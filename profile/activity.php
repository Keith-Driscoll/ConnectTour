<?php
	require_once '/../classes/connections.php';
	$db_connection = db_connect();
	$p_id = $_GET['id'];
	
	$sql = "SELECT * FROM player WHERE id = '".$p_id."'";
	$result = $db_connection->query($sql);
	
	if ($result){
		$player_info = $result->fetch_assoc();
		$p_username = $player_info['player_username'];		
	} 
	$isMe = $p_id == $_SESSION['user_id'];
?>

<row centered>
	<!-- column -->
	<column cols="9">
		<!-- title -->
		<row>
			<column cols="6">
			<h2 class="title"><?php echo $p_username; ?>'s Activity
			</h2>
			</column>
			<column cols="6" class="align-right">
				<? if($isMe){
				echo "<p>
					<button disabled>Edit This</button>
					</p>";
				}
				?>	
				
			</column>
		</row><!-- ./ title end -->
		<!-- profile description -->
		<div>
			<p>
				Feature coming soon
			</p>
		</div><!-- ./ content end -->
	</column><!-- ./second column end -->
</row><!-- ./row end-->