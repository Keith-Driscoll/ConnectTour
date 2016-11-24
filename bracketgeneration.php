<?php 
	global $db_connection;
	session_start();
	require_once("classes/connections.php");
	if ($_SESSION['user_name'] == 'admin' && isset($_POST['b_gen'])){
		echo "<script>console.log('HERE')</script>";
		$db_connection = db_connect();
		$t_id = $_GET['id'];
		$sql = "SELECT tournament_format,tournament_game FROM tournaments WHERE id=$t_id";
		$result3=$db_connection->query($sql);
		$row=$result3->fetch_assoc();
		
		$format = $row['tournament_format'];
		$game_name = $row['tournament_game'];
		$game_table = strtolower($game_name);
		$sql = "SELECT id FROM matches WHERE tournament_id = ".$t_id;
		$result = $db_connection->query($sql);
		if($format != 'League'){
			if ($result->num_rows == 0){

				$sql = "SELECT Player_id FROM tournament_participants WHERE checked_in = 1 AND Tournaments_id = ".$t_id." ORDER BY RAND()";
				$result = $db_connection->query($sql);

				mysqli_error();
				$num_checkins = $result->num_rows;
				$player_ids = array();
				$i=0;
				if ($result){
					while ($name = $result->fetch_assoc()){
						$player_ids[$i] = $name['Player_id'];
						$i++;
					}
				} else {
					echo "Your query has failed";
				}
				echo "<script>console.log('HERE2')</script>";
				//finds largest possible number of matches for first round of given bracket
				$pow2 = 2;
				while ($pow2 < $num_checkins){
					$pow2 = $pow2*2;

				}
				$pow2/=2;	

				$num_rounds = log($pow2, 2)+1;
		
				$num_byes = ($pow2*2) - $num_checkins;
				if ($num_byes > 0){
					$N = intval($pow2/$num_byes);
				}

				generate_bracket($format, $num_rounds, $t_id,$game_table);
				populate_bracket($player_ids);
				account_for_byes();
				$checkinsql = "UPDATE tournaments SET tournament_checkin_phase=2 WHERE id=$t_id";
				$db_connection->query($checkinsql);
			}
		}
		
		else {
			if ($result->num_rows == 0){	
				echo "<script>console.log('here34')</script>";
				generate_bracket($format, $num_rounds, $t_id,$game_table);
				$checkinsql = "UPDATE tournaments SET tournament_checkin_phase=2 WHERE id=$t_id";
				$db_connection->query($checkinsql);
			}
		}
	}
	/*
	if ($_SESSION['user_name'] == 'admin' && isset($_POST['b_gen'])){
		echo "<script>console.log('HERE')</script>";
		$db_connection = db_connect();
		$t_id = $_GET['id'];
		$sql = "SELECT id FROM matches WHERE tournament_id = ".$t_id;
		$result = $db_connection->query($sql);
		$sql = "SELECT tournament_game FROM tournaments WHERE id = ".$t_id;
		$result2 = $db_connection->query($sql);
		$game_name = $result2->fetch_assoc();
		$game_table = strtolower($game_name['tournament_game']);
		if ($result->num_rows == 0){

			$sql = "SELECT Player_id FROM tournament_participants WHERE checked_in = 1 AND Tournaments_id = ".$t_id." ORDER BY RAND()";
			$result = $db_connection->query($sql);

			mysqli_error();
			$num_checkins = $result->num_rows;
			$player_ids = array();
			$i=0;
			if ($result){
				while ($name = $result->fetch_assoc()){
					$player_ids[$i] = $name['Player_id'];
					$i++;
				}
			} else {
				echo "Your query has failed";
			}
			echo "<script>console.log('HERE2')</script>";
			//finds largest possible number of matches for first round of given bracket
			$pow2 = 2;
			while ($pow2 < $num_checkins){
				$pow2 = $pow2*2;

			}
			$pow2/=2;	

			$num_rounds = log($pow2, 2)+1;
	
			$num_byes = ($pow2*2) - $num_checkins;
			if ($num_byes > 0){
				$N = intval($pow2/$num_byes);
			}
			//echo "<script>console.log('HERE3')</script>";
			$sql2 = "SELECT tournament_format FROM tournaments WHERE id = '".$t_id."'";
			$result2 = $db_connection->query($sql2);
			$format = $result2->fetch_assoc();
			//echo "After query<br>";

			generate_bracket($format['tournament_format'], $num_rounds, $t_id,$game_table);
			populate_bracket($player_ids);
			account_for_byes();
			//echo "<script>alert('HERE')</script>";
			$checkinsql = "UPDATE tournaments SET tournament_checkin_phase=2 WHERE id=$t_id";
			$db_connection->query($checkinsql);
		}
	}
	*/
	//function that takes tournament format as input, and generates the matches for the given bracket
	function generate_bracket($t_format, $num_rounds, $t_id,$game_table){
		require_once("classes/connections.php");
		$db_connection = db_connect();
		//determines format and generates bracket
		switch($t_format){
			case 'Single Elimination':
				$round = array(array());
				for ($i=0;$i<=$num_rounds;$i++){
					for ($j=0;$j<pow(2, $i);$j++){
						if ($i > 0){
							
							$parent1 = $round[($i-1)][intval(($j)/2)];
							//echo "<script>console.log('parent1= ".$parent1."')</script>";
						}
						
						$returned_id = create_match($i, $j, $t_id, $parent1, $num_rounds);
						$round[$i][$j] =  $returned_id;
						
						if($i!=$num_rounds){
							$sql = "INSERT INTO ".$game_table." (match_id) VALUES (".$returned_id.")";
							$db_connection->query($sql);
							$sql = "INSERT INTO chat_session (chat_class, class_id) VALUES ('match_lobby', ".$returned_id.")";
							$db_connection->query($sql);
						}
					} 
				}
				break;
			case 'League':
					$sql = "SELECT p_id FROM league_participants WHERE league_id=$t_id ORDER BY RAND()";
					$result = $db_connection->query($sql);
					
					$num_participants = $result->num_rows;
					$matches_per_round = ceil($num_participants/2);
					$num_league_rounds = ceil($num_participants/2)*2-1;
					$players_array_size = $num_league_rounds;
					$players = array();
					$row=$result->fetch_assoc();
					$anchor_player = $row['p_id'];
					while($row=$result->fetch_assoc()){
						$players[] = $row['p_id'];
					}
					if($num_participants%2==1){
						$players[]=-1; //a player value of -1 acts as a bye
					}
					$sql = "SELECT * FROM league_scheduling WHERE league_id=$t_id";
					
					$result = $db_connection->query($sql);
					
					//start of round robin formula
					$round_number=1;
					$pointer=0;
					
					
					while($round_number<=$num_league_rounds){
						//account for 1 being anchored
						$p1=$anchor_player;
						$p2=$players[(15-$round_number)];						
						create_league_match($round_number,$p1,$p2);
						for($j=1;$j<$matches_per_round;$j++){
							$p1 = $players[($players_array_size+$j-$pointer-1)%$players_array_size];
							$p2index = ($players_array_size-$j-1-$pointer)%$players_array_size;
							if($p2index<0){
								$p2index=$players_array_size+$p2index; //handle negative modulus
							}
							$p2= $players[$p2index];
							create_league_match($round_number,$p1,$p2);
						}
						$round_number++;
						$pointer++;
					}
				break;

		/*
			case 'groups_to_single_elim':
				break;


			case 'groups_to_double_elim':
				break;


			case 'swiss':
				break;

		*/
			default:
				echo "Error, unknown format.<br/>";
		}
	}
	
	/* 	id - self explanitory
		parent1id = id of match that winner moves to in double & single elims
		parent2id = id of match that loser moves to in double elim brackets
		child1 = if not first round, holds match id that first player came from
		child2 = if not first round, holds match id that second player came from
		player1 = id of player who came from child 1 (if not round 1).
		player2 = id of player who came from child 2 (if not round 1).
		tournamentid = id of tournament match belongs to
		round = round number match takes place in 						*/

	//function to create matches for single elim matches
	//assigns parents and children to matches if applicable

	function create_match($i, $j, $t_id, $parent1, $num_rounds){
		$db_connection = db_connect();
		if ($i > 0){
			if ($i < $num_rounds){
				$sql = "INSERT INTO matches (tournament_id, parent_1) VALUES ($t_id, $parent1)";
				$result = $db_connection->query($sql);
			}
			$i--;
			
			// Insert code to find the last id 
			$lastid = $db_connection->insert_id;
			if ($j%2 == 0){
				if ($lastid == 0){
					$sql = "UPDATE matches SET round_num = $num_rounds-$i, child_1 = NULL WHERE id = $parent1";
				} else {
					$sql = "UPDATE matches SET round_num = $num_rounds-$i, child_1 = $lastid WHERE id = $parent1";
				}
				$result = $db_connection->query($sql);
			} else if ($j%2 == 1){
				if ($lastid == 0){
					$sql = "UPDATE matches SET round_num = $num_rounds-$i, child_2 = NULL WHERE id = $parent1";
				} else {
					$sql = "UPDATE matches SET round_num = $num_rounds-$i, child_2 = $lastid WHERE id = $parent1";
				}
				$result = $db_connection->query($sql);
			}
		} else {
			$sql = "INSERT INTO matches (tournament_id) VALUE ('".$t_id."')";			
			$result = $db_connection->query($sql);
			echo mysqli_error($db_connection);			
			$lastid = $db_connection->insert_id;		
		}
		return $lastid;
	}

	//assign players to each first round matches
	//some to second round if byes are applicable
	function populate_bracket($player_ids){
		
		global $N;
		global $t_id;
		global $num_checkins;
		require_once("classes/connections.php");
		$db_connection = db_connect();
		$sql = "SELECT id FROM matches WHERE round_num = 1 AND tournament_id = $t_id";
		$result = $db_connection->query($sql);
		mysqli_error();
		$num_matches = 0;		
		while ($row = $result->fetch_assoc()){
			$matchids[] = $row['id'];
			$num_matches++;
			
		}
		for ($i=0;$i<$num_matches;$i++){
			$pid = $player_ids[$i];
		
			$match_id = $matchids[$i];
		
			$sql = "UPDATE matches SET player_1_id = $pid WHERE id = $match_id;";
			
			$name_query_1 = $db_connection->query($sql);
			mysqli_error();
		}
		$i=0;
		for ($j=$num_matches;$j<$num_checkins;$j++){
			if($N){
				if ($j%$N == 0){
					$i++;
				}
			}
			$pid = $player_ids[$j];
			$match_id = $matchids[$i];
			$i++;
			$sql = "UPDATE matches SET player_2_id = $pid WHERE id = $match_id";
			$name_query_1 = $db_connection->query($sql);
		}
		
	}	


	function create_league_match($round_number,$p1,$p2){
		require_once("classes/connections.php");
		$db_connection = db_connect();
		global $t_id;
		$sql = "INSERT INTO matches (tournament_id,player_1_id,player_2_id,round_num) VALUES ($t_id,$p1,$p2,$round_number)";
		$db_connection->query($sql);
		$db_connection->close();
	}
	//NB: Can't distinguish between p1child and p2 child based on % due to lack of array
	//USE CHILD1 & CHILD2 of parent match to distinguish
	function account_for_byes(){
		
		require_once("classes/connections.php");
		$db_connection = db_connect();
		global $t_id;

		$sql = "SELECT * FROM matches WHERE round_num = 1 AND tournament_id = $t_id";
		$result  = $db_connection->query($sql);
		
		while ($match = $result->fetch_assoc()){
			if (($p2id = $match['player_2_id']) == NULL){
				$p1id = $match['player_1_id'];
				
				$parentid = $match['parent_1'];
				
				$sql1 = "SELECT * FROM matches WHERE id = $parentid";
				
				$result2 = $db_connection->query($sql1);
			
				$child_match = $result2->fetch_assoc();
				$match_id = $match['id'];
				if ($match['id'] == $child_match['child_1']){
					$sql2 = "UPDATE matches SET player_1_id = $p1id WHERE id = $parentid";
					$sql3 = "UPDATE matches SET player_1_result = 1, player_1_wins =1 WHERE id = $match_id";
				} else if ($match['id'] == $child_match['child_2']){
					$sql2 = "UPDATE matches SET player_2_id = $p1id WHERE id = $parentid";
					$sql3 = "UPDATE matches SET player_1_result = 1,player_1_wins = 1 WHERE id = $match_id";
				}
				$update = $db_connection->query($sql2);
				$db_connection->query($sql3);
			}
		}
	}
?>






















