<?php
	
	require_once '/../classes/connections.php';
	session_start();
	$db_connection = db_connect();
	$p_id = $_GET['id'];
	$myid = $_SESSION['user_id'];
	$sql = "SELECT * FROM player WHERE id = '".$p_id."'";
	$result = $db_connection->query($sql);
	
	$player_info = $result->fetch_assoc();
	$p_username = $player_info['player_username'];	
	$timestamp = $player_info['timestamp'];
	$isMe = ($_SESSION['user_id']==$_GET['id']);	
	$sql = "SELECT player_bio FROM player WHERE id=".$p_id;
	$res = $db_connection->query($sql);
	$row = $res->fetch_assoc();
	$bio = $row['player_bio'];
	if($isMe && isset($_POST["submit"])){
		$bio = $_POST['bio'];
		$stmt = $db_connection->prepare("UPDATE player SET player_bio =? WHERE id=".$p_id);
		$stmt->bind_param("s",$bio);
		$stmt->execute();
	}
?><script>
function copy(){
	document.getElementById("bio").value =  
        document.getElementById("edit").innerHTML;
	return true;
}

</script>


<row centered>
	<!-- first column -->
	<!-- recently followed -->
	<column cols="3">
		<blocks cols="1">
			<!-- title -->
			<row centered>
				<column cols="12">
					<h1 class="title align-centered">Recently followed</h1>
				</column><!-- ./title end -->
			</row>
			<!-- user start -->
			<?php
				$sql = "SELECT followers.followee, player.player_username FROM followers
				 JOIN player ON player.id=followers.followee
				WHERE followers.follower=".$p_id." ORDER BY followers.follow_time DESC LIMIT 3";
				$res = $db_connection->query($sql);
				$count = 0;
				while($row=$res->fetch_assoc()){
					$sql = "SELECT * FROM followers WHERE follower=".$myid." AND followee=".$row['followee'];
					$result = $db_connection->query($sql);
					$iFollow = 0;
					if($result->num_rows>=1){
						$iFollow=1;
					}
					$thisIsMe = $_SESSION['user_id']==$row['followee'];
					echo "
					<row class='align-centered'>
					<column cols='6'>
					<h4><a href='profile.php?id=".$row['followee']."'>".$row['player_username']."</a></h4>
					</column>
					<column cols='6'>
					";
					if(!$thisIsMe){
						if(!$isMe && !$iFollow){
							echo"
							<button id='".$count."' class='follow' onClick='follow(".$row['followee'].",".$count.")'><span>Follow</span></button>
							";
						}
						else echo "<button id='".$count."' class='following' onClick='follow(".$row['followee'].",".$count.")'><span>Following</span></button>";
					}
					
					
					echo "
					</column>
					</row>";
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
			<h1 class="title">About <?php echo $p_username; ?>
			</h1>
			<p>Member Since: <?=$timestamp?></p>
			</column>
			<column cols="6" class="align-right">
				<p>
					<? if($isMe){
						//echo "<button onClick='myFunction();'>Edit This</button>";
					}
					?>
				</p>
			</column>
		</row><!-- ./ title end -->
		<!-- profile description -->
		<div>
			
			<? 
			//not editable
			if(!$isMe){
				echo "<p>".$bio."</p>";
			}
			//editable
			else {
				echo "
				<form onsubmit='copy()' method='post'>
				<p contenteditable='true' id='edit' class='edit'>
				".$bio."
				</p>
				<input type='hidden' name='bio' id='bio'>
				<button id='submit' name='submit' >Update</button>
				</form>
				";
			}
			?>
			
		</div><!-- ./ content end -->
	</column><!-- ./second column end -->
</row><!-- ./row end-->