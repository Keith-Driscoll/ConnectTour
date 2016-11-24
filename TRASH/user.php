<!-- confirm -->

<?php
    include 'header.php';
    include 'connections.php';
    
    $conn = db_connect();
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];

    $sql = "SELECT * FROM Player WHERE player_username =".$uname." AND player_password = ".$pass."";
    $result = mysql_query($sql);

    $row = mysql_fetch_array($result);

    $conn->close();
?>
            
<div class="container">
            
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-sm-12">
                <legend>Login</legend>
                <div class="account-wall">
                    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"alt="">
                    <form class="form-signin">
                        <input type="text" class="form-control" placeholder="Email" required autofocus>
                        <input type="password" class="form-control" placeholder="Password" required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in
                        </button>
                        <label class="checkbox pull-left">
                            <input type="checkbox" value="remember-me">
                                Remember me
                        </label>
                        <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                    </form>
                </div>
                <a href="#" class="text-center new-account">Create an account </a>
            </div>
        </div>
    </div>
            
    <?php
        echo"<h1>Hey there,".$uname."</h1>";
    ?>
</div>
<?php include 'footer.php';?>