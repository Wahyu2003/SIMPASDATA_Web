-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2023 at 01:02 PM
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
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','pembina') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nip`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Administrator', 'admin', 'admin', 'admin'),
(2, 'ilham nugroho', 'ilham', 'ilham', 'pembina');

-- --------------------------------------------------------

--
-- Table structure for table `detail_nilai`
--

CREATE TABLE `detail_nilai` (
  `id_detail` int(11) NOT NULL,
  `nilai_id` int(11) NOT NULL,
  `tahun_id` int(11) NOT NULL,
  `total_nilai` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entered_junior`
--

CREATE TABLE `entered_junior` (
  `id_entered` int(11) NOT NULL,
  `nisn_s` int(11) NOT NULL,
  `nisn_j` int(11) NOT NULL,
  `detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entered_senior`
--

CREATE TABLE `entered_senior` (
  `id_enter` int(11) NOT NULL,
  `nip` int(25) NOT NULL,
  `nisn` int(11) NOT NULL,
  `detail_id` int(11) NOT NULL
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
  `password` varchar(255) DEFAULT NULL,
  `angkatan` varchar(255) DEFAULT NULL,
  `status` enum('aktif','tidak') DEFAULT NULL,
  `role` enum('junior','senior') DEFAULT NULL,
  `level` enum('allow','denied') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `kelas_id`, `nama`, `gender`, `alamat`, `email`, `password`, `angkatan`, `status`, `role`, `level`) VALUES
(1111, 1, 'Ilham Nugroho', 'L', 'Jember', 'ilhamisdarmawan@gmail.com', 'ilham', '10', 'aktif', 'junior', 'denied'),
(2222, 4, 'Wahyu Isdarmawan', 'L', 'Jember', 'wahyuisdarmawan@gmail.com', 'wahyu', '11', 'aktif', 'senior', 'allow'),
(3333, 4, 'Hafid Wahyudi', 'L', 'Bondowoso', 'hafidwahyudi@gmail.com', 'hafid', '11', 'aktif', 'senior', 'denied');

-- --------------------------------------------------------

--
-- Table structure for table `thn_pelajaran`
--

CREATE TABLE `thn_pelajaran` (
  `id_tahun` int(11) NOT NULL,
  `tahun_awal` varchar(255) DEFAULT NULL,
  `tahun_akhir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thn_pelajaran`
--

INSERT INTO `thn_pelajaran` (`id_tahun`, `tahun_awal`, `tahun_akhir`) VALUES
(1, '2022', '2023'),
(2, '2023', '2024'),
(3, '2024', '2025'),
(4, '2025', '2026');

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
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `relasi2` (`nilai_id`),
  ADD KEY `relasi3` (`tahun_id`);

--
-- Indexes for table `entered_junior`
--
ALTER TABLE `entered_junior`
  ADD PRIMARY KEY (`id_entered`),
  ADD KEY `relasi7` (`nisn_s`),
  ADD KEY `relasi8` (`nisn_j`),
  ADD KEY `relasi9` (`detail_id`);

--
-- Indexes for table `entered_senior`
--
ALTER TABLE `entered_senior`
  ADD PRIMARY KEY (`id_enter`),
  ADD KEY `relasi4` (`nip`),
  ADD KEY `relasi5` (`nisn`),
  ADD KEY `relasi6` (`detail_id`);

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
-- Indexes for table `thn_pelajaran`
--
ALTER TABLE `thn_pelajaran`
  ADD PRIMARY KEY (`id_tahun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entered_junior`
--
ALTER TABLE `entered_junior`
  MODIFY `id_entered` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entered_senior`
--
ALTER TABLE `entered_senior`
  MODIFY `id_enter` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `thn_pelajaran`
--
ALTER TABLE `thn_pelajaran`
  MODIFY `id_tahun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_nilai`
--
ALTER TABLE `detail_nilai`
  ADD CONSTRAINT `relasi2` FOREIGN KEY (`nilai_id`) REFERENCES `nilai` (`id_nilai`),
  ADD CONSTRAINT `relasi3` FOREIGN KEY (`tahun_id`) REFERENCES `thn_pelajaran` (`id_tahun`);

--
-- Constraints for table `entered_junior`
--
ALTER TABLE `entered_junior`
  ADD CONSTRAINT `relasi7` FOREIGN KEY (`nisn_s`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `relasi8` FOREIGN KEY (`nisn_j`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `relasi9` FOREIGN KEY (`detail_id`) REFERENCES `detail_nilai` (`id_detail`);

--
-- Constraints for table `entered_senior`
--
ALTER TABLE `entered_senior`
  ADD CONSTRAINT `relasi4` FOREIGN KEY (`nip`) REFERENCES `admin` (`nip`),
  ADD CONSTRAINT `relasi5` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`),
  ADD CONSTRAINT `relasi6` FOREIGN KEY (`detail_id`) REFERENCES `detail_nilai` (`id_detail`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `relasi1` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
