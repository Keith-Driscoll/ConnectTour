<?php 
	include 'pagination.php';
?>
<script src="http://code.jquery.com/jquery-latest.js"></script> 
<script>
	$(document).ready(function(){
		var game = "<?php echo $game; ?>";
		if (game != ""){		
			$('#game').val(game).prop('selected', true);
		}
		filter();
	});
</script>	
<!-- filters section -->
<column class="bothColumns" cols="2">
	<div class="filtersList">
		<!-- filters header -->
		<div class="filtersListHeader">
			<row centered>
				Filters
			</row>
		</div><!-- filters listheader end-->
		<div class="filterOptions">
			<form method="post" id="filters">
				<!-- option start -->
				<div>
					<label>Tour</label>
					<select id="Game" class="select width-12" name='category'>
						<option>Choose a category</option>
						<option value='Sport'>Sport</option>
						<option value='History'>History</option>
						<option value='Architecture'>Architecture</option>
					</select>
					<!--<select id="game" class="select width-12" name='game'>
						<option>Choose a categor</option>
						<option value='Hearthstone'>Sport</option>
						<option value='League_of_Legends'>History</option>
						<option value='Starcraft_II'>Archite</option>
					</select> -->
				</div>	
				<!-- option divider -->
				<div class="linedividor"></div>
				<!-- ./option end -->
				<!-- option start -->
				<div>
					<label>Region</label>
					<select id="region" class="select width-12" name='region'>
						<option>Choose Region</option>
						<option value='Leinster'>Leinster</option>
						<option value='Munster'>Munster</option>
						<option value='Connacht'>Connacht</option>
						<option value='Ulster'>Ulster</option>
					</select>
					<!--<label>Region</label>
					<select id="region" class="select width-12" name='region'>
						<option>Choose Region</option>
						<option value='EUW'>Europe West</option>
						<option value='EUNE'>Europe North-East</option>
						<option value='NA'>North America</option>
					</select>-->
				</div>		
				<!-- option divider -->
				<div class="linedividor"></div>
				<!-- ./option end -->
				<!-- apply button -->
				<input type='button' onclick='filter();' id='apply' value='Apply' class="applyButton width-12">
			</form>
		</div><!-- ./filter options end -->
	</div><!-- ./filters list end-->
</column> <!-- ./ filters end -->
	<!--	var game = document.forms['filters'].elements['game'].value;	var category = document.forms['filters'].elements['category'].value;-->
<script>
	var jsonData;
	function filter(){
		
var game = document.forms['filters'].elements['game'].value;
	
		var region = document.forms['filters'].elements['region'].value;
		filterResults(game, region);
	}

	function filterResults(game, region){
		$.ajax({
			type: "POST",
			url: "tournaments/applyfilter.php",
			dataType : 'json',
			cache: false,
			data: {Game: game, Region: region},
			success: function(records){
				jsonData = records;
				changePage(1);			
			},
			error: function(jqXHR, textStatus, errorThrown) {
			
			}
		});
	}
	
</script>	