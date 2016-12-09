<?php
    $servername = "127.0.0.1:49354";
	$username = "azure";
	$password = "6#vWHD_$";
	$dbname = "connecttour_db";

	// Create connection
	$db_connection = new mysqli($servername, $username, $password, $dbname);
	echo '1';
	$sql = "SELECT id
			FROM tours
			WHERE unix_timestamp(tour_start) - unix_timestamp(NOW())<=3600
			AND tour_checkin_phase=0";
	echo '2';
	$tour = $db_connection->query($sql);

	echo '3';
	if($tour->num_rows>0){
		echo '4';
		while($t_row=$tour->fetch_assoc()){

			$sql= "UPDATE tours
				   SET tour_checkin_phase = 1
				   WHERE id='".$t_row['id']."'";
			$db_connection->query($sql);

			echo '5';
			$sql = "INSERT INTO chat_session(chat_class,class_id)
					VALUES('tour_lobby','".$t_row['id']."')";
			echo '6';
			$db_connection->query($sql);

			$chat_id = $db_connection->insert_id;
			echo '7';
			$sql = "SELECT * FROM tour_participants
					WHERE Tours_id='".$t_row['id']."'";
			$participants = $db_connection->query($sql);
			echo '8';
			if($participants->num_rows>0){
				echo '9';
				while($p_row=$participants->fetch_assoc()){
					echo '10';
					//TODO send notification
					$sql = "INSERT INTO chat_participants(chat_id,player_id,priviledges)
							VALUES ('".$chat_id."','".$p_row['Player_id']."','".$p_row['checked_in']."')";
					$db_connection->query($sql);
				}
			}
		}
	}

?>