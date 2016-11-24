<?php
	
	require_once '/../classes/connections.php';
	require_once '../getProfilePicture.php';
	session_start();
	$db_connection = db_connect();
	$p_id = $_GET['id'];
	
	$sql = "SELECT * FROM player WHERE id = '".$p_id."'";
	$result = $db_connection->query($sql);
	
	if ($result){
		$player_info = $result->fetch_assoc();
		$p_username = $player_info['player_username'];		
	}
	$isMe=$p_id == $_SESSION['user_id'];
	
?>
<style>
	.friends:hover span {display:none}
	.friends:hover:before {content:"Unfriend"}
	.requested:hover span {display:none}
	.requested:hover:before {content:"Cancel Request"}
	
</style>
<script>
	function addFriend(id,button_id){
			//id: id of person to apply action on, e.g. p1_id adds id as friend
			//codes: 1 -remove friend 2-accept request 3- reject request 4-add friend 5-follow 6-unfollow
			var p1_id = <?= $p_id ?>;
			var p2_id = id;
			var action_code = 1;
			var button_id = button_id;
			var classname = document.getElementById(''+button_id+'').className;
			switch(classname){
				case "addFriend":
					action_code=4;
					break;
				case "friends":
					action_code=1;
					break;
				case "requested":
					action_code=3;
					break;
				default:
					break;
			}
			alert(''+action_code+'');
				$.ajax({
				type: "GET",
				url: "addfriend.php",
				data: {p1_id:p1_id, p2_id:p2_id, action_code:action_code},
				success: function(){
					if(action_code==1){
						document.getElementById(''+button_id+'').className="";
						document.getElementById(''+button_id+'').className="addFriend";
						document.getElementById(''+button_id+'').innerHTML="<span>Add</span>";
					}
					else if(action_code==3){
						document.getElementById(''+button_id+'').className="";
						document.getElementById(''+button_id+'').className="addFriend";
						document.getElementById(''+button_id+'').innerHTML="<span>Add</span>"
					}
					else if(action_code==4){
						document.getElementById(''+button_id+'').className="";
						document.getElementById(''+button_id+'').className="requestSent";
						document.getElementById(''+button_id+'').innerHTML="<span>Request Sent</span>";
					}
				}
  			});
	}

</script>
<row>
	<!-- first column -->
	<!-- recently followed -->
	<column cols="3">
		<blocks cols="1">
			<!-- title -->
			<row centered>
				<column cols="12">
					<h1>Recently added</h1>
				</column><!-- ./title end -->
			</row>
			<!-- user start -->
			<?php
				$sql = "SELECT a.id as id1, b.id as id2, a.player_username as username1, b.player_username as username2 FROM friendships
				 JOIN player a 
				 JOIN player b
                 ON (a.id=friendships.p1id AND b.id=friendships.p2id)
				 WHERE (friendships.p1id=".$p_id." OR friendships.p2id=".$p_id.")  ORDER BY friendships.timestamp DESC LIMIT 5";
				$res = $db_connection->query($sql);
				$count = 0;
				while($row=$res->fetch_assoc()){
					
					if($p_id==$row['id1']){
						$id=$row['id2'];
						$username=$row['username2'];	
					}
					else {
						$id=$row['id1'];
						$username=$row['username1'];
					}
					$thisUserIsMe = $id == $_SESSION['user_id'];
					echo "
					<row class='align-centered'>
					<column cols='6'>
					<h4><a href='profile.php?id=".$id."'>".$username."</a></h4>
					</column>
					<column cols='6'>
					";
					if(!$thisUserIsMe){
						if(!$isMe){					
						$sql = "SELECT * FROM friendships WHERE (p1id=".$_SESSION['user_id']." OR p2id=".$_SESSION['user_id'].") 
						AND (p1id=".$id." OR p2id=".$id.")";
						$result = $db_connection->query($sql);
						$isFriends = $result->num_rows>0;
						if($isFriends){
							echo "<button class='friends' id='$count' onClick='addFriend(".$id.",$count)'><span>Friends</span></button>";
						}
						else{
							$sql = "SELECT * FROM friend_requests WHERE (p1id=".$_SESSION['user_id']." OR p2id=".$_SESSION['user_id'].") 
							AND (p1id=".$id." OR p2id=".$id.")";
							$result=$db_connection->query($sql);
							$requestSent = $result->num_rows>0;
							if($requestSent){
								echo "<button id='$count' class='requested' onClick='addFriend(".$id.",$count)'><span>Request Sent</span></button>";
							}
							else echo "<button id='$count' class='addFriend' onClick='addFriend(".$id.",$count)'><span>Add</span></button>";
							
						}
						
						}
						else echo "<button id='$count' class='friends' onClick='addFriend(".$id.",$count)'><span>Friends</span></button>";
					}
					
					
					echo "
					</column>
					</row>

					";
					$count++;
				}
			
			?>
			
		</blocks><!-- ./side bar end -->
	</column><!-- ./ first column end -->
	<!-- second column -->
	<column cols="9">
		<!-- title -->
		<row>
			<column cols="6">
			<h1 class="title"><?php echo $p_username; ?>'s Friends
			</h1>
			</column>
			<column cols="6" class="align-right">
			<!--
				<p>
					
					
						
				</p>
			-->
			</column>
		</row><!-- ./ title end -->
		<!-- profile description -->
		<blocks cols="6">
			<?php
				$sql="SELECT a.id as id1, b.id as id2, a.player_username as username1, b.player_username as username2 FROM friendships
				 JOIN player a 
				 JOIN player b
                 ON (a.id=friendships.p1id AND b.id=friendships.p2id)
				 WHERE (friendships.p1id=".$p_id." OR friendships.p2id=".$p_id.")";
				 $res=$db_connection->query($sql);
				 while($row=$res->fetch_assoc()){
					 if($p_id==$row['id1']){
						$id=$row['id2'];
						$username=$row['username2'];
					}
					else {
						$id=$row['id1'];
						$username=$row['username1'];
					}
					echo"
						<div>
							<a href='profile.php?id=".$id."'>
							<img src='".getProfilePicture($id)."' height='250' width='250'>
							<p class='align-centered'>".$username."</p>
							</a>
						</div>
					";
				}
				 
				 
			?>
			
			
		</blocks><!-- gallery end -->
	</column><!-- ./second column end -->
</row><!-- ./row end-->