-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para db_gliese
DROP DATABASE IF EXISTS `db_gliese`;
CREATE DATABASE IF NOT EXISTS `db_gliese`;
USE `db_gliese`;

-- Volcando estructura para tabla db_gliese.campus
DROP TABLE IF EXISTS `campus`;
CREATE TABLE IF NOT EXISTS `campus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.campus: ~3 rows (aproximadamente)
INSERT INTO `campus` (`id`, `description`, `status`) VALUES
	(1, 'CHANCAY', 1),
	(2, 'HUARAL', 1),
	(3, 'LIMA', 1);

-- Volcando estructura para tabla db_gliese.carrier
DROP TABLE IF EXISTS `carrier`;
CREATE TABLE IF NOT EXISTS `carrier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_document_type` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `document_number` varchar(20) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `business_name` varchar(256) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `document_number` (`document_number`) USING BTREE,
  KEY `id_document_type` (`id_document_type`) USING BTREE,
  CONSTRAINT `FK_CARRIER_DOCUMENT_TYPE` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.carrier: ~0 rows (aproximadamente)
INSERT INTO `carrier` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `business_name`, `email`, `status`) VALUES
	(1, 2, 'ALEXANDER ANGEL', '75232411451', 'Asoc Santa Rosa MZ E3 Lote 9', '933430561', 'ANGEL ASOC 5050', 'alexanderdiaz78@gmail.com', 1),
	(2, 1, 'ROSANGELA ', '75418596', 'Asoc Santa Rosa Lote 15 A4', '974852142', 'ROSANGELA ASOC 7890', 'rosangelahuanilo74@gmail.com', 1),
	(3, 1, 'ALEXANDER ANGEL DIAZ GRANADOS', '78456252', 'Chancay 748', '526415748', 'ALEXANDER', 'Angel_1574858@hotmail.com', 1);

-- Volcando estructura para tabla db_gliese.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.categories: ~2 rows (aproximadamente)
INSERT INTO `categories` (`id`, `description`, `status`) VALUES
	(2, 'VAMO A PROGRAMAR', 1),
	(3, 'VENDEDORGF', 1);

-- Volcando estructura para tabla db_gliese.clients
DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_document_type` int NOT NULL,
  `name` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `document_number` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `business_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_type` (`id_document_type`) USING BTREE,
  CONSTRAINT `FK_CLIENTS_DOCUMENT_TYPE` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.clients: ~0 rows (aproximadamente)
INSERT INTO `clients` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `email`, `business_name`, `status`) VALUES
	(1, 1, 'Ruben', '72131009', 'Chancay', '987975591', 'rubengmail.com', 'RYR', 1);

-- Volcando estructura para tabla db_gliese.detail_income
DROP TABLE IF EXISTS `detail_income`;
CREATE TABLE IF NOT EXISTS `detail_income` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL,
  `id_income` int NOT NULL,
  `stock` int NOT NULL,
  `purchase_price` decimal(11,2) NOT NULL,
  `sale_price` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `FK_INCOME_PRODUCT` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.detail_income: ~0 rows (aproximadamente)

-- Volcando estructura para tabla db_gliese.document_type
DROP TABLE IF EXISTS `document_type`;
CREATE TABLE IF NOT EXISTS `document_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.document_type: ~2 rows (aproximadamente)
INSERT INTO `document_type` (`id`, `description`, `status`) VALUES
	(1, 'DNI', 1),
	(2, 'RUC', 1);

-- Volcando estructura para tabla db_gliese.income
DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_supplier` int NOT NULL,
  `id_user` int NOT NULL,
  `id_voucher_type` int NOT NULL,
  `id_payment_type` int NOT NULL,
  `proof_series` varchar(7) DEFAULT NULL,
  `voucher_series` varchar(10) NOT NULL,
  `proof_date` datetime NOT NULL,
  `igv` decimal(4,2) NOT NULL,
  `number_installments` int DEFAULT NULL,
  `installment_value` decimal(11,2) DEFAULT NULL,
  `full_purchase` decimal(11,2) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_user` (`id_user`),
  KEY `id_voucher_type` (`id_voucher_type`),
  KEY `id_payment_type` (`id_payment_type`),
  CONSTRAINT `FK_INCOME_PAYMENT_TYPE` FOREIGN KEY (`id_payment_type`) REFERENCES `payment_type` (`id`),
  CONSTRAINT `FK_INCOME_SUPPLIER` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`),
  CONSTRAINT `FK_INCOME_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_INCOME_VOUCHER_TYPE` FOREIGN KEY (`id_voucher_type`) REFERENCES `voucher_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.income: ~0 rows (aproximadamente)
INSERT INTO `income` (`id`, `id_supplier`, `id_user`, `id_voucher_type`, `id_payment_type`, `proof_series`, `voucher_series`, `proof_date`, `igv`, `number_installments`, `installment_value`, `full_purchase`, `status`) VALUES
	(1, 1, 13, 1, 1, 'B001', '00000001', '2023-03-30 21:43:58', 0.18, NULL, NULL, 100.50, '1');

-- Volcando estructura para tabla db_gliese.intent
DROP TABLE IF EXISTS `intent`;
CREATE TABLE IF NOT EXISTS `intent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.intent: ~14 rows (aproximadamente)
INSERT INTO `intent` (`id`, `token`) VALUES
	(12, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(13, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(14, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(15, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(16, 'EFj4ncJXv2k7BoTw6rZUJ7Qto8w/U2stpqCNZY0boNeX8Q7/noplT8/at/4a55wyFySCmYyf5cN0rDX3c+p9u28OyYSJeeJsyvg7fgbo+3IihvmAWidiivGDJGYoJMywbhIZdA=='),
	(17, 'RXy0/jSAd5JczrdApFzVgMPPoN9ZJ7RR1JdvuG5bKZ3443zRi8vjrEqYRwkikqQ2fU7BKe3H3A3IACnGLt97aVeRUDl9VL/3hqUx7HSR+EtlAj6HGCZ6TKjLL6bm3GiNuI8MIQ=='),
	(18, 'RXy0/jSAd5JczrdApFzVgMPPoN9ZJ7RR1JdvuG5bKZ3443zRi8vjrEqYRwkikqQ2fU7BKe3H3A3IACnGLt97aVeRUDl9VL/3hqUx7HSR+EtlAj6HGCZ6TKjLL6bm3GiNuI8MIQ=='),
	(19, 'VYtGUGue1OCp8/5QBhcIi3ShJbk85/YmVbk3iENr8rIseReWUKYmyZ9BPSmQJflxXaZlVIg62LFTcneW9aJBMVZT6srkr+wXoTGA0pzbPKXKZOPIF+U2dwTS6JX3RDysc12VjA=='),
	(20, '3ckmMmMWPQfjL1f5lUk3P+kf38KcpJca/H8FExPCtPDZ6qvN/JaaZAMP/yevdj6Kglp/jhDZhTnnjOs88mh6FM8au67U+FLaEFtG5Jktwhs9e0rjGrfCbbLWnhojZWb53P1/Jg=='),
	(21, 'ao4rLnLR32VGiEXTRJnRDvUa0/YeDi30TSIcPdbYLAdF8SS54edHQXF3yx6rCs3XBfuHr4C04kmqU9XJd5Ya5YlMZSdQDgCZTykvcHIrHGC+QrXzHtu8YLeshLb3W5pmQW5avw=='),
	(22, '4M2cNr72yhLkmPpw+xXJt82moY7QeBgsAWNznGMkjnIbP3LrxA8OFdi3itOI9y38HC0rsQrgxKnE43AKUpVTTnRM/yUME4sFTUVKX/iWYvsYdkqcfh8P662f+Apoj0/chlz3Og=='),
	(23, '4LDRDYaAaQu9fMJdJdpk43GN4uDk4tNzN6RZEhYdSJqSXlCSuDNPZA+wqVY5RVTw+qNyOVA+YbNjZrkXDMINumRg1st8sftzpcQvvp57tbDD3077aHoHnOP2CJ+78V8795lA1g=='),
	(24, 'qQ82xrb5o3w/NUv8+4xU3QLIFSXYmLoFuXE4B8CQGn5vlKZRYBJaVRLyM6go8SAdHb0bSD6w/gARnwrZINKjOwYHjqpb5gTRDYxSsV1gxnzTknpZP2DT7G139Qbvi0uNpXY+6Q=='),
	(25, 'wwDgSp8/w8HlzFp4ixnFeGaa3QjTF8WqFCDzMjLIMDyDinMVMTjDcmBK7WLGJ1fBtsBsQh4MFZs8YWD1w9IwpWYck99EKXOeHzyZaOqvWzaAvoNO6IiO/Exl5evaBVFqZr2uFw==');

-- Volcando estructura para tabla db_gliese.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(80) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.menu: ~5 rows (aproximadamente)
INSERT INTO `menu` (`id`, `description`, `icon`, `order`) VALUES
	(1, 'Home', 'home', 1),
	(2, 'Almacén', 'archive', 2),
	(3, 'Ventas', 'shopping-cart', 3),
	(4, 'Recepción', 'database', 4),
	(5, 'Administración', 'sliders', 5);

-- Volcando estructura para tabla db_gliese.payment_type
DROP TABLE IF EXISTS `payment_type`;
CREATE TABLE IF NOT EXISTS `payment_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.payment_type: ~3 rows (aproximadamente)
INSERT INTO `payment_type` (`id`, `description`, `status`) VALUES
	(1, 'Contado', 1),
	(2, 'Credito', 1),
	(3, 'Transferencia', 1);

-- Volcando estructura para tabla db_gliese.permission
DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_role` int NOT NULL,
  `id_sub_menu` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_PERMISSION_ROLE` (`id_role`),
  KEY `FK_PERMISSION_SUB_MENU` (`id_sub_menu`),
  CONSTRAINT `FK_PERMISSION_ROLE` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_PERMISSION_SUB_MENU` FOREIGN KEY (`id_sub_menu`) REFERENCES `sub_menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.permission: ~14 rows (aproximadamente)
INSERT INTO `permission` (`id`, `id_role`, `id_sub_menu`, `status`) VALUES
	(1, 1, 1, 1),
	(2, 1, 6, 1),
	(3, 1, 7, 1),
	(4, 1, 8, 1),
	(5, 1, 9, 1),
	(6, 1, 10, 1),
	(7, 1, 11, 1),
	(15, 1, 12, 1),
	(16, 1, 13, 1),
	(17, 1, 14, 1),
	(18, 1, 15, 1),
	(19, 1, 16, 1),
	(20, 1, 17, 1),
	(21, 1, 18, 1);

-- Volcando estructura para tabla db_gliese.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_category` int DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `stock` int DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `expiration_date` int DEFAULT NULL,
  `status_expiration_date` tinyint(1) NOT NULL DEFAULT '1',
  `ts_start` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`),
  UNIQUE KEY `code` (`code`),
  KEY `id_categories` (`id_category`) USING BTREE,
  CONSTRAINT `FK_PRODUCTS_CATEGORIES` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.products: ~8 rows (aproximadamente)
INSERT INTO `products` (`id`, `id_category`, `description`, `stock`, `code`, `status`, `expiration_date`, `status_expiration_date`, `ts_start`) VALUES
	(97, 2, 'DESC 01', 52, '01', 1, NULL, 1, 1681254999),
	(112, 3, 'DESC 02', 90, '02', 1, NULL, 1, 1681250641),
	(115, 2, 'DESC 03', 90, '03', 1, NULL, 1, 1681250783),
	(116, 3, 'DESC 04', 15, '04', 1, NULL, 1, 0),
	(117, 3, 'DESC 05', 150, '05', 1, NULL, 1, 1681249710),
	(129, 3, 'DESC 06', 60, '06', 1, NULL, 1, 1681251158),
	(130, 3, 'DESC 07', 70, '07', 1, NULL, 1, 0),
	(131, 2, 'DESC 08', 15, '08', 1, NULL, 1, 1681251540);

-- Volcando estructura para tabla db_gliese.role
DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.role: ~0 rows (aproximadamente)
INSERT INTO `role` (`id`, `description`, `status`) VALUES
	(1, 'ADMINISTRADOR', 1);

-- Volcando estructura para tabla db_gliese.sub_menu
DROP TABLE IF EXISTS `sub_menu`;
CREATE TABLE IF NOT EXISTS `sub_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `description` varchar(45) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `url` varchar(80) NOT NULL,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_SUB_MENU_MENU` (`id_menu`),
  CONSTRAINT `FK_SUB_MENU_MENU` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.sub_menu: ~14 rows (aproximadamente)
INSERT INTO `sub_menu` (`id`, `id_menu`, `description`, `icon`, `url`, `order`) VALUES
	(1, 1, 'Dashboards', 'circle', 'Dashboards', 1),
	(6, 2, 'Productos', 'circle', 'Products', 1),
	(7, 2, 'Categorias', 'circle', 'Categories', 2),
	(8, 3, 'Clientes', 'circle', 'Clients', 1),
	(9, 5, 'Usuarios', 'circle', 'Users', 1),
	(10, 5, 'Roles', 'circle', 'Roles', 2),
	(11, 5, 'Sedes', 'circle', 'Campus', 3),
	(12, 4, 'Ingresos', 'circle', 'Income', 1),
	(13, 4, 'Proveedores', 'circle', 'Suppliers', 2),
	(14, 3, 'Facturación por venta', 'circle', 'Billingpersale', 2),
	(15, 3, 'Ticket', 'circle', 'Ticket', 3),
	(16, 3, 'Proforma', 'circle', 'Proforma', 4),
	(17, 3, 'Nota de credito', 'circle', 'Creditnote', 5),
	(18, 3, 'Transportista', 'circle', 'Carrier', 1);

-- Volcando estructura para tabla db_gliese.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_document_type` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `document_number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `business_name` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_number` (`document_number`),
  KEY `id_document_type` (`id_document_type`),
  CONSTRAINT `FK_SUPPLIER_DOCUMENT_TYPE` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla db_gliese.supplier: ~4 rows (aproximadamente)
INSERT INTO `supplier` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `business_name`, `email`, `status`) VALUES
	(1, 1, 'ALEXANDER', '71695889', 'lopez de zuñiga', '915959584', 'R&amp;J ACTION', 'generateindollars@gmail.com', 1),
	(3, 1, 'JEREMI', '72003664', 'Av 1 de mayo', '936672334', 'J&amp;amp;D ACTION', 'jeregr.21042002@gmail.com12', 1),
	(4, 1, 'RUBEN DARIO', '721368235', 'Chancay Lopez 04', '987975591', 'R&amp;R ACTION', 'rubendario7tu@gmail.com', 1),
	(5, 1, 'JEREMI ARMANDO GONZALES RUEDA', '7', 'Av 1 de mayo', '8', 'J&amp;D ACTION ', 'jeregr.21042002@gmail.com', 1);

-- Volcando estructura para tabla db_gliese.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_role` int NOT NULL,
  `id_document_type` int NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `document_number` varchar(45) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `user` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `image_url` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  UNIQUE KEY `document_number_UNIQUE` (`document_number`),
  KEY `FK_USER_ROLE` (`id_role`),
  KEY `FK_USER_DOCUMENT_TYPE` (`id_document_type`),
  CONSTRAINT `FK_USER_DOCUMENT_TYPE` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`),
  CONSTRAINT `FK_USER_ROLE` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.user: ~0 rows (aproximadamente)
INSERT INTO `user` (`id`, `id_role`, `id_document_type`, `first_name`, `last_name`, `document_number`, `address`, `telephone`, `email`, `user`, `password`, `image_url`, `status`, `active`) VALUES
	(1, 1, 2, 'Diego', 'Uriarte chancafe', '12345678912', 'Chancay', '913085587', 'grjere698@gmail.com', 'admin', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(13, 1, 1, 'Jeremi', 'Gonzales', '8', 'Av. 1 de mayo 1031', '913085589', 'grjere698@gmail.com', 'admin2', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(15, 1, 1, 'Ruben', 'Dario', '12345678', 'Av. 1 de mayo 1031', '999888777', 'essaulherrerasangay601@gmail.com', 'admin3', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(18, 1, 1, 'Alex', 'Diaz', '88888', 'Calichera', '8', 'generateindollars@gmail.com12', 'admin4', 'admin', NULL, 1, 1),
	(19, 1, 1, 'Leonardo', 'Gonzales', '78945612', 'Av. 1 de mayo 1031', '987975591', 'grjere698@gmail.com', 'Leonardo', '4d47566d4e5463304d6a67774e5746695932557a5a54426a4d6d457a5a6a466b5a57517a4d7a63324e7a673d', NULL, 0, 1);

-- Volcando estructura para tabla db_gliese.user_campus
DROP TABLE IF EXISTS `user_campus`;
CREATE TABLE IF NOT EXISTS `user_campus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_campus` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_USER_CAMPUS_CAMPUS` (`id_campus`),
  KEY `FK_USER_CAMPUS_USER` (`id_user`),
  CONSTRAINT `FK_USER_CAMPUS_CAMPUS` FOREIGN KEY (`id_campus`) REFERENCES `campus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_USER_CAMPUS_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.user_campus: ~0 rows (aproximadamente)
INSERT INTO `user_campus` (`id`, `id_user`, `id_campus`, `status`) VALUES
	(1, 1, 1, 1),
	(2, 1, 2, 1),
	(16, 1, 3, 1),
	(17, 13, 1, 1),
	(18, 13, 2, 1),
	(19, 13, 3, 1),
	(20, 15, 1, 1),
	(21, 15, 2, 1),
	(22, 15, 3, 1),
	(23, 18, 1, 1),
	(24, 18, 2, 1),
	(25, 18, 3, 1),
	(26, 19, 2, 1),
	(27, 19, 1, 1),
	(28, 19, 3, 1);

-- Volcando estructura para tabla db_gliese.voucher_type
DROP TABLE IF EXISTS `voucher_type`;
CREATE TABLE IF NOT EXISTS `voucher_type` (
  `id` int NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.voucher_type: ~0 rows (aproximadamente)
INSERT INTO `voucher_type` (`id`, `description`, `status`) VALUES
	(1, 'Factura', 1),
	(2, 'Boleta de Venta', 1),
	(3, 'Nota de Credito', 1),
	(4, 'Guia de Remisión Remitente', 1),
	(5, 'Cotización', 1),
	(6, 'Orden de Pagos', 1),
	(7, 'Ticket', 1),
	(8, 'Prestamo', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;