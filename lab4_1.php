<?php
session_start();
require 'db.php';
?>

<?php

    abstract class AUser{
        abstract function showInfo();
        }

    //класс User - login, psword, email
    class User extends AUser{
        public $login;
        public $psword;
        public $email;

        function show_all(){
            print($this->login . ' ' . $this->email . ' ' . $this->psword );
        }

        public function showInfo(){
            echo 'Функция showInfo!';
        }

        function test($var1){
            //Метод доступа к классу
            echo $var1;
        }

        function __construct($var_login, $var_psword, $var_email)
        {
           $this->login = "";
           $this->psword = "";
           $this->email = "";

           try {
            $this->login = $var_login;
            $this->psword = $var_psword;
            $this->email = $var_email;
            if (empty($var_login) or empty($var_psword) or empty($var_email)) throw new Exception('Одна из переменных пустая!');
           } catch(Exception $e){
               echo 'Произошла ошибка - ',
               $e->getMessage();
           }
        }

        function __destruct()
        {
            echo 'Вызван деструктор';
        }

        function __clone(){
            $this->login = 'Guest';
            $this->psword = 'qwerty';
            $this->email = 'clone_email';
        }
    }

    class SuperUser extends User{
        public $user_mode = 'admin';       

    }

    

    //Создание 
    $myobj = new User('user1', '123', 'user.email.com');
    // Доступ к свойствам класса
    echo $myobj->psword;
    echo '<br/>';
    // Доступ к методу класса
    $myobj->test('amdskadsmk');
    echo '<br/>';
    //метод, позволяющий вывести значения свойств объекта
    $myobj->show_all();
    echo $myobj->login;
    echo '<br/>';
    //клонирование
    $myobj2 = clone $myobj;
    print($myobj2->login);
    echo '<br/>';
    //SuperUser
    $myobj3 = new SuperUser('admin', 'pas_admin', 'admin_email.com');
    $myobj3->show_all();
    echo '<br/>';
    // перехват исключения
    $myobj4 = new User('123', '3213', '');
    print($myobj4 -> login);
    echo '<br/>';
    $myobj2->showInfo();
    echo '<br/>';


?>