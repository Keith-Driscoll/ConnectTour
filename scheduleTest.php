<?php	
	$servername = "gglmysql.cloudapp.net";
	$username = "ggl_adam";
	$password = "skwreapm0011";
	$dbname = "ggl_main";

	// Create connection
	$db_connection = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM chat_messages WHERE username = 'admin'";
	
	$result = $db_connection->query($sql);
	
	if ($result->num_rows > 0){
		//do this 
		while ($row = $result->fetch_assoc()){
			$id = $row['id'];

			$sql = "DELETE FROM chat_messages WHERE id = $id";
			$ded = $db_connection->query($sql);
			
		}
		
	}
	$db_connection->close();	
	
?>