<?php
	include 'classes/connections.php';
    require_once("classes/Login.php");
    include 'classes/doLoginCheck.php';
    //checks if a player is logged in, and displays navbar accordingly

    //pulls game name following '?game = ' in url and stores in
    $game_name = $_GET['game'];

?>

<div class="jumbotron-mini">
    <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="tournament-info top col-lg-4 col-md-4 col-sm-3 hidden-xs">
            <div class="container col-lg-12 col-xs-12">
                <legend>
                    How to use these filters
                </legend>
                <ul class="filter-list">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <li><p>You must select an option supplied within a dropdown box to filter your search on your selection(s).</p></li>
                    </div>
                </ul>
            </div>
        </div>

        <!-- info box -->
        <div class="tournament-info top col-lg-7 col-md-7 col-sm-7 col-xs-12">
            <div class="container col-lg-12 col-md-12 col-sm-12 col-xs-12">
        		<form action="" method="post">
                <legend>
                    Search Filters:
                </legend>
                <ul class="filter-list">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <li>Game:<br/>
                            <select id="game" name="game" required="">
                                <option>Hearthstone</option>
                                <option>League of Legends</option>
                                <option>Starcraft II</option>
                                <option>Minecraft</option>
                            </select>
                        </li>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                        <li>Format:<br/>
                            <select id="game" name="game" required="">
                                <option>Single Elimination</option>
                                <option>Double Elimination</option>
                                <option>Group - Single Elimination</option>
                                <option>Group - Double Elimination</option>
                            </select>
                        </li>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-6">
                        <li>Status:<br/>
                            <select id="game" name="game" required="">
                                <option>Open</option>
                                <option>Closed</option>
                                <option>Finished</option>
                            </select>
                        </li>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                        <li>Region:<br/>
                            <select id="game" name="game" required="">
                                <option>Europe</option>
                                <option>America</option>
                            </select>
                        </li>
                    </div>
                </ul>

                <button id="join-tournament-btn" class="btn btn-join-tournament" onclick="">Apply Filters</button>
                <button id="join-tournament-btn" class="btn btn-join-tournament" onclick="" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Tables -->

<div class="container col-lg-12 col-md-12">
    <table id="table" class="table-responsive col-lg-12 col-md-12 col-sm-12 compete-tables table-striped table-hover filterable sort-table">

        <?php
        	//switch deals with tournament filtering from Compete->game type
        	//Displays only the tournaments of the game type specified in $game_name

        	$db_connection = db_connect();
        	switch($game_name){
        		case "Hearthstone":
        			$sql = "SELECT * FROM tournaments WHERE tournament_game = 'Hearthstone'";
        			break;
        		case "League_of_Legends":
        			$sql = "SELECT * FROM tournaments WHERE tournament_game = 'League_of_Legends'";
        			break;
        		case "Starcraft_II":
        			$sql = "SELECT * FROM tournaments WHERE tournament_game = 'Starcraft_II'";
        			break;
        		default:
        			$sql = "SELECT * FROM tournaments";
        	}

			$result = $db_connection->query($sql);

			//if any tournaments of that type exist
			echo "<tr><th>Game</th><th>Name</th><th>Format</th><th>Start Date</th><th>Players</th><th>Enter</th><th>Prize Pool</th><th>Region</th></tr>";
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "
				    <tr>
	    		    	<td><img src='images/icons/png/".$row['tournament_game'].".png' alt='Hearthstone'/></td>
	    		    	<td><a href='tournamentinfo.php?id=".$row['id']."'>".$row["tournament_name"]."</a></td>
	    		    	<td>".$row["tournament_format"]."</td>
	    		    	<td>".$row["tournament_startdate"]."</td>	<td>".$row["tournament_current_players"]."/".$row["tournament_p_max"]."</td>
	    		    	<td><a class='btn btn-xs btn-join' title='join' type='button' value='join' href='tournamentinfo.php?id=".$row['id']."'>Join now</a></td>
	    		    	<td>"."€".$row["tournament_prize_pool_start"]."</td>
	    		    	<td>".$row["tournament_region"]."</td>
	    		    </tr>
	    	    ";
	    	}
			$db_connection->close();
        ?>
        <tr>
            <td colspan="8" class="table-spacing">
                <p class="pagination">Pagination:</p>
                <ul class="pages">
                	<li>First Page</li>
                	<li>Previous Page</li>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>Next Page</li>
                    <li>Last Page</li>
                </ul>
            </td>
        </tr>
    	<tfoot>
    		<th colspan="8" class="table-foot">Footer</th>
    	</tfoot>
    </table>
</div><!-- container close -->

<link href="../css/tournaments.css" rel="stylesheet" type="text/css" />
<?php include 'segments/footer.php';?>