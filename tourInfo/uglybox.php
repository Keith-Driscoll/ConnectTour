<div class="container col-lg-12 col-xs-12">
	<legend>
		Extra info goes here               
	</legend>
	<ul>
		<!--   echo out the tour information stored in $row   -->
		<div class="infoLeftBox col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<li>Game:
				<?php echo $row['tour_game']; ?>
			</li>

			<li>Start Date:
				<?php echo $row['tour_startdate']; ?>
			</li>

			</li>

			<li>Start Time:
				<?php echo $row['tour_starttime']; ?>
			</li>
			<li>Players:
				<?php echo $row['tour_current_players']. "/".$row[ 'tour_p_max']; ?>
			</li>
		</div>
		<div class="infoMidBox col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<li>Name:
				<?php echo $row['tour_name']; ?>
			</li>

			<li>Description:
				<?php echo $row['tour_details']; ?>
			</li>

			<li>Format:
				<?php echo $row['tour_format']; ?>
			</li>
			<li>Privacy:
				<?php echo $row['tour_privacy']; ?>
			</li>
		</div>
		<div class="infoRightBox col-lg-4 col-md-4 col-sm-4 col-xs-12">

			<li>Region:
				<?php echo $row['tour_region']; ?>
			</li>

			<li>Entry Fee:
				<?php echo "€".$row['tour_entry_fee']; ?>
			</li>

			<li>Prize Pool:
				<?php echo "€".$row['tour_prize_pool_start']; ?>
			</li>
			<!-- Join tour btn , add function inside 'onclick' event.-->
			<form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$t_id; ?>" method="post">
				<input class="btn btn-primary btn-lg" type="submit" value="Enter tour" name="join">
			</form>
		</div>
	</ul>
</div>
<link href="../css/uglybox.css" rel="stylesheet" type="text/css" />