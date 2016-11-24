<?php

	session_start();

	if($_SESSION['views'] > 1){
		session_start();
		$_SESSION['views'] = 0;
	}
	else{
	$_SESSION['views'] = $_SESSION['views'] + 1;	
	}
?>	