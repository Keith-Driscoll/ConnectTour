<?php
	
 // included in tournament info file.   
	
	//query returns entry of logged in player from tournament_participants (if it exists)
	$sql = "SELECT * FROM tournament_participants WHERE Player_id = '".$p_id."' AND Tournaments_id = '".$t_id."'";
	$view = $db_connection->query($sql);
	
	if ($view->num_rows == 1){ 
	
		$banState = 0;
		$user_name = $_SESSION['user_name'];
		$p_id = $_SESSION['user_id'];
		$sql = "SELECT * FROM matches WHERE (player_1_id = ".$p_id." OR player_2_id = ".$p_id.") AND (tournament_id = ".$t_id.") ";
		$missingData = false;
		$result = $db_connection->query($sql);
		
		$sql = "SELECT gameaccount_name FROM gameaccounts WHERE gameaccount_game='$game' AND player_id=$p_id";
		$accountresult = $db_connection->query($sql);
		$my_account_assoc = $accountresult->fetch_assoc();
		if(empty($my_account_assoc)){
			$my_account_name="No linked account";
		}
		else $my_account_name = $my_account_assoc['gameaccount_name'];
		
		if ($result != NULL && ($result->num_rows > 0)){
			$match = $result -> fetch_assoc();	
			$matchid = $match['id'];	
			$self = 0;
			$opponent = 0;
			$pfin = 0; // Is the tournament over for this player
			//set self and opp to figure out who is who in the database
			if ($p_id == $match['player_1_id']){
				$self = 1;
				$opponent = 2; 
			} else {
				$self = 2;
				$opponent = 1;
			}	
			if (($match['player_1_result'] == 1) || ($match['player_2_result'] == 1)){
				$pfin =1;
				if($match['player_1_result'] == 1 && $self ==1 || $match['player_2_result'] == 1 && $self ==2 ){
					echo "<div class='youWon'>You won this tournament.</div>";
				}
				else{
					echo "<div class='knockedOut'>You have been knocked out.</div>";
				}
			} 
			else if($match["player_1_id"]==null||$match["player_2_id"]==null){
				echo "<div class='waiting'>Waiting on other results.</div>";
				$pfin =1;
			}else {				 
				if ($match["player_1_id"] == $p_id){
										
					$p2_id = $match["player_2_id"] ;
					$sql = "SELECT player_username FROM player WHERE id = '".$p2_id."'  "; 
					$result = $db_connection->query($sql);
					$opponent_username = $result -> fetch_assoc();
					$sql = "SELECT * FROM gameaccounts WHERE player_id=$p2_id AND gameaccount_game='$game'";
					$opponent_result = $db_connection->query($sql);
					$opponent_account_assoc = $opponent_result->fetch_assoc();
					if(empty($opponent_account_assoc)){
						$opponent_account="No linked account";
					}
					else {					
						$opponent_account=$opponent_account_assoc['gameaccount_name'];
					}
					$score_p1 = $match['player_1_wins'];
					$score_p2 = $match['player_2_wins'];
					$lockedin=$match['locked_in_p1'];
					$opponentlockedin=$match['locked_in_p2'];
					
				} else if ($match["player_2_id"] == $p_id) {
					$p1_id = $match["player_1_id"] ;
					$p2_id = $match["player_1_id"] ;
					$sql = "SELECT player_username FROM player WHERE id = '".$p1_id."'  "; 
					$result = $db_connection->query($sql);
					$opponent_username = $result -> fetch_assoc();
					$sql = "SELECT * FROM gameaccounts WHERE player_id=$p1_id AND gameaccount_game='$game'";
					$opponent_result = $db_connection->query($sql);
					$opponent_account_assoc = $opponent_result->fetch_assoc();
					if(empty($opponent_account_assoc)){
						$opponent_account="No linked account";
					}
					else {	
						$opponent_account=$opponent_account_assoc['gameaccount_name'];
					}
					$score_p1 = $match['player_2_wins'];
					$score_p2 = $match['player_1_wins'];
					$lockedin=$match['locked_in_p2'];
					$opponentlockedin=$match['locked_in_p1'];
				} else {
					echo "Error, the correct match wasn't found!" ;
				}
				if(!$pfin){
					  include 'games/'.strtolower($game).'/matchinfo.php';
					}
				} 
			}	
		}
									
		//if (tournament has started) {
		if ($view->num_rows == 1){   
			//checks is user logged in
			
				if ($login->isUserLoggedIn() == true) {
					if(!$pfin){
					//checks if query exists
						
						$row = $view->fetch_assoc();
						//checks is player logged in
						if ($row['checked_in'] == true){ 
							
							//if ($checkin['tournament_checkin_phase'] == 2){
								//prints out match display interface					
								if ($missingData == false){
									require_once 'getProfilePicture.php';
									$pic = getProfilePicture($p_id);
									$pic2 = getProfilePicture($p2_id);					
								?>
								
									<row centered>
										<column cols='7'>
											<h3>Your latest match</h3>
										</column>
										<column cols='5'>
											<h3>Match Lobby</h3>
										</column>
									</row>
									
									
									<row id='matchInfo'>
										<!-- left col -->
										
										<column cols='7'>
											<!-- left player -->
												<row end>
													<column cols='5' class='playerInfo'>
														<img src=<?=$pic?> class='img-responsive' alt='user-profile' />
														<p class=''><a href="profile.php?id=<?=$p_id?>"><?=$user_name?></a></p>
														<a href="profile.php?id=<?=$p_id?>"><p><?=$my_account_name?></p></a>
													</column><!-- ./left player end -->
													<!-- score display -->
													<column cols='2'>
														<div class='scoreDisplay'>
															<p>VS</p>
															<p><?=$score_p1?>:<?=$score_p2?></p>
														</div>
													</column><!-- ./score display end -->
													<!-- right player -->
													<column cols='5' class='playerInfo'>
														<img src=<?=$pic2?> class='img-responsive' alt='user-profile' />
														<p><a href="profile.php?id=<?=$p2_id?>"><?=$opponent_username['player_username']?></a></p>                
														<a href="profile.php?id=<?=$p2_id?>"><p><?=$opponent_account?></p></a>
													</column><!-- ./right player end -->
												</row><!-- ./left col end -->
												<?php 
													include 'games/'.strtolower($game).'/pickingsection.php';																								
												?>
											</column>
											<column cols='5'>
												<!-- right col -->
												<column cols='12'>
													
													<?php 
															$sql = "SELECT chat_id FROM chat_session WHERE class_id = ".$matchid." AND chat_class = 'match_lobby'";
															$result = $db_connection->query($sql);
															$row = $result->fetch_assoc();
															$chatID = $row['chat_id']; 
															include 'chatbox.php'?>
												</column>
												<!-- ./right col end -->
											</column>
											
										</column><!-- ./container end -->
									</row><!-- ./match info end -->	
									<row>
										<column cols= "7" class="prevGames" >									
											<?php include "games/".strtolower($game)."/games_played.php";?>
										</column>
									</row>
									
									<?php
									include 'games/'.strtolower($game).'/match_reporting.php';
								} else {
									//logged in, signed up and checked in, but bracket not generated
									echo "
										<div class='clearfix'></div>
										<br/>
										<row>
											<column cols='12'>
												<div class='alert alert-warning align-centered'>
													No matches played yet.
												</div>
											</column>
										</row>";
								}					
							//}
							//else {
								//logged in, signed up and checked in, but bracket not generated
								//echo "The tournament has not begun yet. Please wait for the checkin phase to finish";
							//}
						}
						else {
							//logged in and signed up BUT not checked in
							echo "
								<div class='clearfix'></div>
								<br/>
								<row>
									<column cols='12'>
										<div class='alert alert-warning align-centered'>
											You did not check into this tournament in time
										</div>
									</column>
								</row>";
						}
						
					}					
				}
				else {
				//if not logged in
				echo "
					<div class='clearfix'></div>
					<br/>
					<row>
						<column cols='12'>
							<div class='alert alert-warning align-centered'>
								You aren't logged in. Please <a href='login.php'><u>log in</u></a> to view your matches
							</div>
						</column>
					</row>";
				}  				
		}
		else{
			//if logged in BUT not signed up
			echo "
				<div class='clearfix'></div>
				<br/>
				<row>
					<column cols='12'>
						<div class='alert alert-warning align-centered'>
							You didn't sign up to this tournament
						</div>
					</column>
				</row>";
		}
	?>			