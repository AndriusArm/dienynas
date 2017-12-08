-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017 m. Grd 08 d. 18:12
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dienynas2`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `administratorius`
--

CREATE TABLE `administratorius` (
  `id_Vartotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `administratorius`
--

INSERT INTO `administratorius` (`id_Vartotojas`) VALUES
(0),
(1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `atsiskaitymas`
--

CREATE TABLE `atsiskaitymas` (
  `data` date DEFAULT NULL,
  `aprasymas` varchar(255) DEFAULT NULL,
  `tipas` char(20) DEFAULT NULL,
  `id_Atsiskaitymas` int(11) NOT NULL,
  `fk_KlasesPamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `irasas`
--

CREATE TABLE `irasas` (
  `data` date DEFAULT NULL,
  `pamokosTema` varchar(255) DEFAULT NULL,
  `klasesDarbas` varchar(255) DEFAULT NULL,
  `namuDarbai` varchar(255) DEFAULT NULL,
  `id_Irasas` int(11) NOT NULL,
  `fk_KlasesPamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `klase`
--

CREATE TABLE `klase` (
  `klase` varchar(255) DEFAULT NULL,
  `id_Klase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `klase`
--

INSERT INTO `klase` (`klase`, `id_Klase`) VALUES
('9a', 1);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `klasespamoka`
--

CREATE TABLE `klasespamoka` (
  `id_KlasesPamoka` int(11) NOT NULL,
  `fk_Pamoka` int(11) NOT NULL,
  `fk_Klase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `lankomumas`
--

CREATE TABLE `lankomumas` (
  `data` date DEFAULT NULL,
  `arBuvo` tinyint(1) DEFAULT NULL,
  `id_Lankomumas` int(11) NOT NULL,
  `fk_KlasesPamoka` int(11) NOT NULL,
  `fk_Mokinys` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `mokiniotevas`
--

CREATE TABLE `mokiniotevas` (
  `id_Vartotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `mokiniotevas`
--

INSERT INTO `mokiniotevas` (`id_Vartotojas`) VALUES
(4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `mokinys`
--

CREATE TABLE `mokinys` (
  `id_Vartotojas` int(11) NOT NULL,
  `fk_Klase` int(11) NOT NULL,
  `fk_MokinioTevas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `mokinys`
--

INSERT INTO `mokinys` (`id_Vartotojas`, `fk_Klase`, `fk_MokinioTevas`) VALUES
(3, 1, 4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `mokytojas`
--

CREATE TABLE `mokytojas` (
  `id_Vartotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `mokytojas`
--

INSERT INTO `mokytojas` (`id_Vartotojas`) VALUES
(2);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pamoka`
--

CREATE TABLE `pamoka` (
  `pavadinimas` varchar(255) DEFAULT NULL,
  `id_Pamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pamokoslaikas`
--

CREATE TABLE `pamokoslaikas` (
  `laikas` time DEFAULT NULL,
  `kabinetas` varchar(255) DEFAULT NULL,
  `savaitesDiena` char(14) DEFAULT NULL,
  `id_PamokosLaikas` int(11) NOT NULL,
  `fk_KlasesPamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pazymys`
--

CREATE TABLE `pazymys` (
  `verte` int(11) DEFAULT NULL,
  `tipas` char(20) DEFAULT NULL,
  `id_Pazymys` int(11) NOT NULL,
  `fk_Mokinys` int(11) NOT NULL,
  `fk_KlasesPamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `vartotojas`
--

CREATE TABLE `vartotojas` (
  `prisijungimoVardas` varchar(255) DEFAULT NULL,
  `slaptazodis` varchar(255) DEFAULT NULL,
  `vardas` varchar(255) DEFAULT NULL,
  `pavarde` varchar(255) DEFAULT NULL,
  `busena` char(9) DEFAULT NULL,
  `id_Vartotojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `vartotojas`
--

INSERT INTO `vartotojas` (`prisijungimoVardas`, `slaptazodis`, `vardas`, `pavarde`, `busena`, `id_Vartotojas`) VALUES
('admin', 'demo', 'admin', 'admin', 'aktyvus', 0),
('admin', 'demo', 'admin', 'admin', 'aktyvus', 1),
('mokytojas', 'demo', 'Mokytojas', 'Antanas', 'aktyvus', 2),
('mokinys', 'demo', 'Mokinys', 'Juozas', 'aktyvus', 3),
('tevas', 'demo', 'Tevas', 'Jonas', 'aktyvus', 4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `zinute`
--

CREATE TABLE `zinute` (
  `tema` varchar(255) DEFAULT NULL,
  `tekstas` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_Zinute` int(11) NOT NULL,
  `fk_Siuntejas` int(11) NOT NULL,
  `fk_Gavejas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administratorius`
--
ALTER TABLE `administratorius`
  ADD PRIMARY KEY (`id_Vartotojas`);

--
-- Indexes for table `atsiskaitymas`
--
ALTER TABLE `atsiskaitymas`
  ADD PRIMARY KEY (`id_Atsiskaitymas`),
  ADD KEY `fk_KlasesPamoka` (`fk_KlasesPamoka`);

--
-- Indexes for table `irasas`
--
ALTER TABLE `irasas`
  ADD PRIMARY KEY (`id_Irasas`),
  ADD KEY `fk_KlasesPamoka` (`fk_KlasesPamoka`);

--
-- Indexes for table `klase`
--
ALTER TABLE `klase`
  ADD PRIMARY KEY (`id_Klase`);

--
-- Indexes for table `klasespamoka`
--
ALTER TABLE `klasespamoka`
  ADD PRIMARY KEY (`id_KlasesPamoka`),
  ADD KEY `fk_Pamoka` (`fk_Pamoka`),
  ADD KEY `fk_Klase` (`fk_Klase`);

--
-- Indexes for table `lankomumas`
--
ALTER TABLE `lankomumas`
  ADD PRIMARY KEY (`id_Lankomumas`),
  ADD KEY `fk_KlasesPamoka` (`fk_KlasesPamoka`),
  ADD KEY `fk_Mokinys` (`fk_Mokinys`);

--
-- Indexes for table `mokiniotevas`
--
ALTER TABLE `mokiniotevas`
  ADD PRIMARY KEY (`id_Vartotojas`);

--
-- Indexes for table `mokinys`
--
ALTER TABLE `mokinys`
  ADD PRIMARY KEY (`id_Vartotojas`),
  ADD KEY `priklauso` (`fk_Klase`),
  ADD KEY `fk_MokinioTevas` (`fk_MokinioTevas`);

--
-- Indexes for table `mokytojas`
--
ALTER TABLE `mokytojas`
  ADD PRIMARY KEY (`id_Vartotojas`);

--
-- Indexes for table `pamoka`
--
ALTER TABLE `pamoka`
  ADD PRIMARY KEY (`id_Pamoka`);

--
-- Indexes for table `pamokoslaikas`
--
ALTER TABLE `pamokoslaikas`
  ADD PRIMARY KEY (`id_PamokosLaikas`),
  ADD KEY `fk_KlasesPamoka` (`fk_KlasesPamoka`);

--
-- Indexes for table `pazymys`
--
ALTER TABLE `pazymys`
  ADD PRIMARY KEY (`id_Pazymys`),
  ADD KEY `fk_Mokinys` (`fk_Mokinys`),
  ADD KEY `fk_KlasesPamoka` (`fk_KlasesPamoka`);

--
-- Indexes for table `vartotojas`
--
ALTER TABLE `vartotojas`
  ADD PRIMARY KEY (`id_Vartotojas`);

--
-- Indexes for table `zinute`
--
ALTER TABLE `zinute`
  ADD PRIMARY KEY (`id_Zinute`),
  ADD KEY `fk_Siuntejas` (`fk_Siuntejas`),
  ADD KEY `fk_Gavejas` (`fk_Gavejas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atsiskaitymas`
--
ALTER TABLE `atsiskaitymas`
  MODIFY `id_Atsiskaitymas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `irasas`
--
ALTER TABLE `irasas`
  MODIFY `id_Irasas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pazymys`
--
ALTER TABLE `pazymys`
  MODIFY `id_Pazymys` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zinute`
--
ALTER TABLE `zinute`
  MODIFY `id_Zinute` int(11) NOT NULL AUTO_INCREMENT;

--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `administratorius`
--
ALTER TABLE `administratorius`
  ADD CONSTRAINT `administratorius_ibfk_1` FOREIGN KEY (`id_Vartotojas`) REFERENCES `vartotojas` (`id_Vartotojas`);

--
-- Apribojimai lentelei `atsiskaitymas`
--
ALTER TABLE `atsiskaitymas`
  ADD CONSTRAINT `atsiskaitymas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_KlasesPamoka`);

--
-- Apribojimai lentelei `irasas`
--
ALTER TABLE `irasas`
  ADD CONSTRAINT `irasas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_KlasesPamoka`);

--
-- Apribojimai lentelei `klasespamoka`
--
ALTER TABLE `klasespamoka`
  ADD CONSTRAINT `klasespamoka_ibfk_1` FOREIGN KEY (`fk_Pamoka`) REFERENCES `pamoka` (`id_Pamoka`),
  ADD CONSTRAINT `klasespamoka_ibfk_2` FOREIGN KEY (`fk_Klase`) REFERENCES `klase` (`id_Klase`);

--
-- Apribojimai lentelei `lankomumas`
--
ALTER TABLE `lankomumas`
  ADD CONSTRAINT `lankomumas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_KlasesPamoka`),
  ADD CONSTRAINT `lankomumas_ibfk_2` FOREIGN KEY (`fk_Mokinys`) REFERENCES `mokinys` (`id_Vartotojas`);

--
-- Apribojimai lentelei `mokiniotevas`
--
ALTER TABLE `mokiniotevas`
  ADD CONSTRAINT `mokiniotevas_ibfk_1` FOREIGN KEY (`id_Vartotojas`) REFERENCES `vartotojas` (`id_Vartotojas`);

--
-- Apribojimai lentelei `mokinys`
--
ALTER TABLE `mokinys`
  ADD CONSTRAINT `mokinys_ibfk_1` FOREIGN KEY (`fk_MokinioTevas`) REFERENCES `mokiniotevas` (`id_Vartotojas`),
  ADD CONSTRAINT `mokinys_ibfk_2` FOREIGN KEY (`id_Vartotojas`) REFERENCES `vartotojas` (`id_Vartotojas`),
  ADD CONSTRAINT `priklauso` FOREIGN KEY (`fk_Klase`) REFERENCES `klase` (`id_Klase`);

--
-- Apribojimai lentelei `mokytojas`
--
ALTER TABLE `mokytojas`
  ADD CONSTRAINT `mokytojas_ibfk_1` FOREIGN KEY (`id_Vartotojas`) REFERENCES `vartotojas` (`id_Vartotojas`);

--
-- Apribojimai lentelei `pamokoslaikas`
--
ALTER TABLE `pamokoslaikas`
  ADD CONSTRAINT `pamokoslaikas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_KlasesPamoka`);

--
-- Apribojimai lentelei `pazymys`
--
ALTER TABLE `pazymys`
  ADD CONSTRAINT `pazymys_ibfk_1` FOREIGN KEY (`fk_Mokinys`) REFERENCES `mokinys` (`id_Vartotojas`),
  ADD CONSTRAINT `pazymys_ibfk_2` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_KlasesPamoka`);

--
-- Apribojimai lentelei `zinute`
--
ALTER TABLE `zinute`
  ADD CONSTRAINT `zinute_ibfk_1` FOREIGN KEY (`fk_Siuntejas`) REFERENCES `vartotojas` (`id_Vartotojas`),
  ADD CONSTRAINT `zinute_ibfk_2` FOREIGN KEY (`fk_Gavejas`) REFERENCES `vartotojas` (`id_Vartotojas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
