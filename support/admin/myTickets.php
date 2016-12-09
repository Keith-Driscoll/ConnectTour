<?php 
	require_once 'classes/connections.php';
	$db_connection = db_connect();
	session_start();
	$sql = "SELECT id FROM support_staff WHERE p_id = ".$_SESSION['user_id'];
	$result = $db_connection->query($sql);
	$support_id = $result->fetch_assoc();
?>
	
<script>
	var jsonData1;
	var jsonData2;
	function filter(){		
		filterResults1();
		filterResults2();
	}

	function filterResults1(){
		$.ajax({
			type: "POST",
			url: "support/admin/applyfilter.php",
			dataType : 'json',
			cache: false,
			data: {query: 0, id:<?=$support_id['id']?>},
			success: function(records){
				jsonData1 = records;
				changePage(1, 1);			
			},
			error: function(jqXHR, textStatus, errorThrown) {
			
			}
		});
	}
	function filterResults2(){
		$.ajax({
			type: "POST",
			url: "support/admin/applyfilter.php",
			dataType : 'json',
			cache: false,
			data: {query: 1, id:1},
			success: function(records){
				jsonData2 = records;
				changePage(1, 2);			
			},
			error: function(jqXHR, textStatus, errorThrown) {
			
			}
		});
	}
	
</script>	

<?php
	include 'pagination.php';
?>
<script src="http://code.jquery.com/jquery-latest.js"></script> 
<script>
	$(document).ready(function(){
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
					<label>Game</label>
					<select id="game" class="select width-12" name='game'>
						<option>Choose Game</option>
						<option value='Hearthstone'>Hearthstone</option>
						<option value='League_of_Legends'>League of Legends</option>
						<option value='Starcraft_II'>Starcraft II</option>
					</select>
				</div>	
				<!-- option divider -->
				<div class="linedividor"></div>
				<!-- ./option end -->
				<!-- option start -->
				<div>
					<label>Region</label>
					<select id="region" class="select width-12" name='region'>
						<option>Choose Region</option>
						<option value='EUW'>Europe West</option>
						<option value='EUNE'>Europe North-East</option>
						<option value='NA'>North America</option>
					</select>
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
