<?php 
	require_once 'classes/connections.php';
	$db_connection = db_connect();
	$matchid = $_GET['match_id'];
	$gnum = $_GET['gnum'];
	$p = $_GET['p'];
	$go = false;
	$sql = "SELECT * FROM hearthstone_games WHERE match_id = $matchid"; 
	$result = $db_connection->query($sql);
    $game = $result->fetch_assoc();

	$pow = 0;
	$usedP1 = 0;
	$usedP2 = 0;
	$allUsedA1 = 0;
	$allUsedA2 = 0;
	$allUsedB1 = 0;
	$allUsedB2 = 0;
	if($pow<$gnum){
		//Options accounting for win/loss
		$usedP1 += $game['player_1_class1'] * pow(10, $pow)* $game['player_1_result'];
		$usedP2 += $game['player_2_class1'] * pow(10, $pow)* $game['player_2_result'];
		//Player 1's options 
		$allUsedA1 += $game['player_1_class1'] * pow(10, $pow);
		$allUsedA2 += $game['player_2_class1'] * pow(10, $pow);
		//Player 2's options
		$allUsedB1 += $game['player_1_class1'] * pow(10, $pow);
		$allUsedB2 += $game['player_2_class1'] * pow(10, $pow);
		$pow++;
	}
	while($pow<$gnum && ($game = $result->fetch_assoc())){		
		//Options accounting for win/loss
		$usedP1 += $game['player_1_class1'] * pow(10, $pow)* $game['player_1_result'];
		$usedP2 += $game['player_2_class1'] * pow(10, $pow)* $game['player_2_result'];
		//Player 1's options 
		$allUsedA1 += $game['player_1_class1'] * pow(10, $pow);
		$allUsedA2 += $game['player_2_class1'] * pow(10, $pow);
		//Player 2's options
		$allUsedB1 += $game['player_1_class1'] * pow(10, $pow);
		$allUsedB2 += $game['player_2_class1'] * pow(10, $pow);
		$pow++;
	}		
	
	
		if($p==1){		
			if($game['player_2_result']!=null && $game['player_2_result']!=""){
				$go = true;
			}		
		}
		else{
			if($game['player_1_result']!=null && $game['player_1_result']!=""){
				$go = true;
			}
		}	
		$screenshotStr = "" . $matchid ."_". $gnum ."_". intval($_SESSION['user_id']);
		require_once "getImage.php";
		$screenshotSelf = getImage($screenshotStr,"match_screenshots");
		//Array positions
	if($go){	//0			//1					//2						//3					//4				//5					//6					//7								//8							//9
		print $usedP1 ."|". $usedP2 . "|" . $game['winner'] . "|" . $allUsedA1 . "|" . $allUsedA2 . "|" . $allUsedB1 . "|" . $allUsedB2 ."|". $game['player_1_result']."|". $game['player_2_result'] ."|". $screenshotSelf ;
	}
	
?>