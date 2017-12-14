-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-12-2017 a las 22:28:54
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `natacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `ID` int(11) NOT NULL,
  `Mañana` tinyint(1) NOT NULL,
  `Fecha` date NOT NULL,
  `EntrenamientoID` int(11) DEFAULT NULL,
  `CampeonatoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`ID`, `Mañana`, `Fecha`, `EntrenamientoID`, `CampeonatoID`) VALUES
(2, 1, '2017-12-05', 2, NULL),
(3, 1, '2017-12-06', 1, NULL),
(4, 0, '2017-12-05', 4, NULL),
(5, 1, '2017-12-08', 2, NULL),
(6, 1, '2017-12-13', 4, NULL),
(7, 0, '2017-12-14', 1, NULL),
(8, 1, '2017-12-19', 2, NULL),
(9, 1, '2017-12-20', 3, NULL),
(10, 0, '2017-12-22', 2, NULL),
(11, 1, '2017-12-26', 1, NULL),
(12, 0, '2017-12-27', 3, NULL),
(13, 0, '2017-12-28', 4, NULL),
(14, 0, '2017-12-17', 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato`
--

CREATE TABLE `campeonato` (
  `ID` int(11) NOT NULL,
  `TipoCampeonatoID` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `ClubID` int(11) DEFAULT NULL,
  `color` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `campeonato`
--

INSERT INTO `campeonato` (`ID`, `TipoCampeonatoID`, `nombre`, `inicio`, `fin`, `ClubID`, `color`) VALUES
(1, 1, 'Vuelta a la Isla', '2018-01-13', '2018-01-13', 1, 'blue'),
(2, 2, 'Entrerriano', '2018-04-19', '2018-05-01', 2, 'yellow');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID` int(11) NOT NULL,
  `EdadMinima` int(11) NOT NULL,
  `EdadMaxima` int(11) NOT NULL,
  `Nombre` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID`, `EdadMinima`, `EdadMaxima`, `Nombre`) VALUES
(1, 6, 9, 'Infantil'),
(2, 10, 16, 'Cadete'),
(3, 4, 6, 'Pre Infantil');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE `club` (
  `ID` int(11) NOT NULL,
  `localidadID` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `club`
--

INSERT INTO `club` (`ID`, `localidadID`, `Nombre`) VALUES
(1, 1, 'Neptunia'),
(2, 3, 'Regatas'),
(6, 1, 'Naútico'),
(7, 2, 'Central Gualeguay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distanciatotal`
--

CREATE TABLE `distanciatotal` (
  `ID` int(11) NOT NULL,
  `Distancia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `distanciatotal`
--

INSERT INTO `distanciatotal` (`ID`, `Distancia`) VALUES
(1, 25),
(2, 50),
(3, 100),
(4, 200),
(5, 400),
(6, 1000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento`
--

CREATE TABLE `entrenamiento` (
  `ID` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fin` date NOT NULL,
  `nombre` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TipoEntrenamientoID` int(11) NOT NULL,
  `color` mediumtext COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `entrenamiento`
--

INSERT INTO `entrenamiento` (`ID`, `inicio`, `fin`, `nombre`, `TipoEntrenamientoID`, `color`) VALUES
(1, '2017-12-05', '2017-12-09', 'Preparación física', 1, 'blue'),
(2, '2017-12-12', '2017-12-16', 'Velocidad', 1, 'pink'),
(3, '2017-12-19', '2017-12-21', 'Resistencia', 1, 'yellow'),
(4, '2017-12-26', '2017-12-30', 'Recuperación', 2, 'black');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilo`
--

CREATE TABLE `estilo` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Entrenamiento` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `estilo`
--

INSERT INTO `estilo` (`ID`, `Nombre`, `Entrenamiento`) VALUES
(1, 'Mariposa', 1),
(2, 'Espalda', 1),
(3, 'Pecho', 1),
(4, 'Libre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaasistencia`
--

CREATE TABLE `lineaasistencia` (
  `ID` int(11) NOT NULL,
  `AsistenciaID` int(11) NOT NULL,
  `NadadorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `lineaasistencia`
--

INSERT INTO `lineaasistencia` (`ID`, `AsistenciaID`, `NadadorID`) VALUES
(1, 2, 36101748),
(2, 2, 38570363),
(3, 3, 36101748),
(4, 3, 38570363),
(5, 3, 38570658),
(6, 4, 38570658),
(7, 5, 36101748),
(8, 5, 38570363),
(9, 5, 38570658),
(10, 6, 36101748),
(11, 6, 38570363),
(12, 7, 36101748),
(13, 7, 38570363),
(14, 7, 38570658),
(15, 8, 36101748),
(16, 9, 36101748),
(17, 9, 38570658),
(18, 10, 36101748),
(19, 10, 38570658),
(20, 11, 36101748),
(21, 11, 38570363),
(22, 12, 36101748),
(23, 12, 38570658),
(24, 13, 36101748),
(25, 13, 38570363),
(26, 13, 38570658),
(27, 14, 36101748),
(28, 14, 38570363),
(29, 14, 38570658);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `ID` int(11) NOT NULL,
  `Ciudad` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`ID`, `Ciudad`) VALUES
(3, 'Concepción del Uruguay'),
(2, 'Gualeguay'),
(1, 'Gualeguaychú');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia`
--

CREATE TABLE `multimedia` (
  `ID` int(11) NOT NULL,
  `Archivo` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Descripcion` int(11) NOT NULL,
  `CampeonatoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nadador`
--

CREATE TABLE `nadador` (
  `DNI` int(11) NOT NULL,
  `Apellido` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Nombre` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Sexo` tinyint(1) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `nadador`
--

INSERT INTO `nadador` (`DNI`, `Apellido`, `Nombre`, `Sexo`, `FechaNacimiento`, `activo`) VALUES
(36101748, 'Cuba', 'Juan Pablo', 1, '1991-08-31', 0),
(38570363, 'Cuba', 'Martin', 1, '1995-01-03', 0),
(38570658, 'Lonardi', 'Diego Leandro', 1, '1995-05-30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcial`
--

CREATE TABLE `parcial` (
  `ID` int(11) NOT NULL,
  `ResultadoID` int(11) NOT NULL,
  `Tiempo` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `parcial`
--

INSERT INTO `parcial` (`ID`, `ResultadoID`, `Tiempo`) VALUES
(1, 1, '00:12:61'),
(2, 1, '00:10:64'),
(3, 1, '00:13:10'),
(4, 1, '00:15:17'),
(5, 2, '00:15:89'),
(6, 2, '00:09:63'),
(7, 2, '00:09:97'),
(8, 2, '00:15:38'),
(9, 3, '00:15:5'),
(10, 3, '00:11:20'),
(11, 3, '00:10:93'),
(12, 3, '00:12:70'),
(13, 4, '00:05:48'),
(14, 4, '0:26:70'),
(15, 4, '00:05:48'),
(16, 4, '00:05:48'),
(17, 5, '00:05:48'),
(18, 5, '00:08:48'),
(19, 5, '00:09:48'),
(20, 5, '00:05:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `ID` int(11) NOT NULL,
  `ClubID` int(11) DEFAULT NULL,
  `Nombre` varchar(60) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Apellido` varchar(60) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Usuario` varchar(30) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `Contraseña` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `ID` int(11) NOT NULL,
  `TiempoMin` time DEFAULT NULL,
  `Masculino` tinyint(1) DEFAULT NULL,
  `CategoriaID` int(11) DEFAULT NULL,
  `DistanciaID` int(11) NOT NULL,
  `EstiloID` int(11) NOT NULL,
  `EntrenamientoID` int(11) DEFAULT NULL,
  `CampeonatoID` int(11) DEFAULT NULL,
  `tamaniopiletaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `prueba`
--

INSERT INTO `prueba` (`ID`, `TiempoMin`, `Masculino`, `CategoriaID`, `DistanciaID`, `EstiloID`, `EntrenamientoID`, `CampeonatoID`, `tamaniopiletaID`) VALUES
(1, NULL, 1, 1, 3, 1, 2, NULL, 1),
(2, '01:10:00', 1, 1, 3, 1, NULL, 1, 1),
(6, '01:10:00', 1, 3, 3, 2, NULL, 1, 1),
(7, NULL, 1, 2, 3, 1, 2, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `ID` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `PruebaID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `TiempoTotal` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `resultado`
--

INSERT INTO `resultado` (`ID`, `DNI`, `PruebaID`, `Fecha`, `TiempoTotal`) VALUES
(1, 36101748, 1, '2017-12-14', '00:51:52'),
(2, 38570658, 1, '2017-12-14', '00:50:87'),
(3, 38570363, 1, '2017-12-14', '00:49:88'),
(4, 36101748, 7, '2017-12-14', '00:43:14'),
(5, 38570363, 7, '2017-12-14', '00:28:92');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamaniopileta`
--

CREATE TABLE `tamaniopileta` (
  `ID` int(11) NOT NULL,
  `Tamanio` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tamaniopileta`
--

INSERT INTO `tamaniopileta` (`ID`, `Tamanio`) VALUES
(1, 25),
(2, 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocampeonato`
--

CREATE TABLE `tipocampeonato` (
  `ID` int(11) NOT NULL,
  `Tipo` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipocampeonato`
--

INSERT INTO `tipocampeonato` (`ID`, `Tipo`) VALUES
(3, 'Internacional'),
(1, 'Nacional'),
(2, 'Provincial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoentrenamiento`
--

CREATE TABLE `tipoentrenamiento` (
  `ID` int(11) NOT NULL,
  `CalendarioID` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipoentrenamiento`
--

INSERT INTO `tipoentrenamiento` (`ID`, `CalendarioID`, `Nombre`) VALUES
(1, 0, 'Velocidad'),
(2, 0, 'Descanso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '8n2SQSjiiVMHhB2rQnojY.', 1268889823, 1513283846, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '', 'leandro', '', NULL, '', NULL, NULL, NULL, NULL, 0, NULL, NULL, 'leandro', 'lonardi', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EntrenamientoID` (`EntrenamientoID`),
  ADD KEY `CampeonatoID` (`CampeonatoID`);

--
-- Indices de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `clubid` (`ClubID`),
  ADD KEY `tipoCampeonato` (`TipoCampeonatoID`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`),
  ADD KEY `CP` (`localidadID`) USING BTREE;

--
-- Indices de la tabla `distanciatotal`
--
ALTER TABLE `distanciatotal`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Distancia` (`Distancia`);

--
-- Indices de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`nombre`),
  ADD KEY `TipoEntrenamiento` (`TipoEntrenamientoID`);

--
-- Indices de la tabla `estilo`
--
ALTER TABLE `estilo`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineaasistencia`
--
ALTER TABLE `lineaasistencia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AsistenciaID` (`AsistenciaID`,`NadadorID`),
  ADD KEY `nadador1` (`NadadorID`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Ciudad` (`Ciudad`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `campeonato` (`CampeonatoID`);

--
-- Indices de la tabla `nadador`
--
ALTER TABLE `nadador`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `parcial`
--
ALTER TABLE `parcial`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ResultadoID` (`ResultadoID`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ClubID` (`ClubID`);

--
-- Indices de la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `categoria` (`CategoriaID`),
  ADD KEY `distancia` (`DistanciaID`),
  ADD KEY `estilo` (`EstiloID`),
  ADD KEY `campeonatos` (`CampeonatoID`),
  ADD KEY `tamañopile` (`tamaniopiletaID`),
  ADD KEY `EntrenamientoID` (`EntrenamientoID`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `DNI` (`DNI`),
  ADD KEY `PruebaID` (`PruebaID`);

--
-- Indices de la tabla `tamaniopileta`
--
ALTER TABLE `tamaniopileta`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Tamaño` (`Tamanio`),
  ADD KEY `ID` (`ID`);

--
-- Indices de la tabla `tipocampeonato`
--
ALTER TABLE `tipocampeonato`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Tipo` (`Tipo`);

--
-- Indices de la tabla `tipoentrenamiento`
--
ALTER TABLE `tipoentrenamiento`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `distanciatotal`
--
ALTER TABLE `distanciatotal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estilo`
--
ALTER TABLE `estilo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `lineaasistencia`
--
ALTER TABLE `lineaasistencia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `nadador`
--
ALTER TABLE `nadador`
  MODIFY `DNI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38570659;
--
-- AUTO_INCREMENT de la tabla `parcial`
--
ALTER TABLE `parcial`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `resultado`
--
ALTER TABLE `resultado`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `tamaniopileta`
--
ALTER TABLE `tamaniopileta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipocampeonato`
--
ALTER TABLE `tipocampeonato`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipoentrenamiento`
--
ALTER TABLE `tipoentrenamiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `campeonato1` FOREIGN KEY (`CampeonatoID`) REFERENCES `campeonato` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `entrenamiento1` FOREIGN KEY (`EntrenamientoID`) REFERENCES `entrenamiento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD CONSTRAINT `clubid` FOREIGN KEY (`ClubID`) REFERENCES `club` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipoCampeonato` FOREIGN KEY (`TipoCampeonatoID`) REFERENCES `tipocampeonato` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `localida` FOREIGN KEY (`localidadID`) REFERENCES `localidad` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD CONSTRAINT `TipoEntrenamiento` FOREIGN KEY (`TipoEntrenamientoID`) REFERENCES `tipoentrenamiento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineaasistencia`
--
ALTER TABLE `lineaasistencia`
  ADD CONSTRAINT `asis` FOREIGN KEY (`AsistenciaID`) REFERENCES `asistencia` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nadador` FOREIGN KEY (`NadadorID`) REFERENCES `nadador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `campeonato` FOREIGN KEY (`CampeonatoID`) REFERENCES `campeonato` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `parcial`
--
ALTER TABLE `parcial`
  ADD CONSTRAINT `resultado` FOREIGN KEY (`ResultadoID`) REFERENCES `resultado` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `club` FOREIGN KEY (`ClubID`) REFERENCES `club` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prueba`
--
ALTER TABLE `prueba`
  ADD CONSTRAINT `campeonatos` FOREIGN KEY (`CampeonatoID`) REFERENCES `campeonato` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categoria` FOREIGN KEY (`CategoriaID`) REFERENCES `categoria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distancia` FOREIGN KEY (`DistanciaID`) REFERENCES `distanciatotal` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estilo` FOREIGN KEY (`EstiloID`) REFERENCES `estilo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tama` FOREIGN KEY (`tamaniopiletaID`) REFERENCES `tamaniopileta` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `nadador2` FOREIGN KEY (`DNI`) REFERENCES `nadador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prueba1` FOREIGN KEY (`PruebaID`) REFERENCES `prueba` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
