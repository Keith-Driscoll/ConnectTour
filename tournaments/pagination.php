<?php 
include "segments/header.php";
require_once "classes/connections.php"; 
if (isset($_GET['game'])){
    $game = $_GET['game'];	
}
$sql = "SELECT * FROM tournaments";
$db_connection = db_connect();
$result = $db_connection->query($sql);

$pageNumber= 1;
?>
<link href="css/tournaments.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php include "segments/navigation.php"; ?>

<<<<<<< HEAD
<!-- content section -->
<section id="content">
	<!-- container -->
	<div class="container filtersAndList">
		<row centered>
=======
	function changePage(page){
		var btn_start = document.getElementById("firstPage");
		var btn_next = document.getElementById("nextPage");
		var btn_prev = document.getElementById("prevPage");
		var btn_end = document.getElementById("lastPage");
		var btn_startM = document.getElementById("firstPageM");
		var btn_nextM = document.getElementById("nextPageM");
		var btn_prevM = document.getElementById("prevPageM");
		var btn_endM = document.getElementById("lastPageM");
		// Validate page
		if(jsonData.length>0){
			if (page < 1) page = 1;
			if (page > numPages()) page = numPages();
		
			var fullString = new Array();
			var fullMobileString = new Array();
			$('#totalPages').html(numPages());
			$('#totalPagesM').html(numPages());
			for (var i = (page-1) * records_per_page; i < (page * records_per_page); i++) {
				
				var array = new Array();
				if(i < jsonData.length){
					$.each(jsonData[i], function(k , v) {				
						array.push(v);				
					});
					var date = array[7].substring(0, 10);
					var gameIconString = "../images/old/icons/png/"+array[1]+"mini.png";
					var stringPart = `<div class="oneTournament">
											<a href= "tournamentinfo.php?id=`+array[0]+`">
												<row>
													<column cols="4"><div class="width-12 giveMinWidth">`+array[2]+`</div></column>
													<column cols="2"><div class="width-12 giveMinWidth">€`+array[3]+`</div></column>
													<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">`+array[4]+`</div></column>
													<column cols="1"><div class="width-12 giveMinWidth">`+array[5]+`/`+array[6]+`</div></column>
													<column cols="3"><div class ="width-12 giveMinWidth"> `+date+` </div></column>
                                                    <column cols="1"><div class ="width-12 giveMinWidth"> `` </div></column>
												</row>
											</a>						
										</div>	`;
										
					var mobileStringPart =` <div class="tournamentBlock">
												<a href= "tournamentinfo.php?id=`+array[0]+`">
													<div class="infoBlock">							
														<div class="">`+array[2]+`</div>								
														<div class="linedividor"></div>
														<div class="">`+array[1]+`</div>
														<div class="linedividor"></div>
														<div class="">€`+array[3]+`</div>
														<div class="linedividor"></div>
														<div class=" ">`+array[4]+`</div>
														<div class="linedividor"></div>
														<div class=" ">`+array[5]+`/`+array[6]+`</div>
													</div>
												</a>	
											</div>`;
					fullMobileString.push(mobileStringPart);
					fullString.push(stringPart);
				}	
			}
			$('.dataFillUp').html(fullString);
			$('.mobileDataFillUp').html(fullMobileString);
			$('#currentPage').html(current_page);
			$('#currentPageM').html(current_page);
>>>>>>> parent of 17e5218... output date and time - Keith
			
			<?php
            include 'tournaments/filter.php';
            ?>
			
			<!-- tournament list -->
			<column class="bothColumns" cols="9">
				<!--Desktop Version Start-->
				<div class="tournamentContainer xs-hidden">			
					<div class="tournamentsList">
						<div class="oneTournament tournamentListHeader">
										<row>
											<column cols="1"></column>
											<column cols="4"><div class="width-12 giveMinWidth">Name</div></column>
											<column cols="2"><div class="width-12 giveMinWidth">Prize Pool</div></column>
											<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">Region</div></column>
											<column cols="1"><div class="width-12 giveMinWidth">Players</div></column>
											<column cols="3"><div class="width-12 giveMinWidth">Start date</div></column>											
										</row>						
						</div>			
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
				
			</column> <!-- ./tournaments list end -->
		</row><!-- ./row end -->
	</div>	<!-- ./ container end -->
</section><!-- content end -->
<?php include 'segments/footer.php'; ?>
</body>
</html>