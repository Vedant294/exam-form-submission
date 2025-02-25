-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2025 at 06:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vipuldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam_selections`
--

CREATE TABLE `exam_selections` (
  `id` int(11) NOT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `subjects` text DEFAULT NULL,
  `elective` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_selections`
--

INSERT INTO `exam_selections` (`id`, `branch`, `semester`, `subjects`, `elective`, `created_at`) VALUES
(201, 'cse', '7', 'Cryptography and Network Security, Cryptography and Network Security (Lab)', 'JAVA Programming', '2025-02-20 16:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id_code` int(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `mob_no` int(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `adhar_no` int(20) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_reg` date NOT NULL,
  `profile_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id_code`, `fname`, `mname`, `lname`, `mob_no`, `email`, `adhar_no`, `dob`, `address`, `password`, `date_reg`, `profile_photo`) VALUES
(201, 'Jack', 'Jason', 'Willam', 1234567894, 'jack@gmail.com', 2147483647, '2025-02-20', 'napur', '201', '2025-02-19', '201_67b75f813f543.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_selections`
--
ALTER TABLE `exam_selections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_code`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `adhar_no` (`adhar_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_selections`
--
ALTER TABLE `exam_selections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
