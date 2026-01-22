-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for shoes
CREATE DATABASE IF NOT EXISTS `shoes` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `shoes`;

-- Dumping structure for table shoes.address
DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `street` text NOT NULL,
  `user_id` int NOT NULL,
  `postal_code` int NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_address_user1_idx` (`user_id`),
  KEY `fk_address_city1_idx` (`city_id`),
  CONSTRAINT `fk_address_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_address_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.address: ~0 rows (approximately)
INSERT INTO `address` (`id`, `street`, `user_id`, `postal_code`, `city_id`) VALUES
	(3, '397/3, Colombo Road, Hidellana', 1, 70000, 26);

-- Dumping structure for table shoes.brand
DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.brand: ~8 rows (approximately)
INSERT INTO `brand` (`id`, `name`) VALUES
	(1, 'VALENCIA'),
	(2, 'Reebok'),
	(3, 'U Softo'),
	(4, 'Petalz'),
	(5, 'AVI'),
	(6, 'Puma'),
	(7, 'Santa Cruz'),
	(8, 'Modare'),
	(9, 'ASICS');

-- Dumping structure for table shoes.cart
DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `shoe_id` int NOT NULL,
  `size_id` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cart_user1_idx` (`user_id`),
  KEY `fk_cart_shoe_has_size1_idx` (`shoe_id`,`size_id`),
  CONSTRAINT `fk_cart_shoe_has_size1` FOREIGN KEY (`shoe_id`, `size_id`) REFERENCES `shoe_has_size` (`shoe_id`, `size_id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.cart: ~3 rows (approximately)
INSERT INTO `cart` (`id`, `user_id`, `shoe_id`, `size_id`, `qty`) VALUES
	(28, 2, 1, 3, 1),
	(37, 1, 11, 6, 2),
	(38, 1, 5, 4, 1),
	(40, 1, 3, 3, 2);

-- Dumping structure for table shoes.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.category: ~3 rows (approximately)
INSERT INTO `category` (`id`, `name`) VALUES
	(1, 'Formal'),
	(2, 'Sports'),
	(3, 'Casuals');

-- Dumping structure for table shoes.city
DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `province_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_province1_idx` (`province_id`),
  CONSTRAINT `fk_city_province1` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.city: ~45 rows (approximately)
INSERT INTO `city` (`id`, `name`, `province_id`) VALUES
	(1, 'Kandy', 1),
	(2, 'Matale', 1),
	(3, 'Nuwara Eliya', 1),
	(4, 'Gampola', 1),
	(5, 'Dambulla', 1),
	(6, 'Trincomalee', 2),
	(7, 'Batticaloa', 2),
	(8, 'Ampara', 2),
	(9, 'Kalmunai', 2),
	(10, 'Eravur', 2),
	(11, 'Anuradhapura', 3),
	(12, 'Polonnaruwa', 3),
	(13, 'Medawachchiya', 3),
	(14, 'Hingurakgoda', 3),
	(15, 'Eppawala', 3),
	(16, 'Jaffna', 4),
	(17, 'Kilinochchi', 4),
	(18, 'Vavuniya', 4),
	(19, 'Mannar', 4),
	(20, 'Point Pedro', 4),
	(21, 'Kurunegala', 5),
	(22, 'Puttalam', 5),
	(23, 'Kuliyapitiya', 5),
	(24, 'Chilaw', 5),
	(25, 'Nikaweratiya', 5),
	(26, 'Ratnapura', 6),
	(27, 'Embilipitiya', 6),
	(28, 'Balangoda', 6),
	(29, 'Kegalle', 6),
	(30, 'Ruwanwella', 6),
	(31, 'Galle', 7),
	(32, 'Matara', 7),
	(33, 'Hambantota', 7),
	(34, 'Tangalle', 7),
	(35, 'Deniyaya', 7),
	(36, 'Badulla', 8),
	(37, 'Bandarawela', 8),
	(38, 'Monaragala', 8),
	(39, 'Wellawaya', 8),
	(40, 'Haputale', 8),
	(41, 'Colombo', 9),
	(42, 'Gampaha', 9),
	(43, 'Negombo', 9),
	(44, 'Kalutara', 9),
	(45, 'Moratuwa', 9);

-- Dumping structure for table shoes.color
DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.color: ~9 rows (approximately)
INSERT INTO `color` (`id`, `name`) VALUES
	(1, 'Black'),
	(2, 'Brown'),
	(3, 'Maroon'),
	(4, 'Pink'),
	(5, 'White'),
	(6, 'Gray'),
	(7, 'Mint'),
	(8, 'Orange'),
	(9, 'Yellow');

-- Dumping structure for table shoes.gender
DROP TABLE IF EXISTS `gender`;
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `name`) VALUES
	(1, 'Men'),
	(2, 'Women'),
	(3, 'Unisex');

-- Dumping structure for table shoes.province
DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.province: ~9 rows (approximately)
INSERT INTO `province` (`id`, `name`) VALUES
	(1, 'Central Province'),
	(2, 'Eastern Province'),
	(3, 'North Central Province'),
	(4, 'Northern Province'),
	(5, 'North Western Province'),
	(6, 'Sabaragamuwa Province'),
	(7, 'Southern Province'),
	(8, 'Uva Province'),
	(9, 'Western Province');

-- Dumping structure for table shoes.purchase
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `id` varchar(5) NOT NULL,
  `user_id` int NOT NULL,
  `date_time` datetime NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `street` text NOT NULL,
  `postal_code` varchar(45) NOT NULL,
  `city_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_user1_idx` (`user_id`),
  KEY `fk_purchase_city1_idx` (`city_id`),
  CONSTRAINT `fk_purchase_city1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  CONSTRAINT `fk_purchase_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.purchase: ~8 rows (approximately)
INSERT INTO `purchase` (`id`, `user_id`, `date_time`, `fname`, `lname`, `street`, `postal_code`, `city_id`) VALUES
	('7q1Vv', 1, '2025-03-17 18:50:32', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('BGY5s', 1, '2025-03-17 18:18:13', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('ljwsF', 1, '2025-03-17 18:14:18', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('lYgMW', 1, '2025-03-17 18:56:20', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('OXCsv', 1, '2025-03-17 18:19:57', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('Pbq3c', 1, '2025-03-17 18:23:01', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('TnmwN', 1, '2025-03-17 18:55:12', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('UDWDf', 1, '2025-03-17 18:46:42', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),
	('x2MIY', 1, '2025-03-18 13:23:33', 'john', 'doe', '193/6, Kurunegala Road, Jaffna', '20500', 26),

-- Dumping structure for table shoes.purchase_item
DROP TABLE IF EXISTS `purchase_item`;
CREATE TABLE IF NOT EXISTS `purchase_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `shoe_id` int NOT NULL,
  `size_id` int NOT NULL,
  `qty` int NOT NULL,
  `purchase_id` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_item_shoe_has_size1_idx` (`shoe_id`,`size_id`),
  KEY `fk_purchase_item_purchase1_idx` (`purchase_id`),
  CONSTRAINT `fk_purchase_item_purchase1` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`id`),
  CONSTRAINT `fk_purchase_item_shoe_has_size1` FOREIGN KEY (`shoe_id`, `size_id`) REFERENCES `shoe_has_size` (`shoe_id`, `size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.purchase_item: ~8 rows (approximately)
INSERT INTO `purchase_item` (`id`, `shoe_id`, `size_id`, `qty`, `purchase_id`) VALUES
	(6, 2, 3, 1, 'ljwsF'),
	(7, 4, 4, 1, 'BGY5s'),
	(8, 4, 3, 1, 'OXCsv'),
	(9, 4, 3, 1, 'Pbq3c'),
	(10, 1, 7, 1, 'UDWDf'),
	(11, 2, 3, 1, '7q1Vv'),
	(12, 3, 4, 1, 'TnmwN'),
	(13, 4, 4, 1, 'TnmwN'),
	(14, 4, 4, 1, 'lYgMW'),
	(15, 3, 4, 1, 'lYgMW'),
	(16, 1, 3, 1, 'x2MIY'),
	(17, 2, 5, 1, 'x2MIY');

-- Dumping structure for table shoes.shoe
DROP TABLE IF EXISTS `shoe`;
CREATE TABLE IF NOT EXISTS `shoe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `price` double NOT NULL,
  `brand_id` int NOT NULL,
  `category_id` int NOT NULL,
  `gender_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_shoe_brand_idx` (`brand_id`),
  KEY `fk_shoe_category1_idx` (`category_id`),
  KEY `fk_shoe_gender1_idx` (`gender_id`),
  CONSTRAINT `fk_shoe_brand` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  CONSTRAINT `fk_shoe_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `fk_shoe_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.shoe: ~14 rows (approximately)
INSERT INTO `shoe` (`id`, `name`, `price`, `brand_id`, `category_id`, `gender_id`) VALUES
	(1, 'VALENCIA Men Casual Slip-on Shoes BLACK', 2999, 1, 3, 1),
	(2, 'VALENCIA Men Casual Lacing Shoes BLACK', 2999, 1, 3, 1),
	(3, 'Reebok MEN Gents Shoes Black', 4833, 2, 3, 1),
	(4, 'U SOFTO MEN TOE RINGS SLIPPERS BROWN', 1585, 3, 3, 1),
	(5, 'PETALZ Women Casual Toe Ring Slippers MAROON', 1800, 4, 3, 2),
	(6, 'AVI Women RUNNING Lacing Shoes PINK', 2567, 5, 3, 2),
	(7, 'PUMA Unisex Casual Low Boots Puma White', 5589, 6, 3, 3),
	(8, 'Santa Cruz Men Formal Slip-on Shoes BROWN', 6799, 7, 1, 1),
	(9, 'Santa Cruz Men Formal Slip-on Shoes BLACK', 6799, 7, 1, 1),
	(10, 'MODARE Women Formal Pumps Shoes BLACK', 6898, 8, 1, 2),
	(11, 'AVI Men Running Shoes GRAY', 8990, 5, 2, 1),
	(12, 'AVI Men Basketball Shoes WHITE', 8399, 5, 2, 1),
	(13, 'Asics Women Casual Lacing Shoes WHITE/COSMOS', 5579, 9, 2, 2),
	(14, 'Asics Unisex Performance Running Lacing Shoes WHITE', 6790, 9, 2, 3);

-- Dumping structure for table shoes.shoe_has_color
DROP TABLE IF EXISTS `shoe_has_color`;
CREATE TABLE IF NOT EXISTS `shoe_has_color` (
  `shoe_id` int NOT NULL,
  `color_id` int NOT NULL,
  PRIMARY KEY (`shoe_id`,`color_id`),
  KEY `fk_shoe_has_color_color1_idx` (`color_id`),
  KEY `fk_shoe_has_color_shoe1_idx` (`shoe_id`),
  CONSTRAINT `fk_shoe_has_color_color1` FOREIGN KEY (`color_id`) REFERENCES `color` (`id`),
  CONSTRAINT `fk_shoe_has_color_shoe1` FOREIGN KEY (`shoe_id`) REFERENCES `shoe` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.shoe_has_color: ~21 rows (approximately)
INSERT INTO `shoe_has_color` (`shoe_id`, `color_id`) VALUES
	(1, 1),
	(3, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(4, 2),
	(8, 2),
	(5, 3),
	(6, 4),
	(3, 5),
	(6, 5),
	(7, 5),
	(11, 5),
	(12, 5),
	(13, 5),
	(14, 5),
	(2, 6),
	(11, 6),
	(12, 7),
	(13, 8),
	(14, 8),
	(14, 9);

-- Dumping structure for table shoes.shoe_has_size
DROP TABLE IF EXISTS `shoe_has_size`;
CREATE TABLE IF NOT EXISTS `shoe_has_size` (
  `shoe_id` int NOT NULL,
  `size_id` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`shoe_id`,`size_id`),
  KEY `fk_shoe_has_size_size1_idx` (`size_id`),
  KEY `fk_shoe_has_size_shoe1_idx` (`shoe_id`),
  CONSTRAINT `fk_shoe_has_size_shoe1` FOREIGN KEY (`shoe_id`) REFERENCES `shoe` (`id`),
  CONSTRAINT `fk_shoe_has_size_size1` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.shoe_has_size: ~71 rows (approximately)
INSERT INTO `shoe_has_size` (`shoe_id`, `size_id`, `qty`) VALUES
	(1, 3, 2),
	(1, 4, 2),
	(1, 5, 0),
	(1, 6, 3),
	(1, 7, 1),
	(2, 3, 0),
	(2, 4, 2),
	(2, 5, 0),
	(2, 6, 3),
	(2, 7, 3),
	(3, 3, 3),
	(3, 4, 0),
	(3, 5, 3),
	(3, 6, 3),
	(3, 7, 2),
	(4, 3, 1),
	(4, 4, 1),
	(4, 5, 3),
	(4, 6, 0),
	(4, 7, 3),
	(5, 1, 0),
	(5, 2, 3),
	(5, 3, 3),
	(5, 4, 3),
	(5, 5, 0),
	(6, 1, 3),
	(6, 2, 1),
	(6, 3, 3),
	(6, 4, 3),
	(6, 5, 3),
	(7, 1, 2),
	(7, 2, 5),
	(7, 3, 5),
	(7, 4, 4),
	(7, 5, 5),
	(8, 4, 3),
	(8, 5, 4),
	(8, 6, 2),
	(8, 7, 4),
	(8, 8, 4),
	(9, 4, 1),
	(9, 5, 4),
	(9, 6, 4),
	(9, 7, 2),
	(9, 8, 4),
	(10, 1, 5),
	(10, 2, 5),
	(10, 3, 0),
	(10, 4, 5),
	(10, 5, 5),
	(10, 6, 0),
	(11, 5, 3),
	(11, 6, 3),
	(11, 7, 0),
	(11, 8, 3),
	(11, 9, 0),
	(12, 5, 3),
	(12, 6, 0),
	(12, 7, 3),
	(12, 8, 1),
	(12, 9, 0),
	(13, 1, 2),
	(13, 2, 0),
	(13, 3, 2),
	(13, 4, 2),
	(13, 5, 2),
	(14, 1, 0),
	(14, 2, 0),
	(14, 3, 0),
	(14, 4, 2),
	(14, 5, 2);

-- Dumping structure for table shoes.size
DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.size: ~9 rows (approximately)
INSERT INTO `size` (`id`, `name`) VALUES
	(1, '04'),
	(2, '05'),
	(3, '06'),
	(4, '07'),
	(5, '08'),
	(6, '09'),
	(7, '10'),
	(8, '11'),
	(9, '12');

-- Dumping structure for table shoes.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shoes.user: ~2 rows (approximately)
INSERT INTO `user` (`id`, `fname`, `lname`, `email`, `mobile`, `password`, `verification_code`) VALUES
	(1, 'john', 'doe', 'john@gmail.com', '0712345678', '12345', '67e333224121c'),
	(2, 'jane', 'doe', 'jane@gmail.com', '0712345679', '11111', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
