<?php 
session_start();
require 'header.php'; 
require 'db.php';?>


<?php

    if( isset($_POST['login']) && isset($_POST['psword'])){
        $login = $_POST['login'];
        $psword = $_POST['psword'];

        $check_user = 'SELECT * FROM library_users WHERE login = :login AND psword = :psword';
        $statement = $connection->prepare($check_user);
        $statement->execute([':login' => $login, 'psword' => $psword]);
        $user = $statement->fetch(PDO::FETCH_OBJ);
        $user = (array) $user;

        if ($user['login']){
            if ($user['user_mode'] =='user'){
                $_SESSION['user']['user_mode'] = 'user';
               
            } elseif($user['user_mode'] =='admin'){
                $_SESSION['user']['user_mode'] = 'admin';
            };
            $_SESSION['user']['login'] = $user['login'];
            $_SESSION['user']['id'] = $user['id'];
            header('Location: http://localhost:8083/index.php');
        }else{
            echo 'Такого пользователя нет!';
        }
    }
    if(!empty($_POST["remember"])) {
        setcookie ("member_login",$login,time()+ 300);
        setcookie ("member_psword",$psword,time()+ 300);
    } else {
        if(isset($_COOKIE["member_login"])) {
            setcookie ("member_login","");
            setcookie ("member_psword","");
        }
    }
    

    
    

    
    
    
    


?>