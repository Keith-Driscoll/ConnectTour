<?php
	$servername = "gglmysql.cloudapp.net";
	$username = "ggl_adam";
	$password = "skwreapm0011";
	$dbname = "ggl_main";

	// Create connection
	$db_connection = new mysqli($servername, $username, $password, $dbname);
	echo '1';
	$sql = "SELECT id 
			FROM tournaments
			WHERE unix_timestamp(tournament_start_timestamp) - unix_timestamp(NOW())<=3600 
			AND tournament_checkin_phase=0";
	echo '2';
	$tournament = $db_connection->query($sql);
	
	echo '3';
	if($tournament->num_rows>0){
		echo '4';
		while($t_row=$tournament->fetch_assoc()){
			
			$sql= "UPDATE tournaments 
				   SET tournament_checkin_phase = 1
				   WHERE id='".$t_row['id']."'";
			$db_connection->query($sql);
			
			echo '5';
			$sql = "INSERT INTO chat_session(chat_class,class_id)
					VALUES('tournament_lobby','".$t_row['id']."')";
			echo '6';
			$db_connection->query($sql);
			
			$chat_id = $db_connection->insert_id;
			echo '7';
			$sql = "SELECT * FROM tournament_participants 
					WHERE Tournaments_id='".$t_row['id']."'";
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