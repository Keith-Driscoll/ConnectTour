<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
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
    <link href="../css/customUI.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid col-lg-12 col-md-12 col-sm-12">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div>
                    <h1><a  class="navbar-brand" href="index.php">GGLeagues</a></h1>
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
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">COMPETE <span class="caret"></span></a>
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

                        </ul>
                    </li>
                    <!--Mobile Menu END-->
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
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['user_name']; ?><span class="caret"></span></a>
                        <ul class="dropdown-menu">

                            <!--ECHO USER'S SESSION ID INTO PROFILE URL-->
                            <li><?php echo "<a href='profile.php?id=".$_SESSION['user_id']."'>View Profile</a>";?>
                            </li>
                            <li><a href="#">Edit Settings</a>
                            </li>
                            <li><a href="#">Messages</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Important Notifications</a>
                            <li><a href="index.php?logout">Logout</a>
                            </li>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>