<!-- Created 29/6/2016
Last Modified 28/6/2016 -->
<?php
    include 'segments/header.php';
	include "segments/navigation.php";
    require_once 'classes/connections.php';
	require_once 'support/user/pagination.php';
	$db_connection = db_connect();
	$p_id=$_SESSION['user_id'];
	$sql = "SELECT * FROM tickets WHERE submitter =".$p_id." AND status='read'";
	$res = $db_connection->query($sql);
	$num_tickets = $res->num_rows;
?>
<link href="css/ticket.css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Search for something -->
<row centered>
	<div class="container top support-search">
		<!--<h3>Need to find something?</h3>
		<p>Looking for some help but can't quite find it? Search below!</p>
		<form method="post" action="" class="forms">
			<div class="btn-append">
				<input type="text" name="search" placeholder="Search" />
				<span>
					<button class="btn">Go</button>
				</span>
			</div>
		</form>-->
	</div>
</row><!-- ./Search end -->

<!-- page container -->
	<div class="panel tickets">
		<!-- Container -->
		<div class="container">
			<row centered>
				<!-- Title -->
				<column cols="3">
					<h1>Support Centre</h1>
				</column>
				<!-- Support Navigation -->
				<column cols="9">
					<ul class="support-nav">
						<!-- Announcements -->
						<li>
							<!-- We can post important announcements to our members here, possibly? -->
							<!--<a href="#!">Announcements</a>-->
						</li>
						<!-- Knowledgebase -->
						<li>
							<!-- We can add links to our Terms of Service and FAQ here -->
							<!--<a href="#!">Knowledgebase</a>-->
						</li>
						<!-- Tickets -->
						<li>
							<a href="#!" class="selected">My Tickets</a>
							<!-- Total Number of tickets must have a dynamic number -->
							<? if($num_tickets>0){
								echo "<span class='badge badge-black' outline><b>".$num_tickets."</b></span>";
							}
							?>
						</li>
					</ul>
				</column><!--./ Support Navigation End -->
			</row><!-- ./Row end -->
			
		<?php
			include 'support/user/myTickets.php';
		?>
			
		<!--Desktop Version Start-->

			<!--Filters -->
			<row centered>
				<column cols="12">
					<!-- To-Do Enable Check-boxes to filter the tickets based on Status -->
					<form class="forms alert alert-primary">
						<section class="checkbox-list">
							Tickets
							<!--<label><input type="checkbox">Unread</label>
							<label><input type="checkbox">Read</label>
							<label><input type="checkbox">Important</label>-->
						</section>
					</form>
					<!-- On click, new ticket entry form will popup -->
					<button type="primary" outline class="new-ticket" id="add-ticket">Add New Ticket</button>
				</column>
			</row><!-- Filters end -->
			<!-- Ticket submission -->
			<div id="new-ticket-entry">
				<form class="forms" method="post">
					<fieldset>
						<legend>New Ticket</legend>
						<section>
							<!-- Subject Title -->
							<column cols="6">
								<label>Subject Title</label>
								<input type="text" class="width-6" name="subject" />
							</column>
							<!-- Issue Type -->
							<column cols="6">
								<select name="category" class="width-6 select">
									<option name="Issue1">Feedback</option>
									<option name="Issue2">Website Issue</option>
									<option name="Issue3">Profile Issue</option>
									<option name="Issue4">Miscellaneous</option>
								</select>
							</column>
						</section>
						<!-- Spacer -->
						<section>
							<div class="clearfix"></div>
						</section>
						<!-- Description -->
						<section>
							<column cols="12">
								<label>Description of Issue</label>
								<textarea name="issue_desc" class="width-12" rows="5" placeholder="Please enter your detailed description of any issue(s) you are having with our website."></textarea>
							<column>
						</section>
						<section class="add-ticket-end">
							<a id="cancel" class="right">Cancel</a>
							<button type="primary" outline class="right" name="submit">Submit</button>
						</section>
					</fieldset>
				</form>
			</div>
			<!--./ ticket submission end -->
			
			<!-- Ticket header -->
			<row centered class="ticket-head">
				<column cols="1">Category</column>
				<column cols="4">Subject Title</column>
				<column cols="1" class="sm-hidden">Status</column>
				<column cols="3">Date Submitted</column>	
				<column cols="3">Last Reply</column>							
			</row><!-- Ticket Header End -->

			<!-- data Fillup, do not touch -->	
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

		<!--Desktop Version End -->

	</div><!-- ./container end -->
</div><!-- ./panel tickets end -->
<?php
	
	if(isset($_POST["submit"])) {
		echo $_POST['issue_desc'];
		
		$stmt = $db_connection->prepare("INSERT INTO tickets (submitter, category, title) VALUES(?, ?, ?)");
		$stmt->bind_param("iss",$p_id,$_POST['category'],$_POST['subject']);
		$stmt->execute();
		$stmt->close();
		
		$lastid = $db_connection->insert_id;
		$stmt=$db_connection->prepare("INSERT INTO ticket_messages (ticket_id, text_body) VALUES (?,?)");
		$stmt->bind_param("is",$lastid,$_POST['issue_desc']);
		$stmt->execute();
		$stmt->close();
		
	}
?>

<!-- ./Body end -->
<div class="clearfix"></div>
<!-- Footer -->
<?php require_once 'segments/footer.php'; ?>
<!-- ./Footer End -->

<script src="../js/jquery.form.js"></script>

<!-- Support Page Scripts -->
<script>

	//Show/Hide Ticket Entry
	$("#add-ticket").click(function(){
		$("#new-ticket-entry").toggle(500);
	});
	$("#cancel").click(function(){
		$("#new-ticket-entry").hide(500);
	});
</script>

		
</body>
</html>
