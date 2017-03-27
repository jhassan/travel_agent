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

/*Table structure for table `coa` */

DROP TABLE IF EXISTS `coa`;

CREATE TABLE `coa` (
  `coa_id` int(11) NOT NULL AUTO_INCREMENT,
  `coa_code` int(11) NOT NULL,
  `coa_account` varchar(128) NOT NULL,
  `party_id` int(11) NOT NULL DEFAULT '0',
  `coa_credit` int(11) NOT NULL DEFAULT '0',
  `coa_debit` int(11) NOT NULL DEFAULT '0',
  `account_type` varchar(2) DEFAULT NULL,
  `coa_type` varchar(2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`coa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `coa` */

insert  into `coa`(`coa_id`,`coa_code`,`coa_account`,`party_id`,`coa_credit`,`coa_debit`,`account_type`,`coa_type`,`updated_at`) values (1,100000,'Bank/Card',0,0,0,NULL,NULL,'0000-00-00 00:00:00'),(2,200000,'Clients/Receiveable',0,0,0,NULL,NULL,'0000-00-00 00:00:00'),(3,300000,'Vender/Payable',0,0,0,NULL,NULL,'0000-00-00 00:00:00'),(4,400000,'Expence',0,0,0,NULL,NULL,'0000-00-00 00:00:00'),(5,500000,'Profit and loss',0,0,0,NULL,NULL,'0000-00-00 00:00:00'),(6,200001,'Client Company',1,0,0,NULL,NULL,'0000-00-00 00:00:00'),(7,100001,'Bank Party',2,0,0,NULL,NULL,'0000-00-00 00:00:00');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_10_12_151513_create_parties_table',1),(4,'2016_10_12_151652_create_products_table',1),(5,'2016_10_12_151706_create_brands_table',1),(6,'2016_10_12_151729_create_sizes_table',1),(7,'2016_10_12_152020_create_purchase_stock_master_table',1),(8,'2016_10_12_152043_create_purchase_stock_detail_table',1),(9,'2016_10_12_152122_create_sale_stock_master_table',1),(10,'2016_10_12_152138_create_sale_stock_detail_table',1),(11,'2016_10_12_152251_create_products_stock_table',1),(12,'2016_10_12_152439_create_categories_table',1),(13,'2016_10_12_172352_add_more_fields_to_users_table',1),(14,'2016_10_14_192023_add_more_fields_to_purchase_stock_table',1),(15,'2016_10_25_141942_create_items_prices_table',2),(16,'2016_11_02_171405_create_purchase_voucher_master_table',3),(17,'2016_11_02_171450_create_purchase_voucher_detail_table',3),(18,'2016_11_02_171508_create_sale_voucher_detail_table',3),(19,'2016_11_02_171528_create_sale_voucher_master_table',3),(20,'2016_11_19_182616_create_sale_vouchers_table',4),(21,'2016_11_19_185122_create_sale_vouchers_detail_table',5),(22,'2016_11_18_214417_add_fields_to_parties_table',6),(23,'2016_11_18_222405_create_profiles_table',6),(24,'2016_11_22_221325_add_ptcl_to_profiles_table',7),(25,'2016_11_28_165046_create__payment_vouchers_table',8),(26,'2016_11_30_211953_add_posting_date_field_to_sale_vouchers_table',8),(27,'2016_11_30_212831_add_voucher_type_field_to_sale_vouchers_table',9),(28,'2016_11_30_001508_create_permissions_table',10),(29,'2016_11_30_001548_add_votes_to_users_table',10),(30,'2016_12_05_231911_add_total_payment_voucher_to_sale_vouchers_table',11);

/*Table structure for table `parties` */

DROP TABLE IF EXISTS `parties`;

CREATE TABLE `parties` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` int(11) NOT NULL,
  `ptcl_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `parties` */

insert  into `parties`(`id`,`type_id`,`name`,`address`,`phone_no`,`city`,`created_at`,`updated_at`,`code`,`ptcl_no`,`email`,`account_id`) values (1,0,'Client Company','Multan','0546-5465465','Multan','2016-12-05 23:01:30','2016-12-05 23:01:30',0,'065-4654654','client@gmail.com',200000),(2,0,'Bank Party','Multan','0687-9879879','Multan','2016-12-05 23:02:23','2016-12-05 23:02:23',0,'098-7987987','bank@gmail.com',100000);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payment_vouchers` */

DROP TABLE IF EXISTS `payment_vouchers`;

CREATE TABLE `payment_vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discription` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ammount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `debit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `payment_vouchers` */

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

/*Table structure for table `profiles` */

DROP TABLE IF EXISTS `profiles`;

CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slogon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cell_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ptcl_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profiles` */

insert  into `profiles`(`id`,`name`,`slogon`,`address`,`email`,`cell_no`,`website`,`image`,`created_at`,`updated_at`,`ptcl_no`) values (1,'Jawad','test','Multan','jawadjee0519@gmail.com','0546-5464654','google.com','1479999996.png','2016-11-22 18:51:54','2016-11-24 20:06:36','054-6546546');

/*Table structure for table `sale_vouchers` */

DROP TABLE IF EXISTS `sale_vouchers`;

CREATE TABLE `sale_vouchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flight_way` int(11) NOT NULL DEFAULT '0',
  `posting_date` date NOT NULL,
  `voucher_type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `ven_percent_rec_comm` int(11) NOT NULL DEFAULT '0',
  `ven_give_psf_comm` int(11) NOT NULL DEFAULT '0',
  `ven_wht_percent_comm` int(11) NOT NULL DEFAULT '0',
  `client_percent_rec_comm` int(11) NOT NULL DEFAULT '0',
  `client_receive_psf_comm` int(11) NOT NULL DEFAULT '0',
  `client_wht_percent_comm` int(11) NOT NULL DEFAULT '0',
  `vendor_id` int(11) NOT NULL DEFAULT '0',
  `client_id` int(11) NOT NULL DEFAULT '0',
  `pax_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pnr` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ticket_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sector` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `basic_fare` double(8,2) NOT NULL DEFAULT '0.00',
  `tax` double(8,2) NOT NULL DEFAULT '0.00',
  `actual_fare_total` double(8,2) NOT NULL DEFAULT '0.00',
  `vendor_rec_comm_total` double(8,2) NOT NULL DEFAULT '0.00',
  `ven_give_psf_total` double(8,2) NOT NULL DEFAULT '0.00',
  `ven_wht_total` double(8,2) NOT NULL DEFAULT '0.00',
  `ven_main_total` double(8,2) NOT NULL DEFAULT '0.00',
  `client_rec_comm_total` double(8,2) NOT NULL DEFAULT '0.00',
  `client_receive_psf_total` double(8,2) NOT NULL DEFAULT '0.00',
  `client_wht_total` double(8,2) NOT NULL DEFAULT '0.00',
  `client_main_total` double(8,2) NOT NULL DEFAULT '0.00',
  `profit_loss_total` double(8,2) NOT NULL DEFAULT '0.00',
  `vendor_payable_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `client_receivable_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `depart_date` date NOT NULL,
  `return_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_voucher_amount` double(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sale_vouchers` */

insert  into `sale_vouchers`(`id`,`flight_way`,`posting_date`,`voucher_type`,`user_id`,`ven_percent_rec_comm`,`ven_give_psf_comm`,`ven_wht_percent_comm`,`client_percent_rec_comm`,`client_receive_psf_comm`,`client_wht_percent_comm`,`vendor_id`,`client_id`,`pax_name`,`pnr`,`ticket_no`,`sector`,`basic_fare`,`tax`,`actual_fare_total`,`vendor_rec_comm_total`,`ven_give_psf_total`,`ven_wht_total`,`ven_main_total`,`client_rec_comm_total`,`client_receive_psf_total`,`client_wht_total`,`client_main_total`,`profit_loss_total`,`vendor_payable_amount`,`client_receivable_amount`,`depart_date`,`return_date`,`created_at`,`updated_at`,`total_voucher_amount`) values (1,2,'0000-00-00','RV',2,5,0,10,5,0,20,1,2,'Jawad','SDFSDFSD','SDF98789','Test',50000.00,2500.00,50000.00,2500.00,0.00,250.00,2750.00,2500.00,0.00,500.00,3000.00,250.00,55250.00,55500.00,'2016-11-26','2016-12-29','2016-11-26 12:40:21','2016-11-26 12:40:21',0.00),(2,0,'2016-11-30','SV',2,0,0,0,0,0,0,0,0,'adsf','dfadsf','adsf','',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'2016-11-30','0000-00-00','2016-11-30 21:24:37','2016-11-30 21:24:37',0.00),(3,0,'2016-11-30','',2,0,0,0,0,0,0,0,0,'adsf','dfadsf','adsf','',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'2016-11-30','0000-00-00','2016-11-30 22:43:35','2016-11-30 22:43:35',0.00),(4,0,'2016-11-30','',2,0,0,0,0,0,0,0,0,'adsf','dfadsf','adsf','',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'2016-11-30','0000-00-00','2016-11-30 22:55:17','2016-11-30 22:55:17',0.00),(6,0,'2016-12-05','',0,0,0,0,0,0,0,0,0,'','','','',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'0000-00-00','0000-00-00','2016-12-05 23:31:44','2016-12-05 23:31:44',500000.00),(7,0,'2016-12-05','',0,0,0,0,0,0,0,0,0,'','','','',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'0000-00-00','0000-00-00','2016-12-05 23:34:05','2016-12-05 23:34:05',250000.00),(8,0,'2016-12-05','PV',0,0,0,0,0,0,0,0,0,'','','','',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'0000-00-00','0000-00-00','2016-12-05 23:35:22','2016-12-05 23:35:22',45454.00);

/*Table structure for table `sale_vouchers_detail` */

DROP TABLE IF EXISTS `sale_vouchers_detail`;

CREATE TABLE `sale_vouchers_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_voucher_master_id` int(11) NOT NULL DEFAULT '0',
  `coa_code` int(11) NOT NULL DEFAULT '0',
  `voucher_descriptions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `coa_credit` double(8,2) NOT NULL DEFAULT '0.00',
  `coa_debit` double(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `sale_vouchers_detail` */

insert  into `sale_vouchers_detail`(`id`,`sale_voucher_master_id`,`coa_code`,`voucher_descriptions`,`coa_credit`,`coa_debit`,`created_at`,`updated_at`) values (1,1,200000,'26-11-2016 Sale Voucher',0.00,55250.00,NULL,NULL),(2,1,100000,'26-11-2016 Sale Voucher',55500.00,0.00,NULL,NULL),(3,2,100001,'30-11-2016 Sale Voucher',0.00,0.00,NULL,NULL),(4,2,100001,'30-11-2016 Sale Voucher',0.00,0.00,NULL,NULL),(5,3,100001,'30-11-2016 Sale Voucher',0.00,0.00,NULL,NULL),(6,3,100001,'30-11-2016 Sale Voucher',0.00,0.00,NULL,NULL),(7,4,100001,'30-11-2016 Sale Voucher',0.00,0.00,NULL,NULL),(8,4,100001,'30-11-2016 Sale Voucher',0.00,0.00,NULL,NULL),(11,6,100001,'test',0.00,500000.00,NULL,NULL),(12,6,200001,'test',500000.00,0.00,NULL,NULL),(13,7,100001,'test',0.00,250000.00,NULL,NULL),(14,7,200001,'test',250000.00,0.00,NULL,NULL),(15,8,100001,'test',0.00,45454.00,NULL,NULL),(16,8,200001,'test',45454.00,0.00,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_phone_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0',
  `user_permission` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`,`user_phone_no`,`user_type`,`user_permission`,`active`) values (1,'Jawad','jawadjee0519@gmail.com','$2y$10$vNy83ItH2oDaP.3yIysTBuZKLk9yhA4pgtmabyndylfbWaP9pmeQO','Guc98Gdj3NwfinGbDXtaMOH55EDa1raOzgv1qUNoHivfH83rRLC20xxI0FXn','2016-10-24 10:05:03','2017-01-07 16:42:20','',0,'2,3,4,5,7,8,9,10,12,13,15,16,18,19,20,22,23,24,25,27,28,29,30',0),(2,'Umair','umair@gmail.com','$2y$10$mFrO3YxIscErRn4ZxC97pu0UpBfIGDP4AJn5OTFKK24tNgbSrIem2','3eTJkYN3OI45qannjmmf3VRyDgYlhzKXkvDjw55umeEJtunUxEPXOQ4jxTBO','2016-11-26 12:34:11','2016-12-07 15:23:34',NULL,0,'2,7,8,13,15,19,22,28',0),(4,'Test','test@gmail.com','$2y$10$FM0g5Ud05rC5FSGOF4jYauo/7QhVSiTxH833PZ0QYAJNgrKCca6cu',NULL,'2016-12-05 20:03:14','2016-12-05 20:03:14','0546-5465465',1,'2,7,8,13,15,19,22,28',0),(5,'admin','admin@gmail.com','$2y$10$444Cgq9qMpRVS2wb4eeqhuaFUQwHEld81NgapgIlseR3jYP39u9LO','ksBidsXjlQD2mUHYCwkOCtdc341XVmMWB7SKoUu9xSVE7SbcukG9kFK881hx','2016-12-09 19:35:32','2017-01-07 20:19:02','0546-5465465',0,'2,3,4,5,7,8,9,10,12,13,15,16,18,19,20,22,23,24,25,27,28,29,30',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
