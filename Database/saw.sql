-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 12. Jun 2022 um 15:29
-- Server-Version: 8.0.29-0ubuntu0.20.04.3
-- PHP-Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `saw`
--
CREATE DATABASE IF NOT EXISTS `saw` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `saw`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arrival`
--

DROP TABLE IF EXISTS `arrival`;
CREATE TABLE IF NOT EXISTS `arrival` (
  `cId` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `oId` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `name` varchar(40) NOT NULL,
  `artId` int NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`artId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `article`
--

INSERT INTO `article` (`name`, `artId`, `price`, `available`) VALUES
('Weihnachtliches Formenspiel', 21, 21.99, 0),
('&#34;Florian Stupp&#34; Fancollection', 22, 9.99, 0),
('Dieselgenerator ', 23, 1.99, 1),
('Angereichertes Uran', 24, 0.99, 0),
('Plastiklaurenz', 25, 7.99, 1),
('500g Mitleid', 26, 4.99, 1),
('waffenfähiges Plutonium', 27, 25.99, 1),
('Blyat', 28, 3.99, 0),
('Blyat', 29, 1.99, 1),
('Florian Stupp Fancollection', 30, 9.99, 1),
('test', 31, 5.99, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bankaccount`
--

DROP TABLE IF EXISTS `bankaccount`;
CREATE TABLE IF NOT EXISTS `bankaccount` (
  `id` int NOT NULL,
  `balance` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `bankaccount`
--

INSERT INTO `bankaccount` (`id`, `balance`) VALUES
(1000, 2401.74),
(1234, 1000002206.8089),
(123455, 6.7311111111111),
(123456, 1.5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `banklog`
--

DROP TABLE IF EXISTS `banklog`;
CREATE TABLE IF NOT EXISTS `banklog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `oId` int NOT NULL,
  `bId` int NOT NULL,
  `val` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `banklog`
--

INSERT INTO `banklog` (`id`, `oId`, `bId`, `val`, `date`) VALUES
(11, 1234567, 1234, 100, '2021-05-21 14:18:38'),
(12, 1234567, 1234, 10, '2021-05-28 10:07:36'),
(13, 1234567, 1234, 10, '2021-06-10 15:01:09'),
(14, 1234567, 1234, 2222, '2021-09-09 20:09:05');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `citizen`
--

DROP TABLE IF EXISTS `citizen`;
CREATE TABLE IF NOT EXISTS `citizen` (
  `id` int NOT NULL,
  `passwd` varchar(100) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `fName` varchar(20) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `lName` varchar(20) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `kl` varchar(20) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `theme` enum('Hell','Dunkel') CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL DEFAULT 'Hell',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `citizen`
--

INSERT INTO `citizen` (`id`, `passwd`, `fName`, `lName`, `kl`, `theme`) VALUES
(123455, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Florian', 'Stupp', 'J1', 'Dunkel'),
(123456, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Helmut', 'Honk', '10D', 'Hell');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `enterprise`
--

DROP TABLE IF EXISTS `enterprise`;
CREATE TABLE IF NOT EXISTS `enterprise` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `tax` float NOT NULL,
  `pw` varchar(100) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `theme` enum('Hell','Dunkel') NOT NULL DEFAULT 'Hell',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `enterprise`
--

INSERT INTO `enterprise` (`id`, `name`, `tax`, `pw`, `premium`, `theme`) VALUES
(1000, 'Warenlager', 0, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 0, 'Hell'),
(1234, 'G&G Services', 0.125, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, 'Dunkel');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `env`
--

DROP TABLE IF EXISTS `env`;
CREATE TABLE IF NOT EXISTS `env` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `value` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `officer`
--

DROP TABLE IF EXISTS `officer`;
CREATE TABLE IF NOT EXISTS `officer` (
  `id` int NOT NULL,
  `warehouse` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `bank` tinyint(1) NOT NULL DEFAULT '0',
  `toll` tinyint(1) NOT NULL DEFAULT '0',
  `pw` varchar(100) NOT NULL,
  `cId` int NOT NULL,
  `theme` enum('Hell','Dunkel') NOT NULL DEFAULT 'Hell',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `officer`
--

INSERT INTO `officer` (`id`, `warehouse`, `admin`, `bank`, `toll`, `pw`, `cId`, `theme`) VALUES
(1234567, 1, 1, 1, 1, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 123456, 'Hell');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orderItem`
--

DROP TABLE IF EXISTS `orderItem`;
CREATE TABLE IF NOT EXISTS `orderItem` (
  `oId` int NOT NULL,
  `aId` int NOT NULL,
  `count` int NOT NULL,
  PRIMARY KEY (`oId`,`aId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `orderItem`
--

INSERT INTO `orderItem` (`oId`, `aId`, `count`) VALUES
(95, 23, 1),
(98, 23, 1),
(98, 26, 1),
(98, 27, 1),
(98, 30, 2),
(99, 23, 1),
(99, 25, 1),
(99, 26, 1),
(102, 23, 1),
(102, 25, 1),
(102, 26, 1),
(102, 29, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `cId` int NOT NULL,
  `oId` int NOT NULL AUTO_INCREMENT,
  `offId` int NOT NULL,
  `state` enum('ordering','ordered','shipping','arrived','collected','errored','unknown','cancelled') CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL DEFAULT 'ordering',
  `payed` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`oId`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `orders`
--

INSERT INTO `orders` (`cId`, `oId`, `offId`, `state`, `payed`, `date`) VALUES
(1234, 95, 1234567, 'collected', 1, '2021-09-09 18:27:06'),
(1234, 98, 1234567, 'collected', 1, '2021-09-10 11:20:37'),
(1234, 99, 1234567, 'collected', 1, '2021-09-11 09:40:36'),
(1234, 102, 1234567, 'ordered', 0, '2022-01-10 17:04:05');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `presence`
--

DROP TABLE IF EXISTS `presence`;
CREATE TABLE IF NOT EXISTS `presence` (
  `cId` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL DEFAULT '00:00:00',
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `presence`
--

INSERT INTO `presence` (`cId`, `date`, `time`, `id`) VALUES
(123455, '2021-06-17', '00:09:47', 4),
(123455, '2021-06-21', '93:19:00', 5),
(123455, '2021-08-08', '01:30:34', 7),
(123455, '2021-08-10', '00:09:53', 8),
(123455, '2021-09-11', '00:01:00', 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transfer`
--

DROP TABLE IF EXISTS `transfer`;
CREATE TABLE IF NOT EXISTS `transfer` (
  `tId` int NOT NULL AUTO_INCREMENT,
  `val` float NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `txtL` varchar(100) NOT NULL,
  `txtR` varchar(100) NOT NULL,
  `sendId` int NOT NULL,
  `recId` int NOT NULL,
  `taxVal` float NOT NULL,
  PRIMARY KEY (`tId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf16;

--
-- Daten für Tabelle `transfer`
--

INSERT INTO `transfer` (`tId`, `val`, `txtL`, `txtR`, `sendId`, `recId`, `taxVal`) VALUES
(1, 19.99, 'RechnungsNr', '29381', 1234, 123456, 10.9),
(2, 12.99, 'Buchung', 'Freizeit', 123456, 1234, 7),
(15, 10, 'test', 'zweck', 123456, 1234, 0),
(16, 10, 'test', 'zweck', 123456, 1234, 0),
(17, 8.88889, 'test', 'zweck', 123456, 1234, 1.11111),
(19, 8.88889, 'l', 'r', 123456, 1234, 1.11111),
(20, 8.88889, 'l', 'r', 123456, 1234, 1.11111),
(21, 10, 'l', 'r', 1234, 123456, 0),
(22, 10, 'l', 'r', 1234, 123456, 0),
(23, 8.88889, 'test', 'zweck', 123456, 1234, 1.11111),
(24, 0.888889, 'RN:', '12', 123456, 1234, 0.111111),
(25, 8.88889, 'Test ', 'Zweck', 123456, 1234, 1.11111),
(26, 10, 'Test', 'Zweck', 1234, 123456, 0),
(27, 10.6667, 'Test', 'Zweck', 123456, 1234, 1.33333),
(28, 0.888889, 'Test', 'Zweck', 123456, 1234, 0.111111),
(29, 0.888889, 'Test', 'Zweck', 123456, 1234, 0.111111),
(30, 17.7778, 'Test', 'Zweck', 123456, 1234, 2.22222),
(31, 8.88889, 'Test', 'Zweck', 123456, 1234, 1.11111),
(32, 0.888889, 'Test', 'Zweck', 123456, 1234, 0.111111),
(33, 100, 'Test', 'Zweck', 1234, 123456, 0),
(34, 10, 'Test', 'Zweck', 1234, 1000, 0),
(35, 10, 'Bezahlung', 'Waren', 1234, 1000, 0),
(36, 10.2, 'Test', 'Zweck', 1234, 1000, 0),
(37, 291.81, 'Bezahlung', 'Waren', 1234, 1000, 0),
(38, 291.81, 'Bezahlung', 'Waren', 1234, 1000, 0),
(39, 291.81, 'Bezahlung', 'Waren', 1234, 1000, 0),
(40, 291.81, 'Bezahlung', 'Waren', 1234, 1000, 0),
(41, 291.81, 'Bezahlung', 'Waren', 1234, 1000, 0),
(42, 291.81, 'Bezahlung', 'Waren', 1234, 1000, 0),
(43, 164.91, 'Bezahlung', 'Waren', 1234, 1000, 0),
(44, 164.91, 'Bezahlung', 'Waren', 1234, 1000, 0),
(45, 86.95, 'Bezahlung', 'Waren', 1234, 1000, 0),
(46, 86.95, 'Bezahlung', 'Waren', 1234, 1000, 0),
(47, 0.5, 'Rechnung', 'Kuckuck', 123455, 123456, 0),
(48, 1.76889, 'Hallo', 'Helmut', 123455, 1234, 0.221111),
(49, 1, 'Test', 'Zweck', 123455, 123456, 0),
(50, 1.99, 'Bezahlung', 'Waren', 1234, 1000, 0),
(51, 14.97, 'Bezahlung', 'Waren', 1234, 1000, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
