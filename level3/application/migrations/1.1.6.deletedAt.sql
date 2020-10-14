USE `library`;
ALTER TABLE `books` ADD `deletedAt` INT(10) NULL AFTER `views`;