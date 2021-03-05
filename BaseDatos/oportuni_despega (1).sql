-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2019 a las 16:22:05
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `oportuni_despega`
--
CREATE DATABASE IF NOT EXISTS `oportuni_despega` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `oportuni_despega`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `ID_Alumno` char(15) NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Class` smallint(6) DEFAULT NULL,
  `correo` varchar(75) NOT NULL,
  `ID_Carrera` varchar(10) CHARACTER SET utf8 NOT NULL,
  `ID_Empresa` char(10) DEFAULT NULL,
  `Sexo` binary(1) DEFAULT NULL,
  `Estado` varchar(15) DEFAULT NULL,
  `ID_Status` char(10) DEFAULT NULL,
  `SedeAsistencia` char(10) DEFAULT NULL,
  `ID_Sede` char(10) NOT NULL,
  `Ciclo` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID_Alumno`, `Nombre`, `Class`, `correo`, `ID_Carrera`, `ID_Empresa`, `Sexo`, `Estado`, `ID_Status`, `SedeAsistencia`, `ID_Sede`, `Ciclo`) VALUES
('2015-SS-FT-0001', 'Eduardo Antonio Aguilar SolÃ³rzano', 2017, 'Eduardo.Aguilar@oportunidades.org.sv', 'TSI007', 'ITCA', 0x48, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0002', 'Flor de Maria Alvarado Canjura', 2017, 'Flor.Alvarado@oportunidades.org.sv', 'TEP005', 'UDB', 0x4d, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0003', 'Daniel Antonio Alvarado HernÃ¡ndez', 2017, 'Daniel.Alvarado@oportunidades.org.sv', 'PEM003', 'ESEN', 0x48, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0005', 'Paola Sthephany Angel Rodriguez', 2017, 'Paola.Angel@oportunidades.org.sv', 'TEP005', 'UDB', 0x4d, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0006', 'Fatima Alejandra Arevalo LÃ³pez', 2017, 'Fatima.Arevalo@oportunidades.org.sv', 'TIE004', 'ITCA', 0x4d, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0007', 'Raquel Estefany Argueta Alejo', 2017, 'Raquel.Argueta@oportunidades.org.sv', 'TEF001', 'UEES', 0x4d, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0008', 'AnaÃ­ Michelle AvilÃ©s Castaneda', 2017, 'AnaÃ­.AvilÃ©s@oportunidades.org.sv', 'DEM002', 'UES', 0x4d, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0009', 'Fatima del Carmen Ayala', 2017, 'Fatima.Ayala@oportunidades.org.sv', 'DEM002', 'UEES', 0x4d, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0010', 'Steven Armando Barrera Iraheta', 2017, 'Steven.Barrera@oportunidades.org.sv', 'ISI006', 'UDB', 0x48, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0018', 'Joel Salomon Castillo MÃ¡rquez', 2017, 'joel.castillo@oportunidades.org.sv', 'TSI007', 'UDB', 0x48, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0069', 'Daniel Orlando MÃ¡rquez Saravia', 2017, 'daniel.marquez@oportunidades.org.sv', 'TSI007', 'UDB', 0x48, 'Activo', 'EST001', 'SSFT', 'SSFT', 0),
('2015-SS-FT-0070', 'Jose Maria Marquez Saravia', 2021, 'jose.marquez@oportunidades.org.sv', 'TSI007', 'UFGSS', 0x48, 'Activo', 'EST001', 'SSFT', 'SSFT', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `Id_Carrera` varchar(10) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `Duracion` varchar(30) NOT NULL,
  `ID_Facultades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`Id_Carrera`, `nombre`, `Duracion`, `ID_Facultades`) VALUES
('DEM002', 'Doctorado en Medicina', 'Larga DuraciÃ³n', 12),
('ISI006', 'Ing. en Sistemas InformÃ¡ticos', 'Larga DuraciÃ³n', 7),
('PEM003', 'Profesorado en MatemÃ¡ticas', 'Corta DuraciÃ³n', 11),
('TEF001', 'TÃ©c.en EnfermerÃ­a', 'Corta DuraciÃ³n', 12),
('TEP005', 'TÃ©c. en Publicidad', 'Corta DuraciÃ³n', 10),
('TIE004', 'TÃ©c. en Ing. ElÃ©ctrica', 'Corta DuraciÃ³n', 8),
('TSI007', 'TÃ©c.en Sistemas InformÃ¡ticos', 'Corta DuraciÃ³n', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos`
--

CREATE TABLE `ciclos` (
  `ID_Ciclo` char(10) NOT NULL,
  `Fechanicio` date DEFAULT NULL,
  `FechaFinal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciclos`
--

INSERT INTO `ciclos` (`ID_Ciclo`, `Fechanicio`, `FechaFinal`) VALUES
('2019-01', '2019-11-20', '2019-11-12'),
('201901', '2019-01-15', '2019-05-16'),
('201902', '2019-06-01', '2019-11-16'),
('202001', '2019-11-12', '2019-11-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE `competencias` (
  `IDComptenecia` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `Nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competenciatalleres`
--

CREATE TABLE `competenciatalleres` (
  `id` int(11) NOT NULL,
  `id_taller` char(10) CHARACTER SET latin1 NOT NULL,
  `id_competencia` varchar(3) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprabantestatus`
--

CREATE TABLE `comprabantestatus` (
  `ID_SCom` char(10) NOT NULL,
  `Titulo` varchar(50) DEFAULT NULL,
  `ID_Alumno` char(10) DEFAULT NULL,
  `Descripcion` text,
  `Comprobante` text,
  `ID_Ciclo` char(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `ID_Empresa` char(10) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Tipo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`ID_Empresa`, `Nombre`, `Tipo`) VALUES
('CREO', 'CREO', 'Empresa Externa'),
('ECMH', 'Escuela de ComunicaciÃ³n MÃ³nica Herrera', 'Universidad'),
('ESEN', 'Escuela Superior de EconomÃ­a y Negocios', 'Universidad'),
('FGK', 'Programa Oportunidades', 'Oportunidades'),
('ITCA', 'Escuela Especializada en IngenierÃ­a ITCA-FEPADE S', 'Universidad'),
('UCA', 'Universidad Centroamericana JosÃ© SimeÃ³n CaÃ±as S', 'Universidad'),
('UDB', 'Universidad Don Bosco', 'Universidad'),
('UEES', 'Universidad EvangÃ©lica de El Salvador', 'Universidad'),
('UES', 'Universidad Nacional de El Salvador SS', 'Universidad'),
('UFGSS', 'Universidad Francisco Gavidia SS', 'Universidad'),
('UJMD', 'Universidad Dr. JosÃ© MatÃ­as Delgado', 'Universidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evalicionreunion`
--

CREATE TABLE `evalicionreunion` (
  `id_alumno` char(10) NOT NULL,
  `id_reunion` char(10) NOT NULL,
  `rating` int(11) NOT NULL,
  `comentario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciontalleres`
--

CREATE TABLE `evaluaciontalleres` (
  `ID_Alumno` char(10) DEFAULT NULL,
  `ID_Taller` char(10) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comentario` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades`
--

CREATE TABLE `facultades` (
  `IDFacultates` int(11) NOT NULL,
  `Nombre` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `facultades`
--

INSERT INTO `facultades` (`IDFacultates`, `Nombre`) VALUES
(7, 'InformÃ¡tica'),
(8, 'Ingenierias'),
(9, 'CienciasEconomicas'),
(10, 'DisenoPublicidad'),
(11, 'Humanidades'),
(12, 'Salud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formatotalleres`
--

CREATE TABLE `formatotalleres` (
  `ID_Formato` char(10) NOT NULL,
  `Nombre` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `formatotalleres`
--

INSERT INTO `formatotalleres` (`ID_Formato`, `Nombre`) VALUES
('SITC', 'Charla'),
('SITF', 'Foro'),
('SITL', 'Laboratorio'),
('SITT', 'Taller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariosreunion`
--

CREATE TABLE `horariosreunion` (
  `IDHorRunion` int(10) NOT NULL,
  `ID_Reunion` char(10) CHARACTER SET latin1 NOT NULL,
  `HorarioInicio` time NOT NULL,
  `HorarioFinalizado` time NOT NULL,
  `Canitdad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horariosreunion`
--

INSERT INTO `horariosreunion` (`IDHorRunion`, `ID_Reunion`, `HorarioInicio`, `HorarioFinalizado`, `Canitdad`) VALUES
(1, 'REUUDB19', '08:00:00', '00:00:00', 10),
(2, 'UDB0219114', '08:00:00', '09:00:00', 10),
(3, 'UDB0219114', '09:00:00', '10:00:00', 10),
(4, 'UDB0219111', '11:10:00', '12:12:00', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hsociales`
--

CREATE TABLE `hsociales` (
  `ID_HSociales` char(10) NOT NULL,
  `CantidadH` int(11) DEFAULT NULL,
  `FechaInicio` date DEFAULT NULL,
  `FechaFinal` date DEFAULT NULL,
  `Encargado` varchar(100) DEFAULT NULL,
  `Descripcion` text,
  `Comprobante` text,
  `ID_Ciclo` char(10) DEFAULT NULL,
  `ID_Alumno` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `IDinscripcion` int(11) NOT NULL,
  `ID_Sede` char(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`IDinscripcion`, `ID_Sede`, `Fecha`, `Hora`) VALUES
(1, 'SSFT', '2019-11-12', '09:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcionreunion`
--

CREATE TABLE `inscripcionreunion` (
  `id_alumno` char(15) NOT NULL,
  `id_reunion` char(10) NOT NULL,
  `Horario` int(11) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `asistencia` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciontalleres`
--

CREATE TABLE `inscripciontalleres` (
  `ID_Alumno` char(15) DEFAULT NULL,
  `ID_Taller` char(10) DEFAULT NULL,
  `Asistencia` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `ID_Alumno` char(10) DEFAULT NULL,
  `CicloU` int(11) DEFAULT NULL,
  `Year` year(4) DEFAULT NULL,
  `ComprobanteNotas` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivostaller`
--

CREATE TABLE `objetivostaller` (
  `IDobjetivo` int(3) NOT NULL,
  `ID_Taller` char(10) CHARACTER SET latin1 NOT NULL,
  `Objetivo` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reuniones`
--

CREATE TABLE `reuniones` (
  `ID_Reunion` char(10) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Fecha` date DEFAULT NULL,
  `ID_Empresa` char(10) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `ID_Ciclo` char(10) DEFAULT NULL,
  `Estado` varchar(25) NOT NULL,
  `ComprobanteLista` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reuniones`
--

INSERT INTO `reuniones` (`ID_Reunion`, `Titulo`, `Fecha`, `ID_Empresa`, `Rating`, `ID_Ciclo`, `Estado`, `ComprobanteLista`) VALUES
('UCA0219111', 'ReuniÃ³n Mensual UCA Julio', '2019-10-10', 'UCA', NULL, '201902', 'Activo', ''),
('UDB0219111', 'ReuniÃ³n Mensual UDB Noviembre', '2018-11-08', 'UDB', NULL, '201902', 'Activo', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `ID_Sede` char(10) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`ID_Sede`, `Nombre`) VALUES
('AHFT', 'AHFT'),
('AHSAT', 'AHSAT'),
('CHFT', 'CHFT'),
('CHSAT', 'CHSAT'),
('SAFT', 'SAFT'),
('SASAT', 'SASAT'),
('SMSAT', 'SMSAT'),
('SSFT', 'SSFT'),
('SSSAT', 'SSSAT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `ID_Status` char(10) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`ID_Status`, `Nombre`) VALUES
('ESP004', 'Estudiando-Pasantias'),
('EST001', 'Estudiando'),
('EST005', 'Estudiando y Trabajando'),
('PAS002', 'Pasantias'),
('TRA003', 'Trabajando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talleres`
--

CREATE TABLE `talleres` (
  `ID_Taller` char(10) NOT NULL,
  `Titulo` varchar(100) DEFAULT NULL,
  `Fecha` date DEFAULT NULL,
  `Hora` time DEFAULT NULL,
  `ID_Formato` char(10) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `ID_Sede` char(10) DEFAULT NULL,
  `ID_Ciclo` int(11) DEFAULT NULL,
  `ID_Empresa` char(50) DEFAULT NULL,
  `ComprobanteLista` text,
  `Estado` varchar(25) NOT NULL,
  `Cupo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `talleres`
--

INSERT INTO `talleres` (`ID_Taller`, `Titulo`, `Fecha`, `Hora`, `ID_Formato`, `Rating`, `ID_Sede`, `ID_Ciclo`, `ID_Empresa`, `ComprobanteLista`, `Estado`, `Cupo`) VALUES
('P2019', 'Prueba', '2019-12-04', '10:00:00', 'SITC', NULL, 'SSFT', 201902, 'FGK', NULL, 'Activo', 40),
('TE2019', 'Taller Externa', '2019-11-01', '10:00:00', 'SITT', NULL, 'SSFT', 201902, 'CREO', NULL, 'Activo', 40),
('TI2019', 'Taller Interno', '2019-11-10', '14:00:00', 'SITT', NULL, 'SSFT', 201902, 'FGK', NULL, 'Activo', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUsuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `contrasena` varchar(75) NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `conteo_entradas` int(5) NOT NULL DEFAULT '0',
  `ID_Sede` char(10) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `SedeAsistencia` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IDUsuario`, `nombre`, `correo`, `contrasena`, `imagen`, `conteo_entradas`, `ID_Sede`, `cargo`, `SedeAsistencia`) VALUES
(1, '', 'daniel.saravia@oportunidades.org.sv', '$2y$10$IRPmCA6G6j/JdBjNOVDa0.K8NiwklfBoTd/4uf9o5Beneu2LXt9dG', 'img60417.jpeg', 1, 'SSFT', 'SuperUsuario', 'SSFT'),
(3, '', 'Eduardo.Aguilar@oportunidades.org.sv', '$2y$10$ga89yw9aud.hTXspxVgSHOELpi/qfM8uUga.OznPmjuMj0nbO1Kn2', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(4, '', 'Flor.Alvarado@oportunidades.org.sv', '$2y$10$5MAo2Wp03RfKfP3SSSo09OR/fayT21LRYTWK7u9J4iOttZtvJN.86', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(5, '', 'Daniel.Alvarado@oportunidades.org.sv', '$2y$10$RiP0cXs77H8CpYX5BTNZg.5MR/R4UAFpat.dVHbM5UJfV/bJQjisC', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(6, '', 'Paola.Angel@oportunidades.org.sv', '$2y$10$Df4TK9BJCfZ/ULX.ertAyOJzkV8oHZjEfHb39usTE01B29QhzUnXm', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(7, '', 'Fatima.Arevalo@oportunidades.org.sv', '$2y$10$JtI9.hW9re5K.PvZX/nGO.cHZhTAaR8c1GcMCm6Em9k9kOQPDwgLe', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(8, '', 'Raquel.Argueta@oportunidades.org.sv', '$2y$10$.UaJICiHhZfaHB8gS.FAD.keb13sV3TeCFQ7idvrle.cQQPMoLY0u', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(9, '', 'AnaÃ­.AvilÃ©s@oportunidades.org.sv', '$2y$10$AkHvMg0xKEck85RrarahKOLlrRWPSEwXrHqES/2ae8Ehw7kxV84e.', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(10, '', 'Fatima.Ayala@oportunidades.org.sv', '$2y$10$L3I4fcmrzC8DFMhCLQ11uuzporYNkIQiqiUGwFOoUaorkqC8Pz5xC', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(11, '', 'Steven.Barrera@oportunidades.org.sv', '$2y$10$24bmkUKMpWGB3KgDBQPKn.owiObq2mufnhmCsLyqEux2Pc7qCuvHe', 'imgDefault.png', 0, 'SSFT', 'Estudiante', 'SSFT'),
(12, '', 'daniel.marquez@oportunidades.org.sv', '322476', 'img60417.jpeg', 0, 'SSFT', 'Estudiante', 'SSFT'),
(13, '', 'jose.marquez@oportunidades.org.sv', '$2y$10$vG1nvNQKYUuhVCvuYNfbx.mdkvlzJZ5K4nYD0homRksdGJBBOCtR6', NULL, 0, 'SSFT', 'Estudiante', 'SSFT'),
(15, '', 'joel.castillo@oportunidades.org.sv', '$2y$10$3hfm8sanrtaQF4qT1al40O/iqPUWkW4MfmPIUPwI/bdh0sssDmf3O', 'img27207.jpeg', 1, 'SSFT', 'Estudiante', 'SSFT'),
(16, '', 'mdaniel.o.s@hotmail.com', '$2y$10$HB8SFmodSv4Y6L6yX.dKCeyvCK3v7k7HLE6S3X2XvAFgf6nllMLVW', 'img46176.jpeg', 1, 'SSFT', 'Administrador', 'SSFT'),
(17, '', 'evelin.najera@udb.edu.sv', '$2y$10$teP9xms.EVcgtDigYnqFUurGfY9gC/EGbYZw7OlDVy/NGniim3BRW', 'img34576.jpeg', 1, 'SSFT', 'Administrador', 'SSFT');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID_Alumno`),
  ADD KEY `FK` (`ID_Empresa`,`ID_Status`),
  ADD KEY `FK_Alumno_Estatus` (`ID_Status`),
  ADD KEY `FK_Alumno_Sede_idx` (`ID_Sede`),
  ADD KEY `FK_Alumno_Carrera` (`ID_Carrera`),
  ADD KEY `FK_Alumno_SedeAsistencia` (`SedeAsistencia`);

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`Id_Carrera`),
  ADD KEY `FK_Carreras_Facultades` (`ID_Facultades`);

--
-- Indices de la tabla `ciclos`
--
ALTER TABLE `ciclos`
  ADD PRIMARY KEY (`ID_Ciclo`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD PRIMARY KEY (`IDComptenecia`);

--
-- Indices de la tabla `competenciatalleres`
--
ALTER TABLE `competenciatalleres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CompetenciaTalleres` (`id_taller`),
  ADD KEY `FK_TalleresCompetencia` (`id_competencia`);

--
-- Indices de la tabla `comprabantestatus`
--
ALTER TABLE `comprabantestatus`
  ADD PRIMARY KEY (`ID_SCom`),
  ADD KEY `FK` (`ID_Alumno`,`ID_Ciclo`),
  ADD KEY `FK_Comprobante_Ciclo` (`ID_Ciclo`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`ID_Empresa`);

--
-- Indices de la tabla `evalicionreunion`
--
ALTER TABLE `evalicionreunion`
  ADD KEY `FK_Rating_Alumno` (`id_alumno`),
  ADD KEY `FK_Rating_Reunion` (`id_reunion`);

--
-- Indices de la tabla `evaluaciontalleres`
--
ALTER TABLE `evaluaciontalleres`
  ADD KEY `FK` (`ID_Alumno`,`ID_Taller`),
  ADD KEY `FK_Evaluacion_Taller` (`ID_Taller`);

--
-- Indices de la tabla `facultades`
--
ALTER TABLE `facultades`
  ADD PRIMARY KEY (`IDFacultates`);

--
-- Indices de la tabla `formatotalleres`
--
ALTER TABLE `formatotalleres`
  ADD PRIMARY KEY (`ID_Formato`);

--
-- Indices de la tabla `horariosreunion`
--
ALTER TABLE `horariosreunion`
  ADD PRIMARY KEY (`IDHorRunion`),
  ADD KEY `ID_Reunión` (`ID_Reunion`);

--
-- Indices de la tabla `hsociales`
--
ALTER TABLE `hsociales`
  ADD PRIMARY KEY (`ID_HSociales`),
  ADD KEY `FK` (`ID_Ciclo`,`ID_Alumno`),
  ADD KEY `FK_Horas_Alumno` (`ID_Alumno`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`IDinscripcion`),
  ADD KEY `FKIncripcion_SEDE_idx` (`ID_Sede`);

--
-- Indices de la tabla `inscripcionreunion`
--
ALTER TABLE `inscripcionreunion`
  ADD KEY `FK_Reunion_Alumno` (`id_alumno`),
  ADD KEY `FK_Reunion_Reunion` (`id_reunion`),
  ADD KEY `FK_Horario_Reunion` (`Horario`);

--
-- Indices de la tabla `inscripciontalleres`
--
ALTER TABLE `inscripciontalleres`
  ADD KEY `FK` (`ID_Alumno`,`ID_Taller`),
  ADD KEY `FK_Lista_Taller` (`ID_Taller`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD KEY `FK` (`ID_Alumno`);

--
-- Indices de la tabla `objetivostaller`
--
ALTER TABLE `objetivostaller`
  ADD PRIMARY KEY (`IDobjetivo`),
  ADD KEY `FK_ObjetivosTaller` (`ID_Taller`);

--
-- Indices de la tabla `reuniones`
--
ALTER TABLE `reuniones`
  ADD PRIMARY KEY (`ID_Reunion`),
  ADD KEY `FK` (`ID_Empresa`,`ID_Ciclo`),
  ADD KEY `FK_Reunion_Ciclo` (`ID_Ciclo`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`ID_Sede`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID_Status`);

--
-- Indices de la tabla `talleres`
--
ALTER TABLE `talleres`
  ADD PRIMARY KEY (`ID_Taller`),
  ADD KEY `FK` (`ID_Formato`,`ID_Sede`,`ID_Empresa`),
  ADD KEY `FK_Taller_Sede` (`ID_Sede`),
  ADD KEY `FK_Taller_Empresa` (`ID_Empresa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUsuario`),
  ADD KEY `FK_Usuario_Sede_idx` (`ID_Sede`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `competenciatalleres`
--
ALTER TABLE `competenciatalleres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facultades`
--
ALTER TABLE `facultades`
  MODIFY `IDFacultates` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `horariosreunion`
--
ALTER TABLE `horariosreunion`
  MODIFY `IDHorRunion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `IDinscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `objetivostaller`
--
ALTER TABLE `objetivostaller`
  MODIFY `IDobjetivo` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `FK_Alumno_Carrera` FOREIGN KEY (`ID_Carrera`) REFERENCES `carrera` (`Id_Carrera`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Alumno_Empresa` FOREIGN KEY (`ID_Empresa`) REFERENCES `empresas` (`ID_Empresa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Alumno_Estatus` FOREIGN KEY (`ID_Status`) REFERENCES `status` (`ID_Status`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Alumno_Sede` FOREIGN KEY (`ID_Sede`) REFERENCES `sedes` (`ID_Sede`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Alumno_SedeAsistencia` FOREIGN KEY (`SedeAsistencia`) REFERENCES `sedes` (`ID_Sede`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `FK_Carreras_Facultades` FOREIGN KEY (`ID_Facultades`) REFERENCES `facultades` (`IDFacultates`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `competenciatalleres`
--
ALTER TABLE `competenciatalleres`
  ADD CONSTRAINT `FK_CompetenciaTalleres` FOREIGN KEY (`id_taller`) REFERENCES `talleres` (`ID_Taller`),
  ADD CONSTRAINT `FK_TalleresCompetencia` FOREIGN KEY (`id_competencia`) REFERENCES `competencias` (`IDComptenecia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comprabantestatus`
--
ALTER TABLE `comprabantestatus`
  ADD CONSTRAINT `FK_Comprobante_Alumno` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Comprobante_Ciclo` FOREIGN KEY (`ID_Ciclo`) REFERENCES `ciclos` (`ID_Ciclo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evalicionreunion`
--
ALTER TABLE `evalicionreunion`
  ADD CONSTRAINT `FK_Rating_Alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`ID_Alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Rating_Reunion` FOREIGN KEY (`id_reunion`) REFERENCES `reuniones` (`ID_Reunion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluaciontalleres`
--
ALTER TABLE `evaluaciontalleres`
  ADD CONSTRAINT `FK_Evaluacion_Alumno` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Evaluacion_Taller` FOREIGN KEY (`ID_Taller`) REFERENCES `talleres` (`ID_Taller`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hsociales`
--
ALTER TABLE `hsociales`
  ADD CONSTRAINT `FK_Horas_Alumno` FOREIGN KEY (`ID_Alumno`) REFERENCES `alumnos` (`ID_Alumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Horas_Ciclo` FOREIGN KEY (`ID_Ciclo`) REFERENCES `ciclos` (`ID_Ciclo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscripcionreunion`
--
ALTER TABLE `inscripcionreunion`
  ADD CONSTRAINT `FK_Horario_Reunion` FOREIGN KEY (`Horario`) REFERENCES `horariosreunion` (`IDHorRunion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `objetivostaller`
--
ALTER TABLE `objetivostaller`
  ADD CONSTRAINT `FK_ObjetivosTaller` FOREIGN KEY (`ID_Taller`) REFERENCES `talleres` (`ID_Taller`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
