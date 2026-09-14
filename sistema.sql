-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-09-2026 a las 23:06:29
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

--
-- Volcado de datos para la tabla `ambulancia`
--

INSERT INTO `ambulancia` (`id`, `modelo`, `matricula`) VALUES
(1, 'fitito', '112'),
(2, 'JACOBO', 'AFF1'),
(4, 'rrrr', 'rrrr'),
(5, '1', '11'),
(6, '1', '2');

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

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`id`, `nombre_documento`, `tipo_documento`, `qr`) VALUES
(1, 'luna', 'opcion8', '/tmp/ENTREVISTA.pdf'),
(2, 'luna', 'opcion8', '/tmp/ENTREVISTA.pdf'),
(3, 'luna', 'opcion8', '/tmp/ENTREVISTA.pdf'),
(4, 'sapa', 'opcion9', '/tmp/sensors-21-06905-v2.pdf'),
(5, 'viki', 'azul', '');

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

--
-- Volcado de datos para la tabla `equipamiento`
--

INSERT INTO `equipamiento` (`id`, `n_serie`, `descripcion`) VALUES
(1, '872', 'roja'),
(2, '1111', 'hola');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(70) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`id`, `usuario`, `contrasenia`, `email`) VALUES
(11, 'bytech', '$2y$10$.5FP9YDiTZCgScmqnSBMVePPTgkr0XiiyOiJ8mPJ9V3ChvMWLmD2m', 'yoquese@gmail.com'),
(14, 'luciafernandez', '$2y$10$43Y5ghRW6PkPMGEHjvAPmuzxGGEtmo.DEWwrdVTPLs1JeLDeALkMi', 'luciafernande2z@gmail.com'),
(15, 'aramirez', '$2y$10$bOjBzLqvOks0OIFCvKkkPu9SQjGiDZQqli87X66jg73WxE/Fj.NYe', 'andrea@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'rojo', 'es rojo'),
(2, 'LUNA', 'TIENE PELO CORTO'),
(3, 'ramon', 'es un pan'),
(4, 'ramon', 'es un pan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muestra`
--

CREATE TABLE `muestra` (
  `id` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL
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
(11, '572082', 'yo', 'quese', '2026-09-02'),
(12, '567890', 'sofia', 'gomez', '2026-10-06'),
(13, '4123789', ' Lucía', 'Fernández', '1998-06-14'),
(14, '57109840', 'lucia', 'Fernández', '2003-05-01'),
(15, '51891018', 'Andrea', 'Ramirez', '2000-08-18');

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
  `elemento` varchar(100) NOT NULL,
  `id_conductor` int(11) NOT NULL,
  `nombre_conductor` varchar(50) NOT NULL,
  `id_acompaniante` int(11) NOT NULL,
  `nombre_acompaniante` varchar(200) NOT NULL,
  `id_ambulancia` int(11) NOT NULL,
  `modelo` varchar(200) NOT NULL,
  `matricula_ambulancia` varchar(50) NOT NULL,
  `fecha_origen` date NOT NULL,
  `hora_origen` time(6) NOT NULL,
  `descripcionorigen` text NOT NULL,
  `fecha_destino` date NOT NULL,
  `hora_destino` time(6) NOT NULL,
  `descripcion_destino` text NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `descripcionruta` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registro_traslado`
--

INSERT INTO `registro_traslado` (`id`, `elemento`, `id_conductor`, `nombre_conductor`, `id_acompaniante`, `nombre_acompaniante`, `id_ambulancia`, `modelo`, `matricula_ambulancia`, `fecha_origen`, `hora_origen`, `descripcionorigen`, `fecha_destino`, `hora_destino`, `descripcion_destino`, `ruta`, `descripcionruta`) VALUES
(19, 'muestra', 11, 'julio', 11, 'julia', 2, ' ', 'AFF1', '2026-12-12', '00:00:03.000000', 'hospital', '2026-11-11', '00:00:03.000000', 'hospital', 'Urbano', 'xxx xxxx');

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
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `email` (`email`);

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
  ADD KEY `fk_id_conductor` (`id_conductor`),
  ADD KEY `fk_id_acompaniante` (`id_acompaniante`),
  ADD KEY `fk_id_ambulancia` (`id_ambulancia`),
  ADD KEY `fk_matricula_ambulancia` (`matricula_ambulancia`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambulancia`
--
ALTER TABLE `ambulancia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `equipamiento`
--
ALTER TABLE `equipamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `registro_traslado`
--
ALTER TABLE `registro_traslado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk_funcionario_persona` FOREIGN KEY (`id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_traslado`
--
ALTER TABLE `registro_traslado`
  ADD CONSTRAINT `fk_id_acompaniante` FOREIGN KEY (`id_acompaniante`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `fk_id_ambulancia` FOREIGN KEY (`id_ambulancia`) REFERENCES `ambulancia` (`id`),
  ADD CONSTRAINT `fk_id_conductor` FOREIGN KEY (`id_conductor`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `fk_matricula_ambulancia` FOREIGN KEY (`matricula_ambulancia`) REFERENCES `ambulancia` (`matricula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
