<?php 
	/* Old Code 
	include 'segments/header.php';
	include "segments/navigation.php";
	include 'classes/connections.php';
	$db_connection = db_connect(); 

*/
	require_once '/../classes/connections.php';
	session_start();
	$db_connection = db_connect();
	$p_id = $_SESSION['user_id'];
	
	$sql = "SELECT * FROM player WHERE id = '".$p_id."'";
	$result = $db_connection->query($sql);
	
	if ($result){
		$player_info = $result->fetch_assoc();
		$p_username = $player_info['player_username'];		
	} 
	

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
<link href="../css/profile.css" rel="stylesheet"/>
<!-- Title -->
<row centered>
		<h2>My Notifications</h2>
</row><!-- ./Title end -->

<!-- wrapper start -->
<row centered>
<!-- wrapper start -->
	<column cols="12">
		<!-- notifications center-->
		<div class="notifications">
			<!-- Title row start-->
			<row centered>
				<column cols="8">
					<div class="notif-title">
						<p>Message</p>
					</div>
				</column>
				<column cols="4">
					<div class="notif-title">
						<p>Timestamp</p>
					</div>
				</column>
			</row><!-- ./Title row end -->
			<!-- Body row start -->
			<?php
			$sql = "SELECT * FROM notifications WHERE p_id=".$p_id." ORDER BY timestamp DESC LIMIT 10";
			$result = $db_connection->query($sql);
			while($row=$result->fetch_assoc()){
				
				if($row['is_read']==0){
					echo "
				<a href=".$row['link'].">
					<row centered class='unread'>
						<column cols='8'>
							<div class='notif-body'>
								<p>".$row['message']."</p>
							</div>
						</column>
						<column cols='4'>
							<div class='notif-body'>
								<p>".nicetime($row['timestamp'])."</p>
							</div>
						</column>
					</row>
				</a>";
				}
				else echo"
				<a href=".$row['link'].">
					<row centered class='read'>
						<column cols='8'>
							<div class='notif-body'>
								<p>".$row['message']."</p>
							</div>
						</column>
						<column cols='4'>
							<div class='notif-body'>
								<p>".nicetime($row['timestamp'])."</p>
							</div>
						</column>
					</row>
				</a>";
				$sql = "UPDATE notifications SET is_read=1 WHERE is_read=0";
				$db_connection->query($sql);
			}
			?>
		</div><!-- ./notifications end -->
	</column><!-- ./wrapper end -->
</row><!-- wrapper end -->

<?php /* 

Old notifications code

<row centered>
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
	
	*/ ?>
	
<?php /*
<!-- non-php version, for testing purposes 
-->
<div class="notifications">
<!-- Title row start-->
	<row centered>
		<column cols="8">
			<div class="notif-title">
				<p>Message</p>
			</div>
		</column>
		<column cols="4">
			<div class="notif-title">
				<p>Timestamp</p>
			</div>
		</column>
	</row><!-- ./Title row end -->
	<!-- row start-->
	<a class="notif-unread" href="#">
		<row centered>
			<column cols="8">
				<div class="notif-body">
					<p>Message body is contained within this div</p>
				</div>
			</column>
			<column cols="4">
				<div class="notif-body">
					<p>Posted 2 hours ago</p>
				</div>
			</column>
		</row>
	</a><!-- ./row end -->
	*/ ?>