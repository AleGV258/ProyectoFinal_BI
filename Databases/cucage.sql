-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2022 a las 19:21:04
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
-- Base de datos: `cucage`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mar11`
--

CREATE TABLE `mar11` (
  `ID` int(11) NOT NULL,
  `MAPA` int(9) NOT NULL CHECK (`MAPA` >= 10010001 and `MAPA` <= 320580043),
  `CVE_ENT` int(2) NOT NULL CHECK (`CVE_ENT` >= 1 and `CVE_ENT` <= 32),
  `NOM_ENT` varchar(31) NOT NULL,
  `NOM_ABR` varchar(6) NOT NULL,
  `CVE_MUN` int(3) NOT NULL CHECK (`CVE_MUN` >= 1 and `CVE_MUN` <= 570),
  `NOM_MUN` varchar(49) NOT NULL,
  `CVE_LOC` int(4) NOT NULL CHECK (`CVE_LOC` >= 1 and `CVE_LOC` <= 8010),
  `NOM_LOC` varchar(95) NOT NULL,
  `AMBITO` char(1) NOT NULL,
  `LATITUD` varchar(14) NOT NULL,
  `LONGITUD` varchar(15) NOT NULL,
  `LAT_DECIMAL` double(8,6) NOT NULL CHECK (`LAT_DECIMAL` >= 14.535464 and `LAT_DECIMAL` <= 32.716188),
  `LONG_DECIMAL` double(9,6) NOT NULL CHECK (`LONG_DECIMAL` >= -118.302243 and `LONG_DECIMAL` <= -86.724349),
  `ALTITUD` int(4) NOT NULL CHECK (`ALTITUD` >= -27 and `ALTITUD` <= 4169),
  `CVE_CARTA` varchar(6) NOT NULL,
  `POB_TOTAL` varchar(7) NOT NULL,
  `POB_MASCULINA` varchar(6) NOT NULL,
  `POB_FEMENINA` varchar(6) NOT NULL,
  `TOTAL DE VIVIENDAS HABITADAS` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mar11`
--
ALTER TABLE `mar11`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mar11`
--
ALTER TABLE `mar11`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
