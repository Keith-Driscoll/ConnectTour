<?php
	include ("views/not_logged_in.php");

	$last_page = $_SERVER['HTTP_REFERER'];

?>

<form method="post" action="header('Location: '.$last_page.);" name="loginform">

    <label for="login_input_username">Username</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required="" placeholder="enter username"/>

    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" placeholder="Password" required="" />

    <input type="submit"  name="login" value="Log in" />
    <!--<input type="hidden" name="redirect" value="<?php echo htmlspecialchars($full_url);?>" /> -->

</form>

<?php include "footer.php"; ?>