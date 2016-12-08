<?php 
	include '../classes/connections.php';
	$db_connection = db_connect();

	$sql = "SELECT id, tour_type, tour_name, tour_price, 
<<<<<<< HEAD
					tour_region, tour_members, tour_max, tour_start, 
			FROM tournaments WHERE TRUE";
=======
					tour_region, tour_members, tour_max, tour_start, StartTime
			FROM tours WHERE TRUE";
>>>>>>> parent of 7f79b2d... changed toir table - jim

			
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
	$result = $db_connection->query($sql);
	$rows = mysqli_fetch_all($result);
	$json = json_encode($rows);
	echo($json);
?>