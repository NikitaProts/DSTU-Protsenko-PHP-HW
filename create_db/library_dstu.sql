DROP DATABASE IF EXISTS library_dstu;
CREATE DATABASE library_dstu;

USE library_dstu;

DROP TABLE IF EXISTS authors; 
CREATE TABLE authors(
	id INT NOT NULL AUTO_INCREMENT,
	name varchar(120),
	birtday DATE, 
	date_death DATE,
	PRIMARY KEY(id)
);

INSERT INTO authors (name, birtday, date_death)
VALUES
	( 'Александр Сергеевич Пушкин', '1799-05-06', '1837-01-29'),
	( 'Александр Александрович Блок', '1880-11-16', '1921-08-07'),
	( 'Бунин Иван Алексеевич', '1870-10-10', '1953-11-08'),
	( 'Лев Николаевич Толстой', '1828-08-28', '1910-11-20'),
	( 'Михаил Афанасьевич Булгаков', '1891-05-14', '1940-03-10');

DROP TABLE IF EXISTS genre;
CREATE TABLE genre(
	id INT NOT NULL AUTO_INCREMENT,
	title varchar(120),
	PRIMARY KEY(id)
);

INSERT INTO genre(title)
VALUES
	( 'Роман'),
	( 'Сборник рассказов'),
	( 'Художественный вымысел'),
	('Поэма'),
	( 'Реализм');


DROP TABLE IF EXISTS books;
CREATE TABLE books(
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

INSERT INTO books(title, year_release, author_id, genre_id, description)
VALUES
	('Евгений Онегин', '1833', 1, 1, 'оман в стихах русского писателя и поэта Александра Сергеевича Пушкина, написанный в 1823—1830 годах'),
	( 'Борис Годунов', '1831', 1, 1, 'великолепный образец русской реалистической трагедии'),
	( 'Темные аллеи', '1946', 3, 2, 'История создания – рассказ написан в эмиграции. Тоска по родине, светлые воспоминания, уход от реальности'),
	( 'Окаянные', '1926', 3, 3, 'это художественное и философско-публицистическое произведение'),
	( 'Двенадцать', '1918', 2, 4, 'поэма Александра Блока об Октябрьской революции'),
	( 'Незнакомка', '1907', 2, 3, 'Стихотворение посвящено конфликту реальности'),
	( 'Анна Карегина', '1875', 4, 5, 'роман Льва Толстого о трагической любви замужней дамы Анны Карениной'),
	( 'Мастер и Маргарита', '1966', 5, 1, 'произведение, в котором находят отражения философские, а значит вечные темы' ),
	( 'Война и Мир', '1865', 4, 1, 'роман-эпопея Льва Николаевича Толстого, описывающий русское общество в эпоху войн против Наполеона');



DROP TABLE library_users;
CREATE table library_users(
	id INT NOT NULL AUTO_INCREMENT,
	login varchar(120),
	email varchar(120),
	psword varchar(120),
	user_mode varchar(20),
	PRIMARY KEY(id)	
);

INSERT INTO library_users(login, email, psword, user_mode)
VALUES
('admin', 'admin@email.com', 'admin', 'admin');

DROP TABLE comments;
CREATE TABLE comments(
	id INT NOT NULL AUTO_INCREMENT,
	comment_text TEXT,
	users_id INT NOT NULL,
	book_id INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(users_id) REFERENCES library_users(id),
	FOREIGN KEY(book_id) REFERENCES books(id)
	
);
INSERT INTO comments(comment_text, users_id, book_id) VALUES('dadasd', 3, 3);

SELECT c.comment_text, b.title, l.login  FROM comments c
INNER JOIN books b  ON c.book_id = b.id 
INNER JOIN library_users l ON c.users_id = l.id
WHERE b.id = 3;

DROP TABLE IF EXISTS questions;
CREATE TABLE questions(
	id INT NOT NULL AUTO_INCREMENT,
	question_text text,
	question_answer text,
	PRIMARY KEY(id)
);
INSERT INTO questions(question_text, question_answer)
VALUES
	('Какой-нибудь автор?', 'Пушкин'),
	('Год рождения Ньютона?', '1643'),
	('Как зовут лучшего ученика?', 'Никита'),
	('1+1?', '3'),
	('Джедаи тут?', 'на месте!');

SELECT * FROM questions;

SELECT * FROM questions
ORDER BY RAND()
LIMIT 3;

SELECT * FROM authors
WHERE birtday BETWEEN '1800-05-06' AND '1850-11-16';


SELECT COUNT(*) FROM books 
WHERE author_id = 4;




-- Задания

-- 1. Найти книги 19го века (1801 - 1900)
	
SELECT books.title, books.year_release , genre.title 
FROM books 
LEFT JOIN genre
ON books.genre_id = genre.id
WHERE year_release > 1800 AND year_release < 1901;
	
-- 2. Определить количество книг каждого автора

SELECT authors.name, count(*) 
FROM books 
LEFT JOIN authors 
ON authors.id = books.author_id 
GROUP BY authors.name;
	
-- 3. Найти все книги, написанные Пушкиным и отсортировать их по годам

SELECT *
FROM books 
WHERE author_id = 1
ORDER BY year_release DESC;

-- 4. Добавить 2 новые записи в таблицу жанр
-- Выполнить запрос на поиск книг в этом жанре 

INSERT INTO genre(id, title)
VALUES 
	(6, 'Детектив'),
	(7, 'Антиутопия');

SELECT * FROM genre 
WHERE id = 6 OR ID = 7;

SELECT * FROM genre 
inner JOIN books ON  books.genre_id = genre.id 
WHERE genre.title ='Детектив' OR genre.title = 'Антиутопия';

SELECT * FROM genre; -- проверка что даныне жанры появились в таблице
	
-- 5. Выведите таблицу вида: название книги, ее автор и жанр, в котором она написана

SELECT books.title, authors.name, genre.title 
FROM books 
INNER JOIN authors ON authors.id = books.author_id 
INNER JOIN genre ON genre.id = books.genre_id;
	
-- 6. Найдите всех авторов, написавших книги в жанре роман

SELECT authors.name 
FROM books 
INNER JOIN authors ON authors.id = books.author_id 
INNER JOIN genre ON genre.id = books.genre_id
WHERE genre.title = 'Роман'
GROUP BY authors.name;
	
-- 7. Найти автора Книги Война и Мир

SELECT authors.name
FROM books 
LEFT JOIN authors ON authors.id = books.author_id 
WHERE books.title = 'Война и Мир';
	
-- 8. Вывести все жанры, в которых нет ни одной книги.
SELECT *
FROM genre 
INNER JOIN  books ON books.genre_id = genre.id 
WHERE books.id IS NULL;

-- 9. Найти книги, авторы которых родились в 19 веке(1801 - 1900) Вывести названия книг и их описание.

SELECT books.title, books.description
FROM books
left JOIN authors ON authors.id = books.author_id 
WHERE authors.birtday > '1800-01-01' AND authors.birtday < '1901-01-01';

-- 10. 	Определите, сколько лет прошло между написанием первой и последней книги Льва Толстого.

SELECT	(
	(SELECT max(year_release) FROM books 
	WHERE author_id = 4 ))
	-
	(SELECT year_release FROM books 
	WHERE author_id = 4
	ORDER by year_release ASC
	LIMIT 1);
	
	
-- 11. Объедините два запроса: 1 – Поиск авторов, чье имя начинается на букву А и 2 – Поиск авторов, которые родились в 1891 году.

SELECT * FROM authors
WHERE name LIKE 'А%' OR birtday LIKE '1891%';

SELECT * FROM authors WHERE name LIKE 'А%'
UNION 
SELECT * FROM authors WHERE birtday LIKE '1891%';

-- 12. Создайте представление по одному из запросов и затем выведите из него информацию по произвольному критерию.
CREATE OR REPLACE VIEW task_12
AS
SELECT books.title, authors.name, genre.title AS genre_title
FROM books 
INNER JOIN authors ON authors.id = books.author_id 
INNER JOIN genre ON genre.id = books.genre_id;

SELECT title FROM task_12;

-- 13.Измените год написания книги Война и мир.

UPDATE books 
SET year_release = 2020
WHERE title = 'Война и Мир';

SELECT * FROM books;

-- 14. Удалите все книги написанные в жанре Роман

DELETE FROM books 
WHERE books.genre_id = 1;

SELECT * FROM books;

	
	
	
	
	
	
	
	
	