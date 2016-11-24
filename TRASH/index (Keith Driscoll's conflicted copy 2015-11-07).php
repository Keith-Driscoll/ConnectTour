<?php

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
    include("segments/logged_in.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("segments/not_logged_in.php");
}
?>
<?php
    mysqli_errno();
	include "segments/jumbotron.php";
?>

 <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">World Class Platform!</h2>
                    <h3 class="section-subheading text-muted">Our features empower players to take their competitive gaming to a whole
                    new level!</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="glyphicon glyphicon-thumbs-up fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Ease of Use</h4>
                    <p class="text-muted">From the ground up we have designed our service with you, the gamer, in mind. Everything on our site is desgined to be intutive, beautiful and easy to use. Our features will get you playing competitively in no time!</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Responsive Design</h4>
                    <p class="text-muted">Want to access your account on your gaming pc? How about on your tablet as you relax in bed? Or even on your mobile while you travel? Our resposive design means you can take your competitive gaming wherever you go!
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Security</h4>
                    <p class="text-muted">Never have to worry about scams or shaky tournament organisers again. Here at Good Gaming Leagues we take security very seriously. That's why all of the money transactions are handled by us and processed through PayPal, using industry grade security to protect your privacy.</p>
                </div>
            </div>
        </div>
    </section>

<br/>
<br/>


<!-- Page Content -->

	<a  name="services"></a>
    <div class="content-section-a">

        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Community created tournaments!</h2>
                    <p class="lead"> Set up and run a tournament for your favourite game in just minutes! Our in house features provide you
					with the customisation options and tools you need to turn your competitve tournament into a reality. Crowd funded prize  				pools get the whole community involved. With powerfull yet simple tools, see how easy it is get competitively gaming today!  </p>
                    <a href="#" class="btm_margin btn btn-default btn-lg"><i class="fa fa-check-square-o fa-fw"></i> <span class="network-name">Sign Up!</span></a>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="http://placehold.it/500x350" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-a -->

    <div class="content-section-b">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Competitively driven leagues!</h2>
                    <p class="lead">Easily set up or a join a league today and battle it out with others for the top position! Our league system
					will take your competitive gaming to a whole new level! With live stat tracking and our social platform reputation and 		progression systems, start battling your way to the top today!</p>
                    <a href="#" class="btm_margin btn btn-default btn-lg"><i class="fa fa-plus fa-fw"></i> <span class="network-name">Create!</span></a>
                </div>
                <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                    <img class="img-responsive" src="http://placehold.it/500x300" alt="">
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.content-section-b -->

    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">A social gaming platform. <br> For gamers, powered by gamers!</h2>
                    <p class="lead">"We started from the bottom now we are here!" Work your rep and connect to players and teams that matter to you with our unique social gaming platform! Craft your profile to perfection and back up that image with some solid competitive gaming! No matter how serious you take your gaming, our platform will connect you, support you and empower you to take it to next level! </p>
                    <a href="#" class="btm_margin btn btn-default btn-lg"><i class="fa fa-check-square-o fa-fw"></i> <span class="network-name">Get started!</span></a>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="http://placehold.it/500x300" alt="">
                </div>
            </div>
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-section-a -->
	<a  name="contact"></a>
    <div class="banner">

        <div class="container">

            <div class="row">
                <div class="col-lg-4">
                    <h2>Connect with us:</h2>
                </div>
                <div class="col-lg-8">
                    <ul class="list-inline banner-social-buttons">
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-twitch fa-fw"></i> <span class="network-name">Twitch</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-youtube fa-fw"></i> <span class="network-name">Youtube</span></a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.banner -->




<?php include "segments/footer.php"?>