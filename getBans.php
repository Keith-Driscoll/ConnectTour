<?php 

	$match_id = $_GET['match_id'];
	$player =  $_GET['player'];
	require_once("classes/connections.php");
	$db_connection = db_connect();
	
	$state = $_GET['state'];
	
	if ($player == 1){
		$opp = 2;
	} else {
		$opp = 1;
	}

	switch ($state){
		case 1:
			print "Shouldn't be here for case 1";	
			break;
		case 2:
			$sql = "SELECT classes_banned".$player." FROM hearthstone WHERE match_id=".$match_id;
			$result = $db_connection->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				print $row['classes_banned'.$player];		
			} else {
				print "Error";
			}
			break;
		case 3: 
			print "Shouldn't be here for case 3";	
			break;
		case 4:
			$sql = "SELECT classes_banned".$player.", classes_banned".$opp." FROM hearthstone WHERE match_id=".$match_id;
			$result = $db_connection->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				print $row['classes_banned'.$player];
				print $row['classes_banned'.$opp];		
			} else {
				print "Error";
			}
			break;
	}
?>