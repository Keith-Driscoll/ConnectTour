<?php 
	include 'segments/header.php'; 
	include 'classes/connections.php';
	
	session_start();
	$db_connection = db_connect();
	$ticket_id = $_GET['id'];
	
	//get ticket details
	$sql1 = "SELECT * FROM tickets WHERE ticket_id = ".$ticket_id;
	$result = $db_connection->query($sql1);	
	$ticket_info = $result->fetch_assoc();
	
	if (($_SESSION['user_id'] != $ticket_info['submitter'])){
		$sql = "SELECT * FROM support_staff WHERE p_id = ".$_SESSION['user_id'];
		$is_admin = $db_connection->query($sql);
		if ($is_admin->num_rows == 0){
			header("Location: nopermission.php");
			exit;
		}
	}
	
	//get player details
	$sql2 = "SELECT player_username FROM player WHERE id = ".$ticket_info['submitter'];
	$result = $db_connection->query($sql2);
	$player_info = $result->fetch_assoc();
	
	//get admin details
	$sql4 = "SELECT p_id, support_name FROM support_staff WHERE id = ".$ticket_info['support_assigned'];
	$result = $db_connection->query($sql4);
	$admin_info = $result->fetch_assoc();
	
	
	if (isset($_POST['submit'])){
		if ($_SESSION['user_id'] == $ticket_info['submitter']){
			$rep = 0;
			$response = 1;
		} else if ($_SESSION['user_id'] == $admin_info['p_id']){
			$rep = 1;
			$response = 0;
		} else {
			break;
		}
		$text = $_POST['text'];
		$escaped = $db_connection->real_escape_string($text);
		$sql = "INSERT INTO ticket_messages (ticket_id, text_body, is_reply) VALUES (".$ticket_id.", '".$escaped."', ".$rep.")";
		$db_connection->query($sql);
		$sql = "UPDATE tickets SET response_needed = ".$response." WHERE ticket_id = ".$ticket_id;
		$db_connection->query($sql);
		$sql = "UPDATE tickets SET last_response = NOW() WHERE ticket_id = ".$ticket_id;
		$db_connection->query($sql);
		//set notification
		if($rep==1){
			$base = basename($_SERVER['REQUEST_URI']);
			$sql = "INSERT INTO notifications (p_id,message,link) VALUES (".$ticket_info['submitter'].",'New reply to your ticket!','".$base."')";
			$db_connection->query($sql);
			
		}
	}
	
	//get replies
	$sql3 = "SELECT * FROM ticket_messages WHERE ticket_id = ".$ticket_id." ORDER BY timestamp DESC";
	$messages = $db_connection->query($sql3);

?> 
<?php include_once 'segments/navigation.php'; ?>
<link href="css/ticket.css" rel="stylesheet"/>
</head>

<!-- Ticket Messages Section -->
<section class="top tickets">
	<!-- Container -->
	<div class="container">	

<?php
	if (($_SESSION['user_id'] == $ticket_info['submitter']) || ($_SESSION['user_id'] == $admin_info['p_id'])){
	?>
		<form action='<?=$_SERVER['PHP_SELF']."?id=".$ticket_id?>' method='post'>
			<row centered>
				<textarea id="text" name="text" class="textbox" placeholder="Please enter your message here"></textarea>
				<input type='submit' value='Reply' name="submit" class="width-2 btn"/>
			</row>
		</form>
	<?php 
		}
	?>
	<?php 
		//loop through all messages in ticket correspondance
		//check who sent each, and assign correct values to picture, name etc.
		while($message = $messages->fetch_assoc()){
			if ($message['is_reply'] == 0){
				$class = "userQuestion";
				$name = $player_info['player_username'];
				$id = $ticket_info['submitter'];
			} else if ($message['is_reply'] == 1){
				$class = "oneAnswer";
				$name = $admin_info['support_name'];
				$id = $admin_info['p_id'];
			}
			$dateTime = $message['timestamp'];
			$text = $message['text_body'];
	?>			
		<!-- Message wrapper -->
		<row centered class="ticket-row <?=$class?>">
			<!-- Message User -->
			<column centered cols="1">
				<?php 
					require_once 'getProfilePicture.php';
					$pic = getProfilePicture($id);					
				?>		
				<div>		
					<img class="sm-hidden" src="<?php echo $pic;?>"/>
				</div>
			</column><!--./Message User End-->
			
			<!-- Message Body -->
			<column class="no-margin" cols="9">
				<column cols="12">
					<p class="user-id">
						<?=$name?>
					</p>
				</column>
				<column cols="12">
					<p class="ticket-msg">
						<?=$text?>
					</p>
				</column>
			</column><!-- ./Message Body End-->

			<!-- Message footer -->
			<column cols="2">
				<p class="timestamp">
					<?=$dateTime?>
				</p>
			</column><!-- ./Message Body footer -->
		</row><!-- ./Message Wrapper End -->	
		
	<?php
		}
		?>

	</div><!-- ./Container End -->	
</section><!-- ./Ticket Message Section end -->	

<!-- Footer -->
<?php require_once 'segments/footer.php'; ?>
<!-- ./Footer End -->	
</body>
</html>
