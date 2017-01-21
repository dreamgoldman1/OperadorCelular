-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: operadorcelulares
-- ------------------------------------------------------
-- Server version	5.7.17-0ubuntu0.16.04.1

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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'3015192617','2017-01-20 10:18:25','Activo'),(2,'3015192674','2017-01-20 10:19:15','Activo'),(3,'3001234567','2017-01-20 10:35:33','Activo'),(4,'3001234568','2017-01-20 10:38:05','Inactivo');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumo`
--

DROP TABLE IF EXISTS `consumo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_celular_origen` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_celular_destino` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_llamada` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_llamada` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tiempo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumo`
--

LOCK TABLES `consumo` WRITE;
/*!40000 ALTER TABLE `consumo` DISABLE KEYS */;
INSERT INTO `consumo` VALUES (1,'3015192617','3015192674','1200','2017-01-20 14:28:25','60'),(2,'3015192617','3015192674','1200','2017-01-20 14:29:55','60'),(3,'3015192617','3015192674','1200','2017-01-20 14:30:04','60'),(4,'3015192617','3015192674','1200','2017-01-20 14:30:50','60'),(5,'3001234567','3001234568','1000','2017-01-20 15:03:05','50'),(6,'3015192617','3015192674','1500','2017-01-20 15:03:48','30'),(7,'30151927617','3015192674','25000','2017-01-21 10:21:04','500'),(8,'3015192617','3015192674','250','2017-01-21 10:22:06','5'),(9,'3015192617','3015192674','1500','2017-01-21 10:30:36','30');
/*!40000 ALTER TABLE `consumo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `costo`
--

DROP TABLE IF EXISTS `costo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `costo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor_segundo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `costo`
--

LOCK TABLES `costo` WRITE;
/*!40000 ALTER TABLE `costo` DISABLE KEYS */;
INSERT INTO `costo` VALUES (1,'10','2017-01-20 10-43-44'),(2,'30','2017-01-20 10-44-19'),(3,'20','2017-01-20 10-52-29'),(4,'50','2017-01-20 15-03-30'),(5,'40','2017-01-21 10-33-49');
/*!40000 ALTER TABLE `costo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recarga`
--

DROP TABLE IF EXISTS `recarga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recarga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor_recarga` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_recarga` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recarga`
--

LOCK TABLES `recarga` WRITE;
/*!40000 ALTER TABLE `recarga` DISABLE KEYS */;
INSERT INTO `recarga` VALUES (1,'3015192617','10000','2017-01-20 11:24:24'),(2,'3015192617','10000','2017-01-20 11:28:11'),(3,'3015192617','10000','2017-01-20 11:28:24'),(4,'3015192674','20000','2017-01-20 11:28:42'),(5,'3001234567','30000','2017-01-20 11:42:44'),(6,'3015192617','50000','2017-01-20 13:46:09');
/*!40000 ALTER TABLE `recarga` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-21 15:07:10
