<?php

require 'rb/rb.php';

R::setup('mysql:host=localhost;dbname=library_dstu', 'root', '123456');

$book_name = $_POST['name'];


$book = R::find( 'books', ' title LIKE ? ', [ $book_name . "%" ] );

print_r($book) ;





















?>