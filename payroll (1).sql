-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 05:15 PM
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
-- Database: `payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `sss` varchar(50) NOT NULL,
  `philhealth` varchar(50) NOT NULL,
  `pagibig` varchar(50) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `eName` varchar(50) NOT NULL,
  `ePhone` varchar(50) NOT NULL,
  `eAddress` varchar(255) NOT NULL,
  `hired` varchar(50) NOT NULL,
  `hashed` varchar(255) NOT NULL,
  `qr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `dateIn` varchar(255) NOT NULL,
  `timeIn` varchar(255) NOT NULL,
  `dateOut` varchar(255) NOT NULL,
  `timeOut` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`id`, `name`, `job`, `dateIn`, `timeIn`, `dateOut`, `timeOut`, `status`) VALUES
('E-000', 'FLORENDO, EDRIAN E.', 'TECH SUPPORT', '2024-02-05', '11:41 PM', '2024-02-05', '11:22 PM', 'ACTIVE'),
('E-001', 'FLORENDO, EDRIAN E.', 'SECRETARY', '2024-02-05', '11:41 PM', '2024-02-05', '11:38 PM', 'ACTIVE'),
('O-000', 'FLORENDO, EDRIAN E.', 'GENERAL MANAGER', '', '', '', '', 'NEW');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `sss` varchar(50) NOT NULL,
  `philhealth` varchar(50) NOT NULL,
  `pagibig` varchar(50) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `eName` varchar(50) NOT NULL,
  `ePhone` varchar(50) NOT NULL,
  `eAddress` varchar(255) NOT NULL,
  `hired` varchar(50) NOT NULL,
  `hashed` varchar(255) NOT NULL,
  `qr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `last`, `first`, `middle`, `status`, `email`, `phone`, `job`, `sss`, `philhealth`, `pagibig`, `rate`, `address`, `eName`, `ePhone`, `eAddress`, `hired`, `hashed`, `qr`) VALUES
('E-000', 'FLORENDO', 'EDRIAN', 'ERNESTO', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '09550840452', 'TECH SUPPORT', '12345', '12345', '12345', '430', '1319 STO.CRISTO EXT. ST. TONDO, MANILA', 'EDRIAN ERNESTO FLORENDO', '09550840452', '1319 STO.CRISTO EXT. ST. TONDO, MANILA', '2024-02-05 10:53:36', '$2y$10$cBDUvhJuM3F/3wvd5R2uKetsUerW7OF7Y7ZB.t8Ql7oa4zi/Ld8y6', ''),
('E-001', 'FLORENDO', 'EDRIAN', 'ERNESTO', 'MARRIED', 'EDRIANFLORENDO18@GMAIL.COM', '09550840452', 'SECRETARY', '12345', '12345', '12345', '430', '1319 STO.CRISTO EXT. ST. TONDO, MANILA', 'EDRIAN ERNESTO FLORENDO', '09550840452', '1319 STO.CRISTO EXT. ST. TONDO, MANILA', '2024-02-05 23:33:00', '$2y$10$TYP9nMuKbo7MKJO6h0/N1uglCfZi8mqWVvXEffllXXzFesEAyMvEm', '');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `uid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`uid`, `name`, `size`, `type`, `path`) VALUES
('E-000', 'E-000.jpg', '547284', 'image/jpeg', '../private/images/employee/E-000.jpg'),
('E-001', 'E-001.jpg', '547284', 'image/jpeg', '../private/images/employee/E-001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `dateIn` varchar(255) NOT NULL,
  `timeIn` varchar(255) NOT NULL,
  `dateOut` varchar(255) NOT NULL,
  `timeOut` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `log` tinyint(1) NOT NULL,
  `updateTime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `name`, `job`, `dateIn`, `timeIn`, `dateOut`, `timeOut`, `location`, `log`, `updateTime`) VALUES
('E-000', 'FLORENDO, EDRIAN E.', 'TECH SUPPORT', '2024-02-05', '08:10 AM', '2024-02-05', '12:30 PM', 'AL DAWAH PRODUCERS COOPERATIVE', 0, '1707101901'),
('E-000', 'FLORENDO, EDRIAN E.', 'TECH SUPPORT', '2024-02-05', '01:10 PM', '2024-02-05', '09:30 PM', 'AL DAWAH PRODUCERS COOPERATIVE', 0, '1707146531'),
('E-001', 'FLORENDO, EDRIAN E.', 'SECRETARY', '2024-02-05', '09:30 AM', '2024-02-05', '12:10 PM', 'AL DAWAH PRODUCERS COOPERATIVE', 0, '1707147232'),
('E-001', 'FLORENDO, EDRIAN E.', 'SECRETARY', '2024-02-05', '01:30 PM', '2024-02-05', '08:30 PM', 'AL DAWAH PRODUCERS COOPERATIVE', 0, '1707147498'),
('E-000', 'FLORENDO, EDRIAN E.', 'TECH SUPPORT', '2024-02-05', '11:41 PM', '', '', 'AL DAWAH PRODUCERS COOPERATIVE', 1, '1707147663'),
('E-001', 'FLORENDO, EDRIAN E.', 'SECRETARY', '2024-02-05', '11:41 PM', '', '', 'AL DAWAH PRODUCERS COOPERATIVE', 1, '1707147668');

-- --------------------------------------------------------

--
-- Table structure for table `oncall`
--

CREATE TABLE `oncall` (
  `id` varchar(50) NOT NULL,
  `last` varchar(50) NOT NULL,
  `first` varchar(50) NOT NULL,
  `middle` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `sss` varchar(50) NOT NULL,
  `philhealth` varchar(50) NOT NULL,
  `pagibig` varchar(50) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `eName` varchar(50) NOT NULL,
  `ePhone` varchar(50) NOT NULL,
  `eAddress` varchar(255) NOT NULL,
  `hired` varchar(50) NOT NULL,
  `hashed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oncall`
--

INSERT INTO `oncall` (`id`, `last`, `first`, `middle`, `status`, `email`, `phone`, `job`, `sss`, `philhealth`, `pagibig`, `rate`, `address`, `eName`, `ePhone`, `eAddress`, `hired`, `hashed`) VALUES
('O-000', 'FLORENDO', 'EDRIAN', 'ERNESTO', 'DIVORCED', 'EDRIANFLORENDO18@GMAIL.COM', '09550840452', 'GENERAL MANAGER', '12345', '12345', '12345', '430', '1319 STO.CRISTO EXT. ST. TONDO, MANILA', 'EDRIAN ERNESTO FLORENDO', '09550840452', '1319 STO.CRISTO EXT. ST. TONDO, MANILA', '2024-02-05 23:48:25', '$2y$10$ay99AGaJT3.3hqFK9ukYQ.OYDR5KpRWDuL402fbHyUfLU0i3UFTDO');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `rate` float NOT NULL,
  `days` float NOT NULL,
  `late` float NOT NULL,
  `salary` float NOT NULL,
  `rph` float NOT NULL,
  `hrs` float NOT NULL,
  `ot` float NOT NULL,
  `holiday` float NOT NULL,
  `philhealth` float NOT NULL,
  `sss` float NOT NULL,
  `advance` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `name`, `job`, `rate`, `days`, `late`, `salary`, `rph`, `hrs`, `ot`, `holiday`, `philhealth`, `sss`, `advance`, `total`) VALUES
('E-000', 'FLORENDO, EDRIAN E.', 'TECH SUPPORT', 430, 14, 7, 6396.25, 64.5, 3.5, 225.75, 0, 0, 0, 0, 6622),
('E-001', 'FLORENDO, EDRIAN E.', 'SECRETARY', 430, 1, 1.75, 524.062, 64.5, 2.5, 161.25, 0, 0, 0, 0, 685.312);

-- --------------------------------------------------------

--
-- Table structure for table `qrcode`
--

CREATE TABLE `qrcode` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `imageData` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `username` varchar(255) NOT NULL,
  `hashed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`username`, `hashed`) VALUES
('admin', '$2y$10$UqdqO2LBR11Wz98f4AJtmuRfi.PZfnxcA581Kufpi/tOsnLCCU0iS');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
