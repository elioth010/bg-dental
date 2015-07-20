CREATE DATABASE  IF NOT EXISTS `beta_bg_dental` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `beta_bg_dental`;
-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: beta_bg_dental
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1-log

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
-- Table structure for table `companias`
--

DROP TABLE IF EXISTS `companias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companias` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paciente_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companias`
--

LOCK TABLES `companias` WRITE;
/*!40000 ALTER TABLE `companias` DISABLE KEYS */;
INSERT INTO `companias` VALUES ('2015-01-28 17:17:01','2015-01-28 17:17:01',1,'MAPFRE TRAFICOS','','mapfre tra',0),('2015-01-28 17:17:01','2015-01-28 17:17:01',2,'QUIRON DENTAL A','','quiron den',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',3,'MAPFRE FAMILIAR','','mapfre fam',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',4,'MEDIFIATC AMBUL','','medifiatc ',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',5,'PACIENTE 100%','','paciente 1',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',6,'INTERCRUISES AM','','intercruis',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',7,'GROUPAMA AMBULA','','groupama a',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',8,'MAPFRE DENTAL','','mapfre den',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',9,'ABOGADOS TRAFIC','','abogados t',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',10,'PERSONAL QUIRON','','personal q',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',11,'GLOBAL COMPLEME','','global com',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',12,'CHEQUEO INTEGRA','','chequeo in',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',13,'ANTARES AMBULAN','','antares am',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',14,'SANITAS INGRESO','','sanitas in',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',15,'SANITAS AMBULAN','','sanitas am',0),('2015-01-28 17:17:02','2015-01-28 17:17:02',16,'HNA SC INGRESAD','','hna sc ing',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',17,'ASISA INGRESADO','','asisa ingr',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',18,'DKV FUNCIONARIO','','dkv funcio',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',19,'ASISA AMBULANTE','','asisa ambu',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',20,'CARITAS TIPO B','','caritas ti',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',21,'GLOBAL CARD AEG','','global car',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',22,'NETSERVICES TRA','','netservice',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',23,'COSTA CROCIERE','','costa croc',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',24,'ASEFA SEGUROS A','','asefa segu',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',25,'DKV AMBULANTES','','dkv ambula',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',26,'HNA AMBULANTE','','hna ambula',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',27,'COBERTURA DISPE','','cobertura ',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',28,'CIGNA INGRESADO','','cigna ingr',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',29,'CASER INGRESADO','','caser ingr',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',30,'SEGUROS CATALAN','','seguros ca',0),('2015-01-28 17:17:03','2015-01-28 17:17:03',31,'HNA SC AMBULANT','','hna sc amb',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',32,'CASER AMBULANTE','','caser ambu',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',33,'CIGNA AMBULANTE','','cigna ambu',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',34,'CISNE AMBULANTE','','cisne ambu',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',35,'GENERALI','','generali',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',36,'GES SEGUROS AMB','','ges seguro',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',37,'GENERALI ESPAÑA','','generali e',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',38,'PACIENTE FF','','paciente f',0),('2015-01-28 17:17:04','2015-01-28 17:17:04',39,'VIDACAIXA ADELA','','vidacaixa ',0);
/*!40000 ALTER TABLE `companias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `especialidades`
--

DROP TABLE IF EXISTS `especialidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `especialidades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `especialidad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `especialidades`
--

LOCK TABLES `especialidades` WRITE;
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupostratamientos`
--

DROP TABLE IF EXISTS `grupostratamientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupostratamientos` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupostratamientos`
--

LOCK TABLES `grupostratamientos` WRITE;
/*!40000 ALTER TABLE `grupostratamientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupostratamientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupostratamientos_tratamientos`
--

DROP TABLE IF EXISTS `grupostratamientos_tratamientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupostratamientos_tratamientos` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tratamientos_id` int(11) NOT NULL,
  `grupotratamientos_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupostratamientos_tratamientos`
--

LOCK TABLES `grupostratamientos_tratamientos` WRITE;
/*!40000 ALTER TABLE `grupostratamientos_tratamientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupostratamientos_tratamientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_11_05_182016_create-users-table',1),('2014_11_06_112001_create_pacientes_table',1),('2014_11_14_122220_create_presupuestos_table',1),('2014_11_18_115542_create_tratamientos_table',1),('2014_11_18_120551_create_presupuestos_tratamientos_table',1),('2014_11_18_153656_create_grupostratamientos_table',1),('2014_11_18_154217_create_grupostratamientos_tratamientos_table',1),('2014_11_19_153820_add_compania_to_pacientes_table',1),('2014_11_19_164801_create_companias_table',1),('2014_11_19_172341_add_tipo_to_tratamientos_table',1),('2014_11_19_172622_create_tipos_tratamientos_table',1),('2014_11_24_135345_create_precios_table',1),('2014_11_25_104459_add_paciente_id_to_companias_table',1),('2014_12_09_120130_add_campos_to_presupuestos_tratamientos_table',1),('2014_12_10_171929_create_profesionales_table',1),('2014_12_15_212926_add_user_to_presupuestos_table',1),('2014_12_15_220001_add_profesional_to_presupuestos_table',1),('2014_12_29_093737_add_activo_to_tratamientos_table',1),('2014_12_30_060440_add_tipostratamientos_id_to_tratamientos_table',2),('2014_12_30_060450_add_grupostratamientos_id_to_tratamientos_table',2),('2014_12_30_064514_add_remember_token_to_users_table',3),('2015_01_07_095452_create_especialidades_table',4),('2015_01_07_111839_rename_especialidad_to_especialidades_id_profesionales_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `votes` int(11) DEFAULT NULL,
  `numerohistoria` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido1` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellido2` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombre` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NIF` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechanacimiento` datetime DEFAULT NULL,
  `sexo` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Direccion` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addrnamestre` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addrtel1` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addrtel2` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `terrdesc` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addrpostcode` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compania` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `precios`
--

DROP TABLE IF EXISTS `precios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precios` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tratamientos_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `companias_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio` float(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=190 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precios`
--

LOCK TABLES `precios` WRITE;
/*!40000 ALTER TABLE `precios` DISABLE KEYS */;
INSERT INTO `precios` VALUES ('0000-00-00 00:00:00','0000-00-00 00:00:00',1,'1','1',80.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',2,'2','2',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',3,'3','2',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',4,'2','3',7.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',5,'2','4',12.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',6,'1','5',40.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',7,'4','5',285.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',8,'5','5',105.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',9,'6','5',24.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',10,'7','5',350.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',11,'2','5',20.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',12,'8','5',120.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',13,'9','5',24.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',14,'10','6',108.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',15,'11','6',194.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',16,'12','3',50.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',17,'2','6',105.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',18,'2','7',10.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',19,'11','5',120.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',20,'13','5',99.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',21,'14','8',125.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',22,'11','2',132.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',23,'10','8',51.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',24,'14','5',165.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',25,'14','9',117.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',26,'15','8',90.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',27,'13','8',90.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',28,'13','2',99.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',29,'10','2',65.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',30,'10','5',102.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',31,'16','8',104.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',32,'11','8',90.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',33,'10','10',59.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',34,'16','2',414.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',35,'17','6',62.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',36,'11','10',120.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',37,'18','2',480.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',38,'16','11',394.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',39,'19','3',12.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',40,'20','5',75.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',41,'21','5',150.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',42,'22','8',30.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',43,'17','2',50.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',44,'23','10',675.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',45,'24','9',307.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',46,'25','2',30.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',47,'26','10',56.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',48,'19','5',60.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',49,'10','9',69.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',50,'22','9',30.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',51,'24','10',171.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',52,'26','5',56.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',53,'22','5',33.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',54,'27','5',25.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',55,'24','11',171.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',56,'24','8',161.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',57,'22','2',30.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',58,'28','10',147.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',59,'22','10',30.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',60,'17','8',45.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',61,'29','8',25.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',62,'25','5',30.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',63,'30','10',35.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',64,'24','2',196.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',65,'3','4',12.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',66,'17','11',47.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',67,'31','2',354.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',68,'32','2',354.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',69,'33','5',40.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',70,'34','8',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',71,'35','11',29.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',72,'16','10',156.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',73,'36','2',333.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',74,'26','8',64.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',75,'37','5',45.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',76,'23','2',2270.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',77,'38','8',53.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',78,'2','12',105.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',79,'17','5',90.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',80,'39','13',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',81,'40','14',100.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',82,'41','14',100.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',83,'39','15',17.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',84,'42','3',84.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',85,'43','3',13.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',86,'43','16',46.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',87,'42','16',154.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',88,'44','3',7.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',89,'43','17',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',90,'45','17',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',91,'42','17',82.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',92,'44','18',129.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',93,'39','19',17.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',94,'43','19',45.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',95,'43','18',48.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',96,'43','15',80.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',97,'39','5',20.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',98,'46','20',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',99,'39','20',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',100,'33','20',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',101,'2','1',16.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',102,'47','21',2.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',103,'25','11',38.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',104,'19','11',9.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',105,'45','14',62.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',106,'44','14',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',107,'39','6',105.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',108,'40','6',157.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',109,'39','18',16.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',110,'46','18',12.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',111,'43','14',31.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',112,'48','14',150.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',113,'39','3',16.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',114,'46','3',7.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',115,'45','3',59.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',116,'49','14',100.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',117,'50','14',21.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',118,'42','6',75.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',119,'43','6',150.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',120,'39','22',70.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',121,'46','15',10.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',122,'49','15',130.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',123,'39','23',105.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',124,'45','16',46.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',125,'44','17',24.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',126,'51','18',432.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',127,'46','2',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',128,'39','2',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',129,'19','2',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',130,'46','24',21.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',131,'39','25',20.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',132,'46','19',7.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',133,'45','19',45.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',134,'42','19',82.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',135,'46','26',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',136,'52','3',41.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',137,'53','3',43.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',138,'19','4',15.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',139,'39','27',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',140,'44','28',57.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',141,'45','29',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',142,'19','30',21.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',143,'39','30',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',144,'46','31',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',145,'39','31',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',146,'45','32',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',147,'54','32',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',148,'43','32',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',149,'12','32',193.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',150,'39','32',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',151,'46','32',12.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',152,'39','33',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',153,'45','33',122.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',154,'46','33',15.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',155,'39','34',44.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',156,'46','35',22.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',157,'39','35',22.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',158,'45','4',58.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',159,'40','4',29.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',160,'39','4',19.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',161,'46','4',19.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',162,'46','36',44.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',163,'39','36',44.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',164,'55','3',227.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',165,'56','3',172.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',166,'57','3',546.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',167,'43','37',125.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',168,'58','18',129.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',169,'59','28',190.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',170,'19','10',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',171,'60','5',550.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',172,'60','10',550.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',173,'50','38',115.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',174,'33','10',64.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',175,'61','38',750.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',176,'62','5',900.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',177,'37','10',53.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',178,'33','38',45.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',179,'63','1',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',180,'46','13',18.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',181,'50','28',24.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',182,'40','19',82.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',183,'50','39',15.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',184,'43','31',90.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',185,'42','31',150.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',186,'42','32',0.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',187,'64','3',46.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',188,'65','3',30.00),('0000-00-00 00:00:00','0000-00-00 00:00:00',189,'32','10',317.00);
/*!40000 ALTER TABLE `precios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presupuestos`
--

DROP TABLE IF EXISTS `presupuestos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presupuestos` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aceptado` tinyint(1) NOT NULL DEFAULT '0',
  `numerohistoria` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profesional_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presupuestos`
--

LOCK TABLES `presupuestos` WRITE;
/*!40000 ALTER TABLE `presupuestos` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuestos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `presupuestos_tratamientos`
--

DROP TABLE IF EXISTS `presupuestos_tratamientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presupuestos_tratamientos` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presupuesto_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tratamiento_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipostratamientos_id` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `desc_euros` double NOT NULL,
  `desc_porcien` double NOT NULL,
  `pieza1` int(11) NOT NULL,
  `pieza2` int(11) NOT NULL,
  `pieza3` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `presupuestos_tratamientos`
--

LOCK TABLES `presupuestos_tratamientos` WRITE;
/*!40000 ALTER TABLE `presupuestos_tratamientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuestos_tratamientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profesionales`
--

DROP TABLE IF EXISTS `profesionales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profesionales` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellido2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `especialidades_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profesionales`
--

LOCK TABLES `profesionales` WRITE;
/*!40000 ALTER TABLE `profesionales` DISABLE KEYS */;
/*!40000 ALTER TABLE `profesionales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipostratamientos`
--

DROP TABLE IF EXISTS `tipostratamientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipostratamientos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipostratamientos`
--

LOCK TABLES `tipostratamientos` WRITE;
/*!40000 ALTER TABLE `tipostratamientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipostratamientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tratamientos`
--

DROP TABLE IF EXISTS `tratamientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tratamientos` (
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio_base` float(8,2) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `activo` int(11) NOT NULL,
  `tipostratamientos_id` tinyint(1) NOT NULL,
  `grupostratamientos_id` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tratamientos`
--

LOCK TABLES `tratamientos` WRITE;
/*!40000 ALTER TABLE `tratamientos` DISABLE KEYS */;
INSERT INTO `tratamientos` VALUES ('2015-01-28 17:17:16','2015-01-28 17:17:16',1,'011900516','ORTOD FIJA. VISITA MENSUAL',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',2,'0119000001','CONSULTA ESTOMATOLOGÍA',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',3,'0119000002','REVISION ESTOMATOLOGÍA',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',4,'011900511','ORTOD INTERCEPTIVA.DISYUNTOR,QUAD HELIX, BARRA TRA',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',5,'011900517','ORTOD FIJA. RETENCION (POR APARATO)',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',6,'011900525','ORTODONCIA VISITA MENSUAL 1ª FASE',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',7,'0119000517','ORTODONCIA FIJA. MONTAJE SUPERIOR O INFERIOR',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',8,'011900509','ORTODONCIA. ESTUDIO ORTODONCIA',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',9,'0119000007','CONSULTA ORTODONCIA',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',10,'011900472','CONSERVADORA. RECONSTRUCCION TOTAL (TORNILLO INCL)',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',11,'011900474','ENDODONCIA 2 CONDUCTOS',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',12,'0119000932','CORDAL INCLUIDO. EXTRACCION',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',13,'011900473','ENDODONCIA 1 CONDUCTO',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',14,'011900475','ENDODONCIA 3 CONDUCTOS',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',15,'011900481','ODONTOPEDIATRIA. APICONFORMACION (X SESION)',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',16,'011900500','PROTESIS FIJA. CORONA METAL PORCELANA',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',17,'011900471','CONSERVADORA. OBTURACION COMPLEJA',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',18,'011900477','ENDODONCIA PERNO MUÑON COLADO UNI/BIRRADICULAR',0.00,0,1,0,0),('2015-01-28 17:17:16','2015-01-28 17:17:16',19,'0119001460','TARTRECTOMIA. LIMPIEZA DE BOCA. AMBAS ARCADAS',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',20,'0119000011','REVISION DE FERULA DE ROTH',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',21,'0119000540','ESTUDIO ATM',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',22,'0119001469','OCLUSION. CONTROL PLACA DESCARGA',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',23,'011900933','IMPLANTOLOGIA. PROTESIS FIJA HIBRIDA',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',24,'0119001468','OCLUSION PLACA DE DESCARGA',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',25,'0119001470','CONSERVADORA. OBTURACION SIMPLE',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',26,'0119001461','PERIODONCIA : RASPADO Y CURETAJE (POR CUADRANTE)',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',27,'011900531','CORONA PROVISIONAL',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',28,'011200930','IMPLANTOLOGIA. CORONA METAL PORCELANA',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',29,'011900499','PROTESIS FIJA. CORONA DE RESINA',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',30,'011900526','BLANQUEAMIENTO INTERNO POR DIENTE',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',31,'0119000525','IMPLANTOLOGIA.CORONA SOBRE IMPLANTE (SECTOR ANTERI',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',32,'011900930','IMPLANTOLOGIA.CORONA METAL PORCELANA',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',33,'011200918','EXODONCIA SIMPLE',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',34,'011900527','RECEMENTADO DE CORONAS',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',35,'011900493','PROTESIS REMOVIBLE. COMPOSTURA ACRILICO',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',36,'011900491','PROTESIS REMOVIBLE. COMPLETA SUP O INFERIOR',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',37,'011200919','EXODONCIA RESTO RADICULAR',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',38,'011900507','PROTESIS FIJA. CARILLAS DE COMPOSITE',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',39,'0112000001','CONSULTA CIRUGÍA ORAL Y MAXILOFACIAL',0.00,0,1,0,0),('2015-01-28 17:17:17','2015-01-28 17:17:17',40,'0112000980','TUMOR DE LABIO. EXTIRPACION Y PLASTIA',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',41,'0112000966','OSTEOCONDROSIS. RESECCION OSEA',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',42,'0112000973','QUISTES DENT, PARADENT, FISURALES Y FOLICULARES',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',43,'0112000932','CORDAL INCLUIDO. EXTRACCION',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',44,'0112000AYD','HHMM AYUDANTIA CIRUGIA MAXILOFACIAL',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',45,'0112000941','OTRAS PIEZAS DENTARIAS INCLUIDAS. EXTRACCION',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',46,'0112000002','REVISION CIRUGÍA ORAL Y MAXILOFACIAL',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',47,'0119001464','PREVENTIVA. FLUORACION (SESION)',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',48,'0112001004','QUISTE MAXILAR AFECT. SENO-OTRAS ESTRUCTURAS',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',49,'0112000979','TUMORES BENIGNOS DE MAXILARES. EXTIRPACION',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',50,'0112000006','VISITA A HOSPITAL  CIRUGÍA MAXILOFA(INTERCONSULTA)',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',51,'0112001054','TUM. MEDIANOS CARA-CUELLO.EXTIRP+INJERTO COMPL.',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',52,'011906988','RECONSTRUCCION DIENTE TEMPORAL',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',53,'011900478','ODONTOPEDIATRIA. PULPOTOMIA',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',54,'011900973','QUISTES DENT,PARADENT,FISURALES Y FOLICULARES',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',55,'0112001042','FRAC. MAXILAR LE FORT II O III. REDUC/FIJACION',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',56,'0112001053','TUM. CUTANEO MALIGNO CARA. GRAN COLGAJO FACIAL',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',57,'0112001059','MAXILECTOMIA RADICAL EX. ORBITA,INJERT.CUTANEO',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',58,'0112000981','TUM. SUPERFI.CARA/CUELLO. TTO.C/PLASTIAS LOC.',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',59,'0112000816','TUM. LINGUAL. HEMIGLOSECTOMIA / GLOSECTOMIA TOT',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',60,'011200928','IMPLANTOLOGIA. COLOCACION DE IMPLANTE X UNIDAD',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',61,'0112090445','IMPLANTE DENTAL',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',62,'011200929','IMPLANTOLOGIA. ELEVACION DEL SENO UNILATERAL',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',63,'','',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',64,'0112000931','CIRUGIA PREPROTESICA. REMODELADO CRESTA ALVEOLAR',0.00,0,1,0,0),('2015-01-28 17:17:18','2015-01-28 17:17:18',65,'0112000937','GINGIVECTOMIA (POR CUADRANTE)',0.00,0,1,0,0);
/*!40000 ALTER TABLE `tratamientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ban','Majstrovic','bmajstrovic@bitgeenius.com','$2y$10$eaENRQuOmvXlk5jME1LuWedL8bHTJN.LGyKSj4l.6V9dhkFstobjK','2014-12-29 21:37:04','2015-01-14 17:40:01','JO08nCvJksy3XcDH3oRiUyT7ob7UVnyfsP9SxtpcgScBp9cYERy9nDZu0szq'),(2,'Test','Pérez Pérez','test@test.com','$2y$10$Zb6tYLYuiYxJe60HkzBHAuoEN4G.EU2ixCf8RusAweMQHamJX0KVu','2014-12-30 06:18:57','2014-12-30 07:30:45','RBBDqPN4HKFBccMha7yMvu2awbSdiUtalh3RuMckb1bzYNCwsflKQLCpAOwY'),(3,'pepa','perez','pepa@quiron.com','$2y$10$hXxy1D92K4G4nBfnOOtDb.LYr8TrYRQowM9VEq7MF/05yqDxArcfu','2014-12-30 07:32:17','2014-12-30 07:46:59','4FrJCOk1986m25v82O8Zp4GVUbxcXOTPC2ouU8tioFPZY1p7TnhZIE7crLYA'),(4,'Rafael','Escribano Sánchez','rafaescribano@bitgeenius.com','$2y$10$YDsqtCFJBLURD0jpRb0QpecHUPc.dJkK0LwBAHHhkRVuV9Sm4M.nS','2014-12-30 17:05:25','2014-12-30 17:05:25','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-21  0:48:18
