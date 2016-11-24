<?php
	include 'classes/connections.php';
	include 'segments/header.php';
	include 'segments/navigation.php';
	$db_connection = db_connect();
	$t_id = $_GET['t_id'];

	// $sql = "SELECT p_id, wins, draws, losses, points, games_played, p_id 
	// 		FROM league_participants
	// 		WHERE league_id = ".$t_id;
	$sql = "SELECT player.player_username, league_participants.wins, league_participants.draws, league_participants.losses, 
					league_participants.points, league_participants.games_played, league_participants.p_id
	FROM league_participants JOIN player ON player.id = league_participants.p_id
	WHERE league_participants.league_id = $t_id ORDER BY points DESC";

	$result = $db_connection->query($sql);
	$rows = mysqli_fetch_all($result);
	$json = json_encode($rows);
?>
<link href="css/tournaments.css" rel="stylesheet"/>

<!-- content section -->
<section id="content">
	<!-- container -->
	<div class="container filtersAndList">
		<row centered>

			
			<!-- tournament list -->
			<column class="bothColumns" cols="9">
				<!--Desktop Version Start-->
				<div class="tournamentContainer xs-hidden">			
					<div class="tournamentsList">
						<div class="oneTournament tournamentListHeader">
										<row>
											<column cols="1"><div class="width-12 giveMinWidth">Place</div></column>
											<column cols="4"><div class="width-12 giveMinWidth">Name</div></column>
											<column cols="1"><div class="width-12 giveMinWidth">Wins</div></column>
											<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">Draws</div></column>
											<column cols="1"><div class="width-12 giveMinWidth">Losses</div></column>
											<column cols="1"><div class="width-12 giveMinWidth">Played</div></column>		
											<column cols="2"><div class="width-12 giveMinWidth">Points</div></column>										
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
			</column> <!-- ./tournaments list end -->
		</row><!-- ./row end -->
	</div>	<!-- ./ container end -->
</section><!-- content end -->
<?php include 'segments/footer.php'; ?>


<!-- JS SCRIPTS FOR PAGINATION -->
<script>
	$(document).ready(function(){
		changePage(1);
	});
	var jsonData = <?=$json?>;
	var current_page = 1;
	var records_per_page = 8;
	
	function firstPage(){
		current_page = 1;
		changePage(current_page);
	}	
	function prevPage() {
		if (current_page > 1) {
			current_page--;
			changePage(current_page);
		}
	}
	function nextPage(){
		if (current_page < numPages()) {
			current_page++;
			changePage(current_page);
    	}
	}
	function lastPage(){
		current_page = numPages();
		changePage(current_page);
	}

	function changePage(page){
		var btn_start = document.getElementById("firstPage");
		var btn_next = document.getElementById("nextPage");
		var btn_prev = document.getElementById("prevPage");
		var btn_end = document.getElementById("lastPage");
		// Validate page
		if(jsonData.length>0){
			if (page < 1) page = 1;
			if (page > numPages()) page = numPages();
		
			var fullString = new Array();
			$('#totalPages').html(numPages());
			for (var i = (page-1) * records_per_page; i < (page * records_per_page); i++) {
				
				var array = new Array();
				if(i < jsonData.length){
					$.each(jsonData[i], function(k , v) {				
						array.push(v);				
					});
					var stringPart = `<div class="oneTournament">
											<a href="profile.php?id=`+array[6]+`">
												<row>
													<column cols="1"><div class="width-12 giveMinWidth">`+(i+1)+`</div></column>
													<column cols="4"><div class="width-12 giveMinWidth">`+array[0]+`</div></column>
													<column cols="1"><div class="width-12 giveMinWidth">`+array[1]+`</div></column>
													<column cols="1"><div class="width-12 giveMinWidth">`+array[2]+`</div></column>
													<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">`+array[3]+`</div></column>
													<column cols="1"><div class="width-12 giveMinWidth">`+array[5]+`</div></column>
													<column cols="2"><div class="width-12 giveMinWidth">`+array[4]+`</div></column>
												</row>	
											</a>				
									   </div>	`;
										
					fullString.push(stringPart);
				}	
			}
			$('.dataFillUp').html(fullString);

			$('#currentPage').html(current_page);
			
			if (page == 1) {
				btn_prev.style.visibility = "hidden";		
			} else {
				btn_prev.style.visibility = "visible";
			}
			if (page == 1 || page == 2){
				btn_start.style.visibility = "hidden";
			} else {
				btn_start.style.visibility = "visible";
			}	
			if (page == numPages()) {
				btn_next.style.visibility = "hidden";
			} else {
				btn_next.style.visibility = "visible";
			}
			
			if (page == numPages() || page == numPages()-1){
				btn_end.style.visibility = "hidden";
			} else {
				btn_end.style.visibility = "visible";
			}
		}else{
			$('.dataFillUp').html("No results found");
			btn_prev.style.visibility = "hidden";
			btn_start.style.visibility = "hidden";
			btn_next.style.visibility = "hidden";
			btn_end.style.visibility = "hidden";
		}
	}

	function numPages(){
		return Math.ceil(jsonData.length / records_per_page);
	}
		
</script>
