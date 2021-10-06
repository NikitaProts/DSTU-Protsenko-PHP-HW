<?php
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
 ?>
<?php require 'header.php'; ?>
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
            <td>
              <a href="edit.php?id=<?= $person->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?id=<?= $person->id ?>" class='btn btn-danger'>Delete</a>
            </td>
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
          <th>ID</th>
          <th>title </th>
          <th>description  </th>
          <th>year_release</th>
          <th>author_id</th>
          <th>genre_id</th>
        </tr>
        <?php foreach($books as $books): ?>
          <tr>
            <td><?= $books->id; ?></td>
            <td><?= $books->title; ?></td>
            <td><?= $books->description; ?></td>
            <td><?= $books->year_release; ?></td>
            <td><?= $books->author_id; ?></td>
            <td><?= $books->genre_id; ?></td>
            <td>
              <a href="edit_book.php?id=<?= $books->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_book.php?id=<?= $books->id ?>" class='btn btn-danger'>Delete</a>
            </td>
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
            <td>
              <a href="edit_genre.php?id=<?= $genre->id ?>" class="btn btn-info">Edit</a>
              <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete_genre.php?id=<?= $genre->id ?>" class='btn btn-danger'>Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
















<?php require 'footer.php'; ?>
