<row>
	<column cols='5'>
		<div id='opponentChoicesRep<?=$self?>' style='color:black;'></div>													

		<div id='opponentChoices<?=$self?>' style='color:black; transition: all 1s ease;'>
			<?php 
				//Should we include class picked
				if(($pickState == 1 || $pickState == 3) && $banState == 0){
					include 'class_selection.php';
				} else if (($pickState == 2 || $pickState == 4) && $banState == 0){
					echo "<script>
							getTheClassStuff(".$pickState.", ".$self.");
						</script>";
				}
			?>		
		</div>	
		<div id="bansSection<?=$opponent?>">
				<?php 
					if($banState != 4 && $pickState == 4){
						echo $choicesStringLeft;	
					}										
				?>
			</div>										
	</column>
	<column cols='2' class='matchReport' id='matchReport'>
		<?php
			//if bans are complete
			if($banState == 4){
		?>
		<button id="popup" class="reportButton" onclick="div_show();">Report</button>
			
		<!-- ./match reporting end -->
		<?php } ?>
	</column><!-- ./container end -->
	<column cols='5'>
		<div id='opponentChoicesRep<?=$opponent?>' style='color:black;'></div>
		<div id='opponentChoices<?=$opponent?>' style='color:black; transition: all 1s ease;'>
			<?php
				if ($pickState != 4 && $banState == 0){
					echo $choicesStringRight;
				}
			?>
		</div>
		<div id="bansSection<?=$self?>">
			<?php 
				if($banState == 3 || $banState == 1){
					echo "<input onclick='submitBans()' class='btn bans-submit' type='button' value='Confirma Bans' />
						<div id='bansResponder'></div>";	
				}										
			?>
		</div>
	</column>
</row>