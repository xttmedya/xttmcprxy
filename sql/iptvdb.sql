-- MySQL dump 10.13  Distrib 5.1.67, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: iptvdb
-- ------------------------------------------------------
-- Server version	5.1.67

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
-- Table structure for table `stream`
--

DROP TABLE IF EXISTS `stream`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stream` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stream_server` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stream`
--

LOCK TABLES `stream` WRITE;
/*!40000 ALTER TABLE `stream` DISABLE KEYS */;
INSERT INTO `stream` VALUES (1,'http://88.150.228.170:5001'),(2,'http://88.150.228.170:5002/amigopan'),(3,'http://88.150.228.170:5003/amigopan'),(4,'http://88.150.228.170:5004/amigopan'),(5,'http://88.150.228.170:5005/amigopan'),(6,'http://88.150.228.171:5006/amigopan'),(7,'http://88.150.228.171:5007/amigopan'),(8,'http://88.150.228.171:5008/amigopan'),(9,'http://88.150.228.171:5009/amigopan'),(10,'http://88.150.228.171:5010/amigopan'),(11,'http://88.150.228.171:5001'),(12,'http://88.150.228.171:5002'),(13,'http://88.150.228.171:5013'),(14,'http://88.150.228.171:5014'),(15,'http://88.150.228.171:5015'),(16,'http://188.227.176.156:8080'),(17,'http://188.227.176.156:8081'),(18,'http://188.227.176.156:8082'),(19,'http://188.227.176.156:8083'),(20,'http://188.227.176.156:8084');
/*!40000 ALTER TABLE `stream` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `md5_id` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `full_name` tinytext COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_email` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_level` tinyint(4) NOT NULL DEFAULT '1',
  `pwd` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `address` text COLLATE latin1_general_ci NOT NULL,
  `country` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `tel` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `fax` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `website` text COLLATE latin1_general_ci NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `users_ip` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `approved` int(1) NOT NULL DEFAULT '0',
  `activation_code` int(10) NOT NULL DEFAULT '0',
  `banned` int(1) NOT NULL DEFAULT '0',
  `ckey` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ctime` varchar(220) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `exp_date` varchar(60) COLLATE latin1_general_ci DEFAULT NULL,
  `user_client` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `user_client_sure` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `user_client_name` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `user_client_data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email` (`user_email`),
  FULLTEXT KEY `idx_search` (`full_name`,`address`,`user_email`,`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=3004 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'','HHA','admin','hha@',5,'ha4545','EH ARTIK HAYIRLI OLSUN\r\nBENI UNUTMA!!!!','','yok','','','2010-05-04','',1,0,0,'','','',NULL,NULL,NULL,'0000-00-00 00:00:00'),(2999,'','','tekor','9834rtew',4,'9834rtew','','','','','','2014-09-06','',1,0,0,'hdim8n4','1410203103','2014-11-05','1','60','admin','2014-09-05 21:01:36'),(3002,'','','deneme12','deneme12',1,'deneme12','','','','','','2014-09-08','',1,0,0,'','','2014-09-13','2999','5','tekor','2014-09-08 19:08:40'),(1556,'','','hamza','hamza',1,'hamza','','','','','','2013-04-15','',1,0,1,'','','2014-04-15','1','365','admin','2013-04-15 17:12:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'iptvdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-09-10  6:04:25
