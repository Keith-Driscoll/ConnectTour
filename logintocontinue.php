<?php 
	require_once("classes/Login.php");
    //checks if a player is logged in, and displays navbar accordingly
    $login = new Login();
    if ($login->isUserLoggedIn() == true) {
        include("segments/logged_in.php");
    } else {
        include("segments/not_logged_in.php");
    }
?>

<p>Please Login to continue</p>

<?php include "segments/footer.php"; ?>