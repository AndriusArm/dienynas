-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017 m. Grd 12 d. 20:01
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Dumping data for table `irasas`
--

INSERT INTO `irasas` (`data`, `pamokosTema`, `klasesDarbas`, `namuDarbai`, `id_Irasas`, `fk_KlasesPamoka`) VALUES
('2017-12-11', 'A. Baranauskas', 'Buvo rašomas rašinėlis (500) žodžių apie A. Baranauską.', 'Perskaityti "Anykščių šilelį" sekančiai pamokai.', 1, 1),
('2017-12-11', 'test', 'test', 'wat', 3, 9),
('2017-12-13', 'testas', '', '', 11, 1),
('2017-12-15', 'check', 'tjis', '', 12, 1),
('2017-12-14', 'in', 'ser', 'tas', 13, 1);
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
('9a', 1),
('5a', 2),
('5b', 3),
('5c', 4),
('6d', 5),
('6a', 6),
('6b', 7),
('6c', 8),
('7a', 9),
('7b', 10),
('8a', 11);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `klasespamoka`
--

CREATE TABLE `klasespamoka` (
  `id_Klasespamoka` int(11) NOT NULL,
  `fk_Pamoka` int(11) NOT NULL,
  `fk_Klase` int(11) NOT NULL,
  `fk_Mokytojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `klasespamoka`
--

INSERT INTO `klasespamoka` (`id_Klasespamoka`, `fk_Pamoka`, `fk_Klase`, `fk_Mokytojas`) VALUES
(1, 1, 1, 2),
(2, 4, 1, 7),
(3, 8, 1, 6),
(4, 2, 1, 8),
(5, 5, 1, 9),
(6, 6, 1, 10),
(7, 10, 1, 8),
(9, 3, 1, 2),
(10, 1, 1, 10);

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


--
-- Dumping data for table `lankomumas`
--

INSERT INTO `lankomumas` (`data`, `arBuvo`, `id_Lankomumas`, `fk_KlasesPamoka`, `fk_Mokinys`) VALUES
('2017-12-11', 0, 77, 1, 3);
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
(3, 1, 4),
(14, 2, 13),
(15, 2, 12),
(16, 1, 11),
(18, 2, 17),
(20, 2, 19);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pamoka`
--

CREATE TABLE `pamoka` (
  `pavadinimas` varchar(255) DEFAULT NULL,
  `id_Pamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `pamoka`
--

INSERT INTO `pamoka` (`pavadinimas`, `id_Pamoka`) VALUES
('Lietuvių kalba', 1),
('Matematika', 2),
('Fizika', 3),
('Anglų kalba', 4),
('Kūno kultūra', 5),
('Chemija', 6),
('Biologija', 7),
('Rusų kalba', 8),
('Vokiečių kalba', 9),
('Geografija', 10),
('Istorija', 11),
('Ekonomika', 12);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pamokoslaikas`
--

CREATE TABLE `pamokoslaikas` (
  `laikas` time DEFAULT NULL,
  `kabinetas` varchar(255) DEFAULT NULL,
  `savaitesDiena` char(14) DEFAULT NULL,
  `id_Pamokoslaikas` int(11) NOT NULL,
  `fk_KlasesPamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `pamokoslaikas`
--

INSERT INTO `pamokoslaikas` (`laikas`, `kabinetas`, `savaitesDiena`, `id_Pamokoslaikas`, `fk_KlasesPamoka`) VALUES
('08:00:00', '212', 'Pirmadienis', 1, 1),
('09:00:00', '212', 'Pirmadienis', 2, 3),
('10:00:00', '212', 'Pirmadienis', 3, 4),
('11:00:00', '212', 'Pirmadienis', 4, 5),
('13:00:00', '212', 'Pirmadienis', 6, 9),
('14:00:00', '212', 'Pirmadienis', 7, 1),
('15:00:00', '212', 'Pirmadienis', 8, 3),
('09:00:00', '320', 'Antradienis', 10, 3),
('10:00:00', '320', 'Antradienis', 11, 6),
('11:00:00', '320', 'Antradienis', 12, 2),
('12:00:00', '320', 'Antradienis', 13, 10),
('08:00:00', '320', 'Antradienis', 14, 7),
('08:00:00', '311', 'Trečiadienis', 15, 7),
('09:00:00', '311', 'Trečiadienis', 16, 1),
('10:00:00', '311', 'Trečiadienis', 17, 2),
('11:00:00', '311', 'Trečiadienis', 18, 3),
('12:00:00', '311', 'Trečiadienis', 19, 4),
('13:00:00', '311', 'Trečiadienis', 20, 6),
('08:00:00', '300', 'Ketvirtadienis', 21, 1),
('09:00:00', '300', 'Ketvirtadienis', 22, 2),
('10:00:00', '300', 'Ketvirtadienis', 23, 10),
('11:00:00', '300', 'Ketvirtadienis', 24, 7),
('12:00:00', '300', 'Ketvirtadienis', 25, 6),
('13:00:00', '300', 'Ketvirtadienis', 26, 3),
('08:00:00', '412', 'Penktadienis', 27, 1),
('09:00:00', '412', 'Penktadienis', 28, 2),
('10:00:00', '412', 'Penktadienis', 29, 3),
('11:00:00', '412', 'Penktadienis', 30, 10);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pazymys`
--

CREATE TABLE `pazymys` (
  `verte` int(11) DEFAULT NULL,
  `tipas` char(20) DEFAULT NULL,
  `id_Pazymys` int(11) NOT NULL,
  `fk_Mokinys` int(11) NOT NULL,
  `fk_KlasesPamoka` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pazymys`
--

INSERT INTO `pazymys` (`verte`, `tipas`, `id_Pazymys`, `fk_Mokinys`, `fk_KlasesPamoka`, `data`) VALUES
(NULL, NULL, 1, 3, 3, '2017-12-07'),
(7, '1', 2, 3, 1, '2017-12-08'),
(7, '', 3, 3, 2, '2017-12-07'),
(6, '', 10, 10, 1, '2017-12-09'),
(NULL, '', 11, 3, 1, '2017-12-09'),
(NULL, '', 12, 3, 1, '2017-12-10');
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
  `id_Vartotojas` int(11) NOT NULL,
  `lygis` int(11) NOT NULL,
  `userid` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `vartotojas`
--

INSERT INTO `vartotojas` (`prisijungimoVardas`, `slaptazodis`, `vardas`, `pavarde`, `busena`, `id_Vartotojas`, `lygis`, `userid`) VALUES
('admin', 'fe01ce2a7fbac8fafaed7c982a04e229', 'admin', 'admin', 'aktyvus', 1, 9, '83b2865991d06ff7d942c388c4543c85'),
('mokytojas', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mokytojas', 'Antanas', 'aktyvus', 2, 5, '1325547c3179a81322b54c370d62b21a'),
('mokinys', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mokinys', 'Juozas', 'aktyvus', 3, 1, '67bc40396d94e50c1608c910381d6a12'),
('tevas', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Tevas', 'Jonas', 'aktyvus', 4, 3, ''),
('adminas', 'fe01ce2a7fbac8fafaed7c982a04e229', 'admin', 'admin', 'blokuotas', 5, 9, ''),
('mokytojas2', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mokytoja', 'Angelė', 'aktyvus', 6, 5, '414931a73d8b4651ed72836605a3a545'),
('mokytojas3', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mokytoja', 'Anelė', 'aktyvus', 7, 5, 'd5fbe3a9e91d4d125312be5e283e5b9e'),
('mokytojas4', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mokytoja', 'Dovilė', 'aktyvus', 8, 5, 'b07fa79970d3458277422a9813ee882c'),
('mokytojas5', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mokytoja', 'Elena', 'aktyvus', 9, 5, '0af0829e5ee28e827b4b8bd0cfe2774e'),
('mokytojas6', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mokytoja', 'Rasa', 'aktyvus', 10, 5, '7fef9048a0e4e672f367591f90660f08'),
('jonas95', '123456', 'Jonas', 'Janušauskas', NULL, 11, 3, NULL),
('Petraskaz', 'demo', 'Petras', 'Kazlauskas', NULL, 12, 3, NULL),
('juozas51', 'demo', 'Juozas', 'Bunikis', NULL, 13, 3, NULL),
('petrasbunikis', 'demo', 'Petras', 'Bunikis', NULL, 14, 1, NULL),
('monikakazlauskaite', 'demo', 'Monika', 'Kazlauskaite', NULL, 15, 1, NULL),
('janusauskaite', 'demo', 'Kristina', 'Janušauskaitė', NULL, 16, 1, NULL),
('karolis', 'demo', 'Karolis', 'Pinaiti', NULL, 17, 3, NULL),
('pinaityte', 'demo', 'Nering', 'Pinaityte', NULL, 18, 1, NULL),
('Kazlaskazlauskas', 'demo', 'Kazlas', 'Kazlauskas', NULL, 19, 3, NULL),
('ingkaz', 'demo', 'Inga', 'Kazlauskaitė', NULL, 20, 1, NULL);

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
  ADD PRIMARY KEY (`id_Klasespamoka`),
  ADD KEY `fk_Pamoka` (`fk_Pamoka`),
  ADD KEY `fk_Klase` (`fk_Klase`),
  ADD KEY `klasespamoka_ibfk_3` (`fk_Mokytojas`);

--
-- Indexes for table `lankomumas`
--
ALTER TABLE `lankomumas`
  ADD PRIMARY KEY (`id_Lankomumas`),
  ADD KEY `fk_KlasesPamoka` (`fk_KlasesPamoka`),
  ADD KEY `fk_Mokinys` (`fk_Mokinys`);

--
-- Indexes for table `mokinys`
--
ALTER TABLE `mokinys`
  ADD PRIMARY KEY (`id_Vartotojas`),
  ADD KEY `priklauso` (`fk_Klase`),
  ADD KEY `fk_MokinioTevas` (`fk_MokinioTevas`);

--
-- Indexes for table `pamoka`
--
ALTER TABLE `pamoka`
  ADD PRIMARY KEY (`id_Pamoka`);

--
-- Indexes for table `pamokoslaikas`
--
ALTER TABLE `pamokoslaikas`
  ADD PRIMARY KEY (`id_Pamokoslaikas`),
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
  ADD PRIMARY KEY (`id_Vartotojas`),
  ADD UNIQUE KEY `prisijungimoVardas` (`prisijungimoVardas`);

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
  MODIFY `id_Irasas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `klase`
--
ALTER TABLE `klase`
  MODIFY `id_Klase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `klasespamoka`
--
ALTER TABLE `klasespamoka`
  MODIFY `id_Klasespamoka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lankomumas`
--
ALTER TABLE `lankomumas`
  MODIFY `id_Lankomumas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `pamoka`
--
ALTER TABLE `pamoka`
  MODIFY `id_Pamoka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pamokoslaikas`
--
ALTER TABLE `pamokoslaikas`
  MODIFY `id_Pamokoslaikas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `pazymys`
--
ALTER TABLE `pazymys`
  MODIFY `id_Pazymys` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `vartotojas`
--
ALTER TABLE `vartotojas`
  MODIFY `id_Vartotojas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `zinute`
--
ALTER TABLE `zinute`
  MODIFY `id_Zinute` int(11) NOT NULL AUTO_INCREMENT;
--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `atsiskaitymas`
--
ALTER TABLE `atsiskaitymas`
  ADD CONSTRAINT `atsiskaitymas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_Klasespamoka`);

--
-- Apribojimai lentelei `irasas`
--
ALTER TABLE `irasas`
  ADD CONSTRAINT `irasas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_Klasespamoka`);

--
-- Apribojimai lentelei `klasespamoka`
--
ALTER TABLE `klasespamoka`
  ADD CONSTRAINT `klasespamoka_ibfk_1` FOREIGN KEY (`fk_Pamoka`) REFERENCES `pamoka` (`id_Pamoka`),
  ADD CONSTRAINT `klasespamoka_ibfk_2` FOREIGN KEY (`fk_Klase`) REFERENCES `klase` (`id_Klase`),
  ADD CONSTRAINT `klasespamoka_ibfk_3` FOREIGN KEY (`fk_Mokytojas`) REFERENCES `vartotojas` (`id_Vartotojas`);

--
-- Apribojimai lentelei `lankomumas`
--
ALTER TABLE `lankomumas`
  ADD CONSTRAINT `lankomumas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_Klasespamoka`),
  ADD CONSTRAINT `lankomumas_ibfk_2` FOREIGN KEY (`fk_Mokinys`) REFERENCES `mokinys` (`id_Vartotojas`);

--
-- Apribojimai lentelei `mokinys`
--
ALTER TABLE `mokinys`
  ADD CONSTRAINT `mokinys_ibfk_1` FOREIGN KEY (`fk_MokinioTevas`) REFERENCES `vartotojas` (`id_Vartotojas`),
  ADD CONSTRAINT `mokinys_ibfk_2` FOREIGN KEY (`id_Vartotojas`) REFERENCES `vartotojas` (`id_Vartotojas`),
  ADD CONSTRAINT `priklauso` FOREIGN KEY (`fk_Klase`) REFERENCES `klase` (`id_Klase`);

--
-- Apribojimai lentelei `pamokoslaikas`
--
ALTER TABLE `pamokoslaikas`
  ADD CONSTRAINT `pamokoslaikas_ibfk_1` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_Klasespamoka`);

--
-- Apribojimai lentelei `pazymys`
--
ALTER TABLE `pazymys`
  ADD CONSTRAINT `pazymys_ibfk_1` FOREIGN KEY (`fk_Mokinys`) REFERENCES `mokinys` (`id_Vartotojas`),
  ADD CONSTRAINT `pazymys_ibfk_2` FOREIGN KEY (`fk_KlasesPamoka`) REFERENCES `klasespamoka` (`id_Klasespamoka`);

--
-- Apribojimai lentelei `zinute`
--
ALTER TABLE `zinute`
  ADD CONSTRAINT `zinute_ibfk_1` FOREIGN KEY (`fk_Siuntejas`) REFERENCES `vartotojas` (`id_Vartotojas`),
  ADD CONSTRAINT `zinute_ibfk_2` FOREIGN KEY (`fk_Gavejas`) REFERENCES `vartotojas` (`id_Vartotojas`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
