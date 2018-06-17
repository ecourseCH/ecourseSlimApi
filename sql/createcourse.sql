SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- TODO create a new course - a random dbname needs to be picked, created and used
-- tables to be created in new db



DROP TABLE IF EXISTS `participant`;
DROP TABLE IF EXISTS `participantTag`;
DROP TABLE IF EXISTS `observationTag`;
DROP TABLE IF EXISTS `observation`;
DROP TABLE IF EXISTS `activity`;
DROP TABLE IF EXISTS `codeMapping`;
DROP TABLE IF EXISTS `leader`;


CREATE TABLE IF NOT EXISTS `leader` (
`leaderId` int(11) NOT NULL,
`userId` int(11) NOT NULL,
  `leaderName` varchar(255) COLLATE utf8_bin NOT NULL,
    `leaderSurname` varchar(255) COLLATE utf8_bin NOT NULL,
    `leaderScoutname` varchar(255) COLLATE utf8_bin NOT NULL,
     PRIMARY KEY (`leaderId`),
     UNIQUE KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- TODO might not work accross db's
ALTER TABLE leader ADD CONSTRAINT fk2_user_id FOREIGN KEY (userId) REFERENCES user(userId);



CREATE TABLE IF NOT EXISTS `participant` (
`participantId` int(11) NOT NULL,
  `participantName` varchar(255) COLLATE utf8_bin NOT NULL,
    `participantSurname` varchar(255) COLLATE utf8_bin NOT NULL,
    `participantScoutname` varchar(255) COLLATE utf8_bin NOT NULL,
-- age
-- Unit
-- Group
-- information from Recommender
     PRIMARY KEY (`participantId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- TODO maybe needs to be linked to observation /activity for purpose of observation requests
CREATE TABLE IF NOT EXISTS `participantTag` (
`participantTagId` int(11) NOT NULL,
`parentParticipantTagId` int(11) NULL,
  `participantTagName` varchar(255) COLLATE utf8_bin NOT NULL,
       PRIMARY KEY (`participantTagId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- TODO intersection leader - participantTag

-- TODO intersection participant Tag - participant

CREATE TABLE IF NOT EXISTS `activity` (
`activityId` int(11) NOT NULL,
  `activityName` varchar(255) COLLATE utf8_bin NOT NULL,
  `activityNumber` varchar(255) COLLATE utf8_bin NOT NULL,
  `activityDate` DATETIME NOT NULL,
       PRIMARY KEY (`activityId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




CREATE TABLE IF NOT EXISTS `observation` (
`observationId` int(11) NOT NULL,
  `observationText` varchar(4096) COLLATE utf8_bin NOT NULL,
  `activityId` int(11)  NULL,
  `observationDate` DATETIME NULL,
  `leaderId` int(11) NOT NULL,
  `participantId` int(11) NOT NULL,
       PRIMARY KEY (`observationId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE observation ADD CONSTRAINT fk_activity_id FOREIGN KEY (activityId) REFERENCES activity(activityId);

-- TODO check might be 1..n - 0..n
ALTER TABLE observation ADD CONSTRAINT fk_leader_id FOREIGN KEY (leaderId) REFERENCES leader(leaderId);

-- TODO check might be 1..n - 0..n
ALTER TABLE observation ADD CONSTRAINT fk_participant_id FOREIGN KEY (participantId) REFERENCES participant(participantId);


CREATE TABLE IF NOT EXISTS `observationTag` (
`observationTagId` int(11) NOT NULL,
`parentObservationTagId` int(11) NULL,
  `observationTagName` int(11) NOT NULL,
       PRIMARY KEY (`observationTagId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- TODO intersection observation - observation Tag




CREATE TABLE IF NOT EXISTS `codeMapping` (
`codeMappingId` int(11) NOT NULL,
  `codeMappingName` varchar(255) COLLATE utf8_bin NOT NULL,
  `Key1` int(11)  NULL,
  `Value1` varchar(255) COLLATE utf8_bin  NULL,
   PRIMARY KEY (`codeMappingId`),
     UNIQUE KEY (`codeMappingName`)

) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;









