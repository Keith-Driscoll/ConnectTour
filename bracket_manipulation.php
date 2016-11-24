

<script>
	
<?php // Convert PHP to JS through JSON
	session_start();
	$js_array = json_encode($allPlayers);
	echo "var names = ". $js_array . ";\n";
	$js_rounds = json_encode($roundTotal);
	echo "var rounds = ". $js_rounds . ";\n";
	$js_matchesIDs = json_encode($matchesIDs);
	echo "var matchesIDs = ". $js_matchesIDs . ";\n";
	$js_allResults = json_encode($allResults);
	echo "var results = ". $js_allResults . ";\n";
	$js_allScores = json_encode($allScores);
	echo "var scores = ". $js_allScores . ";\n";
?>
var data = {
	teams : [
		<?=$str?>		
	],
	results : [
		<?=$scoreString?>   				
	]
}

$(function() {
	$('.bracketDraw').bracket({
		init: data /* data to initialize the bracket with */ 
	});
		
	for(var k =0; k<results.length * 2 ; k++){
		$("[data-resultid=result-"+k+"]")[0].innerHTML = '-';
	}
	for(var j =0; j<results.length ; j++){		
		var teams = $('[data-teamid=\"'+j+'\"]');		
		for(var q =0; q<rounds ; q++){
			if(teams[q]){
				teams[q].style.overflow = "hidden";
				var teamLabel = teams[q].getElementsByClassName('teamNameLabel');
				teamLabel[0].innerHTML = "-";
			}
		}
	}	
		
	$(".teamNameLabel").each(function(index){		
		
		var name = names[matchesIDs[index]];
		if(name){
			this.innerHTML = "<div onclick= 'clickBracketUser("+matchesIDs[index]+")'>"+name+"</div>";
			if(name==="<?=$_SESSION['user_name']?>"){
				this.style.color = "white";
				this.style.backgroundColor = "#F39C12";
				this.parentElement.style.overflow = "hidden";
			}		
		}
		else{
			this.innerHTML = "-";
		}		 		
		
	});
	
	$(".score").each(function(index){		
		// var name = names[matchesIDs[index]];
		// if(name){
			this.innerHTML = scores[index];
		// }
		// else{
		// 	this.innerHTML = "-";
		// }	
	});
		
	$(".score").each(function(index){		
		
		var i = parseInt(index/2);
		var player = parseInt(index%2);
		
		if(results[i]==1){
			if(player==0){
				this.style.color = "green";
			}
			else{
				this.style.color = "red";
			}
		}
		else if(results[i]==2){
			if(player==0){
				this.style.color = "red";
			}
			else{
				this.style.color = "green";
			}
		}
		else{
			this.style.color = "black";
		}
		
	});
	$(".na div.score").each(function(index){
		this.innerHTML = "-";
	});
	
	$(".bubble").each(function(index){
		this.innerHTML = "";
	});
		
	$(".bracketRound").each(function(index){
		var pixel = 100 * index;
		if(index!=0){
			this.style.left = pixel + "px";
		}
	});	
		
});	

function clickBracketUser(id){
	top.location.href="http://ggleagues.com/profile.php?id="+id;
}
</script>

