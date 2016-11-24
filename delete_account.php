<?php 
	
	include "classes/connections.php";
	require_once("classes/Login.php");
	include "classes/doLoginCheck.php";
	

	$db_connection = db_connect();

	
	$user_email = $_SESSION['user_email'];
	$user_name = $_SESSION['user_name'];
	
	$sql = "DELETE FROM player WHERE player_username = '".$user_name."' ";    
	$result = $db_connection->query($sql);

	$sendpassword = "Your account has been succesfully deleted. <br/>
	We are sad to see you :(";

	$error = "Something went wrong in deleting your account. Contact support for help.";
	
	if($result)
	{
		echo $sendpassword;
	}
	else
	{
		echo $error;
	}
	


?>


<?php include "segments/footer.php"; ?>	