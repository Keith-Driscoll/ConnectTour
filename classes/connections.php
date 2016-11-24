<?php
	function db_connect(){
		//server1 servername -> gglmysql.cloudapp.net (active)
		//server2 servername -> gglmysql2.cloudapp.net
		$servername = "127.0.0.1";
		$username = "x14346081";
		$password = "";
		$dbname = "c9";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if (mysqli_connect_error()) {
		    //die("Connection failed: " . mysqli_connect_error());
		    exit();
		} else {
			//echo "Connection successful <br>";
			return $conn;
		}
	}
?>