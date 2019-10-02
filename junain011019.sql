-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 02-10-2019 a las 00:59:15
-- Versión del servidor: 5.7.11
-- Versión de PHP: 7.2.7

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
  `cod_dis_even` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `dat_del`
--

INSERT INTO `dat_del` (`cod_del`, `cod_par`, `cod_reg`, `cod_pue`, `cod_dis_even`) VALUES
(2, 2, 8, 8, 2),
(3, 1, 3, 1, 1),
(4, 3, 5, 15, 3),
(5, 5, 3, 5, 4),
(6, 5, 3, 5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_even`
--

CREATE TABLE `dat_even` (
  `cod_even` int(3) NOT NULL,
  `des_even` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fec_even` date NOT NULL,
  `cod_edo` int(11) NOT NULL,
  `cod_tip_even` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Eventos';

--
-- Volcado de datos para la tabla `dat_even`
--

INSERT INTO `dat_even` (`cod_even`, `des_even`, `fec_even`, `cod_edo`, `cod_tip_even`) VALUES
(20, 'Junain 2019', '2019-05-29', 1, 1),
(21, 'Junain 2020', '2019-10-10', 1, 2),
(22, 'Junain 2021', '2019-10-10', 1, 1),
(25, 'Junain 2022', '2019-10-10', 1, 3),
(26, 'Junain 2023', '2019-10-10', 1, 3),
(27, 'juegos 2019', '2019-10-10', 1, 1),
(28, 'juegos 2012', '2019-10-10', 1, 1),
(29, 'juegos 201', '2019-10-10', 1, 1),
(30, 'juegos', '2019-10-10', 1, 1),
(31, 'lol', '2019-10-10', 1, 1),
(32, 'tibia', '2019-10-10', 2, 2),
(33, 'junain12', '2019-12-19', 1, 1),
(40, 'juegos amazonas', '2019-02-10', 1, 1),
(41, 'juegos yaracui', '2019-02-10', 22, 1),
(42, 'Junain 2025', '2019-10-10', 12, 1),
(43, 'Indi19', '2019-10-03', 9, 1);

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
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_med`
--

CREATE TABLE `dat_med` (
  `cod_par` int(3) NOT NULL,
  `cod_esp` int(11) NOT NULL,
  `des_esp` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `dat_med`
--

INSERT INTO `dat_med` (`cod_par`, `cod_esp`, `des_esp`) VALUES
(3, 1, 'Traumatología');

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
(1, 5, 20, 4),
(2, 4, 43, 5),
(3, 2, 43, 6),
(4, 8, 20, 14),
(5, 13, 43, 4),
(6, 14, 43, 5),
(7, 25, 43, 14),
(8, 7, 43, 2),
(9, 35, 43, 7),
(10, 39, 43, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_per`
--

CREATE TABLE `dat_per` (
  `cod_per` int(4) NOT NULL,
  `cod_nac` tinyint(1) NOT NULL,
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
(1, 1, 19885429, 'deifer', 'garanton', '1990-12-08', 1),
(2, 1, 24217511, 'Emibell', 'Romero', '1995-08-15', 2),
(3, 1, 24217510, 'jared', 'Romero', '1994-10-10', 2),
(4, 1, 10241563, 'José', 'Perez', '1985-10-10', 1),
(5, 2, 19885425, 'Tirion', 'Lanister', '1996-12-08', 1),
(6, 1, 19885300, 'deifer', 'garanton', '1990-12-08', 1),
(7, 1, 10113786, 'Lisbeth', 'Espinoza', '1969-09-08', 2),
(8, 1, 18530418, 'Luis', 'Millan', '1987-07-25', 1),
(9, 1, 12675958, 'Geronimo', 'Gil', '1975-10-23', 1),
(10, 1, 10123963, 'Pedro', 'Perez', '1983-10-05', 1),
(11, 1, 15753951, 'Maria', 'Larez', '1984-01-12', 2),
(12, 1, 15759684, 'Juan', 'Rojas', '1981-10-16', 1),
(13, 1, 10159753, 'Maria', 'Redondo', '1968-06-27', 2),
(14, 1, 12116090, 'Maria', 'Rodriguez', '1976-05-09', 2),
(15, 2, 112233, 'Mick', 'Jagger', '1955-02-03', 1),
(16, 2, 92000000, 'Bruce', 'Dickinson', '1958-08-08', 1),
(17, 1, 8654987, 'Miguel', 'Mijares', '1965-01-02', 1),
(18, 1, 10357159, 'Julio', 'Lopez', '1975-04-03', 1),
(19, 1, 7357159, 'Jose', 'Cardona', '1950-07-06', 1),
(20, 1, 6131720, 'Ivan', 'Millan', '1965-10-05', 1),
(21, 1, 9657459, 'Mario', 'Lemina', '1988-05-04', 1),
(22, 1, 12852258, 'Keylyn', 'Alvarado', '1984-09-09', 2),
(23, 1, 10698745, 'Gilberto', 'Perez', '1969-04-02', 1),
(24, 1, 1111748, 'Mirian', 'Borges', '1960-11-04', 2),
(25, 2, 1235748, 'Gareth', 'Bale', '1991-05-02', 1),
(27, 1, 10121314, 'Juan', 'Miguel', '1989-04-02', 1),
(28, 2, 7869698, 'Oscar', 'D Leon', '1943-07-08', 1),
(29, 1, 101112978, 'Carlos', 'Campos', '1970-08-04', 1),
(30, 1, 12365745, 'Juan', 'Romero', '1991-08-24', 1),
(32, 1, 12365747, 'Juan', 'Romero', '1991-08-24', 1),
(33, 1, 12852259, 'JAIRO', 'VELEZ', '1975-09-03', 1),
(35, 1, 25003004, 'Josef', 'Martinez', '1994-04-01', 1),
(37, 1, 23003003, 'Romulo', 'Otero', '1994-07-06', 1),
(39, 1, 23033003, 'Romulo', 'Otero', '1994-07-06', 1),
(40, 1, 10132645, 'Peter', 'Anguila', '2000-10-09', 1),
(42, 1, 10132666, 'Peter', 'Anguila', '2000-10-09', 1),
(44, 1, 10132677, 'Peter', 'Anguila', '2000-10-09', 1),
(45, 1, 10132688, 'Peter', 'Anguila', '2000-10-09', 1),
(47, 2, 7852258, 'Bruce', 'Dickinson', '1958-10-09', 1),
(48, 2, 7872258, 'Bruce', 'Dickinson', '1958-10-09', 1),
(52, 1, 3147852, 'Oscar', 'D Leon', '1942-04-03', 1);

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
(1, 8, 2, 5),
(2, 10, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dat_usr`
--

CREATE TABLE `dat_usr` (
  `cod_usr` int(11) NOT NULL,
  `cod_per` int(11) NOT NULL,
  `des_usr` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cod_perf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='datos de usuario';

--
-- Volcado de datos para la tabla `dat_usr`
--

INSERT INTO `dat_usr` (`cod_usr`, `cod_per`, `des_usr`, `clave`, `cod_perf`) VALUES
(1, 23, 'GIL251', '123456', 2),
(2, 15, 'Jagg66', '6666', 1),
(3, 35, 'Jmart', '1717', 3);

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
  `cod_tip_even` int(11) NOT NULL,
  `cod_cat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_dis`
--

INSERT INTO `tab_dis` (`cod_dis`, `des_dis`, `cod_tip_even`, `cod_cat`) VALUES
(1, 'Cerbatana', 1, 3),
(2, 'Tiro con arco', 1, 3),
(3, 'Rallado de yuca', 1, 3),
(4, 'Corte de leña', 1, 1),
(5, 'Carrera de Watura', 1, 3),
(6, 'Curiara', 1, 5),
(7, 'Natación', 1, 1),
(8, 'Lucha indígena', 1, 1),
(9, 'Carrera de relevo con tronco', 1, 1),
(10, 'Prueba de fuerza', 1, 5),
(11, 'Lanza', 1, 3),
(12, 'Atletismo', 1, 3),
(13, 'Baloncesto', 2, 1),
(14, 'Baloncesto', 2, 3),
(15, 'Baloncesto', 2, 2),
(16, 'Baloncesto', 2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tab_dis_even`
--

CREATE TABLE `tab_dis_even` (
  `cod_dis_even` int(11) NOT NULL,
  `cod_dis` int(11) NOT NULL,
  `cod_even` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
(41, 'Wapishana'),
(33, 'Warao'),
(34, 'Warekena'),
(35, 'Wayuu'),
(37, 'Yanomami'),
(36, 'Yarabana'),
(38, 'Ye\'kwana'),
(40, 'Yeral'),
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
  `des_tip_even` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tab_tip_even`
--

INSERT INTO `tab_tip_even` (`cod_tip_even`, `des_tip_even`) VALUES
(1, 'Autóctono'),
(2, 'Convencional'),
(3, 'Mixto');

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
  ADD KEY `cod_dis` (`cod_dis_even`);

--
-- Indices de la tabla `dat_even`
--
ALTER TABLE `dat_even`
  ADD PRIMARY KEY (`cod_even`),
  ADD UNIQUE KEY `des_even` (`des_even`),
  ADD KEY `cod_edo` (`cod_edo`),
  ADD KEY `cod_tip_even` (`cod_tip_even`);

--
-- Indices de la tabla `dat_inv`
--
ALTER TABLE `dat_inv`
  ADD PRIMARY KEY (`cod_inv`),
  ADD KEY `cod_par` (`cod_par`);

--
-- Indices de la tabla `dat_med`
--
ALTER TABLE `dat_med`
  ADD PRIMARY KEY (`cod_esp`),
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
  ADD KEY `des_gen` (`cod_gen`);

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
  ADD KEY `per_id` (`cod_per`),
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
  ADD KEY `cod_cat` (`cod_cat`),
  ADD KEY `cod_tip_even` (`cod_tip_even`);

--
-- Indices de la tabla `tab_dis_even`
--
ALTER TABLE `tab_dis_even`
  ADD PRIMARY KEY (`cod_dis_even`),
  ADD KEY `cod_even` (`cod_even`),
  ADD KEY `cod_dis` (`cod_dis`);

--
-- Indices de la tabla `tab_edo`
--
ALTER TABLE `tab_edo`
  ADD PRIMARY KEY (`cod_edo`);

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
-- AUTO_INCREMENT de la tabla `dat_even`
--
ALTER TABLE `dat_even`
  MODIFY `cod_even` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `dat_inv`
--
ALTER TABLE `dat_inv`
  MODIFY `cod_inv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dat_med`
--
ALTER TABLE `dat_med`
  MODIFY `cod_esp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dat_par`
--
ALTER TABLE `dat_par`
  MODIFY `cod_par` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dat_per`
--
ALTER TABLE `dat_per`
  MODIFY `cod_per` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `dat_per_tec`
--
ALTER TABLE `dat_per_tec`
  MODIFY `cod_equ_tec` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dat_usr`
--
ALTER TABLE `dat_usr`
  MODIFY `cod_usr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `cod_dis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tab_dis_even`
--
ALTER TABLE `tab_dis_even`
  MODIFY `cod_dis_even` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tab_edo`
--
ALTER TABLE `tab_edo`
  MODIFY `cod_edo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- AUTO_INCREMENT de la tabla `tab_perf`
--
ALTER TABLE `tab_perf`
  MODIFY `cod_perf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tab_pue`
--
ALTER TABLE `tab_pue`
  MODIFY `cod_pue` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `cod_tip_even` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dat_del`
--
ALTER TABLE `dat_del`
  ADD CONSTRAINT `dat_del_ibfk_2` FOREIGN KEY (`cod_pue`) REFERENCES `tab_pue` (`cod_pue`),
  ADD CONSTRAINT `dat_del_ibfk_3` FOREIGN KEY (`cod_reg`) REFERENCES `tab_reg` (`cod_reg`),
  ADD CONSTRAINT `dat_del_ibfk_4` FOREIGN KEY (`cod_par`) REFERENCES `dat_par` (`cod_par`);

--
-- Filtros para la tabla `dat_even`
--
ALTER TABLE `dat_even`
  ADD CONSTRAINT `dat_even_ibfk_4` FOREIGN KEY (`cod_edo`) REFERENCES `tab_edo` (`cod_edo`),
  ADD CONSTRAINT `dat_even_ibfk_5` FOREIGN KEY (`cod_tip_even`) REFERENCES `tab_tip_even` (`cod_tip_even`);

--
-- Filtros para la tabla `dat_inv`
--
ALTER TABLE `dat_inv`
  ADD CONSTRAINT `dat_inv_ibfk_2` FOREIGN KEY (`cod_par`) REFERENCES `dat_par` (`cod_par`);

--
-- Filtros para la tabla `dat_med`
--
ALTER TABLE `dat_med`
  ADD CONSTRAINT `dat_med_ibfk_1` FOREIGN KEY (`cod_par`) REFERENCES `dat_par` (`cod_par`);

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
  ADD CONSTRAINT `dat_per_ibfk_1` FOREIGN KEY (`cod_gen`) REFERENCES `tab_gen` (`cod_gen`) ON UPDATE CASCADE;

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
  ADD CONSTRAINT `dat_usr_ibfk_1` FOREIGN KEY (`cod_per`) REFERENCES `dat_per` (`cod_per`),
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
  ADD CONSTRAINT `tab_dis_ibfk_1` FOREIGN KEY (`cod_cat`) REFERENCES `tab_cat` (`cod_cat`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tab_dis_ibfk_2` FOREIGN KEY (`cod_tip_even`) REFERENCES `tab_tip_even` (`cod_tip_even`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tab_dis_even`
--
ALTER TABLE `tab_dis_even`
  ADD CONSTRAINT `tab_dis_even_ibfk_3` FOREIGN KEY (`cod_even`) REFERENCES `dat_even` (`cod_even`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tab_perf`
--
ALTER TABLE `tab_perf`
  ADD CONSTRAINT `tab_perf_ibfk_1` FOREIGN KEY (`cod_rol`) REFERENCES `tab_rol` (`cod_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
