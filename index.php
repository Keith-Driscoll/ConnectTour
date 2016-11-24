<?php require_once 'segments/header.php';
	  //require_once 'classes/connections.php';
	  //require_once 'classes/Login.php';
	  //session_start();
	  //echo "SESSION ID:".session_id();
	  //$login = new Login();
	  //$loggedIn = $login->isUserLoggedIn() 
?>
<!-- Insert additional scripts here -->
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/pages/landingPage.css"/>
<link rel="stylesheet" href="css/pages/signup.css"/>
<link rel="stylesheet" href="css/games.css"/>
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
											<li style="background-image: url(images/homepage/GPO.jpg)">
												<div class="info">
												<h2>Who IS Keith</h2>
												<div class="bg-border">
													<p>At Connect Tour we provide a service that allows genuine local people to give tours of t.</p>
												</div>
											</div>
												
											</li> 
								            <li style="background-image: url(images/homepage/HaPennyBridge.jpg)">
									            
									            <div class="info">
													<h2>What we do</h2>
													<div class="bg-border">
														<p>To enable gamers to create their own or take part in competitive tournaments &amp; leagues at the highest standard for cash prizes.</p>
													</div>
												</div>
									            
								            </li> 
								            <li style="background-image: url(images/homepage/esports_event.jpg)">
											
									            <div class="info">
													<h2>Alpha Launch Tournament</h2>
													<div class="bg-border">
														<p>Join our community and compete in tournaments created by other players for cash prizes.</p>
													</div>
												</div>
									            
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
										
											<h1>Alpha Signup</h1>
											
											<p>Sign up to get involved with our Alpha launch. Help improve the quality of our development. Keep up to-date with upcoming deals & features!</p>
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
	<section class="featured">
	<!-- Start panel features -->
	
		<div class="panel">
		
			<div class="container">
				<!-- row start -->
				<row centered>
					<column cols="4">
						<div class="inner align-centered">	
							<img src="images/svg/chalkboard.svg" class="features-icon board" alt="Error: Unable to load"/>			
							<h3>Simple &amp; Easy</h3>
							<p>With our minimalist approach, you can create and participate in competitions with ease</p>	
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./ column end -->
					<!-- column start -->
					<column cols="4">
						<div class="inner align-centered">
							<img src="images/svg/dollar-bill.svg" class="features-icon dollar" alt="Error: Unable to load"/>
							<h3>Win Cash prizes</h3>
							<p>Join tournaments and leagues and win real cash prizes. Earn cash playing games you love!</p>
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./column end -->
					<!-- column start -->
					<column cols="4">
						<div class="inner align-centered">
							<img src="images/svg/lock.svg" class="features-icon lock" alt="Error: Unable to load"/>
							<h3>Secure</h3>
							<p>We ensure your safety can rest assured with our industry standard protection.</p>
							<div class="clearfix"></div>
							
						</div>
					</column><!-- ./column end -->		
				</div>			
			</div>
			
			<div class="clearfix"></div>
		
		</row> <!-- ./ row end -->
		</div><!-- ./Container end-->
	</div><!-- End panel features-->
</section><!-- ./section end-->
<!-- Call to action -->
<section class="alpha">
	<div class="panel-alt">
		<div class="container align-centered alpha-signup">
			<h2>Our Aims</h2>
			<hr class="divider">
			<p>Every gamer should have the opportunity to compete in a competitive environment against other players of the same level and gaming interests. Our aim at GGLeagues is to provide tournaments and leagues for players of all abilities and skill levels.
We want to improve the quality of e-sports tournaments for everyone, on every device.<br/></p>
			<!--<p><b>At GGLeagues, we are unified on three core values:</b></p>
			<p>
				<b>-</b> A competitive community environment.</br>
				<b>-</b> Full tournament control for gamers and companies.</br>
				<b>-</b> Quick and reliable payouts.
			</p>-->
			<br/>
			<!--<p>Join GGLeagues today and <i>help us reach these aims!</i></p>-->
			<a href="signup.php">
				<button class="button big">Join GGLeagues Today!</button>
			</a>
		</div><!-- ./container end -->
	</div><!-- ./panel end -->
</section><!-- ./section end -->

<section class="soon">
	<!-- Start panel 1-->
	<div class="panel">
		<div class="features panel box-right">
		
			<div class="container align-centered">
			<div class="divide">
				<h3>Under Development</h3>
			</div>
				<!-- 1st row start -->
				<row centered class="featured">
					<!-- first column -->
					<column cols="4">
						<div class="inner">
							<img src="images/svg/team.svg" class=""/>
							<h3>Profiles</h3>
							<p>Customize your gamer profile, follow your friends and join the same competitions as them!</p>
						</div>
					</column><!--./ 1st column end -->

					<!-- second column -->
					<column cols="4">
						<div class="inner">
							<img src="images/svg/lifebuoy.svg" class=""/>
							<h3>User Support</h3>
							<p>User feedback is very important to us. Help us find bugs and improve our existing features!</p>
						</div>
					</column><!-- ./2nd column end -->

					<!-- third column -->
					<column cols="4">
						<div class="inner">
							<img src="images/svg/alarm-clock2.svg" class=""/>
							<h3>Waiting Lists</h3>
							<p>Once a full tournament starts, open slots will be filled by players in the waiting list!</p>
						</div>
					</column><!-- ./3rd column end -->
				</row><!-- ./1st row end -->
				<div class="divide">
					<h3>Up Next!</h3>
				</div>
				<!-- 2nd row start -->
				<row centered class="featured">
					<!-- first column -->
					<column cols="4">
						<div class="inner">
							<img src="images/svg/change.svg" class=""/>
							<h3>Entry Fees</h3>
							<p>Organising a tournament? Wallet not thick enough? Crowd fund the prize pool by setting an entry fee!</p>
						</div>
					</column><!--./ 1st column end -->

					<!-- second column -->
					<column cols="4">
						<div class="inner">
							<img src="images/svg/trophy.svg" class=""/>
							<h3>Leagues</h3>
							<p>Leagues coming soon! Think you’re the best? Prove your skill and endurance in our bimonthly leagues hosted by GGLeagues and other top gamers!</p>
						</div>
					</column><!-- ./2nd column end -->

					<!-- third column -->
					<column cols="4">
						<div class="inner">
							<img src="images/svg/television.svg" class=""/>
							<h3>Live Streaming</h3>
							<p> Live streams coming soon! Watch livestreams of top players battling it out against each other in our tournaments and leagues.</p>
						</div>
					</column><!-- ./3rd column end -->
				</row><!-- ./2nd row end -->
			</div><!-- ./container end -->
		</div><!--./features end -->
	</div><!-- ./promo panel end-->
</section>
	
	</div>
	<div class="clearfix"></div>			

	<!-- Start loading -->
	
		 <!--
			 <div id="loadingoverlay"><h3><span class="large align-centered fa fa-spinner fa-spin"></span></h3><p></p><p></p><h1>Good Gaming Leagues.</h1><br/><p> Please wait while we load our content.</p></div>
		-->
	<!-- End loading -->
	
	<!-- Footer -->

<!-- Start footer -->

		<div id="footer">

			<div class="container">
				<row centered>
					<h1>Alpha Signup</h1>
				</row>
				<row centered class="footer-signup">
					<column cols="6">
						<form method="post" action="signup.php" class="form">
							<div class="form-item">
								<div class="controls width-50">
									<input type="text" name="search" placeholder="email address">
									<button class="button primary">Sign up!</button>
								</div>
							</div>
						</form>
					</column>
				</row>
				<row centered>
					
					<column cols="1">
					<!-- icon alignment -->
						<!-- icon -->	
						<a href="https://www.facebook.com/GoodGamingLeagues/">
							<span aria-hidden="true" class="social_facebook medium" ></span> 
						</a><!-- ./icon end-->
					</column>
					<column cols="1">	
						<!-- icon -->	
						<a href="http://www.twitter.com/ggleagues">
							<span aria-hidden="true" class="social_twitter medium" ></span> 
						</a><!-- ./icon end-->
					</column>
					<!--<column cols="1">							
						<a href="#!">
							<span aria-hidden="true" class="social_instagram medium" ></span> 
						</a>
					</column>
					<column cols="1">	
						<a href="#!">
							<span aria-hidden="true" class="social_linkedin medium" ></span> 
						</a>
					</column>-->
					
				</row><!-- ./row end -->
				
			</div><!-- ./container end-->
			
		</div><!-- ./footer div end -->
		<div class="clearfix"></div>
		
		<footer class="footer promo">
			<div class="container">
				<row centered>
					<column cols="8">
						<div class="align-centered inner">
							<p>&copy; 2015-2016 <a href="index.php">Good Gaming Leagues</a>.</p>
						</div>
					</div>
				</row>
			</div>
		</footer><!-- ./footer tag end -->
	<!-- End footer -->
	
	<!-- Load scripts -->
	<script src="../js/respond.min.js"></script>
	<script defer src="../js/jquery.flexslider-min.js"></script> 
	<script src="../js/jquery.form.js"></script>
	<script src="../js/jquery.validate.min.js"></script>
	<script src="../js/scripts.js"></script> 
	<script src="../js/navigation.js"></script> 
	<!--<script src="../js/signup.js"></script>-->
	<!--[if lte IE 7]><script src="js/lte-ie7.js"></script><![endif]-->
	
	<!-- ./ End Script Loading -->
	
	<!-- ./Footer End -->
</body>
</html>