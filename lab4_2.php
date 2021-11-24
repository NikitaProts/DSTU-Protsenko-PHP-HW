<?php
    
    class Data{
        public $connection;

        function __construct()
        {
            $dsn = 'mysql:host=localhost;dbname=library_dstu';
            $username = 'root';
            $password='123456';
            $this->connection = new PDO($dsn, $username, $password);
        }
    }

    class Author{
        public $all_authors;

        function __construct($connection)
        {
            $sql = 'SELECT * FROM authors';
            $statement = $connection->prepare($sql);
            $statement->execute();
            $this->all_authors = $statement->fetchAll(PDO::FETCH_OBJ);

        }

        function edit_author($connection, $id, $name, $birtday, $date_death){
            $sql = 'UPDATE authors SET name=:name, birtday=:birtday, date_death=:date_death WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->execute([':name' => $name, ':birtday' => $birtday, ':date_death' => $date_death, ':id' => $id]);
        }

        function delete_author($connection, $id){
            $sql = 'DELETE FROM authors WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->execute([':id' => $id]);
        }

        function create_author($connection, $name, $birtday, $date_death){
            $sql = 'INSERT INTO authors(name, birtday, date_death) VALUES(:name, :birtday, :date_death)';
            $statement = $connection->prepare($sql);
            $statement->execute([':name' => $name, ':birtday' => $birtday, ':date_death' => $date_death]);

        }
    }

    class Book{

        public $all_books;

        function __construct($connection)
        {
            $sql_book = 'SELECT * FROM books';
            $statement_book = $connection->prepare($sql_book);
            $statement_book->execute();
            $this->all_books = $statement_book->fetchAll(PDO::FETCH_OBJ);
        }

        function create_book($connection, $title, $description, $year_release, $author_id, $genre_id){
            $sql = 'INSERT INTO books(title, description, year_release,author_id, genre_id ) VALUES(:title, :description, :year_release, :author_id, :genre_id)';
            $statement = $connection->prepare($sql);
            $statement->execute([':title' => $title, ':description' => $description, ':year_release' => $year_release,':author_id' => $author_id,':genre_id' => $genre_id ]);
        }

        function delete_book($connection, $id){
            $sql = 'DELETE FROM books WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->execute([':id' => $id]);
        }

        function edit_book($connection, $title, $description, $year_release, $author_id, $genre_id, $id){
            $sql = 'UPDATE books SET title=:title, description=:description, year_release=:year_release, author_id=:author_id, genre_id=:genre_id WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->execute([':title' => $title, ':description' => $description, ':year_release' => $year_release, ':author_id' => $author_id, ':genre_id' => $genre_id, ':id' => $id]);
        }
    }

    class Genre{
        public $all_genres;

        function __construct($connection)
        {
            $sql_genre = 'SELECT * FROM genre';
            $statement_genre = $connection->prepare($sql_genre);
            $statement_genre->execute();
            $this->all_genres = $statement_genre->fetchAll(PDO::FETCH_OBJ);
        }

        function create_genre($connection, $title){
            $sql = 'INSERT INTO genre(title) VALUES(:title)';
            $statement = $connection->prepare($sql);
            $statement->execute([':title' => $title]);

        }

        function edit_genre( $connection, $id, $title){
            $sql = 'UPDATE genre SET title=:title WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->execute([':title' => $title, ':id' => $id]);
        }

        function delete_genre($connection, $id){
            $sql = 'DELETE FROM genre WHERE id=:id';
            $statement = $connection->prepare($sql);
            $statement->execute([':id' => $id]);
        }

    }


    $data = new Data();
    $my_authors = new Author($data->connection);
    //$my_authors->create_author($data->connection, 'Test', '2000-05-06', '1799-05-06');
    //$my_authors->edit_author($data->connection, 11, 'Nikita', '2000-05-06', '1799-05-06');
    //$my_authors->delete_author($data->connection, 11);
    print_r($my_authors);

    $my_books = new Book($data->connection);
    //$my_books->create_book($data->connection, 'Test', 'test', '1999', '3', '3');
    //$my_books->edit_book($data->connection, 'Test2', 'Test2','1999', '3', '3', 22);
    //$my_books->delete_book($data->connection, 22);
    //print_r($my_books->all_books);

    $my_genres = new Genre($data->connection);
    //$my_genres->create_genre($data->connection, 'TestGenre');
    //$my_genres->edit_genre($data->connection, 11, 'TEEEEEEEEEEEEESSSST');
    //$my_genres->delete_genre($data->connection, 11);
    //print_r($my_genres->all_genres);

    

?>