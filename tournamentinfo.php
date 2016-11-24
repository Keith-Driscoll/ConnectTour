<?php 

    /* list of files included in this page
        bracketgeneration.php
    */
	
	//require_once("classes/doLoginCheck.php");
	
    require_once 'segments/header.php';
    require_once 'classes/connections.php';
    require_once 'bracketgeneration.php';
    $db_connection = db_connect();
	include 'classes/Login.php';
	$login = new Login();
	session_start();
    //holds the id of the tournament, pulled from url
    $t_id = intval($_GET['id']);
    //holds user_id stored in session if the player is logged in
    $p_id = intval($_SESSION['user_id']);
    //query retrieves all data relating to the tournament $t_id
    $sql = "SELECT * FROM tournaments WHERE id = '".$t_id."'";
    $result = $db_connection->query($sql);
    $row = $result->fetch_assoc();
	$game = $row['tournament_game'];
	
	if($game!="Hearthstone"){ //TODO Should be replaced with a list of supported games
		$game = "general";
	}
	
	//$checkin =$row;
    //query retrieves the ids of all players registered to the tournament
    $sql = "SELECT Player_id FROM tournament_participants WHERE Player_id = '".$p_id."' AND Tournaments_id = '".$t_id."'";
    $res = $db_connection->query($sql);
	$text = "leave";
	$joining=0;
	$inTournament = 1;
	if($res->num_rows==0){
		$text="join";
		$joining=1;
		$inTournament = 0;
	} 
	$loggedIn = $login->isUserLoggedIn();
    //if user tries to join, is logged in, is not already part of the tournament, and there is space in the tournament;
    if (isset($_POST['join']) && ($login->isUserLoggedIn() == true) && ($test->num_rows == 0) && ($row['tournament_current_players'] < $row['tournament_p_max'])){
        //query adds player to tournament participants
        $sql = "INSERT INTO tournament_participants (Player_id, Tournaments_id) VALUES ('".$p_id."', '".$t_id."')";
        $enter = $db_connection->query($sql);

        //query increments number of players in tournament by 1
        $sql = "UPDATE tournaments SET tournament_current_players=tournament_current_players+1";
        $enter = $db_connection->query($sql);
    }
	
	$bracketHeight = pow(2,ceil(log($row['tournament_current_players'],2)));

	$sql = "SELECT is_admin FROM player WHERE id=$p_id";
	$adminres= $db_connection->query($sql);
	$adminrow = $adminres->fetch_assoc();
	$isAdmin = $adminrow['is_admin'];
	//includes necessary file to handle payment of entry fee if required
		include 'payments/entry_fee.php';
?>

<script src='js/jquery.min.js'></script>
<script src='js/lobby_chat.js'></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
	
	$( document ).ready(function() {
		//Tab System (Kube doesn't have one)
		var active;
		active = $("#matchTab");
    	active.addClass('active');
		var content;
		content = active.attr('href');
		//$("#"+content).show();
		
		 $('.myTabClass').not(active).each(function () {
			var a = $(this).attr('href');
			
     		$("#"+a).hide();
   		 });

		$(this).on('click','.myTabClass', function(e){	
			$("#"+content).hide();
			active.removeClass('active');
			active = $(this);
			content = active.attr('href');
			active.addClass('active');
			$("#"+content).show();
		});
		
		$(".bracketFrame").height(<?=$bracketHeight?>*34 + 20);
	});

	
	
	
	
</script>
<link rel='stylesheet' href='css/chat.css' /> 
<link href="../css/tournamentInfoNew.css" rel="stylesheet"/>
</head>
<body>
<?php 
	require_once "segments/navigation.php"; 
	require_once "payments/entry_fee.php";
?>
<script>
	function joinAndLeave(){
		var text  = '<?=$text?>';
		var p_id = <?=intval($p_id)?>;
		var t_id = <?=$t_id?>;
		var entryFee = <?=$row['tournament_entry_fee']?>;
		
		//If entryFee > 0, a payment is required
		if (entryFee > 0){	
			entry_div_show();



		} else if (confirm('Are you sure you want to '+text+'?')) {			
			var joining = <?=$joining?>;
				$.ajax({
					type: "GET",
					url: "updateTournament.php",
					data: {p_id:p_id, t_id:t_id, joining:joining}
				}).done( function() {
					window.location.reload(true);
				});
		} else {
			return false;
		}
	}
</script>	
<div class="content top">
	<!-- tournament overview -->
	<row centered>
		<!-- left column -->
		<column class="panel" cols="8">
			<!-- information header -->
			<!-- participantsTab class is used for it's border-right property -->
			<div class="infoHeader participantsTab">
				<?= $row['tournament_name'];?>
				<?=$plsWork;?>
			</div><!-- information header end -->
			<!-- Information body -->
			<div class="infoBody">				
				<!-- game detail -->						
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Game
					</div>
					<div class="actualDetail piece">
						<?= $row['tournament_game'];?>
					</div>
				</div>	<!-- ./game detail end-->
				<!-- prize pool detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Prize Pool
					</div>
					<div class="actualDetail piece">
						€<?= $row['tournament_prize_pool_start'];?>
					</div>
				</div>	<!-- ./prize pool detail end-->
				<!-- players detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Players
					</div>
					<div class="actualDetail piece">
						<?= $row['tournament_current_players'];?>/<?= $row['tournament_p_max'];?> Players
					</div>
				</div><!-- ./players detail end-->
				<!-- entry fee detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Entry Fee
					</div>
					<div class="actualDetail piece">
						€<?= $row['tournament_entry_fee'];?>
					</div>
				</div><!-- ./ entry fee detail end-->
				<!-- start date detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Start Date
					</div>
					<div class="actualDetail piece">
						<!-- timestamp -->
						<?php $timestamp =$row['tournament_start_timestamp'];
							$justDate = substr($timestamp,0,10);	
							echo $justDate?>
					</div><!-- ./timestamp detail end -->
				</div><!-- ./info body end -->	
				<!-- region detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Region
					</div>
					<div class="actualDetail piece">
						<?= $row['tournament_region'];?>
					</div>
				</div><!-- ./region detail end -->
				
				<div  class="width-6 piece ">
					<?php
						if($loggedIn){
							if($row['tournament_checkin_phase']!=2){ ?><div onclick="joinAndLeave()" class="nameOfDetail piece <?=$text?>" >
						<!--<input type='button' class='sendBtn btn'>-->
						<?php
							echo $text;
						?>
					</div>
					<?php }else{
						?>
						<div class="nameOfDetail piece ongoing">This tournament is ongoing</div>
					<?php }
						}?>
				</div>
				
				
				
			</div><!-- ./information body end -->
		</column><!-- ./left column end -->
		
		<!-- right column-->
		<column cols="4">
			<div class="infoHeader">
				Tournament Lobby
			</div>
			<div class="infoBody chatbox">
				<?php 
					$sql = "SELECT chat_id FROM chat_session WHERE class_id = ".$t_id." AND chat_class = 'tournament_lobby'";
					$result = $db_connection->query($sql);
					$res = $result->fetch_assoc();
					$chatID = $res['chat_id']; 
					include 'chatbox.php';
				?>
			</div>
		</column><!-- ./right column end -->
		
				
	</row><!-- ./ tournament overview end-->
</div><!-- ./content end -->

	<!-- panel header -->
	<row centered class="panel panelhead">
		<!-- container -->
		<column cols="12">
			<!-- Main content -->
			<div class="tabbedHeaders">
				<div class="tabCollection">
					<div id="matchTab" href="theMatch" class="myTabClass">Match</div>
					<div class="myTabClass" href="theBrackets">Brackets</div>
					<div id="pTab" class="participantsTab myTabClass" href="theParticipants">Participants</div>		
					<div id="actualrulesTab" class="myTabClass" href="theRules">Rules</div>
				</div>	
			</div>	
		</column><!-- ./column end -->
	</row><!-- ./panel head end -->
		
		<!-- panel body -->
		<row centered class="panel panelbody">
			<!-- container -->
			<column cols="12">
				<!-- tabbed content -->
					<div id="theMatch">
						<?php if($_SESSION['user_name']=="admin"){ ?>
							<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?=$t_id?>" method="post">
								<!--<button type="submit" name="b_gen" value="1">b_gen</button>	-->
							</form>
						<?php } ?>
						<?php 
							$savedRow = $row;
							if($savedRow['tournament_checkin_phase']==2){
						?>
						<?php 
							include 'tournamentInfo/matchinfo.php';
							}else{
								echo "No matches started";
							}
						?>
					</div>
					<div id="theBrackets">
						<?php 
							if($savedRow['tournament_checkin_phase']==2){
						?>
							
							<iframe width="" class="iframe bracketFrame" <?php echo'src="bracket_test.php?id='.$t_id.'"'?>></iframe>
						<?php
							}else{
									echo "Tournament has not begun yet.";
							}
						?>	
					</div>
					<div id="theParticipants">
						<?php include 'tournamentInfo/participants.php';?>
					</div>	
					
					<div id="theRules">
						<?php echo $savedRow['tournament_rules']; ?>
						
					</div>
				<!-- ./tabbed content end -->
			</column><!-- ./column end -->
		</row><!-- ./row end -->
<?php 
	//include "games/hearthstone/match_reporting.php";
	include 'segments/footer.php';
?>