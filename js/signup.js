$(function() {
	'use strict';
    // Signup form
    $('#register-form').validate({
        rules: {
            user_name: {
                required: true,
                minlength: 4
            },
            user_email: {
                required: true,
                email: true
            },
			user_password_new: {
				required: true,
				minlength: 6
			},
			user_password_repeat: {
				required: true,
				minlength: 6,
				equalTo : "#user_password_new"
			}
        },
        messages: {
            user_name: {
                required: "Please enter your username",
                minlength: "Your username must consist of at least 4 characters"
            },
            user_email: {
                required: "Please enter your email address"
            },
            user_password_new: {
                required: "Please enter your password",
                minlength: "Your password must consist of at least 6 characters"
            },
            user_password_repeat: {
                required: "Please re-enter your password",
                minlength: "Your password must consist of at least 6 characters",
				equalTo: "Passwords must match"
            }
        },
        submitHandler: function(form) {
			console.log("asdf");
            $(form).ajaxSubmit({
                type:"POST",
                data: $(form).serialize(),
                url:"classes/Registration.php",
                success: function(data) {
					console.log(data);
					console.log($("#user_name").val());
					console.log($("#user_email").val());
					if (data == "success"){					
						//sendMail($("#user_name").val(),$("#user_email").val());
						location.href = "index.php";
					} else {
						$('#error_text').html(data);
						$('#register-form').fadeOut( "fast",function() {
                      		$('#error').fadeIn();
                  		});
					}
                },
                error: function(data) {
					$('#error_text').html(data);
                    $('#register-form').fadeOut( "fast",function() {
                        $('#error').fadeIn();
                    });
                }
            });
        }
    });
	

	
	// Login form
    $('#login-form').validate({
        rules: {
            user_name: {
                required: true,
            },
			user_password: {
				required: true,
				minlength: 6
			}
        },
        messages: {
            user_password: {
                required: "Please enter your password",
                minlength: "Your password must consist of at least 6 characters"
            },
            user_name: {
                required: "Please enter your email address/username"
            }
        },
       /*  submitHandler: function(form) {
            $(form).ajaxSubmit({
                type:"GET",
                data: $(form).serialize(),
                url:"login.php",
                success: function() {
                    $('#login-form :input').attr('disabled', 'disabled');
                    $('#login-form').fadeTo( "slow", 0.15, function() {
                        $(this).find(':input').attr('disabled', 'disabled');
                        $(this).find('label').css('cursor','default');
                        $('#success').fadeIn();
						// Handler for page redirect
						window.setTimeout(function () {
							location.href = "profile.php";
						}, 3000);// 3 second delay until page redirect
                    });
                },
                error: function() {
                    $('#login-form').fadeTo( "slow", 0.15, function() {
                        $('#error').fadeIn();
                    });
                }
            });
        } */
    });
	
	// Subscription form
   	$('#subscribe').validate({
        rules: {
            subscribe_email: {
                required: true,
                email: true
            } 
        },
        messages: {
            subscribe_email: {
                required: "Please enter your email address"
            } 
        },
        submitHandler: function(form) {
			var email = document.forms['subscribe'].elements['email'].value;;
            $(form).ajax({
                type:"POST",
                data: {email: email},
                url:"../classes/alpha_signups.php",
                success: function(msg) {
					window.alert(msg);
                    $('#subscribe :input').attr('disabled', 'disabled');
                    $('#subscribe').fadeTo( "slow", 0.15, function() {
                        $(this).find(':input').attr('disabled', 'disabled');
                        $(this).find('label').css('cursor','default');
                        $('#success').fadeIn();
						
						
						// Handler for page redirect
						/*window.setTimeout(function () {
							location.href = "signup.php";
						}, 3000); // 3 second delay until page redirect*/
                    });
                },
                error: function() {
                    $('#subscribe').fadeTo( "slow", 0.15, function() {
                        $('#error').fadeIn();
                    });
                }
            });
        }
    });

});

function retryForm(){
		$('#error').fadeOut( "fast",function() {
			$('#register-form').fadeIn();
		});
}	

// function sendMail(user_name,user_email){
//             $.ajax({
//                 type: "POST",
//                 url: "phpmailer_registration.php",
//                 data: {user_name:user_name,user_email:user_email}				    
//             });
// }

