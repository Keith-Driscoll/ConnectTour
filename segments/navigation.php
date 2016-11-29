


<!-- Google analytics 
Last modified  7/3/2016 - Keith
-->

<?php require_once 'analyticstracking.php';
session_start();
require_once 'getProfilePicture.php';
/*
 $p_id = $_SESSION['user_id'];
 if(!isset($_SESSION)){
	 $p_id=0;
 }
 */
 
?>
<!--./ Do not delete -->
<script src='../js/jquery.min.js'></script>
<script>
	/*
	function getNotifications(){
	var p_id = 0; ///CHANGE THIS BACK SOON
	$.ajax({
		type: "GET",
		url: "get_notifications.php",
		data: {p_id:p_id},
		success: function(data){
			if(data!=''){
				var text = document.getElementById("notifications").innerHTML;
				var res = text.split('(');
				var newstring = ''+res[0] + '(' + data + ')';
				document.getElementById("notifications").innerHTML = newstring;
			}
		}
	});		
	}
	
	
	function sessionTimer(){
		var p_id = 0;///CHANGE THIS BACK SOON
		if(p_id!=0){
			alert("Session timed out. Please login to continue.");
		}
		
	}
	
	$(function() {
			var notificationTimer = setInterval(getNotifications, 600000);	
			//var sessionTime = setInterval(sessionTimer,18000000); //30 minute timeout
	});
	*/
	
</script>
<header>
	<!-- row -->
	<div class="container clearfix">
		<!-- main column -->					
		<a href="index.php">
			<h1  id="logo">ConnectTour</h1>
		</a>
		<nav>	
			<a href="tournaments.php" class="">Tours</a>
			<a href="support.php" class=""> Supportters</a>
			<?php 
			    //checks if user is logged in, if not, redirect to login page
			  //require_once 'classes/doLoginCheck.php';
			  //require_once 'classes/connections.php';
			  //$db_connection = db_connect();
			?>
			
			
			<?php 
							// $currentpage = $_SERVER['PHP_SELF'];
							// //Pages allowed to be visited when user is unverified
							// //Removing unverified or login will cause infinite loop, don't remove.
							// if($currentpage!= "/index.php" && $currentpage != "/unverified.php" && $currentpage != "/login.php" && $currentpage != "/signup.php"){
							// 	if($_SESSION['user_id']!=null){
							// 		$sql = "SELECT is_verified FROM player WHERE id = " . $_SESSION['user_id'];
									
							// 		$result = $db_connection->query($sql);
							// 		$v = $result->fetch_assoc();
							// 		if($v['is_verified']==0){
							// 			header('Location: unverified.php');
							// 		}
													
							// 	}
							// 	else{
							// 		header('Location: login.php');	
							// 	}				
							// }
			?>
			
			
		</nav>
	</div><!-- ./row end -->	
</header><!-- ./ header end-->
	
<aside id="side-nav" class="hide">
		<ul>
			<li class="x">
				<button href="" onclick="hideNav();" class="hide-btn">Hide<span class="x icon_close"></span></button>
			</li>
				<?php 
					$pic = getProfilePicture($_SESSION['user_id']);
				?>
				
				<row>
					<div class="nav-photo sm-hidden">
						<?php echo "<a href='profile.php?id=".$_SESSION['user_id']."'><img src='".$pic."' alt='profile-photo'/></a>";
						?>
					</div>
				</row>
			<li>
				<h3 class="align-right">
				<?php echo "".$_SESSION['user_name'];?>
				
				</h3>
			</li>
			<!-- link -->
			<li>
				<?php echo "<a href='profile.php?id=".$_SESSION['user_id']."'>Your Profile</a>";?>
			</li>
			<!-- link -->
			<li>
				<a href="mytournaments.php" class="">Your Tournaments</a>
			</li>
			<!-- link -->
			
			<hr/>
			<li>
				<?php echo "<a href='profile.php?id=".$_SESSION['user_id']."&page=notifications'>"; ?>Notifications 
				<?php
				//print number of notifications
				//$sql = "SELECT * FROM notifications WHERE p_id = ".$_SESSION['user_id']." AND is_read=0";
				//$result = $db_connection->query($sql);
				//echo " (".$result->num_rows.")";
				?>
				</a>
			</li>
			<!-- link -->
			
			<li>
				<a href="support.php" class="">My Tickets</a>
			</li>
			<hr/>
			<!-- link -->
			<li>
				<form method="post">
					<a href="index.php?logout" class="">Sign out</a>
				</form>
			</li>
		</ul>
</aside>

