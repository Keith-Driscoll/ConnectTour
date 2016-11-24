<?php 
// prints the last error
	mysqli_errno();
	// load the login class
	include "classes/connections.php";
	require_once("classes/Login.php");
	$login = new Login();
	if ($login->isUserLoggedIn() == true) {
		include("segments/logged_in.php");
	} else {
		include("segments/not_logged_in.php");
	}
	function displayLoginBox($e, $h){
		echo "
			<form method='post' action='".$_SERVER['PHP_SELF']."?email=".$e."&hash=".$h."'>
				<label>Enter New Password</label><br/>	
				<input type='password' id='' name='user_password_new' required=''/><br/>
				<label>Confirm New Password</label><br/>
				<input type='password' id='' name='user_password_repeat' required=''/><br/>
				<input type='submit' name='submit' value='Submit'/><br/>
			</form>
		";
	}
	if (!isset($_POST['submit'])){
		$email = ($_GET['email']);
		$hash = ($_GET['hash']);
		displayLoginBox($email, $hash);
	} else {
		$db_connection = db_connect();
		if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])){
			$email = ($_GET['email']);
			$hash = ($_GET['hash']);
			$sql = "SELECT player_email, password_reset_hash, player_pass FROM player WHERE player_email = '".$email."' AND password_reset_hash = '".$hash."'";
			$result = $db_connection->query($sql);
			if($result->num_rows == 1){
				$row = $result->fetch_assoc();
				if (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
					echo "Empty Password <br/>";
					displayLoginBox($email, $hash);
				} elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
					echo "Errorm, your passwords don't match. Pls fixerino.<br/>";
					displayLoginBox($email, $hash);
				} elseif (strlen($_POST['user_password_new']) < 6) {
					echo "Error: password must have a minimum length of 6 characters. <br/>";
					displayLoginBox($email, $hash);
				} elseif (password_verify($_POST['user_password_new'], $row['player_pass'])){
					echo "New password must be different from the old one. <br/>";
					displayLoginBox($email, $hash);
				} elseif (!empty($_POST['user_password_new']) 
					&& !empty($_POST['user_password_repeat']) 
					&& ($_POST['user_password_new'] === $_POST['user_password_repeat'])
					&& (!password_verify($_POST['user_password_new'], $row['player_pass']))
					){
					$user_password_hash = password_hash($_POST['user_password_new'], PASSWORD_DEFAULT);
					$sql = "UPDATE player SET player_pass = '".$user_password_hash."', password_reset_hash = NULL WHERE player_email = '".$email."' ";
					$result = $db_connection->query($sql);
					if ($result){
						echo "Your password has been successfully changed. <br/>";
					} else {
						echo "An error occured in changing your password. Please try again, and contact support if the problem persists.<br/>";
						displayLoginBox($email, $hash);
					}
				} else{
					echo "If you see this, there is a serious problem. Please contact support immediately.<br/>";
				} 
			} else {
				echo "An error occured in changing your password. Please try again, and contact support if the problem persists.<br/>";
			} 	
		} else{
			echo "There is an error in your url. Please request a new reset email. <br/>";
		}	
	}	
?>
<?php include "segments/footer.php"; ?>
