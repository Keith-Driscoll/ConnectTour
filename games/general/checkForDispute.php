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
	$sql  = "SELECT * FROM general_games WHERE match_id = $match_id AND game_number = $game_number";
	$result = $db_connection->query($sql);
	$game = $result->fetch_assoc();
		
	//check if classes match
	if($game["player_".$opp."_result"]!=null){		
			if($win==$game['player_'.$opp.'_result']){
				echo "Result dispute\n"; 
			}		
	}
	
?>