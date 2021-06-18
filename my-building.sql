-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: my-building
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Database: `chenil`
--
CREATE DATABASE IF NOT EXISTS `my-building` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `my-building`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `idAddress` int(11) NOT NULL AUTO_INCREMENT,
  `street` varchar(100) DEFAULT NULL,
  `house_number` varchar(100) DEFAULT NULL,
  `box_number` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idAddress`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'Rue du Syndicat Emile','77','17B','1301','Bierges','Belgique'),(2,'Rue du Syndicat Benoit','88','45C','1301','Chaumont-Gistoux','Belgique'),(3,'Rue Cour Building A','18',NULL,'1301','Rixensart','Belgique'),(4,'Rue Avenue Building B','59',NULL,'1302','Mont-Saint-Guibert','France'),(5,'Place du Building C','18',NULL,'1304','Bruxelles','Espagne'),(6,'Chauss├®e du Building D','18',NULL,'1306','Ottignies','Colombie'),(7,'zert','12','12','12345','zerzer','zer'),(8,'zert','12','12','12345','zerzer','zer'),(9,'zert','12','12','12345','zerzer','zer'),(10,'zert','12','12','12345','zerzer','zer'),(11,'zert','12','12','12345','zerzer','zer'),(12,'zert','12','12','12345','zerzer','zer'),(13,'zet','123','12','12345','zrt','ert'),(14,'sdf','sdf','sdf','sdf','sdf','sdf'),(15,'sdf','sdf','sdf','sdf','sdf','sdf'),(16,'ma rue','mon num','ma bnoite','12345','villema','monpays'),(17,'zertzer','zer','zer','1354','zer','zer');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apartment`
--

DROP TABLE IF EXISTS `apartment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apartment` (
  `idApartment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `fkBuilding` int(11) DEFAULT NULL,
  `fkOwner` int(11) DEFAULT NULL,
  `fkTenant` int(11) DEFAULT NULL,
  PRIMARY KEY (`idApartment`),
  UNIQUE KEY `apartment_un` (`fkTenant`),
  KEY `apartment_FK` (`fkBuilding`),
  KEY `apartment_FK_1` (`fkOwner`),
  KEY `apartment_FK_2` (`fkTenant`),
  CONSTRAINT `apartment_FK` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apartment_FK_1` FOREIGN KEY (`fkOwner`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apartment_FK_2` FOREIGN KEY (`fkTenant`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apartment`
--

LOCK TABLES `apartment` WRITE;
/*!40000 ALTER TABLE `apartment` DISABLE KEYS */;
INSERT INTO `apartment` VALUES (1,'Apartement A1',1,NULL,NULL),(2,'Apartement A2',1,NULL,NULL),(3,'Apartement A3',1,NULL,NULL),(4,'Apartement A4',1,NULL,NULL),(5,'Apartement B1',2,NULL,NULL),(6,'Apartement B2',2,NULL,NULL),(7,'Apartement B3',2,NULL,NULL),(8,'Apartement C1',3,NULL,NULL),(9,'Apartement C2',3,NULL,NULL),(10,'Apartement C3',3,NULL,NULL),(11,'Apartement D1',4,NULL,NULL),(12,'Apartement D2',4,NULL,NULL),(13,'Apartement D3',4,NULL,NULL),(14,'appart',1,NULL,NULL),(15,'app 01',5,NULL,NULL),(16,'monapart123',2,NULL,NULL),(17,'monapart123',2,NULL,NULL);
/*!40000 ALTER TABLE `apartment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `building` (
  `idBuilding` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `fkAddress` int(11) DEFAULT NULL,
  PRIMARY KEY (`idBuilding`),
  KEY `building_FK` (`fkAddress`),
  CONSTRAINT `building_FK` FOREIGN KEY (`fkAddress`) REFERENCES `address` (`idAddress`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `building`
--

LOCK TABLES `building` WRITE;
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
INSERT INTO `building` VALUES (1,'Building A',3),(2,'Building B',4),(3,'Building C',5),(4,'Building D',6),(5,'immeuble 5',NULL),(6,'immeuble 56',7),(7,'immeuble 56',8),(8,'immeuble 56',9),(9,'immeuble 56',10),(10,'immeuble 56',11),(11,'immeuble 56',12),(12,'im69',13),(13,'sdf',14),(14,'sdf',15);
/*!40000 ALTER TABLE `building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `communication`
--

DROP TABLE IF EXISTS `communication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `communication` (
  `idCommunication` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `fkBuilding` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCommunication`),
  KEY `communication_FK` (`fkBuilding`),
  CONSTRAINT `communication_FK_1` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication`
--

LOCK TABLES `communication` WRITE;
/*!40000 ALTER TABLE `communication` DISABLE KEYS */;
INSERT INTO `communication` VALUES (1,'Sujet Building A','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',1),(2,'Sujet Building A','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-17 00:00:00','2021-05-17 00:00:00',1),(3,'Sujet Building B','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-13 00:00:00','2021-05-13 00:00:00',2),(4,'Sujet Building C','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-05 00:00:00','2021-05-05 00:00:00',3),(5,'Sujet Building D','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-07 00:00:00','2021-05-07 00:00:00',4),(6,'Sujet Building D','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-01 00:00:00','2021-05-01 00:00:00',4),(7,'Sujet Building D','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-04-24 00:00:00','2021-05-10 00:00:00',4),(8,'Sujet Building ABIS','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-11-24 00:00:00','2021-05-10 00:00:00',1),(9,'Sujet Building ABIS','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-12-24 00:00:00','2021-05-10 00:00:00',1),(10,'Sujet Building ABIS','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-03-24 00:00:00','2021-05-05 00:00:00',1),(11,'nex com','sqfdsfsd','2021-06-15 10:49:12','2021-06-15 10:49:12',5);
/*!40000 ALTER TABLE `communication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `idRequest` int(11) NOT NULL AUTO_INCREMENT,
  `isOwnerRequest` varchar(1) DEFAULT NULL,
  `fkApartment` int(11) DEFAULT NULL,
  `fkUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idRequest`),
  KEY `request_FK` (`fkUser`),
  KEY `request_FK_1` (`fkApartment`),
  CONSTRAINT `request_FK` FOREIGN KEY (`fkUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `request_FK_1` FOREIGN KEY (`fkApartment`) REFERENCES `apartment` (`idApartment`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (1,'0',15,14),(2,'1',15,15);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `fkUser` int(11) NOT NULL,
  `fkBuilding` int(11) NOT NULL,
  PRIMARY KEY (`idTicket`),
  KEY `ticket_FK` (`fkBuilding`),
  KEY `ticket_FK_1` (`fkUser`),
  CONSTRAINT `ticket_FK` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_FK_1` FOREIGN KEY (`fkUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (1,'Ticket Building A','1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-06-15 10:32:17',3,1),(2,'Ticket Building A','En attente','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',3,1),(3,'Ticket Building B','Non trait├®','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',4,2),(4,'Ticket Building C','En attente','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',5,3),(5,'Ticket Building D','Non trait├®','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',6,4),(6,'Ticket Building E','En attente','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',7,4),(7,'Ticket Building F','En attente','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',8,4),(8,'Ticket Building A','Non trait├®','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',7,1),(9,'Ticket Building A','Traité','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-05-24 00:00:00',6,1),(10,'Ticket Building A','En attente','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-05-24 00:00:00','2021-06-15 10:48:30',5,1),(11,'test user qssdsd','Traité','test descripqsdqsdqdsd','2021-06-16 19:19:10','2021-06-16 19:20:28',14,5);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `session_token` varchar(100) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) DEFAULT NULL,
  `fkAddress` int(11) DEFAULT NULL,
  `fkBuilding` int(11) DEFAULT NULL,
  `fkApartment` int(11) DEFAULT NULL,
  `isActive` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `user_un` (`email`),
  KEY `user_FK` (`fkAddress`),
  KEY `user_FK_1` (`fkApartment`),
  KEY `user_FK_2` (`fkBuilding`),
  CONSTRAINT `user_FK` FOREIGN KEY (`fkAddress`) REFERENCES `address` (`idAddress`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_FK_1` FOREIGN KEY (`fkApartment`) REFERENCES `apartment` (`idApartment`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_FK_2` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user`
VALUES (1,'Emile','Cyimena','cyimena09@hotmail.com','0484090853','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','SYNDIC',1,NULL, NULL, 1),
(2,'Benoit','Vankoningsloo','benoit@hotmail.com','0477213465','F','ce16833c6d23fc9e.1623871238','2021-06-16 21:20:38','$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','SYNDIC',2,1,1,NULL),
(3,'Amaury','Cyemezo','cyemezo@hotmail.com','0499591245','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,1,1,NULL),(4,'Alice','Malaika','malaika@hotmail.com','0476134465','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,1,1,NULL),
(5,'Mike','Francois','mike@hotmail.com','0488124678','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,1,2,NULL),
(6,'Susi','Toupe','stoupe0@symantec.com','6685851293','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,1,2,NULL),(7,'Eveline','Joyner','ejoyner1@cloudflare.com','7861614104','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,1,2,NULL),
(8,'Eba','Penquet','epenquet2@walmart.com','7779636737','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,1,3,NULL),(9,'Justina','Dearth','jdearth3@hc360.com','5481337107','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,1,4,NULL),(10,'Venus','Tolwood','vtolwood4@w3.org','2896359988','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,2,5,NULL),(11,'Napoleon','Jencey','njencey5@csmonitor.com','5625961927','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,2,6,NULL),(12,'Kain','Wrist','kwrist6@mayoclinic.com','5729661592','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,2,7,NULL),(13,'Vernor','Titchen','vtitchen7@moonfruit.com','2342462343','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2','LOCATAIRE',NULL,3,8,NULL),(14,'monp','monn','qs@qs.qs','13564','O','198d5dba65a75af0.1623871127','2021-06-16 21:18:47','$2y$10$M18gDHwFI1tY8tIk2LD3d.yHmTAFTr3s0v4VyQjYe9.T0yd.MMilO','LOCATAIRE',16,NULL,NULL,'0'),(15,'zer','zer','zer@zer.zer','123456','F','225bb33603812a5d.1623870194','2021-06-16 21:03:14','$2y$10$pJK4SZ6I2Z7CHshfQPOgiuaJiDM.uNDsd2voZ1f6hQXF8o2FaRQ/m','PROPRIETAIRE',17,NULL,NULL,'0');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'my-building'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-16 22:58:58
