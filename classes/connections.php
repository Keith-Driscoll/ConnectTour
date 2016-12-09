<?php
	function db_connect(){
		$servername = "127.0.0.1:49354";
        $username = "azure";
        $password = "6#vWHD_$";
        $dbname = "connecttour_db";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if (mysqli_connect_error()) {
		    die("Connection failed: " . mysqli_connect_error());
		    //exit();
		} else {
			//echo "Connection successful <br>";
			return $conn;
		}
	}
?>