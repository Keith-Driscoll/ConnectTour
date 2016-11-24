<!-- This class is not used atm. Not sure what it is meant to do.--> 

<?php 
	include 'header.php';
	include 'connections.php';
?>
    <div class="container">
        <!-- confirm -->
        <?php
		    
		    $register = registerNewUser();
		   
		                if (isset($registration)) {
                            if ($registration->errors) {
                                foreach ($registration->errors as $error) {
                                    echo $error;
                                }
                            }
                            if ($registration->messages) {
                                foreach ($registration->messages as $message) {
                                    echo $message;
                                }
                            }
                        }

            header("Location: confirmed.php");
	    
		?>
    </div>
<?php include 'footer.php';?>