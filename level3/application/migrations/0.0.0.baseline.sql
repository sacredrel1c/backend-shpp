CREATE DATABASE IF NOT EXISTS `library` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `library`;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(11) NOT NULL,
  `MajorVersion` varchar(2) NOT NULL,
  `MinorVersion` varchar(2) NOT NULL,
  `FileNumber` varchar(4) NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `DateApplied` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `migrations` (`id`, `MajorVersion`, `MinorVersion`, `FileNumber`, `Comment`, `DateApplied`) VALUES
(1, '0', '0', '0', 'BaseLine', NOW());
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;