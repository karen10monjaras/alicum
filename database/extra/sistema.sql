-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2023 a las 10:24:04
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
(1, 'Alimento para pollo de 5 kg', 65, 100),
(2, 'Alimento para pollo de 10kg', 120, 19),
(3, 'Alimento para pollo de 20kg', 240, 12),
(4, 'Alimento para cerdo de 40kg', 490, 12),
(5, 'Galletas ricanela', 20, 34),
(8, 'vitafor 10 ml', 66, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` text NOT NULL,
  `telefono` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre_cliente`, `telefono`) VALUES
(1, 'Cliente generico', 'Indefinido'),
(2, 'Empresa x2', '(435) 256-5798'),
(4, 'Alejandro Jimenez Ochoa', '924 235 5331');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_transaccion`, `id_producto`, `cantidad_producto`) VALUES
(1, 1, 1, 10),
(2, 1, 2, 10),
(3, 2, 3, 30),
(4, 2, 4, 20),
(7, 3, 5, 12),
(8, 3, 1, 100),
(10, 5, 8, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` text NOT NULL,
  `telefono_proveedor` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre_proveedor`, `telefono_proveedor`) VALUES
(1, 'CAMPI', '(924) 154-4675'),
(2, 'PURINA', '(924) 456-6472'),
(5, 'BAYER', '923 4353 3423');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_compras`
--

CREATE TABLE `transaccion_compras` (
  `id_transaccion` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_compras`
--

INSERT INTO `transaccion_compras` (`id_transaccion`, `fecha_compra`, `id_proveedor`, `id_usuario`, `total_compra`) VALUES
(1, '2023-10-13 17:16:36', 1, 1, 0),
(2, '2023-10-13 17:16:36', 2, 1, 0),
(3, '2023-10-30 09:11:13', 1, 1, 6740),
(5, '2023-10-30 09:16:18', 5, 1, 1320);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_ventas`
--

CREATE TABLE `transaccion_ventas` (
  `id_transaccion` int(11) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total_venta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_ventas`
--

INSERT INTO `transaccion_ventas` (`id_transaccion`, `fecha_venta`, `id_cliente`, `id_usuario`, `total_venta`) VALUES
(4, '2023-10-28 00:47:54', 1, 1, 65),
(5, '2023-10-28 00:49:24', 1, 1, 490),
(6, '2023-10-28 01:45:25', 1, 1, 1090),
(7, '2023-10-28 01:54:47', 1, 1, 130),
(9, '2023-10-28 02:00:49', 1, 1, 65),
(10, '2023-10-28 02:03:54', 1, 1, 65),
(11, '2023-10-28 02:05:05', 1, 1, 65),
(12, '2023-10-28 02:06:31', 1, 1, 130),
(13, '2023-10-28 02:23:49', 1, 1, 120),
(14, '2023-10-28 02:24:17', 1, 1, 240),
(15, '2023-10-28 02:44:26', 1, 1, 65),
(16, '2023-10-28 02:58:36', 1, 1, 65),
(23512, '2023-10-28 04:36:37', 1, 1, 1100),
(23513, '2023-10-30 01:36:04', 1, 1, 40),
(23514, '2023-10-30 01:55:11', 1, 1, 120),
(23515, '2023-10-30 01:59:17', 1, 1, 240),
(23516, '2023-10-30 02:00:36', 1, 1, 850),
(23517, '2023-10-30 06:03:02', 1, 1, 0),
(23518, '2023-10-30 06:58:07', 1, 1, 65),
(23519, '2023-10-30 07:01:15', 1, 1, 120),
(23520, '2023-10-30 07:02:47', 1, 1, 490),
(23521, '2023-10-30 07:05:06', 1, 1, 490),
(23522, '2023-10-30 07:10:28', 4, 1, 610);

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
(1, 'KAREN YAMILET MONJARAS HERNÁNDEZ', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_transaccion`, `id_producto`, `cantidad_producto`) VALUES
(8, 4, 1, 1),
(9, 5, 4, 1),
(10, 6, 3, 2),
(11, 6, 2, 1),
(12, 6, 4, 1),
(13, 7, 1, 2),
(14, 9, 1, 1),
(15, 10, 1, 1),
(16, 11, 1, 1),
(17, 12, 1, 2),
(18, 13, 2, 1),
(19, 14, 3, 1),
(20, 15, 1, 1),
(21, 16, 1, 1),
(23, 23512, 1, 2),
(24, 23512, 4, 1),
(25, 23512, 3, 2),
(26, 23513, 5, 2),
(27, 23514, 5, 6),
(28, 23515, 5, 12),
(29, 23516, 1, 2),
(30, 23516, 3, 3),
(36, 23518, 1, 1),
(37, 23519, 2, 1),
(38, 23520, 4, 1),
(40, 23521, 4, 1),
(41, 23522, 2, 1),
(42, 23522, 4, 1);

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
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion_compras`
--
ALTER TABLE `transaccion_compras`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `transaccion_ventas`
--
ALTER TABLE `transaccion_ventas`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23524;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
