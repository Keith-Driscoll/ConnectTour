<?php
	require_once 'segments/header.php';
	require_once 'segments/navigation.php';
	require_once 'classes/connections.php'; 

	$db_connection = db_connect();
	if (isset($_GET['team'])){
		$team_id = intval($_GET['team']);
	}
	$sql = "SELECT * FROM teams WHERE id = $team_id";
	$result = $db_connection->query($sql);

	$name = $result->fetch_assoc();	
	$sql = "SELECT * FROM team_members WHERE team_id = $team_id";
	$result = $db_connection->query($sql);
	

	$memberArr = "(";
?>
<h1><?php echo $name['name'];?></h1>
<h1>Members</h1>
<row>
<?php 
	require_once 'getProfilePicture.php';
	while ($member = $result->fetch_assoc()){	
		$memberArr += $member['id']+",";
		$theProfilePic = getProfilePicture($member['player_id']);
		echo " 
			<div id='participantcard' class=''>
				<div onclick='window.location=`profile.php?id=".$member['id']."`;' class='participants onePerson'>
					<img src='".$theProfilePic."' class='' alt='user-profile' />
					<div><p>".$member['player_username']."</p></div>
				</div>
			</div>
		";
	}	
	rtrim($memberArr, ",");
	$memberArr += ")";
?>	
</row>

<?php
	$sql = "SELECT * FROM  matches WHERE player_1_id OR player_2_id IN $memberArr";
	

?>

<div>
	<h1>Recent Matches<h1>

</div>