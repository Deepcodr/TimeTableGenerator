-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 06, 2024 at 10:48 AM
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
('T07', 'Santhosh Desai', 'TK01', 'Engineering Maths', 2, 'B', 13);

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `name` varchar(2) NOT NULL,
  `year` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`name`, `year`) VALUES
('A', 2),
('B', 2),
('C', 2);

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
('S.D.Mule', 'T12', 'M.tech', 'sdm@tkiet.com', 'sdm123', '1234');

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
  `subject_name` varchar(50) NOT NULL,
  `course_type` varchar(15) NOT NULL,
  `semester` int(1) NOT NULL,
  `isAlloted` int(1) NOT NULL,
  `allotedto` text DEFAULT NULL,
  `allotedto2` text DEFAULT NULL,
  `allotedto3` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `subject_name`, `course_type`, `semester`, `isAlloted`, `allotedto`, `allotedto2`, `allotedto3`) VALUES
('CO445', 'Network Security', 'THEORY', 7, 1, 'T011', 'T008', ''),
('CO451', 'Computer Network Design', 'THEORY', 7, 1, 'T003', '', ''),
('CO494', 'Embedded  Systems Lab', 'LAB', 7, 1, 'T008', 'T001', 'T004'),
('CO493', 'Networking Lab', 'LAB', 7, 1, 'T002', 'T007', 'T011'),
('CO394', 'Minor Project', 'LAB', 5, 1, 'T005', 'T007', 'T003'),
('CO393', 'Software Lab I', 'LAB', 5, 1, 'T003', 'T013', 'T005'),
('CO292', ' Data Structures Lab', 'LAB', 3, 1, 'T003', 'T012', 'T013'),
('CO293', 'Programming Lab', 'LAB', 3, 1, 'T006', 'T009', 'T008'),
('CO431', 'Internet Tools', 'THEORY', 7, 1, 'T005', '', ''),
('CO406', 'Compiler Design', 'THEORY', 7, 1, 'T003', '', ''),
('CO206', 'Logic Theory & Computer Organisation', 'THEORY', 3, 1, 'T002', '', ''),
('EL211', 'Electronic Devices & Circuits', 'THEORY', 3, 1, 'T014', '', ''),
('AM261', 'Higher Mathematics', 'THEORY', 3, 1, 'T016', '', ''),
('CO207', 'Data Structures & Algorithm', 'THEORY', 3, 1, 'T003', '', ''),
('CO309', 'Microprocessor Theory & Applications', 'THEORY', 5, 1, 'T011', '', ''),
('EL340', 'Communication Engineering', 'THEORY', 5, 1, 'T014', '', ''),
('CO308', 'Digital Electronics', 'THEORY', 5, 1, 'T008', '', ''),
('CO310', 'Operating Systems', 'THEORY', 5, 1, 'T013', '', ''),
('ME340', 'Economics & Management', 'THEORY', 5, 1, 'T015', '', ''),
('CO448', 'Embedded Systems', 'THEORY', 7, 1, 'T010', '', ''),
('CO460', 'Computer Architecture', 'THEORY', 7, 1, 'T009', '', ''),
('CO203', 'Object Oriented Programming', 'THEORY', 3, 1, 'T006', '', ''),
('TK01', 'Engineering Maths', 'THEORY', 2, 0, NULL, NULL, NULL),
('TK02', 'Data Structures & Algorithms', 'THEORY', 2, 0, NULL, NULL, NULL),
('TK04', 'DMS', 'THEORY', 2, 0, NULL, NULL, NULL),
('TK05', 'OOP', 'THEORY', 2, 0, NULL, NULL, NULL),
('TK06', 'SE', 'THEORY', 2, 0, NULL, NULL, NULL),
('TK07', 'DSMP', 'THEORY', 2, 0, NULL, NULL, NULL),
('TK08', 'M&E', 'THEORY', 2, 0, NULL, NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
