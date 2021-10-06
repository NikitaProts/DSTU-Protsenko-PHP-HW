<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM genre WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$genre = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['title'])) {
  $title = $_POST['title'];
  $sql = 'UPDATE genre SET title=:title WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title, ':id' => $id])) {
    header("Location: /");
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update genre</h2>
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
          <input value="<?= $genre->title; ?>" type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update genre</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
