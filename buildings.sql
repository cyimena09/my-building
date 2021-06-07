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
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `building` (
  `idBuilding` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idBuilding`)
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
  `fkMessage_Owner` int(11) NOT NULL,
  `fkMessage_Trustee` int(11) NOT NULL,
  `fkMessage_Resident` int(11) NOT NULL,
  PRIMARY KEY (`idmessage`),
  KEY `message_FK` (`fkMessage_Owner`),
  KEY `message_FK_1` (`fkMessage_Resident`),
  KEY `message_FK_2` (`fkMessage_Trustee`),
  CONSTRAINT `message_FK` FOREIGN KEY (`fkMessage_Owner`) REFERENCES `message_owner` (`idMessage_Owner`),
  CONSTRAINT `message_FK_1` FOREIGN KEY (`fkMessage_Resident`) REFERENCES `message_resident` (`idMesage_Resident`),
  CONSTRAINT `message_FK_2` FOREIGN KEY (`fkMessage_Trustee`) REFERENCES `message_trustee` (`idMessage_Trustee`)
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
-- Table structure for table `message_owner`
--

DROP TABLE IF EXISTS `message_owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_owner` (
  `idMessage_Owner` int(11) NOT NULL,
  `fkOwner` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMessage_Owner`),
  KEY `message_owner_FK` (`fkOwner`),
  CONSTRAINT `message_owner_FK` FOREIGN KEY (`fkOwner`) REFERENCES `owner` (`idOwner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_owner`
--

LOCK TABLES `message_owner` WRITE;
/*!40000 ALTER TABLE `message_owner` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_resident`
--

DROP TABLE IF EXISTS `message_resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_resident` (
  `idMesage_Resident` int(11) NOT NULL,
  `fkresident` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMesage_Resident`),
  KEY `message_resident_FK` (`fkresident`),
  CONSTRAINT `message_resident_FK` FOREIGN KEY (`fkresident`) REFERENCES `resident` (`idResident`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_resident`
--

LOCK TABLES `message_resident` WRITE;
/*!40000 ALTER TABLE `message_resident` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_resident` ENABLE KEYS */;
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
  PRIMARY KEY (`idMessage_Trustee`),
  KEY `message_trustee_FK` (`fkTrustee`),
  CONSTRAINT `message_trustee_FK` FOREIGN KEY (`fkTrustee`) REFERENCES `trustee` (`idTrustee`)
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
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owner` (
  `idOwner` int(11) NOT NULL AUTO_INCREMENT,
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
  `session_token` varchar(255) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`idOwner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owner`
--

LOCK TABLES `owner` WRITE;
/*!40000 ALTER TABLE `owner` DISABLE KEYS */;
/*!40000 ALTER TABLE `owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `owner_building`
--

DROP TABLE IF EXISTS `owner_building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `owner_building` (
  `idOwner_Building` int(11) NOT NULL AUTO_INCREMENT,
  `fkOwner` int(11) NOT NULL,
  `fkBuilding` int(11) NOT NULL,
  PRIMARY KEY (`idOwner_Building`),
  KEY `owner_building_FK` (`fkOwner`),
  KEY `owner_building_FK_1` (`fkBuilding`),
  CONSTRAINT `owner_building_FK` FOREIGN KEY (`fkOwner`) REFERENCES `owner` (`idOwner`),
  CONSTRAINT `owner_building_FK_1` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owner_building`
--

LOCK TABLES `owner_building` WRITE;
/*!40000 ALTER TABLE `owner_building` DISABLE KEYS */;
/*!40000 ALTER TABLE `owner_building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resident`
--

DROP TABLE IF EXISTS `resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resident` (
  `idResident` int(11) NOT NULL AUTO_INCREMENT,
  `fkBuilding` int(11) NOT NULL,
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
  PRIMARY KEY (`idResident`),
  KEY `resident_FK` (`fkBuilding`),
  CONSTRAINT `resident_FK` FOREIGN KEY (`fkBuilding`) REFERENCES `building` (`idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resident`
--

LOCK TABLES `resident` WRITE;
/*!40000 ALTER TABLE `resident` DISABLE KEYS */;
/*!40000 ALTER TABLE `resident` ENABLE KEYS */;
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
  `fkTicket_Trustee` int(11) NOT NULL,
  `fkTicket_Owner` int(11) NOT NULL,
  `fkTicket_Resident` int(11) NOT NULL,
  PRIMARY KEY (`idTicket`),
  KEY `ticket_FK` (`fkTicket_Trustee`),
  KEY `ticket_FK_1` (`fkTicket_Owner`),
  KEY `ticket_FK_2` (`fkTicket_Resident`),
  CONSTRAINT `ticket_FK` FOREIGN KEY (`fkTicket_Trustee`) REFERENCES `ticket_trustee` (`id_Ticket_Trustee`),
  CONSTRAINT `ticket_FK_1` FOREIGN KEY (`fkTicket_Owner`) REFERENCES `ticket_owner` (`id_Ticket_Owner`),
  CONSTRAINT `ticket_FK_2` FOREIGN KEY (`fkTicket_Resident`) REFERENCES `ticket_resident` (`idTicket_Resident`)
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
-- Table structure for table `ticket_owner`
--

DROP TABLE IF EXISTS `ticket_owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_owner` (
  `id_Ticket_Owner` int(11) NOT NULL AUTO_INCREMENT,
  `fkOwner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Ticket_Owner`),
  KEY `ticket_owner_FK` (`fkOwner`),
  CONSTRAINT `ticket_owner_FK` FOREIGN KEY (`fkOwner`) REFERENCES `owner` (`idOwner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_owner`
--

LOCK TABLES `ticket_owner` WRITE;
/*!40000 ALTER TABLE `ticket_owner` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_resident`
--

DROP TABLE IF EXISTS `ticket_resident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket_resident` (
  `idTicket_Resident` int(11) NOT NULL AUTO_INCREMENT,
  `fkResident` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTicket_Resident`),
  KEY `ticket_resident_FK` (`fkResident`),
  CONSTRAINT `ticket_resident_FK` FOREIGN KEY (`fkResident`) REFERENCES `resident` (`idResident`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket_resident`
--

LOCK TABLES `ticket_resident` WRITE;
/*!40000 ALTER TABLE `ticket_resident` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_resident` ENABLE KEYS */;
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
  PRIMARY KEY (`id_Ticket_Trustee`),
  KEY `ticket_trustee_FK` (`fkTrustee`),
  CONSTRAINT `ticket_trustee_FK` FOREIGN KEY (`fkTrustee`) REFERENCES `trustee` (`idTrustee`)
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
  KEY `trustee_building_FK` (`fkTrustee`),
  KEY `trustee_building_FK_1` (`fkBuilding`),
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

-- Dump completed on 2021-06-07 16:07:53
