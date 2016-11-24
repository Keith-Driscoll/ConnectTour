<?php 
	$game_number = $score_p1 + $score_p2 +1;
	$sql = "SELECT * FROM general_games WHERE match_id = $matchid AND game_number = $game_number"; 
	$result = $db_connection->query($sql);
    $general_game = $result->fetch_assoc();
	
	
	$dispute  = 0;
	if($general_game){
		
		if($general_game['player_1_result']==$general_game['player_2_result']){
			$dispute = 1;
		}
		
	}
	
?>

<link href="../css/generalCase.css" rel="stylesheet"/>
<div id="abc">
	<!-- Popup Div Starts Here -->
	<div id="close" class="icon_close closeButton" onclick ="div_hide()"></div>
	<div id="popupContact">
		<!-- Contact Us Form -->	
			<row centered>			
					<h3 class="lobbyHeading">Match Lobby</h3>				
			</row>				
				
			<row centered>
				<div id="game_number_display">
					Game Number <?php echo $score_p1 + $score_p2 +1;?>
				</div>
			</row>
			<?php if(!$general_game||!$general_game['player_'.$self.'_result']||$dispute){ ?>
			<row centered>
				<column cols="3">
					<div id="playerA" class="highlight_box name_loser">
						<div id="pop_up_name"><?php echo $user_name;?></div>
					</div>
				</column>
				<column cols="1">
						<div style="color:white;margin-top: 10px;font-size:20px;">vs</div>
				</column>
				<column cols="3">
					<div id="playerB" class="highlight_box name_winner">
						<div id="pop_up_name"><?php echo $opponent_username['player_username'];?></div>
					</div>
				</column>
			</row>
			
			<row centered>
				<div class="loss show">I won</div>					
				<div class="toggle-button" data-win = "false">
					<button type="button" id="toggs" name="resultButton"></button>
				</div>
				<div class="won">I lost</div>
			</row>
				
			<row centered>			
				<!-- Confirm section -->
				<?phpif(!$dispute){?>
					<a onclick="checkDispute()" id="submit">Submit </a>	
				<?php }
				else{?>
					<a onclick="checkDispute()" id="resubmit">Resubmit </a>		
				<?php } ?>
				<div id="leftOfConfirm">Are you sure?</div>
				<a onclick="submitResults()" id="subConfirm" class="popUpButtons">Confirm</a>
				<a onclick="unsplit()" id="subCancel" class="popUpButtons">Cancel</a>	
			</row>			
				
			<?php }
			else{
				echo "<div class='waitingNote'>Waiting for opponent to report</div>";
			 } ?> 		
			
	</div>
	<!-- Popup Div Ends Here -->
</div>


<script>	
		
	$(document).on('click', '.toggle-button', function() {
    	$(this).toggleClass('toggle-button-selected');
		if($(this).attr("data-win")=="true"){
			$(this).attr("data-win","false");
		}
		else{
			$(this).attr("data-win","true");
		}
		$("#playerA").toggleClass("name_winner");
		$("#playerB").toggleClass("name_winner");
		$("#playerA").toggleClass("name_loser");
		$("#playerB").toggleClass("name_loser");
	});
	
	$(document).mouseup(function (e)
	{
		var container = $("#abc");

		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.hide();
		}
	});
	
	function split(){
			$("#submit").hide();
			$("#leftOfConfirm").show();
			$("#subConfirm").show();
			$("#subCancel").show();			
	}
	function unsplit(){
		$("#leftOfConfirm").hide();
		$("#subConfirm").hide();
		$("#subCancel").hide();
		$("#submit").show();
	}
	
	function showDispute(){
			$("#leftOfConfirm").hide();
			$("#subConfirm").hide();
			$("#subCancel").hide();
			$("#leftOfDispute").show();
			$("#subResubmit").show();
			$("#subDispute").show();
	}
	
	function div_show() {
		document.getElementById('abc').style.display = "block";
	}
	//Function to Hide Popup
	function div_hide(){
		document.getElementById('abc').style.display = "none";
	}
	
	function checkDispute(){
		var win = 0;
		if($(".toggle-button").attr("data-win")=="true"){
			win = 1;
		}							
			
		var match_id = <?=$matchid?>;				
		var self = <?=$self?>;				
		
		$.ajax({
			url: 'games/general/checkForDispute.php',
			type: 'GET',
			data: {win:win,game_number:game_number,match_id:match_id,self:self}				
		}).done( function( data ){
			var str = data.trim();
			console.log("Check dispute:" + str);
			if(str!=""){
				split();
				$("#leftOfConfirm").html("This will cause a dispute");	
			}	
			else{
				split();
				$("#leftOfConfirm").html("Are you sure?");
				console.log("No dispute");
			}	
		});		
	}
	
	var game_number = <?php echo $score_p1 + $score_p2 +1;?>;
	function submitResults(){
			console.log("submit");
			var win = 0;
			if($(".toggle-button").attr("data-win")=="true"){
				win = 1;
			}					
			
			var match_id = <?=$matchid?>;				
			var self = <?=$self?>;				
			
			$.ajax({
				url: 'games/general/setMatchResults.php',
				type: 'GET',
				data: {win:win,game_number:game_number,match_id:match_id,self:self}				
			}).done( function( data ){
				var str = data.trim();
				console.log("Wut:" + str);
				if(str==""){
					window.location.reload();					
				}else{
				}
				
			});		
	}
		
</script>