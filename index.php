<?php
session_start();
require 'db.php';
$sql = 'SELECT * FROM authors';
$sql_book = 'SELECT * FROM books';
$sql_genre = 'SELECT * FROM genre';


$statement = $connection->prepare($sql);
$statement_book = $connection->prepare($sql_book);
$statement_genre = $connection->prepare($sql_genre);
$statement->execute();
$statement_book->execute();
$statement_genre->execute();
$authors = $statement->fetchAll(PDO::FETCH_OBJ);
$books = $statement_book->fetchAll(PDO::FETCH_OBJ);
$genres = $statement_genre->fetchAll(PDO::FETCH_OBJ);

$key = array_search('5', $authors)
 ?>
<?php require 'header.php';?>
<div class="container">
  <div class="row">
    <div class="col-12">
      <p>Вы авторизованы как: <?= $_SESSION['user']['user_mode'];?></p>
      <?php  if($_SESSION['user']['user_mode'] != 'guest') :?>
      <p><?= $_SESSION['user']['login'];?></p>
      <?php endif; ?>
      
    </div>
  </div>
</div>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All authors</h2>
      
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>birtday</th>
          <th>date_death</th>
        </tr>
        <?php foreach($authors as $person): ?>

          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->name; ?></td>
            <td><?= $person->birtday; ?></td>
            <td><?= $person->date_death; ?></td>
            <?php  if($_SESSION['user']['user_mode'] == 'admin') :?>
            <td>
              <a href="edit.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>



<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All books</h2>
      
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th><?php echo $key ?></th>
          <th>title </th>
          <th>description  </th>
          <th>year_release</th>
          <th>Автор</th>
          <th>Жанр</th>
        </tr>
        <?php foreach($books as $books): ?>
          <?php 
            $test = 'SELECT name FROM authors WHERE id = :id' ;
            $statement_t = $connection->prepare($test);
              $statement_t->execute([':id' => $books->author_id]);
              $query_t = $statement_t->fetch(PDO::FETCH_OBJ);

              $test_2 = 'SELECT title FROM genre WHERE id = :id' ;
            $statement_t_2 = $connection->prepare($test_2);
              $statement_t_2->execute([':id' => $books->genre_id]);
              $query_t_2 = $statement_t_2->fetch(PDO::FETCH_OBJ);

            ?>

    
          <tr>
            <td><?= $books->id; ?></td>
            <td><?= $books->title; ?></td>
            <td><?= $books->description; ?></td>
            <td><?= $books->year_release; ?></td>
            <td><?=  $query_t->{'name'} ; ?></td>
            <td><?= $query_t_2->{'title'}; ?></td>
            <td><a href="comments.php?id=<?= $books->id ?>" class="btn btn-info">comments</a></td>
            <?php  if($_SESSION['user']['user_mode'] == 'admin') :?>
            <td>
              <a href="edit_book.php?id=<?= $books->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_book.php?id=<?= $books->id ?>" class='btn btn-danger'>Delete</a>
            </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>All genre</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>ID</th>
          <th>title </th>
        </tr>
        <?php foreach($genres as $genre): ?>
          <tr>
            <td><?= $genre->id; ?></td>
            <td><?= $genre->title; ?></td>
            <?php  if($_SESSION['user']['user_mode'] == 'admin') :?>
            <td>
              <a href="edit_genre.php?id=<?= $genre->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_genre.php?id=<?= $genre->id ?>" class='btn btn-danger'>Delete</a>
            </td>
            <?php endif; ?>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
















<?php require 'footer.php'; ?>
