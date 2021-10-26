<?php require 'header.php'; 
require 'db.php';?>


<?php
    session_start();

    // Функция, которая проверяет, есть ли в строке хотя бы одна маленькая латинская буква, одна заглавная латинская буква, число и специальный символ 
    function validString($string) {
        $containsSmallLetter = preg_match('/[a-z]/', $string);
        $containsCapsLetter = preg_match('/[A-Z]/', $string);
        $containsDigit = preg_match('/\d/', $string);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $string);
        return ($containsSmallLetter && $containsCapsLetter && $containsDigit && $containsSpecial);
    }

    
    if (isset ($_POST['login'])  && isset($_POST['email']) && isset($_POST['psword'])){
        $login = $_POST['login'];
        $email = $_POST['email'];
        $psword = $_POST['psword'];
        $user_mode = 'user';

        if (filter_var($email, FILTER_VALIDATE_EMAIL)){
            $check_user = 'SELECT * FROM library_users WHERE login = :login';
            $statement = $connection->prepare($check_user);
            $statement->execute([':login' => $login]);
            $user = $statement->fetch(PDO::FETCH_OBJ);
            if ($user){
                echo 'Такой аккаунт уже есть';
            }else{
                if (validString($psword) && (strlen($psword) > 5) && !$user){
                    $sql = 'INSERT INTO library_users(login, email, psword, user_mode) VALUES(:login, :email, :psword, :user_mode)';
                    $statement = $connection->prepare($sql);
                    $statement->execute([':login' => $login, ':email' => $email, ':psword' => $psword, ':user_mode' =>$user_mode]);
                    $_SESSION['message'] = 'Регистрация!';
                    header('Location: http://localhost:8083/register_index.php');
                }else{
                    echo 'password неверный';
                    echo iconv_strlen($psword);
                };
            }           
            
        } else {
            echo 'email неверный';
        }

        
    }


?>