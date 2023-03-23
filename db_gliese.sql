-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.3.0.6589
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
CREATE DATABASE IF NOT EXISTS `db_gliese` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
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

-- Volcando estructura para tabla db_gliese.document_type
DROP TABLE IF EXISTS `document_type`;
CREATE TABLE IF NOT EXISTS `document_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.document_type: ~0 rows (aproximadamente)
INSERT INTO `document_type` (`id`, `description`, `status`) VALUES
	(1, 'DNI', 1);

-- Volcando estructura para tabla db_gliese.income
DROP TABLE IF EXISTS `income`;
CREATE TABLE IF NOT EXISTS `income` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_supplier` int NOT NULL,
  `id_user` int NOT NULL,
  `id_voucher_type` int NOT NULL,
  `proof_series` varchar(7) DEFAULT NULL,
  `voucher_series` varchar(10) NOT NULL,
  `proof_date` int NOT NULL DEFAULT '0',
  `IGV` decimal(4,2) NOT NULL,
  `number_installments` int DEFAULT NULL,
  `installment_value` decimal(11,2) DEFAULT NULL,
  `full_purchase` decimal(11,2) NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_user` (`id_user`),
  KEY `id_voucher_type` (`id_voucher_type`),
  CONSTRAINT `FK_INCOME_SUPPLIER` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`),
  CONSTRAINT `FK_INCOME_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_INCOME_VOUCHER_TYPE` FOREIGN KEY (`id_voucher_type`) REFERENCES `voucher_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.income: ~0 rows (aproximadamente)

-- Volcando estructura para tabla db_gliese.intent
DROP TABLE IF EXISTS `intent`;
CREATE TABLE IF NOT EXISTS `intent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.intent: ~5 rows (aproximadamente)
INSERT INTO `intent` (`id`, `token`) VALUES
	(12, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(13, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(14, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(15, 'gjYSL8sm4porYSQSPo436rnlxTIqTpgfW9jgjnwtfze3caCPGAAZIHGF1n7mlWNvaA863E4TYam55/Pm+LwjiBGPnvSoTQ7QD88mYd5pM4cUpWQgJThJKHGRZL1EsNtsdpBAmg=='),
	(16, 'EFj4ncJXv2k7BoTw6rZUJ7Qto8w/U2stpqCNZY0boNeX8Q7/noplT8/at/4a55wyFySCmYyf5cN0rDX3c+p9u28OyYSJeeJsyvg7fgbo+3IihvmAWidiivGDJGYoJMywbhIZdA==');

-- Volcando estructura para tabla db_gliese.menu
DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(80) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.menu: ~4 rows (aproximadamente)
INSERT INTO `menu` (`id`, `description`, `icon`, `order`) VALUES
	(1, 'Home', 'home', 1),
	(2, 'Almacén', 'archive', 2),
	(3, 'Ventas', 'shopping-cart', 3),
	(4, 'Recepción', 'database', 4),
	(5, 'Administración', 'sliders', 5);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.permission: ~7 rows (aproximadamente)
INSERT INTO `permission` (`id`, `id_role`, `id_sub_menu`, `status`) VALUES
	(1, 1, 1, 1),
	(2, 1, 6, 1),
	(3, 1, 7, 1),
	(4, 1, 8, 1),
	(5, 1, 9, 1),
	(6, 1, 10, 1),
	(7, 1, 11, 1),
	(15, 1, 12, 1);

-- Volcando estructura para tabla db_gliese.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_category` int DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `stock` int DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `expiration_date` char(50) DEFAULT NULL,
  `status_expiration_date` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`),
  UNIQUE KEY `code` (`code`),
  KEY `id_categories` (`id_category`) USING BTREE,
  CONSTRAINT `FK_PRODUCTS_CATEGORIES` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.products: ~9 rows (aproximadamente)
INSERT INTO `products` (`id`, `id_category`, `description`, `stock`, `code`, `status`, `expiration_date`, `status_expiration_date`) VALUES
	(65, 2, 'DESC 01', 10, '01', 1, '2023-03-18', 1),
	(66, 3, 'DESC 02', 20, '02', 1, 'WITHOUT EXPIRATION', 1),
	(67, 2, 'DESC 03', 30, '03', 1, '2023-03-18', 1),
	(68, 3, 'DESC 04', 40, '04', 1, '2023-03-18', 1),
	(69, 2, 'DESC 05', 40, '05', 1, '2023-03-18', 1),
	(95, 3, 'DESC 06', 60, '06', 1, 'WITHOUT EXPIRATION', 1),
	(96, 3, 'DESC 07', 70, '07', 1, '2023-03-20', 1),
	(97, 3, 'DESC 08', 80, '08', 1, 'WITHOUT EXPIRATION', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.sub_menu: ~8 rows (aproximadamente)
INSERT INTO `sub_menu` (`id`, `id_menu`, `description`, `icon`, `url`, `order`) VALUES
	(1, 1, 'Dashboards', 'circle', 'Dashboards', 1),
	(6, 2, 'Productos', 'circle', 'Products', 1),
	(7, 2, 'Categorias', 'circle', 'Categories', 2),
	(8, 3, 'Clientes', 'circle', 'Clients', 1),
	(9, 5, 'Usuarios', 'circle', 'Users', 1),
	(10, 5, 'Roles', 'circle', 'Roles', 2),
	(11, 5, 'Sedes', 'circle', 'Campus', 3),
	(12, 4, 'Ingresos', 'circle', 'income', 1);

-- Volcando estructura para tabla db_gliese.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_document_type` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `document_number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `business_name` varchar(256) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_number` (`document_number`),
  KEY `id_document_type` (`id_document_type`),
  CONSTRAINT `FK_SUPPLIER_DOCUMENT_TYPE` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.supplier: ~0 rows (aproximadamente)

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.user: ~3 rows (aproximadamente)
INSERT INTO `user` (`id`, `id_role`, `id_document_type`, `first_name`, `last_name`, `document_number`, `address`, `telephone`, `email`, `user`, `password`, `image_url`, `status`, `active`) VALUES
	(1, 1, 1, 'diego', 'uriarte chancafe', '74417614', 'Chancay', '913085587', 'grjere698@gmail.com', 'admin', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(13, 1, 1, 'jeremi', 'gonzales', '72003668', 'Av. 1 de mayo 1031', '913085589', 'grjere698@gmail.com', 'admin2', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(15, 1, 1, 'ruben', 'dario', '72003669', 'Av. 1 de mayo 1031', '999888777', 'essaulherrerasangay601@gmail.com', 'admin3', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.user_campus: ~9 rows (aproximadamente)
INSERT INTO `user_campus` (`id`, `id_user`, `id_campus`, `status`) VALUES
	(1, 1, 1, 1),
	(2, 1, 2, 1),
	(16, 1, 3, 1),
	(17, 13, 1, 1),
	(18, 13, 2, 1),
	(19, 13, 3, 1),
	(20, 15, 1, 1),
	(21, 15, 2, 1),
	(22, 15, 3, 1);

-- Volcando estructura para tabla db_gliese.voucher_type
DROP TABLE IF EXISTS `voucher_type`;
CREATE TABLE IF NOT EXISTS `voucher_type` (
  `id` int NOT NULL,
  `voucher_type_description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.voucher_type: ~8 rows (aproximadamente)
INSERT INTO `voucher_type` (`id`, `voucher_type_description`) VALUES
	(1, 'Factura'),
	(2, 'Boleta de Venta'),
	(3, 'Nota de Credito'),
	(4, 'Guia de Remisión Remitente'),
	(5, 'Cotización'),
	(6, 'Orden de Pagos'),
	(7, 'Ticket'),
	(8, 'Prestamo');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
