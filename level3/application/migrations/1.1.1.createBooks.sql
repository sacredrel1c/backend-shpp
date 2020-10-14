USE `library`;

CREATE TABLE IF NOT EXISTS `books`
(
    `id`          int(11)      NOT NULL,
    `title`       varchar(50)  NOT NULL,
    `author`      varchar(50)  NOT NULL,
    `year`        int(4)       NOT NULL,
    `pages`       int(5)       NOT NULL,
    `isbn`        varchar(255) NOT NULL,
    `description` varchar(255) NOT NULL,
    `image`       varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `books`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `books`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
