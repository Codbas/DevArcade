-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: DevArcade
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `DevLogViews`
--

DROP TABLE IF EXISTS `DevLogViews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DevLogViews` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `devLogId` int(11) NOT NULL,
  KEY `devLogId` (`devLogId`),
  CONSTRAINT `devlogviews_ibfk_1` FOREIGN KEY (`devLogId`) REFERENCES `DevLogs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DevLogViews`
--

LOCK TABLES `DevLogViews` WRITE;
/*!40000 ALTER TABLE `DevLogViews` DISABLE KEYS */;
/*!40000 ALTER TABLE `DevLogViews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DevLogs`
--

DROP TABLE IF EXISTS `DevLogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DevLogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DevLogs`
--

LOCK TABLES `DevLogs` WRITE;
/*!40000 ALTER TABLE `DevLogs` DISABLE KEYS */;
INSERT INTO `DevLogs` VALUES (1,'Dev Log - Game One','This is the first Dev Log, appropriately named \"Dev Log - Game One\". Learn how I made this simple, but addicting game!'),(2,'Dev Log - Game Two','The second Dev Log made for DevArcade. This one should be a doozy! Get strapped in, because you\'re in for a ride.'),(3,'Dev Log - Game Three','The third, and possible final Dev Log. This one is no different than the others... or is it?');
/*!40000 ALTER TABLE `DevLogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FailedLogin`
--

DROP TABLE IF EXISTS `FailedLogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FailedLogin` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`timestamp`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FailedLogin`
--

LOCK TABLES `FailedLogin` WRITE;
/*!40000 ALTER TABLE `FailedLogin` DISABLE KEYS */;
INSERT INTO `FailedLogin` VALUES ('2024-05-20 11:22:29','127.0.0.1'),('2024-05-20 12:11:05','127.0.0.1'),('2024-05-20 14:13:34','127.0.0.1'),('2024-05-20 14:13:51','127.0.0.1'),('2024-05-20 14:13:52','127.0.0.1'),('2024-05-20 14:13:53','127.0.0.1'),('2024-05-20 14:13:54','127.0.0.1'),('2024-05-20 23:37:58','127.0.0.1'),('2024-05-21 23:50:32','127.0.0.1'),('2024-05-21 23:50:37','127.0.0.1'),('2024-05-21 23:50:45','127.0.0.1');
/*!40000 ALTER TABLE `FailedLogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GamePlays`
--

DROP TABLE IF EXISTS `GamePlays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GamePlays` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `gameId` int(11) NOT NULL,
  KEY `gameId` (`gameId`),
  CONSTRAINT `gameplays_ibfk_1` FOREIGN KEY (`gameId`) REFERENCES `Games` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GamePlays`
--

LOCK TABLES `GamePlays` WRITE;
/*!40000 ALTER TABLE `GamePlays` DISABLE KEYS */;
/*!40000 ALTER TABLE `GamePlays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Games`
--

DROP TABLE IF EXISTS `Games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Games`
--

LOCK TABLES `Games` WRITE;
/*!40000 ALTER TABLE `Games` DISABLE KEYS */;
INSERT INTO `Games` VALUES (1,'Game One','This is the first game, appropriately named \"Game One\". It is a simple game where you try to click the button, but it has plans of its own. :)'),(2,'Game Two','The second game made for DevArcade. It\'s exactly the same as Game One!'),(3,'Game Three','The third, and possible final game. This one is no different than the others.');
/*!40000 ALTER TABLE `Games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PageViews`
--

DROP TABLE IF EXISTS `PageViews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PageViews` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `pageId` int(11) NOT NULL,
  KEY `pageId` (`pageId`),
  CONSTRAINT `pageviews_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `Pages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PageViews`
--

LOCK TABLES `PageViews` WRITE;
/*!40000 ALTER TABLE `PageViews` DISABLE KEYS */;
/*!40000 ALTER TABLE `PageViews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pages`
--

DROP TABLE IF EXISTS `Pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pages`
--

LOCK TABLES `Pages` WRITE;
/*!40000 ALTER TABLE `Pages` DISABLE KEYS */;
INSERT INTO `Pages` VALUES (1,'Home'),(2,'Games'),(3,'Dev Logs'),(4,'About'),(5,'Log In'),(6,'Change Password'),(7,'Manage Content');
/*!40000 ALTER TABLE `Pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sessions`
--

DROP TABLE IF EXISTS `Sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sessions` (
  `sessionId` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `lastActive` datetime NOT NULL,
  PRIMARY KEY (`sessionId`),
  KEY `username` (`username`),
  CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sessions`
--

LOCK TABLES `Sessions` WRITE;
/*!40000 ALTER TABLE `Sessions` DISABLE KEYS */;
INSERT INTO `Sessions` VALUES ('r4bodpt9st6kmof6jmokvs9ci3','cody','2024-05-21 23:58:27');
/*!40000 ALTER TABLE `Sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SiteHits`
--

DROP TABLE IF EXISTS `SiteHits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SiteHits` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`timestamp`,`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SiteHits`
--

LOCK TABLES `SiteHits` WRITE;
/*!40000 ALTER TABLE `SiteHits` DISABLE KEYS */;
/*!40000 ALTER TABLE `SiteHits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SuccessfulLogin`
--

DROP TABLE IF EXISTS `SuccessfulLogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SuccessfulLogin` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`username`,`ip`,`timestamp`),
  CONSTRAINT `successfullogin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SuccessfulLogin`
--

LOCK TABLES `SuccessfulLogin` WRITE;
/*!40000 ALTER TABLE `SuccessfulLogin` DISABLE KEYS */;
INSERT INTO `SuccessfulLogin` VALUES ('2024-05-20 11:22:33','127.0.0.1','cody'),('2024-05-20 11:24:18','127.0.0.1','cody'),('2024-05-20 12:11:26','127.0.0.1','cody'),('2024-05-20 13:17:55','127.0.0.1','Cody'),('2024-05-20 13:25:52','127.0.0.1','cody'),('2024-05-20 13:29:54','127.0.0.1','cody'),('2024-05-20 13:47:49','127.0.0.1','cody'),('2024-05-20 14:11:41','127.0.0.1','cody'),('2024-05-20 14:11:56','127.0.0.1','cody'),('2024-05-20 22:30:10','127.0.0.1','cody'),('2024-05-20 23:38:14','127.0.0.1','cody'),('2024-05-21 23:58:27','127.0.0.1','cody');
/*!40000 ALTER TABLE `SuccessfulLogin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES ('cody','$2y$10$YS6RTyB6l2VjCp8h2q9Ffuc49iYKIsHP/c9gsqj5TSBTyst7UyH6K');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-23 11:37:13
