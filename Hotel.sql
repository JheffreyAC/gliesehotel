-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
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
CREATE DATABASE IF NOT EXISTS `db_gliese` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_gliese`;

-- Volcando estructura para tabla db_gliese.accessory
CREATE TABLE IF NOT EXISTS `accessory` (
  `id_accesory` int NOT NULL AUTO_INCREMENT,
  `accesory_description` varchar(250) NOT NULL,
  `accesory_price` decimal(10,2) NOT NULL,
  `accesory_stock` int NOT NULL,
  PRIMARY KEY (`id_accesory`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.accessory: ~6 rows (aproximadamente)
DELETE FROM `accessory`;
INSERT INTO `accessory` (`id_accesory`, `accesory_description`, `accesory_price`, `accesory_stock`) VALUES
	(1, 'Funda para teléfono', 5.00, 20),
	(2, 'Correa para reloj', 3.00, 10),
	(3, 'Llavero', 2.00, 15),
	(4, 'Monedero', 7.00, 12),
	(5, 'Gafas de sol', 10.00, 14),
	(6, 'Mochila', 20.00, 10);

-- Volcando estructura para tabla db_gliese.campus
CREATE TABLE IF NOT EXISTS `campus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.campus: ~3 rows (aproximadamente)
DELETE FROM `campus`;
INSERT INTO `campus` (`id`, `description`, `status`) VALUES
	(1, 'CHANCAY', 1),
	(2, 'HUARAL', 1),
	(3, 'LIMA', 1);

-- Volcando estructura para tabla db_gliese.carrier
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

-- Volcando datos para la tabla db_gliese.carrier: ~3 rows (aproximadamente)
DELETE FROM `carrier`;
INSERT INTO `carrier` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `business_name`, `email`, `status`) VALUES
	(1, 2, 'ALEXANDER ANGEL', '75232411451', 'Asoc Santa Rosa MZ E3 Lote 9', '933430561', 'ANGEL ASOC 5050', 'alexanderdiaz78@gmail.com', 1),
	(2, 1, 'ROSANGELA ', '75418596', 'Asoc Santa Rosa Lote 15 A4', '974852142', 'ROSANGELA ASOC 7890', 'rosangelahuanilo74@gmail.com', 1),
	(3, 1, 'ALEXANDER ANGEL DIAZ GRANADOS', '78456252', 'Chancay 748', '526415748', 'ALEXANDER', 'Angel_1574858@hotmail.com', 1);

-- Volcando estructura para tabla db_gliese.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.categories: ~2 rows (aproximadamente)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `description`, `status`) VALUES
	(2, 'VAMO A PROGRAMAR', 1),
	(3, 'VENDEDORGF', 1);

-- Volcando estructura para tabla db_gliese.clients
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

-- Volcando datos para la tabla db_gliese.clients: ~1 rows (aproximadamente)
DELETE FROM `clients`;
INSERT INTO `clients` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `email`, `business_name`, `status`) VALUES
	(1, 1, 'Ruben', '72131009', 'Chancay', '987975591', 'rubengmail.com', 'RYR', 1);

-- Volcando estructura para tabla db_gliese.detail_income
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
DELETE FROM `detail_income`;

-- Volcando estructura para tabla db_gliese.document_type
CREATE TABLE IF NOT EXISTS `document_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.document_type: ~2 rows (aproximadamente)
DELETE FROM `document_type`;
INSERT INTO `document_type` (`id`, `description`, `status`) VALUES
	(1, 'DNI', 1),
	(2, 'RUC', 1);

-- Volcando estructura para tabla db_gliese.food
CREATE TABLE IF NOT EXISTS `food` (
  `id_food` int NOT NULL AUTO_INCREMENT,
  `food_description` varchar(250) NOT NULL,
  `food_price` decimal(10,2) NOT NULL,
  `food_stock` int NOT NULL,
  `tipo_food` varchar(250) NOT NULL,
  PRIMARY KEY (`id_food`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.food: ~7 rows (aproximadamente)
DELETE FROM `food`;
INSERT INTO `food` (`id_food`, `food_description`, `food_price`, `food_stock`, `tipo_food`) VALUES
	(1, 'Huevos', 1.00, 15, 'Comida'),
	(2, 'Panqueques', 3.00, 10, 'Comida'),
	(3, 'Refresco', 5.00, 20, 'Bebida'),
	(4, 'Frutas', 2.00, 23, 'Comida'),
	(5, 'Queso', 3.00, 12, 'Comida'),
	(6, 'Café', 2.00, 14, 'Bebida'),
	(7, 'Leche', 8.00, 10, 'Bebida');

-- Volcando estructura para tabla db_gliese.guest
CREATE TABLE IF NOT EXISTS `guest` (
  `id_guest` int NOT NULL AUTO_INCREMENT,
  `document_type` varchar(50) NOT NULL,
  `document_number` varchar(50) NOT NULL,
  `first_names` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_names` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_guest`),
  UNIQUE KEY `document_number` (`document_number`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.guest: ~55 rows (aproximadamente)
DELETE FROM `guest`;
INSERT INTO `guest` (`id_guest`, `document_type`, `document_number`, `first_names`, `last_names`, `address`, `company_name`) VALUES
	(1, 'DNI', '12345678', 'Juan', 'Perez', 'Calle 123', ''),
	(2, 'DNI', '77777777', 'Luis Alberto', 'Aranibar Leandro', 'Huacho', ''),
	(3, 'RUC', '34444444444', '', '', 'Barranca', 'Mercadotecnia Plus'),
	(4, 'DNI', '11111111', 'Juan Pablo', 'Perez Torres', 'Lima', ''),
	(5, 'RUC', '55555555555', '', '', 'Miraflores', 'Claro'),
	(6, 'DNI', '12111111', 'Mario Alberto', 'Casas Lobo', 'Surco', ''),
	(7, 'RUC', '77777777777', '', '', 'Arequipa', 'Bitel'),
	(8, 'RUC', '99999999999', '', '', 'Lurin', 'Linux Tech'),
	(9, 'DNI', '33333333', 'Mario Hart', 'Juan Perez', 'Callao', ''),
	(11, 'RUC', '66666666666', '', '', 'La Molina', 'Microsoft'),
	(13, 'RUC', '35467543646', '', '', 'La Molina', 'Samsung'),
	(14, 'DNI', '93275536', 'Martin Alberto', 'Mendez Torres', 'Lima', ''),
	(15, 'DNI', '92675453', 'Lucia', 'Martinez Lino', 'Huaura', ''),
	(16, 'RUC', '32654765341', '', '', 'Trujillo', 'La Casa Tech'),
	(17, 'DNI', '26743652', 'Karina Lucia', 'Sone Martinez', 'Cusco', ''),
	(18, 'DNI', '86753254', 'Kevin Pedro', 'Martinez', 'Lima', ''),
	(94, 'DNI', '12385678', 'John', 'Smith', '123 Main St', NULL),
	(95, 'RUC', '98765432109', NULL, NULL, '456 Elm St', 'ABC Corporation'),
	(96, 'DNI', '87654321', 'Jane', 'Doe', '789 Oak Ave', NULL),
	(97, 'RUC', '12345678901', NULL, NULL, '101 Pine Rd', 'XYZ Ltd'),
	(98, 'DNI', '55525555', 'Robert', 'Johnson', '222 Cedar Ln', NULL),
	(99, 'RUC', '23456789012', NULL, NULL, '333 Oakwood Dr', 'LMN Enterprises'),
	(100, 'DNI', '65432123', 'Maria', 'Gonzalez', '444 Willow St', NULL),
	(101, 'RUC', '34567890123', NULL, NULL, '555 Birch Ln', 'PQR Corp'),
	(102, 'DNI', '98765432', 'Carlos', 'Perez', '777 Elmwood Ave', NULL),
	(103, 'RUC', '45678901234', NULL, NULL, '666 Pine Rd', 'XYZ Holdings'),
	(104, 'DNI', '22422222', 'Laura', 'Martinez', '888 Oak Ave', NULL),
	(105, 'RUC', '56789012345', NULL, NULL, '111 Cedar Ln', 'EFG Inc'),
	(106, 'DNI', '31333333', 'Roberto', 'Sanchez', '999 Oakwood Dr', NULL),
	(107, 'RUC', '67890123456', NULL, NULL, '777 Willow St', 'HIJ Corporation'),
	(108, 'DNI', '44434444', 'Elena', 'Lopez', '222 Birch Ln', NULL),
	(109, 'RUC', '78901234567', NULL, NULL, '333 Elmwood Ave', 'KLM Enterprises'),
	(110, 'DNI', '55565555', 'Juan', 'Ramirez', '555 Pine Rd', NULL),
	(111, 'RUC', '89012345678', NULL, NULL, '111 Oak Ave', 'NOP Holdings'),
	(112, 'DNI', '66666666', 'Ana', 'Jimenez', '444 Cedar Ln', NULL),
	(113, 'RUC', '90123456789', NULL, NULL, '999 Willow St', 'QRS Corporation'),
	(114, 'DNI', '77771777', 'Pedro', 'Santos', '777 Elm Ave', NULL),
	(115, 'RUC', '01234567890', NULL, NULL, '222 Elmwood Dr', 'TUV Ltd'),
	(116, 'DNI', '88898888', 'Luis', 'Garcia', '666 Birch Ln', NULL),
	(117, 'RUC', '12349678901', NULL, NULL, '777 Oakwood Ave', 'WXYZ Holdings'),
	(118, 'DNI', '99959999', 'Isabel', 'Fernandez', '555 Pine Rd', NULL),
	(119, 'RUC', '20608300393', '', '', 'CAL. CESAR MORELLI NRO. 181 URB. SAN BORJA NORTE LIMA LIMA SAN BORJA', 'COMPAÑIA FOOD RETAIL S.A.C.'),
	(120, 'RUC', '20100047218', '', '', 'CAL. CENTENARIO NRO. 156 URB. LAS LADERAS DE MELGAREJO LIMA LIMA LA MOLINA', 'BANCO DE CREDITO DEL PERU'),
	(121, 'RUC', '20100017491', '', '', 'JR. DOMINGO MARTINEZ LUJAN NRO. 1130 LIMA LIMA SURQUILLO', 'TELEFONICA DEL PERU SAA'),
	(122, 'DNI', '77707467', 'MAYLLURI SHEYLI', 'CHENTA MUÑOZ', 'BARRANCA', ''),
	(124, 'DNI', '77707469', 'ANDRES ALEJANDRO', 'HUAMANI VILLAGOMEZ', 'LIMA LA MOLINA', ''),
	(125, 'DNI', '33562458', 'TADEO', 'REQUEJO CARRERO', 'HUAURA', 'NULL'),
	(126, 'DNI', '77707451', 'GLORIA BELÚ', 'HUAMAN LABRA', 'HUACHO', ''),
	(127, 'DNI', '77707455', 'ANALI', 'OLIBARES AVILES', 'MIRAFLORES', ''),
	(128, 'RUC', '20263322496', '', '', 'CAL. LUIS GALVANI NRO. 493 URB. LOTIZACION INDUSTRIAL SAN LIMA LIMA ATE', 'NESTLE PERU S A'),
	(129, 'DNI', '71448986', 'JHEFFREY RONALDHIÑO', 'ALCOSER CALERO', 'HUACHO', ''),
	(130, 'DNI', '06256217', 'DINA ERCILIA', 'BOLUARTE ZEGARRA', 'LIMA LA MOLINA', ''),
	(131, 'DNI', '27427864', 'JOSE PEDRO', 'CASTILLO TERRONES', 'CAJAMARCA', ''),
	(132, 'DNI', '41038391', 'GERALD AMERICO', 'OROPEZA LOPEZ', 'CALLAO', ''),
	(133, 'RUC', '20106897914', '', '', 'AV. REPUBLICA DE COLOMBIA NRO. 791 LIMA LIMA SAN ISIDRO', 'ENTEL PERU S.A.');

-- Volcando estructura para tabla db_gliese.income
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

-- Volcando datos para la tabla db_gliese.income: ~1 rows (aproximadamente)
DELETE FROM `income`;
INSERT INTO `income` (`id`, `id_supplier`, `id_user`, `id_voucher_type`, `id_payment_type`, `proof_series`, `voucher_series`, `proof_date`, `igv`, `number_installments`, `installment_value`, `full_purchase`, `status`) VALUES
	(1, 1, 13, 1, 1, 'B001', '00000001', '2023-03-30 21:43:58', 0.18, NULL, NULL, 100.50, '1');

-- Volcando estructura para tabla db_gliese.intent
CREATE TABLE IF NOT EXISTS `intent` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.intent: ~15 rows (aproximadamente)
DELETE FROM `intent`;
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
	(25, 'wwDgSp8/w8HlzFp4ixnFeGaa3QjTF8WqFCDzMjLIMDyDinMVMTjDcmBK7WLGJ1fBtsBsQh4MFZs8YWD1w9IwpWYck99EKXOeHzyZaOqvWzaAvoNO6IiO/Exl5evaBVFqZr2uFw=='),
	(26, 'CQ02JcptgFOmtYvsUJCuV26DzaAZlpXQYauDmio5d/F6EkkNaKIOooAoTcXNkYVGSOnOIQygHGDnlGUPl8N/KTeIatza6blrEQTzEFp1Q191cjgTAU+bRG1z/3xeDdCpji3KnQ==');

-- Volcando estructura para tabla db_gliese.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(80) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.menu: ~8 rows (aproximadamente)
DELETE FROM `menu`;
INSERT INTO `menu` (`id`, `description`, `icon`, `order`) VALUES
	(1, 'Habitaciones', 'home', 1),
	(2, 'Ventas', 'shopping-cart', 2),
	(3, 'Caja', 'archive', 3),
	(4, 'Otros ingresos', 'dollar-sign', 4),
	(5, 'Mantenimiento', 'key', 5),
	(6, 'Reportes', 'clipboard', 6),
	(7, 'Configuraciones', 'settings', 7),
	(8, 'Administración', 'sliders', 8);

-- Volcando estructura para tabla db_gliese.payment_extra
CREATE TABLE IF NOT EXISTS `payment_extra` (
  `id_extra` int NOT NULL AUTO_INCREMENT,
  `extra_hours` int NOT NULL,
  `price_extras` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_extra`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.payment_extra: ~4 rows (aproximadamente)
DELETE FROM `payment_extra`;
INSERT INTO `payment_extra` (`id_extra`, `extra_hours`, `price_extras`) VALUES
	(1, 2, 10.00),
	(2, 5, 20.00),
	(3, 6, 30.00),
	(4, 10, 50.00);

-- Volcando estructura para tabla db_gliese.payment_type
CREATE TABLE IF NOT EXISTS `payment_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.payment_type: ~3 rows (aproximadamente)
DELETE FROM `payment_type`;
INSERT INTO `payment_type` (`id`, `description`, `status`) VALUES
	(1, 'Contado', 1),
	(2, 'Credito', 1),
	(3, 'Transferencia', 1);

-- Volcando estructura para tabla db_gliese.permission
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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.permission: ~48 rows (aproximadamente)
DELETE FROM `permission`;
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
	(21, 1, 18, 1),
	(22, 1, 2, 1),
	(23, 1, 3, 1),
	(24, 1, 4, 1),
	(25, 1, 5, 1),
	(26, 1, 19, 1),
	(27, 1, 20, 1),
	(28, 1, 21, 1),
	(29, 1, 22, 1),
	(30, 1, 23, 1),
	(31, 1, 24, 1),
	(32, 5, 1, 1),
	(33, 5, 2, 1),
	(34, 5, 3, 1),
	(35, 5, 4, 1),
	(36, 5, 19, 1),
	(37, 5, 20, 1),
	(38, 5, 21, 1),
	(39, 5, 5, 0),
	(40, 5, 6, 0),
	(41, 5, 7, 0),
	(42, 5, 8, 0),
	(43, 5, 9, 0),
	(44, 5, 10, 0),
	(45, 5, 11, 0),
	(46, 5, 12, 0),
	(47, 5, 13, 0),
	(48, 5, 14, 0),
	(49, 5, 15, 0),
	(50, 5, 16, 0),
	(51, 5, 17, 0),
	(52, 5, 18, 0),
	(53, 5, 22, 0),
	(54, 5, 23, 0),
	(55, 5, 24, 0);

-- Volcando estructura para tabla db_gliese.products
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
DELETE FROM `products`;
INSERT INTO `products` (`id`, `id_category`, `description`, `stock`, `code`, `status`, `expiration_date`, `status_expiration_date`, `ts_start`) VALUES
	(97, 2, 'DESC 01', 52, '01', 1, NULL, 1, 1681254999),
	(112, 3, 'DESC 02', 90, '02', 1, NULL, 1, 1681250641),
	(115, 2, 'DESC 03', 90, '03', 1, NULL, 1, 1681250783),
	(116, 3, 'DESC 04', 15, '04', 1, NULL, 1, 0),
	(117, 3, 'DESC 05', 150, '05', 1, NULL, 1, 1681249710),
	(129, 3, 'DESC 06', 60, '06', 1, NULL, 1, 1681251158),
	(130, 3, 'DESC 07', 70, '07', 1, NULL, 1, 0),
	(131, 2, 'DESC 08', 15, '08', 1, NULL, 1, 1681251540);

-- Volcando estructura para tabla db_gliese.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `checkin_date` date NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_date` date NOT NULL,
  `checkout_time` time NOT NULL,
  `id_room` int NOT NULL,
  `id_guest` int NOT NULL,
  `payment_room` decimal(10,2) DEFAULT NULL,
  `payment_sales` decimal(10,2) DEFAULT NULL,
  `payment_extra` decimal(10,2) DEFAULT NULL,
  `payment_all` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_room` (`id_room`),
  KEY `id_guest` (`id_guest`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_guest`) REFERENCES `guest` (`id_guest`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.reservation: ~11 rows (aproximadamente)
DELETE FROM `reservation`;
INSERT INTO `reservation` (`id_reservation`, `checkin_date`, `checkin_time`, `checkout_date`, `checkout_time`, `id_room`, `id_guest`, `payment_room`, `payment_sales`, `payment_extra`, `payment_all`) VALUES
	(8, '2023-10-10', '06:06:00', '2023-10-19', '18:07:00', 25, 16, 60.00, NULL, NULL, 60.00),
	(9, '2023-10-06', '05:37:00', '2023-10-11', '05:37:00', 4, 16, 60.00, NULL, NULL, 60.00),
	(10, '2023-10-19', '07:00:00', '2023-10-19', '11:00:00', 2, 108, 30.00, NULL, NULL, 30.00),
	(11, '2023-10-19', '10:00:00', '2023-10-19', '01:00:00', 8, 2, 90.00, NULL, NULL, 90.00),
	(12, '2023-10-19', '10:00:00', '2023-10-19', '12:00:00', 6, 4, 90.00, NULL, NULL, NULL),
	(13, '2023-10-19', '12:00:00', '2023-10-19', '15:00:00', 1, 2, 30.00, NULL, NULL, NULL),
	(14, '2023-10-19', '12:00:00', '2023-10-19', '15:00:00', 2, 108, 40.00, NULL, NULL, NULL),
	(15, '2023-10-20', '05:00:00', '2023-10-21', '11:00:00', 3, 11, 210.00, NULL, NULL, NULL),
	(16, '2023-10-19', '19:00:00', '2023-10-19', '12:00:00', 5, 15, 50.00, NULL, NULL, NULL),
	(17, '2023-10-21', '10:00:00', '2023-10-21', '17:00:00', 7, 121, 50.00, NULL, NULL, NULL),
	(18, '2023-10-24', '05:30:00', '2023-10-26', '10:00:00', 4, 112, 170.00, NULL, NULL, NULL);

-- Volcando estructura para tabla db_gliese.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.role: ~2 rows (aproximadamente)
DELETE FROM `role`;
INSERT INTO `role` (`id`, `description`, `status`) VALUES
	(1, 'ADMINISTRADOR', 1),
	(5, 'EMPLEADO', 1);

-- Volcando estructura para tabla db_gliese.room
CREATE TABLE IF NOT EXISTS `room` (
  `id_room` int NOT NULL AUTO_INCREMENT,
  `room_number` varchar(50) NOT NULL,
  `room_status` varchar(50) NOT NULL,
  `id_type` int NOT NULL,
  PRIMARY KEY (`id_room`),
  UNIQUE KEY `room_number` (`room_number`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `room_type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.room: ~13 rows (aproximadamente)
DELETE FROM `room`;
INSERT INTO `room` (`id_room`, `room_number`, `room_status`, `id_type`) VALUES
	(1, '01', 'Ocupado', 1),
	(2, '02', 'Ocupado', 2),
	(3, '03', 'Reservado', 3),
	(4, '04', 'Reservado', 2),
	(5, '05', 'Reservado', 3),
	(6, '06', 'Disponible', 1),
	(7, '07', 'Reservado', 2),
	(8, '08', 'Disponible', 3),
	(9, '09', 'Disponible', 2),
	(10, '10', 'Disponible', 1),
	(11, '11', 'Disponible', 1),
	(12, '12', 'Disponible', 3),
	(25, '13', 'Disponible', 5);

-- Volcando estructura para tabla db_gliese.room_type
CREATE TABLE IF NOT EXISTS `room_type` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  `person_limit` int NOT NULL,
  `price_temporary` decimal(10,2) NOT NULL,
  `price_half` decimal(10,2) NOT NULL,
  `price_day` decimal(10,2) NOT NULL,
  `bed_type` varchar(150) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.room_type: ~6 rows (aproximadamente)
DELETE FROM `room_type`;
INSERT INTO `room_type` (`id_type`, `type_name`, `person_limit`, `price_temporary`, `price_half`, `price_day`, `bed_type`) VALUES
	(1, 'Simple', 2, 30.00, 40.00, 50.00, '1 x Dos plazas'),
	(2, 'Doble', 4, 40.00, 50.00, 60.00, '2 x Dos plazas'),
	(3, 'Triple', 6, 50.00, 90.00, 120.00, '2 x Dos plazas, 1 Plaza y media'),
	(4, 'Simple', 2, 30.00, 40.00, 50.00, '1 x Dos plazas'),
	(5, 'Doble', 4, 40.00, 50.00, 60.00, '2 x Dos plazas'),
	(6, 'Triple', 6, 50.00, 90.00, 120.00, '2 x Dos plazas, 1 Plaza y media');

-- Volcando estructura para tabla db_gliese.sales_accesory
CREATE TABLE IF NOT EXISTS `sales_accesory` (
  `id_venta_ac` int NOT NULL AUTO_INCREMENT,
  `id_accesory` int NOT NULL,
  `amount_ac` int NOT NULL,
  `price_sales_ac` decimal(10,2) NOT NULL,
  `id_reservation` int NOT NULL,
  PRIMARY KEY (`id_venta_ac`),
  KEY `id_accesory` (`id_accesory`),
  KEY `id_reservation` (`id_reservation`),
  CONSTRAINT `sales_accesory_ibfk_1` FOREIGN KEY (`id_accesory`) REFERENCES `accessory` (`id_accesory`),
  CONSTRAINT `sales_accesory_ibfk_2` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.sales_accesory: ~0 rows (aproximadamente)
DELETE FROM `sales_accesory`;

-- Volcando estructura para tabla db_gliese.sales_food
CREATE TABLE IF NOT EXISTS `sales_food` (
  `id_venta_fo` int NOT NULL AUTO_INCREMENT,
  `id_food` int NOT NULL,
  `amount_fd` int NOT NULL,
  `price_sales_fd` decimal(10,2) NOT NULL,
  `id_reservation` int NOT NULL,
  PRIMARY KEY (`id_venta_fo`),
  KEY `id_food` (`id_food`),
  KEY `id_reservation` (`id_reservation`),
  CONSTRAINT `sales_food_ibfk_1` FOREIGN KEY (`id_food`) REFERENCES `food` (`id_food`),
  CONSTRAINT `sales_food_ibfk_2` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla db_gliese.sales_food: ~0 rows (aproximadamente)
DELETE FROM `sales_food`;

-- Volcando estructura para tabla db_gliese.sub_menu
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.sub_menu: ~24 rows (aproximadamente)
DELETE FROM `sub_menu`;
INSERT INTO `sub_menu` (`id`, `id_menu`, `description`, `icon`, `url`, `order`) VALUES
	(1, 1, 'Reserva', 'circle', 'Reservation', 2),
	(2, 1, 'Recepción', 'circle', 'Reception', 3),
	(3, 2, 'Accesorios', 'circle', 'Accessories', 1),
	(4, 2, 'Alimentos', 'circle', 'Food', 2),
	(5, 2, 'Lista de ventas', 'circle', 'Saleslist', 3),
	(6, 2, 'Reabastecer', 'circle', 'Restock', 4),
	(7, 3, 'Apertura inicial', 'circle', 'Openingcash', 1),
	(8, 3, 'Cierre de caja', 'circle', 'Closingcash', 2),
	(9, 3, 'Lista de caja', 'circle', 'Cashlist', 3),
	(10, 4, 'Ingresos', 'circle', 'Incomes', 1),
	(11, 4, 'Egresos', 'circle', 'Expenses', 2),
	(12, 5, 'Registrar', 'circle', 'Register', 1),
	(13, 5, 'Registro', 'circle', 'Record', 2),
	(14, 6, 'Reporte de cliente', 'circle', 'Customer_report', 1),
	(15, 6, 'Reporte mensual', 'circle', 'Monthlyreport', 2),
	(16, 6, 'Reporte de facturas', 'circle', 'Invoicereport', 3),
	(17, 6, 'Reporte de caja', 'circle', 'Cashreport', 4),
	(18, 6, 'Reporte de estado de habitación', 'circle', 'Roomreport', 5),
	(19, 7, 'Tipo habitación', 'circle', 'Roomtype', 1),
	(20, 7, 'Habitaciones', 'circle', 'Rooms', 2),
	(21, 7, 'Tarifas', 'circle', 'Rates', 3),
	(22, 8, 'Usuarios', 'circle', 'Users', 1),
	(23, 8, 'Roles', 'circle', 'Roles', 2),
	(24, 8, 'Sedes', 'circle', 'Campus', 3);

-- Volcando estructura para tabla db_gliese.supplier
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
DELETE FROM `supplier`;
INSERT INTO `supplier` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `business_name`, `email`, `status`) VALUES
	(1, 1, 'ALEXANDER', '71695889', 'lopez de zuñiga', '915959584', 'R&amp;J ACTION', 'generateindollars@gmail.com', 1),
	(3, 1, 'JEREMI', '72003664', 'Av 1 de mayo', '936672334', 'J&amp;amp;D ACTION', 'jeregr.21042002@gmail.com12', 1),
	(4, 1, 'RUBEN DARIO', '721368235', 'Chancay Lopez 04', '987975591', 'R&amp;R ACTION', 'rubendario7tu@gmail.com', 1),
	(5, 1, 'JEREMI ARMANDO GONZALES RUEDA', '7', 'Av 1 de mayo', '8', 'J&amp;D ACTION ', 'jeregr.21042002@gmail.com', 1);

-- Volcando estructura para tabla db_gliese.user
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.user: ~5 rows (aproximadamente)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `id_role`, `id_document_type`, `first_name`, `last_name`, `document_number`, `address`, `telephone`, `email`, `user`, `password`, `image_url`, `status`, `active`) VALUES
	(1, 1, 2, 'Diego', 'Uriarte chancafe', '12345678912', 'Chancay', '913085587', 'grjere698@gmail.com', 'admin', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(13, 1, 1, 'Jeremi', 'Gonzales', '8', 'Av. 1 de mayo 1031', '913085589', 'grjere698@gmail.com', 'admin2', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(15, 1, 1, 'Ruben', 'Dario', '12345678', 'Av. 1 de mayo 1031', '999888777', 'essaulherrerasangay601@gmail.com', 'admin3', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(18, 1, 1, 'Alex', 'Diaz', '88888', 'Calichera', '8', 'generateindollars@gmail.com12', 'admin4', 'admin', NULL, 1, 1),
	(19, 1, 1, 'Leonardo', 'Gonzales', '78945612', 'Av. 1 de mayo 1031', '987975591', 'grjere698@gmail.com', 'Leonardo', '4d47566d4e5463304d6a67774e5746695932557a5a54426a4d6d457a5a6a466b5a57517a4d7a63324e7a673d', NULL, 0, 1);

-- Volcando estructura para tabla db_gliese.user_campus
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.user_campus: ~15 rows (aproximadamente)
DELETE FROM `user_campus`;
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
CREATE TABLE IF NOT EXISTS `voucher_type` (
  `id` int NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Volcando datos para la tabla db_gliese.voucher_type: ~8 rows (aproximadamente)
DELETE FROM `voucher_type`;
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
