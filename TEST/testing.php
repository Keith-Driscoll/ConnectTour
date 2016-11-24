<?php 
	include 'segments/header.php';
	include "segments/navigation.php";
	include 'classes/connections.php';
	$db_connection = db_connect(); 
	$pid = $_SESSION['user_id'];
	$sql = "SELECT * FROM notifications WHERE p_id=".$pid." ORDER BY timestamp DESC LIMIT 10";
	$result = $db_connection->query($sql);

function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    date_default_timezone_set("UTC"); 
    $now             = time();
    $unix_date         = strtotime($date);
    
       // check validity of date
    if(empty($unix_date)) {    
        return "Bad date";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    
    return "$difference $periods[$j] {$tense}";
}

?>
<link href="../css/notifications.css" rel="stylesheet"/>
<div class="notifications">
	<?php
	while($row=$result->fetch_assoc()){
		if($row['is_read']==0){
			echo "
		<a href=".$row['link'].">
		<p class='unread'><b>".$row['message']."   ".nicetime($row['timestamp'])."</b></p>
		</a>
		<br>

		";
		}
		else echo"
		<a href=".$row['link'].">
		<p class='read'>".$row['message']."    ".nicetime($row['timestamp'])."</p>
		</a>
		<br>
		";
		$sql = "UPDATE notifications SET is_read=1 WHERE is_read=0";
		$db_connection->query($sql);
	}
	?>
</div>





<?php
	include 'segments/footer.php';
?>