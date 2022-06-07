/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 5.7.33 : Database - yuuran
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `app_access_menu` */

DROP TABLE IF EXISTS `app_access_menu`;

CREATE TABLE `app_access_menu` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_group_user_id` int(10) unsigned NOT NULL,
  `app_modul_id` int(10) unsigned NOT NULL,
  `app_menu_id` int(10) unsigned NOT NULL,
  `allowed_access` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_access_menu_created_by_foreign` (`created_by`),
  KEY `app_access_menu_updated_by_foreign` (`updated_by`),
  KEY `app_access_menu_app_group_user_id_foreign` (`app_group_user_id`),
  KEY `app_access_menu_app_modul_id_foreign` (`app_modul_id`),
  KEY `app_access_menu_app_menu_id_foreign` (`app_menu_id`),
  CONSTRAINT `app_access_menu_app_group_user_id_foreign` FOREIGN KEY (`app_group_user_id`) REFERENCES `app_group_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_access_menu_app_menu_id_foreign` FOREIGN KEY (`app_menu_id`) REFERENCES `app_menu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_access_menu_app_modul_id_foreign` FOREIGN KEY (`app_modul_id`) REFERENCES `app_modul` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_access_menu_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_access_menu_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_access_menu` */

insert  into `app_access_menu`(`id`,`app_group_user_id`,`app_modul_id`,`app_menu_id`,`allowed_access`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('092b5176-5c90-4b08-b26a-74fd50856b69',1,1,4,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('2cfa1d50-676c-4e58-8204-b637f67c7605',1,1,10,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('37601332-e583-4cb9-80ab-a0028894cf0f',1,2,16,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('446407d9-19fc-497a-85fb-4bd0a8c1e226',1,1,6,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('4812fb7b-9886-4f76-9ad9-07340a774fa7',1,1,13,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('490a4d70-133b-4e62-8d7b-c7fd9f051bde',1,1,14,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('4f5a0035-0bd9-4cf4-bae0-6146af7d0924',1,1,12,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('7819528d-c55b-438d-9950-95e8c285fca6',1,1,5,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('8c06fc96-c3c0-4136-8b63-b67fdb4cf557',1,1,7,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('95f9782a-2ac9-4d3a-b1f1-c8df20f10fad',1,1,8,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('ad291aba-7551-41a1-8e05-bb54d799dff4',2,2,16,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-14 17:07:36','2022-04-14 17:07:36',NULL,NULL),
('b85973fe-2035-44d8-9d25-51197aba6557',1,1,2,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('c04031ad-b700-424c-a666-1a31625aed8d',2,2,17,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-14 17:07:36','2022-04-14 17:07:36',NULL,NULL),
('c99cd4da-624f-495f-8653-6299349a3b72',1,1,3,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('e165e408-a3d3-4fab-ac4f-e327c8a3b29d',1,1,1,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('ec056a1c-7d7e-435d-9352-ceabb3b57f92',1,1,11,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('ee5efe94-b13a-4af7-acbf-4a260880247f',1,2,17,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('f8b85e64-2b38-4964-b35a-5b318ced1ddd',1,1,9,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
('ffcc66c9-8f80-42a4-8a45-9f7c1e7dafc0',3,3,18,'[\"view\", \"add\", \"delete\", \"edit\", \"print\", \"approve\"]','2022-06-07 13:38:07','2022-06-07 13:38:07',NULL,NULL);

/*Table structure for table `app_access_modul` */

DROP TABLE IF EXISTS `app_access_modul`;

CREATE TABLE `app_access_modul` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `app_group_user_id` int(10) unsigned NOT NULL,
  `app_modul_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_access_modul_created_by_foreign` (`created_by`),
  KEY `app_access_modul_updated_by_foreign` (`updated_by`),
  KEY `app_access_modul_app_group_user_id_foreign` (`app_group_user_id`),
  KEY `app_access_modul_app_modul_id_foreign` (`app_modul_id`),
  CONSTRAINT `app_access_modul_app_group_user_id_foreign` FOREIGN KEY (`app_group_user_id`) REFERENCES `app_group_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_access_modul_app_modul_id_foreign` FOREIGN KEY (`app_modul_id`) REFERENCES `app_modul` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_access_modul_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_access_modul_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_access_modul` */

insert  into `app_access_modul`(`id`,`app_group_user_id`,`app_modul_id`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
('05e338e6-b07f-489d-af2d-1d96230180eb',3,3,'2022-06-07 13:07:38','2022-06-07 13:07:38',NULL,NULL),
('66b3ff28-70ff-4ad7-8bef-7bd211bcfaac',1,1,'2022-06-07 13:08:40','2022-06-07 13:08:40',NULL,NULL),
('7166215e-f4a5-4837-af9e-e2b2c9deb412',1,2,'2022-06-07 13:08:40','2022-06-07 13:08:40',NULL,NULL),
('821974fc-54f6-47fc-bd62-83c851040843',1,3,'2022-06-07 13:08:40','2022-06-07 13:08:40',NULL,NULL),
('b310f00a-e03b-4234-95da-6fc61dfb11c4',2,2,'2022-04-14 17:08:26','2022-04-14 17:08:26',NULL,NULL);

/*Table structure for table `app_group_user` */

DROP TABLE IF EXISTS `app_group_user`;

CREATE TABLE `app_group_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_group_user_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_group_user` */

insert  into `app_group_user`(`id`,`code`,`name`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'superadmin','Super Admin','active',NULL,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
(2,'bendahara','Bendahara','active',NULL,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
(3,'warga','Warga','active',NULL,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24');

/*Table structure for table `app_menu` */

DROP TABLE IF EXISTS `app_menu`;

CREATE TABLE `app_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_modul_id` int(10) unsigned NOT NULL,
  `app_menu_id_parent` int(10) unsigned DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL,
  `icon_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_menu_code_unique` (`code`),
  UNIQUE KEY `app_menu_route_unique` (`route`),
  KEY `app_menu_created_by_foreign` (`created_by`),
  KEY `app_menu_updated_by_foreign` (`updated_by`),
  KEY `app_menu_app_modul_id_foreign` (`app_modul_id`),
  KEY `app_menu_app_menu_id_parent_foreign` (`app_menu_id_parent`),
  CONSTRAINT `app_menu_app_menu_id_parent_foreign` FOREIGN KEY (`app_menu_id_parent`) REFERENCES `app_menu` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_menu_app_modul_id_foreign` FOREIGN KEY (`app_modul_id`) REFERENCES `app_modul` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_menu_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_menu_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_menu` */

insert  into `app_menu`(`id`,`app_modul_id`,`app_menu_id_parent`,`code`,`name`,`route`,`order`,`icon_name`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,1,NULL,'STG000001','Management User','setting/user',1,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(2,1,NULL,'STG000002','Management Group User','setting/user-group',2,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(3,1,NULL,'STG000003','Menu','setting/menu',3,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(4,1,NULL,'STG000004','Modul','setting/modul',4,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(5,1,NULL,'STG000005','Access Menu','setting/access-menu',5,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(6,1,NULL,'STG000006','Access Modul','setting/access-modul',6,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(7,1,NULL,'STG000007','Master Data','setting/master-category',7,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(8,1,NULL,'STG000008','Management Parameter','setting/parameter',8,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(9,1,NULL,'STG000009','Example / Dokumentasi','setting/example',9,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(10,1,NULL,'STG000010','Parent Menu','setting/parent',10,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(11,1,10,'STG000011','Anakan 1','setting/parent/child1',11,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(12,1,10,'STG000012','Anakan 2','setting/parent/child2',12,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(13,1,NULL,'STG000013','Format Penomoran','setting/format-penomoran',13,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(14,1,NULL,'STG000014','Format Dokumen','setting/format-dokumen',14,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(16,2,NULL,'DUES000001','Kategori','dues/category',1,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(17,2,NULL,'DUES000002','Transaksi','dues/transaction',2,NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(18,3,NULL,'CITIZEN00001','Transaksi','citizen/transaction',1,NULL,'active','2022-06-07 13:07:06','2022-06-07 13:07:06',NULL,NULL);

/*Table structure for table `app_modul` */

DROP TABLE IF EXISTS `app_modul`;

CREATE TABLE `app_modul` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `pattern` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_modul_code_unique` (`code`),
  KEY `app_modul_created_by_foreign` (`created_by`),
  KEY `app_modul_updated_by_foreign` (`updated_by`),
  CONSTRAINT `app_modul_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `app_modul_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `app_modul` */

insert  into `app_modul`(`id`,`code`,`name`,`order`,`pattern`,`icon_name`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'STG','Setting',99,'setting/*',NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(2,'DUES','Iuran',1,'dues/*',NULL,'active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(3,'CITIZEN','Warga',2,'citizen/*','','active','2022-06-07 13:06:23','2022-06-07 13:06:23',NULL,NULL);

/*Table structure for table `dues_category` */

DROP TABLE IF EXISTS `dues_category`;

CREATE TABLE `dues_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dues_category_code_unique` (`code`),
  KEY `dues_category_created_by_foreign` (`created_by`),
  KEY `dues_category_updated_by_foreign` (`updated_by`),
  CONSTRAINT `dues_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dues_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `dues_category` */

insert  into `dues_category`(`id`,`code`,`name`,`amount`,`description`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
(1,'IRSMPH','Iuran Sampah',25000,'Deskripsi Iuran Sampah','active',NULL,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
(2,'IRKMN','Iuran Keamanan',25000,'Deskripsi Iuran Keamanan','active',NULL,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
(3,'IRMKN','Iuran Makan',25000,'Deskripsi Iuran Makan','active',NULL,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
(4,'IRAG','Iuran Keagamaan',10000,'Deskripsi Iuran Keagamaan','active',NULL,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24');

/*Table structure for table `dues_detail` */

DROP TABLE IF EXISTS `dues_detail`;

CREATE TABLE `dues_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dues_category_id` int(10) unsigned NOT NULL,
  `users_id` int(10) unsigned NOT NULL,
  `year` int(11) NOT NULL DEFAULT '0',
  `month` int(11) NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `status` enum('paid_off','not_paid_off','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_paid_off',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dues_detail_dues_category_id_foreign` (`dues_category_id`),
  KEY `dues_detail_users_id_foreign` (`users_id`),
  KEY `dues_detail_created_by_foreign` (`created_by`),
  KEY `dues_detail_updated_by_foreign` (`updated_by`),
  CONSTRAINT `dues_detail_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dues_detail_dues_category_id_foreign` FOREIGN KEY (`dues_category_id`) REFERENCES `dues_category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dues_detail_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `dues_detail_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `dues_detail` */

insert  into `dues_detail`(`id`,`dues_category_id`,`users_id`,`year`,`month`,`amount`,`status`,`description`,`created_by`,`updated_by`,`created_at`,`updated_at`) values 
('0c923310-04e4-42c0-a1b7-6120562e2e0a',3,5,2022,4,25000,'paid_off','Dibayarkan oleh anaknya, karena yang bersangkutan belum pulang kerja.',5,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
('11120349-ae86-4412-bdb2-f19cdfbe2764',3,3,2022,4,25000,'paid_off','Dibayarkan oleh anaknya, karena yang bersangkutan belum pulang kerja.',3,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
('18d26744-4734-40e2-82ff-0ec9f4a3d696',1,8,2022,6,25000,'not_paid_off','Mantap nakia',2,NULL,'2022-06-04 14:45:13','2022-06-04 14:45:31'),
('1dae3272-c7ba-4e34-8bfe-f3af5f41c1c0',1,5,2022,5,2500000,'paid_off','tidak ada keterangan',2,NULL,'2022-04-12 07:43:24','2022-05-14 05:19:34'),
('201d33ba-0bd6-44bc-83fa-2cd319df1733',2,4,2022,6,30000,'not_paid_off','Dibayarkan oleh ART-nya',2,NULL,'2022-06-07 12:46:05','2022-06-07 12:46:05'),
('4cd57b1e-c61f-47ff-bb35-4619432a07b2',2,4,2022,4,15000,'not_paid_off',NULL,4,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
('57cb007e-98b5-4c89-8fac-1d38644d0f81',1,4,2022,4,25000,'paid_off',NULL,4,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
('7bf2a567-7dc5-424d-92e0-6f80023a2487',3,4,2022,4,25000,'paid_off','Dibayarkan oleh anaknya, karena yang bersangkutan belum pulang kerja.',4,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
('c88d6342-b45c-4b1d-b41f-fe0f4daf1951',1,3,2022,4,25000,'paid_off',NULL,3,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24'),
('e827f8f7-9364-4050-9dbe-91dddd8ecb1c',2,5,2022,4,100000,'not_paid_off','Oce mantap',2,NULL,'2022-04-12 07:43:24','2022-06-04 14:44:48'),
('edee1e6f-01cc-4ff0-9638-4bec4ed0e6e6',1,3,2022,6,35000,'not_paid_off','Oce mantap',2,NULL,'2022-06-07 09:55:05','2022-06-07 09:55:48'),
('f785b523-36b0-495f-bca2-d21f3008df28',2,3,2022,4,15000,'not_paid_off',NULL,3,NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24');

/*Table structure for table `example` */

DROP TABLE IF EXISTS `example`;

CREATE TABLE `example` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `job_desk` int(11) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `current_money` double NOT NULL,
  `profile_image` text COLLATE utf8mb4_unicode_ci,
  `hobby` json DEFAULT NULL,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci DEFAULT 'none',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `example_code_unique` (`code`),
  KEY `example_created_by_foreign` (`created_by`),
  KEY `example_updated_by_foreign` (`updated_by`),
  CONSTRAINT `example_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `example_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `example` */

insert  into `example`(`id`,`code`,`name`,`description`,`job_desk`,`birth_date`,`current_money`,`profile_image`,`hobby`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'ZR','Zeffry Reynando','Deskripsi Zeffry Reynando',NULL,'1999-04-04',100000,NULL,'[\"mandi\", \"makan\", \"tidur\"]','none','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(2,'SH','Syarif H','Deskripsi Syarif H',NULL,'1999-04-05',300000,NULL,'[\"minum\", \"makan\", \"tidur\"]','none','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(3,'HAHM','Helmi H','Deskripsi Helmi H',NULL,'1999-04-06',200000,NULL,'[\"belanja\", \"makan\", \"tidur\"]','none','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL);

/*Table structure for table `example_child_first` */

DROP TABLE IF EXISTS `example_child_first`;

CREATE TABLE `example_child_first` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `example_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `example_child_first_example_id_foreign` (`example_id`),
  CONSTRAINT `example_child_first_example_id_foreign` FOREIGN KEY (`example_id`) REFERENCES `example` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `example_child_first` */

/*Table structure for table `example_child_second` */

DROP TABLE IF EXISTS `example_child_second`;

CREATE TABLE `example_child_second` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `example_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `example_child_second_example_id_foreign` (`example_id`),
  CONSTRAINT `example_child_second_example_id_foreign` FOREIGN KEY (`example_id`) REFERENCES `example` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `example_child_second` */

/*Table structure for table `example_child_third` */

DROP TABLE IF EXISTS `example_child_third`;

CREATE TABLE `example_child_third` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `example_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `example_child_third_example_id_foreign` (`example_id`),
  CONSTRAINT `example_child_third_example_id_foreign` FOREIGN KEY (`example_id`) REFERENCES `example` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `example_child_third` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `master_category` */

DROP TABLE IF EXISTS `master_category`;

CREATE TABLE `master_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `master_category_id` int(10) unsigned DEFAULT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `master_category_code_unique` (`code`),
  KEY `master_category_created_by_foreign` (`created_by`),
  KEY `master_category_updated_by_foreign` (`updated_by`),
  KEY `master_category_master_category_id_foreign` (`master_category_id`),
  CONSTRAINT `master_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `master_category_master_category_id_foreign` FOREIGN KEY (`master_category_id`) REFERENCES `master_category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `master_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `master_category` */

insert  into `master_category`(`id`,`master_category_id`,`code`,`name`,`description`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,NULL,'testing','Kategori Testing','Deskripsi Kategori Testing','active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL);

/*Table structure for table `master_data` */

DROP TABLE IF EXISTS `master_data`;

CREATE TABLE `master_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `master_category_id` int(10) unsigned NOT NULL,
  `master_category_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `parameter1_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter2_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter3_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter4_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter5_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter1_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter2_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter3_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter4_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter5_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `master_data_code_unique` (`code`),
  KEY `master_data_created_by_foreign` (`created_by`),
  KEY `master_data_updated_by_foreign` (`updated_by`),
  KEY `master_data_master_category_id_foreign` (`master_category_id`),
  CONSTRAINT `master_data_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `master_data_master_category_id_foreign` FOREIGN KEY (`master_category_id`) REFERENCES `master_category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `master_data_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `master_data` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_100000_create_password_resets_table',1),
(2,'2019_08_19_000000_create_failed_jobs_table',1),
(3,'2019_12_14_000001_create_personal_access_tokens_table',1),
(4,'2022_01_01_084704_create_app_group_user_table',1),
(5,'2022_02_01_051426_create_user_table',1),
(6,'2022_02_22_081512_create_app_modul_table',1),
(7,'2022_02_22_082601_create_app_menu_table',1),
(8,'2022_02_22_090132_create_app_access_modul_table',1),
(9,'2022_02_22_090145_create_app_access_menu_table',1),
(10,'2022_02_22_090854_create_example_table',1),
(11,'2022_02_23_053851_create_example_child_first_table',1),
(12,'2022_02_23_053900_create_example_child_second_table',1),
(13,'2022_02_23_053910_create_example_child_third_table',1),
(14,'2022_03_03_034028_create_master_category_table',1),
(15,'2022_03_03_035725_create_master_data_table',1),
(16,'2022_03_18_114359_create_parameter_table',1),
(17,'2022_04_02_233010_create_dues_category_table',1),
(18,'2022_04_02_233156_create_dues_detail_table',1);

/*Table structure for table `parameter` */

DROP TABLE IF EXISTS `parameter`;

CREATE TABLE `parameter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parameter_code_unique` (`code`),
  KEY `parameter_created_by_foreign` (`created_by`),
  KEY `parameter_updated_by_foreign` (`updated_by`),
  CONSTRAINT `parameter_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `parameter_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `parameter` */

insert  into `parameter`(`id`,`name`,`code`,`value`,`status`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,'Minimal Jumlah Pacar','MIN_PACAR','1','active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(2,'Maximal Jumlah Pacar','MAX_PACAR','10','active','2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

insert  into `personal_access_tokens`(`id`,`tokenable_type`,`tokenable_id`,`name`,`token`,`abilities`,`last_used_at`,`created_at`,`updated_at`) values 
(1,'App\\Models\\User',2,'auth_token','99f183ccf3b0a4d92080f62dd954555fa4018b5b36e987c3acda4a67f9f7fd9c','[\"*\"]',NULL,'2022-04-14 16:37:15','2022-04-14 16:37:15'),
(2,'App\\Models\\User',3,'auth_token','0b9f5c85541fda21b6187366b0a28444b8afe334c0495bdc74d65629fc60a92f','[\"*\"]',NULL,'2022-04-15 12:26:37','2022-04-15 12:26:37'),
(3,'App\\Models\\User',3,'auth_token','c9e7724f9793bc6b981a73f6e45651bfde13075d3886197d0b008bcc3259b88c','[\"*\"]',NULL,'2022-04-15 13:29:53','2022-04-15 13:29:53'),
(4,'App\\Models\\User',3,'auth_token','91b787889f13d638d5627ac73eb722ce6907f3c9a27688e8e218c0c5796e2fac','[\"*\"]',NULL,'2022-04-15 13:31:35','2022-04-15 13:31:35'),
(5,'App\\Models\\User',3,'auth_token','fd02e9fc7b36e06dc1bce154f306da2d2dc117b7df1a4229f30d10e2babefd42','[\"*\"]',NULL,'2022-04-15 13:53:55','2022-04-15 13:53:55'),
(6,'App\\Models\\User',2,'auth_token','e4f923df9844c9bdac1930f2939a4ef09d8da53e3f6f92a7744534a159f15c05','[\"*\"]',NULL,'2022-04-16 06:36:06','2022-04-16 06:36:06'),
(7,'App\\Models\\User',3,'auth_token','36107ec53a484027e2be6c62c97101303da958d651bc5678034197260f55a7f3','[\"*\"]',NULL,'2022-04-16 06:44:26','2022-04-16 06:44:26'),
(8,'App\\Models\\User',2,'auth_token','91699a53f2e154ad3678ae988409c93fd680ee9fc3f0b3a8be796448b13a4309','[\"*\"]',NULL,'2022-04-16 06:53:09','2022-04-16 06:53:09'),
(9,'App\\Models\\User',2,'auth_token','b652523c6289892bc7ce22357ff4f8314c0b359290836fb4532e7ef324d60edf','[\"*\"]',NULL,'2022-04-16 07:26:03','2022-04-16 07:26:03'),
(10,'App\\Models\\User',2,'auth_token','3dd443344c4ea2c7d3c93593ee44f611363fd91c43aa6e04569168c2846715da','[\"*\"]',NULL,'2022-05-12 15:39:17','2022-05-12 15:39:17'),
(11,'App\\Models\\User',2,'auth_token','fb1dd016371cc19ed688a4f1e89d10eb8878a2d69c59a7458f5ba78fce65363a','[\"*\"]',NULL,'2022-06-04 13:23:49','2022-06-04 13:23:49'),
(12,'App\\Models\\User',2,'auth_token','30115cc18eb8d112cbbc12a1e317f8a2a0cc03dfcd32c6382de814b8a8b217b6','[\"*\"]',NULL,'2022-06-07 09:53:13','2022-06-07 09:53:13'),
(13,'App\\Models\\User',2,'auth_token','9f6838b2688fd07e32719eb2b574f2c69a4bbd17fffc499ba6e6513cb0f13185','[\"*\"]',NULL,'2022-06-07 09:56:28','2022-06-07 09:56:28'),
(14,'App\\Models\\User',2,'auth_token','00ce78925385c50728845840adc8633684e87da97d38ed52a6fdef3713057989','[\"*\"]',NULL,'2022-06-07 10:17:41','2022-06-07 10:17:41'),
(15,'App\\Models\\User',2,'auth_token','9ff9846ca6f97252a0b33e10d2e9fb6371d6eef7dee950f2e52f6af8c0631a0e','[\"*\"]',NULL,'2022-06-07 10:19:00','2022-06-07 10:19:00'),
(16,'App\\Models\\User',2,'auth_token','3222f7e5c4434c41ef8b5b3e18d5bf4ad61af42a1d9bf0d6807b1ed54b2e6c4e','[\"*\"]',NULL,'2022-06-07 12:29:46','2022-06-07 12:29:46');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_group_user_id` int(10) unsigned DEFAULT '1',
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','not_active','none') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telepon` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` enum('pria','wanita') COLLATE utf8mb4_unicode_ci DEFAULT 'pria',
  `profile_image` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_app_group_user_id_foreign` (`app_group_user_id`),
  KEY `users_created_by_foreign` (`created_by`),
  KEY `users_updated_by_foreign` (`updated_by`),
  CONSTRAINT `users_app_group_user_id_foreign` FOREIGN KEY (`app_group_user_id`) REFERENCES `app_group_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`app_group_user_id`,`username`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`status`,`no_telepon`,`jenis_kelamin`,`profile_image`,`created_at`,`updated_at`,`created_by`,`updated_by`) values 
(1,1,'superadmin','Super Admin','superadmin@gmail.com','2022-04-12 07:43:24','$2y$10$52lWyJk/W.tEa4PztJye8e2Mx4QUpQRGJ697jUbaOgjPDqGUNB3Wi','rdkHiQQ7ij','active',NULL,'pria',NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(2,2,'bendahara','Bendahara','bendahara@gmail.com','2022-04-12 07:43:24','$2y$10$FimiPE0yRlwfjdwlUylDX.U8aLtScAhIWNEGavztqOl1j/YyLldyG','74EbXcyjy0','active',NULL,'pria',NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(3,3,'zeffry','Zeffry Reynando','zeffryreynando@gmail.com','2022-04-12 07:43:24','$2y$10$.9dzu.HFY53t6tFwqAePNu0VusnUv0lKcLgsYnp1xHrN5HbpZvpLu','ql5rrAkpS3','active',NULL,'pria',NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(4,3,'syarif','Syarif Hidayatullah','syarif@gmail.com','2022-04-12 07:43:24','$2y$10$2sKl7b8NfpfJeb9uZy/1huJ2ZR/0MENx/5VQ2FWCumUVJ3jPYoy2W','zZQQvLJwJG','active',NULL,'pria',NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(5,3,'helmi','Helmi Aji','helmi@gmail.com','2022-04-12 07:43:24','$2y$10$q/AacI5nAN41XB1BfeeHM.G1P1l84F0lD6bVIfrmtOaJgf5zJCFba','jVEncEpHah','active',NULL,'pria',NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(6,3,'anggit','Anggit PP','anggit@gmail.com','2022-04-12 07:43:24','$2y$10$PrvBFBVcoLD3h0Y07cBRr.yYExWBEfUEPhtWAYNN8kLTpQnkUENey','vhQxoR0SN5','active',NULL,'pria',NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(7,3,'umar','Umar Bawazir','umar@gmail.com','2022-04-12 07:43:24','$2y$10$DxkBMjwsB97O74hnauqd9OXJyxwmNNBxSlw1U9AJ563ap.QOmfs/y','gX5OwMFDQu','active',NULL,'pria',NULL,'2022-04-12 07:43:24','2022-04-12 07:43:24',NULL,NULL),
(8,3,'nakia','Annisa Nakia Shakila','nakia@gmail.com',NULL,'$2y$10$k77Ih4iPg269IgJUz7jvtenOYez58sy.xfovaD/6/bAkemqN5xKxC',NULL,'active','089333222111','wanita',NULL,'2022-05-12 14:21:46','2022-05-12 14:22:16',NULL,NULL),
(9,3,'q','q','sss@gmail.com',NULL,'$2y$10$3mGVEttnfaXQZ7Vfj1BN0uGyCbeyBeiMB.pvkUV0uJWUMGPE9RMHK',NULL,'active',NULL,'pria',NULL,'2022-05-12 16:37:36','2022-05-12 16:37:36',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
