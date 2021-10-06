<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM authors WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['birtday']) && isset($_POST['date_death']) ) {
  $name = $_POST['name'];
  $birtday = $_POST['birtday'];
  $date_death = $_POST['date_death'];
  $sql = 'UPDATE authors SET name=:name, birtday=:birtday, date_death=:date_death WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':birtday' => $birtday, ':date_death' => $date_death, ':id' => $id])) {
    header("Location: /");
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
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
          <input value="<?= $person->name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="birtday">birtday</label>
          <input type="text" value="<?= $person->birtday; ?>" name="birtday" id="birtday" class="form-control">
        </div>
        <div class="form-group">
          <label for="date_death">date_death</label>
          <input type="text" value="<?= $person->date_death; ?>" name="date_death" id="date_death" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update person</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
