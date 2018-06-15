SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- TODO check if db exists - if yes, make a dump/rename and delete it
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `course`;

CREATE TABLE IF NOT EXISTS `user` (
`userId` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8_bin NOT NULL,
  `userMail` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
      `language` varchar(8) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userId`);

INSERT INTO `user` (`userId`, `userName`, `userMail`, `password`, `language`) values
(0, 'admin', 'admin@localhost', 'root', 'CH_de');


CREATE TABLE IF NOT EXISTS `course` (
`courseId` int(11) NOT NULL,
  `courseName` int(11) NOT NULL,
  `dbScheme` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



