SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- current design: all in one db but with courseId as table and key prefix
-- this is done with a regex of **********

use ecourse;

DROP TABLE IF EXISTS `**********_obs_obsTag`;
DROP TABLE IF EXISTS `**********_part_partTag`;
DROP TABLE IF EXISTS `**********_leader_partTag`;
DROP TABLE IF EXISTS `**********_observation`;
DROP TABLE IF EXISTS `**********_participant`;
DROP TABLE IF EXISTS `**********_participantTag`;
DROP TABLE IF EXISTS `**********_observationTag`;
DROP TABLE IF EXISTS `**********_activity`;
DROP TABLE IF EXISTS `**********_codeMapping`;
DROP TABLE IF EXISTS `**********_leader`;


CREATE TABLE IF NOT EXISTS `**********_leader` (
`leaderId` int(11) NOT NULL AUTO_INCREMENT,
`userId` int(11)  NULL,
  `leaderName` varchar(255) COLLATE utf8_bin NOT NULL,
    `leaderSurname` varchar(255) COLLATE utf8_bin NOT NULL,
    `leaderScoutname` varchar(255) COLLATE utf8_bin NOT NULL,
     PRIMARY KEY (`leaderId`),
     UNIQUE KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- TODO might not work accross db's
ALTER TABLE **********_leader ADD CONSTRAINT **********_fk2_user_id FOREIGN KEY (userId) REFERENCES **********_user(userId);



CREATE TABLE IF NOT EXISTS `**********_participant` (
`participantId` int(11) NOT NULL AUTO_INCREMENT,
  `participantName` varchar(255) COLLATE utf8_bin NOT NULL,
    `participantSurname` varchar(255) COLLATE utf8_bin NOT NULL,
    `participantScoutname` varchar(255) COLLATE utf8_bin NOT NULL,
-- age
-- Unit
-- Group
-- information from Recommender
     PRIMARY KEY (`participantId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- TODO maybe needs to be linked to observation /activity for purpose of observation requests
CREATE TABLE IF NOT EXISTS `**********_participantTag` (
`participantTagId` int(11) NOT NULL AUTO_INCREMENT,
`parentParticipantTagId` int(11) NULL,
  `participantTagName` varchar(255) COLLATE utf8_bin NOT NULL,
       PRIMARY KEY (`participantTagId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE **********_participantTag ADD CONSTRAINT **********_fk_parentParticipantTagId FOREIGN KEY (parentParticipantTagId) REFERENCES **********_participantTag(participantTagId);

CREATE TABLE IF NOT EXISTS `**********_leader_partTag` (
`leaderId` int(11) NOT NULL,
`participantTagId` int(11) NOT NULL,
     UNIQUE KEY (`leaderId`,`participantTagId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE **********_leader_partTag ADD CONSTRAINT **********_fk_participantTagId_2 FOREIGN KEY (participantTagId) REFERENCES **********_participantTag(participantTagId);

ALTER TABLE **********_leader_partTag ADD CONSTRAINT **********_fk_leaderId FOREIGN KEY (leaderId) REFERENCES **********_leader(leaderId);




CREATE TABLE IF NOT EXISTS `**********_part_partTag` (
`participantId` int(11) NOT NULL,
`participantTagId` int(11) NOT NULL,
     UNIQUE KEY (`participantId`,`participantTagId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE **********_part_partTag ADD CONSTRAINT **********_fk_participantTagId FOREIGN KEY (participantTagId) REFERENCES **********_participantTag(participantTagId);

ALTER TABLE **********_part_partTag ADD CONSTRAINT **********_fk_participantId FOREIGN KEY (participantId) REFERENCES **********_participant(participantId);


CREATE TABLE IF NOT EXISTS `**********_activity` (
`activityId` int(11) NOT NULL AUTO_INCREMENT,
  `activityName` varchar(255) COLLATE utf8_bin NOT NULL,
  `activityNumber` varchar(255) COLLATE utf8_bin NOT NULL,
  `activityDate` DATETIME NOT NULL,
       PRIMARY KEY (`activityId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




CREATE TABLE IF NOT EXISTS `**********_observation` (
`observationId` int(11) NOT NULL AUTO_INCREMENT,
  `observationText` varchar(4096) COLLATE utf8_bin NOT NULL,
  `activityId` int(11)  NULL,
  `observationDate` DATETIME NULL,
  `leaderId` int(11) NOT NULL,
  `participantId` int(11) NOT NULL,
       PRIMARY KEY (`observationId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE **********_observation ADD CONSTRAINT **********_fk_activity_id FOREIGN KEY (activityId) REFERENCES **********_activity(activityId);

-- TODO check might be 1..n - 0..n
ALTER TABLE **********_observation ADD CONSTRAINT **********_fk_leader_id FOREIGN KEY (leaderId) REFERENCES **********_leader(leaderId);

-- TODO check might be 1..n - 0..n
ALTER TABLE **********_observation ADD CONSTRAINT **********_fk_participant_id FOREIGN KEY (participantId) REFERENCES **********_participant(participantId);

-- TODO discuss about group observation

CREATE TABLE IF NOT EXISTS `**********_observationTag` (
`observationTagId` int(11) NOT NULL AUTO_INCREMENT,
`parentObservationTagId` int(11) NULL,
  `observationTagName` int(11) NOT NULL,
       PRIMARY KEY (`observationTagId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE **********_observationTag ADD CONSTRAINT **********_fk_parentObservationTagId FOREIGN KEY (parentObservationTagId) REFERENCES **********_observationTag(observationTagId);


CREATE TABLE IF NOT EXISTS `**********_obs_obsTag` (
`observationId` int(11) NOT NULL,
`observationTagId` int(11) NOT NULL,
--       PRIMARY KEY (`observationTagId`)
 UNIQUE KEY (`observationId`,observationTagId)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE **********_obs_obsTag ADD CONSTRAINT **********_fk_observationId FOREIGN KEY (observationId) REFERENCES **********_observation(observationId);

ALTER TABLE **********_obs_obsTag ADD CONSTRAINT **********_fk_observationTagId FOREIGN KEY (observationTagId) REFERENCES **********_observationTag(observationTagId);













