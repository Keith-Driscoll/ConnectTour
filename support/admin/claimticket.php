<?php 
	 include '../../classes/connections.php';
	 $db_connection = db_connect();
?>
<?php
	
	if (isset($_POST['support_id']) && isset($_POST['ticket_id'])){
	 	$sql = "UPDATE tickets SET support_assigned = ".$_POST['support_id']." WHERE ticket_id = ".$_POST['ticket_id'];
	 	$db_connection->query($sql);
	}
	echo $sql;
?>