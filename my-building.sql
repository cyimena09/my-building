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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,'Rue du Syndicat','1',NULL,'1300','Wavre','Belgique'),(2,'rue de l\'immeuble A','A','','1000','Bruxelles','Belgique'),(3,'rue du l\'immeuble B','B','','75000','Paris','France'),(4,'Avenue de l\'immeuble C','C','','97100','Basse-Terre','Guadeloupe'),(5,'impasse de l\'imeuble D','D','','97200','Fort-de-France','Martinique'),(6,'straat bouwen  E','E','','8301','Knokke','Belgïe'),(7,'rue du locataire A1','01','','1000','Schaerbeek','Belgique'),(8,'rue du proprio A1','1','','1000','ma Ville','Belgique'),(9,'rue du prop multi','1','','7895','LaVille','Belgique'),(10,'prop','1','','1234','ma Ville','Belgique'),(11,'rue x','1','','456','Ville','Pay'),(12,'aze','1','','157','azr','ezr'),(13,'rzer','465','','126+','zer','zer'),(14,'azee','123','','123','azea','aze'),(15,'qsd','qsd','qsd','123','qsd','qsd'),(16,'rue az','132','12','1231','ma ville','Belgique'),(17,'rue sd','12','','7896','ville','Belgique'),(18,'rue fdg','132','','4563','bxl','Belgique'),(19,'sdf','13','','1234','elliv','Belgique'),(20,'fgh','456','','9874','fgh','Belgique'),(21,'sqdfq','123','','1245','sdfg','Belgique'),(22,'qsd','123','','1236','Ville','belgium'),(23,'sdf','12','','1234','Paris','Belgique');
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
  PRIMARY KEY (`idApartment`),
  KEY `apartment_FK` (`fkBuilding`),
  KEY `apartment_FK_1` (`fkOwner`),
  CONSTRAINT `apartment_FK` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `apartment_FK_1` FOREIGN KEY (`fkOwner`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apartment`
--

LOCK TABLES `apartment` WRITE;
/*!40000 ALTER TABLE `apartment` DISABLE KEYS */;
INSERT INTO `apartment` VALUES (3,'Appartement A2',1,18),(7,'Appartement B3',2,NULL),(9,'Appartement C2',3,18),(11,'Appartement D1',4,20),(12,'Appartement D2',4,NULL),(13,'Appartement D3',4,NULL),(14,'Appartement E1',5,NULL),(15,'Appartement E2',5,NULL),(16,'Appartement E3',5,NULL),(18,'Appartement E4',5,NULL),(19,'Appartement B4',2,NULL),(20,'Appartement B5',2,NULL),(21,'Appartement D4',4,NULL),(22,'Appartement D5',4,21),(23,'Appartement D6',4,NULL),(24,'Appartmeent C1',3,NULL),(25,'Appartement A1',1,17),(26,'Appartement B1',2,19);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `building`
--

LOCK TABLES `building` WRITE;
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
INSERT INTO `building` VALUES (1,'Immeuble A',2),(2,'Immeuble B',3),(3,'Immeuble C',4),(4,'Immeuble D',5),(5,'Immeuble E',6);
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
  CONSTRAINT `communication_FK` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication`
--

LOCK TABLES `communication` WRITE;
/*!40000 ALTER TABLE `communication` DISABLE KEYS */;
INSERT INTO `communication` VALUES (2,'Com 1 pour bat A de Bruxelles','Bonjour,\nVous avez un nouveau message ......','2021-06-20 17:10:50','2021-06-20 19:42:41',1),(3,'Com 1 pour bat B de Paris','Salut,\nCeci est votre message','2021-06-20 17:12:17','2021-06-20 17:13:15',2),(4,'Com 1 pour bat C','Holla,\r\nVotre message est ici','2021-06-20 17:13:49','2021-06-20 17:13:49',3),(5,'Com 1 pour immeuble D','message pour dire pas de message','2021-06-20 17:14:35','2021-06-20 17:14:46',4),(6,'Com 2 pour bat D','re, \r\nenfin un deuxième message','2021-06-20 17:15:12','2021-06-20 17:15:12',4),(7,'message pour bat E','hello','2021-06-20 17:15:54','2021-06-20 17:15:54',5);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `idRole` int(11) NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Syndic'),(2,'Locataire'),(3,'Propriétaire'),(4,'Propriétaire Résident');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL AUTO_INCREMENT,
  `statusName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idStatus`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Traité'),(2,'En Attente'),(3,'Non Traité');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
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
  `description` varchar(255) DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `fkUser` int(11) NOT NULL,
  `fkBuilding` int(11) NOT NULL,
  `fkStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTicket`),
  KEY `ticket_FK` (`fkBuilding`),
  KEY `ticket_FK_1` (`fkUser`),
  KEY `ticket_FK_2` (`fkStatus`),
  CONSTRAINT `ticket_FK_1` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`),
  CONSTRAINT `ticket_FK_2` FOREIGN KEY (`fkStatus`) REFERENCES `status` (`idStatus`),
  CONSTRAINT `ticket_FK_3` FOREIGN KEY (`fkUser`) REFERENCES `user` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (5,'ticket im C','qsd','2021-06-20 19:12:59','2021-06-20 19:12:59',1,1,2),(7,'buil 5','test ','2021-06-20 19:35:38','2021-06-20 19:35:38',1,5,1),(8,'build 4','test','2021-06-20 19:39:41','2021-06-20 19:39:41',1,1,3),(15,'test syndic','zerzerzer','2021-06-21 11:02:34','2021-06-21 11:02:34',1,1,3);
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
  `fkAddress` int(11) DEFAULT NULL,
  `fkBuilding` int(11) DEFAULT NULL,
  `fkApartment` int(11) DEFAULT NULL,
  `isActive` varchar(1) DEFAULT NULL,
  `fkRole` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `user_un` (`email`),
  KEY `user_FK` (`fkAddress`),
  KEY `user_FK_1` (`fkApartment`),
  KEY `user_FK_2` (`fkBuilding`),
  KEY `user_FK_3` (`fkRole`),
  CONSTRAINT `user_FK` FOREIGN KEY (`fkAddress`) REFERENCES `address` (`idAddress`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_FK_1` FOREIGN KEY (`fkApartment`) REFERENCES `apartment` (`idApartment`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_FK_2` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_FK_3` FOREIGN KEY (`fkRole`) REFERENCES `role` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Admin','Syndic','admin@l.com','1234567','M','64c2657b706551f2.1624289010','2021-06-21 17:23:30','$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',1,NULL,NULL,'1',1),(16,'Locataire','A1','locA1@l.com','123456798','M','256dd7b5ac303ae1.1624289104','2021-06-21 17:25:04','$2y$10$pbOc0xnCqhjN/18F3A4dGeZOuEs34wXOJqSEm06yi.SGc6cJG.EmW',16,1,25,'1',2),(17,'Propriétaire','A1','propA1@l.com','123456','M',NULL,NULL,'$2y$10$AWT9Yd50gQ6MtUm0fpyD8OkIrqSOmey9r4Kuf/jdNzg5TWM5XkRvi',17,NULL,NULL,'1',3),(18,'multi proprio','A2 &amp; C2','prop02@l.com','1234567','M',NULL,NULL,'$2y$10$rB2uiNWITa4s3bGJnkf/8O8WlTMGzLtXUm/7TZ8fWiBmuHAHaZIFe',18,NULL,NULL,'1',3),(19,'Proprio','B1','propB1@l.com','123456','O',NULL,NULL,'$2y$10$t0P/y89NZqYu6RPNhlpTtey3B9FhgcEcMUwR5a7zMicOWO4sLD0t.',19,NULL,NULL,'1',3),(20,'Pro &amp; Résident meme appart','D1','propD1@l.com','123456','M',NULL,NULL,'$2y$10$RHfGZEoXHyfPltROoJ.8nuULVPe7bSsmJMc6G9ABdAUoohHqsT54m',20,4,11,'1',4),(21,'Pro &amp; Rés différent appart	','P=D5 R=C1	','propC1@l.com','123456','F',NULL,NULL,'$2y$10$UL6PFu.rfmg0OO.7qHVUEO9TXWCtAyjivB6fZF.yknRhpXQnQFDB.',21,3,24,'1',4),(22,'Rés avec prop	','C1','locD1@l.com','123456','F',NULL,NULL,'$2y$10$XWh1amnGU.stYG7MLv/aheH..NcCMZOSO3gBTmT3wQtnQ.1q1p.NG',22,4,11,'1',4),(23,'Rés solo','E2','resE2@l.com','123465','O',NULL,NULL,'$2y$10$EYFsrXYl.rhzikLiehGEouHLyq3Mj2.QZ.tNksWS3GLkyTsQHTJpW',23,5,15,'1',4);
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

-- Dump completed on 2021-06-21 17:25:49
