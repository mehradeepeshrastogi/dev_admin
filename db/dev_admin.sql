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

DROP TABLE IF EXISTS `iq_images`;
CREATE TABLE `iq_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(50) NOT NULL,
  `image_original_name` varchar(50) NOT NULL,
  `image_url` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `iq_images` (`image_id`, `image_name`, `image_original_name`, `image_url`, `image_path`, `created_at`, `updated_at`) VALUES
(77,	'15839230695a99fbb9f8c954d369e58033aac42e33.jpg',	'5a99fbb9f8c954d369e58033aac42e33.jpg',	'http://localhost/dev_admin/uploads/images',	'/var/www/html/dev_admin/uploads/images',	'0000-00-00 00:00:00',	'0000-00-00 00:00:00');

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

DROP TABLE IF EXISTS `iq_menu`;
CREATE TABLE `iq_menu` (
  `menu_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = disable,1 = enable',
  `menu_type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = menu, 2 = category 3 = page ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_menu` (`menu_id`, `active`, `menu_type`, `created_at`, `updated_at`) VALUES
(2,	'1',	'1',	'2020-02-25 09:23:37',	'2020-02-29 09:15:15'),
(3,	'1',	'1',	'2020-02-25 09:24:03',	'2020-02-25 12:24:03');

DROP TABLE IF EXISTS `iq_menu_lang`;
CREATE TABLE `iq_menu_lang` (
  `menu_lang_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `lang_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `menu_description` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`menu_lang_id`),
  KEY `menu_id` (`menu_id`),
  KEY `lang_id` (`lang_id`),
  CONSTRAINT `iq_menu_lang_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `iq_menu` (`menu_id`),
  CONSTRAINT `iq_menu_lang_ibfk_2` FOREIGN KEY (`lang_id`) REFERENCES `iq_language` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_menu_lang` (`menu_lang_id`, `menu_id`, `lang_id`, `name`, `menu_description`) VALUES
(5,	3,	1,	'footer_menu',	'[{\"text\":\"fadfasdf\",\"href\":\"http://localhost/dev_admin/sdfsad\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"fadfasdf\",\"post_id\":\"1\"},{\"text\":\"sadfsda\",\"href\":\"http://localhost/dev_admin/d\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"sadfsda\",\"post_id\":\"2\"}]'),
(23,	3,	2,	'german_footer_menu',	'[{\"text\":\"fdsafsdaf\",\"href\":\"http://localhost/dev_admin/dfsadfasdf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"fdsafsdaf\",\"post_id\":\"1\",\"children\":[{\"text\":\"afdsafsdafsdf\",\"href\":\"http://localhost/dev_admin/f\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"afdsafsdafsdf\",\"post_id\":\"2\"},{\"text\":\"dsfsadfsd\",\"href\":\"http://localhost/dev_admin/sdfsdafasdf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"dsfsadfsd\",\"post_id\":\"5\"}]},{\"text\":\"sdfdsafsd\",\"href\":\"http://localhost/dev_admin/sdafsadf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"sdfdsafsd\",\"post_id\":\"4\"},{\"text\":\"fsdf\",\"href\":\"http://localhost/dev_admin/sdfsad\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"fsdf\",\"post_id\":\"6\"}]'),
(24,	2,	2,	'german_header_menu',	'[{\"text\":\"fdsafsdaf\",\"href\":\"http://localhost/dev_admin/dfsadfasdf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"fdsafsdaf\",\"post_id\":\"1\",\"children\":[{\"text\":\"afdsafsdafsdf\",\"href\":\"http://localhost/dev_admin/f\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"afdsafsdafsdf\",\"post_id\":\"2\"}]},{\"text\":\"sdfdsafsd\",\"href\":\"http://localhost/dev_admin/sdafsadf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"sdfdsafsd\",\"post_id\":\"4\"},{\"text\":\"fsdf\",\"href\":\"http://localhost/dev_admin/sdfsad\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"fsdf\",\"post_id\":\"6\",\"children\":[{\"text\":\"dsfsadfsd\",\"href\":\"http://localhost/dev_admin/sdfsdafasdf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"dsfsadfsd\",\"post_id\":\"5\"}]}]'),
(27,	2,	1,	'header_menu',	'[{\"text\":\"sadfsda\",\"href\":\"http://localhost/dev_admin/d\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"sadfsda\",\"post_id\":\"2\"},{\"text\":\"fadfasdf\",\"href\":\"http://localhost/dev_admin/sdfsad\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"fadfasdf\",\"post_id\":\"1\",\"children\":[{\"text\":\"afdsfds\",\"href\":\"http://localhost/dev_admin/sdfsda\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"afdsfds\",\"post_id\":\"5\",\"children\":[{\"text\":\"fasdf\",\"href\":\"http://localhost/dev_admin/sdfasdf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"fasdf\",\"post_id\":\"4\"}]}]},{\"text\":\"afasdf\",\"href\":\"http://localhost/dev_admin/sdfasdf\",\"icon\":\"empty\",\"target\":\"_top\",\"title\":\"afasdf\",\"post_id\":\"6\"}]');

DROP TABLE IF EXISTS `iq_post`;
CREATE TABLE `iq_post` (
  `post_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `short_order` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '0 = disable,1 = enable',
  `post_type` enum('1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '1 = post, 2 = category 3 = page ',
  `post_image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `iq_post` (`post_id`, `short_order`, `active`, `post_type`, `post_image`, `created_at`, `updated_at`) VALUES
(1,	'0',	'1',	'2',	'',	'2020-02-17 09:14:03',	'2020-02-17 09:14:03'),
(2,	'11',	'1',	'3',	'',	'2020-02-17 09:21:19',	'2020-02-17 09:21:19'),
(4,	'0',	'1',	'1',	'',	'2020-02-17 12:10:56',	'2020-02-17 12:10:56'),
(5,	'1',	'1',	'3',	'',	'2020-02-17 12:11:29',	'2020-02-17 12:11:29'),
(6,	'0',	'1',	'2',	'',	'2020-02-17 12:11:52',	'2020-02-17 12:11:52'),
(7,	'1',	'1',	'1',	'',	'2020-02-29 05:26:15',	'2020-02-29 05:26:15'),
(8,	'0',	'1',	'1',	'',	'2020-02-29 05:30:53',	'2020-02-29 05:30:53'),
(9,	'0',	'1',	'1',	'',	'2020-02-29 05:34:55',	'2020-02-29 05:34:55'),
(10,	'0',	'0',	'1',	'',	'2020-02-29 05:35:28',	'2020-02-29 05:35:28'),
(11,	'0',	'0',	'1',	'',	'2020-02-29 05:36:00',	'2020-02-29 05:36:00'),
(12,	'0',	'0',	'1',	'',	'2020-02-29 05:36:03',	'2020-02-29 05:36:03'),
(13,	'0',	'0',	'1',	'',	'2020-02-29 05:36:16',	'2020-02-29 05:36:16'),
(14,	'0',	'0',	'1',	'',	'2020-02-29 05:36:24',	'2020-02-29 05:36:24'),
(15,	'0',	'0',	'1',	'',	'2020-02-29 06:53:39',	'2020-02-29 06:53:39'),
(16,	'0',	'1',	'1',	'',	'2020-02-29 11:04:17',	'2020-02-29 11:04:17'),
(17,	'0',	'0',	'1',	'http://localhost/dev_admin/uploads/images/main/15839092301.png',	'2020-03-11 09:33:01',	'2020-03-11 09:33:01');

DROP TABLE IF EXISTS `iq_post_image`;
CREATE TABLE `iq_post_image` (
  `post_image_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_meta` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(7,	4,	1,	'fasdf',	'sdafadsf',	'<p>sdfasdfasd</p>',	'sdfasdf',	'',	'',	''),
(8,	4,	2,	'sdfdsafsd',	'sdfasdsd',	'<p>sdfsdsad</p>',	'sdafsadf',	'',	'',	''),
(9,	5,	1,	'afdsfds',	'sdfsadsd',	'<p>sdafasdfsad</p>',	'sdfsda',	'',	'',	''),
(10,	5,	2,	'dsfsadfsd',	'sdfasd',	'<p>sdfasd</p>',	'sdfsdafasdf',	'',	'',	''),
(11,	6,	1,	'afasdf',	'sdfsadf',	'',	'sdfasdf',	'',	'',	''),
(12,	6,	2,	'fsdf',	'sdafsdfsdfsa',	'',	'sdfsad',	'',	'',	''),
(13,	7,	1,	'sfdsf',	'sadfasd',	'<p>sdafsadf</p>',	'sdafsda',	'sadfsad',	'sdafas',	'sadfsad'),
(14,	7,	2,	'dfdsafsadf',	'sadfdsafsad',	'<p>sdafdsa</p>',	'sdafsd',	'adsfadsf',	'sadfasd',	'sadfsad'),
(15,	8,	1,	'dsafasd',	'sadfsda',	'<p>sdafsadf</p>',	'sadfads',	'sdfsda',	'sdfdsa',	'asdfsad'),
(16,	8,	2,	'sdafsadf',	'dfsadf',	'<p>sdfsad</p>',	'dsafsad',	'sdafasd',	'sadfsadf',	'sadfsdafasd'),
(17,	9,	1,	'dsafasd',	'sadfsda',	'<p>sdafsadf</p>',	'sadfads',	'sdfsda',	'sdfdsa',	'asdfsad'),
(18,	9,	2,	'sdafsadf',	'dfsadf',	'<p>sdfsad</p>',	'dsafsad',	'sdafasd',	'sadfsadf',	'sadfsdafasd'),
(19,	10,	1,	'fsdfa',	'sdafasd',	'<p>sdafasd</p>',	'sdafas',	'',	'',	''),
(20,	10,	2,	'sdfasd',	'sadfasd',	'<p>sadfasd</p>',	'sdafasd',	'',	'',	''),
(21,	11,	1,	'fsdfa',	'sdafasd',	'<p>sdafasd</p>',	'sdafas',	'',	'',	''),
(22,	11,	2,	'sdfasd',	'sadfasd',	'<p>sadfasd</p>',	'sdafasd',	'',	'',	''),
(23,	12,	1,	'fsdfa',	'sdafasd',	'<p>sdafasd</p>',	'sdafas',	'',	'',	''),
(24,	12,	2,	'sdfasd',	'sadfasd',	'<p>sadfasd</p>',	'sdafasd',	'',	'',	''),
(25,	13,	1,	'fsdfa',	'sdafasd',	'<p>sdafasd</p>',	'sdafas',	'',	'',	''),
(26,	13,	2,	'sdfasd',	'sadfasd',	'<p>sadfasd</p>',	'sdafasd',	'',	'',	''),
(27,	14,	1,	'fsdfa',	'sdafasd',	'<p>sdafasd</p>',	'sdafas',	'',	'',	''),
(28,	14,	2,	'sdfasd',	'sadfasd',	'<p>sadfasd</p>',	'sdafasd',	'',	'',	''),
(29,	15,	1,	'fsdfa',	'sdafasd',	'<p>sdafasd</p>',	'sdafas',	'',	'',	''),
(30,	15,	2,	'sdfasd',	'sadfasd',	'<p>sadfasd</p>',	'sdafasd',	'',	'',	''),
(31,	16,	1,	'sdfssdafsda',	'sdfasd',	'<p>sdafsad</p>',	'sdafsdasdaf',	'',	'',	''),
(32,	16,	2,	'dfasdffasdfsadfsad',	'sdfasd',	'<p>sdafsad</p>',	'sdafsadf',	'',	'',	''),
(39,	17,	1,	'asdfadsf',	'sdafsadf',	'<p><img alt=\"\" src=\"http://localhost/dev_admin/uploads/images/medium/1583909231giphy.gif\" style=\"float:left; height:200px; width:400px\" />&nbsp;dsflsdj lsadkfjsda lfjsdsd fsadflsd sda</p>\r\n\r\n<p>sdf sadfsafasd asd adsf&nbsp; sadf asdfdsfad</p>\r\n\r\n<p>sd fadsfsda fasdfsda fsad fdsa fdsa f</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>sda fdsfsadfasd dsfsdfsdaf</p>\r\n\r\n<p>sda fsdfdsa sdafdsa fsdf sda fdsa fdsafsdaf&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>sd fdsafsd dsa sdaf dsa fsda sda sad fsad daasd sad sad dsa sad sda dsa ads sad asd sad sad sad&nbsp;</p>\r\n</blockquote>\r\n\r\n<blockquote>\r\n<p>sd af sad sd ds ds sd dsa ds ds dsa sad sd dsa sadsda sd sda sda sda dsa dsa dsa dsa sda sda&nbsp;</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li>&nbsp;sdafads ads fds f</li>\r\n	<li>&nbsp;dsafads ads&nbsp;</li>\r\n	<li>sd fdsa fads fdsa&nbsp;</li>\r\n	<li>sdaf sad fasd&nbsp;</li>\r\n	<li>sdfasd fdsa sd&nbsp;</li>\r\n	<li><a href=\"https://www.cnet.com/news/whisper-app-exposed-data-that-ties-millions-of-secrets-to-users-personal-info-report-says/\" target=\"_blank\"><img alt=\"\" src=\"http://localhost/dev_admin/uploads/images/main/1583751257123.png\" style=\"height:485px; width:800px\" /></a></li>\r\n</ul>',	'dsafsdfasdfa',	'',	'',	''),
(40,	17,	2,	'sdfadsff',	'asdfdsafdsafsadfsd',	'<p><img alt=\"\" src=\"http://localhost/dev_admin/uploads/images/medium/1583909231giphy.gif\" style=\"float:left; height:200px; width:400px\" />&nbsp;dsflsdj lsadkfjsda lfjsdsd fsadflsd sda</p>\r\n\r\n<p>sdf sadfsafasd asd adsf&nbsp; sadf asdfdsfad</p>\r\n\r\n<p>sd fadsfsda fasdfsda fsad fdsa fdsa f</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>sda fdsfsadfasd dsfsdfsdaf</p>\r\n\r\n<p>sda fsdfdsa sdafdsa fsdf sda fdsa fdsafsdaf&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>sd fdsafsd dsa sdaf dsa fsda sda sad fsad daasd sad sad dsa sad sda dsa ads sad asd sad sad sad&nbsp;</p>\r\n</blockquote>\r\n\r\n<blockquote>\r\n<p>sd af sad sd ds ds sd dsa ds ds dsa sad sd dsa sadsda sd sda sda sda dsa dsa dsa dsa sda sda&nbsp;</p>\r\n</blockquote>\r\n\r\n<ul>\r\n	<li>&nbsp;sdafads ads fds f</li>\r\n	<li>&nbsp;dsafads ads&nbsp;</li>\r\n	<li>sd fdsa fads fdsa&nbsp;</li>\r\n	<li>sdaf sad fasd&nbsp;</li>\r\n	<li>sdfasd fdsa sd&nbsp;</li>\r\n</ul>',	'sdafsadfasdfsadfsdaf',	'',	'',	'');

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


-- 2020-03-11 10:41:01
