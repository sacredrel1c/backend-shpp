USE `library`;

CREATE TABLE IF NOT EXISTS `authors`
(
    `id`   int(11)      NOT NULL,
    `name` varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `authors`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `authors`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `books_authors`
(
    `book_id`   int(11)      NOT NULL,
    `author_id` int(11) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO authors(`name`) SELECT `author`FROM books;

INSERT INTO books_authors(book_id, author_id) SELECT books.id, authors.id FROM books LEFT JOIN authors ON books.author = authors.name;

ALTER TABLE `books` DROP `author`;

