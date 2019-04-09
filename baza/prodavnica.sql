-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2017 at 12:45 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodavnica`
--

-- --------------------------------------------------------

--
-- Table structure for table `adresa`
--

CREATE TABLE `adresa` (
  `id_adresa` int(255) NOT NULL,
  `ulica` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `broj` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adresa_grad`
--

CREATE TABLE `adresa_grad` (
  `id_ag` int(255) NOT NULL,
  `id_adresa` int(255) NOT NULL,
  `id_grad` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `anketa`
--

CREATE TABLE `anketa` (
  `id_anketa` int(255) NOT NULL,
  `pitanje` text COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id_grad` int(255) NOT NULL,
  `ime_grad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `pos_br` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnik` int(255) NOT NULL,
  `ime_prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `id_ag` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik_uloga`
--

CREATE TABLE `korisnik_uloga` (
  `id_ku` int(255) NOT NULL,
  `id_korisnik` int(255) NOT NULL,
  `id_uloga` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id_korpa` int(255) NOT NULL,
  `id_korisnik` int(255) NOT NULL,
  `datum` date NOT NULL,
  `broj_narucenih` int(5) NOT NULL,
  `marker` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korpa_model`
--

CREATE TABLE `korpa_model` (
  `id_mk` int(255) NOT NULL,
  `id_model` int(255) NOT NULL,
  `id_korpa` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id_meni` int(255) NOT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `naziv_meni` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE `odgovori` (
  `id_odgovor` int(255) NOT NULL,
  `odgovor` text COLLATE utf8_unicode_ci NOT NULL,
  `id_anketa` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proizvodjac`
--

CREATE TABLE `proizvodjac` (
  `id_proizvodjac` int(255) NOT NULL,
  `naziv_proizvodac` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `slika`
--

CREATE TABLE `slika` (
  `id_slika` int(255) NOT NULL,
  `putanjaV` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `putanjaM` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `id_korisnik` int(255) DEFAULT NULL,
  `alt` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_model` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for table `adresa`
--
ALTER TABLE `adresa`
  ADD PRIMARY KEY (`id_adresa`);

--
-- Indexes for table `adresa_grad`
--
ALTER TABLE `adresa_grad`
  ADD PRIMARY KEY (`id_ag`);

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
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id_korpa`);

--
-- Indexes for table `korpa_model`
--
ALTER TABLE `korpa_model`
  ADD PRIMARY KEY (`id_mk`);

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
-- AUTO_INCREMENT for table `adresa`
--
ALTER TABLE `adresa`
  MODIFY `id_adresa` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adresa_grad`
--
ALTER TABLE `adresa_grad`
  MODIFY `id_ag` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `anketa`
--
ALTER TABLE `anketa`
  MODIFY `id_anketa` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id_grad` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnik` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `korisnik_uloga`
--
ALTER TABLE `korisnik_uloga`
  MODIFY `id_ku` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id_korpa` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `korpa_model`
--
ALTER TABLE `korpa_model`
  MODIFY `id_mk` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id_meni` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id_model` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
  MODIFY `id_odgovor` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proizvodjac`
--
ALTER TABLE `proizvodjac`
  MODIFY `id_proizvodjac` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rezultat`
--
ALTER TABLE `rezultat`
  MODIFY `id_rezultat` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slika`
--
ALTER TABLE `slika`
  MODIFY `id_slika` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
