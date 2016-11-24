<?php 
	include 'segments/header.php';
	include 'segments/navigation.php';
	include 'classes/connections.php';
	$db_connection = db_connect();
?>
<style>
	.form{
		padding:100px;
	}
</style>
<div class="form">
	<form method="get">
	<input type="text" name="username" placeholder="Username">
	<br>
	<button name="submit" value="Submit">Submit</button>
	</form>
</div>

<?
if(isset($_GET['submit'])){
		$name = $_GET['username'];
		$sql = "SELECT * FROM player WHERE player_username LIKE '%".$name."%'";
		$result = $db_connection->query($sql);
		if($result->num_rows>0){
			echo "<h2>Results</h2>";
		}
		else echo "<h2>No results found</h2>";
		while($row = $result->fetch_assoc()){
			echo 
			"<a href=profile.php?id=".$row['id']."><p>".$row['player_username']."</p></a>
			<br>";
		}
	}
?>
<?php include 'segments/footer.php' ?>