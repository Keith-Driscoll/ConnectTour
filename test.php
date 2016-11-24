<?php
	include 'vendor/autoload.php';
	
	echo "loaded";

	//Time to send some emails
	
	require 'vendor/autoload.php';
	
	$from = new SendGrid\Email(null, "noreply@ggleagues.com");
	$subject = "Hello World from the SendGrid PHP Library!";
	$to = new SendGrid\Email(null, "adam@ggleagues.com");
	$content = new SendGrid\Content("text/plain", "Hello, Email!");
	$mail = new SendGrid\Mail($from, $subject, $to, $content);

	$apiKey = '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';
	$sg = new \SendGrid($apiKey);

	$response = $sg->client->mail()->send()->post($mail);
	echo $response->statusCode();
	echo $response->headers();
	echo $response->body();
	

?>