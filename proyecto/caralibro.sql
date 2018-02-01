-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2017 a las 22:42:55
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `caralibro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `codigoAmistad` int(5) NOT NULL,
  `codigoUsuario` int(20) NOT NULL,
  `codigoAmigo` int(20) NOT NULL,
  `estadoAmistad` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `codigoComentario` int(4) NOT NULL,
  `codigoUsuario` int(100) NOT NULL,
  `codigoPublicacion` int(5) NOT NULL,
  `comentario` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fechaComentario` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `meGusta` int(5) NOT NULL,
  `noMeGusta` int(5) NOT NULL,
  `likeDadoPor` varchar(1000) COLLATE utf8_spanish_ci NOT NULL,
  `dislikeDadoPor` varchar(1000) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajeria`
--

CREATE TABLE `mensajeria` (
  `idMensaje` int(3) NOT NULL,
  `emisor` varchar(100) NOT NULL,
  `receptor` varchar(100) NOT NULL,
  `asunto` varchar(100) NOT NULL,
  `mensaje` varchar(10000) NOT NULL,
  `estado` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `codigoPublicacion` int(20) NOT NULL,
  `codigoUsuario` int(20) NOT NULL,
  `publicacion` varchar(10200) COLLATE utf8_spanish_ci NOT NULL,
  `fechaPublicacion` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `meGusta` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `noMeGusta` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `likeDadoPor` varchar(10000) COLLATE utf8_spanish_ci NOT NULL,
  `dislikeDadoPor` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblreseteopass`
--

CREATE TABLE `tblreseteopass` (
  `id` int(10) NOT NULL,
  `idusuario` int(10) NOT NULL,
  `correo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_spanish_ci NOT NULL,
  `creado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `codigoUsuario` int(20) NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `contrasena` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`codigoUsuario`, `correo`, `nombre`, `apellido`, `fechaNacimiento`, `sexo`, `imagen`, `contrasena`) VALUES
(4, 'mariaruiz.caralibro@gmail.com', 'Maria', 'Ruiz', '29/12/1996', 'mujer', '../../Imagenes/usuariosRegistrados/1497374824maria.png', 'b368b24e8c10d166c738f1230e733054'),
(8, 'carlosgonzalez.caralibro@gmail.com', 'Carlos', 'Gonzalez', '25/12/1988', 'hombre', '../../Imagenes/usuariosRegistrados/1497378749carlos.png', 'b368b24e8c10d166c738f1230e733054'),
(9, 'mariamoreno.caralibro@gmail.com', 'Maria', 'Moreno', '25/10/1968', 'mujer', '../../Imagenes/usuariosRegistrados/1497386530mariaDos.png', 'b368b24e8c10d166c738f1230e733054');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`codigoAmistad`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`codigoComentario`);

--
-- Indices de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  ADD PRIMARY KEY (`idMensaje`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`codigoPublicacion`);

--
-- Indices de la tabla `tblreseteopass`
--
ALTER TABLE `tblreseteopass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`codigoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigos`
--
ALTER TABLE `amigos`
  MODIFY `codigoAmistad` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `codigoComentario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `mensajeria`
--
ALTER TABLE `mensajeria`
  MODIFY `idMensaje` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `codigoPublicacion` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `tblreseteopass`
--
ALTER TABLE `tblreseteopass`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `codigoUsuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
