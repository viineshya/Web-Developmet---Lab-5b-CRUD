-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2026 at 05:47 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab_5b`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `matric` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`matric`, `name`, `password`, `role`) VALUES
('02000', 'Nur Arif Mohd Zin', '$2y$10$S5Sg1b1p49k6Xk7Zch75O.z9wfW4emYrifgUI93mqJGxy.L0WkJXS', 'lecturer'),
('A100', 'Ahmad', '$2y$10$R.cRiXlrVw8qv2ctlLYp9eVSiFwsssnDoKNRBLojeXWxz8OtzDHDG', 'student'),
('A101', 'Abu', '$2y$10$1.Eqn.FrMYk8M9Vvjl8oQ.cetDEmvBazOBpSsQvpwykl4Br9T.Sxi', 'student'),
('a103', 'Ahmad bin Abu', '$2y$10$FYRlCkFoF7MXgXhDVOJaYOax2IuaK2MWylBTBy6Dxdbm3ytT3aUN6', 'student'),
('AI240138', 'Viineshya', '$2y$10$ztUDVt426wNioYml.3iWledfIyg/GmH1xOEZgmttBvThwBMZau4IG', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`matric`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
