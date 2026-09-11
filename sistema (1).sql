-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2026 a las 20:22:05
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
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambulancia`
--

CREATE TABLE `ambulancia` (
  `id` int(11) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `matricula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `id` int(11) NOT NULL,
  `nombre_documento` varchar(70) NOT NULL,
  `tipo_documento` varchar(100) NOT NULL,
  `qr` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `Cantidad_preguntas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipamiento`
--

CREATE TABLE `equipamiento` (
  `id` int(11) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `contrasenia` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra`
--

CREATE TABLE `muestra` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `tipo_preguntas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `datos` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id` int(11) NOT NULL,
  `origen` varchar(255) NOT NULL,
  `t_ruta` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslado`
--

CREATE TABLE `traslado` (
  `id` int(11) NOT NULL,
  `fecha` time(6) NOT NULL,
  `hora` date NOT NULL,
  `salida` varchar(200) NOT NULL,
  `llegada` varchar(200) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambulancia`
--
ALTER TABLE `ambulancia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricula` (`matricula`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `n_serie` (`n_serie`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `contrasenia` (`contrasenia`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_insumos` (`id`);

--
-- Indices de la tabla `muestra`
--
ALTER TABLE `muestra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cedula` (`cedula`) USING BTREE;

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traslado`
--
ALTER TABLE `traslado`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_persona` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_funcionariopersona` FOREIGN KEY (`id`) REFERENCES `personas` (`id`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `fk_paciente_persona` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
