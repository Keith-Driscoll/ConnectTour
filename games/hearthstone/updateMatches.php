<?php 
	$gameNo = $_GET['game_number'];
	$matchId = $_GET['match_id'];
	$sql = "SELECT winner FROM hearthstone_games 
			WHERE game_number = ".$gameNo." AND match_id = ".$matchId;
	$result = $db_connection->query($sql);
	if ($result){
		$row = $result->fetch_assoc();
		$winner = $row['winner'];
		if ($winner == 1 || $winner == 2){
			$sql = "UPDATE matches 
					SET player_".$winner."_wins = player_".$winner."_wins + 1
					WHERE id = ".$matchId;
			$result = $db_connection->query($sql);
		}
	}
	
	$sql = "SELECT * FROM matches WHERE id = ".$matchId;
	$result = $db_connection->query($sql);
	if ($result->num_rows > 0){
		$match = $result->fetch_assoc();
	}
	
	if (($match['player_1_wins'] == intval($match['bestof']/2)+1)||($match['player_2_wins'] == intval($match['bestof']/2)+1)){
		echo "enter"; 	
		$p_num = 0;
		if ($match['player_1_wins'] > $match['player_2_wins']){	
			echo "update 1";
			$p_num = 1;
		} else {
			echo "update 2";
			$p_num = 2;
		}
		$sql = "UPDATE matches SET player_".$p_num."_result = 1 WHERE id = ".$matchId;
		echo $sql;
		$db_connection->query($sql);
		
		$sql = "SELECT * FROM matches WHERE id = ".$match['parent_1'];
		$result = $db_connection->query($sql);
		$x = $result->fetch_assoc();
		
		//if match is first child, move player into p1 slot
		if ($match['id'] == $x['child_1']){
			$sql = "UPDATE matches SET player_1_id = '".$match['player_'.$p_num.'_id']."' WHERE id = '".$x['id']."'";
			$result = $db_connection->query($sql);
		} else if ($match['id'] == $x['child_2']){
			$sql = "UPDATE matches SET player_2_id = '".$match['player_'.$p_num.'_id']."' WHERE id = '".$x['id']."'";
			$result = $db_connection->query($sql);
		 }
	}
	
?>	