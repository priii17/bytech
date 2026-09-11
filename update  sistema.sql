-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-09-2026 a las 14:59:53
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
  `qr` varchar(500) NOT NULL,
  `id_funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE `encuesta` (
  `id` int(11) NOT NULL,
  `Cantidad_preguntas` varchar(100) NOT NULL,
  `id_funcionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipamiento`
--

CREATE TABLE `equipamiento` (
  `id` int(11) NOT NULL,
  `n_serie` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_traslado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `contrasenia` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario_traslado`
--

CREATE TABLE `funcionario_traslado` (
  `id_funcionario` int(11) NOT NULL,
  `id_traslado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_traslado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra`
--

CREATE TABLE `muestra` (
  `id` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `id` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estado` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_encuesta`
--

CREATE TABLE `paciente_encuesta` (
  `id_paciente` int(11) NOT NULL,
  `id_encuesta` int(11) NOT NULL
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
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `cedula`, `nombre`, `apellido`, `fecha_nacimiento`) VALUES
(4, '5209857', 'pri', 'ramos', '2026-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `tipo_preguntas` varchar(100) NOT NULL,
  `id_encuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_traslado`
--

CREATE TABLE `registro_traslado` (
  `id` int(11) NOT NULL,
  `elemento` varchar(50) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `id_acompaniante` int(11) DEFAULT NULL,
  `modelo` varchar(50) NOT NULL,
  `matricula` varchar(20) NOT NULL,
  `fecha_origen` date NOT NULL,
  `hora_origen` time NOT NULL,
  `fecha_destino` date NOT NULL,
  `hora_destino` time NOT NULL,
  `ruta` varchar(50) NOT NULL,
  `descripcionruta` text DEFAULT NULL,
  `id_ambulancia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `datos` varchar(2048) NOT NULL,
  `id_preguntas` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `traslado_ambulancia`
--

CREATE TABLE `traslado_ambulancia` (
  `id_traslado` int(11) NOT NULL,
  `id_ambulancia` int(11) NOT NULL
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_documento_funcionario` (`id_funcionario`);

--
-- Indices de la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_encuesta_funcionario` (`id_funcionario`);

--
-- Indices de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `n_serie` (`n_serie`),
  ADD KEY `fk_equipamiento_traslado` (`id_traslado`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_funcionario_tipo` (`id_tipo`);

--
-- Indices de la tabla `funcionario_traslado`
--
ALTER TABLE `funcionario_traslado`
  ADD PRIMARY KEY (`id_funcionario`,`id_traslado`),
  ADD KEY `id_traslado` (`id_traslado`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_insumos` (`id`),
  ADD KEY `fk_insumos_traslados` (`id_traslado`);

--
-- Indices de la tabla `muestra`
--
ALTER TABLE `muestra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_muestra_paciente` (`id_paciente`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `paciente_encuesta`
--
ALTER TABLE `paciente_encuesta`
  ADD PRIMARY KEY (`id_paciente`,`id_encuesta`),
  ADD KEY `id_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`) USING BTREE;

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_preguntas_encuesta` (`id_encuesta`);

--
-- Indices de la tabla `registro_traslado`
--
ALTER TABLE `registro_traslado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_conductor` (`id_conductor`),
  ADD KEY `id_acompaniante` (`id_acompaniante`),
  ADD KEY `id_ambulancia` (`id_ambulancia`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_respuestas_preguntas` (`id_preguntas`);

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
-- Indices de la tabla `traslado_ambulancia`
--
ALTER TABLE `traslado_ambulancia`
  ADD PRIMARY KEY (`id_traslado`,`id_ambulancia`),
  ADD KEY `id_ambulancia` (`id_ambulancia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambulancia`
--
ALTER TABLE `ambulancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro_traslado`
--
ALTER TABLE `registro_traslado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `fk_documento_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`);

--
-- Filtros para la tabla `encuesta`
--
ALTER TABLE `encuesta`
  ADD CONSTRAINT `fk_encuesta_funcionario` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`);

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_persona` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_funcionario_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_traslado`
--
ALTER TABLE `registro_traslado`
  ADD CONSTRAINT `registro_traslado_ibfk_1` FOREIGN KEY (`id_conductor`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `registro_traslado_ibfk_2` FOREIGN KEY (`id_acompaniante`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `registro_traslado_ibfk_3` FOREIGN KEY (`id_ambulancia`) REFERENCES `ambulancia` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
