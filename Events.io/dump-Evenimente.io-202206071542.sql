-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: Evenimente.io
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

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
-- Table structure for table `follow`
--

DROP TABLE IF EXISTS `follow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `follow` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `user_following` int(15) unsigned NOT NULL,
  `post_followed` int(15) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_following` (`user_following`),
  KEY `fk_followed` (`post_followed`),
  CONSTRAINT `fk_followed` FOREIGN KEY (`post_followed`) REFERENCES `posts` (`id`),
  CONSTRAINT `fk_following` FOREIGN KEY (`user_following`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `follow`
--

LOCK TABLES `follow` WRITE;
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;
/*!40000 ALTER TABLE `follow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_rights`
--

DROP TABLE IF EXISTS `page_rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_rights` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` int(15) unsigned NOT NULL,
  `page_id` int(15) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_type_right` (`user_type`),
  KEY `fk_page_right` (`page_id`),
  CONSTRAINT `fk_page_right` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`),
  CONSTRAINT `fk_type_right` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_rights`
--

LOCK TABLES `page_rights` WRITE;
/*!40000 ALTER TABLE `page_rights` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `show_menu` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Account settings','settings.php','1'),(2,'View Users','view.php','1'),(4,'Log Out','logout.php','1');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` datetime DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `fpage` varchar(50) NOT NULL DEFAULT 'index.php',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Admin','dashboardadmin.php'),(2,'User','dashboard.php');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(15) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf16 NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) CHARACTER SET utf16 NOT NULL,
  `type_id` int(15) unsigned NOT NULL DEFAULT 2,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_type` (`type_id`),
  CONSTRAINT `fk_type` FOREIGN KEY (`type_id`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'Evenimente.io'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-07 15:42:34
