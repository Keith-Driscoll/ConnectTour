<?php 

require_once 'segments/header.php';
require_once 'classes/connections.php';
$db_connection = db_connect();
include 'classes/Login.php';
$login = new Login();
session_start();
//holds the id of the tour, pulled from url
$t_id = intval($_GET['id']);
//holds user_id stored in session if the player is logged in
$p_id = intval($_SESSION['user_id']);
//query retrieves all data relating to the tour $t_id
$sql = "SELECT * FROM tours WHERE id = '".$t_id."'";
$result = $db_connection->query($sql);
$row = $result->fetch_assoc();
$game = $row['tour_type'];

if($game!="Sport"){ //TODO Should be replaced with a list of supported games
    $game = "general";
}

//$checkin =$row;
//query retrieves the ids of all players registered to the tour
$sql = "SELECT Player_id FROM tour_participants WHERE Player_id = '".$p_id."' AND Tours_id = '".$t_id."'";
$res = $db_connection->query($sql);
$text = "leave";
$joining=0;
$intour = 1;
if($res->num_rows==0){
    $text="join";
    $joining=1;
    $intour = 0;
} 
$loggedIn = $login->isUserLoggedIn();
//if user tries to join, is logged in, is not already part of the tour, and there is space in the tour;
if (isset($_POST['join']) && ($login->isUserLoggedIn() == true) && ($test->num_rows == 0) && ($row['tour_members'] < $row['tour_max'])){
    //query adds player to tour participants
    $sql = "INSERT INTO tour_participants (Player_id, Tours_id) VALUES ('".$p_id."', '".$t_id."')";
    $enter = $db_connection->query($sql);

    //query increments number of players in tour by 1
    $sql = "UPDATE tours SET tour_members=tour_members+1";
    $enter = $db_connection->query($sql);
}

$bracketHeight = pow(2,ceil(log($row['tour_members'],2)));

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
		active = $("#tourTab");
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
<link href="../css/tourInfo.css" rel="stylesheet"/>
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
		var entryFee = <?=$row['tour_entry_fee']?>;
		
		//If entryFee > 0, a payment is required
		if (entryFee > 0){	
			entry_div_show();



		} else if (confirm('Are you sure you want to '+text+'?')) {			
			var joining = <?=$joining?>;
				$.ajax({
					type: "GET",
					url: "updateTour.php",
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
	<!-- tour overview -->
	<row centered>
		<!-- left column -->
		<column class="panel" cols="8">
			<!-- information header -->
			<!-- participantsTab class is used for it's border-right property -->
			<div class="infoHeader participantsTab">
				<?= $row['tour_name'];?>
				<?=$plsWork;?>
			</div><!-- information header end -->
			<!-- Information body -->
			<div class="infoBody">				
				<!-- game detail -->						
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Tour
					</div>
					<div class="actualDetail piece">
						<?= $row['tour_type'];?>
					</div>
				</div>	<!-- ./game detail end-->
				<!-- prize pool detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Price
					</div>
					<div class="actualDetail piece">
						€<?= $row['tour_price'];?>
					</div>
				</div>	<!-- ./prize pool detail end-->
				<!-- players detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Members
					</div>
					<div class="actualDetail piece">
						<?= $row['tour_members'];?>/<?= $row['tour_max'];?> Tour members
					</div>
				</div><!-- ./players detail end-->
				<!-- entry fee detail -->
				 <!--<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Tour Cost
					</div>
					<div class="actualDetail piece">
						€/*= $row['tour_entry_fee'];*/
					</div>
				</div><!-- ./ entry fee detail end--> -->
				<!-- start date detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Start Date
					</div>
					<div class="actualDetail piece">
						<!-- timestamp -->
						<?php $timestamp =$row['tour_start'];
                              /*$justDate = substr($timestamp,0,10);	*/
                              echo $timestamp?>
					</div><!-- ./timestamp detail end --> hh
				</div>
                <div class="width-6 piece">
                    <div class="nameOfDetail piece">
                       Tour Details
                    </div>
                    <div class="actualDetail piece">
                        <?= $row['tour_details'];?> 
                    </div>
                </div>
            
            
            
            
            <!-- ./info body end -->	
				<!-- region detail -->
				<div class="width-6 piece">
					<div class="nameOfDetail piece">
						Region
					</div>
					<div class="actualDetail piece">
						<?= $row['tour_region'];?>
					</div>
				</div><!-- ./region detail end -->
				
				<div  class="width-6 piece ">
					<?php
                    if($loggedIn){
                        if($row['tour_checkin_phase']!=2){ ?><div onclick="joinAndLeave()" class="nameOfDetail piece <?=$text?>" >
						<!--<input type='button' class='sendBtn btn'>-->
						<?php
							echo $text;
                        ?>
					</div>
					<?php }else{
                    ?>
						<div class="nameOfDetail piece ongoing">This tour is ongoing</div>
					<?php }
                    }?>
				</div>
				
				
				
			</div><!-- ./information body end -->
		</column><!-- ./left column end -->
		
		<!-- right column-->
		<column cols="4">
			<div class="infoHeader">
				Tour Lobby
			</div>
			<div class="infoBody chatbox">
				<?php 
                $sql = "SELECT chat_id FROM chat_session WHERE class_id = ".$t_id." AND chat_class = 'tour_lobby'";
                $result = $db_connection->query($sql);
                $res = $result->fetch_assoc();
                $chatID = $res['chat_id']; 
                include 'chatbox.php';
                ?>
			</div>
		</column><!-- ./right column end -->
		
				
	</row><!-- ./ tour overview end-->
</div><!-- ./content end -->

	<!-- panel header -->
	<row centered class="panel panelhead">
		<!-- container -->
		<column cols="12">
			<!-- Main content -->
			<div class="tabbedHeaders">
				<div class="tabCollection">
					<div id="tourTab" href="theTour" class="myTabClass">Tour</div>
					<div id="pTab" class="participantsTab myTabClass" href="theParticipants">Tour members</div>		
					<div id="actualrulesTab" class="myTabClass" href="theRules">Extra info</div>
				</div>	
			</div>	
		</column><!-- ./column end -->
	</row><!-- ./panel head end -->
		
		<!-- panel body -->
		<row centered class="panel panelbody">
			<!-- container -->
			<column cols="12">
				<!-- tabbed content -->
					<div id="theTour">
						<?php if($_SESSION['user_name']=="admin"){ ?>
							<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?=$t_id?>" method="post">
								<!--<button type="submit" name="b_gen" value="1">b_gen</button>	-->
							</form>
						<?php } ?>
						<?php 
							include 'tourInfo/info.php';
                        ?>
					</div>
					
					<div id="theParticipants">
						<?php include 'tourinfo/participants.php';?>
					</div>	
					
					<div id="theRules">                        
                        <?php include 'tourinfo/rules.php';?>
					</div>
				<!-- ./tabbed content end -->
			</column><!-- ./column end -->
		</row><!-- ./row end -->
<?php 

include 'segments/footer.php';
?>