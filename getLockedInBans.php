<?php

	$player =  $_GET['player'];
	$match_id =  $_GET['match_id'];
	require_once 'classes/connections.php';
	$db_connection = db_connect();
	
	if ($player == 1){
		$opp = 2;
	} else {
		$opp = 1;
	}
	$sql = "SELECT classes_banned".$player.", classes_banned".$opp." FROM hearthstone WHERE match_id = ".$match_id;
	$result = $db_connection->query($sql);
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		if ($row['classes_banned'.$player]){
			if ($row['classes_banned'.$opp]){
				print(4);
			} else {
				print(3);
			}
		} else {
			if ($row['classes_banned'.$opp]){
				print(2);
			} else {
				print(1);
			}
		}
	} else {
		print "Error";
	}
?>