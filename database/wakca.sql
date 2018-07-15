-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2018 at 11:07 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wakca`
--

-- --------------------------------------------------------

--
-- Table structure for table `dokumen_desa`
--

CREATE TABLE `dokumen_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `desa` varchar(10) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `dokumen_desa`
--

INSERT INTO `dokumen_desa` (`id`, `desa`, `judul`, `link`) VALUES
(1, '3205200005', 'Dokumen 1', 'http://google.com/'),
(2, '3205200005', 'Test', 'http://google.com/');

-- --------------------------------------------------------

--
-- Table structure for table `kabar_desa`
--

CREATE TABLE `kabar_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `desa` varchar(10) NOT NULL,
  `konten` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `kabar_desa`
--

INSERT INTO `kabar_desa` (`id`, `desa`, `konten`) VALUES
(1, '3205200005', '<p>123 232323232</p>');

-- --------------------------------------------------------

--
-- Table structure for table `organisasi_desa`
--

CREATE TABLE `organisasi_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `desa` varchar(10) NOT NULL,
  `konten` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `organisasi_desa`
--

INSERT INTO `organisasi_desa` (`id`, `desa`, `konten`) VALUES
(2, '3205200005', '<p>test test</p>');

-- --------------------------------------------------------

--
-- Table structure for table `produk_unggulan`
--

CREATE TABLE `produk_unggulan` (
  `id` int(10) UNSIGNED NOT NULL,
  `desa` varchar(10) NOT NULL,
  `konten` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `produk_unggulan`
--

INSERT INTO `produk_unggulan` (`id`, `desa`, `konten`) VALUES
(2, '3205200005', '<p>Halaman Produk Unggulan</p>');

-- --------------------------------------------------------

--
-- Table structure for table `profil_desa`
--

CREATE TABLE `profil_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `desa` varchar(10) NOT NULL,
  `konten` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `profil_desa`
--

INSERT INTO `profil_desa` (`id`, `desa`, `konten`) VALUES
(2, '3205200005', '<p>Test Halaman Profil Desa</p>');

-- --------------------------------------------------------

--
-- Table structure for table `selayang_pandang`
--

CREATE TABLE `selayang_pandang` (
  `id` int(10) UNSIGNED NOT NULL,
  `desa` varchar(10) NOT NULL,
  `konten` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selayang_pandang`
--

INSERT INTO `selayang_pandang` (`id`, `desa`, `konten`) VALUES
(1, '3205200005', '<p>Halaman Selayang Pandang</p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokumen_desa`
--
ALTER TABLE `dokumen_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabar_desa`
--
ALTER TABLE `kabar_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisasi_desa`
--
ALTER TABLE `organisasi_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_unggulan`
--
ALTER TABLE `produk_unggulan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_desa`
--
ALTER TABLE `profil_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selayang_pandang`
--
ALTER TABLE `selayang_pandang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokumen_desa`
--
ALTER TABLE `dokumen_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kabar_desa`
--
ALTER TABLE `kabar_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `organisasi_desa`
--
ALTER TABLE `organisasi_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk_unggulan`
--
ALTER TABLE `produk_unggulan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profil_desa`
--
ALTER TABLE `profil_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `selayang_pandang`
--
ALTER TABLE `selayang_pandang`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
