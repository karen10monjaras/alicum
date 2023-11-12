-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2023 a las 16:32:08
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
(1, 'Alimento de cerdo 40kg', 400, 56),
(2, 'Alimento de pollo 1kg', 20, 123);

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
(1, 'cliente genérico', '', 'Conocido'),
(3, 'prueba', '2425345345', 'p');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `precio_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_transaccion`, `id_producto`, `cantidad_producto`, `precio_compra`) VALUES
(5, 2, 1, 1000, 0),
(6, 3, 2, 40, 0),
(7, 4, 1, 12, 0),
(8, 5, 1, 1, 0),
(9, 6, 2, 1, 0),
(10, 7, 1, 1, 0),
(11, 7, 2, 1, 0),
(12, 8, 1, 1, 0),
(13, 8, 2, 1, 0),
(15, 10, 1, 15, 420),
(17, 11, 1, 20, 410),
(18, 11, 2, 100, 20);

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
(1, 'Purina', '924 234 3455', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_compras`
--

CREATE TABLE `transaccion_compras` (
  `id_transaccion` int(11) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_proveedor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total_compra` int(11) NOT NULL,
  `descripcion_compra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_compras`
--

INSERT INTO `transaccion_compras` (`id_transaccion`, `fecha_compra`, `id_proveedor`, `id_usuario`, `total_compra`, `descripcion_compra`) VALUES
(2, '2023-11-07 06:39:24', 1, 1, 400000, ''),
(3, '2023-11-07 06:53:16', 1, 1, 800, ''),
(4, '2023-11-12 05:57:18', 1, 1, 4800, ''),
(5, '2023-11-12 05:59:34', 1, 1, 400, ''),
(6, '2023-11-12 06:03:57', 1, 1, 20, ''),
(7, '2023-11-12 06:22:31', 1, 1, 420, ''),
(8, '2023-11-12 06:29:03', 1, 1, 420, ''),
(9, '2023-11-12 11:25:40', 1, 1, 480, ''),
(10, '2023-11-12 12:40:24', 1, 1, 6900, ''),
(11, '2023-11-12 15:27:43', 1, 1, 10200, 'Pagado en efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_ventas`
--

CREATE TABLE `transaccion_ventas` (
  `id_transaccion` int(11) NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total_venta` double NOT NULL,
  `descripcion_venta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_ventas`
--

INSERT INTO `transaccion_ventas` (`id_transaccion`, `fecha_venta`, `id_cliente`, `id_usuario`, `total_venta`, `descripcion_venta`) VALUES
(1, '2023-11-07 06:53:34', 1, 1, 200, ''),
(3, '2023-11-12 11:29:11', 1, 1, 48, ''),
(4, '2023-11-12 14:31:28', 1, 1, 880, 'Contado'),
(5, '2023-11-12 14:45:58', 1, 1, 900, 'Efectivo');

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
  `precio_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `id_transaccion`, `id_producto`, `cantidad_producto`, `precio_venta`) VALUES
(2, 1, 2, 10, 0),
(6, 4, 1, 2, 0),
(7, 4, 2, 4, 0),
(8, 5, 1, 2, 400),
(9, 5, 2, 5, 20);

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
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transaccion_compras`
--
ALTER TABLE `transaccion_compras`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `transaccion_ventas`
--
ALTER TABLE `transaccion_ventas`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
