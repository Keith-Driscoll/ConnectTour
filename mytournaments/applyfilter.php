<?php 
	include '../classes/connections.php';
	$db_connection = db_connect();
	session_start();
		$sql = "SELECT  tournaments.id, tournaments.tournament_game, tournaments.tournament_name, 
					tournaments.tournament_prize_pool_start, tournaments.tournament_region, 
					tournaments.tournament_current_players, tournaments.tournament_p_max, tournaments.tournament_start_timestamp
			FROM tournament_participants
			JOIN tournaments ON tournament_participants.Tournaments_id = tournaments.id
			WHERE tournament_participants.Player_id = ".$_SESSION['user_id']."
				AND tournaments.tournament_checkin_phase >= 0";

	//$result = $db_connection->query($sql);

	
	//append filters to text if needed
	if(isset($_POST['Game']) && $_POST['Game'] != "Choose Game"){
		$sql .= " AND tournament_game = '".$_POST['Game']."'";
	}
	if(isset($_POST['Region']) && $_POST['Region'] != "Choose Region"){
		$sql .= " AND tournament_region = '".$_POST['Region']."'";
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