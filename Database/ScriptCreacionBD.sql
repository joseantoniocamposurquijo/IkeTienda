-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.5.10-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para tienda
CREATE DATABASE IF NOT EXISTS `tienda` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tienda`;

-- Volcando estructura para tabla tienda.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `CaId` char(3) NOT NULL,
  `CaDescripcion` varchar(100) NOT NULL,
  `CaIcono` char(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`CaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.infotarjeta
CREATE TABLE IF NOT EXISTS `infotarjeta` (
  `ItId` int(11) NOT NULL AUTO_INCREMENT,
  `ItUsuario` char(20) NOT NULL,
  `ItInputNumero` varchar(50) NOT NULL,
  `ItMes` char(10) NOT NULL,
  `ItAnio` char(20) NOT NULL,
  `ItInputCCV` char(3) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`ItId`),
  KEY `usuarios_tarjetas` (`ItUsuario`),
  CONSTRAINT `usuarios_tarjetas` FOREIGN KEY (`ItUsuario`) REFERENCES `usuarios` (`UsAlias`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.inventarios
CREATE TABLE IF NOT EXISTS `inventarios` (
  `InId` int(11) NOT NULL AUTO_INCREMENT,
  `InProductoId` int(11) NOT NULL,
  `InCantidad` int(11) NOT NULL,
  PRIMARY KEY (`InId`),
  UNIQUE KEY `InProductoId` (`InProductoId`),
  KEY `productos_inventario` (`InProductoId`),
  CONSTRAINT `productos_inventario` FOREIGN KEY (`InProductoId`) REFERENCES `productos` (`PrId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.logs
CREATE TABLE IF NOT EXISTS `logs` (
  `LoId` int(11) NOT NULL AUTO_INCREMENT,
  `LoQueryType` char(20) NOT NULL,
  `LoTable` char(50) NOT NULL,
  `LoUser` char(50) NOT NULL,
  `LoQuery` varchar(5000) NOT NULL,
  `LoValues` varchar(5000) NOT NULL,
  `LoIp` varchar(5000) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`LoId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='tabla de logs de consultas sql';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `PeId` int(11) NOT NULL AUTO_INCREMENT,
  `PdVentaId` int(11) NOT NULL,
  `PeProductoId` int(11) NOT NULL,
  `PePrecioUnitario` decimal(20,2) NOT NULL DEFAULT 0.00,
  `PeCantidad` int(11) NOT NULL,
  `PeDescargado` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`PeId`),
  KEY `productos_pedidos` (`PeProductoId`),
  KEY `ventas_pedidos` (`PdVentaId`),
  CONSTRAINT `productos_pedidos` FOREIGN KEY (`PeProductoId`) REFERENCES `productos` (`PrId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ventas_pedidos` FOREIGN KEY (`PdVentaId`) REFERENCES `ventas` (`VeId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `PrId` int(11) NOT NULL AUTO_INCREMENT,
  `PrNombre` varchar(255) NOT NULL,
  `PrPrecio` decimal(20,2) NOT NULL,
  `PrDescripcion` varchar(5000) NOT NULL,
  `PrImagen` varchar(1000) NOT NULL,
  `PrCategoria` char(3) NOT NULL,
  `PrDescuento` float NOT NULL,
  PRIMARY KEY (`PrId`),
  KEY `productos_categoria` (`PrCategoria`),
  CONSTRAINT `productos_categoria` FOREIGN KEY (`PrCategoria`) REFERENCES `categorias` (`CaId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `RoId` char(3) NOT NULL,
  `RoDescription` char(30) NOT NULL,
  PRIMARY KEY (`RoId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Roles de usuarios';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `UsAlias` char(20) NOT NULL,
  `UsRol` char(3) NOT NULL,
  `UsNombres` varchar(50) NOT NULL,
  `UsApellidos` varchar(50) NOT NULL,
  `UsCorreo` varchar(255) NOT NULL,
  `UsPassword` varchar(130) NOT NULL,
  `UsDireccion` varchar(255) NOT NULL,
  `UsTelefono` varchar(20) NOT NULL,
  KEY `usuarios_roles` (`UsRol`),
  KEY `UsAlias` (`UsAlias`),
  CONSTRAINT `usuarios_roles` FOREIGN KEY (`UsRol`) REFERENCES `roles` (`RoId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla tienda.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `VeId` int(11) NOT NULL AUTO_INCREMENT,
  `VeUsuario` char(20) NOT NULL DEFAULT '',
  `VeClaveTransaccion` varchar(255) NOT NULL,
  `VePago` int(11) DEFAULT 0,
  `VeFecha` datetime NOT NULL,
  `VeTotal` decimal(20,2) NOT NULL,
  `VeStatus` char(50) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`VeId`),
  KEY `usuarios_ventas` (`VeUsuario`),
  KEY `tarjetas_ventas` (`VePago`),
  CONSTRAINT `usuarios_ventas` FOREIGN KEY (`VeUsuario`) REFERENCES `usuarios` (`UsAlias`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
