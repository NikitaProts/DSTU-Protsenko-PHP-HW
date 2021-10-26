<?php 
session_start();
require 'header.php'; 
require 'db.php';
?>

<?php       
    $users_id = $_SESSION['user']['id'];
    $book_id = $_GET['id']; 
    $comment_text = $_POST['comment_text'];
    echo $comment_text;


    $sql = 'INSERT INTO comments(comment_text, users_id, book_id) VALUES(:comment_text, :users_id, :book_id)';
    $statement = $connection->prepare($sql);
    $statement->execute([':comment_text' => $comment_text, ':users_id' => $users_id, ':book_id' => $book_id]);
    header("Location: http://localhost:8083/comments.php?id=".$book_id);


?>




