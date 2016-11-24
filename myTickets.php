<?php
    include 'segments/header.php';
	include "segments/navigation.php";
    require_once 'classes/connections.php';
	require_once 'support/user/pagination.php';
	$db_connection = db_connect();
	$p_id=$_SESSION['user_id'];
?>
<link href="css/tournaments.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<div align="center" >

<meta name="viewport" content="width=device-width, initial-scale=1">
<div align="center" >
	<div class="container filtersAndList">
		<h1>My Tickets</h1>
		<row centered>
			
			<?php
				include 'support/user/myTickets.php';
			?>
			
			<!-- tournament list -->
			<column class="bothColumns" cols="9">
				<!--Desktop Version Start-->
				<div class="tournamentContainer xs-hidden">			
					<div class="tournamentsList">
						<div class="oneTournament tournamentListHeader">
							<row>
								<column cols="2"><div class="width-12 giveMinWidth">Category</div></column>
								<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">Status</div></column>
								<column cols="3"><div class="width-12 giveMinWidth">Date Submitted</div></column>	
								<column cols="3"><div class="width-12 giveMinWidth">Last Reply</div></column>							
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
				</column> <!-- ./tournaments list end -->
		</row><!-- ./row end -->
	</div>	<!-- ./ container end -->
</div>

<div>
	<h1>Create New Ticket</h1>
	<form method="post">
	<h3>Issue Title</h3>
	<select name="title">
		<option name="Issue1">Issue 1</option>
		<option name="Issue2">Issue 2</option>
		<option name="Issue3">Issue 3</option>
		<option name="Issue4">Issue 4</option>
		
	</select>
	
	<h3>Description of Issue</h3>
	<input type="text" name="description">
	<br><br>
	<input type="submit" name="submit">
	</form>
	
</div>
<?php
	
	if(isset($_POST["submit"])) {
		echo $_POST['description'];
		
		$stmt = $db_connection->prepare("INSERT INTO tickets (submitter, category) VALUES(?, ?)");
		$stmt->bind_param("is",$p_id,$_POST['title']);
		$stmt->execute();
		$stmt->close();
		
		$lastid = $db_connection->insert_id;
		$stmt=$db_connection->prepare("INSERT INTO ticket_messages (ticket_id, text_body) VALUES (?,?)");
		$stmt->bind_param("is",$lastid,$_POST['description']);
		$stmt->execute();
		$stmt->close();
		
	}
?>


<?php 
	include 'segments/footer.php';
?>