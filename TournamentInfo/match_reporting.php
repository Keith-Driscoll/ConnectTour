<?php 

	/*
		Add: 	- Function to check result - removes ~30 lines and improves readibility
				- Checking if match has concluded
					- Call function to update bracket position
					- Display winning/losing messages to particpants
				- Get score to update on submit, rather than on page refresh (AJAX?)
				- Something should be here and it's important, but I forgot...
		Last Updated: Adam - 11:55PM 21/11/15
	*/
	
	//included in match info	
	
	if (isset($_POST['game'])){
		
		if ($_POST['game'] == 'I won'){
			$user_result = 1;
		} else if ($_POST['game'] == 'I lost'){
			$user_result = 0;
		}
	
		//deals with instances where player submitting is player1 in the match record		
		if ($p_id == $match['player_1_id']){
			
			//if the other player has already reported the outcome
			if($match['player_2_result'] != NULL){
				//compare outcomes
				if ($match['player_2_result'] != $user_result){					
					if ($match['player_2_result'] == 1 && $user_result == 0){
						$sql = "UPDATE matches SET player_2_wins = player_2_wins + 1 WHERE id = '".$matchid."'";
						$result = $db_connection->query($sql);
					 	
						if (!$result){
							 echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
						} else {
							$sql = "UPDATE matches SET player_1_result = NULL, player_2_result = NULL WHERE id = '".$matchid."'";
							$result = $db_connection->query($sql);
							if (!$result){
							 	echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
							}	
						}
					} else if ($match['player_2_result'] == 0 && $user_result == 1){
						$sql = "UPDATE matches SET player_1_wins = player_1_wins + 1 WHERE id = '".$matchid."'";
						$result = $db_connection->query($sql);
					 	
						if (!$result){
							 echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
						} else {
							$sql = "UPDATE matches SET player_1_result = NULL, player_2_result = NULL WHERE id = '".$matchid."'";
							$result = $db_connection->query($sql);
							if (!$result){
							 	echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
							}	
						}
					} else {
						echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
					}
													
				} else if ($match['player_2_result'] == $user_result){
					
					//create admin table, with composite key player_id and tournament_id
					echo "It appears that you have disagreed on who won. Admins have been notified and will be with you
							shortly to resolve the dispute";
					//and alert the admins				
					
				} else {
					echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
				}
			//if player 2 hasn't reported the outcome, update the db with the submitters alleged outcome.
			} else {
				$sql = "UPDATE matches SET player_1_result = $user_result WHERE id = '".$matchid."'";
				$result = $db_connection->query($sql);
				if (!$result){
					echo "There was an error in updating your score</br>".$mysqli_error;
				} 
			}
			
		//deals with instances where player submitting is player2 in the match record
		} else if ($p_id == $match['player_2_id']){
			
			//if the other player has already reported the outcome
			if($match['player_1_result'] != NULL){
				//compare outcomes
				if ($match['player_1_result'] != $user_result){
					
					if ($match['player_1_result'] == 1 && $user_result == 0){
						$sql = "UPDATE matches SET player_1_wins = player_1_wins + 1 WHERE id = '".$matchid."'";
						$result = $db_connection->query($sql);
					 	
						if (!$result){
							 echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
						} else {
							$sql = "UPDATE matches SET player_1_result = NULL, player_2_result = NULL WHERE id = '".$matchid."'";
							$result = $db_connection->query($sql);
							if (!$result){
							 	echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
							}	
						}
					} else if ($match['player_2_result'] == 0 && $user_result == 1){
						$sql = "UPDATE matches SET player_2_wins = player_2_wins + 1 WHERE id = '".$matchid."'";
						$result = $db_connection->query($sql);
					 	
						if (!$result){
							 echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
						} else {
							$sql = "UPDATE matches SET player_1_result = NULL, player_2_result = NULL WHERE id = '".$matchid."'";
							$result = $db_connection->query($sql);
							if (!$result){
							 	echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
							}	
						}
					} else {
						echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
					}
					
				} else if ($match['player_1_result'] == $user_result){
					
					//create admin table, with composite key player_id and tournament_id
					echo "It appears that you have disagreed on who won. Admins have been notified and will be with you
							shortly to resolve the dispute";
					//and alert the admins
					
				} else {
					echo "Sorry, something went wrong with updating your score. Please ask an admin for help</br>";
				}
			//if player 1 hasn't reported the outcome, update the db with the submitters alleged outcome.
			} else {
				$sql = "UPDATE matches SET player_2_result = $user_result WHERE id = '".$matchid."'";
				$result = $db_connection->query($sql);
				if (!$result){
					echo "There was an error in updating your score</br>".$mysqli_error;
				}
			}	
		}
		
		//THIS ONLY WORKS FOR SINGLE ELIM
		if (($match['player_1_wins'] == intval($match['bestof']/2)+1)||($match['player_2_wins'] == intval($match['bestof']/2)+1)){	
			if ($match['player_1_wins'] > $match['player_2_wins']){
				update_bracket(1);
			} else {
				update_bracket(2);
			}
		}
		
				
	}
	
	//when a match is completed, update the bracket to advance the winner to the next round.
	function update_bracket($p_num){
		$sql = "SELECT * FROM matches WHERE id = '".$match['parent_1']."'";
		$result = $db_connection->query($sql);
		$x = $result->fetch_assoc();
		
		//if match is first child, move player into p1 slot
		if ($match['id'] == $x['child1']){
			$sql = "UPDATE matches SET player_1_id = '".$match['player_'.$p_num.'_id']."' WHERE id = '".$x['id']."'";
			$result = $db_connection->query($sql);
		} else if ($match['id'] == $x['child2']){
			$sql = "UPDATE matches SET player_2_id = '".$match['player_'.$p_num.'_id']."' WHERE id = '".$x['id']."'";
			$result = $db_connection->query($sql);
		}
	}
?>