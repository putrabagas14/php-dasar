-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 11, 2022 at 04:59 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_dasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nrp` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nama`, `nrp`, `email`, `jurusan`, `gambar`, `created_at`) VALUES
(2, 'saputra', '11800711', 'bagaskuyy14@gmail.com', 'Rekayasa Perangkat Lunak', '', '2022-07-24 16:45:29'),
(8, 'pratama', '11800711', 'bagaskuyy14@gmail.com', 'Rekayasa Perangkat Lunak', 'oRqwLc.png', '2022-07-24 18:06:14'),
(10, 'berhasil', 'berhasil', 'berhasil', 'berhasil', '1778237.jpg', '2022-07-24 18:20:14'),
(11, 'berhasil2', 'berhasil', 'berhasil', 'berhasil', 'nero.jpg', '2022-07-24 18:21:52'),
(12, 'eeee', '11800711', 'bagaskuyy14@gmail.com', 'Rekayasa Perangkat Lunak', 'asd-1657963815 (2).jpg', '2022-07-24 18:26:24'),
(13, 'saputra', '11800711', 'bagaskuyy14@gmail.com', 'Rekayasa Perangkat Lunak', 'beccbc212a15f3abb147d3723c02f976.jpg', '2022-07-24 18:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('admin','guru','mahasiswa') NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `level`, `created_at`) VALUES
(1, 'bagas', 'bagaskuyy14@gmail.com', '$2y$10$r7f0QRZucv91cEdDV371Tejs8lLVpVb99ToEbaYnNgfLjSM2bu/He', 'admin', '2022-07-24 16:35:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
