-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for viva
CREATE DATABASE IF NOT EXISTS `viva` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `viva`;

-- Dumping structure for table viva.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`email`, `fname`, `lname`, `code`) VALUES
	('iharathathsara0@gmail.com', 'Ihara', 'Thathsara', '63c2461a42656');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table viva.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_brand_category1_idx` (`category_id`),
  CONSTRAINT `fk_brand_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.brand: ~0 rows (approximately)
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;

-- Dumping structure for table viva.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_product1_idx` (`product_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.cart: ~7 rows (approximately)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` (`id`, `qty`, `product_id`, `user_email`) VALUES
	(35, 1, 48, 'iharathathsara0@gmail.com'),
	(40, 1, 48, 'hasitha@gmail.com'),
	(41, 1, 46, 'hasitha@gmail.com'),
	(42, 1, 47, 'hasitha@gmail.com'),
	(43, 1, 50, 'hasitha@gmail.com'),
	(46, 1, 48, 'kisal@gmail.com'),
	(50, 2, 54, 'kisal@gmail.com');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table viva.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.category: ~5 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Cake'),
	(2, 'Juice'),
	(3, 'Ice Cream'),
	(4, 'Pudin'),
	(10, 'Chocolate');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table viva.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_district1_idx` (`district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.city: ~2 rows (approximately)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`id`, `name`, `district_id`) VALUES
	(4, 'Galle', 25),
	(8, 'veyangoda', 8);
/*!40000 ALTER TABLE `city` ENABLE KEYS */;

-- Dumping structure for table viva.district
CREATE TABLE IF NOT EXISTS `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_province1_idx` (`province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.district: ~25 rows (approximately)
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` (`id`, `name`, `province_id`) VALUES
	(1, 'Jaffna', 1),
	(2, 'Kilinochchi', 1),
	(3, 'Mannar', 1),
	(4, 'Mullaitivu', 1),
	(5, 'Vavuniya', 1),
	(6, 'Puttalam', 2),
	(7, 'Kurunrgala', 2),
	(8, 'Gampaha', 3),
	(9, 'Colombo', 3),
	(10, 'Kaluthara', 3),
	(11, 'Anuradhapura', 4),
	(12, 'Polonnaruwa', 4),
	(13, 'Matale', 5),
	(14, 'Kandy', 5),
	(15, 'Nuwara Eliya', 5),
	(16, 'Kagalle', 6),
	(17, 'Rathnapura', 6),
	(18, 'Trincomalee', 7),
	(19, 'Batticaloa', 7),
	(20, 'Ampara', 7),
	(21, 'Badulla', 8),
	(22, 'Monaragala', 8),
	(23, 'Hambanthota', 9),
	(24, 'Matara', 9),
	(25, 'Galle', 9);
/*!40000 ALTER TABLE `district` ENABLE KEYS */;

-- Dumping structure for table viva.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `feedback` text,
  `date` datetime DEFAULT NULL,
  `type_id` int NOT NULL,
  `invoice_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feedback_type1_idx` (`type_id`),
  KEY `FK_feedback_invoice` (`invoice_id`),
  CONSTRAINT `FK_feedback_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`),
  CONSTRAINT `fk_feedback_type1` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.feedback: ~0 rows (approximately)
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`id`, `feedback`, `date`, `type_id`, `invoice_id`) VALUES
	(21, 'good', '2023-01-12 18:15:38', 1, 17);
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;

-- Dumping structure for table viva.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.gender: ~2 rows (approximately)
/*!40000 ALTER TABLE `gender` DISABLE KEYS */;
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');
/*!40000 ALTER TABLE `gender` ENABLE KEYS */;

-- Dumping structure for table viva.images
CREATE TABLE IF NOT EXISTS `images` (
  `code` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_images_product1_idx` (`product_id`),
  CONSTRAINT `fk_images_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.images: ~28 rows (approximately)
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` (`code`, `product_id`) VALUES
	('resourses//product_img//63b5782785597.jpeg', 46),
	('resourses//product_img//63b5782785f44.jpeg', 46),
	('resourses//product_img//63b578278693c.jpeg', 46),
	('resourses//product_img//63b5789e76b83.jpeg', 47),
	('resourses//product_img//63b5789e773fc.jpeg', 47),
	('resourses//product_img//63b5789e77a94.jpeg', 47),
	('resourses//product_img//63b579048154d.jpeg', 48),
	('resourses//product_img//63b5790481f03.jpeg', 48),
	('resourses//product_img//63b57904828e5.jpeg', 48),
	('resourses//product_img//63b579be1e636.jpeg', 49),
	('resourses//product_img//63b579be1efef.jpeg', 49),
	('resourses//product_img//63b579be1fa0d.jpeg', 49),
	('resourses//product_img//63b57a340779e.jpeg', 50),
	('resourses//product_img//63b57a34081fd.jpeg', 50),
	('resourses//product_img//63b57a3408bc3.jpeg', 50),
	('resourses//product_img//63b57a9050305.jpeg', 51),
	('resourses//product_img//63b57a9050dd1.jpeg', 51),
	('resourses//product_img//63b57a9051966.jpeg', 51),
	('resourses//product_img//63b57d7cb1610.jpeg', 53),
	('resourses//product_img//63b57d7cb2014.jpeg', 53),
	('resourses//product_img//63b57d7cb29b7.jpeg', 53),
	('resourses//product_img//63b57de3a7b39.jpeg', 54),
	('resourses//product_img//63b57de3a86b0.jpeg', 54),
	('resourses//product_img//63b57de3a916c.jpeg', 54),
	('resourses//product_img//63c19d9b2c474.jpeg', 56),
	('resourses//product_img//63c19d9b2d24a.jpeg', 56),
	('resourses//product_img//63c19d9b2d96c.jpeg', 56),
	('resourses//product_img//63c19e12ebfaa.jpeg', 57),
	('resourses//product_img//63c19e12ec865.jpeg', 57),
	('resourses//product_img//63c19e12ed30c.jpeg', 57);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;

-- Dumping structure for table viva.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.invoice: ~9 rows (approximately)
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
INSERT INTO `invoice` (`id`, `order_id`, `date`, `total`, `qty`, `status`, `product_id`, `user_email`) VALUES
	(14, '63b6e678dd6f5', '2023-01-05 20:32:42', 3600, 1, 4, 48, 'iharathathsara0@gmail.com'),
	(15, '63b6e6fa1609e', '2023-01-05 20:34:53', 1400, 1, 3, 50, 'iharathathsara0@gmail.com'),
	(16, '63b9a73529f34', '2023-01-07 22:39:35', 3600, 1, 2, 48, 'hasitha@gmail.com'),
	(17, '63b9aa1dba5d6', '2023-01-07 22:52:11', 1450, 1, 4, 49, 'hasitha@gmail.com'),
	(18, '63beef7ea7534', '2023-01-11 22:49:53', 4600, 1, 0, 46, 'hasitha@gmail.com'),
	(19, '63beef7ea7534', '2023-01-11 22:49:53', 4600, 1, 1, 47, 'hasitha@gmail.com'),
	(20, '63beef7ea7534', '2023-01-11 22:49:53', 3600, 1, 1, 48, 'hasitha@gmail.com'),
	(21, '63c03b3958ead', '2023-01-12 22:24:58', 3600, 1, 0, 48, 'kisal@gmail.com'),
	(22, '63c03b3958ead', '2023-01-12 22:24:58', 1700, 2, 0, 54, 'kisal@gmail.com'),
	(23, '63c1b8467dbbb', '2023-01-14 01:30:43', 2200, 1, 0, 57, 'hasitha@gmail.com');
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;

-- Dumping structure for table viva.model
CREATE TABLE IF NOT EXISTS `model` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.model: ~8 rows (approximately)
/*!40000 ALTER TABLE `model` DISABLE KEYS */;
INSERT INTO `model` (`id`, `name`) VALUES
	(29, 'Wedding Cake'),
	(30, 'Cup Cake'),
	(31, 'Party Cake'),
	(32, 'Chocolate Juice'),
	(33, 'Vanila Juice'),
	(34, 'Fruit Juice'),
	(35, 'Ice Bar'),
	(36, 'Ice Cup');
/*!40000 ALTER TABLE `model` ENABLE KEYS */;

-- Dumping structure for table viva.model_has_category
CREATE TABLE IF NOT EXISTS `model_has_category` (
  `category_id` int NOT NULL,
  `model_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_brand_has_model_model1_idx` (`model_id`),
  KEY `fk_brand_has_model_brand1_idx` (`category_id`) USING BTREE,
  CONSTRAINT `fk_brand_has_model_model1` FOREIGN KEY (`model_id`) REFERENCES `model` (`id`),
  CONSTRAINT `FK_model_has_category_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.model_has_category: ~7 rows (approximately)
/*!40000 ALTER TABLE `model_has_category` DISABLE KEYS */;
INSERT INTO `model_has_category` (`category_id`, `model_id`, `id`) VALUES
	(1, 30, 34),
	(1, 29, 35),
	(1, 31, 36),
	(2, 32, 37),
	(2, 34, 38),
	(3, 35, 39),
	(3, 36, 40);
/*!40000 ALTER TABLE `model_has_category` ENABLE KEYS */;

-- Dumping structure for table viva.msg
CREATE TABLE IF NOT EXISTS `msg` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `msg_img` varchar(100) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `to` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__users` (`from`),
  KEY `FK__users_2` (`to`),
  CONSTRAINT `FK__users` FOREIGN KEY (`from`) REFERENCES `users` (`email`),
  CONSTRAINT `FK__users_2` FOREIGN KEY (`to`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.msg: ~18 rows (approximately)
/*!40000 ALTER TABLE `msg` DISABLE KEYS */;
INSERT INTO `msg` (`id`, `content`, `msg_img`, `date_time`, `status`, `from`, `to`) VALUES
	(1, 'hi', '0', '2023-01-06 19:22:59', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(2, 'ok', '0', '2023-01-06 19:23:29', 1, 'iharathathsara0@gmail.com', 'hasitha@gmail.com'),
	(3, 'i m hasitha', '0', '2023-01-06 20:34:29', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(4, 'i want new cake', '0', '2023-01-06 20:35:20', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(5, '', 'resourses//chat_img//63b83e90e8e81.jpeg', '2023-01-06 21:00:24', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(6, 'this design is good', 'resourses//chat_img//63b84383f1b70.jpeg', '2023-01-06 21:21:31', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(7, '', '0', '2023-01-06 22:22:44', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(8, 'im admin', '0', '2023-01-06 23:20:31', 1, 'iharathathsara0@gmail.com', 'hasitha@gmail.com'),
	(9, 'like this', 'resourses//chat_img//63b85fef91dac.jpeg', '2023-01-06 23:22:47', 1, 'iharathathsara0@gmail.com', 'hasitha@gmail.com'),
	(10, 'amazing', '0', '2023-01-06 23:23:33', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(11, 'hi', '0', '2023-01-06 23:24:48', 1, 'kisal@gmail.com', 'iharathathsara0@gmail.com'),
	(12, 'how can i help u', '0', '2023-01-06 23:59:03', 0, 'iharathathsara0@gmail.com', 'kisal@gmail.com'),
	(13, 'i wanna birthday cake', '0', '2023-01-06 23:59:46', 1, 'kisal@gmail.com', 'iharathathsara0@gmail.com'),
	(14, 'hi', '0', '2023-01-07 00:27:46', 1, 'kisal@gmail.com', 'iharathathsara0@gmail.com'),
	(15, 'ok', '0', '2023-01-07 00:30:46', 0, 'iharathathsara0@gmail.com', 'kisal@gmail.com'),
	(16, 'i like it', '0', '2023-01-09 16:23:15', 1, 'hasitha@gmail.com', 'iharathathsara0@gmail.com'),
	(17, 'hai kisal', NULL, '2023-01-09 23:25:45', 0, 'iharathathsara0@gmail.com', 'kisal@gmail.com'),
	(18, 'hi kisal', NULL, '2023-01-14 11:59:03', 0, 'iharathathsara0@gmail.com', 'kisal@gmail.com');
/*!40000 ALTER TABLE `msg` ENABLE KEYS */;

-- Dumping structure for table viva.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `model_has_category_id` int NOT NULL,
  `price` double DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `status_id` int NOT NULL,
  `users_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_status1_idx` (`status_id`),
  KEY `fk_product_catogary1_idx` (`category_id`) USING BTREE,
  KEY `fk_product_brand_has_model1_idx` (`model_has_category_id`) USING BTREE,
  KEY `fk_product_user1_idx` (`users_email`) USING BTREE,
  CONSTRAINT `fk_product_brand_has_model1` FOREIGN KEY (`model_has_category_id`) REFERENCES `model_has_category` (`id`),
  CONSTRAINT `fk_product_catogary1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.product: ~10 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `category_id`, `model_has_category_id`, `price`, `description`, `title`, `status_id`, `users_email`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`) VALUES
	(46, 1, 35, 4000, 'One Tier Veil Wedding Cake. new design .  it will be delivered in 48 hours. Eat within 10 days.', 'One Tier Veil Wedding Cake', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:29:19', 400, 600),
	(47, 1, 36, 4000, 'chocolate coconut layer cake. special for birthday party.  it will be delivered in 48 hours. Eat within 10 days.', 'chocolate coconut layer cake ', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:31:18', 400, 600),
	(48, 1, 34, 3000, 'Chocolate Heaven Cupcake Gift Tin. 6 cup cakes in 1 gift tin.  it will be delivered in 24 hours. It can be stored in the refrigerator. Eat within 5 days.', 'Chocolate Heaven Cupcake Gift Tin', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:33:00', 400, 600),
	(49, 2, 37, 850, 'chocolate Milk Shake. kids favor.  it will be delivered in 12 hours. It can be stored in the refrigerator. Drink within one days.', 'chocolate Milk Shake', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:36:06', 400, 600),
	(50, 2, 38, 800, 'Avocado Juice. fresh fruit. it will be delivered in 12 hours. It can be stored in the refrigerator. Drink within one days.', 'Avocado Juice', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:38:04', 400, 600),
	(51, 2, 38, 800, 'watermelon juice. fresh juice. it will be delivered in 12 hours. It can be stored in the refrigerator. Drink within one days.', 'Watermelon Juice', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:39:36', 400, 600),
	(53, 3, 40, 600, 'Chocolate Ice Cream Cup. it will be delivered in one day. It can be stored in the refrigerator. Eat within 5 days.', 'Chocolate Ice Cream Cup', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:52:04', 300, 500),
	(54, 3, 40, 600, 'vanila ice cream cup.  it will be delivered in one day. It can be stored in the refrigerator. Eat within 5 days.', 'vanila ice cream cup', 1, 'iharathathsara0@gmail.com', '2023-01-04 18:53:47', 300, 500),
	(56, 1, 36, 4000, 'Caramel Macadamia Nut Carousel Cake. cake. special for birthday party. it will be delivered in 48 hours. Eat within 10 days.', 'Caramel Macadamia Nut Carousel Cake', 1, 'iharathathsara0@gmail.com', '2023-01-13 23:36:19', 500, 800),
	(57, 1, 34, 1500, 'Animal Theme Cupcakes. 6 cup cakes in 1 gift tin. it will be delivered in 24 hours. It can be stored in the refrigerator. Eat within 5 days.', 'Animal Theme Cupcakes', 1, 'iharathathsara0@gmail.com', '2023-01-13 23:38:18', 400, 700);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table viva.profile_image
CREATE TABLE IF NOT EXISTS `profile_image` (
  `path` varchar(150) NOT NULL DEFAULT '',
  `users_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_image_user1_idx` (`users_email`) USING BTREE,
  CONSTRAINT `fk_profile_image_user1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.profile_image: ~3 rows (approximately)
/*!40000 ALTER TABLE `profile_image` DISABLE KEYS */;
INSERT INTO `profile_image` (`path`, `users_email`) VALUES
	('resourses//profile_img//63b94751dfdd2.png', 'hasitha@gmail.com'),
	('resourses//profile_img//63b5ac16510c7.svg', 'iharathathsara0@gmail.com'),
	('resourses//profile_img//63b947b32ad23.png', 'kisal@gmail.com');
/*!40000 ALTER TABLE `profile_image` ENABLE KEYS */;

-- Dumping structure for table viva.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.province: ~9 rows (approximately)
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` (`id`, `name`) VALUES
	(1, 'Northern'),
	(2, 'North Western'),
	(3, 'Western'),
	(4, 'North Central'),
	(5, 'Central'),
	(6, 'Sabaragamuwa'),
	(7, 'Eastern'),
	(8, 'Uva'),
	(9, 'Southern');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;

-- Dumping structure for table viva.recent
CREATE TABLE IF NOT EXISTS `recent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_recent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`users_email`) USING BTREE,
  CONSTRAINT `fk_recent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.recent: ~8 rows (approximately)
/*!40000 ALTER TABLE `recent` DISABLE KEYS */;
INSERT INTO `recent` (`id`, `product_id`, `users_email`) VALUES
	(65, 47, 'iharathathsara0@gmail.com'),
	(66, 46, 'kisal@gmail.com'),
	(67, 47, 'kisal@gmail.com'),
	(68, 49, 'kisal@gmail.com'),
	(69, 51, 'iharathathsara0@gmail.com'),
	(70, 53, 'iharathathsara0@gmail.com'),
	(71, 54, 'hasitha@gmail.com'),
	(72, 49, 'hasitha@gmail.com');
/*!40000 ALTER TABLE `recent` ENABLE KEYS */;

-- Dumping structure for table viva.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.status: ~2 rows (approximately)
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `name`) VALUES
	(1, 'Available'),
	(2, 'Unvailable');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table viva.type
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.type: ~2 rows (approximately)
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` (`id`, `name`) VALUES
	(1, 'Positive'),
	(2, 'Nuatrial'),
	(3, 'Negative');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;

-- Dumping structure for table viva.users
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(100) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`email`, `fname`, `lname`, `password`, `mobile`, `joined_date`, `verification_code`, `status`, `gender_id`) VALUES
	('hasitha@gmail.com', 'hasitha', 'kavishan', '123456', '0716443112', '2023-01-04 21:34:28', NULL, 1, 1),
	('iharathathsara0@gmail.com', 'Ihara', 'Thathsara', '123456', '0763947527', '2022-12-28 22:11:18', NULL, 1, 1),
	('kisal@gmail.com', 'kisal', 'dilaka', '123456', '0779880794', '2023-01-06 23:24:28', NULL, 1, 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table viva.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `city_id` int NOT NULL,
  `line1` text,
  `line2` text,
  `postal_code` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_has_city_city1_idx` (`city_id`),
  KEY `fk_user_has_city_user1_idx` (`users_email`) USING BTREE,
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.user_has_address: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_has_address` DISABLE KEYS */;
INSERT INTO `user_has_address` (`id`, `users_email`, `city_id`, `line1`, `line2`, `postal_code`) VALUES
	(15, 'iharathathsara0@gmail.com', 4, 'Kaduruduwa', 'Wanchawala', '80000'),
	(16, 'hasitha@gmail.com', 8, 'kalahe', 'malegoda', '30000'),
	(17, 'kisal@gmail.com', 4, 'bogahagoda', 'agulugaha', '80000');
/*!40000 ALTER TABLE `user_has_address` ENABLE KEYS */;

-- Dumping structure for table viva.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `users_email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  KEY `fk_watchlist_user1_idx` (`users_email`) USING BTREE,
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table viva.watchlist: ~9 rows (approximately)
/*!40000 ALTER TABLE `watchlist` DISABLE KEYS */;
INSERT INTO `watchlist` (`id`, `product_id`, `users_email`) VALUES
	(71, 50, 'iharathathsara0@gmail.com'),
	(72, 46, 'iharathathsara0@gmail.com'),
	(73, 48, 'kisal@gmail.com'),
	(74, 49, 'kisal@gmail.com'),
	(75, 53, 'kisal@gmail.com'),
	(76, 56, 'hasitha@gmail.com'),
	(77, 48, 'hasitha@gmail.com'),
	(78, 50, 'hasitha@gmail.com'),
	(79, 54, 'hasitha@gmail.com');
/*!40000 ALTER TABLE `watchlist` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
