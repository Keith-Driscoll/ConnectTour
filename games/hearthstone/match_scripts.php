
<script>

var NUM_BANS =<?=$numBans?>; //CHANGE TO DB VALUE
var bansToChoose = NUM_BANS;
var timerID;

/*
	Variables from matchinfo.php: (also fix this)
	$self
	$opponent
*/
var CLASS_STATE = <?=$pickState?>;
var BANS_STATE = <?=$banState?>;
var match_id = <?=$matchid?>;
var numClasses = <?=$numClasses?>;

function getTheClassStuff(state, player){
	var match_id = <?=$matchid?>;
	if (player == 1){
		var alt = 2;
	} else {
		var alt = 1;
	}

	$.ajax({
		type: "GET",
		url: "getClasses.php",
		data: {state:state, match_id:match_id, player:player}
	}).done( function( data ){

		if (data != ""){
			switch(state){
				case 1:
					//nah
					break;
				case 2:
					var str = convertNumberToClassesImages(data,player);
					setImageSpace(str,player);
					break;
				case 3:					
					break;
				case 4:
					var parsedData = parseData(data, <?=$numClasses?>);
					var str = convertNumberToClassesImages(parsedData[0],player);
					setImageSpace(str, player);
					var str = convertNumberToClassesImages(parsedData[1],alt);
					setImageSpace(str, alt);
					
					if (NUM_BANS > 0 && (BANS_STATE == 1 || BANS_STATE == 3)){
						makeClassesClickable();
						$("#bansSection"+<?=$self?>).html("<input onclick='submitBans()' class='btn bans-submit' type='button' value='Confirm Bans' />	<div id='bansResponder'></div>"); 
					}
					if(BANS_STATE == 2 || BANS_STATE == 4){
						getBans();
					}
					break;
				default: 
					alert("We're fukt bois");
					break;	
			}
		}
	});
}
//parse data if exists for 2 players
function parseData(data, num){
	var arr = [];
	arr[0] = "";
	arr[1] = "";
	for (var i = 0; i<num*2; i++ ){
		if (i < (num))	{
			arr[0] += data[i];
		} else {
			arr[1] += data[i];
		}
	}
	return arr;
}

function setImageSpace(str,p){

	var oneOrMore = bansToChoose==1 ? " class" : " classes";
	if(p==<?=$opponent?>){
		document.getElementById("opponentChoicesRep"+p).innerHTML = "Ban "+bansToChoose + oneOrMore + ":<br>";
		document.getElementById("opponentChoices"+p).innerHTML = str;
	}
	else{
		document.getElementById("opponentChoicesRep"+p).innerHTML = "Your Classes:<br>";
		document.getElementById("opponentChoices"+p).innerHTML = str;
	}
}
//calls constantlyCheckOppClasses every 3s
function intervalChecking(){	
	timerID = setInterval(function(){ 		
		constantlyCheckOppClasses();		
	}, 3000);	
}
//checks class state and acts accordingly
function constantlyCheckOppClasses(){
		var player =  <?=$opponent?>;
		var match_id = <?=$matchid?>;
		$.ajax({
			type: "GET",
			url: "getLockedInClasses.php",
			data: {player:player,match_id:match_id
			}
  			}).done( function(data) {
				data = parseInt(data);
				switch (data){
					case 1:
						CLASS_STATE = data;
						break;
					case 2:
						CLASS_STATE = data;
						$('#opponentChoices'+player).html("Opponent has locked in.");
						break;
					case 3:
						CLASS_STATE = data;
						$('#opponentChoices'+player).html("Opponent has not locked in.");
						break;
					case 4:
						CLASS_STATE = data;
						getTheClassStuff(CLASS_STATE ,<?=$opponent?>);						
						clearInterval(timerID);
						if (NUM_BANS > 0){
							BANS_STATE = 1;
							intervalBanChecking();
						}
						break;
					default:
						break;
				}	  
		 	});
}
//Takes in number representing classes and outsputs images for each class
function convertNumberToClassesImages(num,p)
{	
	if(num!=null&&num!=""){
		var str = "";
		var test = num;
		while(test!=0){
			
			var current = test%10-1;
			var name = convertNumberToClassesString(current+1);
			if(p==<?=$opponent?>&& (BANS_STATE == 1 || BANS_STATE == 3)){
				
				str += "<div data-banned=false onclick='classClicked(`class_"+current+"_player_"+p+"`)' width='64' height='64' style='float:left;background-image: url(images/hearth_icons/"+current+".png)' id='class_"+current+"_player_"+p+"' class='classIcon oppClassIcon' title='"+name+"'></div>";
			}
			else{
				str += "<div width='64' height='64' style='float:left; background-image: url(images/hearth_icons/"+current+".png)' id='class_"+current+"_player_"+p+"' class='classIcon' title='"+name+"'></div>";
			}
			test = Math.trunc(test / 10);
		}	
	}
	return str;
}

function makeClassesClickable(){
	console.log("mcc");
	var numClasses = <?=$numClasses?>;
	var count=0;
	$(".classIcon").each(function() {
		var current = this;		
		if(count>=numClasses){
			this.data('banned', false);
		}		
	});	
}

function makeClassesUnclickable(){
	console.log("mcu");
	$(".classIcon").prop( "onclick", null );
	$(".classIcon").removeClass("oppClassIcon");
}

function convertNumberToClassesString(num)
	{	
	var str = "";		
		switch(num){				
			case 1 : str = str + "Warrior";
			break;
			case 2 : str = str + "Shaman";
			break;
			case 3 : str = str + "Rogue";
			break;
			case 4 : str = str + "Paladin";
			break;
			case 5 : str = str + "Hunter";
			break;
			case 6 : str = str + "Druid";
			break;
			case 7 : str = str + "Warlock";
			break;
			case 8 : str = str + "Mage";
			break;
			case 9 : str = str + "Priest";
			break;
		}	
	return str;
}
//When you click on a class
var stopClick =false;
function classClicked(id){
	
	if(stopClick){
		return;
	}
	var change = true;
	stopClick = true;
	if(bansToChoose>0){
		if($("#"+id).attr("data-banned")=='false'){
			var newStr = 'url(images/hearth_icons/ban.png),' +$("#"+id).css('background-image');
			$("#"+id).css('background-image',newStr );
			$("#"+id).attr("data-banned",'true');
			bansToChoose--; 
			change =false; 
		}
	}
	if($("#"+id).attr("data-banned")=='true'&&change){
			var oldStr = $("#"+id).css('background-image');
			var newStr = oldStr.replace('url("http://ggleagues.com/images/hearth_icons/ban.png"),',"");
			$("#"+id).css('background-image',newStr);
			$("#"+id).attr("data-banned",'false');
			bansToChoose++;
	}
	stopClick= false;
}

function submitBans(){
	var whichPlayer = <?=$opponent?>;
	if(bansToChoose!=0){
		$('#bansResponder').html("Choose "+bansToChoose + " more classes to ban.");
	}else{		
		
		var banValue=0;		
		$( ".oppClassIcon" ).each(function() {			
			if($(this).attr("data-banned")=='true'){
				var fullID = $(this).attr('id');
				var justClass = fullID.replace("class_","");
				justClass = justClass.replace("_player_"+whichPlayer,"");
				banValue = banValue * 10;
				banValue = banValue + (parseInt(justClass)+1);
			}			
		});
		makeClassesUnclickable();
		$.ajax({
			type: "GET",
			url: "setBans.php",
			data: {player:<?=$self?>,match_id:<?=$matchid?>,banValue:banValue}
		}).done( function(data) {
			$('#bansSection'+<?=$self?>).html("");
			//Update States
			if (BANS_STATE == 1){
				BANS_STATE = 2;
				getBans(BANS_STATE);
			} else if (BANS_STATE == 3) {
				BANS_STATE = 4;
				getBans(BANS_STATE);
			} else {
				console.log("State error in submitBans");
			}				
		});		
	}
}

function setBannedVisuals(data,p){	
	if(data!=null&&data!=""){
		if(p==1){
			p=2;
		} else{
			p=1;
		}
		var total = data;
		while(total!=0){	
			var current =  (total % 10)-1;
			var id = "class_"+current+"_player_"+p;
			if($("#"+id).attr("data-banned")!='true'){
				var newStr = 'url(images/hearth_icons/ban.png),' +$("#"+id).css('background-image');
				$("#"+id).css('background-image',newStr );
				$("#"+id).attr("data-banned",'true');					
			}
			total = Math.floor(total/10);
		}
	}
}

var banTimer=null;
var intCount = 0;

function intervalBanChecking(){	

	banTimer = setInterval(function(){ 
		constantlyCheckOppBans();		
	}, 3000);	
}

function constantlyCheckOppBans(){
	
	var player = <?=$opponent?>;
	var match_id = <?=$matchid?>;
	var alt = <?=$self?>;
	$.ajax({
		type: "GET",
		url: "getLockedInBans.php",
		data: {player:player,match_id:match_id}
	}).done( function( data ) {
		data = parseInt(data);
		switch (data){
			case 1:
				BANS_STATE = data;
				$('#bansSection'+player).html("Opponent has not locked in bans.");
				break;
			case 2:
				BANS_STATE = data;
				$('#bansSection'+player).html("Opponent has not locked in bans.");				
				break;
			case 3:
				BANS_STATE = data;
				$('#bansSection'+player).html("Opponent has locked in bans.");
				break;
			case 4:			
				BANS_STATE = data;
				getBans(BANS_STATE);
				clearInterval(banTimer);
				$('#bansSection'+player).html("");
				$('#matchReport').html('<button id="popup" class="reportButton" onclick="div_show();">Report</button>');	
				break;
			default:
				
				console.log("Here we go again");
				break;
		}
	});
		
}
var once = 0;
function getBans() {	
		var state = BANS_STATE;			
		var match_id = <?=$matchid?>;
		var player = <?=$self?>;
		$.ajax({
				type: "GET",
				url: "getBans.php",
				data: {match_id:match_id,state:state, player:player}
  		}).done( function( data ) {
				
			switch (state){
				case 1:
					//data = parseInt(data);
					//convertNumberToClassesImages(data,player);
					break;
				case 2:
					data = parseInt(data);
					setBannedVisuals(data, <?=$self?>);
					break;
				case 3:
					break;
				case 4:
					var parsedData = parseData(data,NUM_BANS);
					setBannedVisuals(parsedData[0], <?=$self?>);
					setBannedVisuals(parsedData[1], <?=$opponent?>);
					document.getElementById("opponentChoicesRep"+<?=$opponent?>).innerHTML = "Your Classes:<br>";
					$('#matchReport').html('<button id="popup" class="reportButton" onclick="div_show();">Report</button>');
					if(!once){
						getUnbannedClasses();	
						once = 1;				
					}
					break;
				default:
					console.log("Here we go again2");
					break;
			}						  
		});
}



</script>