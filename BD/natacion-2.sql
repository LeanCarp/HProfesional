-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-08-2017 a las 22:52:11
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
  `CalendarioID` int(11) NOT NULL,
  `Presente` tinyint(1) DEFAULT NULL,
  `EntrenamientoID` int(11) NOT NULL,
  `NadadorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE `calendario` (
  `ID` int(11) NOT NULL,
  `ProfesorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campeonato`
--

CREATE TABLE `campeonato` (
  `ID` int(11) NOT NULL,
  `CalendarioID` int(11) NOT NULL,
  `TipoCampeonatoID` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Fecha` date NOT NULL,
  `ClubID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

CREATE TABLE `club` (
  `ID` int(11) NOT NULL,
  `CP` int(11) NOT NULL,
  `Nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distanciatotal`
--

CREATE TABLE `distanciatotal` (
  `ID` int(11) NOT NULL,
  `Distancia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `ID` int(11) NOT NULL,
  `TiempoTotal` int(11) NOT NULL,
  `EntrenamientoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento`
--

CREATE TABLE `entrenamiento` (
  `ID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Nombre` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL,
  `TipoEntrenamientoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estilo`
--

CREATE TABLE `estilo` (
  `ID` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL,
  `Entrenamiento` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `CP` int(11) NOT NULL,
  `Ciudad` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `FechaNacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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
  `TiempoMin` int(11) DEFAULT NULL,
  `Masculino` tinyint(1) DEFAULT NULL,
  `CantidadSeries` int(11) NOT NULL,
  `CategoriaID` int(11) DEFAULT NULL,
  `TamañoPiletaID` int(11) DEFAULT NULL,
  `DistanciaID` int(11) NOT NULL,
  `EstiloID` int(11) NOT NULL,
  `EjercicioID` int(11) DEFAULT NULL,
  `CampeonatoID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado`
--

CREATE TABLE `resultado` (
  `DNI` int(11) NOT NULL,
  `PruebaID` int(11) NOT NULL,
  `Tiempo` time NOT NULL,
  `Fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamañopileta`
--

CREATE TABLE `tamañopileta` (
  `ID` int(11) NOT NULL,
  `Tamaño` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocampeonato`
--

CREATE TABLE `tipocampeonato` (
  `ID` int(11) NOT NULL,
  `Tipo` varchar(60) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoentrenamiento`
--

CREATE TABLE `tipoentrenamiento` (
  `ID` int(11) NOT NULL,
  `CalendarioID` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CalendarioID` (`CalendarioID`),
  ADD KEY `EntrenamientoID` (`EntrenamientoID`),
  ADD KEY `nadadorDNI` (`NadadorID`);

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProfesorID` (`ProfesorID`),
  ADD KEY `ProfesorID_2` (`ProfesorID`);

--
-- Indices de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CalendarioID` (`CalendarioID`),
  ADD UNIQUE KEY `TipoCampeonatoID` (`TipoCampeonatoID`),
  ADD KEY `clubid` (`ClubID`);

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
  ADD UNIQUE KEY `CP` (`CP`);

--
-- Indices de la tabla `distanciatotal`
--
ALTER TABLE `distanciatotal`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Distancia` (`Distancia`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Entrenamiento` (`EntrenamientoID`);

--
-- Indices de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`),
  ADD KEY `TipoEntrenamiento` (`TipoEntrenamientoID`);

--
-- Indices de la tabla `estilo`
--
ALTER TABLE `estilo`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Nombre` (`Nombre`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`CP`),
  ADD UNIQUE KEY `Ciudad` (`Ciudad`);

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
  ADD KEY `tamañoPileta` (`TamañoPiletaID`),
  ADD KEY `distancia` (`DistanciaID`),
  ADD KEY `estilo` (`EstiloID`),
  ADD KEY `ejercicio` (`EjercicioID`),
  ADD KEY `campeonatos` (`CampeonatoID`);

--
-- Indices de la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`PruebaID`,`DNI`),
  ADD KEY `nadador` (`DNI`);

--
-- Indices de la tabla `tamañopileta`
--
ALTER TABLE `tamañopileta`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Tamaño` (`Tamaño`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `calendario`
--
ALTER TABLE `calendario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `campeonato`
--
ALTER TABLE `campeonato`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `club`
--
ALTER TABLE `club`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `distanciatotal`
--
ALTER TABLE `distanciatotal`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estilo`
--
ALTER TABLE `estilo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `CP` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `nadador`
--
ALTER TABLE `nadador`
  MODIFY `DNI` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prueba`
--
ALTER TABLE `prueba`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tamañopileta`
--
ALTER TABLE `tamañopileta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipocampeonato`
--
ALTER TABLE `tipocampeonato`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipoentrenamiento`
--
ALTER TABLE `tipoentrenamiento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `CalendarioID` FOREIGN KEY (`CalendarioID`) REFERENCES `calendario` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `EntrenamientoID` FOREIGN KEY (`EntrenamientoID`) REFERENCES `entrenamiento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nadadorDNI` FOREIGN KEY (`NadadorID`) REFERENCES `nadador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calendario`
--
ALTER TABLE `calendario`
  ADD CONSTRAINT `ProfesorID` FOREIGN KEY (`ProfesorID`) REFERENCES `profesor` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `campeonato`
--
ALTER TABLE `campeonato`
  ADD CONSTRAINT `TipoCampeonato` FOREIGN KEY (`TipoCampeonatoID`) REFERENCES `tipocampeonato` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `clubid` FOREIGN KEY (`ClubID`) REFERENCES `club` (`ID`);

--
-- Filtros para la tabla `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `CodigoPostal` FOREIGN KEY (`CP`) REFERENCES `localidad` (`CP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD CONSTRAINT `Entrenamiento` FOREIGN KEY (`EntrenamientoID`) REFERENCES `entrenamiento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD CONSTRAINT `TipoEntrenamiento` FOREIGN KEY (`TipoEntrenamientoID`) REFERENCES `tipoentrenamiento` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `campeonato` FOREIGN KEY (`CampeonatoID`) REFERENCES `campeonato` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `ejercicio` FOREIGN KEY (`EjercicioID`) REFERENCES `ejercicio` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estilo` FOREIGN KEY (`EstiloID`) REFERENCES `estilo` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tamañoPileta` FOREIGN KEY (`TamañoPiletaID`) REFERENCES `tamañopileta` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resultado`
--
ALTER TABLE `resultado`
  ADD CONSTRAINT `nadador` FOREIGN KEY (`DNI`) REFERENCES `nadador` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prueba` FOREIGN KEY (`PruebaID`) REFERENCES `prueba` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tamañopileta`
--
ALTER TABLE `tamañopileta`
  ADD CONSTRAINT `tamañopileta_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `prueba` (`TamañoPiletaID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
