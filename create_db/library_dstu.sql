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
	( '��������� ��������� ������', '1799-05-06', '1837-01-29'),
	( '��������� ������������� ����', '1880-11-16', '1921-08-07'),
	( '����� ���� ����������', '1870-10-10', '1953-11-08'),
	( '��� ���������� �������', '1828-08-28', '1910-11-20'),
	( '������ ����������� ��������', '1891-05-14', '1940-03-10');

DROP TABLE IF EXISTS genre;
CREATE TABLE genre(
	id INT NOT NULL AUTO_INCREMENT,
	title varchar(120),
	PRIMARY KEY(id)
);

INSERT INTO genre(title)
VALUES
	( '�����'),
	( '������� ���������'),
	( '�������������� �������'),
	('�����'),
	( '�������');


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
	('������� ������', '1833', 1, 1, '���� � ������ �������� �������� � ����� ���������� ���������� �������, ���������� � 1823�1830 �����'),
	( '����� �������', '1831', 1, 1, '������������ ������� ������� �������������� ��������'),
	( '������ �����', '1946', 3, 2, '������� �������� � ������� ������� � ���������. ����� �� ������, ������� ������������, ���� �� ����������'),
	( '��������', '1926', 3, 3, '��� �������������� � ����������-���������������� ������������'),
	( '����������', '1918', 2, 4, '����� ���������� ����� �� ����������� ���������'),
	( '����������', '1907', 2, 3, '������������� ��������� ��������� ����������'),
	( '���� ��������', '1875', 4, 5, '����� ���� �������� � ����������� ����� �������� ���� ���� ���������'),
	( '������ � ���������', '1966', 5, 1, '������������, � ������� ������� ��������� �����������, � ������ ������ ����' ),
	( '����� � ���', '1865', 4, 1, '�����-������ ���� ����������� ��������, ����������� ������� �������� � ����� ���� ������ ���������');



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
	('�����-������ �����?', '������'),
	('��� �������� �������?', '1643'),
	('��� ����� ������� �������?', '������'),
	('1+1?', '3'),
	('������ ���?', '�� �����!');

SELECT * FROM questions;

SELECT * FROM questions
ORDER BY RAND()
LIMIT 3;

SELECT * FROM authors
WHERE birtday BETWEEN '1800-05-06' AND '1850-11-16';


SELECT COUNT(*) FROM books 
WHERE author_id = 4;




-- �������

-- 1. ����� ����� 19�� ���� (1801 - 1900)
	
SELECT books.title, books.year_release , genre.title 
FROM books 
LEFT JOIN genre
ON books.genre_id = genre.id
WHERE year_release > 1800 AND year_release < 1901;
	
-- 2. ���������� ���������� ���� ������� ������

SELECT authors.name, count(*) 
FROM books 
LEFT JOIN authors 
ON authors.id = books.author_id 
GROUP BY authors.name;
	
-- 3. ����� ��� �����, ���������� �������� � ������������� �� �� �����

SELECT *
FROM books 
WHERE author_id = 1
ORDER BY year_release DESC;

-- 4. �������� 2 ����� ������ � ������� ����
-- ��������� ������ �� ����� ���� � ���� ����� 

INSERT INTO genre(id, title)
VALUES 
	(6, '��������'),
	(7, '����������');

SELECT * FROM genre 
WHERE id = 6 OR ID = 7;

SELECT * FROM genre 
inner JOIN books ON  books.genre_id = genre.id 
WHERE genre.title ='��������' OR genre.title = '����������';

SELECT * FROM genre; -- �������� ��� ������ ����� ��������� � �������
	
-- 5. �������� ������� ����: �������� �����, �� ����� � ����, � ������� ��� ��������

SELECT books.title, authors.name, genre.title 
FROM books 
INNER JOIN authors ON authors.id = books.author_id 
INNER JOIN genre ON genre.id = books.genre_id;
	
-- 6. ������� ���� �������, ���������� ����� � ����� �����

SELECT authors.name 
FROM books 
INNER JOIN authors ON authors.id = books.author_id 
INNER JOIN genre ON genre.id = books.genre_id
WHERE genre.title = '�����'
GROUP BY authors.name;
	
-- 7. ����� ������ ����� ����� � ���

SELECT authors.name
FROM books 
LEFT JOIN authors ON authors.id = books.author_id 
WHERE books.title = '����� � ���';
	
-- 8. ������� ��� �����, � ������� ��� �� ����� �����.
SELECT *
FROM genre 
INNER JOIN  books ON books.genre_id = genre.id 
WHERE books.id IS NULL;

-- 9. ����� �����, ������ ������� �������� � 19 ����(1801 - 1900) ������� �������� ���� � �� ��������.

SELECT books.title, books.description
FROM books
left JOIN authors ON authors.id = books.author_id 
WHERE authors.birtday > '1800-01-01' AND authors.birtday < '1901-01-01';

-- 10. 	����������, ������� ��� ������ ����� ���������� ������ � ��������� ����� ���� ��������.

SELECT	(
	(SELECT max(year_release) FROM books 
	WHERE author_id = 4 ))
	-
	(SELECT year_release FROM books 
	WHERE author_id = 4
	ORDER by year_release ASC
	LIMIT 1);
	
	
-- 11. ���������� ��� �������: 1 � ����� �������, ��� ��� ���������� �� ����� � � 2 � ����� �������, ������� �������� � 1891 ����.

SELECT * FROM authors
WHERE name LIKE '�%' OR birtday LIKE '1891%';

SELECT * FROM authors WHERE name LIKE '�%'
UNION 
SELECT * FROM authors WHERE birtday LIKE '1891%';

-- 12. �������� ������������� �� ������ �� �������� � ����� �������� �� ���� ���������� �� ������������� ��������.
CREATE OR REPLACE VIEW task_12
AS
SELECT books.title, authors.name, genre.title AS genre_title
FROM books 
INNER JOIN authors ON authors.id = books.author_id 
INNER JOIN genre ON genre.id = books.genre_id;

SELECT title FROM task_12;

-- 13.�������� ��� ��������� ����� ����� � ���.

UPDATE books 
SET year_release = 2020
WHERE title = '����� � ���';

SELECT * FROM books;

-- 14. ������� ��� ����� ���������� � ����� �����

DELETE FROM books 
WHERE books.genre_id = 1;

SELECT * FROM books;

	
	
	
	
	
	
	
	
	