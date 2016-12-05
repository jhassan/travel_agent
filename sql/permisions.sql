/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.16-MariaDB : Database - travel_agent
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`travel_agent` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `travel_agent`;

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`parent_id`,`name`,`created_at`,`updated_at`) values (1,0,'Manage Profile','2016-12-05 18:52:39','2016-12-05 18:52:39'),(2,1,'Create Profile','2016-12-05 18:52:39','2016-12-05 18:52:39'),(3,1,'Edit Profile','2016-12-05 18:52:39','2016-12-05 18:52:39'),(4,1,'Delete Profile','2016-12-05 18:52:39','2016-12-05 18:52:39'),(5,1,'View Profile','2016-12-05 18:52:39','2016-12-05 18:52:39'),(6,0,'Manage Vendor/Client','2016-12-05 18:52:39','2016-12-05 18:52:39'),(7,6,'Create Vendor/Client','2016-12-05 18:52:51','2016-12-05 18:52:51'),(8,6,'Edit Vendor/Client','2016-12-05 18:52:58','2016-12-05 18:52:58'),(9,6,'Delete Vendor/Client','2016-12-05 18:53:06','2016-12-05 18:53:06'),(10,6,'View Vendor/Client','2016-12-05 18:53:13','2016-12-05 18:53:13'),(11,0,'Manage Sale Vouchers','2016-12-05 18:53:22','2016-12-05 18:53:22'),(12,11,'Create Sale Vouchers','2016-12-05 18:53:30','2016-12-05 18:53:30'),(13,11,'List Sale Vouchers','2016-12-05 18:53:37','2016-12-05 18:53:37'),(14,0,'Manage Refund Vouchers','2016-12-05 18:54:34','2016-12-05 18:54:34'),(15,14,'Create Refund Vouchers','2016-12-05 18:54:44','2016-12-05 18:54:44'),(16,14,'List Refund Vouchers','2016-12-05 18:54:53','2016-12-05 18:54:53'),(17,0,'Manage Payment Vouchers','2016-12-05 18:55:36','2016-12-05 18:55:36'),(18,17,'Receive Payment','2016-12-05 18:55:48','2016-12-05 18:55:48'),(19,17,'Payment Voucher','2016-12-05 18:55:56','2016-12-05 18:55:56'),(20,17,'Journal Voucher','2016-12-05 18:56:04','2016-12-05 18:56:04'),(21,0,'Manage Users','2016-12-05 18:57:41','2016-12-05 18:57:41'),(22,21,'Create User','2016-12-05 18:57:51','2016-12-05 18:57:51'),(23,21,'Edit User','2016-12-05 18:58:06','2016-12-05 18:58:06'),(24,21,'View User','2016-12-05 18:58:15','2016-12-05 18:58:15'),(25,21,'Delete User','2016-12-05 18:58:24','2016-12-05 18:58:24'),(26,0,'Manage Permission','2016-12-05 18:58:48','2016-12-05 18:58:48'),(27,26,'Create Permission','2016-12-05 18:59:03','2016-12-05 18:59:03'),(28,26,'Edit Permission','2016-12-05 18:59:15','2016-12-05 18:59:15'),(29,26,'View Permission','2016-12-05 18:59:23','2016-12-05 18:59:23'),(30,26,'Delete Permission','2016-12-05 18:59:33','2016-12-05 18:59:33');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
