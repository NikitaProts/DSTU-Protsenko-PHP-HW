<?php 
session_start();
require 'header.php'; 
require 'db.php';
$_SESSION['user'] = [
    "user_mode" => 'guest'
];
?>




<div class="cointainer">
    <div class="row">
        <div class="col-12">
        <form action="signin.php" method="POST">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" name="login" class="form-control" id="login" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
            </div>
            <div class="mb-3">
                <label for="psword" class="form-label">Password</label>
                <input type="password" name = "psword" class="form-control" id="psword" value="<?php if(isset($_COOKIE["member_psword"])) { echo $_COOKIE["member_psword"]; } ?>">
            </div>
            <div class="field-group">
		<div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"]) && isset($_COOKIE["member_psword"])) { ?> checked <?php } ?> />
		<label for="remember-me">Remember me</label>
	</div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <p>
            <a href="register.php">Регистрация</a>
        </p>
        <p>
            <a href="index.php">Продолжить без регистрации </a>
        </p>
        
        </div>
    </div>
</div>