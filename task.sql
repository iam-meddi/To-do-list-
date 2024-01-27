-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2023 at 04:24 PM
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
-- Database: `To-List`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `tNam` varchar(20) NOT NULL,
  `tDes` text NOT NULL,
  `dDate` date NOT NULL,
  `pLvl` varchar(20) NOT NULL,
  `stat` varchar(20) NOT NULL,
  `cat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`tNam`, `tDes`, `dDate`, `pLvl`, `stat`, `cat`) VALUES
('Water', ' Water the plants', '2023-12-22', 'low', 'completed', 'Home'),
('Revision ', 'Read and practice ', '2023-12-30', 'high', 'in progress', 'School'),
('ask', 'ask teacher ', '2023-12-21', 'high', 'in progress', 'school');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
