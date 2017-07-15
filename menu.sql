-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-09-2016 a las 07:22:01
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `title`, `icon`, `action`, `parent_id`) VALUES
(1, 'Catalogo y Consultas', 'file text outline icon', '', 0),
(2, 'Arrticulos', 'shopping bag icon', 'catalogos.articulos', 1),
(3, 'Servicios', 'suitcase icon', 'catalogos.servicios', 1),
(4, 'Compras', 'shop icon', 'catalogos.compras', 1),
(5, 'Traspasos', 'exchange icon', 'catalogos.traspasos', 1),
(6, 'Clientes', 'users icon', 'catalogos.traspasos', 1),
(7, 'Proveedores', 'shipping icon', 'catalogos.proveedores', 1),
(8, 'Cortes de Caja', 'calculator icon', 'catalogos.corteDeCaja', 1),
(9, 'Pedidos', 'shipping icon', 'catalogos.pedidos', 1),
(10, 'Movimientos', 'shipping icon', 'catalogos.movimientos', 1),
(11, 'Citas', 'calendar icon', 'catalogos.citas', 1),
(12, 'Sucursal', 'building icon', 'catalogos.sucursal', 1),
(13, 'Procesos y Operaciones', 'tasks icon', '', 0),
(14, 'Operaciones', 'wizard icon', '', 13),
(15, 'Venta', 'dollar icon', 'operaciones.venta', 14),
(16, 'Citas', 'checked calendar icon', 'operaciones.citas', 14),
(17, 'Traspaso', 'exchange icon', 'operaciones.traspaso', 14),
(18, 'Facturacion CFDI', 'file text icon', 'operaciones.facturacion', 14),
(19, 'Cotizacion', 'line chart icon', 'operaciones.cotizacion', 14),
(20, 'Pedidos', 'shipping icon', 'operaciones.pedidos', 14),
(21, 'Procesos', 'tasks icon', '', 13),
(22, 'Respaldo local', 'disk outline icon', 'procesos.respaldo', 21),
(23, 'Localizacion', 'translate icon', 'procesos.localizacion', 21),
(24, 'Categoria', 'sitemap icon', 'procesos.categoria', 21),
(25, 'Departamento', 'building icon', 'procesos.departamento', 21),
(27, 'Configuración', 'settings icon', '', 0),
(28, 'Empresa', 'building icon', 'configuracion.empresa', 27),
(29, 'Usuarios', 'users icon', 'configuracion.usuarios', 27),
(30, 'Roles', 'lock icon', 'configuracion.roles', 27),
(31, 'Perifericos', 'plug icon', 'configuracion.perifericos', 27),
(32, 'Moneda', 'dollar icon', 'configuracion.moneda', 27),
(33, 'Unidades', 'dollar icon', 'configuracion.unidades', 27),
(34, 'cajas', 'laptop icon', 'configuracion.cajas', 27),
(35, 'Licencia', 'registered icon', 'configuracion.licencia', 27);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD UNIQUE KEY `id` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
