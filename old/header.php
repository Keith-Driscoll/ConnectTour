
<!DOCTYPE html>
	<html lang="en" class="no-js">

	<head>
		<!-- SEO -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Ireland's best platform for gamers alike.">
		<meta name="author" content="Good Gaming Leagues">

		<title>Good Gaming Leagues - Ireland's #1 eSports platform</title>

		<!-- Bootstrap Core CSS -->
		<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />

		<!--Gylphicon social media set-->
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

		<!-- Custom CSS -->
		<link href="../css/style.css" rel="stylesheet" type="text/css" />
		<link href="../css/loginBox.css" rel="stylesheet" type="text/css" />
		<link href="../css/jumbotron.css" rel="stylesheet" type="text/css" />
		<link href="../css/navigation.css" rel="stylesheet" type="text/css" />
		<link href="../css/footer.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->



	</head>

	<body>

		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
						<div class="logo">
							<h1>
								<a class="navbar-brand" href="index.php"></a>
							</h1>
						</div>
					</div>

				<!-- Mobile Menu Start-->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<form class="navbar-form navbar hidden-md hidden-lg hidden-sm visible-xs" role="search">
						<div class="visible-xs">
							<!-- Second social icon set only for small devices-->
							<ul class="social-wrapper">
								<li><a href="#"><span class="social2 fa fa-facebook"></span></a>
								</li>
								<li><a href="#"><span class="social2 fa fa-twitter"></span></a>
								</li>
								<li><a href="#"><span class="social2 fa fa-twitch"></span></a>
								</li>
								<li><a href="#"><span class="social2 fa fa-youtube"></span></a>
								</li>
								<!--Social icon set end-->
							</ul>
						</div>
						<div class="form-group">
							<input type="text" class="form-control-static" placeholder="Search GGLeagues!">
							<button type="submit" class="btn btn-default">Search</button>
						</div>
					</form>

					<!--MAIN/Mobile Menu-->
					<ul class="nav navbar-nav">
						<li><a href="#">NEWS</a>
						</li>
						<li><a href="#">FEATURES</a>
						</li>
						<!-- Dropdown Start -->
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" href="tournaments.php">COMPETE <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="tournaments.php?game=Hearthstone">Hearthstone</a>
								</li>
								<li><a href="tournaments.php?game=League_of_Legends">League of Legends</a>
								</li>
								<li><a href="tournaments.php?game=Starcraft_II">Starcraft II</a>
								</li>
								<li role="separator" class="divider"></li>
								<li><a href="tournaments.php">Tournaments</a>
								</li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Leagues</a>
								</li>
								<li role="separator" class="divider"></li>

							</ul><!-- ./Dropdown END -->
						</li><!--Mobile Menu END-->
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden-xs"><a href="#"><span class="social fa fa-facebook"></span></a>
						</li>
						<li class="hidden-xs"><a href="#"><span class="social fa fa-twitter"></span></a>
						</li>
						<li class="hidden-xs"><a href="#"><span class="social fa fa-twitch"></span></a>
						</li>
						<li class="hidden-xs"><a href="#"><span class="social fa fa-youtube"></span></a>
						</li>
						<li class="hidden-xs">
							<button class="login" data-toggle="modal" data-target="#loginModal" href="">Login/Signup</button>


						</li>


					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
			<!-- /.container-fluid -->



		</nav>
		<div id="loginModal" class="modal fade" tabindex="" role="dialog" aria-hidden="true">
			<div class="col-lg-6 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
				<div class="panel panel-login">
					<span class="nav-left">
				<button class="popup fa-1x" data-toggle="modal" data-target="#loginModal">X</button>
            </span>
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Signup</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<!-- Login Form-->
								<form id="login-form" onsubmit="window.location.reload();" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
									<div class="form-group">
										<input type="text" name="user_name" id="login_input_username" tabindex="1" class="form-control" placeholder="Email/Username" required="">
									</div>
									<div class="form-group">
										<input type="password" name="user_password" id="login_input_password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label class="remember" for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login" id="login" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- ./Login Form END -->
								<!-- Register Form -->
								<form id="register-form" onsubmit="window.location.reload();" action="registration.php" method="post" style="display: none;">
									<div class="form-group">
										<input type="text" name="user_name" id="user_name" tabindex="1" class="form-control" placeholder="Username" value="" required="">
									</div>
									<div class="form-group">
										<input type="email" name="user_email" id="login_input_email" tabindex="1" class="form-control" placeholder="Email Address" value="" required="">
									</div>
									<div class="form-group">
										<input type="password" name="user_password_new" id="login_input_password_new" tabindex="2" class="form-control" autocomplete="off" placeholder="Password" required="">
									</div>
									<div class="form-group">
										<input type="password" name="user_password_repeat" id="login_input_password_repeat" tabindex="2" class="form-control" autocomplete="off" placeholder="Confirm Password" required="">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register" id="register" tabindex="4" class="form-control btn btn-register" value="Signup Now">
											</div>
										</div>
									</div>
								</form>
								<!-- ./Register Form END -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>