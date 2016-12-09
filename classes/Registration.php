<?php
    /**
     *
     *
     * @var object $db_connection The database connection
     */
    $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    $messages = array();
	if (empty($_POST['user_name'])) {
		$errors[] = "Empty Username";
	} elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
		$errors[] = "Empty Password";
	} elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
		$errors[] = "Password and password repeat are not the same";
	} elseif (strlen($_POST['user_password_new']) < 6) {
		$errors[] = "Password has a minimum length of 6 characters";
	} elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
		$errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
	} elseif (!preg_match('/^[a-z\d_-]{2,64}$/i', $_POST['user_name'])) {
		$errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
	} elseif (empty($_POST['user_email'])) {
		$errors[] = "Email cannot be empty";
	} elseif (strlen($_POST['user_email']) > 64) {
		$errors[] = "Email cannot be longer than 64 characters";
	} elseif (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Your email address is not in a valid email format";
	} elseif (!empty($_POST['user_name'])
		&& strlen($_POST['user_name']) <= 64
		&& strlen($_POST['user_name']) >= 2
		&& preg_match('/^[a-z\d_-]{2,64}$/i', $_POST['user_name'])
		&& !empty($_POST['user_email'])
		&& strlen($_POST['user_email']) <= 64
		&& filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)
		&& !empty($_POST['user_password_new'])
		&& !empty($_POST['user_password_repeat'])
		&& ($_POST['user_password_new'] === $_POST['user_password_repeat'])
	) {
		// create a database connection
		$db_connection = new mysqli("127.0.0.1:49354", "azure", "6#vWHD_$", "connecttour_db");
		// change character set to utf8 and check it
		if (!($db_connection->set_charset("utf8_general_ci"))) {
			$errors[] = $db_connection->error;
		}
		// if no connection $errors (= working database connection)
		if (!$db_connection->connect_errno) {
		// 	echo '<script>console.log("4");</script>';
		// 	// escaping, additionally removing everything that could be (html/javascript-) code
			$user_name = $db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
			$user_email = $db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));
			$user_password = $_POST['user_password_new'];
			$hash = password_hash($user_email, PASSWORD_DEFAULT);

			// crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
			// hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
			// PHP 5.3/5.4, by the password hashing compatibility library
			$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);
			// check if user or email address already exists
			$sql = "SELECT * FROM player WHERE player_username = '".$user_name."' OR player_email = '".$user_email."'";
			$query_check_user_name = $db_connection->query($sql);
			if ($query_check_user_name->num_rows > 0) {
				$nameOrEmail = $query_check_user_name->fetch_assoc();
				if($nameOrEmail['player_username']==$user_name){
					echo "Sorry, that username is already taken.";
				}
				else{
					echo "Sorry, that email address is already taken.";
				}
				$errors[] = "Sorry, that username / email address is already taken.";
			}
		 	else {
				// write new user's data into database
				$sql = "INSERT INTO player (player_username, player_pass, player_email, verification_hash)
						VALUES('".$user_name."', '".$user_password_hash."', '".$user_email."', '".$hash."')";
				$query_new_user_insert = $db_connection->query($sql);

				$stmt = $db_connection->prepare("INSERT INTO player (player_username, player_pass, player_email, verification_hash)
						VALUES(?,?,?,?)");
				$stmt->bind_param("ssss",$user_name,$user_password_hash,$user_email,$hash);
				$stmt->execute();
				$stmt->close();
				// log people in after they register
				include 'Login.php';
				$_POST['login']=1;
				$_POST['user_password']=$_POST['user_password_new'];
				$login = new Login();
				// echo '<script>console.log("8");</script>';
				echo "success";
			}
		} else {
			echo "error1";
			$errors[] = "Sorry, no database connection.";
		}
	} else {
		echo "error2";
		$errors[] = "An unknown error occurred.";
	}
	//uncommenting breaks it for some reason
	//mysqli_close($db_connection);

?>
