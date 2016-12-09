<!-- this page is used in tourpages. -->

<?php
	if ($checkin['tour_checkin_phase'] == 2){
		// This searches for all of the matches in the tour and orders them first by their round number and then by their id number.
		$sql = "SELECT * FROM matches WHERE tour_id = $t_id ORDER BY round_num ASC, id DESC";
		$result = $db_connection->query($sql);

		if ($result && $result->num_rows > 0){
			// This searches for the highest round number and sets that as the total number of rounds.
			$sql = "SELECT MAX(round_num) as round_ceiling FROM matches WHERE tour_id = $t_id";
			$total_rounds = $db_connection->query($sql);
			$x = $total_rounds->fetch_assoc();

			$current_round = 1;
			$spacing = 1;
			$match = $result->fetch_assoc();
		
			echo "<table>";

			// This while loop prints out the brackets and the player names in the brackets.
			while ($current_round <= $x['round_ceiling']){
				$p1id = $match['player_1_id'];
				//query returns the name of player_1 of next match
				$sql = "SELECT player_username FROM player WHERE id = '".$p1id."'";
				$users = $db_connection->query($sql);
				$name = $users->fetch_assoc();
				echo "<td class='col_1' id = 'col_".$current_round."'>
					<table class='bracket'>
						<tr>
							<td class='col1'>
								A
							</td>
							<td>
								<table class='group'>
									<tr>
										<td class='winner'>
											<p>".$name['player_username']."
												<span class='label label-light right'>".$match['round_num']."</span>
											</p>
										</td>
									</tr>
								";
								$p2id = $match['player_2_id'];
								//query returns name of player_2 of next match
								$sql = "SELECT player_username FROM player WHERE id = '".$p2id."'";
								$users = $db_connection->query($sql);
								$name = $users->fetch_assoc();
								echo "
									<tr>
										<td class='loser'>
											<p>".$name['player_username']."
												<span class='label label-light right'>".$match['round_num']."</span>
											</p>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

				";
				$match = $result->fetch_assoc();

				// This nested while loop deals with spacing issues and printing out the names in the brackets ( same as the code above).
				while ($current_round == $match['round_num']){

					echo "
						<table class='bracket'>
					";
					if ($current_round%2 == 0 && $current_round != $total_rounds){
						for ($i=0;$i<$spacing;$i++){
							echo "
								<tr class='emptyContainer'>
									<td class='empty'>
									</td>
								</tr>
							";
						}
					} else if ($current_round%2 == 1 && $current_round != $x['round_ceiling']){
						for ($i=0;$i<$spacing;$i++){
							echo "
								<tr class='emptyContainer'>
									<td class='empty'>
									</td>
								</tr>
							";
						}
					}
					$p1id = $match['player_1_id'];
					$sql = "SELECT player_username FROM player WHERE id = '".$p1id."'";
					$users = $db_connection->query($sql);
					$name = $users->fetch_assoc();
					echo "
						<tr>
							<td class='col1'>A</td>
								<td>
									<table class='group'>
										<tr>
											<td class='winner'>
												<p>".$name['player_username']."
													<span class='label label-light right'>".$match['round_num']."</span>
												</p>
											</td>
										</tr>
										";
										$p1id = $match['player_2_id'];
										$sql = "SELECT player_username FROM player WHERE id = '".$p1id."'";
										$users = $db_connection->query($sql);
										$name = $users->fetch_assoc();
										echo "
										<tr>
											<td class='loser'>
												<p>".$name['player_username']."
													<span class='label label-light right'>".$match['round_num']."</span>
												</p>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					";
					$match = $result->fetch_assoc();
				}
				//moves on to next round (i.e, next column)
				echo "</td>";
				$current_round++;
				$spacing = $spacing*2+1;
			}
		}	
	} else {
		echo "Sorry, the bracket for this tour has not been generated yet. Please wait for the tour to start.";
	}
?>
	</tr>
</table>
<link href="../css/brackets.css" rel="stylesheet" type="text/css" />

 