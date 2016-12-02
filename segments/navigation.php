

<!-- Google analytics 
Last modified  7/3/2016 - Keith
-->

<?php include_once("analyticstracking.php");
 $p_id = $_SESSION['user_id'];
 if(!isset($_SESSION)){
	 $p_id=0;
 }
?>
<!--./ Do not delete -->
<script src='../js/jquery.min.js'></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script>
<!--
<script>
	function getNotifications(){
	var p_id = <?=$p_id?>;
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

	function sessionTimer(){
		var p_id = <?=$p_id?>;
		if(p_id!=0){
			alert("Session timed out. Please login to continue.");
		}
		
	}
	
	$(function() {
			var notificationTimer = setInterval(getNotifications, 600000);	
			//var sessionTime = setInterval(sessionTimer,18000000); //30 minute timeout
	});
	
</script>
-->
<header class="cd-main-header">
		<a href="../index.php">
			<h1 id="cd-logo">GGLeagues</h1>
		</a>
		<!-- 
		<div class="cd-search is-hidden">
			<form action="#0">
				<input type="search" placeholder="Search...">
			</form>
		</div>
		-->

		<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li><a href="../tournaments.php">Compete</a></li>
				<li><a href="../support.php">Support</a></li>
				<li class="has-children account">
					<a href="#0">
						<?php include 'getProfilePicture.php'; $pic = getProfilePicture($_SESSION['user_id']); ?>
							<?php echo"
							<img src='".$pic."' alt='avatar'/>
							"
							?>
							<?php echo "".$_SESSION['user_name']?>
					</a>

					<ul>

						<li>
							<?php echo "<a href='profile.php?id=".$_SESSION['user_id']."'>My Account</a>";?>
						</li>
						<li>
							<?php //echo "<a href='../profile.php?id=".$_SESSION['user_id']."&page=notifications'>"; ?>Notifications 
								<?php
								//print number of notifications
                                /*
								$db_connection = db_connect();
								$sql = "SELECT * FROM notifications WHERE p_id = ".$_SESSION['user_id']." AND is_read=0";
								$result = $db_connection->query($sql);
								echo " (".$result->num_rows.")";
								*/?>
							</a>
						</li>
						<li>
							<form method="post">
								<a href="index.php?logout" class="">Sign out</a>
							</form>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</header><!-- ./ header end-->
