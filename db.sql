-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1	Database: lmcms
-- ------------------------------------------------------
-- Server version 	5.5.5-10.1.35-MariaDB
-- Date: Tue, 12 Mar 2019 16:18:14 +0700

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
-- Table structure for table `bagian`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bagian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_modul` int(11) NOT NULL,
  `bagian` varchar(191) NOT NULL,
  `text` longtext NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_modul` (`id_modul`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `bagian_ibfk_1` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`),
  CONSTRAINT `bagian_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `bagian` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bagian`
--

LOCK TABLES `bagian` WRITE;
/*!40000 ALTER TABLE `bagian` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `bagian` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `bagian` with 0 row(s)
--

--
-- Table structure for table `hak_akses`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hak_akses` (
  `id_user` int(11) NOT NULL,
  `route` varchar(191) NOT NULL,
  PRIMARY KEY (`id_user`,`route`),
  CONSTRAINT `hak_akses_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hak_akses`
--

LOCK TABLES `hak_akses` WRITE;
/*!40000 ALTER TABLE `hak_akses` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `hak_akses` VALUES (1,'auth.index'),(1,'auth.store'),(1,'menu.create'),(1,'menu.destroy'),(1,'menu.down'),(1,'menu.edit'),(1,'menu.index'),(1,'menu.store'),(1,'menu.up'),(1,'menu.update'),(1,'peran.create'),(1,'temp.index'),(1,'temp.sendData'),(3,'auth.index'),(3,'auth.store'),(3,'menu.create'),(3,'menu.destroy'),(3,'menu.down'),(3,'menu.edit'),(3,'menu.index'),(3,'menu.store'),(3,'menu.up'),(3,'menu.update'),(3,'peran.create'),(3,'temp.index'),(3,'temp.sendData');
/*!40000 ALTER TABLE `hak_akses` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `hak_akses` with 26 row(s)
--

--
-- Table structure for table `hak_akses_peran`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hak_akses_peran` (
  `id_peran` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(191) NOT NULL,
  PRIMARY KEY (`id_peran`,`route`),
  CONSTRAINT `hak_akses_peran_ibfk_1` FOREIGN KEY (`id_peran`) REFERENCES `peran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hak_akses_peran`
--

LOCK TABLES `hak_akses_peran` WRITE;
/*!40000 ALTER TABLE `hak_akses_peran` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `hak_akses_peran` VALUES (1,'auth.index'),(1,'auth.store'),(1,'menu.create'),(1,'menu.destroy'),(1,'menu.down'),(1,'menu.edit'),(1,'menu.index'),(1,'menu.store'),(1,'menu.up'),(1,'menu.update'),(1,'peran.create'),(1,'temp.index'),(1,'temp.sendData'),(4,'auth.create'),(4,'auth.destroy'),(4,'auth.edit'),(4,'auth.index'),(4,'auth.show'),(4,'auth.store'),(4,'auth.update'),(4,'menu.up');
/*!40000 ALTER TABLE `hak_akses_peran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `hak_akses_peran` with 21 row(s)
--

--
-- Table structure for table `menu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL,
  `route` varchar(191) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `posisi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `menu` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menu` VALUES (80,'Dashboard','fa fa-dashboard','main.index',NULL,1),(82,'Master','fa fa-list-ul',NULL,NULL,2),(111,'Admin','fa fa-dashboard',NULL,NULL,3),(112,'Menu','fa fa-dashboard','menu.index',111,1),(113,'Peran','fa fa-dashboard','peran.index',111,2);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menu` with 5 row(s)
--

--
-- Table structure for table `modul`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modul` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(191) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `pos`.`user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modul`
--

LOCK TABLES `modul` WRITE;
/*!40000 ALTER TABLE `modul` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `modul` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `modul` with 0 row(s)
--

--
-- Table structure for table `peran`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `peran` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peran`
--

LOCK TABLES `peran` WRITE;
/*!40000 ALTER TABLE `peran` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `peran` VALUES (1,'Admin'),(4,'a');
/*!40000 ALTER TABLE `peran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `peran` with 2 row(s)
--

--
-- Table structure for table `user`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `id_peran` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id_peran` (`id_peran`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_peran`) REFERENCES `peran` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `user` VALUES (1,'admin','$2y$10$WwAZ2IliBuDLWwX1JiwcWuBe5c8t.KckyQf6siSS5Ea1cKRwZUe2K','Administrator',1),(3,'agungdh','$2y$10$QvL7GUgF1gMVZ34JwPIyMO6ybdKwUXiksHqxOfwhMfMZwv3ssLbJi','AgungDH',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `user` with 2 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Tue, 12 Mar 2019 16:18:14 +0700
