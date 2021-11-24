<?php

require 'rb/rb.php';

R::setup('mysql:host=localhost;dbname=library_dstu', 'root', '123456');

// $ids = [1,2,3, 4, 5, 6, 7];
// $books = R::loadAll('books', $ids);

// foreach ($books as $book){
//     echo $book->title . '</br>';
// }

//Задание 1. Вставка данных в таблицу автор
// $author = R::dispense('authors');
// $author->name = "Тест_лаб5_1_bdskbfhjsdf";
// $author->birtday = '1888-01-01';
// $author->date_death = '1888-01-02';
// R::store($author);

//Задание 2. Редактирование информации об авторе
// $id = 12;
// $author = R::load('authors', $id);
// $author->name = 'Лаб5_задание_2_____';
// R::store($author);

//Задание 3. Удалить жанр
$genre_test = 'Тест_лаб5';

// $genre = R::dispense('genre');
// $genre->title = $genre_test;
// R::store($genre);

// $genre_test  = R::findOne( 'genre', ' title = ? ', [ $genre_test] );
// $id = $genre_test ->id;
// $genre = R::load('genre', $id);
// R::trash($genre);

//Задание 4. таблица вида Жанр-Количество книг в жанре.


$myResult = R::convertToBeans('myResult', $result); 


$genre_books = R::getAll( "SELECT genre.title, Count(books.genre_id)  FROM genre 
INNER JOIN books ON genre.id = books.genre_id 
GROUP BY genre.title 
;");

//Задание 5

// SELECT * FROM books
// WHERE year_release BETWEEN YEAR(now()) -10 AND  YEAR(now());

// SELECT * FROM books
// WHERE year_release BETWEEN 1900 AND 1919;

$sql = "SELECT books.title,year_release FROM  books
WHERE year_release BETWEEN 1900 AND 1919;";
$sql_data = R::getAll($sql);






?>

<!-- Задание 4 -->

<table border="1">
    <?php foreach ($genre_books as $genre): ?>
        <tr>
            <td><?= $genre['title']?></td>
            <td><?= $genre['Count(books.genre_id)']?></td>
        </tr>
    <?php endforeach;?>
</table>

<!-- Задание 5 -->
<form action="action_5.php" method="post">
 <p>Введите ключевое слово названия книги: <input type="text" name="name" /></p>
 <p><input type="submit" /></p>
</form>



<!-- Задание 6 -->

<ul>
    <?php foreach ($sql_data as $data):?>
        <li><?= $data['title']?> <?= $data['year_release'] ?> </li>
        <?php endforeach;?>
</ul>


<form action="action_5_author.php" method="POST">
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
