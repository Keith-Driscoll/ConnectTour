<?php
	function db_connect(){
		$servername = "127.0.0.1:49354";
        $username = "azure";
        $password = "6#vWHD_$";
        $dbname = "ggl_main";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if (mysqli_connect_error()) {
		    die("Connection has failed: " . mysqli_connect_error());
		    //exit();
		} else {
			//echo "Connection successful <br>";
			return $conn; 
		}
	}
?>