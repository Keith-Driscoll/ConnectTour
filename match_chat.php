<?php //require_once 'segments/not_logged_in.php'; ?>
	<script src="javascript/jquery.js"></script>
	<script src='javascript/m_lobby_chat.js'></script>
	<div class='col-md-12 col-sm-12 col-xs-12'>								
		<link rel='stylesheet' href='css/chat.css' />
		<!-- missing bootstrap that deals with chat colour??? -->
		<div>
			<div id='view_ajax2' >
			</div>		
			<div id='ajaxForm'>
				<input type='text' class='col-md-10 col-sm-10 col-xs-10' id='chatInput2' onkeydown='keyPress(event)'/><input type='button' value='Send' id='sendBtn2' class='col-md-2 col-sm-2 col-xs-2 btn' />
			</div>
		</div>
	</div>
<?php //require_once 'segments/footer.php'; ?>
