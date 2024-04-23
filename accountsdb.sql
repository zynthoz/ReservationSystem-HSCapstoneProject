-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 07:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` int(100) NOT NULL,
  `Privilege` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `Username`, `Password`, `Email`, `Phone`, `Privilege`) VALUES
(5, 'Francisco Chan III', '213123213', 'francisco.dthird@gmail.com', 2147483647, 'Outsider'),
(6, 'test1', 'asdsadsad', 'test1@gmail.com', 69696969, 'Outsider'),
(7, 'test12', '21313ss', 'test12@gmail.com', 2147483647, 'Outsider'),
(8, 'test', 'test12345', 'test@gmail.com', 123, 'Outsider'),
(9, 'Aaron Gabriel', 'password123', 'lim@lsqc.edu.ph', 912345678, 'Outsider');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `ID` int(100) NOT NULL,
  `Facility` varchar(100) NOT NULL,
  `Floor` varchar(100) NOT NULL,
  `Access` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`ID`, `Facility`, `Floor`, `Access`, `Description`) VALUES
(11, 'Swimming Pool', '4th Floor', 'Private', 'swim'),
(12, 'Golf Course', '3rd Floor', 'Private', 'golf'),
(13, 'Tennis Court', 'Grounds', 'Public', 'tennis');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `ID` int(100) NOT NULL,
  `Timestamp` int(100) NOT NULL DEFAULT current_timestamp(),
  `User` varchar(100) NOT NULL,
  `Account No.` int(100) NOT NULL,
  `Action` varchar(100) NOT NULL,
  `Privilege` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `Ticket ID` int(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Facility` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`Ticket ID`, `Date`, `Name`, `Facility`, `Status`, `Reason`) VALUES
(1, '', '', '', 'Pending', ''),
(1293801, '02/15/2024', 'Russell', 'Physics Laboratory', 'Pending', 'Project Making'),
(21333566, '01/16/2024', 'Elijah', 'Room 307', 'Reserved', 'Classes'),
(32133455, '02/25/2024', 'Lim', 'GS Gym', 'Reserved', 'Basketball Tournament\r\n'),
(95925492, '03/23/2024', 'Santos', 'Computer Laboratory', 'Pending', 'Computer Class'),
(123123123, '02/01/2024', 'Chan', 'HS Gym', 'Reserved', 'Volleyball Tournament'),
(2131239929, '02/13/2024', 'Jedric', 'Library', 'Pending', 'Interview'),
(2131239930, '2024-02-28', '', '', 'Pending', 'hi po'),
(2131239931, '2024-02-27', '', 'Golf Course', 'Pending', 'for da connections pare yk'),
(2131239932, '2024-02-21', '', 'Tennis Court', 'Pending', 'i like tennis duhh'),
(2131239933, '2024-02-29', 'Aaron Gabriel', 'Tennis Court', 'Pending', '2nd times the charm yk'),
(2131239934, '2024-02-07', 'Francisco Chan III', 'Swimming Pool', 'Pending', 'testing kiko dapat lumabas papakamatay ako pag hinde'),
(2131239935, '', 'Aaron Gabriel', '', 'Pending', ''),
(2131239936, '', 'Aaron Gabriel', '', 'Pending', ''),
(2131239937, '2024-02-15', 'Aaron Gabriel', 'Swimming Pool', 'Pending', 'asdfasdasdasdasdasdasda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`Ticket ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `Ticket ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2131239938;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
