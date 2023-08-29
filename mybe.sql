-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2023 at 10:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mybe`
--

-- --------------------------------------------------------

--
-- Table structure for table `annee`
--

CREATE TABLE `annee` (
  `id_annee` int(11) NOT NULL,
  `annee` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `annee`
--

INSERT INTO `annee` (`id_annee`, `annee`) VALUES
(9, '2000'),
(13, '2007'),
(12, '2008'),
(8, '2011'),
(1, '2020');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `nom_class` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id_class`, `nom_class`) VALUES
(1, 'A'),
(2, 'B'),
(6, 'class1'),
(7, 'DD1'),
(8, 'DD2'),
(3, 'pc');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id_document` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `date_creation` date NOT NULL,
  `type_document` varchar(255) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `imageName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id_document`, `titre`, `date_creation`, `type_document`, `id_etudiant`, `file_path`, `imageName`) VALUES
(3, 'titre6', '2023-04-17', 'pdf', 3, '../uploads/2023-03-13_2023-03-08_2023-03-04_8bb05fb8-30e3-4041-bd97-134beb300a51 (3) (2).jpg', '2023-03-13_2023-03-08_2023-03-04_8bb05fb8-30e3-4041-bd97-134beb300a51 (3) (2).jpg'),
(7, 'titre6', '2023-04-18', 'pdf', 7, NULL, ''),
(8, 'titre6', '2023-04-18', 'pdf', 8, NULL, ''),
(9, 'titre6', '2023-04-18', 'pdf', 9, '../uploads/BDF.pdf', 'BDF.pdf'),
(17, 'titre6', '2023-04-20', 'pdf', 17, NULL, ''),
(20, 'titre6', '2023-05-01', 'pdf', 20, NULL, ''),
(21, 'attistation', '2023-05-22', 'pdf', 21, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `document_annee`
--

CREATE TABLE `document_annee` (
  `id_document` int(11) NOT NULL,
  `id_annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_annee`
--

INSERT INTO `document_annee` (`id_document`, `id_annee`) VALUES
(3, 1),
(7, 8),
(8, 1),
(9, 1),
(17, 12),
(20, 9),
(21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `document_class`
--

CREATE TABLE `document_class` (
  `id_document` int(11) NOT NULL,
  `id_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_class`
--

INSERT INTO `document_class` (`id_document`, `id_class`) VALUES
(3, 1),
(7, 7),
(8, 8),
(9, 8),
(17, 8),
(20, 1),
(21, 6);

-- --------------------------------------------------------

--
-- Table structure for table `document_filiere`
--

CREATE TABLE `document_filiere` (
  `id_document` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_filiere`
--

INSERT INTO `document_filiere` (`id_document`, `id_filiere`) VALUES
(3, 10),
(7, 2),
(8, 1),
(9, 1),
(17, 7),
(20, 10),
(21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

CREATE TABLE `etudiants` (
  `id_etudiant` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`id_etudiant`, `nom`, `email`, `telephone`, `adresse`) VALUES
(0, '<br /><b>Warning</b>:  Undefined variable $etudiant in <b>C:\\xasever\\htdocs\\tp\\src\\edit.php</b> on line <b>224</b><br /><br /><b>Warning</b>:  Trying to access array offset on value of type null in <b>C:\\xasever\\htdocs\\tp\\src\\edit.php</b> on line <b>224</', '<br /><b>Warning</b>:  Undefined variable $etudiant in <b>C:\\xasever\\htdocs\\tp\\src\\edit.php</b> on line <b>227</b><br /><br /><b>Warning</b>:  Trying to access array offset on value of type null in <b>C:\\xasever\\htdocs\\tp\\src\\edit.php</b> on line <b>227</', '<br /><b>Warning</b>:  Undefined variable $etudiant in <b>C:\\xasever\\htdocs\\tp\\src\\edit.php</b> on line <b>229</b><br /><br /><b>Warning</b>:  Trying to access array offset on value of type null in <b>C:\\xasever\\htdocs\\tp\\src\\edit.php</b> on line <b>229</', NULL),
(3, 'nlkj', 'kkkkk@gmail.com', '0928328983', 'sksapodi9343'),
(7, 'rrr', 'rrrr@gmail.com', '0928328983', 'sksapodi9343'),
(8, 'dfs', 'fdsf@gmail.com', '0928328983', 'sksapodi9343'),
(9, 'dfsfdssd', 'fdssdfsf@gmail.com', '0928328983', 'sksapodi9343'),
(17, 'weq', 'wqe@gmail.com', '0928328983', 'sksapodi9343try'),
(20, 'amine', 'aminek@gmail.com', '0928328983', 'sksapodi9343'),
(21, 'soulaimane', 'soulaimaabek@gmail.com', '0928328983', 'sksapodi9343');

-- --------------------------------------------------------

--
-- Table structure for table `etudiants_annee`
--

CREATE TABLE `etudiants_annee` (
  `id_etudiant` int(11) NOT NULL,
  `id_annee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiants_annee`
--

INSERT INTO `etudiants_annee` (`id_etudiant`, `id_annee`) VALUES
(3, 1),
(7, 8),
(8, 1),
(9, 1),
(17, 12),
(20, 9),
(21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `etudiants_class`
--

CREATE TABLE `etudiants_class` (
  `id_etudiant` int(11) NOT NULL,
  `id_class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiants_class`
--

INSERT INTO `etudiants_class` (`id_etudiant`, `id_class`) VALUES
(3, 1),
(7, 7),
(8, 8),
(9, 8),
(17, 8),
(20, 1),
(21, 6);

-- --------------------------------------------------------

--
-- Table structure for table `etudiants_filiere`
--

CREATE TABLE `etudiants_filiere` (
  `id_etudiant` int(11) NOT NULL,
  `id_filiere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etudiants_filiere`
--

INSERT INTO `etudiants_filiere` (`id_etudiant`, `id_filiere`) VALUES
(3, 10),
(7, 2),
(8, 1),
(9, 1),
(17, 7),
(20, 10),
(21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id_filiere` int(11) NOT NULL,
  `nom_filiere` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id_filiere`, `nom_filiere`) VALUES
(10, 'as'),
(12, 'auto'),
(1, 'Computer Science'),
(6, 'dev'),
(11, 'eco'),
(7, 'GC'),
(9, 'GE'),
(8, 'GI'),
(2, 'Mathematics'),
(3, 'pci');

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
  `id_operation` int(11) NOT NULL,
  `type_operation` varchar(255) NOT NULL,
  `id_document` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type_utilisateur` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `mot_de_passe`, `type_utilisateur`) VALUES
(0, 'hhhh', 'hhhhh', 'admin'),
(1, 'admin', 'admin', 'admin'),
(2, 'user', '123456', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`id_annee`),
  ADD UNIQUE KEY `annee` (`annee`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`),
  ADD UNIQUE KEY `nom_class` (`nom_class`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_document`),
  ADD KEY `id_etudiant` (`id_etudiant`);

--
-- Indexes for table `document_annee`
--
ALTER TABLE `document_annee`
  ADD PRIMARY KEY (`id_document`,`id_annee`),
  ADD KEY `id_annee` (`id_annee`);

--
-- Indexes for table `document_class`
--
ALTER TABLE `document_class`
  ADD PRIMARY KEY (`id_document`,`id_class`),
  ADD KEY `id_class` (`id_class`);

--
-- Indexes for table `document_filiere`
--
ALTER TABLE `document_filiere`
  ADD PRIMARY KEY (`id_document`,`id_filiere`),
  ADD KEY `id_filiere` (`id_filiere`);

--
-- Indexes for table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id_etudiant`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `etudiants_annee`
--
ALTER TABLE `etudiants_annee`
  ADD PRIMARY KEY (`id_etudiant`,`id_annee`),
  ADD KEY `id_annee` (`id_annee`);

--
-- Indexes for table `etudiants_class`
--
ALTER TABLE `etudiants_class`
  ADD PRIMARY KEY (`id_etudiant`,`id_class`),
  ADD KEY `id_class` (`id_class`);

--
-- Indexes for table `etudiants_filiere`
--
ALTER TABLE `etudiants_filiere`
  ADD PRIMARY KEY (`id_etudiant`,`id_filiere`),
  ADD KEY `id_filiere` (`id_filiere`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id_filiere`),
  ADD UNIQUE KEY `nom_filiere` (`nom_filiere`);

--
-- Indexes for table `operation`
--
ALTER TABLE `operation`
  ADD PRIMARY KEY (`id_operation`),
  ADD KEY `id_document` (`id_document`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`);

--
-- Constraints for table `document_annee`
--
ALTER TABLE `document_annee`
  ADD CONSTRAINT `document_annee_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`),
  ADD CONSTRAINT `document_annee_ibfk_2` FOREIGN KEY (`id_annee`) REFERENCES `annee` (`id_annee`);

--
-- Constraints for table `document_class`
--
ALTER TABLE `document_class`
  ADD CONSTRAINT `document_class_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`),
  ADD CONSTRAINT `document_class_ibfk_2` FOREIGN KEY (`id_class`) REFERENCES `class` (`id_class`);

--
-- Constraints for table `document_filiere`
--
ALTER TABLE `document_filiere`
  ADD CONSTRAINT `document_filiere_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`),
  ADD CONSTRAINT `document_filiere_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);

--
-- Constraints for table `etudiants_annee`
--
ALTER TABLE `etudiants_annee`
  ADD CONSTRAINT `etudiants_annee_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`),
  ADD CONSTRAINT `etudiants_annee_ibfk_2` FOREIGN KEY (`id_annee`) REFERENCES `annee` (`id_annee`);

--
-- Constraints for table `etudiants_class`
--
ALTER TABLE `etudiants_class`
  ADD CONSTRAINT `etudiants_class_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`),
  ADD CONSTRAINT `etudiants_class_ibfk_2` FOREIGN KEY (`id_class`) REFERENCES `class` (`id_class`);

--
-- Constraints for table `etudiants_filiere`
--
ALTER TABLE `etudiants_filiere`
  ADD CONSTRAINT `etudiants_filiere_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiants` (`id_etudiant`),
  ADD CONSTRAINT `etudiants_filiere_ibfk_2` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id_filiere`);

--
-- Constraints for table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `operation_ibfk_1` FOREIGN KEY (`id_document`) REFERENCES `document` (`id_document`),
  ADD CONSTRAINT `operation_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
