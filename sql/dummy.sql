-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.3.7-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Exportiere Datenbank Struktur für project
CREATE DATABASE IF NOT EXISTS `project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `project`;

-- Exportiere Struktur von Tabelle project.component
CREATE TABLE IF NOT EXISTS `component` (
  `componentid` int(11) NOT NULL AUTO_INCREMENT,
  `componentdescriptionid` int(11) NOT NULL,
  `componentvalueid` int(11) NOT NULL,
  PRIMARY KEY (`componentid`),
  KEY `fk_component_componentvalue1_idx` (`componentvalueid`),
  KEY `fk_component_componentdescription1_idx` (`componentdescriptionid`),
  CONSTRAINT `fk_component_componentdescription1` FOREIGN KEY (`componentdescriptionid`) REFERENCES `componentdescription` (`componentdescriptionid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_component_componentvalue1` FOREIGN KEY (`componentvalueid`) REFERENCES `componentvalue` (`componentvalueid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.component: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` (`componentid`, `componentdescriptionid`, `componentvalueid`) VALUES
	(1, 1, 1),
	(2, 4, 4),
	(3, 2, 2),
	(4, 3, 3);
/*!40000 ALTER TABLE `component` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.componentdescription
CREATE TABLE IF NOT EXISTS `componentdescription` (
  `componentdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`componentdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.componentdescription: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `componentdescription` DISABLE KEYS */;
INSERT INTO `componentdescription` (`componentdescriptionid`, `description`) VALUES
	(4, 'Auflösung'),
	(3, 'Helligkeit'),
	(1, 'Hersteller'),
	(2, 'Seriennummer');
/*!40000 ALTER TABLE `componentdescription` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.componentvalue
CREATE TABLE IF NOT EXISTS `componentvalue` (
  `componentvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`componentvalueid`),
  UNIQUE KEY `value_UNIQUE` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.componentvalue: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `componentvalue` DISABLE KEYS */;
INSERT INTO `componentvalue` (`componentvalueid`, `value`) VALUES
	(4, '1280 x 800 px'),
	(3, '3300 lm'),
	(1, 'Epson'),
	(2, 'SN34567809');
/*!40000 ALTER TABLE `componentvalue` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.object
CREATE TABLE IF NOT EXISTS `object` (
  `objectid` int(11) NOT NULL AUTO_INCREMENT,
  `objectdescriptionid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  PRIMARY KEY (`objectid`),
  KEY `fk_object_room_idx` (`roomid`),
  KEY `fk_object_objectdescription1_idx` (`objectdescriptionid`),
  CONSTRAINT `fk_object_objectdescription1` FOREIGN KEY (`objectdescriptionid`) REFERENCES `objectdescription` (`objectdescriptionid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_object_room` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.object: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` (`objectid`, `objectdescriptionid`, `roomid`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `object` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.objectcomponentassign
CREATE TABLE IF NOT EXISTS `objectcomponentassign` (
  `objectid` int(11) NOT NULL,
  `componentid` int(11) NOT NULL,
  PRIMARY KEY (`objectid`,`componentid`),
  KEY `fk_objectcomponentassign_object1_idx` (`objectid`),
  KEY `fk_objectcomponentassign_component1_idx` (`componentid`),
  CONSTRAINT `fk_objectcomponentassign_component1` FOREIGN KEY (`componentid`) REFERENCES `component` (`componentid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_objectcomponentassign_object1` FOREIGN KEY (`objectid`) REFERENCES `object` (`objectid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.objectcomponentassign: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `objectcomponentassign` DISABLE KEYS */;
INSERT INTO `objectcomponentassign` (`objectid`, `componentid`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4);
/*!40000 ALTER TABLE `objectcomponentassign` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.objectdescription
CREATE TABLE IF NOT EXISTS `objectdescription` (
  `objectdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`objectdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.objectdescription: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `objectdescription` DISABLE KEYS */;
INSERT INTO `objectdescription` (`objectdescriptionid`, `description`) VALUES
	(1, 'Beamer');
/*!40000 ALTER TABLE `objectdescription` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.room
CREATE TABLE IF NOT EXISTS `room` (
  `roomid` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(25) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.room: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`roomid`, `number`, `description`) VALUES
	(1, 'F100', 'Laden');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.user
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `email` varchar(65) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.user: ~1 rows (ungefähr)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userid`, `name`, `firstname`, `email`, `password`) VALUES
	(1, 'Testkovski', 'Povli', 'povli.testkovski@testdomain.ch', 'test05');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
