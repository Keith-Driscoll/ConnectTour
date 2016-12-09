<div class="tab-pane" id="tourinfo">
	<div class="row">
		<!-- chatbox to be continued -->
    	
			<?php
				if ($intour && ($result->num_rows > 0) && $checkin['tour_checkin_phase'] != 0){
					echo "<div class='chat-box container col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        					<legend>Chatbox</legend>";
					$sql = "SELECT chat_id FROM chat_session WHERE class_id = '".$t_id."'";
					$result = $db_connection->query($sql);
					$chat_id = $result->fetch_assoc();
					$chat_id = $chat_id['chat_id'];
					
					include '/../chatbox.php';
					
					echo "</div><!-- ./ chatbox end -->";
				}
			 ?>
			
    	
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
			<h4>tour Information</h4>

			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
				<ul>
					<?php
						//prints out the relevant details for the tour
						echo "
							<li>Name: ".$row['tour_name']."</li>
							<li>Game: ".$row['tour_game']."</li>
							<li>Format: ".$row['tour_format']."</li>
							<li>Start-Date: ".$row['tour_startdate']."</li>
							<li>Start-Time: ".$row['tour_starttime']."</li>
							<li>Max Players: ".$row['tour_p_max']."</li>
						";
					?>
				</ul>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
				<ul>
					<?php 
						//prints out the relevant details for the tour
						echo "
							<li>Min-Players: ".$row["tour_p_min"]."</li>
							<li>Current-Players: ".$row["tour_current_players"]."</li>
							<li>Entry-fee: ".$row["tour_entry_fee"]."</li>
							<li>Region: ".$row["tour_region"]."</li>
							<li>Prize-pool: ".$row["tour_prize_pool_start"]."</li>
							<li>Privacy: ".$row["tour_privacy"]."</li>
						";
					?>
				</ul>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h4>tour Description</h4>
			<?php
				echo "
					<p>".$row["tour_details"]."</p>
				";
			?>
			<p> 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras justo lorem, ultricies a purus in, congue ullamcorper velit. 
				Suspendisse sed erat vitae enim dictum vulputate in laoreet quam. In mattis justo ut placerat mattis. Aliquam gravida, augue 
				eu lobortis luctus, diam arcu semper erat, eget placerat nunc nulla eu urna. Vivamus auctor malesuada mi imperdiet molestie. 
				Aenean diam ligula, auctor in tincidunt sit amet, placerat in ex. Nulla facilisi.
			</p>
			<p>
				Nam gravida ultrices ipsum, in maximus lorem mattis ac. Sed gravida orci eu turpis viverra, in lobortis massa sodales. Sed tortor 
				enim, congue sed faucibus ut, scelerisque ac quam. Integer ut orci molestie, tristique tortor in, interdum lacus. Integer ultrices 
				finibus magna eu semper. Vivamus mattis est dui, ut mattis ligula facilisis rhoncus. Proin in facilisis lacus. Suspendisse ut 
				lacus sem.
			</p>
			<p>
				Pellentesque in mattis erat, ac fermentum nisi. Aliquam consectetur tincidunt velit nec sollicitudin. Phasellus fermentum id 
				sapien sed finibus. Duis auctor eleifend ante eget suscipit. Aenean malesuada auctor iaculis. Donec feugiat ex sed diam faucibus 
				tempor. Donec lacinia aliquet massa, quis molestie augue sodales sit amet. Cras eu erat id magna venenatis lobortis.
			</p>
		</div>
	</div>
</div>