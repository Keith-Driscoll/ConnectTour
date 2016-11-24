<?php 
	include '../classes/connections.php';
	session_start();
	$db_connection = db_connect();
	$pid = $_SESSION['user_id'];
	$sql = "SELECT disputes.id,disputes.match_id,disputes.game_number,disputes.status,disputes.timestamp
		FROM disputes JOIN matches WHERE matches.id=disputes.match_id";
			

	$result = $db_connection->query($sql);
	$rows = mysqli_fetch_all($result);
	$json = json_encode($rows);
	echo($json);
?>