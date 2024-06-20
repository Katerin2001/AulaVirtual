-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 03, 2023 at 12:16 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plataforma_virtual`
--

-- --------------------------------------------------------

--
-- Table structure for table `actividad`
--

CREATE TABLE `actividad` (
  `ID_Actividad` bigint NOT NULL,
  `ID_Curso` bigint DEFAULT NULL,
  `ID_Asignatura` bigint DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(300) DEFAULT NULL,
  `Documento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Finaliza` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `actividad`
--

INSERT INTO `actividad` (`ID_Actividad`, `ID_Curso`, `ID_Asignatura`, `Nombre`, `Descripcion`, `Documento`, `Finaliza`) VALUES
(6, 36, 19, 'Lección Primer Parcial', 'Bienvenidos, porfavor no copiar. Y mantenerse integro al material ofrecido durante la clase.\r\nGracias.', 'SOFTWARE.pdf', '2023-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `asignatura`
--

CREATE TABLE `asignatura` (
  `ID_Asignatura` bigint NOT NULL,
  `ID_Docente` bigint DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `asignatura`
--

INSERT INTO `asignatura` (`ID_Asignatura`, `ID_Docente`, `Nombre`) VALUES
(19, 3, 'Matemáticas'),
(22, 3, 'Comunicación Visual'),
(23, 3, 'Estudios Sociales'),
(24, 3, 'Ciencias Naturales'),
(25, 3, 'Desarrollo Web'),
(26, 3, 'Educación Física');

-- --------------------------------------------------------

--
-- Table structure for table `curso`
--

CREATE TABLE `curso` (
  `ID_Curso` bigint NOT NULL,
  `ID_Asignatura` bigint DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `curso`
--

INSERT INTO `curso` (`ID_Curso`, `ID_Asignatura`, `Nombre`) VALUES
(36, 19, 'A'),
(38, 19, 'B'),
(40, 23, 'A'),
(41, 26, 'A'),
(52, 24, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `estudiante-asignatura`
--

CREATE TABLE `estudiante-asignatura` (
  `ID` bigint NOT NULL,
  `ID_Curso` bigint DEFAULT NULL,
  `ID_Asignatura` bigint DEFAULT NULL,
  `ID_Estudiante` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estudiante-asignatura`
--

INSERT INTO `estudiante-asignatura` (`ID`, `ID_Curso`, `ID_Asignatura`, `ID_Estudiante`) VALUES
(24, 36, 19, 2),
(28, 38, 19, 16),
(29, 36, 19, 16),
(30, 38, 19, 24),
(32, 36, 19, 24),
(38, 38, 19, 28);

-- --------------------------------------------------------

--
-- Table structure for table `persona`
--

CREATE TABLE `persona` (
  `ID_Persona` bigint NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellidos` varchar(100) DEFAULT NULL,
  `Direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `persona`
--

INSERT INTO `persona` (`ID_Persona`, `Nombre`, `Apellidos`, `Direccion`) VALUES
(1, 'John Andres', 'Palacios Tutiven', 'Sauces 3 Mz 121 v30'),
(2, 'Ana Elena', 'Santamaria Rios', 'Ambato'),
(3, 'Katerin Rocio', 'Cecen Rios', 'Ambato Tungurahua'),
(4, 'Manuel Alejandro', 'Rodriguez Loor', 'Tungurahua Ambato'),
(26, 'John Andrés', 'Palacios Tutiven', 'Sauces 3'),
(27, '7765 Berge Branch', 'Consequatur ipsum alias quia modi sint saepe officia.', 'Praesentium omnis veritatis assumenda omnis assumenda quae et minima.'),
(28, '642 Dora Lakes', 'Dicta voluptatibus omnis similique inventore quia officiis sit alias nam.', 'Amet sed quis saepe.'),
(29, '258 Jadon Green', 'Est dignissimos sint eligendi voluptatem et cum soluta.', 'In non ipsum illum voluptatem nam culpa dolorem.'),
(30, '82862 Bednar Station', 'Dolores ut veritatis sed hic mollitia adipisci eveniet ut.', 'Optio est aut odio assumenda neque dolores.'),
(31, '3699 Emard Summit', 'Sed porro aperiam laborum autem facere cum error et.', 'Sit harum maxime rerum enim molestias eos aliquid at corporis.'),
(32, '42032 Thompson Points', 'Aliquam non asperiores eius ex commodi eos repellendus a corrupti.', 'Earum ipsam vel nostrum tempore.'),
(33, 'Jaylan Bauch', 'Iste eaque', 'Voluptates et vitae'),
(34, 'Darian Hartmann', 'Doloremque', 'Qui accusamus blanditiis '),
(35, 'Vel ut laborum Pari', 'Quaerat reiciendis n', 'Earum cumque totam v'),
(36, 'Id officia molestia', 'Excepturi ratione ex', 'Incidunt ad consequ'),
(37, 'Rem perferendis dolo', 'Proident ut debitis', 'Autem omnis sed accu'),
(38, 'Ipsa eaque commodi ', 'Nihil est earum cum ', 'Ex est praesentium d'),
(39, 'Velit ab quis rem qu', 'Error non vero digni', 'Ab reprehenderit odi'),
(40, 'Omnis impedit quasi', 'Error elit inventor', 'Ad velit aut rerum v');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `ID_Rol` bigint NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`ID_Rol`, `Nombre`) VALUES
(1, 'Admin'),
(2, 'Estudiante'),
(3, 'Docente'),
(4, 'Invitado');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `ID_Usuario` bigint NOT NULL,
  `ID_Persona` bigint DEFAULT NULL,
  `ID_Rol` bigint DEFAULT NULL,
  `Usuario` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `ID_Persona`, `ID_Rol`, `Usuario`, `Email`) VALUES
(1, 1, 1, 'JohnSmith20', 'johnpalacios.t@uta.edu.ec'),
(2, 2, 2, 'AnaElena10', 'anaelena10@uta.edu.ec'),
(3, 3, 3, 'KaterinCecen22', 'katerincecen25@uta.edu.ec'),
(4, 4, 4, 'ManuelAlejandro30', 'manuelalejandro30@uta.edu.ec'),
(16, 26, 2, 'JohnPalacios40', 'john.palaciost@gmail.com'),
(23, 33, 2, 'Jaylan20', 'akedata69135@gmail.com'),
(24, 34, 2, 'Darian50', 'yourdata35534@gmail.com'),
(25, 35, 2, 'Voluptas aliquip vel', 'bywi@mailinator.com'),
(26, 36, 2, 'Ut ab exercitationem', 'kiha@mailinator.com'),
(27, 37, 3, 'Laudantium dolorem ', 'lawivito@mailinator.com'),
(28, 38, 2, 'Duis mollit laudanti', 'judocome@mailinator.com'),
(29, 39, 2, 'Perferendis eius sol', 'hovyc@mailinator.com'),
(30, 40, 1, 'Accusamus fugiat so', 'carek@mailinator.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actividad`
--
ALTER TABLE `actividad`
  ADD PRIMARY KEY (`ID_Actividad`);

--
-- Indexes for table `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`ID_Asignatura`),
  ADD KEY `ID_Docente` (`ID_Docente`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`ID_Curso`);

--
-- Indexes for table `estudiante-asignatura`
--
ALTER TABLE `estudiante-asignatura`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID_Persona`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Usuario` (`Usuario`),
  ADD KEY `ID_Rol` (`ID_Rol`),
  ADD KEY `ID_Persona` (`ID_Persona`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actividad`
--
ALTER TABLE `actividad`
  MODIFY `ID_Actividad` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `ID_Asignatura` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `ID_Curso` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `estudiante-asignatura`
--
ALTER TABLE `estudiante-asignatura`
  MODIFY `ID` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `persona`
--
ALTER TABLE `persona`
  MODIFY `ID_Persona` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `ID_Rol` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_Usuario` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`ID_Docente`) REFERENCES `usuario` (`ID_Usuario`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `rol` (`ID_Rol`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`ID_Persona`) REFERENCES `persona` (`ID_Persona`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
