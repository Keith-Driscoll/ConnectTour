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
?>
<!-- Insert Some JS/ajax to call follow function, and change state if buttons to match following status -->
<!-- FIGURE SHIT OUT PLS
	I want the follow.php script to run when big follow button, and smaller recently followed buttons are pressed
	both times with the id of the person to be followed in the url. (id will be echoed into class of div or something)
	Then div needs to update to show that the user is now following/unfollowing that person.__CLASS__
	
	Speaking of unfollowing, i'll need hover effects for the follow buttons (both big and small) that say unfollow depending on
	whether or not the user follows them.__CLASS__
	
	All that's left then is to do the recently followed tabs and the following system is done. (except for feed etc.)

 -->
 <style>
	.following:hover span {display:none}
	.following:hover:before {content:"Unfollow"}
	.edit:hover{
		 background-color: lightgray;
	}
	
</style>
<script>	
$(document).ready(function(){
	//alert ('in function');
    $('#followBtn').click( function(){
		alert ('in function');
        var followeeID = $('#followBtn').attr('class');
		alert ('in function');
		$.ajax({
			type: "GET",
			url: "profile/follow.php",
			data: {followeeID: followeeID}
  		}).done(function (data){
		});
    });
});

function follow(id,button_id){
			//id: id of person to apply action on, e.g. p1_id adds id as friend
			//codes: 1 -remove friend 2-accept request 3- reject request 4-add friend 5-follow 6-unfollow
			var p1_id = <?= $myid ?>;
			var p2_id = id;
			var action_code = 6;
			if(document.getElementById(''+button_id+'').className == "follow"){
				action_code=5;
			}
			var button_id = button_id
				$.ajax({
				type: "GET",
				url: "addfriend.php",
				data: {p1_id:p1_id, p2_id:p2_id, action_code:action_code}
  			}).done( function() {
				if(action_code==5){
					document.getElementById(''+button_id+'').className="";
					document.getElementById(''+button_id+'').className="following";
					document.getElementById(''+button_id+'').innerHTML="<span>Following</span>";
				}
				else{
					document.getElementById(''+button_id+'').className="";									
					document.getElementById(''+button_id+'').className="follow";
					document.getElementById(''+button_id+'').innerHTML="<span>Follow</span>";
				}
				
			
			});
}

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