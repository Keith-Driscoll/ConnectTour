<?php
	$t_id = $_GET['t_id'];
	$p_id =  $_GET['p_id'];
	$joining = $_GET['joining'];
	require_once("classes/connections.php");
	$db_connection = db_connect();
	if($joining==1){
		$sql = "SELECT tour_members,tour_max FROM tours WHERE id=$t_id";
		$res = $db_connection->query($sql);
		$row = $res->fetch_assoc();
		$current = $row['tour_participants'];
		$max = $row['tour_max'];
		if($current<$max){
			$stmt = $db_connection->prepare("INSERT INTO tour_participants (Player_id, tours_id) VALUES (?, ?) ");
			$stmt->bind_param("ii", $p_id, $t_id);
			$stmt->execute();
			$stmt->close();
			$sql = "UPDATE tours SET tour_members = tour_members + 1 WHERE id=".$t_id;
			$db_connection->query($sql);
		}
		else{
			//insert into waiting list
			$sql = "SELECT MAX(place_number) AS max_place FROM waiting_list WHERE t_id=$t_id";
			$res = $db_connection->query($sql);
			if($res->num_rows==0){
				$placenumber = 1;
			}
			else{
				$row = $res->fetch_assoc();
				$placenumber = $row['max_place']+1;
			}
			$sql = "INSERT INTO waiting_list (p_id,t_id,place_number) VALUES($p_id,$t_id,$placenumber)";
			$db_connection->query($sql);
		}
		
	}
	else{
		$sql = "DELETE FROM tour_participants WHERE tours_id=".$t_id." AND Player_id=".$p_id;
		$db_connection->query($sql);
		$sql = "UPDATE tours SET tour_members = tour_members - 1 WHERE id=".$t_id;
		$db_connection->query($sql);
		
	}
	$db_connection->close();
	
?>