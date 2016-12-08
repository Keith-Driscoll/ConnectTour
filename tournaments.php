<?php 
	include "segments/header.php";
	require_once "classes/connections.php"; 
	if (isset($_GET['game'])){
		$game = $_GET['game'];	
	}
	$sql = "SELECT * FROM tours";
	$db_connection = db_connect();
	$result = $db_connection->query($sql);
	
	$pageNumber= 1;
?>
<link href="css/tournaments.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include "segments/navigation.php"; ?>

<!-- content section -->
<section id="content">
	<!-- container -->
	<div class="container filtersAndList">
		<row centered>
			
			<?php
				include 'tournaments/filter.php';
            ?>
			
			<!-- tour list -->
			<column class="bothColumns" cols="10">
				<!--Desktop Version Start-->
				<div class="tournamentContainer xs-hidden">			
					<div class="tournamentsList">
						<div class="oneTournament tournamentListHeader">
										<row>
											<column cols="4"><div class="width-12 giveMinWidth">Name</div></column>
											<column cols="1"><div class="width-12 giveMinWidth">Price</div></column>
											<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">Region</div></column>
											<column cols="2"><div class="width-12 giveMinWidth">Participants</div></column>
											<column cols="3"><div class="width-12 giveMinWidth">Start date/time</div></column>											
										</row>						
						</div>			
                        <!-- PHP query loops through database and outputs data -->
						<div class="dataFillUp">		
							
						</div>
						</div>	
					<div class="bottomNavigator">
						<row centered>			
							<ul class="pagination" centered>
								<li centered><a href="javascript:firstPage()" id="firstPage" href="#">|&larr;</a></li>
								<li centered><a href="javascript:prevPage()" id="prevPage" href="#">&larr;</a></li>
								<li centered><span id="currentPage"></span> of <span id="totalPages"></span></li>
								<li centered><a href="javascript:nextPage()" id="nextPage" href="#">&rarr;</a></li>
								<li centered><a href="javascript:lastPage()" id="lastPage" href="#">&rarr;|</a></li>
							</ul>
						</row>
					</div>	
				</div>	
				<!--Desktop Version End -->
				
				<!--Mobile Version Start -->
				<div class="sm-hidden-up blockCoverage">
					<div class="mobileDataFillUp">
						
					</div>
					<div class="bottomNavigatorM">	
						<div class="myPagination">							
								<a href="javascript:firstPage()" id="firstPageM" > <div class="colorChange mobilePagination">|&larr;</div></a>
								<a href="javascript:prevPage()" id="prevPageM"><div class="colorChange mobilePagination">&larr;</div></a>
								<div class="mobilePagination1" id="currentPageM"></div>
								<div class="mobilePagination1">of</div>
								<div class="mobilePagination1" id="totalPagesM"></div>
								<a href="javascript:nextPage()" id="nextPageM"><div class="colorChange mobilePagination" centered>&rarr;</div></a>
								<a href="javascript:lastPage()" id="lastPageM"><div class="colorChange mobilePagination" centered>&rarr;|</div></a>
						</div>
					</div>	
				</div>
				<!--Mobile Version End -->
				
			</column> <!-- ./tour list end -->
		</row><!-- ./row end -->
	</div>	<!-- ./ container end -->
</section><!-- content end -->
<?php include 'segments/footer.php'; ?>
</body>
</html>