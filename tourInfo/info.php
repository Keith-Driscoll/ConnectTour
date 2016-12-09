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
							<li>Type: ".$row['tour_type']."</li>
							
							<li>Start-Date: ".$row['tour_start']."</li>
							
							<li>Max Tourists: ".$row['tour_max']."</li>
						";
					?>
				</ul>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
				<ul>
					<?php 
						//prints out the relevant details for the tour
						echo "
					
							<li>Current-Members: ".$row["tour_members"]."</li>
							<li>Entry-fee: ".$row["tour_entry_fee"]."</li>
							<li>Region: ".$row["tour_region"]."</li>
							<li>Price: ".$row["tour_price"]."</li>
							<li>Privacy: ".$row["tour_privacy"]."</li>
						";
                    ?>
				</ul>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<h4>tour Description</h4>
            
                <div class="nameOfDetail piece">
                    Tour Details
                </div>
                <div class="actualDetail piece">
                    <?= $row['tour_details'];?>
                </div>
            
			
		</div>
	</div>
</div>