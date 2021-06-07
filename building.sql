-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: buildings
-- ------------------------------------------------------
-- Server version	5.5.5-10.5.9-MariaDB

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
-- Table structure for table `apartment`
--

DROP TABLE IF EXISTS `apartment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apartment` (
  `idapartment` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idapartment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apartment`
--

LOCK TABLES `apartment` WRITE;
/*!40000 ALTER TABLE `apartment` DISABLE KEYS */;
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
  `fkApartment` int(11) DEFAULT NULL,
  PRIMARY KEY (`idBuilding`),
  KEY `building_FK` (`fkApartment`),
  CONSTRAINT `building_FK` FOREIGN KEY (`fkApartment`) REFERENCES `apartment` (`idapartment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `building`
--

LOCK TABLES `building` WRITE;
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
/*!40000 ALTER TABLE `building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `idmessage` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `session_token` varchar(100) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  `fkMessage_Trustee` int(11) NOT NULL,
  `fkMessage_User` int(11) NOT NULL,
  PRIMARY KEY (`idmessage`),
  KEY `message_FK_2` (`fkMessage_Trustee`),
  KEY `message_FK` (`fkMessage_User`),
  CONSTRAINT `message_FK` FOREIGN KEY (`fkMessage_User`) REFERENCES `user` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_trustee`
--

DROP TABLE IF EXISTS `message_trustee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_trustee` (
  `idMessage_Trustee` int(11) NOT NULL AUTO_INCREMENT,
  `fkTrustee` int(11) DEFAULT NULL,
  `fkMessage` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMessage_Trustee`),
  KEY `message_trustee_FK` (`fkTrustee`),
  CONSTRAINT `message_trustee_FK` FOREIGN KEY (`fkTrustee`) REFERENCES `trustee` (`idTrustee`),
  CONSTRAINT `message_trustee_FK_1` FOREIGN KEY (`fkTrustee`) REFERENCES `message` (`idmessage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_trustee`
--

LOCK TABLES `message_trustee` WRITE;
/*!40000 ALTER TABLE `message_trustee` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_trustee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `assigned` varchar(100) DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `session_token` varchar(100) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  PRIMARY KEY (`idTicket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_trustee`
--

DROP TABLE IF EXISTS `ticket_trustee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_trustee` (
  `id_Ticket_Trustee` int(11) NOT NULL,
  `fkTrustee` int(11) DEFAULT NULL,
  `fkTicket` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Ticket_Trustee`),
  KEY `ticket_trustee_FK_2` (`fkTrustee`),
  KEY `ticket_trustee_FK` (`fkTicket`),
  CONSTRAINT `ticket_trustee_FK` FOREIGN KEY (`fkTicket`) REFERENCES `ticket` (`idTicket`),
  CONSTRAINT `ticket_trustee_FK_2` FOREIGN KEY (`fkTrustee`) REFERENCES `trustee` (`idTrustee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_trustee`
--

LOCK TABLES `ticket_trustee` WRITE;
/*!40000 ALTER TABLE `ticket_trustee` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_trustee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_user`
--

DROP TABLE IF EXISTS `ticket_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_user` (
  `idTicket_User` int(11) NOT NULL AUTO_INCREMENT,
  `fkUser` int(11) DEFAULT NULL,
  `fkTicket` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTicket_User`),
  KEY `ticket_user_FK` (`fkUser`),
  KEY `ticket_user_FK_1` (`fkTicket`),
  CONSTRAINT `ticket_user_FK` FOREIGN KEY (`fkUser`) REFERENCES `user` (`idUser`),
  CONSTRAINT `ticket_user_FK_1` FOREIGN KEY (`fkTicket`) REFERENCES `ticket` (`idTicket`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_user`
--

LOCK TABLES `ticket_user` WRITE;
/*!40000 ALTER TABLE `ticket_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trustee`
--

DROP TABLE IF EXISTS `trustee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trustee` (
  `idTrustee` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `house_number` varchar(10) DEFAULT NULL,
  `box_number` varchar(10) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `session_token` varchar(100) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`idTrustee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trustee`
--

LOCK TABLES `trustee` WRITE;
/*!40000 ALTER TABLE `trustee` DISABLE KEYS */;
/*!40000 ALTER TABLE `trustee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trustee_building`
--

DROP TABLE IF EXISTS `trustee_building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trustee_building` (
  `idTrustee_Building` int(11) NOT NULL,
  `fkTrustee` int(11) NOT NULL,
  `fkBuilding` int(11) NOT NULL,
  KEY `trustee_building_FK_1` (`fkBuilding`),
  KEY `trustee_building_FK` (`fkTrustee`),
  CONSTRAINT `trustee_building_FK` FOREIGN KEY (`fkTrustee`) REFERENCES `trustee` (`idTrustee`),
  CONSTRAINT `trustee_building_FK_1` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trustee_building`
--

LOCK TABLES `trustee_building` WRITE;
/*!40000 ALTER TABLE `trustee_building` DISABLE KEYS */;
/*!40000 ALTER TABLE `trustee_building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `fkAparment` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `house_number` varchar(10) DEFAULT NULL,
  `box_number` varchar(10) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `session_token` varchar(100) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `user_FK` (`fkAparment`),
  CONSTRAINT `user_FK` FOREIGN KEY (`fkAparment`) REFERENCES `apartment` (`idapartment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'buildings'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-07 21:03:15
