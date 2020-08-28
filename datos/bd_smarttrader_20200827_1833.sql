-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2020 a las 01:33:10
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_smarttrader`
--
CREATE DATABASE IF NOT EXISTS `bd_smarttrader` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd_smarttrader`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_caj_movimientos`
--

DROP TABLE IF EXISTS `tb_caj_movimientos`;
CREATE TABLE IF NOT EXISTS `tb_caj_movimientos` (
  `movi_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_par_inversionistas` int(11) NOT NULL,
  `movi_tipo` varchar(1) NOT NULL,
  `movi_descripcion` varchar(100) NOT NULL,
  `movi_fecha` datetime NOT NULL,
  `movi_monto` decimal(10,0) NOT NULL,
  `fc` datetime NOT NULL,
  `uc` int(11) NOT NULL,
  PRIMARY KEY (`movi_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_caj_movimientos`
--

INSERT INTO `tb_caj_movimientos` (`movi_codigo`, `fk_par_inversionistas`, `movi_tipo`, `movi_descripcion`, `movi_fecha`, `movi_monto`, `fc`, `uc`) VALUES
(1, 8, 'E', 'Capital de ingreso', '2020-07-07 23:07:09', '200000', '2020-07-07 23:07:09', 1),
(2, 9, 'E', 'Capital de ingreso', '2020-07-07 23:07:05', '800000', '2020-07-07 23:07:05', 1),
(17, 8, 'S', 'participación en el prestamo 1', '2020-07-20 00:00:00', '100000', '2020-07-20 18:07:31', 1),
(18, 9, 'S', 'participación en el prestamo 1', '2020-07-20 00:00:00', '400000', '2020-07-20 18:07:32', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_par_clientes`
--

DROP TABLE IF EXISTS `tb_par_clientes`;
CREATE TABLE IF NOT EXISTS `tb_par_clientes` (
  `clie_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_par_tipos_identificacion` int(11) NOT NULL,
  `clie_identificacion` varchar(20) NOT NULL,
  `clie_nombre` varchar(50) NOT NULL,
  `clie_apellido` varchar(50) NOT NULL,
  `clie_correo` varchar(80) NOT NULL,
  `clie_celular` varchar(10) NOT NULL,
  `clie_direccion` varchar(200) NOT NULL,
  `clie_calificacion` int(11) NOT NULL,
  `fk_seg_usuarios` int(11) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `fc` datetime NOT NULL,
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  PRIMARY KEY (`clie_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_par_clientes`
--

INSERT INTO `tb_par_clientes` (`clie_codigo`, `fk_par_tipos_identificacion`, `clie_identificacion`, `clie_nombre`, `clie_apellido`, `clie_correo`, `clie_celular`, `clie_direccion`, `clie_calificacion`, `fk_seg_usuarios`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 1, '1130100100', 'Carlos', 'Lopez', 'clopez.cliente@st.com', '3101001010', '', 0, 18, 1, '2020-07-17 00:07:58', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_par_estados`
--

DROP TABLE IF EXISTS `tb_par_estados`;
CREATE TABLE IF NOT EXISTS `tb_par_estados` (
  `esta_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `esta_descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`esta_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_par_estados`
--

INSERT INTO `tb_par_estados` (`esta_codigo`, `esta_descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo'),
(3, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_par_inversionistas`
--

DROP TABLE IF EXISTS `tb_par_inversionistas`;
CREATE TABLE IF NOT EXISTS `tb_par_inversionistas` (
  `inve_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `inve_identificacion` varchar(30) NOT NULL,
  `fk_par_tipos_identificacion` int(11) NOT NULL,
  `inve_nombre` varchar(80) NOT NULL,
  `inve_apellido` varchar(80) NOT NULL,
  `inve_correo` varchar(200) NOT NULL,
  `inve_telefono` int(11) DEFAULT NULL,
  `inve_celular` varchar(10) NOT NULL,
  `fk_seg_usuarios` int(11) NOT NULL,
  `inve_saldo` decimal(10,0) NOT NULL DEFAULT 0,
  `inve_saldo_min` decimal(10,0) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `fc` datetime NOT NULL,
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  PRIMARY KEY (`inve_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_par_inversionistas`
--

INSERT INTO `tb_par_inversionistas` (`inve_codigo`, `inve_identificacion`, `fk_par_tipos_identificacion`, `inve_nombre`, `inve_apellido`, `inve_correo`, `inve_telefono`, `inve_celular`, `fk_seg_usuarios`, `inve_saldo`, `inve_saldo_min`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(8, '1130595683', 1, 'Jorge', 'Aguilar', 'jaguilar.8709@gmail.com', NULL, '3185572639', 15, '100000', '80000', 1, '2020-07-07 23:07:09', 1, NULL, NULL),
(9, '66661645', 1, 'Yuliet', 'Mejia de la Hoz', 'ymejia1212@gmail.com', NULL, '3105044487', 16, '400000', '80000', 1, '2020-07-16 23:07:40', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_par_tipos`
--

DROP TABLE IF EXISTS `tb_par_tipos`;
CREATE TABLE IF NOT EXISTS `tb_par_tipos` (
  `tipo_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_descripcion` varchar(56) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `fc` datetime NOT NULL,
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  PRIMARY KEY (`tipo_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tb_par_tipos`
--

INSERT INTO `tb_par_tipos` (`tipo_codigo`, `tipo_descripcion`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 'Cédula de Ciudadanía', 1, '2018-10-15 09:10:32', 1, '2020-07-07 00:07:00', 1),
(2, 'NIT', 1, '2020-07-07 00:07:41', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_par_tipos_identificacion`
--

DROP TABLE IF EXISTS `tb_par_tipos_identificacion`;
CREATE TABLE IF NOT EXISTS `tb_par_tipos_identificacion` (
  `tiid_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tiid_descripcion` varchar(80) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `fc` datetime NOT NULL,
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  PRIMARY KEY (`tiid_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_par_tipos_identificacion`
--

INSERT INTO `tb_par_tipos_identificacion` (`tiid_codigo`, `tiid_descripcion`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 'Cédula de Ciudadanía', 1, '2020-07-07 01:07:17', 1, NULL, NULL),
(2, 'NIT', 1, '2020-07-07 01:07:22', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_pre_cuotas`
--

DROP TABLE IF EXISTS `tb_pre_cuotas`;
CREATE TABLE IF NOT EXISTS `tb_pre_cuotas` (
  `prcu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_pre_prestamos` int(11) NOT NULL,
  `prcu_numero` int(11) NOT NULL,
  `prcu_fecha` datetime NOT NULL,
  `prcu_fecha_pago` datetime NOT NULL,
  `prcu_valor` int(11) NOT NULL,
  `prcu_valor_pago` int(11) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`prcu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_pre_cuotas`
--

INSERT INTO `tb_pre_cuotas` (`prcu_codigo`, `fk_pre_prestamos`, `prcu_numero`, `prcu_fecha`, `prcu_fecha_pago`, `prcu_valor`, `prcu_valor_pago`, `fk_par_estados`) VALUES
(1, 1, 1, '2020-08-20 00:00:00', '0000-00-00 00:00:00', 165000, 0, 1),
(2, 1, 2, '2020-09-20 00:00:00', '0000-00-00 00:00:00', 165000, 0, 1),
(3, 1, 3, '2020-10-20 00:00:00', '0000-00-00 00:00:00', 165000, 0, 1),
(4, 1, 4, '2020-11-20 00:00:00', '0000-00-00 00:00:00', 165000, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_pre_participacion`
--

DROP TABLE IF EXISTS `tb_pre_participacion`;
CREATE TABLE IF NOT EXISTS `tb_pre_participacion` (
  `prpa_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_pre_prestamos` int(11) NOT NULL,
  `fk_par_inversionistas` int(11) NOT NULL,
  `prpa_porcentaje` decimal(10,2) NOT NULL,
  PRIMARY KEY (`prpa_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_pre_participacion`
--

INSERT INTO `tb_pre_participacion` (`prpa_codigo`, `fk_pre_prestamos`, `fk_par_inversionistas`, `prpa_porcentaje`) VALUES
(1, 1, 8, '20.00'),
(2, 1, 9, '80.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_pre_prestamos`
--

DROP TABLE IF EXISTS `tb_pre_prestamos`;
CREATE TABLE IF NOT EXISTS `tb_pre_prestamos` (
  `pres_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_par_clientes` int(11) NOT NULL,
  `pres_fecha` datetime NOT NULL,
  `pres_vlr_monto` decimal(10,0) NOT NULL,
  `pres_plazo` int(11) NOT NULL,
  `pres_interes` float NOT NULL,
  `pres_int_mensual` decimal(10,0) NOT NULL,
  `pres_int_total` decimal(10,0) NOT NULL,
  `pres_vlr_pago` decimal(10,0) NOT NULL,
  `pres_vlr_cuota` decimal(10,0) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `fc` datetime NOT NULL,
  `uc` int(11) NOT NULL,
  PRIMARY KEY (`pres_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_pre_prestamos`
--

INSERT INTO `tb_pre_prestamos` (`pres_codigo`, `fk_par_clientes`, `pres_fecha`, `pres_vlr_monto`, `pres_plazo`, `pres_interes`, `pres_int_mensual`, `pres_int_total`, `pres_vlr_pago`, `pres_vlr_cuota`, `fk_par_estados`, `fc`, `uc`) VALUES
(1, 1, '2020-07-20 00:00:00', '500000', 4, 8, '40000', '160000', '660000', '165000', 1, '2020-07-20 18:07:31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_modulos`
--

DROP TABLE IF EXISTS `tb_seg_modulos`;
CREATE TABLE IF NOT EXISTS `tb_seg_modulos` (
  `modu_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `modu_descripcion` varchar(50) NOT NULL,
  `modu_prefijo` varchar(3) NOT NULL,
  `modu_icono` varchar(20) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`modu_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_modulos`
--

INSERT INTO `tb_seg_modulos` (`modu_codigo`, `modu_descripcion`, `modu_prefijo`, `modu_icono`, `fk_par_estados`) VALUES
(1, 'Seguridad', 'seg', 'shield', 1),
(2, 'Parámetros', 'par', 'sliders', 1),
(3, 'Caja y Bancos', 'par', 'money', 1),
(4, 'Préstamos', 'pre', 'handshake-o', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_opciones`
--

DROP TABLE IF EXISTS `tb_seg_opciones`;
CREATE TABLE IF NOT EXISTS `tb_seg_opciones` (
  `opci_codigo` int(11) NOT NULL,
  `fk_seg_modulos` int(11) NOT NULL,
  `opci_nombre` varchar(50) NOT NULL,
  `opci_enlace` varchar(100) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`opci_codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_opciones`
--

INSERT INTO `tb_seg_opciones` (`opci_codigo`, `fk_seg_modulos`, `opci_nombre`, `opci_enlace`, `fk_par_estados`) VALUES
(1001, 1, 'Perfiles', 'seguridad/perfiles', 1),
(1002, 1, 'Usuarios', 'seguridad/usuarios', 1),
(1003, 1, 'Permisos', 'seguridad/permisos', 1),
(1004, 1, 'Cambiar Clave', 'seguridad/cambiarClave', 1),
(2001, 2, 'Tipos de Identificación', 'parametros/tiposIdentificacion', 1),
(2002, 2, 'Inversionsitas', 'parametros/inversionistas', 1),
(2003, 2, 'Clientes', 'parametros/clientes', 1),
(3001, 3, 'Movimientos', 'caja/movimientos', 1),
(4001, 4, 'Préstamos', 'prestamos/prestamos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_perfiles`
--

DROP TABLE IF EXISTS `tb_seg_perfiles`;
CREATE TABLE IF NOT EXISTS `tb_seg_perfiles` (
  `perf_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `perf_descripcion` varchar(50) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `fc` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` int(11) DEFAULT NULL,
  PRIMARY KEY (`perf_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_perfiles`
--

INSERT INTO `tb_seg_perfiles` (`perf_codigo`, `perf_descripcion`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 'root', 1, '2017-07-01 10:00:00', 1, NULL, NULL),
(3, 'Administrador', 1, '2018-10-13 17:10:39', 1, NULL, NULL),
(5, 'Supervisor', 1, '2018-10-16 17:10:01', 1, '2018-10-18 09:10:20', 1),
(6, 'Cobrador', 1, '2018-10-18 09:10:28', 1, NULL, NULL),
(7, 'Inversionista', 1, '2020-07-07 03:07:04', 1, NULL, NULL),
(8, 'Cliente', 1, '2020-07-17 00:07:33', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_permisos`
--

DROP TABLE IF EXISTS `tb_seg_permisos`;
CREATE TABLE IF NOT EXISTS `tb_seg_permisos` (
  `perm_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_seg_perfiles` int(11) NOT NULL,
  `fk_seg_opciones` int(11) NOT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `perm_c` int(11) NOT NULL DEFAULT 0,
  `perm_r` int(11) NOT NULL DEFAULT 0,
  `perm_u` int(11) NOT NULL DEFAULT 0,
  `perm_d` int(11) NOT NULL DEFAULT 0,
  `perm_l` int(11) NOT NULL,
  PRIMARY KEY (`perm_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_permisos`
--

INSERT INTO `tb_seg_permisos` (`perm_codigo`, `fk_seg_perfiles`, `fk_seg_opciones`, `fk_par_estados`, `perm_c`, `perm_r`, `perm_u`, `perm_d`, `perm_l`) VALUES
(13, 5, 1004, 1, 1, 0, 0, 0, 0),
(14, 5, 2001, 1, 1, 1, 1, 0, 1),
(36, 6, 1004, 1, 1, 0, 0, 0, 0),
(37, 6, 2001, 1, 0, 0, 0, 0, 1),
(59, 3, 1001, 1, 1, 1, 1, 0, 1),
(60, 3, 1002, 1, 1, 1, 1, 0, 1),
(61, 3, 1003, 1, 1, 1, 1, 0, 1),
(62, 3, 1004, 1, 1, 1, 1, 0, 1),
(63, 3, 2001, 1, 1, 1, 1, 0, 1),
(64, 3, 2002, 1, 1, 1, 1, 0, 1),
(65, 3, 2003, 1, 1, 1, 1, 0, 1),
(66, 3, 3001, 1, 1, 1, 1, 0, 1),
(67, 1, 1001, 1, 1, 1, 1, 1, 1),
(68, 1, 1002, 1, 1, 1, 1, 1, 1),
(69, 1, 1003, 1, 1, 1, 1, 1, 0),
(70, 1, 1004, 1, 1, 1, 1, 1, 0),
(71, 1, 2001, 1, 1, 1, 1, 1, 1),
(72, 1, 2002, 1, 1, 1, 1, 1, 1),
(73, 1, 2003, 1, 1, 1, 1, 1, 1),
(74, 1, 3001, 1, 1, 1, 1, 0, 0),
(75, 1, 4001, 1, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_seg_usuarios`
--

DROP TABLE IF EXISTS `tb_seg_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_seg_usuarios` (
  `usua_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usua_nombre` varchar(50) NOT NULL,
  `usua_mail` varchar(100) NOT NULL,
  `usua_login` varchar(20) NOT NULL,
  `usua_clave` varchar(50) NOT NULL,
  `fk_seg_perfiles` int(11) NOT NULL,
  `usua_token` varchar(255) DEFAULT NULL,
  `usua_vcto_token` datetime DEFAULT NULL,
  `fk_par_estados` int(11) NOT NULL DEFAULT 1,
  `fc` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `uc` int(11) NOT NULL,
  `fm` datetime DEFAULT NULL,
  `um` smallint(11) DEFAULT NULL,
  PRIMARY KEY (`usua_codigo`),
  UNIQUE KEY `usua_login` (`usua_login`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tb_seg_usuarios`
--

INSERT INTO `tb_seg_usuarios` (`usua_codigo`, `usua_nombre`, `usua_mail`, `usua_login`, `usua_clave`, `fk_seg_perfiles`, `usua_token`, `usua_vcto_token`, `fk_par_estados`, `fc`, `uc`, `fm`, `um`) VALUES
(1, 'Usuario Root', 'root@st.com', 'root', '202cb962ac59075b964b07152d234b70', 1, '', '0000-00-00 00:00:00', 1, '2017-07-01 10:00:00', 0, '2018-10-23 16:10:03', 1),
(3, 'Administrador Prueba', 'q@q.com', 'admin.prueba', '202cb962ac59075b964b07152d234b70', 3, NULL, NULL, 1, '2018-10-13 17:10:15', 0, '2018-10-13 17:10:26', 1),
(4, 'Visitante Prueba', 'q@q.com', 'visitante', '202cb962ac59075b964b07152d234b70', 5, NULL, NULL, 1, '2018-10-16 17:10:11', 0, '2018-10-16 17:10:37', 1),
(15, 'Jorge Aguilar', 'jaguilar.8709@gmail.com', 'jorge.aguilar.inv', '202cb962ac59075b964b07152d234b70', 7, NULL, NULL, 1, '2020-07-07 23:07:08', 1, NULL, NULL),
(16, 'Yuliet Mejia de la Hoz', 'ymejia1212@gmail.com', 'yuliet.mejia.inv', '202cb962ac59075b964b07152d234b70', 7, NULL, NULL, 1, '2020-07-07 23:07:05', 1, NULL, NULL),
(18, 'Carlos Lopez', 'clopez.cliente@st.com', 'carlos.lopez.clie', '202cb962ac59075b964b07152d234b70', 8, NULL, NULL, 1, '2020-07-17 00:07:58', 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
