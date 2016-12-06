<?php

//added by keith
include_once("segments/header.php");
//
?>
</head>
<html>
    <?php
	    // load the login class
	    require_once("classes/Login.php");
	    $login = new Login();
	    if ($login->isUserLoggedIn() == true) {
	        include("segments/logged_in.php");
	    } else {
	        include("segments/not_logged_in.php");
	    }
	    $error = "You cannot access this page, as you do not have alpha access. Please apply for access or return to the home page";
	    echo $error;
    ?>
</html>

<?php include 'segments/footer.php'; ?>