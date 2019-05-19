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
DROP TABLE IF EXISTS `component`;
CREATE TABLE IF NOT EXISTS `component` (
  `componentid` int(11) NOT NULL AUTO_INCREMENT,
  `componentdescriptionid` int(11) NOT NULL,
  `componentvalueid` int(11) NOT NULL,
  PRIMARY KEY (`componentid`),
  KEY `fk_component_componentvalue1_idx` (`componentvalueid`),
  KEY `fk_component_componentdescription1_idx` (`componentdescriptionid`),
  CONSTRAINT `fk_component_componentdescription1` FOREIGN KEY (`componentdescriptionid`) REFERENCES `componentdescription` (`componentdescriptionid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_component_componentvalue1` FOREIGN KEY (`componentvalueid`) REFERENCES `componentvalue` (`componentvalueid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.component: ~7 rows (ungefähr)
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` (`componentid`, `componentdescriptionid`, `componentvalueid`) VALUES
	(1, 1, 1),
	(2, 29, 4),
	(3, 2, 2),
	(12, 3, 3),
	(13, 29, 29),
	(14, 1, 30);
/*!40000 ALTER TABLE `component` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.componentdescription
DROP TABLE IF EXISTS `componentdescription`;
CREATE TABLE IF NOT EXISTS `componentdescription` (
  `componentdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`componentdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.componentdescription: ~17 rows (ungefähr)
/*!40000 ALTER TABLE `componentdescription` DISABLE KEYS */;
INSERT INTO `componentdescription` (`componentdescriptionid`, `description`) VALUES
	(29, 'Auflösung'),
	(3, 'Helligkeit'),
	(1, 'Hersteller'),
	(2, 'Seriennummer');
/*!40000 ALTER TABLE `componentdescription` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.componentvalue
DROP TABLE IF EXISTS `componentvalue`;
CREATE TABLE IF NOT EXISTS `componentvalue` (
  `componentvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`componentvalueid`),
  UNIQUE KEY `value_UNIQUE` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.componentvalue: ~13 rows (ungefähr)
/*!40000 ALTER TABLE `componentvalue` DISABLE KEYS */;
INSERT INTO `componentvalue` (`componentvalueid`, `value`) VALUES
	(4, '1280 x 800 px'),
	(3, '3300 lm'),
	(29, '4K'),
	(1, 'Epson'),
	(30, 'Samsung'),
	(2, 'SN34567809');
/*!40000 ALTER TABLE `componentvalue` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.object
DROP TABLE IF EXISTS `object`;
CREATE TABLE IF NOT EXISTS `object` (
  `objectid` int(11) NOT NULL AUTO_INCREMENT,
  `objectdescriptionid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  PRIMARY KEY (`objectid`),
  KEY `fk_object_room_idx` (`roomid`),
  KEY `fk_object_objectdescription1_idx` (`objectdescriptionid`),
  CONSTRAINT `fk_object_objectdescription1` FOREIGN KEY (`objectdescriptionid`) REFERENCES `objectdescription` (`objectdescriptionid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_object_room` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.object: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` (`objectid`, `objectdescriptionid`, `roomid`) VALUES
	(1, 1, 1),
	(5, 8, 7),
	(7, 9, 8),
	(8, 1, 1);
/*!40000 ALTER TABLE `object` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.objectcomponentassign
DROP TABLE IF EXISTS `objectcomponentassign`;
CREATE TABLE IF NOT EXISTS `objectcomponentassign` (
  `objectid` int(11) NOT NULL,
  `componentid` int(11) NOT NULL,
  PRIMARY KEY (`objectid`,`componentid`),
  KEY `fk_objectcomponentassign_object1_idx` (`objectid`),
  KEY `fk_objectcomponentassign_component1_idx` (`componentid`),
  CONSTRAINT `fk_objectcomponentassign_component1` FOREIGN KEY (`componentid`) REFERENCES `component` (`componentid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_objectcomponentassign_object1` FOREIGN KEY (`objectid`) REFERENCES `object` (`objectid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.objectcomponentassign: ~5 rows (ungefähr)
/*!40000 ALTER TABLE `objectcomponentassign` DISABLE KEYS */;
INSERT INTO `objectcomponentassign` (`objectid`, `componentid`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 12),
	(5, 13),
	(5, 14),
	(7, 13),
	(7, 14),
	(8, 2),
	(8, 14);
/*!40000 ALTER TABLE `objectcomponentassign` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.objectdescription
DROP TABLE IF EXISTS `objectdescription`;
CREATE TABLE IF NOT EXISTS `objectdescription` (
  `objectdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`objectdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.objectdescription: ~6 rows (ungefähr)
/*!40000 ALTER TABLE `objectdescription` DISABLE KEYS */;
INSERT INTO `objectdescription` (`objectdescriptionid`, `description`) VALUES
	(1, 'Beamer'),
	(8, 'Fernseher'),
	(9, 'Monitor');
/*!40000 ALTER TABLE `objectdescription` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.room
DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `roomid` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(25) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.room: ~2 rows (ungefähr)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`roomid`, `number`, `description`) VALUES
	(1, 'Lager', 'default'),
	(7, 'A200', 'Lehrerzimmer'),
	(8, 'A100', 'Sekretariat');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle project.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Exportiere Daten aus Tabelle project.user: ~4 rows (ungefähr)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userid`, `name`, `firstname`, `email`, `password`, `admin`) VALUES
	(1, 'Admin', 'Admin', 'admin@admin.ch', '0192023a7bbd73250516f069df18b500', 1),
	(4, 'User', 'User', 'user@user.ch', '6ad14ba9986e3615423dfca256d04e3f', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
