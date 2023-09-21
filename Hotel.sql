-- Volcando estructura de base de datos para db_gliese
CREATE DATABASE IF NOT EXISTS `db_gliese` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_gliese`;

-- Volcando estructura para tabla db_gliese.accesory
CREATE TABLE IF NOT EXISTS `accesory` (
  `id_accesory` int(11) NOT NULL AUTO_INCREMENT,
  `accesory_description` varchar(250) NOT NULL,
  `accesory_price` decimal(10,2) NOT NULL,
  `accesory_stock` int(11) NOT NULL,
  PRIMARY KEY (`id_accesory`)
);

-- Volcando datos para la tabla db_gliese.accesory: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `accesory` DISABLE KEYS */;
INSERT INTO `accesory` (`id_accesory`, `accesory_description`, `accesory_price`, `accesory_stock`) VALUES
	(1, 'Funda para teléfono', 5.00, 20),
	(2, 'Correa para reloj', 3.00, 10),
	(3, 'Llavero', 2.00, 15),
	(4, 'Monedero', 7.00, 12),
	(5, 'Gafas de sol', 10.00, 14),
	(6, 'Mochila', 20.00, 10);
/*!40000 ALTER TABLE `accesory` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.campus
CREATE TABLE IF NOT EXISTS `campus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Volcando datos para la tabla db_gliese.campus: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `campus` DISABLE KEYS */;
INSERT INTO `campus` (`id`, `description`, `status`) VALUES
	(1, 'CHANCAY', 1),
	(2, 'HUARAL', 1),
	(3, 'LIMA', 1);
/*!40000 ALTER TABLE `campus` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.carrier
CREATE TABLE IF NOT EXISTS `carrier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_document_type` int(11) NOT NULL,
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
);

-- Volcando datos para la tabla db_gliese.carrier: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `carrier` DISABLE KEYS */;
INSERT INTO `carrier` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `business_name`, `email`, `status`) VALUES
	(1, 2, 'ALEXANDER ANGEL', '75232411451', 'Asoc Santa Rosa MZ E3 Lote 9', '933430561', 'ANGEL ASOC 5050', 'alexanderdiaz78@gmail.com', 1),
	(2, 1, 'ROSANGELA ', '75418596', 'Asoc Santa Rosa Lote 15 A4', '974852142', 'ROSANGELA ASOC 7890', 'rosangelahuanilo74@gmail.com', 1),
	(3, 1, 'ALEXANDER ANGEL DIAZ GRANADOS', '78456252', 'Chancay 748', '526415748', 'ALEXANDER', 'Angel_1574858@hotmail.com', 1);
/*!40000 ALTER TABLE `carrier` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
);

-- Volcando datos para la tabla db_gliese.categories: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `description`, `status`) VALUES
	(2, 'VAMO A PROGRAMAR', 1),
	(3, 'VENDEDORGF', 1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_document_type` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `document_number` varchar(45) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `business_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_type` (`id_document_type`) USING BTREE,
  CONSTRAINT `FK_CLIENTS_DOCUMENT_TYPE` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`)
);

-- Volcando datos para la tabla db_gliese.clients: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `email`, `business_name`, `status`) VALUES
	(1, 1, 'Ruben', '72131009', 'Chancay', '987975591', 'rubengmail.com', 'RYR', 1);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.detail_income
CREATE TABLE IF NOT EXISTS `detail_income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_income` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `purchase_price` decimal(11,2) NOT NULL,
  `sale_price` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_product` (`id_product`),
  CONSTRAINT `FK_INCOME_PRODUCT` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
);

-- Volcando datos para la tabla db_gliese.detail_income: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detail_income` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_income` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.document_type
CREATE TABLE IF NOT EXISTS `document_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Volcando datos para la tabla db_gliese.document_type: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `document_type` DISABLE KEYS */;
INSERT INTO `document_type` (`id`, `description`, `status`) VALUES
	(1, 'DNI', 1),
	(2, 'RUC', 1);
/*!40000 ALTER TABLE `document_type` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.food
CREATE TABLE IF NOT EXISTS `food` (
  `id_food` int(11) NOT NULL AUTO_INCREMENT,
  `food_description` varchar(250) NOT NULL,
  `food_price` decimal(10,2) NOT NULL,
  `food_stock` int(11) NOT NULL,
  `tipo_food` varchar(250) NOT NULL,
  PRIMARY KEY (`id_food`)
);

-- Volcando datos para la tabla db_gliese.food: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` (`id_food`, `food_description`, `food_price`, `food_stock`, `tipo_food`) VALUES
	(1, 'Huevos', 1.00, 15, 'Comida'),
	(2, 'Panqueques', 3.00, 10, 'Comida'),
	(3, 'Refresco', 5.00, 20, 'Bebida'),
	(4, 'Frutas', 2.00, 23, 'Comida'),
	(5, 'Queso', 3.00, 12, 'Comida'),
	(6, 'Café', 2.00, 14, 'Bebida'),
	(7, 'Leche', 8.00, 10, 'Bebida');
/*!40000 ALTER TABLE `food` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.guest
CREATE TABLE IF NOT EXISTS `guest` (
  `id_guest` int(11) NOT NULL AUTO_INCREMENT,
  `document_type` varchar(50) NOT NULL,
  `document_number` varchar(50) NOT NULL,
  `first_names` varchar(50) NOT NULL,
  `last_names` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_guest`)
);

-- Volcando datos para la tabla db_gliese.guest: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `guest` DISABLE KEYS */;
/*!40000 ALTER TABLE `guest` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.income
CREATE TABLE IF NOT EXISTS `income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_voucher_type` int(11) NOT NULL,
  `id_payment_type` int(11) NOT NULL,
  `proof_series` varchar(7) DEFAULT NULL,
  `voucher_series` varchar(10) NOT NULL,
  `proof_date` datetime NOT NULL,
  `igv` decimal(4,2) NOT NULL,
  `number_installments` int(11) DEFAULT NULL,
  `installment_value` decimal(11,2) DEFAULT NULL,
  `full_purchase` decimal(11,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_user` (`id_user`),
  KEY `id_voucher_type` (`id_voucher_type`),
  KEY `id_payment_type` (`id_payment_type`),
  CONSTRAINT `FK_INCOME_PAYMENT_TYPE` FOREIGN KEY (`id_payment_type`) REFERENCES `payment_type` (`id`),
  CONSTRAINT `FK_INCOME_SUPPLIER` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`),
  CONSTRAINT `FK_INCOME_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_INCOME_VOUCHER_TYPE` FOREIGN KEY (`id_voucher_type`) REFERENCES `voucher_type` (`id`)
);

-- Volcando datos para la tabla db_gliese.income: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `income` DISABLE KEYS */;
INSERT INTO `income` (`id`, `id_supplier`, `id_user`, `id_voucher_type`, `id_payment_type`, `proof_series`, `voucher_series`, `proof_date`, `igv`, `number_installments`, `installment_value`, `full_purchase`, `status`) VALUES
	(1, 1, 13, 1, 1, 'B001', '00000001', '2023-03-30 21:43:58', 0.18, NULL, NULL, 100.50, '1');
/*!40000 ALTER TABLE `income` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.intent
CREATE TABLE IF NOT EXISTS `intent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  PRIMARY KEY (`id`)
);

-- Volcando datos para la tabla db_gliese.intent: ~14 rows (aproximadamente)
/*!40000 ALTER TABLE `intent` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `intent` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(80) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Volcando datos para la tabla db_gliese.menu: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `description`, `icon`, `order`) VALUES
	(1, 'Habitaciones', 'home', 1),
	(2, 'Ventas', 'shopping-cart', 2),
	(3, 'Caja', 'archive', 3),
	(4, 'Otros ingresos', 'dollar-sign', 4),
	(5, 'Mantenimiento', 'key', 5),
	(6, 'Reportes', 'clipboard', 6),
	(7, 'Configuraciones', 'settings', 7),
	(8, 'Administración', 'sliders', 8);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `total_amount` decimal(10,2) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  PRIMARY KEY (`id_payment`),
  KEY `id_reservation` (`id_reservation`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id_reservation`)
);

-- Volcando datos para la tabla db_gliese.payment: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.payment_extra
CREATE TABLE IF NOT EXISTS `payment_extra` (
  `id_extra` int(11) NOT NULL AUTO_INCREMENT,
  `extra_hours` int(11) NOT NULL,
  `price_extras` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_extra`)
);

-- Volcando datos para la tabla db_gliese.payment_extra: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `payment_extra` DISABLE KEYS */;
INSERT INTO `payment_extra` (`id_extra`, `extra_hours`, `price_extras`) VALUES
	(1, 2, 10.00),
	(2, 5, 20.00),
	(3, 6, 30.00),
	(4, 10, 50.00);
/*!40000 ALTER TABLE `payment_extra` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.payment_type
CREATE TABLE IF NOT EXISTS `payment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Volcando datos para la tabla db_gliese.payment_type: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `payment_type` DISABLE KEYS */;
INSERT INTO `payment_type` (`id`, `description`, `status`) VALUES
	(1, 'Contado', 1),
	(2, 'Credito', 1),
	(3, 'Transferencia', 1);


CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_sub_menu` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_PERMISSION_ROLE` (`id_role`),
  KEY `FK_PERMISSION_SUB_MENU` (`id_sub_menu`),
  CONSTRAINT `FK_PERMISSION_ROLE` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_PERMISSION_SUB_MENU` FOREIGN KEY (`id_sub_menu`) REFERENCES `sub_menu` (`id`) ON DELETE CASCADE
);


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
	(31, 1, 24, 1);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `expiration_date` int(11) DEFAULT NULL,
  `status_expiration_date` tinyint(1) NOT NULL DEFAULT '1',
  `ts_start` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `description` (`description`),
  UNIQUE KEY `code` (`code`),
  KEY `id_categories` (`id_category`) USING BTREE,
  CONSTRAINT `FK_PRODUCTS_CATEGORIES` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`)
);

-- Volcando datos para la tabla db_gliese.products: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `id_category`, `description`, `stock`, `code`, `status`, `expiration_date`, `status_expiration_date`, `ts_start`) VALUES
	(97, 2, 'DESC 01', 52, '01', 1, NULL, 1, 1681254999),
	(112, 3, 'DESC 02', 90, '02', 1, NULL, 1, 1681250641),
	(115, 2, 'DESC 03', 90, '03', 1, NULL, 1, 1681250783),
	(116, 3, 'DESC 04', 15, '04', 1, NULL, 1, 0),
	(117, 3, 'DESC 05', 150, '05', 1, NULL, 1, 1681249710),
	(129, 3, 'DESC 06', 60, '06', 1, NULL, 1, 1681251158),
	(130, 3, 'DESC 07', 70, '07', 1, NULL, 1, 0),
	(131, 2, 'DESC 08', 15, '08', 1, NULL, 1, 1681251540);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.reservation
CREATE TABLE IF NOT EXISTS `reservation` (
  `id_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `id_room` int(11) NOT NULL,
  `id_guest` int(11) NOT NULL,
  `id_venta_ac` int(11) DEFAULT NULL,
  `id_venta_fo` int(11) DEFAULT NULL,
  `id_extra` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_room` (`id_room`),
  KEY `id_guest` (`id_guest`),
  KEY `id_venta_ac` (`id_venta_ac`),
  KEY `id_venta_fo` (`id_venta_fo`),
  KEY `id_extra` (`id_extra`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`),
  CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_guest`) REFERENCES `guest` (`id_guest`),
  CONSTRAINT `reservation_ibfk_3` FOREIGN KEY (`id_venta_ac`) REFERENCES `venta_accesory` (`id_venta_ac`),
  CONSTRAINT `reservation_ibfk_4` FOREIGN KEY (`id_venta_fo`) REFERENCES `venta_food` (`id_venta_fo`),
  CONSTRAINT `reservation_ibfk_5` FOREIGN KEY (`id_extra`) REFERENCES `payment_extra` (`id_extra`)
);

-- Volcando datos para la tabla db_gliese.reservation: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Volcando datos para la tabla db_gliese.role: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `description`, `status`) VALUES
	(1, 'ADMINISTRADOR', 1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.room
CREATE TABLE IF NOT EXISTS `room` (
  `id_room` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` varchar(50) NOT NULL,
  `room_status` varchar(50) NOT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id_room`),
  UNIQUE KEY `room_number` (`room_number`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `room_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `room_type` (`id_type`)
);

-- Volcando datos para la tabla db_gliese.room: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
INSERT INTO `room` (`id_room`, `room_number`, `room_status`, `id_type`) VALUES
	(1, '01',  'Disponible', 1),
	(2, '02',  'Disponible', 2),
	(3, '03', 'Disponible', 3),
	(4, '04', 'Disponible', 2),
	(5, '05',  'Disponible', 3),
	(6, '06', 'Disponible', 1),
	(7, '07', 'Disponible', 2),
	(8, '08', 'Disponible', 3),
	(9, '09',  'Disponible', 2),
	(10, '10',  'Disponible', 1),
	(11, '11',  'Disponible', 1),
	(12, '12',  'Disponible', 3);
/*!40000 ALTER TABLE `room` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.room_type
CREATE TABLE IF NOT EXISTS `room_type` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  `bed_type` varchar(250) NOT NULL,
  `person_limit` int(11) NOT NULL,
  `price_temporary` decimal(10,2) NOT NULL,
  `price_half` decimal(10,2) NOT NULL,
  `price_day` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_type`)
);

-- Volcando datos para la tabla db_gliese.room_type: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `room_type` DISABLE KEYS */;
INSERT INTO `room_type` (`id_type`, `type_name`,  `bed_type`,`person_limit`, `price_temporary`, `price_half`, `price_day`) VALUES
	(1, 'Simple','1 x Dos plazas' ,2,  30.00, 40.00, 50.00),
	(2, 'Doble','2 x Dos plazas' ,4,  40.00, 50.00, 60.00),
	(3, 'Triple', '2 x Dos plazas, 1 Plaza y media',6, 50.00, 90.00, 120.00);
/*!40000 ALTER TABLE `room_type` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.sub_menu
CREATE TABLE IF NOT EXISTS `sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `url` varchar(80) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_SUB_MENU_MENU` (`id_menu`),
  CONSTRAINT `FK_SUB_MENU_MENU` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE
);

-- Volcando datos para la tabla db_gliese.sub_menu: ~24 rows (aproximadamente)
/*!40000 ALTER TABLE `sub_menu` DISABLE KEYS */;
INSERT INTO `sub_menu` (`id`, `id_menu`, `description`, `icon`, `url`, `order`) VALUES
	(1, 1, 'Reserva', 'circle', 'Reservation', 2),
	(2, 1, 'Recepción', 'circle', 'Reception', 3),
	(3, 2, 'Accesorios', 'circle', 'Accessories', 1),
	(4, 2, 'Alimentos', 'circle', 'Food', 2),
	(5, 2, 'Lista de ventas', 'circle', 'Sales_list', 3),
	(6, 2, 'Reabastecer', 'circle', 'Restock', 4),
	(7, 3, 'Apertura inicial', 'circle', 'Opening_cash', 1),
	(8, 3, 'Cierre de caja', 'circle', 'Closing_cash', 2),
	(9, 3, 'Lista de caja', 'circle', 'Cash_list', 3),
	(10, 4, 'Ingresos', 'circle', 'Incomes', 1),
	(11, 4, 'Egresos', 'circle', 'Expenses', 2),
	(12, 5, 'Registrar', 'circle', 'Register', 1),
	(13, 5, 'Registro', 'circle', 'Record', 2),
	(14, 6, 'Reporte de cliente', 'circle', 'Customer_report', 1),
	(15, 6, 'Reporte mensual', 'circle', 'Monthly_report', 2),
	(16, 6, 'Reporte de facturas', 'circle', 'Invoice_report', 3),
	(17, 6, 'Reporte de caja', 'circle', 'Cash_report', 4),
	(18, 6, 'Reporte de estado de habitación', 'circle', 'Room_report', 5),
	(19, 7, 'Habitaciones', 'circle', 'Rooms', 1),
	(20, 7, 'Categorías', 'circle', 'Categories', 2),
	(21, 7, 'Tarifas', 'circle', 'Rates', 3),
	(22, 8, 'Usuarios', 'circle', 'Users', 1),
	(23, 8, 'Roles', 'circle', 'Roles', 2),
	(24, 8, 'Sedes', 'circle', 'Campus', 3);
/*!40000 ALTER TABLE `sub_menu` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_document_type` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `document_number` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `business_name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `document_number` (`document_number`),
  KEY `id_document_type` (`id_document_type`),
  CONSTRAINT `FK_SUPPLIER_DOCUMENT_TYPE` FOREIGN KEY (`id_document_type`) REFERENCES `document_type` (`id`)
);

-- Volcando datos para la tabla db_gliese.supplier: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id`, `id_document_type`, `name`, `document_number`, `address`, `phone`, `business_name`, `email`, `status`) VALUES
	(1, 1, 'ALEXANDER', '71695889', 'lopez de zuñiga', '915959584', 'R&amp;J ACTION', 'generateindollars@gmail.com', 1),
	(3, 1, 'JEREMI', '72003664', 'Av 1 de mayo', '936672334', 'J&amp;amp;D ACTION', 'jeregr.21042002@gmail.com12', 1),
	(4, 1, 'RUBEN DARIO', '721368235', 'Chancay Lopez 04', '987975591', 'R&amp;R ACTION', 'rubendario7tu@gmail.com', 1),
	(5, 1, 'JEREMI ARMANDO GONZALES RUEDA', '7', 'Av 1 de mayo', '8', 'J&amp;D ACTION ', 'jeregr.21042002@gmail.com', 1);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_document_type` int(11) NOT NULL,
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
);

-- Volcando datos para la tabla db_gliese.user: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `id_role`, `id_document_type`, `first_name`, `last_name`, `document_number`, `address`, `telephone`, `email`, `user`, `password`, `image_url`, `status`, `active`) VALUES
	(1, 1, 2, 'Diego', 'Uriarte chancafe', '12345678912', 'Chancay', '913085587', 'grjere698@gmail.com', 'admin', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(13, 1, 1, 'Jeremi', 'Gonzales', '8', 'Av. 1 de mayo 1031', '913085589', 'grjere698@gmail.com', 'admin2', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(15, 1, 1, 'Ruben', 'Dario', '12345678', 'Av. 1 de mayo 1031', '999888777', 'essaulherrerasangay601@gmail.com', 'admin3', '5a6d4d35597a41334e6a4a6a5a4459784d7a51355a6a457a596d593159324d7a597a566d4d5445784e7a633d', NULL, 1, 1),
	(18, 1, 1, 'Alex', 'Diaz', '88888', 'Calichera', '8', 'generateindollars@gmail.com12', 'admin4', 'admin', NULL, 1, 1),
	(19, 1, 1, 'Leonardo', 'Gonzales', '78945612', 'Av. 1 de mayo 1031', '987975591', 'grjere698@gmail.com', 'Leonardo', '4d47566d4e5463304d6a67774e5746695932557a5a54426a4d6d457a5a6a466b5a57517a4d7a63324e7a673d', NULL, 0, 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.user_campus
CREATE TABLE IF NOT EXISTS `user_campus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_campus` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_USER_CAMPUS_CAMPUS` (`id_campus`),
  KEY `FK_USER_CAMPUS_USER` (`id_user`),
  CONSTRAINT `FK_USER_CAMPUS_CAMPUS` FOREIGN KEY (`id_campus`) REFERENCES `campus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_USER_CAMPUS_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE
);

-- Volcando datos para la tabla db_gliese.user_campus: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `user_campus` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `user_campus` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.venta_accesory
CREATE TABLE IF NOT EXISTS `venta_accesory` (
  `id_venta_ac` int(11) NOT NULL AUTO_INCREMENT,
  `id_accesory` int(11) NOT NULL,
  `venta_cantidad` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  PRIMARY KEY (`id_venta_ac`),
  KEY `id_accesory` (`id_accesory`),
  KEY `id_room` (`id_room`),
  CONSTRAINT `venta_accesory_ibfk_1` FOREIGN KEY (`id_accesory`) REFERENCES `accesory` (`id_accesory`),
  CONSTRAINT `venta_accesory_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`)
);

-- Volcando datos para la tabla db_gliese.venta_accesory: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `venta_accesory` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_accesory` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.venta_food
CREATE TABLE IF NOT EXISTS `venta_food` (
  `id_venta_fo` int(11) NOT NULL AUTO_INCREMENT,
  `id_food` int(11) NOT NULL,
  `venta_cantidad` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  PRIMARY KEY (`id_venta_fo`),
  KEY `id_food` (`id_food`),
  KEY `id_room` (`id_room`),
  CONSTRAINT `venta_food_ibfk_1` FOREIGN KEY (`id_food`) REFERENCES `food` (`id_food`),
  CONSTRAINT `venta_food_ibfk_2` FOREIGN KEY (`id_room`) REFERENCES `room` (`id_room`)
);

-- Volcando datos para la tabla db_gliese.venta_food: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `venta_food` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta_food` ENABLE KEYS */;

-- Volcando estructura para tabla db_gliese.voucher_type
CREATE TABLE IF NOT EXISTS `voucher_type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
);

-- Volcando datos para la tabla db_gliese.voucher_type: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `voucher_type` DISABLE KEYS */;
INSERT INTO `voucher_type` (`id`, `description`, `status`) VALUES
	(1, 'Factura', 1),
	(2, 'Boleta de Venta', 1),
	(3, 'Nota de Credito', 1),
	(4, 'Guia de Remisión Remitente', 1),
	(5, 'Cotización', 1),
	(6, 'Orden de Pagos', 1),
	(7, 'Ticket', 1),
	(8, 'Prestamo', 1);
/*!40000 ALTER TABLE `voucher_type` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
