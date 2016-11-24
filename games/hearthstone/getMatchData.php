<?
	$path = $_SERVER['DOCUMENT_ROOT'];
	$matchid = $match['id'];
	$sql = "SELECT * FROM hearthstone WHERE match_id = ".$matchid;
	$result2= $db_connection->query($sql);
	$hearth = $result2 -> fetch_assoc();
	
	$myClassesPicked = 0;
	$oppClassesPicked = 0;
	$myBansDone = 0;
	$oppBansDone = 0;
	
	$pickState = 0;
	$banState = 0;
	
	//set self and opp to figure out who is who in the database
	if ($p_id == $match['player_1_id']){
		$self = 1;
		$opponent = 2; 
	} else {
		$self = 2;
		$opponent = 1;
	}

	//determine pick_state 
	if ($hearth['classes_picked'.$self]){
		if ($hearth['classes_picked'.$opponent]){
			$pickState = 4;
		} else {
			$pickState = 2;
		}
	} else {
		if ($hearth['classes_picked'.$opponent]){
			$pickState = 3;
		} else {
			$pickState = 1;
		}
	}
	
	
	switch($pickState){
		case 1:
			break;
		case 2:
			break;
		case 3:
			break;
		case 4:
			
			//determine ban state
			if ($hearth['classes_banned'.$self]){			
				if($hearth['classes_banned'.$opponent]){
					$banState = 4;
				} else {
					$banState = 2;
				}
			} else {
				if($hearth['classes_banned'.$opponent]){
					$banState = 3;
				} else {
					$banState = 1;
				}
			}		
			
			switch($banState){
				case 1:
		
					break;
				case 2:
				
					break;
				case 3:
				
					break;
				case 4:
	
					break;
		
			}			
			break;	
	}		
?>