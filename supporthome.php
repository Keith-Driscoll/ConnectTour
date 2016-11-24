<?php
	require_once 'classes/connections.php';
	include 'segments/header.php';
	include 'segments/navigation.php';
	$db_connection = db_connect();
	
	$sql = "SELECT * FROM support_staff WHERE p_id = ".$_SESSION['user_id'];
	$is_admin = $db_connection->query($sql);
	if ($is_admin->num_rows == 0){
		header("Location: nopermission.php");
		exit;
	}
?>
<link href="css/tournaments.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!-- content section -->
<section id="content">
	<!-- container -->
	<div class="container filtersAndList">
		<h1>>| My Tickets </h1>
		<row centered>
			
			<?php
				include 'support/admin/myTickets.php';
			?>
			<!-- tournament list -->
			<column class="bothColumns" cols="9">
				<!--Desktop Version Start-->
				<div class="tournamentContainer xs-hidden">			
					<div class="tournamentsList">
						<div class="oneTournament tournamentListHeader">
							<row>
								<column cols="1"><div class="width-12 giveMinWidth">Priority</div></column>
								<column cols="2"><div class="width-12 giveMinWidth">Category</div></column>
								<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">Status</div></column>
								<column cols="3"><div class="width-12 giveMinWidth">Date Submitted</div></column>
								<column cols="3"><div class="width-12 giveMinWidth">Submitted By</div></column>											
							</row>						
						</div>			
						<div class="dataFillUp1">		
							
						</div>
						</div>	
					<div class="bottomNavigator">
						<row centered>			
							<ul class="pagination" centered>
								<li centered><a href="javascript:firstPage(1)" id="firstPage1" href="#">|&larr;</a></li>
								<li centered><a href="javascript:prevPage(1)" id="prevPage1" href="#">&larr;</a></li>
								<li centered><span id="currentPage"></span> of <span id="totalPages"></span></li>
								<li centered><a href="javascript:nextPage(1)" id="nextPage1" href="#">&rarr;</a></li>
								<li centered><a href="javascript:lastPage(1)" id="lastPage1" href="#">&rarr;|</a></li>
							</ul>
						</row>
					</div>	
				</div>	
				<!--Desktop Version End -->
				</column> <!-- ./tournaments list end -->
		</row><!-- ./row end -->
	</div>	<!-- ./ container end -->
	
	<!-- container -->
	<div class="container filtersAndList">
		<h1>>| All Tickets</h1>
		<row centered>
			<?php
				//include 'support/filter.php';
			?>
			<!-- tournament list -->
			<column class="bothColumns" cols="9">
				<!--Desktop Version Start-->
				<div class="tournamentContainer xs-hidden">			
					<div class="tournamentsList">
						<div class="oneTournament tournamentListHeader">
							<row>
								<column cols="1"><div class="width-12 giveMinWidth">Priority</div></column>
								<column cols="2"><div class="width-12 giveMinWidth">Category</div></column>
								<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">Status</div></column>
								<column cols="3"><div class="width-12 giveMinWidth">Date Submitted</div></column>
								<column cols="3"><div class="width-12 giveMinWidth">Last Reply</div></column>
								<column cols="2"><div class="width-12 giveMinWidth"></div></column>											
							</row>						
						</div>			
						<div class="dataFillUp2">		
							
						</div>
						</div>	
					<div class="bottomNavigator">
						<row centered>			
							<ul class="pagination" centered>
								<li centered><a href="javascript:firstPage(2)" id="firstPage2" href="#">|&larr;</a></li>
								<li centered><a href="javascript:prevPage(2)" id="prevPage2" href="#">&larr;</a></li>
								<li centered><span id="currentPage"></span> of <span id="totalPages2"></span></li>
								<li centered><a href="javascript:nextPage(2)" id="nextPage2" href="#">&rarr;</a></li>
								<li centered><a href="javascript:lastPage(2)" id="lastPage2" href="#">&rarr;|</a></li>
							</ul>
						</row>
					</div>	
				</div>	
				<!--Desktop Version End -->
				</column> <!-- ./tournaments list end -->
		</row><!-- ./row end -->
	</div>	<!-- ./ container end -->
</section><!-- content end -->
<?php include 'segments/footer.php';