
<?php
	include '/../classes/connections.php';
	$db_connection = db_connect();
	if (isset($_GET['followeeID'])){
		$followeeID = $_GET['followeeID'];
		$sql = "INSERT INTO followers (followee, follower) VALUES ('".$followee_id."', '".$_SESSION['user_id']."')";
		$result = $db_connection->query($sql);
		if (!$result){
			mysqli_error($db_connection);
		}
	}
?>