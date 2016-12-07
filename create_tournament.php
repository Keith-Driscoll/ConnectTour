<?php 
    
    //require_once("classes/Login.php");
    //checks if a player is logged in, and displays navbar accordingly
    //$login = new Login();
    /*
    if ($login->isUserLoggedIn() == true) {
        include("segments/logged_in.php");
    } else {
		echo "Not logged in";
        header('Location: http://www.ggleagues.com/logintocontinue.php');
    } 
    */
    include 'segments/header.php';
	include "segments/navigation.php";
    require_once 'classes/connections.php';
    $db_connection = db_connect();
    $stmt = $db_connection->prepare("INSERT INTO tours (tour_name, tour_type, 
															tournament_details, tour_start, 
															tour_max, tournament_entry_fee, tour_price, 
                                                           tour_region, tournament_privacy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,
                                                                   ?)");
	$timestamp =  "" . $_POST['tour_start']." ".$_POST['StartTime'];
    if(isset($_POST["submit"])){							   
        $stmt->bind_param("sssssidiss", $_POST['game'], $_POST['name'], $_POST['desc'],$timestamp, $_POST['max_players'], $_POST['entry_fee'], 
                                        $_POST['start_prize_pool'], $_POST['region'], $_POST['privacy']);
        if($stmt->execute()){
            echo "Done";
        } 
        else echo mysqli_error($db_connection);
        $stmt->close();
        $lastid = $db_connection->insert_id;	
        $sql = "INSERT INTO chat_session (chat_class, class_id) VALUES ('tournament_lobby', ".$lastid.")";
        $db_connection->query($sql);
        //deal with league scheduling table
        if($_POST['format']==='League'){
            $num_matches = intval($_POST['matches_per_week']);   
            $lastid=1;
            for($i=0;$i<$num_matches;$i++){
                $daypost = 'dayofweek'.$i;
                $timepost = 'time'.$i;
                $time=$_POST[$timepost];
                $daynumber =0;
                switch($_POST[$daypost]){
                    case 'Monday':
                        $daynumber=1;
                        break;
                    case 'Tuesday':
                        $daynumber=2;
                        break;
                    case 'Wednesday':
                        $daynumber=3;
                        break;
                    case 'Thursday':
                        $daynumber=4;
                        break;
                    case 'Friday':
                        $daynumber=5;
                        break;
                    case 'Saturday':
                        $daynumber=6;
                        break;
                    case 'Sunday':
                        $daynumber=7;  
                        break;
                    default:
                        break;            
                }
                
                 $sql = "INSERT INTO league_scheduling (league_id,day,time) VALUES ($lastid,$daynumber,'$time')";
                 $db_connection->query($sql);
                
            }
        }
        header("Location: /tournamentinfo.php?id=".$lastid);
        $db_connection->close();
        
   }	
	

	

?>	
<script src='js/jquery.min.js'></script>
<script>
    $('document').ready(function(){
        $('#leaguedetails').hide();
        
        $('#format').on('change', function() {
            if(this.value=='League'){
                $('#leaguedetails').show();
            }
            else{
                $('#leaguedetails').hide();
            }
        });
        
        $('#matches_per_week').on('change',function(){
            var i = parseInt(this.value);
            $('.dayform').remove();
            for(var j=0;j<i;j++){
                var html_string = "<div class='dayform'><br><select name='dayofweek"+j+"'><option>Monday</option><option>Tuesday</option><option>Wednesday</option><option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option></select><input type='time' name='time"+j+"'></input></div><br>";
                $(this).parent().append(html_string);
            }
        });
    });
    
    
</script>
<style>
	
	.top{
		margin-top:100px;
		color:white;
		background-color:grey;
		padding:10px;
		}
	
</style>
	
    <div class="container top">
        <!--<aside class="well col-lg-3 col-mid-3 col-sm-3 hidden-xs">
            <ul>
                <li><legend>Sidebar</legend></li>

                <li>
                    <p>Lorem ipsum doler sit amet.</p>
                </li>

                <li><a href="#">link</a></li>

                <li><a href="#">link</a></li>

                <li><a href="#">link</a></li>

                <li><a href="#">link</a></li>

                <li><a href="#">link</a></li>
            </ul>
        </aside>-->

        <div style="margin-bottom:10px"class="container col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="well container col-lg-12 col-md-9 col-sm-12 col-xs-12">
                <h3>Create your own Tour</h3>

                <p>Lorem ipsum doler sit amet.</p>
            </div>

            <div class="clearfix"></div>

                <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div id="legend">
                        <legend class="">Create Tour</legend>
                        
                    </div>
<!-- Tour START -->

                    <div class="control-group col-md-6 col-sm-4 col-xs-12">
                        <label class="control-label" for="region">Tour</label>

                        <div class="controls">
                            <select id="tour_type" name="type" required="">
                                <option value='Sport'>Sport</option>
                                <option value='History'>History</option>
                                <option value='Architecture'>Architecture</option>
                                <option value='Adventure'>Adventure</option>
                                <option value='Scenic'>Scenic</option>
                        </select>

                           
                        </div>
                    </div>
                    <!-- Tour END-->
                    
                    <!-- DATE START -->

                    <div class="control-group">
                        <label class="control-label" for="tour_start">Start date *</label>

                        <div class="date controls">
                            <input data-format="dd/MM/yyyy hh:mm" type="date" id="tour_start" name="tour_start" required=""></input>
                           
                            <p class="help-block">Choose your tournament start time/date</p>
                        </div>
                    </div>
                    <!-- DATE END-->
                    
                    <!-- TIME START -->

                    <div class="control-group">
                        <label class="control-label" for="StartTime">Start time *</label>

                        <div class="date controls">
                            <input data-format="dd/MM/yyyy hh:mm" type="time" id="StartTime" name="StartTime" required=""></input>
                           
                            <p class="help-block">Choose your tour start time</p>
                        </div>
                    </div>
                    <!-- TIME END-->
                    
                    
                    <!-- START -->

                    <div class="control-group">
                        <label class="control-label" for="tour_name">Tour Name *</label>

                        <div class="controls">
                            <input type="text" id="tour_name" name="name" placeholder="Enter name" class="input-xlarge" required="">

                            <p class="help-block">This will display your tour name in the tours listing directory</p>
                        </div>
                    </div>
                    <!-- END-->
                    
                    <!-- DESCRIPTION-->

                    <div class="control-group">
                        <label class="control-label" for="desc">Description *</label>

                        <div class="controls">
                            <textarea type="text" class="textarea" maxlength="500" id="desc" name="desc" placeholder="Enter description (max 500 characters)" class="input-xlarge" required=""></textarea>

                            <p class="help-block">Give your tour a relevant description.</p>
                        </div>
                    </div>
                    <!-- DESCRIPTION END-->
                    
                    <!-- FORMAT START

                    <div class="control-group">
                        <label class="control-label" for="format">Format</label>

                        <div class="controls">
                            <select name="format" id="format" required="">
	                            <option>Single Elimination</option>
	                            <option>Double Elimination</option>
                                <option>League</option>
	                            <option>Groups - Single Elimination</option>
	                            <option>Groups - Double Elimination</option>
                            </select>
                        

                            <p class="help-block">Select your favoured tournament format.</p>
                        </div>
                        
                        <div class="control-group" id='leaguedetails'>
                             <label class="control-label" >Matches Per Week</label>

                            <div class="controls">
                                <select name='matches_per_week' id='matches_per_week'>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <!-- FORMAT END-->
                    
                    <!-- MAX Tourists START -->

                    <div class="control-group">
                        <label class="control-label" for="tour_max">Max Tourists</label>

                        <div class="controls">
                            <select name="tour_max" id="tour_max" required="">
	                            <option>8</option>
                                <option>12</option>
                                <option>16</option>
                                <option>20</option>
                                <option>25</option>
                                <option>30</option>
	                            <option>40</option>
	                            <option>50</option>
	                            <option>64</option>
	                            <option>128</option>
	                            <option>256</option>
	                            <option>512</option>
                            </select>

                            <p class="help-block">Determine how many tourists you want to be able to join your tour</p>
                        </div>
                    </div>
                    <!-- MAX TOURISTS END-->
                  
                    <!-- PRIVACY START -->

                    <div class="control-group">
                        <label class="control-label" for="privacy">Privacy</label>

                        <div class="controls">
                            <select name="privacy" id="privacy" required="">
	                            <option>Public Only</option>
	                            <option>Premium Only</option>
	                            <option>Invite Only</option>
                            </select>
                        

                            <p class="help-block">Select your preferred privacy setting</p>
                        </div>
                    </div>
                    <!-- PRIVACY END-->
                    
                    <!-- REGION START -->

                    <div class="control-group">
                        <label class="control-label" for="tour_region">Region</label>

                        <div class="controls">
                            <select name="region" id="tour_region" required="">
	                            <option>LEI</option>
	                            <option>MUN</option>
	                            <option>ULS</option>
                                <option>CON</option>
                            </select>

                            <p class="help-block">Select your preferred region</p>
                        </div>
                    </div>
                    <!-- REGION END-->
                    <!-- Price START -->

                    <div class="control-group">
                        <label class="control-label" for="entry_fee">Entry Fee</label>

                        <div class="controls">
                            <select name="entry_fee" id="entry_fee" required="">
	                            <option>0</option>
                                <option>1</option>
	                            <option>2</option>
	                            <option>3</option>
	                            <option>4</option>
                                <option>5</option>                          
                            </select>

                            <p class="help-block">Select your starting entry fee</p>
                        </div>
                    </div>
                    <!-- Prize pool END-->
                    
                    <!-- Entry Fee START -->

                    <div class="control-group">
                        <label class="control-label" for="tour_price">Tour Price </label>

                        <div class="controls">
                            <input type="number" name="tour_price" id="tour_price" placeholder="€" required=""></div>

                            <p class="help-block">Enter the price of tour</p>
                        </div>
                    <!-- Entry Fee END-->
                    <!-- SUBMIT Button -->
                    <div class="control-group">
                        <div class="controls">
                            <button id="submit" name="submit" class="btn btn-success">Create</button>
	                        
                        </div>
                    </div>
                </form>
            </div><!-- div .create END -->
        </div>
    </div><!-- main container end-->
    <?php include 'segments/footer.php' ?>
