<?php session_start();?>




<?php require 'header.php'; 
require 'db.php';?>



<div class="cointainer">
    <div class="row">
        <div class="col-12">
        <form action="signup.php" method="POST">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" name="login" class="form-control" id="login">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Emai</label>
                <input type="email" name ="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="psword" class="form-label">Password</label>
                <input type="password" name = "psword" class="form-control" id="psword">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <p>
            <a href="login.php">Авторизация</a>
        </p>
 
        
        </div>
    </div>
</div>