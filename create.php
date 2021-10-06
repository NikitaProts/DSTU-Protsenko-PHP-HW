<?php
require 'db.php';
$message = '';
if (isset ($_POST['name'])  && isset($_POST['birtday']) && isset($_POST['date_death'])) {
  $name = $_POST['name'];
  $birtday = $_POST['birtday'];
  $date_death = $_POST['date_death'];
  $sql = 'INSERT INTO authors(name, birtday, date_death) VALUES(:name, :birtday, :date_death)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':birtday' => $birtday, ':date_death' => $date_death])) {
    $message = 'data inserted successfully';
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Create a person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="birtday">birtday</label>
          <input type="text" name="birtday" id="birtday" class="form-control">
        </div>
        <div class="form-group">
          <label for="date_death">date_death</label>
          <input type="text" name="date_death" id="date_death" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Create a person</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
