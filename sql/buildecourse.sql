SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- TODO make sequencer

-- TODO check if db exists - if yes, make a dump/rename and delete it 
DROP DATABASE IF EXISTS ecourse;

CREATE DATABASE ecourse;

USE ecourse;

-- No need to drop tables as db was droped
-- DROP TABLE IF EXISTS `course`;
-- DROP TABLE IF EXISTS `user`;

CREATE TABLE IF NOT EXISTS `user` (
`userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) COLLATE utf8_bin NOT NULL,
  `userMail` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
      `language` varchar(8) COLLATE utf8_bin NOT NULL,
        PRIMARY KEY (`userId`),
  UNIQUE KEY `userName` (`userName`),
  UNIQUE KEY `userMail` (`userMail`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `user` (`userId`, `userName`, `userMail`, `password`, `language`) values
(0, 'admin', 'admin@localhost', 'root', 'CH_de');


CREATE TABLE IF NOT EXISTS `course` (
`courseId` int(11) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(255) NOT NULL,
  `ownerUserId` int(11) NOT NULL,
  `dbScheme` varchar(255) COLLATE utf8_bin  NULL, -- TODO should not be nullable, only for testing
    -- start date
  -- end date
          PRIMARY KEY (`courseId`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


ALTER TABLE course ADD CONSTRAINT fk_user_id FOREIGN KEY (ownerUserId) REFERENCES user(userId);

-- USER

-- TODO intersection table which user is in which course


-- DELETE FROM mysql.user WHERE User = 'ecourse';

drop user ecourse@localhost;

flush privileges;

CREATE USER ecourse@localhost IDENTIFIED BY  '123456';

GRANT SELECT ON ecourse.* TO ecourse@localhost;
GRANT INSERT ON ecourse.* TO ecourse@localhost;
GRANT DELETE ON ecourse.* TO ecourse@localhost;
GRANT UPDATE ON ecourse.* TO ecourse@localhost;

-- TODO maybe move courses to other db such that create and drop would not be done on ecourse db level
-- GRANT DROP ON ecourse.* TO 'ecourse'@'localhost';
-- GRANT CREATE ON ecourse.* TO 'ecourse'@'localhost';