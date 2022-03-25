-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2022 a las 09:35:21
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cinetics`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--
CREATE TABLE `user` (
  `iduser` int(9) NOT NULL,
  `mail` varchar(40) COLLATE utf8mb4_bin DEFAULT NULL,
  `username` varchar(16) COLLATE utf8mb4_bin DEFAULT NULL,
  `passHash` varchar(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `userFirstName` varchar(60) COLLATE utf8mb4_bin DEFAULT NULL,
  `userLastName` varchar(120) COLLATE utf8mb4_bin DEFAULT NULL,
  `creationDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `removeDate` datetime DEFAULT NULL,
  `lastSingIn` datetime DEFAULT NULL,
  `activate` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`iduser`, `mail`, `username`, `passHash`, `userFirstName`, `userLastName`, `creationDate`, `removeDate`, `lastSingIn`, `activate`) VALUES
(6, 'gon@gmail.com', 'gon', '$2y$10$ebURHV.mdBk9CA1akbilG.lhDcBE70elWJYGZxippWw8DEZF5D.rO', 'gon', 'zale', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
