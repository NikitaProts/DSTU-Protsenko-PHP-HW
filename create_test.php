<?php
    session_start();
    require 'header.php'; 
    require 'db.php';?>


<?php
    if (isset($_SESSION['max_q'])){
        if ($_GET['q'] <= $_SESSION['max_q']){
            $q = $_GET['q'];
            if ($q == 1){
                $number_questions = $_POST['create_test'];
                if ($number_questions ==3) {
                    $sql = 'SELECT * FROM questions ORDER BY RAND() LIMIT 3';
                    $_SESSION['max_q'] = 3;
                } else if ($number_questions ==5) {
                    $sql = 'SELECT * FROM questions ORDER BY RAND() LIMIT 5';
                    $_SESSION['max_q'] = 5;
                }else {
                    header("Location: http://localhost:8083/book_test.php");
                };
                
                $statement = $connection->prepare($sql);
                $statement->execute();
                $questions = $statement->fetchAll(PDO::FETCH_OBJ);
                $_SESSION['questions']= (array) $questions;
                $_SESSION['count_answers'] = 0;
        
        
              
            };
            $question = (array) $_SESSION['questions'][$q - 1];
            if ($q >1){
                $previous_question =  (array) $_SESSION['questions'][$q - 2];
            } else{
                $previous_question = false;
            }
        
            if (isset($_POST['answer'])){
                $answer = $_POST['answer'];
                if ($previous_question['question_answer'] == $answer){
                    ++$_SESSION['count_answers']; 
                }
            }
        }
    } else {

    }
   


?>


<?php if ($_GET['q'] <= $_SESSION['max_q']): ?>
<form action="create_test.php?q=<?= $q + 1 ?>" method="POST">
  <div class="form-group">
      <label for="answer"><?php echo $question['question_text']; ?></label>
    <input type="text" name = 'answer' class="form-control" id="answer">
  </div>
  <button type="submit" class="btn btn-primary">Отправить ответ</button>
</form>
<?php else: ?>
    <pre>
        <p>
            Кол-во правильных ответов: <?= $_SESSION['count_answers'] ?>
        </p>
    </pre>

 <?php endif ?>