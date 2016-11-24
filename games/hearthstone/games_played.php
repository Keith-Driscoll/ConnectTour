<?php

	$sql ="SELECT * FROM hearthstone_games WHERE match_id = $matchid"; 
	$result = $db_connection->query($sql);
	
?>

<link rel="stylesheet" type="text/css" href="css/games_played.css">


<script>
	
	function viewScreenshot(){
		$(".userScreenshot").show();
		$(".closeButtonScr").show();
	}
	
	function hideScreenshot(){
		$(".userScreenshot").hide();
		$(".closeButtonScr").hide();
	}
	
</script>

<?php 
$currentGameNumber = 1;
while($game = $result->fetch_assoc()){
	
	$winner = $game['winner'];
	if($winner){
		
		if($winner == $self){
			$pc1 = "prevWin";
			$pc2 = "prevLoss";
		}
		else{
			$pc2 = "prevWin";
			$pc1 = "prevLoss";
		}
	}else{
		if($game['player_1_result']==null||$game['player_2_result']==null){
			$winner = -2;
		}
		else{
			$winner = -1;
		}
	}
	?>

<div class="oneGame <?php if($winner==-1){echo "disputed";} ?>">
<row centered>
	Game <?=$currentGameNumber?> <?php if($winner==-1){echo " (Disputed)";} ?>
</row>	
<?php if($winner==1 || $winner == 2){?>
<row centered class="games">
	<column cols="5">
		<div class=<?=$pc1?>>
			<?=conv($game['player_'.$self.'_class1'])?>
		</div>
	</column>
	<column cols="1">
		vs 
	</column>
	<column cols="5">
		<div class=<?=$pc2?>>
			<?=conv($game['player_'.$opponent.'_class1'])?>
		</div>
	</column>
</row>

<?php
	}
	else if($winner == -1){
		$screenshotStr = "" . $matchid ."_". $game_number ."_". intval($p_id);
		require_once "getImage.php";
		$screenshotSelf = getImage($screenshotStr,"match_screenshots");
		$scrAv = false;
		if($screenshotSelf!="images/logo_vector.png"){
			$scrAv = true;
		}
		?>
		<row centered class="games">			
			<column cols="5">
				<div>
					<?=conv($game['player_1_class1'])?> vs <?=conv($game['player_2_class1'])?>
				</div>
			</column>
			<column cols="1">
				vs 
			</column>
			<column cols="5">
				<div>
					<?=conv($game['player_1_class2'])?> vs <?=conv($game['player_2_class2'])?>
				</div>
			</column>			
		</row>
		<row centered class="games">			
			<column cols="2">
				<div>
					<?php if($game['player_'.$self.'_result']){
						echo "I won";
					}
					if($scrAv){
					?>
					<a class="viewShotBut" onclick="viewScreenshot()">Screenshot</a>
					
					<?php }?>
				</div>
			</column>
			<column cols="4">
				<div class='uploadScreenshot'>
					<form action='image_upload.php?path=match_screenshots&file_name=<?=$screenshotStr?>&max_size=100000000&ret=<?=$_SERVER['REQUEST_URI']?>' method='post' enctype='multipart/form-data'>
						<input type='file' class='uploadInput' name='fileToUpload' id='fileToUpload'>
						<input type='submit' class='uploadButton' value='Upload Image' name='submit'>
					</form>
				</div>
			</column>
			<column cols="2">
				<div>
					<?php
						if($game['player_'.$opponent.'_result']){
							echo "I won";
						}									
					?>
					<img class="userScreenshot" src='<?php echo $screenshotSelf;?>'/>
					<div class="icon_close closeButtonScr" onclick="hideScreenshot()"></div>
				</div>
			</column>			
		</row>
	
<?php	}
		else{
			echo "<row centered id='waitingReport'>Waiting on results</row>";
		}
	echo "</div>";
	$currentGameNumber++;
} 


function conv($num)
	{	
	$str = "";		
		switch($num){				
			case 1 : $str .= "Warrior";
			break;
			case 2 : $str .= "Shaman";
			break;
			case 3 : $str .= "Rogue";
			break;
			case 4 : $str .= "Paladin";
			break;
			case 5 : $str .= "Hunter";
			break;
			case 6 : $str .= "Druid";
			break;
			case 7 : $str .= "Warlock";
			break;
			case 8 : $str .= "Mage";
			break;
			case 9 : $str .= "Priest";
			break;
		}	
	return $str;
}
?>