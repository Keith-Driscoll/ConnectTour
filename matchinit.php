<?php 

?>
<style>
	ul#classes li {
		display:inline;
	}
	ul#classes li img {
		/*background-color: black;*/
		/*color: white;*/
		width:125px;
		height:125px;
		padding: 10px 20px;
		border-radius: 4px 4px 4px 4px;
	}
}

</style>
	
<!--Display names of players in match-->
<div id='header'>
	<h1> <?php //echo $p1_name." vs ".$p2_name; ?>Test</h1>
</div>
<!--Display classes selected by you-->
<div id='class_container'>
	<ul id='classes'>
		<li><img id='1' src='/images/hearthstone_heroes/default.png' ></li>
		<li><img id='2' src='/images/hearthstone_heroes/default.png' ></li>
		<li><img id='3' src='/images/hearthstone_heroes/default.png' ></li>
		<li><img id='4' src='/images/hearthstone_heroes/default.png' ></li>
	</ul>
</div>
<!--Dropdown to select classes-->
<div id='dropdown'>
	<select id='class_selection' onchange='imageChange()'>
		<option value='druid'>Druid</option>
		<option value='hunter'>Hunter</option>
		<option value='mage'>Mage</option>
		<option value='paladin'>Paladin</option>
		<option value='priest'>Priest</option>
		<option value='rogue'>Rogue</option>
		<option value='shaman'>Shaman</option>
		<option value='warlock'>Warlock</option>
		<option value='warrior'>Warrior</option>
	</select>
<div>
	
<script src='js/jquery.min.js';></script>
<script>
	var selected = 1;
	function imageChange(){
		var url = "/images/hearthstone_heroes/";		
		var val = $('#class_selection').val();
		var tmp_url = url + val +".png";
		$('#'+selected.toString()).attr("src", tmp_url);
		$('option.'+val).hide();
		console.log(selected.toString());
		selected = selected + 1;
	}
</script>