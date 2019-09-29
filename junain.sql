-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2019 a las 01:51:17
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `junain`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_del`
--

CREATE TABLE `dat_del` (
  `cod_del` int(4) NOT NULL,
  `cod_par` int(3) NOT NULL,
  `cod_reg` int(2) NOT NULL,
  `cod_pue` int(3) NOT NULL,
  `cod_dis` int(11) NOT NULL,
  `cod_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dat_del`
--

INSERT INTO `dat_del` (`cod_del`, `cod_par`, `cod_reg`, `cod_pue`, `cod_dis`, `cod_cat`) VALUES
(1, 4, 3, 35, 11, 2),
(2, 5, 4, 2, 11, 2),
(3, 6, 7, 7, 8, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_even`
--

CREATE TABLE `dat_even` (
  `cod_even` int(3) NOT NULL,
  `des_even` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fec_even` date NOT NULL,
  `cod_edo` int(11) NOT NULL,
  `cod_tip_even` int(11) NOT NULL,
  `cod_estat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Eventos';

--
-- Volcado de datos para la tabla `dat_even`
--

INSERT INTO `dat_even` (`cod_even`, `des_even`, `fec_even`, `cod_edo`, `cod_tip_even`, `cod_estat`) VALUES
(28, 'junain', '2020-12-08', 10, 1, 2),
(31, 'ZWAJIRA 2019', '2019-12-30', 23, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_inv`
--

CREATE TABLE `dat_inv` (
  `cod_inv` int(11) NOT NULL,
  `cod_par` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dat_inv`
--

INSERT INTO `dat_inv` (`cod_inv`, `cod_par`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_par`
--

CREATE TABLE `dat_par` (
  `cod_par` int(4) NOT NULL,
  `cod_per` int(4) NOT NULL,
  `cod_even` int(11) NOT NULL,
  `cod_perf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dat_par`
--

INSERT INTO `dat_par` (`cod_par`, `cod_per`, `cod_even`, `cod_perf`) VALUES
(1, 15, 28, 8),
(2, 13, 28, 14),
(3, 14, 28, 7),
(4, 17, 28, 4),
(5, 18, 28, 5),
(6, 16, 28, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_per`
--

CREATE TABLE `dat_per` (
  `cod_per` int(4) NOT NULL,
  `cod_nac` int(2) NOT NULL,
  `ced` int(8) NOT NULL,
  `nom` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `ape` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fec_nac` date NOT NULL,
  `cod_gen` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dat_per`
--

INSERT INTO `dat_per` (`cod_per`, `cod_nac`, `ced`, `nom`, `ape`, `fec_nac`, `cod_gen`) VALUES
(13, 2, 24217518, 'ESPERANZA CLAHRIZ', 'GARANTON ROMERO', '1995-06-11', 2),
(14, 1, 19885430, 'VICTOR', 'GARANTON', '1990-01-04', 1),
(15, 1, 24217513, 'ELIZABETH', 'GARANTON', '1995-12-30', 2),
(16, 1, 19885429, 'DEIFER', 'GARANTON', '1990-12-08', 1),
(17, 1, 24217511, 'EMIBELL', 'ROMERO', '1995-08-15', 2),
(18, 1, 24214445, 'AMITA', 'AMITA', '1995-08-15', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_per_tec`
--

CREATE TABLE `dat_per_tec` (
  `cod_equ_tec` int(4) NOT NULL,
  `cod_par` int(11) NOT NULL,
  `cod_inst` int(11) NOT NULL,
  `cod_carg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dat_per_tec`
--

INSERT INTO `dat_per_tec` (`cod_equ_tec`, `cod_par`, `cod_inst`, `cod_carg`) VALUES
(1, 3, 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_usr`
--

CREATE TABLE `dat_usr` (
  `cod_usr` int(11) NOT NULL,
  `des_usr` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cod_perf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos de usuario';

--
-- Volcado de datos para la tabla `dat_usr`
--

INSERT INTO `dat_usr` (`cod_usr`, `des_usr`, `clave`, `cod_perf`) VALUES
(1, 'DGARANTON', '123456', 1),
(3, 'DGARANTOAA', '123456', 1),
(5, 'DGARANTOAAA', '123456', 1),
(6, 'EROMERO', '123456', 1),
(7, 'DGAR', '123', 1),
(8, 'FALLLLL', '1', 1),
(9, 'DDDDDDD', '12', 1),
(10, 'BBBBBBBBBBBBBB', '1', 1),
(11, 'QQQQQQ', '12', 1),
(12, 'QWWWWWW', '12', 1),
(13, 'RRRRRRRR', '12', 2),
(15, 'DGARANTONH', '111', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_carg`
--

CREATE TABLE `tab_carg` (
  `cod_carg` int(11) NOT NULL,
  `des_carg` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_carg`
--

INSERT INTO `tab_carg` (`cod_carg`, `des_carg`) VALUES
(1, 'Coordinador'),
(2, 'Supervisor'),
(3, 'Director'),
(4, 'Analista'),
(5, 'Asistente'),
(6, 'Gerente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_cat`
--

CREATE TABLE `tab_cat` (
  `cod_cat` int(2) NOT NULL,
  `des_cat` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `cod_gen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_cat`
--

INSERT INTO `tab_cat` (`cod_cat`, `des_cat`, `cod_gen`) VALUES
(1, 'Juvenil', 1),
(2, 'Libre', 1),
(3, 'Juvenil', 2),
(4, 'Libre', 2),
(5, 'Juvenil', 3),
(6, 'Libre', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_dis`
--

CREATE TABLE `tab_dis` (
  `cod_dis` int(11) NOT NULL,
  `des_dis` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cod_tip_even` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_dis`
--

INSERT INTO `tab_dis` (`cod_dis`, `des_dis`, `cod_tip_even`) VALUES
(1, 'Cerbatana', 1),
(2, 'Tiro con arco', 1),
(3, 'Rallado de yuca', 1),
(4, 'Corte de leña', 1),
(5, 'Carrera de Watura', 1),
(6, 'Curiara', 1),
(7, 'Natación', 1),
(8, 'Lucha indígena', 1),
(9, 'Carrera de relevo con tronco', 1),
(10, 'Prueba de fuerza', 1),
(11, 'Lanza', 1),
(12, 'Atletismo', 1),
(13, 'Baloncesto', 2),
(14, 'Futbol', 2),
(15, 'Voleibol', 2),
(16, 'Kickingball', 2),
(17, 'Boxeo', 2),
(18, 'Tenis de mesa', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_edo`
--

CREATE TABLE `tab_edo` (
  `cod_edo` int(11) NOT NULL,
  `des_edo` varchar(250) CHARACTER SET utf8 NOT NULL,
  `iso_3166-2` varchar(4) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_edo`
--

INSERT INTO `tab_edo` (`cod_edo`, `des_edo`, `iso_3166-2`) VALUES
(1, 'Amazonas', 'VE-X'),
(2, 'Anzoátegui', 'VE-B'),
(3, 'Apure', 'VE-C'),
(4, 'Aragua', 'VE-D'),
(5, 'Barinas', 'VE-E'),
(6, 'Bolívar', 'VE-F'),
(7, 'Carabobo', 'VE-G'),
(8, 'Cojedes', 'VE-H'),
(9, 'Delta Amacuro', 'VE-Y'),
(10, 'Falcón', 'VE-I'),
(11, 'Guárico', 'VE-J'),
(12, 'Lara', 'VE-K'),
(13, 'Mérida', 'VE-L'),
(14, 'Miranda', 'VE-M'),
(15, 'Monagas', 'VE-N'),
(16, 'Nueva Esparta', 'VE-O'),
(17, 'Portuguesa', 'VE-P'),
(18, 'Sucre', 'VE-R'),
(19, 'Táchira', 'VE-S'),
(20, 'Trujillo', 'VE-T'),
(21, 'Vargas', 'VE-W'),
(22, 'Yaracuy', 'VE-U'),
(23, 'Zulia', 'VE-V'),
(24, 'Distrito Capital', 'VE-A'),
(25, 'Dependencias Federales', 'VE-Z');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_estat`
--

CREATE TABLE `tab_estat` (
  `cod_estat` int(11) NOT NULL,
  `des_estat` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_estat`
--

INSERT INTO `tab_estat` (`cod_estat`, `des_estat`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_gen`
--

CREATE TABLE `tab_gen` (
  `cod_gen` int(11) NOT NULL,
  `des_gen` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_gen`
--

INSERT INTO `tab_gen` (`cod_gen`, `des_gen`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Mixto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_inst`
--

CREATE TABLE `tab_inst` (
  `cod_inst` int(11) NOT NULL,
  `des_inst` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `siglas` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_inst`
--

INSERT INTO `tab_inst` (`cod_inst`, `des_inst`, `siglas`) VALUES
(1, 'Ministerio del Poder Popular Para los Pueblos Indí', 'MINPPPI'),
(2, 'Ministerio de Juventud y Deporte', 'MINDEP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_nac`
--

CREATE TABLE `tab_nac` (
  `cod_nac` int(2) NOT NULL,
  `des_nac` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_nac`
--

INSERT INTO `tab_nac` (`cod_nac`, `des_nac`) VALUES
(1, 'Venezolana'),
(2, 'Extranjera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_perf`
--

CREATE TABLE `tab_perf` (
  `cod_perf` int(11) NOT NULL,
  `des_perf` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `cod_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_perf`
--

INSERT INTO `tab_perf` (`cod_perf`, `des_perf`, `cod_rol`) VALUES
(1, 'Administrador', 1),
(2, 'Analista', 1),
(3, 'Auditor', 1),
(4, 'Deportista', 2),
(5, 'Delegado', 2),
(6, 'Médico', 2),
(7, 'Acreditación', 4),
(8, 'Logística', 4),
(9, 'Organizador', 4),
(10, 'Hospedaje', 4),
(11, 'Hidratación', 4),
(12, 'Seguridad', 4),
(13, 'Transporte', 4),
(14, 'Invitado', 5),
(15, 'Invitado Especial ', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_pue`
--

CREATE TABLE `tab_pue` (
  `cod_pue` int(3) NOT NULL,
  `des_pue` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_pue`
--

INSERT INTO `tab_pue` (`cod_pue`, `des_pue`) VALUES
(1, 'Akawayo'),
(2, 'Amorúa'),
(3, 'Anú'),
(4, 'Arawako'),
(5, 'Ayamán'),
(6, 'Baniva'),
(7, 'Baré'),
(8, 'Barí'),
(9, 'Chaima'),
(10, 'Cuiba'),
(11, 'Cumanagoto'),
(12, 'Curripaco'),
(13, 'Eñepá'),
(14, 'Guanono'),
(15, 'Hoti'),
(16, 'Houttöja'),
(17, 'Inga'),
(18, 'Japreria'),
(19, 'Jivi'),
(20, 'Kariña'),
(21, 'Mako'),
(22, 'Mapoyo'),
(23, 'Ñengatú'),
(24, 'Pemón'),
(25, 'Piapoco'),
(26, 'Puinave'),
(27, 'Pumé'),
(28, 'Sáliva'),
(29, 'Sanemá'),
(30, 'Sapé'),
(31, 'Timotes'),
(32, 'Uruak'),
(33, 'Warao'),
(34, 'Warekena'),
(35, 'Wayuu'),
(37, 'Yanomami'),
(36, 'Yarabana'),
(38, 'Ye\'kwana'),
(39, 'Yukpa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_reg`
--

CREATE TABLE `tab_reg` (
  `cod_reg` int(2) NOT NULL,
  `des_reg` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `color` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_reg`
--

INSERT INTO `tab_reg` (`cod_reg`, `des_reg`, `color`) VALUES
(1, 'Valles, Sabanas y Tepuyes', 'Rosa'),
(2, 'Sierra de Perija y Cordillera Andina', 'Carne'),
(3, 'Costas y Montañas', 'Rojo'),
(4, 'Deltas, Caños y Manglares', 'Verde'),
(5, 'Sabanas y Morichales Llaneros', 'Naranja'),
(6, 'Peninsula, Desiertos y Aguas', 'Azul claro'),
(7, 'Rios, Sierras y Bosques de la Selva Amazonica', 'Amarillo'),
(8, 'Zonas Urbanas', 'Vinotinto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_rol`
--

CREATE TABLE `tab_rol` (
  `cod_rol` int(11) NOT NULL,
  `des_rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_rol`
--

INSERT INTO `tab_rol` (`cod_rol`, `des_rol`) VALUES
(1, 'Usuario'),
(2, 'Delegado'),
(4, 'Personal Técnico'),
(5, 'Invitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_tip_even`
--

CREATE TABLE `tab_tip_even` (
  `cod_tip_even` int(11) NOT NULL,
  `des_tip_even` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_tip_even`
--

INSERT INTO `tab_tip_even` (`cod_tip_even`, `des_tip_even`) VALUES
(1, 'Autóctono'),
(2, 'Convencional'),
(3, 'Autóctono y Convencional');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dat_del`
--
ALTER TABLE `dat_del`
  ADD PRIMARY KEY (`cod_del`),
  ADD KEY `cod_reg` (`cod_reg`),
  ADD KEY `cod_pue` (`cod_pue`),
  ADD KEY `cod_even` (`cod_par`),
  ADD KEY `cod_dis` (`cod_dis`),
  ADD KEY `cod_cat` (`cod_cat`);

--
-- Indices de la tabla `dat_even`
--
ALTER TABLE `dat_even`
  ADD PRIMARY KEY (`cod_even`),
  ADD UNIQUE KEY `des_even` (`des_even`),
  ADD KEY `cod_edo` (`cod_edo`),
  ADD KEY `cod_tip_even` (`cod_tip_even`),
  ADD KEY `cod_estat` (`cod_estat`);

--
-- Indices de la tabla `dat_inv`
--
ALTER TABLE `dat_inv`
  ADD PRIMARY KEY (`cod_inv`),
  ADD KEY `cod_par` (`cod_par`);

--
-- Indices de la tabla `dat_par`
--
ALTER TABLE `dat_par`
  ADD PRIMARY KEY (`cod_par`),
  ADD KEY `per_id` (`cod_per`),
  ADD KEY `cod_even` (`cod_even`),
  ADD KEY `cod_perf` (`cod_perf`);

--
-- Indices de la tabla `dat_per`
--
ALTER TABLE `dat_per`
  ADD PRIMARY KEY (`cod_per`),
  ADD UNIQUE KEY `ced` (`ced`),
  ADD KEY `des_gen` (`cod_gen`),
  ADD KEY `nac` (`cod_nac`);

--
-- Indices de la tabla `dat_per_tec`
--
ALTER TABLE `dat_per_tec`
  ADD PRIMARY KEY (`cod_equ_tec`),
  ADD KEY `cod_par` (`cod_par`),
  ADD KEY `cod_inst` (`cod_inst`),
  ADD KEY `cod_carg` (`cod_carg`);

--
-- Indices de la tabla `dat_usr`
--
ALTER TABLE `dat_usr`
  ADD PRIMARY KEY (`cod_usr`),
  ADD UNIQUE KEY `des_usr` (`des_usr`),
  ADD KEY `cod_perf` (`cod_perf`);

--
-- Indices de la tabla `tab_carg`
--
ALTER TABLE `tab_carg`
  ADD PRIMARY KEY (`cod_carg`);

--
-- Indices de la tabla `tab_cat`
--
ALTER TABLE `tab_cat`
  ADD PRIMARY KEY (`cod_cat`),
  ADD KEY `cod_gen` (`cod_gen`);

--
-- Indices de la tabla `tab_dis`
--
ALTER TABLE `tab_dis`
  ADD PRIMARY KEY (`cod_dis`),
  ADD KEY `cod_tip_even` (`cod_tip_even`);

--
-- Indices de la tabla `tab_edo`
--
ALTER TABLE `tab_edo`
  ADD PRIMARY KEY (`cod_edo`);

--
-- Indices de la tabla `tab_estat`
--
ALTER TABLE `tab_estat`
  ADD PRIMARY KEY (`cod_estat`);

--
-- Indices de la tabla `tab_gen`
--
ALTER TABLE `tab_gen`
  ADD PRIMARY KEY (`cod_gen`);

--
-- Indices de la tabla `tab_inst`
--
ALTER TABLE `tab_inst`
  ADD PRIMARY KEY (`cod_inst`);

--
-- Indices de la tabla `tab_nac`
--
ALTER TABLE `tab_nac`
  ADD PRIMARY KEY (`cod_nac`);

--
-- Indices de la tabla `tab_perf`
--
ALTER TABLE `tab_perf`
  ADD PRIMARY KEY (`cod_perf`),
  ADD KEY `cod_rol` (`cod_rol`);

--
-- Indices de la tabla `tab_pue`
--
ALTER TABLE `tab_pue`
  ADD PRIMARY KEY (`cod_pue`),
  ADD UNIQUE KEY `des_pue` (`des_pue`);

--
-- Indices de la tabla `tab_reg`
--
ALTER TABLE `tab_reg`
  ADD PRIMARY KEY (`cod_reg`);

--
-- Indices de la tabla `tab_rol`
--
ALTER TABLE `tab_rol`
  ADD PRIMARY KEY (`cod_rol`);

--
-- Indices de la tabla `tab_tip_even`
--
ALTER TABLE `tab_tip_even`
  ADD PRIMARY KEY (`cod_tip_even`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dat_del`
--
ALTER TABLE `dat_del`
  MODIFY `cod_del` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dat_even`
--
ALTER TABLE `dat_even`
  MODIFY `cod_even` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `dat_inv`
--
ALTER TABLE `dat_inv`
  MODIFY `cod_inv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dat_par`
--
ALTER TABLE `dat_par`
  MODIFY `cod_par` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `dat_per`
--
ALTER TABLE `dat_per`
  MODIFY `cod_per` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `dat_per_tec`
--
ALTER TABLE `dat_per_tec`
  MODIFY `cod_equ_tec` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dat_usr`
--
ALTER TABLE `dat_usr`
  MODIFY `cod_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tab_carg`
--
ALTER TABLE `tab_carg`
  MODIFY `cod_carg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tab_cat`
--
ALTER TABLE `tab_cat`
  MODIFY `cod_cat` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tab_dis`
--
ALTER TABLE `tab_dis`
  MODIFY `cod_dis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tab_edo`
--
ALTER TABLE `tab_edo`
  MODIFY `cod_edo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tab_estat`
--
ALTER TABLE `tab_estat`
  MODIFY `cod_estat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tab_gen`
--
ALTER TABLE `tab_gen`
  MODIFY `cod_gen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tab_inst`
--
ALTER TABLE `tab_inst`
  MODIFY `cod_inst` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tab_nac`
--
ALTER TABLE `tab_nac`
  MODIFY `cod_nac` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tab_perf`
--
ALTER TABLE `tab_perf`
  MODIFY `cod_perf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tab_pue`
--
ALTER TABLE `tab_pue`
  MODIFY `cod_pue` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `tab_reg`
--
ALTER TABLE `tab_reg`
  MODIFY `cod_reg` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tab_rol`
--
ALTER TABLE `tab_rol`
  MODIFY `cod_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tab_tip_even`
--
ALTER TABLE `tab_tip_even`
  MODIFY `cod_tip_even` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dat_del`
--
ALTER TABLE `dat_del`
  ADD CONSTRAINT `dat_del_ibfk_2` FOREIGN KEY (`cod_pue`) REFERENCES `tab_pue` (`cod_pue`),
  ADD CONSTRAINT `dat_del_ibfk_3` FOREIGN KEY (`cod_reg`) REFERENCES `tab_reg` (`cod_reg`),
  ADD CONSTRAINT `dat_del_ibfk_4` FOREIGN KEY (`cod_par`) REFERENCES `dat_par` (`cod_par`),
  ADD CONSTRAINT `dat_del_ibfk_6` FOREIGN KEY (`cod_cat`) REFERENCES `tab_cat` (`cod_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dat_del_ibfk_7` FOREIGN KEY (`cod_dis`) REFERENCES `tab_dis` (`cod_dis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `dat_even`
--
ALTER TABLE `dat_even`
  ADD CONSTRAINT `dat_even_ibfk_4` FOREIGN KEY (`cod_edo`) REFERENCES `tab_edo` (`cod_edo`),
  ADD CONSTRAINT `dat_even_ibfk_5` FOREIGN KEY (`cod_tip_even`) REFERENCES `tab_tip_even` (`cod_tip_even`),
  ADD CONSTRAINT `dat_even_ibfk_6` FOREIGN KEY (`cod_estat`) REFERENCES `tab_estat` (`cod_estat`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dat_inv`
--
ALTER TABLE `dat_inv`
  ADD CONSTRAINT `dat_inv_ibfk_2` FOREIGN KEY (`cod_par`) REFERENCES `dat_par` (`cod_par`);

--
-- Filtros para la tabla `dat_par`
--
ALTER TABLE `dat_par`
  ADD CONSTRAINT `dat_par_ibfk_2` FOREIGN KEY (`cod_per`) REFERENCES `dat_per` (`cod_per`),
  ADD CONSTRAINT `dat_par_ibfk_3` FOREIGN KEY (`cod_perf`) REFERENCES `tab_perf` (`cod_perf`),
  ADD CONSTRAINT `dat_par_ibfk_4` FOREIGN KEY (`cod_even`) REFERENCES `dat_even` (`cod_even`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `dat_per`
--
ALTER TABLE `dat_per`
  ADD CONSTRAINT `dat_per_ibfk_1` FOREIGN KEY (`cod_gen`) REFERENCES `tab_gen` (`cod_gen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `dat_per_ibfk_2` FOREIGN KEY (`cod_nac`) REFERENCES `tab_nac` (`cod_nac`);

--
-- Filtros para la tabla `dat_per_tec`
--
ALTER TABLE `dat_per_tec`
  ADD CONSTRAINT `dat_per_tec_ibfk_3` FOREIGN KEY (`cod_par`) REFERENCES `dat_par` (`cod_par`),
  ADD CONSTRAINT `dat_per_tec_ibfk_4` FOREIGN KEY (`cod_inst`) REFERENCES `tab_inst` (`cod_inst`),
  ADD CONSTRAINT `dat_per_tec_ibfk_5` FOREIGN KEY (`cod_carg`) REFERENCES `tab_carg` (`cod_carg`);

--
-- Filtros para la tabla `dat_usr`
--
ALTER TABLE `dat_usr`
  ADD CONSTRAINT `dat_usr_ibfk_2` FOREIGN KEY (`cod_perf`) REFERENCES `tab_perf` (`cod_perf`);

--
-- Filtros para la tabla `tab_cat`
--
ALTER TABLE `tab_cat`
  ADD CONSTRAINT `tab_cat_ibfk_1` FOREIGN KEY (`cod_gen`) REFERENCES `tab_gen` (`cod_gen`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tab_dis`
--
ALTER TABLE `tab_dis`
  ADD CONSTRAINT `tab_dis_ibfk_1` FOREIGN KEY (`cod_tip_even`) REFERENCES `tab_tip_even` (`cod_tip_even`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tab_perf`
--
ALTER TABLE `tab_perf`
  ADD CONSTRAINT `tab_perf_ibfk_1` FOREIGN KEY (`cod_rol`) REFERENCES `tab_rol` (`cod_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
