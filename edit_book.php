<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM books WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$book = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['title'])  && isset($_POST['description']) && isset($_POST['year_release'])&& isset($_POST['author_id'])&& isset($_POST['genre_id']) ) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $year_release = $_POST['year_release'];
  $author_id = $_POST['author_id'];
  $genre_id = $_POST['genre_id'];
  $sql = 'UPDATE books SET title=:title, description=:description, year_release=:year_release, author_id=:author_id, genre_id=:genre_id WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title, ':description' => $description, ':year_release' => $year_release, ':author_id' => $author_id, ':genre_id' => $genre_id, ':id' => $id])) {
    header("Location: /");
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update book</h2>
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
          <input value="<?= $book->title; ?>" type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="description">description</label>
          <input type="text" value="<?= $book->description; ?>" name="description" id="description" class="form-control">
        </div>
        <div class="form-group">
          <label for="year_release">year_release</label>
          <input type="text" value="<?= $book->year_release; ?>" name="year_release" id="year_release" class="form-control">
        </div>
        <div class="form-group">
          <label for="author_id">author_id</label>
          <input type="text" value="<?= $book->author_id; ?>" name="author_id" id="author_id" class="form-control">
        </div>
        <div class="form-group">
          <label for="genre_id">genre_id</label>
          <input type="text" value="<?= $book->genre_id; ?>" name="genre_id" id="genre_id" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update book</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
