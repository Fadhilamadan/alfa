-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2016 at 05:13 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alfa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `password`) VALUES
(1, 'admin', '123'),
(2, 'fadhil', '123'),
(3, 'faishal', '123'),
(4, 'lucas', '123'),
(5, 'adit', '123');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `npk` varchar(9) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`npk`, `nama`, `password`, `status`, `jabatan`) VALUES
('998800', 'dosen', '123', 1, 'dosen'),
('998801', 'lisana', '123', 1, 'dosen'),
('998802', 'naufal', '123', 0, 'dosen'),
('998803', 'nyoto', '123', 1, 'dosen'),
('998804', 'hendra', '123', 1, 'dosen'),
('998805', 'daniel', '123', 0, 'dosen'),
('998806', 'monica', '123', 1, 'dosen'),
('998807', 'melissa', '123', 1, 'dosen'),
('998808', 'susana', '123', 1, 'dosen'),
('998809', 'joko', '123', 0, 'dosen'),
('998810', 'andre', '123', 0, 'dosen');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kegiatan_dosen`
--

CREATE TABLE `jadwal_kegiatan_dosen` (
  `id` int(9) NOT NULL,
  `tgl` varchar(20) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `npk` varchar(9) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_kegiatan_dosen`
--

INSERT INTO `jadwal_kegiatan_dosen` (`id`, `tgl`, `jam`, `npk`, `status`) VALUES
(40, '2016-11-14', '07.00-08.30', '998800', 1),
(41, '2016-11-15', '07.00-08.30', '998800', 0),
(42, '2016-11-16', '07.00-08.30', '998800', 1),
(43, '2016-11-14', '08.30-10.00', '998800', 0),
(44, '2016-11-15', '08.30-10.00', '998800', 0),
(45, '2016-11-16', '08.30-10.00', '998800', 0),
(46, '2016-11-14', '10.00-11.30', '998800', 0),
(47, '2016-11-15', '10.00-11.30', '998800', 0),
(48, '2016-11-16', '10.00-11.30', '998800', 0),
(49, '2016-11-14', '11.30-13.00', '998800', 0),
(50, '2016-11-15', '11.30-13.00', '998800', 0),
(51, '2016-11-14', '13.00-14.30', '998800', 0),
(52, '2016-11-15', '07.00-08.30', '998801', 0),
(53, '2016-11-16', '07.00-08.30', '998801', 1),
(54, '2016-11-17', '07.00-08.30', '998801', 0),
(55, '2016-11-15', '08.30-10.00', '998801', 0),
(56, '2016-11-16', '08.30-10.00', '998801', 0),
(57, '2016-11-17', '08.30-10.00', '998801', 0),
(58, '2016-11-15', '10.00-11.30', '998801', 0),
(59, '2016-11-16', '10.00-11.30', '998801', 0),
(61, '2016-11-15', '11.30-13.00', '998801', 0),
(62, '2016-11-16', '11.30-13.00', '998801', 0),
(63, '2016-11-15', '13.00-14.30', '998801', 0),
(64, '2016-11-14', '07.00-08.30', '998802', 1),
(65, '2016-11-16', '07.00-08.30', '998802', 0),
(66, '2016-11-17', '07.00-08.30', '998802', 0),
(67, '2016-11-14', '08.30-10.00', '998802', 0),
(68, '2016-11-16', '08.30-10.00', '998802', 0),
(69, '2016-11-17', '08.30-10.00', '998802', 0),
(70, '2016-11-16', '10.00-11.30', '998802', 0),
(71, '2016-11-17', '10.00-11.30', '998802', 0),
(72, '2016-11-16', '11.30-13.00', '998802', 0),
(73, '2016-11-17', '11.30-13.00', '998802', 0),
(74, '2016-11-16', '13.00-14.30', '998802', 0),
(75, '2016-11-14', '07.00-08.30', '998803', 0),
(76, '2016-11-15', '07.00-08.30', '998803', 0),
(77, '2016-11-16', '07.00-08.30', '998803', 0),
(78, '2016-11-17', '07.00-08.30', '998803', 0),
(79, '2016-11-18', '07.00-08.30', '998803', 1),
(80, '2016-11-19', '07.00-08.30', '998803', 0),
(81, '2016-11-18', '08.30-10.00', '998803', 0),
(82, '2016-11-19', '08.30-10.00', '998803', 0),
(83, '2016-11-18', '10.00-11.30', '998803', 0),
(84, '2016-11-19', '10.00-11.30', '998803', 0),
(85, '2016-11-19', '11.30-13.00', '998803', 0),
(86, '2016-11-17', '07.00-08.30', '998804', 0),
(87, '2016-11-18', '07.00-08.30', '998804', 1),
(88, '2016-11-19', '07.00-08.30', '998804', 0),
(89, '2016-11-17', '08.30-10.00', '998804', 0),
(90, '2016-11-18', '08.30-10.00', '998804', 0),
(91, '2016-11-19', '08.30-10.00', '998804', 0),
(92, '2016-11-17', '10.00-11.30', '998804', 0),
(93, '2016-11-18', '10.00-11.30', '998804', 0),
(94, '2016-11-19', '10.00-11.30', '998804', 0),
(95, '2016-11-17', '11.30-13.00', '998804', 0),
(96, '2016-11-18', '11.30-13.00', '998804', 0),
(97, '2016-11-17', '13.00-14.30', '998804', 0),
(98, '2016-11-14', '07.00-08.30', '998809', 0),
(99, '2016-11-15', '07.00-08.30', '998809', 0),
(100, '2016-11-16', '07.00-08.30', '998809', 0),
(101, '2016-11-14', '08.30-10.00', '998809', 0),
(102, '2016-11-15', '08.30-10.00', '998809', 0),
(103, '2016-11-16', '08.30-10.00', '998809', 0),
(104, '2016-11-14', '10.00-11.30', '998809', 0),
(105, '2016-11-15', '10.00-11.30', '998809', 0),
(106, '2016-11-16', '10.00-11.30', '998809', 0),
(107, '2016-11-14', '11.30-13.00', '998809', 0),
(108, '2016-11-15', '11.30-13.00', '998809', 0),
(109, '2016-11-16', '11.30-13.00', '998809', 0),
(110, '2016-11-14', '13.00-14.30', '998809', 0),
(111, '2016-11-15', '13.00-14.30', '998809', 0),
(112, '2016-11-16', '13.00-14.30', '998809', 0),
(113, '2016-11-14', '14.30-16.00', '998809', 0),
(114, '2016-11-15', '14.30-16.00', '998809', 0),
(115, '2016-11-16', '14.30-16.00', '998809', 0),
(116, '2016-11-14', '07.00-08.30', '998810', 0),
(117, '2016-11-14', '08.30-10.00', '998810', 0),
(118, '2016-11-14', '10.00-11.30', '998810', 0),
(119, '2016-11-14', '11.30-13.00', '998810', 0),
(120, '2016-11-14', '13.00-14.30', '998810', 0),
(121, '2016-11-14', '14.30-16.00', '998810', 0),
(122, '2016-11-14', '16.00-17.30', '998810', 0),
(123, '2016-11-15', '16.00-17.30', '998810', 0),
(124, '2016-11-16', '16.00-17.30', '998810', 0),
(125, '2016-11-17', '16.00-17.30', '998810', 0),
(126, '2016-11-18', '16.00-17.30', '998810', 0),
(127, '2016-11-19', '16.00-17.30', '998810', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sidang_tugas_akhir`
--

CREATE TABLE `jadwal_sidang_tugas_akhir` (
  `id` int(9) NOT NULL,
  `nrp` varchar(9) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `ruangid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_sidang_tugas_akhir`
--

INSERT INTO `jadwal_sidang_tugas_akhir` (`id`, `nrp`, `jam`, `tanggal`, `ruangid`) VALUES
(21, '160414009', '07.00-08.30', '2016-11-14', 10),
(22, '160414033', '07.00-08.30', '2016-11-16', 0),
(23, '160414036', '07.00-08.30', '2016-11-18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kalab`
--

CREATE TABLE `kalab` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kalab`
--

INSERT INTO `kalab` (`id`, `nama`, `password`) VALUES
(1, 'fadhil', '123'),
(2, 'kalab', '123'),
(3, 'faishal', '123'),
(4, 'lucas', '123'),
(5, 'adit', '123');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nrp` varchar(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hp` varchar(13) NOT NULL,
  `judul_ta` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `npk1` varchar(9) NOT NULL,
  `npk2` varchar(9) NOT NULL,
  `pra1` tinyint(1) NOT NULL,
  `pra2` tinyint(1) NOT NULL,
  `pra3` tinyint(1) NOT NULL,
  `pra4` tinyint(1) NOT NULL,
  `pra5` tinyint(1) NOT NULL,
  `pra6` tinyint(1) NOT NULL,
  `penguji1` varchar(9) NOT NULL,
  `penguji2` varchar(9) NOT NULL,
  `ketua` varchar(20) NOT NULL,
  `sekretaris` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nrp`, `nama`, `hp`, `judul_ta`, `status`, `npk1`, `npk2`, `pra1`, `pra2`, `pra3`, `pra4`, `pra5`, `pra6`, `penguji1`, `penguji2`, `ketua`, `sekretaris`) VALUES
('160414009', 'Evin Cintiawan', '08977348xxx', 'Judul Tugas Akhir', 0, '998803', '998804', 1, 1, 1, 1, 1, 0, '998800', '998802', '998810', '998808'),
('160414033', 'Sonny Haryadi', '08977348xxx', 'Judul Tugas Akhir', 0, '998809', '998807', 1, 1, 0, 1, 1, 1, '998800', '998801', '998806', '998805'),
('160414036', 'Alvin Pranata', '08977348xxx', 'Judul Tugas Akhir', 0, '998806', '998805', 1, 1, 1, 1, 0, 1, '998803', '998804', '', ''),
('160414039', 'Putu Aditya', '08977348xxx', 'Judul Tugas Akhir', 1, '998801', '998802', 0, 1, 1, 0, 0, 0, '', '', '', ''),
('160414040', 'Lucas Leonard', '08977348xxx', 'Judul Tugas Akhir', 0, '998803', '998800', 1, 1, 1, 0, 1, 1, '', '', '', ''),
('160414042', 'Billie Aryanto', '08977348xxx', 'Judul Tugas Akhir', 0, '998806', '998808', 1, 1, 1, 1, 1, 1, '', '', '', ''),
('160414053', 'Faishal Hendaryawan', '08977348xxx', 'Judul Tugas Akhir', 1, '998801', '998802', 0, 0, 0, 0, 0, 0, '', '', '', ''),
('160414063', 'Fadhil Amadan', '08977348xxx', 'Judul Tugas Akhir', 1, '998803', '998804', 0, 0, 0, 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `buka` date NOT NULL,
  `tutup` date NOT NULL,
  `nama` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `buka`, `tutup`, `nama`, `status`) VALUES
(2, '2016-11-14', '2016-11-21', 'GASAL 2016/2017 II', 1),
(3, '2017-01-19', '2017-07-12', 'GENAP 2016/2017 I', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `nama`) VALUES
(1, 'TF 02.01'),
(2, 'TF 02.02'),
(3, 'TF 02.03'),
(4, 'TF 02.04'),
(5, 'TF 02.05'),
(6, 'TF 03.04'),
(7, 'TF 03.01'),
(8, 'TF 03.02'),
(9, 'TF 03.03'),
(10, 'TC 04 A'),
(11, 'TC 04 B'),
(12, 'TC 04 C'),
(13, 'TC 04 D');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`npk`);

--
-- Indexes for table `jadwal_kegiatan_dosen`
--
ALTER TABLE `jadwal_kegiatan_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_sidang_tugas_akhir`
--
ALTER TABLE `jadwal_sidang_tugas_akhir`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nrp` (`nrp`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nrp`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_kegiatan_dosen`
--
ALTER TABLE `jadwal_kegiatan_dosen`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `jadwal_sidang_tugas_akhir`
--
ALTER TABLE `jadwal_sidang_tugas_akhir`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
