-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2018 at 07:14 PM
-- Server version: 5.5.60-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventara_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaction_id_event`
--

CREATE TABLE `detail_transaction_id_event` (
  `id` int(8) NOT NULL,
  `id_transaction` varchar(8) DEFAULT NULL,
  `id_form_participant` int(5) DEFAULT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `harga` int(8) DEFAULT NULL,
  `validasi` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaction_id_event`
--

INSERT INTO `detail_transaction_id_event` (`id`, `id_transaction`, `id_form_participant`, `id_kategori`, `harga`, `validasi`) VALUES
(1, '080001', 1, 1, 10000, NULL),
(2, '080001', 2, 1, 10000, NULL),
(3, '080002', 3, 1, 10000, NULL),
(4, '080003', 4, 1, 10000, NULL),
(5, '080003', 5, 1, 10000, NULL),
(6, '080004', 6, 1, 10000, NULL),
(7, '080004', 7, 1, 10000, NULL),
(8, '080005', 8, 1, 10000, NULL),
(9, '080005', 9, 1, 10000, NULL),
(10, '080005', 10, 1, 10000, NULL),
(11, '080005', 11, 1, 10000, NULL),
(12, '080006', 12, 1, 10000, NULL),
(13, '080006', 13, 2, 10000, NULL),
(14, '080007', 14, 1, 10000, NULL),
(15, '080007', 15, 1, 10000, NULL),
(16, '080008', 16, 1, 10000, NULL),
(17, '080008', 17, 1, 10000, NULL),
(18, '080009', 18, 1, 10000, NULL),
(19, '080010', 19, 1, 10000, NULL),
(20, '080010', 20, 1, 10000, NULL),
(21, '080011', 21, 1, 10000, NULL),
(22, '080012', 22, 1, 10000, NULL),
(23, '080013', 23, 1, 10000, NULL),
(24, '080013', 24, 1, 10000, NULL),
(25, '080014', 25, 1, 10000, NULL),
(26, '080015', 26, 1, 10000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id` int(11) NOT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `potongan` int(11) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`id`, `kode`, `potongan`, `jenis`, `id_group`, `id_kategori`, `id_event`) VALUES
(1, 'MAKINMURAH', 1000, 1, NULL, NULL, 1),
(2, 'MURAHBANGET', 20, 2, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `early_bird`
--

CREATE TABLE `early_bird` (
  `id` int(5) NOT NULL,
  `id_kategori` int(5) DEFAULT NULL,
  `harga` int(6) DEFAULT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `kuota` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_medical`
--

CREATE TABLE `emergency_medical` (
  `id` int(8) NOT NULL,
  `id_personal_detail` int(8) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `kondisi_kesehatan` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency_medical`
--

INSERT INTO `emergency_medical` (`id`, `id_personal_detail`, `nama`, `nohp`, `kondisi_kesehatan`) VALUES
(1, 2, 'Bapak', '0812', 'ok'),
(2, 3, 'OK', '012', 'as'),
(3, 6, 'Bayu', '08912', 'OK'),
(4, 10, 'CENG HONG', '081222224440', 'Sehat'),
(5, 8, 'YASNO', '0811272909', 'Sehat'),
(6, 13, 'Saputra', '085695555430', 'SEHAT');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(5) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_kota` int(3) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `nama`, `tanggal`, `id_kota`, `logo`) VALUES
(1, 'Marathon Museum Angkot 2019', '2019-01-06', 3579, 'https://drive.thunder.id/file/public/2/7/2018/01/26/15/Movie%20Star%20Run%202018%20LariKu.info.jpg'),
(2, 'Nice Season Spektra', '2019-02-02', 3579, 'https://tripleasport.com/wp-content/uploads/2016/08/IMG_0597.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_detail`
--

CREATE TABLE `event_detail` (
  `id` int(5) NOT NULL,
  `id_event` int(5) DEFAULT NULL,
  `status_registrasi` int(1) DEFAULT '0' COMMENT '(0=close,1=open)',
  `deskripsi` text,
  `website` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_detail`
--

INSERT INTO `event_detail` (`id`, `id_event`, `status_registrasi`, `deskripsi`, `website`) VALUES
(1, 1, 1, 'MOVIE STAR RUN Museum Angkut Kota Wisata Batu Pengen tahu gimana serunya Runnning sambil ditemenin Movie Stars ala Red Carpet di Museum Terbaik di Indonesia', ''),
(2, 2, 1, 'Nice Season Spektra mengajak anda untuk ikut terlibat dengan suasana sejuk pegunungan panderman, dan menuju ke wisata apel', '');

-- --------------------------------------------------------

--
-- Table structure for table `event_term`
--

CREATE TABLE `event_term` (
  `id` int(5) NOT NULL,
  `deskripsi` text,
  `id_event` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_term`
--

INSERT INTO `event_term` (`id`, `deskripsi`, `id_event`) VALUES
(1, '', 1),
(2, 'ini deskripsi nice run', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(5) NOT NULL,
  `deskripsi` text,
  `id_event` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `deskripsi`, `id_event`) VALUES
(1, '<p>Fasilitas yang didapat :</p>\n\n<ol>\n	<li>Medali All Finisher</li>\n	<li>Sertifikat</li>\n	<li>Jersey</li>\n	<li>Merchandice Sponsor</li>\n</ol>\n', 1),
(2, 'Ini Deskrispi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `form_participant_id_event`
--

CREATE TABLE `form_participant_id_event` (
  `id` int(8) NOT NULL,
  `id_personal_detail` int(8) DEFAULT NULL,
  `nama_bib` varchar(200) DEFAULT NULL,
  `best_time` varchar(10) DEFAULT NULL,
  `url_best_time` varchar(200) DEFAULT NULL,
  `id_ukuran_jersey` int(2) DEFAULT NULL,
  `makan` int(1) DEFAULT '0' COMMENT '0=Tidak, 1=Ya',
  `kode_validate` int(10) DEFAULT NULL COMMENT 'diisikan hanya saat pembayaran sudah valid bersifat unik'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_participant_id_event`
--

INSERT INTO `form_participant_id_event` (`id`, `id_personal_detail`, `nama_bib`, `best_time`, `url_best_time`, `id_ukuran_jersey`, `makan`, `kode_validate`) VALUES
(1, 8, 'HENDRA', NULL, NULL, 2, 0, NULL),
(2, 9, 'OCHIE', NULL, NULL, 3, 0, NULL),
(3, 10, 'WIDYA', NULL, NULL, 3, 0, NULL),
(4, 12, 'OK', NULL, NULL, 3, 0, NULL),
(5, 11, 'OK', NULL, NULL, 2, 0, NULL),
(6, 12, 'OK', NULL, NULL, 3, 0, NULL),
(7, 11, 'OK', NULL, NULL, 2, 0, NULL),
(8, 11, 'OK', NULL, NULL, 1, 0, NULL),
(9, 12, 'A', NULL, NULL, 2, 0, NULL),
(10, 11, 'OK', NULL, NULL, 1, 0, NULL),
(11, 12, 'A', NULL, NULL, 2, 0, NULL),
(12, 11, 'A', NULL, NULL, 1, 0, NULL),
(13, 12, NULL, NULL, NULL, 2, 0, NULL),
(14, 11, 'A', NULL, NULL, 1, 0, NULL),
(15, 12, 'A012', NULL, NULL, 1, 0, NULL),
(16, 11, 'o', NULL, NULL, 1, 0, NULL),
(17, 12, '098', NULL, NULL, 1, 0, NULL),
(18, 11, 'DSA', NULL, NULL, 1, 0, NULL),
(19, 11, 'hehe', NULL, NULL, 1, 0, NULL),
(20, 12, 'bd', NULL, NULL, 2, 0, NULL),
(21, 12, 'DSA', NULL, NULL, 1, 0, NULL),
(22, 13, 'WINDA', NULL, NULL, 3, 0, NULL),
(23, 13, 'WIDYA', NULL, NULL, 3, 0, NULL),
(24, 14, 'BUDI', NULL, NULL, 2, 0, NULL),
(25, 8, 'HENDRA', NULL, NULL, 2, 0, NULL),
(26, 8, 'HENDRA', NULL, NULL, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(5) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `id_event` int(5) DEFAULT NULL,
  `status` int(1) DEFAULT '0' COMMENT '0=Tidak Aktif, 1=Aktif',
  `nationality` int(1) DEFAULT '0' COMMENT '0=Open,1=Indonesia'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `nama`, `id_event`, `status`, `nationality`) VALUES
(1, '5K', 1, 1, 0),
(2, '10K', 1, 1, 0),
(3, '21K', 1, 1, 0),
(4, '5k', 2, 1, 1),
(5, '10K', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bayar`
--

CREATE TABLE `jenis_bayar` (
  `id` int(5) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(5) NOT NULL DEFAULT '0',
  `nama` varchar(200) DEFAULT NULL,
  `id_group` int(1) DEFAULT NULL,
  `harga` int(6) DEFAULT NULL,
  `usia_min` int(2) DEFAULT NULL COMMENT '0=tdk ada batas minimal usia',
  `usia_max` int(3) DEFAULT NULL COMMENT '0=tdk ada batas maksimal usia',
  `deskripsi` text,
  `kuota` int(5) DEFAULT NULL COMMENT '0=Unlimited'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `id_group`, `harga`, `usia_min`, `usia_max`, `deskripsi`, `kuota`) VALUES
(1, 'Lari 5Km', 1, 10000, 15, 50, NULL, 400),
(2, 'Lari 10Km', 2, 10000, 17, 50, NULL, 400),
(3, 'Family 5K', 4, 10000, 17, 50, NULL, 250);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id` int(6) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `id_provinsi` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id`, `nama`, `id_provinsi`) VALUES
(1101, 'KABUPATEN SIMEULUE', 11),
(1102, 'KABUPATEN ACEH SINGKIL', 11),
(1103, 'KABUPATEN ACEH SELATAN', 11),
(1104, 'KABUPATEN ACEH TENGGARA', 11),
(1105, 'KABUPATEN ACEH TIMUR', 11),
(1106, 'KABUPATEN ACEH TENGAH', 11),
(1107, 'KABUPATEN ACEH BARAT', 11),
(1108, 'KABUPATEN ACEH BESAR', 11),
(1109, 'KABUPATEN PIDIE', 11),
(1110, 'KABUPATEN BIREUEN', 11),
(1111, 'KABUPATEN ACEH UTARA', 11),
(1112, 'KABUPATEN ACEH BARAT DAYA', 11),
(1113, 'KABUPATEN GAYO LUES', 11),
(1114, 'KABUPATEN ACEH TAMIANG', 11),
(1115, 'KABUPATEN NAGAN RAYA', 11),
(1116, 'KABUPATEN ACEH JAYA', 11),
(1117, 'KABUPATEN BENER MERIAH', 11),
(1118, 'KABUPATEN PIDIE JAYA', 11),
(1171, 'KOTA BANDA ACEH', 11),
(1172, 'KOTA SABANG', 11),
(1173, 'KOTA LANGSA', 11),
(1174, 'KOTA LHOKSEUMAWE', 11),
(1175, 'KOTA SUBULUSSALAM', 11),
(1201, 'KABUPATEN NIAS', 12),
(1202, 'KABUPATEN MANDAILING NATAL', 12),
(1203, 'KABUPATEN TAPANULI SELATAN', 12),
(1204, 'KABUPATEN TAPANULI TENGAH', 12),
(1205, 'KABUPATEN TAPANULI UTARA', 12),
(1206, 'KABUPATEN TOBA SAMOSIR', 12),
(1207, 'KABUPATEN LABUHAN BATU', 12),
(1208, 'KABUPATEN ASAHAN', 12),
(1209, 'KABUPATEN SIMALUNGUN', 12),
(1210, 'KABUPATEN DAIRI', 12),
(1211, 'KABUPATEN KARO', 12),
(1212, 'KABUPATEN DELI SERDANG', 12),
(1213, 'KABUPATEN LANGKAT', 12),
(1214, 'KABUPATEN NIAS SELATAN', 12),
(1215, 'KABUPATEN HUMBANG HASUNDUTAN', 12),
(1216, 'KABUPATEN PAKPAK BHARAT', 12),
(1217, 'KABUPATEN SAMOSIR', 12),
(1218, 'KABUPATEN SERDANG BEDAGAI', 12),
(1219, 'KABUPATEN BATU BARA', 12),
(1220, 'KABUPATEN PADANG LAWAS UTARA', 12),
(1221, 'KABUPATEN PADANG LAWAS', 12),
(1222, 'KABUPATEN LABUHAN BATU SELATAN', 12),
(1223, 'KABUPATEN LABUHAN BATU UTARA', 12),
(1224, 'KABUPATEN NIAS UTARA', 12),
(1225, 'KABUPATEN NIAS BARAT', 12),
(1271, 'KOTA SIBOLGA', 12),
(1272, 'KOTA TANJUNG BALAI', 12),
(1273, 'KOTA PEMATANG SIANTAR', 12),
(1274, 'KOTA TEBING TINGGI', 12),
(1275, 'KOTA MEDAN', 12),
(1276, 'KOTA BINJAI', 12),
(1277, 'KOTA PADANGSIDIMPUAN', 12),
(1278, 'KOTA GUNUNGSITOLI', 12),
(1301, 'KABUPATEN KEPULAUAN MENTAWAI', 13),
(1302, 'KABUPATEN PESISIR SELATAN', 13),
(1303, 'KABUPATEN SOLOK', 13),
(1304, 'KABUPATEN SIJUNJUNG', 13),
(1305, 'KABUPATEN TANAH DATAR', 13),
(1306, 'KABUPATEN PADANG PARIAMAN', 13),
(1307, 'KABUPATEN AGAM', 13),
(1308, 'KABUPATEN LIMA PULUH KOTA', 13),
(1309, 'KABUPATEN PASAMAN', 13),
(1310, 'KABUPATEN SOLOK SELATAN', 13),
(1311, 'KABUPATEN DHARMASRAYA', 13),
(1312, 'KABUPATEN PASAMAN BARAT', 13),
(1371, 'KOTA PADANG', 13),
(1372, 'KOTA SOLOK', 13),
(1373, 'KOTA SAWAH LUNTO', 13),
(1374, 'KOTA PADANG PANJANG', 13),
(1375, 'KOTA BUKITTINGGI', 13),
(1376, 'KOTA PAYAKUMBUH', 13),
(1377, 'KOTA PARIAMAN', 13),
(1401, 'KABUPATEN KUANTAN SINGINGI', 14),
(1402, 'KABUPATEN INDRAGIRI HULU', 14),
(1403, 'KABUPATEN INDRAGIRI HILIR', 14),
(1404, 'KABUPATEN PELALAWAN', 14),
(1405, 'KABUPATEN S I A K', 14),
(1406, 'KABUPATEN KAMPAR', 14),
(1407, 'KABUPATEN ROKAN HULU', 14),
(1408, 'KABUPATEN BENGKALIS', 14),
(1409, 'KABUPATEN ROKAN HILIR', 14),
(1410, 'KABUPATEN KEPULAUAN MERANTI', 14),
(1471, 'KOTA PEKANBARU', 14),
(1473, 'KOTA D U M A I', 14),
(1501, 'KABUPATEN KERINCI', 15),
(1502, 'KABUPATEN MERANGIN', 15),
(1503, 'KABUPATEN SAROLANGUN', 15),
(1504, 'KABUPATEN BATANG HARI', 15),
(1505, 'KABUPATEN MUARO JAMBI', 15),
(1506, 'KABUPATEN TANJUNG JABUNG TIMUR', 15),
(1507, 'KABUPATEN TANJUNG JABUNG BARAT', 15),
(1508, 'KABUPATEN TEBO', 15),
(1509, 'KABUPATEN BUNGO', 15),
(1571, 'KOTA JAMBI', 15),
(1572, 'KOTA SUNGAI PENUH', 15),
(1601, 'KABUPATEN OGAN KOMERING ULU', 16),
(1602, 'KABUPATEN OGAN KOMERING ILIR', 16),
(1603, 'KABUPATEN MUARA ENIM', 16),
(1604, 'KABUPATEN LAHAT', 16),
(1605, 'KABUPATEN MUSI RAWAS', 16),
(1606, 'KABUPATEN MUSI BANYUASIN', 16),
(1607, 'KABUPATEN BANYU ASIN', 16),
(1608, 'KABUPATEN OGAN KOMERING ULU SELATAN', 16),
(1609, 'KABUPATEN OGAN KOMERING ULU TIMUR', 16),
(1610, 'KABUPATEN OGAN ILIR', 16),
(1611, 'KABUPATEN EMPAT LAWANG', 16),
(1612, 'KABUPATEN PENUKAL ABAB LEMATANG ILIR', 16),
(1613, 'KABUPATEN MUSI RAWAS UTARA', 16),
(1671, 'KOTA PALEMBANG', 16),
(1672, 'KOTA PRABUMULIH', 16),
(1673, 'KOTA PAGAR ALAM', 16),
(1674, 'KOTA LUBUKLINGGAU', 16),
(1701, 'KABUPATEN BENGKULU SELATAN', 17),
(1702, 'KABUPATEN REJANG LEBONG', 17),
(1703, 'KABUPATEN BENGKULU UTARA', 17),
(1704, 'KABUPATEN KAUR', 17),
(1705, 'KABUPATEN SELUMA', 17),
(1706, 'KABUPATEN MUKOMUKO', 17),
(1707, 'KABUPATEN LEBONG', 17),
(1708, 'KABUPATEN KEPAHIANG', 17),
(1709, 'KABUPATEN BENGKULU TENGAH', 17),
(1771, 'KOTA BENGKULU', 17),
(1801, 'KABUPATEN LAMPUNG BARAT', 18),
(1802, 'KABUPATEN TANGGAMUS', 18),
(1803, 'KABUPATEN LAMPUNG SELATAN', 18),
(1804, 'KABUPATEN LAMPUNG TIMUR', 18),
(1805, 'KABUPATEN LAMPUNG TENGAH', 18),
(1806, 'KABUPATEN LAMPUNG UTARA', 18),
(1807, 'KABUPATEN WAY KANAN', 18),
(1808, 'KABUPATEN TULANGBAWANG', 18),
(1809, 'KABUPATEN PESAWARAN', 18),
(1810, 'KABUPATEN PRINGSEWU', 18),
(1811, 'KABUPATEN MESUJI', 18),
(1812, 'KABUPATEN TULANG BAWANG BARAT', 18),
(1813, 'KABUPATEN PESISIR BARAT', 18),
(1871, 'KOTA BANDAR LAMPUNG', 18),
(1872, 'KOTA METRO', 18),
(1901, 'KABUPATEN BANGKA', 19),
(1902, 'KABUPATEN BELITUNG', 19),
(1903, 'KABUPATEN BANGKA BARAT', 19),
(1904, 'KABUPATEN BANGKA TENGAH', 19),
(1905, 'KABUPATEN BANGKA SELATAN', 19),
(1906, 'KABUPATEN BELITUNG TIMUR', 19),
(1971, 'KOTA PANGKAL PINANG', 19),
(2101, 'KABUPATEN KARIMUN', 21),
(2102, 'KABUPATEN BINTAN', 21),
(2103, 'KABUPATEN NATUNA', 21),
(2104, 'KABUPATEN LINGGA', 21),
(2105, 'KABUPATEN KEPULAUAN ANAMBAS', 21),
(2171, 'KOTA B A T A M', 21),
(2172, 'KOTA TANJUNG PINANG', 21),
(3101, 'KABUPATEN KEPULAUAN SERIBU', 31),
(3171, 'KOTA JAKARTA SELATAN', 31),
(3172, 'KOTA JAKARTA TIMUR', 31),
(3173, 'KOTA JAKARTA PUSAT', 31),
(3174, 'KOTA JAKARTA BARAT', 31),
(3175, 'KOTA JAKARTA UTARA', 31),
(3201, 'KABUPATEN BOGOR', 32),
(3202, 'KABUPATEN SUKABUMI', 32),
(3203, 'KABUPATEN CIANJUR', 32),
(3204, 'KABUPATEN BANDUNG', 32),
(3205, 'KABUPATEN GARUT', 32),
(3206, 'KABUPATEN TASIKMALAYA', 32),
(3207, 'KABUPATEN CIAMIS', 32),
(3208, 'KABUPATEN KUNINGAN', 32),
(3209, 'KABUPATEN CIREBON', 32),
(3210, 'KABUPATEN MAJALENGKA', 32),
(3211, 'KABUPATEN SUMEDANG', 32),
(3212, 'KABUPATEN INDRAMAYU', 32),
(3213, 'KABUPATEN SUBANG', 32),
(3214, 'KABUPATEN PURWAKARTA', 32),
(3215, 'KABUPATEN KARAWANG', 32),
(3216, 'KABUPATEN BEKASI', 32),
(3217, 'KABUPATEN BANDUNG BARAT', 32),
(3218, 'KABUPATEN PANGANDARAN', 32),
(3271, 'KOTA BOGOR', 32),
(3272, 'KOTA SUKABUMI', 32),
(3273, 'KOTA BANDUNG', 32),
(3274, 'KOTA CIREBON', 32),
(3275, 'KOTA BEKASI', 32),
(3276, 'KOTA DEPOK', 32),
(3277, 'KOTA CIMAHI', 32),
(3278, 'KOTA TASIKMALAYA', 32),
(3279, 'KOTA BANJAR', 32),
(3301, 'KABUPATEN CILACAP', 33),
(3302, 'KABUPATEN BANYUMAS', 33),
(3303, 'KABUPATEN PURBALINGGA', 33),
(3304, 'KABUPATEN BANJARNEGARA', 33),
(3305, 'KABUPATEN KEBUMEN', 33),
(3306, 'KABUPATEN PURWOREJO', 33),
(3307, 'KABUPATEN WONOSOBO', 33),
(3308, 'KABUPATEN MAGELANG', 33),
(3309, 'KABUPATEN BOYOLALI', 33),
(3310, 'KABUPATEN KLATEN', 33),
(3311, 'KABUPATEN SUKOHARJO', 33),
(3312, 'KABUPATEN WONOGIRI', 33),
(3313, 'KABUPATEN KARANGANYAR', 33),
(3314, 'KABUPATEN SRAGEN', 33),
(3315, 'KABUPATEN GROBOGAN', 33),
(3316, 'KABUPATEN BLORA', 33),
(3317, 'KABUPATEN REMBANG', 33),
(3318, 'KABUPATEN PATI', 33),
(3319, 'KABUPATEN KUDUS', 33),
(3320, 'KABUPATEN JEPARA', 33),
(3321, 'KABUPATEN DEMAK', 33),
(3322, 'KABUPATEN SEMARANG', 33),
(3323, 'KABUPATEN TEMANGGUNG', 33),
(3324, 'KABUPATEN KENDAL', 33),
(3325, 'KABUPATEN BATANG', 33),
(3326, 'KABUPATEN PEKALONGAN', 33),
(3327, 'KABUPATEN PEMALANG', 33),
(3328, 'KABUPATEN TEGAL', 33),
(3329, 'KABUPATEN BREBES', 33),
(3371, 'KOTA MAGELANG', 33),
(3372, 'KOTA SURAKARTA', 33),
(3373, 'KOTA SALATIGA', 33),
(3374, 'KOTA SEMARANG', 33),
(3375, 'KOTA PEKALONGAN', 33),
(3376, 'KOTA TEGAL', 33),
(3401, 'KABUPATEN KULON PROGO', 34),
(3402, 'KABUPATEN BANTUL', 34),
(3403, 'KABUPATEN GUNUNG KIDUL', 34),
(3404, 'KABUPATEN SLEMAN', 34),
(3471, 'KOTA YOGYAKARTA', 34),
(3501, 'KABUPATEN PACITAN', 35),
(3502, 'KABUPATEN PONOROGO', 35),
(3503, 'KABUPATEN TRENGGALEK', 35),
(3504, 'KABUPATEN TULUNGAGUNG', 35),
(3505, 'KABUPATEN BLITAR', 35),
(3506, 'KABUPATEN KEDIRI', 35),
(3507, 'KABUPATEN MALANG', 35),
(3508, 'KABUPATEN LUMAJANG', 35),
(3509, 'KABUPATEN JEMBER', 35),
(3510, 'KABUPATEN BANYUWANGI', 35),
(3511, 'KABUPATEN BONDOWOSO', 35),
(3512, 'KABUPATEN SITUBONDO', 35),
(3513, 'KABUPATEN PROBOLINGGO', 35),
(3514, 'KABUPATEN PASURUAN', 35),
(3515, 'KABUPATEN SIDOARJO', 35),
(3516, 'KABUPATEN MOJOKERTO', 35),
(3517, 'KABUPATEN JOMBANG', 35),
(3518, 'KABUPATEN NGANJUK', 35),
(3519, 'KABUPATEN MADIUN', 35),
(3520, 'KABUPATEN MAGETAN', 35),
(3521, 'KABUPATEN NGAWI', 35),
(3522, 'KABUPATEN BOJONEGORO', 35),
(3523, 'KABUPATEN TUBAN', 35),
(3524, 'KABUPATEN LAMONGAN', 35),
(3525, 'KABUPATEN GRESIK', 35),
(3526, 'KABUPATEN BANGKALAN', 35),
(3527, 'KABUPATEN SAMPANG', 35),
(3528, 'KABUPATEN PAMEKASAN', 35),
(3529, 'KABUPATEN SUMENEP', 35),
(3571, 'KOTA KEDIRI', 35),
(3572, 'KOTA BLITAR', 35),
(3573, 'KOTA MALANG', 35),
(3574, 'KOTA PROBOLINGGO', 35),
(3575, 'KOTA PASURUAN', 35),
(3576, 'KOTA MOJOKERTO', 35),
(3577, 'KOTA MADIUN', 35),
(3578, 'KOTA SURABAYA', 35),
(3579, 'KOTA BATU', 35),
(3601, 'KABUPATEN PANDEGLANG', 36),
(3602, 'KABUPATEN LEBAK', 36),
(3603, 'KABUPATEN TANGERANG', 36),
(3604, 'KABUPATEN SERANG', 36),
(3671, 'KOTA TANGERANG', 36),
(3672, 'KOTA CILEGON', 36),
(3673, 'KOTA SERANG', 36),
(3674, 'KOTA TANGERANG SELATAN', 36),
(5101, 'KABUPATEN JEMBRANA', 51),
(5102, 'KABUPATEN TABANAN', 51),
(5103, 'KABUPATEN BADUNG', 51),
(5104, 'KABUPATEN GIANYAR', 51),
(5105, 'KABUPATEN KLUNGKUNG', 51),
(5106, 'KABUPATEN BANGLI', 51),
(5107, 'KABUPATEN KARANG ASEM', 51),
(5108, 'KABUPATEN BULELENG', 51),
(5171, 'KOTA DENPASAR', 51),
(5201, 'KABUPATEN LOMBOK BARAT', 52),
(5202, 'KABUPATEN LOMBOK TENGAH', 52),
(5203, 'KABUPATEN LOMBOK TIMUR', 52),
(5204, 'KABUPATEN SUMBAWA', 52),
(5205, 'KABUPATEN DOMPU', 52),
(5206, 'KABUPATEN BIMA', 52),
(5207, 'KABUPATEN SUMBAWA BARAT', 52),
(5208, 'KABUPATEN LOMBOK UTARA', 52),
(5271, 'KOTA MATARAM', 52),
(5272, 'KOTA BIMA', 52),
(5301, 'KABUPATEN SUMBA BARAT', 53),
(5302, 'KABUPATEN SUMBA TIMUR', 53),
(5303, 'KABUPATEN KUPANG', 53),
(5304, 'KABUPATEN TIMOR TENGAH SELATAN', 53),
(5305, 'KABUPATEN TIMOR TENGAH UTARA', 53),
(5306, 'KABUPATEN BELU', 53),
(5307, 'KABUPATEN ALOR', 53),
(5308, 'KABUPATEN LEMBATA', 53),
(5309, 'KABUPATEN FLORES TIMUR', 53),
(5310, 'KABUPATEN SIKKA', 53),
(5311, 'KABUPATEN ENDE', 53),
(5312, 'KABUPATEN NGADA', 53),
(5313, 'KABUPATEN MANGGARAI', 53),
(5314, 'KABUPATEN ROTE NDAO', 53),
(5315, 'KABUPATEN MANGGARAI BARAT', 53),
(5316, 'KABUPATEN SUMBA TENGAH', 53),
(5317, 'KABUPATEN SUMBA BARAT DAYA', 53),
(5318, 'KABUPATEN NAGEKEO', 53),
(5319, 'KABUPATEN MANGGARAI TIMUR', 53),
(5320, 'KABUPATEN SABU RAIJUA', 53),
(5321, 'KABUPATEN MALAKA', 53),
(5371, 'KOTA KUPANG', 53),
(6101, 'KABUPATEN SAMBAS', 61),
(6102, 'KABUPATEN BENGKAYANG', 61),
(6103, 'KABUPATEN LANDAK', 61),
(6104, 'KABUPATEN MEMPAWAH', 61),
(6105, 'KABUPATEN SANGGAU', 61),
(6106, 'KABUPATEN KETAPANG', 61),
(6107, 'KABUPATEN SINTANG', 61),
(6108, 'KABUPATEN KAPUAS HULU', 61),
(6109, 'KABUPATEN SEKADAU', 61),
(6110, 'KABUPATEN MELAWI', 61),
(6111, 'KABUPATEN KAYONG UTARA', 61),
(6112, 'KABUPATEN KUBU RAYA', 61),
(6171, 'KOTA PONTIANAK', 61),
(6172, 'KOTA SINGKAWANG', 61),
(6201, 'KABUPATEN KOTAWARINGIN BARAT', 62),
(6202, 'KABUPATEN KOTAWARINGIN TIMUR', 62),
(6203, 'KABUPATEN KAPUAS', 62),
(6204, 'KABUPATEN BARITO SELATAN', 62),
(6205, 'KABUPATEN BARITO UTARA', 62),
(6206, 'KABUPATEN SUKAMARA', 62),
(6207, 'KABUPATEN LAMANDAU', 62),
(6208, 'KABUPATEN SERUYAN', 62),
(6209, 'KABUPATEN KATINGAN', 62),
(6210, 'KABUPATEN PULANG PISAU', 62),
(6211, 'KABUPATEN GUNUNG MAS', 62),
(6212, 'KABUPATEN BARITO TIMUR', 62),
(6213, 'KABUPATEN MURUNG RAYA', 62),
(6271, 'KOTA PALANGKA RAYA', 62),
(6301, 'KABUPATEN TANAH LAUT', 63),
(6302, 'KABUPATEN KOTA BARU', 63),
(6303, 'KABUPATEN BANJAR', 63),
(6304, 'KABUPATEN BARITO KUALA', 63),
(6305, 'KABUPATEN TAPIN', 63),
(6306, 'KABUPATEN HULU SUNGAI SELATAN', 63),
(6307, 'KABUPATEN HULU SUNGAI TENGAH', 63),
(6308, 'KABUPATEN HULU SUNGAI UTARA', 63),
(6309, 'KABUPATEN TABALONG', 63),
(6310, 'KABUPATEN TANAH BUMBU', 63),
(6311, 'KABUPATEN BALANGAN', 63),
(6371, 'KOTA BANJARMASIN', 63),
(6372, 'KOTA BANJAR BARU', 63),
(6401, 'KABUPATEN PASER', 64),
(6402, 'KABUPATEN KUTAI BARAT', 64),
(6403, 'KABUPATEN KUTAI KARTANEGARA', 64),
(6404, 'KABUPATEN KUTAI TIMUR', 64),
(6405, 'KABUPATEN BERAU', 64),
(6409, 'KABUPATEN PENAJAM PASER UTARA', 64),
(6411, 'KABUPATEN MAHAKAM HULU', 64),
(6471, 'KOTA BALIKPAPAN', 64),
(6472, 'KOTA SAMARINDA', 64),
(6474, 'KOTA BONTANG', 64),
(6501, 'KABUPATEN MALINAU', 65),
(6502, 'KABUPATEN BULUNGAN', 65),
(6503, 'KABUPATEN TANA TIDUNG', 65),
(6504, 'KABUPATEN NUNUKAN', 65),
(6571, 'KOTA TARAKAN', 65),
(7101, 'KABUPATEN BOLAANG MONGONDOW', 71),
(7102, 'KABUPATEN MINAHASA', 71),
(7103, 'KABUPATEN KEPULAUAN SANGIHE', 71),
(7104, 'KABUPATEN KEPULAUAN TALAUD', 71),
(7105, 'KABUPATEN MINAHASA SELATAN', 71),
(7106, 'KABUPATEN MINAHASA UTARA', 71),
(7107, 'KABUPATEN BOLAANG MONGONDOW UTARA', 71),
(7108, 'KABUPATEN SIAU TAGULANDANG BIARO', 71),
(7109, 'KABUPATEN MINAHASA TENGGARA', 71),
(7110, 'KABUPATEN BOLAANG MONGONDOW SELATAN', 71),
(7111, 'KABUPATEN BOLAANG MONGONDOW TIMUR', 71),
(7171, 'KOTA MANADO', 71),
(7172, 'KOTA BITUNG', 71),
(7173, 'KOTA TOMOHON', 71),
(7174, 'KOTA KOTAMOBAGU', 71),
(7201, 'KABUPATEN BANGGAI KEPULAUAN', 72),
(7202, 'KABUPATEN BANGGAI', 72),
(7203, 'KABUPATEN MOROWALI', 72),
(7204, 'KABUPATEN POSO', 72),
(7205, 'KABUPATEN DONGGALA', 72),
(7206, 'KABUPATEN TOLI-TOLI', 72),
(7207, 'KABUPATEN BUOL', 72),
(7208, 'KABUPATEN PARIGI MOUTONG', 72),
(7209, 'KABUPATEN TOJO UNA-UNA', 72),
(7210, 'KABUPATEN SIGI', 72),
(7211, 'KABUPATEN BANGGAI LAUT', 72),
(7212, 'KABUPATEN MOROWALI UTARA', 72),
(7271, 'KOTA PALU', 72),
(7301, 'KABUPATEN KEPULAUAN SELAYAR', 73),
(7302, 'KABUPATEN BULUKUMBA', 73),
(7303, 'KABUPATEN BANTAENG', 73),
(7304, 'KABUPATEN JENEPONTO', 73),
(7305, 'KABUPATEN TAKALAR', 73),
(7306, 'KABUPATEN GOWA', 73),
(7307, 'KABUPATEN SINJAI', 73),
(7308, 'KABUPATEN MAROS', 73),
(7309, 'KABUPATEN PANGKAJENE DAN KEPULAUAN', 73),
(7310, 'KABUPATEN BARRU', 73),
(7311, 'KABUPATEN BONE', 73),
(7312, 'KABUPATEN SOPPENG', 73),
(7313, 'KABUPATEN WAJO', 73),
(7314, 'KABUPATEN SIDENRENG RAPPANG', 73),
(7315, 'KABUPATEN PINRANG', 73),
(7316, 'KABUPATEN ENREKANG', 73),
(7317, 'KABUPATEN LUWU', 73),
(7318, 'KABUPATEN TANA TORAJA', 73),
(7322, 'KABUPATEN LUWU UTARA', 73),
(7325, 'KABUPATEN LUWU TIMUR', 73),
(7326, 'KABUPATEN TORAJA UTARA', 73),
(7371, 'KOTA MAKASSAR', 73),
(7372, 'KOTA PAREPARE', 73),
(7373, 'KOTA PALOPO', 73),
(7401, 'KABUPATEN BUTON', 74),
(7402, 'KABUPATEN MUNA', 74),
(7403, 'KABUPATEN KONAWE', 74),
(7404, 'KABUPATEN KOLAKA', 74),
(7405, 'KABUPATEN KONAWE SELATAN', 74),
(7406, 'KABUPATEN BOMBANA', 74),
(7407, 'KABUPATEN WAKATOBI', 74),
(7408, 'KABUPATEN KOLAKA UTARA', 74),
(7409, 'KABUPATEN BUTON UTARA', 74),
(7410, 'KABUPATEN KONAWE UTARA', 74),
(7411, 'KABUPATEN KOLAKA TIMUR', 74),
(7412, 'KABUPATEN KONAWE KEPULAUAN', 74),
(7413, 'KABUPATEN MUNA BARAT', 74),
(7414, 'KABUPATEN BUTON TENGAH', 74),
(7415, 'KABUPATEN BUTON SELATAN', 74),
(7471, 'KOTA KENDARI', 74),
(7472, 'KOTA BAUBAU', 74),
(7501, 'KABUPATEN BOALEMO', 75),
(7502, 'KABUPATEN GORONTALO', 75),
(7503, 'KABUPATEN POHUWATO', 75),
(7504, 'KABUPATEN BONE BOLANGO', 75),
(7505, 'KABUPATEN GORONTALO UTARA', 75),
(7571, 'KOTA GORONTALO', 75),
(7601, 'KABUPATEN MAJENE', 76),
(7602, 'KABUPATEN POLEWALI MANDAR', 76),
(7603, 'KABUPATEN MAMASA', 76),
(7604, 'KABUPATEN MAMUJU', 76),
(7605, 'KABUPATEN MAMUJU UTARA', 76),
(7606, 'KABUPATEN MAMUJU TENGAH', 76),
(8101, 'KABUPATEN MALUKU TENGGARA BARAT', 81),
(8102, 'KABUPATEN MALUKU TENGGARA', 81),
(8103, 'KABUPATEN MALUKU TENGAH', 81),
(8104, 'KABUPATEN BURU', 81),
(8105, 'KABUPATEN KEPULAUAN ARU', 81),
(8106, 'KABUPATEN SERAM BAGIAN BARAT', 81),
(8107, 'KABUPATEN SERAM BAGIAN TIMUR', 81),
(8108, 'KABUPATEN MALUKU BARAT DAYA', 81),
(8109, 'KABUPATEN BURU SELATAN', 81),
(8171, 'KOTA AMBON', 81),
(8172, 'KOTA TUAL', 81),
(8201, 'KABUPATEN HALMAHERA BARAT', 82),
(8202, 'KABUPATEN HALMAHERA TENGAH', 82),
(8203, 'KABUPATEN KEPULAUAN SULA', 82),
(8204, 'KABUPATEN HALMAHERA SELATAN', 82),
(8205, 'KABUPATEN HALMAHERA UTARA', 82),
(8206, 'KABUPATEN HALMAHERA TIMUR', 82),
(8207, 'KABUPATEN PULAU MOROTAI', 82),
(8208, 'KABUPATEN PULAU TALIABU', 82),
(8271, 'KOTA TERNATE', 82),
(8272, 'KOTA TIDORE KEPULAUAN', 82),
(9101, 'KABUPATEN FAKFAK', 91),
(9102, 'KABUPATEN KAIMANA', 91),
(9103, 'KABUPATEN TELUK WONDAMA', 91),
(9104, 'KABUPATEN TELUK BINTUNI', 91),
(9105, 'KABUPATEN MANOKWARI', 91),
(9106, 'KABUPATEN SORONG SELATAN', 91),
(9107, 'KABUPATEN SORONG', 91),
(9108, 'KABUPATEN RAJA AMPAT', 91),
(9109, 'KABUPATEN TAMBRAUW', 91),
(9110, 'KABUPATEN MAYBRAT', 91),
(9111, 'KABUPATEN MANOKWARI SELATAN', 91),
(9112, 'KABUPATEN PEGUNUNGAN ARFAK', 91),
(9171, 'KOTA SORONG', 91),
(9401, 'KABUPATEN MERAUKE', 94),
(9402, 'KABUPATEN JAYAWIJAYA', 94),
(9403, 'KABUPATEN JAYAPURA', 94),
(9404, 'KABUPATEN NABIRE', 94),
(9408, 'KABUPATEN KEPULAUAN YAPEN', 94),
(9409, 'KABUPATEN BIAK NUMFOR', 94),
(9410, 'KABUPATEN PANIAI', 94),
(9411, 'KABUPATEN PUNCAK JAYA', 94),
(9412, 'KABUPATEN MIMIKA', 94),
(9413, 'KABUPATEN BOVEN DIGOEL', 94),
(9414, 'KABUPATEN MAPPI', 94),
(9415, 'KABUPATEN ASMAT', 94),
(9416, 'KABUPATEN YAHUKIMO', 94),
(9417, 'KABUPATEN PEGUNUNGAN BINTANG', 94),
(9418, 'KABUPATEN TOLIKARA', 94),
(9419, 'KABUPATEN SARMI', 94),
(9420, 'KABUPATEN KEEROM', 94),
(9426, 'KABUPATEN WAROPEN', 94),
(9427, 'KABUPATEN SUPIORI', 94),
(9428, 'KABUPATEN MAMBERAMO RAYA', 94),
(9429, 'KABUPATEN NDUGA', 94),
(9430, 'KABUPATEN LANNY JAYA', 94),
(9431, 'KABUPATEN MAMBERAMO TENGAH', 94),
(9432, 'KABUPATEN YALIMO', 94),
(9433, 'KABUPATEN PUNCAK', 94),
(9434, 'KABUPATEN DOGIYAI', 94),
(9435, 'KABUPATEN INTAN JAYA', 94),
(9436, 'KABUPATEN DEIYAI', 94),
(9471, 'KOTA JAYAPURA', 94);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `log` text,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) DEFAULT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `log`, `time`, `userid`, `ip_address`) VALUES
(30, 'User Checkout Transaksi #080014', '2018-08-31 08:52:52', 597036, ''),
(29, 'User Memasukan Kode Voucher MAKINMURAH | userid = 597036', '2018-08-31 08:52:49', NULL, ''),
(28, 'User Mengakses Halaman http://event.arayamedia.id/index.html', '2018-08-31 08:47:55', 597036, ''),
(27, 'User Mengakses Halaman http://event.arayamedia.id/index.html', '2018-08-31 08:47:52', 597036, ''),
(26, 'User Mengakses Halaman http://event.arayamedia.id/index.html', '2018-08-31 08:47:31', 597036, ''),
(25, 'User Mengakses Halaman http://event.arayamedia.id/index.html', '2018-08-31 08:37:13', 597036, ''),
(23, 'User Membuka Invoice Lain', '2018-08-31 08:35:22', NULL, ''),
(24, 'User Membuka Invoice Lain', '2018-08-31 08:35:39', NULL, ''),
(22, 'User Membuka Invoice Lain URL=http://event.arayamedia.id/trx/080010', '2018-08-31 08:34:46', 597036, ''),
(21, 'User Mengakses Halaman http://event.arayamedia.id/trx', '2018-08-31 08:26:16', 879738, ''),
(20, 'User Membuka Invoice Lain URL=http://event.arayamedia.id/trx/080011', '2018-08-31 08:17:51', 597036, ''),
(19, 'User Mengakses Halaman http://event.arayamedia.id/trx', '2018-08-31 08:17:40', 597036, ''),
(31, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-08-31 13:56:08', 879738, ''),
(32, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:16:15', NULL, ''),
(33, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:16:36', NULL, ''),
(34, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:17:34', NULL, ''),
(35, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:18:03', NULL, ''),
(36, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:19:12', NULL, ''),
(37, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:20:15', NULL, ''),
(38, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:20:43', NULL, ''),
(39, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:21:07', NULL, ''),
(40, 'Kirim Invoice Lunas ke  merahkode@gmail.com | kode = 080011', '2018-08-31 14:38:31', NULL, ''),
(41, 'User Membuka Invoice Lain', '2018-08-31 18:35:39', NULL, ''),
(42, 'User Membuka Invoice Lain', '2018-08-31 18:35:43', NULL, ''),
(43, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-08-31 23:17:27', 597036, ''),
(44, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-08-31 23:17:46', 597036, ''),
(45, 'User Register167215 | OK | IP =202.80.219.31', '2018-08-31 23:22:26', NULL, ''),
(46, 'User Checkout Transaksi #080015', '2018-08-31 23:32:22', 597036, ''),
(47, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-08-31 23:40:29', 167215, ''),
(48, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 14:52:14', 167215, '114.142.168.26'),
(49, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 14:52:18', 167215, '114.142.168.26'),
(50, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 14:52:34', 167215, '114.142.168.26'),
(51, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 14:53:22', 167215, '114.142.168.26'),
(52, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 14:54:37', 167215, '114.142.168.26'),
(53, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 14:54:42', 167215, '114.142.168.26'),
(54, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 14:55:54', 167215, '114.142.168.26'),
(55, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 14:56:25', 167215, '114.142.168.26'),
(56, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 14:58:54', 167215, '114.142.168.26'),
(57, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 14:59:14', 167215, '114.142.168.26'),
(58, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:01:03', 167215, '114.142.168.26'),
(59, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:01:08', 167215, '114.142.168.26'),
(60, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:01:11', 167215, '114.142.168.26'),
(61, 'User Mengakses Halaman http://event.arayamedia.id/update-personl', '2018-09-01 15:01:14', 167215, '114.142.168.26'),
(62, 'User Mengakses Halaman http://event.arayamedia.id/update-personl', '2018-09-01 15:01:28', 167215, '114.142.168.26'),
(63, 'User Mengakses Halaman http://event.arayamedia.id/update-personl', '2018-09-01 15:01:46', 167215, '114.142.168.26'),
(64, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:01:50', 167215, '114.142.168.26'),
(65, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:02:31', 167215, '114.142.168.26'),
(66, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:02:36', 167215, '114.142.168.26'),
(67, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:03:24', 167215, '114.142.168.26'),
(68, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:06:27', 167215, '114.142.168.26'),
(69, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:06:28', 167215, '114.142.168.26'),
(70, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:06:50', 167215, '114.142.168.26'),
(71, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:10:21', 167215, '114.142.168.26'),
(72, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:10:28', 167215, '114.142.168.26'),
(73, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:12:14', 167215, '114.142.168.26'),
(74, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:12:55', 167215, '114.142.168.26'),
(75, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:13:28', 167215, '114.142.168.26'),
(76, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:13:40', 167215, '114.142.168.26'),
(77, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:14:21', 167215, '114.142.168.26'),
(78, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:16:36', 167215, '114.142.168.26'),
(79, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:17:05', 167215, '114.142.168.26'),
(80, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:21:10', 167215, '114.142.168.26'),
(81, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:21:35', 167215, '114.142.168.26'),
(82, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:25:19', 167215, '114.142.168.26'),
(83, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 15:27:50', 167215, '114.142.168.26'),
(84, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:29:17', 167215, '114.142.168.26'),
(85, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:29:30', 167215, '114.142.168.26'),
(86, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:30:21', 167215, '114.142.168.26'),
(87, 'User Tidak Bisa Login | Tidak Ada Akun | IP =114.142.168.26', '2018-09-01 15:31:13', NULL, '114.142.168.26'),
(88, 'User Register634795 | OK | IP =114.142.168.26', '2018-09-01 15:32:29', NULL, '114.142.168.26'),
(89, 'Kirim Token Daftar ke farisredmi55@gmail.com Token =  2zRIDQ2zPmj4Yf8Ds7LFuddCtCLui5YmrLlVSncC', '2018-09-01 15:32:29', NULL, '114.142.168.26'),
(90, 'User Register907875 | OK | IP =114.142.168.26', '2018-09-01 15:32:56', NULL, '114.142.168.26'),
(91, 'Kirim Token Daftar ke fariswidhi32@gmail.com Token =  SZcp1tBFHtziJzt4mOIAkdQflfy9YUOoQkcUc6Xj', '2018-09-01 15:32:56', NULL, '114.142.168.26'),
(92, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:33:11', 907875, '114.142.168.26'),
(93, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:34:22', 907875, '114.142.168.26'),
(94, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:35:29', 907875, '114.142.168.26'),
(95, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:35:39', 907875, '114.142.168.26'),
(96, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:36:09', 907875, '114.142.168.26'),
(97, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:37:20', 907875, '114.142.168.26'),
(98, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:38:56', 907875, '114.142.168.26'),
(99, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 15:39:55', 907875, '114.142.168.26'),
(100, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:40:23', 907875, '114.142.168.26'),
(101, 'User Mengakses Halaman http://event.arayamedia.id/update-personals', '2018-09-01 15:43:59', 907875, '114.142.168.26'),
(102, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 16:19:48', 907875, '114.142.168.26'),
(103, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:20:30', 907875, '114.142.168.26'),
(104, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 16:34:35', 907875, '114.142.168.26'),
(105, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:35:04', 907875, '114.142.168.26'),
(106, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:36:12', 907875, '114.142.168.26'),
(107, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:39:47', 907875, '114.142.168.26'),
(108, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:40:42', 907875, '114.142.168.26'),
(109, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:40:45', 907875, '114.142.168.26'),
(110, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:41:48', 907875, '114.142.168.26'),
(111, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:41:51', 907875, '114.142.168.26'),
(112, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:45:31', 907875, '114.142.168.26'),
(113, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:45:35', 907875, '114.142.168.26'),
(114, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:45:37', 907875, '114.142.168.26'),
(115, 'User Mengakses Halaman http://event.arayamedia.id/update-personalx', '2018-09-01 16:45:39', 907875, '114.142.168.26'),
(116, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 16:47:52', 907875, '114.142.168.26'),
(117, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:48:23', 907875, '114.142.168.26'),
(118, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:02', 907875, '114.142.168.26'),
(119, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:05', 907875, '114.142.168.26'),
(120, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:41', 907875, '114.142.168.26'),
(121, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:41', 907875, '114.142.168.26'),
(122, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:42', 907875, '114.142.168.26'),
(123, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:44', 907875, '114.142.168.26'),
(124, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:45', 907875, '114.142.168.26'),
(125, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:45', 907875, '114.142.168.26'),
(126, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:46', 907875, '114.142.168.26'),
(127, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:46', 907875, '114.142.168.26'),
(128, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:54:48', 907875, '114.142.168.26'),
(129, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:02', 907875, '114.142.168.26'),
(130, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:03', 907875, '114.142.168.26'),
(131, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:05', 907875, '114.142.168.26'),
(132, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:13', 907875, '114.142.168.26'),
(133, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:36', 907875, '114.142.168.26'),
(134, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:38', 907875, '114.142.168.26'),
(135, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:39', 907875, '114.142.168.26'),
(136, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:55:44', 907875, '114.142.168.26'),
(137, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:57:11', 907875, '114.142.168.26'),
(138, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 16:57:15', 907875, '114.142.168.26'),
(139, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 22:37:45', 167215, '202.80.219.31'),
(140, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 22:37:50', 167215, '202.80.219.31'),
(141, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 22:38:31', 167215, '202.80.219.31'),
(142, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 22:38:39', 167215, '202.80.219.31'),
(143, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 22:39:17', 167215, '202.80.219.31'),
(144, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 22:40:51', 167215, '202.80.219.31'),
(145, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 22:41:04', 167215, '202.80.219.31'),
(146, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 23:27:38', 907875, '114.142.170.23'),
(147, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:28:42', 907875, '114.142.170.23'),
(148, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:28:50', 907875, '114.142.170.23'),
(149, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:29:12', 907875, '114.142.170.23'),
(150, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:31:07', 907875, '114.142.170.23'),
(151, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:31:25', 907875, '114.142.170.23'),
(152, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:31:40', 907875, '114.142.170.23'),
(153, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:31:48', 907875, '114.142.170.23'),
(154, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 23:41:15', 907875, '114.142.170.23'),
(155, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:41:26', 907875, '114.142.170.23'),
(156, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 23:41:41', 907875, '114.142.170.23'),
(157, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 23:42:00', 907875, '114.142.170.23'),
(158, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 23:42:10', 907875, '114.142.170.23'),
(159, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-01 23:42:54', 907875, '114.142.170.23'),
(160, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-01 23:51:41', 907875, '114.142.170.23'),
(161, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-02 00:07:48', 907875, '114.142.170.23'),
(162, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:08:09', 907875, '114.142.170.23'),
(163, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:08:19', 907875, '114.142.170.23'),
(164, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:09:20', 907875, '114.142.170.23'),
(165, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-02 00:09:46', 907875, '114.142.170.23'),
(166, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:10:52', 907875, '114.142.170.23'),
(167, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:11:13', 907875, '114.142.170.23'),
(168, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-02 00:11:20', 907875, '114.142.170.23'),
(169, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:11:34', 907875, '114.142.170.23'),
(170, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:14:36', 907875, '114.142.170.23'),
(171, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:18:31', 907875, '114.142.170.23'),
(172, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:20:24', 907875, '114.142.170.23'),
(173, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-02 00:20:40', 907875, '114.142.170.23'),
(174, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:20:50', 907875, '114.142.170.23'),
(175, 'User Mengakses Halaman http://event.arayamedia.id/update-personal', '2018-09-02 00:22:42', 907875, '114.142.170.23'),
(176, 'User Mengakses Halaman http://event.arayamedia.id/uploads', '2018-09-02 00:30:25', 167215, '202.80.219.31');

-- --------------------------------------------------------

--
-- Table structure for table `login_member`
--

CREATE TABLE `login_member` (
  `id` int(8) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `komunitas` varchar(30) DEFAULT NULL,
  `jml_personal` int(11) NOT NULL DEFAULT '0',
  `tipe_akun` int(1) DEFAULT '0' COMMENT '0=personal, 1 =komunitas',
  `verified` int(5) DEFAULT NULL,
  `nohp` varchar(20) DEFAULT NULL,
  `status` int(1) DEFAULT '0' COMMENT '0=blm aktif, 1=aktif'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_member`
--

INSERT INTO `login_member` (`id`, `email`, `password`, `komunitas`, `jml_personal`, `tipe_akun`, `verified`, `nohp`, `status`) VALUES
(493851, 'fwidhiarta@gmail.com', '$2y$10$cHkATrTxaKKGkbByZTHZ9.6UJ9xdXaIiuRtttp83SoJyKCDdaDYnG', 'KOMUNITASKU', 0, 1, NULL, '08982382321', 1),
(879738, 'merahkode@gmail.com', '$2y$10$poPdY0PU4ce4btWL7e9QreLap50xwCLWRmZ49Difo3WxX4onuyRJO', 'KOMUNITAS REMBANG BANGKIT', 3, 1, NULL, '08982382323', 1),
(777094, 'fariswidhiarta123@gmail.com', '$2y$10$wSB8YqOsetwqhWvpYUOfQe6FblFRVGxiU8XHsSn9JPLqIW4sHT6sG', NULL, 0, 1, NULL, '08982382323', 1),
(597036, 'idhenz@gmail.com', '$2y$10$fsqdgU9PZjWdydyXzamC/..RDTyB29exk.giNMy52Huhf82GCy2zO', 'RGO', 6, 1, NULL, '+6285695555430', 1),
(147595, 'widyapamela@gmail.com', '$2y$10$tk9GDV9k77XqneIH4V0nlOyCz8P0KBwpatncKpZA/d2CVbFJH4Vm6', '3A', 10, 1, NULL, '08113030151', 1),
(167215, 'rosyi88@gmail.com', '$2y$10$tR3mzmql1GFS7IcchqHMA.zJRLto6dhGFEcurcdjtkXlsfs6e8Ip.', NULL, 0, 0, NULL, '085695555430', 0),
(634795, 'farisredmi55@gmail.com', '$2y$10$cRdJjsV4n3fYxNMKK3/5Vuoyx2yac7HLYjiBkJIsbepYo2vqUEX8W', NULL, 0, 0, NULL, '0981212', 0),
(907875, 'fariswidhi32@gmail.com', '$2y$10$fa50TRc5NToH3U3xv9hP1OsYEJyIbERvEhzoqD0zqBM8TrU4gWf2O', NULL, 0, 0, NULL, '08912919219', 1);

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE `negara` (
  `id` int(4) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id`, `nama`) VALUES
(1, 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `personal_detail`
--

CREATE TABLE `personal_detail` (
  `id` int(8) NOT NULL,
  `id_login_member` int(8) DEFAULT NULL,
  `nik` varchar(30) DEFAULT NULL,
  `nama_awal` varchar(50) DEFAULT NULL,
  `nama_akhir` varchar(50) DEFAULT NULL,
  `jk` int(1) DEFAULT NULL,
  `gol_darah` varchar(2) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_kota` int(5) DEFAULT NULL,
  `id_provinsi` int(11) DEFAULT NULL,
  `nasionality` int(3) DEFAULT '62' COMMENT 'id_negara',
  `residence` int(3) DEFAULT '62' COMMENT 'lokasi tempat tinggal'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_detail`
--

INSERT INTO `personal_detail` (`id`, `id_login_member`, `nik`, `nama_awal`, `nama_akhir`, `jk`, `gol_darah`, `tgl_lahir`, `nohp`, `alamat`, `id_kota`, `id_provinsi`, `nasionality`, `residence`) VALUES
(5, 777094, '120102', 'Roni', 'Ahmad', 1, 'A', '2000-07-06', '08982382323', 'Rembang', 12, NULL, 1, 1),
(4, 777094, '12121', 'Budi', 'Raharja', 1, 'A', '2000-08-06', '08982382323', 'Rembang', 12, NULL, 1, 1),
(6, 493851, '1929129', 'Budi', 'Awan', 1, 'B', '2000-08-09', '08982382323', 'Rembang', 12, NULL, 1, 1),
(8, 597036, '3573052201870001', 'Hendra', 'Saputra', 1, 'B', '1987-01-22', '085695555430', 'Jl Bantaran', 3319, 33, 1, 1),
(9, 597036, '3318106702810003', 'Rosyida', 'Nugraheni', 2, 'O', '1986-01-20', '085695555430', 'Jl Bantaran', 12, NULL, 1, 1),
(10, 597036, '3318106702810003', 'Widya', 'Pamela', 2, 'A', '1987-02-08', '081122229112', 'Junrejo', 12, NULL, 1, 1),
(11, 879738, '1234512345123451', 'Heru Sujatmoko', NULL, 1, 'AB', '2000-07-06', '08982382323', 'Rembang', 3301, 33, 1, 1),
(12, 879738, '1234512345123452', 'Budiawan', NULL, 1, 'A', '2000-06-07', '08982382323', 'Rembang', 3301, 33, 1, 1),
(13, 147595, '3318106702810001', 'Widya', 'Pamela', NULL, NULL, NULL, '081232081233', 'MALANG', 3579, 35, 1, 1),
(14, 147595, '3573052201870002', 'BUDI', 'PURWANTO', 1, 'A', '1995-01-01', '081232081233', 'MALANG', 3501, 35, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` int(2) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `nama`) VALUES
(11, 'ACEH'),
(12, 'SUMATERA UTARA'),
(13, 'SUMATERA BARAT'),
(14, 'RIAU'),
(15, 'JAMBI'),
(16, 'SUMATERA SELATAN'),
(17, 'BENGKULU'),
(18, 'LAMPUNG'),
(19, 'KEPULAUAN BANGKA BELITUNG'),
(21, 'KEPULAUAN RIAU'),
(31, 'DKI JAKARTA'),
(32, 'JAWA BARAT'),
(33, 'JAWA TENGAH'),
(34, 'DI YOGYAKARTA'),
(35, 'JAWA TIMUR'),
(36, 'BANTEN'),
(51, 'BALI'),
(52, 'NUSA TENGGARA BARAT'),
(53, 'NUSA TENGGARA TIMUR'),
(61, 'KALIMANTAN BARAT'),
(62, 'KALIMANTAN TENGAH'),
(63, 'KALIMANTAN SELATAN'),
(64, 'KALIMANTAN TIMUR'),
(65, 'KALIMANTAN UTARA'),
(71, 'SULAWESI UTARA'),
(72, 'SULAWESI TENGAH'),
(73, 'SULAWESI SELATAN'),
(74, 'SULAWESI TENGGARA'),
(75, 'GORONTALO'),
(76, 'SULAWESI BARAT'),
(81, 'MALUKU'),
(82, 'MALUKU UTARA'),
(91, 'PAPUA BARAT'),
(94, 'PAPUA'),
(11, 'ACEH'),
(12, 'SUMATERA UTARA'),
(13, 'SUMATERA BARAT'),
(14, 'RIAU'),
(15, 'JAMBI'),
(16, 'SUMATERA SELATAN'),
(17, 'BENGKULU'),
(18, 'LAMPUNG'),
(19, 'KEPULAUAN BANGKA BELITUNG'),
(21, 'KEPULAUAN RIAU'),
(31, 'DKI JAKARTA'),
(32, 'JAWA BARAT'),
(33, 'JAWA TENGAH'),
(34, 'DI YOGYAKARTA'),
(35, 'JAWA TIMUR'),
(36, 'BANTEN'),
(51, 'BALI'),
(52, 'NUSA TENGGARA BARAT'),
(53, 'NUSA TENGGARA TIMUR'),
(61, 'KALIMANTAN BARAT'),
(62, 'KALIMANTAN TENGAH'),
(63, 'KALIMANTAN SELATAN'),
(64, 'KALIMANTAN TIMUR'),
(65, 'KALIMANTAN UTARA'),
(71, 'SULAWESI UTARA'),
(72, 'SULAWESI TENGAH'),
(73, 'SULAWESI SELATAN'),
(74, 'SULAWESI TENGGARA'),
(75, 'GORONTALO'),
(76, 'SULAWESI BARAT'),
(81, 'MALUKU'),
(82, 'MALUKU UTARA'),
(91, 'PAPUA BARAT'),
(94, 'PAPUA');

-- --------------------------------------------------------

--
-- Table structure for table `regis_participant_id_event`
--

CREATE TABLE `regis_participant_id_event` (
  `id_form_participant` int(8) DEFAULT NULL,
  `tgl_regis` datetime DEFAULT NULL,
  `status_fasilitas` int(1) DEFAULT '1' COMMENT '1=Lengkap, 0=Kurang',
  `isi_fasilitas` varchar(200) DEFAULT NULL,
  `id_panitia` int(5) DEFAULT NULL,
  `kode_validasi` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `token_registration`
--

CREATE TABLE `token_registration` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `userid` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token_registration`
--

INSERT INTO `token_registration` (`id`, `token`, `userid`, `created_at`) VALUES
(1, 'asas', '568801', '2018-08-20 09:28:11'),
(2, 'dmcVE4vkNEMBKc9nUuA2yKIvnDlB1ywe3c7e5JBg', '503978', '2018-08-20 09:44:36'),
(3, '87iJEtQr1rG0MPGBxqXVWfOPDzBTqIGLvFnyMGoV', '700203', '2018-08-20 09:53:25'),
(4, 'LqlTdRjzwliRxbRw9qCVGZ6ynIGBwAidOQpHgu92', '513602', '2018-08-20 09:55:55'),
(5, 'wB85ItkGHRDhGxkaJNRYHzYnIgFn19CvA8UKTV16', '376296', '2018-08-20 09:57:45'),
(6, 'TiIZQNVQ0uWdHi5J1PnevmEco6GFhHJ68zoDfxca', '557884', '2018-08-20 10:02:44'),
(7, '1ajTngboXw4phE1LgxDDoBakx6BZYv0myXc5i4Uu', '845393', '2018-08-20 10:03:46'),
(8, 'lkEcYMukveIMgJ6bsojBLu1LraZn6UGeIFdKPQ8i', '876460', '2018-08-20 10:04:49'),
(9, 'ySebIyLplhshxy7ZURjulHXDBdFUxQMiYnOiTnoL', '879738', '2018-08-20 14:25:09'),
(10, '3RCQGQpQIxysvr6UrUjykdwZPSJzxoU20ZF0A7Jf', '777094', '2018-08-24 12:58:47'),
(11, 'wPP2fRvl1d4tsmuvuchBWhQRFTC1WBgkLWiPcNqs', '493851', '2018-08-24 13:11:35'),
(12, 'oekb2J1E39f2JozOU8MAgPiZwdvbjJ81aWj2YBZU', '597036', '2018-08-24 13:52:44'),
(13, 'g7Upb0fiwWmh3QxtkzaN4GeW9VXWEzx51THOtbwj', '147595', '2018-08-30 04:20:52'),
(14, 'a0a2aZ3EEkG7jD8uVkqddsjnYbNObcOuuU7SAoyq', '167215', '2018-08-31 23:22:27'),
(15, '2zRIDQ2zPmj4Yf8Ds7LFuddCtCLui5YmrLlVSncC', '634795', '2018-09-01 15:32:29'),
(16, 'SZcp1tBFHtziJzt4mOIAkdQflfy9YUOoQkcUc6Xj', '907875', '2018-09-01 15:32:56');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_id_event`
--

CREATE TABLE `transaction_id_event` (
  `id` varchar(20) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  `jumlah_total` int(10) DEFAULT NULL,
  `diskon` int(10) DEFAULT NULL,
  `harga_akhir` int(10) DEFAULT NULL,
  `status_bayar` int(1) DEFAULT '0' COMMENT '0=Belum Lunas, 1=Lunas',
  `id_jenis_bayar` int(2) DEFAULT NULL,
  `keterangan_bank` varchar(255) DEFAULT NULL,
  `validasi_no` varchar(255) DEFAULT NULL,
  `id_user_merchant` int(3) DEFAULT NULL,
  `id_login_member` varchar(20) DEFAULT NULL,
  `id_event` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_id_event`
--

INSERT INTO `transaction_id_event` (`id`, `tgl_transaksi`, `jumlah_total`, `diskon`, `harga_akhir`, `status_bayar`, `id_jenis_bayar`, `keterangan_bank`, `validasi_no`, `id_user_merchant`, `id_login_member`, `id_event`) VALUES
('080001', '2018-08-28 11:32:05', 20000, 0, 20765, 1, NULL, 'TRSF E-BANKING CR 2808/FTSCY/WS95051 20765.00 ARTA ELEKTRONIK IN', '765', NULL, '597036', NULL),
('080002', '2018-08-28 12:53:35', 10000, 0, 10865, 1, NULL, 'TRSF E-BANKING CR 2808/FTSCY/WS95051 10865.00 ARTA ELEKTRONIK IN', '865', NULL, '597036', NULL),
('080003', '2018-08-28 13:39:21', 20000, 0, 20356, 0, NULL, NULL, '356', NULL, '879738', NULL),
('080004', '2018-08-28 13:41:11', 20000, 0, 20647, 0, NULL, NULL, '647', NULL, '879738', NULL),
('080005', '2018-08-28 22:17:17', 20000, 0, 20355, 0, NULL, NULL, '355', NULL, '879738', 1),
('080006', '2018-08-28 22:32:27', 20000, 0, 20592, 0, NULL, NULL, '592', NULL, '879738', 1),
('080007', '2018-08-28 22:33:11', 20000, 0, 20717, 0, NULL, NULL, '717', NULL, '879738', 1),
('080008', '2018-08-29 12:47:07', 19000, 1, 19426, 0, NULL, '[#080008] Pending Payment ATM Transfer FOR Marathon Museum Angkot 2019', '426', NULL, '879738', 1),
('080009', '2018-08-29 13:17:33', 9000, 1, 9367, 0, NULL, '[#080009] Pending Payment ATM Transfer FOR Marathon Museum Angkot 2019', '367', NULL, '879738', 1),
('080010', '2018-08-29 14:13:32', 19000, 1, 19226, 0, NULL, '[#080010] Pending Payment ATM Transfer FOR Marathon Museum Angkot 2019', '226', NULL, '879738', 1),
('080011', '2018-08-30 03:27:18', 9000, 1, 9540, 0, NULL, '[#080011] Pending Payment ATM Transfer FOR Marathon Museum Angkot 2019', '540', NULL, '879738', 1),
('080012', '2018-08-30 05:07:38', 6000, 1, 6288, 0, NULL, '[#080012] Pending Payment ATM Transfer FOR Marathon Museum Angkot 2019', '288', NULL, '147595', 1),
('080013', '2018-08-30 05:12:06', 20000, 0, 20410, 1, NULL, '[080013] Payment Received/Paid For Marathon Museum Angkot 2019', '410', NULL, '147595', 1),
('080014', '2018-08-31 08:52:52', 9000, 1, 9171, 0, NULL, '[#080014] Pending Payment ATM Transfer FOR Marathon Museum Angkot 2019', '171', NULL, '597036', 1),
('080015', '2018-08-31 23:32:22', 10000, 0, 10746, 0, NULL, '[#080015] Pending Payment ATM Transfer FOR Marathon Museum Angkot 2019', '746', NULL, '597036', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ukuran_jersey`
--

CREATE TABLE `ukuran_jersey` (
  `id` int(3) NOT NULL,
  `ukuran` varchar(5) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_event` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ukuran_jersey`
--

INSERT INTO `ukuran_jersey` (`id`, `ukuran`, `deskripsi`, `foto`, `id_event`) VALUES
(1, 'XL', NULL, 'https://5.imimg.com/data5/WP/EW/MY-42286563/sports-jersey-500x500.jpg', 1),
(2, 'L', NULL, 'https://5.imimg.com/data5/WP/EW/MY-42286563/sports-jersey-500x500.jpg', 1),
(3, 'M', NULL, 'https://5.imimg.com/data5/WP/EW/MY-42286563/sports-jersey-500x500.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_system`
--

CREATE TABLE `user_system` (
  `id` int(5) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(1) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaction_id_event`
--
ALTER TABLE `detail_transaction_id_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `early_bird`
--
ALTER TABLE `early_bird`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_medical`
--
ALTER TABLE `emergency_medical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_detail`
--
ALTER TABLE `event_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_term`
--
ALTER TABLE `event_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_participant_id_event`
--
ALTER TABLE `form_participant_id_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_member`
--
ALTER TABLE `login_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_detail`
--
ALTER TABLE `personal_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_registration`
--
ALTER TABLE `token_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ukuran_jersey`
--
ALTER TABLE `ukuran_jersey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_system`
--
ALTER TABLE `user_system`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaction_id_event`
--
ALTER TABLE `detail_transaction_id_event`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `early_bird`
--
ALTER TABLE `early_bird`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_medical`
--
ALTER TABLE `emergency_medical`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `event_term`
--
ALTER TABLE `event_term`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `form_participant_id_event`
--
ALTER TABLE `form_participant_id_event`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9472;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_detail`
--
ALTER TABLE `personal_detail`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `token_registration`
--
ALTER TABLE `token_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_system`
--
ALTER TABLE `user_system`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
