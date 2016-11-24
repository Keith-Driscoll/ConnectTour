<?php require_once 'segments/header.php';
	  require_once 'classes/connections.php';
	  require_once 'classes/Login.php';
	  $login = new Login();
	  $loggedIn = $login->isUserLoggedIn()?>
<!-- Insert additional scripts here -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/pages/landingPage.css"/>
<link rel="stylesheet" href="css/pages/signup.css"/>
<link rel="stylesheet" href="css/games.css"/>
</head><!-- Header ends here incase additional scripts required for specific pages must be added -->
<?php require_once 'segments/navigation.php'; ?>
<body class="loading">
<!-- This stops particular scripts being loaded on every page regardless if they're needed or not -->
<!-- ./Header End -->

<!-- deals with alpha signups

	<!-- Start Top -->	
	<div id="top">	
		<!-- Start Content -->		
			<div id="content" class="boxed">		
				<div class="container">
						<!-- row start -->
						<row centered>
				        	<!-- slider -->
				        	<column cols="8" class="left">				        	
				        		<!-- Video Start -->				        			
				        			<!--
				        			<div class="video">  
					        			<iframe src="//player.vimeo.com/video/113545541?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					        		</div>
					        		-->				        		
				        		<!-- Video end -->				        	
				        		<!-- Static Start -->				        				        	
					        		<!-- <img src="http://placehold.it/1000" /> -->				        		
				        		<!-- Static end -->		        						        		
				        		<!-- Slideshow Start -->			        		
								<div class="flexslider">
								    	<ul class="slides">
								            <li style="background-image: url(images/homepage/esports_event.jpg)">
											
									            <div class="info">
									            	<h2>Play to win</h2>
									           	<!-- <p>Duis varius commodo. In mollis lorem a dui imperdiet, a sollicitudin felis pellentesque. Nullam suscipit lacinia venenatis.</p>
									            --></div>
									            
											</li> 
								            <li style="background-image: url(images/homepage/maxresdefault.jpg)">
									            <!--
									            <div class="info">
									            	<h2>This is a title</h2>
									           	 <p>Duis varius commodo. In mollis lorem a dui imperdiet, a sollicitudin felis pellentesque. Nullam suscipit lacinia venenatis.</p>
									            </div>
									            -->
								            </li> 
								            <li style="background-image: url(images/homepage/Hearthimage.jpg)">
											<!--
									            <div class="info">
									            	<h2>This is a title</h2>
									           	 <p>Duis varius commodo. In mollis lorem a dui imperdiet, a sollicitudin felis pellentesque. Nullam suscipit lacinia venenatis.</p>
									            </div>
									            -->
											</li>  
									</ul>
								</div>
					        		
				        		<!-- Slideshow End -->
				        		
				        	</column><!-- image slider end -->
				        	
				        	<column cols="4">
				        	
				        		<div class="inner">
				        		
				        			<div class="form-box"> 
				        				<?php if(!$loggedIn){
											
										?>
										
											<h1>Pre-Alpha Signup</h1>
											
											<p>Sign up to get involved with our pre-Alpha launch. Help improve the quality of our development. Keep up to-date with upcoming deals & features!</p>
				        			 	<?php
											} else{
												
										?>
											<h1>Join a Tournament</h1>
											
											<p>Get involved with your first tournament on GGLeagues. Click here to begin!</p>
										<?
											}
										?>
									<div class="msg-container">
									
										<div id="success" class="msg-overlay">
										    	<div class="green textcenter">
													<br/><br/>
										        	<p class="soft-muted" ></p>
										    	</div>
										</div>
			
										<div id="error" class="msg-overlay">
										    	<div>
													<br/><br/>
													<p>Something went wrong. Please refresh and try again.</p>
										    	</div>
										</div>	
										<!-- signup form -->
										<script src="js/alpha_signups.js"></script>
										<form id="subscribe" name="subscribe" novalidate="novalidate">								
		
											<div class="form-row">									     
												<div class="input-wrapper">
													<!--<input type="email" name="email" id="email" size="30" onKeyPress="checkKey()" value="" required="" class="text login_input"  placeholder="Email Address *">-->
												</div>
											</div>
											<div class="form-row">								     
												<?if(!$loggedIn){?>
												<input id="submitA" type="button" onclick="window.location.href= 'signup.php'" name="submitA" value="Register" class="btn">
												<?}else{?>	
												<input id="submitA" type="button" onclick="window.location.href= 'tournaments.php'" name="submitA" value="Tournaments" class="btn">
												<?}?>
											</div>
											<div class="form-row">
												<br/><br/>
												<?if(!$loggedIn){
												?>
												<p>
													Returning user? Please login <a href="login.php"><u>here</u></a>.
												</p>
												<?}?>
											</div>
										</form>	<!-- ./signup form end -->
									
									</div>	<!-- ./ msg container end -->								
				        			
				        			</div> <!-- ./ form box end -->
				        			
				        		</div> <!-- ./ inner end -->
				        		
				        	</div>
				        	
			            	</div>  
			            	
			            	<div class="clearfix"></div>
				
				</div><!-- ./ call to action end -->
			
			</row><!-- ./ row end-->
		<row centered class="down"><a href="#panel"><span class="arrow_carrot-down_alt2 down align-centered sm-hidden"></span></a></row>
		<!-- ./ End content -->
		
		<div class="clearfix"></div>
		
	</div>

	<!-- End Top -->
	<!-- Start panel features -->
	
		<div id="panel">
		
			<div class="container">
				<!-- row start -->
				<row centered>
					<h2 class="align-centered">Key features...</h2>
				</row>
				<row centered>
					<column cols="3">
						<div class="inner align-centered">	
							<div aria-hidden="true" class="icon_lightbulb_alt large" ></div>			
							<h3>Simple &amp; Easy</h3>
							<p>With our minimalist approach, you can create and participate in competitions with ease</p>	
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./ column end -->
					<!-- column start -->
					<column cols="3">
						<div class="inner align-centered">
							<div aria-hidden="true" class="icon_wallet large" ></div>
							<h3>Win Cash prizes</h3>
							<p>Join tournaments and leagues and win real cash prizes. Earn cash playing games you love!</p>
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./column end -->
					<!-- column start -->
					<column cols="3">
						<div class="inner align-centered">
							<div aria-hidden="true" class="icon_lock_alt large" ></div>	
							<h3>Secure</h3>
							<p>We ensure your safety can rest assured with our industry standard protection.</p>
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./column end -->
					<column cols="3">
						<div class="inner align-centered">
							<div aria-hidden="true" class="icon_mobile large" ></div>					
							<h3>Responsive</h3>
							<p>Our responsive design means you can take your competitive gaming wherever you go!</p>
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./ column end -->				
				</div>			
			</div>
			
			<div class="clearfix"></div>
		
		</row> <!-- ./ row end -->
	
	<!-- End panel features-->

	<!-- Start panel 1-->
	
		<div class="features panel panel-alt box-right">
		
			<div class="container">
				<!-- row start -->
				<row centered>
					<!-- column start -->	
					<column cols="6">
						<div class="inner"> 
						
							<h3>Create tournaments</h3> 
							<p>Create and manage your own customisable tournament for your favourite game(s)!</p>
							<!--<a href="tournaments.php" class="button"><span aria-hidden="true" class="arrow_carrot-up_alt2" ></span> Create tournament</a> -->
							<a href="features.php" class="button button-light"><span aria-hidden="true" class="arrow_carrot-right_alt2" ></span> Learn More</a>
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./column end -->
					<!-- column start -->
					<column cols="6" class="hidden">
					
						<div class="clearfix"></div>
						
					</column><!-- ./column end -->
				
				</div>
			
			</row> <!-- ./row end-->
			
			<div class="image-box img sm-hidden"></div>
			
			<div class="clearfix"></div>
		
		</div><!-- ./ container end -->
		
	 <!-- ./ End panel 1-->
	
	<div class="clearfix"></div>
	
	<!-- Start panel 2-->
	
		<div class="features panel panel-alt box-left">
		
			<div class="container">
				<!-- row start -->
				<row centered>
					<!-- column start -->
					<column cols="6" class="hidden">		
						<div class="clearfix"></div>
					</column><!-- ./column end -->
					<!-- column start -->
					<column cols="6">
						<div class="inner">
						
							<h3>Participate in tournaments</h3> 
							<p>Join tournaments and start your journey towards becoming a better gamer!</p>
							
							<div class="clearfix"></div>
							
							<!--<a href="tournaments.php" class="button"><span aria-hidden="true" class="arrow_carrot-up_alt2" ></span> Participate</a> -->
							<a href="features.php" class="button button-light"><span aria-hidden="true" class="arrow_carrot-right_alt2" ></span> Learn More</a>
							
							<div class="clearfix"></div>
							
						</div>
					</column>
				
				</row><!-- ./ row end -->
			
			</div><!-- ./container end -->
			
			<div class="image-box sm-hidden"></div>
			
			<div class="clearfix"></div>  
		
		</div><!-- ./promo panel end -->
	
	<!-- End panel 2-->
	
	<!-- Start panel 1-->
	
		<div class="features panel panel-alt box-right">
		
			<div class="container">
				<!-- row start -->
				<row centered>
					<!-- column start -->	
					<column cols="6">
						<div class="inner"> 
						
							<h3>User Profiles</h3>  
							<p>Sign up to setup your own profile to follow friends and other gamers. Keep up to date with current gaming news and events!</p>
							
							<!--<a href="signup.php" class="button"><span aria-hidden="true" class="arrow_carrot-up_alt2" ></span> Sign Up</a> -->
							<a href="features.php" class="button button-light"><span aria-hidden="true" class="arrow_carrot-right_alt2" ></span> Learn More</a>
							
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./column end -->
					<!-- column start -->
					<column cols="6" class="hidden">
					
						<div class="clearfix"></div>
						
					</column><!-- ./column end -->
				
				</div><!-- ./container end -->
			
			</row> <!-- ./row end-->
			
			<div class="image-box img2 sm-hidden"></div>
			
			<div class="clearfix"></div>
		
		</div><!-- ./promo panel end -->
		
	 <!-- ./ End panel 1-->
	
	</div>
	<div class="clearfix"></div>
	
	<!-- Start panel 4-->
	
		<div class="panel promo">
		
			<div class="container">
						
				<div class="inner intro align-centered">
					<h3>Your journey starts here</h3>  
					<p>Begin your competitive gaming journey, with Good Gaming Leagues!</p>
					
				</div>
				
				<div class="clearfix"></div>
				<!-- row start -->
				<row centered>
					<column cols="6" class="text-centered">
						<!--<a href="signup.php" class="button-alt"><span aria-hidden="true" class="arrow_carrot-up_alt2"></span> Start now!</a> -->
					</column>
				</row><!-- ./row end -->
				
			</div><!-- ./container end -->
			
		</div><!-- ./promo panel end-->
	
	<!-- End panel 4-->
	
	<!-- Start panel 5-->

		<div class="games panel panel-alt sm-hidden">
			<div class="container">
				<!-- title row start -->
				<row centered>
					<column cols="8">
						<div class="inner intro align-centered">
							<h3>Games we currently provide for</h3> 
							<p></p>
							
						</div>
					</column>
				</row><!-- ./title row end-->
				<!-- games row start-->
				<row centered>
					<!-- column start -->
					<column cols="12" class="align-centered">
						<blocks cols="4">
						<!-- gallery start -->
							<ul class="ch-grid">
								<li>
									<h3 class="title">Hearthstone</h3>
									<a href="tournaments.php?game=Hearthstone"><div class="ch-item ch-img-1">
									</div></a>
								</li>
								<li>
									<h3 class="title">League of Legends</h3>
									<div class="ch-item ch-img-2">
										<div class="ch-info selected">
											<h3>Coming soon!</h3>
											<p>This game will be supported soon!</p>
										</div>
									</div>
								</li>
								<li>
									<h3 class="title">Starcraft II</h3>
									<div class="ch-item ch-img-3">
										<div class="ch-info selected">
											<h3>Coming soon!</h3>
											<p>This game will be supported soon!</p>
										</div>
									</div>
								</li>
								<li>
									<h3 class="title">Dota II</h3>
									<div class="ch-item ch-img-4">
										<div class="ch-info selected">
											<h3>Coming soon!</h3>
											<p>This game will be supported soon!</p>
										</div>
									</div>
								</li>
							</ul>
						</blocks>
					</column><!-- ./column end-->
				</row><!-- ./games row end-->
				
			</div><!-- ./container end -->
		</div><!-- ./games panel end -->
	
	<!-- End panel 5-->
	
	</div>
	<div class="clearfix"></div>			

	<!-- Start loading -->
	
		 <!--
			 <div id="loadingoverlay"><h3><span class="large align-centered fa fa-spinner fa-spin"></span></h3><p></p><p></p><h1>Good Gaming Leagues.</h1><br/><p> Please wait while we load our content.</p></div>
		-->
	<!-- End loading -->
	
	<!-- Footer -->
	
	<?php require_once 'segments/footer.php'; ?>
	
	<!-- ./Footer End -->
</body>
</html>
