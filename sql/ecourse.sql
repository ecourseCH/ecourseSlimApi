-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 14. Jun 2018 um 21:42
-- Server Version: 5.6.21
-- PHP-Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `ecourse`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
`noticeId` int(11) NOT NULL,
  `participantId` int(11) NOT NULL,
  `noticeText` longtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `notice`
--

INSERT INTO `notice` (`noticeId`, `participantId`, `noticeText`) VALUES
(1, 1, 'xxxxx'),
(2, 1, 'Meine zweite Beobachtung'),
(3, 1, 'Insert...'),
(4, 1, 'xxx'),
(5, 1, 'blablabla'),
(6, 1, 'ssdasdasd'),
(7, 1, 'Hat wiedermal was am Ecourse gemacht. '),
(8, 1, 'blablablup'),
(9, 2, 'hallo\n'),
(10, 2, 'sdnfalsdjfnl\nÃ¼\n%I/&)=)=W'),
(11, 1, ''),
(12, 1, 'dfsdsdf'),
(13, 1, 'sdfsdfsdf sdf ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `noticeNoticeTag`
--

CREATE TABLE IF NOT EXISTS `noticeNoticeTag` (
  `noticeId` int(11) NOT NULL,
  `noticeTagId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `noticeTag`
--

CREATE TABLE IF NOT EXISTS `noticeTag` (
`noticeTagId` int(11) NOT NULL,
  `noticeTagName` text COLLATE utf8_bin NOT NULL,
  `parentNoticeTagId` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `noticeTag`
--

INSERT INTO `noticeTag` (`noticeTagId`, `noticeTagName`, `parentNoticeTagId`) VALUES
(3, 'Kategorie\r\n', NULL),
(4, 'Pers&ouuml;nlichkeit', 3),
(5, 'Gruppenverhalten', 3),
(6, 'Fachkompetenz', 3),
(7, 'Subcategory 1 Pers&oouml;nlichkeit', 4),
(8, 'Subcategory 2 Pers&ouml;nlichkeit', 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
`participantId` int(11) NOT NULL,
  `scoutName` varchar(255) COLLATE utf8_bin NOT NULL,
  `preName` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `branch` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `participant`
--

INSERT INTO `participant` (`participantId`, `scoutName`, `preName`, `name`, `branch`) VALUES
(1, 'Prusik', 'Florian', 'Bosshard', NULL),
(2, 'Luxus', 'Roman', 'Hellmueller', 'PBS');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `notice`
--
ALTER TABLE `notice`
 ADD PRIMARY KEY (`noticeId`);

--
-- Indizes für die Tabelle `noticeTag`
--
ALTER TABLE `noticeTag`
 ADD PRIMARY KEY (`noticeTagId`);

--
-- Indizes für die Tabelle `participant`
--
ALTER TABLE `participant`
 ADD PRIMARY KEY (`participantId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `notice`
--
ALTER TABLE `notice`
MODIFY `noticeId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT für Tabelle `noticeTag`
--
ALTER TABLE `noticeTag`
MODIFY `noticeTagId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT für Tabelle `participant`
--
ALTER TABLE `participant`
MODIFY `participantId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
