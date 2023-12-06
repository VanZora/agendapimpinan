-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2023 at 03:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kelola`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `nohp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `prodi`, `nohp`) VALUES
(3, 'C030321102', 'Anugerah', 'Teknik Informatika', '08222222222'),
(5, 'C030321104', 'Ahmad Rafiq', 'Teknik Informatika', '08444444444'),
(7, 'C030321106', 'Budi Tabudi', 'Sistem Informasi Kota Cerdas', '086666666666'),
(8, 'C030321107', 'Cahyadi Rahmani', 'Administrasi Bisnis', '08111111111'),
(9, 'C030321108', 'Supriadi', 'Teknik Informatika', '08191919195'),
(10, 'C030321109', 'Iman Hasbi', 'Teknik Listrik', '08111111111'),
(11, 'C030321110', 'Irfan Wahyudi', 'Teknik Listrik', '081011010102'),
(12, 'C030321123', 'Harun', 'Teknik Informatika', '081011010103'),
(13, 'C030321144', 'Rahmat Ibnu Sina', 'Teknik Listrik', '082224445676');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_mhs`
--

CREATE TABLE `nilai_mhs` (
  `id` int(11) NOT NULL,
  `nim_mhs` varchar(50) NOT NULL,
  `matkul` varchar(50) NOT NULL,
  `nilai` int(11) NOT NULL,
  `grade` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_mhs`
--

INSERT INTO `nilai_mhs` (`id`, `nim_mhs`, `matkul`, `nilai`, `grade`) VALUES
(9, 'C030321144', 'Pemrograman Web', 45, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `foto`) VALUES
(13, 'jamet', '$2y$10$Qeccb2GaBVX2bZIQLevK1.4P70A9w/N9OxAkejnBdip7cWk7EZpm.', 'image/Akudimana.jpg'),
(15, 'dimas', '$2y$10$dsLoK3TXF9O3GB0..zTWL.Ds0eVvn7N8K5KStZHjXCCZp/vbvpDr6', 'image/2sadzg.png'),
(25, 'nuge', '$2y$10$Fy6vV6sK5d3FMT.vS0ewj.nKr0dNoGjxYEvwEBNzjkpsxVQY.3s3a', 'image/2sadzg.png'),
(27, 'admin', '$2y$10$QCZxfeocFl58aiQl89cOl.4EYDT7xrdjDBikm7fiPjPilzDxT02ki', 'image/AI Poliban w4.png'),
(28, 'adminz', '$2y$10$Ha/GP8E9bJgg9XwRm.zkrO1sdhEf1Wx2LiqcmzrICtY5KmgcxaWx.', 'image/AI Poliban w4.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indexes for table `nilai_mhs`
--
ALTER TABLE `nilai_mhs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim_mhs` (`nim_mhs`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nilai_mhs`
--
ALTER TABLE `nilai_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nilai_mhs`
--
ALTER TABLE `nilai_mhs`
  ADD CONSTRAINT `nilai_mhs_ibfk_1` FOREIGN KEY (`nim_mhs`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
