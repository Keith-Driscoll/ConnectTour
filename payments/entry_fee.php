<?php
	//include 'init.php';
	$plswork = "Hello World";
	$p_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM customer_tokens WHERE player_id = $p_id";
	$result = $db_connection->query($sql);
	
	if ($result->num_rows == 0){
		$isCustomer = 0;
	} else if ($result->num_rows == 1){
		$isCustomer = 1;
		$customerDetails = $result->fetch_assoc();
	}
	
?>
<link href="css/entry_fee.css" rel="stylesheet"/>
<script>
	function entry_div_show() {
		document.getElementById('entry_fee').style.display = "block";
	}
	//Function to Hide Popup
	function entry_div_hide(){
		document.getElementById('entry_fee').style.display = "none";
	}
</script>

<div id="entry_fee" style="display:none">
	<!-- Popup Div Starts Here -->
	<div id="close" class="icon_close closeButton" onclick ="entry_div_hide()"></div>
		<div id="popupContact">
			
			<?php
				// ***below are tmp variables***
//				if ($accountBalance >= $row['tournament_entry_fee']){
					//There are sufficient funds in your account to pay this entry fee
					//do you wish to do so?
//				} 
//				if ($isCustomer == 1){
				//ask if they'd like to pay with the same card, or enter a new method of payment?
			?>	
					<!--<div id=''>-->
						
					
					
					
			<?php
//				} else if ($isCustomer == 0) {
			?>		
					<div class="container">
						<div class="row">
						<!-- You can make it whatever width you want. I'm making it full width
						on <= small devices and 4/12 page width on >= medium devices -->
							<div class="col-xs-12 col-md-4">


								<!-- CREDIT CARD FORM STARTS HERE -->
								<div class="panel panel-default credit-card-box">
									<div class="panel-heading display-table" >
										<div class="row display-tr" >
											<h3 class="panel-title display-td" >Payment Details</h3>
												<div class="display-td" >                            
												<img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
												</div>
												</div>                    
												</div>
												<div class="panel-body">
												<form role="form" id="payment-form">
												<div class="row">
												<div class="col-xs-12">
												<div class="form-group">
												<label for="cardNumber">CARD NUMBER</label>
												<div class="input-group">
												<input 
												type="tel"
												class="form-control"
												name="cardNumber"
												placeholder="Valid Card Number"
												autocomplete="cc-number"
												required autofocus 
												/>
												<span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
												</div>
												</div>                            
												</div>
												</div>
												<div class="row">
												<div class="col-xs-7 col-md-7">
												<div class="form-group">
												<label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
												<input 
												type="tel" 
												class="form-control" 
												name="cardExpiry"
												placeholder="MM / YY"
												autocomplete="cc-exp"
												required 
												/>
												</div>
												</div>
												<div class="col-xs-5 col-md-5 pull-right">
												<div class="form-group">
												<label for="cardCVC">CV CODE</label>
												<input 
												type="tel" 
												class="form-control"
												name="cardCVC"
												placeholder="CVC"
												autocomplete="cc-csc"
												required
												/>
												</div>
												</div>
												</div>
												<div class="row">
												<div class="col-xs-12">
												<div class="form-group">
												<label for="couponCode">COUPON CODE</label>
												<input type="text" class="form-control" name="couponCode" />
												</div>
												</div>                        
												</div>
												<div class="row">
												<div class="col-xs-12">
												<button class="btn btn-success btn-lg btn-block" type="submit">Start Subscription</button>
												</div>
												</div>
												<div class="row" style="display:none;">
												<div class="col-xs-12">
												<p class="payment-errors"></p>
												</div>
											</div>
										</form>
									</div>
								</div>            
							<!-- CREDIT CARD FORM ENDS HERE -->
							</div>            
						</div>
					</div>

					<!--<form action='' method='POST' id='payment-form'>
					<span class='payment-errors'></span>
					
					<div class='form-row'>
						<label>
							<span>Card Number</span>
							<input type='text' size='20' data-stripe='number'>
						</label>
					</div>

					<div class='form-row'>
						<label>
							<span>Expiration (MM/YY)</span>
							<input type='text' size='2' data-stripe='exp_month'>
						</label>
						<span> / </span>
						<input type='text' size='2' data-stripe='exp_year'>
					</div>

					<div class='form-row'>
						<label>
							<span>CVC</span>
							<input type='text' size='4' data-stripe='cvc'>
						</label>
					</div>

					<div class='form-row'>
						<label>
							<span>Billing Zip</span>
							<input type='text' size='6' data-stripe='address_zip'>
						</label>
					</div>
					
					<div class='form-row'>
						<label>
							<span>Remember my details for next time?</span>
							<input type='checkbox' id='1' name='remember_me' value='1' size='4' >
						</label>
					</div>
					<input type='submit' class='submit' value='Submit Payment of 9.99'>
					</form>	-->
			<?php
			//	}
			?>
		</div>
	<!-- Popup Div Ends Here -->
</div>
</div>

