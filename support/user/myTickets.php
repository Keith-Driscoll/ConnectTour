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
		filterResults();
	});
</script>	


<script>
	var jsonData;


	function filterResults(){
		$.ajax({
			type: "POST",
			url: "support/user/applyfilter.php",
			dataType : 'json',
			cache: false,
			success: function(records){
				jsonData = records;
				changePage(1);			
			},
			error: function(jqXHR, textStatus, errorThrown) {
			
			}
		});
	}
	
</script>	