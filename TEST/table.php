<?php
	include 'classes/connections.php';
	include 'segments/header.php';
	include 'segments/navigation.php';
?>
<link href="../css/tournaments.css" rel="stylesheet"/>
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