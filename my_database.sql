-- MySQL dump 10.13  Distrib 9.2.0, for Win64 (x86_64)
--
-- Host: localhost    Database: sinadanaaccounting
-- ------------------------------------------------------
-- Server version	9.2.0

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_branch_id_foreign` (`branch_id`),
  CONSTRAINT `accounts_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL COMMENT 'نام',
  `family` varchar(15) NOT NULL COMMENT 'نام خانوادگی',
  `mobile` varchar(11) NOT NULL COMMENT 'موبایل',
  `admin_code` varchar(10) NOT NULL COMMENT 'کد مدیریت',
  `national_code` varchar(11) NOT NULL COMMENT 'کد ملی',
  `education` varchar(15) NOT NULL COMMENT 'تحصیلات',
  `role` varchar(15) NOT NULL COMMENT 'سمت',
  `father_name` varchar(15) NOT NULL COMMENT 'نام پدر',
  `address` varchar(255) NOT NULL COMMENT 'آدرس',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_mobile_unique` (`mobile`),
  UNIQUE KEY `admins_national_code_unique` (`national_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'سینا','محمدی','09306747180','ee2244','2283845111','فوق دیپلم','مدیر اجرایی','شهریار','شیراز','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT 'نام',
  `code` varchar(8) NOT NULL COMMENT 'کد شعبه',
  `count_staff` int NOT NULL COMMENT 'تعداد کارکنان',
  `address` varchar(255) NOT NULL COMMENT 'آدرس',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branches_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'شعبه شیراز','44225',5,'خیابان گاز','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'همه','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `province_id` bigint unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_name_unique` (`name`),
  KEY `cities_province_id_foreign` (`province_id`),
  CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,1,'شیراز','2026-06-28 17:05:38','2026-06-28 17:05:38'),(2,2,'تهران','2026-06-28 17:05:38','2026-06-28 17:05:38'),(3,3,'اصفهان','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_rows`
--

DROP TABLE IF EXISTS `document_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_rows` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `document_id` bigint unsigned NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_code` varchar(4) NOT NULL,
  `description` text NOT NULL,
  `detailed_code` varchar(4) NOT NULL,
  `debtor` bigint unsigned NOT NULL,
  `creditor` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_rows_account_id_foreign` (`account_id`),
  KEY `document_rows_document_id_foreign` (`document_id`),
  CONSTRAINT `document_rows_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`),
  CONSTRAINT `document_rows_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_rows`
--

LOCK TABLES `document_rows` WRITE;
/*!40000 ALTER TABLE `document_rows` DISABLE KEYS */;
/*!40000 ALTER TABLE `document_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned NOT NULL,
  `staff_id` bigint unsigned NOT NULL,
  `accept_staff_id` bigint unsigned DEFAULT NULL,
  `factor_id` bigint unsigned DEFAULT NULL COMMENT 'فاکتور',
  `title` varchar(255) NOT NULL,
  `type` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_branch_id_foreign` (`branch_id`),
  KEY `documents_staff_id_foreign` (`staff_id`),
  KEY `documents_accept_staff_id_foreign` (`accept_staff_id`),
  KEY `documents_factor_id_foreign` (`factor_id`),
  CONSTRAINT `documents_accept_staff_id_foreign` FOREIGN KEY (`accept_staff_id`) REFERENCES `staff` (`id`),
  CONSTRAINT `documents_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `documents_factor_id_foreign` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`),
  CONSTRAINT `documents_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factor_products`
--

DROP TABLE IF EXISTS `factor_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `factor_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `factor_id` bigint unsigned NOT NULL COMMENT 'فاکتور',
  `product_id` bigint unsigned NOT NULL COMMENT 'کالا',
  `storage_id` bigint unsigned NOT NULL COMMENT 'انبار',
  `description` varchar(255) DEFAULT NULL COMMENT 'توضیحات',
  `unit` varchar(10) NOT NULL COMMENT 'واحد',
  `count` int NOT NULL COMMENT 'تعداد',
  `unit_price` bigint unsigned NOT NULL COMMENT 'قیمت پایه',
  `discount` bigint unsigned NOT NULL COMMENT 'تخفیف',
  `tax` bigint unsigned NOT NULL COMMENT 'مالیات',
  `total_price` bigint unsigned NOT NULL COMMENT 'قیمت کل',
  PRIMARY KEY (`id`),
  KEY `factor_products_factor_id_foreign` (`factor_id`),
  KEY `factor_products_product_id_foreign` (`product_id`),
  KEY `factor_products_storage_id_foreign` (`storage_id`),
  CONSTRAINT `factor_products_factor_id_foreign` FOREIGN KEY (`factor_id`) REFERENCES `factors` (`id`),
  CONSTRAINT `factor_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `factor_products_storage_id_foreign` FOREIGN KEY (`storage_id`) REFERENCES `storages` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factor_products`
--

LOCK TABLES `factor_products` WRITE;
/*!40000 ALTER TABLE `factor_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `factor_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factors`
--

DROP TABLE IF EXISTS `factors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `factors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned NOT NULL COMMENT 'شعبه',
  `staff_id` bigint unsigned NOT NULL COMMENT 'کارمند',
  `category_id` bigint unsigned NOT NULL COMMENT 'دسته بندی',
  `person_id` bigint unsigned NOT NULL COMMENT 'شخص',
  `title` varchar(50) NOT NULL COMMENT 'عنوان',
  `date` date NOT NULL COMMENT 'تاریخ',
  `due_date` date NOT NULL COMMENT 'تاریخ سررسید',
  `paid_price` bigint unsigned NOT NULL COMMENT 'هزینه پرداخت شده',
  `total_price` bigint unsigned NOT NULL COMMENT 'هزینه کل',
  `type` tinyint(1) NOT NULL COMMENT '0 خرید 1 فروش',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `factors_title_unique` (`title`),
  KEY `factors_branch_id_foreign` (`branch_id`),
  KEY `factors_staff_id_foreign` (`staff_id`),
  KEY `factors_category_id_foreign` (`category_id`),
  KEY `factors_person_id_foreign` (`person_id`),
  CONSTRAINT `factors_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `factors_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `factors_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`),
  CONSTRAINT `factors_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factors`
--

LOCK TABLES `factors` WRITE;
/*!40000 ALTER TABLE `factors` DISABLE KEYS */;
/*!40000 ALTER TABLE `factors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ledgers`
--

DROP TABLE IF EXISTS `ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ledgers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `amount` bigint unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ledgers`
--

LOCK TABLES `ledgers` WRITE;
/*!40000 ALTER TABLE `ledgers` DISABLE KEYS */;
/*!40000 ALTER TABLE `ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_reset_tokens_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2026_03_11_000312_create_branches_table',1),(5,'2026_03_11_001659_create_categories_table',1),(6,'2026_03_11_003201_create_provinces_table',1),(7,'2026_03_11_003330_create_cities_table',1),(8,'2026_03_11_004027_create_people_table',1),(9,'2026_03_11_071944_create_storages_table',1),(10,'2026_03_11_212144_create_staff_table',1),(11,'2026_03_11_224857_create_factors_table',1),(12,'2026_03_12_002217_create_products_table',1),(13,'2026_03_12_005222_create_factor_products_table',1),(14,'2026_03_12_014042_create_admins_table',1),(15,'2026_04_07_204430_create_roles_table',1),(16,'2026_04_07_204503_create_permissions_table',1),(17,'2026_04_07_204619_create_permission_role_table',1),(18,'2026_04_15_175308_create_users_table',1),(19,'2026_05_10_130241_create_ledgers_table',1),(20,'2026_06_13_135607_create_accounts_table',1),(21,'2026_06_21_195518_create_documents_table',1),(22,'2026_06_23_200634_create_document_rows_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `people`
--

DROP TABLE IF EXISTS `people`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `people` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `province_id` bigint unsigned NOT NULL COMMENT 'استان',
  `city_id` bigint unsigned NOT NULL COMMENT 'شهر',
  `branch_id` bigint unsigned NOT NULL COMMENT 'شعبه',
  `first_name` varchar(15) NOT NULL COMMENT 'نام',
  `last_name` varchar(15) NOT NULL COMMENT 'نام خانوادگی',
  `community` varchar(100) DEFAULT NULL COMMENT 'شرکت',
  `mobile` varchar(11) NOT NULL COMMENT 'موبایل',
  `tel` varchar(11) DEFAULT NULL COMMENT 'تلفن',
  `postal_code` varchar(10) NOT NULL COMMENT 'کد پستی',
  `email` varchar(30) DEFAULT NULL COMMENT 'ایمیل',
  `website` varchar(50) DEFAULT NULL COMMENT 'وبسایت',
  `address` varchar(255) DEFAULT NULL COMMENT 'آدرس',
  `pic` varchar(10) DEFAULT NULL COMMENT 'عکس',
  `type` int NOT NULL COMMENT 'نوع',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `people_mobile_unique` (`mobile`),
  KEY `people_province_id_foreign` (`province_id`),
  KEY `people_city_id_foreign` (`city_id`),
  KEY `people_branch_id_foreign` (`branch_id`),
  CONSTRAINT `people_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `people_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  CONSTRAINT `people_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `people`
--

LOCK TABLES `people` WRITE;
/*!40000 ALTER TABLE `people` DISABLE KEYS */;
/*!40000 ALTER TABLE `people` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `role_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(2,22),(2,23),(2,24),(2,25),(2,26),(2,27),(2,28),(2,29),(2,30),(2,31),(2,32),(2,33),(2,34),(2,35),(2,36),(2,37),(2,38),(2,39),(2,40),(2,41),(2,42),(2,43),(2,44),(2,45),(2,46);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `permission` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_permission_unique` (`permission`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'مشاهده شخص','read-person'),(2,'ایجاد شخص','create-person'),(3,'ویرایش شخص','edit-person'),(4,'حذف شخص','delete-person'),(5,'مشاهده انبار','read-product'),(6,'ایجاد انبار','create-product'),(7,'ویرایش انبار','edit-product'),(8,'حذف انبار','delete-product'),(9,'مشاهده فاکتور','read-factor'),(10,'ایجاد فاکتور','create-factor'),(11,'ویرایش فاکتور','edit-factor'),(12,'حذف فاکتور','delete-factor'),(13,'مشاهده نقش','read-role'),(14,'ایجاد نقش','create-role'),(15,'ویرایش نقش','edit-role'),(16,'حذف نقش','delete-role'),(17,'مشاهده کارمند','read-staff'),(18,'ایجاد کارمند','create-staff'),(19,'ویرایش کارمند','edit-staff'),(20,'حذف کارمند','delete-staff'),(21,'مشاهده گزارشات','read-reports'),(22,'مشاهده شخص','read-person-admin'),(23,'ایجاد شخص','create-person-admin'),(24,'ویرایش شخص','edit-person-admin'),(25,'حذف شخص','delete-person-admin'),(26,'مشاهده انبار','read-storage-admin'),(27,'ایجاد انبار','create-storage-admin'),(28,'ویرایش انبار','edit-storage-admin'),(29,'حذف انبار','delete-storage-admin'),(30,'مشاهده فاکتور','read-factor-admin'),(31,'ایجاد فاکتور','create-factor-admin'),(32,'ویرایش فاکتور','edit-factor-admin'),(33,'حذف فاکتور','delete-factor-admin'),(34,'مشاهده نقش','read-role-admin'),(35,'ایجاد نقش','create-role-admin'),(36,'ویرایش نقش','edit-role-admin'),(37,'حذف نقش','delete-role-admin'),(38,'مشاهده کارمند','read-staff-admin'),(39,'ایجاد کارمند','create-staff-admin'),(40,'ویرایش کارمند','edit-staff-admin'),(41,'حذف کارمند','delete-staff-admin'),(42,'مشاهده شعبه','read-branch-admin'),(43,'ایجاد شعبه','create-branch-admin'),(44,'ویرایش شعبه','edit-branch-admin'),(45,'حذف شعبه','delete-branch-admin'),(46,'مشاهده گزارشات','read-reports-admin');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) NOT NULL,
  `branch_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `staff_id` bigint unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `sell_price` bigint unsigned NOT NULL,
  `buy_price` bigint unsigned NOT NULL,
  `count` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_name_unique` (`name`),
  UNIQUE KEY `products_product_code_unique` (`product_code`),
  KEY `products_branch_id_foreign` (`branch_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_staff_id_foreign` (`staff_id`),
  CONSTRAINT `products_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provinces` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `provinces_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinces`
--

LOCK TABLES `provinces` WRITE;
/*!40000 ALTER TABLE `provinces` DISABLE KEYS */;
INSERT INTO `provinces` VALUES (1,'فارس','2026-06-28 17:05:38','2026-06-28 17:05:38'),(2,'تهران','2026-06-28 17:05:38','2026-06-28 17:05:38'),(3,'اصفهان','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `provinces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_title_unique` (`title`),
  KEY `roles_branch_id_foreign` (`branch_id`),
  CONSTRAINT `roles_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,1,'مدیر شعبه 1','2026-06-28 17:05:38','2026-06-28 17:05:38'),(2,NULL,'مدیر کل','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned NOT NULL COMMENT 'شعبه',
  `name` varchar(15) NOT NULL COMMENT 'نام',
  `family` varchar(15) NOT NULL COMMENT 'نام خانوادگی',
  `mobile` varchar(11) NOT NULL COMMENT 'موبایل',
  `personal_code` varchar(10) NOT NULL COMMENT 'کد پرسنلی',
  `national_code` varchar(11) NOT NULL COMMENT 'کد ملی',
  `education` varchar(15) NOT NULL COMMENT 'تحصیلات',
  `role` varchar(15) NOT NULL COMMENT 'سمت',
  `father_name` varchar(15) NOT NULL COMMENT 'نام پدر',
  `address` varchar(255) NOT NULL COMMENT 'آدرس',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_mobile_unique` (`mobile`),
  UNIQUE KEY `staff_national_code_unique` (`national_code`),
  KEY `staff_branch_id_foreign` (`branch_id`),
  CONSTRAINT `staff_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,1,'سینا','محمدی','09306747180','ee2244','2283845111','فوق دیپلم','مدیر اجرایی','شهریار','شیراز','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storages`
--

DROP TABLE IF EXISTS `storages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `storages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned NOT NULL COMMENT 'شعبه',
  `code` varchar(255) NOT NULL COMMENT 'کد',
  `name` varchar(50) NOT NULL COMMENT 'نام',
  `address` varchar(255) NOT NULL COMMENT 'آدرس',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `storages_code_unique` (`code`),
  KEY `storages_branch_id_foreign` (`branch_id`),
  CONSTRAINT `storages_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storages`
--

LOCK TABLES `storages` WRITE;
/*!40000 ALTER TABLE `storages` DISABLE KEYS */;
INSERT INTO `storages` VALUES (1,1,'2358','انبار اصلی','شعبه','2026-06-28 17:05:38','2026-06-28 17:05:38');
/*!40000 ALTER TABLE `storages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `model` varchar(30) NOT NULL DEFAULT 'AppHttpModelsStaff',
  `username` varchar(20) NOT NULL COMMENT 'نام کاربری',
  `password` varchar(100) NOT NULL COMMENT 'رمز عبور',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,2,'App\\Http\\Models\\Admin','admin','ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f','2026-06-28 17:05:38','2026-06-28 17:05:38'),(2,1,1,'App\\Http\\Models\\Staff','staff','$2y$12$PNLbHQzaTKuRWFOo4pyCIefyL7pSicVmPliNPd.Ybbm736Hw1/cJ2','2026-06-28 17:05:38','2026-06-28 17:05:38');
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

-- Dump completed on 2026-06-29  0:17:26
