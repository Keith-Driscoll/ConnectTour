<?php session_start();
 require_once 'segments/header.php';
 require_once 'segments/navigation.php';
 require_once 'classes/connections.php';?>

<!-- Profile Stylesheet -->
 
<link href="css/pages/profile.css" rel="stylesheet" type="text/css" />

								
<?php 
	if (isset($_GET['id'])){
		$p_id = $_GET['id'];
	}
	$db_connection = db_connect();
	
	$sql = "SELECT * FROM player WHERE id = '".$p_id."'";
	$result = $db_connection->query($sql);
	if ($result->num_rows == 1){
		$player_info = $result->fetch_assoc();
		$p_username = $player_info['player_username'];
	}
	$timestamp = $player_info['timestamp'];
	
	$sql = "SELECT * FROM followers WHERE followee = '".$p_id."'";
	$result = $db_connection->query($sql);
	$num_followers = $result->num_rows;
	
	$sql = "SELECT * FROM followers WHERE follower = '".$p_id."'";
	$result = $db_connection->query($sql);
	$num_following = $result->num_rows;
	

	
	//friend request stuff
	$isMe = ($_SESSION['user_id']==$_GET['id']);
	
	$areFriends=0;
	$sentMeRequest=0;
	if(!$isMe){
		$sql = "SELECT * FROM friendships WHERE (p1id=".$p_id." OR p1id=".$_SESSION['user_id'].") AND (p2id=".$p_id." OR p2id=".$_SESSION['user_id'].")";
		$res = $db_connection->query($sql);
		$areFriends = $res->num_rows > 0;
	}
	if(!$isMe){
		$sql = "SELECT * FROM friend_requests WHERE p2id=".$_SESSION['user_id']." AND p1id=".$p_id." AND STATUS=0";
		$res = $db_connection->query($sql);
		$sentMeRequest= $res->num_rows > 0;
		$sql = "SELECT * FROM friend_requests WHERE p1id=".$_SESSION['user_id']." AND p2id=".$p_id." AND STATUS=0";
		$res= $db_connection->query($sql);
		$ISentRequest=$res->num_rows>0;
	}
	
	$sql = "SELECT * FROM followers WHERE follower=".$_SESSION['user_id']." AND followee=".$p_id;
	$res = $db_connection->query($sql);
	$following = $res->num_rows>0;
	$sql = "SELECT * FROM followers WHERE followee=".$_SESSION['user_id']." AND follower=".$p_id;
	$res = $db_connection->query($sql);
	$followsMe = $res->num_rows>0;
	
	$page = $_GET['page'];
	
	
	
	
?>							
	
								
								
<!-- navigation -->
<script type="text/javascript">
	var playerID;
	$(document).ready(function(){
		
		$(".uploadInput").hide();
		$(".uploadButton").hide();
		
		var page = "<?=$page?>";
		if(typeof page !== 'undefined' && page != ""){
			playerID = "<?php echo $p_id; ?>"
			$('#content-change').load("profile/"+page+".php?id="+playerID);
			$('.selected').removeClass('selected');
			$(this).addClass('selected');
		}
		
		
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
	
	function editPicture(){
		$(".editProfilePicButton").hide();
		$(".imageErrorMessage").html("");
		$(".uploadInput").fadeIn();
		$(".uploadButton").fadeIn();
	}
</script>

</head>
<body class="loading">
<div class="clearfix"></div>
<div id="profile" class="fade">
	<div class="container">
		<div class="clearfix"></div>
		<row centered>
			<column cols="6" class="align-centered">
				<div class="profile-photo">
					
					<?php 
					require_once 'getProfilePicture.php';
					$pic = getProfilePicture($p_id);
					?>
					<img src='<?php echo $pic;?>'/>
					
				</div>
				<?if($isMe){
				echo "
				<row centered>
					<div  class='editProfilePicButton'  onclick='editPicture()'>Edit Picture</div>
				</row>
				<div class='imageErrorMessage' style='color:white'>";
					if($_GET['error']){
						echo $_GET['error'];
					}
					echo"
				</div>
				<div class='uploadNewProfile'>
					<form action='image_upload.php?path=profile_pictures&file_name=".intval($p_id)."&max_size=1000000&ret=".$_SERVER['REQUEST_URI']."' method='post' enctype='multipart/form-data'>
						<input type='file' class='uploadInput' name='fileToUpload' id='fileToUpload'>
						<input type='submit' class='uploadButton' value='Upload Image' name='submit'>
					</form>
				</div>
					";
				}
				?>
				
				<p class="profile-id large"><?php echo $p_username; ?>
					<a href="#">
						<!-- Edit button -->
						<?php 
							if($isMe){
								echo //"<span onClick='editProfile()' class='edit-icon fa fa-pencil-square-o'></span>";
							}			
						?>
						
						<!-- ./Edit button end-->
					</a>
				</p>
			
			</column>
		</row><!-- ./ row end -->
	</div><!-- ./container end -->
	<!-- navigation -->
	<row centered id="sidebar" class="<?php echo $p_id; ?>">
		<!-- Sidebar -->
		<ul id="sidemenu" class="align-centered">
			<!-- Overview -->
				<li>
					<a href="#!" class="" id="overview">
						<span class="fa fa-th"></span><br/>
						<p>Overview</p>
					</a>
				</li><!-- ./Overview End -->
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
						<p>Tours</p>
					</a>
				</li><!-- ./Tour Accounts End -->
			<!-- Teams -->
				<li>
					<a href="#!" id="teams" class="">
						<span class="fa fa-shield"></span><br/>
						<p>Groups</p>
					</a>
				</li><!-- ./Group End -->
			<!-- Contact -->		
				<li>
					<a href="#!" id="contact" class="">
						<span class="fa fa-comment"></span><br/>
						<p>Contact</p>
					</a>
				</li><!-- ./Contact End -->
			<!-- Notifications -->		
				<? if($isMe){
					$sql = "SELECT * FROM notifications WHERE p_id=".$p_id." AND is_read=0";
					$res = $db_connection->query($sql);
					$num_tickets=$res->num_rows;
					echo"<li>
					<a href='#!'id='notifications' class='last'>
						<span class='fa fa-align-left'></span><br/>
						<p>Notifications (".$num_tickets.")</p>
					</a>
				</li>";
				}
				?>
		</ul><!-- ./sidebar end -->
		</row><!-- ./navigation end -->
	</row><!-- ./top end-->
</div><!-- ./profile end -->
<div class="clearfix"></div>
<section id="content">
	<!-- content container -->
	<div class="container">
		
			<!-- content change -->
			<div id="content-change">
				<?php include 'profile/overview.php'; ?>
			</div><!-- ./content-change end -->
		
	</div>
</section>
<!-- Start loading -->
	
		 <!--<div id="loadingoverlay"><h3><span class="large align-centered fa fa-spinner fa-spin"></span></h3><p></p><p></p><h1>Good Gaming Leagues.</h1><br/><p> Please wait while we load your profile.</p></div>
		
	<!-- End loading -->
<!-- Footer -->

<?php include 'segments/footer.php' ?>

<!-- ./Footer End -->
</body>
</html>