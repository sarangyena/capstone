-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2024 at 12:27 AM
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
('E-000', 'FLORENDO, EDRIA A.', 'FARMER', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 'NEW'),
('O-006', 'FLORENDO, EDRIA A.', 'GENERAL MANAGER', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 'ACTIVE'),
('E-001', 'FLORENDO, EDRIA S.', 'FARMER', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 'NEW'),
('E-002', 'FLORENDO, EDRIA S.', 'SECRETARY', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 'NEW'),
('E-003', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', '2024-02-04', '06:52 AM', '2024-02-04', '06:52 AM', 'ACTIVE'),
('E-004', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', '2024-02-04', '06:52 AM', '2024-02-04', '06:53 AM', 'ACTIVE'),
('E-005', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-006', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-007', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-008', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-009', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-010', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-011', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-012', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-013', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-014', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW'),
('E-015', 'FLORENDO, EDRIA S.', 'FARMER', '', '', '', '', 'NEW');

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
('E-000', 'FLORENDO', 'EDRIA', 'ASD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-31 16:06:30', '$2y$10$X1oNKpnQmzqQkFLOzG3Zx.EdN/yWN1F5u0YndVFEBmOQcjHOGDk4a', ''),
('E-001', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-31 16:07:09', '$2y$10$lJ.91Ktjug3LTt65BtVElOdCZ5rDWYsHKK51M03OVnUcZ1ZGNSrHS', ''),
('E-002', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'SECRETARY', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-31 16:08:23', '$2y$10$zj2mDWa/q9zNM2zh6JqzBewjv0wztu4Ho0GJwCuot8dieeNxFaS7u', ''),
('E-003', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'GENERAL MANAGER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-31 16:28:36', '$2y$10$IasRnTEXyVS9uE4wbBlsleCpDv0.t4W1wHuyC0x06DXm9kSMVuGI2', ''),
('E-004', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'GENERAL MANAGER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-31 22:18:59', '$2y$10$eMtnYou8T8d0Yai9WPUu/uHkA82Y.WTiVWySTsPobdR9Y/m.nic4m', ''),
('E-005', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 17:22:21', '$2y$10$2WALHK85nnqMT1agLIIPtuqITNakJ3lvFH7J7kr3biKARiaxlp4tK', ''),
('E-006', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 17:25:41', '$2y$10$H/H1Wccg2eC141gjSJbXuOcbK2zSZR6S0fq0nrw4hCPEoseh9y2km', ''),
('E-007', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 17:27:21', '$2y$10$X2rBBYvNZ3kjBAGGtKdaYuUag.URgRkNlxCsWZxVR11qoMwr0sd2W', ''),
('E-008', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 17:28:21', '$2y$10$qjMvtiUikMMP1d0Hb1chpuVZEg15PGj.OxOdzHEnvcFMyd6cImiTm', ''),
('E-009', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 17:28:52', '$2y$10$5bDbNavt6sC.wLtMd5WOSOS8SpD3s85LhTmFQolexxdFT3Fl/a.yS', ''),
('E-010', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 17:56:28', '$2y$10$DcUG3fltq3GmJpAbVNltMeWCI8mjgrpJz5Cffz7BkMpLxQCOXSP0m', ''),
('E-011', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 18:25:40', '$2y$10$ghGGbG1.0w.bjbg9514JteuerSGySq0sxpIlwTP2rRRpcnLJKvJa6', ''),
('E-012', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 18:33:59', '$2y$10$56vlbcVM5h0H3nzny8.Gzu2cR71NYn5VfDPjiamPnCR5YxX8NamjO', ''),
('E-013', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 18:35:17', '$2y$10$CKcpnY5V.jgiPS6YelFwqemVm03RllAuAWVsmUY4J1cv/JglNaiia', ''),
('E-014', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 18:42:51', '$2y$10$0G0XWdXor8.OKgFel5KgJugKGfZsAlFnGzdQ79SYG3kRCVMQ4i7ra', ''),
('E-015', 'FLORENDO', 'EDRIA', 'SADSD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-02-03 18:55:23', '$2y$10$YGqGv7PLAsqUL4O1wLYclOcuYw7FS5qHCiJbeP/sz.rlyXtYXX/hK', '');

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
('E-003', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', '2024-02-04', '06:51 AM', '2024-02-04', '06:51 AM', '14.8443, 120.810204', 0, '1707000707'),
('E-003', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', '2024-02-04', '06:51 AM', '2024-02-04', '06:51 AM', '14.8443, 120.810204', 0, '1707000716'),
('E-003', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', '2024-02-04', '06:52 AM', '2024-02-04', '06:52 AM', '14.8443, 120.810204', 0, '1707000766'),
('E-004', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', '2024-02-04', '06:52 AM', '2024-02-04', '06:53 AM', '14.8443, 120.810204', 0, '1707000784'),
('E-003', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', '2024-02-04', '06:52 AM', '', '', '14.8443, 120.810204', 1, '1707000778');

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
('O-000', 'FLORENDO', 'EDRIA', 'ASDAD', 'DIVORCED', 'SDAWE2S@SDASDA', '213123', 'SECRETARY', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-16 08:59:43', '$2y$10$cXPyQq0f5V0yzUrXCUUIZ.uFZs1FHws8qkPOXt4tRF3L85Ik4PxhW'),
('O-001', 'FLORENDO', 'EDRIA', 'ASDAD', 'SINGLE', 'SDAWE2S@SDASDA', '213123', 'SECRETARY', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-16 09:02:28', '$2y$10$jYTkc3UJXzqrAVZy.rUsI.mLCfmoOetm6OUau7BrJWb7gaJhdFoiW'),
('O-002', 'FLORENDO', 'EDRIA', 'ASDAD', 'SINGLE', 'SDAWE2S@SDASDA', '213123', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-25 16:40:41', '$2y$10$m2hch6vWNGDOoSFh1prXt.59GkutvpYewOukKs6H3dhP1Rx3HXsP2'),
('O-003', 'FLORENDO', 'EDRIA', 'ASDAD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '213123', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-25 16:42:04', '$2y$10$Jd/0YxahaKYpdlaQiOefwuvfgHRimLf0H6PXttf0QNt28Vybxplv2'),
('O-004', 'FLORENDO', 'EDRIA', 'ASDAD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '213123', 'FARMER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-25 16:42:28', '$2y$10$iNm.Rkxus5IvkttZqsXpqe81858tC7ZKkN2t.AzqMDCrX0LdzqfDO'),
('O-005', 'FLORENDO', 'EDRIA', 'ASDAD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'GENERAL MANAGER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-31 15:38:20', '$2y$10$h8m95aWZQ3edJa8AF21Y7unoMiAPtwHlUIPG94Kr9O7L5jspeAt4K'),
('O-006', 'FLORENDO', 'EDRIA', 'ASDAD', 'SINGLE', 'EDRIANFLORENDO18@GMAIL.COM', '639062603486', 'GENERAL MANAGER', '3123123', '31232', '321321', '53413', 'EDASD', 'ADADA', '2123123', 'DADASDA', '2024-01-31 16:06:46', '$2y$10$Xj8D0sPDdnBbePTmBppFTuXPlhWAJ3IqxbnT54///J4ZJKLe80g4K');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `rate` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `late` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `rph` int(11) NOT NULL,
  `hrs` int(11) NOT NULL,
  `ot` int(11) NOT NULL,
  `holiday` int(11) NOT NULL,
  `philhealth` int(11) NOT NULL,
  `sss` int(11) NOT NULL,
  `advance` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `name`, `job`, `rate`, `days`, `late`, `salary`, `rph`, `hrs`, `ot`, `holiday`, `philhealth`, `sss`, `advance`, `total`) VALUES
('E-003', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', 500, 0, 0, 0, 0, 0, 0, 1000, 12312, 30, 40, 0),
('E-004', 'FLORENDO, EDRIA S.', 'GENERAL MANAGER', 231321, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-005', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-006', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-007', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-008', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-009', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-010', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-011', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-012', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-013', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-014', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('E-015', 'FLORENDO, EDRIA S.', 'FARMER', 53413, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
