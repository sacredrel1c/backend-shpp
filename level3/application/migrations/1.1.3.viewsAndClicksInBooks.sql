USE `library`;
ALTER TABLE `books` ADD `clicks` INT NOT NULL AFTER `image`;
ALTER TABLE `books` ADD `views` INT NOT NULL AFTER `clicks`;