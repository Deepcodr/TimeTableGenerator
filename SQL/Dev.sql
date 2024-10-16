-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 18, 2024 at 03:48 PM
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
-- Database: `Dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `password`, `username`, `phone`, `email`) VALUES
('System Admin', 'admin', 'admin@tkiet.com', '1234', 'admin@tkiet.com');

-- --------------------------------------------------------

--
-- Table structure for table `associations`
--

CREATE TABLE `associations` (
  `staffid` varchar(10) NOT NULL,
  `staffname` varchar(50) NOT NULL,
  `subjectcode` varchar(10) NOT NULL,
  `subjectname` varchar(50) NOT NULL,
  `year` int(1) NOT NULL,
  `division` varchar(2) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `associations`
--

INSERT INTO `associations` (`staffid`, `staffname`, `subjectcode`, `subjectname`, `year`, `division`, `id`) VALUES
('T01', 'S.R.Aralimatti', 'TK02', 'Data Structures & Algorithms', 2, 'A', 1),
('T02', 'Savitha M', 'TK07', 'DSMP', 2, 'A', 2),
('T03', 'V.C.Patil', 'TK06', 'SE', 2, 'A', 3),
('T04', 'A.S.Kamble', 'TK04', 'DMS', 2, 'A', 4),
('T05', 'S.V.Nikam', 'TK05', 'OOP', 2, 'A', 5),
('T06', 'R.D.Gade', 'TK08', 'M&E', 2, 'A', 6),
('T07', 'Santhosh Desai', 'TK01', 'Engineering Maths', 2, 'A', 7),
('T08', 'S.G.Totad', 'TK02', 'Data Structures & Algorithms', 2, 'B', 8),
('T09', 'P.P.Shirgaonkar', 'TK07', 'DSMP', 2, 'B', 9),
('T10', 'A.V.Gundavade', 'TK04', 'DMS', 2, 'B', 10),
('T11', 'R.Y.Kumbhar', 'TK05', 'OOP', 2, 'B', 11),
('T12', 'S.D.Mule', 'TK08', 'M&E', 2, 'B', 12),
('T07', 'Santhosh Desai', 'TK01', 'Engineering Maths', 2, 'B', 13),
('T05', 'S.V.Nikam', 'TK02', 'Data Structures & Algorithms', 2, 'C', 14),
('T09', 'P.P.Shirgaonkar', 'TK07', 'DSMP', 2, 'C', 15),
('T13', 'P.V.Nalawade', 'TK06', 'SE', 2, 'C', 16),
('T12', 'S.D.Mule', 'TK04', 'DMS', 2, 'C', 17),
('T14', 'M.S.Bhosale', 'TK05', 'OOP', 2, 'C', 18),
('T02', 'Savitha M', 'TK08', 'M&E', 2, 'C', 19),
('T07', 'Santhosh Desai', 'TK01', 'Engineering Maths', 2, 'C', 20);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` int(11) NOT NULL,
  `name` varchar(2) NOT NULL,
  `division` varchar(2) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`id`, `name`, `division`, `year`) VALUES
(1, 'A1', 'A', 2),
(2, 'A2', 'A', 2),
(3, 'A3', 'A', 2),
(4, 'A4', 'A', 2),
(5, 'B1', 'B', 2),
(6, 'B2', 'B', 2),
(7, 'B3', 'B', 2),
(8, 'B4', 'B', 2),
(9, 'C1', 'C', 2),
(10, 'C2', 'C', 2),
(11, 'C3', 'C', 2);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `name` varchar(2) NOT NULL,
  `year` int(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`name`, `year`, `id`) VALUES
('A', 2, 1),
('B', 2, 2),
('C', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `name` varchar(50) NOT NULL,
  `staffId` varchar(10) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `emailId` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`name`, `staffId`, `qualification`, `emailId`, `password`, `phone`) VALUES
('S.R.Aralimatti', 'T01', 'M.tech', 'sra@tkiet.com', 'sra123', '1234'),
('Savitha M', 'T02', 'M.tech', 'sm@tkiet.com', 'sm123', '1234'),
('V.C.Patil', 'T03', 'M.Tech', 'vcp@tkiet.com', 'vcp123', '1234'),
('A.S.Kamble', 'T04', 'M.Tech', 'ask@tkiet.com', 'ask123', '1234'),
('S.V.Nikam', 'T05', 'M.tech', 'svn@tkiet.com', 'svn123', '1234'),
('R.D.Gade', 'T06', 'M.tech', 'rdg@tkiet.com', 'rdg123', '1234'),
('Santhosh Desai', 'T07', 'M.tech', 'sd@tkiet.com', 'sd123', '1234'),
('S.G.Totad', 'T08', 'M.tech', 'sgt@tkiet.com', 'sgt123', '1234'),
('P.P.Shirgaonkar', 'T09', 'M.tech', 'pps@tkiet.com', 'pps123', '1234'),
('A.V.Gundavade', 'T10', 'M.tech', 'avg@tkiet.com', 'avg123', '1234'),
('R.Y.Kumbhar', 'T11', 'M.tech', 'ryk@tkiet.com', 'ryk123', '1234'),
('S.D.Mule', 'T12', 'M.tech', 'sdm@tkiet.com', 'sdm123', '1234'),
('P.V.Nalawade', 'T13', 'M.tech', 'pvn@tkiet.com', 'pvn123', '1234'),
('M.S.Bhosale', 'T14', 'M.Tech', 'msb@tkiet.com', 'msb123', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `phone`, `email`, `password`, `name`) VALUES
('test@test.com', '1234', 'test@test.com', 'test', 'testuser');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_code` varchar(10) NOT NULL,
  `subject_alias` varchar(50) NOT NULL,
  `subject_name` varchar(200) NOT NULL,
  `course_type` varchar(15) NOT NULL,
  `semester` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `subject_alias`, `subject_name`, `course_type`, `semester`) VALUES
('TK01', 'Maths', 'Mathematics For Computer Science', 'THEORY', 2),
('TK02', 'DS', 'Data Structures', 'THEORY', 2),
('TK04', 'DMS', 'Discrete Mathematical Structure', 'THEORY', 2),
('TK05', 'OOP', 'Object Oriented Programming', 'THEORY', 2),
('TK06', 'SE', 'Software Engineering', 'THEORY', 2),
('TK07', 'DSMP', 'Digital Systems and Microprocessors', 'THEORY', 2),
('TK08', 'M&E', 'Management and Enterpreneurship', 'THEORY', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `associations`
--
ALTER TABLE `associations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`),
  ADD UNIQUE KEY `emailId` (`emailId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associations`
--
ALTER TABLE `associations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
