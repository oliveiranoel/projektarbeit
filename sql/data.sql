-- MySQL dump 10.16  Distrib 10.1.33-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: project
-- ------------------------------------------------------
-- Server version	10.1.33-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `component`
--

DROP TABLE IF EXISTS `component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `component` (
  `componentid` int(11) NOT NULL AUTO_INCREMENT,
  `componentdescriptionid` int(11) NOT NULL,
  `componentvalueid` int(11) NOT NULL,
  PRIMARY KEY (`componentid`),
  KEY `fk_component_componentvalue1_idx` (`componentvalueid`),
  KEY `fk_component_componentdescription1_idx` (`componentdescriptionid`),
  CONSTRAINT `fk_component_componentdescription1` FOREIGN KEY (`componentdescriptionid`) REFERENCES `componentdescription` (`componentdescriptionid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_component_componentvalue1` FOREIGN KEY (`componentvalueid`) REFERENCES `componentvalue` (`componentvalueid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `component`
--

LOCK TABLES `component` WRITE;
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` VALUES (1,1,1),(2,4,4),(3,2,2),(4,3,3);
/*!40000 ALTER TABLE `component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `componentdescription`
--

DROP TABLE IF EXISTS `componentdescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `componentdescription` (
  `componentdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`componentdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `componentdescription`
--

LOCK TABLES `componentdescription` WRITE;
/*!40000 ALTER TABLE `componentdescription` DISABLE KEYS */;
INSERT INTO `componentdescription` VALUES (4,'Aufl?sung'),(21,'CPU'),(3,'Helligkeit'),(1,'Hersteller'),(23,'Junge'),(22,'Lüfter'),(2,'Seriennummer');
/*!40000 ALTER TABLE `componentdescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `componentvalue`
--

DROP TABLE IF EXISTS `componentvalue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `componentvalue` (
  `componentvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`componentvalueid`),
  UNIQUE KEY `value_UNIQUE` (`value`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `componentvalue`
--

LOCK TABLES `componentvalue` WRITE;
/*!40000 ALTER TABLE `componentvalue` DISABLE KEYS */;
INSERT INTO `componentvalue` VALUES (4,'1280 x 800 px'),(3,'3300 lm'),(20,'asd'),(1,'Epson'),(19,'i5600K'),(5,'Lenovo'),(2,'SN34567809'),(21,'test');
/*!40000 ALTER TABLE `componentvalue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `object`
--

DROP TABLE IF EXISTS `object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `object` (
  `objectid` int(11) NOT NULL AUTO_INCREMENT,
  `objectdescriptionid` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  PRIMARY KEY (`objectid`),
  KEY `fk_object_room_idx` (`roomid`),
  KEY `fk_object_objectdescription1_idx` (`objectdescriptionid`),
  CONSTRAINT `fk_object_objectdescription1` FOREIGN KEY (`objectdescriptionid`) REFERENCES `objectdescription` (`objectdescriptionid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_object_room` FOREIGN KEY (`roomid`) REFERENCES `room` (`roomid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `object`
--

LOCK TABLES `object` WRITE;
/*!40000 ALTER TABLE `object` DISABLE KEYS */;
INSERT INTO `object` VALUES (1,1,1);
/*!40000 ALTER TABLE `object` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objectcomponentassign`
--

DROP TABLE IF EXISTS `objectcomponentassign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objectcomponentassign` (
  `objectid` int(11) NOT NULL,
  `componentid` int(11) NOT NULL,
  PRIMARY KEY (`objectid`,`componentid`),
  KEY `fk_objectcomponentassign_object1_idx` (`objectid`),
  KEY `fk_objectcomponentassign_component1_idx` (`componentid`),
  CONSTRAINT `fk_objectcomponentassign_component1` FOREIGN KEY (`componentid`) REFERENCES `component` (`componentid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_objectcomponentassign_object1` FOREIGN KEY (`objectid`) REFERENCES `object` (`objectid`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objectcomponentassign`
--

LOCK TABLES `objectcomponentassign` WRITE;
/*!40000 ALTER TABLE `objectcomponentassign` DISABLE KEYS */;
INSERT INTO `objectcomponentassign` VALUES (1,1),(1,2),(1,3),(1,4);
/*!40000 ALTER TABLE `objectcomponentassign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objectdescription`
--

DROP TABLE IF EXISTS `objectdescription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objectdescription` (
  `objectdescriptionid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`objectdescriptionid`),
  UNIQUE KEY `description_UNIQUE` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objectdescription`
--

LOCK TABLES `objectdescription` WRITE;
/*!40000 ALTER TABLE `objectdescription` DISABLE KEYS */;
INSERT INTO `objectdescription` VALUES (1,'Beamer');
/*!40000 ALTER TABLE `objectdescription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `roomid` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(25) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` VALUES (1,'F100','Laden'),(2,'A777','Lehrerzimmer');
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(65) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Master','Admin','nexu@mailinator.net','39aac1655d662fcee21cff3fda9ff410',0),(4,'Muster','Max','max.muster@domain.ch','11c9efa639a13c650cc4ccf081500383',0),(9,'Suter','Dominik','dominik.suter@bbzsogr.ch','11c9efa639a13c650cc4ccf081500383',1),(12,'Oliveira','Noel','noel.oliveira@bbzsogr.ch','cc03e747a6afbbcbf8be7668acfebee5',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-15 10:54:19
