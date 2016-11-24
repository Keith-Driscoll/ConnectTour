<?php

    /* list of files included in this page
        bracketgeneration.php
    
	require_once("classes/Login.php");
    include 'classes/doLoginCheck.php';
    include 'classes/connections.php';
    include 'bracketgeneration.php';
    $db_connection = db_connect();

    //holds the id of the tournament, pulled from url
    $t_id = $_GET['id'];
    //holds user_id stored in session if the player is logged in
    $p_id = $_SESSION['user_id'];

    //query retrieves all data relating to the tournament $t_id
    $sql = "SELECT * FROM tournaments WHERE id = '".$t_id."'";
    $result = $db_connection->query($sql);
    $row = $result->fetch_assoc();

    //query retrieves the ids of all players registered to the tournament
    $sql = "SELECT Player_id FROM tournament_participants WHERE Player_id = '".$p_id."' AND tournaments_id = '".$t_id."'";
    $test = $db_connection->query($sql);

    //if user tries to join, is logged in, is not already part of the tournament, and there is space in the tournament;
    if (isset($_POST['join']) && ($login->isUserLoggedIn() == true) && ($test->num_rows == 0) && ($row['tournament_current_players'] < $row['tournament_p_max'])){

        //query adds player to tournament participants
        $sql = "INSERT INTO tournament_participants (Player_id, Tournaments_id) VALUES ('".$p_id."', '".$t_id."')";
        $enter = $db_connection->query($sql);

        //query increments number of players in tournament by 1
        $sql = "UPDATE tournaments SET tournament_current_players=tournament_current_players+1";
        $enter = $db_connection->query($sql);
    }
	*/
?>
<?php include 'header.php' ?>
<div class="jumbotron-mini">
    <div class="container col-lg-10 col-md-10 col-sm-10 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
        <!-- info box -->
        <div class="tournament-info top col-lg-9 col-md-9 col-sm-9 col-xs-12">

            <!-- Includes the shit box up the top that needs removing -->
            <?php include 'tournamentInfo/uglybox.php'; ?>
        </div>
    </div>
</div>
<div class="container">

    <!-- tabs n shit -->
    <div class="container col-sm-12 col-xs-12">
        <div class="content-right col-lg-12 col-md-12 col-sm-12 com-xs-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tournamentinfo" data-toggle="tab">Tournament Info</a>
                </li>
                <li>
                    <a href="#matchinfo" data-toggle="tab">Match Info</a>
                </li>
                <li>
                    <a href="#rules" data-toggle="tab">Rules</a>
                </li>
                <li>
                    <a href="#brackets" data-toggle="tab">Brackets</a>
                </li>
                <li>
                    <a href="#participants" data-toggle="tab">Participants</a>
                </li>
            </ul>
            <!-- Information -->
            <div class="tab-content">
                <div class="active tab-pane" id="tournamentinfo">

         	        <!-- include info file  -->
                    	<?php
							$sql = "SELECT tournament_checkin_phase FROM tournaments WHERE id = '".$t_id."'";
							$result = $db_connection->query($sql);
							if ($result){
								$checkin = $result->fetch_assoc();
							}
							include 'tournamentInfo/info.php';
                    	?>
                </div>

                <!-- Match Info -->
                <div class="tab-pane" id="matchinfo">

                    <!-- include match info file -->
                    <?php
                        include 'tournamentInfo/matchinfo.php';
                    ?>
                </div>

                <!-- Rules -->
                <div class="tab-pane" id="rules">
                    <?php
                        include 'tournamentInfo/rules.php';
                    ?>
                </div>

                <!-- Brackets -->
                <div class="tab-pane" id="brackets">
                    <!-- include bracket display file -->
                    <?php
                        include 'tournamentInfo/brackets.php';
                    ?>
                </div>

                <!-- Participants -->
                <div class='tab-pane' id='participants'>
                    <!-- include participant display file -->
                    <?php
                        include 'tournamentInfo/participants.php';
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- container end-->
<link href="../css/tournamentInfo.css" rel="stylesheet" type="text/css" />


<?php include 'segments/footer.php' ?>