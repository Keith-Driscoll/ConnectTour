<?php 
	// edited table formatting to make each row a link to it's respective
	// tourinfoNew.php page.
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
		var btn_startM = document.getElementById("firstPageM");
		var btn_nextM = document.getElementById("nextPageM");
		var btn_prevM = document.getElementById("prevPageM");
		var btn_endM = document.getElementById("lastPageM");
		// Validate page
		if(jsonData.length>0){
			if (page < 1) page = 1;
			if (page > numPages()) page = numPages();
		
			var fullString = new Array();
			var fullMobileString = new Array();
			$('#totalPages').html(numPages());
			$('#totalPagesM').html(numPages());
			for (var i = (page-1) * records_per_page; i < (page * records_per_page); i++) {
				
				var array = new Array();
				if(i < jsonData.length){
					$.each(jsonData[i], function(k , v) {				
						array.push(v);				
					});
					var date = array[7].substring(0, 10);
					var gameIconString = "../images/old/icons/png/"+array[1]+"mini.png";
					var stringPart = `<div class="onetour">
											<a href= "tourinfo.php?id=`+array[0]+`">
												<row>
													<column cols="4"><div class="width-12 giveMinWidth">`+array[2]+`</div></column>
													<column cols="2"><div class="width-12 giveMinWidth">€`+array[3]+`</div></column>
													<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">`+array[4]+`</div></column>
													<column cols="1"><div class="width-12 giveMinWidth">`+array[5]+`/`+array[6]+`</div></column>
													<column cols="3"><div class ="width-12 giveMinWidth"> `+date+` </div></column>
												</row>
											</a>						
										</div>	`;
										
					var mobileStringPart =` <div class="tourBlock">
												<a href= "tourinfo.php?id=`+array[0]+`">
													<div class="infoBlock">							
														<div class="">`+array[2]+`</div>								
														<div class="linedividor"></div>
														<div class="">`+array[1]+`</div>
														<div class="linedividor"></div>
														<div class="">€`+array[3]+`</div>
														<div class="linedividor"></div>
														<div class=" ">`+array[4]+`</div>
														<div class="linedividor"></div>
														<div class=" ">`+array[5]+`/`+array[6]+`</div>
													</div>
												</a>	
											</div>`;
					fullMobileString.push(mobileStringPart);
					fullString.push(stringPart);
				}	
			}
			$('.dataFillUp').html(fullString);
			$('.mobileDataFillUp').html(fullMobileString);
			$('#currentPage').html(current_page);
			$('#currentPageM').html(current_page);
			
			if (page == 1) {
				btn_prev.style.visibility = "hidden";	
				btn_prevM.style.visibility = "hidden";		
			} else {
				btn_prev.style.visibility = "visible";
				btn_prevM.style.visibility = "visible";
			}
			if (page == 1 || page == 2){
				btn_start.style.visibility = "hidden";
				btn_startM.style.visibility = "hidden";
			} else {
				btn_start.style.visibility = "visible";
				btn_startM.style.visibility = "visible";
			}	
			if (page == numPages()) {
				btn_next.style.visibility = "hidden";
				btn_nextM.style.visibility = "hidden";
			} else {
				btn_next.style.visibility = "visible";
				btn_nextM.style.visibility = "visible";
			}
			
			if (page == numPages() || page == numPages()-1){
				btn_end.style.visibility = "hidden";
				btn_endM.style.visibility = "hidden";
			} else {
				btn_end.style.visibility = "visible";
				btn_endM.style.visibility = "visible";
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