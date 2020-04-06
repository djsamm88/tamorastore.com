-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2020 at 02:37 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tamorastore`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `user_admin` varchar(222) NOT NULL,
  `pass_admin` varchar(222) NOT NULL,
  `time_admin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_admin` enum('1','0') NOT NULL,
  `nama_admin` varchar(222) NOT NULL,
  `telp_admin` varchar(222) NOT NULL,
  `email_admin` varchar(222) NOT NULL,
  `level` enum('3','2','1') NOT NULL COMMENT '1=admin,2=keuangan,3=CS',
  `request_status` int(1) NOT NULL COMMENT '1=link_sent,0=tidak_ada',
  `tempat_lahir` varchar(222) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `pendidikan` varchar(55) NOT NULL,
  `jabatan` varchar(222) NOT NULL,
  `npwp` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `user_admin`, `pass_admin`, `time_admin`, `status_admin`, `nama_admin`, `telp_admin`, `email_admin`, `level`, `request_status`, `tempat_lahir`, `tgl_lahir`, `kelamin`, `pendidikan`, `jabatan`, `npwp`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2020-04-03 09:23:18', '1', 'Admin', '0811656616', 'dokterwebid@gmail.com', '1', 0, '', '0000-00-00', 'L', '', '', ''),
(2, 'kasir', '827ccb0eea8a706c4c34a16891f84e7b', '2020-01-25 08:29:32', '1', 'kasir', '082277109994', 'reza.angga@gmail.com', '3', 0, 'Medan', '0000-00-00', 'L', 'S1', 'Designer', '4223423'),
(5, 'jony', 'e10adc3949ba59abbe56e057f20f883e', '2018-12-03 05:06:43', '1', 'Jony', '082277109994', 'blionia.com@gmail.com', '2', 0, '', '0000-00-00', 'L', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id_bank`, `nama_bank`) VALUES
(14, 'BANK BCA'),
(8, 'BANK MANDIRI'),
(9, 'BANK BNI'),
(9, 'BANK BNI SYARIAH'),
(2, 'BANK BRI'),
(451, 'BANK SYARIAH MANDIRI'),
(22, 'BANK CIMB NIAGA'),
(22, 'BANK CIMB NIAGA SYARIAH'),
(147, 'BANK MUAMALAT'),
(422, 'BANK BRI SYARIAH'),
(200, 'BANK TABUNGAN NEGARA (BTN)'),
(13, 'PERMATA BANK'),
(11, 'BANK DANAMON'),
(16, 'BANK BII MAYBANK'),
(426, 'BANK MEGA'),
(153, 'BANK SINARMAS'),
(950, 'BANK COMMONWEALTH'),
(28, 'BANK OCBC NISP'),
(441, 'BANK BUKOPIN'),
(536, 'BANK BCA SYARIAH'),
(26, 'BANK LIPPO'),
(110, 'BANK JABAR'),
(111, 'BANK DKI'),
(112, 'BPD DIY'),
(113, 'BANK JATENG'),
(114, 'BANK JATIM'),
(115, 'BPD JAMBI'),
(116, 'BPD ACEH'),
(117, 'BANK SUMUT'),
(118, 'BANK NAGARI'),
(119, 'BANK RIAU'),
(120, 'BANK SUMSEL'),
(121, 'BANK LAMPUNG'),
(122, 'BPD KALSEL'),
(123, 'BPD KALIMANTAN BARAT'),
(124, 'BPD KALTIM'),
(125, 'BPD KALTENG'),
(126, 'BPD SULSEL'),
(127, 'BANK SULUT'),
(128, 'BPD NTB'),
(129, 'BPD BALI'),
(130, 'BANK NTT'),
(131, 'BANK MALUKU'),
(132, 'BPD PAPUA'),
(133, 'BANK BENGKULU'),
(134, 'BPD SULAWESI TENGAH'),
(135, 'BANK SULTRA'),
(3, 'BANK EKSPOR INDONESIA'),
(19, 'BANK PANIN'),
(20, 'BANK ARTA NIAGA KENCANA'),
(23, 'BANK BUANA IND'),
(37, 'BANK ARTHA GRAHA'),
(46, 'BANK DBS INDONESIA'),
(47, 'BANK RESONA PERDANIA'),
(48, 'BANK MIZUHO INDONESIA'),
(50, 'STANDARD CHARTERED BANK'),
(52, 'BANK ABN AMRO'),
(60, 'RABOBANK INTERNASIONAL INDONESIA'),
(61, 'ANZ PANIN BANK'),
(76, 'BANK BUMI ARTA'),
(87, 'BANK EKONOMI'),
(151, 'BANK MESTIKA'),
(157, 'BANK MASPION'),
(159, 'BANK HAGAKITA'),
(161, 'BANK GANESHA'),
(162, 'BANK WINDU KENTJANA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(222) NOT NULL,
  `harga_pokok` double NOT NULL,
  `harga_retail` double NOT NULL,
  `harga_lusin` double NOT NULL,
  `harga_koli` double NOT NULL,
  `jum_per_koli` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `nama_barang`, `harga_pokok`, `harga_retail`, `harga_lusin`, `harga_koli`, `jum_per_koli`) VALUES
(1, 'ALAT PENGIRIS KENTANG SPIRAL', 52000, 69000, 68000, 67000, 20),
(2, 'ALAT PENGASAH PISAU', 15000, 23000, 22000, 21000, 20),
(3, 'AYUNAN KAIN (200cm x 80cm)', 35000, 55000, 54000, 53000, 20),
(4, 'APPLE LEARNING', 23000, 27000, 26000, 25000, 20),
(5, 'ALAT POTONG SET', 48000, 55000, 54000, 53000, 5),
(6, 'BLENDER PORTABLE', 57000, 66000, 65000, 64000, 20),
(7, 'BOTOL PETAK', 7100, 8000, 8000, 8000, 20),
(8, 'BOTOL PETAK BPA FREE', 7100, 9000, 9000, 9000, 20),
(9, 'BLENDER CAPSULE', 87000, 100000, 98000, 96000, 20),
(10, 'BLENDER NATIONAL 2in1', 100000, 135000, 133000, 132000, 20),
(11, 'BLENDER MANUAL', 30000, 33000, 33000, 33000, 20),
(12, 'BOTOL PORTABLE CUP', 15000, 24000, 23000, 22000, 20),
(13, 'BOTOL SELIYA', 15000, 23000, 22000, 21000, 20),
(14, 'BOTOL DREAM', 15000, 18000, 17000, 16000, 20),
(15, 'CALYPSO PAN (24cm)', 30000, 38000, 37000, 36000, 20),
(16, 'CETAKAN LONTONG KECIL (15cm x 4cm)', 32000, 40000, 38000, 37000, 20),
(17, 'CELEMEK', 4000, 6000, 5500, 5000, 20),
(18, 'COOKING BOWL', 24000, 28000, 27000, 26000, 20),
(19, 'CELANA DALAM ANAK', 3500, 5000, 4500, 4000, 20),
(20, 'COOKWARE SET ISI 4', 130000, 150000, 148000, 145000, 20),
(21, 'COOKWARE SET ISI 6', 210000, 250000, 247000, 245000, 20),
(22, 'CASPIAN SENDOK SET', 14, 75000, 73000, 71000, 20),
(23, 'DISPENSER ODOL', 14000, 20000, 19000, 18000, 20),
(24, 'E - BOOK 4in1', 50000, 55000, 58000, 56000, 20),
(25, 'GEMBOK ALARM', 40000, 55000, 54000, 52000, 20),
(26, 'GORDEN KOLONG (80cm x 65cm)', 10000, 15000, 14000, 13000, 20),
(27, 'HAPPY CALL 7 LUBANG DATAR', 98000, 109000, 108000, 106000, 20),
(28, 'HAPPY CALL 12 LUBANG MOTIF', 98000, 109000, 108000, 106000, 20),
(29, 'HAPPY CALL 12 LUBANG DATAR', 98000, 109000, 108000, 106000, 20),
(30, 'HAPPY CALL 19 LUBANG TAKOYAKI', 98000, 109000, 108000, 106000, 20),
(31, 'HAPPY CALL DOUBLE PAN (32cm)', 142000, 155000, 153000, 150000, 20),
(32, 'HAPPY CALL GRILL (32cm)', 28500, 33000, 33000, 33000, 20),
(33, 'HAIR DRYER JUMBO NOVA', 52000, 55000, 53000, 50000, 20),
(34, 'HAIR DRYER MINI NOVA', 25000, 35000, 34000, 32000, 20),
(35, 'HANDUK MOTIF KARAKTER (140cm x 70cm)', 16000, 22000, 21000, 19000, 20),
(36, 'JAHIT SET', 9000, 13000, 12000, 11500, 20),
(37, 'KELAMBU BUTTERFLY (200cm x 200cm)', 90000, 105000, 103000, 98000, 20),
(38, 'KIM GLASS 3 PCS', 20000, 27000, 26000, 24000, 20),
(39, 'KINOKI KOYO', 7000, 9000, 9000, 9000, 20),
(40, 'KESET KAKI MOTIF', 11000, 14000, 13000, 13000, 20),
(41, 'KERANJANG KOTOR KARAKTER', 8000, 12000, 10000, 10000, 20),
(42, 'KELAMBU MAWAR (200cm x 180cm)', 20000, 30000, 29000, 28000, 20),
(43, 'KEPALA SHOWER', 25000, 35000, 34000, 32000, 20),
(44, 'LAMPU TUMBLR (10m)', 13500, 17000, 16500, 16000, 20),
(45, 'LAMPU CAMPING ', 24000, 34000, 33000, 32000, 20),
(46, 'LAMPU HIAS BINTANG BESAR', 15000, 23000, 23000, 21500, 20),
(47, 'LEMARI KOTAK 6 sisi (37cm x 74cm x 111cm)', 180000, 215000, 213000, 210000, 20),
(48, 'LEMARI MINI (50cm x 37cm)', 70000, 88000, 86000, 85000, 20),
(49, 'LAMPU TIUP', 32500, 37000, 36000, 35500, 20),
(50, 'LAMPU CAMPING DISCO', 45000, 55000, 44000, 42000, 20),
(51, 'LAMPU MEJA BELAJAR', 36000, 36000, 36000, 360000, 20),
(52, 'MINI FAN', 25000, 30000, 29000, 27000, 20),
(53, 'MAGNOLIA', 170000, 170000, 170000, 170000, 20),
(54, 'MAGIC HOSE 15M', 35000, 38000, 38000, 38000, 20),
(55, 'MAGIC HOSE 22.5M', 45000, 50000, 50000, 49000, 20),
(56, 'MATRAS MOBIL LARIZ', 180000, 190000, 188000, 186000, 20),
(57, 'GURITA PHONE', 4000, 5000, 5000, 5000, 20),
(58, 'MAGIC HANGER', 30000, 40000, 39000, 37000, 20),
(59, 'PISAU BUAH', 11000, 15000, 14000, 13000, 20),
(60, 'PISAU KITCHEN SET', 55000, 65000, 63000, 60000, 20),
(61, 'PISAU KITCHEN SET Q2', 55000, 65000, 63000, 60000, 20),
(62, 'SARINGAN AIR SWS', 31000, 49000, 47000, 45000, 20),
(63, 'PENYEDOT KOMEDO', 75000, 86000, 84000, 82000, 20),
(64, 'PENGGILING DAGING', 32000, 37000, 36000, 35000, 48),
(65, 'PEMERAS JERUK', 10000, 12000, 12000, 12000, 20),
(66, 'PANGGANGAN PORTABLE', 87000, 97000, 95000, 0, 20),
(67, 'PANCI MUSCLE', 105000, 125000, 123000, 0, 20),
(68, 'RAK DINDING SWEETHOME', 15000, 26000, 24000, 0, 20),
(69, 'RAK SET 3 IN 1', 28000, 53000, 52000, 0, 20),
(70, 'RAK PORTABLE KARAKTER DIVA', 50000, 65000, 63000, 0, 20),
(71, 'RAK SEGITIGA', 90000, 105000, 100000, 0, 20),
(72, 'RAK BAJU SERBAGUNA', 75000, 100000, 95000, 0, 20),
(73, 'RANTANG MAKAN LUVMI', 50000, 65000, 64000, 0, 20),
(74, 'RAK SHABBY', 30000, 46000, 44000, 0, 20),
(75, 'RAK BUKU SERBAGUNA', 55000, 76000, 74000, 0, 20),
(76, 'RAK SABUN', 36000, 58000, 55000, 0, 20),
(77, 'RAK SEGITIGA TOILET', 36000, 58000, 56000, 0, 20),
(78, 'RAK QURAN', 25000, 33000, 38000, 0, 20),
(79, 'RAK SEPATU PAYUNG 5 SUSUN', 55000, 70000, 68000, 0, 20),
(80, 'RAK SEPATU AMAZING', 51000, 58000, 55000, 0, 20),
(81, 'SENDOK POLKADOT', 48000, 52000, 51000, 0, 20),
(82, 'SABUN MAHKOTA', 14500, 16000, 15500, 0, 20),
(83, 'SENDOK BATIK', 10000, 11000, 11000, 0, 20),
(84, 'STAND HANGER DOUBLE', 90000, 110000, 108000, 0, 20),
(85, 'SELIMUT (190cm x 140cm)', 24000, 30000, 28000, 0, 20),
(86, 'STICKER KACA (5m x 45cm)', 22000, 27000, 0, 0, 20),
(87, 'SURPET KARAKTER (150cm x 180cm x 3cm)', 230000, 260000, 0, 0, 20),
(88, 'SUTIL STAINLESS', 25000, 33000, 0, 0, 20),
(89, 'STAND CORNER', 75000, 88000, 0, 0, 20),
(90, 'TEMPAT BUMBU SEASONING', 25000, 34000, 32000, 0, 20),
(91, 'TOPI KERAMAS (SHOWER CAP)', 1500, 3000, 2500, 0, 20),
(92, 'TIRAI BENANG (100cm x 200cm)', 5000, 11000, 10000, 0, 20),
(93, 'TUDUNG SAJI', 20000, 30000, 26000, 0, 20),
(94, 'TAPLAK MEJA MAKAN (137cm x 100cm)', 22000, 30000, 0, 0, 20),
(95, 'TIKAR PIKNIK (150cm x 152cm)', 30000, 40000, 39000, 0, 20),
(96, 'TIRAI MAGNET (210cm x 90cm)', 17000, 22000, 21000, 0, 20),
(97, 'TERMOS KACA ANIMAL (450ml)', 7000, 13000, 0, 0, 20),
(98, 'TIMBANGAN BADAN PS DIGITAL', 55000, 75000, 72000, 0, 20),
(99, 'TAS SANDANG ', 20000, 27000, 25000, 0, 20),
(100, 'TEA POT 5in1', 27000, 35000, 34000, 0, 20),
(101, 'TELENAN SERBAGUNA', 30000, 36000, 0, 0, 20),
(102, 'TEKO SIUL 5L', 80000, 90000, 0, 0, 20),
(103, 'TAS MOBIL MULTIFUNGSI', 21000, 26000, 0, 0, 20),
(104, 'TAPLAK KULKAS (130cm x 54cm)', 8000, 14000, 13000, 0, 20),
(105, 'TEKO LISTRIK', 55000, 74000, 0, 0, 20),
(106, 'TEFLON MINI', 8000, 13000, 0, 0, 20),
(107, 'WARMER STOVE', 60000, 80000, 0, 0, 20),
(108, 'WALLPAPER DINDING (10m x 45cm)', 31000, 35000, 34000, 33500, 30),
(109, 'WALLPAPER DAPUR (5m x 45cm)', 21500, 23000, 0, 0, 20),
(110, 'WAJAN ENAMEL (34cm)', 29500, 38000, 0, 0, 20),
(111, 'BOTOL H&P', 18000, 25000, 0, 0, 20),
(112, 'KALIGRAFI (25cm x 25cm) (38cm x 21cm)', 35000, 45000, 0, 0, 20),
(113, 'SAJADAH', 50000, 60000, 58000, 55000, 40),
(114, 'WALLPAPPER GABUS', 15000, 22000, 21000, 20000, 0),
(115, 'CALIGRAFI', 0, 45000, 44000, 0, 0),
(117, 'SABUN ARAB', 0, 16000, 15500, 15000, 144),
(118, 'LES WALLPAPER', 0, 20000, 19000, 18000, 48),
(119, 'Marlboro merah', 50000, 55000, 54000, 53000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_masuk_tanpa_harga`
--

CREATE TABLE `tbl_barang_masuk_tanpa_harga` (
  `id_barang_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` double NOT NULL,
  `id_gudang` int(11) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('belum','sudah') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang_masuk_tanpa_harga`
--

INSERT INTO `tbl_barang_masuk_tanpa_harga` (`id_barang_masuk`, `id_barang`, `qty`, `id_gudang`, `tgl`, `status`) VALUES
(2, 33, 5, 1, '2020-04-05 13:27:27', 'sudah'),
(3, 33, 4, 1, '2020-04-05 13:27:30', 'sudah'),
(4, 33, 5, 2, '2020-04-05 11:08:08', 'sudah'),
(5, 119, 5, 2, '2020-04-05 11:06:46', 'sudah'),
(6, 42, 5, 1, '2020-04-05 12:38:51', 'sudah'),
(7, 42, 10, 1, '2020-04-05 13:04:55', 'sudah'),
(8, 74, 5, 1, '2020-04-05 13:27:31', 'sudah'),
(9, 106, 12, 1, '2020-04-06 09:41:02', 'belum'),
(10, 10, 2, 2, '2020-04-06 09:49:24', 'sudah'),
(11, 42, 10, 1, '2020-04-06 09:46:25', 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_return`
--

CREATE TABLE `tbl_barang_return` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `uang_kembali` double NOT NULL,
  `nama` varchar(222) NOT NULL,
  `hp` int(11) NOT NULL,
  `ket` varchar(222) NOT NULL,
  `tgl_trx` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_pelanggan` int(11) NOT NULL,
  `kondisi` enum('rusak','baik') NOT NULL,
  `id_gudang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang_return`
--

INSERT INTO `tbl_barang_return` (`id`, `id_barang`, `jumlah`, `uang_kembali`, `nama`, `hp`, `ket`, `tgl_trx`, `id_pelanggan`, `kondisi`, `id_gudang`) VALUES
(1, 65, 2, 100000, '', 0, 'Coba return', '2020-04-06 12:33:27', 1, 'baik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang_transaksi`
--

CREATE TABLE `tbl_barang_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `harga_beli` double NOT NULL,
  `grup_penjualan` char(50) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_pembeli` varchar(222) NOT NULL,
  `hp_pembeli` varchar(222) NOT NULL,
  `nama_packing` varchar(222) NOT NULL,
  `satuan_jual` varchar(222) NOT NULL COMMENT 'enum(''retail'', ''lusin'', ''koli'')',
  `harga_jual` double NOT NULL,
  `diskon` double NOT NULL,
  `bayar` double NOT NULL,
  `sub_total_jual` double NOT NULL,
  `qty_jual` int(11) NOT NULL,
  `jum_per_koli` int(11) NOT NULL,
  `tgl_trx_manual` datetime NOT NULL,
  `keterangan` varchar(222) NOT NULL,
  `sub_total_beli` double NOT NULL,
  `transport_ke_ekspedisi` double NOT NULL,
  `harga_ekspedisi` double NOT NULL,
  `nama_ekspedisi` varchar(222) NOT NULL,
  `id_gudang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang_transaksi`
--

INSERT INTO `tbl_barang_transaksi` (`id_transaksi`, `jumlah`, `jenis`, `id_barang`, `tgl_transaksi`, `harga_beli`, `grup_penjualan`, `id_admin`, `id_pelanggan`, `nama_pembeli`, `hp_pembeli`, `nama_packing`, `satuan_jual`, `harga_jual`, `diskon`, `bayar`, `sub_total_jual`, `qty_jual`, `jum_per_koli`, `tgl_trx_manual`, `keterangan`, `sub_total_beli`, `transport_ke_ekspedisi`, `harga_ekspedisi`, `nama_ekspedisi`, `id_gudang`) VALUES
(1, 5, 'masuk', 119, '2020-04-05 11:06:46', 50000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 2),
(2, 5, 'masuk', 33, '2020-04-05 11:08:08', 52000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 2),
(3, 5, 'masuk', 42, '2020-04-05 12:38:51', 20000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 1),
(4, 10, 'masuk', 42, '2020-04-05 13:04:55', 20000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 1),
(5, 5, 'masuk', 33, '2020-04-05 13:27:27', 52000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 1),
(6, 4, 'masuk', 33, '2020-04-05 13:27:30', 52000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 1),
(7, 5, 'masuk', 74, '2020-04-05 13:27:31', 30000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 1),
(8, 2, 'masuk', 10, '2020-04-06 09:49:24', 100000, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 2),
(9, 1, 'keluar', 10, '2020-04-06 09:54:43', 100000, '200406165346', 1, 1, 'samuel', '02348243842482', '', 'retail', 135000, 0, 160000, 135000, 1, 20, '2020-04-06 16:53:46', '', 100000, 5000, 15000, 'TIKI', 0),
(10, 1, 'keluar', 102, '2020-04-06 10:32:13', 80000, '200406173117', 1, 1, 'samuel', '02348243842482', '', 'retail', 90000, 0, 400000, 90000, 1, 20, '2020-04-06 17:31:17', '', 80000, 5000, 12000, 'JNE', 0),
(11, 2, 'keluar', 52, '2020-04-06 10:32:13', 25000, '200406173117', 1, 1, 'samuel', '02348243842482', '', 'retail', 30000, 0, 400000, 60000, 2, 20, '2020-04-06 17:31:17', '', 50000, 5000, 12000, 'JNE', 0),
(12, 4, 'keluar', 112, '2020-04-06 10:32:13', 35000, '200406173117', 1, 1, 'samuel', '02348243842482', '', 'retail', 45000, 0, 400000, 180000, 4, 20, '2020-04-06 17:31:17', '', 140000, 5000, 12000, 'JNE', 0),
(13, 5, 'keluar', 74, '2020-04-06 11:54:23', 30000, '200406185344', 1, 1, 'samuel', '02348243842482', '', 'retail', 46000, 50000, 202000, 230000, 5, 20, '2020-04-06 18:53:44', '', 150000, 10000, 12000, 'JNE', 0),
(14, 2, 'masuk', 65, '2020-04-06 12:33:27', 0, '', 0, 0, '', '', '', '', 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ekspedisi`
--

CREATE TABLE `tbl_ekspedisi` (
  `id_ekspedisi` int(11) NOT NULL,
  `nama_ekspedisi` varchar(222) NOT NULL,
  `harga_ekspedisi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ekspedisi`
--

INSERT INTO `tbl_ekspedisi` (`id_ekspedisi`, `nama_ekspedisi`, `harga_ekspedisi`) VALUES
(1, 'JNE', 12000),
(2, 'TIKI', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group_transaksi`
--

CREATE TABLE `tbl_group_transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(222) NOT NULL,
  `jenis` enum('masuk','keluar') NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_group_transaksi`
--

INSERT INTO `tbl_group_transaksi` (`id`, `nama`, `jenis`, `urutan`) VALUES
(1, 'Pembelian Barang', 'keluar', 2),
(4, 'Pengeluaran Bulanan', 'keluar', 10),
(5, 'Kas Awal/Modal', 'masuk', 1),
(6, 'Return Barang', 'keluar', 5),
(8, 'Penjualan Barang', 'masuk', 6),
(9, 'Diskon', 'keluar', 7),
(11, 'Penarikan Kas Oleh Owner', 'keluar', 11),
(12, 'Koreksi', 'masuk', 12),
(13, 'Ekspedisi', 'masuk', 13),
(14, 'Transport ke ekspedisi', 'masuk', 14),
(15, 'Ekspedisi Keluar', 'keluar', 15),
(16, 'Transport Keluar', 'keluar', 16),
(17, 'Utang', 'keluar', 17),
(18, 'Piutang', 'masuk', 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_gudang`
--

CREATE TABLE `tbl_gudang` (
  `id_gudang` int(11) NOT NULL,
  `nama_gudang` varchar(222) NOT NULL,
  `reminder` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_gudang`
--

INSERT INTO `tbl_gudang` (`id_gudang`, `nama_gudang`, `reminder`) VALUES
(1, 'Gudang Toko', 12),
(2, 'Gudang A', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pembeli` varchar(222) NOT NULL,
  `email_pembeli` varchar(222) NOT NULL,
  `hp_pembeli` varchar(55) NOT NULL,
  `tgl_daftar` datetime NOT NULL,
  `tgl_trx_terakhir` datetime NOT NULL,
  `saldo` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id_pelanggan`, `nama_pembeli`, `email_pembeli`, `hp_pembeli`, `tgl_daftar`, `tgl_trx_terakhir`, `saldo`) VALUES
(1, 'samuel', 'djsamm88@gmail.com', '02348243842482', '2020-04-03 16:47:46', '2020-04-06 18:54:23', -5000),
(2, 'Jony', 'djsamm88@gmail.com', '1200000', '2020-04-03 17:02:11', '2020-04-04 01:10:13', 10000),
(3, 'Budy', '', '082277109994', '0000-00-00 00:00:00', '2020-04-03 23:56:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran_bulanan`
--

CREATE TABLE `tbl_pengeluaran_bulanan` (
  `id` int(11) NOT NULL,
  `nama_pengeluaran` varchar(222) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengeluaran_bulanan`
--

INSERT INTO `tbl_pengeluaran_bulanan` (`id`, `nama_pengeluaran`, `tgl_update`) VALUES
(1, 'Gaji karyawan', '2019-02-10 22:17:18'),
(2, 'Air', '2019-02-10 22:17:24'),
(3, 'Listrik', '2019-02-10 22:17:34'),
(4, 'Pengeluaran lainnya', '2019-02-10 22:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran_bulanan_transaksi`
--

CREATE TABLE `tbl_pengeluaran_bulanan_transaksi` (
  `id` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_pengeluaran` varchar(222) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengeluaran_bulanan_transaksi`
--

INSERT INTO `tbl_pengeluaran_bulanan_transaksi` (`id`, `jumlah`, `tgl_update`, `nama_pengeluaran`, `keterangan`) VALUES
(3, 10000, '2020-01-26 08:07:42', 'Air', 'Bayar air');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran_transaksi`
--

CREATE TABLE `tbl_pengeluaran_transaksi` (
  `id` int(11) NOT NULL,
  `id_paket` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nama_pengeluaran` varchar(222) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` int(11) NOT NULL,
  `id_group` char(50) NOT NULL,
  `id_referensi` char(50) NOT NULL COMMENT 'id_group/id_table',
  `keterangan` text NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jumlah` double NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `diskon` double NOT NULL,
  `nama_ekspedisi` varchar(222) NOT NULL,
  `harga_ekspedisi` double NOT NULL,
  `transport_ke_ekspedisi` double NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `url_bukti` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id`, `id_group`, `id_referensi`, `keterangan`, `tgl_update`, `jumlah`, `id_barang`, `harga_beli`, `diskon`, `nama_ekspedisi`, `harga_ekspedisi`, `transport_ke_ekspedisi`, `id_pelanggan`, `url_bukti`) VALUES
(1, '1', '1', 'Barang masuk id[33] qty=[5], harga[52000]', '2020-04-05 06:39:34', 260000, 33, 0, 0, '', 0, 0, 0, ''),
(2, '1', '1', 'Barang masuk id[119] qty=[5], harga[50000]', '2020-04-05 11:06:46', 250000, 119, 0, 0, '', 0, 0, 0, ''),
(3, '1', '2', 'Barang masuk id[33] qty=[5], harga[52000]', '2020-04-05 11:08:08', 260000, 33, 0, 0, '', 0, 0, 0, ''),
(4, '1', '3', 'Barang masuk id[42] qty=[5], harga[20000]', '2020-04-05 12:38:51', 100000, 42, 0, 0, '', 0, 0, 0, ''),
(5, '1', '4', 'Barang masuk id[42] qty=[10], harga[20000]', '2020-04-05 13:04:55', 200000, 42, 0, 0, '', 0, 0, 0, ''),
(6, '1', '5', 'Barang masuk id[33] qty=[5], harga[52000]', '2020-04-05 13:27:27', 260000, 33, 0, 0, '', 0, 0, 0, ''),
(7, '1', '6', 'Barang masuk id[33] qty=[4], harga[52000]', '2020-04-05 13:27:30', 208000, 33, 0, 0, '', 0, 0, 0, ''),
(8, '1', '7', 'Barang masuk id[74] qty=[5], harga[30000]', '2020-04-05 13:27:31', 150000, 74, 0, 0, '', 0, 0, 0, ''),
(9, '1', '8', 'Barang masuk id[10] qty=[2], harga[100000]', '2020-04-06 09:49:24', 200000, 10, 0, 0, '', 0, 0, 0, ''),
(10, '8', '200406165346', 'Kpd: [samuel] - Kode TRX:[200406165346] \n				Jumlah:[135.000] \n				diskon:[0] \n				harga_ekspedisi:[15000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 09:54:43', 135000, 0, 100000, 0, '', 15000, 5000, 1, ''),
(11, '14', '200406165346', 'Kpd: [samuel] - Kode TRX:[200406165346] \n				Jumlah:[135.000] \n				diskon:[0] \n				harga_ekspedisi:[15000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 09:54:43', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(12, '13', '200406165346', 'Kpd: [samuel] - Kode TRX:[200406165346] \n				Jumlah:[135.000] \n				diskon:[0] \n				harga_ekspedisi:[15000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 09:54:43', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(13, '16', '200406165346', 'Kpd: [samuel] - Kode TRX:[200406165346] \n				Jumlah:[135.000] \n				diskon:[0] \n				harga_ekspedisi:[15000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 09:54:43', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(14, '15', '200406165346', 'Kpd: [samuel] - Kode TRX:[200406165346] \n				Jumlah:[135.000] \n				diskon:[0] \n				harga_ekspedisi:[15000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 09:54:43', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(15, '8', '200406173117', 'Kpd: [samuel] - Kode TRX:[200406173117] \n				Jumlah:[330.000] \n				diskon:[0] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 10:32:13', 330000, 0, 270000, 0, '', 12000, 5000, 1, ''),
(16, '14', '200406173117', 'Kpd: [samuel] - Kode TRX:[200406173117] \n				Jumlah:[330.000] \n				diskon:[0] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 10:32:13', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(17, '13', '200406173117', 'Kpd: [samuel] - Kode TRX:[200406173117] \n				Jumlah:[330.000] \n				diskon:[0] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 10:32:13', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(18, '16', '200406173117', 'Kpd: [samuel] - Kode TRX:[200406173117] \n				Jumlah:[330.000] \n				diskon:[0] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 10:32:13', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(19, '15', '200406173117', 'Kpd: [samuel] - Kode TRX:[200406173117] \n				Jumlah:[330.000] \n				diskon:[0] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[5.000] \n				', '2020-04-06 10:32:13', 5000, 0, 0, 0, '', 0, 0, 0, ''),
(27, '17', '', 'coba tambah utang - A.n : samuel - ID :1', '2020-04-06 11:31:30', 10000, 0, 0, 0, '', 0, 0, 1, '1586172690.jpeg'),
(29, '18', '', 'ini misalnya coba tambah saldo - A.n : Jony - ID :2', '2020-04-06 11:32:51', 10000, 0, 0, 0, '', 0, 0, 2, '1586172771.png'),
(30, '18', '', 'Coba utang lagi - A.n : samuel - ID :1', '2020-04-06 11:34:32', 5000, 0, 0, 0, '', 0, 0, 1, '1586172872.png'),
(31, '8', '200406185344', 'Kpd: [samuel] - Kode TRX:[200406185344] \n				Jumlah:[230.000] \n				diskon:[50.000] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[10.000] \n				', '2020-04-06 11:54:23', 230000, 0, 150000, 50000, '', 12000, 10000, 1, ''),
(32, '9', '200406185344', 'Kpd: [samuel] - Kode TRX:[200406185344] \n				Jumlah:[230.000] \n				diskon:[50.000] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[10.000] \n				', '2020-04-06 11:54:23', 50000, 0, 0, 0, '', 0, 0, 0, ''),
(33, '14', '200406185344', 'Kpd: [samuel] - Kode TRX:[200406185344] \n				Jumlah:[230.000] \n				diskon:[50.000] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[10.000] \n				', '2020-04-06 11:54:23', 10000, 0, 0, 0, '', 0, 0, 0, ''),
(34, '13', '200406185344', 'Kpd: [samuel] - Kode TRX:[200406185344] \n				Jumlah:[230.000] \n				diskon:[50.000] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[10.000] \n				', '2020-04-06 11:54:23', 10000, 0, 0, 0, '', 0, 0, 0, ''),
(35, '16', '200406185344', 'Kpd: [samuel] - Kode TRX:[200406185344] \n				Jumlah:[230.000] \n				diskon:[50.000] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[10.000] \n				', '2020-04-06 11:54:23', 10000, 0, 0, 0, '', 0, 0, 0, ''),
(36, '15', '200406185344', 'Kpd: [samuel] - Kode TRX:[200406185344] \n				Jumlah:[230.000] \n				diskon:[50.000] \n				harga_ekspedisi:[12000] \n				transport_ke_ekspedisi:[10.000] \n				', '2020-04-06 11:54:23', 10000, 0, 0, 0, '', 0, 0, 0, ''),
(37, '6', '65', 'Kpd: [id_pelanggan:1] nama barang: [PEMERAS JERUK] id_barang:[65] Jumlah:[2]  -Coba return', '2020-04-06 12:33:27', 100000, 0, 0, 0, '', 0, 0, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang_masuk_tanpa_harga`
--
ALTER TABLE `tbl_barang_masuk_tanpa_harga`
  ADD PRIMARY KEY (`id_barang_masuk`);

--
-- Indexes for table `tbl_barang_return`
--
ALTER TABLE `tbl_barang_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang_transaksi`
--
ALTER TABLE `tbl_barang_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `tbl_ekspedisi`
--
ALTER TABLE `tbl_ekspedisi`
  ADD PRIMARY KEY (`id_ekspedisi`);

--
-- Indexes for table `tbl_group_transaksi`
--
ALTER TABLE `tbl_group_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_gudang`
--
ALTER TABLE `tbl_gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `tbl_pengeluaran_bulanan`
--
ALTER TABLE `tbl_pengeluaran_bulanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pengeluaran_bulanan_transaksi`
--
ALTER TABLE `tbl_pengeluaran_bulanan_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pengeluaran_transaksi`
--
ALTER TABLE `tbl_pengeluaran_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `tbl_barang_masuk_tanpa_harga`
--
ALTER TABLE `tbl_barang_masuk_tanpa_harga`
  MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_barang_return`
--
ALTER TABLE `tbl_barang_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_barang_transaksi`
--
ALTER TABLE `tbl_barang_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_ekspedisi`
--
ALTER TABLE `tbl_ekspedisi`
  MODIFY `id_ekspedisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_group_transaksi`
--
ALTER TABLE `tbl_group_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_gudang`
--
ALTER TABLE `tbl_gudang`
  MODIFY `id_gudang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran_bulanan`
--
ALTER TABLE `tbl_pengeluaran_bulanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran_bulanan_transaksi`
--
ALTER TABLE `tbl_pengeluaran_bulanan_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran_transaksi`
--
ALTER TABLE `tbl_pengeluaran_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
