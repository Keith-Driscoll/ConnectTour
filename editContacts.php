<?php
	require_once ("classes/connections.php");
	session_start();
	$id = $_SESSION['user_id'];
	$db_connection = db_connect();
	$delete = $_GET['delete'];
	$edit = $_GET['edit'];
	$game = $_GET['game'];
	$name = $_GET['name'];
	$gamewithoutspaces = str_replace(' ', '_', $game);
	if(isset($delete)){
		
		$sql = "DELETE FROM gameaccounts WHERE player_id = $id AND gameaccount_game='$gamewithoutspaces'";
		$db_connection->query($sql);
	}
	else if(isset($edit)){
		$sql = "UPDATE gameaccounts SET gameaccount_name='$name' WHERE player_id=$id AND gameaccount_game='$gamewithoutspaces'";
		$db_connection->query($sql);
	}
	else{
		$twitter = $_GET['twitter'];
		$instagram = $_GET['instagram'];
		$snapchat = $_GET['snapchat'];
		$gameaccount = $_GET['gameaccount'];
		$servername = $_GET['server'];
		if(!isset($game)){
			$stmt = $db_connection->prepare("UPDATE player SET twitter_username=?, instagram_username=?, snapchat_username=? WHERE id=".$id);
			$stmt->bind_param("sss",$twitter,$instagram,$snapchat);
			$stmt->execute();
		}
		else{
			$stmt = $db_connection->prepare("INSERT INTO gameaccounts (player_id,gameaccount_name,gameaccount_game,gameaccount_server)  VALUES(?,?,?,?)");
			$stmt->bind_param("isss",$id,$gameaccount,$game,$servername);
			$stmt->execute();
		}
	
	}
	
?>