<?php
require_once("classes/doLoginCheck.php");
    include 'segments/header.php';
	include "segments/navigation.php";
    require_once 'classes/connections.php';
	
	$db_connection = db_connect();
	$t_id=$_GET['id'];
	echo $t_id;
	$sql="SELECT * FROM player_reports WHERE id='$t_id'";
	$res=$db_connection->query($sql);
	while($row = $res->fetch_assoc()){
		echo"
				   <tr>
	    		    	<td><h2>".$row['report_category']."</td>
						<td>".$row['player_id']."</td>
						<td>".$row['report_details']."</h2></td>
						<br>
	    		    </tr>
	    	    ";
	}
?>




<?php 
	include 'segments/footer.php';
?>