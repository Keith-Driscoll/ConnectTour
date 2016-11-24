<?php
	
	require_once '/../classes/connections.php';
	session_start();
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
<row>
	<!-- column -->
	<column cols="12">
		<!-- title -->
		<row>
			<column cols="6">
			<h1 class="title">Games <?php echo $p_username; ?> plays
			</h1>
			</column>
			<column cols="6" class="align-left">
			<?if($isMe){?>
				<button id='addAccount' style="float:right" type='button'>Add Game Account</button>
			<?}?>	
			</column>
		</row> <!-- ./title end-->
			<?if($isMe){?>
		<row centered>
			<column cols="12">
				<form id='accountForm' onsubmit='return submitAccount()' method='post' class='align-centered'>
				<p>Account Name</p>
				<input type='text' name='gameaccount'>
				<p>Game</p>
				<select name='game'>
					<option value='Hearthstone'>Hearthstone</option>
					<!--
					<option value='League of Legends'>League of Legends</option>
					<option value='Dota II'>Dota II</option>
					<option value='Starcraft II'>Starcraft II</option>
					-->
				</select>
				<br><br>
				<p>Region</p>
				 <select name='server'>
	                           	<option>EUW</option>
	                            <option>NA</option>
	                            <option>EUNE</option>
                </select>
				<br><br>
				<button type='submit' name='submit'>Add</button>
				</form>
			</column>
		</row>
		<?}?>
		<?
			$sql = "SELECT * FROM gameaccounts WHERE player_id=$p_id";
			$res=$db_connection->query($sql);
			while($row=$res->fetch_assoc()){
				
				if($isMe){					
					$game = str_replace('_',' ',$row['gameaccount_game']);
					$imgStr = str_replace(' ','_',$row['gameaccount_game']);
					echo"
					<div id='$game'>
						<row>
							<img height='32' width='32' src='../images/old/icons/png/".$imgStr."mini.png'/>
							<div style='font-size:18px;margin-top: 4px; margin-left: 4px;'>$game</div>
						</row>
						<input class='$game' style='height:40px'; type='text' value='".$row['gameaccount_name']."'></input>
						<button  class='edit ".$game."'>Update</button>
						<button  class='delete ".$game."'>Delete</button>
					</div>
					<br>";
				}
				else{
					$game = str_replace('_',' ',$row['gameaccount_game']);
					$imgStr = str_replace(' ','_',$row['gameaccount_game']);
					echo "<row>
							<img height='32' width='32' src='../images/old/icons/png/".$imgStr."mini.png'/>
							<div style='font-size:18px;margin-top: 4px; margin-left: 4px;'>$game</div>
						  </row>
						  <row>
						  		<column cols='2'>".$row['gameaccount_name']."</column>
								<column cols='2'>".$row['gameaccount_server']."</column>
						  </row>
					";
				}
			}
		
			
			
		?>
		
		
	</column><!-- ./second column end -->
</row><!-- ./row end-->

<script>
$(document).ready(function(){
	//alert ('in function');
	$('#accountForm').hide();
	
});

$('#addAccount').click(function(){
	$('#accountForm').toggle(300);
});

$('.edit').click(function(){
	var classname= $(this).attr('class');
	var split = classname.split(" ");
	var game = split[1];
	var name = $('.'+game).val();
	$.ajax({
		type: "GET",
		url: "editContacts.php",
		data: {edit:1,game:game,name:name}
	}).done(function(){
		
	});

});

$('.delete').click(function(){
	var classname= $(this).attr('class');
	var split = classname.split(" ");
	var game = split[1];
	
	
	$.ajax({
		type: "GET",
		url: "editContacts.php",
		data: {delete:1,game:game}
	}).done(function(){
		$('#'+game+'').hide();
		$('.'+game+'').hide();
	});
});

function submitAccount(){
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