-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2023 a las 20:08:08
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
  `stock` int(11) NOT NULL,
  `categoria_producto` enum('producto','alimento_fabricado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_producto`, `nombre_producto`, `precio_producto`, `stock`, `categoria_producto`) VALUES
(1, 'Alimento de cerdo 40kg', 400, 30, 'alimento_fabricado'),
(2, 'Alimento de pollo 1kg', 20, 105, 'producto'),
(5, 'Alimento de pollo 5kg', 66, 10, 'producto'),
(6, 'Jabón Asuntol', 40, 133, 'producto'),
(10, 'Alimento de pollo 20kg', 70, 0, 'alimento_fabricado'),
(11, 'Alimento de pollo 5kg', 25, 0, 'alimento_fabricado'),
(13, 'Material primario 1', 10, 200, 'producto'),
(14, 'Material primario 2', 20, 300, 'producto'),
(15, 'Material primario 3', 30, 400, 'producto');

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
(17, 11, 1, 20, 410),
(18, 11, 2, 100, 20),
(19, 12, 5, 20, 68),
(21, 14, 6, 25, 42),
(30, 20, 13, 200, 12),
(31, 20, 14, 300, 22),
(32, 20, 15, 400, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulas`
--

CREATE TABLE `formulas` (
  `id_formula` int(11) NOT NULL,
  `id_transaccion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `formulas`
--

INSERT INTO `formulas` (`id_formula`, `id_transaccion`, `id_producto`, `cantidad_producto`) VALUES
(28, 19, 13, 50),
(29, 19, 14, 25),
(30, 20, 14, 10),
(31, 20, 15, 20);

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
(11, '2023-11-12 15:27:43', 1, 1, 10200, 'Pagado en efectivo'),
(12, '2023-11-12 15:39:23', 3, 1, 1360, ''),
(14, '2023-11-12 17:47:57', 4, 1, 1050, ''),
(20, '2023-11-17 19:00:47', 3, 1, 21800, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion_formulas`
--

CREATE TABLE `transaccion_formulas` (
  `id_transaccion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `transaccion_formulas`
--

INSERT INTO `transaccion_formulas` (`id_transaccion`, `id_producto`) VALUES
(19, 1),
(20, 10);

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
(13, '2023-11-12 17:59:22', 1, 1, 40, ''),
(14, '2023-11-12 18:01:14', 1, 1, 1086, 'Pago en efectivo'),
(15, '2023-11-12 18:43:24', 1, 1, 798, 'Pago en Efectivo'),
(16, '2023-11-13 04:53:32', 1, 1, 1200, ''),
(19, '2023-11-13 05:21:54', 1, 1, 3600, 'Pagado en efectivo'),
(20, '2023-11-13 05:39:38', 1, 1, 2480, 'Efectivo'),
(21, '2023-11-13 06:12:05', 1, 1, 2764, 'Pagado en efectivo');

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
(31, 21, 6, 1, 40);

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
-- Indices de la tabla `formulas`
--
ALTER TABLE `formulas`
  ADD PRIMARY KEY (`id_formula`),
  ADD KEY `id_transaccion` (`id_transaccion`),
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
-- Indices de la tabla `transaccion_formulas`
--
ALTER TABLE `transaccion_formulas`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_producto` (`id_producto`);

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
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `formulas`
--
ALTER TABLE `formulas`
  MODIFY `id_formula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transaccion_compras`
--
ALTER TABLE `transaccion_compras`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `transaccion_formulas`
--
ALTER TABLE `transaccion_formulas`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `transaccion_ventas`
--
ALTER TABLE `transaccion_ventas`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
-- Filtros para la tabla `formulas`
--
ALTER TABLE `formulas`
  ADD CONSTRAINT `formulas_ibfk_1` FOREIGN KEY (`id_transaccion`) REFERENCES `transaccion_formulas` (`id_transaccion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formulas_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `almacen` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transaccion_compras`
--
ALTER TABLE `transaccion_compras`
  ADD CONSTRAINT `transaccion_compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaccion_compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `transaccion_formulas`
--
ALTER TABLE `transaccion_formulas`
  ADD CONSTRAINT `transaccion_formulas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `almacen` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

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
