DROP TABLE IF EXISTS `characters`;

CREATE TABLE `characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `homeworld` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`homeworld`) REFERENCES `planets` (`id`))
ENGINE=INNODB
DROP TABLE IF EXISTS `planets`;

CREATE TABLE `planets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `ships`;

CREATE TABLE `ships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `skills`;

CREATE TABLE `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

CREATE TABLE `stationed` (
	`cid` INT NOT NULL,
	`sid` INT NOT NULL,
	PRIMARY KEY (`cid`, `sid`),
	FOREIGN KEY (`cid`) REFERENCES characters (`id`) ON DELETE CASCADE,
	FOREIGN KEY (`sid`) REFERENCES ships (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE `reports` (
	`sub_id` INT NOT NULL,
	`o_id` INT NOT NULL,
	PRIMARY KEY (`sub_id`, `o_id`),
	FOREIGN KEY (`sub_id`) REFERENCES characters (`id`) ON DELETE CASCADE,
	FOREIGN KEY (`o_id`) REFERENCES characters (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE `stskills` (
	`char_id` INT NOT NULL,
	`skill_id` INT NOT NULL,
	PRIMARY KEY (`char_id`, `skill_id`),
	FOREIGN KEY (`char_id`) REFERENCES characters (`id`) ON DELETE CASCADE,
	FOREIGN KEY (`skill_id`) REFERENCES skills (`id`) ON DELETE CASCADE
) ENGINE = InnoDB;