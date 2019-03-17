-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: 127.0.0.1	Database: lmcms
-- ------------------------------------------------------
-- Server version 	5.5.5-10.1.35-MariaDB
-- Date: Sun, 17 Mar 2019 20:07:43 +0700

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
  `id_modul` int(11) DEFAULT NULL,
  `bagian` varchar(191) NOT NULL,
  `text` longtext,
  `parent_id` int(11) DEFAULT NULL,
  `posisi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_modul` (`id_modul`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `bagian_ibfk_1` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id`),
  CONSTRAINT `bagian_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `bagian` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bagian`
--

LOCK TABLES `bagian` WRITE;
/*!40000 ALTER TABLE `bagian` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `bagian` VALUES (10,7,'Version Control',NULL,NULL,1),(11,NULL,'What is version control ?','<p>test</p>\r\n<ol>\r\n<li>1</li>\r\n<li>2</li>\r\n<li>3</li>\r\n<li>4</li>\r\n</ol>\r\n<p>q</p>\r\n<p>q</p>\r\n<p>q</p>\r\n<p>sa</p>\r\n<p><img class=\"img-responsive\" src=\"https://cdn-images-1.medium.com/fit/c/50/50/1*iwyBHCDpkA0uF9R6e6unsQ.png\" alt=\"\" width=\"100\" height=\"100\" /></p>\r\n<ul>\r\n<li>asd</li>\r\n<li>a</li>\r\n<li>a</li>\r\n<li>&nbsp;</li>\r\n<li>a</li>\r\n</ul>\r\n<p>&nbsp;</p>',10,1),(12,NULL,'GIT',NULL,10,2),(13,NULL,'SVN',NULL,10,3),(14,7,'Looping',NULL,NULL,2),(15,NULL,'For',NULL,14,2),(16,NULL,'While',NULL,14,1),(17,NULL,'Foreach',NULL,14,3),(18,7,'kosong',NULL,NULL,3),(19,NULL,'hh',NULL,18,1);
/*!40000 ALTER TABLE `bagian` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `bagian` with 10 row(s)
--

--
-- Table structure for table `gambar`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gambar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(191) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gambar`
--

LOCK TABLES `gambar` WRITE;
/*!40000 ALTER TABLE `gambar` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `gambar` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `gambar` with 0 row(s)
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
INSERT INTO `hak_akses` VALUES (1,'bagian.create'),(1,'bagian.destroy'),(1,'bagian.down'),(1,'bagian.edit'),(1,'bagian.index'),(1,'bagian.store'),(1,'bagian.up'),(1,'bagian.update'),(1,'gambar.create'),(1,'gambar.destroy'),(1,'gambar.edit'),(1,'gambar.index'),(1,'gambar.store'),(1,'gambar.update'),(1,'hakakses.index'),(1,'hakakses.update'),(1,'hakaksesperan.index'),(1,'hakaksesperan.update'),(1,'menu.create'),(1,'menu.destroy'),(1,'menu.down'),(1,'menu.edit'),(1,'menu.index'),(1,'menu.store'),(1,'menu.up'),(1,'menu.update'),(1,'modul.create'),(1,'modul.destroy'),(1,'modul.edit'),(1,'modul.index'),(1,'modul.store'),(1,'modul.update'),(1,'peran.create'),(1,'peran.destroy'),(1,'peran.edit'),(1,'peran.index'),(1,'peran.store'),(1,'peran.sync'),(1,'peran.update'),(1,'subbagian.create'),(1,'subbagian.destroy'),(1,'subbagian.document'),(1,'subbagian.down'),(1,'subbagian.edit'),(1,'subbagian.index'),(1,'subbagian.saveDocument'),(1,'subbagian.store'),(1,'subbagian.up'),(1,'subbagian.update'),(1,'user.create'),(1,'user.destroy'),(1,'user.edit'),(1,'user.index'),(1,'user.store'),(1,'user.sync'),(1,'user.update'),(5,'bagian.create'),(5,'bagian.destroy'),(5,'bagian.down'),(5,'bagian.edit'),(5,'bagian.index'),(5,'bagian.store'),(5,'bagian.up'),(5,'bagian.update'),(5,'gambar.create'),(5,'gambar.destroy'),(5,'gambar.edit'),(5,'gambar.index'),(5,'gambar.store'),(5,'gambar.update'),(5,'modul.create'),(5,'modul.destroy'),(5,'modul.edit'),(5,'modul.index'),(5,'modul.store'),(5,'modul.update'),(5,'subbagian.create'),(5,'subbagian.destroy'),(5,'subbagian.document'),(5,'subbagian.down'),(5,'subbagian.edit'),(5,'subbagian.index'),(5,'subbagian.saveDocument'),(5,'subbagian.store'),(5,'subbagian.up'),(5,'subbagian.update');
/*!40000 ALTER TABLE `hak_akses` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `hak_akses` with 86 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hak_akses_peran`
--

LOCK TABLES `hak_akses_peran` WRITE;
/*!40000 ALTER TABLE `hak_akses_peran` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `hak_akses_peran` VALUES (1,'bagian.create'),(1,'bagian.destroy'),(1,'bagian.down'),(1,'bagian.edit'),(1,'bagian.index'),(1,'bagian.store'),(1,'bagian.up'),(1,'bagian.update'),(1,'gambar.create'),(1,'gambar.destroy'),(1,'gambar.edit'),(1,'gambar.index'),(1,'gambar.store'),(1,'gambar.update'),(1,'hakakses.index'),(1,'hakakses.update'),(1,'hakaksesperan.index'),(1,'hakaksesperan.update'),(1,'menu.create'),(1,'menu.destroy'),(1,'menu.down'),(1,'menu.edit'),(1,'menu.index'),(1,'menu.store'),(1,'menu.up'),(1,'menu.update'),(1,'modul.create'),(1,'modul.destroy'),(1,'modul.edit'),(1,'modul.index'),(1,'modul.store'),(1,'modul.update'),(1,'peran.create'),(1,'peran.destroy'),(1,'peran.edit'),(1,'peran.index'),(1,'peran.store'),(1,'peran.sync'),(1,'peran.update'),(1,'subbagian.create'),(1,'subbagian.destroy'),(1,'subbagian.document'),(1,'subbagian.down'),(1,'subbagian.edit'),(1,'subbagian.index'),(1,'subbagian.saveDocument'),(1,'subbagian.store'),(1,'subbagian.up'),(1,'subbagian.update'),(1,'user.create'),(1,'user.destroy'),(1,'user.edit'),(1,'user.index'),(1,'user.store'),(1,'user.sync'),(1,'user.update'),(5,'bagian.create'),(5,'bagian.destroy'),(5,'bagian.down'),(5,'bagian.edit'),(5,'bagian.index'),(5,'bagian.store'),(5,'bagian.up'),(5,'bagian.update'),(5,'gambar.create'),(5,'gambar.destroy'),(5,'gambar.edit'),(5,'gambar.index'),(5,'gambar.store'),(5,'gambar.update'),(5,'modul.create'),(5,'modul.destroy'),(5,'modul.edit'),(5,'modul.index'),(5,'modul.store'),(5,'modul.update'),(5,'subbagian.create'),(5,'subbagian.destroy'),(5,'subbagian.document'),(5,'subbagian.down'),(5,'subbagian.edit'),(5,'subbagian.index'),(5,'subbagian.saveDocument'),(5,'subbagian.store'),(5,'subbagian.up'),(5,'subbagian.update');
/*!40000 ALTER TABLE `hak_akses_peran` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `hak_akses_peran` with 86 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menu` VALUES (111,'Admin','fa fa-user-secret',NULL,NULL,3),(112,'Menu','fa fa-list','menu.index',111,1),(113,'Peran','fa fa-user','peran.index',111,2),(115,'Modul','fa fa-book','modul.index',NULL,1),(116,'Gambar','fa fa-image','gambar.index',NULL,2),(117,'User','fa fa-users','user.index',111,3);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menu` with 6 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modul`
--

LOCK TABLES `modul` WRITE;
/*!40000 ALTER TABLE `modul` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `modul` VALUES (7,'JAVA is EZ PZ',1);
/*!40000 ALTER TABLE `modul` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `modul` with 1 row(s)
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peran`
--

LOCK TABLES `peran` WRITE;
/*!40000 ALTER TABLE `peran` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `peran` VALUES (1,'Admin'),(5,'User');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `user` VALUES (1,'admin','$2y$10$WwAZ2IliBuDLWwX1JiwcWuBe5c8t.KckyQf6siSS5Ea1cKRwZUe2K','Administrator',1),(5,'user','$2y$10$lK09qSrWaH00D9Cl5SYH7.I0crg4wethJOtd5hVNC2q0Rl0bYVQWK','User',5);
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

-- Dump completed on: Sun, 17 Mar 2019 20:07:43 +0700
