<?php
	include 'connections.php';

	if (isset($_POST['Email'])){
		$db_connection = db_connect();
		$sql = "SELECT * FROM alpha_signups WHERE email = '".$_POST['Email']."'";
		$result = $db_connection->query($sql);
		
		if ($result->num_rows > 0){
			$msg = "Whoops, it looks like you've already signed up for our alpha. Keep an eye on your email for updates!";
		} else {
			$msg = "Thanks for signing up! Your alpha key will be emailed out to you in the coming weeks.
					<b>Keep an eye out for further details and information! </b>.";
			
			$sql = "INSERT INTO alpha_signups (email) VALUES ('".$_POST['Email']."')";
			$result = $db_connection->query($sql);
			if (!$result){
				$msg = "Something went wrong. Please refresh and try again.";
			}
		}	
	} else {
		$msg = "FAIL";
	}

	echo $msg;
?>