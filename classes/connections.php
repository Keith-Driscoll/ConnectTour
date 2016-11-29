<?php
	function db_connect(){
		$servername = "eu-cdbr-azure-west-a.cloudapp.net";
		$username = "be4333e100072e";
		$password = "2cb22472";
		$dbname = "ggl_main";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if (mysqli_connect_error()) {
		    die("Connection failed: " . mysqli_connect_error());
		    //exit();
		} else {
			echo "Connection successful <br>";
			return $conn;
		}
	}
?>