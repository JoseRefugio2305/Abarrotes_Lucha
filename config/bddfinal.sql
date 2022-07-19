-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para la_tiendita
CREATE DATABASE IF NOT EXISTS `la_tiendita` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `la_tiendita`;


-- Volcando estructura para tabla la_tiendita.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL,
  `is_active` varchar(1) DEFAULT '1',
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla la_tiendita.rol: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`id_rol`, `nombre_rol`, `is_active`) VALUES
	(1, 'Administrador', '1'),
	(2, 'Cliente', '1'),
	(3, 'Cajero', '1');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

-- Volcando estructura para tabla la_tiendita.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL DEFAULT 'Desconocido',
  `ap_pat` varchar(100) NOT NULL DEFAULT 'Desconocido',
  `ap_mat` varchar(100) NOT NULL DEFAULT 'Desconocido',
  `user_name` varchar(100) NOT NULL DEFAULT 'Desconocido',
  `email` varchar(150) NOT NULL DEFAULT 'Desconocido',
  `password` varchar(100) NOT NULL DEFAULT 'Desconocido',
  `user_rol` int(11) NOT NULL DEFAULT '2',
  `is_active` varchar(1) DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  KEY `rol` (`user_rol`),
  CONSTRAINT `rol` FOREIGN KEY (`user_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla la_tiendita.usuarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `ap_pat`, `ap_mat`, `user_name`, `email`, `password`, `user_rol`, `is_active`) VALUES
	(1, 'Administrador', 'Rivera', 'Mendoza', 'admin', 'admin@mail.com', '123456', 1, '1'),
	(2, 'Refugio', 'Rivera', 'Mendoza', 'refu', 'refu@mail.com', '123456', 3, '1'),
	(3, 'Cliente', 'Desconocido', 'Desconocido', 'cliente', 'cliente@mail.com', '123456', 2, '0'),
	(4, 'MarÃ­a', 'Mendoza', 'Puente', 'mariapuente', 'maria@mail.com', '123456', 2, '1'),
	(5, 'Ruben', 'Coronado', '', 'mb', 'ruben@gmail.com', '123456', 2, '1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
-- Volcando estructura para tabla la_tiendita.comentarios
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id_com` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT 'Desconocido',
  `apellidos` varchar(50) NOT NULL DEFAULT 'Desconocido',
  `email` varchar(50) NOT NULL DEFAULT 'Desconocido',
  `asunto` varchar(50) DEFAULT 'Desconocido',
  `comentario` text,
  `fecha_com` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla la_tiendita.comentarios: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` (`id_com`, `nombre`, `apellidos`, `email`, `asunto`, `comentario`, `fecha_com`) VALUES
	(1, 'Mario', 'Mendoza', 'mario@mail.com', 'Comentario', 'Es muy buena tienda encuentras de todo', '2022-05-15 20:11:33'),
	(2, 'Jorge', 'Rivera', 'jorge@mail.com', 'Desconocido', 'Encuentras de todo', '2022-05-15 20:21:21'),
	(3, 'Refugio', 'Rivera Mendoza', 'refugio@mail.com', 'Te cambia la vida', 'Es buena tienda, me cambio la vida', '2022-05-15 20:22:08'),
	(4, 'Maria', 'Mendoza', 'maria@mail.com', 'Buena tienda', 'Es buena tienda, tiene buenos precios y muchos prductos', '2022-05-15 20:29:20');
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;

-- Volcando estructura para tabla la_tiendita.compra
CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `sale_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` double DEFAULT '0',
  `is_pend` varchar(1) DEFAULT '0',
  `pdf_ticket` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `FKUSER` (`id_user`),
  CONSTRAINT `FKUSER` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla la_tiendita.compra: ~31 rows (aproximadamente)
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
INSERT INTO `compra` (`id_compra`, `id_user`, `sale_date`, `total`, `is_pend`, `pdf_ticket`) VALUES
	(20, 1, '2022-06-02 21:29:45', 2.5, '1', '../../Tickets/ventas20.pdf'),
	(31, 1, '2022-06-02 21:45:14', 2695, '1', '../../Tickets/ventas31.pdf'),
	(32, 1, '2022-06-02 21:51:33', 20, '1', '../../Tickets/ventas32.pdf'),
	(33, 1, '2022-06-03 11:46:01', 6929, '1', '../../Tickets/ventas33.pdf'),
	(43, 1, '2022-06-03 21:22:37', 37, '1', '../../Tickets/ventas43.pdf'),
	(45, 1, '2022-06-03 21:49:14', 20, '1', '../../Tickets/ventas45.pdf'),
	(46, 1, '2022-06-04 13:56:18', 299, '1', '../../Tickets/ventas46.pdf'),
	(47, 1, '2022-06-04 13:56:48', 14, '1', '../../Tickets/ventas47.pdf'),
	(48, 1, '2022-06-04 14:00:35', 14.5, '1', '../../Tickets/ventas48.pdf'),
	(49, 1, '2022-06-04 14:48:04', 215, '1', '../../Tickets/ventas49.pdf'),
	(53, 1, '2022-06-04 20:55:39', 22.5, '1', '../../Tickets/ventas53.pdf'),
	(54, 1, '2022-06-05 14:15:30', 270, '1', '../../Tickets/ventas54.pdf'),
	(55, 1, '2022-06-05 14:30:07', 241, '1', '../../Tickets/ventas55.pdf'),
	(56, 1, '2022-06-05 15:02:33', 13820, '1', '../../Tickets/ventas56.pdf'),
	(57, 1, '2022-06-05 15:04:54', 252, '1', '../../Tickets/ventas57.pdf'),
	(58, 1, '2022-06-05 15:07:07', 14970, '1', '../../Tickets/ventas58.pdf'),
	(59, 1, '2022-06-05 20:01:21', 15, '1', '../../Tickets/ventas59.pdf'),
	(61, 1, '2022-06-05 20:03:17', 15, '1', '../../Tickets/ventas61.pdf'),
	(62, 1, '2022-06-07 09:30:30', 801, '1', '../../Tickets/ventas62.pdf'),
	(63, 1, '2022-06-07 09:34:02', 442, '1', '../../Tickets/ventas63.pdf'),
	(64, 1, '2022-06-07 09:35:02', 210, '1', '../../Tickets/ventas64.pdf'),
	(65, 1, '2022-06-07 10:50:21', 75, '1', '../../Tickets/ventas65.pdf'),
	(66, 1, '2022-06-07 10:58:23', 253, '1', '../../Tickets/ventas66.pdf'),
	(68, 1, '2022-06-07 11:09:15', 180, '1', '../../Tickets/ventas68.pdf'),
	(71, 1, '2022-06-08 20:09:04', 360, '1', '../../Tickets/ventas71.pdf'),
	(72, 1, '2022-06-08 20:15:06', 15, '1', '../../Tickets/ventas72.pdf'),
	(73, 1, '2022-06-09 10:37:44', 519, '1', '../../Tickets/ventas73.pdf'),
	(74, 1, '2022-06-09 10:39:19', 180, '1', '../../Tickets/ventas74.pdf'),
	(75, 1, '2022-06-09 10:40:00', 15, '1', '../../Tickets/ventas75.pdf'),
	(76, 1, '2022-06-09 10:41:21', 29.4, '1', '../../Tickets/ventas76.pdf'),
	(77, 1, '2022-06-09 10:41:56', 14000, '1', '../../Tickets/ventas77.pdf');
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;

-- Volcando estructura para tabla la_tiendita.p_categoria
CREATE TABLE IF NOT EXISTS `p_categoria` (
  `id_cat` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cat` varchar(100) DEFAULT 'Desconocido',
  `desc_cat` varchar(252) DEFAULT 'Sin descripción',
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla la_tiendita.p_categoria: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `p_categoria` DISABLE KEYS */;
INSERT INTO `p_categoria` (`id_cat`, `nombre_cat`, `desc_cat`) VALUES
	(1, 'Frutas y Verduras', 'Estas son las frutas y verduras'),
	(2, 'LÃ¡cteos', 'LÃ¡cteos'),
	(3, 'Despensa', 'Despensa'),
	(4, 'Golosinas', 'Golosinas'),
	(5, 'Farmacia', 'Medicamentos');
/*!40000 ALTER TABLE `p_categoria` ENABLE KEYS */;

-- Volcando estructura para tabla la_tiendita.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pr` varchar(100) DEFAULT 'Desconocido',
  `desc_pr` varchar(252) DEFAULT 'Sin descripción',
  `stock` double DEFAULT '0',
  `url_img` varchar(512) DEFAULT 'img/no_image.png',
  `precio_compra` double DEFAULT NULL,
  `precio_uni` double DEFAULT '0',
  `descuento` double DEFAULT '0',
  `id_cat` int(11) NOT NULL,
  `fecha_add` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_active` char(1) DEFAULT '1',
  PRIMARY KEY (`id_product`),
  KEY `FK_Categoria` (`id_cat`),
  CONSTRAINT `FK_Categoria` FOREIGN KEY (`id_cat`) REFERENCES `p_categoria` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla la_tiendita.productos: ~33 rows (aproximadamente)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id_product`, `nombre_pr`, `desc_pr`, `stock`, `url_img`, `precio_compra`, `precio_uni`, `descuento`, `id_cat`, `fecha_add`, `is_active`) VALUES
	(1, 'PiÃ±a', 'Es una fruta', 794, 'img/product-2.jpg', 27, 30, 0.02, 1, '2022-05-15 14:19:04', '1'),
	(2, 'Tomate Fresco', 'Sin descripciÃ³n', 995, 'img/product-1.jpg', 15, 20, 0, 1, '2022-05-15 14:19:04', '1'),
	(3, 'Chile Serrano', 'Sin descripciÃ³n', 1000, 'img/product-3.jpg', 20, 25, 0, 1, '2022-05-15 14:19:04', '1'),
	(4, 'Fresas', 'Sin descripciÃ³n', 1000, 'img/product-4.jpg', 28, 30, 0, 1, '2022-05-15 14:19:04', '1'),
	(5, 'Pepino', 'Sin descripciÃ³n', 950, 'img/product-5.jpg', 33.5, 40, 0, 1, '2022-05-15 14:19:04', '1'),
	(6, 'Jitomate', 'Sin descripciÃ³n', 1000, 'img/product-6.jpg', 24, 27.9, 0.1, 1, '2022-05-15 14:19:04', '1'),
	(7, 'Papa', 'Sin descripciÃ³n', 1000, 'img/product-7.jpg', 15, 19.85, 0, 1, '2022-05-15 14:19:04', '1'),
	(8, 'Platano', 'Sin descripciÃ³n', 1000, 'img/product-8.jpg', 20, 24.3, 0.1, 1, '2022-05-15 14:19:04', '1'),
	(9, 'Leche Lala 1.89L', 'Sin descripciÃ³n', 988, 'img/lalap1.jpg', 19, 21, 0, 2, '2022-05-15 14:21:20', '1'),
	(10, 'Queso Piladelphia 90g', 'El queso philadelphia', 998, 'img/quesophip2.png', 10, 14.5, 0, 2, '2022-05-15 14:27:40', '1'),
	(11, 'Chocolala 500ml', 'Sin descripciÃ³n', 983, 'img/chocolalap3.jpg', 14, 15, 0, 2, '2022-05-15 14:28:12', '1'),
	(12, 'Nutrileche 1L', 'Sin descripciÃ³n', 999, 'img/nutrilechep4.jpg', 18, 20, 0, 2, '2022-05-15 14:28:44', '1'),
	(13, 'Mantequilla 90g', 'Sin descripciÃ³n', 987, 'img/matequillap5.jpg', 10, 12, 0, 2, '2022-05-15 14:29:18', '1'),
	(14, 'Yoghurt Lala Batido Fresa 120g', 'Sin descripciÃ³n', 947, 'img/yoghurtlalap6.jpg', 16, 17, 0, 2, '2022-05-15 14:29:43', '1'),
	(15, 'Leche Lala Deslactosada 1 L', 'Sin descripciÃ³n', 984, 'img/laladeslactoadap7.jpg', 20, 23, 0, 2, '2022-05-15 14:30:11', '1'),
	(16, 'Danonino', 'Sin descripciÃ³n', 1000, 'img/danoninop8.jpg', 8.34, 10, 0, 2, '2022-05-15 14:31:38', '1'),
	(17, 'Sabritas', 'Sin descripciÃ³n', 0, 'img/sabritasp1.jpg', 11, 14, 0, 4, '2022-05-15 14:32:31', '1'),
	(18, 'Gansito', 'Sin descripciÃ³n', 877, 'img/gansitop2.jpg', 9.9, 12, 0, 4, '2022-05-15 14:32:56', '1'),
	(19, 'Donitas Bimbo', 'Sin descripciÃ³n', 1000, 'img/donitasp3.jpg', 6.8, 10, 0, 4, '2022-05-15 14:33:24', '1'),
	(20, 'Refresco Coca Cola de 355 ml', 'Sin descripciÃ³n', 1000, 'img/cocap4.jpg', 10, 12.7, 0, 4, '2022-05-15 14:33:55', '1'),
	(21, 'Pepsi 600ml', 'Sin descripciÃ³n', 1000, 'img/pepsip5.png', 10, 13.5, 0, 4, '2022-05-15 14:34:21', '1'),
	(22, 'Tostileo Leo', 'Sin descripciÃ³n', 988, 'img/tostileop6.jpg', 12, 14, 0, 4, '2022-05-15 14:34:50', '1'),
	(23, 'Submarinos Fresa', 'Sin descripciÃ³n', 976, 'img/submarinosp7.jpg', 16, 18, 0, 4, '2022-05-15 14:35:30', '1'),
	(24, 'Paketaxo', 'Sin descripciÃ³n', 985, 'img/paketaxop8.jpg', 10, 15, 0, 4, '2022-05-15 14:36:01', '1'),
	(25, 'Cereales Kellogs', 'Sin descripciÃ³n', 988, 'img/kellogsp1.png', 17, 18, 0, 3, '2022-05-15 14:36:52', '1'),
	(26, 'Huevo', 'Sin descripciÃ³n', 1000, 'img/huevosp2.jpg', 27.5, 30, 0.1, 3, '2022-05-15 14:37:15', '1'),
	(27, 'AtÃºn', 'Sin descripciÃ³n', 955, 'img/atunp3.jpg', 11, 13, 0, 3, '2022-05-15 14:38:23', '1'),
	(28, 'Aceite Vegetal 1 2 3 1L', 'Sin descripciÃ³n', 1000, 'img/aceitep4.jpg', 27, 30, 0, 3, '2022-05-15 14:38:50', '1'),
	(29, 'Arroz 1Kg', 'Sin descripciÃ³n', 1000, 'img/arrozp.jpg', 17, 20.7, 0, 3, '2022-05-15 14:39:19', '1'),
	(30, 'Pasta Italpasta Spagehtti 400g', 'Sin descripciÃ³n', 985, 'img/italpastap6.jpg', 11, 13, 0, 3, '2022-05-15 14:40:03', '1'),
	(31, 'Lavatrastes LÃ­quido Axion LimÃ³n 750ml', 'Sin descripciÃ³n', 1000, 'img/jabonaxionp7.jpg', 22, 25, 0, 3, '2022-05-15 14:40:36', '1'),
	(32, 'Chiles JalapeÃ±os Enteros en Escabeche La CosteÃ±a 220 gr', 'Sin descripciÃ³n', 973, 'img/chilesvinagrep8.jpg', 11, 15, 0, 3, '2022-05-15 14:41:11', '1'),
	(34, 'Jeringas', 'jeringa del numero 5 ml', 150, 'img/products/p06_07_2022_03_51_31', 4, 8, 0.1, 5, '2022-06-07 10:51:31', '1');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla la_tiendita.detalles_compra
CREATE TABLE IF NOT EXISTS `detalles_compra` (
  `id_compra` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `fecha_add` datetime DEFAULT CURRENT_TIMESTAMP,
  KEY `FKCOMPRA` (`id_compra`),
  KEY `FKPRODUCTO` (`id_product`),
  CONSTRAINT `FKCOMPRA` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FKPRODUCTO` FOREIGN KEY (`id_product`) REFERENCES `productos` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla la_tiendita.detalles_compra: ~44 rows (aproximadamente)
/*!40000 ALTER TABLE `detalles_compra` DISABLE KEYS */;
INSERT INTO `detalles_compra` (`id_compra`, `id_product`, `qty`, `total`, `fecha_add`) VALUES
	(20, 2, 160, 20, '2022-06-02 21:29:45'),
	(31, 12, 124, 20, '2022-06-02 21:45:14'),
	(31, 12, 133, 2660, '2022-06-02 21:45:17'),
	(31, 24, 12, 15, '2022-06-02 21:45:21'),
	(32, 12, 15, 20, '2022-06-02 21:51:31'),
	(33, 15, 130, 23, '2022-06-03 11:45:27'),
	(33, 18, 123, 1476, '2022-06-03 11:45:34'),
	(33, 22, 12, 168, '2022-06-03 11:45:42'),
	(33, 1, 145, 3262, '2022-06-03 11:45:49'),
	(33, 5, 50, 2000, '2022-06-03 11:45:57'),
	(43, 1, 1, 22, '2022-06-03 21:22:30'),
	(45, 12, 1, 20, '2022-06-03 21:49:12'),
	(46, 15, 13, 299, '2022-06-04 13:56:16'),
	(47, 10, 1, 14, '2022-06-04 13:56:37'),
	(48, 10, 1, 14.5, '2022-06-04 14:00:33'),
	(49, 12, 1, 20, '2022-06-04 14:47:56'),
	(49, 30, 15, 195, '2022-06-04 14:48:03'),
	(53, 1, 1, 22.5, '2022-06-04 20:55:37'),
	(54, 1, 12, 270, '2022-06-05 14:15:28'),
	(55, 14, 13, 221, '2022-06-05 14:30:02'),
	(55, 12, 1, 20, '2022-06-05 14:30:06'),
	(56, 12, 691, 13820, '2022-06-05 15:02:16'),
	(57, 9, 12, 252, '2022-06-05 15:04:52'),
	(58, 11, 998, 14970, '2022-06-05 15:06:51'),
	(59, 11, 1, 15, '2022-06-05 20:01:20'),
	(61, 11, 1, 15, '2022-06-05 20:03:15'),
	(62, 25, 12, 216, '2022-06-07 09:30:18'),
	(62, 27, 45, 585, '2022-06-07 09:30:27'),
	(63, 14, 26, 442, '2022-06-07 09:34:00'),
	(64, 24, 14, 210, '2022-06-07 09:35:00'),
	(65, 2, 3, 60, '2022-06-07 10:49:22'),
	(65, 11, 1, 15, '2022-06-07 10:50:13'),
	(66, 23, 12, 216, '2022-06-07 10:57:40'),
	(66, 14, 1, 17, '2022-06-07 10:58:08'),
	(66, 12, 1, 20, '2022-06-07 10:58:19'),
	(68, 11, 12, 180, '2022-06-07 11:08:43'),
	(71, 34, 50, 360, '2022-06-08 20:09:00'),
	(72, 11, 1, 15, '2022-06-08 20:15:05'),
	(73, 32, 13, 195, '2022-06-09 10:37:26'),
	(73, 1, 12, 324, '2022-06-09 10:37:42'),
	(74, 32, 12, 180, '2022-06-09 10:39:13'),
	(75, 32, 1, 15, '2022-06-09 10:39:56'),
	(76, 1, 1, 29.4, '2022-06-09 10:41:18'),
	(77, 17, 1000, 14000, '2022-06-09 10:41:53');
/*!40000 ALTER TABLE `detalles_compra` ENABLE KEYS */;






-- Volcando estructura para procedimiento la_tiendita.deletePrSale
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePrSale`(
	IN `idcompradel` INT,
	IN `idproddel` INT,
	IN `saledatedel` DATETIME


)
BEGIN
	SET @stock=(SELECT stock FROM productos WHERE id_product=idproddel);
	UPDATE productos SET stock=(@stock+(SELECT qty FROM detalles_compra WHERE id_compra=idcompradel
        AND id_product=idproddel
        AND fecha_add=saledatedel))
		  WHERE id_product=idproddel;
	DELETE FROM detalles_compra 
        WHERE id_compra=idcompradel
        AND id_product=idproddel
        AND fecha_add=saledatedel;
END//
DELIMITER ;

-- Volcando estructura para procedimiento la_tiendita.insertcompra
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertcompra`(
	IN `idusuario` INT,
	IN `idproducto` INT,
	IN `cantprod` INT



,
	IN `opt` INT,
	IN `idcompra` INT



)
BEGIN
	IF (opt=1) THEN
		SET @qty = (SELECT (stock-cantprod) FROM productos WHERE id_product=idproducto);
		SET @stock = (SELECT stock FROM productos WHERE id_product=idproducto);
		IF (cantprod<=@stock) THEN
	      INSERT INTO compra (id_user) VALUES (idusuario);
			
			INSERT INTO detalles_compra (id_compra,id_product,qty,total) VALUES ((SELECT id_compra FROM compra WHERE id_user=idusuario ORDER BY id_compra DESC LIMIT 1),idproducto,cantprod, (SELECT (cantprod*(precio_uni-precio_uni*descuento)) FROM productos WHERE id_product=idproducto));
			UPDATE productos SET stock=@qty WHERE id_product=idproducto;
			SELECT dc.*, p.nombre_pr,p.precio_uni, 'Realizada' AS cantStock FROM detalles_compra as dc INNER JOIN productos as p on dc.id_product=p.id_product WHERE dc.id_compra =(SELECT id_compra FROM compra WHERE id_user=idusuario ORDER BY id_compra DESC  LIMIT 1)
			ORDER BY dc.fecha_add DESC  LIMIT 1;
		ELSE 
		 SELECT @stock AS cantStock;
		END IF;
   ELSEIF (opt=2) THEN
   	SET @qty = (SELECT (stock-cantprod) FROM productos WHERE id_product=idproducto);
   	SET @stock = (SELECT stock FROM productos WHERE id_product=idproducto);
		IF (cantprod<=@stock) THEN
	      INSERT INTO detalles_compra (id_compra,id_product,qty,total) VALUES (idcompra,idproducto,cantprod, (SELECT (cantprod*(precio_uni-precio_uni*descuento)) FROM productos WHERE id_product=idproducto));
	      
			UPDATE productos SET stock=@qty WHERE id_product=idproducto;
	      SELECT dc.*, p.nombre_pr,p.precio_uni, 'Realizada' AS cantStock FROM detalles_compra as dc INNER JOIN productos as p on dc.id_product=p.id_product WHERE dc.id_compra =idcompra
			ORDER BY dc.fecha_add DESC  LIMIT 1;
		ELSE
			SELECT @stock AS cantStock;
		END IF;
   END IF;
	
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
