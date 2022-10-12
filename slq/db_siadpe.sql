-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2022 a las 03:25:36
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`) VALUES
(1, 'Dirección'),
(2, 'Contaduria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuadrillas`
--

CREATE TABLE IF NOT EXISTS `cuadrillas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_area` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cuadrillas`
--

INSERT INTO `cuadrillas` (`id`, `nombre`, `id_area`) VALUES
(1, 'AB_Juan-Samuel', 1),
(2, 'AB_Nata-', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE IF NOT EXISTS `empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cuadrilla` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cuadrilla` (`id_cuadrilla`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `id_cuadrilla`, `id_usuario`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'Pendiente'),
(2, 'Proceso'),
(3, 'Finalizada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jefes`
--

CREATE TABLE IF NOT EXISTS `jefes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_area` (`id_area`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `jefes`
--

INSERT INTO `jefes` (`id`, `id_area`, `id_usuario`) VALUES
(1, 1, 1),
(2, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `resolucion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `id_jefe` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_tipologia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jefe` (`id_jefe`),
  KEY `id_estado` (`id_estado`),
  KEY `id_tipologia` (`id_tipologia`),
  FULLTEXT KEY `resolucion` (`resolucion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `descripcion`, `resolucion`, `fecha_inicio`, `fecha_finalizacion`, `id_jefe`, `id_estado`, `id_tipologia`) VALUES
(1, 'Tarea de Reparacion Ejemplo', '', '2022-09-30', NULL, 1, 1, 1),
(3, 'Tarea de ensamblaje Ejemplo', '', '2022-09-30', NULL, 1, 1, 4),
(4, 'Tarea de distribución ejemplo', 'La Tarea se finalizo con Exito!', '2022-09-30', '2022-10-11', 1, 3, 3),
(5, 'Ejemplo de tarea con muucha descripción - hola soy homero simposo, ahora voy a nombrarte las ventajas de programar con PHP sin conocerlo. ventaja 1: Fin de las ventajas', 'La tarea se finalizo con éxito a pesar de no conocer PHP, Yoda estaría orgulloso!', '2022-09-30', '2022-10-12', 1, 3, 2),
(6, 'texto corto', '', '2022-09-30', NULL, 1, 2, 2),
(7, 'Pedir unas Pizzas y Gaseosa, en la casa de Juan', '', '2022-09-30', NULL, 1, 2, 2),
(8, 'prueba de tarea, homero sipson', '', '2022-10-04', NULL, 1, 2, 5),
(9, 'tarea ejemplo usuario 2', '', '2022-10-06', NULL, 2, 2, 2),
(10, 'prueba tarea Jefe 2 Delivery de mate cocido', '', '2022-10-10', NULL, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas_empleados`
--

CREATE TABLE IF NOT EXISTS `tareas_empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empleado` int(11) NOT NULL,
  `id_cuadrilla` int(11) NOT NULL,
  `id_tarea` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_empleado` (`id_empleado`),
  KEY `id_cuadrilla` (`id_cuadrilla`),
  KEY `id_tarea` (`id_tarea`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `tareas_empleados`
--

INSERT INTO `tareas_empleados` (`id`, `id_empleado`, `id_cuadrilla`, `id_tarea`) VALUES
(1, 2, 2, 3),
(2, 2, 2, 1),
(5, 2, 2, 5),
(6, 2, 2, 6),
(7, 2, 2, 7),
(10, 1, 1, 4),
(11, 3, 1, 4),
(12, 2, 2, 9),
(13, 1, 1, 10),
(14, 3, 1, 10),
(15, 1, 1, 8),
(16, 3, 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipologias`
--

CREATE TABLE IF NOT EXISTS `tipologias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipologias`
--

INSERT INTO `tipologias` (`id`, `descripcion`) VALUES
(1, 'Reparacion'),
(2, 'Delivery'),
(3, 'Distribución'),
(4, 'Ensamblaje'),
(5, 'Transporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `nombre` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idRol` (`idRol`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `idRol`, `nombre`, `habilitado`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Pablo', 1),
(2, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 2, 'Natanael', 1),
(3, 'demo2', 'fe01ce2a7fbac8fafaed7c982a04e229', 2, 'Juan', 1),
(4, 'demo3', 'fe01ce2a7fbac8fafaed7c982a04e229', 2, 'Samuel', 1),
(5, 'admin2', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'Gustavo', 1);

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
