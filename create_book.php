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

$message = '';
if (isset ($_POST['title'])  && isset($_POST['description']) && isset($_POST['year_release'])&& isset($_POST['author_id'])&& isset($_POST['genre_id']) ) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $year_release = $_POST['year_release'];
    $author_id = $_POST['author_id'];
    $genre_id = $_POST['genre_id'];
  $sql = 'INSERT INTO books(title, description, year_release,author_id, genre_id ) VALUES(:title, :description, :year_release, :author_id, :genre_id)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title, ':description' => $description, ':year_release' => $year_release,':author_id' => $author_id,':genre_id' => $genre_id ])) {
    $message = 'data inserted successfully';
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a book</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="title">title</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">description</label>
          <input type="text" name="description" id="description" class="form-control">
        </div>
        <div class="form-group">
          <label for="year_release">year_release</label>
          <input type="text" name="year_release" id="year_release" class="form-control">
        </div>
        <div class="form-group">
        <select onchange="myFunction_1(event)"   class="form-control" id="genre_id_select" name = 'genre_id_select'>
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
          <button type="submit" class="btn btn-info">Create a book</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script src="script.js"></script>
<?php require 'footer.php'; ?>
