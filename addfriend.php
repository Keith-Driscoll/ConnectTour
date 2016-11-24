<?php
	$p1 = $_GET['p1_id'];
	$p2 = $_GET['p2_id'];
	$action_code = $_GET['action_code'];
	require_once ("classes/connections.php");
	session_start();
	$db_connection = db_connect();
	//codes: 1 -remove friend 2-accept request 3- reject/cancel request 4-add friend 5-follow 6-unfollow
	
	switch($action_code){
		case 1:
			removeFriend();
			break;
		case 2:
			acceptRequest();
			break;
		case 3:
			rejectRequest();
			break;
		case 4:
			addFriend();
			break;
		case 5:
			follow();
			break;
		case 6:
			unfollow();
			break;
		case 7:
			cancelRequest();
		default:
			break;
	}
	$db_connection->close();
	
	function removeFriend(){
		global $p1, $p2, $db_connection;
		$sql = "DELETE FROM friendships WHERE (p1id=".$p1." OR p1id=".$p2.") AND (p2id=".$p1." OR p2id=".$p2.") ";
		$db_connection->query($sql);
	}
	
	function acceptRequest(){
		global $p1, $p2, $db_connection;
		$sql = "DELETE FROM friend_requests WHERE(p1id=".$p1." OR p1id=".$p2.") AND (p2id=".$p1." OR p2id=".$p2.") ";
		$db_connection->query($sql);
		$sql = "INSERT INTO friendships (p1id, p2id) VALUES (".$p1.", ".$p2.") ";
		$db_connection->query($sql);
		$message = "Friend request accepted!";
		$link = "profile.php?id=".$p1;
		$sql = "INSERT INTO notifications (p_id, message, link) VALUES (".$p2.", '".$message.", ".$link.")";
	}
	
	function rejectRequest(){
		global $p1, $p2, $db_connection;
		$sql = "DELETE FROM friend_requests WHERE (p1id=".$p1." OR p1id=".$p2.") AND (p2id=".$p1." OR p2id=".$p2.") ";
		$db_connection->query($sql);
	}
	
	function addFriend(){
		global $p1, $p2, $db_connection;
		$sql = "INSERT INTO friend_requests (p1id, p2id) VALUES (".$p1.",".$p2.")";
		$db_connection->query($sql);
		$message = $_SESSION['user_name']." would like to be your friend";
		$link = "profile.php?id=".$p1;
		$sql = "INSERT INTO notifications (p_id, message, link) VALUES (".$p2.",'".$message."', '".$link."')";
		$db_connection->query($sql);
	}
	
	function follow(){
		global $p1, $p2, $db_connection;
		$sql = "INSERT INTO followers (followee, follower) VALUES (".$p2.", ".$p1.")";
		$db_connection->query($sql);
		$message = $_SESSION['user_name']." has followed you!";
		$link = "profile.php?id=".$p1;
		$sql = "INSERT INTO notifications (p_id,message,link) VALUES (".$p2." ,'".$message."','".$link."')";
		$db_connection->query($sql);
	}
	
	function unfollow(){
		global $p1, $p2, $db_connection;
		$sql = "DELETE FROM followers WHERE followee=".$p2." AND follower=".$p1;
		$db_connection->query($sql);
	}
	
	
?>