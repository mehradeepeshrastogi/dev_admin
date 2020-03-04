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

DROP TABLE IF EXISTS `iq_post`;
CREATE TABLE `iq_post` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `short_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = disable,1 = enable',
  `post_type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = post, 2 = category 3 = page ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_post` (`post_id`, `short_order`, `active`, `post_type`, `created_at`, `updated_at`) VALUES
(1,	'0',	'0',	'2',	'2020-02-17 09:14:03',	'2020-02-17 09:14:03'),
(2,	'11',	'0',	'3',	'2020-02-17 09:21:19',	'2020-02-17 09:21:19'),
(3,	'0',	'1',	'1',	'2020-02-17 12:10:29',	'2020-02-17 12:10:29'),
(4,	'0',	'0',	'1',	'2020-02-17 12:10:56',	'2020-02-17 12:10:56'),
(5,	'1',	'0',	'3',	'2020-02-17 12:11:29',	'2020-02-17 12:11:29'),
(6,	'0',	'0',	'2',	'2020-02-17 12:11:52',	'2020-02-17 12:11:52');

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
  `post_lang_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `lang_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `description_short` mediumtext CHARACTER SET utf8 NOT NULL,
  `description` longtext CHARACTER SET utf8 NOT NULL,
  `slug` varchar(300) CHARACTER SET utf8 NOT NULL,
  `meta_title` varchar(128) CHARACTER SET utf8 NOT NULL,
  `meta_keyword` varchar(255) CHARACTER SET utf8 NOT NULL,
  `meta_description` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`post_lang_id`),
  KEY `post_id` (`post_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `iq_post_lang_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `iq_post` (`post_id`),
  CONSTRAINT `iq_post_lang_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `iq_language` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_post_lang` (`post_lang_id`, `post_id`, `lang_id`, `name`, `description_short`, `description`, `slug`, `meta_title`, `meta_keyword`, `meta_description`) VALUES
(1,	1,	1,	'fadfasdf',	'sdfsdafsd',	'',	'sdfsad',	'',	'',	''),
(2,	1,	2,	'fdsafsdaf',	'fsdfsdafsdf',	'',	'dfsadfasdf',	'',	'',	''),
(3,	2,	1,	'sadfsda',	'',	'<p>ffgsadfdfdsfs</p>',	'd',	'',	'',	''),
(4,	2,	2,	'afdsafsdafsdf',	'',	'<p>sdafsadfsdafsad</p>',	'f',	'',	'',	''),
(5,	3,	1,	'sdfsdafasdfsadf',	'sdfsda',	'<p>sdfdsasdf</p>',	'sdafdsafasd',	'',	'',	''),
(6,	3,	2,	'sdafadsfasdf',	'sdfsad',	'<p>dsfdsa</p>',	'sdfsdaf',	'',	'',	''),
(7,	4,	1,	'fasdf',	'sdafadsf',	'<p>sdfasdfasd</p>',	'sdfasdf',	'',	'',	''),
(8,	4,	2,	'sdfdsafsd',	'sdfasdsd',	'<p>sdfsdsad</p>',	'sdafsadf',	'',	'',	''),
(9,	5,	1,	'afdsfds',	'sdfsadsd',	'<p>sdafasdfsad</p>',	'sdfsda',	'',	'',	''),
(10,	5,	2,	'dsfsadfsd',	'sdfasd',	'<p>sdfasd</p>',	'sdfsdafasdf',	'',	'',	''),
(11,	6,	1,	'afasdf',	'sdfsadf',	'',	'sdfasdf',	'',	'',	''),
(12,	6,	2,	'fsdf',	'sdafsdfsdfsa',	'',	'sdfsad',	'',	'',	'');

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


-- 2020-02-17 13:17:14
