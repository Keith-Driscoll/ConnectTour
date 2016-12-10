<!-- Header -->
<?php 

include 'segments/header.php';
/*Added in by Keith*/

// load the login class
require_once 'classes/Login.php';
//checks if player is logged in and displays navbar accordingly
$login = new Login();

//Original
require_once 'segments/navigation.php'; 
	if($login->isUserLoggedIn()==true){
        header("Location: profile.php?id=".$_SESSION['user_id']."");
		exit;
	}

?>
<link rel="stylesheet" href="css/pages/signup.css"> 
</head><!--./ head tag ends here to support page-specific style-sheets/scripts -->

<body class="signup">

<!-- ./Header End -->
<div id="top">

	<!-- Start Content -->
	<row centered>
		<column cols="12">
			<div id="content" class="boxed">		
				<div class="container">
					<!-- row start -->
					<row centered>						
						<column cols="12">							
							<div class="inner">								
								<div class="form-box"> 									
									<h1>User Login</h1>									
									<div class="msg-container">									
										<div id="success" class="msg-overlay">
											<div class="green textcenter">
												<br/><br/>
												<p>You have logged in successfully!</p>
											</div>
										</div>
										<div id="error" class="msg-overlay">
											<div>
												<br/><br/>
												<p>Something went wrong. Please refresh and try again.</p>
											</div>
										</div>	
										<!-- login form -->
										<form id="login-form" name="login-form" method="post">								
											<div class="form-row">									     
												<div class="input-wrapper">
													<input type="text" name="user_name" id="user_name" tabindex="1" size="30" value="" required="" class="text login_input"  placeholder="Email or Username*">
												</div>
											</div>
											<div class="form-row">									     
												<div class="input-wrapper">								     
													<input type="password" name="user_password" id="user_password" tabindex="2" size="30" value="" class="text login_input"  placeholder="Password *">
												</div>
											</div> 
											<div class="form-row">									     
													<input id="login" type="submit" tabindex="3" name="login" value="Login" class="btn"> 
											</div>
											<div class="clearfix"></div>
											<div class="form-row">
												<br/><p class="muted">Don't have an account?<br/><a href="signup.php">Register</a></p>
											</div>
										</form>	<!-- ./login form end -->							
									</div>	<!-- ./ msg container end -->																
								</div> <!-- ./ form box end -->								
							</div> <!-- ./ inner end -->							
						</div>						
					</div>  						
					<div class="clearfix"></div>
				</row><!-- ./ row end-->
			</div><!-- ./ call to action end -->
		</column><!-- ./ column end -->
	</row><!-- ./ row end-->
<!-- ./ End content -->
<!-- Footer -->
	
	
	<?php include_once 'segments/footer.php'; ?>
	
	<!-- ./Footer End -->
</body>
</html>