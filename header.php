<?php
require 'db.php';?>



<!doctype html>
<html lang="en">
  <head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
      <?php  if($_SESSION['user']['user_mode'] == 'admin') :?>
        <a class="nav-link" href="create.php">Create author</a>
        <a class="nav-link" href="create_book.php">Create book</a>
        <a class="nav-link" href="create_genre.php">Create genre</a>
        <?php endif; ?>
        <a class="nav-link" href="book_test.php">Test</a>
        <a class="nav-link" href="inquiry.php">Inquiry</a>
        <a class="nav-link" href="register_index.php">authorization</a>
        <a class="nav-link" href="lab4_1.php">Lab4_1</a>
        <a class="nav-link" href="lab4_2.php">Lab4_2</a>
        <a class="nav-link" href="lab4_3.php">Lab4_34</a>

        
      </li>
      
      
    </ul>
  </div>
</nav>
