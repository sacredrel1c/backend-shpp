USE `library`;

CREATE TABLE IF NOT EXISTS `admins`
(
    `id`       int(11)      NOT NULL,
    `username` varchar(50)  NOT NULL,
    `pwhash`   varchar(255) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

ALTER TABLE `admins`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `admins`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
