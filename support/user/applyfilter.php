<?php 
	include '../../classes/connections.php';
	session_start();
	$db_connection = db_connect();
	$pid = $_SESSION['user_id'];
	$sql = "SELECT tickets.ticket_id, tickets.priority, tickets.category, tickets.title,
			tickets.response_needed, tickets.date_submitted, player.player_username,tickets.last_response
			FROM tickets
			JOIN player ON tickets.submitter = player.id
			WHERE submitter = '".$pid."' ";

			
	//append filters to text if needed
	if(isset($_POST['Game']) && $_POST['Game'] != "Choose Game"){
		//$sql .= " AND tour_game = '".$_POST['Game']."'";
	}
	if(isset($_POST['Region']) && $_POST['Region'] != "Choose Region"){
		//$sql .= " AND tour_region = '".$_POST['Region']."'";
	}
	$result = $db_connection->query($sql);
	$rows = mysqli_fetch_all($result);
	$json = json_encode($rows);
	echo($json);
?>