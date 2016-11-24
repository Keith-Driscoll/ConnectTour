<?php
	require_once 'classes/connections.php';
	require_once 'segments/navigation.php';
	require_once 'segments/header.php';
	require_once 'disputes/pagination.php';
	session_start();
	$db_connection = db_connect();
	$p_id = $_SESSION['user_id'];
	if ($p_id!=9){
		header("Location: nopermission.php");
		exit;
	}
?>
<link href="css/ticket.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<div class="panel tickets">
	<div class="container">
	<?php
			include 'disputes/mydisputes.php';
		?>
	<row centered class="ticket-head">
					<column cols="4">Match</column>
					<column cols="3">Game Number</column>	
					<column cols="1" class="sm-hidden">Status</column>
					<column cols="4">Date Submitted</column>
	</row><!-- Ticket Header End -->
	
	<row centered>	
				<div class="dataFillUp">		
				</div><!-- ./Fillup End -->
	</row>

			<!-- Pagination start -->
	<row centered>			
				<ul class="pagination" centered>
					<li centered><a href="javascript:firstPage()" id="firstPage" href="#">|&larr;</a></li>
					<li centered><a href="javascript:prevPage()" id="prevPage" href="#">&larr;</a></li>
					<li centered><span id="currentPage"></span> of <span id="totalPages"></span></li>
					<li centered><a href="javascript:nextPage()" id="nextPage" href="#">&rarr;</a></li>
					<li centered><a href="javascript:lastPage()" id="lastPage" href="#">&rarr;|</a></li>
				</ul>
	</row><!-- ./Pagination end-->
</div>
</div>

<?php
	include 'segments/footer.php';
?>