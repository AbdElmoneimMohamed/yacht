-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: yacht
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

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
-- Table structure for table `boats`
--

DROP TABLE IF EXISTS `boats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `boatId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `totalRpm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tankSize` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fuelQuentity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sizeByFeet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registerationDate` date DEFAULT NULL,
  `registerationTime` time DEFAULT NULL,
  `numberOfGenerators` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `boats_user_id_foreign` (`user_id`),
  CONSTRAINT `boats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boats`
--

LOCK TABLES `boats` WRITE;
/*!40000 ALTER TABLE `boats` DISABLE KEYS */;
INSERT INTO `boats` VALUES (1,3,'#ddd','boat','type1','brand1','300','300','200','30','2018-03-04','15:20:20','20','2018-04-25 10:20:38','2018-04-25 10:20:38',NULL),(2,3,'#dd5d','b6oat','type1','brand1','300','300','200','30','2018-03-04','15:20:20','20','2018-04-25 10:20:52','2018-04-25 10:20:52',NULL),(3,3,'#dd5d','b66oat','type1','brand1','300','300','200','30','2018-03-04','15:20:20','20','2018-04-25 10:21:47','2018-04-25 10:21:47',NULL),(4,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-04-25 10:22:24','2018-04-25 10:22:24',NULL);
/*!40000 ALTER TABLE `boats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engines`
--

DROP TABLE IF EXISTS `engines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `boat_id` int(10) unsigned NOT NULL,
  `engineId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rpm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `engines_boat_id_foreign` (`boat_id`),
  CONSTRAINT `engines_boat_id_foreign` FOREIGN KEY (`boat_id`) REFERENCES `boats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engines`
--

LOCK TABLES `engines` WRITE;
/*!40000 ALTER TABLE `engines` DISABLE KEYS */;
INSERT INTO `engines` VALUES (1,1,'#ddd','300','2018-04-25 10:20:38','2018-04-25 10:20:38',NULL),(2,1,NULL,'200','2018-04-25 10:20:38','2018-04-25 10:20:38',NULL),(3,2,'#ddd','300','2018-04-25 10:20:52','2018-04-25 10:20:52',NULL),(4,2,NULL,'200','2018-04-25 10:20:52','2018-04-25 10:20:52',NULL),(5,3,'#ddd','300','2018-04-25 10:21:47','2018-04-25 10:21:47',NULL),(6,3,NULL,'200','2018-04-25 10:21:47','2018-04-25 10:21:47',NULL);
/*!40000 ALTER TABLE `engines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `boat_id` int(10) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_boat_id_foreign` (`boat_id`),
  CONSTRAINT `images_boat_id_foreign` FOREIGN KEY (`boat_id`) REFERENCES `boats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,1,'/getPhoto/url1','2018-04-25 10:20:38','2018-04-25 10:20:38',NULL),(2,1,'/getPhoto/url2','2018-04-25 10:20:39','2018-04-25 10:20:39',NULL),(3,1,'/getPhoto/url3','2018-04-25 10:20:39','2018-04-25 10:20:39',NULL),(4,2,'/getPhoto/url1','2018-04-25 10:20:52','2018-04-25 10:20:52',NULL),(5,2,'/getPhoto/url2','2018-04-25 10:20:53','2018-04-25 10:20:53',NULL),(6,2,'/getPhoto/url3','2018-04-25 10:20:53','2018-04-25 10:20:53',NULL),(7,3,'/getPhoto/url1','2018-04-25 10:21:47','2018-04-25 10:21:47',NULL),(8,3,'/getPhoto/url2','2018-04-25 10:21:48','2018-04-25 10:21:48',NULL),(9,3,'/getPhoto/url3','2018-04-25 10:21:48','2018-04-25 10:21:48',NULL);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenances`
--

DROP TABLE IF EXISTS `maintenances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `boat_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenances_boat_id_foreign` (`boat_id`),
  CONSTRAINT `maintenances_boat_id_foreign` FOREIGN KEY (`boat_id`) REFERENCES `boats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenances`
--

LOCK TABLES `maintenances` WRITE;
/*!40000 ALTER TABLE `maintenances` DISABLE KEYS */;
INSERT INTO `maintenances` VALUES (1,1,'main1','2018-04-03','152','us',0,'2018-04-25 10:20:38','2018-04-25 10:20:38',NULL),(2,1,'main1','2018-04-03','152','us',0,'2018-04-25 10:20:38','2018-04-25 10:20:38',NULL),(3,2,'main1','2018-04-03','152','us',0,'2018-04-25 10:20:52','2018-04-25 10:20:52',NULL),(4,2,'main1','2018-04-03','152','us',0,'2018-04-25 10:20:52','2018-04-25 10:20:52',NULL),(5,3,'main1','2018-04-25','152','us',1,'2018-04-25 10:21:47','2018-04-25 12:08:01',NULL),(6,3,'main1','2018-04-25','152','us',1,'2018-04-25 10:21:47','2018-04-25 12:08:02',NULL);
/*!40000 ALTER TABLE `maintenances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (96,'2014_01_07_073615_create_tagged_table',1),(97,'2014_01_07_073615_create_tags_table',1),(98,'2014_10_12_000000_create_users_table',1),(99,'2014_10_12_100000_create_password_resets_table',1),(100,'2016_06_01_000001_create_oauth_auth_codes_table',1),(101,'2016_06_01_000002_create_oauth_access_tokens_table',1),(102,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(103,'2016_06_01_000004_create_oauth_clients_table',1),(104,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(105,'2016_06_29_073615_create_tag_groups_table',1),(106,'2016_06_29_073615_update_tags_table',1),(107,'2018_04_22_160842_create_boats_table',1),(108,'2018_04_22_160912_create_trips_table',1),(109,'2018_04_22_161324_create_maintenances_table',1),(110,'2018_04_22_161349_create_stages_table',1),(111,'2018_04_22_161923_create_images_table',1),(112,'2018_04_22_162035_create_engines_table',1),(113,'2018_04_22_162057_create_notifications_table',1),(114,'2018_04_22_162129_create_rpms_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `messageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `messageBody` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_foreign` (`user_id`),
  CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,3,'{\"notificationType\":\"Maintenance Time\",\"content\":{\"maintenanceId\":5}}','Notification Time','0000-00-00','2018-04-25 12:05:15','2018-04-25 12:05:15',NULL),(2,3,'{\"notificationType\":\"Maintenance Time\",\"content\":{\"maintenanceId\":6}}','Notification Time','0000-00-00','2018-04-25 12:05:16','2018-04-25 12:05:16',NULL),(3,3,'{\"notificationType\":\"Trip Notification\",\"content\":{\"tripId\":1}}','Trip Time','0000-00-00','2018-04-25 12:05:17','2018-04-25 12:05:17',NULL),(4,3,'{\"notificationType\":\"Trip Notification\",\"content\":{\"tripId\":2}}','Trip Time','0000-00-00','2018-04-25 12:05:18','2018-04-25 12:05:18',NULL),(5,3,'{\"notificationType\":\"Maintenance Time\",\"content\":{\"maintenanceId\":5}}','Notification Time','2018-04-25','2018-04-25 12:08:01','2018-04-25 12:08:01',NULL),(6,3,'{\"notificationType\":\"Maintenance Time\",\"content\":{\"maintenanceId\":6}}','Notification Time','2018-04-25','2018-04-25 12:08:02','2018-04-25 12:08:02',NULL),(7,3,'{\"notificationType\":\"Trip Notification\",\"content\":{\"tripId\":1}}','Trip Time','2018-04-25','2018-04-25 12:08:03','2018-04-25 12:08:03',NULL),(8,3,'{\"notificationType\":\"Trip Notification\",\"content\":{\"tripId\":2}}','Trip Time','2018-04-25','2018-04-25 12:08:04','2018-04-25 12:08:04',NULL),(9,3,'{\"notificationType\":\"Trip Notification\",\"content\":{\"tripId\":1}}','Trip Time','2018-04-25','2018-04-25 12:08:36','2018-04-25 12:08:36',NULL),(10,3,'{\"notificationType\":\"Trip Notification\",\"content\":{\"tripId\":2}}','Trip Time','2018-04-25','2018-04-25 12:08:37','2018-04-25 12:08:37',NULL);
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('01c938d5b18017db8af514102ef3be986981ef44ce9635842223a9651df2b7af933ac717db84ec47',2,1,'MyApp','[]',0,'2018-04-25 09:25:18','2018-04-25 09:25:18','2019-04-25 11:25:18'),('f5ceb7630f408725f42c8fb7ea97f17d001b3faeed051137370c47854618bf4318b9e0bce88f81fb',3,1,'MyApp','[]',0,'2018-04-25 10:18:40','2018-04-25 10:18:40','2019-04-25 12:18:40');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,' Personal Access Client','4CRTRy6JlmNXxpv0d6zGQkyVJAi69vgqGUjmTScU','http://localhost',1,0,0,'2018-04-25 09:24:18','2018-04-25 09:24:18'),(2,NULL,' Password Grant Client','pJbaIBSnbpbLC3tSx9J71BqEaKWMR8tU23MUc4ov','http://localhost',0,1,0,'2018-04-25 09:24:18','2018-04-25 09:24:18');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2018-04-25 09:24:18','2018-04-25 09:24:18');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rpms`
--

DROP TABLE IF EXISTS `rpms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `boat_id` int(10) unsigned NOT NULL,
  `rpm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fuelConsumption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rpms_boat_id_foreign` (`boat_id`),
  CONSTRAINT `rpms_boat_id_foreign` FOREIGN KEY (`boat_id`) REFERENCES `boats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rpms`
--

LOCK TABLES `rpms` WRITE;
/*!40000 ALTER TABLE `rpms` DISABLE KEYS */;
INSERT INTO `rpms` VALUES (1,1,'200','300','300','2018-04-25 10:20:38','2018-04-25 10:20:38',NULL),(2,2,'200','300','300','2018-04-25 10:20:52','2018-04-25 10:20:52',NULL),(3,3,'200','300','300','2018-04-25 10:21:47','2018-04-25 10:21:47',NULL);
/*!40000 ALTER TABLE `rpms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trip_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fromLat` text COLLATE utf8_unicode_ci NOT NULL,
  `fromLon` text COLLATE utf8_unicode_ci NOT NULL,
  `toLat` text COLLATE utf8_unicode_ci NOT NULL,
  `toLon` text COLLATE utf8_unicode_ci NOT NULL,
  `rpm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stageDistance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stages_trip_id_foreign` (`trip_id`),
  CONSTRAINT `stages_trip_id_foreign` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stages`
--

LOCK TABLES `stages` WRITE;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` VALUES (1,1,'stage1','31.1014445455','31.6546541323','32.255611454545','32.132564654','30','60','50','2018-04-25 10:36:36','2018-04-25 10:36:36',NULL),(2,1,'stage2','31.1014445455','31.6546541323','32.255611454545','32.132564654','30','60','50','2018-04-25 10:36:36','2018-04-25 10:36:36',NULL),(3,2,'stage1','31.1014445455','31.6546541323','32.255611454545','32.132564654','30','60','50','2018-04-25 10:38:38','2018-04-25 10:38:38',NULL),(4,2,'stage2','31.1014445455','31.6546541323','32.255611454545','32.132564654','30','60','50','2018-04-25 10:38:38','2018-04-25 10:38:38',NULL);
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagging_tag_groups`
--

DROP TABLE IF EXISTS `tagging_tag_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagging_tag_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tag_groups_slug_index` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagging_tag_groups`
--

LOCK TABLES `tagging_tag_groups` WRITE;
/*!40000 ALTER TABLE `tagging_tag_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tag_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagging_tagged`
--

DROP TABLE IF EXISTS `tagging_tagged`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagging_tagged` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taggable_id` int(10) unsigned NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tag_slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tagging_tagged_taggable_id_index` (`taggable_id`),
  KEY `tagging_tagged_taggable_type_index` (`taggable_type`),
  KEY `tagging_tagged_tag_slug_index` (`tag_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagging_tagged`
--

LOCK TABLES `tagging_tagged` WRITE;
/*!40000 ALTER TABLE `tagging_tagged` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tagged` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagging_tags`
--

DROP TABLE IF EXISTS `tagging_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tagging_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_group_id` int(10) unsigned DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `suggest` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tagging_tags_slug_index` (`slug`),
  KEY `tagging_tags_tag_group_id_foreign` (`tag_group_id`),
  CONSTRAINT `tagging_tags_tag_group_id_foreign` FOREIGN KEY (`tag_group_id`) REFERENCES `tagging_tag_groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagging_tags`
--

LOCK TABLES `tagging_tags` WRITE;
/*!40000 ALTER TABLE `tagging_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tagging_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trips`
--

DROP TABLE IF EXISTS `trips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `boat_id` int(10) unsigned NOT NULL,
  `tripId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `boatId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `distance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `creationDate` date NOT NULL,
  `timeBegin` time NOT NULL,
  `timeEnd` time NOT NULL,
  `liters` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trips_boat_id_foreign` (`boat_id`),
  CONSTRAINT `trips_boat_id_foreign` FOREIGN KEY (`boat_id`) REFERENCES `boats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trips`
--

LOCK TABLES `trips` WRITE;
/*!40000 ALTER TABLE `trips` DISABLE KEYS */;
INSERT INTO `trips` VALUES (1,3,'#eeee','#eeee','20','2018-04-25','15:00:00','18:00:00','50','60','us',1,'2018-04-25 10:36:36','2018-04-25 12:08:36',NULL),(2,3,'#eeee','#eeee','20','2018-04-25','15:00:00','18:00:00','50','60','us',1,'2018-04-25 10:38:38','2018-04-25 12:08:37',NULL);
/*!40000 ALTER TABLE `trips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageUrl` text COLLATE utf8_unicode_ci,
  `forget_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_token` text COLLATE utf8_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Super Admin','admin@admin.com','','$2y$10$L5qd96l.g7apJjkaU.Uc6.tGP7lvaU2BJWcxFIGXJIU3qP1v3EvNC',NULL,NULL,NULL,'ezUDbigXbyQ:APA91bFoopqdKGmS0g2lBxKB49I-xzlXtJMRyLasPWIa_vSIf44WHAi23Sd5ofxgeRTKgeKcL-h7RZXf8H9yZn6XnRn2Ue7HFOl3w6rjwqan_FII8A4KkL6SetWFS00EQr0vC65hW6j6','p3ICMNWgHh','2018-04-25 09:24:16','2018-04-25 09:24:16',NULL),(2,'dddd','test@eee.com','012365478965','$2y$10$IzjQV/bZCnT0VhyUHbtzAekoMYoavT/DEq4pr8Mo.CarkrK8HQnZy','getPhoto/default_user.png',NULL,NULL,'ezUDbigXbyQ:APA91bFoopqdKGmS0g2lBxKB49I-xzlXtJMRyLasPWIa_vSIf44WHAi23Sd5ofxgeRTKgeKcL-h7RZXf8H9yZn6XnRn2Ue7HFOl3w6rjwqan_FII8A4KkL6SetWFS00EQr0vC65hW6j6',NULL,'2018-04-25 09:25:18','2018-04-25 09:25:18',NULL),(3,'ddd','test@eese.com','012365478365','$2y$10$6tc/5K65TG5Yrn1i6hwt7uWVhc1SadqXrV3edfZta/Dn/G4jqiWL.','getPhoto/default_user.png',NULL,NULL,'ezUDbigXbyQ:APA91bFoopqdKGmS0g2lBxKB49I-xzlXtJMRyLasPWIa_vSIf44WHAi23Sd5ofxgeRTKgeKcL-h7RZXf8H9yZn6XnRn2Ue7HFOl3w6rjwqan_FII8A4KkL6SetWFS00EQr0vC65hW6j6',NULL,'2018-04-25 10:18:40','2018-04-25 10:18:40',NULL);
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

-- Dump completed on 2018-04-25 16:19:53
