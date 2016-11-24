<?php 
	require_once '../../classes/connections.php';
	$db_connection = db_connect();
	$win = $_GET['win'];
	$myClasses = intval($_GET['myClasses'])+1;
	$oppClasses = intval($_GET['opp'])+1;
	$match_id = $_GET['match_id'];
	$game_number = $_GET['game_number'];
	$self = $_GET['self'];	
	$opp = 1;
	if($self == 1){
		$opp = 2;
	}
	$sql  = "SELECT * FROM hearthstone_games WHERE match_id = $match_id AND game_number = $game_number";
	$result = $db_connection->query($sql);
	$game = $result->fetch_assoc();
		
	//check if classes match
	if($game["player_".$opp."_result"]!=null){
		if($myClasses==$game['player_'.$self.'_class'.$opp]&&$oppClasses==$game['player_'.$opp.'_class'.$opp]){
			if($win==$game['player_'.$opp.'_result']){
				echo "Result dispute\n"; 
			}
		}else{
			echo "Class dispute\n"; 
		}
	}
	
?>