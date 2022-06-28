-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-06-2022 a las 23:02:43
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ingresos_sena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id_dispositivos` bigint(20) NOT NULL,
  `dispositivo` varchar(50) NOT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `placa` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `cantidad` bigint(20) DEFAULT NULL,
  `propiedad` varchar(50) DEFAULT NULL,
  `autoriza` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id_dispositivos`, `dispositivo`, `serial`, `placa`, `marca`, `cantidad`, `propiedad`, `autoriza`) VALUES
(13, 'portatil', '12312412', 'asdase1221', 'Samsung', 1, 'sena', NULL),
(14, 'celular', '123456789', 'dasdq', 'Dell', 1, 'personal', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `codigo_ingreso` bigint(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `motivo` varchar(50) NOT NULL,
  `cedula` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`codigo_ingreso`, `fecha`, `hora`, `estado`, `motivo`, `cedula`) VALUES
(1210, '2022-06-28', '15:12:13', 'INGRESO', '', '123456789');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresodispositivo`
--

CREATE TABLE `ingresodispositivo` (
  `iddis` bigint(20) NOT NULL,
  `id_dispositivos` bigint(20) DEFAULT NULL,
  `codigo_ingreso` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ingresodispositivo`
--

INSERT INTO `ingresodispositivo` (`iddis`, `id_dispositivos`, `codigo_ingreso`) VALUES
(5, 13, 1210),
(6, 14, 1210);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusu` bigint(20) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `sede` varchar(250) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusu`, `cedula`, `nombres`, `correo`, `contrasena`, `sede`, `rol`) VALUES
(1, '123456789', 'Brayan Jesús Charris Cantillo', 'bjcharris4@misena.edu.co', 'Sena2022', 'Sede TIC', 'instructor');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id_dispositivos`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`codigo_ingreso`);

--
-- Indices de la tabla `ingresodispositivo`
--
ALTER TABLE `ingresodispositivo`
  ADD PRIMARY KEY (`iddis`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivos` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ingresodispositivo`
--
ALTER TABLE `ingresodispositivo`
  MODIFY `iddis` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
