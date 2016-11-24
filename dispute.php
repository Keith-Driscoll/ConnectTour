<?php
	//ADMIN ONLY
	require_once 'classes/connections.php';
	require_once 'segments/header.php';
	require_once 'segments/navigation.php';
	require_once 'getImage.php';
	session_start();
	$db_connection = db_connect();
	$p_id = $_SESSION['user_id'];
	if ($p_id!=9){
		header("Location: nopermission.php");
		exit;
	}
	$d_id = $_GET['id'];
	$sql = "SELECT * FROM disputes WHERE id=$d_id";
	$res = $db_connection->query($sql);
	$row = $res->fetch_assoc();
	$match = $row['match_id'];
	$game = $row['game_number'];
	$sql = "SELECT player_1_id, player_2_id FROM matches WHERE id=$match";
	$res = $db_connection->query($sql);
	$row = $res->fetch_assoc();
	$player1=$row['player_1_id'];
	$player2=$row['player_2_id'];
	$screenshot1 = $match."_".$game."_".intval($player1);
	$screenshot2 = $match."_".$game."_".intval($player2);
	if(isset($_POST['submitwinner'])){
		$winner = intval($_POST['winner']);
		if($winner==1){
			$p1result=1; $p2result=0;
		}
		else{
			$p1result=0; $p2result=1;
		}
		$sql = "UPDATE hearthstone_games SET winner=$winner, player_1_result=$p1result, player_2_result=$p2result  WHERE match_id=$match AND game_number =$game";
		$db_connection->query($sql);
		if(!$p1_class_conflict && !$p2_class_conflict){
			$sql = "UPDATE disputes SET status=1 WHERE id=$d_id";
			$db_connection->query($sql);
		}
			
	}
	if(isset($_POST['submitclass1'])){
		$action = $_POST['action'];
		$chosenclass=intval($_POST['classnumber']);
		if($action==='replay'){
			$sql = "DELETE FROM hearthstone_games WHERE match_id=$match AND game_number=$game";
			$db_connection->query($sql);
		}
		if($action=='setclasses'){
			$sql = "UPDATE hearthstone_games SET player_1_class1=$chosenclass,  player_1_class2=$chosenclass  WHERE match_id=$match AND game_number =$game";
			$db_connection->query($sql);
		}
		
		if(!$result_conflict && !$p2_class_conflict){
			$sql = "UPDATE disputes SET status=1 WHERE id=$d_id";
			$db_connection->query($sql);
		}
	}
	
	if(isset($_POST['submitclass2'])){
		$action = $_POST['action'];
		$chosenclass=intval($_POST['classnumber']);
		if($action==='replay'){
			$sql = "DELETE FROM hearthstone_games WHERE match_id=$match AND game_number=$game";
			$db_connection->query($sql);
		}
		if($action=='setclasses'){
			$sql = "UPDATE hearthstone_games SET player_2_class2=$chosenclass, player_2_class1=$chosenclass  WHERE match_id=$match AND game_number =$game";
			$db_connection->query($sql);
		}
		
		if(!$result_conflict && !$p1_class_conflict){
			$sql = "UPDATE disputes SET status=1 WHERE id=$d_id";
			$db_connection->query($sql);
		}
	}
	//need some form of checking for game type in future
	$sql = "SELECT * FROM hearthstone_games WHERE match_id=$match AND game_number=$game";
	$res = $db_connection->query($sql);
	$row = $res->fetch_assoc();
	//determine conflict type
	$result_conflict = $row['player_1_result']==$row['player_2_result'];
	$p1_class_conflict = $row['player_1_class1']!=$row['player_1_class2'];
	$p2_class_conflict = $row['player_2_class1']!=$row['player_2_class2'];
	
	echo"<div class='disputecontainer'>";
	if($result_conflict){
			echo"
			<p>Match ID:".$row['match_id']."</p>
			<p>Game Number:$game</p>
			<p>Player 1 result: ".$row['player_1_result']."</p>
			<p>Player 2 result: ".$row['player_2_result']."</p>
			<p>Conflict</p>";
	}
	else echo "<p>No match conflicts</p>";
	
	
	if($p1_class_conflict){
		echo "<p>Player 1 says they used: ".conv($row['player_1_class1'])."</p>
		    	<p>Player 2 says player 1 used: ".conv($row['player_1_class2'])."</p>
				<p>Conflict</p>";
	}
	else echo "<p>No P1 class conflicts</p>";
	
	
	if($p2_class_conflict){
		echo "<p>Player 2 says they used: ".conv($row['player_2_class2'])."</p>
			<p>Player 1 says player 2 used: ".conv($row['player_2_class1'])."</p>
			<p>Conflict</p>";
	}
	else echo "<p>No P2 class conflicts</p>";
	
	if($result_conflict){
	?>

	<form method='post'>
		
		<p>Winner: </p>
		<select name='winner'>
			<option value='1'>1</option>
			<option value='2'>2</option>
		</select>
		<input type='submit' value='Resolve' name='submitwinner'/>
	</form>

	<?}
	  if($p1_class_conflict){
	?>
		<form method='post'>
		
			<p>Action</p>
			<select name='action' id='action1'>
				<option value='replay'>Replay</option>
				<option value='setclasses'>Set Classes</option>
			</select>
			<select name='classnumber' id='classnumber1'>
				<option value='1'>Warrior</option>
				<option value='2'>Shaman</option>
				<option value='3'>Rogue</option>
				<option value='4'>Paladin</option>
				<option value='5'>Hunter</option>
				<option value='6'>Druid</option>
				<option value='7'>Warlock</option>
				<option value='8'>Mage</option>
				<option value='9'>Priest</option>
			</select>
			<input type='submit' value='Resolve' name='submitclass1'/>
		</form>
	<?}if($p2_class_conflict){?>
		<form method='post'>
		
			<p>Action</p>
			<select name='action' id='action2'>
				<option value='replay'>Replay</option>
				<option value='setclasses'>Set Classes</option>
			</select>
			<select name='classnumber' id='classnumber2'>
				<option value='1'>Warrior</option>
				<option value='2'>Shaman</option>
				<option value='3'>Rogue</option>
				<option value='4'>Paladin</option>
				<option value='5'>Hunter</option>
				<option value='6'>Druid</option>
				<option value='7'>Warlock</option>
				<option value='8'>Mage</option>
				<option value='9'>Priest</option>
			</select>
			<input type='submit' value='Resolve' name='submitclass2'/>
		</form>
	<?}
	?>
	</div>
	<?php 
		$path = "match_screenshots";
		$pic1 = getImage($screenshot1,$path);
		$pic2 = getImage($screenshot2,$path);
		if($pic1!="images/logo_vector.png"){
	?> 
	<p>Player 1 screenshot</p>
	<img src='<?php echo $pic1;?>'/>
	<?}
		if($pic2!="images/logo_vector.png"){
	?>
	<p>Player 2 screenshot</p>
	<img src='<?php echo $pic2;?>'/>
	<?}?>
<script src='js/jquery.min.js'></script>
<script>
	$(function() {
    	$('#classnumber1').hide();
		$('#classnumber2').hide();
	});
	$('#action1').on('change',function(){
     var selection = $(this).val();
	 switch(selection){
		 case "replay":
		 	$('#classnumber1').hide();
			break;
		case "setclasses":
			$('#classnumber1').show();
			break;
		default:
			break;
	 }
	});
	
	$('#action2').on('change',function(){
     var selection = $(this).val();
	 switch(selection){
		 case "replay":
		 	$('#classnumber2').hide();
			break;
		case "setclasses":
			$('#classnumber2').show();
			break;
		default:
			break;
	 }
	});
</script>
<style>
	.disputecontainer{
		padding: 100px;
	}
</style>



<?php
	function conv($num)
	{	
	$str = "";		
		switch($num){				
			case 1 : $str .= "Warrior";
			break;
			case 2 : $str .= "Shaman";
			break;
			case 3 : $str .= "Rogue";
			break;
			case 4 : $str .= "Paladin";
			break;
			case 5 : $str .= "Hunter";
			break;
			case 6 : $str .= "Druid";
			break;
			case 7 : $str .= "Warlock";
			break;
			case 8 : $str .= "Mage";
			break;
			case 9 : $str .= "Priest";
			break;
		}	
	return $str;
	}
	require_once 'segments/footer.php';
?>