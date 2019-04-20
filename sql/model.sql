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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle project.componentdescription
CREATE TABLE IF NOT EXISTS `componentdescription` (
  `componentdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`componentdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle project.componentvalue
CREATE TABLE IF NOT EXISTS `componentvalue` (
  `componentvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`componentvalueid`),
  UNIQUE KEY `value_UNIQUE` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
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

-- Daten Export vom Benutzer nicht ausgewählt
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

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle project.objectdescription
CREATE TABLE IF NOT EXISTS `objectdescription` (
  `objectdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`objectdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle project.room
CREATE TABLE IF NOT EXISTS `room` (
  `roomid` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(25) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
-- Exportiere Struktur von Tabelle project.user
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Daten Export vom Benutzer nicht ausgewählt
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
