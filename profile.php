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
	
	function addFriend(code){
			//codes: 1 -remove friend 2-accept request 3- reject request 4-add friend 5-follow 6-unfollow 
			var p1_id = <?= intval($_SESSION['user_id']) ?>;
			var p2_id = <?= intval($_GET['id']) ?>;
			var action_code = code;
			if(action_code == 6 && document.getElementById('follow').className=='followButton'){
				action_code = 5;
			}
			if(action_code ==5 && document.getElementById('follow').className=='unfollowButton'){
				action_code = 6;
			}
			$.ajax({
				type: "GET",
				url: "addfriend.php",
				data: {p1_id:p1_id, p2_id:p2_id, action_code:action_code},
				success:function(){
					if(action_code==5){
					document.getElementById('follow').className="";
					document.getElementById('follow').className="unfollowButton";
					document.getElementById('follow').innerHTML="<span>Following</span>";
				}
					else{
					document.getElementById('follow').className="";									
					document.getElementById('follow').className="followButton";
					document.getElementById('follow').innerHTML="<span>Follow</span>";
				}
				}
  			});		
	}
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
			<column cols="3" class="right sm-hidden">
				<h2 class="align-right">Followers</h2>
				<p class="align-right large"><?php echo $num_followers; ?></p>
			</column>
			<column cols="3" class="align-centered">
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
								//echo "<span onClick='editProfile()' class='edit-icon fa fa-pencil-square-o'></span>";
							}
							else {
								//friends
								if($areFriends){
									echo "<span onClick='addFriend(1)' class='edit-icon fa fa-times'></span>";
								}
								//friend request sent but not friends
								elseif($sentMeRequest){
									echo "<span onClick='addFriend(2)' class='edit-icon fa fa-check-circle'></span>";
									echo "<span onClick='addFriend(3)' class='edit-icon fa fa-times'></span>";
								}
								elseif($ISentRequest){
									echo "<button class='requestSent' onClick='addFriend(3)'><span>Request Sent</span></button>";
								}
								//not friends
								else {
									echo "<span onClick='addFriend(4)' class='edit-icon fa fa-plus-square-o'></span>";
								}
								
								echo "<br>";
								//not following
								if(!$following){
									echo "<button id='follow' class='followButton' onClick='addFriend(5)'><span>Follow</span></button>";
								}
								//following
								else{
									echo "<button  id='follow' onClick='addFriend(6)' class='unfollowButton'><span>Following</span></button>";
								}
								//follows you
								if($followsMe){
									echo "<button>Follows You</button>";
								}
							}
							
						?>
						
						<!-- ./Edit button end-->
					</a>
				</p>
			
			</column>
			<column cols="3" class="left sm-hidden">
				<h2 class="align-left">Following</h2>
				<p class="align-left large"><?php echo $num_following; ?></p>
			</column>
		</row><!-- ./ row end -->
	</div><!-- ./container end -->





<!-- Move PHP where appropriate -->
				<!-- Following
				<div class="following-float">
					<div class="following ">
						<h3>Following</h3>
						
					</div>
				</div><!-- ./Following end -->
				<!-- Followers 
				<div class="followers-float">
					<div class="followers">
						<h3>Followers</h3>
						<?php /*
							$sql = "SELECT COUNT(followee) AS followees FROM followers WHERE followee = '".$p_id."'";
							$result = $db_connection->query($sql);
							if ($result){	
								$num_followees = $result->fetch_assoc();
							}
							echo "
								<p>".$num_followees['followees']."</p>
							";
						*/ ?>
					</div>
				</div><!-- ./text styling end-->
				<!-- ./Followers end-->
				
<!-- ./ END -->






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
						<p>Games</p>
					</a>
				</li><!-- ./Game Accounts End -->
			<!-- Teams -->
				<li>
					<a href="#!" id="teams" class="">
						<span class="fa fa-shield"></span><br/>
						<p>Teams</p>
					</a>
				</li><!-- ./Teams End -->
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