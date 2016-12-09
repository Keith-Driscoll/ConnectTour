
<div class='nopadding left-margin'>								      
	<div class='nopadding'>			
		<div class='nopadding'>
			<div id='view_ajax<?=$chatID?>' class='view_ajax'></div>		
			<div id='smallerChatActiveUsers' class='activeUsersDiv'>
			
			</div>	
			
			<?php if($intour==1 || $isAdmin){?>			
			<div id='ajaxForm' class='ajxForm'>
				<input type='text' class='chatInput' id='chatInput<?=$chatID?>' onkeydown='keyPress(event)' onkeyup='keyUp()'/>
				<input type='button' value='Send' id='sendBtn<?=$chatID?>' class='sendBtn btn' />
			</div>		
			<?php } ?>			
		</div>		
	</div>
</div>
<script src='js/jquery.min.js'></script>



