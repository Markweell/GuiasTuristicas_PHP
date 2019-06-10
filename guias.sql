-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2019 a las 23:00:04
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyectoguiasturisticas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guias`
--

CREATE TABLE `guias` (
  `id` int(11) NOT NULL,
  `fechaDeCreacion` date NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `Titulo` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `guias`
--

INSERT INTO `guias` (`id`, `fechaDeCreacion`, `id_usuario`, `Titulo`, `descripcion`) VALUES
(43, '2019-03-10', 12, 'Casco Antiguo CÃ³rdoba', 'Recorrido por las callejuelas de CÃ³rdoba. El centro histÃ³rico de CÃ³rdoba es uno de los cascos antiguos mÃ¡s grandes de Europa. En 1984, la Unesco declarÃ³ a la mezquita-catedral de CÃ³rdoba como Patrimonio de la Humanidad.1â€‹ MÃ¡s tarde, en 1994, la Unesco expandiÃ³ esta denominaciÃ³n a gran parte del casco antiguo.2â€‹ El centro histÃ³rico posee una gran riqueza monumental conservando grandes vestigios de la Ã©poca romana, Ã¡rabe y cristiana.3â€‹\r\n\r\nLos elementos de borde que definen la del'),
(48, '2019-03-10', 12, 'Guia por las afueras', 'Cuando el viajero llega a CÃ³rdoba suele venir con su estancia organizada de antemano: No dejar de ver la Mezquita-Catedralâ€¦ Visitar el AlcÃ¡zar de los Reyes Cristianosâ€¦ Ummâ€¦ Ah, sÃ­, la Sinagogaâ€¦ Yâ€¦ Â¿Hay algo mÃ¡s?\r\n\r\nÂ¡Claro que hay mÃ¡s! Porque CÃ³rdoba no es sÃ³lo la Mezquita-Catedral, ni el AlcÃ¡zar, ni la Sinagoga. Â¡CÃ³rdoba es mucho mÃ¡s que eso! CÃ³rdoba sorprende a los viajeros por la gran cantidad de patrimonio que alberga en sus rincones. Es una ciudad ideal para el turist');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `guias`
--
ALTER TABLE `guias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `guias_fk_id_usuarioCreador` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `guias`
--
ALTER TABLE `guias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `guias`
--
ALTER TABLE `guias`
  ADD CONSTRAINT `guias_fk_id_usuarioCreador` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
