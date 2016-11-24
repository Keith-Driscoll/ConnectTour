<?php 
	require_once '../../classes/connections.php';
	$db_connection = db_connect();
	$win = $_GET['win'];	
	$match_id = $_GET['match_id'];
	$game_number = $_GET['game_number'];
	$self = $_GET['self'];	
	$opp = 1;
	if($self == 1){
		$opp = 2;
	}
	
	$sql = "SELECT * FROM general_games WHERE game_number = $game_number AND match_id = $match_id";
	$res = $db_connection->query($sql);
	
	if($res -> num_rows >0){
		$sql = "UPDATE general_games SET player_".$self."_result = $win WHERE game_number = $game_number AND match_id = $match_id";
	}
	else{
		$sql = "INSERT INTO general_games (player_".$self."_result, match_id, game_number)
		VALUES ($win,$match_id,$game_number)";
	}	
	
	if ($db_connection->query($sql) === TRUE) {
    	//echo "New record created successfully\n";
	} else {
    	echo "Error: " . $sql . "\n" . $db_connection->error;
	}
	
	$sql  = "SELECT * FROM general_games WHERE match_id = $match_id AND game_number = $game_number";
	$result = $db_connection->query($sql);
	$game = $result->fetch_assoc();
	
	//echo $game['player_1_class1']."//".$game['player_1_class2']."//".$game['player_2_class1']."//".$game['player_2_class2'];
	//check if classes match
	if($game["player_1_result"]!=null&&$game["player_2_result"]!=null){
				
		if($game["player_1_result"]==$game['player_2_result']){
			//Dispute
			
			$sql = "INSERT INTO disputes (match_id,game_number,game_type) values ($match_id,$game_number,'general')";
			if ($db_connection->query($sql) === TRUE) {				
			} else {
				echo "Error: " . $sql . "\n" . $db_connection->error;
			}
			
		}else if($game["player_1_result"]==1&&$game['player_2_result']==0){
			//Player 1 wins
			$sql = "UPDATE general_games SET winner = 1 WHERE game_number = $game_number AND match_id = $match_id";
			if ($db_connection->query($sql) === TRUE) {				
			} else {
				echo "Error: " . $sql . "\n" . $db_connection->error;
			}
			
		}else if($game["player_1_result"]==0&&$game['player_2_result']==1){
			//Player 2 wins
			$sql = "UPDATE general_games SET winner = 2 WHERE game_number = $game_number AND match_id = $match_id";
			if ($db_connection->query($sql) === TRUE) {				
			} else {
				echo "Error: " . $sql . "\n" . $db_connection->error;
			}
		}
	}
	else{				
			$sql = "INSERT INTO disputes (match_id,game_number,game_type) values ($match_id,$game_number,'general')";
			if ($db_connection->query($sql) === TRUE) {				
			} else {
				echo "Error: " . $sql . "\n" . $db_connection->error;
			}
	}
	
	
	include 'updateMatches.php';
?>