<link rel='stylesheet' href='css/bracketStyle.css' />
<div class="all">
	
	<?php
		header('P3P: CP="CAO PSA OUR"');
		session_start();
		require_once 'classes/connections.php';
		//include 'bracketgeneration.php';
		$db_connection = db_connect();
		//holds the id of the tournament, pulled from url
		$t_id = intval($_GET['id']);
		//holds user_id stored in session if the player is logged in
		$p_id = intval($_SESSION['user_id']);
		//query retrieves all data relating to the tournament $t_id
		$sql = "SELECT * FROM tournaments WHERE id = '".$t_id."'";
		$result = $db_connection->query($sql);
		$checkin = $result->fetch_assoc();
		//query retrieves the ids of all players registered to the tournament
		$sql = "SELECT Player_id FROM tournament_participants WHERE Player_id = '".$p_id."' AND tournaments_id = '".$t_id."'";
		$test = $db_connection->query($sql);
		$inTournament = !($test->num_rows == 0);
		$allPlayers = array();
		$allScores = array();
		$allResults = array();
		$matchesIDs = array();
		
		$totalPlayers = 0;
		
		if ($checkin['tournament_checkin_phase'] == 2){
			// This searches for all of the matches in the tournament and orders them first by their round number and then by their id number.
			$sql = "SELECT * FROM matches WHERE tournament_id = $t_id ORDER BY round_num ASC, id ASC";
			$result = $db_connection->query($sql);
			if ($result && $result->num_rows > 0){
				// This searches for the highest round number and sets that as the total number of rounds.
				/*
				$sql = "SELECT MAX(round_num) as round_ceiling FROM matches WHERE tournament_id = ".$t_id;
				$total_rounds = $db_connection->query($sql);
				$x = $total_rounds->fetch_assoc();	
				$roundTotal = $x['round_ceiling'];	
				*/
				$current_round = 1;
				$match = $result->fetch_assoc();
				
				$scoreString .= "[";
				
				$index = 0;
				
				while ($current_round == $match['round_num']){
					
					$p1id = $match['player_1_id'];
					//query returns the name of player_1 of next match
					$sql = "SELECT player_username FROM player WHERE id = '".$p1id."'";
					$users = $db_connection->query($sql);
					$name = $users->fetch_assoc();	
					$allPlayers[$p1id] = $name['player_username'];				
					$p2id = $match['player_2_id'];
					
					//query returns name of player_2 of next match
					$sql = "SELECT player_username FROM player WHERE id = '".$p2id."'";
					$users = $db_connection->query($sql);
					$name = $users->fetch_assoc();
					$allPlayers[$p2id] = $name['player_username'];
					
					//Get match results into array 
					if($match['player_1_result']==1&&$match['player_2_result']==0){
						$allResults[] = 1;
						$scoreString .= "[1,0]";
					}
					else if($match['player_1_result']==0&&$match['player_2_result']==1){
						$allResults[] = 2;
						$scoreString .= "[0,1]";
					}
					else{
						$allResults[] = 0;
						$scoreString .= "[0,0]";
					}
					//Get exact match scores into array
					$allScores[] = $match['player_1_wins'];
					$allScores[] = $match['player_2_wins'];
									
					$totalPlayers += 2;
					//get next match and check if still in same round
					$match = $result->fetch_assoc();
					if($current_round == $match['round_num']){
						$scoreString .= ",";
					}
					
					$matchesIDs[$index] = $p1id;
					$index++;
					$matchesIDs[$index] = $p2id;
					$index++;
					
				}	
				$p1id = $match['player_1_id'];
				$p2id = $match['player_2_id'];
				$matchesIDs[$index] = $p1id;
				$index++;
				$matchesIDs[$index] = $p2id;
				$index++;
				
				$scoreString .= "],[";
				
				//Get match results into array 
				if($match['player_1_result']==1&&$match['player_2_result']==0){
					$allResults[] = 1;
					$scoreString .= "[".$match['player_1_result'].",".$match['player_2_result']."]";
				}
				else if($match['player_1_result']==0&&$match['player_2_result']==1){
					$allResults[] = 2;
					$scoreString .= "[".$match['player_1_result'].",".$match['player_2_result']."]";
				}
				else{
					$allResults[] = 0;
					$scoreString .= "[0,0]";
				}
				$scoreString .= ",";
				$allScores[] = $match['player_1_wins'];
				$allScores[] = $match['player_2_wins'];		
						
				$current_round++;
				
				while ($match = $result->fetch_assoc())
				{	
					if($current_round != $match['round_num']){
						$scoreString = rtrim($scoreString, ",");
						$scoreString .= "],[";
						$current_round++;
					}
					//Get ids from match for js array
					$p1id = $match['player_1_id'];
					$p2id = $match['player_2_id'];
					$matchesIDs[$index] = $p1id;
					$index++;
					$matchesIDs[$index] = $p2id;
					$index++;
				
					//Get match results into array 
					
					if($match['player_1_result']==1&&$match['player_2_result']==0){
						$allResults[] = 1;
						$scoreString .= "[".$match['player_1_result'].",".$match['player_2_result']."]";
					}
					else if($match['player_1_result']==0&&$match['player_2_result']==1){
						$allResults[] = 2;
						$scoreString .= "[".$match['player_1_result'].",".$match['player_2_result']."]";
					}
					else{
						$allResults[] = 0;
						$scoreString .= "[0,0]";
					}
					
					//Get scores for js
					$allScores[] = $match['player_1_wins'];
					$allScores[] = $match['player_2_wins'];
					
					//Initial bracket string generation		
					/*		
					if($current_round == $match['round_num']){
						$scoreString .= ",";
					}
					else $current_round++;
					*/
					$scoreString .= ",";
					

				}
				$scoreString = rtrim($scoreString, ",");
				$scoreString .= "]";	
				
		}	
	} else {
		echo "Sorry, the bracket for this tournament has not been generated yet. Please wait for the tournament to start.";
	}					
		//Initial bracket string generation	
		for($x=0;$x<$totalPlayers;$x+=2)
		{				
			$player1 = "blank".$x;			
			$player2 = "blank".($x+1);
			
			$str .= "['" .$player1."','".$player2."']";
			
			if($x!=$totalPlayers-2){
				$str .= ",";
			}
		}
		echo "
		<script type='text/javascript' src='js/jquery.min.js'></script>
		<script type='text/javascript' src='js/jquery-bracket/dist/jquery.bracket.min.js'></script>
		<link rel='stylesheet' type='text/css' href='js/jquery-bracket/dist/jquery.bracketx.min.css' />
		
		";
		include 'bracket_manipulation.php';
		echo"			
		
		<div class='bracketDraw'>

		</div> 
	
</div>
";



