<?php
	// load the login class
	require_once 'classes/Login.php';
	//checks if player is logged in and displays navbar accordingly
	$login = new Login();
	if ($login->isUserLoggedIn() == true) {
		include 'segments/logged_in.php';
	    include 'segments/not_logged_in.php';
	} else {
	    include 'segments/not_logged_in.php';
<<<<<<< HEAD
	    header("Location: permissions.php");
	    exit;
	}	
=======
	    //header("Location: permissions.php");
	    exit;
	}
>>>>>>> fd0e3d1badb618c582eeadcdb3a51c529a196dc7
?>