<?php 
	include "segments/header.php"; 
?>
	<link rel="stylesheet" href="css/pages/signup.css"/>
	</head>
	<body>
	<?php include "segments/navigation.php"; ?>
	<?php 
	// prints the last error
	mysqli_errno();
	// load the login class
	include "classes/connections.php";
	require_once("classes/Login.php");
	

	$db_connection = db_connect();

	
	$user_email = $_SESSION['user_email'];
	$user_name = $_SESSION['user_name'];
	
	$hash = password_hash($user_name, PASSWORD_DEFAULT);
	$sql = "UPDATE player SET password_reset_hash = '".$hash."' WHERE player_email = '".$user_email."' ";    
	$result = $db_connection->query($sql);

	$sendpassword = "A password reset email has been sent to the email address associated with this account.
		Please follow the instructions in this email to reset your account.";

	$error = '<div class="alert alert-error">Something went wrong in resetting your password. Contact support for help</div>';
	
?>
<!-- Password Reset Body -->
<section id="content">
	<!-- container -->
	<row centered class="container" id="dialog">
		<!-- message body-->
		<column cols="12" class="dialog" >
		<h3>Password Reset</h3>
		 	<p>
			 <?php 
			 
			 if($result){
					include "phpmailer_password_reset.php";
				}
				else{
					echo $error;
				}
				
			?>
	</p>
		</column><!-- ./message body end -->
	</row><!-- ./container end -->
</section><!-- ./password reset end -->





<!-- Includes footer section of webpage -->
<?php include "segments/footer.php"; ?>	
</body>
</html>