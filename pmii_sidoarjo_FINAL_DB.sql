-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: pmii_darjo
-- ------------------------------------------------------
-- Server version	8.0.45-0ubuntu0.24.04.1

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1773325203),('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1773325203;',1773325203),('laravel-cache-livewire-rate-limiter:92b3696be6cd7819e503ee187dfd88f666e2627c','i:1;',1773640382),('laravel-cache-livewire-rate-limiter:92b3696be6cd7819e503ee187dfd88f666e2627c:timer','i:1773640382;',1773640382);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `downloads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `downloads`
--

LOCK TABLES `downloads` WRITE;
/*!40000 ALTER TABLE `downloads` DISABLE KEYS */;
INSERT INTO `downloads` VALUES (1,'Mars PMII','Atribut & Lagu','downloads/01KJQHSBA3RR3QH5ASYGTDPG1A.mp3','MP3','Lagu official',1,'2026-03-02 08:13:38','2026-03-02 08:13:38'),(2,'AD ART Organisasi','Produk Hukum','downloads/01KJQJ3R4RC410YSMXDHATZC6C.pdf','PDF','sebagai acuan organisasi',1,'2026-03-02 08:19:18','2026-03-02 08:19:18');
/*!40000 ALTER TABLE `downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `e_magazines`
--

DROP TABLE IF EXISTS `e_magazines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `e_magazines` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `e_magazines`
--

LOCK TABLES `e_magazines` WRITE;
/*!40000 ALTER TABLE `e_magazines` DISABLE KEYS */;
INSERT INTO `e_magazines` VALUES (1,'Sang Surya','Vol. 1, edisi Ramadhan','e-magazine/covers/01KJQKVHTG0HQAWXVGTKKAXKCZ.jpg','e-magazine/files/01KJQKVHTJM1DZTWZE8DRYPJ8E.pdf',1,'2026-03-02 08:49:47','2026-03-02 08:49:47');
/*!40000 ALTER TABLE `e_magazines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
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
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
INSERT INTO `galleries` VALUES (1,'test kegiatan pertama','galleries/01KJMYZFZKM1XDG6SPZ024NKYF.png','Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta repellendus nesciunt ullam facilis ea ipsam est rerum officiis tempore sit facere placeat, quisquam ex nemo eaque atque obcaecati dolor laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores, harum? Corrupti qui error laborum tempore iusto labore sint fugit totam aperiam provident, placeat enim dolore libero minus quas pariatur autem.',1,'2026-03-01 08:06:27','2026-03-01 08:15:11'),(2,'tes 2','galleries/01KJMZ0F273G1190V2AY8B1337.jpg','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod est dignissimos cumque sint dicta, excepturi enim voluptates officiis modi aspernatur labore omnis itaque fuga corporis, ullam dolorem animi, at nulla. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis repellat facilis eius magnam aliquam facere accusamus ducimus dolore necessitatibus est mollitia quidem maxime voluptates, nulla quaerat nobis explicabo, ipsum quod.',1,'2026-03-01 08:06:59','2026-03-01 08:15:12'),(3,'tes 3','galleries/01KJMZ2YPA7NC3BFVXAS6DQVZS.jpg','Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex ipsum incidunt omnis odio magnam pariatur corporis ducimus atque nesciunt nobis. Alias molestiae qui voluptatibus fuga facere ullam laborum asperiores architecto. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consectetur magni nemo ab minus cum, delectus non sunt eaque maxime! Incidunt, doloribus accusamus. Expedita necessitatibus atque alias rem quos, nisi repellat!',1,'2026-03-01 08:08:21','2026-03-01 08:15:12'),(4,'tes4','galleries/01KJMZ3N3C78WN1X38NFY3BXDB.jpg','Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda possimus voluptatem et dolor facilis temporibus, cumque vitae unde ut quisquam rerum quia asperiores, velit reprehenderit est, laboriosam hic vel. Odio?',1,'2026-03-01 08:08:44','2026-03-01 08:15:12'),(5,'test 5','galleries/01KJMZ4QA2G9QM6C5SSFMWFQ8D.jpg','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptates et quibusdam molestiae recusandae tempora quae rerum ullam vel, omnis nobis voluptas atque magni vitae reprehenderit deserunt! Nisi voluptas fuga eos!',1,'2026-03-01 08:09:19','2026-03-01 08:15:12'),(6,'tes terakhir','galleries/01KJMZ5MYC96EEMPCYK35V1M4W.jpg','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur eius expedita nulla ad, quis doloremque excepturi cumque error, magnam iure nostrum quo fuga ducimus illum sint dicta nesciunt itaque vero.\n    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit labore alias, quam officia optio totam dolores saepe quaerat eius a nam quas maxime fugiat modi molestias esse ducimus et nemo.',1,'2026-03-01 08:09:49','2026-03-01 08:15:12');
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komisariat`
--

DROP TABLE IF EXISTS `komisariat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `komisariat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `singkatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kampus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Sidoarjo',
  `ketua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_ketua` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `komisariat_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komisariat`
--

LOCK TABLES `komisariat` WRITE;
/*!40000 ALTER TABLE `komisariat` DISABLE KEYS */;
INSERT INTO `komisariat` VALUES (1,'Komisariat Ahmad Dahlan',NULL,NULL,'Sidoarjo',NULL,NULL,'aktif',NULL,'2026-03-01 07:53:56','2026-03-01 07:53:56'),(2,'Komisariat UMSIDA',NULL,NULL,'Sidoarjo',NULL,NULL,'aktif',NULL,'2026-03-01 07:55:10','2026-03-01 07:55:10'),(3,'Komisariat UNUSIDA',NULL,NULL,'Sidoarjo',NULL,NULL,'aktif',NULL,'2026-03-01 07:55:10','2026-03-01 07:55:10');
/*!40000 ALTER TABLE `komisariat` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_02_26_000001_create_categories_table',1),(5,'2026_02_26_000002_create_posts_table',1),(6,'2026_02_26_000003_create_events_table',1),(7,'2026_02_26_000004_create_galleries_table',1),(8,'2026_02_26_000005_create_pengurus_table',1),(9,'2026_02_26_000006_create_downloads_table',1),(10,'2026_02_26_000007_create_surat_masuk_table',1),(11,'2026_02_26_000008_create_sliders_table',1),(12,'2026_02_26_000009_create_e_magazines_table',1),(13,'2026_02_26_000010_create_site_settings_table',1),(14,'2026_03_01_000011_create_komisariat_table',2),(15,'2026_03_10_140900_add_link_to_site_settings_table',3),(16,'2026_03_12_134825_add_berkas_tambahan_to_surat_masuk_table',4),(17,'2026_03_12_134829_convert_berkas_aktif_to_sk_requirements_config',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
-- Table structure for table `pengurus`
--

DROP TABLE IF EXISTS `pengurus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengurus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urutan` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengurus`
--

LOCK TABLES `pengurus` WRITE;
/*!40000 ALTER TABLE `pengurus` DISABLE KEYS */;
INSERT INTO `pengurus` VALUES (1,'Mahbub Djunaedi','Ketua Umum','pengurus/01KJN0PKBZFA066NCFQS0F5EMY.jpg','rayon.mahbubdjunaidi',1,1,'2026-03-01 08:36:33','2026-03-01 08:38:50'),(2,'Joni Deep','Wakil Ketua 1','pengurus/01KKH6MQXBJEEZ7ER908NZ2MTX.jpg',NULL,2,1,'2026-03-12 07:19:08','2026-03-12 07:19:08');
/*!40000 ALTER TABLE `pengurus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT '0',
  `category_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Pelantikan Raya Se darjo','pelantikan-raya-se-darjo','<p><strong>Lorem ipsum</strong> dolor sit amet consectetur adipisicing elit. Rem, iste repellendus. Consequuntur non cum aliquid, maiores voluptatibus at eos repudiandae eaque nobis, tempora quaerat ratione libero exercitationem in. Voluptates, at!</p>','posts/01KJQF1X5TKD2REDV1SQFESF64.jpg',1,NULL,'2026-03-02 07:25:52','2026-03-02 07:25:52'),(2,'pkd al khozini','pkd-al-khozini','<p><em>Lorem ipsum</em> dolor sit amet consectetur adipisicing elit. Consequuntur fuga velit vel iusto assumenda incidunt eius aperiam laudantium modi, sunt delectus officiis sed animi error mollitia, quaerat magnam. Neque, tempora.</p>','posts/01KJQG9JN298YC07HWM2F2WGC5.jpg',1,NULL,'2026-03-02 07:47:32','2026-03-02 07:47:32'),(3,'Baksos PMII kepada UMAT','baksos-pmii-kepada-umat','<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id non, deleniti dolores sint rem facere consequuntur? A reiciendis ad fugit, nihil ipsa alias ducimus perferendis natus nam, vitae exercitationem eaque. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatem, praesentium facere, porro ab accusamus aliquid iste inventore fugiat ut itaque quisquam? Quam accusantium autem distinctio doloribus laborum et suscipit inventore?</p>','posts/01KJQGD1C02B69ZFXCYT7DGYQ3.jpg',1,NULL,'2026-03-02 07:49:26','2026-03-02 07:50:35');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('2YR8mNrRoSTFCkVsF760LfIBTALi9JngbD2qESfK',NULL,'104.37.27.57','Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOE10cnVYa21RdUpCdWxmbjUzMG9LUDNIU3Zwd2hBeUJTRk5xd0pKdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbW9oZWYtc2VydmVyLnRhaWwzMjRjNmEudHMubmV0IjtzOjU6InJvdXRlIjtOO319',1773681477),('3y0wyf5tm8UMHH11JFoJYGiB6YXQVOFPd8K5ZiCs',1,'100.75.97.120','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo4OntzOjY6Il90b2tlbiI7czo0MDoid3JtVHByMXlzRXZpcmxIbmFIZG15Y3hLRjk2TWlUV0ZTeVZMZk5zTyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjUxOiJodHRwczovL21vaGVmLXNlcnZlci50YWlsMzI0YzZhLnRzLm5ldC9wZW5nYWp1YW4tc2siO3M6NToicm91dGUiO3M6ODoic2suaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjY0OiI3MDY0Njg3NzE4ZjI2NGVmMjE0YWEwMjQ5MjNiMjAzNzgzZTc5Yjc0MGQwYmY5NWIyOTE0Zjk2NzIxYjhiNTcwIjtzOjg6ImZpbGFtZW50IjthOjA6e31zOjY6InRhYmxlcyI7YTozOntzOjQwOiI4MmJhNzE0ODAzN2U3OWMzOTQ4YjIxNDM4ZjU3MmFiMF9jb2x1bW5zIjthOjQ6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJpbWFnZSI7czo1OiJsYWJlbCI7czo3OiJQcmV2aWV3IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJ0aXRsZSI7czo1OiJsYWJlbCI7czo1OiJKdWR1bCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjI7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6NjoidXJ1dGFuIjtzOjU6ImxhYmVsIjtzOjY6IlVydXRhbiI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6OToiaXNfYWN0aXZlIjtzOjU6ImxhYmVsIjtzOjU6IkFrdGlmIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiI2ZDYxOWQwMGNiYTgxMWM5NzM2NTEzYmMxNmQyYmM2YV9jb2x1bW5zIjthOjM6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo1OiJsYWJlbCI7czo1OiJsYWJlbCI7czoxMDoiS2V0ZXJhbmdhbiI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6Mzoia2V5IjtzOjU6ImxhYmVsIjtzOjQ6IktvZGUiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjU6InZhbHVlIjtzOjU6ImxhYmVsIjtzOjU6Ik5pbGFpIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiI0NmYzZDU3MjFlNWIwZGEzYjgzNWNiMjY5YjliOTVlZF9jb2x1bW5zIjthOjY6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMjoibmFtYV9wZW1vaG9uIjtzOjU6ImxhYmVsIjtzOjEyOiJOYW1hIFBlbW9ob24iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToxO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJrb21pc2FyaWF0IjtzOjU6ImxhYmVsIjtzOjEwOiJLb21pc2FyaWF0IjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo4OiJ3aGF0c2FwcCI7czo1OiJsYWJlbCI7czo4OiJXaGF0c0FwcCI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTQ6ImJlcmthc19sZW5na2FwIjtzOjU6ImxhYmVsIjtzOjY6IkJlcmthcyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjQ7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6Njoic3RhdHVzIjtzOjU6ImxhYmVsIjtzOjY6IlN0YXR1cyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTM6IlRhbmdnYWwgTWFzdWsiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9fX19',1773640665),('5VrBT8bxoUEXZNVbkke9Es1e7tGajtAuYSh3nCOE',NULL,'35.90.69.232','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWW9lUldRZVpZTEd5QWg0dnQwdzl3aXdJaExmaWprblBobVBGQk42MyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbW9oZWYtc2VydmVyLnRhaWwzMjRjNmEudHMubmV0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1773681481),('6Thq44tVLforukJ08Eb6UppGcJ89zAdYuQrc7b9m',NULL,'74.7.242.54','Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; GPTBot/1.3; +https://openai.com/gptbot)','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYmtZcXRBM3RDczA1dlJLZlV6MllMa0pVUWlIeVE0WVVPM2t6R0pMSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vbW9oZWYtc2VydmVyLnRhaWwzMjRjNmEudHMubmV0L3Bvc3RzL3BrZC1hbC1raG96aW5pIjtzOjU6InJvdXRlIjtzOjEwOiJwb3N0cy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1773650908),('DxuggZbkqJlznmgEOpXgkLjEuNjNF6fCaSSaJsBu',NULL,'104.224.66.228','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.2210.133','YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTNKaTFUVktVWGxuVkx6YlVrODdsNnlvVEt2TlVkZ3ZJZUZsYmV2VSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njk6Imh0dHBzOi8vbW9oZWYtc2VydmVyLnRhaWwzMjRjNmEudHMubmV0L3Bvc3RzL3BlbGFudGlrYW4tcmF5YS1zZS1kYXJqbyI7czo1OiJyb3V0ZSI7czoxMDoicG9zdHMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1773681466),('j2KSVLWhwuapkkXekLQgqiy2u0QgVZkpz4KfBbdt',NULL,'172.121.209.113','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRU13YzJhYzI0aGx5cDFBSlZDQmZmd1NyWnNyUnRySnJLZXNmZkFQcyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbW9oZWYtc2VydmVyLnRhaWwzMjRjNmEudHMubmV0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1773660760),('JQAiWDE3DZMMCxiagTeMjKengWFn01egz4h5rwhM',NULL,'8.229.136.210','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXV0eHEycFF2YVBNa0hTRVlreTNTU0dBVjhwcEdJZHVSeklPdGpBeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbW9oZWYtc2VydmVyLnRhaWwzMjRjNmEudHMubmV0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1773691320),('MnjUK5G8HRXwT0tXefpF3lYj42GveT8pcb36D8uD',NULL,'172.121.209.113','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0','YToyOntzOjY6Il90b2tlbiI7czo0MDoiSVpDTFRXVE83a1NzYlY3amR3cXdZTXRwaVJmSjV1TGp0aktNSmM0dyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1773660756),('q4YeyvoHNm2uOp8P4HXk4muvt00YgfYXZzcbHuMd',NULL,'100.75.97.120','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidHVmZmp5ZEowZU5HN01HVnd4QmhHRjg2VlhzNVhvMEFjMjJMZkZESiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NDoiaHR0cHM6Ly9tb2hlZi1zZXJ2ZXIudGFpbDMyNGM2YS50cy5uZXQvYWRtaW4iO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozODoiaHR0cHM6Ly9tb2hlZi1zZXJ2ZXIudGFpbDMyNGM2YS50cy5uZXQiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1773727493),('qtMdes0naIWs6eUtdPfXDgFhEwDqX6Wnfdk7OBmO',NULL,'45.5.66.200','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiYUpOWnprM3h5NXlQMWhFQzFPeGk3bmFtcFdyRFpmdlZqZXdPaTNkZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vbW9oZWYtc2VydmVyLnRhaWwzMjRjNmEudHMubmV0IjtzOjU6InJvdXRlIjtOO319',1773681472);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'anggota_aktif','800','https://www.bps.go.id/id/statistics-table/2/MjI2MyMy/inflasi-year-on-year--februari-2026.html','Anggota Aktif','2026-02-26 23:57:41','2026-03-10 07:17:40'),(2,'alumni_kaderisasi','300','https://dinkannak.banyumaskab.go.id/read/47405/mengenal-sapi-perah-yang-populer-di-indoneisa','Alumni Kaderisasi','2026-02-26 23:57:41','2026-03-15 22:55:30'),(3,'kegiatan_tahunan','45',NULL,'Kegiatan Tahunan','2026-02-26 23:57:41','2026-02-26 23:57:41'),(4,'publikasi_kajian','25',NULL,'Publikasi & Kajian','2026-02-26 23:57:41','2026-02-26 23:57:41'),(5,'profil_media','',NULL,'Profil – Foto/Video (upload path atau URL YouTube embed)','2026-02-27 01:18:02','2026-03-10 02:58:41'),(6,'profil_media_type','image',NULL,'Profil – Tipe Media (image / video)','2026-02-27 01:18:02','2026-02-27 01:18:02'),(7,'profil_judul','Pergerakan Mahasiswa Islam Indonesia',NULL,'Profil – Judul','2026-02-27 01:18:02','2026-02-27 01:18:02'),(8,'profil_deskripsi','PMII merupakan organisasi gerakan dan kaderisasi yang berlandaskan islam ahlussunah waljamaah. Berdiri sejak tanggal 17 April 1960 di Surabaya dan hingga lebih dari setengah abad kini PMII terus eksis untuk memberikan kontribusi bagi kemajuan bangsa dan negara.',NULL,'Profil – Deskripsi','2026-02-27 01:18:03','2026-02-27 01:18:03'),(9,'profil_tujuan','Terbentuknya pribadi muslim Indonesia yang bertakwa kepada Allah Swt, Berbudi luhur, berilmu, cakap dan bertanggungjawab dalam mengamalkan ilmunya serta komitmen memperjuangkan cita-cita kemerdekaan Indonesia.',NULL,'Profil – Tujuan PMII','2026-02-27 01:18:03','2026-02-27 01:18:03'),(10,'profil_visi','Menguatkan Profesionalitas Organisasi Menuju Era Baru PMII',NULL,'Profil – Visi PMII Sidoarjo','2026-02-27 01:18:03','2026-02-27 01:18:03'),(11,'sk_requirements_config','[{\"label\":\"Surat Pengajuan SK\",\"is_required\":true,\"is_active\":false,\"is_system\":true,\"key\":\"surat_permohonan_sk_1\"},{\"label\":\"Berita Acara RTK \\/ RTAR\",\"is_required\":false,\"is_active\":false,\"is_system\":true,\"key\":\"berita_acara_rapat_tahunan_rapat_anggota\"},{\"label\":\"Berita Acara Formatur\",\"is_required\":false,\"is_active\":false,\"is_system\":true,\"key\":\"berita_acara_formatur\"},{\"label\":\"Struktur Kepengurusan\",\"is_required\":false,\"is_active\":false,\"is_system\":true,\"key\":\"struktur_kepengurusan\"},{\"label\":\"Laporan Pertanggungjawaban Pengurus Demisioner\",\"is_required\":false,\"is_active\":false,\"is_system\":true,\"key\":\"laporan_pertanggungjawaban_pengurus_demisioner\"},{\"label\":\"Dokumentasi RTK\\/ RTAR\",\"is_required\":false,\"is_active\":false,\"is_system\":true,\"key\":\"rekomendasi_ika_jika_ada\"},{\"label\":\"Sertifikat PKD bagi Ketua dan BPH Komisariat - FC Sertifikat PKD untuk ketua Rayon\",\"is_required\":false,\"is_active\":false,\"is_system\":true,\"key\":\"scan_ktp_pemohon\"},{\"label\":\"Data BPH Komisariat \\/ Rayon \",\"is_required\":true,\"is_active\":false,\"is_system\":true,\"key\":\"scan_ktm_kartu_anggota\"},{\"label\":\"CV BPH PENGURUS\",\"is_required\":false,\"is_active\":false,\"is_system\":true,\"key\":\"sertifikat_pkd_pkl\"},{\"key\":\"db_lengkap_anggota_nama_fakultas_jurusan_dsb\",\"label\":\"DB Lengkap Anggota (NAma, Fakultas, Jurusan dsb)\",\"is_required\":true,\"is_active\":false,\"is_system\":false},{\"key\":\"surat_pengajuan_dana\",\"label\":\"surat pengajuan dana\",\"is_required\":false,\"is_active\":true,\"is_system\":false}]',NULL,'Konfigurasi Syarat SK','2026-03-01 07:53:57','2026-03-15 22:57:35'),(12,'kontak_alamat','Jl. Capung No.114, Kwadengan Barat, Lemahputro, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61213',NULL,'Kontak – Alamat / Lokasi','2026-03-10 02:58:41','2026-03-10 02:58:41'),(13,'kontak_email','pcpmiisda@yahoo.com',NULL,'Kontak – Email','2026-03-10 02:58:41','2026-03-10 03:20:36'),(15,'sosmed_facebook','',NULL,'Sosmed – Facebook URL','2026-03-10 02:58:41','2026-03-10 02:58:41'),(16,'sosmed_instagram','https://www.instagram.com/setelanpabrik__/',NULL,'Sosmed – Instagram URL','2026-03-10 02:58:41','2026-03-10 03:19:56'),(17,'sosmed_twitter','',NULL,'Sosmed – Twitter/X URL','2026-03-10 02:58:42','2026-03-10 02:58:42'),(18,'sosmed_youtube','',NULL,'Sosmed – YouTube URL','2026-03-10 02:58:42','2026-03-10 02:58:42'),(20,'link_bergabung','https://id.wikipedia.org/wiki/Sapi',NULL,'Beranda – Link Tombol \"Bergabung dengan Kami\"','2026-03-10 03:02:13','2026-03-15 22:54:11'),(21,'kontak_wa_list','[{\"nomor\":\"6282232619640\"},{\"nomor\":\"6285785168163\"}]',NULL,'Daftar Nomor WhatsApp','2026-03-10 07:40:35','2026-03-15 22:52:59');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` smallint unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (2,'kegiatan 1','demo','sliders/01KJEZ32E5R5Y19PP2SRBEZQVH.jpg',1,1,'2026-02-27 00:12:58','2026-02-27 00:12:58'),(3,'kegiatan 2','diskusi','sliders/01KJEZ3MW8NFXQQJ99DNK9W839.jpg',2,1,'2026-02-27 00:13:17','2026-02-27 00:13:17'),(4,'kegiatan 3','sarasehan','sliders/01KJEZ4Q8EZYVVFRK5RKT4KZSB.jpeg',3,1,'2026-02-27 00:13:52','2026-02-27 00:13:52'),(5,'coba','coba lagi','sliders/01KK1NSBF3SX5S2VMJKQ96GJFF.jpg',5,1,'2026-03-06 06:35:56','2026-03-06 06:35:56');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat_masuk`
--

DROP TABLE IF EXISTS `surat_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `surat_masuk` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_pemohon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisariat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','diproses','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan_admin` text COLLATE utf8mb4_unicode_ci,
  `file_permohonan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ba_rapat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ba_formatur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_struktur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_lpj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_rekomendasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ktm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_sertifikat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berkas_tambahan` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat_masuk`
--

LOCK TABLES `surat_masuk` WRITE;
/*!40000 ALTER TABLE `surat_masuk` DISABLE KEYS */;
INSERT INTO `surat_masuk` VALUES (1,'Mohammad','082336744354','on','diproses','lengkapi lagi','surat-masuk/00c8r6pWEI6Jb1WlFoxNOXiQcPTA7CmFuTeCTupF.jpg','surat-masuk/KRzLrxm5GFQWducPhhIvnD5FWdz1RCnIdWcbDINM.pdf','surat-masuk/ByGT5qfJi0onMkyBG1obtJz3n8SyXZg9aYCV0uVi.pdf',NULL,'surat-masuk/GHXrK0xdbtXE3zctQndqIzxVXZfaMdOLYQCPGncr.pdf',NULL,NULL,NULL,NULL,NULL,'2026-02-28 07:50:55','2026-02-28 08:02:52'),(2,'erina','085785168163','on','selesai',NULL,'surat-masuk/Mdr49mwemVirPKgIUCQutJEdBWVZQuR8AiLgi0tB.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-02-28 08:21:20','2026-02-28 08:33:42'),(3,'Jhony','082326968990','Komisariat AL-KHOLIL','diproses',NULL,'surat-masuk/Tx4hCE5PTC2F8WMKYwUBWVPyGaOpvFPyc71DjPAv.jpg','surat-masuk/YxtMpJzzevMm12ElSX1D9OrwwYaAT2UkIOKuE65v.pdf','surat-masuk/KV1GucBYPGlDm2NVllMtifcpyDoYQOz0QEBWU8Qy.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-02-28 08:44:58','2026-03-02 07:45:47'),(4,'jamal','085785168163','Komisariat UMSIDA','selesai',NULL,'surat-masuk/e7ndFIYpce9feqFVZGM7qI5WITp99DjXElrEP7gI.pdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2026-03-06 06:25:32','2026-03-06 06:26:36');
/*!40000 ALTER TABLE `surat_masuk` ENABLE KEYS */;
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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin PMII Sidoarjo','admin@pmiisidoarjo.or.id',NULL,'$2y$12$jm7hR7yc4kJCfKiYBq/UP.756w1KiCK05d2XSzw4s02Aqcz0Nsz66','JFzrAQtTTaL8KweDY6qOPDKNqupYqBaxFQ41G7V7IhkljtxgPRYsk4tmrKgI','2026-02-26 23:57:40','2026-02-26 23:57:40');
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

-- Dump completed on 2026-03-17 13:49:52
