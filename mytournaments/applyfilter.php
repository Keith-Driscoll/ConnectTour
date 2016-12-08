<?php
	include '../classes/connections.php';
	$db_connection = db_connect();
	session_start();
    $sql = "SELECT      id, tour_type, tour_name, tour_price,
					tour_region, tour_members, tour_max, tour_start, StartTime
			FROM tournament_participants
			JOIN tours ON tournament_participants.Tours_id = tours.id
			WHERE tournament_participants.Player_id = ".$_SESSION['user_id']."
				AND tournaments.tournament_checkin_phase >= 0";

	//$result = $db_connection->query($sql);


	//append filters to text if needed
	if(isset($_POST['Game']) && $_POST['Game'] != "Choose Tour"){
		$sql .= " AND tour_type = '".$_POST['Game']."'";
	}
	if(isset($_POST['Region']) && $_POST['Region'] != "Choose Region"){
		$sql .= " AND tour_region = '".$_POST['Region']."'";
	}
	// if(isset($_POST['Min_pool'])){
	// 	$sql .= " AND tournament_prize_pool_start >= '".$_POST['Min_pool']."'";
	// }
	// if(isset($_POST['Max_fee'])){
	// 	$sql .= " AND tournament_entry_fee <= '".$_POST['Max_fee']."'";
	// }
	$sql.= " ORDER BY tournaments.tournament_checkin_phase DESC";
	$result = $db_connection->query($sql);
	$rows = mysqli_fetch_all($result);
	$json = json_encode($rows);
	echo($json);
?>