<?php
	function db_connect(){
		//server1 servername -> gglmysql.cloudapp.net (active)
		//server2 servername -> gglmysql2.cloudapp.net
		$servername = "127.0.0.1";
		$username = "azure@localhost";
		$password = "Password123";
		$dbname = "ggl_main";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if (mysqli_connect_error()) {
		    die("Connection failed: " . mysqli_connect_error());
		    exit();
		} else {
			echo "Connection successful <br>";
			return $conn;
		}
	}
?>