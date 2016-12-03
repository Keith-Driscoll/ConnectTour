<?php;
 $p_id = $_SESSION['user_id'];
 if(!isset($_SESSION)){
	 $p_id=0;
 }
?>
<!--./ Do not delete -->
<script src='../js/jquery.min.js'></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script>

 <script>

	function sessionTimer(){
		var p_id = <?=$p_id?>;
		if(p_id!=0){
			alert("Session timed out. Please login to continue.");
		}
		
	}
	
	$(function() {
			var sessionTime = setInterval(sessionTimer,18000000); //30 minute timeout
	});
	
</script>
<header>
	<!-- row -->
	<div class="container clearfix">
		<!-- main column -->					
		<a href="index.php">
			<h1 id="logo">ConnectTour</h1>
		</a>
		<nav>	
<<<<<<< HEAD
			<a href="tournaments.php" class="">Tours</a>
			<a href="support.php" class=""> Supporters</a>
			<?php 
				
			  require_once 'classes/doLoginCheck.php';
			  require_once 'classes/connections.php';
			  $db_connection = db_connect();
			?>
			
			
			<?php 
							 $currentpage = $_SERVER['PHP_SELF'];
							 //Pages allowed to be visited when user is unverified
							 //Removing unverified or login will cause infinite loop, don't remove.
							 if($currentpage!= "/index.php" && $currentpage != "/unverified.php" && $currentpage != "/login.php" && $currentpage != "/signup.php"){
							 	if($_SESSION['user_id']!=null){
							 		$sql = "SELECT is_verified FROM player WHERE id = " . $_SESSION['user_id'];
									
							 		$result = $db_connection->query($sql);
							 		$v = $result->fetch_assoc();
							 		if($v['is_verified']==0){
							 			header('Location: unverified.php');
							 		}
													
							 	}
							 	else{
							 		header('Location: login.php');	
							 	}				
							 }
			?>
			
			
=======
			<a href="tournaments.php" class="">Compete</a>
			<a href="support.php" class=""> Support</a>
			<a href="../login.php" class="login-btn">Login</a>
>>>>>>> fd0e3d1badb618c582eeadcdb3a51c529a196dc7
		</nav>
	</div><!-- ./row end -->	
</header><!-- ./ header end-->
	
<aside id="side-nav" class="hide">
		<ul>
			<li class="x">
				<button href="" onclick="hideNav();" class="hide-btn">Hide<span class="x icon_close"></span></button>
			</li>
								
				<row>
					<div class="nav-photo sm-hidden">
						<a href='profile.php?id='><img src='images/logo_vector.png' alt='profile-photo'/></a>					</div>
				</row>
			<li>
				<h3 class="align-right">
								
				</h3>
			</li>
			<!-- link -->
			<li>
				<a href='profile.php?id='>Your Profile</a>			</li>
			<!-- link -->
			<li>
				<a href="mytournaments.php" class="">Your Tournaments</a>
			</li>
			<!-- link -->
			
			<hr/>
			<li>
				<a href='profile.php?id=&page=notifications'>Notifications 
				 ()				</a>
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
