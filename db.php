<?php

$dsn = 'mysql:host=localhost;dbname=library_dstu';
$username = 'root';
$password='123456';
$options =  [];



try{
    $connection = new PDO($dsn, $username, $password);


    } catch (PDOException $e)

    {}



?>