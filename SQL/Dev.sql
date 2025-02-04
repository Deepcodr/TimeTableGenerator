-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 04, 2025 at 03:39 PM
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
  `name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('T07', 'Santhosh Desai', 'TK01', 'Mathematics For Computer Science', 2, 'C', 22);

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
(3, 'A3', 'A', 2),
(4, 'A4', 'A', 2),
(5, 'B1', 'B', 2),
(6, 'B2', 'B', 2),
(7, 'B3', 'B', 2),
(8, 'B4', 'B', 2),
(9, 'C1', 'C', 2),
(10, 'C2', 'C', 2),
(11, 'C3', 'C', 2),
(13, 'A1', 'A', 2),
(14, 'A2', 'A', 2);

-- --------------------------------------------------------

--
-- Table structure for table `batch_associations`
--

CREATE TABLE `batch_associations` (
  `batchname` varchar(2) NOT NULL,
  `division` varchar(2) NOT NULL,
  `staffid` varchar(11) NOT NULL,
  `staffname` varchar(50) NOT NULL,
  `subjectcode` varchar(11) NOT NULL,
  `subjectname` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batch_associations`
--

INSERT INTO `batch_associations` (`batchname`, `division`, `staffid`, `staffname`, `subjectcode`, `subjectname`, `year`, `id`) VALUES
('C1', 'C', 'T05', 'S.V.Nikam', 'TK09', 'Data Structures Lab', 2, 4),
('C2', 'C', 'T05', 'S.V.Nikam', 'TK09', 'Data Structures Lab', 2, 5),
('C3', 'C', 'T01', 'S.R.Aralimatti', 'TK09', 'Data Structures Lab', 2, 6),
('C1', 'C', 'T02', 'Savitha M', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 7),
('C2', 'C', 'T02', 'Savitha M', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 8),
('C3', 'C', 'T09', 'P.P.Shirgaonkar', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 9),
('C1', 'C', 'T12', 'S.D.Mule', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 10),
('C2', 'C', 'T12', 'S.D.Mule', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 11),
('C3', 'C', 'T12', 'S.D.Mule', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 12),
('C1', 'C', 'T14', 'M.S.Bhosale', 'TK12', 'Object Oriented Programming Lab', 2, 13),
('C2', 'C', 'T14', 'M.S.Bhosale', 'TK12', 'Object Oriented Programming Lab', 2, 14),
('C3', 'C', 'T11', 'R.Y.Kumbhar', 'TK12', 'Object Oriented Programming Lab', 2, 15),
('A1', 'A', 'T01', 'S.R.Aralimatti', 'TK09', 'Data Structures Lab', 2, 16),
('A3', 'A', 'T05', 'S.V.Nikam', 'TK09', 'Data Structures Lab', 2, 17),
('A4', 'A', 'T14', 'M.S.Bhosale', 'TK09', 'Data Structures Lab', 2, 18),
('A1', 'A', 'T02', 'Savitha M', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 19),
('A2', 'A', 'T02', 'Savitha M', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 20),
('A3', 'A', 'T02', 'Savitha M', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 21),
('A4', 'A', 'T02', 'Savitha M', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 22),
('A1', 'A', 'T04', 'A.S.Kamble', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 23),
('A2', 'A', 'T04', 'A.S.Kamble', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 24),
('A3', 'A', 'T04', 'A.S.Kamble', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 25),
('A4', 'A', 'T04', 'A.S.Kamble', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 26),
('A1', 'A', 'T05', 'S.V.Nikam', 'TK12', 'Object Oriented Programming Lab', 2, 27),
('A2', 'A', 'T14', 'M.S.Bhosale', 'TK12', 'Object Oriented Programming Lab', 2, 28),
('A3', 'A', 'T05', 'S.V.Nikam', 'TK12', 'Object Oriented Programming Lab', 2, 29),
('A4', 'A', 'T05', 'S.V.Nikam', 'TK12', 'Object Oriented Programming Lab', 2, 30),
('B1', 'B', 'T14', 'M.S.Bhosale', 'TK09', 'Data Structures Lab', 2, 31),
('B2', 'B', 'T06', 'R.D.Gade', 'TK09', 'Data Structures Lab', 2, 32),
('B3', 'B', 'T11', 'R.Y.Kumbhar', 'TK09', 'Data Structures Lab', 2, 33),
('B1', 'B', 'T09', 'P.P.Shirgaonkar', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 34),
('B2', 'B', 'T09', 'P.P.Shirgaonkar', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 35),
('B3', 'B', 'T09', 'P.P.Shirgaonkar', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 36),
('B4', 'B', 'T09', 'P.P.Shirgaonkar', 'TK10', 'Digital Systems & Microprocessors Lab', 2, 37),
('B1', 'B', 'T10', 'A.V.Gundavade', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 38),
('B2', 'B', 'T10', 'A.V.Gundavade', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 39),
('B3', 'B', 'T10', 'A.V.Gundavade', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 40),
('B4', 'B', 'T10', 'A.V.Gundavade', 'TK11', 'Discrete Mathematical Structures Tutorial', 2, 41),
('B1', 'B', 'T11', 'R.Y.Kumbhar', 'TK12', 'Object Oriented Programming Lab', 2, 42),
('B2', 'B', 'T11', 'R.Y.Kumbhar', 'TK12', 'Object Oriented Programming Lab', 2, 43),
('B3', 'B', 'T11', 'R.Y.Kumbhar', 'TK12', 'Object Oriented Programming Lab', 2, 44),
('B4', 'B', 'T11', 'R.Y.Kumbhar', 'TK12', 'Object Oriented Programming Lab', 2, 45),
('A2', 'A', 'T15', 'ABS', 'TK09', 'Data Structures Lab', 2, 46);

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
('C', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `name` varchar(50) NOT NULL,
  `staff_alias` varchar(10) DEFAULT NULL,
  `staffId` varchar(10) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `emailId` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`name`, `staff_alias`, `staffId`, `qualification`, `emailId`, `password`, `phone`, `year`) VALUES
('OFF', 'OFF', 'OFF', 'NULL', 'NULL', 'NULL', 'NULL', 2),
('S.R.Aralimatti', 'SRA', 'T01', 'M.tech', 'sra@tkiet.com', 'sra123', '1234', 2),
('Savitha M', 'SM', 'T02', 'M.tech', 'sm@tkiet.com', 'sm123', '1234', 2),
('V.C.Patil', 'VCP', 'T03', 'M.Tech', 'vcp@tkiet.com', 'vcp123', '1234', 2),
('A.S.Kamble', 'ASK', 'T04', 'M.Tech', 'ask@tkiet.com', 'ask123', '1234', 2),
('S.V.Nikam', 'SVN', 'T05', 'M.tech', 'svn@tkiet.com', 'svn123', '1234', 2),
('R.D.Gade', 'RDG', 'T06', 'M.tech', 'rdg@tkiet.com', 'rdg123', '1234', 2),
('Santhosh Desai', 'SD', 'T07', 'M.tech', 'sd@tkiet.com', 'sd123', '1234', 2),
('S.G.Totad', 'SGT', 'T08', 'M.tech', 'sgt@tkiet.com', 'sgt123', '1234', 2),
('P.P.Shirgaonkar', 'PPS', 'T09', 'M.tech', 'pps@tkiet.com', 'pps123', '1234', 2),
('A.V.Gundavade', 'AVG', 'T10', 'M.tech', 'avg@tkiet.com', 'avg123', '1234', 2),
('R.Y.Kumbhar', 'RYK', 'T11', 'M.tech', 'ryk@tkiet.com', 'ryk123', '1234', 2),
('S.D.Mule', 'SDM', 'T12', 'M.tech', 'sdm@tkiet.com', 'sdm123', '1234', 2),
('P.V.Nalawade', 'PVN', 'T13', 'M.tech', 'pvn@tkiet.com', 'pvn123', '1234', 2),
('M.S.Bhosale', 'MSB', 'T14', 'M.Tech', 'msb@tkiet.com', 'msb123', '1234', 2),
('ABS', 'ABS', 'T15', 'M.Tech', 'abs@tkiet.com', 'abs@123', '1234', 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `username` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `PRN` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` int(2) NOT NULL,
  `division` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`username`, `phone`, `email`, `password`, `PRN`, `name`, `year`, `division`) VALUES
('deepak@tkiet.com', '8828364428', 'deepak@tkiet.com', 'deepak', 202401, 'Deepak Patil', 2, 1),
('test@test.com', '1234', 'test@test.com', 'test', 202301, 'testuser', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollment`
--

CREATE TABLE `student_enrollment` (
  `roll` int(11) NOT NULL,
  `dept` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_enrollment`
--

INSERT INTO `student_enrollment` (`roll`, `dept`, `name`, `year`) VALUES
(1, 'cse', 'deepak', 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_code`, `subject_alias`, `subject_name`, `course_type`, `semester`) VALUES
('OFF', 'OFF', 'OFF', 'LAB', 2),
('TK01', 'Maths', 'Mathematics For Computer Science', 'THEORY', 2),
('TK02', 'DS', 'Data Structures', 'THEORY', 2),
('TK04', 'DMS', 'Discrete Mathematical Structures', 'THEORY', 2),
('TK05', 'OOP', 'Object Oriented Programming', 'THEORY', 2),
('TK06', 'SE', 'Software Engineering', 'THEORY', 2),
('TK07', 'DSMP', 'Digital Systems and Microprocessors', 'THEORY', 2),
('TK08', 'M&E', 'Management and Enterpreneurship', 'THEORY', 2),
('TK09', 'DSLAB', 'Data Structures Lab', 'LAB', 2),
('TK10', 'DSMPLAB', 'Digital Systems & Microprocessors Lab', 'LAB', 2),
('TK11', 'DMSTUT', 'Discrete Mathematical Structures Tutorial', 'LAB', 2),
('TK12', 'OOPLAB', 'Object Oriented Programming Lab', 'LAB', 2);

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `division` varchar(2) DEFAULT NULL,
  `batch` varchar(2) DEFAULT NULL,
  `timeslot` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `staff` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `year`, `division`, `batch`, `timeslot`, `day`, `subject`, `staff`) VALUES
(961, 2, 'A', NULL, 1, 'Monday', 'TK02', 'T01'),
(962, 2, 'A', NULL, 2, 'Monday', 'TK05', 'T05'),
(963, 2, 'A', NULL, 3, 'Monday', 'OFF', 'OFF'),
(964, 2, 'A', NULL, 4, 'Monday', 'TK08', 'T06'),
(965, 2, 'A', NULL, 5, 'Monday', 'TK02', 'T01'),
(966, 2, 'A', NULL, 6, 'Monday', 'OFF', 'OFF'),
(967, 2, 'A', NULL, 7, 'Monday', 'TK07', 'T02'),
(968, 2, 'A', NULL, 8, 'Monday', 'TK04', 'T04'),
(969, 2, 'A', NULL, 1, 'Tuesday', 'TK05', 'T05'),
(970, 2, 'A', NULL, 2, 'Tuesday', 'TK01', 'T07'),
(971, 2, 'A', NULL, 3, 'Tuesday', 'OFF', 'OFF'),
(972, 2, 'A', 'A1', 4, 'Tuesday', 'TK09', 'T01'),
(973, 2, 'A', 'A2', 4, 'Tuesday', 'TK09', 'T15'),
(974, 2, 'A', 'A3', 4, 'Tuesday', 'TK09', 'T05'),
(975, 2, 'A', 'A4', 4, 'Tuesday', 'TK09', 'T14'),
(976, 2, 'A', NULL, 5, 'Tuesday', 'OFF', 'OFF'),
(977, 2, 'A', NULL, 6, 'Tuesday', 'OFF', 'OFF'),
(978, 2, 'A', NULL, 7, 'Tuesday', 'TK02', 'T01'),
(979, 2, 'A', NULL, 8, 'Tuesday', 'TK06', 'T03'),
(980, 2, 'A', NULL, 1, 'Wednesday', 'TK06', 'T03'),
(981, 2, 'A', NULL, 2, 'Wednesday', 'TK08', 'T06'),
(982, 2, 'A', NULL, 3, 'Wednesday', 'OFF', 'OFF'),
(983, 2, 'A', 'A1', 4, 'Wednesday', 'TK10', 'T02'),
(984, 2, 'A', 'A2', 4, 'Wednesday', 'TK11', 'T04'),
(985, 2, 'A', 'A3', 4, 'Wednesday', 'OFF', 'OFF'),
(986, 2, 'A', 'A4', 4, 'Wednesday', 'TK09', 'T14'),
(987, 2, 'A', NULL, 5, 'Wednesday', 'OFF', 'OFF'),
(988, 2, 'A', NULL, 6, 'Wednesday', 'OFF', 'OFF'),
(989, 2, 'A', 'A1', 7, 'Wednesday', 'TK11', 'T04'),
(990, 2, 'A', 'A2', 7, 'Wednesday', 'TK12', 'T14'),
(991, 2, 'A', 'A3', 7, 'Wednesday', 'TK10', 'T02'),
(992, 2, 'A', 'A4', 7, 'Wednesday', 'OFF', 'OFF'),
(993, 2, 'A', NULL, 8, 'Wednesday', 'OFF', 'OFF'),
(994, 2, 'A', NULL, 1, 'Thursday', 'TK01', 'T07'),
(995, 2, 'A', NULL, 2, 'Thursday', 'TK06', 'T03'),
(996, 2, 'A', NULL, 3, 'Thursday', 'OFF', 'OFF'),
(997, 2, 'A', NULL, 4, 'Thursday', 'TK02', 'T01'),
(998, 2, 'A', NULL, 5, 'Thursday', 'TK04', 'T04'),
(999, 2, 'A', NULL, 6, 'Thursday', 'OFF', 'OFF'),
(1000, 2, 'A', 'A1', 7, 'Thursday', 'TK12', 'T05'),
(1001, 2, 'A', 'A2', 7, 'Thursday', 'TK09', 'T15'),
(1002, 2, 'A', 'A3', 7, 'Thursday', 'TK11', 'T04'),
(1003, 2, 'A', 'A4', 7, 'Thursday', 'TK10', 'T02'),
(1004, 2, 'A', NULL, 8, 'Thursday', 'OFF', 'OFF'),
(1005, 2, 'A', NULL, 1, 'Friday', 'TK01', 'T07'),
(1006, 2, 'A', NULL, 2, 'Friday', 'TK07', 'T02'),
(1007, 2, 'A', NULL, 3, 'Friday', 'OFF', 'OFF'),
(1008, 2, 'A', 'A1', 4, 'Friday', 'TK09', 'T01'),
(1009, 2, 'A', 'A2', 4, 'Friday', 'TK10', 'T02'),
(1010, 2, 'A', 'A3', 4, 'Friday', 'TK12', 'T05'),
(1011, 2, 'A', 'A4', 4, 'Friday', 'TK11', 'T04'),
(1012, 2, 'A', NULL, 5, 'Friday', 'OFF', 'OFF'),
(1013, 2, 'A', NULL, 6, 'Friday', 'OFF', 'OFF'),
(1014, 2, 'A', NULL, 7, 'Friday', 'TK04', 'T04'),
(1015, 2, 'A', NULL, 8, 'Friday', 'TK07', 'T02'),
(1016, 2, 'A', 'A1', 1, 'Saturday', 'OFF', 'OFF'),
(1017, 2, 'A', 'A2', 1, 'Saturday', 'OFF', 'OFF'),
(1018, 2, 'A', 'A3', 1, 'Saturday', 'TK09', 'T05'),
(1019, 2, 'A', 'A4', 1, 'Saturday', 'OFF', 'OFF'),
(1020, 2, 'A', NULL, 2, 'Saturday', 'OFF', 'OFF'),
(1021, 2, 'A', NULL, 3, 'Saturday', 'OFF', 'OFF'),
(1022, 2, 'A', NULL, 4, 'Saturday', 'OFF', 'OFF'),
(1023, 2, 'A', NULL, 5, 'Saturday', 'OFF', 'OFF'),
(1024, 2, 'A', NULL, 6, 'Saturday', 'OFF', 'OFF'),
(1025, 2, 'A', NULL, 7, 'Saturday', 'OFF', 'OFF'),
(1026, 2, 'A', NULL, 8, 'Saturday', 'OFF', 'OFF'),
(1027, 2, 'B', 'B1', 1, 'Monday', 'TK12', 'T11'),
(1028, 2, 'B', 'B2', 1, 'Monday', 'TK09', 'T06'),
(1029, 2, 'B', 'B3', 1, 'Monday', 'TK11', 'T10'),
(1030, 2, 'B', 'B4', 1, 'Monday', 'OFF', 'OFF'),
(1031, 2, 'B', NULL, 2, 'Monday', 'OFF', 'OFF'),
(1032, 2, 'B', NULL, 3, 'Monday', 'OFF', 'OFF'),
(1033, 2, 'B', NULL, 4, 'Monday', 'TK05', 'T11'),
(1034, 2, 'B', NULL, 5, 'Monday', 'TK02', 'T08'),
(1035, 2, 'B', NULL, 6, 'Monday', 'OFF', 'OFF'),
(1036, 2, 'B', 'B1', 7, 'Monday', 'TK09', 'T14'),
(1037, 2, 'B', 'B2', 7, 'Monday', 'TK12', 'T11'),
(1038, 2, 'B', 'B3', 7, 'Monday', 'OFF', 'OFF'),
(1039, 2, 'B', 'B4', 7, 'Monday', 'TK11', 'T10'),
(1040, 2, 'B', NULL, 8, 'Monday', 'OFF', 'OFF'),
(1041, 2, 'B', NULL, 1, 'Tuesday', 'TK08', 'T12'),
(1042, 2, 'B', NULL, 2, 'Tuesday', 'TK07', 'T09'),
(1043, 2, 'B', NULL, 3, 'Tuesday', 'OFF', 'OFF'),
(1044, 2, 'B', NULL, 4, 'Tuesday', 'TK01', 'T07'),
(1045, 2, 'B', NULL, 5, 'Tuesday', 'TK05', 'T11'),
(1046, 2, 'B', NULL, 6, 'Tuesday', 'OFF', 'OFF'),
(1047, 2, 'B', 'B1', 7, 'Tuesday', 'TK11', 'T10'),
(1048, 2, 'B', 'B2', 7, 'Tuesday', 'TK10', 'T09'),
(1049, 2, 'B', 'B3', 7, 'Tuesday', 'TK12', 'T11'),
(1050, 2, 'B', 'B4', 7, 'Tuesday', 'OFF', 'OFF'),
(1051, 2, 'B', NULL, 8, 'Tuesday', 'OFF', 'OFF'),
(1052, 2, 'B', NULL, 1, 'Wednesday', 'TK07', 'T09'),
(1053, 2, 'B', NULL, 2, 'Wednesday', 'TK04', 'T10'),
(1054, 2, 'B', NULL, 3, 'Wednesday', 'OFF', 'OFF'),
(1055, 2, 'B', NULL, 4, 'Wednesday', 'TK08', 'T12'),
(1056, 2, 'B', NULL, 5, 'Wednesday', 'TK02', 'T08'),
(1057, 2, 'B', NULL, 6, 'Wednesday', 'OFF', 'OFF'),
(1058, 2, 'B', NULL, 7, 'Wednesday', 'TK01', 'T07'),
(1059, 2, 'B', NULL, 8, 'Wednesday', 'TK02', 'T08'),
(1060, 2, 'B', 'B1', 1, 'Thursday', 'TK10', 'T09'),
(1061, 2, 'B', 'B2', 1, 'Thursday', 'TK09', 'T06'),
(1062, 2, 'B', 'B3', 1, 'Thursday', 'TK09', 'T11'),
(1063, 2, 'B', 'B4', 1, 'Thursday', 'OFF', 'OFF'),
(1064, 2, 'B', NULL, 2, 'Thursday', 'OFF', 'OFF'),
(1065, 2, 'B', NULL, 3, 'Thursday', 'OFF', 'OFF'),
(1066, 2, 'B', NULL, 4, 'Thursday', 'TK07', 'T09'),
(1067, 2, 'B', NULL, 5, 'Thursday', 'TK01', 'T07'),
(1068, 2, 'B', NULL, 6, 'Thursday', 'OFF', 'OFF'),
(1069, 2, 'B', NULL, 7, 'Thursday', 'TK04', 'T10'),
(1070, 2, 'B', NULL, 8, 'Thursday', 'TK02', 'T08'),
(1071, 2, 'B', NULL, 1, 'Friday', 'TK04', 'T10'),
(1072, 2, 'B', NULL, 2, 'Friday', 'OFF', 'OFF'),
(1073, 2, 'B', NULL, 3, 'Friday', 'OFF', 'OFF'),
(1074, 2, 'B', NULL, 4, 'Friday', 'OFF', 'OFF'),
(1075, 2, 'B', NULL, 5, 'Friday', 'OFF', 'OFF'),
(1076, 2, 'B', NULL, 6, 'Friday', 'OFF', 'OFF'),
(1077, 2, 'B', 'B1', 7, 'Friday', 'TK09', 'T14'),
(1078, 2, 'B', 'B2', 7, 'Friday', 'TK11', 'T10'),
(1079, 2, 'B', 'B3', 7, 'Friday', 'TK10', 'T09'),
(1080, 2, 'B', 'B4', 7, 'Friday', 'TK12', 'T11'),
(1081, 2, 'B', NULL, 8, 'Friday', 'OFF', 'OFF'),
(1082, 2, 'B', NULL, 1, 'Saturday', 'OFF', 'OFF'),
(1083, 2, 'B', NULL, 2, 'Saturday', 'OFF', 'OFF'),
(1084, 2, 'B', NULL, 3, 'Saturday', 'OFF', 'OFF'),
(1085, 2, 'B', NULL, 4, 'Saturday', 'OFF', 'OFF'),
(1086, 2, 'B', NULL, 5, 'Saturday', 'OFF', 'OFF'),
(1087, 2, 'B', NULL, 6, 'Saturday', 'OFF', 'OFF'),
(1088, 2, 'B', 'B1', 7, 'Saturday', 'OFF', 'OFF'),
(1089, 2, 'B', 'B2', 7, 'Saturday', 'OFF', 'OFF'),
(1090, 2, 'B', 'B3', 7, 'Saturday', 'TK09', 'T11'),
(1091, 2, 'B', 'B4', 7, 'Saturday', 'TK10', 'T09'),
(1092, 2, 'B', NULL, 8, 'Saturday', 'OFF', 'OFF'),
(1093, 2, 'C', NULL, 1, 'Monday', 'TK07', 'T09'),
(1094, 2, 'C', NULL, 2, 'Monday', 'TK05', 'T14'),
(1095, 2, 'C', NULL, 3, 'Monday', 'OFF', 'OFF'),
(1096, 2, 'C', 'C1', 4, 'Monday', 'TK11', 'T12'),
(1097, 2, 'C', 'C2', 4, 'Monday', 'TK10', 'T02'),
(1098, 2, 'C', 'C3', 4, 'Monday', 'TK10', 'T09'),
(1099, 2, 'C', NULL, 5, 'Monday', 'OFF', 'OFF'),
(1100, 2, 'C', NULL, 6, 'Monday', 'OFF', 'OFF'),
(1101, 2, 'C', NULL, 7, 'Monday', 'TK04', 'T12'),
(1102, 2, 'C', NULL, 8, 'Monday', 'TK07', 'T09'),
(1103, 2, 'C', 'C1', 1, 'Tuesday', 'TK12', 'T14'),
(1104, 2, 'C', 'C2', 1, 'Tuesday', 'OFF', 'OFF'),
(1105, 2, 'C', 'C3', 1, 'Tuesday', 'TK09', 'T01'),
(1106, 2, 'C', NULL, 2, 'Tuesday', 'OFF', 'OFF'),
(1107, 2, 'C', NULL, 3, 'Tuesday', 'OFF', 'OFF'),
(1108, 2, 'C', NULL, 4, 'Tuesday', 'TK06', 'T13'),
(1109, 2, 'C', NULL, 5, 'Tuesday', 'TK08', 'T02'),
(1110, 2, 'C', NULL, 6, 'Tuesday', 'OFF', 'OFF'),
(1111, 2, 'C', NULL, 7, 'Tuesday', 'TK06', 'T13'),
(1112, 2, 'C', NULL, 8, 'Tuesday', 'TK08', 'T02'),
(1113, 2, 'C', 'C1', 1, 'Wednesday', 'TK09', 'T05'),
(1114, 2, 'C', 'C2', 1, 'Wednesday', 'TK12', 'T14'),
(1115, 2, 'C', 'C3', 1, 'Wednesday', 'TK12', 'T11'),
(1116, 2, 'C', NULL, 2, 'Wednesday', 'OFF', 'OFF'),
(1117, 2, 'C', NULL, 3, 'Wednesday', 'OFF', 'OFF'),
(1118, 2, 'C', NULL, 4, 'Wednesday', 'TK01', 'T07'),
(1119, 2, 'C', NULL, 5, 'Wednesday', 'TK02', 'T05'),
(1120, 2, 'C', NULL, 6, 'Wednesday', 'OFF', 'OFF'),
(1121, 2, 'C', NULL, 7, 'Wednesday', 'TK07', 'T09'),
(1122, 2, 'C', NULL, 8, 'Wednesday', 'TK02', 'T05'),
(1123, 2, 'C', NULL, 1, 'Thursday', 'OFF', 'OFF'),
(1124, 2, 'C', NULL, 2, 'Thursday', 'TK01', 'T07'),
(1125, 2, 'C', NULL, 3, 'Thursday', 'OFF', 'OFF'),
(1126, 2, 'C', 'C1', 4, 'Thursday', 'TK10', 'T02'),
(1127, 2, 'C', 'C2', 4, 'Thursday', 'TK09', 'T05'),
(1128, 2, 'C', 'C3', 4, 'Thursday', 'TK11', 'T12'),
(1129, 2, 'C', NULL, 5, 'Thursday', 'OFF', 'OFF'),
(1130, 2, 'C', NULL, 6, 'Thursday', 'OFF', 'OFF'),
(1131, 2, 'C', NULL, 7, 'Thursday', 'TK05', 'T14'),
(1132, 2, 'C', NULL, 8, 'Thursday', 'TK04', 'T12'),
(1133, 2, 'C', 'C1', 1, 'Friday', 'TK09', 'T05'),
(1134, 2, 'C', 'C2', 1, 'Friday', 'TK11', 'T12'),
(1135, 2, 'C', 'C3', 1, 'Friday', 'TK09', 'T01'),
(1136, 2, 'C', NULL, 2, 'Friday', 'OFF', 'OFF'),
(1137, 2, 'C', NULL, 3, 'Friday', 'OFF', 'OFF'),
(1138, 2, 'C', NULL, 4, 'Friday', 'TK01', 'T07'),
(1139, 2, 'C', NULL, 5, 'Friday', 'TK04', 'T12'),
(1140, 2, 'C', NULL, 6, 'Friday', 'OFF', 'OFF'),
(1141, 2, 'C', NULL, 7, 'Friday', 'TK02', 'T05'),
(1142, 2, 'C', NULL, 8, 'Friday', 'TK02', 'T05'),
(1143, 2, 'C', NULL, 1, 'Saturday', 'TK06', 'T13'),
(1144, 2, 'C', NULL, 2, 'Saturday', 'OFF', 'OFF'),
(1145, 2, 'C', NULL, 3, 'Saturday', 'OFF', 'OFF'),
(1146, 2, 'C', 'C1', 4, 'Saturday', 'OFF', 'OFF'),
(1147, 2, 'C', 'C2', 4, 'Saturday', 'TK09', 'T05'),
(1148, 2, 'C', 'C3', 4, 'Saturday', 'OFF', 'OFF'),
(1149, 2, 'C', NULL, 5, 'Saturday', 'OFF', 'OFF'),
(1150, 2, 'C', NULL, 6, 'Saturday', 'OFF', 'OFF'),
(1151, 2, 'C', NULL, 7, 'Saturday', 'OFF', 'OFF'),
(1152, 2, 'C', NULL, 8, 'Saturday', 'OFF', 'OFF');

-- --------------------------------------------------------

--
-- Table structure for table `timetable_status`
--

CREATE TABLE `timetable_status` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable_status`
--

INSERT INTO `timetable_status` (`id`, `year`, `status`) VALUES
(1, 2, 1),
(2, 1, 0),
(3, 3, 0),
(4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`) VALUES
(1, 'deepak');

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
-- Indexes for table `batch_associations`
--
ALTER TABLE `batch_associations`
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
  ADD UNIQUE KEY `emailId` (`emailId`),
  ADD UNIQUE KEY `staff_alias` (`staff_alias`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `PRN` (`PRN`),
  ADD KEY `division` (`division`);

--
-- Indexes for table `student_enrollment`
--
ALTER TABLE `student_enrollment`
  ADD PRIMARY KEY (`roll`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_code`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staffid` (`staff`),
  ADD KEY `subject` (`subject`) USING BTREE;

--
-- Indexes for table `timetable_status`
--
ALTER TABLE `timetable_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `associations`
--
ALTER TABLE `associations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `batch_associations`
--
ALTER TABLE `batch_associations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1153;

--
-- AUTO_INCREMENT for table `timetable_status`
--
ALTER TABLE `timetable_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `division` FOREIGN KEY (`division`) REFERENCES `divisions` (`id`);

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `staffid` FOREIGN KEY (`staff`) REFERENCES `staff` (`staffId`),
  ADD CONSTRAINT `subject_code` FOREIGN KEY (`subject`) REFERENCES `subjects` (`subject_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
