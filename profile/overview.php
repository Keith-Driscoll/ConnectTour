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
	
	<!-- second column -->
	<column cols="12">
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