<?php
	session_start();
  	require_once("chatClass.php" );
  	$chattext = htmlspecialchars_decode( $_GET['chattext'] );
	$chatID = $_GET['chatClass'];
  	chatClass::setChatLines( $chattext, $_SESSION['user_name'], $_SESSION['colour'], $chatID);
?>
