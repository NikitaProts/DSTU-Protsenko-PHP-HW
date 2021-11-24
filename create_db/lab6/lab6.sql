-- Задание 1
ALTER TABLE authors DROP COLUMN amount;
ALTER TABLE genre DROP COLUMN amount;

ALTER TABLE authors ADD COLUMN amount int DEFAULT 0;
ALTER TABLE genre ADD COLUMN amount int DEFAULT 0;


-- Задание 2

-- согласование жанров 
delimiter //
DROP PROCEDURE IF EXISTS lab6_genre//
CREATE PROCEDURE lab6_genre()
BEGIN 
	update genre set amount = (select count(*) from books where genre_id = genre.id)
	where exists (select count(*) from books where genre_id = genre.id);
END //
delimiter ;

CALL lab6_genre();

-- согласование авторов
delimiter //
DROP PROCEDURE IF EXISTS lab6_author//
CREATE PROCEDURE lab6_author()
BEGIN 
	update authors set amount = (select count(*) from books where author_id = authors.id)
	where exists (select count(*) from books where author_id = authors.id);
END //
delimiter ;

CALL lab6_author();


-- Задание 3

delimiter //
DROP TRIGGER IF EXISTS lab6_3_genre//
CREATE TRIGGER lab6_3_genre
AFTER INSERT 
ON books
FOR EACH ROW BEGIN 
	CALL lab6_genre();
END;

delimiter ;

SELECT * FROM genre;

INSERT INTO books(title, year_release, author_id, genre_id, description)
VALUES
	('FFFFFF', '1833', 1, 6, 'оман в стихах русского писателя и поэта Александра Сергеевича Пушкина, написанный в 1823—1830 годах');

delimiter //
DROP TRIGGER IF EXISTS lab6_3_author//
CREATE TRIGGER lab6_3_author
AFTER INSERT 
ON books
FOR EACH ROW BEGIN 
	CALL lab6_author();
END;

delimiter ;

SELECT * FROM authors;

INSERT INTO books(title, year_release, author_id, genre_id, description)
VALUES
	('FFFFFF', '1833', 4, 7, 'оман в стихах русского писателя и поэта Александра Сергеевича Пушкина, написанный в 1823—1830 годах');

-- Задание 4

delimiter //
DROP TRIGGER IF EXISTS lab6_3_genre//
CREATE TRIGGER lab6_3_genre
AFTER delete 
ON books
FOR EACH ROW BEGIN 
	CALL lab6_genre();
END;

delimiter ;

delimiter //
DROP TRIGGER IF EXISTS lab6_3_author//
CREATE TRIGGER lab6_3_author
AFTER DELETE  
ON books
FOR EACH ROW BEGIN 
	CALL lab6_author();
END;

delimiter ;

DELETE FROM books WHERE genre_id = 7;


-- Задание 5

CREATE VIEW `lab6_5` AS
SELECT * FROM genre;
-- а 
SELECT * FROM `lab6_5`;
delimiter //
DROP PROCEDURE IF EXISTS show_all_genres//
CREATE PROCEDURE show_all_genres()
BEGIN 
	SELECT * FROM genre;
END //
delimiter ;

CALL show_all_genres();

-- b
delimiter //
DROP PROCEDURE IF EXISTS show_genre_params//
CREATE PROCEDURE show_genre_params(IN genre_title varchar(100))
BEGIN 
	SELECT * FROM `lab6_5` WHERE title = genre_title;
END //
delimiter ;

CALL show_genre_params('Поэма');

-- c 
delimiter //
DROP PROCEDURE IF EXISTS show_book_params//
CREATE PROCEDURE show_book_params(IN genre_title varchar(100))
BEGIN 
	SELECT * FROM books 
	WHERE genre_id = (SELECT id FROM `lab6_5` WHERE title = genre_title);
END
delimiter ;

CALL show_book_params('Реализм');
-- d 

delimiter //
DROP PROCEDURE IF EXISTS show_book_author//
CREATE PROCEDURE show_book_author(IN book_title varchar(100))
BEGIN 
	SELECT authors.name, books.title FROM authors LEFT JOIN books ON books.author_id = authors.id WHERE books.title = book_title;
END
delimiter ;

CALL show_book_author('Темные аллеи');


-- Задание 6

DROP TABLE IF EXISTS basket;
CREATE TABLE basket(
	id INT NOT NULL AUTO_INCREMENT,
	title varchar(120),
	description varchar(360),
	year_release varchar(4),
	author_id INT NOT NULL,
	genre_id int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(author_id) REFERENCES authors(id),
	FOREIGN KEY(genre_id) REFERENCES genre(id)
);



SELECT * FROM basket;

delimiter //
CREATE PROCEDURE from_books_to_basket_func()
BEGIN 
	INSERT INTO basket (title, description, year_release, author_id,genre_id )
	SELECT books.title, books.description, books.year_release, books.author_id, books.genre_id FROM books LEFT JOIN genre ON books.genre_id = genre.id WHERE genre.title ='Детектив';
END
delimiter ;


SET GLOBAL event_scheduler = On;

delimiter //
-- DROP EVENT IF  EXISTS `from_books_to_basket_func`;
CREATE EVENT `from_books_to_basket_func`
ON SCHEDULE EVERY 1 MINUTE 
DO BEGIN 
	CALL from_books_to_basket_func();
END
delimiter ;

	
	












