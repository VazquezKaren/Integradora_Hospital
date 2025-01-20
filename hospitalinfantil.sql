-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 07:39 PM
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

--
-- Dumping data for table `documentos`
--

INSERT INTO `documentos` (`idDocumento`, `nombre`, `vinculoDocumento`, `fechaSubida`, `horaSubida`, `tipo`, `fkPaciente`) VALUES
(1, 'Receta asma', 'receta_asma.pdf', '2024-10-01', '08:40:00', 'PDF', 2),
(2, 'Informe alergias', 'informe_alergias.pdf', '2024-10-06', '09:15:00', 'PDF', 3),
(3, 'Resultados de análisis', 'resultados_analisis.pdf', '2024-11-02', '10:25:00', 'PDF', 5),
(4, 'Historial bronquitis', 'historial_bronquitis.pdf', '2024-11-03', '15:55:00', 'PDF', 4);

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
(1, 'Daniel1234', 'Villarreal123', 'Gallegos', 'valle de suchil', '#309', 'Fraccionamiento Santa Teresa', '6181563424', 'dv956543@gmail.com', 'CARDIOLOGIA'),
(2, 'Doctor', 'Perez', 'Monrreal', '5 de febrero', '209', 'zona centro', '6181563424', 'dv956543@gmail.com', 'CARDIOLOGIA'),
(3, 'Admin', 'Perez', 'Monrreal', '5 de febrero', '209', 'zona centro', '6181563424', 'dv956543@gmail.com', 'PEDIATRIA'),
(4, 'Enfermera', 'Perez', 'Monrreal', '5 de febrero', '209', 'zona centro', '6181563424', 'dv956543@gmail.com', 'NEUROLOGIA'),
(5, 'Alonso4', 'Perez', 'Monrreal', '5 de febrero', '209', 'zona centro', '6181563424', 'dv956543@gmail.com', 'CARDIOLOGIA'),
(6, 'Carla', 'Sanchez', 'Lopez', 'Revolución', '#123', 'Centro', '6181234567', 'csanchez@gmail.com', 'PEDIATRIA'),
(7, 'Miguel', 'Torres', 'Martinez', 'Allende', '#456', 'Las Flores', '6187654321', 'mtorres@gmail.com', 'CARDIOLOGIA'),
(8, 'Luisa', 'Fernandez', 'Reyes', 'Av. Principal', '#45', 'Las Lomas', '6181112223', 'lfernandez@gmail.com', 'PEDIATRIA'),
(9, 'Pedro', 'Garcia', 'Martinez', 'Calle Hidalgo', '#78', 'Centro', '6183334445', 'pgarcia@gmail.com', 'NEUROLOGIA'),
(10, 'efsdfsd', 'sfsdfsd', 'sdfsdsdf', 'sfsdfdfs', '34', 'asdasdas', '3342342342', 'asdasdsad', 'CARDIOLOGIA'),
(11, 'efsdfsd', 'sfsdfsd', 'sdfsdsdf', 'sfsdfdfs', '34', 'asdasdas', '3342342342', 'asdasdsad', 'CARDIOLOGIA'),
(14, 'Ricardo', 'Perez', 'Hernandez', 'asdasdasd', '309', 'Santa Teresa', '6181563424', 'dv956543@gmail.com', 'CARDIOLOGIA'),
(17, 'Guillermo', 'Villarreal', 'Gallegos', 'valle de suchil', '309', 'asasdasda', '6181563424', 'dv956543@gmail.com', 'NEUROLOGIA'),
(18, 'Juan', 'Perez', 'Lopez', 'Calle 1', '123', 'Colonia Centro', '5551234567', 'juan.perez@example.com', 'CARDIOLOGIA'),
(19, 'asdasd', 'asdasd', 'asdasda', 'valle de suchil', '309', 'Santa Teresa', '3423422332', 'daniel_3141230009@utd.edu.mx', 'PEDIATRIA'),
(20, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(21, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(22, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(23, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(24, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(25, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(26, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(27, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(28, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(29, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(30, 'sdfsdf', 'adasdas', 'asfasfasf', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'dv956534@gmail.com', 'CARDIOLOGIA'),
(31, 'Sebastian', 'Lozano', 'Reyes', 'asfasfsa', '565', 'adkjasfksaf', '6587878', 'pablo@gmail.com', ''),
(32, 'crtistian', 'asds', 'asdasd', 'msdcblhdc', '2546', 'ASDASD', '6565565', 'Jax12.800@gmail.com', ''),
(33, 'enfermera', 'Perez', 'Lopez', 'kjlfdhsf', '424', 'asdsad', '7457455', 'pablo@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `historial`
--

CREATE TABLE `historial` (
  `idRegistro` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `actividad` varchar(20) NOT NULL,
  `campoModificado` varchar(20) NOT NULL,
  `datoAnterior` varchar(50) DEFAULT NULL,
  `datoNuevo` varchar(50) DEFAULT NULL,
  `usuario` int(11) NOT NULL,
  `hora` time NOT NULL,
  `SQLejecutado` varchar(2000) DEFAULT NULL,
  `SQLdeshacer` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historial`
--

INSERT INTO `historial` (`idRegistro`, `fecha`, `actividad`, `campoModificado`, `datoAnterior`, `datoNuevo`, `usuario`, `hora`, `SQLejecutado`, `SQLdeshacer`) VALUES
(1, '2024-11-29', 'Eliminar Paciente', 'status', NULL, NULL, 3, '08:42:33', 'UPDATE paciente SET status = 1 WHERE idPaciente = 9', 'UPDATE paciente SET status = 0 WHERE idPaciente = 9');

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

--
-- Dumping data for table `hojasclinicas`
--

INSERT INTO `hojasclinicas` (`idHojaClinica`, `fecha`, `hora`, `edad`, `peso`, `pc`, `talla`, `temperatura`, `fkIdIngreso`) VALUES
(1, '2024-10-01', '08:35:00', 9, 30.50, 50.00, 130.00, 37.50, 1),
(2, '2024-10-06', '09:10:00', 6, 22.00, 47.00, 115.00, 38.00, 2),
(3, '2024-11-02', '10:20:00', 10, 45.00, 52.00, 135.00, 36.80, 3),
(4, '2024-11-03', '15:50:00', 7, 32.00, 49.00, 120.00, 37.20, 4);

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
  `turno` enum('MATUTINO','VESPERTINO','NOCTURNO') NOT NULL,
  `fkIdPaciente` int(11) DEFAULT NULL,
  `fkIdUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingresos`
--

INSERT INTO `ingresos` (`idIngreso`, `fechaIngreso`, `horaIngreso`, `fechaEgreso`, `horaEgreso`, `egreso`, `motivo`, `servicioSolicita`, `turno`, `fkIdPaciente`, `fkIdUsuario`) VALUES
(1, '2024-10-01', '08:30:00', '2024-10-05', '10:00:00', 1, 'Consulta por asma recurrente', 'Pediatría', 'MATUTINO', 2, 1),
(2, '2024-10-06', '09:00:00', '2024-10-07', '14:30:00', 1, 'Reacción alérgica severa', 'Urgencias', 'MATUTINO', 3, 2),
(3, '2024-11-02', '10:15:00', '2024-11-05', '09:30:00', 1, 'Complicaciones por diabetes', 'Endocrinología', 'VESPERTINO', 5, 2),
(4, '2024-11-03', '15:45:00', '2024-11-06', '12:20:00', 1, 'Chequeo por bronquitis', 'Pediatría', 'NOCTURNO', 4, 1),
(5, '2024-11-10', '09:30:00', '2024-11-15', '15:00:00', 1, 'Consulta urgente', 'Pediatria', 'VESPERTINO', 1, 1),
(8, '2024-11-02', '09:15:00', '2024-11-27', '03:19:17', 1, 'Control de amigdalitis', 'Otorrinolaringología', 'VESPERTINO', 4, 2),
(9, '2024-11-03', '10:45:00', '2024-11-07', '12:00:00', 1, 'Infección en el oído', 'Pediatría', 'NOCTURNO', 5, 1),
(11, '2024-11-05', '13:00:00', '2024-11-10', '15:30:00', 1, 'Control de diabetes', 'Endocrinología', 'MATUTINO', 7, 2),
(12, '2024-11-01', '08:30:00', '2024-11-03', '16:30:00', 1, 'Consulta por asma', 'Neumología', 'MATUTINO', 3, 1),
(14, '2024-11-03', '10:00:00', '2024-11-27', '04:04:02', 1, 'Control postquirúrgico', 'Pediatría', 'NOCTURNO', 5, 1),
(16, '2024-11-05', '13:30:00', '2024-11-27', '03:52:29', 1, 'Revisión prequirúrgica', 'Cirugía', 'VESPERTINO', 7, 2),
(19, '2024-11-09', '11:00:46', '2024-11-27', '04:47:58', 1, 'dfdfdffgbdbdfbdfbfd', 'asfasfasfasasf', 'VESPERTINO', 15, 9),
(30, '2024-11-20', '09:00:00', '2024-11-27', '03:59:12', 1, 'Control de hipertensión', 'Cardiología', 'NOCTURNO', 8, 2),
(32, '2024-11-23', '15:00:00', '2024-11-29', '16:48:34', 1, 'Revisión de anemia', 'Hematología', 'VESPERTINO', 10, 1),
(33, '2024-11-24', '08:45:00', '2024-11-27', '04:00:52', 1, 'Chequeo médico general', 'Medicina General', 'MATUTINO', 11, 2),
(37, '2024-11-28', '09:30:00', '2024-11-27', '03:31:02', 0, 'Evaluación de crecimiento infantil', 'Pediatría', 'MATUTINO', 15, 1),
(73, '2024-12-22', '08:00:00', '2024-11-29', '07:57:44', 1, 'Control de diabetes', 'Endocrinología', 'MATUTINO', 1, 2),
(74, '2024-12-23', '09:30:00', '2024-12-24', '12:00:00', 1, 'Chequeo postoperatorio', 'Cirugía', 'MATUTINO', 2, 1),
(76, '2024-12-25', '11:30:00', '2024-12-26', '14:00:00', 1, 'Consulta por fatiga crónica', 'Medicina Interna', 'MATUTINO', 4, 2),
(77, '2024-12-26', '12:00:00', NULL, NULL, 0, 'Tratamiento de migrañas', 'Neurología', 'MATUTINO', 5, 1),
(79, '2024-12-28', '14:15:00', '2024-12-30', '18:00:00', 1, 'Tratamiento de amigdalitis', 'Otorrinolaringología', 'MATUTINO', 7, 2),
(80, '2024-12-29', '15:00:00', NULL, NULL, 0, 'Chequeo de piel', 'Dermatología', 'MATUTINO', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paciente`
--

CREATE TABLE `paciente` (
  `idPaciente` int(11) NOT NULL,
  `noRegistro` varchar(10) NOT NULL,
  `curp` varchar(110) NOT NULL,
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
  `observaciones` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paciente`
--

INSERT INTO `paciente` (`idPaciente`, `noRegistro`, `curp`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `pais`, `estado`, `municipio`, `sexo`, `edad`, `calleDireccion`, `numeroDireccion`, `coloniaDireccion`, `derechoHabiente`, `dx`, `observaciones`, `status`) VALUES
(1, '', 'VIGD051206HDGLLNA3', 'ENRIQUE', 'LOZANO', 'LOPEZ', '2023-11-01', 'Mexico', 'DURANGO', 'DURANGO', 'MASCULINO', 1, 'VALLE DE SUCHIL', '#309', 'FRACCIONAMIENTO SANTA TERESA', 'IMSS', 'ASDJKASFKHASKJFJAKSFKJASFKJAFKSJAKJFSKJASFKNASCMSKJACVESFJKVSKJDCSJDKVSD', 'LALSJKJSDÑFWEÑIOFÑWOCEÑIONWCÑIONSÑDJJJKÑASDJAKSDAJFSAAS', 1),
(2, '', '', 'Maria', 'Gonzalez', 'Hernandez', '2015-06-15', 'Mexico', 'Durango', 'Durango', 'FEMENINO', 9, 'Independencia', '#54', 'Centro', 'IMSS', 'Asma infantil', 'Requiere inhaladores periódicos', 1),
(3, '', '', 'Juan', 'Perez', 'Lopez', '2018-03-23', 'Mexico', 'Durango', 'Durango', 'MASCULINO', 6, 'Chapultepec', '#23', 'Las Rosas', 'Seguro Popular', 'Alergia a alimentos', 'Vigilancia de alergias severas', 1),
(4, '', '', 'Sofia', 'Martinez', 'Diaz', '2017-08-10', 'Mexico', 'Durango', 'Durango', 'FEMENINO', 7, 'Av. Reforma', '#210', 'El Valle', 'IMSS', 'Bronquitis recurrente', 'Requiere seguimiento mensual', 0),
(5, '', '', 'Carlos', 'Luna', 'Garcia', '2014-12-22', 'Mexico', 'Durango', 'Durango', 'MASCULINO', 10, 'Paseo de la Paz', '#98', 'Los Pinos', 'Seguro Popular', 'Diabetes tipo 1', 'Necesita control de insulina diario', 0),
(6, '', '', 'saasdasd', 'afasfasf', 'asfasfasf', '2024-11-15', 'Mexico', 'Jalisco', 'Zapopan', 'FEMENINO', 1, 'asfsfasf', '33', 'afasfasfasf', 'IMSS', 'afasfasfasfasf', 'asfasfasfasfasfasf', 0),
(7, '', '', 'Juan', 'Perez', 'Lopez', '2015-06-15', 'Mexico', 'CDMX', 'Benito Juarez', 'MASCULINO', 9, 'Calle 1', '123', 'Colonia A', 'IMSS', 'Fiebre Alta', 'Sin observaciones', 0),
(8, '', '', 'Maria', 'Garcia', 'Hernandez', '2018-11-25', 'Mexico', 'CDMX', 'Coyoacan', 'FEMENINO', 6, 'Calle 2', '456', 'Colonia B', 'ISSSTE', 'Fractura', 'Requiere seguimiento', 0),
(9, '', '', 'Luis', 'Sanchez', 'Martinez', '2012-03-08', 'Mexico', 'EdoMex', 'Toluca', 'MASCULINO', 12, 'Calle 3', '789', 'Colonia C', 'IMSS', 'Asma Crónica', 'Requiere inhalador', 0),
(10, '', '', 'Andrea', 'Lopez', 'Mendez', '2016-07-22', 'Mexico', 'Queretaro', 'San Juan del Rio', 'FEMENINO', 8, 'Calle 4', '101', 'Colonia D', 'Particular', 'Amigdalitis', 'En recuperación', 0),
(11, '', '', 'Jorge', 'Fernandez', 'Ruiz', '2019-09-15', 'Mexico', 'CDMX', 'Miguel Hidalgo', 'MASCULINO', 5, 'Calle 5', '202', 'Colonia E', 'IMSS', 'Otitis Media', 'Sin observaciones', 1),
(12, '', '', 'Camila', 'Gomez', 'Castro', '2020-01-01', 'Mexico', 'Jalisco', 'Guadalajara', 'FEMENINO', 4, 'Calle 6', '303', 'Colonia F', 'ISSSTE', 'Varicela', 'En cuarentena', 1),
(13, '', '', 'Diego', 'Ortega', 'Ramirez', '2013-11-11', 'Mexico', 'Nuevo Leon', 'Monterrey', 'MASCULINO', 11, 'Calle 7', '404', 'Colonia G', 'IMSS', 'Diabetes Infantil', 'En tratamiento', 0),
(14, '', '', 'Luis', 'Sanchez', 'Perez', '2012-03-08', 'Mexico', 'EdoMex', 'Toluca', 'MASCULINO', 12, 'Calle Reforma', '101', 'Colonia Centro', 'IMSS', 'Asma', 'Tratamiento con inhaladores', 0),
(15, '', '', 'Luis', 'Sanchez', 'Martinez', '2012-03-09', 'Mexico', 'EdoMex', 'Toluca', 'MASCULINO', 12, 'Calle Reforma', '102', 'Colonia Centro', 'ISSSTE', 'Asma agudo', 'Control periódico', 0),
(16, '', '', 'Andrea', 'Lopez', 'Gomez', '2016-07-22', 'Mexico', 'Queretaro', 'San Juan del Rio', 'FEMENINO', 8, 'Avenida Juarez', '20', 'Colonia Alameda', 'Particular', 'Amigdalitis', 'Tratamiento en curso', 0),
(17, '', '', 'Andrea', 'Lopez', 'Mendez', '2016-07-22', 'Mexico', 'Queretaro', 'San Juan del Rio', 'FEMENINO', 8, 'Avenida Hidalgo', '21', 'Colonia Alameda', 'IMSS', 'Amigdalitis crónica', 'Sin complicaciones', 0),
(18, '', '', 'Jorge', 'Fernandez', 'Ruiz', '2019-09-15', 'Mexico', 'CDMX', 'Miguel Hidalgo', 'MASCULINO', 5, 'Calle Allende', '15', 'Colonia Roma', 'IMSS', 'Otitis media', 'Se requiere cirugía menor', 0),
(19, '', '', 'saasdasd', 'afasfasf', 'asfasfasf', '2024-11-12', 'Mexico', 'Durango', 'Durango', 'FEMENINO', 1, 'asfsfasf', '33', 'afasfasfasf', 'IMSS', 'rtyhrtsrtywer5yt', 'eryereryeryer', 0),
(20, '', '', 'saasdasd', 'afasfasf', 'asfasfasf', '2024-11-07', 'Mexico', 'Durango', 'Durango', 'FEMENINO', 1, 'asfsfasf', '33', 'afasfasfasf', 'IMSS', 'asfasfasfsaasf', 'asfasfasf', 0),
(21, '', '', 'Luis', 'Gomez', 'Martinez', '2015-04-12', 'México', 'CDMX', 'Miguel Hidalgo', 'MASCULINO', 9, 'Calle 2', '456', 'Colonia Norte', 'IMSS', 'Diagnóstico inicial', 'Sin observaciones', 0);

--
-- Triggers `paciente`
--
DELIMITER $$
CREATE TRIGGER `after_update_paciente_status_delete` AFTER UPDATE ON `paciente` FOR EACH ROW BEGIN
SET @usuario_actual = 3;
        IF OLD.status = 1 AND NEW.status = 0 THEN
        INSERT INTO historial (
            fecha, 
            actividad, 
            campoModificado, 
            datoAnterior, 
            datoNuevo, 
            usuario, 
            hora, 
            SQLejecutado, 
            SQLdeshacer
        ) 
        VALUES (
            NOW(), 
            'Eliminar Paciente', 
            'status', 
            NULL, 
            NULL, 
            @usuario_actual, 
            CURRENT_TIME(), 
            CONCAT('UPDATE paciente SET status = ', OLD.status, ' WHERE idPaciente = ', OLD.idPaciente), 
            CONCAT('UPDATE paciente SET status = ', NEW.status, ' WHERE idPaciente = ', NEW. idPaciente)
        );
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `beforeInsertPaciente` BEFORE INSERT ON `paciente` FOR EACH ROW BEGIN
    DECLARE max_id INT;
    SET max_id = (SELECT IFNULL(MAX(CAST(SUBSTRING_INDEX(noRegistro, '/', 1) AS UNSIGNED)), 0) FROM paciente WHERE noRegistro LIKE CONCAT('%/', YEAR(CURDATE()) % 100));
    SET NEW.noRegistro = LPAD(max_id + 1, 4, '0') + '/' + RIGHT(YEAR(CURDATE()), 2);
END
$$
DELIMITER ;

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
  `ocupacion` varchar(60) NOT NULL,
  `fkIdPaciente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`idTutor`, `nombres`, `apellidoPaterno`, `apellidoMaterno`, `noPersonasHogar`, `noPersonasApoyanEconomiaHogar`, `totalIngresos`, `totalEgresos`, `indiceEconomico`, `trabajoSocial`, `parentesco`, `pais`, `estado`, `municipio`, `calleDireccion`, `numeroDireccion`, `coloniaDireccion`, `telefono`, `ocupacion`, `fkIdPaciente`) VALUES
(1, 'PAPA DE ENRIQUE', 'GONZALES', 'LOZANO', 4, 2, 10000.00, 10000.00, 'BAJO', 'MEDIO_APOYO', 'PADRE', 'MEXICO', 'DURANGO', 'DURANGO', 'VALLE DE SUCHIL', '#309', 'FRACCIONAMIENTO SANTA TERESA', '6181563424', 'MAESTRO', 1),
(2, 'asfasfas', 'asfaasf', 'asasfasf', 3, 2, 2000.00, 2000.00, 'MEDIO', 'SIN_APOYO', 'PADRE', 'Mexico', 'Durango', 'Canatlán', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'Empleado', 6),
(3, 'PAPA DE ENRIQUE', 'GONZALES', 'LOZANO', 4, 2, 10000.00, 10000.00, 'BAJO', 'MEDIO_APOYO', 'PADRE', 'MEXICO', 'DURANGO', 'DURANGO', 'VALLE DE SUCHIL', '#309', 'FRACCIONAMIENTO SANTA TERESA', '6181563424', 'MAESTRO', 1),
(4, 'Ana', 'Garcia', 'Hernandez', 3, 1, 3000.00, 1800.00, 'ALTO', 'BAJO_APOYO', 'MADRE', 'Mexico', 'CDMX', 'Coyoacan', 'Calle 2', '456', 'Colonia B', '5598765432', 'Ingeniera', 2),
(5, 'Miguel', 'Sanchez', 'Martinez', 4, 2, 2500.00, 2000.00, 'BAJO', 'MEDIO_APOYO', 'PADRE', 'Mexico', 'EdoMex', 'Toluca', 'Calle 3', '789', 'Colonia C', '5523456789', 'Chofer', 3),
(6, 'Rosa', 'Lopez', 'Mendez', 3, 1, 3200.00, 2500.00, 'MEDIO', 'BAJO_APOYO', 'MADRE', 'Mexico', 'Queretaro', 'San Juan del Rio', 'Calle 4', '101', 'Colonia D', '5512349876', 'Secretaria', 4),
(7, 'Pablo', 'Fernandez', 'Ruiz', 5, 2, 1800.00, 1500.00, 'BAJO', 'SIN_APOYO', 'PADRE', 'Mexico', 'CDMX', 'Miguel Hidalgo', 'Calle 5', '202', 'Colonia E', '5545678901', 'Empleado', 5),
(8, 'Lucia', 'Gomez', 'Castro', 2, 1, 4000.00, 3000.00, 'ALTO', 'MEDIO_APOYO', 'MADRE', 'Mexico', 'Jalisco', 'Guadalajara', 'Calle 6', '303', 'Colonia F', '5598764321', 'Contadora', 6),
(9, 'Antonio', 'Ortega', 'Ramirez', 6, 3, 4500.00, 3200.00, 'MEDIO', 'ALTO_APOYO', 'PADRE', 'Mexico', 'Nuevo Leon', 'Monterrey', 'Calle 7', '404', 'Colonia G', '5587654321', 'Ingeniero', 7),
(10, 'Miguel', 'Sanchez', 'Perez', 4, 2, 2500.00, 1800.00, 'BAJO', 'MEDIO_APOYO', 'PADRE', 'Mexico', 'EdoMex', 'Toluca', 'Calle Reforma', '101', 'Colonia Centro', '5523412312', 'Chofer', 3),
(11, 'Miguel', 'Sanchez', 'Martinez', 4, 2, 2600.00, 1900.00, 'BAJO', 'BAJO_APOYO', 'PADRE', 'Mexico', 'EdoMex', 'Toluca', 'Calle Reforma', '102', 'Colonia Centro', '5523412313', 'Vendedor', 4),
(12, 'Rosa', 'Lopez', 'Gomez', 3, 1, 3200.00, 2400.00, 'MEDIO', 'BAJO_APOYO', 'MADRE', 'Mexico', 'Queretaro', 'San Juan del Rio', 'Avenida Juarez', '20', 'Colonia Alameda', '5545678910', 'Ama de casa', 5),
(13, 'Rosa', 'Lopez', 'Mendez', 3, 1, 3300.00, 2500.00, 'MEDIO', 'MEDIO_APOYO', 'MADRE', 'Mexico', 'Queretaro', 'San Juan del Rio', 'Avenida Hidalgo', '21', 'Colonia Alameda', '5545678911', 'Secretaria', 6),
(14, 'Pablo', 'Fernandez', 'Ruiz', 5, 2, 1500.00, 1400.00, 'BAJO', 'SIN_APOYO', 'PADRE', 'Mexico', 'CDMX', 'Miguel Hidalgo', 'Calle Allende', '15', 'Colonia Roma', '5545678912', 'Empleado', 7),
(15, 'asfasfas', 'asfaasf', 'asasfasf', 3, 2, 2000.00, 2000.00, 'BAJO', 'SIN_APOYO', 'PADRE', 'Mexico', 'Durango', 'Durango', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'Empleado', 19),
(16, 'asfasfas', 'asfaasf', 'asasfasf', 3, 2, 2000.00, 2000.00, 'BAJO', 'SIN_APOYO', 'PADRE', 'Mexico', 'Durango', 'Durango', 'valle de suchil 309', '309', 'Santa Teresa', '6181563424', 'Empleado', 20),
(17, 'María', 'Lopez', 'Hernandez', 4, 2, 15000.00, 12000.00, 'MEDIO', '', 'MADRE', 'México', 'CDMX', 'Miguel Hidalgo', 'Calle 3', '789', 'Colonia Sur', '5559876543', 'Ama de casa', 21);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL,
  `rol` enum('ADMIN','DOCTOR','ENFERMERA','TRABAJO_SOCIAL') DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `fkIdEmpleado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `contrasena`, `rol`, `status`, `fkIdEmpleado`) VALUES
(1, 'trabajosocial', '$2y$10$F3Sy3zlsCWiz60dIxrdF.e392dByAsO5ysvRCzogFZJroKuZSCt42', 'TRABAJO_SOCIAL', 1, 1),
(2, 'doctor', '$2y$10$F3Sy3zlsCWiz60dIxrdF.e392dByAsO5ysvRCzogFZJroKuZSCt42', 'DOCTOR', 1, 2),
(5, 'ricardo', '$2y$10$DQlq.zazkQW6kHqIk79qw..vKbYM4DIiufGjRszRDWYi284EOhReG', 'DOCTOR', 1, 7),
(8, 'guillermo', '$2y$10$ONaKR2bxgV3vn5OQxN8mdO3BmcoGBcs5hNDGrfXqOR0ilCPYfdRWu', 'ADMIN', 0, 17),
(9, 'adminJuan', '123456', 'ADMIN', 0, 18),
(10, '1234', '$2y$10$KSb11wbhOajl9CFrokHZMendbzCm8gubk/YPcxkKI9FwBMKVG4I8a', '', 0, 19),
(11, 'daniel', '$2y$10$akpPaLHZMP44tArMPQ0F3.8YY2Joiw6nAX.bodzRcVPHExop1YOTi', 'DOCTOR', 0, 20),
(12, 'daniel', '$2y$10$ewBD7UJNa.jh2YJ2j6hFNedd29HVqyPZzPIDJ0tWO/4jjs0FAeIL.', 'DOCTOR', 0, 21),
(13, 'daniel', '$2y$10$wZ6abu5X3Ht9RJLGSM1ZGu.fIY7yYToN1bbedC9MB.jk3jEv7rjVi', 'DOCTOR', 0, 22),
(14, 'daniel', '$2y$10$Xq4cs5UQAL16orARHT5ufe1/XGVrzV7B856Lc/Fx.Nw7Gpyr6zBpG', 'DOCTOR', 0, 23),
(15, 'daniel', '$2y$10$sQBlGSnEQwlXm9rgRsc0cOYeBu8/cz2OztelFMHwL1NzKU4DDPc3S', 'DOCTOR', 0, 24),
(16, 'daniel', '$2y$10$XetEO0eGUvVNolhkfDQYRO/IktifPaWlT3OHjK58rcp6n76jVuGwG', 'DOCTOR', 0, 25),
(17, 'daniel', '$2y$10$8sX6s5HHaEyzd3nabimj8.3Wv3qoaII6vC1c847tjw6vpeJ/jGuBm', 'DOCTOR', 0, 26),
(18, 'daniel', '$2y$10$itH8YKXO1YTx1S3hd4dlm.GElsC7XSCddQ086I0ToAFLPljVrEAvK', 'DOCTOR', 0, 27),
(19, 'daniel', '$2y$10$quPOwahgMrBnAcY5EwPoGeX1GFm8mUnszQJyg46ZaZ5gkuM5eT9qW', 'DOCTOR', 0, 28),
(20, 'daniel', '$2y$10$mBgoZXlyQJEcrf1l8Wk7u.1.s0NlxKnGCpH9KByYLSRRJH8L8PPbS', 'DOCTOR', 0, 29),
(21, 'daniel', '$2y$10$4N3TtR7QMfU2Eq89PVRr9Ox8IIAXMxNzkD/KPkWz3Mkk3Tf/sJZEC', 'DOCTOR', 0, 30),
(22, 'sebastian', '$2y$10$xtHkZ6sLDL9n2ZLCvof7puphv.LEK9fenQJ6kDvnoP5FofMYbjJOm', 'DOCTOR', 0, 31),
(23, 'crispene', '$2y$10$JnUT7K1mA91VgJ.ZHykOj.gq8UAjZLAzvMs/1b3qdiLVyGE7BfBqO', 'ADMIN', 0, 32),
(24, 'admin', '$2y$10$F3Sy3zlsCWiz60dIxrdF.e392dByAsO5ysvRCzogFZJroKuZSCt42', 'ADMIN', 1, 3),
(25, 'enfermera', '$2y$10$LKYsZb2vmWdnBTHVsrHmKeg6s2O7HKm00J6I7jaHH18lAsEfOTwuG', 'ENFERMERA', 0, 33);

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
-- Indexes for table `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`idRegistro`);

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
  MODIFY `idDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `historial`
--
ALTER TABLE `historial`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hojasclinicas`
--
ALTER TABLE `hojasclinicas`
  MODIFY `idHojaClinica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `idIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `idTutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
