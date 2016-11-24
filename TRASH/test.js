function match(match_id, player_1,player_2){
	this.match_id = match_id;
	this.player_1 = player_1;
	this.player_2 = player_2;
	this.result = [0, 0];


	this.update_result = function(winner){
		if (winner === 1){
			this.result[0]++;
		} else {
			this.result[1]++;
		}
	}

}

//fill this array with names of all players who checked in (somehow)
var players = new Array();
var i = 0;
while (/*moreNamesStillExist*/){
	players[i] = "";
	i++;
}

var num_players = players.length;
var pow2 = 2;

while (pow2 < players.length){
	pow2 *= 2;
}

var players_in_r1 = 2*num_players - pow2;
var matches_in_r1 = num_players - pow2/2;
//fix
var last_id;

function bracket(){
	for (var i=0;i<num_matches;i++){
		this.bracket[i] = match(last_id,players[i],players[i++]);
		last_id++;
	}

}