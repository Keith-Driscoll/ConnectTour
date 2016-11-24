var lastTimeID = 0;
var itWasMe =1;

$(document).ready(function() {
  $('#sendBtn2').click( function() {
    sendChatText();
    $('#chatInput2').val("");
  });	
  startChat();
});

function keyPress(e){
  if(e.keyCode === 13){
      sendChatText();
      $('#chatInput2').val("");
  }
  return false;
}

function scrollToBottom(){ 
    var objDiv = document.getElementById("view_ajax");
    objDiv.scrollTop = objDiv.scrollHeight;
}

function startChat(){	
  setInterval( function() { getChatText(); }, 2000);
}

function getChatText() {
	
  	$.ajax({
    	type: "GET",
    	url: "refresh.php",
		data: {lastTimeID: lastTimeID}
  	}).done( function( data ) {
    	var jsonData = JSON.parse(data);
    	var jsonLength = jsonData.results.length;
    	var html = "";
    	for (var i = 0; i < jsonLength; i++) {
    		var result = jsonData.results[i];
    		html += '<div class="username" style="color:' + result.color + '">' + result.usrname +': ' +'<span class="chattext">  '+ result.chattext +'</span>'+ '<span class="chattime">  '+result.chattime+'</span>'+'</div>';
			lastTimeID = result.id;
    	}
      
      var atBot=0;
      if($('#view_ajax').scrollTop()+ $('#view_ajax').innerHeight() >= $('#view_ajax')[0].scrollHeight){
        atBot=1;
      }
    	$('#view_ajax').append(html);
      if(itWasMe ===1){
        itWasMe =0;
        scrollToBottom();
      }else if(atBot===1){
        scrollToBottom();
      }
      
  	});
}

function sendChatText(){
  itWasMe = 1;
  var chatInput2 = $('#chatInput2').val();
  var input = encodeURIComponent(chatInput2);
  if(chatInput2 != ""){
    	$.ajax({
    	  type: "GET",
    	  url: "/submit.php",
		  data: {chattext: input}
    	});
  }
  getChatText();
}