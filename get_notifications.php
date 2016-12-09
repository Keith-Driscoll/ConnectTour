<?php
//Access Members database to output registered members on the page
	$p_id = $_GET['p_id'];
	require_once ("classes/connections.php");
	session_start();
	$db_connection = db_connect();
	$sql = "SELECT * FROM notifications WHERE p_id=".$p_id." AND is_read=0";
	$result = $db_connection->query($sql);
	$num_notifications=$result->num_rows;
	$db_connection->close();
	if($num_notifications>0){
		echo $num_notifications;
	}
	


?>