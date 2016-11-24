<?php
require("classes/PHPMailer-master/PHPMailerAutoload.php");

	$mail = new PHPMailer();

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'n1plcpnl0038.prod.ams1.secureserver.net';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'noreply@ggleagues.com';                 // SMTP username
	$mail->Password = 'Skwreapm0011';                           // SMTP password
	//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	//$mail->Port = 465;                                    // TCP port to connect to

	$mail->setFrom('noreply@ggleagues.com', 'GGLeagues');
	$mail->addAddress( $user_email, $user_name);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'GGLeagues - Reset your password.';


	$mail->Body    = '<html>
						<head>
			
							<title> Reset your password.  </title>
			
						</head>
						<body>
			
						<p>Dear '.$user_name.' <br/>We have a recieved a request to reset your password.
						</br> Please click on the link below to continue with your request. </p>
						<p><br/><a href= "http://www.ggleagues.com/password_resetting_code.php?email='.$user_email.'&hash='.$hash.'"> Click here to access your link.</a> 
						<p><br/>Game hard! 
						<br/>GGLeagues</p>
			
						</body>
					</html>';


	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
    	echo '<div class="alert alert-error">
				<b>Error: </b>Something went wrong in resetting your password. If this problem consists, contact support for help. </br></br><b>Reason: </b>' . $mail->ErrorInfo; '</div>';
	} else {
	    echo '<div class="alert alert-success">A password reset email has been sent to the email address associated with this account. <br/><br/>
		Please follow the instructions in this email to reset your account.</div>';
	}

?>