<?php
	require_once("classes/doLoginCheck.php");
    include 'segments/header.php';
	include "segments/navigation.php";
    require_once 'classes/connections.php';
	
	$db_connection = db_connect();
	$p_id = $_SESSION['user_id'];
	echo $p_id;
	if(!isset($_POST["submit"])){
		echo "HERE";
	}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div align="center" >
<h1>Create new Ticket</h1>
<h2>Enter in your issue and we will deal with the ticket as soon as possible</h2>
<select id="issue" align="left">
	<option value="Issue 1">Issue 1</option>
	<option value="Issue 2">Issue 2</option>
	<option value="Issue 3">Issue 3</option>
	<option value="Issue 4">Issue 4</option>
</select>
<br>
<form method="post">
<textarea id="description" placeholder="Description of issue"name="description"></textarea>
<br>
<input type="submit" value="Upload Ticket" name="submit" id="submit">
</form>
	
	
	
</div>

<?php if(!empty($_POST)){
		echo "123456";
		$desc= htmlspecialchars($_POST['description']);
		$sql = "INSERT INTO player_reports (player_id,report_category,report_details,admin_id,report_status) VALUES (2,'test2','$desc',1,0)";
		$db_connection->query($sql);
		echo "<p>YOUR TICKET HAS BEEN SUBMITTED</p>";
		echo $desc;
	}
?>
<?php 
	include 'segments/footer.php';
?>