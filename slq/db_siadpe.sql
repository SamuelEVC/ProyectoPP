-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2022 a las 15:58:15
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_siadpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`) VALUES
(1, 'Direccion'),
(2, 'Contaduria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuadrillas`
--

CREATE TABLE IF NOT EXISTS `cuadrillas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_area` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuadrillas`
--

INSERT INTO `cuadrillas` (`id`, `nombre`, `id_area`) VALUES
(1, 'Ab_Juan-Samuel', 1),
(2, 'AB_nata-Pablo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int(11) NOT NULL,
  `id_cuadrilla` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cuadrilla` (`id_cuadrilla`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `id_cuadrilla`, `id_usuario`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'pendiente'),
(2, 'proceso'),
(3, 'finalizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefes`
--

CREATE TABLE IF NOT EXISTS `jefes` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jefes`
--

INSERT INTO `jefes` (`id`, `id_area`, `id_usuario`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'admin'),
(2, 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `resolucion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `id_jefe` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipologia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jefe` (`id_jefe`),
  KEY `id_estado` (`id_estado`),
  KEY `id_tipologia` (`id_tipologia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `descripcion`, `resolucion`, `fecha_inicio`, `fecha_finalizacion`, `id_jefe`, `id_estado`, `id_tipologia`) VALUES
(1, 'comprar una coca', '', '2022-09-26', '0000-00-00', 1, 1, 1),
(2, 'Comprar milanesas en la esquina', '', '2022-09-27', '2022-09-28', 1, 1, 2),
(3, 'Comprar jugos', '', '2022-09-28', '2022-09-29', 1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_empleados`
--

CREATE TABLE IF NOT EXISTS `tareas_empleados` (
  `id` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_cuadrilla` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_cuadrilla` (`id_cuadrilla`),
  KEY `id_tarea` (`id_tarea`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tareas_empleados`
--

INSERT INTO `tareas_empleados` (`id`, `id_empleado`, `id_cuadrilla`, `id_tarea`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2),
(3, 2, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipologias`
--

CREATE TABLE IF NOT EXISTS `tipologias` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipologias`
--

INSERT INTO `tipologias` (`id`, `descripcion`) VALUES
(1, 'Reparacion'),
(2, 'Delivery'),
(3, 'Distribución');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `idRol`, `nombre`, `habilitado`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Samuel', 1),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 2, 'Natanel', 1),
(3, 'demo2', 'fe01ce2a7fbac8fafaed7c982a04e229', 2, 'Juan', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuadrillas`
--
ALTER TABLE `cuadrillas`
  ADD CONSTRAINT `cuadrillas_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`id_cuadrilla`) REFERENCES `cuadrillas` (`id`),
  ADD CONSTRAINT `empleados_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `jefes`
--
ALTER TABLE `jefes`
  ADD CONSTRAINT `jefes_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `jefes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `tareas_ibfk_1` FOREIGN KEY (`id_jefe`) REFERENCES `jefes` (`id`),
  ADD CONSTRAINT `tareas_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `tareas_ibfk_3` FOREIGN KEY (`id_tipologia`) REFERENCES `tipologias` (`id`);

--
-- Filtros para la tabla `tareas_empleados`
--
ALTER TABLE `tareas_empleados`
  ADD CONSTRAINT `tareas_empleados_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id`),
  ADD CONSTRAINT `tareas_empleados_ibfk_2` FOREIGN KEY (`id_cuadrilla`) REFERENCES `cuadrillas` (`id`),
  ADD CONSTRAINT `tareas_empleados_ibfk_3` FOREIGN KEY (`id_tarea`) REFERENCES `tareas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
