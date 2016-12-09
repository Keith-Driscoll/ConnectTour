<?php 
	include '../../classes/connections.php';
	$db_connection = db_connect();
	
	$sql = "SELECT tickets.ticket_id, tickets.priority, tickets.category, support_staff.id, 
			tickets.response_needed, tickets.date_submitted, player.player_username
			FROM tickets
			JOIN support_staff ON tickets.support_assigned = support_staff.id
			JOIN player ON tickets.submitter = player.id
			WHERE support_staff.id = ".$_POST['id'];

			
	//append filters to text if needed
	if(isset($_POST['Game']) && $_POST['Game'] != "Choose Game"){
		//$sql .= " AND tour_game = '".$_POST['Game']."'";
	}
	if(isset($_POST['Region']) && $_POST['Region'] != "Choose Region"){
		//$sql .= " AND tour_region = '".$_POST['Region']."'";
	}
	// if(isset($_POST['Min_pool'])){
	// 	$sql .= " AND tour_prize_pool_start >= '".$_POST['Min_pool']."'";
	// }
	// if(isset($_POST['Max_fee'])){
	// 	$sql .= " AND tour_entry_fee <= '".$_POST['Max_fee']."'";
	// }
	$result = $db_connection->query($sql);
	$rows = mysqli_fetch_all($result);
	$json = json_encode($rows);
	echo($json);
?>