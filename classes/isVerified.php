<?php
	require_once 'connections.php';
	session_start();
	$player_id = $_SESSION['user_id'];
	
	$sql = "SELECT is_verified FROM player WHERE id = $player_id";
	$result = $db_connection->query($sql);
	
	if ($result){
		$row = $result->fetch_assoc();
	}
	
	if ($row['is_verified'] == 0){
			header('Location: unverified.php');
	}