<?php 
require 'db.php';

$sql_authors = "SELECT * FROM authors";
$statement_authors = $connection->prepare($sql_authors);
$statement_authors->execute();
$authors = $statement_authors->fetchAll(PDO::FETCH_OBJ);

$sql_genres = 'SELECT * FROM genre';
$statement_genres = $connection->prepare($sql_genres);
$statement_genres->execute();
$genres = $statement_genres->fetchAll(PDO::FETCH_OBJ);

$sql_books = 'SELECT * FROM books';
$statement_books = $connection->prepare($sql_books);
$statement_books->execute();
$books = $statement_books->fetchAll(PDO::FETCH_OBJ);

if (isset ($_POST['book_id']) && isset ($_POST['genre_id'])  && isset ($_POST['author_id']) ){
    $book_id = $_POST['book_id'];
    $genre_id = $_POST['genre_id'];
    $author_id = $_POST['author_id'];


    $sql = 'SELECT * FROM books WHERE id= :id OR genre_id = :genre_id OR author_id = :author_id ';
    $statement = $connection->prepare($sql);
    $statement->execute([':id' => $book_id, ':genre_id' => $genre_id, ':author_id' => $author_id ]);
    $query = $statement->fetchAll(PDO::FETCH_OBJ);   

} 
?>



<?php require 'header.php'; ?>

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Запрос</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>

      <form method="post">
        <div class="form-group">
        <select onchange="myFunction_1(event)"   class="form-control" id="genre_id_select" name = 'genre_id_select'>
        <option   value="0">None</option>
        <?php
          foreach($genres as $genre) { ?>
            <option value="<?= $genre->id; ?>"><?= $genre->title;  ?></option>
        <?php
          } ?>
          </select>
          <label for="genre_id">id жанра: </label>
          <input  type="text" name="genre_id" id="genre_id" class="form-control" readonly>
        </div>

        <div class="form-group">
          <select onchange="myFunction(event)"   class="form-control" id="author_id_select" name = 'author_id_select'>
          <option  value="0">None</option>
        <?php
          foreach($authors as $person) { ?>
            <option value="<?= $person->id; ?>"><?= $person->name;  ?></option>
        <?php
          } ?>
          </select>
          <label for="author_id">id автора: </label>
          <input  type="text" name="author_id" id="author_id" class="form-control" readonly>
        </div>

        <div class="form-group">
          <select onchange="myFunction_2(event)"   class="form-control" id="book_id_select" name = 'book_id_select'>
          <option  value="0">None</option>
        <?php
          foreach($books as $book) { ?>
            <option value="<?= $book->id; ?>"><?= $book->title;  ?></option>
        <?php
          } ?>
          </select>
          <label for="book_id">id книги: </label>
          
          <input  type="text" name="book_id" id="book_id" class="form-control" readonly>
        </div>



        <div class="form-group">
          <button type="submit" class="btn btn-info">Отправить</button>
          
        </div>
      </form>
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
        <?php foreach($query as $books): ?>
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



<script src="script.js"></script>
<?php require 'footer.php'; ?>