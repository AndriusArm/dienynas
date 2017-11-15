-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 m. Grd 21 d. 22:42
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `andarm`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `active_guests`
--

CREATE TABLE `active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `active_users`
--

CREATE TABLE `active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `active_users`
--

INSERT INTO `active_users` (`username`, `timestamp`) VALUES
('Moderatorius', 1482356506);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `banned_users`
--

CREATE TABLE `banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `banned_users`
--

INSERT INTO `banned_users` (`username`, `timestamp`) VALUES
('Jonas', 1478723779);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `irasas`
--

CREATE TABLE `irasas` (
  `id_Irasas` int(11) NOT NULL,
  `data` date NOT NULL,
  `pazymys` int(2) NOT NULL,
  `fk_Pamoka` int(11) NOT NULL,
  `fk_Mokinys` int(11) NOT NULL,
  `komentaras` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `irasas`
--

INSERT INTO `irasas` (`id_Irasas`, `data`, `pazymys`, `fk_Pamoka`, `fk_Mokinys`, `komentaras`) VALUES
(1, '2016-12-21', 10, 9, 3, 'Labai gerai'),
(2, '2016-12-21', 2, 9, 7, 'Labai blogai'),
(3, '2016-12-21', 10, 13, 3, 'Puiku'),
(4, '2016-12-21', 6, 12, 7, 'Reikia pasimokyti');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `mokinys_pamoka`
--

CREATE TABLE `mokinys_pamoka` (
  `fk_Mokinys` int(11) NOT NULL,
  `fk_Pamoka` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `mokinys_pamoka`
--

INSERT INTO `mokinys_pamoka` (`fk_Mokinys`, `fk_Pamoka`) VALUES
(3, 9),
(3, 10),
(3, 13),
(3, 15),
(7, 9),
(7, 12),
(7, 15),
(10, 14),
(10, 15),
(10, 16),
(10, 17);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `naujiena`
--

CREATE TABLE `naujiena` (
  `id` int(11) NOT NULL,
  `pavadinimas` text NOT NULL,
  `tekstas` text NOT NULL,
  `vartotojas` varchar(20) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `naujiena`
--

INSERT INTO `naujiena` (`id`, `pavadinimas`, `tekstas`, `vartotojas`, `data`) VALUES
(1, 'Sveiki!', 'Sveiki atvykę į Elektroninį dienyną', 'Moderatorius', '2016-11-07 00:00:00'),
(2, 'Atidarymas', 'Ketvirtadienį įvyks puslapio atidarymas', 'Moderatorius', '2016-11-07 00:00:00'),
(3, 'Naujienų sistema', 'Įkelta naujienų sistema. Naujienas gali rašyti mokytojai ir moderatoriai.', 'Moderatorius', '2016-11-06 00:00:00'),
(12, 'Klaidos', 'Buvo ištaisytos kelios klaidos', 'Moderatorius', '2016-12-20 09:06:43'),
(13, 'Pamokų sistema', 'Įvesta veikianti pamokų sistema', 'Mokytojas2', '2016-12-21 09:39:35');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `pamoka`
--

CREATE TABLE `pamoka` (
  `id_Pamoka` int(11) NOT NULL,
  `pavadinimas` varchar(100) NOT NULL,
  `fk_Mokytojas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `pamoka`
--

INSERT INTO `pamoka` (`id_Pamoka`, `pavadinimas`, `fk_Mokytojas`) VALUES
(9, 'Anglų k.', 5),
(10, 'Matematika', 1),
(12, 'Lietuvių k.', 5),
(13, 'Kūno kultūra', 5),
(14, 'Dailė', 6),
(15, 'Fizika', 8),
(16, 'Chemija', 9),
(17, 'Vokiečių kalba', 4);

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `users`
--

CREATE TABLE `users` (
  `id_Vartotojas` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) UNSIGNED NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Sukurta duomenų kopija lentelei `users`
--

INSERT INTO `users` (`id_Vartotojas`, `username`, `password`, `userid`, `userlevel`, `email`, `timestamp`) VALUES
(1, 'Mokytojas', 'fe01ce2a7fbac8fafaed7c982a04e229', '5b2e685d2193478b7b1ae7792769f1e3', 5, 'mokytojas@demo.lt', 1482150633),
(2, 'Moderatorius', 'fe01ce2a7fbac8fafaed7c982a04e229', '40068eee558c7118fdcd38fb00094c6d', 9, 'moderatorius@demo.lt', 1482356506),
(3, 'Mokinys', 'fe01ce2a7fbac8fafaed7c982a04e229', '7af2d20221077330989be0781e13eb91', 1, 'mokinys@demo.lt', 1482353510),
(4, 'Mokytojas3', 'fe01ce2a7fbac8fafaed7c982a04e229', '301d2de217ac462e32af7042f66d0de8', 5, 'mokytojas3@demo.lt', 1482354699),
(5, 'Mokytojas2', 'fe01ce2a7fbac8fafaed7c982a04e229', '38f5addb6423bc264b850f977a9b4697', 5, 'mokytojas2@demo.lt', 1482352800),
(6, 'mokytojas4', 'fe01ce2a7fbac8fafaed7c982a04e229', '0', 5, 'mokytojas4@demo.lt', 1482339389),
(7, 'petras', 'fe01ce2a7fbac8fafaed7c982a04e229', '911744c24adaad4efa3d6048625267d8', 1, 'petras@demo.lt', 1482353524),
(8, 'Mokytojas5', 'fe01ce2a7fbac8fafaed7c982a04e229', '5722388563430c681c88f5a730244750', 5, 'mokytojas5@demo.lt', 1482341624),
(9, 'Mokytojas6', 'fe01ce2a7fbac8fafaed7c982a04e229', '0', 5, 'mokytojas6@demo.lt', 1482340727),
(10, 'Andrius', 'fe01ce2a7fbac8fafaed7c982a04e229', '25f9faaccf00021e9afb3feb2f533630', 1, 'andrius@demo.lt', 1482354678);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_guests`
--
ALTER TABLE `active_guests`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `active_users`
--
ALTER TABLE `active_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `banned_users`
--
ALTER TABLE `banned_users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `irasas`
--
ALTER TABLE `irasas`
  ADD PRIMARY KEY (`id_Irasas`);

--
-- Indexes for table `mokinys_pamoka`
--
ALTER TABLE `mokinys_pamoka`
  ADD PRIMARY KEY (`fk_Mokinys`,`fk_Pamoka`);

--
-- Indexes for table `naujiena`
--
ALTER TABLE `naujiena`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pamoka`
--
ALTER TABLE `pamoka`
  ADD PRIMARY KEY (`id_Pamoka`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_Vartotojas` (`id_Vartotojas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `irasas`
--
ALTER TABLE `irasas`
  MODIFY `id_Irasas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `naujiena`
--
ALTER TABLE `naujiena`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pamoka`
--
ALTER TABLE `pamoka`
  MODIFY `id_Pamoka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_Vartotojas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
