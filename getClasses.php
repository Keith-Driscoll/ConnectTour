<?php
	require_once("classes/connections.php");
	
	$match_id = $_GET['match_id'];
	$player =  $_GET['player'];
	$state = $_GET['state'];
	
	$db_connection = db_connect();
	
	switch($state){
		case 1:
			print "Shouldn't be here for case 1";	
			break;
		case 2:
			$sql = "SELECT classes_picked".$player." FROM hearthstone WHERE match_id=".$match_id;
			$result = $db_connection->query($sql);
			if ($result->num_rows > 0){
				$row = $result->fetch_assoc();
				print $row['classes_picked'.$player];
			} else {
				print "Error";
			}
			break;
		case 3:
			print "Shouldn't be here for case 3";
			break;
		case 4:
			if ($player == 1){
				$alt = 2;
			} else {
				$alt = 1;
			}
			$sql = "SELECT classes_picked".$player.", classes_picked".$alt." FROM hearthstone WHERE match_id = ".$match_id;
			$result = $db_connection->query($sql);
			if ($result->num_rows > 0){
				$row = $result->fetch_assoc();
				print $row['classes_picked'.$player];
				print $row['classes_picked'.$alt];
			} else {
				print "Error";
			}
			break;
	}
?>