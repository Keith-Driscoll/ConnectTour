//urls have been modified to include window.chatClass which is the id of the session
//in the functions getChatText, and sendChatText

//Functions in refresh, submit and chatclass have been modified to take it as a parameter and use it in queries
//Declared globally, and initialised on $(document).ready(function() before startChat()
var lastTimeID = 0;
var lastTimeID1 = 0;
var lastTimeID2 = 0;
var timerId;
var itWasMe = 1;
var chatClass;
var chatClassSending;
var currentChat =0;
var currentChatSending =0;
var fired = false;
var chats = new Array(2);
var justSent1 = false;
var justSent2 = false;
$(document).ready(function() {
	
	$('.sendBtn').click( function() {	
		
		var str =this.id;
		chatClassSending = str.replace("sendBtn", "");
		if(chatClassSending==chats[0]){
			currentChatSending = 0;
		}
		else{
			currentChatSending = 1;
		}			
		sendChatText();
		$('#chatInput'+chatClassSending).val("");
	
	});	
	startChat();
   
});

function keyPress(e){
	if(!fired) {
		fired = true;
		if(e.keyCode === 13){
				
			$( ".chatInput" ).each(function(i, obj) {
				var val  = obj.id.replace("chatInput", "");
				if ($('#chatInput'+val).is(":focus")) {				
					chatClassSending= val;
					if(chatClassSending==chats[0]){
						currentChatSending = 0;
					}
					else{
						currentChatSending = 1;
					}
					sendChatText();

					$('#chatInput'+chatClassSending).val("");							
				}
			});
		}
	}
 	return true;
}
function keyUp(){
	fired = false;
}
var  j =0;
function startChat(){	
	
	
	$('.view_ajax').each(function(i, obj) {
       chats[j] = obj.id.replace("view_ajax", "");
	   j++;
  	});		
	startInterval();	
}

function startInterval(){	
	timerId = setInterval(function(){ 
		getChatText();
		if(j>1){
			getChatText2();		
		}					 				
	}, 2000);	
}

//////////////////////////Getting/////////////////////////////////////////////////////////

function getChatText() {
	currentChat = 0;
	chatClass= chats[currentChat];
	lastTimeID = lastTimeID1;  
	if(justSent1){
		lastTimeID=0;		
	}
  	$.ajax({
    	type: "GET",
    	url: "refresh.php?chatClass="+chatClass,
		data: {lastTimeID: lastTimeID}
  	}).done( function(data) {	
		currentChat = 0;
		chatClass= chats[currentChat];
		var jsonData = JSON.parse(data);
		var jsonLength = jsonData.results.length;
		var html = "";
		var result;
		for (var i = 0; i < jsonLength; i++) {
			result = jsonData.results[i];	
			html += '<div class="username" >' + '<span class="oneUsersName" onclick="clickUsername('+ result.player_id + ')" style="color: #' + result.color + '">'+ result.usrname + '</span>' +': ' +'<span class="chattext">  '+ decodeURIComponent(result.chattext) +'</span>'+ '<span class="chattime">  '+result.chattime+'</span>'+'</div>';
		}
		
		var atBot=0;
		var str = '#view_ajax'+chatClass;
		if($(str).scrollTop()+ $(str).innerHeight() >= $(str)[0].scrollHeight){
		atBot=1;
		}	
		if(justSent1){
			$(str).html(html);
			justSent1=false;
		}else{
			$(str).append(html);
		}
				
	  
	  //Scrolling
		if(itWasMe ===1){
			itWasMe =0;
			scrollToBottom();
		}else if(atBot===1){
			scrollToBottom();
		}		
		if(result!=null){
			lastTimeID1 = result.id;
		}		
  	});	  
}

//////HAX DOUBLE CHAT////////

function getChatText2() {
	currentChat =1;
	chatClass= chats[currentChat];
	lastTimeID = lastTimeID2;	
	if(justSent2){
		lastTimeID=0;
	}
  	$.ajax({
    	type: "GET",
    	url: "refresh.php?chatClass="+chatClass,
		data: {lastTimeID: lastTimeID}
  	}).done( function(data) {	
		currentChat =1;
		chatClass= chats[currentChat];
		var jsonData = JSON.parse(data);
		var jsonLength = jsonData.results.length;
		var html = "";
		var result;
		for (var i = 0; i < jsonLength; i++) {
			result = jsonData.results[i];	
			html += '<div class="username" >' + '<span onclick="clickUsername('+ result.player_id + ')" class="oneUsersName" style="color: #' + result.color + '">'+ result.usrname + '</span>' +': ' +'<span class="chattext">  '+ decodeURIComponent(result.chattext) +'</span>'+ '<span class="chattime">  '+result.chattime+'</span>'+'</div>';
		}
		
		var atBot=0;
		var str = '#view_ajax'+chatClass;
		if($(str).scrollTop()+ $(str).innerHeight() >= $(str)[0].scrollHeight){
		atBot=1;
		}
		
		if(justSent2){
			$(str).html(html);
			justSent2 = false;
		}else{
			$(str).append(html);
		}
	  
	  //Scrolling
		if(itWasMe ===1){
			itWasMe =0;
			scrollToBottom();
		}else if(atBot===1){
			scrollToBottom();
		}	
		if(result!=null){
			lastTimeID2 = result.id;
		}		
  	});	  
}


//////////////////////////Sending/////////////////////////////////////////////////////////

function sendChatText(){
	itWasMe = 1;
	var chatInput = $('#chatInput'+chatClassSending).val();
	
	var input = encodeURIComponent(chatInput);
	if(chatInput != ''){
		$.ajax({
			type: "GET",
			url: "submit.php?chatClass="+window.chatClassSending,
			data: {chattext: input},
			success: function(data, textStatus){  
				getChatTextFromASend();				
			}
		});
	}	  
}

function getChatTextFromASend() {
	
	if(currentChatSending==0){
		lastTimeID = 0;  
		justSent1 = true;
	}
	else{
		lastTimeID = 0;
		justSent2 = true;
	}
	
  	$.ajax({
    	type: "GET",
    	url: "refresh.php?chatClass="+window.chatClassSending,
		data: {lastTimeID: lastTimeID}
  	}).done( function(data) {	
		
		var jsonData = JSON.parse(data);
		var jsonLength = jsonData.results.length;
		var html = "";
		var result;
		for (var i = 0; i < jsonLength; i++) {
			result = jsonData.results[i];	
			html += '<div class="username" >' + '<span class="oneUsersName" onclick="clickUsername('+ result.player_id + ')" style="color: #' + result.color + '">'+ result.usrname + '</span>' +': ' +'<span class="chattext">  '+ decodeURIComponent(result.chattext) +'</span>'+ '<span class="chattime">  '+result.chattime+'</span>'+'</div>';
		}
	
		var atBot=0;
		var str = '#view_ajax'+chatClassSending;
		if($(str).scrollTop()+ $(str).innerHeight() >= $(str)[0].scrollHeight){
		atBot=1;
		}
		$(str).html(html);
	  
	  //Scrolling
		if(itWasMe ===1){
			itWasMe =0;
			scrollToBottomSending();
		}else if(atBot===1){
			scrollToBottomSending();
		}		
		if(currentChatSending==0){
			if(result!=null){
				lastTimeID1 = result.id;
			}
		}
		else{
			if(result!=null){
				lastTimeID2 = result.id;
			}
		}					
  	});	  
}

function clickUsername(id){
	location.href = "profile.php?id="+id;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////


function setActiveChatUsers(){	
	
	var users = document.getElementsByClassName('oneUsersName');
	var i=0;
	document.getElementById("chatUsers").innerHTML = "";
	var userArray = [];
	var colorArray = [];
	for (i = 0; i < users.length; i++) {
		if ( !(isInArray(users[i].innerHTML, userArray))){
    		userArray.push(users[i].innerHTML);
			colorArray.push($(users[i]).css("color"));
		}
	}		
	for (i = 0; i < userArray.length; i++) {
		document.getElementById("chatUsers").innerHTML = document.getElementById("chatUsers").innerHTML + '<span class="activeUsers" style="color: '+ colorArray[i] +'">' + userArray[i] +'</span>' + '<br>';	
	}
}

function isInArray(value, array) {
  return array.indexOf(value) > -1;
}

function scrollToBottom(){ 
    var objDiv = document.getElementById("view_ajax"+chatClass);
    objDiv.scrollTop = objDiv.scrollHeight;
}
function scrollToBottomSending(){ 
    var objDiv = document.getElementById("view_ajax"+chatClassSending);
    objDiv.scrollTop = objDiv.scrollHeight;
}
