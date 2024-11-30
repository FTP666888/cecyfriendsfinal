-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Servidor: db5016748144.hosting-data.io
-- Tiempo de generación: 30-11-2024 a las 19:39:59
-- Versión del servidor: 10.11.7-MariaDB-log
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbs13548892`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `id_owner` int(11) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `talentos_requeridos` varchar(100) NOT NULL,
  `descripcion_proyecto` text DEFAULT NULL,
  `recompensas` text DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `id_owner`, `titulo`, `talentos_requeridos`, `descripcion_proyecto`, `recompensas`, `fecha_entrega`) VALUES
(1, 1, 'Proyecto Ciencia', '', 'Investigaci?n cient?fica en biolog?a', 'Certificados', '2024-12-01'),
(2, 2, 'Proyecto Matem?ticas', '', 'Competencia de matem?ticas', 'Reconocimientos', '2024-11-15'),
(3, 3, 'Taller de Rob?tica', '', 'Proyecto para crear un robot funcional', 'Medallas', '2024-10-30'),
(4, 4, 'Club de Lectura', '', 'Grupo para discutir literatura', 'Libros', '2024-12-20'),
(5, 5, 'Equipo de F?tbol', '', 'Grupo deportivo escolar', 'Trofeo', '2024-10-25'),
(6, 6, 'Club de Arte', '', 'Actividades art?sticas', 'Exposici?n', '2024-11-30'),
(7, 6, 'Proyecto De programacion', 'programacion', 'Proyecto defecto', 'calif', '2024-12-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_remitente` int(11) DEFAULT NULL,
  `id_destinatario` int(11) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_remitente`, `id_destinatario`, `id_grupo`, `mensaje`, `fecha_envio`) VALUES
(1, 1, 2, 1, '?Est?s listo para el proyecto?', '2024-09-01 16:00:00'),
(2, 2, 3, 2, 'Vamos a ganar la competencia.', '2024-09-02 17:30:00'),
(3, 3, 4, 3, 'La programaci?n est? en marcha.', '2024-09-03 15:15:00'),
(4, 4, 5, 4, 'El libro de esta semana es genial.', '2024-09-04 20:45:00'),
(5, 5, 6, 5, 'Entrenamiento a las 5 pm.', '2024-09-05 23:00:00'),
(6, 6, 1, 6, 'Exposici?n de arte el pr?ximo mes.', '2024-09-06 22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id_orden` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id_orden`, `id_usuario`, `total`, `fecha`, `estado`) VALUES
(1, 1, '150.75', '2024-01-10 16:30:00', 'P'),
(2, 2, '230.50', '2024-02-12 18:45:00', 'C'),
(3, 3, '50.25', '2024-03-15 17:20:00', 'P'),
(4, 4, '175.00', '2024-04-18 15:30:00', 'C'),
(5, 5, '300.00', '2024-05-22 20:00:00', 'P'),
(6, 6, '75.50', '2024-06-25 21:15:00', 'C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_producto`
--

CREATE TABLE `orden_producto` (
  `id_orden_producto` int(11) NOT NULL,
  `id_orden` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orden_producto`
--

INSERT INTO `orden_producto` (`id_orden_producto`, `id_orden`, `id_producto`, `cantidad`) VALUES
(1, 1, 1, 2),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 5),
(5, 5, 5, 2),
(6, 6, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_puesto` int(11) NOT NULL DEFAULT 1,
  `grupo` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL DEFAULT 'CecyFriends!',
  `pfp_path` varchar(60) NOT NULL DEFAULT '/profile/pfp/default.png',
  `talentos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `id_usuario`, `id_puesto`, `grupo`, `descripcion`, `pfp_path`, `talentos`) VALUES
(1, 5, 1, 'TPROG-AV', 'CecyFriends!', '/profile/pfp/default.png	', 'programacion,diseno,sonic'),
(2, 6, 1, 'TBIO-AV', 'CecyFriends!', '/pfp/perfil_674a0adcd3f0a.jpg', 'cuidado de plantas,hola'),
(3, 7, 1, '5TPROG-AV', 'CecyFriends!', '/pfp/perfil_674a0b869e850.jpg', 'programacion,hola'),
(4, 8, 1, 'TPROG-AV', 'CecyFriends!', '/pfp/perfil_674a2ef2b84f9.jpeg', ''),
(5, 9, 1, '5TPROG-AV', 'CecyFriends!', '/pfp/perfil_674b316311c8f.jpg', 'programacion,diseno'),
(6, 10, 1, 'TMEC-BV', 'CecyFriends!', '/pfp/perfil_674b53bbc2e44.png', 'programacion'),
(7, 11, 1, 'TPROG-AV', 'CecyFriends!', '/pfp/perfil_674b575533feb.jpg', 'programacion,hola'),
(8, 12, 1, '5TPROG-AV', 'CecyFriends!', '/pfp/perfil_674b5faf7a742.jpg', 'programacion'),
(9, 13, 1, 'TBIO-AV', 'CecyFriends!', '/pfp/perfil_674b65f544c37.png', 'programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `nombre_permiso` varchar(20) NOT NULL,
  `desc_permiso` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre_permiso`, `desc_permiso`) VALUES
(1, 'basics', 'acceder e interactuar con paginas por defecto'),
(2, 'escribir', 'Editar la pagina web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) DEFAULT NULL,
  `descripcion` varchar(200) NOT NULL DEFAULT 'Rico platillo ',
  `img_path` varchar(200) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_producto`, `descripcion`, `img_path`, `precio`) VALUES
(1, 'Torta de milanesa', 'hola', '/order/img/Torta_carnitas.jpg', '40.00'),
(2, 'Torta de Carnitas', 'Rico platillo ', '/order/img/Torta_carnitas.jpg', '40.00'),
(3, 'Chilaquiles', 'Rico platillo ', '/order/img/chilaquiles.jpg', '40.00'),
(4, 'Molletes', 'Rico platillo ', '/order/img/mollete.jpg', '40.00'),
(5, 'Gorditas', 'Rico platillo ', '/order/img/gorditas.jpg', '30.00'),
(6, 'Quesadilla', 'Rico platillo ', '/order/img/quesadilla.jpg', '30.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto`
--

CREATE TABLE `puesto` (
  `id_puesto` int(11) NOT NULL,
  `nombre_puesto` varchar(20) NOT NULL,
  `desc_puesto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puesto`
--

INSERT INTO `puesto` (`id_puesto`, `nombre_puesto`, `desc_puesto`) VALUES
(1, 'alumno', 'Solo un alumno de la escuela');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puesto_permiso`
--

CREATE TABLE `puesto_permiso` (
  `id_puesto_permiso` int(11) NOT NULL,
  `id_puesto` int(11) DEFAULT NULL,
  `id_permiso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `puesto_permiso`
--

INSERT INTO `puesto_permiso` (`id_puesto_permiso`, `id_puesto`, `id_permiso`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talento`
--

CREATE TABLE `talento` (
  `id_talento` int(11) NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `descripcion_talento` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talento`
--

INSERT INTO `talento` (`id_talento`, `id_grupo`, `descripcion_talento`) VALUES
(1, 1, 'Investigaci?n Cient?fica'),
(2, 2, 'Resoluci?n de Problemas'),
(3, 3, 'Construcci?n de Robots'),
(4, 4, 'Cr?tica Literaria'),
(5, 5, 'Deportes de Alto Rendimiento'),
(6, 6, 'Creatividad en Artes Visuales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `num_tel` char(10) NOT NULL,
  `matricula` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `email`, `contrasena`, `num_tel`, `matricula`) VALUES
(1, 'Jafet Aldahir Delgadillo Montoya', 'jafetdelgadillo@cecyteq.edu.mx', '$2y$10$tJzBgXRhgd4lDP.w6IQrp.wcm9BMpNhgsj.FilXiQAtIAiE.6ByNu', '4426694154', '224220700603324'),
(2, 'Administrador', 'administrador@cecyteq.edu.mx', '$2y$10$Gy02VWkwGioxvE3aN/9VGud/kSfgSkDPa6944nyRgfw02WQjYjT9G', '5555555555', '123456789012345'),
(3, 'Carlos Eduardo Flores', 'carlosflores@cecyteq.edu.mx', '$2y$10$2rcXiBpB2Cv34mhdEfgAWu15KZntPtn7sJdRjfbnE95IgSMkf7e6m', '4426694155', '224220700660321'),
(4, 'Carlos Eduardo Flores Garcia', 'carlosfloresgarcia@cecyteq.edu.mx', '$2y$10$FOrogORGc.ELCEwTcZyUeOGN4NTS1Yl24KigoLMhUO7Rgj/M.fZ9S', '4426694118', '224220700660398'),
(5, 'Brandon Sonic', 'brandon@cecyteq.edu.mx', '$2y$10$t3AMAxKn/cwrr/lu6ekpM.fJnqf6.EzJSoXoa8uu7E6jyIq0UYdy6', '4426696543', '123123123123121'),
(6, 'Brandon Muratalla', 'brandonmuratalla@cecyteq.edu.mx', '$2y$10$E0q2aOMDnU/6si4bznyqoujwRbGHWQ8L5y8HNQh0Xy15ZXqoxKJGS', '4426674356', '098765432109887'),
(7, 'Jafet Aldahir', 'jafie@cecyteq.edu.mx', '$2y$10$xrnh25H97REBJSBNENN0EOoksONH4Pa/tjDOyqUIAkRCkkqIkkNIe', '4426695666', '567812340987811'),
(8, 'Santiago Peralta Olvera', 'santiagoperalta1@cecyteq.edu.mx', '$2y$10$kJJmhKs/9x8P3T5Z7Diqn.R8oU.Lwl5Txb5HAiWtic1wQuGCN99Cy', '4426768170', '220204061618293'),
(9, 'Cherry', 'cherry@cecyteq.edu.mx', '$2y$10$eODNNMQXU6Be5tNUGMsnrOZ0ECS2VkJ0pvzWtOT2tLcW1LkJ7T.CK', '4426694153', '890219747372717'),
(10, 'daniela', 'dani@cecyteq.edu.mx', '$2y$10$oH4yXj7DGt/tVcoJZn32ceEe6eQGsfcLAGEVoOrNAzQ8HcuX0wrp.', '4426694100', '192837198732981'),
(11, 'Carlos Flores', 'florescarlo@cecyteq.edu.mx', '$2y$10$4pXI.zJVgQ2c/8VRP11SVOsQte7eFTGwzWLvHyKqViYY7UPAzDHJ2', '4428871717', '983458972123123'),
(12, 'ELPRO', 'elprogames@cecyteq.edu.mx', '$2y$10$piHh1e6nirTs53dh5cIteeaaRG3wYdTwQ4QMKX58aZKOQMN0JX.ia', '4426691111', '990219747372717'),
(13, 'Camila Flores', 'fakecami@cecyteq.edu.mx', '$2y$10$jXktAsbV/h0E1jcAspilS.dJoyNkcyfQJ3MUJq4MA9uqOHLpgIE4S', '4423515660', '001019029102910');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_grupo`
--

CREATE TABLE `usuario_grupo` (
  `id_match` int(11) NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `id_interesado` int(11) DEFAULT NULL,
  `fecha_interes` timestamp NOT NULL DEFAULT current_timestamp(),
  `match_confirmado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_grupo`
--

INSERT INTO `usuario_grupo` (`id_match`, `id_grupo`, `id_interesado`, `fecha_interes`, `match_confirmado`) VALUES
(1, 1, 2, '2024-08-15 16:00:00', 0),
(2, 2, 3, '2024-08-16 17:00:00', 0),
(3, 3, 4, '2024-08-17 18:00:00', 0),
(4, 4, 5, '2024-08-18 19:00:00', 0),
(5, 5, 6, '2024-08-19 20:00:00', 0),
(6, 6, 1, '2024-08-20 21:00:00', 0),
(7, 5, 1, '2024-11-30 06:40:09', 0),
(8, 3, 1, '2024-11-30 06:43:30', 0),
(9, 2, 1, '2024-11-30 06:43:40', 0),
(10, 1, 1, '2024-11-30 06:43:44', 0),
(11, 4, 1, '2024-11-30 06:43:47', 0),
(12, 3, 6, '2024-11-30 06:48:36', 0),
(13, 2, 6, '2024-11-30 06:48:38', 0),
(14, 6, 6, '2024-11-30 06:48:40', 1),
(15, 1, 6, '2024-11-30 06:48:41', 0),
(16, 4, 6, '2024-11-30 06:48:42', 0),
(17, NULL, 6, '2024-11-30 07:44:17', 0),
(18, NULL, 6, '2024-11-30 07:44:18', 0),
(19, NULL, 6, '2024-11-30 07:44:18', 0),
(20, NULL, 6, '2024-11-30 07:44:18', 0),
(21, NULL, 6, '2024-11-30 07:44:19', 0),
(22, NULL, 6, '2024-11-30 07:44:19', 0),
(23, NULL, 1, '2024-11-30 07:46:08', 0),
(24, NULL, 1, '2024-11-30 07:46:10', 0),
(25, NULL, 1, '2024-11-30 07:46:14', 0),
(26, NULL, 1, '2024-11-30 07:46:17', 0),
(27, NULL, 1, '2024-11-30 07:46:18', 0),
(28, NULL, 1, '2024-11-30 07:46:18', 0),
(29, NULL, 1, '2024-11-30 07:46:19', 0),
(30, NULL, 1, '2024-11-30 07:46:37', 0),
(31, NULL, 1, '2024-11-30 07:46:38', 0),
(32, NULL, 1, '2024-11-30 07:46:38', 0),
(33, NULL, 1, '2024-11-30 07:46:38', 0),
(34, NULL, 1, '2024-11-30 07:46:43', 0),
(35, NULL, 1, '2024-11-30 07:46:44', 0),
(36, NULL, 1, '2024-11-30 07:46:44', 0),
(37, NULL, 1, '2024-11-30 07:46:44', 0),
(38, 1, 1, '2024-11-30 07:50:05', 0),
(39, 1, 1, '2024-11-30 07:50:06', 0),
(40, 1, 1, '2024-11-30 07:50:06', 0),
(41, 1, 1, '2024-11-30 07:50:06', 0),
(42, 1, 1, '2024-11-30 07:50:06', 0),
(43, 1, 1, '2024-11-30 07:50:07', 0),
(44, 1, 1, '2024-11-30 07:50:07', 0),
(45, 1, 1, '2024-11-30 07:50:08', 0),
(46, 1, 1, '2024-11-30 07:50:27', 0),
(47, 1, 1, '2024-11-30 07:50:28', 0),
(48, 1, 1, '2024-11-30 07:50:28', 0),
(49, 1, 1, '2024-11-30 07:50:28', 0),
(50, 1, 1, '2024-11-30 07:50:28', 0),
(51, 1, 1, '2024-11-30 07:50:28', 0),
(52, 1, 1, '2024-11-30 07:50:28', 0),
(53, 1, 1, '2024-11-30 07:50:29', 0),
(54, 1, 1, '2024-11-30 07:50:29', 0),
(55, 1, 1, '2024-11-30 07:50:29', 0),
(56, 1, 1, '2024-11-30 07:50:32', 0),
(57, 1, 1, '2024-11-30 07:50:34', 0),
(58, 1, 1, '2024-11-30 07:50:49', 0),
(59, 1, 1, '2024-11-30 07:50:49', 0),
(60, 1, 1, '2024-11-30 07:50:50', 0),
(61, 1, 1, '2024-11-30 07:51:42', 0),
(62, 1, 1, '2024-11-30 07:51:52', 0),
(63, 1, 1, '2024-11-30 07:52:01', 0),
(64, 1, 1, '2024-11-30 07:52:02', 0),
(65, 1, 1, '2024-11-30 07:52:10', 0),
(66, 1, 1, '2024-11-30 07:52:10', 0),
(67, 1, 1, '2024-11-30 07:52:10', 0),
(68, 1, 1, '2024-11-30 07:52:11', 0),
(69, 1, 1, '2024-11-30 07:52:11', 0),
(70, 1, 1, '2024-11-30 07:52:11', 0),
(71, 1, 1, '2024-11-30 07:52:11', 0),
(72, 1, 1, '2024-11-30 07:52:11', 0),
(73, 1, 1, '2024-11-30 07:52:11', 0),
(74, 1, 1, '2024-11-30 07:52:12', 0),
(75, 1, 1, '2024-11-30 07:52:16', 0),
(76, 1, 1, '2024-11-30 07:53:39', 0),
(77, 7, 1, '2024-11-30 07:53:45', 0),
(78, 1, 9, '2024-11-30 17:13:58', 0),
(79, 5, 9, '2024-11-30 17:14:05', 0),
(80, 3, 9, '2024-11-30 17:14:09', 0),
(81, 2, 9, '2024-11-30 17:14:12', 0),
(82, 6, 9, '2024-11-30 17:14:15', 0),
(83, 7, 9, '2024-11-30 17:14:19', 0),
(84, 4, 9, '2024-11-30 17:14:22', 0),
(85, 5, 11, '2024-11-30 18:43:52', 0),
(86, 3, 11, '2024-11-30 18:43:57', 0),
(87, 2, 11, '2024-11-30 18:44:05', 0),
(88, 6, 11, '2024-11-30 18:44:10', 0),
(89, 1, 11, '2024-11-30 18:44:13', 0),
(90, 7, 11, '2024-11-30 18:44:17', 0),
(91, 4, 11, '2024-11-30 18:44:20', 0),
(92, 5, 13, '2024-11-30 19:31:21', 0),
(93, 3, 13, '2024-11-30 19:31:27', 0),
(94, 2, 13, '2024-11-30 19:31:28', 0),
(95, 6, 13, '2024-11-30 19:31:29', 0),
(96, 1, 13, '2024-11-30 19:31:30', 0),
(97, 7, 13, '2024-11-30 19:31:31', 0),
(98, 4, 13, '2024-11-30 19:31:32', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD KEY `id_owner` (`id_owner`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_remitente` (`id_remitente`),
  ADD KEY `id_destinatario` (`id_destinatario`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id_orden`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `orden_producto`
--
ALTER TABLE `orden_producto`
  ADD PRIMARY KEY (`id_orden_producto`),
  ADD KEY `id_orden` (`id_orden`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`),
  ADD UNIQUE KEY `id_perfil` (`id_perfil`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_puesto` (`id_puesto`) USING BTREE;

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `puesto`
--
ALTER TABLE `puesto`
  ADD PRIMARY KEY (`id_puesto`);

--
-- Indices de la tabla `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  ADD PRIMARY KEY (`id_puesto_permiso`),
  ADD KEY `id_puesto` (`id_puesto`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `talento`
--
ALTER TABLE `talento`
  ADD PRIMARY KEY (`id_talento`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD UNIQUE KEY `num_tel` (`num_tel`);

--
-- Indices de la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD PRIMARY KEY (`id_match`),
  ADD KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_interesado` (`id_interesado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id_orden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `orden_producto`
--
ALTER TABLE `orden_producto`
  MODIFY `id_orden_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `puesto`
--
ALTER TABLE `puesto`
  MODIFY `id_puesto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  MODIFY `id_puesto_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `talento`
--
ALTER TABLE `talento`
  MODIFY `id_talento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  MODIFY `id_match` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_owner`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_remitente`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `mensajes_ibfk_2` FOREIGN KEY (`id_destinatario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `mensajes_ibfk_3` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `orden_producto`
--
ALTER TABLE `orden_producto`
  ADD CONSTRAINT `orden_producto_ibfk_1` FOREIGN KEY (`id_orden`) REFERENCES `orden` (`id_orden`),
  ADD CONSTRAINT `orden_producto_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`id_puesto`) REFERENCES `puesto_permiso` (`id_puesto_permiso`);

--
-- Filtros para la tabla `puesto_permiso`
--
ALTER TABLE `puesto_permiso`
  ADD CONSTRAINT `puesto_permiso_ibfk_1` FOREIGN KEY (`id_puesto`) REFERENCES `puesto` (`id_puesto`),
  ADD CONSTRAINT `puesto_permiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`);

--
-- Filtros para la tabla `talento`
--
ALTER TABLE `talento`
  ADD CONSTRAINT `talento_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Filtros para la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD CONSTRAINT `usuario_grupo_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `usuario_grupo_ibfk_2` FOREIGN KEY (`id_interesado`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
