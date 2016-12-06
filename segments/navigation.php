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
		var p_id = "<?=$p_id?>"; 
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
			<a href="tournaments.php" class="">Compete</a>
			<a href="support.php" class=""> Support</a>
			<a href="../login.php" class="login-btn">Login</a>
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
