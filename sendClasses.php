<?php
	$match_id = $_GET['match_id'];
	$player =  $_GET['player'];
	$dbVal = $_GET['dataBaseValue'];
	require_once("classes/connections.php");
	$db_connection = db_connect();
	$db_connection->query( "SET NAMES 'UTF8'" );
	if($player==1){
		$statement = $db_connection->prepare( "UPDATE hearthstone SET classes_picked1=? WHERE match_id=".$match_id);
		//set notification
		$sql = "SELECT tournament_id, player_2_id FROM matches WHERE id=".$match_id;
		$res = $db_connection->query($sql);
		$row = $res->fetch_assoc();
		$link = "tournamentinfo.php?id=".$row['tournament_id'];
		$sql="INSERT INTO notifications (p_id,message,link) VALUES (".$row['player_2_id'].", 'Your opponent locked in their classes', '".$link."')";
		$db_connection->query($sql);
	}
	else{
		$statement = $db_connection->prepare( "UPDATE hearthstone SET classes_picked2=? WHERE match_id=".$match_id);
		//set notification
		$sql = "SELECT tournament_id, player_1_id FROM matches WHERE id=".$match_id;
		$res = $db_connection->query($sql);
		$row = $res->fetch_assoc();
		$link = "tournamentinfo.php?id=".$row['tournament_id'];
		$sql="INSERT INTO notifications (p_id,message,link) VALUES (".$row['player_1_id'].", 'Your opponent locked in their classes', '".$link."')";
		$db_connection->query($sql);
	}
	print $match_id."//".$player."//".$dbVal;
	$statement->bind_param( 'i', $dbVal);
	$statement->execute();
	$statement->close();
	$db_connection->close();
?>