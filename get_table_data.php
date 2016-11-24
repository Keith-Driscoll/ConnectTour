<?php 
	include 'classes/connections.php';
	$db_connection = db_connect();

	$t_id = $_GET['t_id'];

	// $sql = "SELECT player.player_username, league_participants.wins, league_participants.draws, league_participants.losses, 
	// 				league_participants.points, league_participants.games_played, league_participants.p_id
	// FROM league_participants JOIN player ON player.id = league_participants.p_id
	// WHERE league_participants.league_id = $t_id ORDER BY points DESC";

	echo($json);
?>