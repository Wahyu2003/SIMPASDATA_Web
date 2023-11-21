-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 01:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurikuler`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nip` int(25) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','pembina') DEFAULT NULL,
  `status` enum('aktif','tidak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nip`, `nama`, `email`, `no_hp`, `alamat`, `gender`, `foto`, `password`, `role`, `status`) VALUES
(1, 'Admin', 'admin@gmail.com', '010101010101', 'Jember', 'L', '', 'admin', 'admin', 'aktif'),
(2, 'Pembina', 'pembina@gmail.com', '010101010101', 'Jember', 'L', '', 'pembina', 'pembina', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `detail_nilai`
--

CREATE TABLE `detail_nilai` (
  `enter_id` int(11) DEFAULT NULL,
  `nilai_id` int(11) NOT NULL,
  `total_nilai` int(255) DEFAULT NULL,
  `tahun_pelajaran` varchar(12) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entered`
--

CREATE TABLE `entered` (
  `id_enter` int(11) NOT NULL,
  `nip` int(25) NOT NULL,
  `nisn_s` int(11) NOT NULL,
  `nisn_j` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama`) VALUES
(1, '10 A'),
(2, '10 B'),
(3, '10 C'),
(4, '11 A'),
(5, '11 B'),
(6, '11 C'),
(7, '12 A'),
(8, '12 B'),
(9, '12 C');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nama`) VALUES
(1, 'Nilai Sikap'),
(2, 'Nilai Pola Pikir'),
(3, 'Nilai Keaktifan'),
(4, 'Nilai PBB');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('aktif','tidak') DEFAULT NULL,
  `role` enum('junior','senior','purna') DEFAULT NULL,
  `level` enum('allow','denied') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `kelas_id`, `nama`, `gender`, `alamat`, `email`, `no_hp`, `foto`, `password`, `status`, `role`, `level`) VALUES
(1111, 1, 'Ilham', 'L', 'Jember', 'ilhamisdarmawan@gmail.com', '010101010101', '', '1111Ilham', 'aktif', 'senior', 'allow'),
(2222, 2, 'Wahyu Isdarmawan', 'L', 'Jember', 'wahyuisdarmawan@gmail.com', '010101010101', '', '2222Wahyu Isdarmawan', 'aktif', 'junior', 'denied'),
(3333, 1, 'Rival', 'L', 'Jember', 'rival@gmail.com', '010101010101', '', '3333Rival', 'aktif', 'purna', 'denied'),
(4444, 3, 'Rahmat', 'L', 'Jember', 'rahmat@gmail.com', '010101010101', '', '4444Rahmat', 'aktif', 'senior', 'denied'),
(5555, 1, 'Silvi', 'P', 'Jember', 'silvi@gmail.com', '010101010101', '', '5555Silvi', 'aktif', 'junior', 'denied'),
(6666, 1, 'Nadiva', 'P', 'Jember', 'nadiva@gmail.com', '010101010101', '', '6666Nadiva', 'aktif', 'junior', 'denied'),
(7777, 1, 'Firda', 'P', 'Jember', 'firda@gmail.com', '010101010101', '', '7777Firda', 'aktif', 'junior', 'denied'),
(8888, 1, 'Sinta', 'P', 'Jember', 'sinta@gmail.com', '010101010101', '', '8888Sinta', 'aktif', 'junior', 'denied'),
(41221091, 1, 'RIzal', 'L', 'Bondowoso', 'rizal@gmail.com', '085737134160', 'download (1).jpeg', '41221091RIzal', 'aktif', 'junior', 'denied');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD KEY `relasi2` (`nilai_id`),
  ADD KEY `enter_id` (`enter_id`);

--
-- Indexes for table `entered`
--
ALTER TABLE `entered`
  ADD PRIMARY KEY (`id_enter`),
  ADD KEY `relasi4` (`nip`),
  ADD KEY `relasi5` (`nisn_s`),
  ADD KEY `nisn_j` (`nisn_j`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `relasi1` (`kelas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `entered`
--
ALTER TABLE `entered`
  MODIFY `id_enter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD CONSTRAINT `detail_nilai_ibfk_1` FOREIGN KEY (`enter_id`) REFERENCES `entered` (`id_enter`),
  ADD CONSTRAINT `relasi2` FOREIGN KEY (`nilai_id`) REFERENCES `nilai` (`id_nilai`);

--
-- Constraints for table `entered`
--
ALTER TABLE `entered`
  ADD CONSTRAINT `entered_ibfk_1` FOREIGN KEY (`nisn_j`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `relasi4` FOREIGN KEY (`nip`) REFERENCES `admin` (`nip`),
  ADD CONSTRAINT `relasi5` FOREIGN KEY (`nisn_s`) REFERENCES `siswa` (`nisn`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `relasi1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
