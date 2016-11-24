<!-- Header -->
<?php include 'segments/header.php';?>
<link rel="stylesheet" href="css/pages/signup.css"> 
</head><!--./ head tag ends here to support page-specific style-sheets/scripts -->
<body class="signup">
<?php include 'segments/navigation.php';?>
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
										
											<h1>User Signup</h1>
										
										<div class="msg-container">
										
											<div id="success" class="msg-overlay">
													<div class="green textcenter">
														You have registered successfully! Please check your email for confirmation.
													</div>
											</div>
				
											<div id="error" class="msg-overlay">
													<div id="error_text">														
														Something went wrong. Please refresh and try again.
													</div>
													<div onclick="retryForm()" class="retry">Retry</div>
											</div>	
											<!-- signup form -->
											<form id="register-form" name="register-form" method="post">								
												<div class="form-row">									     
													<div class="input-wrapper">
														<input type="text" name="user_name" id="user_name" size="30" value="" required="" tabindex="1" class="text signup_input"  placeholder="Username*">
													</div>
												</div>
												<div class="form-row">									     
													<div class="input-wrapper">
														<input type="email" name="user_email" id="user_email" size="30" value="" required="" tabindex="2" class="text signup_input"  placeholder="Email*">
													</div>
												</div>
												<row class="margin-none">
													<column cols="6" class="left">
														<div class="form-row">									     
															<div class="input-wrapper">								     
																<input type="password" name="user_password_new" id="user_password_new" size="30" value="" tabindex="3" class="text signup_input"  placeholder="Password *">
															</div>
														</div>
													</column>
													<column cols="6" class="right">									     
														<div class="form-row">									     
															<div class="input-wrapper">								     
																<input type="password" name="user_password_repeat" id="user_password_repeat" size="30" value="" tabindex="4" class="text signup_input"  placeholder="Confirm Password *">
															</div>
														</div>
													</column>
												</row> 
												<div class="form-row">									     
														<input id="register" type="submit" name="register" value="Register" tabindex="5" class="btn"> 
												</div>
												<div class="clearfix"></div>
												<div class="form-row">
														<br/><p class="muted">Already have an account?<br/><a href="login.php">Login</a></p>
												</div>
											</form>	<!-- ./signup form end -->
										
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
	
	
	<!-- Load scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/respond.min.js"></script>
	<script src="js/scripts.js"></script> 
	<script defer src="js/jquery.flexslider-min.js"></script> 
	<script src="js/jquery.form.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/signup.js"></script>
	<!--[if lte IE 7]><script src="js/lte-ie7.js"></script><![endif]-->
	
	<!-- ./ End Script Loading -->
	
	<!-- ./Footer End -->
</body>
</html>