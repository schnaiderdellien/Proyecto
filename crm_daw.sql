-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-05-2026 a las 01:10:12
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crm_daw`
--
CREATE DATABASE IF NOT EXISTS `crm_daw` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `crm_daw`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
CREATE TABLE `Categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Categoria`
--

INSERT INTO `Categoria` (`id_categoria`, `categoria`, `descripcion`) VALUES
(1, 'Electrónica', 'Dispositivos electrónicos'),
(2, 'Informática', 'Equipos y accesorios informáticos'),
(3, 'Telefonía', 'Smartphones y accesorios'),
(4, 'Oficina', 'Material de oficina'),
(5, 'Servicio', 'Mano de obra'),
(6, 'Audio y Video', 'Sonido e imagen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombreCliente` varchar(100) DEFAULT NULL,
  `apellido1` varchar(100) DEFAULT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `emailCliente` varchar(150) DEFAULT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `id_metodo_pago` int(11) DEFAULT NULL,
  `id_impuesto` int(11) DEFAULT NULL,
  `credito` decimal(10,2) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_de_alta` date DEFAULT NULL,
  `fecha_de_baja` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombreCliente`, `apellido1`, `apellido2`, `emailCliente`, `documento`, `telefono`, `direccion`, `cp`, `ciudad`, `pais`, `fecha_de_nacimiento`, `id_metodo_pago`, `id_impuesto`, `credito`, `id_estado`, `fecha_de_alta`, `fecha_de_baja`, `id_usuario`) VALUES
(1, 'Carlos', 'Gómez', 'Perez', 'carlos.gomez@gmail.com', '12345678A', '600111001', 'C/ Mayor 12', '28001', 'Madrid', 'España', '1985-04-12', 3, 4, 3000.00, 1, '2023-01-10', NULL, 2),
(2, 'Laura', 'Martínez', 'Santos', 'laura.martinez@gmail.com', '23456789B', '600111002', 'Av. Andalucía 45', '41001', 'Sevilla', 'España', '1990-07-22', 2, 1, 2500.00, 1, '2023-01-12', NULL, 2),
(3, 'Javier', 'López', 'Hernández', 'j.lopez@gmail.com', '34567890C', '600111003', 'C/ Gran Vía 3', '46001', 'Valencia', 'España', '1982-03-08', 1, 1, 4000.00, 1, '2023-01-15', NULL, 5),
(4, 'Ana', 'Pérez', 'Díaz', 'ana.perez@gmail.com', '45678901D', '600111004', 'C/ Aragón 55', '08013', 'Barcelona', 'España', '1995-11-18', 3, 1, 1800.00, 1, '2023-01-18', NULL, 2),
(5, 'Miguel', 'Sánchez', 'Vega', 'miguel.sanchez@gmail.com', '56789012E', '600111005', 'C/ Real 9', '29001', 'Málaga', 'España', '1988-06-30', 1, 1, 3200.00, 1, '2023-01-20', NULL, 2),
(6, 'Lucía', 'Romero', 'Gil', 'lucia.romero@gmail.com', '67890123F', '600111006', 'C/ Colón 17', '50001', 'Zaragoza', 'España', '1992-02-14', 2, 1, 2100.00, 1, '2023-02-01', NULL, 5),
(7, 'David', 'Torres', 'Molina', 'david.torres@gmail.com', '78901234G', '600111007', 'C/ Larios 22', '29005', 'Málaga', 'España', '1986-09-09', 1, 1, 3500.00, 2, '2023-02-03', '2026-05-11', 5),
(8, 'Marta', 'Navarro', 'Cruz', 'marta.navarro@gmail.com', '89012345H', '600111008', 'Av. Europa 4', '03001', 'Alicante', 'España', '1991-01-27', 4, 1, 2700.00, 1, '2023-02-05', NULL, 5),
(9, 'Pablo', 'Ortega', 'Rey', 'pablo.ortega@gmail.com', '90123456J', '600111009', 'C/ Castilla 88', '47001', 'Valladolid', 'España', '1984-08-15', 1, 1, 3900.00, 1, '2023-02-08', NULL, 5),
(10, 'Elena', 'Val', 'Iglesias', 'elena.morales@gmail.com', '01234567K', '600111010', 'C/ Paz 10', '02001', 'Albacete', 'España', '1993-12-02', 2, 1, 2200.00, 1, '2023-02-10', NULL, 4),
(11, 'schnaider', 'Coimbra', 'coimbra', 'schnaiderdellien@gmail.com', '12345678A', '618000451', 'C. de Cervantes, 34', '46220', 'Picassent', 'España', '1995-05-19', 4, 1, 3500.00, 2, '2026-05-12', '2026-05-16', 5),
(12, 'Angel', 'Izquierdo', 'Brull', 'angel@gmail.com', '12345678A', '666995966', 'C. de Cervantes, 34', '46220', 'Picassent', 'España', '1994-02-07', 1, 1, 3000.00, 2, '2026-05-13', '2026-05-14', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_factura`
--

DROP TABLE IF EXISTS `Detalle_factura`;
CREATE TABLE `Detalle_factura` (
  `id_detalle_factura` int(11) NOT NULL,
  `id_factura` int(11) DEFAULT NULL,
  `id_productos` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_pedidos`
--

DROP TABLE IF EXISTS `Detalle_pedidos`;
CREATE TABLE `Detalle_pedidos` (
  `id_detalle_pedido` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_productos` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `cantidad_servida` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Detalle_pedidos`
--

INSERT INTO `Detalle_pedidos` (`id_detalle_pedido`, `id_pedido`, `id_productos`, `cantidad`, `precio_unitario`, `subtotal`, `descuento`, `total`, `cantidad_servida`) VALUES
(8, 1, 12, 4, 50.00, 200.00, 0.00, 200.00, 4),
(9, 1, 13, 1, 150.00, 150.00, 0.00, 150.00, 1),
(10, 1, 14, 3, 80.00, 240.00, 0.00, 240.00, 3),
(12, 2, 11, 1, 300.00, 300.00, 0.00, 300.00, 0),
(13, 2, 12, 2, 120.00, 240.00, 20.00, 220.00, 0),
(14, 3, 13, 6, 45.00, 270.00, 0.00, 270.00, 3),
(15, 3, 14, 2, 80.00, 160.00, 10.00, 150.00, 0),
(16, 4, 15, 10, 25.00, 250.00, 0.00, 250.00, 10),
(17, 4, 11, 3, 300.00, 900.00, 50.00, 850.00, 3),
(18, 4, 15, 10, 25.00, 250.00, 0.00, 250.00, 10),
(19, 4, 11, 3, 300.00, 900.00, 50.00, 850.00, 3),
(20, 5, 12, 8, 120.00, 960.00, 60.00, 900.00, 8),
(21, 5, 13, 4, 45.00, 180.00, 0.00, 180.00, 4),
(22, 5, 14, 1, 80.00, 80.00, 0.00, 80.00, 1),
(25, 1, 33, 2, 299.00, 598.00, 0.00, 598.00, 0),
(28, 2, 13, 2, 999.00, 1998.00, 0.00, 1998.00, 0),
(30, 6, 11, 1, 749.00, 749.00, 0.00, 749.00, 1),
(31, 6, 12, 2, 899.00, 1798.00, 10.00, 1788.00, 2),
(32, 7, 14, 1, 879.00, 879.00, 0.00, 879.00, 1),
(33, 7, 19, 1, 349.00, 349.00, 0.00, 349.00, 1),
(36, 8, 12, 1, 899.00, 899.00, 0.00, 899.00, 1),
(37, 8, 18, 2, 229.00, 458.00, 0.00, 458.00, 2),
(38, 4, 14, 2, 879.00, 1758.00, 0.00, 1758.00, 0),
(41, 9, 14, 4, 879.00, 3516.00, 0.00, 3516.00, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estado`
--

DROP TABLE IF EXISTS `Estado`;
CREATE TABLE `Estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Estado`
--

INSERT INTO `Estado` (`id_estado`, `estado`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Estado_pedido`
--

DROP TABLE IF EXISTS `Estado_pedido`;
CREATE TABLE `Estado_pedido` (
  `id_estado_pedido` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Estado_pedido`
--

INSERT INTO `Estado_pedido` (`id_estado_pedido`, `estado`) VALUES
(1, 'Creado'),
(2, 'Confirmado'),
(3, 'En preparación'),
(4, 'Cerrado'),
(5, 'Enviado'),
(6, 'Cancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Factura`
--

DROP TABLE IF EXISTS `Factura`;
CREATE TABLE `Factura` (
  `id_factura` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_factura` date DEFAULT NULL,
  `id_metodo_pago` int(11) DEFAULT NULL,
  `bruto` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `id_impuesto` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Impuestos`
--

DROP TABLE IF EXISTS `Impuestos`;
CREATE TABLE `Impuestos` (
  `id_impuesto` int(11) NOT NULL,
  `impuesto` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Impuestos`
--

INSERT INTO `Impuestos` (`id_impuesto`, `impuesto`) VALUES
(1, 21.00),
(2, 10.00),
(3, 4.00),
(4, 7.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Marca`
--

DROP TABLE IF EXISTS `Marca`;
CREATE TABLE `Marca` (
  `id_marca` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Marca`
--

INSERT INTO `Marca` (`id_marca`, `marca`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'HP'),
(4, 'Dell'),
(5, 'Lenovo'),
(6, 'Asus'),
(7, 'Xiaomi'),
(8, 'Sony'),
(9, 'LG'),
(10, 'Logitech'),
(11, 'Dellien');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Metodo_pago`
--

DROP TABLE IF EXISTS `Metodo_pago`;
CREATE TABLE `Metodo_pago` (
  `id_metodo_pago` int(11) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Metodo_pago`
--

INSERT INTO `Metodo_pago` (`id_metodo_pago`, `metodo_pago`) VALUES
(1, 'Transferencia bancaria'),
(2, 'Tarjeta de crédito'),
(3, 'Pago anticipado'),
(4, 'Domiciliación bancaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedidos`
--

DROP TABLE IF EXISTS `Pedidos`;
CREATE TABLE `Pedidos` (
  `id_pedido` int(11) NOT NULL,
  `numero_pedido` varchar(50) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `id_estado_pedido` int(11) DEFAULT NULL,
  `id_metodo_pago` int(11) DEFAULT NULL,
  `bruto` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `id_impuesto` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `fecha_confirmacion` date DEFAULT NULL,
  `fecha_preparacion` date DEFAULT NULL,
  `fecha_cierre` date DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Pedidos`
--

INSERT INTO `Pedidos` (`id_pedido`, `numero_pedido`, `id_cliente`, `id_usuario`, `fecha_pedido`, `id_estado_pedido`, `id_metodo_pago`, `bruto`, `descuento`, `id_impuesto`, `total`, `notas`, `fecha_confirmacion`, `fecha_preparacion`, `fecha_cierre`, `fecha_envio`) VALUES
(1, 'PED-2026-00001', 5, 4, '2026-05-15', 5, 2, 1787.00, 0.00, 2, 1965.70, 'Pedido de prueba de guardado confirmado', '2026-05-16', '2026-05-16', '2026-05-16', '2026-05-16'),
(2, 'PED-2026-00002', 2, 5, '2026-05-15', 2, 2, 3417.00, 20.00, 1, 4110.37, 'Pedido confirmado', '2026-05-15', NULL, NULL, NULL),
(3, 'PED-2026-00003', 5, 5, '2026-05-15', 3, 1, 500.00, 0.00, 1, 605.00, 'Pedido en preparación', '2026-05-15', '2026-05-15', NULL, NULL),
(4, 'PED-2026-00004', 4, 4, '2026-05-15', 4, 2, 5816.00, 100.00, 1, 6916.36, 'Pedido cerrado', '2026-05-15', '2026-05-15', '2026-05-15', NULL),
(5, 'PED-2026-00005', 5, 2, '2026-05-15', 5, 1, 1200.00, 50.00, 1, 1391.50, 'Pedido enviado', '2026-05-15', '2026-05-15', '2026-05-15', '2026-05-15'),
(6, 'PED-2026-00006', 4, 2, '2026-05-18', 1, 3, 2547.00, 10.00, 1, 3069.77, '', NULL, NULL, NULL, NULL),
(7, 'PED-2026-00007', 3, 5, '2026-05-18', 5, 1, 1228.00, 0.00, 1, 1485.88, '', NULL, '2026-05-18', '2026-05-18', '2026-05-18'),
(8, 'PED-2026-00008', 8, 5, '2026-05-19', 5, 4, 1357.00, 0.00, 1, 1641.97, 'nota', '2026-05-19', '2026-05-19', '2026-05-19', '2026-05-19'),
(9, 'PED-2026-00009', 9, 5, '2026-05-22', 4, 1, 3516.00, 0.00, 1, 4254.36, '', '2026-05-22', '2026-05-22', '2026-05-22', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Productos`
--

DROP TABLE IF EXISTS `Productos`;
CREATE TABLE `Productos` (
  `id_productos` int(11) NOT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion_corta` varchar(255) DEFAULT NULL,
  `descripcion_larga` text DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `precio_coste` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `moneda` varchar(10) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `stock_maximo` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `fecha_de_alta` date DEFAULT NULL,
  `fecha_de_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Productos`
--

INSERT INTO `Productos` (`id_productos`, `sku`, `nombre`, `descripcion_corta`, `descripcion_larga`, `id_tipo`, `id_categoria`, `id_marca`, `modelo`, `precio_coste`, `precio_venta`, `moneda`, `stock`, `stock_minimo`, `stock_maximo`, `id_estado`, `fecha_de_alta`, `fecha_de_baja`) VALUES
(11, 'PR-HP-001', 'Portátil HP 15', 'Portátil 13\"', 'Portátil HP Intel i5 16GB RAM', 1, 2, 3, '15s-eq2021', 550.00, 749.00, 'EUR', 29, 8, 100, 1, '2023-01-05', NULL),
(12, 'PR-DE-002', 'Portátil Dell Inspiron', 'Portátil Dell', 'Dell Inspiron Intel i7', 1, 2, 4, 'Inspiron 5510', 650.00, 899.00, 'EUR', 17, 5, 80, 1, '2023-01-06', NULL),
(13, 'PR-LE-003', 'Portátil Lenovo ThinkPad', 'Portátil profesional', 'ThinkPad empresarial', 1, 2, 5, 'E14 Gen2', 700.00, 999.00, 'EUR', 15, 3, 60, 1, '2023-01-07', NULL),
(14, 'PR-AS-004', 'Portátil Asus VivoBook', 'Portátil Asus', 'VivoBook Ryzen 7', 1, 2, 6, 'VivoBook 15', 620.00, 879.00, 'EUR', 0, 5, 70, 1, '2023-01-08', NULL),
(15, 'PR-IP-005', 'iPhone 13', 'Smartphone Apple', 'iPhone 13 128GB', 1, 3, 1, 'A2633', 680.00, 899.00, 'EUR', 40, 10, 150, 1, '2023-01-10', NULL),
(16, 'PR-SA-006', 'Samsung Galaxy S22', 'Smartphone Samsung', 'Galaxy S22 5G', 1, 3, 2, 'SM-S901', 620.00, 849.00, 'EUR', 50, 10, 200, 1, '2023-01-11', NULL),
(17, 'PR-XI-007', 'Xiaomi Redmi Note 12', 'Smartphone Xiaomi', 'Redmi Note 12 5G', 1, 3, 7, 'RN12', 180.00, 299.00, 'EUR', 70, 15, 250, 1, '2023-01-12', NULL),
(18, 'PR-LG-008', 'Monitor LG 27\"', 'Monitor IPS', 'Monitor LG Full HD', 1, 2, 9, '27MK600', 150.00, 229.00, 'EUR', 58, 10, 200, 1, '2023-01-13', NULL),
(19, 'PR-DE-009', 'Monitor Dell 24\"', 'Monitor profesional', 'UltraSharp 24\"', 1, 2, 4, 'U2422H', 220.00, 349.00, 'EUR', 29, 5, 100, 1, '2023-01-14', NULL),
(20, 'PR-AS-010', 'Monitor Asus 27\"', 'Monitor gaming', 'Asus TUF Gaming', 1, 2, 6, 'VG27AQ', 260.00, 399.00, 'EUR', 25, 5, 90, 1, '2023-01-15', NULL),
(21, 'PR-LO-011', 'Ratón Logitech MX', 'Ratón inalámbrico', 'Ratón profesional', 1, 2, 10, 'MX Master 3', 60.00, 99.00, 'EUR', 80, 20, 300, 1, '2023-01-16', NULL),
(22, 'PR-LO-012', 'Teclado Logitech G915', 'Teclado mecánico', 'Teclado gaming', 1, 2, 10, 'G915', 120.00, 199.00, 'EUR', 35, 5, 120, 1, '2023-01-17', NULL),
(23, 'PR-HP-013', 'Impresora HP Laser', 'Impresora láser', 'LaserJet Pro', 1, 4, 3, 'M404dn', 180.00, 299.00, 'EUR', 22, 5, 70, 1, '2023-01-18', NULL),
(24, 'PR-HP-014', 'Impresora HP InkJet', 'Impresora tinta', 'DeskJet color', 1, 4, 3, '2720e', 60.00, 109.00, 'EUR', 40, 10, 150, 1, '2023-01-19', NULL),
(25, 'PR-LE-015', 'PC Lenovo ThinkCentre', 'PC sobremesa', 'Sobremesa empresarial', 1, 2, 5, 'M70s', 750.00, 1099.00, 'EUR', 10, 2, 40, 1, '2023-01-20', NULL),
(26, 'PR-DE-016', 'PC Dell OptiPlex', 'PC sobremesa', 'Equipo oficina', 1, 2, 4, '7090', 700.00, 1049.00, 'EUR', 12, 2, 50, 1, '2023-01-21', NULL),
(27, 'PR-SA-017', 'Tablet Samsung Galaxy', 'Tablet Android', 'Galaxy Tab S8', 1, 3, 2, 'SM-X700', 480.00, 699.00, 'EUR', 25, 5, 90, 1, '2023-01-22', NULL),
(28, 'PR-IP-018', 'iPad 10ª Gen', 'Tablet Apple', 'iPad 64GB', 1, 3, 1, 'A2696', 420.00, 599.00, 'EUR', 30, 5, 100, 1, '2023-01-23', NULL),
(29, 'PR-LG-019', 'Televisor LG 55\"', 'TV 4K', 'LG UHD Smart TV', 1, 5, 9, '55UP7500', 650.00, 899.00, 'EUR', 18, 3, 60, 1, '2023-01-24', NULL),
(30, 'PR-SO-020', 'Televisor Sony 65\"', 'TV premium', 'Sony Bravia 4K', 1, 5, 8, 'XR65X90J', 900.00, 1299.00, 'EUR', 10, 2, 40, 1, '2023-01-25', NULL),
(31, 'PR-LO-021', 'Webcam Logitech', 'Webcam Full HD', 'Webcam profesional', 1, 2, 10, 'C920', 50.00, 89.00, 'EUR', 90, 20, 300, 1, '2023-01-26', NULL),
(32, 'PR-AS-022', 'Router Asus', 'Router WiFi 6', 'Router alto rendimiento', 1, 2, 6, 'RT-AX58U', 140.00, 229.00, 'EUR', 35, 5, 120, 1, '2023-01-27', NULL),
(33, 'PR-TP-023', 'Switch 24 puertos', 'Switch red', 'Switch gestionable', 1, 2, 6, 'SG2424', 180.00, 299.00, 'EUR', 20, 3, 70, 1, '2023-01-28', NULL),
(34, 'PR-HP-024', 'Disco SSD 1TB', 'Almacenamiento', 'SSD NVMe', 1, 2, 3, 'EX950', 70.00, 129.00, 'EUR', 100, 20, 400, 1, '2023-01-29', NULL),
(35, 'PR-SA-025', 'Disco HDD 4TB', 'Almacenamiento', 'Disco duro 4TB', 1, 2, 2, 'ST4000', 90.00, 159.00, 'EUR', 65, 10, 250, 1, '2023-01-30', NULL),
(36, 'PR-LO-026', 'Auriculares Logitech', 'Auriculares gaming', 'Sonido envolvente', 1, 5, 10, 'G Pro X', 80.00, 149.00, 'EUR', 40, 5, 150, 1, '2023-02-01', NULL),
(37, 'PR-SON-027', 'Barra de sonido Sony', 'Audio', 'Barra sonido TV', 1, 5, 8, 'HT-S40R', 260.00, 399.00, 'EUR', 22, 3, 80, 1, '2023-02-02', NULL),
(38, 'PR-XI-028', 'Smartwatch Xiaomi', 'Wearable', 'Smartwatch deportivo', 1, 3, 7, 'Mi Watch', 70.00, 129.00, 'EUR', 55, 10, 200, 1, '2023-02-03', NULL),
(39, 'PR-AP-029', 'Apple Watch SE', 'Wearable', 'Smartwatch Apple', 1, 3, 1, 'SE 44mm', 220.00, 329.00, 'EUR', 28, 5, 90, 1, '2023-02-04', NULL),
(40, 'PR-LE-030', 'Dock Lenovo USB-C', 'Accesorio', 'Dock estación', 1, 2, 5, 'USB-C Dock', 120.00, 199.00, 'EUR', 35, 5, 120, 1, '2023-02-05', NULL),
(41, 'SR-INST-031', 'Instalación de equipos', 'Servicio', 'Instalación de equipos informáticos', 2, 4, 10, 'Servicio', 0.00, 120.00, 'EUR', 0, 0, 0, 1, '2023-02-06', NULL),
(42, 'SR-MONT-032', 'Montaje de puestos', 'Servicio', 'Montaje de puestos de trabajo', 2, 4, 10, 'Servicio', 0.00, 95.00, 'EUR', 0, 0, 0, 1, '2023-02-07', NULL),
(43, 'SR-RED-033', 'Instalación de red', 'Servicio', 'Cableado y red local', 2, 4, 10, 'Servicio', 0.00, 250.00, 'EUR', 0, 0, 0, 1, '2023-02-08', NULL),
(44, 'SR-MANT-034', 'Mantenimiento mensual', 'Servicio', 'Mantenimiento informático', 2, 4, 10, 'Servicio', 0.00, 80.00, 'EUR', 0, 0, 0, 1, '2023-02-09', NULL),
(45, 'SR-MANT-035', 'Mantenimiento anual', 'Servicio', 'Soporte anual', 2, 4, 10, 'Servicio', 0.00, 900.00, 'EUR', 0, 0, 0, 1, '2023-02-10', NULL),
(46, 'SR-FORM-036', 'Formación usuarios', 'Servicio', 'Formación informática', 2, 4, 10, 'Servicio', 0.00, 150.00, 'EUR', 0, 0, 0, 1, '2023-02-11', NULL),
(47, 'SR-BACK-037', 'Configuración backups', 'Servicio', 'Copias de seguridad', 2, 4, 10, 'Servicio', 0.00, 110.00, 'EUR', 0, 0, 0, 1, '2023-02-12', NULL),
(48, 'SR-MIG-038', 'Migración de datos', 'Servicio', 'Migración de sistemas', 2, 4, 10, 'Servicio', 0.00, 300.00, 'EUR', 0, 0, 0, 1, '2023-02-13', NULL),
(49, 'SR-SEC-039', 'Auditoría de seguridad', 'Servicio', 'Revisión de seguridad', 2, 4, 10, 'Servicio', 0.00, 450.00, 'EUR', 0, 0, 0, 1, '2023-02-14', NULL),
(50, 'SR-CONS-040', 'Consultoría IT', 'Servicio', 'Consultoría tecnológica', 2, 4, 10, 'Servicio', 0.00, 100.00, 'EUR', 0, 0, 0, 1, '2023-02-15', NULL),
(51, 'SR-SOFT-041', 'Instalación software', 'Servicio', 'Instalación de software', 2, 4, 10, 'Servicio', 0.00, 90.00, 'EUR', 0, 0, 0, 1, '2023-02-16', NULL),
(52, 'SR-LIC-042', 'Licencia antivirus', 'Servicio', 'Licencia anual antivirus', 2, 4, 10, 'Servicio', 0.00, 60.00, 'EUR', 0, 0, 0, 1, '2023-02-17', NULL),
(53, 'SR-CLOUD-043', 'Configuración cloud', 'Servicio', 'Servicios cloud', 2, 4, 10, 'Servicio', 0.00, 200.00, 'EUR', 0, 0, 0, 1, '2023-02-18', NULL),
(54, 'SR-WEB-044', 'Mantenimiento web', 'Servicio', 'Soporte web mensual', 2, 4, 10, 'Servicio', 0.00, 75.00, 'EUR', 0, 0, 0, 1, '2023-02-19', NULL),
(55, 'SR-DES-045', 'Desarrollo a medida', 'Servicio', 'Desarrollo software', 2, 4, 10, 'Servicio', 0.00, 500.00, 'EUR', 0, 0, 0, 1, '2023-02-20', NULL),
(56, 'SR-ERP-046', 'Implantación ERP', 'Servicio', 'Implantación ERP', 2, 4, 10, 'Servicio', 0.00, 2500.00, 'EUR', 0, 0, 0, 1, '2023-02-21', NULL),
(57, 'SR-CRM-047', 'Implantación CRM', 'Servicio', 'Implantación CRM', 2, 4, 10, 'Servicio', 0.00, 1800.00, 'EUR', 0, 0, 0, 1, '2023-02-22', NULL),
(58, 'SR-AUD-048', 'Auditoría sistemas', 'Servicio', 'Auditoría informática', 2, 4, 10, 'Servicio', 0.00, 400.00, 'EUR', 0, 0, 0, 1, '2023-02-23', NULL),
(59, 'SR-REC-049', 'Recuperación datos', 'Servicio', 'Recuperación de datos', 2, 4, 10, 'Servicio', 0.00, 350.00, 'EUR', 0, 0, 0, 1, '2023-02-24', NULL),
(60, 'SR-SOP-050', 'Soporte urgente', 'Servicio', 'Soporte técnico urgente', 2, 4, 10, 'Servicio', 0.00, 150.00, 'EUR', 0, 0, 0, 1, '2023-02-25', NULL),
(61, '088888', 'Schnaider', 'Portátil 15\"', 'prueba de nuevo producto', NULL, NULL, NULL, '15s-eq2021', 50.00, 100.00, 'EUR', 80, 10, 10, 2, '2026-05-13', '2026-05-16'),
(62, 'skuprueba', 'Julia', 'Portátil 15\"', 'prueba', NULL, NULL, NULL, '15s-eq2021', 4.20, 87.97, 'EUR', 100, 5, 148, 2, '2026-05-13', '2026-05-16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Rol`
--

DROP TABLE IF EXISTS `Rol`;
CREATE TABLE `Rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Rol`
--

INSERT INTO `Rol` (`id_rol`, `rol`) VALUES
(1, 'Comercial'),
(2, 'Contabilidad'),
(3, 'Administrativo'),
(4, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tipo`
--

DROP TABLE IF EXISTS `Tipo`;
CREATE TABLE `Tipo` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Tipo`
--

INSERT INTO `Tipo` (`id_tipo`, `nombre_tipo`) VALUES
(1, 'Producto'),
(2, 'Servicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
CREATE TABLE `Usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`id_usuario`, `nombre`, `email`, `id_rol`, `fecha_alta`, `fecha_baja`, `ultimo_login`, `id_estado`, `password`) VALUES
(1, 'Schnaider', 'schnaiderdellien@gmail.com', 4, '2026-01-28', NULL, '2026-05-22 14:22:11', 1, '$2y$10$7fDxCUJiK36Xgk7gfV8ZEOKGbd7W5PKLzn0CbPSCSItYEwU3Iu./i'),
(2, 'Laura Comercial', 'laura.comercial@empresa.com', 1, '2023-01-15', NULL, '2026-05-13 13:39:58', 1, '$2y$10$3//I/hLVDI/fouMGOHqcEeLGOViKuGMb3X2e8LF6ReVsgFlaPaHYe'),
(3, 'Carlos Administración', 'carlos.admin@empresa.com', 3, '2023-01-20', NULL, '2026-05-18 21:33:51', 1, '$2y$10$SqYpw7NVU5Q086AyAJUnyeYzMk6QkxIncQCGVltIsNmTCxDNORB9y'),
(4, 'Marta Comercial', 'marta.comercial@empresa.com', 1, '2023-02-01', NULL, '2026-05-17 07:53:40', 1, '$2y$10$tfFFvKqfjmh2R2Hm8UF.peV3B2a4Cz.X5W2pubAxcuykJpPPUmU8m'),
(5, 'Javier Perez', 'javier.comercial@dellien.com', 1, '2026-03-21', NULL, '2026-05-19 19:42:54', 1, '$2y$10$3//I/hLVDI/fouMGOHqcEeLGOViKuGMb3X2e8LF6ReVsgFlaPaHYe'),
(7, 'Julia', 'julia.admin@empresa.com', 3, '2026-05-13', NULL, '2026-05-19 19:43:58', 1, '$2y$10$fZeBH6JuILaH5i.Ip8zdIeeqdCs0huXUONtj/U9HACluZpd34TMO2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_metodo_pago` (`id_metodo_pago`),
  ADD KEY `id_impuesto` (`id_impuesto`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `fk_clientes_usuario` (`id_usuario`);

--
-- Indices de la tabla `Detalle_factura`
--
ALTER TABLE `Detalle_factura`
  ADD PRIMARY KEY (`id_detalle_factura`),
  ADD KEY `id_factura` (`id_factura`),
  ADD KEY `id_productos` (`id_productos`);

--
-- Indices de la tabla `Detalle_pedidos`
--
ALTER TABLE `Detalle_pedidos`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_productos` (`id_productos`);

--
-- Indices de la tabla `Estado`
--
ALTER TABLE `Estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `Estado_pedido`
--
ALTER TABLE `Estado_pedido`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indices de la tabla `Factura`
--
ALTER TABLE `Factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_metodo_pago` (`id_metodo_pago`),
  ADD KEY `id_impuesto` (`id_impuesto`);

--
-- Indices de la tabla `Impuestos`
--
ALTER TABLE `Impuestos`
  ADD PRIMARY KEY (`id_impuesto`);

--
-- Indices de la tabla `Marca`
--
ALTER TABLE `Marca`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `Metodo_pago`
--
ALTER TABLE `Metodo_pago`
  ADD PRIMARY KEY (`id_metodo_pago`);

--
-- Indices de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_estado_pedido` (`id_estado_pedido`),
  ADD KEY `id_metodo_pago` (`id_metodo_pago`),
  ADD KEY `id_impuesto` (`id_impuesto`);

--
-- Indices de la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`id_productos`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_marca` (`id_marca`),
  ADD KEY `id_estado` (`id_estado`);

--
-- Indices de la tabla `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `Tipo`
--
ALTER TABLE `Tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_estado` (`id_estado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Categoria`
--
ALTER TABLE `Categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `Detalle_factura`
--
ALTER TABLE `Detalle_factura`
  MODIFY `id_detalle_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Detalle_pedidos`
--
ALTER TABLE `Detalle_pedidos`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `Estado`
--
ALTER TABLE `Estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Estado_pedido`
--
ALTER TABLE `Estado_pedido`
  MODIFY `id_estado_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Factura`
--
ALTER TABLE `Factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Impuestos`
--
ALTER TABLE `Impuestos`
  MODIFY `id_impuesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Marca`
--
ALTER TABLE `Marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `Metodo_pago`
--
ALTER TABLE `Metodo_pago`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Productos`
--
ALTER TABLE `Productos`
  MODIFY `id_productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `Rol`
--
ALTER TABLE `Rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Tipo`
--
ALTER TABLE `Tipo`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`id_metodo_pago`) REFERENCES `Metodo_pago` (`id_metodo_pago`),
  ADD CONSTRAINT `clientes_ibfk_2` FOREIGN KEY (`id_impuesto`) REFERENCES `Impuestos` (`id_impuesto`),
  ADD CONSTRAINT `clientes_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `Estado` (`id_estado`),
  ADD CONSTRAINT `fk_clientes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `Detalle_factura`
--
ALTER TABLE `Detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`id_factura`) REFERENCES `Factura` (`id_factura`),
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`id_productos`) REFERENCES `Productos` (`id_productos`);

--
-- Filtros para la tabla `Detalle_pedidos`
--
ALTER TABLE `Detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `Pedidos` (`id_pedido`),
  ADD CONSTRAINT `detalle_pedidos_ibfk_2` FOREIGN KEY (`id_productos`) REFERENCES `Productos` (`id_productos`);

--
-- Filtros para la tabla `Factura`
--
ALTER TABLE `Factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `Pedidos` (`id_pedido`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `Clientes` (`id_cliente`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`),
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`id_metodo_pago`) REFERENCES `Metodo_pago` (`id_metodo_pago`),
  ADD CONSTRAINT `factura_ibfk_5` FOREIGN KEY (`id_impuesto`) REFERENCES `Impuestos` (`id_impuesto`);

--
-- Filtros para la tabla `Pedidos`
--
ALTER TABLE `Pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `Clientes` (`id_cliente`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `Usuarios` (`id_usuario`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`id_estado_pedido`) REFERENCES `Estado_pedido` (`id_estado_pedido`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`id_metodo_pago`) REFERENCES `Metodo_pago` (`id_metodo_pago`),
  ADD CONSTRAINT `pedidos_ibfk_5` FOREIGN KEY (`id_impuesto`) REFERENCES `Impuestos` (`id_impuesto`);

--
-- Filtros para la tabla `Productos`
--
ALTER TABLE `Productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `Tipo` (`id_tipo`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `Categoria` (`id_categoria`),
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`id_marca`) REFERENCES `Marca` (`id_marca`),
  ADD CONSTRAINT `productos_ibfk_4` FOREIGN KEY (`id_estado`) REFERENCES `Estado` (`id_estado`);

--
-- Filtros para la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `Rol` (`id_rol`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `Estado` (`id_estado`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
