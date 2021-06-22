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
INSERT INTO `address` VALUES (1,'Rue du Syndicat Emile','77','17B','1301','Bierges','Belgique'),(2,'Rue du Benoit','88','45C','1301','Chaumont-Gistoux','Angleterre'),(3,'Rue de la place Amaury','18',NULL,'1301','Rixensart','Rwanda'),(4,'Rue de la place Alice','59',NULL,'1302','Mont-Saint-Guibert','Espagne'),(5,'Rue de la place Mike','18',NULL,'1304','Bruxelles','Espagne'),(6,'Rue de la place Susi','18',NULL,'1306','Ottignies','Etat-unis'),(7,'Rue de la place Eveline','77','17B','1301','Bierges','Canada'),(8,'Rue de la place Eba','88','45C','1301','Chaumont-Gistoux','Belgique'),(9,'Rue de la place Justina','18',NULL,'1301','Rixensart','Belgique'),(10,'Rue de la place Venus','59',NULL,'1302','Mont-Saint-Guibert','France'),(11,'Rue de la place Napoleon','18',NULL,'1304','Bruxelles','Espagne'),(12,'Rue de la place Kain','18',NULL,'1306','Ottignies','Colombie'),(13,'Rue de la place Vernor','18',NULL,'1306','Ottignies','Colombie'),(14,'Rue de la résidence A','77',NULL,'1301','Bierges','Canada'),(15,'Rue de la résidence B','88',NULL,'1301','Chaumont-Gistoux','Pays-Bas'),(16,'Rue de la résidence C','18',NULL,'1301','Rixensart','Belgique'),(17,'Rue de la résidence D','59',NULL,'1302','Mont-Saint-Guibert','France'),(18,'Rue du professeur Benoit Delbar','59','B','1302','Wavre','Belgique');
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
INSERT INTO `apartment` VALUES (1,'Apartement A1',1,8),(2,'Apartement A2',1,4),(3,'Apartement A3',1,6),(4,'Apartement A4',1,4),(5,'Apartement B1',2,7),(6,'Apartement B2',2,6),(7,'Apartement B3',2,7),(8,'Apartement C1',3,8),(9,'Apartement C2',3,3),(10,'Apartement C3',3,4),(11,'Apartement D1',4,6),(12,'Apartement D2',4,8),(13,'Apartement D3',4,3);
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
INSERT INTO `building` VALUES (1,'Building A',14),(2,'Building B',15),(3,'Building C',16),(4,'Building D',17);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `communication`
--

LOCK TABLES `communication` WRITE;
/*!40000 ALTER TABLE `communication` DISABLE KEYS */;
INSERT INTO `communication` VALUES (8,'Sujet de la comm A1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',1),(9,'Sujet de la comm A2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',1),(10,'Sujet de la comm A3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',1),(11,'Sujet de la comm B1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',2),(12,'Sujet de la comm B2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',2),(13,'Sujet de la comm B3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',2),(14,'Sujet de la comm C1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',3),(15,'Sujet de la comm C2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',3),(16,'Sujet de la comm C3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',3),(17,'Sujet de la comm D1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',4),(18,'Sujet de la comm D2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',4),(19,'Sujet de la comm D3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',4),(20,'Sujet de la comm D4','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',4);
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
  CONSTRAINT `ticket_FK` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_FK_4` FOREIGN KEY (`fkStatus`) REFERENCES `status` (`idStatus`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_FK_5` FOREIGN KEY (`fkUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` VALUES (19,'Sujet du ticket A1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',2,1,3),(20,'Sujet du ticket A2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',3,1,2),(21,'Sujet du ticket A3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',4,1,1),(22,'Sujet du ticket A4','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',5,1,3),(23,'Sujet du ticket B1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',2,2,2),(24,'Sujet du ticket B2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',3,2,1),(25,'Sujet du ticket B3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',4,2,3),(26,'Sujet du ticket B4','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',5,2,2),(27,'Sujet du ticket C1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',2,3,1),(28,'Sujet du ticket C2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',3,3,3),(29,'Sujet du ticket C3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',4,3,2),(30,'Sujet du ticket C4','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',5,3,1),(31,'Sujet du ticket D1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis eum molestiaetur?','2021-06-20 19:12:59','2021-06-20 19:12:59',2,4,3);
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
INSERT INTO `user` VALUES (1,'Emile','Cyimena','cyimena09@hotmail.com','0484090853','M','0f86f5141ab4807c.1624351852','2021-06-22 10:50:52','$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',1,NULL,NULL,'1',1),(2,'Benoit','Vankoningsloo','vanko@hotmail.com','0477213465','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',2,NULL,1,'1',2),(3,'Amaury','Cyemezo','cyemezo@hotmail.com','0499591245','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',3,NULL,NULL,'1',3),(4,'Alice','Malaika','malaika@hotmail.com','0476134465','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',4,NULL,1,'1',4),(5,'Mike','Francois','locataire@hotmail.com','0488124678','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',5,NULL,2,'1',2),(6,'Susi','Toupe','proprietaire@hotmail.com','6685851293','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',6,NULL,NULL,'1',3),(7,'Eveline','Joyner','ejoyner1@cloudflare.com','7861614104','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',7,NULL,2,'1',3),(8,'Eba','Penquet','proprietaire_resident@hotmail.com','7779636737','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',8,NULL,3,'1',4),(9,'Justina','Dearth','jdearth3@hc360.com','5481337107','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',9,NULL,4,'1',2),(10,'Venus','Tolwood','vtolwood4@w3.org','2896359988','F',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',10,NULL,5,'1',2),(11,'Napoleon','Jencey','njencey5@csmonitor.com','5625961927','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',11,NULL,NULL,'1',3),(12,'Kain','Wrist','kwrist6@mayoclinic.com','5729661592','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',12,NULL,7,'1',4),(13,'Vernor','Titchen','vtitchen7@moonfruit.com','2342462343','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',13,NULL,8,'1',2),(14,'Benoit','Delbar','syndic@hotmail.com','0489464544','M',NULL,NULL,'$2y$10$AKWxJHelS825lfPhx4rAG.dI0TX7bvQgsPzyFzQOB576rKF.U/8y2',18,NULL,NULL,'1',1);
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

-- Dump completed on 2021-06-22 10:51:19
