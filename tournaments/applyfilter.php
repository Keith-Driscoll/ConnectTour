<?php 
	include '../classes/connections.php';
	$db_connection = db_connect();

	$sql = "SELECT id, tournament_game, tournament_name, tournament_prize_pool_start, 
					tournament_region, tournament_current_players, tournament_p_max, tournament_start_timestamp 
			FROM tournaments WHERE TRUE";
			
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
	$result = $db_connection->query($sql);
	$rows = mysqli_fetch_all($result);
	$json = json_encode($rows);
	echo($json);
?>