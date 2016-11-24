<?php
	$game_number =  $score_p1 + $score_p2 +1;
					$matchid = $match['id'];
					
					$sql = "SELECT * FROM hearthstone WHERE match_id = ".$matchid;
					$result2= $db_connection->query($sql);
					$hearth = $result2 -> fetch_assoc();
					
					$numClasses = $hearth['num_classes'];
					$numBans = $hearth['num_bans'];
					
					$pickState = 0;
					$banState = 0;
					
					include 'match_scripts.php';
					//determine pickState 
					if ($hearth['classes_picked'.$self]){
						if ($hearth['classes_picked'.$opponent]){
							$pickState = 4;
							echo "<script>CLASS_STATE = ".$pickState.";</script>";
							if ($numBans == 0){
								echo "<script>getTheClassStuff(".$pickState.", ".$self.");</script>";
							} else {
								//determine banState
								if ($hearth['classes_banned'.$self]){			
									if($hearth['classes_banned'.$opponent]){
										$banState = 4;
										echo "<script>
												BANS_STATE = ".$banState.";
												getTheClassStuff(".$pickState.", ".$self.");
											</script>";
										//apply bans
									} else {
										$banState = 2;
										echo "<script>
												BANS_STATE = ".$banState.";
												getTheClassStuff(".$pickState.", ".$self.");
											</script>";
										$choicesStringLeft = "Opponent has not locked in bans";
										//apply just your bans to opp images
										echo "
										
											<script>										
												intervalBanChecking();
											</script>
										";	
									}
								} else {
									if($hearth['classes_banned'.$opponent]){
										$banState = 3;
										echo "<script>
												BANS_STATE = ".$banState.";
												getTheClassStuff(".$pickState.", ".$self.");
											</script>";
										$choicesStringLeft = "Opponent has locked in bans";
										echo "
											<script>									
												//makeClassesClickable();
											</script>
										";
										//indicate opp has banned
									} else {
										$banState = 1;
										echo "<script>
												BANS_STATE = ".$banState.";
												getTheClassStuff(".$pickState.", ".$self.");
											</script>";
										$choicesStringLeft = "Opponent has not locked in bans";
										echo "
											<script>
												//makeClassesClickable();
												intervalBanChecking();
											</script>
										";
									}
								}			
							}//end ban checking
						} else {
							$pickState = 2;
							echo "<script>CLASS_STATE = ".$pickState.";</script>";
							$choicesStringRight = "Opponent has not locked in";
							echo "<script>intervalChecking();</script>";
						}
					} else {
						if ($hearth['classes_picked'.$opponent]){
							$choicesStringRight = "Opponent has locked in";
							$pickState = 3;
							echo "<script>CLASS_STATE = ".$pickState.";</script>";
						} else {
							$pickState = 1;
							echo "<script>CLASS_STATE = ".$pickState.";</script>";
							$choicesStringRight = "Opponent has not locked in";
							echo "<script>intervalChecking();</script>";
						}
					}
					include 'match_reporting.php';
?>
