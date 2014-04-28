-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2012 at 08:47 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `angsuran`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `kelamin` varchar(8) COLLATE latin1_general_ci NOT NULL,
  `user` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `kelamin`, `user`, `password`) VALUES
(1, 'Akhmad Dharma', 'akhmad_dharma@yahoo.com', 'pria', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE IF NOT EXISTS `angsuran` (
  `no_ang` int(100) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `tgl_tempo` date NOT NULL,
  `ags_ke` int(100) NOT NULL,
  `telat` int(100) NOT NULL,
  `denda` int(100) NOT NULL,
  `no` varchar(6) NOT NULL,
  `id_nasabah` varchar(6) NOT NULL,
  PRIMARY KEY (`no_ang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`no_ang`, `tgl`, `tgl_tempo`, `ags_ke`, `telat`, `denda`, `no`, `id_nasabah`) VALUES
(1, '2012-09-10', '2012-10-02', 1, 0, 0, 'PN0002', 'NB0004'),
(2, '2012-09-10', '2012-11-02', 2, 0, 0, 'PN0002', 'NB0004'),
(3, '2012-09-10', '2012-10-06', 1, 0, 0, 'PN0001', 'NB0001'),
(4, '2012-09-12', '2012-11-06', 2, 0, 0, 'PN0001', 'NB0001'),
(5, '2012-10-30', '2012-12-02', 3, 0, 0, 'PN0002', 'NB0004');

-- --------------------------------------------------------

--
-- Table structure for table `lama`
--

CREATE TABLE IF NOT EXISTS `lama` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lama` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lama`
--

INSERT INTO `lama` (`id`, `lama`) VALUES
(1, 12),
(2, 24),
(3, 36),
(4, 48),
(6, 60);

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE IF NOT EXISTS `nasabah` (
  `id` varchar(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `ktp` varchar(40) NOT NULL,
  `tmpt_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id`, `nama`, `ktp`, `tmpt_lahir`, `tgl_lahir`, `alamat`, `telpon`, `email`) VALUES
('NB0001', 'Akhmad Dharma', '12.837373.12938.441', 'Bogor', '1990-09-25', 'Serua Raya, Sawangan Depok', '085691738451', 'dharma@lokomedia.com'),
('NB0002', 'Sammy Simorangkir', '34.13831.3837.445.32', 'Jakarta', '1984-09-05', 'Jl. Ciputat No.44 , Tangerang Selatan', '08562823115', 'sammy@yahoo.com'),
('NB0004', 'Kresna Abimanyu', 'Ciputat', '2011-02-19', '0000-00-00', 'Jalan Jombang Raya No. 12 ', '08573515129', 'abim19@yahoo.com'),
('NB0003', 'Setiawan', '991.2813631.31', 'Bojongsari', '1989-09-22', 'Jl. Kesuman 23', '0878625522', 'matriks27@yahoo.com'),
('NB0005', 'Dewi Retno Wulan', 'Jakarta', '1989-07-07', '0000-00-00', 'Jalan Paninggilan Ciledug', '0218366386', 'dewi289@yahoo.com'),
('NB0006', 'Joni Adi Surya', 'Balikpapan', '1991-09-24', '0000-00-00', 'Jalan Montong Raya 23', '08561622161', 'joni@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE IF NOT EXISTS `pinjaman` (
  `no` varchar(6) NOT NULL,
  `tgl` date NOT NULL,
  `pokok` bigint(20) NOT NULL,
  `lama` int(10) NOT NULL,
  `bunga` float NOT NULL,
  `angsuran` bigint(20) NOT NULL,
  `status` enum('belum','lunas') NOT NULL DEFAULT 'belum',
  `id` varchar(12) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`no`, `tgl`, `pokok`, `lama`, `bunga`, `angsuran`, `status`, `id`) VALUES
('PN0001', '2012-09-06', 1000000, 12, 30, 108334, 'belum', 'NB0001'),
('PN0002', '2012-09-02', 6000000, 24, 33, 415000, 'belum', 'NB0004'),
('PN0003', '2012-09-12', 3000000, 36, 20, 133334, 'belum', 'NB0002');

-- --------------------------------------------------------

--
-- Table structure for table `pokok`
--

CREATE TABLE IF NOT EXISTS `pokok` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pokok` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `pokok`
--

INSERT INTO `pokok` (`id`, `pokok`) VALUES
(1, 5000000),
(3, 6000000),
(4, 7000000),
(5, 8000000),
(6, 9000000),
(7, 10000000),
(8, 11000000),
(9, 12000000),
(10, 13000000),
(11, 14000000),
(12, 15000000),
(13, 16000000),
(14, 17000000),
(15, 18000000),
(16, 19000000),
(18, 20000000),
(19, 21000000),
(20, 22000000),
(21, 23000000),
(22, 24000000),
(24, 25000000),
(25, 1000000),
(26, 2000000),
(27, 3000000),
(28, 4000000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
