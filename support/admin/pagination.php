<?php 
?>
<script>
	var current_page1 = 1;
	var current_page2 = 1;
	var records_per_page = 6;
	
	function firstPage(id){
		if (id == 1){
			current_page1 = 1;
			changePage(current_page1, 1);
		} else if (id == 2){
			current_page2 = 1;
			changePage(current_page2, 2);
		}
	}	
	function prevPage(id) {
		if (id == 1){
			if (current_page1 > 1) {
				current_page1--;
				changePage(current_page1, 1);
			}
		} else if (id == 2){
			if (current_page2 > 1) {
				current_page2--;
				changePage(current_page2, 2);
			}
		}
	}
	function nextPage(id){
		if (id == 1){	
			if (current_page1 < numPages(1)) {
				current_page1++;
				changePage(current_page1, 1);
			}
		} else if (id == 2){
			if (current_page2 < numPages(2)) {
				current_page2++;
				changePage(current_page2, 2);
			}
		}
	}
	function lastPage(id){
		if (id == 1){
			current_page1 = numPages(1);
			changePage(current_page1, 1);
		} else if (id == 2){
			current_page2 = numPages(2);
			changePage(current_page2, 2);
		}
	}

	function changePage(page, dataType){
		var btn_start = document.getElementById("firstPage");
		var btn_next = document.getElementById("nextPage");
		var btn_prev = document.getElementById("prevPage");
		var btn_end = document.getElementById("lastPage");
		// Validate page	
					
		if (page < 1) page = 1;	
			
		if (dataType == 1 && (jsonData1 != null)){
			var fullString1 = new Array();
			if (page > numPages(1)) page = numPages(1);
			$('#totalPages').html(numPages());
			var flag = 0;
			for (var i = (page-1) * records_per_page; i < (page * records_per_page); i++) {
				var array = new Array();
				if(jsonData1.length > 0){
					if(i < jsonData1.length){
						$.each(jsonData1[i], function(k , v) {				
							array.push(v);				
						});
						
						if (array[3] == <?=$support_id['id']?>){
							flag = 1;
							var date = array[5];
							var stringPart = `<div class="oneTour">
													<a href= "ticket.php?id=`+array[0]+`">
														<row>
															<column cols="1"><div class="width-12 giveMinWidth">`+array[1]+`</div></column>
															<column cols="2"><div class="width-12 giveMinWidth">`+array[2]+`</div></column>
															<column cols="1" class="sm-hidden"><div class="width-12 giveMinWidth">`+array[4]+`</div></column>
															<column cols="3"><div class="width-12 giveMinWidth">`+date+`</div></column>
															<column cols="3"><div class="width-12 giveMinWidth">`+array[6]+`</div></column>
														</row>
													</a>						
												</div>	`;
												
							fullString1.push(stringPart);
						}
					}
				}	
			}
			if (flag == 0){
				fullString1.push("You have no tickets");
			}
			if (page < 1) page = 1;
			
		} else if (dataType == 2 && (jsonData2 != null)){
			var fullString2 = new Array();	
			if (page > numPages(2)) page = numPages(2);
			var flag = 0;
			for (var i = (page-1) * records_per_page; i < (page * records_per_page); i++) {
				if (jsonData2.length > 0){
					var array = new Array();
					if(i < jsonData2.length){
						$.each(jsonData2[i], function(k , v) {				
							array.push(v);				
						});
						if (array[3] == 1){
							flag = 1;
							var date = array[5];
							var stringPart = `<div class="oneTour">
													<!--<a href= "ticket.php?id=`+array[0]+`"-->
														<row>
															<column cols="1" onclick="link(`+array[0]+`)"><div class="width-12 giveMinWidth">`+array[1]+`</div></column>
															<column cols="2" onclick="link(`+array[0]+`)"><div class="width-12 giveMinWidth">`+array[2]+`</div></column>
															<column cols="1" class=" sm-hidden" onclick="link(`+array[0]+`)"><div class="width-12 giveMinWidth">`+array[4]+`</div></column>
															<column cols="3" onclick="link(`+array[0]+`)"><div class="width-12 giveMinWidth">`+date+`</div></column>
															<column cols="3" onclick="link(`+array[0]+`)"><div class="width-12 giveMinWidth">`+array[6]+`</div></column>
															<column cols="2"><div class="width-12 giveMinWidth"><button onclick="claim(`+array[0]+`)">Claim</button></div></column>													
														</row>
													<!--</a>-->			
													
												</div>	`;
												
							fullString2.push(stringPart);
						}				
					}
				}
			}
			if (flag == 0){
				fullString2.push("There are currently no unclaimed tickets");
			}
		} else{
			$('.dataFillUp').html("No results found");
			btn_prev.style.visibility = "hidden";
			btn_start.style.visibility = "hidden";
			btn_next.style.visibility = "hidden";
			btn_end.style.visibility = "hidden";
		}
		
		$('.dataFillUp1').html(fullString1);
		$('.dataFillUp2').html(fullString2);
		$('#currentPage1').html(current_page1);
		$('#currentPage2').html(current_page2);
		
		if (dataType == 1){
			if (page == 1) { btn_prev.style.visibility = "hidden";	} 
			else { btn_prev.style.visibility = "visible"; }
			if (page == 1 || page == 2){ btn_start.style.visibility = "hidden"; } 
			else { btn_start.style.visibility = "visible"; }	
			if (page == numPages(1)) { btn_next.style.visibility = "hidden"; } 
			else { btn_next.style.visibility = "visible"; }
			if (page == numPages(1) || page == numPages(1)-1){ btn_end.style.visibility = "hidden"; } 
			else { btn_end.style.visibility = "visible"; }
		} else if (dataType == 2){
			if (page == 1) { btn_prev.style.visibility = "hidden";	} 
			else { btn_prev.style.visibility = "visible"; }
			if (page == 1 || page == 2){ btn_start.style.visibility = "hidden"; } 
			else { btn_start.style.visibility = "visible"; }	
			if (page == numPages(2)) { btn_next.style.visibility = "hidden"; } 
			else { btn_next.style.visibility = "visible"; }
			if (page == numPages(2) || page == numPages(2)-1){ btn_end.style.visibility = "hidden"; } 
			else { btn_end.style.visibility = "visible"; }
		}
		
	}
	
	
	function claim(id){
	alert(id);
	alert(<?=$support_id['id']?>);
		$.ajax({
			type: "POST",
			url: "support/admin/claimticket.php",
			cache: false,
			data: {support_id: <?=$support_id['id']?>, ticket_id: id},
			success: function(data){				
				filter();		
			},
			error: function(jqXHR, textStatus, errorThrown) {

			}
		});
	}
	
	function numPages(id){
		if (id == 1){
			return Math.ceil(jsonData1.length / records_per_page);
		} else if (id == 2){
			return Math.ceil(jsonData2.length / records_per_page);
		}
	}
	
	function link(id){
		console.log(id);
		window.location.href = "ticket.php?id="+id;
		
	}
</script>