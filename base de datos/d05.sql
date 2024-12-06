-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-05-2024 a las 23:19:31
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
-- Base de datos: `d05`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `correo`, `pass`) VALUES
(1, 'Ramiro Zavala', 'ramiro@correo.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Héctor Aceves ', 'hector@correo.com', 'e35cf7b66449df565f93c607d5a81d09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellidos` varchar(128) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `rol` int(1) NOT NULL,
  `archivo_nombre` varchar(255) NOT NULL,
  `archivo_file` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellidos`, `correo`, `pass`, `rol`, `archivo_nombre`, `archivo_file`, `status`, `eliminado`) VALUES
(1, 'David Guadalupe', 'Fernández Venegas', 'david@correo.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'images.jfif', '05700d19c8fafeb5f9708fee1894e2fd.jfif', 1, 0),
(2, 'María', 'García Martínez', 'maria@correo.com', '9c38641fc6eb6a0e8337006b6d586d80', 2, 'images (2).jfif', '23fbe966981967ac2aea736a5ea5926e.jfif', 1, 0),
(3, 'Juan Carlos', 'López Sánchez', 'juan@correo.com', 'e35cf7b66449df565f93c607d5a81d09', 2, 'images (1).jfif', 'f829aa9407def0b9832d3f400cad7f51.jfif', 1, 0),
(4, 'Ana', 'Pérez Rodríguez', 'ana@correo.com', '4c1acc6890214b88cadd4b0d63820691', 1, 'images (3).jfif', 'fee217086f640999aa87d6098e3ca965.jfif', 1, 0),
(5, 'Pedro José', 'Ortiz Reyes', 'pedro@correo.com', 'ccdcdd204013ab2c6854274f4b85114e', 2, 'images (1).jfif', 'f829aa9407def0b9832d3f400cad7f51.jfif', 1, 0),
(20, 'Fernanda', 'López Garza', 'fernando@correo.com', '536f868c09cfbc81399401da424e42e6', 1, 'images (4).jfif', 'cce9011986cd935c7486f7fcfe9089eb.jfif', 1, 0),
(29, 'Luis', 'Flores Plasencia', 'luis@correo.com', '10188a8cb505596f6c0893dfbcabfd95', 2, 'images.jfif', '05700d19c8fafeb5f9708fee1894e2fd.jfif', 1, 0),
(30, 'Bryan', 'Solís del Campo', 'bryan@correo.com', 'fcea920f7412b5da7be0cf42b8c93759', 2, 'Ejemplo2.png', '0574c8cc9847e3263cfd638b8842d07a.png', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `id_usuario`, `status`) VALUES
(1, '2024-05-21', 1, 1),
(2, '2024-05-22', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_productos`
--

CREATE TABLE `pedidos_productos` (
  `id` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos_productos`
--

INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`, `precio`) VALUES
(1, 1, 3, 2, 6500.35),
(2, 1, 4, 3, 12700.2),
(3, 2, 1, 5, 12000.25),
(4, 2, 2, 10, 14500.1),
(5, 2, 8, 7, 7000.9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `codigo` varchar(32) NOT NULL,
  `descripcion` text NOT NULL,
  `costo` double NOT NULL,
  `stock` int(11) NOT NULL,
  `archivo_nombre` varchar(255) NOT NULL,
  `archivo` varchar(128) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `codigo`, `descripcion`, `costo`, `stock`, `archivo_nombre`, `archivo`, `status`, `eliminado`) VALUES
(1, 'Play 5', 'PS5123', 'Consola de videojuegos SONY.', 12500.25, 25, 'Play 5.jpg', '55c176cf5e4881747b2f1c80bf746ac5.jpg', 1, 0),
(2, 'iPhone 15', 'IPH456', 'Celular inteligente Apple.', 14500.1, 20, 'iphone 15.jfif', 'f6b332ea6740692578e902c2c1d203c9.jfif', 1, 0),
(3, 'Nintendo switch', 'NSW789', 'Consola de videojuegos Nintendo.', 6500.35, 30, 'switch.jfif', '3745755521c5d748c5a8bb5acda40f0d.jfif', 1, 0),
(4, 'Xbox Series X ', 'XSX147', 'Consola de videojuegos Microsoft.', 12700.2, 15, 'xbox.jpg', '254b03c5b63085f4acd9a7120ad56c88.jpg', 1, 0),
(8, 'Xbox Series S', 'XSS147', 'Consola de videojuegos Microsoft.', 7000.9, 80, 'XBSS.jpg', 'b7aca149ebc78dd83fbee8e0206a979c.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `archivo` varchar(64) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `eliminado` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id`, `nombre`, `archivo`, `status`, `eliminado`) VALUES
(3, 'PROMO XBOX', 'f6b332ea6740692578e902c2c1d203c9.jfif', 1, 0),
(7, 'Promociones 2x1', 'dafed3ea138c262e1e149faf32a58d70.jpg', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos_productos`
--
ALTER TABLE `pedidos_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
