SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- TODO check if db exists - if yes, make a dump/rename and delete it
DROP TABLE IF EXISTS `leader`;
DROP TABLE IF EXISTS `course`;

CREATE TABLE IF NOT EXISTS `leader` (
`leaderId` int(11) NOT NULL,
`userId` int(11) NOT NULL,
  `leaderName` varchar(255) COLLATE utf8_bin NOT NULL,
    `leaderSurname` varchar(255) COLLATE utf8_bin NOT NULL,
    `leaderScoutname` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
ALTER TABLE `leader`
 ADD PRIMARY KEY (`leaderId`);
 
 ALTER TABLE `leader`
 ADD UNIQUE KEY (`userId`);



CREATE TABLE IF NOT EXISTS `course` (
`courseId` int(11) NOT NULL,
  `courseName` int(11) NOT NULL,
  `dbScheme` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

