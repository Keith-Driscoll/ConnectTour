<?php
	require_once("classes/doLoginCheck.php");
    include 'segments/header.php';
	include "segments/navigation.php";
    require_once 'classes/connections.php';
	
	$db_connection = db_connect();
	$p_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM player_reports";
	$result = $db_connection->query($sql);
?>
<div class="content" align="center">
	<h1>Unresolved Tickets</h1>
	<?php while($row = $result->fetch_assoc()){
		
		echo"
				   <tr>
	    		    	<td><h2>".$row['report_category']."</td>
						<td>".$row['player_id']."</td>
						<td>".$row['report_details']."</h2></td>
						<br>
	    		    </tr>
	    	    ";
	}
	$db_connection->close();
	?>
	
	
	
</div>


<?php 
	include 'segments/footer.php';
?>