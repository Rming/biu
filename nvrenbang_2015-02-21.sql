# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.34-0ubuntu0.12.04.1)
# Database: nvrenbang
# Generation Time: 2015-02-21 08:38:26 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attachment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attachment`;

CREATE TABLE `attachment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` smallint(6) unsigned DEFAULT NULL,
  `url` varchar(512) DEFAULT NULL,
  `scale` float unsigned DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table attachment_tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attachment_tag`;

CREATE TABLE `attachment_tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attachment_id` bigint(20) unsigned DEFAULT NULL,
  `tag_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table biu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `biu`;

CREATE TABLE `biu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `creator_id` bigint(20) unsigned DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table biu_attachment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `biu_attachment`;

CREATE TABLE `biu_attachment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `biu_id` bigint(20) unsigned DEFAULT NULL,
  `attachment_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `biu_id` bigint(20) unsigned DEFAULT NULL,
  `content` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table like
# ------------------------------------------------------------

DROP TABLE IF EXISTS `like`;

CREATE TABLE `like` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `biu_id` bigint(20) unsigned DEFAULT NULL,
  `attach_id` bigint(20) unsigned DEFAULT NULL,
  `creator_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(10) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `nickname` varchar(256) CHARACTER SET utf8mb4 DEFAULT NULL,
  `description` varchar(512) CHARACTER SET utf8mb4 DEFAULT NULL,
  `gender` int(11) unsigned DEFAULT NULL,
  `birthday` bigint(20) unsigned DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `avatar` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `background` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lon` double DEFAULT NULL,
  `address` varchar(512) CHARACTER SET utf8 DEFAULT NULL,
  `from_where` int(11) DEFAULT NULL,
  `third_nick` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `token` char(40) CHARACTER SET utf8 DEFAULT NULL,
  `token_at` bigint(20) unsigned DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL DEFAULT '',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `resource_id` bigint(20) unsigned DEFAULT NULL,
  `action_id` bigint(20) unsigned DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `href` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table request_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `request_log`;

CREATE TABLE `request_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `request` varchar(1024) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table tag
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag_unique_id` bigint(20) unsigned DEFAULT NULL,
  `position_x` int(11) unsigned DEFAULT NULL,
  `position_y` int(11) unsigned DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) unsigned DEFAULT '30',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table tag_unique
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tag_unique`;

CREATE TABLE `tag_unique` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `background` varchar(512) DEFAULT NULL,
  `slug` varchar(512) DEFAULT NULL,
  `created_at` bigint(20) unsigned DEFAULT NULL,
  `status` int(11) unsigned DEFAULT '30',
  `is_topic` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
