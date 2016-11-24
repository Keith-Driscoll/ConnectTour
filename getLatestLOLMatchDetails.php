<?php 
	$summoner = $_GET['summoner'];	
	$server = $_GET['server'];	
	
	$curl = curl_init('https://' . $server . '.api.pvp.net/api/lol/' . $server . '/v1.4/summoner/by-name/' . $summoner . '?api_key=RGAPI-99639656-FF88-4CEA-8155-9FE607E06497');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($curl);	
	curl_close($curl);	
	$summoner_info = $result;
	$summoner_info_array = json_decode($summoner_info,true);
	//echo "<br>Info// " . print_r($summoner_info_array,true)." //<br>";	
		
	//echo "<br>".$summoner."<br>";	
	$summoner_info_array_name = summoner_info_array_name($summoner);
	
	//echo "<br>Info2//    " . $summoner_info_array_name."      //<br>";
	
	$summoner_id = $summoner_info_array[$summoner_info_array_name]['id'];
		
	//echo "<br>Info3//    " . $summoner_id ."      //<br>";
	
	function summoner_info_array_name($summoner) {
		$summoner_lower = mb_strtolower($summoner, 'UTF-8');
		$summoner_nospaces = str_replace(' ', '', $summoner_lower);
		return $summoner_nospaces;
	}
	
	$curl = curl_init('https://' . $server . '.api.pvp.net/api/lol/'.$server.'/v2.2/matchlist/by-summoner/'.$summoner_id. '?api_key=RGAPI-99639656-FF88-4CEA-8155-9FE607E06497');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$result = curl_exec($curl);	
	curl_close($curl);	
	$summoner_info = $result;
	$summoner_info_array = json_decode($summoner_info,true);
	echo print_r($summoner_info_array,true);


?>