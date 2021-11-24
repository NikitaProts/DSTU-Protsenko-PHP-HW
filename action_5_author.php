<?php
    require 'rb/rb.php';
    R::setup('mysql:host=localhost;dbname=library_dstu', 'root', '123456');


    $author = R::dispense('authors');
    $author->name = $_POST['name'];
    $author->birtday = $_POST['birtday'];
    $author->date_death = $_POST['date_death'];
    R::store($author);





?>
