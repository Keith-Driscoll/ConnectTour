<?php
	
	require_once '/../classes/connections.php';
	$db_connection = db_connect();
	session_start();
	$p_id = $_GET['id'];
	
	$sql = "SELECT * FROM player WHERE id = '".$p_id."'";
	$result = $db_connection->query($sql);
	
	if ($result){
		$player_info = $result->fetch_assoc();
		$p_username = $player_info['player_username'];		
	}
	$isMe = $p_id == $_SESSION['user_id'];
	//set placeholder for social media form
	if(!empty($player_info['twitter_username'])){
		$hasTwitter = true;
		$twitter = $player_info['twitter_username'];
	}
	else $twitter = "Twitter";
	
	if(!empty($player_info['instagram_username'])){
		$hasInstagram = true;
		$instagram = $player_info['instagram_username'];
	}
	else $instagram = "Instagram";
	
	if(!empty($player_info['snapchat_username'])){
		$hasSnapchat = true;
		$snapchat = $player_info['snapchat_username'];
	}
	else $snapchat = "Snapchat";
	
	
?>



<row>
	<!-- second column -->
	<column cols="9">
		<!-- title -->
		<row>
			<column cols="6">
			<h1 id='acc' class="title">Contact <?php echo $p_username; ?>
			</h1>
			</column>


		</row><!-- ./ title end -->
		<!-- profile description -->
		<?if($isMe){
			echo "
		 <div>
			<form action='' name='form' onsubmit='return validate()' method='post'>
				<p>Twitter</p>
				<input type='text' id='twitter' name='twitter' value='".$twitter."'>
				<p>Instagram</p>
				<input type='text' id='instagram' name='instagram' value='".$instagram."'>
				<p>Snapchat</p>
				<input type='text' id='snapchat' name='snapchat' value='".$snapchat."'>
				<br><br>
				
				<button type='submit' id='submit' name='submit'>Update</button>
				
			</form>
		</div>";
		}
		
		else{
			if(isset($hasTwitter)){
				echo"
				<a href='http://www.twitter.com/".$twitter."' class='fa fa-twitter'>Twitter: ".$twitter."</a><br>";
			}
			if(isset($hasInstagram)){
				echo"
				<a href='http://www.twitter.com/".$twitter."' class='fa fa-twitter'>Twitter: ".$twitter."</a><br>";
			}
			if(isset($hasSnapchat)){
				echo"	<a href='http://www.snapchat.com' class='fa fa-snapchat-ghost'>Snapchat: ".$snapchat."</a><br>";
			}
		}
		?>
		
		
		<!-- ./ content end -->
	</column><!-- ./second column end -->
</row><!-- ./row end-->

<script>	
$(document).ready(function(){
	//alert ('in function');
	$('#accountForm').hide();
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

$('#addAccount').click(function(){
	$('#accountForm').toggle();
});


function validate(){
	var id = <?=intval($p_id) ?>;
	$.ajax({
		type: "GET",
		url: "editContacts.php",
		data: $("form").serialize() + "&id=id"
	}).done(function(){
		window.location.reload();
	});
}
</script>