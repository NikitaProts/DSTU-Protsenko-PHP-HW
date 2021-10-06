<?php
require 'db.php';
$message = '';
if (isset ($_POST['title'])) {
  $title = $_POST['title'];
  $sql = 'INSERT INTO genre(title) VALUES(:title)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title])) {
    $message = 'data inserted successfully';
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a genre</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a title</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
