-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2016 a las 08:13:38
-- Versión del servidor: 10.1.8-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `amerepo`
--
CREATE DATABASE IF NOT EXISTS `amerepo` DEFAULT CHARACTER SET ascii COLLATE ascii_bin;
USE `amerepo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartment`
--

DROP TABLE IF EXISTS `apartment`;
CREATE TABLE IF NOT EXISTS `apartment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instanceId` varchar(36) COLLATE ascii_bin NOT NULL,
  `name` varchar(70) COLLATE ascii_bin NOT NULL,
  `owner` varchar(70) COLLATE ascii_bin NOT NULL,
  `resident` varchar(70) COLLATE ascii_bin NOT NULL,
  `building_instanceId` varchar(36) COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Truncar tablas antes de insertar `apartment`
--

TRUNCATE TABLE `apartment`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `building`
--

DROP TABLE IF EXISTS `building`;
CREATE TABLE IF NOT EXISTS `building` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instanceId` varchar(36) COLLATE ascii_bin NOT NULL,
  `name` varchar(70) COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Truncar tablas antes de insertar `building`
--

TRUNCATE TABLE `building`;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
