-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2026 a las 09:48:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

-- =========================================================
-- Script completo de creación e inicialización de Crescendo
-- Este archivo crea la base de datos desde cero y carga datos iniciales.
-- Compatible con MariaDB 10.4.32 / phpMyAdmin / XAMPP.
-- =========================================================

DROP DATABASE IF EXISTS `crescendo`;
CREATE DATABASE `crescendo`
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE `crescendo`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crescendo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nombre_tutor` varchar(150) DEFAULT NULL,
  `telefono_tutor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `id_usuario`, `nombre_tutor`, `telefono_tutor`) VALUES
(1, 3, 'María Martín', '600123456'),
(2, 11, 'María Molina', '600111222'),
(3, 12, 'Laura Navarro', '600222333'),
(4, 13, 'Antonio Martín', '600333444'),
(5, 14, 'Carmen Díaz', '600444555'),
(6, 15, 'Raúl Sánchez', '600555666'),
(7, 16, 'Elena Ruiz', '601666777');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_clase`
--

CREATE TABLE `alumno_clase` (
  `id_matricula` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `fecha_matricula` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumno_clase`
--

INSERT INTO `alumno_clase` (`id_matricula`, `id_alumno`, `id_clase`, `fecha_matricula`, `activo`) VALUES
(1, 11, 1, '2026-05-10', 1),
(2, 11, 9, '2026-05-10', 1),
(3, 12, 3, '2026-05-10', 1),
(4, 13, 5, '2026-05-10', 1),
(5, 14, 6, '2026-05-10', 1),
(6, 15, 2, '2026-05-10', 1),
(7, 16, 8, '2026-05-10', 1),
(8, 16, 9, '2026-05-10', 1),
(9, 3, 7, '2026-05-13', 1),
(10, 13, 2, '2026-05-14', 0),
(11, 13, 9, '2026-05-17', 1),
(12, 13, 1, '2026-05-17', 1),
(13, 13, 6, '2026-05-24', 1),
(14, 13, 8, '2026-05-24', 1),
(16, 13, 3, '2026-05-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id_anuncio` int(11) NOT NULL,
  `id_administrador` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_edicion` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anuncios`
--

INSERT INTO `anuncios` (`id_anuncio`, `id_administrador`, `titulo`, `contenido`, `fecha_creacion`, `fecha_edicion`, `activo`) VALUES
(1, 1, 'Bienvenidos a Crescendo', 'Os damos la bienvenida a la nueva plataforma académica. Aquí podréis consultar tareas, materiales, anuncios y novedades importantes relacionadas con vuestras clases.', '2026-05-24 18:28:15', NULL, 1),
(2, 1, 'Audiciones de fin de curso', 'Las audiciones de fin de curso comenzarán el próximo 15 de junio. En los próximos días cada profesor publicará los horarios y repertorios correspondientes.', '2026-05-24 18:28:15', NULL, 1),
(3, 1, 'Nuevo material disponible', 'Se han añadido nuevas partituras y ejercicios de lenguaje musical en la biblioteca digital. Revisad vuestro panel para acceder al contenido.', '2026-05-24 18:28:15', NULL, 1),
(4, 1, 'Mantenimiento programado de la plataforma', ' El próximo sábado entre las 22:00 y las 00:00 se realizarán tareas de mantenimiento en Crescendo. Durante ese periodo algunas funciones podrían no estar disponibles temporalmente.\r\n', '2026-05-24 18:51:55', NULL, 1),
(5, 1, 'TEST', 'TEST', '2026-05-24 19:09:25', NULL, 0),
(6, 1, '5', '´k', '2026-05-26 11:35:51', NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE `asignaturas` (
  `id_asignatura` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`id_asignatura`, `nombre`, `descripcion`, `activo`) VALUES
(1, 'Piano', 'Clases de piano para todos los niveles.', 1),
(2, 'Guitarra', 'Aprendizaje de guitarra clásica y moderna.', 1),
(3, 'Violín', 'Formación técnica y musical en violín.', 1),
(4, 'Canto', 'Técnica vocal y expresión artística.', 1),
(5, 'Lenguaje Musical', 'Teoría musical, ritmo y lectura.', 1),
(6, 'Batería', 'Clases de batería moderna y técnica rítmica.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `horario` varchar(100) DEFAULT NULL,
  `aula` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `id_asignatura`, `id_profesor`, `nombre`, `horario`, `aula`, `activo`) VALUES
(1, 1, 5, 'Piano Iniciación', 'Lunes y Miércoles 17:00-18:00', 'Aula 1', 1),
(2, 1, 5, 'Piano Avanzado', 'Martes y Jueves 18:00-19:30', 'Aula 2', 1),
(3, 2, 6, 'Guitarra Grupo A', 'Lunes 19:00-20:00', 'Aula 3', 1),
(4, 2, 6, 'Guitarra Grupo B', 'Miércoles 19:00-20:00', 'Aula 3', 1),
(5, 4, 7, 'Canto Moderno', 'Martes 17:00-18:30', 'Aula Vocal', 1),
(6, 3, 8, 'Violín Infantil', 'Viernes 17:00-18:00', 'Aula 4', 1),
(7, 3, 8, 'Violín Intermedio', 'Viernes 18:00-19:30', 'Aula 4', 1),
(8, 6, 9, 'Batería Rock', 'Jueves 19:00-20:30', 'Sala Ritmo', 1),
(9, 5, 10, 'Lenguaje Musical Básico', 'Jueves 16:00-17:00', 'Aula Teórica', 1),
(10, 5, 10, 'Lenguaje Musical Avanzado', 'Viernes 16:00-17:30', 'Aula Teórica', 1),
(11, 2, 9, 'Clase TEST', 'TEST', 'TEST', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id_profesor` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `especialidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `id_usuario`, `especialidad`) VALUES
(1, 2, 'Piano'),
(2, 4, 'Guitarra'),
(3, 5, 'Piano'),
(4, 6, 'Guitarra'),
(5, 7, 'Canto'),
(6, 8, 'Violín'),
(7, 9, 'Batería'),
(8, 10, 'Lenguaje Musical');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id_publicacion` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `tipo` enum('tarea','material','mensaje') NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_edicion` datetime DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id_publicacion`, `id_profesor`, `id_clase`, `tipo`, `titulo`, `contenido`, `fecha_creacion`, `fecha_edicion`, `activo`) VALUES
(1, 5, 2, 'material', 'EJEMPLO', 'EJEMPLO', '2026-05-12 18:05:21', '2026-05-12 18:05:32', 0),
(2, 5, 2, 'tarea', 'Escalas mayores', 'Durante esta semana quiero que practiques diariamene las escalas mayores trabajadas en clase.', '2026-05-12 18:11:47', '2026-05-28 13:57:02', 1),
(4, 5, 2, 'mensaje', 'Recordatorio para la próxima clase', 'Traer el material.', '2026-05-12 18:39:00', '2026-05-24 12:36:53', 1),
(5, 7, 5, 'tarea', 'Ejercicio de respiración diafragmática', 'Practica durante 10 minutos los ejercicios de respiración vistos en clase. Anota cualquier dificultad para comentarla en la próxima sesión.', '2026-05-23 18:30:57', NULL, 1),
(6, 7, 5, 'material', 'Partitura: Vocalización inicial', 'Material de apoyo para practicar vocalización en casa. Revisa la partitura antes de la próxima clase.', '2026-05-23 18:30:57', NULL, 1),
(7, 7, 5, 'mensaje', 'Recordatorio para la próxima clase', 'Traed agua y la libreta de anotaciones. La próxima sesión trabajaremos proyección vocal y afinación.', '2026-05-23 18:30:57', NULL, 1),
(8, 7, 5, 'tarea', 'Práctica de afinación básica', 'Escucha el audio trabajado en clase y practica las escalas ascendentes y descendentes durante 15 minutos.', '2026-05-23 19:20:43', NULL, 1),
(9, 7, 5, 'tarea', 'Ejercicio de proyección vocal', 'Practica la proyección de voz manteniendo una postura relajada. Intenta vocalizar sin forzar la garganta.', '2026-05-23 19:20:43', NULL, 1),
(10, 7, 5, 'tarea', 'Preparación de interpretación', 'Prepara el primer verso de la canción trabajada en clase. Trabajaremos expresión e intención musical.', '2026-05-23 19:20:43', NULL, 1),
(11, 5, 1, 'tarea', 'Lectura de partitura sencilla', 'Practica la lectura de la partitura entregada en clase. Presta atención al ritmo y a la posición de las manos.', '2026-05-29 10:00:00', NULL, 1),
(12, 5, 1, 'mensaje', 'Recordatorio de material', 'Para la próxima clase trae el cuaderno de piano y la partitura trabajada durante la semana.', '2026-05-29 10:05:00', NULL, 1),
(13, 6, 3, 'tarea', 'Práctica de acordes básicos', 'Repasa los acordes de Do, Sol y Re mayor. Intenta cambiar entre ellos manteniendo un ritmo constante.', '2026-05-29 10:10:00', NULL, 1),
(14, 8, 6, 'material', 'Ejercicio de arco', 'Material de apoyo para practicar el movimiento del arco de forma controlada y uniforme.', '2026-05-29 10:15:00', NULL, 1),
(15, 9, 8, 'tarea', 'Ritmo básico en batería', 'Practica el patrón rítmico trabajado en clase utilizando bombo, caja y charles. Mantén un tempo estable.', '2026-05-29 10:20:00', NULL, 1),
(16, 10, 9, 'material', 'Repaso de figuras musicales', 'Revisa las figuras musicales vistas en clase: redonda, blanca, negra y corchea. Practica su duración con palmadas.', '2026-05-29 10:25:00', NULL, 1),
(17, 10, 9, 'tarea', 'Ejercicio de ritmo y compás', 'Completa los ejercicios de compás de 2/4 y 4/4. Se corregirán en la próxima sesión.', '2026-05-29 10:30:00', NULL, 1),
(18, 7, 5, 'mensaje', 'Preparación de la próxima canción', 'En la próxima clase comenzaremos a trabajar una nueva canción. Escúchala previamente y anota las partes que te resulten más difíciles.', '2026-05-29 10:35:00', NULL, 1),
(19, 5, 1, 'material', 'Vídeo sobre postura al piano', 'Revisa el vídeo recomendado sobre postura corporal y colocación correcta de las manos antes de practicar.', '2026-05-29 09:46:15', NULL, 1),
(20, 5, 1, 'tarea', 'Escala de Do Mayor', 'Practica la escala de Do Mayor a dos manos durante al menos 10 minutos diarios.', '2026-05-29 09:46:15', NULL, 1),
(21, 6, 3, 'material', 'Guía de afinación', 'Consulta la guía de afinación y comprueba siempre la afinación antes de comenzar a tocar.', '2026-05-29 09:46:15', NULL, 1),
(22, 6, 3, 'mensaje', 'Ensayo grupal', 'La próxima semana realizaremos una práctica conjunta. Se recomienda repasar los ejercicios trabajados hasta ahora.', '2026-05-29 09:46:15', NULL, 1),
(23, 7, 5, 'material', 'Técnicas de respiración', 'Lee el material sobre respiración diafragmática y realiza los ejercicios indicados diariamente.', '2026-05-29 09:46:15', NULL, 1),
(24, 7, 5, 'tarea', 'Ejercicios vocales', 'Completa la rutina de calentamiento vocal trabajada en clase durante al menos 15 minutos al día.', '2026-05-29 09:46:15', NULL, 1),
(25, 7, 5, 'mensaje', 'Preparación para audición', 'Durante las próximas semanas comenzaremos a preparar una pequeña actuación grupal.', '2026-05-29 09:46:15', NULL, 1),
(26, 8, 6, 'mensaje', 'Cuidados del instrumento', 'Recuerda guardar el violín correctamente después de cada práctica y limpiar la resina sobrante.', '2026-05-29 09:46:15', NULL, 1),
(27, 8, 6, 'tarea', 'Práctica de cuerdas al aire', 'Trabaja los ejercicios de cuerdas al aire vistos en clase manteniendo una velocidad constante.', '2026-05-29 09:46:15', NULL, 1),
(28, 8, 6, 'material', 'Partitura de repaso', 'Se adjunta la partitura utilizada en clase para reforzar la lectura musical.', '2026-05-29 09:46:15', NULL, 1),
(29, 9, 8, 'material', 'Patrones básicos de rock', 'Consulta el documento con los patrones rítmicos básicos trabajados durante este trimestre.', '2026-05-29 09:46:15', NULL, 1),
(30, 9, 8, 'mensaje', 'Práctica con metrónomo', 'Se recomienda utilizar metrónomo en todas las sesiones de práctica para mejorar la precisión rítmica.', '2026-05-29 09:46:15', NULL, 1),
(31, 9, 8, 'tarea', 'Coordinación de manos y pies', 'Practica el ejercicio de coordinación explicado en clase durante al menos 15 minutos diarios.', '2026-05-29 09:46:15', NULL, 1),
(32, 10, 9, 'mensaje', 'Repaso para el control', 'La próxima semana realizaremos una prueba breve sobre figuras musicales y compases.', '2026-05-29 09:46:15', NULL, 1),
(33, 10, 9, 'material', 'Apuntes de teoría musical', 'Se encuentran disponibles los apuntes actualizados sobre compases simples y figuras musicales.', '2026-05-29 09:46:15', NULL, 1),
(34, 10, 9, 'tarea', 'Lectura rítmica', 'Completa los ejercicios de lectura rítmica de la página 12 del cuaderno.', '2026-05-29 09:46:15', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('administrador','profesor','alumno') NOT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellidos`, `email`, `password`, `rol`, `activo`, `fecha_creacion`) VALUES
(1, 'Admin', 'Principal', 'admin.crescendo@gmail.com', 'admin123', 'administrador', 1, '2026-05-07 15:35:29'),
(2, 'Laura', 'Gómez', 'laura.gomez@gmail.com', 'profesor123', 'profesor', 1, '2026-05-07 15:35:29'),
(3, 'Hugo', 'Martín', 'hugo.martin@gmail.com', 'alumno123', 'alumno', 1, '2026-05-07 15:35:29'),
(4, 'Antonio', 'López Martín', 'Antonio.crescendo@gmail.com', 'antonio1234', 'profesor', 1, '2026-05-09 10:22:09'),
(5, 'Lucía', 'Herrera', 'lucia.herrera@crescendo.com', '1234', 'profesor', 1, '2026-05-10 15:44:56'),
(6, 'Daniel', 'Ruiz', 'daniel.ruiz@crescendo.com', '1234', 'profesor', 1, '2026-05-10 15:44:56'),
(7, 'Marta', 'López', 'marta.lopez@crescendo.com', '1234', 'profesor', 1, '2026-05-10 15:44:56'),
(8, 'Álvaro', 'Montes', 'alvaro.montes@crescendo.com', '1234', 'profesor', 1, '2026-05-10 15:44:56'),
(9, 'Sergio', 'Valdés', 'sergio.valdes@crescendo.com', '1234', 'profesor', 1, '2026-05-10 15:44:56'),
(10, 'Alejandro', 'Vega', 'alejandro.vega@crescendo.com', '1234', 'profesor', 1, '2026-05-10 15:44:56'),
(11, 'Sofía', 'García Molina', 'sofia.garcia@crescendo.com', '1234', 'alumno', 1, '2026-05-10 16:00:45'),
(12, 'Lucas', 'Pérez Navarro', 'lucas.perez@crescendo.com', '1234', 'alumno', 1, '2026-05-10 16:00:45'),
(13, 'Emma', 'Martín Torres', 'emma.martin@crescendo.com', '1234', 'alumno', 1, '2026-05-10 16:00:45'),
(14, 'Hugo', 'Romero Díaz', 'hugo.romero@crescendo.com', '1234', 'alumno', 1, '2026-05-10 16:00:45'),
(15, 'Valeria', 'Sánchez López', 'valeria.sanchez@crescendo.com', '1234', 'alumno', 1, '2026-05-10 16:00:45'),
(16, 'Mateo', 'Jiménez Ruiz', 'mateo.jimenez@crescendo.com', '1234', 'alumno', 1, '2026-05-10 16:00:45');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `alumno_clase`
--
ALTER TABLE `alumno_clase`
  ADD PRIMARY KEY (`id_matricula`),
  ADD UNIQUE KEY `id_alumno` (`id_alumno`,`id_clase`),
  ADD KEY `fk_matricula_clase` (`id_clase`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id_anuncio`),
  ADD KEY `fk_anuncios_administrador` (`id_administrador`);

--
-- Indices de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  ADD PRIMARY KEY (`id_asignatura`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`),
  ADD KEY `id_asignatura` (`id_asignatura`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id_profesor`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id_publicacion`),
  ADD KEY `id_profesor` (`id_profesor`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `alumno_clase`
--
ALTER TABLE `alumno_clase`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id_anuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asignaturas`
--
ALTER TABLE `asignaturas`
  MODIFY `id_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id_publicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `alumno_clase`
--
ALTER TABLE `alumno_clase`
  ADD CONSTRAINT `fk_matricula_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fk_matricula_clase` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`);

--
-- Filtros para la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD CONSTRAINT `fk_anuncios_administrador` FOREIGN KEY (`id_administrador`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignaturas` (`id_asignatura`),
  ADD CONSTRAINT `clases_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD CONSTRAINT `profesores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicaciones_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `publicaciones_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
