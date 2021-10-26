<?php 
session_start();
require 'header.php'; 
require 'db.php';?>


<?php
    $book_id = $_GET['id']; 

    $sql_book = 'SELECT * FROM books WHERE id=:id';
    $statement = $connection->prepare($sql_book);
    $statement->execute([':id' => $book_id ]);
    $book = $statement->fetch(PDO::FETCH_OBJ);
    $book = (array) $book;


    
    $sql = 'SELECT * FROM comments WHERE book_id=:id';
    $statement = $connection->prepare($sql);
    $statement->execute([':id' => $book_id ]);
    $comments = $statement->fetchAll(PDO::FETCH_OBJ);
    $comments = (array) $comments;




?>
<div class="container">
    <div class="row">
    <div class="col-12">
        <div class="p">
            Книга: <?php
            echo $book['title'] ;?>
        </div>
    </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                <th scope="col">User</th>
                <th scope="col">Comment</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php foreach($comments as $comment): ?>

                    <?php
                        $test = 'SELECT login FROM library_users WHERE id = :id' ;
                        $statement_t = $connection->prepare($test);
                        $statement_t->execute([':id' => $comment->users_id]);
                        $query_t = $statement_t->fetch(PDO::FETCH_OBJ);
                    ?>
                <td><?=$query_t->{'login'} ; ?></td>
                <td><?= $comment -> comment_text; ?></td>
                </tr>
                <tr>
                </tr>
                <?php endforeach; ?>
                
            </tbody>
            </table>
        </div>
    </div>

    <?php  if($_SESSION['user']['user_mode'] != 'guest') :?>
    <form action="create_comment.php?id=<?= $book['id'];?>" method="POST">
  <div class="form-group">
    <input type="text" name = 'comment_text' class="form-control" id="comment_text">
  </div>
  <button type="submit" class="btn btn-primary">Написать комментарий</button>
</form>
<?php endif; ?>
</div>
