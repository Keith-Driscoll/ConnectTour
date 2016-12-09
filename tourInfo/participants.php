<?php
    //query returns the set of all players who are part of the given tour
    $sql = "SELECT player.player_username,id  FROM player, tour_participants WHERE player.id = tour_participants.Player_id AND tour_participants.tours_id = '".$t_id."'";
    $result = $db_connection->query($sql);
    
    if ($result->num_rows > 0) {
        //for each entry as row, print participant box
		echo "<div class='clearfix'></div>";
        while($row = $result->fetch_assoc()) {
            //Participant Box						
			require_once 'getProfilePicture.php';
			$theProfilePic = getProfilePicture($row['id']);
            echo " 
					<div id='participantcard' class=''>
						<div onclick='window.location=`profile.php?id=".$row['id']."`;' class='participants onePerson'>
							<img src='".$theProfilePic."' class='' alt='user-profile' />
							<div><p>".$row['player_username']."</p></div>
						</div>
					</div>
			";
            //Participant Box End
        }
		echo "<div class='clearfix'></div>";
    }
?>