-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 01:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitalinfantil`
--

-- --------------------------------------------------------

--
-- Table structure for table `documentos`
--

CREATE TABLE `documentos` (
  `idDocumento` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `vinculoDocumento` varchar(500) DEFAULT NULL,
  `fechaSubida` date DEFAULT NULL,
  `horaSubida` time DEFAULT NULL,
  `tipo` varchar(10) DEFAULT NULL,
  `fkPaciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidoPaterno` varchar(50) NOT NULL,
  `apellidoMaterno` varchar(50) NOT NULL,
  `calleDireccion` varchar(50) NOT NULL,
  `numeroDireccion` varchar(50) NOT NULL,
  `coloniaDireccion` varchar(50) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `especialidad` enum('CARDIOLOGIA','PEDIATRIA','NEUROLOGIA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `calleDireccion`, `numeroDireccion`, `coloniaDireccion`, `telefono`, `email`, `especialidad`) VALUES
(1, 'Daniel', 'Villarreal', 'Gallegos', 'valle de suchil', '#309', 'Fraccionamiento Santa Teresa', '6181563424', 'dv956543@gmail.com', 'CARDIOLOGIA');

-- --------------------------------------------------------

--
-- Table structure for table `hojasclinicas`
--

CREATE TABLE `hojasclinicas` (
  `idHojaClinica` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `pc` decimal(5,2) DEFAULT NULL,
  `talla` decimal(5,2) DEFAULT NULL,
  `temperatura` decimal(4,2) DEFAULT NULL,
  `fkIdIngreso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingresos`
--

CREATE TABLE `ingresos` (
  `idIngreso` int(11) NOT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `horaIngreso` time DEFAULT NULL,
  `fechaEgreso` date DEFAULT NULL,
  `horaEgreso` time DEFAULT NULL,
  `egreso` tinyint(1) DEFAULT NULL,
  `motivo` text DEFAULT NULL,
  `servicioSolicita` varchar(50) DEFAULT NULL,
  `fkIdPaciente` int(11) DEFAULT NULL,
  `fkIdUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidoPaterno` varchar(50) DEFAULT NULL,
  `apellidoMaterno` varchar(50) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `pais` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `sexo` enum('MASCULINO','FEMENINO') DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `calleDireccion` varchar(50) NOT NULL,
  `numeroDireccion` varchar(50) NOT NULL,
  `coloniaDireccion` varchar(50) NOT NULL,
  `derechoHabiente` varchar(20) DEFAULT NULL,
  `dx` text NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`idPaciente`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `pais`, `estado`, `municipio`, `sexo`, `edad`, `calleDireccion`, `numeroDireccion`, `coloniaDireccion`, `derechoHabiente`, `dx`, `observaciones`) VALUES
(1, 'bebe', 'lozano', 'lopez', '2023-11-01', 'Mexico', 'Durango', 'Durango', 'MASCULINO', 1, 'valle de suchil', '#309', 'Fraccionamiento Santa Teresa', 'IMSS', 'ASDJKASFKHASKJFJAKSFKJASFKJAFKSJAKJFSKJASFKNASCMSKJACVESFJKVSKJDCSJDKVSD', 'LALSJKJSDÑFWEÑIOFÑWOCEÑIONWCÑIONSÑDJJJKÑASDJAKSDAJFSAAS');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `idTutor` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidoPaterno` varchar(50) DEFAULT NULL,
  `apellidoMaterno` varchar(50) DEFAULT NULL,
  `noPersonasHogar` int(11) DEFAULT NULL,
  `noPersonasApoyanEconomiaHogar` int(11) DEFAULT NULL,
  `totalIngresos` decimal(10,2) DEFAULT NULL,
  `totalEgresos` decimal(10,2) DEFAULT NULL,
  `indiceEconomico` enum('BAJO','MEDIO','ALTO') NOT NULL,
  `trabajoSocial` enum('SIN_APOYO','BAJO_APOYO','MEDIO_APOYO','ALTO_APOYO') NOT NULL,
  `parentesco` enum('PADRE','MADRE','TUTOR_LEGAL') NOT NULL,
  `pais` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `municipio` varchar(50) NOT NULL,
  `calleDireccion` varchar(50) NOT NULL,
  `numeroDireccion` varchar(50) NOT NULL,
  `coloniaDireccion` varchar(50) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `derechoHabiente` varchar(50) DEFAULT NULL,
  `fkIdPaciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`idTutor`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `noPersonasHogar`, `noPersonasApoyanEconomiaHogar`, `totalIngresos`, `totalEgresos`, `indiceEconomico`, `trabajoSocial`, `parentesco`, `pais`, `estado`, `municipio`, `calleDireccion`, `numeroDireccion`, `coloniaDireccion`, `telefono`, `derechoHabiente`, `fkIdPaciente`) VALUES
(1, 'papa', 'gonzales', 'lozano', 4, 2, 10000.00, 5000.00, 'BAJO', 'MEDIO_APOYO', 'PADRE', 'Mexico', 'Durango', 'Durango', 'valle de suchil', '#309', 'Fraccionamiento Santa Teresa', '6181563424', 'IMSS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `rol` enum('ADMIN','DOCTOR','ENFERMERA','TRABAJO_SOCIAL') DEFAULT NULL,
  `fkIdEmpleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contrasena`, `rol`, `fkIdEmpleado`) VALUES
(1, 'trabajosocial', '1234', 'TRABAJO_SOCIAL', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`idDocumento`),
  ADD KEY `fkPaciente` (`fkPaciente`);

--
-- Indexes for table `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indexes for table `hojasclinicas`
--
ALTER TABLE `hojasclinicas`
  ADD PRIMARY KEY (`idHojaClinica`),
  ADD KEY `fkIdIngreso` (`fkIdIngreso`);

--
-- Indexes for table `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`idIngreso`),
  ADD KEY `fkIdPaciente` (`fkIdPaciente`),
  ADD KEY `fkIdUsuario` (`fkIdUsuario`);

--
-- Indexes for table `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idPaciente`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`idTutor`),
  ADD KEY `fkIdPaciente` (`fkIdPaciente`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fkIdEmpleado` (`fkIdEmpleado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documentos`
--
ALTER TABLE `documentos`
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hojasclinicas`
--
ALTER TABLE `hojasclinicas`
  MODIFY `idHojaClinica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `idIngreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `idTutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`fkPaciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hojasclinicas`
--
ALTER TABLE `hojasclinicas`
  ADD CONSTRAINT `hojasclinicas_ibfk_1` FOREIGN KEY (`fkIdIngreso`) REFERENCES `ingresos` (`idIngreso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`fkIdPaciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingresos_ibfk_2` FOREIGN KEY (`fkIdUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_1` FOREIGN KEY (`fkIdPaciente`) REFERENCES `paciente` (`idPaciente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`fkIdEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
