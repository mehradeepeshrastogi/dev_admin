-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `iq_admin`;
CREATE TABLE `iq_admin` (
  `admin_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `lang_id` bigint(20) unsigned DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `iq_admin_email_unique` (`email`),
  UNIQUE KEY `iq_admin_phone_unique` (`phone`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `iq_admin_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `iq_language` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_admin` (`admin_id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `active`, `lang_id`, `created_at`, `updated_at`) VALUES
(2,	'deepesh rastogi',	'dev43@infoicon.co.in',	'9876543210',	NULL,	'e7b0fdf2ddecc62db63d328b9895096f',	NULL,	'1',	1,	'2019-08-03 12:23:59',	'2019-08-03 12:23:59');

DROP TABLE IF EXISTS `iq_category`;
CREATE TABLE `iq_category` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 = disable,1 = enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_category` (`category_id`, `slug`, `short_order`, `active`, `created_at`, `updated_at`) VALUES
(1,	'testsdfdsasdf',	'0',	'1',	'2020-02-13 07:47:22',	'2020-02-13 07:47:22'),
(2,	'cat2',	'0',	'1',	'2020-02-13 08:51:27',	'2020-02-13 08:51:27');

DROP TABLE IF EXISTS `iq_category_lang`;
CREATE TABLE `iq_category_lang` (
  `category_lang_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `lang_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`category_lang_id`),
  KEY `iq_category_lang_category_id_foreign` (`category_id`),
  KEY `iq_category_lang_lang_id_foreign` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_category_lang` (`category_lang_id`, `name`, `description_short`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `category_id`, `lang_id`) VALUES
(9,	'test',	'fadsfasdfsdaf',	'',	NULL,	NULL,	NULL,	1,	1),
(10,	'test',	'asdfsdfsdfsdafsdaf',	'',	NULL,	NULL,	NULL,	1,	2),
(11,	'cat2',	'tetreraew',	'',	NULL,	NULL,	NULL,	2,	1),
(12,	'cat2',	'fdsafadsfsdaf',	'',	NULL,	NULL,	NULL,	2,	2);

DROP TABLE IF EXISTS `iq_language`;
CREATE TABLE `iq_language` (
  `lang_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = disable,1 = enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_language` (`lang_id`, `name`, `short_order`, `active`, `created_at`, `updated_at`) VALUES
(1,	'english',	'1',	'1',	'2019-08-03 12:23:35',	'2019-08-03 12:23:35'),
(2,	'german',	'2',	'1',	'2019-08-03 12:25:33',	'2019-08-03 12:25:33');

DROP TABLE IF EXISTS `iq_migrations`;
CREATE TABLE `iq_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_page`;
CREATE TABLE `iq_page` (
  `page_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `short_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 = disable,1 = enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_page` (`page_id`, `short_order`, `slug`, `active`, `created_at`, `updated_at`) VALUES
(1,	'0',	'dsfsda',	'1',	'2020-02-13 07:48:14',	'2020-02-13 07:48:14'),
(2,	'0',	'page2',	'1',	'2020-02-13 08:51:44',	'2020-02-13 08:51:44');

DROP TABLE IF EXISTS `iq_page_image`;
CREATE TABLE `iq_page_image` (
  `page_image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`page_image_id`),
  KEY `iq_page_image_page_id_foreign` (`page_id`),
  CONSTRAINT `iq_page_image_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `iq_page` (`page_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_page_lang`;
CREATE TABLE `iq_page_lang` (
  `page_lang_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) unsigned NOT NULL,
  `page_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`page_lang_id`),
  KEY `iq_page_lang_lang_id_foreign` (`lang_id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `iq_page_lang_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `iq_page` (`page_id`),
  CONSTRAINT `iq_page_lang_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `iq_language` (`lang_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_page_lang` (`page_lang_id`, `name`, `description_short`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `lang_id`, `page_id`) VALUES
(3,	'test page',	'',	'<p>sdfsdafasdf</p>\r\n',	'',	'',	'',	1,	1),
(4,	'test page',	'',	'<p>sdafsdfdsaf</p>\r\n',	'',	'',	'',	2,	1),
(5,	'page2',	'',	'<p>page2</p>',	'',	'',	'',	1,	2),
(6,	'page2',	'',	'<p>page2</p>',	'',	'',	'',	2,	2);

DROP TABLE IF EXISTS `iq_password_resets`;
CREATE TABLE `iq_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `iq_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_post`;
CREATE TABLE `iq_post` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `short_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = disable,1 = enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `iq_post_product_id_foreign` (`product_id`),
  CONSTRAINT `iq_post_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `iq_product` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_post_image`;
CREATE TABLE `iq_post_image` (
  `post_image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`post_image_id`),
  KEY `iq_post_image_post_id_foreign` (`post_id`),
  CONSTRAINT `iq_post_image_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `iq_post` (`post_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_post_lang`;
CREATE TABLE `iq_post_lang` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `iq_post_lang_lang_id_foreign` (`lang_id`),
  CONSTRAINT `iq_post_lang_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `iq_language` (`lang_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_product`;
CREATE TABLE `iq_product` (
  `product_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `short_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = disable,1 = enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `iq_product_category_id_foreign` (`category_id`),
  CONSTRAINT `iq_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `iq_category` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_product_image`;
CREATE TABLE `iq_product_image` (
  `product_image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`product_image_id`),
  KEY `iq_product_image_product_id_foreign` (`product_id`),
  CONSTRAINT `iq_product_image_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `iq_product` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_product_lang`;
CREATE TABLE `iq_product_lang` (
  `product_lang_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_short` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`product_lang_id`),
  KEY `iq_product_lang_lang_id_foreign` (`lang_id`),
  CONSTRAINT `iq_product_lang_lang_id_foreign` FOREIGN KEY (`lang_id`) REFERENCES `iq_language` (`lang_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_users`;
CREATE TABLE `iq_users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT ' 1 = Android, 2 = iOS',
  `device_id` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Android',
  `device_token` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'IOS',
  `active` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT '1' COMMENT '0 = disable, 1 = enable, 2 = delete_from_user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `iq_users_email_unique` (`email`),
  UNIQUE KEY `iq_users_phone_unique` (`phone`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `iq_users_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `iq_language` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `iq_user_login_history`;
CREATE TABLE `iq_user_login_history` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `iq_user_login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `iq_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-02-13 12:22:17
