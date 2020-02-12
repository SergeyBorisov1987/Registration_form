-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `logIn` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `logIn`;

DROP TABLE IF EXISTS `logIn`;
CREATE TABLE `logIn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `logIn` (`id`, `name`, `email`, `password`) VALUES
(2,	'Chak Noris',	'Chak@Noris.com',	'c5fe25896e49ddfe996db7508cf00534'),
(3,	'John Smith',	'Smith@John.com.ca',	'd8578edf8458ce06fbc5bb76a58c5ca4'),
(4,	'Ernesto Guevara',	'ErnestoCheGuevara@gmail.com',	'555cbf3837e743b56e5457d36aa0e99f')
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `email` = VALUES(`email`), `password` = VALUES(`password`);

-- 2020-02-12 08:29:14
