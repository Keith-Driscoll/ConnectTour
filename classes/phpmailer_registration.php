<?php
ignore_user_abort(true);
$user_email = $_GET['user_email'];
$user_name = $_GET['user_name'];

include "PHPMailer-master/PHPMailerAutoload.php";
	$mail = new PHPMailer();

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'localhost';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'azure';                 // SMTP username
	$mail->Password = '6#vWHD_$';                           // SMTP password
	//$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	//$mail->Port = 465;                                    // TCP port to connect to

	$mail->setFrom('noreply@connecttours.com', 'ConnectTours');
	$mail->addAddress( $user_email, $user_name);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'ConnectTours - Please confirm your registration.';


	$mail->Body    = '<html>
						<head>

							<title> Thank you for signing up with ConnectTours!  </title>

						</head>
						<body>

						<p>Welcome to ConnectTours! <br/><br/>Thank you for signing up. We cannot wait for you to get started! Simply click on the link below and login to activate your account.</br>  </p>
						<p><br/><a href= "http://connecttours.azurewebsites.net/verification.php?email='.$user_email.'&hash='.$hash.'"> Click here to access your link.</a>
						<p><br/>Have fun! <br/>ConnectTours</p>

						</body>
					</html>';


	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send()) {
    	echo '<div class="alert alert-error">
				<b>Error: </b>Something went wrong in resetting your password. If this problem consists, contact support for help. </br></br><b>Reason: </b>' . $mail->ErrorInfo; '</div>';
	} else {

	}

?>