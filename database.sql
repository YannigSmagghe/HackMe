CREATE DATABASE  IF NOT EXISTS `ourComicsStore` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ourComicsStore`;
-- MySQL dump 10.13  Distrib 5.5.59, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ourComicsStore
-- ------------------------------------------------------
-- Server version	5.5.59-0+deb8u1

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
-- Table structure for table `comics`
--

DROP TABLE IF EXISTS `comics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denomination` varchar(45) NOT NULL,
  `denomination_secondaire` varchar(45) DEFAULT NULL,
  `code` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  UNIQUE KEY `denomination_UNIQUE` (`denomination`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comics`
--

LOCK TABLES `comics` WRITE;
/*!40000 ALTER TABLE `comics` DISABLE KEYS */;
INSERT INTO `comics` VALUES (1,'Green Lantern','La decouverte','GR01'),(2,'Superman','Contre lex luthor','SU01'),(3,'Dr. Manhathan','Voyage sur le soleil','DR01'),(4,'Le joker','Why so serious ?','LE01'),(5,'Batman et robin','Duo implacable','BA01'),(6,'SpiderMan','La morsure','SP01');
/*!40000 ALTER TABLE `comics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaries`
--

DROP TABLE IF EXISTS `commentaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentarie` varchar(45) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `comics_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`,`comics_name`),
  KEY `fk_commentaries_comics1_idx` (`comics_name`),
  CONSTRAINT `fk_commentaries_comics1` FOREIGN KEY (`comics_name`) REFERENCES `comics` (`denomination`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaries`
--

LOCK TABLES `commentaries` WRITE;
/*!40000 ALTER TABLE `commentaries` DISABLE KEYS */;
INSERT INTO `commentaries` VALUES (1,'J\'ai adoré','Jacques','Green Lantern'),(2,'Pas mal','paul','Superman'),(3,'Je reccomende !','aline','Superman'),(4,'génial !','Xxdark69xX','Superman'),(5,'La couverture est trompeuse','alice32','SpiderMan'),(6,'J\'ai peur des araignées','steph','SpiderMan'),(7,'LOL, la 10eme page va vous suprendre','RoxxPoney','SpiderMan'),(8,'Pas terrible','DarkAngel','Dr. Manhathan');
/*!40000 ALTER TABLE `commentaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `people` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denomination` varchar(45) NOT NULL,
  `denomination_secondaire` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `avatar` blob,
  `code_2_connexion` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
INSERT INTO `people` VALUES (1,'Physics',NULL,NULL,NULL,NULL,'14Carbon14'),(2,'atom12',NULL,NULL,NULL,NULL,'Atom45'),(3,'Jacques',NULL,NULL,NULL,NULL,'JeSuisJacques'),(4,'Nous','admins','25',NULL,NULL,'suoN');
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(45) NOT NULL,
  `manager` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (1,'Lyon','Abdel'),(2,'Lyon','Paul'),(3,'Lyon','Jake');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store_has_comics`
--

DROP TABLE IF EXISTS `store_has_comics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store_has_comics` (
  `store_id` int(11) NOT NULL,
  `comics_id` int(11) NOT NULL,
  PRIMARY KEY (`store_id`,`comics_id`),
  KEY `fk_store_has_comics_comics1_idx` (`comics_id`),
  KEY `fk_store_has_comics_store_idx` (`store_id`),
  CONSTRAINT `fk_store_has_comics_store` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_store_has_comics_comics1` FOREIGN KEY (`comics_id`) REFERENCES `comics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store_has_comics`
--

LOCK TABLES `store_has_comics` WRITE;
/*!40000 ALTER TABLE `store_has_comics` DISABLE KEYS */;
INSERT INTO `store_has_comics` VALUES (1,1),(1,2),(2,2),(1,3),(2,4);
/*!40000 ALTER TABLE `store_has_comics` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-12 10:41:49
