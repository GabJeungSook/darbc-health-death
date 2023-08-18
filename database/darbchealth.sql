-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: darbc_health_death
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `documentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachments_documentable_type_documentable_id_index` (`documentable_type`,`documentable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cash_advances`
--

DROP TABLE IF EXISTS `cash_advances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cash_advances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NOT NULL,
  `enrollment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_purpose` text COLLATE utf8mb4_unicode_ci,
  `illness` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_numbers` json NOT NULL,
  `account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_requested` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_approved` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `date_approved` date DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_attempts` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cash_advances`
--

LOCK TABLES `cash_advances` WRITE;
/*!40000 ALTER TABLE `cash_advances` DISABLE KEYS */;
INSERT INTO `cash_advances` VALUES (1,3882,'member','ARMANDO P.',NULL,'EBRONA','Maintenance',NULL,NULL,'[{\"contact_number\": \"09054008576\"}]','2120','10000','3000','2023-06-13','2023-06-21',NULL,'Approved',0,'2023-06-21 05:52:54','2023-06-21 05:52:54'),(2,2958,'member','ERLINDA N.',NULL,'CORNAGO','Maintenance',NULL,NULL,'[{\"contact_number\": \"09679904351\"}]','0','2000','2000','2023-06-01','2023-06-21',NULL,'Approved',0,'2023-06-21 07:04:24','2023-06-21 07:04:24'),(3,871,'member','HERMINIA C.',NULL,'AVILA','Maintenance',NULL,NULL,'[{\"contact_number\": \"0\"}]','20688.47','2000','1000','2023-06-22','2023-06-22',NULL,'Approved',0,'2023-06-22 00:53:27','2023-06-22 00:53:27'),(4,7845,'member','DIONISIO L.',NULL,'PATIGAYON','Maintenance',NULL,NULL,'[{\"contact_number\": \"09639085254\"}]','0','5000','5000','2023-06-13','2023-06-22',NULL,'Approved',0,'2023-06-22 02:07:42','2023-06-22 02:07:42'),(5,4780,'member','ERLINDA M.',NULL,'GATDULA','Maintenance',NULL,NULL,'[{\"contact_number\": \"0\"}]','9595.41','2000','2000','2023-06-23','2023-06-23',NULL,'Approved',0,'2023-06-23 02:00:23','2023-06-23 02:00:23'),(6,4533,'member','ADELINA M.',NULL,'GA','Others','Financial Problem',NULL,'[{\"contact_number\": \"0\"}]','0','3000','3000','2023-06-23','2023-06-23',NULL,'Approved',0,'2023-06-23 05:27:54','2023-06-23 05:27:54'),(7,1873,'member','BERLINE ','T.','BONTIGAO','Maintenance',NULL,NULL,'[{\"contact_number\": \"09123905386\"}]','0','3000','3000','2023-06-05','2023-06-23',NULL,'Approved',0,'2023-06-23 06:42:21','2023-06-23 06:42:21'),(8,874,'member','RONALD  C.',NULL,'AVILA','Maintenance',NULL,NULL,'[{\"contact_number\": \"09813368721\"}]','0','2500','2500','2023-06-23','2023-06-23',NULL,'Approved',0,'2023-06-23 06:43:21','2023-06-23 06:43:21'),(9,3953,'member','ENECITA S.',NULL,'EMPLEO','Hospitalization',NULL,NULL,'[{\"contact_number\": \"094884252265\"}]','0','3000','3000','2023-06-21','2023-06-26',NULL,'Approved',0,'2023-06-26 05:09:13','2023-06-26 05:09:13'),(10,4882,'member','MARILYN ','ILUSTRISIMO','GILA','Maintenance',NULL,NULL,'[{\"contact_number\": \"0\"}]','0','3000','3000','2023-06-26','2023-06-26',NULL,'Approved',0,'2023-06-26 05:17:48','2023-06-26 05:17:48'),(11,1562,'member','AGNES DIVINE  B.',NULL,'ABALOS','Maintenance',NULL,NULL,'[{\"contact_number\": \"0\"}]','0','5000','5000','2023-06-27','2023-06-27',NULL,'Approved',0,'2023-06-27 05:37:40','2023-06-27 05:37:40'),(12,1643,'member','DOMINADOR B.',NULL,'BENITO','Others','Fare to Iloilo',NULL,'[{\"contact_number\": \"0\"}]','0','5000','5000','2023-06-27','2023-06-27',NULL,'Approved',0,'2023-06-27 05:46:32','2023-06-27 05:46:32'),(13,5948,'member','NOEMI B.',NULL,'LEQUIGAN','Others','Spouse Eye Operation',NULL,'[{\"contact_number\": \"09367525232\"}]','0','5000','5000','2023-06-29','2023-06-29',NULL,'Approved',0,'2023-06-29 06:36:24','2023-06-29 06:36:24'),(14,6852,'member','JOEL  ','RULOMA','MOLINA','Others','Fare to Manila',NULL,'[{\"contact_number\": \"09465355444\"}]','0','20000','5000','2023-06-20','2023-06-30',NULL,'Approved',0,'2023-06-30 06:52:39','2023-06-30 06:52:39'),(15,10243,'member','NERIO B.',NULL,'VALIENTE','Others','Financial Assistance',NULL,'[{\"contact_number\": \"0\"}]','8255','5000','1000','2023-06-30','2023-06-30',NULL,'Approved',0,'2023-06-30 07:53:58','2023-06-30 07:53:58'),(16,9773,'member','GEORGIE M.',NULL,'TANIONGON','Others','Ear Cyst Operation',NULL,'[{\"contact_number\": \"09513147056\"}]','0','5000','5000','2023-07-30','2023-07-03',NULL,'Approved',0,'2023-07-03 02:44:26','2023-07-03 02:44:26'),(17,3232,'member','JUDITH  D.',NULL,'ALAO','Others','Child Medicine',NULL,'[{\"contact_number\": \"029381901538\"}]','0','0','1000','2023-07-30','2023-07-03',NULL,'Approved',0,'2023-07-03 02:52:11','2023-07-03 02:52:11'),(18,4833,'member','ELIZABETH B.',NULL,'GERASTA','Others','Eye Check up',NULL,'[{\"contact_number\": \"09291434462\"}]','0','0','1000','2023-06-05','2023-07-03',NULL,'Approved',0,'2023-07-03 05:37:10','2023-07-03 05:37:10'),(19,92,'member','BERNARDITA',NULL,'ABONG','Maintenance',NULL,NULL,'[{\"contact_number\": \"0\"}]','13302.70','2000','1500','2023-07-03','2023-07-03',NULL,'Approved',0,'2023-07-03 06:12:53','2023-07-03 06:12:53'),(20,8969,'member','NORMA S.',NULL,'SANCHEZ','Others','Eye Drop',NULL,'[{\"contact_number\": \"09488200790\"}]','8230','0','1500','2023-05-29','2023-07-03',NULL,'Approved',0,'2023-07-03 07:02:45','2023-07-03 07:02:45'),(21,8628,'member','LITO D.',NULL,'ROMANO','Hospitalization',NULL,NULL,'[{\"contact_number\": \"0\"}]','12560','5000','1000','2023-06-29','2023-07-04',NULL,'Approved',0,'2023-07-03 23:32:00','2023-07-03 23:32:00'),(22,4520,'member','EVA M.',NULL,'FUENTESPINA','Maintenance',NULL,NULL,'[{\"contact_number\": \"0\"}]','0','1000','1000','2023-07-04','2023-07-04',NULL,'Approved',0,'2023-07-04 05:30:49','2023-07-04 05:30:49'),(23,7411,'member','PERLITO A.',NULL,'ONGUE','Others','Medicine & Biopsy',NULL,'[{\"contact_number\": \"0\"}]','0','5000','3500','2023-07-06','2023-07-06',NULL,'Approved',0,'2023-07-06 01:35:35','2023-07-06 01:35:35'),(24,7710,'member','MARILYN G.',NULL,'PANDOY','Hospitalization',NULL,NULL,'[{\"contact_number\": \"0\"}]','10226','2000','1000','2023-07-04','2023-07-07',NULL,'Approved',0,'2023-07-07 03:13:36','2023-07-07 03:13:36'),(25,5423,'member','LILIA B.',NULL,'JAVIER','Maintenance',NULL,NULL,'[{\"contact_number\": \"09093899628\"}]','27641','15000','3000','2023-06-20','2023-07-07',NULL,'Approved',0,'2023-07-07 05:51:03','2023-07-07 05:51:03'),(26,7605,'member','SABINA S.',NULL,'PAGADO','Others','Spouse Check up',NULL,'[{\"contact_number\": \"093225736530\"}]','0','25000','1000','2023-07-07','2023-07-07',NULL,'Approved',0,'2023-07-07 07:28:41','2023-07-07 07:28:41'),(27,1512,'member','ALVIN  G.',NULL,'BAYONA','Maintenance','',NULL,'[{\"contact_number\": \"09510414477\"}]','09510414477','5000','5000','2023-07-10','2023-07-10',NULL,'Approved',0,'2023-07-10 03:30:56','2023-07-10 03:30:56'),(28,5989,'member','VIVENCIO JR. B.',NULL,'LICUDINE','Others','Eye Operation',NULL,'[{\"contact_number\": \"09368599588\"}]','5300','30000','2000','2023-06-01','2023-07-12',NULL,'Approved',0,'2023-07-12 02:45:37','2023-07-12 02:45:37'),(29,2761,'member','ROSITA L.',NULL,'CELIS','Others','Eye Operation',NULL,'[{\"contact_number\": \"09107528014\"}]','0','0','3000','2023-06-29','2023-07-12',NULL,'Approved',0,'2023-07-12 05:25:49','2023-07-12 05:25:49'),(30,5951,'member','VINCENT RHOD ',' PANES','LEQUIGAN','Maintenance',NULL,'m','[{\"contact_number\": \"0\"}]','0','0','2000','2023-07-17','2023-07-17',NULL,'Approved',0,'2023-07-17 03:25:04','2023-07-17 03:25:04');
/*!40000 ALTER TABLE `cash_advances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `community_relations`
--

DROP TABLE IF EXISTS `community_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `community_relations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned DEFAULT NULL,
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` text COLLATE utf8mb4_unicode_ci,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_id` bigint unsigned DEFAULT NULL,
  `number_of_participants` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_attempts` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `community_relations`
--

LOCK TABLES `community_relations` WRITE;
/*!40000 ALTER TABLE `community_relations` DISABLE KEYS */;
/*!40000 ALTER TABLE `community_relations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coverage_histories`
--

DROP TABLE IF EXISTS `coverage_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coverage_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `number_of_days` int NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_implemented` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coverage_histories`
--

LOCK TABLES `coverage_histories` WRITE;
/*!40000 ALTER TABLE `coverage_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `coverage_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `death_attachments`
--

DROP TABLE IF EXISTS `death_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `death_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `documentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `death_attachments_documentable_type_documentable_id_index` (`documentable_type`,`documentable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `death_attachments`
--

LOCK TABLES `death_attachments` WRITE;
/*!40000 ALTER TABLE `death_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `death_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deaths`
--

DROP TABLE IF EXISTS `deaths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deaths` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NOT NULL,
  `mortuary_id` bigint unsigned NOT NULL,
  `batch_number` int NOT NULL,
  `date` date NOT NULL,
  `enrollment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependents_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependents_middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependents_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependent_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `has_diamond_package` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `age` int NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_death` date NOT NULL,
  `place_of_death` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coverage_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_vehicle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_attempts` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deaths_mortuary_id_index` (`mortuary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deaths`
--

LOCK TABLES `deaths` WRITE;
/*!40000 ALTER TABLE `deaths` DISABLE KEYS */;
INSERT INTO `deaths` VALUES (5,10069,54,1,'2023-07-12','member','ENOLFA',NULL,'TRAZO',NULL,NULL,NULL,NULL,'No','1951-04-17',72,'9309711212','2023-03-10','PSC','4','Yes','55000',0,'2023-07-12 05:33:50','2023-07-12 05:33:50'),(6,8706,6,1,'2023-07-12','member','ROBERT',NULL,'RULE',NULL,NULL,NULL,NULL,'No','1942-07-22',80,'9105806536','2023-03-24','PSC','4','No','56000',0,'2023-07-12 05:46:00','2023-07-12 05:46:00'),(7,3708,5,1,'2023-07-12','member','BEBETH',NULL,'DOMINGO',NULL,NULL,NULL,NULL,'No','1937-04-21',86,'9518237892','2023-03-19','PSC','4','No','56000',0,'2023-07-12 05:49:37','2023-07-12 05:49:37'),(8,5342,2,1,'2023-07-12','member','JANICE',NULL,'IWAG',NULL,NULL,NULL,NULL,'No','1957-01-29',66,'9108959063','2023-03-13','PSC','4','No','56000',0,'2023-07-12 06:35:43','2023-07-12 06:35:43');
/*!40000 ALTER TABLE `deaths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_attachments`
--

DROP TABLE IF EXISTS `health_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `health_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `documentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `health_attachments_documentable_type_documentable_id_index` (`documentable_type`,`documentable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_attachments`
--

LOCK TABLES `health_attachments` WRITE;
/*!40000 ALTER TABLE `health_attachments` DISABLE KEYS */;
INSERT INTO `health_attachments` VALUES (1,'App\\Models\\Health',425,'public/23461906282023-SKMBT_28323062908480.pdf','SKMBT_28323062908480.pdf','2023-06-28 23:46:19','2023-06-28 23:46:19'),(2,'App\\Models\\Health',426,'public/23481007032023-SKMBT_28323070408500.pdf','SKMBT_28323070408500.pdf','2023-07-03 23:48:10','2023-07-03 23:48:10'),(3,'App\\Models\\Health',427,'public/00035007042023-Mandid, Romeo.pdf','Mandid, Romeo.pdf','2023-07-04 00:03:50','2023-07-04 00:03:50'),(4,'App\\Models\\Health',428,'public/00240507042023-Mandid, Romeo.pdf','Mandid, Romeo.pdf','2023-07-04 00:24:05','2023-07-04 00:24:05'),(5,'App\\Models\\Health',429,'public/00255007042023-Tayone, Emma.pdf','Tayone, Emma.pdf','2023-07-04 00:25:50','2023-07-04 00:25:50'),(6,'App\\Models\\Health',430,'public/00300907042023-SKMBT_28323070409320.pdf','SKMBT_28323070409320.pdf','2023-07-04 00:30:09','2023-07-04 00:30:09'),(7,'App\\Models\\Health',431,'public/00563207042023-SKMBT_28323070409590.pdf','SKMBT_28323070409590.pdf','2023-07-04 00:56:32','2023-07-04 00:56:32'),(8,'App\\Models\\Health',432,'public/01193307042023-SKMBT_28323070410210.pdf','SKMBT_28323070410210.pdf','2023-07-04 01:19:33','2023-07-04 01:19:33'),(9,'App\\Models\\Health',433,'public/01225207042023-SKMBT_28323070410240.pdf','SKMBT_28323070410240.pdf','2023-07-04 01:22:52','2023-07-04 01:22:52');
/*!40000 ALTER TABLE `health_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `health_deaths`
--

DROP TABLE IF EXISTS `health_deaths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `health_deaths` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `patients_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrollment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dhib` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_confinement_from` date DEFAULT NULL,
  `date_of_confinement_to` date DEFAULT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transmittal_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batches` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transmittal_date` date DEFAULT NULL,
  `fortune_paid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `difference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `_batches` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `with_hollographic-will` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_cash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cannery` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `polomolok` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_deaths`
--

LOCK TABLES `health_deaths` WRITE;
/*!40000 ALTER TABLE `health_deaths` DISABLE KEYS */;
/*!40000 ALTER TABLE `health_deaths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `healths`
--

DROP TABLE IF EXISTS `healths`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `healths` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_id` bigint unsigned NOT NULL,
  `batch_number` int NOT NULL,
  `enrollment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `confinement_date_from` date NOT NULL,
  `confinement_date_to` date NOT NULL,
  `number_of_days` int NOT NULL,
  `amount` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_attempts` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=434 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `healths`
--

LOCK TABLES `healths` WRITE;
/*!40000 ALTER TABLE `healths` DISABLE KEYS */;
INSERT INTO `healths` VALUES (1,'6401',1,1,'member','BEDALIA L.',NULL,'MALIDAS','9359327197',66,'2023-03-08','2023-03-09',1,1000,'TRANSMITTED',0,'2023-06-20 01:34:47','2023-06-29 19:59:31'),(2,'4221',2,1,'member','CRESENCIA D.',NULL,'ESTREBILLA','9351969307',65,'2023-03-08','2023-03-09',1,1000,'TRANSMITTED',0,'2023-06-20 01:38:37','2023-06-29 19:59:45'),(3,'2084',3,1,'member','NOLI',NULL,'CABALHIN','9506932341',60,'2023-03-08','2023-03-09',1,1000,'TRANSMITTED',0,'2023-06-20 01:43:45','2023-06-29 19:59:54'),(4,'5575',4,1,'member','SUSANA  C.',NULL,'JUTAJERO','9305351896',61,'2023-03-10','2023-03-12',2,2000,'TRANSMITTED',0,'2023-06-20 01:48:30','2023-06-29 20:00:21'),(5,'5385',5,1,'member','ROSELYN M.',NULL,'JAMCO','9382115736',70,'2023-03-08','2023-03-10',2,2000,'TRANSMITTED',0,'2023-06-20 02:02:53','2023-06-29 20:00:30'),(6,'2700',4,1,'member','ALICIA S.',NULL,'CATOLICO','9302500480',61,'2023-03-08','2023-03-12',4,4000,'TRANSMITTED',0,'2023-06-20 02:10:55','2023-06-29 20:00:40'),(7,'2889',2,1,'member','CORAZON G.',NULL,'COMBATIR','9097828122',63,'2023-03-08','2023-03-10',2,2000,'TRANSMITTED',0,'2023-06-20 02:12:12','2023-06-29 20:00:51'),(8,'7581',4,1,'member','ROSALINA  A.',NULL,'PACULBA','9268665790',70,'2023-03-10','2023-03-13',3,3000,'TRANSMITTED',0,'2023-06-20 02:15:11','2023-06-29 20:01:28'),(9,'88',2,1,'member','NORMA O.',NULL,'ABOGA-A','9773305586',67,'2023-03-09','2023-03-11',2,2000,'TRANSMITTED',0,'2023-06-20 02:16:57','2023-06-29 20:01:38'),(10,'923',7,1,'member','JULUIS  T.',NULL,'BACTONG','9708809761',36,'2023-03-08','2023-03-11',3,3000,'TRANSMITTED',0,'2023-06-20 02:25:55','2023-06-29 20:01:49'),(11,'2862',7,1,'member','ROBERTO T.',NULL,'COFREROS','9368189883',50,'2023-03-08','2023-03-10',2,2000,'TRANSMITTED',0,'2023-06-20 03:41:26','2023-06-29 20:02:07'),(12,'7948',1,1,'member','BENITO',NULL,'PENOL','9502167303',67,'2023-03-10','2023-03-16',6,6000,'TRANSMITTED',0,'2023-06-20 03:42:26','2023-06-29 20:02:16'),(13,'6305',9,1,'member','MARIA G.',NULL,'MADRONA','9193798139',67,'2023-03-10','2023-03-14',4,4000,'TRANSMITTED',0,'2023-06-20 03:43:24','2023-06-29 20:02:27'),(14,'6305',9,1,'member','MARIA G.',NULL,'MADRONA','9193798139',67,'2023-03-10','2023-03-14',4,4000,'TRANSMITTED',0,'2023-06-20 03:43:31','2023-06-29 20:02:38'),(15,'2139',6,1,'dependent','VIRGINIA',NULL,'CABILADAS','N/A',62,'2023-03-09','2023-03-10',1,300,'TRANSMITTED',0,'2023-06-20 05:11:19','2023-06-29 20:02:48'),(16,'3620',2,1,'member','NENITA B.',NULL,'DIAZ','N/A',77,'2023-03-08','2023-03-11',3,3000,'TRANSMITTED',0,'2023-06-20 05:12:22','2023-06-29 20:02:58'),(17,'1240',8,1,'dependent','XYREN',NULL,'BARBON','N/A',9,'2023-03-11','2023-03-14',3,900,'TRANSMITTED',0,'2023-06-20 05:14:45','2023-06-29 20:03:08'),(18,'8836',7,1,'member','WILLIAM B.',NULL,'SALADO','N/A',58,'2023-03-12','2023-03-15',3,3000,'TRANSMITTED',0,'2023-06-20 05:17:57','2023-06-29 20:03:19'),(19,'1350',4,1,'member','ROMULO',NULL,'BASA','N/A',66,'2023-03-11','2023-03-15',4,4000,'TRANSMITTED',0,'2023-06-20 05:18:57','2023-06-29 20:03:31'),(20,'3382',6,1,'dependent','NELSON',NULL,'DELA CRUZ','N/A',68,'2023-03-18','2023-03-24',6,1800,'TRANSMITTED',0,'2023-06-20 05:24:55','2023-06-29 20:03:41'),(21,'5499',2,1,'dependent','SIMEON',NULL,'JOYA','N/A',76,'2023-03-08','2023-03-16',8,2400,'TRANSMITTED',0,'2023-06-20 05:26:11','2023-06-29 20:03:59'),(22,'7191',4,1,'dependent','VIVENCIA',NULL,'NILLAS','N/A',69,'2023-03-09','2023-03-16',7,2100,'TRANSMITTED',0,'2023-06-20 05:54:30','2023-06-29 20:04:11'),(23,'7366',2,1,'member','PERSITA C.',NULL,'OLIVA','9192598551',69,'2023-03-16','2023-03-20',4,4000,'TRANSMITTED',0,'2023-06-20 05:56:19','2023-06-29 20:04:23'),(24,'3204',7,1,'member','ANITA  V.',NULL,'DANDOY','9129224213',75,'2023-03-17','2023-03-19',2,2000,'TRANSMITTED',0,'2023-06-20 05:57:36','2023-06-29 20:04:36'),(25,'8951',12,1,'member','RODIN A.',NULL,'SAMPLIDAN','9360985039',74,'2023-03-14','2023-03-18',4,4000,'TRANSMITTED',0,'2023-06-20 06:06:13','2023-06-29 20:05:00'),(26,'7485',4,1,'member','PURISIMA  M.',NULL,'ORPALES','9062737253',75,'2023-03-14','2023-03-17',3,3000,'TRANSMITTED',0,'2023-06-20 06:09:09','2023-06-29 20:05:10'),(27,'1472',4,1,'dependent','LUZVIMINDA',NULL,'BAUTISTA','N/A',71,'2023-03-10','2023-03-14',4,1200,'TRANSMITTED',0,'2023-06-20 06:14:41','2023-06-29 20:05:20'),(28,'7365',2,1,'dependent','TERESITA',NULL,'OLIVA','N/A',71,'2023-03-16','2023-03-20',4,1200,'TRANSMITTED',0,'2023-06-20 06:17:32','2023-06-29 20:05:31'),(29,'10107',6,1,'dependent','REIGNZEL',NULL,'TUCAYAO','N/A',12,'2023-03-10','2023-03-18',8,2400,'TRANSMITTED',0,'2023-06-20 06:19:05','2023-06-29 20:05:42'),(30,'8789',7,1,'member','HANNAH KAY S.',NULL,'MUCHO','9508028887',34,'2023-03-08','2023-03-09',1,1000,'TRANSMITTED',0,'2023-06-20 06:20:44','2023-06-29 20:05:53'),(31,'4769',13,1,'member','DELMA R.',NULL,'GASPAR','9395330180',65,'2023-03-08','2023-03-11',3,3000,'TRANSMITTED',0,'2023-06-20 06:23:58','2023-06-29 20:06:10'),(33,'6664',10,1,'member','NOEMI N.',NULL,'MASENDO','N/A',69,'2023-03-12','2023-03-22',10,10000,'TRANSMITTED',0,'2023-06-20 07:03:09','2023-06-29 20:06:32'),(34,'9824',6,1,'member','AMADOR S.',NULL,'TAVARRO','9179996564',81,'2023-03-08','2023-03-13',5,5000,'TRANSMITTED',0,'2023-06-20 07:04:33','2023-06-29 20:06:43'),(35,'7204',2,1,'member','PEPITO ','LACHICA','NOBLEZA','09485248667',74,'2023-03-14','2023-03-18',4,4000,'TRANSMITTED',0,'2023-06-20 07:06:16','2023-06-29 20:06:53'),(36,'2636',14,1,'member','ROSALINDA M.',NULL,'CASTRANA','9758684495',73,'2023-03-10','2023-03-14',4,4000,'TRANSMITTED',0,'2023-06-20 07:07:22','2023-06-29 20:07:04'),(37,'8936',2,1,'member','ANA D.',NULL,'SAMBOG','9463368205',70,'2023-03-20','2023-03-23',3,3000,'TRANSMITTED',0,'2023-06-20 07:09:05','2023-06-29 20:07:16'),(38,'8016',3,1,'member','JANET L.',NULL,'PEREZ','9152758083',64,'2023-03-11','2023-03-15',4,4000,'TRANSMITTED',0,'2023-06-20 07:10:35','2023-06-29 20:07:27'),(40,'57',2,1,'dependent','ARELLANO',NULL,'ABE','N/A',67,'2023-03-19','2023-03-23',4,1200,'TRANSMITTED',0,'2023-06-20 07:14:45','2023-06-29 20:07:38'),(41,'487',10,1,'member','VICTORINO GALES',NULL,'AMPO','9104768434',70,'2023-03-18','2023-03-19',1,1000,'TRANSMITTED',0,'2023-06-20 07:26:58','2023-06-29 20:07:48'),(42,'8148',7,1,'member','ALEJANDRO SR. R.',NULL,'POLICARPIO','9480089511',80,'2023-03-08','2023-03-09',1,1000,'TRANSMITTED',0,'2023-06-20 07:32:29','2023-06-29 20:08:09'),(43,'4484',7,1,'member','LORENA ','CABRALES','FRANCISCO','09700635958/09667029356',71,'2023-03-14','2023-03-20',6,6000,'TRANSMITTED',0,'2023-06-20 07:33:24','2023-06-29 20:08:26'),(44,'2727',4,1,'member','JANETTE  C.',NULL,'PALER','9518284292',38,'2023-03-20','2023-03-21',1,1000,'TRANSMITTED',0,'2023-06-20 07:35:20','2023-06-29 20:08:39'),(45,'981',2,1,'member','ESPERANZA G.',NULL,'BAGUIOS','9513125328',64,'2023-03-21','2023-03-25',4,4000,'TRANSMITTED',0,'2023-06-20 07:40:18','2023-06-29 20:08:50'),(46,'3673',4,1,'member','MARILOU P.',NULL,'DIONELA','0918411826-3',67,'2023-03-16','2023-03-21',5,5000,'TRANSMITTED',0,'2023-06-20 07:44:03','2023-06-29 20:09:01'),(47,'2523',4,1,'member','DOMINGO C.',NULL,'CARIAGA','9104549364',66,'2023-03-23','2023-03-26',3,3000,'TRANSMITTED',0,'2023-06-20 07:46:35','2023-06-29 20:09:12'),(48,'9854',7,1,'member','DELIA T.',NULL,'TEJADA','9423607459',57,'2023-03-21','2023-03-24',3,3000,'TRANSMITTED',0,'2023-06-20 07:48:45','2023-06-29 20:09:23'),(49,'56',2,1,'member','ARELLANO ','DURIMAN','ABE','09709081914',67,'2023-03-19','2023-03-23',4,4000,'TRANSMITTED',0,'2023-06-20 07:57:25','2023-06-29 20:09:36'),(51,'9854',7,1,'member','DELIA T.',NULL,'TEJADA','9423607459',57,'2023-03-21','2023-03-24',3,3000,'TRANSMITTED',0,'2023-06-20 08:00:22','2023-06-29 20:09:53'),(52,'9855',7,1,'dependent','DELIA',NULL,'TEJADA','N/A',57,'2023-03-21','2023-03-24',3,900,'TRANSMITTED',0,'2023-06-22 01:00:59','2023-06-29 20:10:07'),(53,'2367',4,1,'member','ERLINDA M.',NULL,'CALULO','9305307700',72,'2023-03-22','2023-03-24',2,2000,'TRANSMITTED',0,'2023-06-22 01:02:11','2023-06-29 20:10:20'),(54,'4406',4,1,'member','PAZ M.',NULL,'FIN','9304067112',85,'2023-03-18','2023-03-20',2,2000,'TRANSMITTED',0,'2023-06-22 03:45:59','2023-06-29 20:10:47'),(55,'9343',11,1,'member','BEATRIZ A.',NULL,'SOLIDARIOS','9332565351',74,'2023-03-17','2023-03-24',7,7000,'TRANSMITTED',0,'2023-06-22 03:47:01','2023-06-29 20:10:59'),(56,'8609',2,1,'member','LOURDES B.',NULL,'RODRIGUEZ','9506500485',78,'2023-03-22','2023-03-26',4,4000,'TRANSMITTED',0,'2023-06-22 05:10:20','2023-06-29 20:11:10'),(57,'9375',2,1,'member','ARCADIO R.',NULL,'SOLON','N/A',63,'2023-03-24','2023-03-25',1,1000,'TRANSMITTED',0,'2023-06-22 05:14:15','2023-06-29 20:15:57'),(58,'7761',7,1,'member','ANGELITO H.',NULL,'PARCON','9125864191',65,'2023-03-17','2023-03-21',4,4000,'TRANSMITTED',0,'2023-06-22 05:15:01','2023-06-29 20:16:10'),(59,'10395',17,1,'member','BENITO C.',NULL,'VILLAPEZ','9061280812',60,'2023-03-23','2023-03-26',3,3000,'TRANSMITTED',0,'2023-06-22 05:23:56','2023-06-29 20:16:23'),(60,'3040',9,1,'member','VICENTE R.',NULL,'CUMAYAS','9387350224',69,'2023-03-19','2023-03-25',6,6000,'TRANSMITTED',0,'2023-06-22 05:34:25','2023-06-29 20:16:38'),(61,'2354',7,1,'member','RAMON M.',NULL,'CALUBAD','N/A',71,'2023-03-19','2023-03-24',5,5000,'TRANSMITTED',0,'2023-06-22 05:38:58','2023-06-29 20:16:51'),(62,'5768',4,1,'member','LYDIA T.',NULL,'LANDASAN','9973360291',68,'2023-03-25','2023-03-30',5,5000,'TRANSMITTED',0,'2023-06-22 05:42:18','2023-06-29 20:17:06'),(63,'10189',6,1,'member','BEVERLY  B.',NULL,'URBANO','9158552190',50,'2023-03-13','2023-03-23',10,10000,'TRANSMITTED',0,'2023-06-22 05:46:12','2023-06-29 20:17:17'),(64,'2585',19,1,'member','VICTORIANO E.',NULL,'CASIPONG','N/A',79,'2022-09-01','2022-09-05',4,4000,'TRANSMITTED',0,'2023-06-22 05:58:18','2023-06-29 20:17:43'),(65,'252',15,1,'member','RODRIGO ','ESTEBAN','ALARCON','09632813318',56,'2023-03-22','2023-03-25',3,3000,'TRANSMITTED',0,'2023-06-22 06:08:04','2023-06-29 20:17:57'),(66,'3062',16,1,'member','MERLITA',NULL,'CURIBA','9758955441',69,'2023-03-22','2023-03-28',6,6000,'TRANSMITTED',0,'2023-06-22 06:11:03','2023-06-29 20:18:11'),(67,'95',16,1,'member','MA. MYRNA',NULL,'ABONITO','N/A',68,'2023-05-25','2023-06-07',13,13000,'TRANSMITTED',0,'2023-06-22 06:12:34','2023-06-29 20:18:24'),(68,'9604',4,1,'member','ANGELINA  S.',NULL,'TABILING','9306877805',65,'2023-03-25','2023-03-30',5,5000,'TRANSMITTED',0,'2023-06-22 06:13:32','2023-06-29 20:18:36'),(69,'6798',2,1,'member','ESTELITO S.',NULL,'MILLAN','9103827144',69,'2023-03-21','2023-03-23',2,2000,'TRANSMITTED',0,'2023-06-22 06:15:13','2023-06-29 20:18:49'),(70,'597',16,1,'member','FE',NULL,'APOSTOL','9469244150',65,'2023-03-14','2023-03-16',2,2000,'TRANSMITTED',0,'2023-06-22 06:19:31','2023-06-29 20:19:02'),(71,'8020',7,1,'member','RALPH',NULL,'PEREZ','0936-0671149',57,'2023-03-29','2023-03-31',2,2000,'TRANSMITTED',0,'2023-06-22 06:20:43','2023-06-29 20:19:15'),(72,'3187',9,1,'dependent','PEDRO','D.','DAMAYO','N/A',69,'2023-06-04','2023-06-10',6,1800,'TRANSMITTED',0,'2023-06-22 06:21:35','2023-06-29 20:19:28'),(73,'2182',1,1,'member','DEDIMO C.',NULL,'CABULAO','N/A',74,'2023-03-27','2023-04-01',5,5000,'TRANSMITTED',0,'2023-06-22 06:23:35','2023-06-29 20:21:29'),(74,'1654',6,1,'member','LEO P.',NULL,'BERANDOY','9985928875',67,'2023-06-12','2023-06-15',3,3000,'TRANSMITTED',0,'2023-06-22 06:24:58','2023-06-29 20:21:51'),(75,'5637',1,1,'member','ROLANDO C.',NULL,'LABUGA','9485245303',70,'2023-03-27','2023-04-01',5,5000,'TRANSMITTED',0,'2023-06-22 06:25:29','2023-06-29 20:22:05'),(76,'10196',20,1,'member','AURORA P.',NULL,'UY','N',73,'2023-03-25','2023-03-28',3,3000,'TRANSMITTED',0,'2023-06-22 06:28:42','2023-06-29 20:22:18'),(77,'10196',20,1,'member','AURORA P.',NULL,'UY','N',73,'2022-11-03','2022-11-07',4,4000,'TRANSMITTED',0,'2023-06-22 06:35:52','2023-06-29 20:22:30'),(78,'6078',4,1,'dependent','APOLLO','T.','LLIDO SR.','N/A',75,'2023-03-25','2023-03-30',5,1500,'TRANSMITTED',0,'2023-06-22 06:36:43','2023-06-29 20:22:41'),(79,'3320',6,1,'dependent','NEAL','E.','LIGTAS','N/A',46,'2023-06-09','2023-06-12',3,900,'TRANSMITTED',0,'2023-06-22 06:40:24','2023-06-29 20:22:55'),(80,'2270',7,1,'member','JEANEFIL C.',NULL,'BERNALES','9155524891',47,'2023-06-08','2023-06-13',5,5000,'TRANSMITTED',0,'2023-06-22 06:48:42','2023-06-29 20:23:08'),(81,'4522',4,1,'member','ROLANDO M.',NULL,'FUENTESPINA','9103419457',65,'2023-06-10','2023-06-13',3,3000,'TRANSMITTED',0,'2023-06-22 06:49:59','2023-06-29 20:23:23'),(82,'2679',2,1,'dependent','WENNIE','E.','CATEDRAL','N/A',66,'2023-03-20','2023-03-29',9,2700,'TRANSMITTED',0,'2023-06-22 06:50:37','2023-06-29 20:23:37'),(83,'7792',9,1,'member','RESTITUTO A.',NULL,'PAROJINOG','907849530',83,'2023-06-03','2023-06-08',5,5000,'TRANSMITTED',0,'2023-06-22 06:52:39','2023-06-29 20:23:50'),(84,'6942',2,1,'member','PARALUMAN C.',NULL,'MONTICALBO','9308908791',67,'2023-03-27','2023-04-03',7,7000,'TRANSMITTED',0,'2023-06-22 06:52:51','2023-06-29 20:24:08'),(85,'2571',9,1,'member','LUZ MERLY S.',NULL,'CASIDSID','9284350590',76,'2023-05-31','2023-06-01',1,1000,'TRANSMITTED',0,'2023-06-22 06:54:45','2023-06-29 20:24:22'),(86,'5002',7,1,'member','MARIO C.',NULL,'GORUMBA','9091040853',57,'2023-03-28','2023-03-31',3,3000,'TRANSMITTED',0,'2023-06-22 06:55:47','2023-06-29 20:24:37'),(87,'4102',3,1,'member','AVELINO JR.',NULL,'ESPADA','N/A',77,'2023-06-07','2023-06-13',6,6000,'TRANSMITTED',0,'2023-06-22 06:58:11','2023-06-29 20:24:51'),(88,'3990',21,1,'member','RUPERTO JR. C.',NULL,'ENTUNA','N/A',61,'2023-05-09','2023-05-12',3,3000,'TRANSMITTED',0,'2023-06-22 07:02:39','2023-06-29 20:25:06'),(89,'1759',6,1,'member','JUANITO S.',NULL,'BIANZON','N/A',70,'2023-06-05','2023-06-09',4,4000,'TRANSMITTED',0,'2023-06-22 07:25:32','2023-06-29 20:25:20'),(90,'10972',22,1,'member','DARYLL','BELTIAR','DIEGO','09971989303',65,'2023-04-18','2023-05-08',20,20000,'TRANSMITTED',0,'2023-06-22 07:39:49','2023-06-29 20:25:39'),(91,'5497',6,1,'member','MONSITO S.',NULL,'JOVENES','09468472989-5001957',75,'2023-05-30','2023-06-09',10,10000,'TRANSMITTED',0,'2023-06-22 07:41:17','2023-06-29 20:26:09'),(94,'5727',24,1,'dependent','HONORIO ','P. ','LAMANOSA','N/A',72,'2023-05-15','2023-05-19',4,1200,'TRANSMITTED',0,'2023-06-22 07:56:04','2023-06-29 20:26:23'),(95,'5727',23,1,'dependent','HONORIO','P.','LAMANOSA','N/A',72,'2023-03-22','2023-03-25',3,900,'TRANSMITTED',0,'2023-06-22 08:00:56','2023-06-29 20:26:35'),(96,'5727',23,1,'dependent','HONORIO','P.','LAMANOSA','N/A',72,'2023-04-20','2023-04-28',8,2400,'TRANSMITTED',0,'2023-06-22 08:01:47','2023-06-29 20:26:54'),(97,'8445',16,1,'member','ROMEO G.',NULL,'RAVELO','9094145484',63,'2023-03-08','2023-04-03',26,26000,'TRANSMITTED',0,'2023-06-22 08:05:24','2023-06-29 20:27:09'),(98,'2952',9,1,'member','NOEL  B.',NULL,'CORDOVA','9075411315',58,'2023-03-28','2023-04-01',4,4000,'TRANSMITTED',0,'2023-06-22 08:06:51','2023-06-29 20:27:23'),(99,'2339',4,1,'member','AURELIA  G.',NULL,'CALLAO','9275281547',33,'2023-04-01','2023-04-02',1,1000,'TRANSMITTED',0,'2023-06-22 08:09:25','2023-06-29 20:27:37'),(100,'7954',7,1,'dependent','MARITES','T.','PEPITO','N/A',63,'2023-05-31','2023-06-02',2,600,'TRANSMITTED',0,'2023-06-22 08:09:53','2023-06-29 20:29:54'),(103,'94',4,1,'member','MAE ROSE  A.',NULL,'TONOGBANUA','9099293200',33,'2023-04-01','2023-04-02',1,1000,'TRANSMITTED',0,'2023-06-23 06:55:57','2023-06-29 20:30:16'),(104,'2339',2,1,'member','AURELIA  G.',NULL,'CALLAO','9275281547',72,'2023-04-01','2023-04-04',3,3000,'TRANSMITTED',0,'2023-06-23 06:57:40','2023-06-29 20:30:51'),(105,'2009',2,1,'member','JOSE JR. D.',NULL,'BUNDA','9355882464',67,'2023-04-04','2023-04-08',4,4000,'TRANSMITTED',0,'2023-06-23 06:59:13','2023-06-29 20:31:06'),(106,'918',4,1,'member','BEATA',NULL,'BACO','9465610036',74,'2023-03-30','2023-04-07',8,8000,'TRANSMITTED',0,'2023-06-23 07:03:02','2023-06-29 20:31:20'),(107,'2009',2,1,'member','JOSE JR. D.',NULL,'BUNDA','9355882464',67,'2023-03-29','2023-04-01',3,3000,'TRANSMITTED',0,'2023-06-23 07:04:42','2023-06-29 20:36:56'),(108,'4544',6,1,'dependent','LILIT','G','GABAO','N/A',73,'2023-03-30','2023-04-02',3,900,'TRANSMITTED',0,'2023-06-23 07:06:52','2023-06-29 20:37:15'),(109,'2400',2,1,'member','LUCRECIA  C.',NULL,'CAMORO','9300663527',63,'2023-04-08','2023-04-10',2,2000,'TRANSMITTED',0,'2023-06-23 07:11:16','2023-06-29 20:37:30'),(110,'9465',7,1,'member','MILAGROS M.',NULL,'SUBALDO','9504262336',71,'2023-04-08','2023-04-11',3,3000,'TRANSMITTED',0,'2023-06-23 07:12:37','2023-06-29 20:37:47'),(111,'707',16,1,'member','LUCIA P.',NULL,'ARIAS','9461542563',67,'2023-03-22','2023-03-28',6,6000,'TRANSMITTED',0,'2023-06-23 07:14:40','2023-06-29 20:38:03'),(112,'7403',4,1,'dependent','TERESITA',NULL,'ONG','N/A',65,'2023-03-30','2023-04-03',4,1200,'TRANSMITTED',0,'2023-06-23 07:18:38','2023-06-29 20:38:40'),(113,'7418',4,1,'member','RODEL A.',NULL,'OPENA','N/A',67,'2023-03-26','2023-03-29',3,3000,'TRANSMITTED',0,'2023-06-23 07:20:04','2023-06-29 20:39:05'),(114,'1445',7,1,'member','MA.CORAZON B.',NULL,'BATITANG','N/A',60,'2023-03-27','2023-04-02',6,6000,'TRANSMITTED',0,'2023-06-23 07:25:31','2023-06-29 20:39:20'),(115,'4846',2,1,'member','REBECCA M.',NULL,'GETALADA','9103069672',64,'2023-06-08','2023-06-12',4,4000,'TRANSMITTED',0,'2023-06-23 12:44:28','2023-06-29 20:39:36'),(116,'6863',7,1,'member','EDUARDO C. JR.',NULL,'MONDARES','9102756349',52,'2023-05-30','2023-06-02',3,3000,'TRANSMITTED',0,'2023-06-23 13:00:01','2023-06-29 20:41:00'),(117,'6863',7,1,'member','EDUARDO C. JR.',NULL,'MONDARES','9102756349',52,'2023-05-30','2023-06-02',3,3000,'TRANSMITTED',0,'2023-06-23 13:00:35','2023-06-29 20:41:16'),(118,'5283',9,1,'dependent','JOHN BENEDICT','I.','ROILO','N/A',6,'2023-05-31','2023-06-05',5,1500,'TRANSMITTED',0,'2023-06-23 13:12:48','2023-06-29 20:41:59'),(119,'2630',46,1,'member','ANELIA I.',NULL,'CASTOR','N/A',88,'2023-03-20','2023-03-23',3,3000,'TRANSMITTED',0,'2023-06-24 04:36:54','2023-06-29 20:43:00'),(120,'7701',10,1,'member','EVA M.',NULL,'PANCHO','9488426500',73,'2023-05-25','2023-06-01',7,7000,'TRANSMITTED',0,'2023-06-24 10:11:39','2023-06-29 20:43:29'),(121,'9943',2,1,'member','BENJAMIN R.',NULL,'TIMBANG','0949818698-7',69,'2023-06-03','2023-06-07',4,4000,'TRANSMITTED',0,'2023-06-24 10:22:05','2023-06-29 20:43:45'),(122,'4037',7,1,'member','LEONARDO C.',NULL,'ESCARLAN','0907-856-9161',77,'2023-06-02','2023-06-05',3,3000,'TRANSMITTED',0,'2023-06-24 10:31:31','2023-06-29 20:44:08'),(123,'4037',7,1,'member','LEONARDO C.',NULL,'ESCARLAN','0907-856-9161',77,'2023-06-02','2023-06-05',3,3000,'TRANSMITTED',0,'2023-06-24 10:32:18','2023-06-29 20:44:22'),(124,'4037',7,1,'member','LEONARDO C.',NULL,'ESCARLAN','0907-856-9161',77,'2023-06-02','2023-06-05',3,3000,'TRANSMITTED',0,'2023-06-24 10:32:18','2023-06-29 20:44:37'),(125,'9498',26,1,'member','CARMELINO D.',NULL,'SUICO','9973423300',67,'2023-05-29','2023-06-07',9,9000,'TRANSMITTED',0,'2023-06-24 10:40:48','2023-06-29 20:44:55'),(126,'6096',7,1,'member','MINERVA B.',NULL,'LLOREN','9307247884',77,'2023-05-23','2023-05-29',6,6000,'TRANSMITTED',0,'2023-06-24 10:53:06','2023-06-29 20:45:14'),(127,'6096',7,1,'member','MINERVA B.',NULL,'LLOREN','9307247884',77,'2023-05-23','2023-05-29',6,6000,'TRANSMITTED',0,'2023-06-24 10:53:34','2023-06-29 20:45:37'),(128,'2254',7,1,'member','ALEJANDRO G.',NULL,'CAGAMPANG','N/A',64,'2023-05-31','2023-06-07',7,7000,'TRANSMITTED',0,'2023-06-24 11:01:48','2023-06-29 20:46:01'),(129,'6578',2,1,'dependent','SALIPADA','B.','MAQUILING','N/A',1,'2023-06-01','2023-06-06',5,1500,'TRANSMITTED',0,'2023-06-24 11:09:31','2023-06-29 20:46:19'),(130,'6578',2,1,'dependent','SALIPADA','B.','MAQUILING','N/A',1,'2023-06-01','2023-06-06',5,1500,'TRANSMITTED',0,'2023-06-24 11:10:18','2023-06-29 20:46:35'),(131,'3960',27,1,'dependent','LOLITA ','G.','ENCLOMAR','N/A',64,'2023-06-02','2023-06-06',4,1200,'TRANSMITTED',0,'2023-06-24 11:24:16','2023-06-29 20:46:50'),(132,'8413',9,1,'member','LUCIA  ','S.','RANAN','09066885449',69,'2023-06-03','2023-06-05',2,2000,'TRANSMITTED',0,'2023-06-24 11:39:35','2023-06-29 20:47:06'),(133,'969',7,1,'member','ARMANDO ','B.','BAGSICAN','09473482137',69,'2023-05-26','2023-06-06',11,11000,'TRANSMITTED',0,'2023-06-24 11:56:23','2023-06-29 20:47:23'),(134,'2630',46,1,'member','ANELIA I.',NULL,'CASTOR','N/A',88,'2023-03-20','2023-03-23',3,3000,'TRANSMITTED',0,'2023-06-25 04:37:43','2023-06-29 20:49:34'),(135,'4840',7,1,'dependent','LANGER',NULL,'GERMUDO','N/A',15,'2023-03-30','2023-04-04',5,1500,'TRANSMITTED',0,'2023-06-25 15:34:13','2023-06-29 20:50:22'),(137,'5101',9,1,'member','ALICIA M.',NULL,'GULLE','9501582061',69,'2023-04-04','2023-04-06',2,2000,'TRANSMITTED',0,'2023-06-25 15:36:35','2023-06-29 20:51:46'),(138,'2020',42,1,'member','EMMA B.',NULL,'BURGOS','9268376883',75,'2023-03-19','2023-03-23',4,4000,'TRANSMITTED',0,'2023-06-25 15:40:44','2023-06-29 20:52:04'),(139,'3054',7,1,'member','NENITA C.',NULL,'CUNA','N/A',69,'2023-04-02','2023-04-07',5,5000,'TRANSMITTED',0,'2023-06-25 15:41:43','2023-06-29 20:57:44'),(140,'4390',2,1,'member','HENRIQUITO M.',NULL,'FERROLINO','9302912319',64,'2023-03-24','2023-03-30',6,6000,'TRANSMITTED',0,'2023-06-25 15:42:43','2023-07-02 11:35:01'),(141,'4389',2,1,'dependent','HENRIQUITO M.',NULL,'FERROLINO','N/A',64,'2023-03-24','2023-03-25',1,300,'TRANSMITTED',0,'2023-06-25 15:44:25','2023-07-02 11:35:25'),(142,'6123',4,1,'dependent','ZENAIDA',NULL,'LONGAY','N/A',69,'2023-04-02','2023-04-05',3,900,'TRANSMITTED',0,'2023-06-25 15:45:40','2023-07-02 11:36:32'),(143,'1938',7,1,'member','CEAZAR B.',NULL,'BRUTO','9354107020',89,'2023-04-02','2023-04-05',3,3000,'TRANSMITTED',0,'2023-06-25 16:03:07','2023-07-02 11:36:45'),(144,'678',4,1,'member','ROWENA  P.',NULL,'ARCE','9151499342',52,'2023-04-05','2023-04-07',2,2000,'TRANSMITTED',0,'2023-06-25 16:05:01','2023-07-02 11:36:58'),(145,'7774',6,1,'member','PREDISVINDA A.',NULL,'PARDO','9175087886',73,'2023-04-05','2023-04-08',3,3000,'TRANSMITTED',0,'2023-06-25 16:06:39','2023-07-02 11:37:21'),(146,'5755',7,1,'member','RONALD',NULL,'LAMPARAS','9667030774',44,'2023-04-09','2023-04-12',3,3000,'TRANSMITTED',0,'2023-06-25 16:08:11','2023-07-02 11:37:35'),(147,'10576',7,1,'member','ZABRINA  Z.',NULL,'ALCOSEBA','9468911831',45,'2023-04-04','2023-04-08',4,4000,'TRANSMITTED',0,'2023-06-25 16:09:58','2023-07-02 11:37:50'),(148,'2340',47,1,'member','JASMIN R.',NULL,'CALLAO','09351841359',79,'2023-03-29','2023-03-31',2,2000,'TRANSMITTED',1,'2023-06-25 16:16:07','2023-07-02 11:38:30'),(149,'628',2,1,'dependent','ARNEL',NULL,'ARAIZA','N/A',17,'2023-04-02','2023-04-06',4,1200,'TRANSMITTED',0,'2023-06-25 16:20:43','2023-07-02 11:39:49'),(150,'360',9,1,'member','MARIA S.',NULL,'ALMODIEL','9973507305',64,'2023-03-30','2023-04-05',6,6000,'TRANSMITTED',0,'2023-06-25 16:22:49','2023-07-02 11:40:09'),(151,'9192',29,1,'member','BELLA U.',NULL,'SESDUYRO','9109164106',66,'2023-03-29','2023-04-04',6,6000,'TRANSMITTED',0,'2023-06-25 16:23:49','2023-07-02 11:40:24'),(152,'7370',7,1,'dependent','VICENTE',NULL,'OLIVEROS','N/A',64,'2023-03-28','2023-04-01',4,1200,'TRANSMITTED',0,'2023-06-25 16:25:13','2023-07-02 13:21:48'),(153,'3959',27,2,'member','LOLITA G.',NULL,'ENCLONAR','9102790993',64,'2023-06-02','2023-06-06',4,4000,'TRANSMITTED',0,'2023-06-26 02:25:41','2023-07-02 13:21:56'),(154,'6436',4,2,'dependent','LORETO','A.','MAMAC','N/A',75,'2023-06-02','2023-06-06',4,1200,'TRANSMITTED',0,'2023-06-26 02:26:42','2023-07-02 13:22:32'),(155,'6435',4,2,'member','LORETO ','A.','MAMAC','9460996512/9127296718',75,'2023-06-02','2023-06-06',4,4000,'TRANSMITTED',0,'2023-06-26 02:27:46','2023-07-02 13:23:05'),(156,'6272',35,2,'dependent','AURORA',NULL,'MACASERO','N/A',63,'2023-03-24','2023-03-28',4,1200,'TRANSMITTED',0,'2023-06-26 02:40:06','2023-07-02 13:23:47'),(157,'3299',9,2,'dependent','LEONORA','N.','DE ASIS','N/A',73,'2023-05-26','2023-06-01',6,1800,'TRANSMITTED',0,'2023-06-26 02:47:15','2023-07-02 13:25:22'),(158,'9055',28,2,'member','ELGIE O.',NULL,'SARINO','N/A',60,'2023-05-31','2023-06-06',6,6000,'TRANSMITTED',0,'2023-06-26 02:48:27','2023-07-02 13:25:31'),(159,'3298',4,2,'member','MAGDALENA C.',NULL,'DE ASIS','N/A',65,'2023-05-31','2023-06-05',5,5000,'TRANSMITTED',0,'2023-06-26 02:49:37','2023-07-02 13:25:57'),(160,'962',2,2,'member','DIONISIO F.',NULL,'BAGATUA','9453143527',70,'2023-04-07','2023-04-11',4,4000,'TRANSMITTED',0,'2023-06-26 02:51:40','2023-07-02 13:26:14'),(161,'8218',4,2,'dependent','ERLINDA','D.','PREMAYLON','N/A',74,'2023-05-30','2023-06-02',3,900,'TRANSMITTED',0,'2023-06-26 02:53:11','2023-07-02 13:26:24'),(162,'8217',4,2,'member','ERLINDA D.',NULL,'PREMAYLON','094639554-30',74,'2023-05-30','2023-06-02',3,3000,'TRANSMITTED',0,'2023-06-26 02:54:18','2023-07-02 13:26:51'),(163,'1259',7,2,'member','ROGELIO N.',NULL,'BARLAS','9072894823',73,'2023-05-29','2023-06-05',7,7000,'TRANSMITTED',0,'2023-06-26 02:55:05','2023-07-02 13:27:02'),(164,'5341',42,2,'dependent','RISALINO',NULL,'IWAG','N/A',67,'2023-03-08','2023-03-13',5,1500,'TRANSMITTED',0,'2023-06-26 02:55:34','2023-07-02 13:27:12'),(165,'2679',10,2,'member','FLORITA B.',NULL,'CATEDRAL','9187385341',67,'2023-05-21','2023-06-02',12,12000,'TRANSMITTED',0,'2023-06-26 02:56:20','2023-07-02 13:27:29'),(166,'8937',16,2,'dependent','ROSA','B.','SAMBRANO','N/A',72,'2023-04-07','2023-04-18',11,3300,'TRANSMITTED',0,'2023-06-26 02:57:37','2023-07-02 13:27:39'),(167,'2071',7,2,'member','CHERYL D.',NULL,'CABAHUG','9093922906',45,'2023-03-23','2023-03-28',5,5000,'TRANSMITTED',0,'2023-06-26 02:57:45','2023-07-02 13:27:51'),(168,'8938',16,2,'member','ROSA ','BENDOL','SAMBRANO','09175395920',72,'2023-04-07','2023-04-18',11,11000,'TRANSMITTED',0,'2023-06-26 02:58:28','2023-07-02 13:28:02'),(169,'5062',6,2,'member','LUCIANO V.',NULL,'GUIBELONDO','N/A',90,'2023-05-20','2023-06-01',12,12000,'TRANSMITTED',0,'2023-06-26 03:00:06','2023-07-02 13:28:19'),(170,'2873',7,2,'dependent','ELIZABETH','C.','COLLADO','N/A',62,'2023-05-27','2023-06-01',5,1500,'TRANSMITTED',0,'2023-06-26 03:01:05','2023-07-02 13:28:31'),(171,'7387',2,2,'member','JANE  O.',NULL,'VALIENTE','N/A',35,'2023-05-26','2023-06-02',7,7000,'TRANSMITTED',0,'2023-06-26 03:02:14','2023-07-02 13:28:42'),(172,'5061',4,2,'member','PURISIMA S.',NULL,'GUGMAYA','9068156002',69,'2023-06-03','2023-06-06',3,3000,'TRANSMITTED',0,'2023-06-26 03:15:09','2023-07-02 13:28:53'),(173,'8197',29,2,'member','FELISA P.',NULL,'PORPETCHO','N/A',65,'2023-06-02','2023-06-05',3,3000,'TRANSMITTED',0,'2023-06-26 03:16:19','2023-07-02 13:29:03'),(174,'9659',2,2,'member','APOLINARIO C.',NULL,'TADEM','N/A',80,'2023-05-30','2023-06-02',3,3000,'TRANSMITTED',0,'2023-06-26 03:17:17','2023-07-02 13:29:15'),(175,'10225',2,2,'member','ANGELITA  C.',NULL,'VALDEZ','9518284553',66,'2023-05-30','2023-06-02',3,3000,'TRANSMITTED',0,'2023-06-26 03:19:37','2023-07-02 13:29:25'),(176,'9419',6,2,'member','TERESA S.',NULL,'SORIEL','9363333934',82,'2023-05-31','2023-06-02',2,2000,'TRANSMITTED',0,'2023-06-26 03:20:26','2023-07-02 13:29:37'),(177,'6945',30,2,'member','ANTONIO G.',NULL,'MONTILLANO','9755418990',66,'2023-05-30','2023-06-01',2,2000,'TRANSMITTED',0,'2023-06-26 03:21:13','2023-07-02 13:29:52'),(178,'5875',2,2,'member','CERINA B.',NULL,'LECHAGO','9273498288',86,'2023-05-30','2023-06-05',6,6000,'TRANSMITTED',0,'2023-06-26 03:28:20','2023-07-02 13:30:02'),(179,'10526',6,2,'dependent','WILFREDO','A.','YGOT','N/A',63,'2023-05-27','2023-06-01',5,1500,'TRANSMITTED',0,'2023-06-26 03:29:21','2023-07-02 13:31:19'),(180,'10529',6,2,'member','WILFREDO SR. A.',NULL,'YGOT','9265489166',63,'2023-05-31','2023-06-01',1,1000,'TRANSMITTED',0,'2023-06-26 03:32:55','2023-07-02 13:31:37'),(181,'4037',7,2,'member','LEONARDO C.',NULL,'ESCARLAN','09302258098',77,'2023-05-24','2023-05-29',5,5000,'TRANSMITTED',0,'2023-06-26 03:34:07','2023-07-02 13:31:50'),(182,'10467',10,2,'dependent','REYNALDO','','VISTAVILLA','N',65,'2023-03-01','2023-03-04',3,900,'TRANSMITTED',0,'2023-06-26 03:37:51','2023-07-02 13:32:03'),(183,'8242',2,2,'member','URSULA  L.',NULL,'PUDADERA','9104299274',73,'2023-05-24','2023-05-27',3,3000,'TRANSMITTED',0,'2023-06-26 03:39:14','2023-07-02 13:32:24'),(184,'9177',4,2,'member','NATIVIDAD B.',NULL,'SERRA','9753290819',85,'2023-05-30','2023-06-02',3,3000,'TRANSMITTED',0,'2023-06-26 03:40:16','2023-07-02 13:32:35'),(185,'5002',6,2,'member','MARIO C.',NULL,'GORUMBA','9091040853',57,'2023-05-25','2023-06-01',7,7000,'TRANSMITTED',0,'2023-06-26 03:40:59','2023-07-02 13:32:47'),(186,'7204',2,2,'member','PEPITO ','LACHICA','NOBLEZA','09485248667',74,'2023-05-26','2023-05-31',5,5000,'TRANSMITTED',0,'2023-06-26 03:43:04','2023-07-02 13:32:57'),(187,'5153',7,2,'member','HENDRILI M.',NULL,'HALLARSIS','9851533097',69,'2023-05-23','2023-05-29',6,6000,'TRANSMITTED',0,'2023-06-26 03:45:07','2023-07-02 13:33:08'),(188,'2659',31,2,'member','CELIA V.',NULL,'CATALAN','9097446810',72,'2023-03-24','2023-03-25',1,1000,'TRANSMITTED',0,'2023-06-26 03:46:14','2023-07-02 13:33:18'),(189,'3244',9,2,'member','EVELYN C.',NULL,'DASALLA','9469150213',64,'2023-05-25','2023-05-29',4,4000,'TRANSMITTED',0,'2023-06-26 03:47:12','2023-07-02 13:34:31'),(190,'5497',7,2,'member','MONSITO S.',NULL,'JOVENES','09468472989-5001957',75,'2023-05-29','2023-05-30',1,1000,'TRANSMITTED',0,'2023-06-26 03:52:28','2023-07-02 13:34:46'),(191,'7743',7,2,'member','ZAMIDA',NULL,'PANTORILLA','9484446946/09553491841',39,'2023-05-28','2023-05-31',3,3000,'TRANSMITTED',0,'2023-06-26 03:53:48','2023-07-02 13:34:55'),(192,'1922',7,2,'member','AILEEN  B.',NULL,'TUMBAGAHAN','N/A',34,'2023-05-26','2023-05-29',3,3000,'TRANSMITTED',0,'2023-06-26 03:54:48','2023-07-02 13:35:08'),(193,'2354',7,2,'member','RAMON M.',NULL,'CALUBAD','N/A',1,'2023-05-27','2023-05-30',3,3000,'TRANSMITTED',0,'2023-06-26 03:55:40','2023-07-02 13:35:25'),(194,'1427',2,2,'member','TOMASA G.',NULL,'BATIANCILA','9772750979',78,'2023-05-28','2023-05-30',2,2000,'TRANSMITTED',0,'2023-06-26 03:58:50','2023-07-02 13:35:36'),(195,'8079',7,2,'member','ROSITA D.',NULL,'PIELAGO','9467453430',73,'2023-05-26','2023-05-30',4,4000,'TRANSMITTED',0,'2023-06-26 04:00:39','2023-07-02 13:35:48'),(196,'3104',9,2,'member','EDITHA S.',NULL,'DACIA','9398035133',74,'2023-05-24','2023-05-29',5,5000,'TRANSMITTED',0,'2023-06-26 04:13:11','2023-07-02 13:36:03'),(197,'6467',4,2,'member','PORFERIO A.',NULL,'MANCAO','9381139146',74,'2023-05-25','2023-06-01',7,7000,'TRANSMITTED',0,'2023-06-26 04:14:21','2023-07-02 13:36:13'),(198,'5709',10,2,'dependent','ARLITA','V.','LAGRADILLA','N/A',75,'2023-05-23','2023-05-31',8,2400,'TRANSMITTED',0,'2023-06-26 04:16:13','2023-07-02 13:36:24'),(199,'5708',10,2,'member','ARLITA',NULL,'LAGRADILLA','9204690720',75,'2023-05-23','2023-05-31',8,8000,'TRANSMITTED',0,'2023-06-26 04:16:42','2023-07-02 13:38:40'),(200,'3952',2,2,'dependent','ANDREASA','A','EMPAS','9094180961',66,'2023-05-22','2023-05-30',8,2400,'TRANSMITTED',0,'2023-06-26 04:19:23','2023-07-02 13:39:04'),(201,'10529',9,2,'member','WILFREDO SR. A.',NULL,'YGOT','9265489166',72,'2023-05-27','2023-06-01',5,5000,'TRANSMITTED',0,'2023-06-26 04:20:27','2023-07-02 13:39:27'),(202,'8407',3,2,'member','SIMPLICIA M.',NULL,'RAMOS','9610735124',72,'2023-05-25','2023-05-29',4,4000,'TRANSMITTED',0,'2023-06-26 04:21:31','2023-07-02 13:39:39'),(203,'2690',9,2,'member','EDITHA B.',NULL,'CATIMBANG','N/A',64,'2023-05-22','2023-05-25',3,3000,'TRANSMITTED',0,'2023-06-26 04:22:15','2023-07-02 13:39:50'),(204,'4320',42,2,'member','PAZ C.',NULL,'FELISILDA','N/A',68,'2023-05-23','2023-05-26',3,3000,'TRANSMITTED',0,'2023-06-26 04:52:51','2023-07-02 13:40:03'),(205,'339',7,2,'member','ALVIN B.',NULL,'ALINSUGAY','N/A',54,'2023-05-25','2023-05-28',3,3000,'TRANSMITTED',0,'2023-06-26 04:53:42','2023-07-02 13:40:15'),(206,'8950',9,2,'dependent','DOMINGO','C.','SAMPIANO JR.','N/A',54,'2023-05-22','2023-05-26',4,1200,'TRANSMITTED',0,'2023-06-26 04:55:22','2023-07-02 13:40:25'),(207,'597',16,2,'member','FE',NULL,'APOSTOL','9469244150',65,'2023-05-16','2023-05-22',6,6000,'TRANSMITTED',0,'2023-06-26 04:56:31','2023-07-02 13:40:36'),(208,'1427',7,2,'member','TOMASA G.',NULL,'BATIANCILA','9772750979',78,'2023-05-17','2023-05-21',4,4000,'TRANSMITTED',0,'2023-06-26 04:57:09','2023-07-02 13:40:47'),(209,'3614',7,2,'dependent','EDGAR','B.','DIAZ','9260217724',63,'2023-05-20','2023-05-26',6,1800,'TRANSMITTED',0,'2023-06-26 04:59:41','2023-07-02 13:42:00'),(210,'3613',2,2,'member','EDGAR ','BRAGA','DIAZ','09176417934',63,'2023-05-20','2023-05-26',6,6000,'TRANSMITTED',0,'2023-06-26 05:22:08','2023-07-02 13:42:11'),(211,'6861',26,2,'member','LAUREANO I.',NULL,'MONATO','9519416109',70,'2023-05-19','2023-05-26',7,7000,'TRANSMITTED',0,'2023-06-26 05:23:21','2023-07-02 13:42:25'),(212,'2855',26,2,'member','BENNY',NULL,'COBRADO','9072160667',81,'2023-05-22','2023-05-27',5,5000,'TRANSMITTED',0,'2023-06-26 05:24:13','2023-07-02 13:42:39'),(213,'1252',4,2,'member','JANE',NULL,'BARDA','9120136388',64,'2023-06-24','2023-06-26',2,2000,'TRANSMITTED',0,'2023-06-26 05:25:15','2023-07-02 13:42:50'),(214,'2952',6,2,'member','NOEL  B.',NULL,'CORDOVA','9075411315',58,'2023-06-22','2023-06-26',4,4000,'TRANSMITTED',0,'2023-06-26 05:26:32','2023-07-02 13:43:01'),(215,'4525',2,2,'member','GLORENA T.',NULL,'FUERTES','N/A',58,'2023-05-22','2023-05-26',4,4000,'TRANSMITTED',0,'2023-06-26 05:31:31','2023-07-02 13:43:11'),(216,'1777',3,2,'member','MARY JANE  ','BAYANI','PETINES','09196898421',52,'2023-05-20','2023-05-23',3,3000,'TRANSMITTED',0,'2023-06-26 05:32:14','2023-07-02 13:43:23'),(217,'10333',16,2,'member','TRINIDAD N.',NULL,'VILLA','9462957213',73,'2023-04-04','2023-04-09',5,5000,'TRANSMITTED',0,'2023-06-26 05:43:00','2023-07-02 13:43:34'),(218,'4289',6,2,'member','MILAGROS A.',NULL,'FALLER','9099519505',74,'2023-05-05','2023-05-23',18,18000,'TRANSMITTED',0,'2023-06-26 05:44:22','2023-07-02 13:43:44'),(219,'3819',37,2,'member','JOSE B.',NULL,'DULA','9307753125',69,'2023-03-31','2023-04-13',13,13000,'TRANSMITTED',0,'2023-06-26 05:44:51','2023-07-02 14:02:58'),(221,'3375',16,2,'member','FRANCISCO B.',NULL,'DELA CRUZ','9078029194',70,'2023-05-09','2023-05-16',7,7000,'TRANSMITTED',0,'2023-06-26 05:46:24','2023-07-02 14:03:09'),(223,'4544',7,2,'member','JUAN B.',NULL,'GABAO','9367619091',73,'2023-05-21','2023-05-25',4,4000,'TRANSMITTED',0,'2023-06-26 05:49:42','2023-07-02 14:03:22'),(224,'2407',2,2,'dependent','RHENZ','S.','CAMPOMANES','N/A',18,'2023-05-14','2023-05-19',5,1500,'TRANSMITTED',0,'2023-06-26 05:50:50','2023-07-02 14:03:34'),(225,'7755',2,2,'member','ALFREDO JR.',NULL,'PARAGSA','9129915661',44,'2023-05-22','2023-05-25',3,3000,'TRANSMITTED',0,'2023-06-26 05:51:31','2023-07-02 14:03:52'),(226,'27',2,2,'member','ALEJANDRO B.',NULL,'ABALLE','N/A',69,'2023-05-21','2023-05-24',3,3000,'TRANSMITTED',0,'2023-06-26 05:52:30','2023-07-02 14:04:05'),(228,'8558',7,2,'member','ESTEBAN L.',NULL,'RIVAMONTE','9496387179',72,'2023-05-19','2023-05-22',3,3000,'TRANSMITTED',0,'2023-06-26 05:56:17','2023-07-02 14:04:17'),(229,'8148',7,2,'member','ALEJANDRO SR. R.',NULL,'POLICARPIO','9480089511',80,'2023-05-19','2023-05-23',4,4000,'TRANSMITTED',0,'2023-06-26 05:57:55','2023-07-02 14:04:31'),(230,'712',33,2,'member','RODOLFO C.',NULL,'ARILLO','N/A',79,'2023-05-07','2023-05-22',15,15000,'TRANSMITTED',0,'2023-06-26 05:59:00','2023-07-02 14:04:43'),(231,'2887',9,2,'dependent','SOFRONIO ','A.','FELISILDA','N/A',70,'2023-02-09','2023-02-15',6,1800,'TRANSMITTED',0,'2023-06-26 06:00:50','2023-07-02 14:04:53'),(232,'1146',3,2,'dependent','ERNA',NULL,'BALONES','N/A',64,'2023-02-11','2023-02-15',4,1200,'TRANSMITTED',0,'2023-06-26 06:01:44','2023-07-02 14:05:07'),(233,'7501',1,2,'dependent','MERLINDA','S.','OSANO','N/A',66,'2023-05-17','2023-05-22',5,1500,'TRANSMITTED',0,'2023-06-26 06:05:53','2023-07-02 14:05:33'),(234,'9464',7,2,'member','CLAIRE  M.',NULL,'SUBALDO','9504262336',70,'2023-05-19','2023-05-22',3,3000,'TRANSMITTED',0,'2023-06-26 06:06:38','2023-07-02 14:05:52'),(235,'3976',16,2,'member','FAUSTINO T.',NULL,'ENERIO','9094544350',57,'2023-03-31','2023-04-03',3,3000,'TRANSMITTED',0,'2023-06-26 06:07:55','2023-07-02 14:06:05'),(236,'9675',16,2,'dependent','JULIETA','I.','TAHIL','N/A',73,'2023-04-07','2023-04-21',14,4200,'TRANSMITTED',0,'2023-06-26 06:10:53','2023-07-02 14:06:48'),(237,'8568',3,2,'member','ADELA C.','CUAJOTOR','ROBLE','09075210249',68,'2023-03-17','2023-04-12',26,26000,'TRANSMITTED',0,'2023-06-26 06:11:11','2023-07-02 14:07:06'),(238,'6079',7,2,'member','MA. BELLY B.',NULL,'LLIDO','9196727850',73,'2023-05-15','2023-05-22',7,7000,'TRANSMITTED',0,'2023-06-26 06:12:29','2023-07-02 14:07:20'),(239,'4829',9,2,'member','NENA A.',NULL,'GENOSAS','0907-2959-812',72,'2023-05-14','2023-05-22',8,8000,'TRANSMITTED',0,'2023-06-26 06:13:08','2023-07-02 14:07:33'),(240,'1957',7,2,'dependent','EDGAR','D.','BUCIO','N/A',66,'2023-05-10','2023-05-15',5,1500,'TRANSMITTED',0,'2023-06-26 06:14:39','2023-07-02 14:08:13'),(241,'6272',35,2,'dependent','AURORA','A.','MACASERO','N/A',64,'2023-04-20','2023-04-28',8,2400,'TRANSMITTED',0,'2023-06-26 06:19:00','2023-07-02 14:08:30'),(242,'9977',7,2,'member','REYNALDO A.',NULL,'TUGAY','9638279062',56,'2023-05-07','2023-05-12',5,5000,'TRANSMITTED',0,'2023-06-26 06:20:53','2023-07-02 14:08:47'),(243,'4037',7,2,'member','LEONARDO C.',NULL,'ESCARLAN','0907-856-9161',77,'2023-05-16','2023-05-19',3,3000,'TRANSMITTED',0,'2023-06-26 06:22:19','2023-07-02 14:09:14'),(244,'5513',4,2,'member','ERLINDA D.',NULL,'JUGAR','9608190545',67,'2023-05-20','2023-05-22',2,2000,'TRANSMITTED',0,'2023-06-26 06:23:42','2023-07-02 14:09:35'),(245,'9684',36,2,'member','JULIAN S.',NULL,'TAJALA','N/A',69,'2023-04-16','2023-04-21',5,5000,'TRANSMITTED',0,'2023-06-26 06:25:59','2023-07-02 14:09:51'),(246,'9561',7,2,'member','MEDY  B.',NULL,'SUPERIORIDAD','9462649123',64,'2023-05-14','2023-05-18',4,4000,'TRANSMITTED',0,'2023-06-26 06:28:20','2023-07-02 14:10:07'),(247,'8702',37,2,'dependent','GEMMA','A.','RUFO','N',58,'2023-05-15','2023-05-18',3,900,'TRANSMITTED',0,'2023-06-26 06:31:00','2023-07-02 14:10:19'),(248,'7952',6,2,'member','BILLY S.',NULL,'PEPITO','N/A',64,'2023-05-08','2023-05-12',4,4000,'TRANSMITTED',0,'2023-06-26 06:33:45','2023-07-02 14:10:32'),(249,'2873',7,2,'dependent','ELIZABETH','C.','COLLADO','N/A',62,'2023-05-13','2023-05-17',4,1200,'TRANSMITTED',0,'2023-06-26 06:36:46','2023-07-02 14:10:46'),(250,'2472',29,2,'member','MARCELINO F.',NULL,'CAPORAL','N/A',71,'2023-05-10','2023-05-13',3,3000,'TRANSMITTED',0,'2023-06-26 06:37:33','2023-07-02 14:10:58'),(251,'3578',2,2,'member','LORNA U.',NULL,'DESUYO','N/A',61,'2023-05-16','2023-05-19',3,3000,'TRANSMITTED',0,'2023-06-26 07:02:12','2023-07-02 14:11:12'),(252,'3928',7,2,'dependent','REY','C.','ELIGINO','N/A',65,'2023-05-01','2023-05-12',11,3300,'TRANSMITTED',0,'2023-06-26 07:03:31','2023-07-02 14:11:34'),(253,'8356',2,2,'member','JUSTINA B.',NULL,'RAMIL','0930-6857723',66,'2023-05-15','2023-05-18',3,3000,'TRANSMITTED',0,'2023-06-26 07:05:11','2023-07-02 14:11:51'),(254,'10466',4,2,'member','MARIANO A.',NULL,'VISITAS','9755719294',75,'2023-05-16','2023-05-18',2,2000,'TRANSMITTED',0,'2023-06-26 07:05:53','2023-07-02 14:12:03'),(255,'9455',7,2,'member','ROBERTO V.',NULL,'SUAT','N/A',64,'2023-05-04','2023-05-07',3,3000,'TRANSMITTED',0,'2023-06-26 07:07:17','2023-07-02 14:12:22'),(257,'2686',7,2,'dependent','RUBEN','E.','CATEDRILLA','N/A',71,'2023-05-05','2023-05-08',3,900,'TRANSMITTED',0,'2023-06-26 07:10:49','2023-07-02 14:12:36'),(258,'2689',7,2,'member','RUBEN E.',NULL,'CATEDRILLA','9286588021',71,'2023-05-05','2023-05-08',3,3000,'TRANSMITTED',0,'2023-06-26 07:11:26','2023-07-02 14:12:50'),(259,'3027',4,2,'member','ANGELITA C.',NULL,'CUEVAS','9075914185',68,'2023-05-12','2023-05-15',3,3000,'TRANSMITTED',0,'2023-06-26 07:12:08','2023-07-02 14:13:03'),(260,'8719',2,2,'member','JUDITH',NULL,'RUTA','9304721729',64,'2023-05-12','2023-05-14',2,2000,'TRANSMITTED',0,'2023-06-26 07:12:50','2023-07-02 14:13:20'),(261,'8250',7,2,'member','LEONORA',NULL,'PUEBLA-ESCOBER','9098868211',52,'2023-05-12','2023-05-16',4,4000,'TRANSMITTED',0,'2023-06-26 07:15:12','2023-07-02 14:14:48'),(262,'8893',38,2,'member','ALMA SALES',NULL,'TUPAS','9997165289',46,'2023-05-02','2023-05-05',3,3000,'TRANSMITTED',0,'2023-06-26 07:15:51','2023-07-02 14:15:03'),(263,'1958',7,2,'member','EDGAR D.',NULL,'BUCIO','9099348817',66,'2023-05-10','2023-05-15',5,5000,'TRANSMITTED',0,'2023-06-26 07:16:46','2023-07-02 14:15:38'),(264,'8454',10,2,'member','VICENTE JR. J.',NULL,'REAL','09751950534/09192896086',69,'2023-04-27','2023-05-04',7,7000,'TRANSMITTED',0,'2023-06-26 07:17:58','2023-07-02 14:17:46'),(265,'9041',4,2,'member','FLORIE O.',NULL,'SARASA','N/A',61,'2023-05-11','2023-05-16',5,5000,'TRANSMITTED',0,'2023-06-26 07:18:44','2023-07-02 14:18:05'),(266,'3578',2,2,'member','LORNA U.',NULL,'DESUYO','N/A',61,'2023-05-14','2023-05-16',2,2000,'TRANSMITTED',0,'2023-06-26 07:19:53','2023-07-02 14:18:24'),(267,'6284',9,2,'member','PAQUITO P.',NULL,'MACION','9121926006',70,'2023-05-08','2023-05-12',4,4000,'TRANSMITTED',0,'2023-06-26 07:20:52','2023-07-02 14:18:45'),(268,'7439',6,2,'member','BILLY JEAN  O.',NULL,'SOQUITA','N/A',34,'2023-05-03','2023-05-12',9,9000,'TRANSMITTED',0,'2023-06-26 07:22:01','2023-07-02 14:19:06'),(269,'7240',2,2,'member','GUILLERMA B.',NULL,'NORCOS','9127487311',61,'2023-05-11','2023-05-15',4,4000,'TRANSMITTED',0,'2023-06-26 07:23:06','2023-07-02 14:19:24'),(270,'9746',2,2,'member','VICTORIA A.',NULL,'TAMOO','N/A',74,'2023-05-08','2023-05-15',7,7000,'TRANSMITTED',0,'2023-06-26 07:24:52','2023-07-02 14:19:43'),(271,'9764',2,2,'member','CANDELARIA T.',NULL,'TANATE','N/A',69,'2023-05-12','2023-05-15',3,3000,'TRANSMITTED',0,'2023-06-26 07:25:39','2023-07-02 14:20:00'),(272,'7878',10,2,'member','BELINDA L.',NULL,'PEDREGOSA','N/A',73,'2023-04-26','2023-05-05',9,9000,'TRANSMITTED',0,'2023-06-26 07:26:35','2023-07-02 14:20:18'),(273,'4872',7,2,'member','ELENA O.',NULL,'GIGANTE','9103442842',69,'2023-05-11','2023-05-15',4,4000,'TRANSMITTED',0,'2023-06-26 07:28:06','2023-07-02 14:24:42'),(274,'3114',29,2,'member','CYNTHIA',NULL,'DACUDAG','N/A',72,'2023-05-08','2023-05-11',3,3000,'TRANSMITTED',0,'2023-06-26 07:32:23','2023-07-02 14:25:12'),(275,'4481',7,2,'member','CRISPINA',NULL,'FRANCISCO','9489030968',66,'2023-05-09','2023-05-13',4,4000,'TRANSMITTED',0,'2023-06-26 07:33:42','2023-07-02 14:25:31'),(276,'5083',39,2,'member','RITCHEL  ','G.','PABLEO','09631251725',40,'2023-05-07','2023-05-10',3,3000,'TRANSMITTED',0,'2023-06-26 07:36:13','2023-07-02 14:27:59'),(277,'8563',7,2,'dependent','LEVITA','C.','RIVERA','N/A',69,'2023-05-07','2023-05-10',3,900,'TRANSMITTED',0,'2023-06-26 07:38:28','2023-07-02 14:28:29'),(278,'6147',9,2,'member','CARMELITA B.',NULL,'LORENTE','9260881017',69,'2023-04-19','2023-04-21',2,2000,'TRANSMITTED',0,'2023-06-26 07:40:44','2023-07-02 14:28:41'),(279,'1208',40,2,'member','PAULINA B.',NULL,'BANSALE','N/A',73,'2023-05-02','2023-05-06',4,4000,'TRANSMITTED',0,'2023-06-26 07:41:53','2023-07-02 14:28:55'),(280,'1208',40,2,'member','PAULINA B.',NULL,'BANSALE','N/A',73,'2023-04-19','2023-04-21',2,2000,'TRANSMITTED',0,'2023-06-26 07:42:44','2023-07-02 14:29:04'),(281,'540',2,2,'member','EMMA C.',NULL,'ANISCO','9264995064',70,'2023-05-05','2023-05-10',5,5000,'TRANSMITTED',0,'2023-06-26 07:45:34','2023-07-02 14:29:13'),(282,'7038',4,2,'member','THELMA L.',NULL,'MUTIA','N/A',75,'2023-05-05','2023-05-09',4,4000,'TRANSMITTED',0,'2023-06-26 07:46:30','2023-07-02 14:29:21'),(283,'1817',49,2,'member','SOFIA B.',NULL,'BLANDO','9056269447',72,'2023-05-08','2023-05-12',4,4000,'TRANSMITTED',0,'2023-06-26 07:52:08','2023-07-02 14:51:46'),(284,'8235',38,2,'member','LUZ C.',NULL,'PRUDENTE','9089704633',64,'2023-04-18','2023-04-24',6,6000,'TRANSMITTED',0,'2023-06-26 07:53:16','2023-07-02 14:52:02'),(285,'6735',9,2,'member','HERMILINA A.',NULL,'MENDEZ','N/A',63,'2023-05-01','2023-05-04',3,3000,'TRANSMITTED',0,'2023-06-26 07:54:29','2023-07-02 14:52:10'),(286,'1680',4,2,'member','ISABEL G.',NULL,'BERLANAS','0955-312-3110',71,'2023-05-06','2023-05-10',4,4000,'TRANSMITTED',0,'2023-06-26 07:56:06','2023-07-02 14:52:20'),(287,'7418',6,2,'member','RODEL A.',NULL,'OPENA','N/A',66,'2023-02-26','2023-02-28',2,2000,'TRANSMITTED',0,'2023-06-26 07:57:09','2023-07-02 14:52:29'),(288,'2791',41,2,'member','NORMA E.',NULL,'CERVO','9063094416',80,'2023-03-12','2023-04-11',30,30000,'TRANSMITTED',0,'2023-06-26 07:58:05','2023-07-02 14:52:37'),(289,'5529',6,2,'member','EUNESIE M.',NULL,'JUMANGIT','N/A',67,'2023-05-07','2023-05-10',3,3000,'TRANSMITTED',0,'2023-06-26 07:59:20','2023-07-02 14:52:46'),(290,'348',7,2,'member','CONRADA A.',NULL,'ALMEYDA','9307763733',70,'2023-05-05','2023-05-08',3,3000,'TRANSMITTED',0,'2023-06-26 08:00:31','2023-07-02 14:52:53'),(291,'4390',2,2,'dependent','FELLY','B.','FERROLINO','N/A',64,'2023-05-07','2023-05-11',4,1200,'TRANSMITTED',0,'2023-06-26 08:01:44','2023-07-02 14:53:17'),(292,'4389',2,2,'member','FELY B.',NULL,'FERROLINO','9121694647',64,'2023-05-07','2023-05-11',4,4000,'TRANSMITTED',0,'2023-06-26 08:04:40','2023-07-02 14:53:26'),(293,'9330',1,2,'member','CARLITO C.',NULL,'SOLAYAO','9393731334',75,'2023-05-05','2023-05-11',6,6000,'TRANSMITTED',0,'2023-06-26 08:06:07','2023-07-02 14:53:48'),(294,'2346',37,2,'dependent','ROLDAN','C.','CALOOY','N/A',65,'2023-04-25','2023-05-04',9,2700,'TRANSMITTED',0,'2023-06-26 08:07:37','2023-07-02 14:53:59'),(295,'9412',7,2,'member','ARGELITO  C.',NULL,'SOREMA','N/A',44,'2023-05-05','2023-05-08',3,3000,'TRANSMITTED',0,'2023-06-26 08:09:06','2023-07-02 14:54:08'),(296,'485',31,2,'member','GINA  S.',NULL,'AMPO','9513843437',44,'2023-05-01','2023-05-06',5,5000,'TRANSMITTED',0,'2023-06-26 08:10:16','2023-07-02 14:54:32'),(297,'9207',42,2,'dependent','ARCADIO','A.','SESURA JR.','N/A',61,'2023-05-03','2023-05-09',6,1800,'TRANSMITTED',0,'2023-06-26 08:11:48','2023-07-02 14:54:41'),(298,'6729',7,2,'member','PEDRO B.',NULL,'MENASALVAS','0998-964-9412',88,'2023-04-03','2023-04-09',6,6000,'TRANSMITTED',0,'2023-06-26 08:14:00','2023-07-02 14:55:01'),(299,'6560',7,2,'member','RODOLFO M.',NULL,'MAPILI','N/A',70,'2023-04-22','2023-04-27',5,5000,'TRANSMITTED',0,'2023-06-26 08:14:53','2023-07-02 14:55:44'),(300,'9016',10,2,'dependent','MYRNA','S.','SANTOS','N/A',69,'2023-05-06','2023-05-09',3,900,'TRANSMITTED',0,'2023-06-26 08:16:28','2023-07-02 14:55:55'),(301,'9015',10,2,'member','MYRNA S.',NULL,'SANTOS','9494100574',69,'2023-05-06','2023-05-09',3,3000,'TRANSMITTED',0,'2023-06-26 08:17:13','2023-07-02 14:56:26'),(302,'7719',2,2,'member','LOVELYN B.',NULL,'PANES','9306102943',24,'2023-05-03','2023-05-06',3,3000,'TRANSMITTED',0,'2023-06-26 08:24:29','2023-07-02 14:56:36'),(303,'9396',7,2,'member','LEAH',NULL,'SOMILI','N/A',62,'2023-04-28','2023-04-30',2,2000,'TRANSMITTED',0,'2023-06-26 08:26:32','2023-07-02 14:57:28'),(304,'2350',37,2,'member','ROLDAN C.',NULL,'CALOOY','9094264900',65,'2023-04-25','2023-05-04',9,9000,'TRANSMITTED',0,'2023-06-26 08:29:25','2023-07-02 14:57:37'),(305,'8274',2,2,'dependent','PRESENTACIO',NULL,'QUIJE','N/A',68,'2023-05-03','2023-05-06',3,900,'TRANSMITTED',0,'2023-06-26 08:31:54','2023-07-02 14:57:48'),(306,'180',40,2,'member','RICARDO M. SR. ',NULL,'ADAYA','N/A',66,'2023-04-23','2023-04-28',5,5000,'TRANSMITTED',0,'2023-06-26 08:35:28','2023-07-02 14:58:13'),(307,'180',40,2,'member','RICARDO M. SR. ',NULL,'ADAYA','N/A',66,'2023-02-26','2023-03-02',4,4000,'TRANSMITTED',0,'2023-06-26 08:36:05','2023-07-02 14:58:36'),(308,'3217',50,2,'member','ROSARIO R.',NULL,'DANTE','N/A',65,'2023-04-24','2023-04-26',2,2000,'TRANSMITTED',0,'2023-06-27 00:16:47','2023-07-02 14:59:05'),(309,'9675',3,2,'dependent','JULIETA','I.','TAHIL','N/A',78,'2023-03-22','2023-03-25',3,900,'TRANSMITTED',0,'2023-06-27 00:19:06','2023-07-02 14:59:15'),(310,'4846',2,2,'member','REBECCA M.',NULL,'GETALADA','9103069672',64,'2023-05-04','2023-05-08',4,4000,'TRANSMITTED',0,'2023-06-27 00:19:54','2023-07-02 14:59:26'),(311,'4820',2,2,'member','LEOISA T.',NULL,'GENETE','9103013181',81,'2023-04-30','2023-05-04',4,4000,'TRANSMITTED',0,'2023-06-27 00:33:08','2023-07-02 14:59:33'),(312,'6109',18,2,'member','ELEUTERIA A.',NULL,'LOGRONO','9485350446',72,'2023-04-22','2023-04-29',7,7000,'TRANSMITTED',0,'2023-06-27 00:34:37','2023-07-02 14:59:43'),(313,'2930',2,2,'dependent','LOURDES','P.','CORATIVO','N/A',70,'2023-04-25','2023-05-03',8,2400,'TRANSMITTED',0,'2023-06-27 00:35:44','2023-07-02 15:17:09'),(314,'3910',10,2,'member','JOSEPHINE B.',NULL,'EGAGAMAO','N/A',62,'2023-04-12','2023-04-18',6,6000,'TRANSMITTED',0,'2023-06-27 00:36:38','2023-07-02 15:17:49'),(315,'8568',48,2,'member','ADELA C.','CUAJOTOR','ROBLE','09075210249',68,'2023-03-13','2023-03-17',4,4000,'TRANSMITTED',0,'2023-06-27 00:37:05','2023-07-02 15:18:26'),(316,'10048',6,2,'dependent','ERVIN','H.','TORRES','N/A',63,'2023-04-21','2023-04-24',3,900,'TRANSMITTED',0,'2023-06-27 00:37:58','2023-07-02 15:19:05'),(317,'1351',16,2,'member','MARIBEL B.',NULL,'BASALAN','9207959735',65,'2023-03-24','2023-03-26',2,2000,'TRANSMITTED',0,'2023-06-27 00:38:10','2023-07-02 15:20:09'),(318,'7501',16,2,'dependent','MERLINDA','S.','OSANO','N/A',66,'2023-04-23','2023-04-27',4,1200,'TRANSMITTED',0,'2023-06-27 00:39:03','2023-07-02 15:20:46'),(319,'2350',2,2,'member','ROLDAN C.',NULL,'CALOOY','9094264900',65,'2023-04-08','2023-04-13',5,5000,'TRANSMITTED',0,'2023-06-27 00:39:42','2023-07-02 15:21:32'),(320,'4517',2,2,'dependent','VENACIO','E.','FUENTES','N/A',70,'2023-04-27','2023-05-04',7,2100,'TRANSMITTED',0,'2023-06-27 00:40:06','2023-07-02 15:22:12'),(321,'7090',3,2,'member','TERESITA D.',NULL,'NAPATAL','9092889461',78,'2023-04-24','2023-04-26',2,2000,'TRANSMITTED',0,'2023-06-27 00:41:11','2023-07-02 15:23:02'),(322,'7090',3,2,'member','TERESITA D.',NULL,'NAPATAL','9092889461',78,'2023-03-22','2023-03-25',3,3000,'TRANSMITTED',0,'2023-06-27 00:41:51','2023-07-02 15:23:40'),(323,'9531',36,2,'member','DOMINGO  V.',NULL,'SUMICAD','N/A',54,'2023-04-28','2023-05-05',7,7000,'TRANSMITTED',0,'2023-06-27 00:45:34','2023-07-02 15:24:42'),(324,'2346',2,2,'dependent','ROLDAN ',NULL,'CALOOY','N/A',65,'2023-04-08','2023-04-13',5,1500,'TRANSMITTED',0,'2023-06-27 00:45:53','2023-07-02 15:25:21'),(325,'7726',43,2,'member','RAYMUNDA O.',NULL,'PANGANTIHON','9098734239',66,'2023-04-03','2023-04-05',2,2000,'TRANSMITTED',0,'2023-06-27 00:46:20','2023-07-02 15:25:58'),(326,'5887',32,2,'member','BETTY C.',NULL,'LEGADA','9612080548',84,'2023-04-06','2023-04-11',5,5000,'TRANSMITTED',0,'2023-06-27 00:53:39','2023-07-02 15:26:39'),(327,'9124',7,2,'member','ANEOLINA',NULL,'SENATO','N/A',79,'2023-04-23','2023-04-24',1,1000,'TRANSMITTED',0,'2023-06-27 00:54:22','2023-07-02 15:27:19'),(328,'5812',2,2,'member','MARIO M.',NULL,'LASCONIA','9384826060',63,'2023-04-26','2023-05-02',6,6000,'TRANSMITTED',0,'2023-06-27 00:55:38','2023-07-02 15:28:02'),(329,'1884',7,2,'member','ANDY  T.',NULL,'BORJA','9198139046',47,'2023-04-29','2023-05-02',3,3000,'TRANSMITTED',0,'2023-06-27 00:56:32','2023-07-02 15:28:44'),(330,'10826',7,2,'member','RUPERTO ','BELLINA','TORATO','09197684395',63,'2023-05-01','2023-05-03',2,2000,'TRANSMITTED',0,'2023-06-27 00:57:12','2023-07-02 15:29:43'),(331,'8170',7,2,'member','SHIRLEY E.',NULL,'PON-AN','N/A',68,'2023-03-31','2023-04-04',4,4000,'TRANSMITTED',0,'2023-06-27 00:57:59','2023-07-02 15:30:25'),(332,'5139',9,2,'member','PEDRO ','FORNES','GUZON','09976204544',74,'2023-03-29','2023-04-05',7,7000,'TRANSMITTED',0,'2023-06-27 00:59:06','2023-07-02 15:31:12'),(333,'10576',7,2,'dependent','ZYVELLE','Z.','ALCOSEBA','N/A',19,'2023-04-19','2023-04-22',3,900,'TRANSMITTED',0,'2023-06-27 00:59:55','2023-07-02 15:31:56'),(334,'3893',1,2,'member','SATURNINA U.',NULL,'EDILLO','9227106454',85,'2023-04-09','2023-04-13',4,4000,'TRANSMITTED',0,'2023-06-27 01:00:08','2023-07-02 15:32:31'),(335,'6436',4,2,'member','VIRGINIA G.',NULL,'MAMAC','9460996512/9127296718',72,'2023-04-10','2023-04-15',5,5000,'TRANSMITTED',0,'2023-06-27 01:01:19','2023-07-02 15:32:54'),(336,'1258',1,2,'member','REYNALDO N.',NULL,'BARLAS','N/A',69,'2023-04-27','2023-05-02',5,5000,'TRANSMITTED',0,'2023-06-27 01:01:40','2023-07-02 15:33:15'),(337,'6435',4,2,'dependent','VIRGINIA',NULL,'MAMAC','N/A',72,'2023-04-10','2023-04-15',5,1500,'TRANSMITTED',0,'2023-06-27 01:02:12','2023-07-02 15:33:36'),(338,'8399',51,2,'member','NENITO P.',NULL,'RAMOS','9096233742',72,'2023-04-17','2023-04-25',8,8000,'TRANSMITTED',0,'2023-06-27 01:04:24','2023-07-02 15:33:58'),(340,'5716',4,2,'member','ELMER  C.',NULL,'LAGUE','9991763461',70,'2023-04-10','2023-04-11',1,1000,'TRANSMITTED',0,'2023-06-27 01:09:20','2023-07-02 15:34:24'),(341,'1494',7,2,'member','PETER D.',NULL,'BAYBAYAN','N/A',70,'2023-03-28','2023-03-30',2,2000,'TRANSMITTED',0,'2023-06-27 01:10:44','2023-07-02 15:34:48'),(342,'10599',52,2,'member','MILDRED',NULL,'ZULIETA','N/A',64,'2023-03-27','2023-04-03',7,7000,'TRANSMITTED',0,'2023-06-27 01:10:44','2023-07-02 15:35:15'),(343,'6135',2,2,'member','NENITA L.',NULL,'LOPEZ','9219610199',74,'2023-04-25','2023-04-29',4,4000,'TRANSMITTED',0,'2023-06-27 01:15:18','2023-07-02 15:35:51'),(344,'1779',3,2,'member','MA. ELIZABETH  ','BAYANI','GARCIA','09177069032',44,'2023-04-27','2023-04-29',2,2000,'TRANSMITTED',0,'2023-06-27 01:15:57','2023-07-02 15:37:08'),(345,'6454',53,2,'member','JOSEFINA S.',NULL,'MANALO','9282691434',61,'2023-04-12','2023-04-13',1,1000,'TRANSMITTED',0,'2023-06-27 01:22:25','2023-07-02 15:38:03'),(346,'10227',7,2,'member','NOLITA T.',NULL,'VALDEZ','9099573349',68,'2023-04-28','2023-04-30',2,2000,'TRANSMITTED',0,'2023-06-27 01:23:35','2023-07-02 15:38:48'),(347,'4390',4,2,'dependent','FELY','B.','FERROLINO','N/A',64,'2023-04-23','2023-04-29',6,1800,'TRANSMITTED',0,'2023-06-27 01:24:26','2023-07-02 15:39:31'),(348,'4389',4,2,'member','FELY B.',NULL,'FERROLINO','9121694647',64,'2023-04-23','2023-04-29',6,6000,'TRANSMITTED',0,'2023-06-27 01:24:51','2023-07-02 15:40:42'),(349,'10491',2,2,'member','ELENA B.',NULL,'YANSON','9297148517',70,'2023-04-27','2023-05-01',4,4000,'TRANSMITTED',0,'2023-06-27 01:26:19','2023-07-02 15:41:27'),(350,'1979',2,2,'member','ELMA A.',NULL,'BUETA','9514106727',65,'2023-04-25','2023-05-02',7,7000,'TRANSMITTED',0,'2023-06-27 01:27:32','2023-07-02 15:42:02'),(351,'4481',7,2,'member','CRISPINA',NULL,'FRANCISCO','9514106727',66,'2023-04-17','2023-04-25',8,8000,'TRANSMITTED',0,'2023-06-27 01:29:14','2023-07-02 15:42:41'),(352,'1154',6,2,'member','LILIA S.',NULL,'BALUCANAG','9451068443',70,'2023-04-25','2023-04-27',2,2000,'TRANSMITTED',0,'2023-06-27 01:30:01','2023-07-02 15:43:13'),(353,'2180',4,2,'member','MA FE. M.',NULL,'CABUGWAS','9362973263',59,'2023-04-21','2023-04-27',6,6000,'TRANSMITTED',0,'2023-06-27 01:30:39','2023-07-02 15:44:04'),(354,'2486',4,2,'member','ROLINDA B.',NULL,'CAQUILALA','9151186481',71,'2023-04-22','2023-04-26',4,4000,'TRANSMITTED',0,'2023-06-27 01:31:35','2023-07-02 15:44:54'),(355,'2157',7,2,'member','PEDRITO J.',NULL,'CABISADA','N/A',71,'2023-04-23','2023-04-24',1,1000,'TRANSMITTED',0,'2023-06-27 01:35:19','2023-07-02 15:45:32'),(356,'10560',54,2,'member','ANDRESA  S.',NULL,'YUNGCO','N/A',92,'2023-04-02','2023-04-16',14,14000,'TRANSMITTED',0,'2023-06-27 01:38:50','2023-07-02 15:46:04'),(357,'8454',9,2,'member','VICENTE JR. J.',NULL,'REAL','09751950534/09192896086',69,'2023-04-17','2023-04-22',5,5000,'TRANSMITTED',0,'2023-06-27 01:41:36','2023-07-02 15:46:34'),(358,'10532',4,2,'dependent','CYNTHIA','V.','YLANAN','N/A',63,'2023-04-12','2023-04-15',3,900,'TRANSMITTED',0,'2023-06-27 01:43:07','2023-07-02 15:47:10'),(359,'9604',25,2,'member','ANGELINA  S.',NULL,'TABILING','90905502098',63,'2023-04-01','2023-04-06',5,5000,'TRANSMITTED',0,'2023-06-27 01:45:20','2023-07-02 15:47:39'),(360,'6861',55,2,'member','LAUREANO I.',NULL,'MONATO','9519416109',70,'2023-04-25','2023-05-01',6,6000,'TRANSMITTED',0,'2023-06-27 01:47:24','2023-07-02 15:48:54'),(361,'8822',16,2,'member','KAREN MAE  N.',NULL,'SALADA','N/A',36,'2023-04-13','2023-04-18',5,5000,'TRANSMITTED',0,'2023-06-27 01:51:53','2023-07-02 15:49:30'),(362,'10866',2,2,'member','EGLESERIO','RAMIREZ','SANTOYO','09631251956',84,'2023-04-22','2023-04-23',1,1000,'TRANSMITTED',0,'2023-06-27 01:53:34','2023-07-02 15:50:06'),(363,'10866',10,2,'member','EGLESERIO','RAMIREZ','SANTOYO','09631251956',84,'2023-04-23','2023-04-25',2,2000,'TRANSMITTED',0,'2023-06-27 01:54:59','2023-07-02 15:50:39'),(364,'820',2,2,'member','VILMA H.',NULL,'ASUNCION','9094264071',77,'2023-04-18','2023-04-21',3,3000,'TRANSMITTED',0,'2023-06-27 01:55:38','2023-07-02 15:51:29'),(365,'2379',42,2,'dependent','NELIA','B.','CALUSAY','N/A',75,'2023-04-11','2023-04-14',3,900,'TRANSMITTED',0,'2023-06-27 01:56:45','2023-07-02 15:52:06'),(366,'8028',3,2,'dependent','JANET',NULL,'PEREZ','N/A',64,'2023-03-11','2023-03-15',4,1200,'TRANSMITTED',0,'2023-06-27 01:57:34','2023-07-02 15:52:38'),(367,'4494',56,2,'member','WILFREDO M.',NULL,'FRANCISCO','N/A',68,'2023-04-16','2023-04-25',9,9000,'TRANSMITTED',0,'2023-06-27 02:01:07','2023-07-02 15:53:11'),(368,'5681',7,2,'member','HELEN  I.',NULL,'LADIONA','9515307634',60,'2023-04-14','2023-04-19',5,5000,'TRANSMITTED',0,'2023-06-27 02:02:08','2023-07-02 15:53:47'),(369,'10616',9,2,'member','ELVIRA M.',NULL,'FRANCISCO','9228280320',68,'2023-04-14','2023-04-24',10,10000,'TRANSMITTED',0,'2023-06-27 02:02:55','2023-07-02 15:54:21'),(370,'494',2,2,'member','TAMMY T.',NULL,'AÑANA','9484037713',68,'2023-04-18','2023-04-20',2,2000,'TRANSMITTED',0,'2023-06-27 02:04:15','2023-07-02 15:54:54'),(371,'5956',6,2,'member','AVELINA V.',NULL,'LEZADA','9261371683',79,'2023-03-24','2023-03-26',2,2000,'TRANSMITTED',0,'2023-06-27 02:05:50','2023-07-02 15:55:37'),(372,'5956',16,2,'member','AVELINA V.',NULL,'LEZADA','9261371683',79,'2023-03-26','2023-04-03',8,8000,'TRANSMITTED',0,'2023-06-27 02:06:16','2023-07-02 15:56:13'),(373,'5956',6,2,'member','AVELINA V.',NULL,'LEZADA','9261371683',79,'2023-04-13','2023-04-19',6,6000,'TRANSMITTED',0,'2023-06-27 02:06:55','2023-07-02 15:56:46'),(374,'9436',2,2,'member','MARCELO D.',NULL,'SOTA','9554484274',85,'2023-04-16','2023-04-20',4,4000,'TRANSMITTED',0,'2023-06-27 02:07:47','2023-07-02 15:57:56'),(375,'1088',7,2,'member','LEONARDO L.',NULL,'BALDONASA','9811063665',78,'2023-04-15','2023-04-22',7,7000,'TRANSMITTED',0,'2023-06-27 02:08:53','2023-07-02 15:58:59'),(377,'8789',7,2,'member','HANNAH KAY S.',NULL,'MUCHO','9508028887',34,'2023-03-29','2023-03-31',2,2000,'TRANSMITTED',0,'2023-06-27 02:14:33','2023-07-02 15:59:38'),(378,'1471',7,2,'member','LIEZL  B.',NULL,'SALAZAR','9069082488',85,'2023-04-17','2023-04-20',3,3000,'TRANSMITTED',0,'2023-06-27 02:15:54','2023-07-02 16:00:23'),(379,'7098',9,2,'dependent','MA. LENNIE','E.','NAPUTO','9099939737',52,'2023-04-01','2023-04-16',15,4500,'TRANSMITTED',0,'2023-06-27 02:23:03','2023-07-02 16:01:02'),(380,'7746',22,2,'member','CRISANTO L.',NULL,'PANTURAS','N/A',63,'2023-04-03','2023-04-09',6,6000,'TRANSMITTED',0,'2023-06-27 02:23:58','2023-07-02 16:01:41'),(381,'10863',6,2,'member','RICHIE DEAN ','CASELA','ZERRUDO','09124310171',70,'2023-04-13','2023-04-15',2,2000,'TRANSMITTED',0,'2023-06-27 02:25:11','2023-07-02 16:02:30'),(382,'7022',7,2,'member','ROBERTO C.',NULL,'MUNEZ','9305910694',67,'2023-04-11','2023-04-16',5,5000,'TRANSMITTED',0,'2023-06-27 02:26:24','2023-07-02 16:03:13'),(383,'151',4,2,'member','HONORATA S.',NULL,'ACIDO','9382085959',58,'2023-04-21','2023-04-24',3,3000,'TRANSMITTED',0,'2023-06-27 02:27:27','2023-07-02 16:03:55'),(384,'7843',7,2,'member','ABDON JR. A.',NULL,'PATAGOC','9382085959',64,'2023-04-10','2023-04-14',4,4000,'TRANSMITTED',0,'2023-06-27 02:28:14','2023-07-02 16:04:32'),(385,'5647',4,2,'member','ELVIRA J.',NULL,'LACHICA','909-711-6445',74,'2023-04-18','2023-04-20',2,2000,'TRANSMITTED',0,'2023-06-27 02:29:03','2023-07-02 16:05:16'),(386,'4254',7,2,'dependent','LAILA','T.','FABLES','N/A',57,'2023-04-17','2023-04-21',4,1200,'TRANSMITTED',0,'2023-06-27 02:30:01','2023-07-02 16:06:30'),(387,'4252',7,2,'member','LAILA T.',NULL,'FABALES','N/A',57,'2023-04-17','2023-04-21',4,4000,'TRANSMITTED',0,'2023-06-27 02:30:40','2023-07-02 16:07:13'),(388,'506',6,2,'member','MERCEDES  E.',NULL,'ALCONTIN','9086600903',62,'2023-04-03','2023-04-06',3,3000,'TRANSMITTED',0,'2023-06-27 02:31:56','2023-07-02 16:07:59'),(389,'506',28,2,'member','MERCEDES  E.',NULL,'ALCONTIN','9086600903',62,'2023-03-26','2023-03-30',4,4000,'TRANSMITTED',0,'2023-06-27 02:32:26','2023-07-02 16:08:43'),(390,'9285',7,2,'member','JOSUE C.',NULL,'SINAG','09-264293799',82,'2023-04-16','2023-04-22',6,6000,'TRANSMITTED',0,'2023-06-27 02:33:08','2023-07-02 16:09:25'),(391,'6502',2,2,'member','ANTONIO J.',NULL,'MANIPON','9072629445',87,'2023-04-16','2023-04-20',4,4000,'TRANSMITTED',0,'2023-06-27 02:33:45','2023-07-02 16:10:13'),(392,'506',28,2,'member','MERCEDES  E.',NULL,'ALCONTIN','9264900439',77,'2023-04-02','2023-04-03',1,1000,'TRANSMITTED',0,'2023-06-27 02:34:21','2023-07-02 16:10:55'),(393,'4151',4,2,'dependent','PHOEBE','B.','ESPINA','N/A',62,'2023-04-14','2023-04-17',3,900,'TRANSMITTED',0,'2023-06-27 02:35:19','2023-07-02 16:11:41'),(394,'581',2,2,'member','ELVIRA U.',NULL,'APARICIO','9307106694',63,'2023-04-19','2023-04-22',3,3000,'TRANSMITTED',0,'2023-06-27 02:36:13','2023-07-02 16:12:57'),(395,'7110',4,2,'member','MARCOS B.',NULL,'NATAYADA','0909-172-5761',74,'2023-04-17','2023-04-20',3,3000,'TRANSMITTED',0,'2023-06-27 02:36:58','2023-07-02 16:14:45'),(396,'9623',2,2,'member','EUGENIO N.',NULL,'TABURNO','0946307-6749',72,'2023-04-10','2023-04-12',2,2000,'TRANSMITTED',0,'2023-06-27 02:37:33','2023-07-02 16:15:38'),(397,'4072',2,2,'member','JOSEPINA O.',NULL,'ESCONDE','9090582876',80,'2023-04-17','2023-04-20',3,3000,'TRANSMITTED',0,'2023-06-27 02:38:06','2023-07-02 16:17:14'),(398,'182',2,2,'member','EVELLA  A.',NULL,'SOL','9488212164',53,'2023-04-10','2023-04-12',2,2000,'TRANSMITTED',0,'2023-06-27 02:38:37','2023-07-02 16:18:05'),(399,'7138',7,2,'member','ELEANOR L.',NULL,'NAVIGAR','9309881984',70,'2023-04-17','2023-04-19',2,2000,'TRANSMITTED',0,'2023-06-27 02:39:16','2023-07-02 16:19:07'),(400,'5059',10,2,'member','THELMA P.',NULL,'GUEVARRA','N/A',66,'2023-04-15','2023-04-18',3,3000,'TRANSMITTED',0,'2023-06-27 02:39:57','2023-07-02 16:20:00'),(401,'1685',9,2,'member','MELVIN',NULL,'BERMUDEZ','N/A',45,'2023-04-13','2023-04-17',4,4000,'TRANSMITTED',0,'2023-06-27 02:40:43','2023-07-02 16:20:56'),(402,'6008',57,2,'member','NEBOCANISAR ','NABASA','LIM','09772619540/09390463138',69,'2023-03-30','2023-04-04',5,5000,'TRANSMITTED',0,'2023-06-27 03:11:57','2023-07-02 16:22:04'),(403,'4363',6,2,'member','ROMMEL  J.',NULL,'FERNANDEZ','9151316900',40,'2023-03-18','2023-03-20',2,2000,'TRANSMITTED',0,'2023-06-27 03:12:26','2023-07-02 16:22:54'),(404,'10107',6,2,'dependent','MARAINE',NULL,'TUCAYAO','N/A',6,'2023-03-31','2023-04-08',8,2400,'TRANSMITTED',0,'2023-06-27 03:13:21','2023-07-02 16:24:04'),(405,'8225',7,2,'member','IGMEDIO E.',NULL,'PRESGA','9382356388',67,'2023-04-05','2023-04-06',1,1000,'TRANSMITTED',0,'2023-06-27 03:14:18','2023-07-02 16:25:37'),(406,'1351',16,2,'member','MARIBEL B.',NULL,'BASALAN','9207959735',65,'2023-03-29','2023-04-07',9,9000,'TRANSMITTED',0,'2023-06-27 03:14:47','2023-07-02 16:26:53'),(407,'5998',4,2,'member','ROLY  L.',NULL,'LIGTAS','9991855448',56,'2023-04-13','2023-04-18',5,5000,'TRANSMITTED',0,'2023-06-27 03:15:21','2023-07-02 16:29:03'),(408,'9690',2,2,'member','NIEL  M.',NULL,'TAJALE','9486874033',51,'2023-04-18','2023-04-20',2,2000,'TRANSMITTED',0,'2023-06-27 03:16:01','2023-07-02 16:30:34'),(409,'2234',2,2,'member','ELIZABETH  ','DIOT','CAGA','09709238063',65,'2023-04-13','2023-04-17',4,4000,'TRANSMITTED',0,'2023-06-27 03:16:34','2023-07-02 16:32:35'),(410,'6879',42,2,'member','MINDA B.',NULL,'MONINIO','9090982746',67,'2023-04-02','2023-04-04',2,2000,'TRANSMITTED',0,'2023-06-27 03:19:42','2023-07-02 16:33:56'),(411,'3432',28,2,'dependent','TERESITA','A.','DELITO','N/A',66,'2023-04-03','2023-04-13',10,3000,'TRANSMITTED',0,'2023-06-27 03:20:44','2023-07-02 16:34:58'),(412,'3433',28,2,'member','TERESITA A.',NULL,'DELITO','9319746392',66,'2023-04-03','2023-04-13',10,10000,'TRANSMITTED',0,'2023-06-27 03:21:36','2023-07-02 16:35:53'),(413,'5241',4,2,'member','TERESITA L.',NULL,'IBANEZ','9093967999',84,'2023-04-12','2023-04-16',4,4000,'TRANSMITTED',0,'2023-06-27 03:31:48','2023-07-02 16:36:58'),(414,'1445',7,2,'member','MA.CORAZON B.',NULL,'BATITANG','N/A',60,'2023-04-13','2023-04-16',3,3000,'TRANSMITTED',0,'2023-06-27 03:32:36','2023-07-02 16:38:11'),(415,'5239',4,2,'member','LEONITA',NULL,'IBANEZ','N/A',80,'2023-04-13','2023-04-17',4,4000,'TRANSMITTED',0,'2023-06-27 03:34:57','2023-07-02 16:40:20'),(416,'3062',16,2,'member','MERLITA',NULL,'CURIBA','N/A',69,'2023-04-06','2023-04-08',2,2000,'TRANSMITTED',0,'2023-06-27 03:35:39','2023-07-02 16:41:36'),(417,'5565',7,2,'member','ARACELI C.',NULL,'JUSA','9500950424',82,'2023-03-27','2023-04-06',10,10000,'TRANSMITTED',0,'2023-06-27 03:36:25','2023-07-02 16:42:37'),(418,'566',4,2,'member','ELEUTERIO B.',NULL,'ANTIPORTA','9306797441',65,'2023-04-12','2023-04-15',3,3000,'TRANSMITTED',0,'2023-06-27 03:37:09','2023-07-02 16:43:45'),(419,'10324',16,2,'dependent','TRINIDAD',NULL,'VILLA','N/A',73,'2023-04-04','2023-04-09',5,1500,'TRANSMITTED',0,'2023-06-27 03:38:08','2023-07-02 16:44:44'),(420,'10333',16,2,'member','TRINIDAD N.',NULL,'VILLA','9462957213',73,'2023-04-04','2023-04-09',5,5000,'TRANSMITTED',0,'2023-06-27 03:38:35','2023-07-02 16:45:44'),(421,'9193',29,2,'dependent','BELLA','U.','SESDUYRO','N/A',66,'2023-03-29','2023-04-04',6,1800,'TRANSMITTED',0,'2023-06-27 03:42:26','2023-07-02 16:46:55'),(422,'1492',7,2,'dependent','PETER',NULL,'BAYBAYAN','N/A',70,'2023-03-28','2023-03-30',2,600,'TRANSMITTED',0,'2023-06-27 03:43:20','2023-07-02 16:48:18'),(423,'3416',4,2,'member','YOLANDA B.',NULL,'DELGADO','9102149468',67,'2023-04-11','2023-04-14',3,3000,'TRANSMITTED',0,'2023-06-27 03:44:04','2023-07-02 16:49:46'),(424,'7237',2,2,'member','ROSITA C.',NULL,'NORCA','N/A',89,'2023-04-13','2023-04-17',4,4000,'TRANSMITTED',0,'2023-06-27 03:44:55','2023-07-02 16:50:51'),(425,'6945',58,2,'member','ANTONIO G.',NULL,'MONTILLANO','096669198832',66,'2023-06-19','2023-06-25',6,6000,'TRANSMITTED',0,'2023-06-28 23:46:19','2023-07-02 16:52:19'),(426,'2716',4,3,'member','CELERINA',NULL,'CAVITE','09090720711/9482348862',81,'2023-06-27','2023-06-30',3,3000,'ENCODED',0,'2023-07-03 23:48:10','2023-07-03 23:48:10'),(427,'6474',25,3,'member','ROMEO M.',NULL,'MANDID','9207795351/09513533739',64,'2023-06-21','2023-06-26',5,5000,'ENCODED',0,'2023-07-04 00:03:50','2023-07-04 00:03:50'),(429,'9835',2,3,'member','EMMA L.',NULL,'TAYONE','9069240835',63,'2023-06-26','2023-06-30',4,4000,'ENCODED',0,'2023-07-04 00:25:50','2023-07-04 00:25:50'),(430,'3555',2,3,'member','ROSITA S.',NULL,'DESAMPARADO','09461541574',77,'2023-06-28','2023-07-02',4,4000,'ENCODED',1,'2023-07-04 00:30:09','2023-07-04 00:33:44'),(431,'5736',2,3,'member','EDUARDO A.',NULL,'LAMBAYAN','9094225840',74,'2023-06-29','2023-07-03',4,4000,'ENCODED',0,'2023-07-04 00:56:32','2023-07-04 00:56:32'),(432,'5106',9,3,'member','PEDRO ROLANDO A.',NULL,'GULMATICO','9955146440',68,'2023-06-25','2023-06-27',2,2000,'ENCODED',0,'2023-07-04 01:19:33','2023-07-04 01:19:33'),(433,'10366',10,3,'member','JOSE S.',NULL,'VILLALOBOS','0',62,'2023-06-14','2023-06-26',12,12000,'ENCODED',0,'2023-07-04 01:22:52','2023-07-04 01:22:52');
/*!40000 ALTER TABLE `healths` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hospitals`
--

DROP TABLE IF EXISTS `hospitals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hospitals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospitals`
--

LOCK TABLES `hospitals` WRITE;
/*!40000 ALTER TABLE `hospitals` DISABLE KEYS */;
INSERT INTO `hospitals` VALUES (1,'PMH','UNKNOWN','2023-06-20 01:22:27','2023-06-20 01:22:27'),(2,'Bontuyan Medical Hospital Inc. Medical Hospital Inc.',' Polomolok, South Cotabato','2023-06-20 01:23:53','2023-06-27 01:40:08'),(3,'SCH','UNKNOWN','2023-06-20 01:25:47','2023-06-20 01:25:47'),(4,'Heramil Hospital','Polomolok, South Cotabato','2023-06-20 01:26:09','2023-06-27 01:39:37'),(5,'Surallah Valley Medical Specialist\'s Center Inc. Hospital','SURALLAH, SOUTH COTABATO','2023-06-20 01:27:04','2023-06-20 01:28:27'),(6,'St. Elizabeth Hospital Inc.','GENERAL SANTOS CITY','2023-06-20 01:27:20','2023-06-20 01:29:21'),(7,'Howard Hubbard Memorial Hospital','Polomolok, South Cotabato','2023-06-20 01:27:35','2023-06-27 01:41:21'),(8,'SMC','UNKNOWN','2023-06-20 01:27:47','2023-06-20 01:27:47'),(9,'General Santos Doctors Hospital, Inc.','GENERAL SANTOS CITY','2023-06-20 01:27:58','2023-06-20 01:28:13'),(10,'Sarangani Bay Specialists Medical Center Inc.','SARANGANI PROVINCE','2023-06-20 01:28:50','2023-06-20 01:28:50'),(11,'SBSMCI','UNKNOWN','2023-06-20 01:29:09','2023-06-20 01:29:09'),(12,'RSMH','UNKNOWN','2023-06-20 06:03:40','2023-06-20 06:03:40'),(13,'ECSGH','UNKNOWN','2023-06-20 06:03:56','2023-06-20 06:03:56'),(14,'NDH','UNKNOWN','2023-06-20 06:04:26','2023-06-20 06:04:26'),(15,'MMHI','UNKNOWN','2023-06-20 06:04:48','2023-06-20 06:04:48'),(16,'SCPH','UNKNOWN','2023-06-20 07:18:18','2023-06-20 07:18:18'),(17,'SDSGH','UNKNOWN','2023-06-22 05:22:58','2023-06-22 05:22:58'),(18,'TCDH','UNKNOWN','2023-06-22 05:54:04','2023-06-22 05:54:04'),(19,'TDHI','UNKNOWN','2023-06-22 05:54:26','2023-06-22 05:54:26'),(20,'AMCB','UNKNOWN','2023-06-22 05:55:35','2023-06-22 05:55:35'),(21,'SMCI','UNKNOWN','2023-06-22 05:56:06','2023-06-22 05:56:06'),(22,'DRMC','UNKNOWN','2023-06-22 05:56:21','2023-06-22 05:56:21'),(23,'MIHMCI','UNKNOWN','2023-06-22 05:56:41','2023-06-22 05:56:41'),(24,'SPHII','UNKNOWN','2023-06-22 05:56:57','2023-06-22 05:56:57'),(25,'SCPH','UNKNOWN','2023-06-22 05:57:11','2023-06-22 05:57:11'),(26,'SPHM','UNKNOWN','2023-06-22 05:57:31','2023-06-22 05:57:31'),(27,'DIAGAN','UNKNOWN','2023-06-22 05:57:50','2023-06-22 05:57:50'),(28,'MMCI','UNKNOWN','2023-06-22 05:58:01','2023-06-22 05:58:01'),(29,'DMC','UNKNOWN','2023-06-22 05:59:10','2023-06-22 05:59:10'),(30,'SLH','UNKNOWN','2023-06-22 05:59:27','2023-06-22 05:59:27'),(31,'SK','UNKNOWN','2023-06-22 05:59:42','2023-06-22 05:59:42'),(32,'DJMMC','UNKNOWN','2023-06-22 05:59:57','2023-06-22 05:59:57'),(33,'IPH','UNKNOWN','2023-06-22 06:00:15','2023-06-22 06:00:15'),(34,'CPH','UNKNOWN','2023-06-22 06:00:43','2023-06-22 06:00:43'),(35,'LCP','UNKNOWN','2023-06-22 06:00:59','2023-06-22 06:00:59'),(36,'SKPH','UNKNOWN','2023-06-22 06:01:12','2023-06-22 06:01:12'),(37,'DJRCH','UNKNOWN','2023-06-22 06:01:24','2023-06-22 06:01:24'),(38,'ST.ELIBETH','UNKNOWN','2023-06-22 06:01:39','2023-06-22 06:01:39'),(39,'PSK','UNKNOWN','2023-06-22 06:01:54','2023-06-22 06:01:54'),(40,'STH','UNKNOWN','2023-06-22 06:02:05','2023-06-22 06:02:05'),(41,'LPDH','UNKNOWN','2023-06-22 06:02:43','2023-06-22 06:02:43'),(42,'Allah Valley Medical Specialist\'s Center Inc. Hospital','KORONADAL CITY, SOUTH COTABATO','2023-06-22 06:03:20','2023-06-22 06:03:20'),(43,'FRTMDH','UNKNOWN','2023-06-22 06:03:52','2023-06-22 06:03:52'),(44,'UCMMCI','UNKNOWN','2023-06-22 06:04:23','2023-06-22 06:04:23'),(45,'SMCI','UNKNOWN','2023-06-22 07:01:04','2023-06-22 07:01:04'),(46,'LCH','UNKNOWN','2023-06-23 07:50:21','2023-06-23 07:50:21'),(47,'SMCH','UNKNOWN','2023-06-25 16:14:03','2023-06-25 16:14:03'),(48,'SPH','UNKNOWN','2023-06-26 06:14:36','2023-06-26 06:14:36'),(49,'MCH','UNKNOWN','2023-06-26 07:48:56','2023-06-26 07:48:56'),(50,'ADH','UNKNOWN','2023-06-27 00:15:34','2023-06-27 00:15:34'),(51,'LCHI','UNKNOWN','2023-06-27 01:03:24','2023-06-27 01:03:24'),(52,'NMMC','UNKNOWN','2023-06-27 01:09:48','2023-06-27 01:09:48'),(53,'SKDHI','UNKNOWN','2023-06-27 01:21:20','2023-06-27 01:21:20'),(54,'NGHC','UNKNOWN','2023-06-27 01:37:35','2023-06-27 01:37:35'),(55,'MAASIM','UNKNOWN','2023-06-27 01:46:31','2023-06-27 01:46:31'),(56,'SGH','UNKNOWN','2023-06-27 01:59:57','2023-06-27 01:59:57'),(57,'COOPMPI','UNKNOWN','2023-06-27 03:10:58','2023-06-27 03:10:58'),(58,'ST. DOMINIC','National Highway, Kolambog, Isulan, Sultan Kudarat','2023-06-28 23:43:37','2023-06-28 23:43:37');
/*!40000 ALTER TABLE `hospitals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_coverages`
--

DROP TABLE IF EXISTS `insurance_coverages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `insurance_coverages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `number_of_days` int NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_coverages`
--

LOCK TABLES `insurance_coverages` WRITE;
/*!40000 ALTER TABLE `insurance_coverages` DISABLE KEYS */;
INSERT INTO `insurance_coverages` VALUES (1,1000,30,'MEMBER','2023-06-20 01:10:41','2023-06-20 01:10:41'),(2,300,15,'DEPENDENT','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `insurance_coverages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_id` bigint unsigned NOT NULL,
  `enrollment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dependents_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dependents_middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependents_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `date_received` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'4284',2,'member','ROMEO G.',NULL,'FALDAS','ROMEO G.',NULL,'FALDAS',4322.96,'2023-06-23','2023-06-23 01:25:51','2023-06-23 01:25:51'),(2,'626',2,'member','FELOMINA',NULL,'ARAIZA','FELOMINA',NULL,'ARAIZA',11516.88,'2023-07-04','2023-07-04 01:44:44','2023-07-04 01:44:44'),(3,'4747',42,'member','NORMA E.',NULL,'GARDONIA','NORMA E.',NULL,'GARDONIA',20000,'2023-07-04','2023-07-04 05:46:53','2023-07-04 05:46:53'),(4,'8672',7,'dependent','RODOLFO C.',NULL,'LORIA','Cherry Ann','L.','Del Rosario',8000,'2023-07-04','2023-07-04 05:49:18','2023-07-04 05:49:18'),(5,'626',2,'member','FELOMINA',NULL,'ARAIZA','FELOMINA',NULL,'ARAIZA',11561.88,'2023-07-04','2023-07-04 05:50:04','2023-07-04 05:50:04'),(6,'7022',6,'member','ROBERTO C.',NULL,'MUNEZ','ROBERTO C.',NULL,'MUNEZ',20000,'2023-07-04','2023-07-04 05:51:24','2023-07-04 05:51:24'),(7,'1793',7,'member','ALFREDO B.',NULL,'BINALON','ALFREDO B.',NULL,'BINALON',5000,'2023-07-04','2023-07-04 05:52:14','2023-07-04 05:52:14'),(8,'5736',2,'member','EDUARDO A.',NULL,'LAMBAYAN','EDUARDO A.',NULL,'LAMBAYAN',3707.6,'2023-07-04','2023-07-04 05:53:00','2023-07-04 05:53:00'),(9,'4392',7,'member','NOVY JOY  F.',NULL,'FRANCONAS','NOVY JOY  F.',NULL,'FRANCONAS',10800.49,'2023-07-03','2023-07-04 05:57:05','2023-07-04 05:57:05'),(10,'10359',6,'dependent','ROBERTA  B.',NULL,'OLASO','Kyle Xian  ','V.','Quizon',20000,'2023-07-03','2023-07-04 05:58:18','2023-07-04 05:58:18'),(11,'5666',7,'dependent','LUCRESIO V.',NULL,'ESCALICAS','Angel Marie','P.','Geronimo',5000,'2023-06-30','2023-07-04 06:00:14','2023-07-04 06:00:14'),(12,'9231',4,'member','LORETA B.',NULL,'SHAROL','LORETA B.',NULL,'SHAROL',13378.8,'2023-07-10','2023-07-10 06:01:49','2023-07-10 06:01:49'),(13,'5198',7,'member','FERNANDO L.',NULL,'HITAAS','FERNANDO L.',NULL,'HITAAS',12710,'2023-07-12','2023-07-12 02:54:12','2023-07-12 02:54:12'),(14,'2160',7,'member','MARY ANN  B.',NULL,'CABIZARES','MARY ANN  B.',NULL,'CABIZARES',10000,'2023-07-12','2023-07-12 02:55:10','2023-07-12 02:55:10'),(15,'3431',10,'member','OFELIA N.',NULL,'DELITO','OFELIA N.',NULL,'DELITO',5000,'2023-07-12','2023-07-12 02:56:45','2023-07-12 02:56:45'),(16,'3429',10,'member','ANA MARIE',NULL,'DELITO','ANA MARIE',NULL,'DELITO',20000,'2023-07-11','2023-07-12 02:57:40','2023-07-12 02:57:40'),(17,'8462',2,'dependent','JUANITO L.',NULL,'LILAM','Teresita','L.','Rebotazo',5000,'2023-07-12','2023-07-12 02:58:57','2023-07-12 02:58:57'),(18,'2528',7,'member','JOSE S.',NULL,'CARINO','JOSE S.',NULL,'CARINO',20000,'2023-07-12','2023-07-12 03:03:25','2023-07-12 03:03:25'),(19,'5276',10,'member','ROSALIA M.',NULL,'IHALAD','ROSALIA M.',NULL,'IHALAD',20000,'2023-07-11','2023-07-12 03:04:20','2023-07-12 03:05:44'),(20,'9944',10,'dependent','ANTONIO B.',NULL,'NALUGON','Rosalia','M.','Ihalad',2000,'2023-07-11','2023-07-12 03:09:34','2023-07-12 03:09:34'),(21,'7905',4,'member','PRAXEDES  A.',NULL,'PELIGRO','PRAXEDES  A.',NULL,'PELIGRO',5000,'2023-07-11','2023-07-12 03:10:22','2023-07-12 03:10:22'),(22,'7905',4,'member','PRAXEDES  A.',NULL,'PELIGRO','PRAXEDES  A.',NULL,'PELIGRO',5000,'2023-07-11','2023-07-12 05:19:15','2023-07-12 05:19:15'),(24,'7038',4,'member','THELMA L.',NULL,'MUTIA','THELMA L.',NULL,'MUTIA',9249.2,'2023-07-12','2023-07-12 07:18:40','2023-07-12 07:18:40'),(25,'8522',4,'member','LEONIDA A.',NULL,'RETIZA','LEONIDA A.',NULL,'RETIZA',1625,'2023-07-13','2023-07-13 05:06:21','2023-07-13 05:06:21'),(26,'9265',9,'member','PATROCINIO A.',NULL,'SILVANO','PATROCINIO A.',NULL,'SILVANO',20000,'2023-07-13','2023-07-13 05:44:05','2023-07-13 05:44:05'),(27,'6073',4,'member','RODOLFO E.',NULL,'LLAGAS','RODOLFO E.',NULL,'LLAGAS',17160,'2023-07-17','2023-07-16 23:33:03','2023-07-16 23:33:03'),(28,'9285',7,'member','JOSUE C.',NULL,'SINAG','JOSUE C.',NULL,'SINAG',20000,'2023-07-14','2023-07-17 00:05:33','2023-07-17 00:05:33'),(29,'1963',2,'member','LYDIA  M.',NULL,'BUCIO','LYDIA  M.',NULL,'BUCIO',15000,'2023-07-14','2023-07-17 00:06:50','2023-07-17 00:06:50'),(31,'9231',4,'member','LORETA B.',NULL,'SHAROL','LORETA B.',NULL,'SHAROL',13500,'2023-07-10','2023-07-17 00:08:57','2023-07-17 00:08:57'),(32,'10256',6,'member','PATROCINIA S.',NULL,'VANZUELA','PATROCINIA S.',NULL,'VANZUELA',20000,'2023-07-10','2023-07-17 00:11:16','2023-07-17 00:11:16'),(33,'10258',6,'dependent','RANULFO C.',NULL,'OCADO','Patrocina','S.','Vanzuela',20000,'2023-07-10','2023-07-17 00:14:18','2023-07-17 00:14:18'),(34,'3326',10,'dependent','JENALYN  C.',NULL,'GUBALANI','Niel Vincent ','E.','Ligtas',171025,'2023-07-10','2023-07-17 00:16:13','2023-07-17 00:16:13'),(35,'6930',9,'member','MANSUETO ','GARBO ','MONTERDE','MANSUETO ','GARBO ','MONTERDE',20000,'2023-07-10','2023-07-17 00:17:49','2023-07-17 00:17:49'),(36,'765',10,'member','EGMEDIO A.',NULL,'ARRIESGADO','EGMEDIO A.',NULL,'ARRIESGADO',20000,'2023-07-10','2023-07-17 00:18:22','2023-07-17 00:18:22'),(37,'3330',4,'member','LORNA G.',NULL,'DEALCA','LORNA G.',NULL,'DEALCA',10000,'2023-07-10','2023-07-17 00:22:21','2023-07-17 00:22:21'),(38,'8911',9,'member','HENRY SR. D.',NULL,'SALLE','HENRY SR. D.',NULL,'SALLE',20000,'2023-07-07','2023-07-17 00:23:06','2023-07-17 00:23:06'),(39,'3255',6,'member','ALAN  U.',NULL,'DATAHAN','ALAN  U.',NULL,'DATAHAN',10000,'2023-07-07','2023-07-17 00:24:22','2023-07-17 00:24:22'),(40,'2747',2,'member','EDGARDO D.',NULL,'CELAJES','EDGARDO D.',NULL,'CELAJES',15000,'2023-07-07','2023-07-17 00:32:49','2023-07-17 00:32:49'),(41,'5704',6,'member','LEILA ',' L.','PASQUIL','LEILA ',' L.','PASQUIL',15000,'2023-07-07','2023-07-17 00:34:33','2023-07-17 00:34:33'),(42,'1427',7,'member','TOMASA G.',NULL,'BATIANCILA','TOMASA G.',NULL,'BATIANCILA',10000,'2023-07-06','2023-07-17 00:35:10','2023-07-17 00:35:10'),(43,'7373',2,'member','ALLAN  L.',NULL,'OLIVEROS','ALLAN  L.',NULL,'OLIVEROS',4605,'2023-07-07','2023-07-17 00:36:54','2023-07-17 00:36:54'),(44,'9782',2,'dependent','BIENVENIDO JR. B.',NULL,'MONTOYA','Cecilia','B.','Tano-an',5000,'2023-07-06','2023-07-17 00:38:24','2023-07-17 00:38:24'),(45,'4438',9,'dependent','HELEN ','FERNANDEZ','DAGUPLO','Russel','F.','Pantua',5000,'2023-07-05','2023-07-17 00:40:30','2023-07-17 00:40:30'),(46,'5097',7,'dependent','ROGELIO C.',NULL,'DIAZ','Felina','A.','Gulay',2645,'2023-07-05','2023-07-17 00:41:30','2023-07-17 00:41:30'),(47,'3604',6,'dependent','MELITINA P.',NULL,'CARPIO','Dina','O.','Diamos',10000,'2023-07-05','2023-07-17 00:42:31','2023-07-17 00:42:31'),(48,'5577',2,'dependent','JUSTINIANO Q.',NULL,'ENCLONAR','Chaad Ellie','Mondejar','Blando',3475.93,'2023-07-17','2023-07-17 05:08:24','2023-07-17 05:08:24');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_03_28_012857_create_members_table',1),(6,'2023_03_28_013019_create_health_deaths_table',1),(7,'2023_03_31_010850_create_deaths_table',1),(8,'2023_04_22_061727_create_healths_table',1),(9,'2023_04_23_005438_create_hospitals_table',1),(10,'2023_04_24_122921_create_logs_table',1),(11,'2023_05_04_045719_create_vehicle_schedules_table',1),(12,'2023_05_05_052335_create_cash_advances_table',1),(13,'2023_05_05_122805_create_transmittals_table',1),(14,'2023_05_05_122815_create_payments_table',1),(15,'2023_05_06_003148_create_attachments_table',1),(16,'2023_05_06_112514_create_payment_attachments_table',1),(17,'2023_05_09_002815_create_mortuaries_table',1),(18,'2023_05_11_031204_create_supervisor_codes_table',1),(19,'2023_05_11_071430_create_health_attachments_table',1),(20,'2023_05_12_090230_create_insurance_coverages_table',1),(21,'2023_05_12_090240_create_coverage_histories_table',1),(22,'2023_05_14_033849_create_reports_table',1),(23,'2023_05_14_033854_create_report_headers_table',1),(24,'2023_05_14_033900_create_report_signatories_table',1),(25,'2023_05_14_092603_create_mortuary_attachments_table',1),(26,'2023_05_14_143753_create_death_attachments_table',1),(27,'2023_05_16_120036_create_community_relations_table',1),(28,'2023_05_29_234219_create_purposes_table',1),(29,'2023_05_29_234227_create_types_table',1),(30,'2023_05_30_000017_add_purpose_column_and_type_column_to_community_relations_table',1),(31,'2023_05_30_051442_add_illness_column_to_cash_advances_table',1),(32,'2023_05_30_072926_update_column_member_id_to_nullable_to_community_relations_table',1),(33,'2023_05_31_022934_add_column_enrollment_status_to_cash_advances_table',1),(34,'2023_05_31_081447_add_column_date_of_death_to_mortuaries-table',1),(35,'2023_05_31_111231_create_signatories_table',1),(36,'2023_06_01_012543_create_roles_table',1),(37,'2023_06_01_012650_add_role_id_column_to_users_table',1),(38,'2023_06_30_000249_add_coverage_type_column_to_mortuaries_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mortuaries`
--

DROP TABLE IF EXISTS `mortuaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mortuaries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NOT NULL,
  `member_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_death` date DEFAULT NULL,
  `place_of_death` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hollographic` tinyint(1) DEFAULT NULL,
  `claimants_first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `claimants_middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claimants_last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `claimants_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diamond_package` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coverage_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_attempts` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mortuaries`
--

LOCK TABLES `mortuaries` WRITE;
/*!40000 ALTER TABLE `mortuaries` DISABLE KEYS */;
INSERT INTO `mortuaries` VALUES (2,5342,'ROSALINO A. JR. IWAG','9108959063','75640','2023-03-13','PSC',0,'JEANETTE','I.','ABALDE',NULL,'2023-03-16','Approved','No','No','4',1,'2023-06-27 06:00:27','2023-07-07 01:44:06'),(3,8879,'WILFREDO R. SALAZAR',NULL,'75640','2023-03-15','PSC',0,'NIDA','B.','SALAZAR',NULL,'2023-06-17','Approved','No','No','4',1,'2023-06-27 06:03:35','2023-07-07 01:47:52'),(4,9104,'ULDARICO  M. SEDORIFA',NULL,'75640','2023-03-19','PSC',0,'ANALYN','A.','SEDORIFA',NULL,'2023-06-20','Approved','No','No','4',1,'2023-06-27 06:04:58','2023-07-07 01:49:37'),(5,3708,'ANTONIETA T. DOMINGO','9518237892','75640','2023-03-19','PSC',0,'GLORIA','D.','ESTOQUIA',NULL,'2023-03-20','Approved','No','No','4',1,'2023-06-27 06:25:12','2023-07-07 01:51:25'),(6,8706,'ANGELO R. RULE','9105806536','75640','2023-03-24','PSC',0,'ROBERT','J.','RULE SR.',NULL,'2023-03-27','Approved','No','No','4',1,'2023-06-27 06:26:47','2023-07-07 01:56:20'),(7,6876,'ARTURO T. MONG',NULL,'75640','2023-03-26','ZAMBOANGA',0,'BERNARDO','S.','MONG',NULL,'2023-03-29','Approved','No','No','4',1,'2023-06-27 06:29:42','2023-07-07 01:59:09'),(8,2685,'WENNIE E. CATEDRAL','9187385341','75640','2023-03-30','PSC',0,'FLORITA','B.','CATEDRAL',NULL,'2023-03-31','Approved','No','No',NULL,0,'2023-06-27 06:30:53','2023-06-27 06:30:53'),(9,4620,'SOCORRO B. GALES',NULL,'75640','2023-03-26','BOHOL',0,'SHIERALYN','G.','SAAVEDRA',NULL,'2023-03-31','Approved','No','No',NULL,0,'2023-06-27 06:32:19','2023-06-27 06:32:19'),(10,7810,'TEODORA A. PASCUA','9203377144','75640','2023-03-31','N/A',0,'GLORIA','P.','TILLO',NULL,'2023-04-03','Approved','No','No',NULL,0,'2023-06-27 06:38:47','2023-06-27 06:38:47'),(11,10305,'JUSTINIANO T. VICHO','9953696372','75640','2023-04-01','N/A',0,'EDITH','V.','LLIDO',NULL,'2023-04-03','Approved','No','No',NULL,0,'2023-06-27 06:40:20','2023-06-27 06:40:20'),(12,6051,'JAIME  G. LINGGANAY','9387319998','75640','2023-03-04','PSC',0,'N/A',NULL,'N/A',NULL,'2023-04-03','Approved','Yes','No',NULL,1,'2023-06-27 06:42:28','2023-06-27 06:46:02'),(13,9382,'WILFREDO SOLON','9755744596','75640','2023-04-05','PSC',0,'HERSHE JOY','L.','SOLON',NULL,'2023-04-10','Approved','Yes','Yes',NULL,1,'2023-06-27 06:45:05','2023-06-27 06:45:41'),(14,9070,'BONIFACIO S. SARONA',NULL,'75640','2023-04-10','PSC',0,'MARISSA',NULL,'SARONA',NULL,'2023-04-10','Approved','No','No',NULL,0,'2023-06-27 06:47:54','2023-06-27 06:47:54'),(15,2157,'PEDRITO J. CABISADA',NULL,'75640','2023-04-24','PSC',0,'ARLYN','C.','LIBRANDO',NULL,'2023-04-25','Approved','Yes','No',NULL,0,'2023-06-27 06:49:06','2023-06-27 06:49:06'),(16,10866,'EGLESERIO SANTOYO','09631251956','75640','2023-04-24','N/A',0,'JOSEPHINE','L.','SANTONYO',NULL,'2023-04-25','Approved','Yes','Yes',NULL,0,'2023-06-27 06:50:41','2023-06-27 06:50:41'),(17,9627,'TESSILYN  T. CAJILIG',NULL,'75640','2023-04-19','PSC',0,'ALPHER JOHN','T.','CAJILIG',NULL,'2023-04-25','Approved','No','Yes',NULL,1,'2023-06-27 06:52:18','2023-06-27 06:54:26'),(18,4205,'EMILIE B. ESTOCE','9091710484','75640','2023-04-25','PSC',0,'DONNA LOU','E.','VILLAREAL',NULL,'2023-04-26','Approved','No','Yes',NULL,0,'2023-06-27 06:54:05','2023-06-27 06:54:05'),(19,6430,'JOHNNY  R. MALUBAY',NULL,'75640','2023-04-28','LEYTE',0,'MARNELLE','M.','MALUBAY',NULL,'2023-04-27','Approved','No','Yes',NULL,0,'2023-06-27 06:55:55','2023-06-27 06:55:55'),(20,7428,'EMELIANO B. SR. ORAIZ','9092745566','75640','2023-04-27','PSC',0,'ESTERLITA','B.','ORAIZ',NULL,'2023-05-02','Approved','Yes','Yes',NULL,0,'2023-06-27 07:01:34','2023-06-27 07:01:34'),(21,5516,'ISAIAS  B. JUGAR','9554319223','75640','2023-05-01','PSC',0,'ANNA LIZA','J.','QUIROS',NULL,'2023-05-03','Approved','Yes','Yes',NULL,0,'2023-06-27 07:03:58','2023-06-27 07:03:58'),(22,9436,'MARCELO D. SOTA',NULL,'75640','2023-04-29','PSC',0,'REYNALDO','F.','SOTA',NULL,'2023-05-03','Approved','Yes','No',NULL,0,'2023-06-27 07:06:55','2023-06-27 07:06:55'),(23,901,'PERLA C. BABOR',NULL,'75640','2023-04-12','BUKIDNON',0,'PERRYL','B.','CESAR',NULL,'2023-05-04','Approved','Distant','Yes',NULL,0,'2023-06-27 07:08:24','2023-06-27 07:08:24'),(24,791,'EMILY J. ASCAÑO',NULL,'75640','2023-05-05','GSC',0,'VICTOR','J.','ASCAÑO',NULL,'2023-05-09','Approved','No','Yes',NULL,0,'2023-06-27 07:09:55','2023-06-27 07:09:55'),(25,8915,'NORMA Y. SALMORIN','9352876919','75640','2023-04-09','PSC',0,'RODEL','Y.','SALMORIN',NULL,'2023-05-10','Approved','Yes','Yes',NULL,0,'2023-06-27 07:11:10','2023-06-27 07:11:10'),(26,10972,'DARYLL DIEGO','09971989303','75640','2023-05-06','DAVAO',0,'MECHAEL','B.','DIEGO',NULL,'2023-05-10','Approved','Distant','Yes',NULL,0,'2023-06-27 07:12:47','2023-06-27 07:12:47'),(27,2591,'EDUARDO  CASTAÑEDA','0917753767','75640','2023-04-19','GSC',0,'LILIAN','C.','CASTANEDA',NULL,'2023-05-10','Approved','Yes','Yes',NULL,0,'2023-06-27 07:13:55','2023-06-27 07:13:55'),(28,9676,'JULIETA I. TAHIL','9501546779','75640','2023-05-13','PSC',0,'EDILBERTO','C.','TAHIL',NULL,'2023-05-11','Approved','Yes','No',NULL,0,'2023-06-27 07:14:58','2023-06-27 07:14:58'),(29,9432,'NOEMI B. SOSOBAN','9129802755','75640','2023-05-11','PSC',0,'RICHARD','B.','SOSOHAN',NULL,'2023-05-11','Approved','Yes','Yes',NULL,0,'2023-06-27 07:16:13','2023-06-27 07:16:13'),(30,10592,'RICHIE DEAN C. ZERRUDO',NULL,'75640','2023-04-15','PSC',0,'RICHIE DEAN','B.','SOSOHAN',NULL,'2023-05-11','Approved','No','No',NULL,0,'2023-06-27 07:17:12','2023-06-27 07:17:12'),(31,479,'JUSTINIANO B. SR.  AMPO','9069318561','75640','2023-05-12','PSC',0,'JANICE','A.','DAQUERA',NULL,'2023-05-12','Approved','Yes','Yes',NULL,0,'2023-06-27 07:19:00','2023-06-27 07:19:00'),(32,1712,'SONNY  BERNAL','09482895462','75640','2023-06-13','PSC',0,'REMA','T.','BERNAL',NULL,'2023-05-17','Approved','Yes','Yes',NULL,0,'2023-06-27 07:19:53','2023-06-27 07:19:53'),(33,10768,'TERESITA A. GILAGA',NULL,'75640','2023-05-15','PSC',0,'ERLINDA','G.','SILVANO',NULL,'2023-05-18','Approved','Yes','Yes',NULL,0,'2023-06-27 07:22:00','2023-06-27 07:22:00'),(34,3639,'ERNESTO A. DIGNADICE','9187184070','75640','2023-05-15','GSC',0,'KRISTINA MARIE','D.','SAMSONA',NULL,'2023-05-22','Approved','No','Yes',NULL,0,'2023-06-27 07:24:19','2023-06-27 07:24:19'),(35,7595,'JAIME S. PADILLA','09262082736','75640','2023-05-23','TANTANGAN',0,'NENA','C.','PADILLA',NULL,'2023-07-23','Approved','No','Yes',NULL,0,'2023-06-27 07:25:20','2023-06-27 07:25:20'),(36,5968,'ANGELA LIBRADO',NULL,'75640','2023-05-24','NEGROS',0,'ROSARIO','L.','ARGEL',NULL,'2023-05-23','Approved','Distant','Yes',NULL,0,'2023-06-27 07:32:57','2023-06-27 07:32:57'),(37,10378,'CESAR  T. VILLANUEVA','9076917767','75640','2023-05-23','PSC',0,'MIRAFE',NULL,'VILLANUEVA',NULL,'2023-05-24','Approved','Yes','Yes',NULL,0,'2023-06-27 07:34:31','2023-06-27 07:34:31'),(38,4370,'OSCAR D. FERNANDEZ','9387026819','75640','2023-05-24','PSC',0,'IRENE','D.','FERNANDEZ',NULL,'2023-05-26','Approved','Yes','Yes',NULL,0,'2023-06-27 07:35:26','2023-06-27 07:35:26'),(39,10434,'TERESITA N. VILLAVICENCIO',NULL,'75640','2023-04-06','GSC',0,'ARLEEN','V.','RUIZ',NULL,'2023-05-26','Approved','Yes','No',NULL,0,'2023-06-27 07:36:39','2023-06-27 07:36:39'),(40,2791,'NORMA E. CERVO','9063094416','75640','2023-05-15','MANILA',0,'NORMINDA','E.','CERVO',NULL,'2023-05-26','Approved','Distant','Yes',NULL,0,'2023-06-27 07:37:45','2023-06-27 07:37:45'),(41,3888,'MARINA  L. EBUETADA','9197733880','75640','2023-05-24','PSC',0,'ROCHEVILLE','E.','LACO',NULL,'2023-05-28','Approved','Yes','Yes',NULL,0,'2023-06-27 07:39:22','2023-06-27 07:39:22'),(42,4140,'MANUEL  ESPERO','09177004789','75640','2023-04-03','MANILA',0,'LOURDES','S.','ESPERO',NULL,'2023-05-28','Approved','Distant','Yes',NULL,0,'2023-06-27 07:40:24','2023-06-27 07:40:24'),(43,837,'JARIA BADRUDIN','9679735607','75640','2023-05-23','GSC',0,'NORWESA','E.','BADRUDIN',NULL,'2023-05-28','Approved','Islam','Yes',NULL,0,'2023-06-27 07:41:22','2023-06-27 07:41:22'),(44,8568,'ADELA C. ROBLE','09075210249','75640','2023-05-27','MALUNGON',0,'JODILYN','C.','ROBLE',NULL,'2023-05-31','Approved','Distant','Yes',NULL,0,'2023-06-27 07:43:41','2023-06-27 07:43:41'),(45,8528,'OFELIA  REUBAL','9465085605','75640','2023-05-31','PSC',0,'JESSIE ','A.','REUBAL',NULL,'2023-05-31','Approved','Yes','Yes',NULL,0,'2023-06-27 07:44:51','2023-06-27 07:44:51'),(46,9116,'NESTOR SEGURA','09469443178','75640','2023-06-01','PSC',0,'ERLINDA','G.','SEGURA',NULL,'2023-06-02','Approved','Yes','Yes',NULL,0,'2023-06-27 07:45:48','2023-06-27 07:45:48'),(47,2571,'LUZ MERLY  CASIDSID','09284350590','75640','2023-06-01','GSC',0,'CHERYL','C.','EXCLAMADOR',NULL,'2023-06-05','Approved','Yes','Yes',NULL,0,'2023-06-27 07:46:54','2023-06-27 07:46:54'),(48,5672,'PANFILO S. LADERA','9700916780','75640','2023-06-02','PSC',0,'NELIE','M.','LADERA',NULL,'2023-06-05','Approved','Yes','Yes',NULL,0,'2023-06-27 07:48:08','2023-06-27 07:48:08'),(49,3345,'ERNESTO  DECLARO','09556787227','75640','2023-06-05','PSC',0,'ANGELYN','D.','ORACION',NULL,'2023-06-05','Approved','Yes','No',NULL,0,'2023-06-27 07:50:20','2023-06-27 07:50:20'),(50,5564,'CORA A. JURIN','9058499666','75640','2023-05-31','GSC',0,'RIZALIN','A.','AGUANA',NULL,'2023-06-05','Approved','No','No',NULL,0,'2023-06-27 07:52:00','2023-06-27 07:52:00'),(51,4642,'FRANCISCA  C. GALLANO','9216747637','75640','2023-06-03','PSC',0,'SHEENG ','G.','MERCADO',NULL,'2023-06-06','Approved','Yes','No',NULL,0,'2023-06-27 07:55:41','2023-06-27 07:55:41'),(52,5728,'HONORIO  LAMANOSA','09302317185','75640','2023-05-20','PSC',0,'CHERYL','L.','DESIERTO',NULL,'2023-06-09','Approved','Distant','Yes',NULL,0,'2023-06-27 07:56:40','2023-06-27 07:56:40'),(53,8798,'ROQUE S. SACOTE',NULL,'75640','2023-06-11','PSC',0,'THERESA','J.','SACOTE',NULL,'2023-06-13','Approved','Yes','No',NULL,0,'2023-06-27 07:58:32','2023-06-27 07:58:32'),(54,10069,'GABRIEL R. TRAZO','9309711212','75640','2023-03-10','PSC',0,'ENOLFA',NULL,'TRAZO',NULL,'2023-03-10','Approved','No','Yes','4',0,'2023-07-11 03:40:53','2023-07-11 03:40:53');
/*!40000 ALTER TABLE `mortuaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mortuary_attachments`
--

DROP TABLE IF EXISTS `mortuary_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mortuary_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `documentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mortuary_attachments_documentable_type_documentable_id_index` (`documentable_type`,`documentable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mortuary_attachments`
--

LOCK TABLES `mortuary_attachments` WRITE;
/*!40000 ALTER TABLE `mortuary_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `mortuary_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_attachments`
--

DROP TABLE IF EXISTS `payment_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_attachments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `documentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentable_id` bigint unsigned NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_attachments_documentable_type_documentable_id_index` (`documentable_type`,`documentable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_attachments`
--

LOCK TABLES `payment_attachments` WRITE;
/*!40000 ALTER TABLE `payment_attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `health_id` bigint unsigned NOT NULL,
  `date_of_payment` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purposes`
--

DROP TABLE IF EXISTS `purposes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purposes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purposes`
--

LOCK TABLES `purposes` WRITE;
/*!40000 ALTER TABLE `purposes` DISABLE KEYS */;
INSERT INTO `purposes` VALUES (1,'Medical Assistance','2023-06-20 01:10:41','2023-06-20 01:10:41'),(2,'Community/Event Sponsorship','2023-06-20 01:10:41','2023-06-20 01:10:41'),(3,'School Assistance','2023-06-20 01:10:41','2023-06-20 01:10:41'),(4,'Church Assistance','2023-06-20 01:10:41','2023-06-20 01:10:41'),(5,'General Assembly','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `purposes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_headers`
--

DROP TABLE IF EXISTS `report_headers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_headers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `report_id` bigint unsigned NOT NULL,
  `report_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_headers_report_id_index` (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_headers`
--

LOCK TABLES `report_headers` WRITE;
/*!40000 ALTER TABLE `report_headers` DISABLE KEYS */;
INSERT INTO `report_headers` VALUES (1,1,'Health - Members & Dependent','Health - Members & Dependent','2023-06-20 01:10:41','2023-06-20 01:10:41'),(2,1,'Transmittals','Transmittals','2023-06-20 01:10:41','2023-06-20 01:10:41'),(3,2,'Death - Members & Dependent','Death - Members & Dependent','2023-06-20 01:10:41','2023-06-20 01:10:41'),(4,4,'Mortuary Benefits','Mortuary Benefits','2023-06-20 01:10:41','2023-06-20 01:10:41'),(5,5,'Cash Advances','Cash Advances','2023-06-20 01:10:41','2023-06-20 01:10:41'),(6,6,'Community Relations','Community Relations Report','2023-06-20 01:10:41','2023-06-20 01:10:41'),(7,1,'Paid','Paid','2023-06-20 01:10:41','2023-06-20 01:10:41'),(8,1,'Encoded','Encoded','2023-06-20 01:10:41','2023-06-20 01:10:41'),(9,1,'Below 10k','Below 10K Daily Payment','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `report_headers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report_signatories`
--

DROP TABLE IF EXISTS `report_signatories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_signatories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `report_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_signatories_report_id_index` (`report_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_signatories`
--

LOCK TABLES `report_signatories` WRITE;
/*!40000 ALTER TABLE `report_signatories` DISABLE KEYS */;
INSERT INTO `report_signatories` VALUES (1,3,'VINCENT E. PALMA','Chairman of the Board','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `report_signatories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,'health','2023-06-20 01:10:41','2023-06-20 01:10:41'),(2,'death','2023-06-20 01:10:41','2023-06-20 01:10:41'),(3,'log','2023-06-20 01:10:41','2023-06-20 01:10:41'),(4,'mortuary','2023-06-20 01:10:41','2023-06-20 01:10:41'),(5,'cash advance','2023-06-20 01:10:41','2023-06-20 01:10:41'),(6,'community relations','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2023-06-20 01:10:41','2023-06-20 01:10:41'),(2,'user','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `signatories`
--

DROP TABLE IF EXISTS `signatories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `signatories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `report_header_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `signatories_report_header_id_index` (`report_header_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `signatories`
--

LOCK TABLES `signatories` WRITE;
/*!40000 ALTER TABLE `signatories` DISABLE KEYS */;
INSERT INTO `signatories` VALUES (1,1,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(2,1,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:39:26'),(3,1,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(4,2,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(5,2,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:39:41'),(6,2,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(7,7,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(8,7,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:41:12'),(9,7,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(10,8,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(11,8,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:41:24'),(12,8,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(13,9,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(14,9,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:41:34'),(15,9,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(16,10,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(17,10,'JOHN EFFIE T. BELARMA','Membership Supervisor','Checked by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(18,10,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(19,3,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(20,3,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:40:22'),(21,3,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(22,11,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(23,11,'JOHN EFFIE T. BELARMA','Membership Supervisor','Checked by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(24,11,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(25,4,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(26,4,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:40:33'),(27,4,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(28,12,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(29,12,'JOHN EFFIE T. BELARMA','Membership Supervisor','Checked by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(30,12,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(31,5,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(32,5,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:40:45'),(33,5,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(34,6,'FUNNY C. BALENDES','Member Benefits-in-charge','Prepaid by','2023-06-20 01:10:41','2023-06-20 01:10:41'),(35,6,NULL,NULL,'Received by','2023-06-20 01:10:41','2023-06-26 12:41:02'),(36,6,'MYTHEL FAITH S. MANLANGIT','CAD Department Head','Conformed by','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `signatories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supervisor_codes`
--

DROP TABLE IF EXISTS `supervisor_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supervisor_codes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supervisor_codes`
--

LOCK TABLES `supervisor_codes` WRITE;
/*!40000 ALTER TABLE `supervisor_codes` DISABLE KEYS */;
INSERT INTO `supervisor_codes` VALUES (1,'12345','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `supervisor_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transmittals`
--

DROP TABLE IF EXISTS `transmittals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transmittals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `health_id` bigint unsigned NOT NULL,
  `batch_number` int NOT NULL,
  `date_transmitted` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=412 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transmittals`
--

LOCK TABLES `transmittals` WRITE;
/*!40000 ALTER TABLE `transmittals` DISABLE KEYS */;
INSERT INTO `transmittals` VALUES (1,1,2,'2023-06-30','2023-06-29 19:59:31','2023-06-29 19:59:31'),(2,2,2,'2023-06-30','2023-06-29 19:59:45','2023-06-29 19:59:45'),(3,3,2,'2023-06-30','2023-06-29 19:59:54','2023-06-29 19:59:54'),(4,4,2,'2023-06-30','2023-06-29 20:00:21','2023-06-29 20:00:21'),(5,5,2,'2023-06-30','2023-06-29 20:00:30','2023-06-29 20:00:30'),(6,6,2,'2023-06-30','2023-06-29 20:00:40','2023-06-29 20:00:40'),(7,7,2,'2023-06-30','2023-06-29 20:00:51','2023-06-29 20:00:51'),(8,8,2,'2023-06-30','2023-06-29 20:01:28','2023-06-29 20:01:28'),(9,9,2,'2023-06-30','2023-06-29 20:01:38','2023-06-29 20:01:38'),(10,10,2,'2023-06-30','2023-06-29 20:01:49','2023-06-29 20:01:49'),(11,11,2,'2023-06-30','2023-06-29 20:02:07','2023-06-29 20:02:07'),(12,12,2,'2023-06-30','2023-06-29 20:02:16','2023-06-29 20:02:16'),(13,13,2,'2023-06-30','2023-06-29 20:02:27','2023-06-29 20:02:27'),(14,14,2,'2023-06-30','2023-06-29 20:02:38','2023-06-29 20:02:38'),(15,15,2,'2023-06-30','2023-06-29 20:02:48','2023-06-29 20:02:48'),(16,16,2,'2023-06-30','2023-06-29 20:02:58','2023-06-29 20:02:58'),(17,17,2,'2023-06-30','2023-06-29 20:03:08','2023-06-29 20:03:08'),(18,18,2,'2023-06-30','2023-06-29 20:03:19','2023-06-29 20:03:19'),(19,19,2,'2023-06-30','2023-06-29 20:03:31','2023-06-29 20:03:31'),(20,20,2,'2023-06-30','2023-06-29 20:03:41','2023-06-29 20:03:41'),(21,21,2,'2023-06-30','2023-06-29 20:03:59','2023-06-29 20:03:59'),(22,22,2,'2023-06-30','2023-06-29 20:04:11','2023-06-29 20:04:11'),(23,23,2,'2023-06-30','2023-06-29 20:04:23','2023-06-29 20:04:23'),(24,24,2,'2023-06-30','2023-06-29 20:04:36','2023-06-29 20:04:36'),(25,25,2,'2023-06-30','2023-06-29 20:05:00','2023-06-29 20:05:00'),(26,26,2,'2023-06-30','2023-06-29 20:05:10','2023-06-29 20:05:10'),(27,27,2,'2023-06-30','2023-06-29 20:05:20','2023-06-29 20:05:20'),(28,28,2,'2023-06-30','2023-06-29 20:05:31','2023-06-29 20:05:31'),(29,29,2,'2023-06-30','2023-06-29 20:05:42','2023-06-29 20:05:42'),(30,30,2,'2023-06-30','2023-06-29 20:05:53','2023-06-29 20:05:53'),(31,31,2,'2023-06-30','2023-06-29 20:06:10','2023-06-29 20:06:10'),(32,33,2,'2023-06-30','2023-06-29 20:06:32','2023-06-29 20:06:32'),(33,34,2,'2023-06-30','2023-06-29 20:06:43','2023-06-29 20:06:43'),(34,35,2,'2023-06-30','2023-06-29 20:06:53','2023-06-29 20:06:53'),(35,36,2,'2023-06-30','2023-06-29 20:07:04','2023-06-29 20:07:04'),(36,37,2,'2023-06-30','2023-06-29 20:07:16','2023-06-29 20:07:16'),(37,38,2,'2023-06-30','2023-06-29 20:07:27','2023-06-29 20:07:27'),(38,40,2,'2023-06-30','2023-06-29 20:07:38','2023-06-29 20:07:38'),(39,41,2,'2023-06-30','2023-06-29 20:07:48','2023-06-29 20:07:48'),(40,42,2,'2023-06-30','2023-06-29 20:08:09','2023-06-29 20:08:09'),(41,43,2,'2023-06-30','2023-06-29 20:08:26','2023-06-29 20:08:26'),(42,44,2,'2023-06-30','2023-06-29 20:08:39','2023-06-29 20:08:39'),(43,45,2,'2023-06-30','2023-06-29 20:08:50','2023-06-29 20:08:50'),(44,46,2,'2023-06-30','2023-06-29 20:09:01','2023-06-29 20:09:01'),(45,47,2,'2023-06-30','2023-06-29 20:09:12','2023-06-29 20:09:12'),(46,48,2,'2023-06-30','2023-06-29 20:09:23','2023-06-29 20:09:23'),(47,49,2,'2023-06-30','2023-06-29 20:09:36','2023-06-29 20:09:36'),(48,51,2,'2023-06-30','2023-06-29 20:09:53','2023-06-29 20:09:53'),(49,52,2,'2023-06-30','2023-06-29 20:10:07','2023-06-29 20:10:07'),(50,53,2,'2023-06-30','2023-06-29 20:10:20','2023-06-29 20:10:20'),(51,54,2,'2023-06-30','2023-06-29 20:10:47','2023-06-29 20:10:47'),(52,55,2,'2023-06-30','2023-06-29 20:10:59','2023-06-29 20:10:59'),(53,56,2,'2023-06-30','2023-06-29 20:11:10','2023-06-29 20:11:10'),(54,57,2,'2023-06-30','2023-06-29 20:15:57','2023-06-29 20:15:57'),(55,58,2,'2023-06-30','2023-06-29 20:16:10','2023-06-29 20:16:10'),(56,59,2,'2023-06-30','2023-06-29 20:16:23','2023-06-29 20:16:23'),(57,60,2,'2023-06-30','2023-06-29 20:16:38','2023-06-29 20:16:38'),(58,61,2,'2023-06-30','2023-06-29 20:16:51','2023-06-29 20:16:51'),(59,62,2,'2023-06-30','2023-06-29 20:17:06','2023-06-29 20:17:06'),(60,63,2,'2023-06-30','2023-06-29 20:17:17','2023-06-29 20:17:17'),(61,64,2,'2023-06-30','2023-06-29 20:17:43','2023-06-29 20:17:43'),(62,65,2,'2023-06-30','2023-06-29 20:17:57','2023-06-29 20:17:57'),(63,66,2,'2023-06-30','2023-06-29 20:18:11','2023-06-29 20:18:11'),(64,67,2,'2023-06-30','2023-06-29 20:18:24','2023-06-29 20:18:24'),(65,68,2,'2023-06-30','2023-06-29 20:18:36','2023-06-29 20:18:36'),(66,69,2,'2023-06-30','2023-06-29 20:18:49','2023-06-29 20:18:49'),(67,70,2,'2023-06-30','2023-06-29 20:19:02','2023-06-29 20:19:02'),(68,71,2,'2023-06-30','2023-06-29 20:19:15','2023-06-29 20:19:15'),(69,72,2,'2023-06-30','2023-06-29 20:19:28','2023-06-29 20:19:28'),(70,73,2,'2023-06-30','2023-06-29 20:21:29','2023-06-29 20:21:29'),(71,74,2,'2023-06-30','2023-06-29 20:21:51','2023-06-29 20:21:51'),(72,75,2,'2023-06-30','2023-06-29 20:22:05','2023-06-29 20:22:05'),(73,76,2,'2023-06-30','2023-06-29 20:22:18','2023-06-29 20:22:18'),(74,77,2,'2023-06-30','2023-06-29 20:22:30','2023-06-29 20:22:30'),(75,78,2,'2023-06-30','2023-06-29 20:22:41','2023-06-29 20:22:41'),(76,79,2,'2023-06-30','2023-06-29 20:22:55','2023-06-29 20:22:55'),(77,80,2,'2023-06-30','2023-06-29 20:23:08','2023-06-29 20:23:08'),(78,81,2,'2023-06-30','2023-06-29 20:23:23','2023-06-29 20:23:23'),(79,82,2,'2023-06-30','2023-06-29 20:23:37','2023-06-29 20:23:37'),(80,83,2,'2023-06-30','2023-06-29 20:23:50','2023-06-29 20:23:50'),(81,84,2,'2023-06-30','2023-06-29 20:24:08','2023-06-29 20:24:08'),(82,85,2,'2023-06-30','2023-06-29 20:24:22','2023-06-29 20:24:22'),(83,86,2,'2023-06-30','2023-06-29 20:24:37','2023-06-29 20:24:37'),(84,87,2,'2023-06-30','2023-06-29 20:24:51','2023-06-29 20:24:51'),(85,88,2,'2023-06-30','2023-06-29 20:25:06','2023-06-29 20:25:06'),(86,89,2,'2023-06-30','2023-06-29 20:25:20','2023-06-29 20:25:20'),(87,90,2,'2023-06-30','2023-06-29 20:25:39','2023-06-29 20:25:39'),(88,91,2,'2023-06-30','2023-06-29 20:26:09','2023-06-29 20:26:09'),(89,94,2,'2023-06-30','2023-06-29 20:26:23','2023-06-29 20:26:23'),(90,95,2,'2023-06-30','2023-06-29 20:26:35','2023-06-29 20:26:35'),(91,96,2,'2023-06-30','2023-06-29 20:26:54','2023-06-29 20:26:54'),(92,97,2,'2023-06-30','2023-06-29 20:27:09','2023-06-29 20:27:09'),(93,98,2,'2023-06-30','2023-06-29 20:27:23','2023-06-29 20:27:23'),(94,99,2,'2023-06-30','2023-06-29 20:27:37','2023-06-29 20:27:37'),(95,100,2,'2023-06-30','2023-06-29 20:29:54','2023-06-29 20:29:54'),(96,103,2,'2023-06-30','2023-06-29 20:30:16','2023-06-29 20:30:16'),(97,104,2,'2023-06-30','2023-06-29 20:30:51','2023-06-29 20:30:51'),(98,105,2,'2023-06-30','2023-06-29 20:31:06','2023-06-29 20:31:06'),(99,106,2,'2023-06-30','2023-06-29 20:31:20','2023-06-29 20:31:20'),(100,107,2,'2023-06-30','2023-06-29 20:36:56','2023-06-29 20:36:56'),(101,108,2,'2023-06-30','2023-06-29 20:37:15','2023-06-29 20:37:15'),(102,109,2,'2023-06-30','2023-06-29 20:37:30','2023-06-29 20:37:30'),(103,110,2,'2023-06-30','2023-06-29 20:37:47','2023-06-29 20:37:47'),(104,111,2,'2023-06-30','2023-06-29 20:38:03','2023-06-29 20:38:03'),(105,112,2,'2023-06-30','2023-06-29 20:38:40','2023-06-29 20:38:40'),(106,113,2,'2023-06-30','2023-06-29 20:39:05','2023-06-29 20:39:05'),(107,114,2,'2023-06-30','2023-06-29 20:39:20','2023-06-29 20:39:20'),(108,115,2,'2023-06-30','2023-06-29 20:39:36','2023-06-29 20:39:36'),(109,116,2,'2023-06-30','2023-06-29 20:41:00','2023-06-29 20:41:00'),(110,117,2,'2023-06-30','2023-06-29 20:41:16','2023-06-29 20:41:16'),(111,118,2,'2023-06-30','2023-06-29 20:41:59','2023-06-29 20:41:59'),(112,119,2,'2023-06-30','2023-06-29 20:43:00','2023-06-29 20:43:00'),(113,120,2,'2023-06-30','2023-06-29 20:43:29','2023-06-29 20:43:29'),(114,121,2,'2023-06-30','2023-06-29 20:43:45','2023-06-29 20:43:45'),(115,122,2,'2023-06-30','2023-06-29 20:44:08','2023-06-29 20:44:08'),(116,123,2,'2023-06-30','2023-06-29 20:44:22','2023-06-29 20:44:22'),(117,124,2,'2023-06-30','2023-06-29 20:44:37','2023-06-29 20:44:37'),(118,125,2,'2023-06-30','2023-06-29 20:44:55','2023-06-29 20:44:55'),(119,126,2,'2023-06-30','2023-06-29 20:45:14','2023-06-29 20:45:14'),(120,127,2,'2023-06-30','2023-06-29 20:45:37','2023-06-29 20:45:37'),(121,128,2,'2023-06-30','2023-06-29 20:46:01','2023-06-29 20:46:01'),(122,129,2,'2023-06-30','2023-06-29 20:46:19','2023-06-29 20:46:19'),(123,130,2,'2023-06-30','2023-06-29 20:46:35','2023-06-29 20:46:35'),(124,131,2,'2023-06-30','2023-06-29 20:46:50','2023-06-29 20:46:50'),(125,132,2,'2023-06-30','2023-06-29 20:47:06','2023-06-29 20:47:06'),(126,133,2,'2023-06-30','2023-06-29 20:47:23','2023-06-29 20:47:23'),(127,134,2,'2023-06-30','2023-06-29 20:49:34','2023-06-29 20:49:34'),(128,135,2,'2023-06-30','2023-06-29 20:50:22','2023-06-29 20:50:22'),(129,137,2,'2023-06-30','2023-06-29 20:51:46','2023-06-29 20:51:46'),(130,138,2,'2023-06-30','2023-06-29 20:52:04','2023-06-29 20:52:04'),(131,139,2,'2023-06-30','2023-06-29 20:57:44','2023-06-29 20:57:44'),(132,140,2,'2023-06-30','2023-07-02 11:35:01','2023-07-02 11:35:01'),(133,141,2,'2023-06-30','2023-07-02 11:35:25','2023-07-02 11:35:25'),(134,142,2,'2023-06-30','2023-07-02 11:36:32','2023-07-02 11:36:32'),(135,143,2,'2023-06-30','2023-07-02 11:36:45','2023-07-02 11:36:45'),(136,144,2,'2023-06-30','2023-07-02 11:36:58','2023-07-02 11:36:58'),(137,145,2,'2023-06-30','2023-07-02 11:37:21','2023-07-02 11:37:21'),(138,146,2,'2023-06-30','2023-07-02 11:37:35','2023-07-02 11:37:35'),(139,147,2,'2023-06-30','2023-07-02 11:37:50','2023-07-02 11:37:50'),(140,148,2,'2023-06-30','2023-07-02 11:38:02','2023-07-02 11:38:30'),(141,149,2,'2023-06-30','2023-07-02 11:39:49','2023-07-02 11:39:49'),(142,150,2,'2023-06-30','2023-07-02 11:40:09','2023-07-02 11:40:09'),(143,151,2,'2023-06-30','2023-07-02 11:40:24','2023-07-02 11:40:24'),(144,152,2,'2023-07-30','2023-07-02 13:21:48','2023-07-02 13:21:48'),(145,153,2,'2023-07-30','2023-07-02 13:21:56','2023-07-02 13:21:56'),(146,154,2,'2023-07-30','2023-07-02 13:22:32','2023-07-02 13:22:32'),(147,155,2,'2023-06-30','2023-07-02 13:23:05','2023-07-02 13:23:05'),(148,156,2,'2023-06-30','2023-07-02 13:23:47','2023-07-02 13:23:47'),(149,157,2,'2023-06-30','2023-07-02 13:25:22','2023-07-02 13:25:22'),(150,158,2,'2023-06-30','2023-07-02 13:25:31','2023-07-02 13:25:31'),(151,159,2,'2023-06-30','2023-07-02 13:25:57','2023-07-02 13:25:57'),(152,160,2,'2023-06-30','2023-07-02 13:26:14','2023-07-02 13:26:14'),(153,161,2,'2023-06-30','2023-07-02 13:26:24','2023-07-02 13:26:24'),(154,162,2,'2023-06-30','2023-07-02 13:26:51','2023-07-02 13:26:51'),(155,163,2,'2023-06-30','2023-07-02 13:27:02','2023-07-02 13:27:02'),(156,164,2,'2023-06-30','2023-07-02 13:27:12','2023-07-02 13:27:12'),(157,165,2,'2023-06-30','2023-07-02 13:27:29','2023-07-02 13:27:29'),(158,166,2,'2023-06-30','2023-07-02 13:27:39','2023-07-02 13:27:39'),(159,167,2,'2023-06-30','2023-07-02 13:27:51','2023-07-02 13:27:51'),(160,168,2,'2023-06-30','2023-07-02 13:28:02','2023-07-02 13:28:02'),(161,169,2,'2023-06-30','2023-07-02 13:28:19','2023-07-02 13:28:19'),(162,170,2,'2023-06-30','2023-07-02 13:28:31','2023-07-02 13:28:31'),(163,171,2,'2023-06-30','2023-07-02 13:28:42','2023-07-02 13:28:42'),(164,172,2,'2023-06-30','2023-07-02 13:28:53','2023-07-02 13:28:53'),(165,173,2,'2023-06-30','2023-07-02 13:29:03','2023-07-02 13:29:03'),(166,174,2,'2023-06-30','2023-07-02 13:29:15','2023-07-02 13:29:15'),(167,175,2,'2023-06-30','2023-07-02 13:29:25','2023-07-02 13:29:25'),(168,176,2,'2023-06-30','2023-07-02 13:29:37','2023-07-02 13:29:37'),(169,177,2,'2023-06-30','2023-07-02 13:29:52','2023-07-02 13:29:52'),(170,178,2,'2023-06-30','2023-07-02 13:30:02','2023-07-02 13:30:02'),(171,179,2,'2023-06-30','2023-07-02 13:31:19','2023-07-02 13:31:19'),(172,180,2,'2023-06-30','2023-07-02 13:31:37','2023-07-02 13:31:37'),(173,181,2,'2023-06-30','2023-07-02 13:31:50','2023-07-02 13:31:50'),(174,182,2,'2023-06-30','2023-07-02 13:32:03','2023-07-02 13:32:03'),(175,183,2,'2023-06-30','2023-07-02 13:32:24','2023-07-02 13:32:24'),(176,184,2,'2023-06-30','2023-07-02 13:32:35','2023-07-02 13:32:35'),(177,185,2,'2023-06-30','2023-07-02 13:32:47','2023-07-02 13:32:47'),(178,186,2,'2023-06-30','2023-07-02 13:32:57','2023-07-02 13:32:57'),(179,187,2,'2023-06-30','2023-07-02 13:33:08','2023-07-02 13:33:08'),(180,188,2,'2023-06-30','2023-07-02 13:33:18','2023-07-02 13:33:18'),(181,189,2,'2023-06-30','2023-07-02 13:34:31','2023-07-02 13:34:31'),(182,190,2,'2023-06-30','2023-07-02 13:34:46','2023-07-02 13:34:46'),(183,191,2,'2023-06-30','2023-07-02 13:34:55','2023-07-02 13:34:55'),(184,192,2,'2023-06-30','2023-07-02 13:35:08','2023-07-02 13:35:08'),(185,193,2,'2023-06-30','2023-07-02 13:35:25','2023-07-02 13:35:25'),(186,194,2,'2023-06-30','2023-07-02 13:35:36','2023-07-02 13:35:36'),(187,195,2,'2023-06-30','2023-07-02 13:35:48','2023-07-02 13:35:48'),(188,196,2,'2023-06-30','2023-07-02 13:36:03','2023-07-02 13:36:03'),(189,197,2,'2023-06-30','2023-07-02 13:36:13','2023-07-02 13:36:13'),(190,198,2,'2023-06-30','2023-07-02 13:36:24','2023-07-02 13:36:24'),(191,199,2,'2023-06-30','2023-07-02 13:38:40','2023-07-02 13:38:40'),(192,200,2,'2023-06-30','2023-07-02 13:39:04','2023-07-02 13:39:04'),(193,201,2,'2023-06-30','2023-07-02 13:39:27','2023-07-02 13:39:27'),(194,202,2,'2023-06-30','2023-07-02 13:39:39','2023-07-02 13:39:39'),(195,203,2,'2023-06-30','2023-07-02 13:39:50','2023-07-02 13:39:50'),(196,204,2,'2023-06-30','2023-07-02 13:40:03','2023-07-02 13:40:03'),(197,205,2,'2023-06-30','2023-07-02 13:40:15','2023-07-02 13:40:15'),(198,206,2,'2023-06-30','2023-07-02 13:40:25','2023-07-02 13:40:25'),(199,207,2,'2023-06-30','2023-07-02 13:40:36','2023-07-02 13:40:36'),(200,208,2,'2023-06-30','2023-07-02 13:40:47','2023-07-02 13:40:47'),(201,209,2,'2023-06-30','2023-07-02 13:42:00','2023-07-02 13:42:00'),(202,210,2,'2023-06-30','2023-07-02 13:42:11','2023-07-02 13:42:11'),(203,211,2,'2023-06-30','2023-07-02 13:42:25','2023-07-02 13:42:25'),(204,212,2,'2023-06-30','2023-07-02 13:42:39','2023-07-02 13:42:39'),(205,213,2,'2023-06-30','2023-07-02 13:42:50','2023-07-02 13:42:50'),(206,214,2,'2023-06-30','2023-07-02 13:43:01','2023-07-02 13:43:01'),(207,215,2,'2023-06-30','2023-07-02 13:43:11','2023-07-02 13:43:11'),(208,216,2,'2023-06-30','2023-07-02 13:43:23','2023-07-02 13:43:23'),(209,217,2,'2023-06-30','2023-07-02 13:43:34','2023-07-02 13:43:34'),(210,218,2,'2023-06-30','2023-07-02 13:43:44','2023-07-02 13:43:44'),(211,219,2,'2023-06-30','2023-07-02 14:02:58','2023-07-02 14:02:58'),(212,221,2,'2023-06-30','2023-07-02 14:03:09','2023-07-02 14:03:09'),(213,223,2,'2023-06-30','2023-07-02 14:03:22','2023-07-02 14:03:22'),(214,224,2,'2023-06-30','2023-07-02 14:03:34','2023-07-02 14:03:34'),(215,225,2,'2023-06-30','2023-07-02 14:03:52','2023-07-02 14:03:52'),(216,226,2,'2023-06-30','2023-07-02 14:04:05','2023-07-02 14:04:05'),(217,228,2,'2023-06-30','2023-07-02 14:04:17','2023-07-02 14:04:17'),(218,229,2,'2023-06-30','2023-07-02 14:04:31','2023-07-02 14:04:31'),(219,230,2,'2023-06-30','2023-07-02 14:04:43','2023-07-02 14:04:43'),(220,231,2,'2023-07-02','2023-07-02 14:04:53','2023-07-02 14:04:53'),(221,232,2,'2023-07-02','2023-07-02 14:05:07','2023-07-02 14:05:07'),(222,233,2,'2023-06-30','2023-07-02 14:05:33','2023-07-02 14:05:33'),(223,234,2,'2023-06-30','2023-07-02 14:05:52','2023-07-02 14:05:52'),(224,235,2,'2023-06-30','2023-07-02 14:06:05','2023-07-02 14:06:05'),(225,236,2,'2023-06-30','2023-07-02 14:06:48','2023-07-02 14:06:48'),(226,237,2,'2023-06-30','2023-07-02 14:07:06','2023-07-02 14:07:06'),(227,238,2,'2023-06-30','2023-07-02 14:07:20','2023-07-02 14:07:20'),(228,239,2,'2023-06-30','2023-07-02 14:07:33','2023-07-02 14:07:33'),(229,240,2,'2023-06-30','2023-07-02 14:08:13','2023-07-02 14:08:13'),(230,241,2,'2023-06-30','2023-07-02 14:08:30','2023-07-02 14:08:30'),(231,242,2,'2023-06-30','2023-07-02 14:08:47','2023-07-02 14:08:47'),(232,243,2,'2023-06-30','2023-07-02 14:09:14','2023-07-02 14:09:14'),(233,244,2,'2023-07-02','2023-07-02 14:09:35','2023-07-02 14:09:35'),(234,245,2,'2023-06-30','2023-07-02 14:09:51','2023-07-02 14:09:51'),(235,246,2,'2023-06-30','2023-07-02 14:10:07','2023-07-02 14:10:07'),(236,247,2,'2023-06-30','2023-07-02 14:10:19','2023-07-02 14:10:19'),(237,248,2,'2023-06-30','2023-07-02 14:10:32','2023-07-02 14:10:32'),(238,249,2,'2023-06-30','2023-07-02 14:10:46','2023-07-02 14:10:46'),(239,250,2,'2023-06-30','2023-07-02 14:10:58','2023-07-02 14:10:58'),(240,251,2,'2023-06-30','2023-07-02 14:11:12','2023-07-02 14:11:12'),(241,252,2,'2023-06-30','2023-07-02 14:11:34','2023-07-02 14:11:34'),(242,253,2,'2023-06-30','2023-07-02 14:11:51','2023-07-02 14:11:51'),(243,254,2,'2023-06-30','2023-07-02 14:12:03','2023-07-02 14:12:03'),(244,255,2,'2023-06-30','2023-07-02 14:12:22','2023-07-02 14:12:22'),(245,257,2,'2023-06-30','2023-07-02 14:12:36','2023-07-02 14:12:36'),(246,258,2,'2023-06-30','2023-07-02 14:12:50','2023-07-02 14:12:50'),(247,259,2,'2023-06-30','2023-07-02 14:13:03','2023-07-02 14:13:03'),(248,260,2,'2023-06-30','2023-07-02 14:13:20','2023-07-02 14:13:20'),(249,261,2,'2023-06-30','2023-07-02 14:14:48','2023-07-02 14:14:48'),(250,262,2,'2023-06-30','2023-07-02 14:15:03','2023-07-02 14:15:03'),(251,263,2,'2023-06-30','2023-07-02 14:15:38','2023-07-02 14:15:38'),(252,264,2,'2023-06-30','2023-07-02 14:17:46','2023-07-02 14:17:46'),(253,265,2,'2023-06-30','2023-07-02 14:18:05','2023-07-02 14:18:05'),(254,266,2,'2023-06-30','2023-07-02 14:18:24','2023-07-02 14:18:24'),(255,267,2,'2023-06-30','2023-07-02 14:18:45','2023-07-02 14:18:45'),(256,268,2,'2023-06-30','2023-07-02 14:19:06','2023-07-02 14:19:06'),(257,269,2,'2023-06-30','2023-07-02 14:19:24','2023-07-02 14:19:24'),(258,270,2,'2023-06-30','2023-07-02 14:19:43','2023-07-02 14:19:43'),(259,271,2,'2023-06-30','2023-07-02 14:20:00','2023-07-02 14:20:00'),(260,272,2,'2023-06-30','2023-07-02 14:20:18','2023-07-02 14:20:18'),(261,273,2,'2023-06-30','2023-07-02 14:24:42','2023-07-02 14:24:42'),(262,274,2,'2023-06-30','2023-07-02 14:25:12','2023-07-02 14:25:12'),(263,275,2,'2023-06-30','2023-07-02 14:25:31','2023-07-02 14:25:31'),(264,276,2,'2023-06-30','2023-07-02 14:27:59','2023-07-02 14:27:59'),(265,277,2,'2023-06-30','2023-07-02 14:28:29','2023-07-02 14:28:29'),(266,278,2,'2023-06-30','2023-07-02 14:28:41','2023-07-02 14:28:41'),(267,279,2,'2023-06-30','2023-07-02 14:28:55','2023-07-02 14:28:55'),(268,280,2,'2023-06-30','2023-07-02 14:29:04','2023-07-02 14:29:04'),(269,281,2,'2023-06-30','2023-07-02 14:29:13','2023-07-02 14:29:13'),(270,282,2,'2023-06-30','2023-07-02 14:29:21','2023-07-02 14:29:21'),(271,283,2,'2023-06-30','2023-07-02 14:51:46','2023-07-02 14:51:46'),(272,284,2,'2023-06-30','2023-07-02 14:52:02','2023-07-02 14:52:02'),(273,285,2,'2023-06-30','2023-07-02 14:52:10','2023-07-02 14:52:10'),(274,286,2,'2023-06-30','2023-07-02 14:52:20','2023-07-02 14:52:20'),(275,287,2,'2023-06-30','2023-07-02 14:52:29','2023-07-02 14:52:29'),(276,288,2,'2023-06-30','2023-07-02 14:52:37','2023-07-02 14:52:37'),(277,289,2,'2023-06-30','2023-07-02 14:52:46','2023-07-02 14:52:46'),(278,290,2,'2023-07-02','2023-07-02 14:52:53','2023-07-02 14:52:53'),(279,291,2,'2023-06-30','2023-07-02 14:53:17','2023-07-02 14:53:17'),(280,292,2,'2023-06-30','2023-07-02 14:53:26','2023-07-02 14:53:26'),(281,293,2,'2023-07-02','2023-07-02 14:53:48','2023-07-02 14:53:48'),(282,294,2,'2023-06-30','2023-07-02 14:53:59','2023-07-02 14:53:59'),(283,295,2,'2023-06-30','2023-07-02 14:54:08','2023-07-02 14:54:08'),(284,296,2,'2023-06-30','2023-07-02 14:54:32','2023-07-02 14:54:32'),(285,297,2,'2023-06-30','2023-07-02 14:54:41','2023-07-02 14:54:41'),(286,298,2,'2023-06-30','2023-07-02 14:55:01','2023-07-02 14:55:01'),(287,299,2,'2023-06-30','2023-07-02 14:55:44','2023-07-02 14:55:44'),(288,300,2,'2023-06-30','2023-07-02 14:55:55','2023-07-02 14:55:55'),(289,301,2,'2023-06-30','2023-07-02 14:56:26','2023-07-02 14:56:26'),(290,302,2,'2023-06-30','2023-07-02 14:56:36','2023-07-02 14:56:36'),(291,303,2,'2023-06-30','2023-07-02 14:57:28','2023-07-02 14:57:28'),(292,304,2,'2023-06-30','2023-07-02 14:57:37','2023-07-02 14:57:37'),(293,305,2,'2023-06-30','2023-07-02 14:57:48','2023-07-02 14:57:48'),(294,306,2,'2023-06-30','2023-07-02 14:58:13','2023-07-02 14:58:13'),(295,307,2,'2023-06-30','2023-07-02 14:58:36','2023-07-02 14:58:36'),(296,308,2,'2023-06-30','2023-07-02 14:59:05','2023-07-02 14:59:05'),(297,309,2,'2023-06-30','2023-07-02 14:59:15','2023-07-02 14:59:15'),(298,310,2,'2023-06-30','2023-07-02 14:59:26','2023-07-02 14:59:26'),(299,311,2,'2023-07-02','2023-07-02 14:59:33','2023-07-02 14:59:33'),(300,312,2,'2023-06-30','2023-07-02 14:59:43','2023-07-02 14:59:43'),(301,313,2,'2023-06-30','2023-07-02 15:17:09','2023-07-02 15:17:09'),(302,314,2,'2023-06-30','2023-07-02 15:17:49','2023-07-02 15:17:49'),(303,315,2,'2023-06-30','2023-07-02 15:18:26','2023-07-02 15:18:26'),(304,316,2,'2023-06-30','2023-07-02 15:19:05','2023-07-02 15:19:05'),(305,317,2,'2023-06-30','2023-07-02 15:20:09','2023-07-02 15:20:09'),(306,318,2,'2023-06-30','2023-07-02 15:20:46','2023-07-02 15:20:46'),(307,319,2,'2023-06-30','2023-07-02 15:21:32','2023-07-02 15:21:32'),(308,320,2,'2023-06-30','2023-07-02 15:22:12','2023-07-02 15:22:12'),(309,321,2,'2023-06-30','2023-07-02 15:23:02','2023-07-02 15:23:02'),(310,322,2,'2023-06-30','2023-07-02 15:23:40','2023-07-02 15:23:40'),(311,323,2,'2023-06-30','2023-07-02 15:24:42','2023-07-02 15:24:42'),(312,324,2,'2023-06-30','2023-07-02 15:25:21','2023-07-02 15:25:21'),(313,325,2,'2023-06-30','2023-07-02 15:25:58','2023-07-02 15:25:58'),(314,326,2,'2023-06-30','2023-07-02 15:26:39','2023-07-02 15:26:39'),(315,327,2,'2023-06-30','2023-07-02 15:27:19','2023-07-02 15:27:19'),(316,328,2,'2023-06-30','2023-07-02 15:28:02','2023-07-02 15:28:02'),(317,329,2,'2023-06-30','2023-07-02 15:28:44','2023-07-02 15:28:44'),(318,330,2,'2023-06-30','2023-07-02 15:29:43','2023-07-02 15:29:43'),(319,331,2,'2023-06-30','2023-07-02 15:30:25','2023-07-02 15:30:25'),(320,332,2,'2023-06-30','2023-07-02 15:31:12','2023-07-02 15:31:12'),(321,333,2,'2023-06-30','2023-07-02 15:31:56','2023-07-02 15:31:56'),(322,334,2,'2023-06-30','2023-07-02 15:32:31','2023-07-02 15:32:31'),(323,335,2,'2023-06-30','2023-07-02 15:32:54','2023-07-02 15:32:54'),(324,336,2,'2023-06-30','2023-07-02 15:33:15','2023-07-02 15:33:15'),(325,337,2,'2023-06-30','2023-07-02 15:33:36','2023-07-02 15:33:36'),(326,338,2,'2023-06-30','2023-07-02 15:33:58','2023-07-02 15:33:58'),(327,340,2,'2023-06-30','2023-07-02 15:34:24','2023-07-02 15:34:24'),(328,341,2,'2023-06-30','2023-07-02 15:34:48','2023-07-02 15:34:48'),(329,342,2,'2023-06-30','2023-07-02 15:35:15','2023-07-02 15:35:15'),(330,343,2,'2023-06-30','2023-07-02 15:35:51','2023-07-02 15:35:51'),(331,344,2,'2023-06-30','2023-07-02 15:37:08','2023-07-02 15:37:08'),(332,345,2,'2023-06-30','2023-07-02 15:38:03','2023-07-02 15:38:03'),(333,346,2,'2023-06-30','2023-07-02 15:38:48','2023-07-02 15:38:48'),(334,347,2,'2023-06-30','2023-07-02 15:39:31','2023-07-02 15:39:31'),(335,348,2,'2023-06-30','2023-07-02 15:40:42','2023-07-02 15:40:42'),(336,349,2,'2023-06-30','2023-07-02 15:41:27','2023-07-02 15:41:27'),(337,350,2,'2023-06-30','2023-07-02 15:42:02','2023-07-02 15:42:02'),(338,351,2,'2023-06-30','2023-07-02 15:42:41','2023-07-02 15:42:41'),(339,352,2,'2023-06-30','2023-07-02 15:43:13','2023-07-02 15:43:13'),(340,353,2,'2023-06-30','2023-07-02 15:44:04','2023-07-02 15:44:04'),(341,354,2,'2023-06-30','2023-07-02 15:44:54','2023-07-02 15:44:54'),(342,355,2,'2023-06-30','2023-07-02 15:45:32','2023-07-02 15:45:32'),(343,356,2,'2023-06-30','2023-07-02 15:46:04','2023-07-02 15:46:04'),(344,357,2,'2023-06-30','2023-07-02 15:46:34','2023-07-02 15:46:34'),(345,358,2,'2023-06-30','2023-07-02 15:47:10','2023-07-02 15:47:10'),(346,359,2,'2023-06-30','2023-07-02 15:47:39','2023-07-02 15:47:39'),(347,360,2,'2023-06-30','2023-07-02 15:48:54','2023-07-02 15:48:54'),(348,361,2,'2023-06-30','2023-07-02 15:49:30','2023-07-02 15:49:30'),(349,362,2,'2023-06-30','2023-07-02 15:50:06','2023-07-02 15:50:06'),(350,363,2,'2023-06-30','2023-07-02 15:50:39','2023-07-02 15:50:39'),(351,364,2,'2023-06-30','2023-07-02 15:51:29','2023-07-02 15:51:29'),(352,365,2,'2023-06-30','2023-07-02 15:52:06','2023-07-02 15:52:06'),(353,366,2,'2023-06-30','2023-07-02 15:52:38','2023-07-02 15:52:38'),(354,367,2,'2023-06-30','2023-07-02 15:53:11','2023-07-02 15:53:11'),(355,368,2,'2023-06-30','2023-07-02 15:53:47','2023-07-02 15:53:47'),(356,369,2,'2023-06-30','2023-07-02 15:54:21','2023-07-02 15:54:21'),(357,370,2,'2023-06-30','2023-07-02 15:54:54','2023-07-02 15:54:54'),(358,371,2,'2023-06-30','2023-07-02 15:55:37','2023-07-02 15:55:37'),(359,372,2,'2023-06-30','2023-07-02 15:56:13','2023-07-02 15:56:13'),(360,373,2,'2023-06-30','2023-07-02 15:56:46','2023-07-02 15:56:46'),(361,374,2,'2023-06-30','2023-07-02 15:57:56','2023-07-02 15:57:56'),(362,375,2,'2023-06-30','2023-07-02 15:58:59','2023-07-02 15:58:59'),(363,377,2,'2023-06-30','2023-07-02 15:59:38','2023-07-02 15:59:38'),(364,378,2,'2023-06-30','2023-07-02 16:00:23','2023-07-02 16:00:23'),(365,379,2,'2023-06-30','2023-07-02 16:01:02','2023-07-02 16:01:02'),(366,380,2,'2023-06-30','2023-07-02 16:01:41','2023-07-02 16:01:41'),(367,381,2,'2023-06-30','2023-07-02 16:02:30','2023-07-02 16:02:30'),(368,382,2,'2023-06-30','2023-07-02 16:03:13','2023-07-02 16:03:13'),(369,383,2,'2023-06-30','2023-07-02 16:03:55','2023-07-02 16:03:55'),(370,384,2,'2023-06-30','2023-07-02 16:04:32','2023-07-02 16:04:32'),(371,385,2,'2023-06-30','2023-07-02 16:05:16','2023-07-02 16:05:16'),(372,386,2,'2023-06-30','2023-07-02 16:06:30','2023-07-02 16:06:30'),(373,387,2,'2023-06-30','2023-07-02 16:07:13','2023-07-02 16:07:13'),(374,388,2,'2023-06-30','2023-07-02 16:07:59','2023-07-02 16:07:59'),(375,389,2,'2023-06-30','2023-07-02 16:08:43','2023-07-02 16:08:43'),(376,390,2,'2023-06-30','2023-07-02 16:09:25','2023-07-02 16:09:25'),(377,391,2,'2023-06-30','2023-07-02 16:10:13','2023-07-02 16:10:13'),(378,392,2,'2023-06-30','2023-07-02 16:10:55','2023-07-02 16:10:55'),(379,393,2,'2023-06-30','2023-07-02 16:11:41','2023-07-02 16:11:41'),(380,394,2,'2023-06-30','2023-07-02 16:12:57','2023-07-02 16:12:57'),(381,395,2,'2023-06-30','2023-07-02 16:14:45','2023-07-02 16:14:45'),(382,396,2,'2023-06-30','2023-07-02 16:15:38','2023-07-02 16:15:38'),(383,397,2,'2023-06-30','2023-07-02 16:17:14','2023-07-02 16:17:14'),(384,398,2,'2023-06-30','2023-07-02 16:18:05','2023-07-02 16:18:05'),(385,399,2,'2023-06-30','2023-07-02 16:19:07','2023-07-02 16:19:07'),(386,400,2,'2023-06-30','2023-07-02 16:20:00','2023-07-02 16:20:00'),(387,401,2,'2023-06-30','2023-07-02 16:20:56','2023-07-02 16:20:56'),(388,402,2,'2023-06-30','2023-07-02 16:22:04','2023-07-02 16:22:04'),(389,403,2,'2023-06-30','2023-07-02 16:22:54','2023-07-02 16:22:54'),(390,404,2,'2023-06-30','2023-07-02 16:24:04','2023-07-02 16:24:04'),(391,405,2,'2023-06-30','2023-07-02 16:25:37','2023-07-02 16:25:37'),(392,406,2,'2023-06-30','2023-07-02 16:26:53','2023-07-02 16:26:53'),(393,407,2,'2023-06-30','2023-07-02 16:29:03','2023-07-02 16:29:03'),(394,408,2,'2023-06-30','2023-07-02 16:30:34','2023-07-02 16:30:34'),(395,409,2,'2023-06-30','2023-07-02 16:32:35','2023-07-02 16:32:35'),(396,410,2,'2023-06-30','2023-07-02 16:33:56','2023-07-02 16:33:56'),(397,411,2,'2023-06-30','2023-07-02 16:34:58','2023-07-02 16:34:58'),(398,412,2,'2023-06-30','2023-07-02 16:35:53','2023-07-02 16:35:53'),(399,413,2,'2023-06-30','2023-07-02 16:36:58','2023-07-02 16:36:58'),(400,414,2,'2023-06-30','2023-07-02 16:38:11','2023-07-02 16:38:11'),(401,415,2,'2023-06-30','2023-07-02 16:40:20','2023-07-02 16:40:20'),(402,416,2,'2023-06-30','2023-07-02 16:41:36','2023-07-02 16:41:36'),(403,417,2,'2023-06-30','2023-07-02 16:42:37','2023-07-02 16:42:37'),(404,418,2,'2023-06-30','2023-07-02 16:43:45','2023-07-02 16:43:45'),(405,419,2,'2023-06-30','2023-07-02 16:44:44','2023-07-02 16:44:44'),(406,420,2,'2023-06-30','2023-07-02 16:45:44','2023-07-02 16:45:44'),(407,421,2,'2023-06-30','2023-07-02 16:46:55','2023-07-02 16:46:55'),(408,422,2,'2023-06-30','2023-07-02 16:48:18','2023-07-02 16:48:18'),(409,423,2,'2023-06-30','2023-07-02 16:49:46','2023-07-02 16:49:46'),(410,424,2,'2023-06-30','2023-07-02 16:50:51','2023-07-02 16:50:51'),(411,425,2,'2023-06-30','2023-07-02 16:52:19','2023-07-02 16:52:19');
/*!40000 ALTER TABLE `transmittals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES (1,'Cash','2023-06-20 01:10:41','2023-06-20 01:10:41'),(2,'Coupon','2023-06-20 01:10:41','2023-06-20 01:10:41'),(3,'Item','2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@darbc.com',NULL,'$2y$10$lYBOcoQ/C4pK/SphM/jyWeqEzl6uuOMl3I36Etqu9Pskb3YYj0RFe',1,NULL,'2023-06-20 01:10:40','2023-06-20 01:10:40'),(2,'Community Relations','community@darbc.com',NULL,'$2y$10$UBNnyRS86CQQ8SvLfg8YRu48xIxxr89qk4oTU5xtNU7PbJDTXoIUa',2,NULL,'2023-06-20 01:10:41','2023-06-20 01:10:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_schedules`
--

DROP TABLE IF EXISTS `vehicle_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `death_id` bigint unsigned NOT NULL,
  `schedule_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_requested` date DEFAULT NULL,
  `scheduled_date` date DEFAULT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_schedules`
--

LOCK TABLES `vehicle_schedules` WRITE;
/*!40000 ALTER TABLE `vehicle_schedules` DISABLE KEYS */;
INSERT INTO `vehicle_schedules` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-07-07 01:03:36','2023-07-07 01:03:36'),(2,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-07-12 05:33:50','2023-07-12 05:33:50');
/*!40000 ALTER TABLE `vehicle_schedules` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-17  2:42:35
