<?php
	// load the login class
	require_once("classes/Login.php");
	include 'classes/doLoginCheck.php';
	require_once 'classes/connections.php';
	
	$p_id = $_GET['id'];	
	
	$db_connection = db_connect();
	$sql = "SELECT * FROM player WHERE id = '".$p_id."'";
	$result = $db_connection->query($sql);
	
	if ($result){
		$player_info = $result->fetch_assoc();
		$p_username = $player_info['player_username'];		
	} else {
		echo "Error";
	}
	
?>
<!-- Cache Disabler -->
<script type="text/javascript">
/* <![CDATA[ */
( function( $ ) {
   $( 'a[href="#!"]' ).click( function(e) {
      e.preventDefault();
   } );
} )( jQuery );
/* ]]> */
</script><!-- ./Cache prevention end -->

<!-- navigation -->
<script type="text/javascript">
	var playerID;
	$(document).ready(function(){
		
	$('#content-change').load("profile/overview.php?id=<?php echo $p_id; ?>");
		
	//Menu content changer
		$('#sidemenu a').click(function() {
			playerID = $('#sidebar').attr('class');
			//stores the link that's clicked in variable called 'clicked'
			var clicked= $(this).attr("id");
			//loads html page related to stored variable when clicked
			$('#content-change').load("profile/"+clicked+".php?id="+playerID);
			//removes class from previously selected link
			$('.selected').removeClass('selected');
			//adds class to newly selected link
			$(this).addClass('selected');
		});
		//end
	}); 
</script>

	<div class="profile-header fade">
		<div class="container">
			<!-- text styling -->
			<div class="text-styling">
			<!-- Following -->
			<div class="following-float">
				<div class="following ">
					<h3>Following</h3>
					<?php
						$sql = "SELECT COUNT(follower) AS followed FROM followers WHERE follower = '".$p_id."'";
						$result = $db_connection->query($sql);
						if ($result){	
							$num_followed = $result->fetch_assoc();
						}
						echo "
							<p>".$num_followed['followed']."</p>
						";
					?>
				</div>
			</div><!-- ./Following end -->
			<!-- Followers -->
			<div class="followers-float">
				<div class="followers">
					<h3>Followers</h3>
					<?php
						$sql = "SELECT COUNT(followee) AS followees FROM followers WHERE followee = '".$p_id."'";
						$result = $db_connection->query($sql);
						if ($result){	
							$num_followees = $result->fetch_assoc();
						}
						echo "
							<p>".$num_followees['followees']."</p>
						";
					?>
				</div>
			</div><!-- ./text styling end-->
			<!-- ./Followers end-->
			</div><!-- Profile card -->
			<div class="profile-card">
				<div class="profile-photo">Profile Photo</div>
				<p class="profile-id"><?php echo $p_username; ?></p>
			</div><!-- ./Profile card end -->
		</div><!-- ./Container end -->
		
		<!-- gradient -->
		<div class="gradient">
		</div><!-- ./gradient end -->
		
		<!-- Edit button -->
		<div class="edit-profile">
			<a href="#">
				<span class="edit-icon fa fa-pencil-square-o"></span>
			</a>
		</div>
		<!-- ./Edit button end-->
	</div><!-- ./profile header end -->
<!-- Main Body Styling -->

	<!-- navigation -->
	<div id="sidebar" class=<?php echo $p_id; ?>>
		<!-- Sidebar -->
		<ul id="sidemenu">
			<!-- Activity -->
				<li>
					<a href="#!" class="" id="overview">
						<span class="fa fa-th"></span><br/>
						<p>Overview</p>
					</a>
				</li><!-- ./Activity End -->
			<!-- Friends -->
				<li>
					<a href="#!" id="friends" class="">
						<span class="fa fa-heart"></span><br/>
						<p>Friends</p>
					</a>
				</li><!-- ./Friends End -->
			<!-- Game Accounts -->
				<li>
					<a href="#!" id="games" class="">
						<span class="fa fa-gamepad"></span><br/>
						<p>Games</p>
					</a>
				</li><!-- ./Game Accounts End -->
			<!-- Teams -->
				<li>
					<a href="#!" id="teams" class="">
						<span class="fa  fa-shield"></span><br/>
						<p>Teams</p>
					</a>
				</li><!-- ./Teams End -->
			<!-- Contact -->		
				<li>
					<a href="#!" id="contact" class="">
						<span class="glyphicon glyphicon-comment"></span><br/>
						<p>Contact</p>
					</a>
				</li><!-- ./Contact End -->
			<!-- Activity -->		
				<li>
					<a href="#!" id="activity" class="last">
						<span class="glyphicon glyphicon-align-left"></span><br/>
						<p>Activity</p>
					</a>
				</li><!-- ./Activity End -->
		</ul><!-- ./sidebar end -->
	</div><!-- ./navigation end -->
	<div class="clearfix"></div>
	<!-- content container -->
	<div class="container">
		<!-- content change -->
		<div id="content-change">
		</div><!-- ./content-change end -->
	</div>
<!-- Profile Stylesheet -->
<link href="css/profile.css" rel="stylesheet" type="text/css" />

<!-- Footer -->

<?php include 'segments/footer.php' ?>

<!-- ./Footer End -->