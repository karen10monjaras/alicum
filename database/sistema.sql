-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2023 a las 18:37:21
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` text NOT NULL,
  `precio_producto` float NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_producto`, `nombre_producto`, `precio_producto`, `stock`) VALUES
(1, 'Alimento de cerdo 40kg', 400, 29),
(2, 'Alimento de pollo 1kg', 20, 105),
(5, 'Alimento de pollo 5kg', 66, 10),
(6, 'Jabón Asuntol', 40, 133),
(7, 'Pollinaza', 2.1, 992988),
(8, 'Maiz Entero / Molido', 6.4, 1997000),
(9, 'Melaza', 5.5, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` text NOT NULL,
  `telefono_cliente` varchar(18) NOT NULL,
  `domicilio_cliente` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono_cliente`, `domicilio_cliente`) VALUES
(1, 'Cliente genérico', '-', 'Conocido'),
(4, 'Joel Garcia Ochoa', '924 235 2342', 'Calle Aldama Acayucan, Ver.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_compra` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_transaccion`, `id_producto`, `cantidad_producto`, `precio_compra`) VALUES
(9, 6, 2, 1, 0),
(10, 7, 1, 1, 0),
(11, 7, 2, 1, 0),
(12, 8, 1, 1, 0),
(13, 8, 2, 1, 0),
(15, 10, 1, 15, 420),
(17, 11, 1, 20, 410),
(18, 11, 2, 100, 20),
(19, 12, 5, 20, 68),
(21, 14, 6, 25, 42),
(22, 15, 9, 100, 5),
(23, 15, 8, 2000000, 6),
(24, 15, 7, 1000000, 2),
(25, 16, 6, 100, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` text NOT NULL,
  `telefono_proveedor` varchar(18) NOT NULL,
  `domicilio_proveedor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `telefono_proveedor`, `domicilio_proveedor`) VALUES
(1, 'Purina', '924 234 3455', 'Sayula de Aleman'),
(3, 'Campi', '924 324 3452', 'Bd. Lopez Arias, Matias Romero Av. Oax'),
(4, 'Bayer', '924 2342 4312', 'Av. Guerrero, Acayucan, Ver');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_compras`
--

CREATE TABLE `transaccion_compras` (
  `id_transaccion` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total_compra` float NOT NULL,
  `descripcion_compra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_compras`
--

INSERT INTO `transaccion_compras` (`id_transaccion`, `fecha_compra`, `id_proveedor`, `id_usuario`, `total_compra`, `descripcion_compra`) VALUES
(6, '2023-11-12 06:03:57', 1, 1, 20, ''),
(7, '2023-11-12 06:22:31', 1, 1, 420, ''),
(8, '2023-11-12 06:29:03', 1, 1, 420, ''),
(9, '2023-11-12 11:25:40', 1, 1, 480, ''),
(10, '2023-11-12 12:40:24', 1, 1, 6900, ''),
(11, '2023-11-12 15:27:43', 1, 1, 10200, 'Pagado en efectivo'),
(12, '2023-11-12 15:39:23', 3, 1, 1360, ''),
(14, '2023-11-12 17:47:57', 4, 1, 1050, ''),
(15, '2023-11-13 06:22:58', 3, 1, 14000500, ''),
(16, '2023-11-13 06:45:20', 4, 1, 4250, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_ventas`
--

CREATE TABLE `transaccion_ventas` (
  `id_transaccion` int(11) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total_venta` float NOT NULL,
  `descripcion_venta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_ventas`
--

INSERT INTO `transaccion_ventas` (`id_transaccion`, `fecha_venta`, `id_cliente`, `id_usuario`, `total_venta`, `descripcion_venta`) VALUES
(5, '2023-11-12 14:45:58', 1, 1, 900, 'Efectivo'),
(6, '2023-11-10 15:36:14', 1, 1, 4200, 'Efectivo'),
(7, '2023-11-12 17:04:21', 1, 1, 132, 'Efectivo'),
(8, '2023-11-12 17:05:05', 1, 1, 400, 'Efectivo'),
(12, '2023-11-12 17:53:27', 1, 1, 0, ''),
(13, '2023-11-12 17:59:22', 1, 1, 40, ''),
(14, '2023-11-12 18:01:14', 1, 1, 1086, 'Pago en efectivo'),
(15, '2023-11-12 18:43:24', 1, 1, 798, 'Pago en Efectivo'),
(16, '2023-11-13 04:53:32', 1, 1, 1200, ''),
(19, '2023-11-13 05:21:54', 1, 1, 3600, 'Pagado en efectivo'),
(20, '2023-11-13 05:39:38', 1, 1, 2480, 'Efectivo'),
(21, '2023-11-13 06:12:05', 1, 1, 2764, 'Pagado en efectivo'),
(22, '2023-11-13 06:25:00', 1, 1, 10627.5, ''),
(24, '2023-11-13 06:42:40', 1, 1, 2100, '-'),
(25, '2023-11-13 06:44:01', 1, 1, 2100, 'Efectivo'),
(26, '2023-11-13 08:13:25', 1, 1, 2100, 'Efectivo'),
(27, '2023-11-13 08:15:47', 1, 1, 10875, 'Pagado 11000, total 10,875.00, cambio 125.00'),
(28, '2023-11-13 08:21:16', 1, 1, 25.2, 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `nombre_usuario` text NOT NULL,
  `contrasenia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `nombre_usuario`, `contrasenia`) VALUES
(1, 'KAREN YAMILET MONJARAS HERNÁNDEZ', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'ARTURO SALAS HERNANDEZ', 'arturo15', '65e313615c709400f57b2c19b11931eabffd8cf6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_venta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_transaccion`, `id_producto`, `cantidad_producto`, `precio_venta`) VALUES
(8, 5, 1, 2, 400),
(9, 5, 2, 5, 20),
(10, 6, 1, 10, 400),
(11, 6, 2, 10, 20),
(12, 7, 5, 2, 66),
(13, 8, 1, 1, 400),
(14, 13, 6, 1, 40),
(15, 14, 6, 4, 40),
(16, 14, 1, 2, 400),
(17, 14, 2, 3, 20),
(18, 14, 5, 1, 66),
(19, 15, 1, 1, 400),
(20, 15, 2, 2, 20),
(21, 15, 5, 3, 66),
(22, 15, 6, 4, 40),
(23, 16, 1, 3, 400),
(25, 19, 1, 3, 1200),
(26, 20, 1, 2, 1200),
(27, 20, 6, 2, 40),
(28, 21, 1, 2, 1200),
(29, 21, 2, 3, 20),
(30, 21, 5, 4, 66),
(31, 21, 6, 1, 40),
(32, 22, 9, 5, 6),
(33, 22, 8, 1000, 6),
(34, 22, 7, 2000, 2),
(36, 24, 7, 1000, 2),
(37, 25, 7, 1000, 2.1),
(38, 26, 7, 1000, 2.1),
(39, 27, 8, 1000, 6.4),
(40, 27, 7, 2000, 2.1),
(41, 27, 9, 50, 5.5),
(42, 28, 7, 12, 2.1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `compras_ibfk_1` (`id_transaccion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `transaccion_compras`
--
ALTER TABLE `transaccion_compras`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `transaccion_ventas`
--
ALTER TABLE `transaccion_ventas`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_transaccion` (`id_transaccion`),
  ADD KEY `id_producto` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transaccion_compras`
--
ALTER TABLE `transaccion_compras`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `transaccion_ventas`
--
ALTER TABLE `transaccion_ventas`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_transaccion`) REFERENCES `transaccion_compras` (`id_transaccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `almacen` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transaccion_compras`
--
ALTER TABLE `transaccion_compras`
  ADD CONSTRAINT `transaccion_compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaccion_compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transaccion_ventas`
--
ALTER TABLE `transaccion_ventas`
  ADD CONSTRAINT `transaccion_ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaccion_ventas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_transaccion`) REFERENCES `transaccion_ventas` (`id_transaccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `almacen` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
