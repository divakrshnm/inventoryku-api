-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2020 at 05:10 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorikudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(15) NOT NULL,
  `nama_barang` varchar(35) NOT NULL,
  `kuantitas_barang` int(11) NOT NULL DEFAULT '0',
  `catatan_barang` text,
  `gambar_barang` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `kuantitas_barang`, `catatan_barang`, `gambar_barang`) VALUES
('12342', 'gelas', 0, 'pecah belah', NULL),
('12344', 'gelas', 0, 'pecah belah', NULL),
('12347', 'gelas', 0, 'pecah belah', NULL),
('8996006856715', 'Tebs', 37, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `kode_barang_keluar` int(11) NOT NULL,
  `kode_barang_barang_keluar` varchar(15) NOT NULL,
  `kode_konsumen_barang_keluar` int(11) NOT NULL,
  `kuantitas_barang_keluar` int(11) NOT NULL,
  `tanggal_waktu_barang_keluar` datetime NOT NULL,
  `catatan_barang_keluar` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`kode_barang_keluar`, `kode_barang_barang_keluar`, `kode_konsumen_barang_keluar`, `kuantitas_barang_keluar`, `tanggal_waktu_barang_keluar`, `catatan_barang_keluar`) VALUES
(1, '8996006856715', 1, 30, '2020-02-04 20:00:00', ''),
(2, '8996006856715', 1, 50, '2020-02-04 08:00:00', 'ada apa sih'),
(3, '8996006856715', 1, 50, '2020-02-04 08:00:00', 'ada apa'),
(4, '8996006856715', 1, 50, '2020-02-04 08:00:00', 'ada apa');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `delete_barang_keluar` AFTER DELETE ON `barang_keluar` FOR EACH ROW UPDATE barang SET kuantitas_barang=kuantitas_barang-OLD.kuantitas_barang_keluar WHERE kode_barang = OLD.kode_barang_barang_keluar
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `input_barang_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW UPDATE barang SET kuantitas_barang=kuantitas_barang-NEW.kuantitas_barang_keluar WHERE kode_barang = NEW.kode_barang_barang_keluar
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `kode_barang_masuk` int(11) NOT NULL,
  `kode_barang_barang_masuk` varchar(15) NOT NULL,
  `kode_pemasok_barang_masuk` int(11) NOT NULL,
  `kuantitas_barang_masuk` int(11) NOT NULL,
  `tanggal_waktu_barang_masuk` datetime NOT NULL,
  `catatan_barang_masuk` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`kode_barang_masuk`, `kode_barang_barang_masuk`, `kode_pemasok_barang_masuk`, `kuantitas_barang_masuk`, `tanggal_waktu_barang_masuk`, `catatan_barang_masuk`) VALUES
(2, '8996006856715', 1, 20, '2020-02-04 08:00:00', ''),
(4, '8996006856715', 1, 50, '2020-02-04 08:00:00', 'ada apa');

--
-- Triggers `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `delete_barang_masuk` AFTER DELETE ON `barang_masuk` FOR EACH ROW UPDATE barang SET kuantitas_barang=kuantitas_barang-OLD.kuantitas_barang_masuk WHERE kode_barang = OLD.kode_barang_barang_masuk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `input_barang_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW UPDATE barang SET kuantitas_barang=kuantitas_barang+NEW.kuantitas_barang_masuk WHERE kode_barang = NEW.kode_barang_barang_masuk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `kode_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(35) NOT NULL,
  `alamat_konsumen` text NOT NULL,
  `kontak_konsumen` varchar(15) NOT NULL,
  `gambar_konsumen` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`kode_konsumen`, `nama_konsumen`, `alamat_konsumen`, `kontak_konsumen`, `gambar_konsumen`) VALUES
(1, 'Albert', 'Bandung', '089677709045', NULL),
(4, 'Kadek', 'Gianyar', '089677709045', 'diva.png'),
(5, 'Kadek', 'Gianyar', '089677709045', 'himatif.png'),
(6, 'Kadek', 'Gianyar', '089677709045', 'however its you.jpg'),
(7, 'Kadek', 'Gianyar', '089677709045', 'however its you.jpg'),
(8, 'Kadek', 'Gianyar', '089677709045', ''),
(9, 'Kadek', 'Gianyar', '', ''),
(10, 'Diva', 'Gianyar', '089677709045', 'however its you.jpg'),
(11, 'Diva', 'Gianyar', '089677709045', 'however its you.jpg'),
(12, 'Diva', 'Gianyar', '089677709045', 'however its you.jpg'),
(13, 'Diva', 'Gianyar', '089677709045', 'however its you.jpg'),
(15, 'gelas', '3434', '4545', 'ISO_9001-2015.jpg'),
(16, 'gelas', '3434', '4545', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `kode_pemasok` int(11) NOT NULL,
  `nama_pemasok` varchar(35) NOT NULL,
  `alamat_pemasok` text NOT NULL,
  `kontak_pemasok` varchar(15) NOT NULL,
  `gambar_pemasok` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`kode_pemasok`, `nama_pemasok`, `alamat_pemasok`, `kontak_pemasok`, `gambar_pemasok`) VALUES
(1, 'gelar', 'aaa', 'aa', 'himatifx.png'),
(2, 'Budhi', 'Bandung', 'budi@gmail.com', 'however its you.jpg'),
(3, 'gelas', 'aaa', 'ddd', '.jpg'),
(4, 'gelas', 'aaa', 'ddd', NULL),
(5, 'gelas', 'aaa', 'ddd', '.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`kode_barang_keluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`kode_barang_masuk`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`kode_konsumen`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`kode_pemasok`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `kode_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `kode_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `kode_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `kode_pemasok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
