<?php
	//Currently used to explore Stripe's API
	require('../vendor/stripe/stripe-php/init.php');

	function setSecretKey(){ \Stripe\Stripe::setApiKey("sk_test_pmmIwDoIAeRL01Gy2Q5xnOd6"); }
	
	function setPublicKey(){ \Stripe\Stripe::setApiKey("pk_test_5Lamg5okMmwv9p4dx8JFmFns");	}

	echo "<script type='text/javascript' src='https://js.stripe.com/v2/'></script>";
?>