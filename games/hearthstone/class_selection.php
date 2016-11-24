<?php
	$user_name = $_SESSION['user_name'];
    $p_id = $_SESSION['user_id'];      
		
    $sql = "SELECT * FROM matches WHERE (player_1_id = ".$p_id." OR player_2_id = ".$p_id.") AND (tournament_id = ".$t_id.") ";
	
	$result = $db_connection->query($sql);
	if ($result != NULL && ($result->num_rows > 0)){
		$match = $result -> fetch_assoc();	
		
		//Not currently getting correct match id I think
		$match_id = $match['id'];
			
	}
	$sql = "SELECT * FROM hearthstone WHERE match_id = ".$match_id;
	$result = $db_connection->query($sql);
	if ($result != NULL && ($result->num_rows > 0)){
		$hearthstuff = $result -> fetch_assoc();
	}
	else{
	}
	//echo $match["player_1_id"];
	
	/*     for showing up to match I thought    */
	
	$num_classes=$hearthstuff["num_classes"];
	if($match['player_1_id']==$p_id){
		$lockedin=$match['locked_in_p1'];
		$opponentlockedin=$match['locked_in_p2'];
	} else{
		$lockedin=$match['locked_in_p2'];
		$opponentlockedin=$match['locked_in_p1'];
	}
?>

<script>	
	var dataBaseValue = 0;
	
	function validateForm(){
		var form = document.getElementById("theForm");
		var count = 0;
		var tenCount = 1;	
		
		for (var i = 0; i < form.length; i++) {
			if (form[i].checked) {				
				count++;
				dataBaseValue += (i+1)*tenCount;
				tenCount *= 10;
			}
		}		
		if(count==<?=$num_classes?>){			
			document.getElementById("result").innerHTML = "Success";
			sendData();			
		}
		else{
			document.getElementById("result").innerHTML = "Pick "+<?=$num_classes?>+" classes only";
			dataBaseValue = 0;
			tenCount = 1;
		}			
	}		
	function sendData(){ //Sends players class choices to Database in the form of one number
			
			var player = <?=$self?>;
			var match_id = <?=$match_id?>;
			$.ajax({
				type: "GET",
				url: "sendClasses.php",
				data: {dataBaseValue:dataBaseValue,player:player,match_id:match_id}
  			}).done( function( data ) {		
				  console.log("submit : " + player);
				if(CLASS_STATE==1){
					getTheClassStuff(2, player);
				}
				else if(CLASS_STATE==3){
					console.log("HEREwith : " + player);
					makeClassesClickable();
					$("#bansSection"+<?=$self?>).html("<input onclick='submitBans()' class='btn bans-submit' type='button' value='Confirm Bans' />	<div id='bansResponder'></div>"); 
					getTheClassStuff(4, player);
				}	
				else{
					console.log("Error in sendData() CLASS_STATE is: " + CLASS_STATE);
				}
  			});
			dataBaseValue = 0;
			tenCount = 1;
	}		
</script>
<script src='js/jquery.min.js';></script>
<div>
	<p id="chooseHeading" style="color:black">Choose <?=$num_classes?> classes <br>	
	</p>
	
	<form id="theForm">
		<input type="checkbox" value="Warrior">Warrior
		<input type="checkbox" value="Shaman">Shaman
		<input type="checkbox" value="Rogue">Rogue<br>
		<input type="checkbox" value="Paladin">Paladin
		<input type="checkbox" value="Hunter">Hunter
		<input type="checkbox" value="Druid">Druid<br>
		<input type="checkbox" value="Warlock">Warlock
		<input type="checkbox" value="Mage">Mage
		<input type="checkbox" value="Priest">Priest<br>	
	</form>
	<button onclick="validateForm()">Submit</button>
	
	<p id="result" style="color:black"></p>
	
</div>
