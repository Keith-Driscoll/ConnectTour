<?php
	
	$sql = "SELECT * FROM hearthstone_games WHERE match_id = $matchid"; 
	$result = $db_connection->query($sql);
    $hearthstone_game = $result->fetch_assoc();
	$firstDone = 0;
	
	if($hearthstone_game['player_1_result']!=null&&$hearthstone_game['player_2_result']!=null){
		$firstDone = 1;
	}
	$dispute = 0;
	$pow = 0;
	$usedP1 = 0;
	$usedP2 = 0;
	if($pow<$game_number){
		if($hearthstone_game['player_1_result']!=null&&$hearthstone_game['player_2_result']!=null){		
			if(!$hearthstone_game['winner']){
					$dispute = 1;
			}
			else{
				$usedP1 += $hearthstone_game['player_1_class1'] * pow(10, $pow)* $hearthstone_game['player_1_result'];
				$usedP2 += $hearthstone_game['player_2_class1'] * pow(10, $pow)* $hearthstone_game['player_2_result'];
				
			}				
		}
		$pow++;			
	}
	while($pow<$game_number && ($hearthstone_game = $result->fetch_assoc())){	
		if($hearthstone_game['player_1_result']!=null&&$hearthstone_game['player_2_result']!=null){
			if(!$hearthstone_game['winner']){							
				$dispute = 1;
			}
			else{
				$usedP1 += $hearthstone_game['player_1_class1'] * pow(10, $pow) * $hearthstone_game['player_1_result'];
				$usedP2 += $hearthstone_game['player_2_class1'] * pow(10, $pow) * $hearthstone_game['player_2_result'];	
			}
		}
		$pow++;
	}	
?>
<div id="abc">
	<!-- Popup Div Starts Here -->
	<div id="close" class="icon_close closeButton" onclick ="div_hide()"></div>
	<div id="popupContact">
		<!-- Contact Us Form -->	
				<row centered>			
						<h3 class="lobbyHeading">Match Lobby</h3>				
				</row>
				<row centered>			
						<column cols="3" id="player1" class="playerInfo">
							<img src="images/logo_vector.png" id="chosenClass<?=$self?>" class='img-responsive' alt='user-profile' />
							<p class=''><b>You</b></p>
							<p><a href="profile.php?id=<?=$p_id?>"><b><?=$user_name?></b></a></p>
						</column>		
						<column cols="2" class="scoreDisplayPop">vs</column>	
						<column cols="3" id="player2" class="playerInfo winner">
						<img src="images/logo_vector.png" id="chosenClass<?=$opponent?>" class='img-responsive' alt='user-profile' />
							<p class=''><b>Opponent</b></p>
							<p><a href="profile.php?id=<?=$p2_id?>"><b><?=$opponent_username['player_username']?></b></a></p></column>
				</row>
				<div id="reportSection">
				<?php 
				$checking =0;							
				if(!$hearthstone_game||$hearthstone_game['player_'.$self.'_result']==null||$dispute){	?>
					<row centered>
						<column cols="3"><div id="myClasses"></div></column>
						<column cols="2"></column>
						<column cols="3"><div id="oppClasses"></div></column>
					</row>
					<row centered>
						<div class="loss show">I won</div>					
						<div class="toggle-button" data-win = "false">
							<button type="button" id="toggs" name="resultButton"></button>
						</div>
						<div class="won">I lost</div>
					</row>
					<row centered>
						<?php if(!$dispute){ ?>
						<!-- Confirm section -->
						<a onclick="checkDispute()" id="submit">Submit </a>	
						<div id="leftOfConfirm">Are you sure?</div>
						<a onclick="submitResults()" id="subConfirm" class="popUpButtons">Confirm</a>
						<a onclick="unsplit()" id="subCancel" class="popUpButtons">Cancel</a>
						<?php }else{ ?>
						<!-- Dispute section -->						
						<div id="leftOfDispute">Results don't match</div>
						<a onclick="submitResults()" id="subResubmit" class="popUpButtons">Resubmit</a>
						<?php } ?>
					</row>					
					<div id="classChooseReport"></div>	
				<?php }					
					else{
							$checking = 1;
							echo "<div class='waitingNote'>Waiting for opponent to report</div>";						
					}
				?>
				</div>
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
		$(".won").toggleClass("show");
		$(".loss").toggleClass("show");
		$("#player1").toggleClass("winner");
		$("#player2").toggleClass("winner");
	});
	
	function checkDispute(){
		var win = 0;
			if($(".toggle-button").attr("data-win")=="true"){
				win = 1;
			}		
			var myClasses = $("#chosenClass"+<?=$self?>).attr("src").replace("images/hearth_icons/","").replace(".png","");
			var opp = $("#chosenClass"+<?=$opponent?>).attr("src").replace("images/hearth_icons/","").replace(".png","");
			
			var match_id = <?=$matchid?>;
				
			var self = <?=$self?>;
				
			
			$.ajax({
				url: 'games/hearthstone/checkForDispute.php',
				type: 'GET',
				data: {win:win,myClasses:myClasses,opp:opp,game_number:game_number,match_id:match_id,self:self}				
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
		
	function split(){
		if(chosen1 && chosen2){
			$("#submit").hide();
			$("#leftOfConfirm").show();
			$("#subConfirm").show();
			$("#subCancel").show();
		}
		else{
			$("#classChooseReport").html("Choose the class used by both players");
			$("#classChooseReport").fadeIn(1000);
			$("#classChooseReport").fadeOut(2000);
		}
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
	var uP1 = <?=$usedP1?>;
	var uP2 = <?=$usedP2?>;
	var getBanVis = <?=$firstDone?>;
	function getUnbannedClasses(){

		$("#myClasses").html("");
		$("#oppClasses").html("");
		$(".classIcon").each(function( index ) {
  			if(!$(this).attr("data-banned")){
					var old = this;	
					var str = old.style.backgroundImage;
					str = str.replace("url(","");
					str = str.replace(")","");
					var c = str.replace("images/hearth_icons/","");
					c = c.replace(".png","");
					c = c.replace('"','');
					c = c.replace('"','');
					if(this.parentElement.getAttribute('id')=="opponentChoices"+<?=$self?>){
						
						$("#myClasses").append(`<div width="64" height="64" onclick='clickUsedClass(`+<?=$self?>+`,`+str+`)' style='cursor:pointer;float:left; background-image: `+old.style.backgroundImage+`' id="c`+c+`p`+<?=$self?>+`" class="classIcon glow" title="`+old.title+`"></div>`);				  
					}
					else{
						$("#oppClasses").append(`<div width="64" height="64" onclick='clickUsedClass(`+<?=$opponent?>+`,`+str+`)' style='cursor:pointer;float:left; background-image: `+old.style.backgroundImage+`' id="c`+c+`p`+<?=$opponent?>+`" class="classIcon glow" title="`+old.title+`"></div>`);
					}
			}
			else if($(this).attr("data-banned")=="false"){
				var old = this;	
					var str = old.style.backgroundImage;
					str = str.replace("url(","");
					str = str.replace(")","");
					if(this.parentElement.getAttribute('id')=="opponentChoices"+<?=$self?>){
						
						$("#myClasses").append(`<div width="64" height="64" onclick='clickUsedClass(`+<?=$self?>+`,`+str+`)' style='cursor:pointer;float:left; background-image: `+old.style.backgroundImage+`' id="c`+c+`p`+<?=$self?>+`" class="glow classIcon" title="`+old.title+`"></div>`);				  
					}
					else{
						$("#oppClasses").append(`<div width="64" height="64" onclick='clickUsedClass(`+<?=$opponent?>+`,`+str+`)' style='cursor:pointer;float:left; background-image: `+old.style.backgroundImage+`' id="c`+c+`p`+<?=$opponent?>+`" class="glow classIcon" title="`+old.title+`"></div>`);
					}
			}
		});
		
		if(getBanVis==1){
			console.log("1:"+uP1);
			console.log("2:"+uP2);
			setUsedVisuals(uP1,1);
			setUsedVisuals(uP2,2);
		}
		var set =  0<?=$checking?>;
		if(set==1){
			intervalReporting();
		}
		
		if(<?=$dispute?>==1){
			intervalDisputeCheck();
		}
		
	}
	var chosen1 = 0;
	var chosen2 = 0;
	function clickUsedClass(player,backImage){
		unsplit();
		$("#chosenClass"+player).attr("src", backImage);
		
		if(player == 1){
			chosen1 = 1;
		}
		else{
			chosen2 =1;
		}
		
	}
	var game_number = <?=$game_number?>;
	
	function submitResults(){
		
			var win = 0;
			if($(".toggle-button").attr("data-win")=="true"){
				win = 1;
			}		
			var myClasses = $("#chosenClass"+<?=$self?>).attr("src").replace("images/hearth_icons/","").replace(".png","");
			var opp = $("#chosenClass"+<?=$opponent?>).attr("src").replace("images/hearth_icons/","").replace(".png","");
			
			var match_id = <?=$matchid?>;
				
			var self = <?=$self?>;
				
			
			$.ajax({
				url: 'games/hearthstone/setMatchResults.php',
				type: 'GET',
				data: {win:win,myClasses:myClasses,opp:opp,game_number:game_number,match_id:match_id,self:self}				
			}).done( function( data ){
				var str = data.trim();
				if(str==""){
					window.location.reload();					
				}else{
				}
				
			});		
	}
	var usedVisSet = 0;
	function setUsedVisuals(data,p){		
		console.log("Data: " + data + " p :" + p);	
		if(data!=null&&data!=""){			
			var total = data;
			var visCount = 0;
			while(total!=0){	
				if(visCount>=usedVisSet){
					var current =  (total % 10)-1;
					var id = "c"+current+"p"+p;
					if($("#"+id).attr("data-banned")!='true'){
						var newStr = 'url(images/hearth_icons/used.png),' +$("#"+id).css('background-image');
						$("#"+id).css('background-image',newStr );
						$("#"+id).attr("data-banned",'true');	
						$("#"+id).prop( "onclick", null );
						$("#"+id).removeClass("glow");		
						$("#"+id).css( 'cursor', 'not-allowed' );
					}							
					var id = "class_"+current+"_player_"+p;
					var newStr = 'url(images/hearth_icons/used.png),' +$("#"+id).css('background-image');
					$("#"+id).css('background-image',newStr );							
					total = Math.floor(total/10);					
					usedVisSet++;
				}		
				visCount++;		
			}
		}
	}
	var reportId;
	var fin =false;
	function intervalReporting(){	
		
		if(!fin){
			reportId = setInterval(function(){ 	
					checkOppReport();		
				}, 3000);
				fin = true;
		}	
	}
	
	function checkOppReport(){
		console.log("check");
		console.log("gnum: "+game_number);
			var p = <?=$self?>;
			var gnum = <?=$game_number?>;
			$.ajax({
				type: "GET",
				url: "checkOppReport.php",
				data: {p:p,gnum:gnum,match_id:<?=$matchid?>}
  			}).done( function( data ) {	
				  if(data!=null && data!=""){
					  console.log(data);
						var classesArray = data.split("|");
						//Update scores
						var winner = classesArray[2];	
						if(winner){
							replaceReportSection(classesArray[0],classesArray[1]);
							updateScore(winner);
							updateGamesPlayed(classesArray[3],classesArray[4],winner);
							if(game_number-1 == <?=$match['bestof']?>){
								updateMatchSection(winner);
							}
							game_number++;
						}
						else{
							//Dispute
							replaceReportSectionDispute();
							console.log("ca9: " + classesArray[9]);
							updatePlayedDispute(classesArray[3],classesArray[4],classesArray[5],classesArray[6],classesArray[7],classesArray[8],classesArray[9]);
							getBanVis = 0;
							getUnbannedClasses();	
							intervalDisputeCheck();
						}			
						clearInterval(reportId);						
				}	
				else{
					console.log("Player not locked");
				}	
			});		
	}
	var disputeRepId;
	var dispIOnce =false;
	function intervalDisputeCheck(){
		if(!dispIOnce){
			disputeRepId = setInterval(function(){ 		
						checkStillDisp();		
			}, 3000);
			dispIOnce = true;
		}
	}
	
	function checkStillDisp(){
		
		console.log("dispCheck");
			var p = <?=$self?>;
			var gnum = <?=$game_number?>;
			$.ajax({
				type: "GET",
				url: "checkOppReport.php",
				data: {p:p,gnum:gnum,match_id:<?=$matchid?>}
  			}).done( function( data ) {	
				  if(data!=null && data!=""){
						var classesArray = data.split("|");
						//Update scores
						var winner = classesArray[2];	
						if(winner){
							replaceReportSection(classesArray[0],classesArray[1]);
							updateScore(winner);
							updateAfterDispute(classesArray[3],classesArray[4],winner);
							if(game_number-1 == <?=$match['bestof']?>){
								updateMatchSection(winner);
							}
							clearInterval(disputeRepId);
							game_number++;
						}						
				}	
				else{
					console.log("Player not locked");
				}	
			});	
		
	}
	
	function updateMatchSection(winner){
		if(winner==<?=$self?>){
			$("#theRules").html("<div class='youWon'>You won the match.</div>");
		}
		else{
			$("#theRules").html("<div class='knockedOut'>You have been knocked out.</div>");
		}
	}
	
	function updateScore(winner){
		if(winner==<?=$self?>){
			$(".scoreDisplay").html('<p>VS</p><p>'+<?=$score_p1 + 1?>+':'+<?=$score_p2?>+'</p>');
		}
		else{
			$(".scoreDisplay").html('<p>VS</p><p>'+<?=$score_p1?>+':'+<?=$score_p2 + 1?>+'</p>');
		}
	}
		
	function replaceReportSection(a,b){
			$("#reportSection").html('<row centered><column cols="3"><div id="myClasses"></div></column><column cols="2"></column><column cols="3"><div id="oppClasses"></div></column></row><row centered><div class="loss show">I won</div><div class="toggle-button" data-win = "false"><button type="button" id="toggs" name="resultButton"></button></div><div class="won">I lost</div></row><row centered><a onclick="checkDispute()" id="submit">Submit </a><div id="leftOfConfirm">Are you sure?</div><a onclick="submitResults()" id="subConfirm" class="popUpButtons">Confirm</a><a onclick="unsplit()" id="subCancel" class="popUpButtons">Cancel</a></row>');
			getBanVis = 1;
			uP1 = a;
			uP2 = b;
			getUnbannedClasses();
		}
		
		function replaceReportSectionDispute(){
			$("#reportSection").html('<row centered><column cols="3"><div id="myClasses"></div></column><column cols="2"></column><column cols="3"><div id="oppClasses"></div></column></row><row centered><div class="loss show">I won</div><div class="toggle-button" data-win = "false"><button type="button" id="toggs" name="resultButton"></button></div><div class="won">I lost</div></row><row centered><div id="leftOfDispute">Results don\'t match</div><a onclick="submitResults()" id="subResubmit" class="popUpButtons">Resubmit</a>');
		}
		
	function convertNumberToClassesStr(num)
	{	
		console.log("num: "+ num);
		var s = "";		
			switch(num){							
				case 1 : s = s + "Warrior";
				break;
				case 2 : s = s + "Shaman";
				break;
				case 3 : s = s + "Rogue";
				break;
				case 4 : s = s + "Paladin";
				break;
				case 5 : s = s + "Hunter";
				break;
				case 6 : s = s + "Druid";
				break;
				case 7 : s = s + "Warlock";
				break;
				case 8 : s = s + "Mage";
				break;
				case 9 : s = s + "Priest";
				break;
			}	
		console.log("s: "+ s);
		return s;
	}
		
	function updateGamesPlayed(a1,a2,winner){
		console.log("update Games played a1: " + a1 + " a2: " + a2);
		var p1 = convertNumberToClassesStr(parseInt(a1[0]));
		var p2 = convertNumberToClassesStr(parseInt(a2[0]));
		if(winner == <?=$self?>){
			var pc<?=$self?> = "prevWin";
			var pc<?=$opponent?> = "prevLoss";
		}
		else{
			var pc<?=$opponent?> = "prevWin";
			var pc<?=$self?> = "prevLoss";
		}
		$('#waitingReport').html('<row centered class="games"><column cols="5"><div class="'+pc<?=$self?>+'">'+p<?=$self?>+'</div></column><column cols="1">vs</column><column cols="5"><div class="'+pc<?=$opponent?>+'">'+p<?=$opponent?>+'</div></column></row>');
	}		
	
	function updateAfterDispute(a1,a2,winner){
		console.log("update Games after dispute a1: " + a1 + " a2: " + a2);
		var p1 = convertNumberToClassesStr(parseInt(a1[0]));
		var p2 = convertNumberToClassesStr(parseInt(a2[0]));
		if(winner == <?=$self?>){
			var pc<?=$self?> = "prevWin";
			var pc<?=$opponent?> = "prevLoss";
		}
		else{
			var pc<?=$opponent?> = "prevWin";
			var pc<?=$self?> = "prevLoss";
		}
		var last_div = $('.oneGame:last'); 
		var gnum =  <?=$game_number?>;
		last_div.html('<row centered>Game '+gnum+'</row><row centered class="games"><column cols="5"><div class="'+pc<?=$self?>+'">'+p<?=$self?>+'</div></column><column cols="1">vs</column><column cols="5"><div class="'+pc<?=$opponent?>+'">'+p<?=$opponent?>+'</div></column></row>');
	}	
	
	function updatePlayedDispute(A1,A2,B1,B2,winnerA, winnerB, scrPic){
		var pA1 = convertNumberToClassesStr(parseInt(A1[0]));
		var pA2 = convertNumberToClassesStr(parseInt(A2[0]));
		var pB1 = convertNumberToClassesStr(parseInt(B1[0]));
		var pB2 = convertNumberToClassesStr(parseInt(B2[0]));
		var strA = winnerA == 1 ? "I Won":"I Lost";
		var strB = winnerB == 1 ? "I Won":"I Lost";
		var last_div = $('.oneGame:last'); 
		var gnum =  <?=$game_number?>;
		console.log(scrPic);
		var scrStr = '<?=$matchid ."_". $game_number ."_". intval($p_id)?>';
		var retAddr = '<?=$_SERVER['REQUEST_URI']?>';
		last_div.html('<row centered>Game '+gnum+' (Disputed)</row><row centered class="games"><column cols="5"><div>'+pA1+' vs '+pA2+'</div></column><column cols="1"></column><column cols="5"><div>'+pB1+' vs '+pB2+'</div></column></row><row centered class="games"><column cols="2">'+strA+'<div><a class="viewShotBut" onclick="viewScreenshot()">Screenshot</a></div></column><column cols="4"><div class="uploadScreenshot"><form action="image_upload.php?path=match_screenshots&file_name='+scrStr+'&max_size=100000000&ret='+retAddr+'" method="post" enctype="multipart/form-data"><input type="file" lass="uploadInput" name="fileToUpload" id="fileToUpload"><input type="submit" class="uploadButton" value="Upload Image" name="submit"></form></div></column><column cols="2"><div>'+strB+'<img class="userScreenshot" src="'+scrPic+'"/><div class="icon_close closeButtonScr" onclick="hideScreenshot()"></div></div></column></row>');
	}
	
</script>