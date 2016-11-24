<?php
	session_start();
  	require_once( "chatClass.php" );
	require_once("classes/connections.php");
	
	$id = intval( $_GET[ 'lastTimeID' ] );
	$chatID = $_GET['chatClass'];
  	$jsonData = chatClass::getRestChatLines( $id, $chatID );
  	print $jsonData;
?>