-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2024 a las 19:42:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallespedido`
--

CREATE TABLE `detallespedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha_pedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_pedido` enum('pendiente','en_proceso','completado') DEFAULT 'pendiente',
  `total` decimal(10,2) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `detalles` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `fecha_pedido`, `estado_pedido`, `total`, `direccion`, `detalles`) VALUES
(101, 3, '2024-05-19 16:27:36', NULL, 70.00, 'Recibe: MELISSA, en calle: palmas, colonia: Emiliano Zapata, CP: 92853, Teléfono: 7894561235. Instrucciones de entrega: ninguna', 'Producto 5'),
(102, 3, '2024-05-19 16:28:45', NULL, 60.00, 'Recibe: MELISSA, en calle: palmas, colonia: Emiliano Zapata, CP: 92853, Teléfono: 7894561235. Instrucciones de entrega: ninguna', 'Producto 4'),
(103, 3, '2024-05-19 16:32:01', NULL, 200.00, 'Recibe: MELISSA, en calle: palmas, colonia: Emiliano Zapata, CP: 92853, Teléfono: 7894561235. Instrucciones de entrega: ninguna', 'Producto 1'),
(104, 3, '2024-05-19 16:32:47', NULL, 70.00, 'Recibe: MELISSA, en calle: palmas, colonia: Emiliano Zapata, CP: 92853, Teléfono: 7894561235. Instrucciones de entrega: ninguna', 'Producto 5'),
(105, 3, '2024-05-19 16:34:56', NULL, 40.00, 'Recibe: MELISSA, en calle: palmas, colonia: Emiliano Zapata, CP: 92853, Teléfono: 7894561235. Instrucciones de entrega: ninguna', 'Producto 1'),
(106, 3, '2024-05-19 17:35:35', NULL, 560.00, 'Recibe: MELISSA, en calle: palmas, colonia: Emiliano Zapata, CP: 92853, Teléfono: 7894561235. Instrucciones de entrega: ninguna', 'Producto 5, Producto 5, Producto 5, Producto 5, Producto 5, Producto 5, Producto 5, Producto 5, Producto 5, Producto 5, Producto 5'),
(107, 1, '2024-05-19 17:37:43', NULL, 150.00, 'Recibe: Jorge Marcos, en calle: palmeras, colonia: emiliano zapatilla, CP: 92858, Teléfono: 7831279890. Instrucciones de entrega: pilin', 'Producto 1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(38, 'Producto 4', 'descripcion de producto 4', 30.00, 'Producto4.jpg'),
(39, 'Producto 5', 'descripcion de producto 5', 35.00, 'Producto5.jpg'),
(40, 'Producto 6', 'descripcion de producto 6', 40.00, 'Background.jpg'),
(47, 'Producto 1', 'descripcion de producto 1', 50.00, 'Producto1.jpg'),
(48, 'Producto 2', 'descripcion de producto 2', 35.00, 'Producto2.jpg'),
(49, 'Producto 3', 'descripcion de producto 3', 20.00, 'Producto3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetasusuario`
--

CREATE TABLE `tarjetasusuario` (
  `id` int(11) NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `ultimos_digitos` char(4) NOT NULL,
  `nombre_titular` varchar(255) NOT NULL,
  `fecha_expiracion` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tarjetasusuario`
--

INSERT INTO `tarjetasusuario` (`id`, `usuario_id`, `token`, `ultimos_digitos`, `nombre_titular`, `fecha_expiracion`) VALUES
(38, 3, '5555 6546 8445 9452', '1234', 'Jorge Luis Marcos Canales', '11/26'),
(39, 1, '5553 6366 2556 2626', '1234', 'Jorge Luis Marcos Canales', '11/23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `idUbicacion` int(10) UNSIGNED NOT NULL,
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `C.P.` varchar(5) DEFAULT NULL,
  `calle` varchar(50) DEFAULT NULL,
  `colonia` varchar(80) DEFAULT NULL,
  `numTelefono` varchar(10) DEFAULT NULL,
  `instruccionesEntrega` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`idUbicacion`, `idUsuario`, `nombre`, `C.P.`, `calle`, `colonia`, `numTelefono`, `instruccionesEntrega`) VALUES
(24, 1, 'Luis Mario Marcos Canales', '92858', 'palmeras', 'emiliano zapatilla', '7831279890', 'pilin'),
(25, 3, 'Melissa Hernandez Cano', '92853', 'palmas', 'Emiliano Zapata', '7894561235', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`idUsuario`, `username`, `password`, `email`) VALUES
(1, 'Jorge Marcos', '$2y$10$2q7ZbincfJMEH8RKqAs/1.pFJDKloJwBgeWXFKLTVrWwp8Lx1emGq', 'luismar1345@gmail.com'),
(3, 'MELISSA', '$2y$10$Jic3gidwEo/04HQP3c096eZMKtwRIEIOCVXEh0cp3OuiIiTDuqy6.', 'luimar1345@gmail.com'),
(4, 'Tilin', '$2y$10$lLRgDS8/u.F96C6f6UIAm.lwNNR0YHvKeK/nVfjvHQ2uIEcJuPqbu', 'tilin@gmail.coom'),
(5, 'Luis Mario', '$2y$10$cTD8msQXQrZg/agbfRpmD.fwp6klAm3PzNeBSfksQxlmF/2Ypb0wG', 'mariolmc2008@gmail.com'),
(6, 'luis marcos', '$2y$10$wSClAve91RQDr2Kp.9EOW.qVado3WZsrdBrSbIUWjSPRnWJQimk8u', 'luism1951@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Nombre` varchar(11) NOT NULL,
  `Apellido` varchar(11) NOT NULL,
  `ID` int(10) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Nombre`, `Apellido`, `ID`, `mail`, `password`) VALUES
('Jorge', 'Marcos', 11111, 'luismar1234@gmail.com', 123456);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detallespedido`
--
ALTER TABLE `detallespedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `tarjetasusuario`
--
ALTER TABLE `tarjetasusuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`idUbicacion`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detallespedido`
--
ALTER TABLE `detallespedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `tarjetasusuario`
--
ALTER TABLE `tarjetasusuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `idUbicacion` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `idUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11113;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallespedido`
--
ALTER TABLE `detallespedido`
  ADD CONSTRAINT `FK_detallespedido_productos` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallespedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detallespedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `tarjetasusuario`
--
ALTER TABLE `tarjetasusuario`
  ADD CONSTRAINT `tarjetasusuario_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `users` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
