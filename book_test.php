<?php
    session_start();
    require 'header.php'; 
    require 'db.php';?>
   
<?php
  $q = 1;

?>



<form action="create_test.php?q=<?= $q ?>" method="POST">
  <div class="form-group">
      <label for="create_test">Сколько будет вопросов? 3 или 5</label>
    <input type="number" name = 'create_test' class="form-control" id="create_test">
  </div>
  <button type="submit" class="btn btn-primary">Начать тест</button>
</form>