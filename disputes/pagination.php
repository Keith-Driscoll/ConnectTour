<?php 
	// edited table formatting to make each row a link to it's respective
	// tournamentinfoNew.php page.
?>
<script>
	var current_page = 1;
	var records_per_page = 6;
	
	function firstPage(){
		current_page = 1;
		changePage(current_page);
	}	
	function prevPage() {
		if (current_page > 1) {
			current_page--;
			changePage(current_page);
		}
	}
	function nextPage(){
		if (current_page < numPages()) {
			current_page++;
			changePage(current_page);
    	}
	}
	function lastPage(){
		current_page = numPages();
		changePage(current_page);
	}

	function changePage(page){
		var btn_start = document.getElementById("firstPage");
		var btn_next = document.getElementById("nextPage");
		var btn_prev = document.getElementById("prevPage");
		var btn_end = document.getElementById("lastPage");
		// Validate page
		if(jsonData.length>0){
			if (page < 1) page = 1;
			if (page > numPages()) page = numPages();
		
			var fullString = new Array();
			$('#totalPages').html(numPages());
			for (var i = (page-1) * records_per_page; i < (page * records_per_page); i++) {
				
				var array = new Array();
				if(i < jsonData.length){
					$.each(jsonData[i], function(k , v) {				
						array.push(v);				
					});
					//Modified by Keith 30/6/2016
					var stringPart = `<div id="support-ticket" class="oneTournament">
									
											<a class="selected-ticket" href="dispute.php?id=`+array[0]+`">	
												<row centered>
													<column cols="4">`+array[1]+`</column>
													<column cols="3">`+array[2]+`</column>
													<column cols="1" class="sm-hidden">`+array[3]+`</column>
													<column cols="4">`+array[4]+`</column>
												</row>
											</a>						
										</div>	`;
					fullString.push(stringPart);
				}	
				//End
			}
			$('.dataFillUp').html(fullString);
			$('#currentPage').html(current_page);
			
			if (page == 1) {
				btn_prev.style.visibility = "hidden";			
			} else {
				btn_prev.style.visibility = "visible";
			}
			if (page == 1 || page == 2){
				btn_start.style.visibility = "hidden";
			} else {
				btn_start.style.visibility = "visible";
			}	
			if (page == numPages()) {
				btn_next.style.visibility = "hidden";
			} else {
				btn_next.style.visibility = "visible";
			}
			
			if (page == numPages() || page == numPages()-1){
				btn_end.style.visibility = "hidden";
			} else {
				btn_end.style.visibility = "visible";
			}
		}else{
			$('.dataFillUp').html("No results found");
			$('.mobileDataFillUp').html("No results found");
			btn_prev.style.visibility = "hidden";
			btn_start.style.visibility = "hidden";
			btn_next.style.visibility = "hidden";
			btn_end.style.visibility = "hidden";
			btn_prevM.style.visibility = "hidden";
			btn_startM.style.visibility = "hidden";
			btn_nextM.style.visibility = "hidden";
			btn_endM.style.visibility = "hidden";
		}
	}

	function numPages(){
		return Math.ceil(jsonData.length / records_per_page);
	}
</script>