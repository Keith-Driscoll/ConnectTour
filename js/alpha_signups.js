
function checkKey(){	
	if(event.keyCode == 13){
        alpha_signup();
    }	
}

function alpha_signup(){
	
	var email = document.forms['subscribe'].elements['email'].value;
	$.ajax({
		type: "POST",
		dataType: "text",
		url: "../classes/alpha_signups.php",
		data: {Email: email},
		success: function(message){
			console.log(message);
			$('#subscribe :input').attr('disabled', 'disabled');
			$('#subscribe').fadeTo( "slow", 0.15, function() {
				document.getElementById("success").innerHTML = message;
				$(this).find(':input').attr('disabled', 'disabled');
				$(this).find('label').css('cursor','default');
				$('#success').fadeIn();
			});
		},
		error: function(message){
			console.log("fail" + message);
			$('#subscribe').fadeTo( "slow", 0, function() {
				document.getElementById("error").innerHTML = message;
				$('#error').fadeIn();
			});
		}
	})
	
	return false;
};