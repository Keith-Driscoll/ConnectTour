<?php

	// load the login class
	require_once("classes/Login.php");
	$login = new Login();
	if ($login->isUserLoggedIn() == true) {
	    include("segments/logged_in.php");
	} else {
	    include("segments/not_logged_in.php");
	}

	// load the jumbotron
	include "segments/jumbotron.php";

	// prints the last error
	mysqli_errno();
?>

	<section class="module">
		<div class="container">
			<div class="row">
				<!-- heading -->
				<div class="col-lg-12 text-center">
					<h2 class="section-heading">World Class Platform!</h2>
					<h3 class="section-subheading text-muted">Our features empower players to take their competitive gaming to a whole
					new level!</h3>
				</div><!-- ./ heading END -->
			</div><!-- ./row END -->
			<!-- Feature 1 - Easy -->
			<div class="row text-center">
				<div class="col-md-4">
					<span class="fa-stack fa-4x">
						<i class="fa fa-circle fa-stack-2x text-primary"></i>
						<i class="glyphicon glyphicon-thumbs-up fa-stack-1x fa-inverse"></i>
					</span>
					<h4 class="service-heading">Ease of Use</h4>
					<p class="text-muted">
						From the ground up we have designed our service with you, the gamer, in mind. Everything on our site is desgined to be intutive, beautiful and easy to use. Our features will get you playing competitively in no time!
					</p>
				</div><!-- ./Feature 1 END -->
				<!-- Feature 2 - Responsive -->
				<div class="col-md-4">
					<span class="fa-stack fa-4x">
						<i class="fa fa-circle fa-stack-2x text-primary"></i>
						<i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
					</span>
					<h4 class="service-heading">Responsive Design</h4>
					<p class="text-muted">
						Want to access your account on your gaming pc? How about on your tablet as you relax in bed? Or even on your mobile while you travel? Our resposive design means you can take your competitive gaming wherever you go!
					</p>
				</div><!-- ./ Feature 2 END -->
				<!-- Feature 3 - Security -->
				<div class="col-md-4">
					<span class="fa-stack fa-4x">
						<i class="fa fa-circle fa-stack-2x text-primary"></i>
						<i class="fa fa-lock fa-stack-1x fa-inverse"></i>
					</span>
					<h4 class="service-heading">Security</h4>
					<p class="text-muted">
						Never have to worry about scams or shaky tournament organisers again. Here at Good Gaming Leagues we take security very seriously. That's why all of the money transactions are handled by us and processed through PayPal, using industry grade security to protect your privacy.
					</p>
				</div><!-- ./feature 3 end -->
			</div><!-- ./row END -->
		</div><!-- ./container END -->
	</section><!-- ./ Section 1 END -->
	<!-- Section 2 START -->
	<section class="module parallax parallax-1">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-sm-6">
					<h2 class="content ">Community created tournaments!</h2>
					<!-- Spacer -->
					<hr class="section-heading-spacer ">
					<div class="clearfix"></div>
					<!-- section content -->
					<p class="lead content ">Set up and run a tournament for your favourite game in just minutes! Our in house features provide you with the customisation options and tools you need to turn your competitve tournament into a reality. Crowd funded prize pools get the whole community involved. With powerfull yet simple tools, see how easy it is get competitively gaming today!</p>
					<a href="" data-toggle="modal" data-target="#loginModal" class="btm_margin btn btn-default btn-lg animated bounceInUp"><i class="fa fa-check-square-o fa-fw"></i> <span class="network-name animated bounceInUp">Sign Up!</span></a>
				</div>
				<!-- Image -->
				<div class="col-lg-6 col-lg-offset-1 col-sm-6">
					<img class="img-responsive hidden-xs " src="http://placehold.it/500x350" alt="">
				</div>
			</div><!-- .row END -->
		</div><!-- /.container end -->
	</section><!-- ./Section 2 END -->
	<!-- Section 3 Start -->
	<section id="seamus" class="module">
		<div class="container ">
			<div class="row">
				<div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
					<h2 class="section-heading ">Competitively driven leagues!</h2>
					<!-- Spacer -->
					<hr class="section-heading-spacer ">
					<div class="clearfix"></div>
					<!-- section content -->
					<p class="lead ">Easily set up or a join a league today and battle it out with others for the top position! Our league system will take your competitive gaming to a whole new level! With live stat tracking and our social platform reputation and progression systems, start battling your way to the top today!</p>
					<a href="create_tournament.php" class="btm_margin btn btn-default btn-lg animated bounceInDown"><i class="fa fa-plus fa-fw"></i> <span class="network-name animated bounceInDown">Create!</span></a>
				</div>
				<!-- Image -->
				<div class="col-lg-6 col-sm-pull-6  col-sm-6">
					<img class="img-responsive hidden-xs " src="http://placehold.it/500x350" alt="">
				</div>
			</div><!-- ./ row END-->
		</div><!-- /.container END -->
	</section><!-- ./ Section 3 END -->
	<!-- Section 4 Start -->
	<section class="module parallax parallax-2">
		<div class="container ">
			<div class="row">
				<div class="col-lg-5 col-sm-6">
					<h2 class="section-heading content ">For gamers, powered by gamers!</h2>
					<!-- Spacer -->
					<hr class="section-heading-spacer ">
					<div class="clearfix"></div>
					<!-- section content -->
					<p class="lead content ">"We started from the bottom now we are here!" Work your rep and connect to players and teams that matter to you with our unique social gaming platform! Craft your profile to perfection and back up that image with some solid competitive gaming! No matter how serious you take your gaming, our platform will connect you, support you and empower you to take it to next level! </p>
					<a href="features.php" class="btm_margin btn btn-default btn-lg animated bounceInUp"><i class="fa fa-check-square-o fa-fw"></i> <span class="network-name animated bounceInUp">Learn More!</span></a>
				</div>
				<!-- Image -->
				<div class="col-lg-6 col-lg-offset-1 col-sm-6">
					<img class="img-responsive hidden-xs " src="http://placehold.it/500x350" alt="">
				</div>
			</div><!-- ./Row END-->
		</div><!-- ./Container END -->
	</section><!-- ./Section 4 END -->
<!-- Get in touch with us Section START -->
	<section class="module parallax parallax-3">
		<div class="banner ">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<h2>Stay in Touch:</h2>
					</div>
					<div class="col-lg-8">
						<ul class="list-inline banner-social-buttons">
							<!-- Facebook button -->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
								<li>
									<a target="_blank" href="http://www.facebook.com/" class="btn btn-default btn-lg animated flip"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
								</li>
							</div>
							<!-- Twitter button -->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
								<li>
									<a target="_blank" href="http://www.twitter.com/" class="btn btn-default btn-lg animated flip"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
								</li>
							</div>
							<!-- Twitch button -->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
								<li>
									<a target="_blank" href="http://www.twitch.com/" class="btn btn-default btn-lg animated flip"><i class="fa fa-twitch fa-fw"></i> <span class="network-name">Twitch</span></a>
								</li>
							</div>
							<!-- Youtube button -->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
								<li>
									<a target="_blank" href="http://www.youtube.com/" class="btn btn-default btn-lg animated flip"><i class="fa fa-youtube fa-fw"></i> <span class="network-name">Youtube</span></a>
								</li>
							</div>
						</ul>
					</div>
				</div>
			</div>
			<!-- /.container -->
		</div>
		<!-- /.contact -->
	</section>

<!-- Transitions -->
<link rel="stylesheet" type="text/css" href="../css/parallax.css" />
	<?php include "segments/footer.php" ?>