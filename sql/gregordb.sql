-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2020 a las 10:55:39
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gregordb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `archivo_id` int(11) NOT NULL,
  `denominacion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_carga` date DEFAULT NULL,
  `formato` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`archivo_id`, `denominacion`, `url`, `fecha_carga`, `formato`) VALUES
(2, 'Schweppes', '220201121294809760', '2020-11-21', 'png'),
(3, 'fanta', '320201121986836892', '2020-11-21', 'jpeg'),
(4, 'sprite', '42020112179225516', '2020-11-21', 'png'),
(5, 'coca-cola', '120201121953974780', '2020-11-21', 'png'),
(7, 'cervesas', '220201121328277250', '2020-11-21', 'png'),
(8, 'agua', '320201121818087275', '2020-11-21', 'png'),
(9, 'tragos', '4202011211424201692', '2020-11-21', 'png'),
(10, 'cafe', '5202011211757480625', '2020-11-21', 'png'),
(12, 'gaseosas', '620201121588898477', '2020-11-21', 'png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivocategoria`
--

CREATE TABLE `archivocategoria` (
  `archivocategoria_id` int(11) NOT NULL,
  `compuesto` int(11) NOT NULL,
  `compositor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `archivocategoria`
--

INSERT INTO `archivocategoria` (`archivocategoria_id`, `compuesto`, `compositor`) VALUES
(1, 3, 8),
(2, 4, 9),
(3, 5, 10),
(4, 2, 7),
(6, 6, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivomarca`
--

CREATE TABLE `archivomarca` (
  `archivomarca_id` int(11) NOT NULL,
  `compuesto` int(11) NOT NULL,
  `compositor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `archivomarca`
--

INSERT INTO `archivomarca` (`archivomarca_id`, `compuesto`, `compositor`) VALUES
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(6, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebida`
--

CREATE TABLE `bebida` (
  `bebida_id` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `marca` int(11) NOT NULL,
  `denominacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` decimal(6,2) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `habilitado` tinyint(4) DEFAULT '1',
  `eliminado` tinyint(4) DEFAULT '0',
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='		';

--
-- Volcado de datos para la tabla `bebida`
--

INSERT INTO `bebida` (`bebida_id`, `categoria`, `marca`, `denominacion`, `valor`, `stock`, `habilitado`, `eliminado`, `create`, `update`) VALUES
(3, 6, 3, '1 1/2 LITRO Y MEDIO', '150.00', 50, 1, 0, '2020-11-21 02:46:08', '2020-11-21 02:46:08'),
(4, 6, 2, '1 1/2 LITRO Y MEDIO', '75.00', 20, 1, 0, '2020-11-21 03:18:34', '2020-11-21 03:18:34'),
(5, 6, 1, '1/2 MEDIO LITRO', '75.00', 70, 1, 0, '2020-11-22 22:13:02', '2020-11-22 22:13:02'),
(6, 2, 2, '1 LITRO', '130.00', 50, 1, 0, '2020-11-23 15:28:09', '2020-11-23 15:28:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bebidapedido`
--

CREATE TABLE `bebidapedido` (
  `bebidapedido_id` int(11) NOT NULL,
  `pedido` int(11) DEFAULT NULL,
  `bebida` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bebidapedido`
--

INSERT INTO `bebidapedido` (`bebidapedido_id`, `pedido`, `bebida`, `cantidad`) VALUES
(230, 155, 5, 1),
(232, 157, 6, 1),
(233, 157, 5, 1),
(234, 158, 6, 1),
(235, 158, 3, 2),
(236, 159, 4, 1),
(237, 160, 5, 1),
(238, 160, 6, 1),
(239, 161, 3, 1),
(240, 161, 5, 1),
(241, 162, 6, 1),
(242, 163, 6, 1),
(243, 163, 6, 1),
(244, 164, 3, 1),
(245, 165, 3, 1),
(247, 165, 4, 1),
(248, 166, 6, 1),
(250, 167, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(11) NOT NULL,
  `denominacion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `denominacion`) VALUES
(2, 'CERVEZAS'),
(3, 'AGUA'),
(4, 'TRAGOS'),
(5, 'CAFE'),
(6, 'GASEOSAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `apellido` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `habilitado` tinyint(4) DEFAULT '0',
  `eliminado` tinyint(4) DEFAULT '0',
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comida`
--

CREATE TABLE `comida` (
  `comida_id` int(11) NOT NULL,
  `denominacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `valor` decimal(6,2) DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` tinyint(4) DEFAULT '1',
  `eliminado` tinyint(4) DEFAULT '0',
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comida`
--

INSERT INTO `comida` (`comida_id`, `denominacion`, `descripcion`, `valor`, `imagen`, `habilitado`, `eliminado`, `create`, `update`) VALUES
(4, 'TOSTADOS', 'DOBLE MIGA', '125.00', '4202011251420495005.png', 1, 0, '2020-11-25 13:54:57', '2020-11-25 13:54:57'),
(5, 'MEDIALUNA', '', '25.00', '5202011251864527608.png', 1, 0, '2020-11-25 13:59:59', '2020-11-25 13:59:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comidapedido`
--

CREATE TABLE `comidapedido` (
  `comidapedido_id` int(11) NOT NULL,
  `pedido` int(11) DEFAULT NULL,
  `comida` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comidapedido`
--

INSERT INTO `comidapedido` (`comidapedido_id`, `pedido`, `comida`, `cantidad`) VALUES
(26, 155, 4, 0),
(27, 155, 5, 0),
(36, 157, 5, 1),
(37, 157, 4, 0),
(38, 158, 5, 1),
(39, 158, 5, 2),
(40, 158, 5, 0),
(41, 159, 5, 3),
(42, 159, 4, 1),
(43, 159, 4, 0),
(44, 159, 5, 0),
(45, 160, 4, 1),
(46, 160, 5, 3),
(48, 161, 5, 1),
(49, 161, 5, 0),
(50, 161, 4, 0),
(51, 162, 5, 3),
(52, 162, 4, 1),
(53, 162, 4, 5),
(54, 162, 5, 3),
(55, 163, 5, 3),
(56, 163, 4, 1),
(57, 163, 5, 4),
(58, 164, 5, 3),
(59, 164, 5, 1),
(60, 165, 5, 3),
(63, 165, 4, 1),
(64, 166, 4, 1),
(65, 166, 5, 1),
(66, 167, 4, 2),
(67, 167, 4, 1),
(68, 167, 5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracionmenu`
--

CREATE TABLE `configuracionmenu` (
  `configuracionmenu_id` int(11) NOT NULL,
  `denominacion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `configuracionmenu`
--

INSERT INTO `configuracionmenu` (`configuracionmenu_id`, `denominacion`, `nivel`) VALUES
(1, 'DESARROLLADOR', 9),
(2, 'ADMINISTRADOR', 3),
(3, 'Operador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `delivery`
--

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL,
  `zona` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `valor` decimal(6,2) DEFAULT NULL,
  `habilitado` tinyint(4) DEFAULT '0',
  `eliminado` tinyint(4) DEFAULT '0',
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='\n';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `estado_id` int(11) NOT NULL,
  `denominacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='						';

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`estado_id`, `denominacion`) VALUES
(1, 'PENDIENTE'),
(2, 'ENTREGADO'),
(3, 'PAGADO'),
(4, 'ANULADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `denominacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `submenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`item_id`, `denominacion`, `detalle`, `url`, `submenu`) VALUES
(1, 'Panel', 'Menú', '/menu/panel', 8),
(2, 'Agregar Ítems', 'Agregar Ítems', '/menu/agregar', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemconfiguracionmenu`
--

CREATE TABLE `itemconfiguracionmenu` (
  `itemconfiguracionmenu_id` int(11) NOT NULL,
  `compuesto` int(11) DEFAULT NULL,
  `compositor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `itemconfiguracionmenu`
--

INSERT INTO `itemconfiguracionmenu` (`itemconfiguracionmenu_id`, `compuesto`, `compositor`) VALUES
(16, 1, 1),
(17, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `localidad_id` int(11) NOT NULL,
  `denominacion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`localidad_id`, `denominacion`, `detalle`) VALUES
(1, 'Pagancillo', ''),
(2, 'Los Palacios', ''),
(3, 'Villa Unión', ''),
(4, 'Guandacol', ''),
(5, 'Banda Florida', ''),
(6, 'Aicuña', ''),
(7, 'Los Patillos', ''),
(8, 'Los Tambillos', ''),
(9, 'Santa Clara', ''),
(10, 'El Zapallar', ''),
(11, 'El Cardón', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `marca_id` int(11) NOT NULL,
  `denominacion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`marca_id`, `denominacion`) VALUES
(1, 'COCA-COLA'),
(2, 'SCHWEPPES'),
(3, 'FANTA'),
(4, 'SPRITE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `denominacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`menu_id`, `denominacion`, `icon`, `url`) VALUES
(4, 'CONFIGURACIÓN', 'fa-cogs', '#'),
(7, 'BEBIDAS', 'fa-beer', '#'),
(8, 'COMIDAS', 'fa-cutlery', '#');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
  `mesa_id` int(11) NOT NULL,
  `denominacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`mesa_id`, `denominacion`) VALUES
(1, 'UNO'),
(2, 'DOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `pedido_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `mesa` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT '1',
  `create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`pedido_id`, `fecha`, `mesa`, `estado`, `create`, `update`) VALUES
(154, '2020-11-25', 1, 1, '2020-11-25 23:02:29', '2020-11-25 23:02:29'),
(155, '2020-11-25', 1, 1, '2020-11-25 23:24:53', '2020-11-25 23:24:53'),
(156, '2020-11-25', 1, 1, '2020-11-25 23:33:36', '2020-11-25 23:33:36'),
(157, '2020-11-25', 1, 1, '2020-11-25 23:34:48', '2020-11-25 23:34:48'),
(158, '2020-11-25', 1, 1, '2020-11-26 00:11:04', '2020-11-26 00:11:04'),
(159, '2020-11-25', 1, 1, '2020-11-26 00:13:08', '2020-11-26 00:13:08'),
(160, '2020-11-25', 1, 1, '2020-11-26 01:11:01', '2020-11-26 01:11:01'),
(161, '2020-11-25', 1, 1, '2020-11-26 01:14:25', '2020-11-26 01:14:25'),
(162, '2020-11-25', 1, 1, '2020-11-26 01:20:57', '2020-11-26 01:20:57'),
(163, '2020-11-25', 1, 1, '2020-11-26 01:26:34', '2020-11-26 01:26:34'),
(164, '2020-11-25', 1, 1, '2020-11-26 01:27:28', '2020-11-26 01:27:28'),
(165, '2020-11-25', 1, 1, '2020-11-26 01:28:56', '2020-11-26 01:28:56'),
(166, '2020-11-25', 1, 1, '2020-11-26 01:34:53', '2020-11-26 01:34:53'),
(167, '2020-11-25', 1, 1, '2020-11-26 01:37:40', '2020-11-26 01:37:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submenu`
--

CREATE TABLE `submenu` (
  `submenu_id` int(11) NOT NULL,
  `denominacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `icon` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `submenu`
--

INSERT INTO `submenu` (`submenu_id`, `denominacion`, `icon`, `url`, `detalle`, `menu`) VALUES
(8, 'Menú', 'fa-cogs', '#', '', 4),
(9, 'Usuarios', NULL, '/usuario/agregar', '', 4),
(18, 'Panel', NULL, '/bebida/panel', '', 7),
(19, 'Panel', NULL, '/comida/panel', '', 8),
(20, 'Categorías', ' ', '/categoria/panel', '', 7),
(21, 'Marcas', ' ', '/marca/panel', '', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submenuconfiguracionmenu`
--

CREATE TABLE `submenuconfiguracionmenu` (
  `submenuconfiguracionmenu_id` int(11) NOT NULL,
  `compuesto` int(11) DEFAULT NULL,
  `compositor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `submenuconfiguracionmenu`
--

INSERT INTO `submenuconfiguracionmenu` (`submenuconfiguracionmenu_id`, `compuesto`, `compositor`) VALUES
(181, 1, 8),
(182, 1, 9),
(229, 2, 18),
(230, 2, 20),
(231, 2, 21),
(232, 2, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `denominacion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(1) DEFAULT NULL,
  `usuariodetalle` int(11) DEFAULT NULL,
  `configuracionmenu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `denominacion`, `nivel`, `usuariodetalle`, `configuracionmenu`) VALUES
(1, 'admin', 3, 1, 2),
(2, 'desarrollador', 9, 2, 1),
(3, 'operador', 3, 3, 3),
(4, 'lvergara', 3, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariodetalle`
--

CREATE TABLE `usuariodetalle` (
  `usuariodetalle_id` int(11) NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correoelectronico` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `token` text COLLATE utf8_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuariodetalle`
--

INSERT INTO `usuariodetalle` (`usuariodetalle_id`, `apellido`, `nombre`, `correoelectronico`, `token`) VALUES
(1, 'Gallegos', 'Eric', 'admin@admin.com', 'ff050c2a6dd7bc3e4602e9702de81d21'),
(2, 'Desarrollador', 'Admin', 'infozamba@gmail.com', '1a092790480ffafdd87c38ad89eb6653'),
(3, 'Operador', 'Operador', 'operador@operador', '3fe0a7e76ffa68cfcbf814d66e875d42'),
(4, 'Vergara', 'Luis Federico', '', 'ece342b5c8657f5e7055e71031c04bcf');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`archivo_id`);

--
-- Indices de la tabla `archivocategoria`
--
ALTER TABLE `archivocategoria`
  ADD PRIMARY KEY (`archivocategoria_id`);

--
-- Indices de la tabla `archivomarca`
--
ALTER TABLE `archivomarca`
  ADD PRIMARY KEY (`archivomarca_id`);

--
-- Indices de la tabla `bebida`
--
ALTER TABLE `bebida`
  ADD PRIMARY KEY (`bebida_id`);

--
-- Indices de la tabla `bebidapedido`
--
ALTER TABLE `bebidapedido`
  ADD PRIMARY KEY (`bebidapedido_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `comida`
--
ALTER TABLE `comida`
  ADD PRIMARY KEY (`comida_id`);

--
-- Indices de la tabla `comidapedido`
--
ALTER TABLE `comidapedido`
  ADD PRIMARY KEY (`comidapedido_id`);

--
-- Indices de la tabla `configuracionmenu`
--
ALTER TABLE `configuracionmenu`
  ADD PRIMARY KEY (`configuracionmenu_id`);

--
-- Indices de la tabla `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`estado_id`);

--
-- Indices de la tabla `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `submenu` (`submenu`);

--
-- Indices de la tabla `itemconfiguracionmenu`
--
ALTER TABLE `itemconfiguracionmenu`
  ADD PRIMARY KEY (`itemconfiguracionmenu_id`),
  ADD KEY `compuesto` (`compuesto`),
  ADD KEY `compositor` (`compositor`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`localidad_id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`marca_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`mesa_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`pedido_id`);

--
-- Indices de la tabla `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`submenu_id`),
  ADD KEY `submenu` (`menu`);

--
-- Indices de la tabla `submenuconfiguracionmenu`
--
ALTER TABLE `submenuconfiguracionmenu`
  ADD PRIMARY KEY (`submenuconfiguracionmenu_id`),
  ADD KEY `compuesto` (`compuesto`),
  ADD KEY `compositor` (`compositor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD KEY `usuariodetalle` (`usuariodetalle`),
  ADD KEY `configuracionmenu` (`configuracionmenu`);

--
-- Indices de la tabla `usuariodetalle`
--
ALTER TABLE `usuariodetalle`
  ADD PRIMARY KEY (`usuariodetalle_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `archivo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `archivocategoria`
--
ALTER TABLE `archivocategoria`
  MODIFY `archivocategoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `archivomarca`
--
ALTER TABLE `archivomarca`
  MODIFY `archivomarca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bebida`
--
ALTER TABLE `bebida`
  MODIFY `bebida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bebidapedido`
--
ALTER TABLE `bebidapedido`
  MODIFY `bebidapedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comida`
--
ALTER TABLE `comida`
  MODIFY `comida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `comidapedido`
--
ALTER TABLE `comidapedido`
  MODIFY `comidapedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `configuracionmenu`
--
ALTER TABLE `configuracionmenu`
  MODIFY `configuracionmenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `delivery`
--
ALTER TABLE `delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `itemconfiguracionmenu`
--
ALTER TABLE `itemconfiguracionmenu`
  MODIFY `itemconfiguracionmenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `localidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `marca_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
  MODIFY `mesa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `submenuconfiguracionmenu`
--
ALTER TABLE `submenuconfiguracionmenu`
  MODIFY `submenuconfiguracionmenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuariodetalle`
--
ALTER TABLE `usuariodetalle`
  MODIFY `usuariodetalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`submenu`) REFERENCES `submenu` (`submenu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `itemconfiguracionmenu`
--
ALTER TABLE `itemconfiguracionmenu`
  ADD CONSTRAINT `itemconfiguracionmenu_ibfk_1` FOREIGN KEY (`compuesto`) REFERENCES `configuracionmenu` (`configuracionmenu_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `itemconfiguracionmenu_ibfk_2` FOREIGN KEY (`compositor`) REFERENCES `item` (`item_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`menu`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `submenuconfiguracionmenu`
--
ALTER TABLE `submenuconfiguracionmenu`
  ADD CONSTRAINT `submenuconfiguracionmenu_ibfk_1` FOREIGN KEY (`compuesto`) REFERENCES `configuracionmenu` (`configuracionmenu_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submenuconfiguracionmenu_ibfk_2` FOREIGN KEY (`compositor`) REFERENCES `submenu` (`submenu_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`usuariodetalle`) REFERENCES `usuariodetalle` (`usuariodetalle_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
