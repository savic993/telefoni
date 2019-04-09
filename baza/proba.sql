-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2017 at 05:55 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proba`
--

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id_anketa` int(255) NOT NULL,
  `pitanje` text COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `anketa`
--

INSERT INTO `anketa` (`id_anketa`, `pitanje`, `aktivna`) VALUES
(2, 'Koji model Vam se najvise svidja?', 1),
(3, 'Da li Vam se svidja sajt?', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id_grad` int(255) NOT NULL,
  `ime_grad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pos_br` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id_grad`, `ime_grad`, `pos_br`) VALUES
(1, 'Beograd', 11000),
(2, 'Lajkovac', 14224),
(3, 'Novi Sad', 21000);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(255) NOT NULL,
  `ime_prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_grad` int(255) NOT NULL,
  `adresa` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnik`, `ime_prezime`, `username`, `password`, `email`, `id_grad`, `adresa`) VALUES
(2, 'Mika Mikic', 'user', '6ad14ba9986e3615423dfca256d04e3f', 'mika@gmail.com', 1, 'Vojvode Stepe 32'),
(5, 'Nemanja Savic', 'nemanja', 'a61237f30a9ade8674490042ddc31838', 'nemanja.savic.21.12@ict.edu.rs', 2, 'Vojvode Milenka 18');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_uloga`
--

CREATE TABLE `korisnik_uloga` (
  `id_ku` int(255) NOT NULL,
  `id_korisnik` int(255) NOT NULL,
  `id_uloga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik_uloga`
--

INSERT INTO `korisnik_uloga` (`id_ku`, `id_korisnik`, `id_uloga`) VALUES
(2, 2, 2),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id_meni` int(255) NOT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `naziv_meni` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pozicija` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id_meni`, `link`, `naziv_meni`, `pozicija`) VALUES
(2, 'index.php?x=', 'Telefoni', 2),
(5, 'index.php?x=', 'Galerija', 3),
(6, 'index.php?x=', 'Pocetna', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id_model` int(255) NOT NULL,
  `naziv_model` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `id_proizvodjac` int(255) NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `cena` double NOT NULL,
  `kolicina` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id_model`, `naziv_model`, `id_proizvodjac`, `opis`, `cena`, `kolicina`) VALUES
(2, 'Galaxy J7', 1, '13 MP,Cortex-A53 Quad-core,16 GB,Wi-Fi 802.11 / Bluetooth 4.1,Crna', 269, 5),
(3, 'Galaxy S7', 1, '12 MP, Dual-core 2.15 GHz,32 GB,Wi-Fi 802.11/Bluetooth v4.2,Crna', 472, 10),
(4, 'G5', 2, '16MP, Dual-core 2.15 GHz,16MP,Wi-Fi/Bluetooth 4.2,Siva', 380, 8),
(5, 'G3', 2, '13 MP,Quad-core Krait 400,16 GB,Wi-Fi 802.11 / Bluetooth 4.1,Bela', 255, 0),
(6, '7', 4, '12 MP,Quad-core,32 GB,Wi-Fi 802.11/Bluetooth v4.2,Crna', 655, 12),
(7, '5s', 4, '8,Dual-core Cyclone (ARM v8-based),16GB,Wi-Fi 802.11/Bluetooth v4.2,Bela', 300, 2);

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE `odgovori` (
  `id_odgovor` int(255) NOT NULL,
  `odgovor` text COLLATE utf8_unicode_ci NOT NULL,
  `id_anketa` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`id_odgovor`, `odgovor`, `id_anketa`) VALUES
(1, 'Tesla 9', 2),
(2, 'Samsung Galaxy J7', 2),
(3, 'iphone 5s', 2),
(4, 'Da', 3),
(5, 'Ne', 3);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodjac`
--

CREATE TABLE `proizvodjac` (
  `id_proizvodjac` int(255) NOT NULL,
  `naziv_proizvodjac` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvodjac`
--

INSERT INTO `proizvodjac` (`id_proizvodjac`, `naziv_proizvodjac`) VALUES
(1, 'Samsung'),
(2, 'LG'),
(4, 'iPhone');

-- --------------------------------------------------------

--
-- Table structure for table `rezultat`
--

CREATE TABLE `rezultat` (
  `id_rezultat` int(255) NOT NULL,
  `id_anketa` int(255) NOT NULL,
  `id_odgovor` int(255) NOT NULL,
  `rezultat` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezultat`
--

INSERT INTO `rezultat` (`id_rezultat`, `id_anketa`, `id_odgovor`, `rezultat`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 3),
(3, 2, 3, 2),
(4, 2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `id_slika` int(255) NOT NULL,
  `putanjaV` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `putanjaM` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_model` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slika`
--

INSERT INTO `slika` (`id_slika`, `putanjaV`, `putanjaM`, `alt`, `id_model`) VALUES
(3, 'slike/telefoni/velikeSlike/1489433532galaxyj7_2.jpg', 'slike/telefoni/maleSlike/1489433532galaxyj7_2.jpg', 'j7_2', 2),
(4, 'slike/telefoni/velikeSlike/1489433552galaxyj7_3.jpeg', 'slike/telefoni/maleSlike/1489433552galaxyj7_3.jpeg', 'j7_3', 2),
(5, 'slike/telefoni/velikeSlike/1489434959galaxyj7_1.jpg', 'slike/telefoni/maleSlike/1489434959galaxyj7_1.jpg', 'j7_1', 2),
(6, 'slike/telefoni/velikeSlike/1489452167galaxys7_1.jpg', 'slike/telefoni/maleSlike/1489452167galaxys7_1.jpg', 'galaxy S7', 3),
(7, 'slike/telefoni/velikeSlike/1489452209galaxys7_2.png', 'slike/telefoni/maleSlike/1489452209galaxys7_2.png', 'galaxy S7 druga slika', 3),
(8, 'slike/telefoni/velikeSlike/1489452234galaxys7_3.jpg', 'slike/telefoni/maleSlike/1489452234galaxys7_3.jpg', 'galaxy S7 treca slika', 3),
(9, 'slike/telefoni/velikeSlike/1489452335g5_1.jpg', 'slike/telefoni/maleSlike/1489452335g5_1.jpg', 'G5', 4),
(10, 'slike/telefoni/velikeSlike/1489452362g5_2.jpg', 'slike/telefoni/maleSlike/1489452362g5_2.jpg', 'G5 druga slika', 4),
(11, 'slike/telefoni/velikeSlike/1489452388g5_3.jpg', 'slike/telefoni/maleSlike/1489452388g5_3.jpg', 'G5 treca slika', 4),
(12, 'slike/telefoni/velikeSlike/1489629897g3_1.jpg', 'slike/telefoni/maleSlike/1489629897g3_1.jpg', 'g3', 5),
(13, 'slike/telefoni/velikeSlike/1489629921g3_2.jpg', 'slike/telefoni/maleSlike/1489629921g3_2.jpg', 'g3_druga', 5),
(14, 'slike/telefoni/velikeSlike/1489629942g3_3.jpg', 'slike/telefoni/maleSlike/1489629942g3_3.jpg', 'g3 treca', 5),
(15, 'slike/telefoni/velikeSlike/14896305817_1.jpg', 'slike/telefoni/maleSlike/14896305817_1.jpg', '7', 6),
(16, 'slike/telefoni/velikeSlike/14896306007_2.jpg', 'slike/telefoni/maleSlike/14896306007_2.jpg', '7 druga', 6),
(17, 'slike/telefoni/velikeSlike/14896306227_3.jpg', 'slike/telefoni/maleSlike/14896306227_3.jpg', '7 treca', 6),
(18, 'slike/telefoni/velikeSlike/14896803265s_1.jpg', 'slike/telefoni/maleSlike/14896803265s_1.jpg', '5s', 7),
(19, 'slike/telefoni/velikeSlike/14896803455s_2.jpg', 'slike/telefoni/maleSlike/14896803455s_2.jpg', '5s druga', 7),
(20, 'slike/telefoni/velikeSlike/14896804065s_3.jpg', 'slike/telefoni/maleSlike/14896804065s_3.jpg', '5s treca', 7);

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(255) NOT NULL,
  `naziv_uloga` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv_uloga`) VALUES
(1, 'Administrator'),
(2, 'Korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anketa`
--
ALTER TABLE `anketa`
  ADD PRIMARY KEY (`id_anketa`);

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id_grad`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnik`);

--
-- Indexes for table `korisnik_uloga`
--
ALTER TABLE `korisnik_uloga`
  ADD PRIMARY KEY (`id_ku`);

--
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id_meni`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id_model`);

--
-- Indexes for table `odgovori`
--
ALTER TABLE `odgovori`
  ADD PRIMARY KEY (`id_odgovor`);

--
-- Indexes for table `proizvodjac`
--
ALTER TABLE `proizvodjac`
  ADD PRIMARY KEY (`id_proizvodjac`);

--
-- Indexes for table `rezultat`
--
ALTER TABLE `rezultat`
  ADD PRIMARY KEY (`id_rezultat`);

--
-- Indexes for table `slika`
--
ALTER TABLE `slika`
  ADD PRIMARY KEY (`id_slika`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id_anketa` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id_grad` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `korisnik_uloga`
--
ALTER TABLE `korisnik_uloga`
  MODIFY `id_ku` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id_meni` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id_model` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
  MODIFY `id_odgovor` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `proizvodjac`
--
ALTER TABLE `proizvodjac`
  MODIFY `id_proizvodjac` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rezultat`
--
ALTER TABLE `rezultat`
  MODIFY `id_rezultat` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `id_slika` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
