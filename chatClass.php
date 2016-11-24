<?php
	class chatClass {
    	public static function getRestChatLines($id, $chatID) {
      		$arr = array();
      		$jsonData = '{"results":[';
      		require_once("classes/connections.php");
	  		$db_connection = db_connect();
      		$db_connection->query( "SET NAMES 'UTF8'" );
      		$statement = $db_connection->prepare( "SELECT id, player_id, username, colour, message_text, timestamp FROM chat_messages WHERE id > ? AND chat_id = ? AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 HOUR)");
      		$statement->bind_param( 'ii', $id, $chatID);
      		$statement->execute();
      		$statement->bind_result( $id,$player_id, $usrname, $color, $chattext, $chattime);
      		$line = new stdClass;
      		while ($statement->fetch()) {
        		$line->id = $id;
				$line->player_id = $player_id;
        		$line->usrname = $usrname;
        		$line->color = $color;
       		 	$line->chattext = $chattext;
        		$line->chattime = date('H:i:s', strtotime($chattime));
      		  	$arr[] = json_encode($line);
      		}
      		$statement->close();
      		$db_connection->close();
      		$jsonData .= implode(",", $arr);
      		$jsonData .= ']}';
    		return $jsonData;
		}
    
    	public static function setChatLines( $chattext, $usrname, $color, $chatID) {
    	  	require_once("classes/connections.php");
			$db_connection = db_connect();
    	  	$db_connection->query( "SET NAMES 'UTF8'" );
    	  	$statement = $db_connection->prepare( "INSERT INTO chat_messages( player_id, username, colour, message_text, chat_id) VALUES(?, ?, ?, ?, ?)");
    	  	$statement->bind_param( 'isssi', $_SESSION['user_id'], $usrname, $color, $chattext, $chatID);	  	
    	  	$statement->execute();
    	  	$statement->close();
    	  	$db_connection->close();
    	}
  	}	
?>