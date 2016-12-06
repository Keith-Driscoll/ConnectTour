<?php
	// load the login class
	require_once 'classes/Login.php';
	//checks if player is logged in and displays navbar accordingly
	$login = new Login();
	if ($login->isUserLoggedIn() == true) {
		include 'segments/logged_in.php';
	} else {
	    include 'segments/not_logged_in.php';
	    //header("Location: permissions.php");
	}
?>