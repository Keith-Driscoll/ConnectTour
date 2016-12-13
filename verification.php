<?php include "segments/header.php" ?>
<link rel="stylesheet" href="css/pages/signup.css"/>
</head>
<body>
<?php 
	// prints the last error
	mysqli_errno();
	// load the login class
	include "classes/connections.php";
	include 'segments/navigation.php';
	require_once("classes/Login.php");
?>
<!-- Email Verification Body -->
<section id="content">
	<!-- container -->
	<row centered class="container" id="dialog">
		<!-- message body-->
		<column cols="12" class="dialog" >
		<h3>Account Verification</h3>
		 	<p>
			 <?php 
			 
			 	$db_connection = db_connect();


	if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])){

		$email = ($_GET['email']);
		$hash = ($_GET['hash']);
		

		$sql = "SELECT player_email, verification_hash, is_verified FROM player WHERE player_email = '".$email."' AND verification_hash = '".$hash."'";
	
		$result = $db_connection->query($sql);
		
		if ($result->num_rows == 1){
			$entry = $result->fetch_assoc();
			
			if ($entry['is_verified'] == 0){
				$sql = "UPDATE player SET is_verified = 1, verification_hash = NULL WHERE player_email = '".$email."' "; 
				$db_connection->query($sql);
				echo'<div class="alert alert-success">Your account has been successfully verified!</div>';
			
			} else {
				echo'<div class="alert alert-warning">It appears that you are already registered and do not need to verify your account again.</div>';	
			}
		
		} else {
			echo'<div class="alert alert-error">It appears that something has gone wrong. Please request a new verification email or contact support for further help.</div>';
		
		}
	} else {
		
		echo '<div class="alert alert-error">It appears that something has gone wrong. Please request a new verification email or contact support for further help.</div>' ;
	}
				
			?>
	</p>
		</column><!-- ./message body end -->
	</row><!-- ./container end -->
</section><!-- ./email verification end -->






<!-- Includes footer section of webpage -->
<?php include "segments/footer.php"; ?>	
</body>
</html>