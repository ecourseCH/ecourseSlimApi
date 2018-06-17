SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- create a new course - a random scheme needs to be picked and tables created

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
  -- start date
  -- end date
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `participant` (
`participantId` int(11) NOT NULL,
  `participantName` varchar(255) COLLATE utf8_bin NOT NULL,
    `participantSurname` varchar(255) COLLATE utf8_bin NOT NULL,
    `participantScoutname` varchar(255) COLLATE utf8_bin NOT NULL
-- age
-- Unit
-- Group
-- information from Recommender
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `participantTag` (
`participantTagId` int(11) NOT NULL,
`parentParticipantTagId` int(11) NULL,
  `participantTagName` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `observationTag` (
`observationTagId` int(11) NOT NULL,
`parentObservationTagId` int(11) NULL,
  `observationTagName` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `observation` (
`observationId` int(11) NOT NULL,
  `observationText` varchar(4096) COLLATE utf8_bin NOT NULL,
  `activityId` int(11)  NULL,
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `activity` (
`activityId` int(11) NOT NULL,
  `activityName` varchar(255) COLLATE utf8_bin NOT NULL,
  `activityNumber` varchar(255) COLLATE utf8_bin NOT NULL,
  `activityDate` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



CREATE TABLE IF NOT EXISTS `codeMapping` (
`participantTagId` int(11) NOT NULL,
  `courseName` int(11) NOT NULL,
  `dbScheme` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;









