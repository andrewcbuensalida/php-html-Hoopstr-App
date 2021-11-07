-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 08:20 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basketball_stats`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `game_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `activity`, `game_fk`) VALUES
(2, 'I made a 3-pointer', 1),
(3, 'I made a layup', 1),
(5, 'I made a layup', 2),
(6, 'I missed a layup', 2),
(7, 'I missed a layup', 2),
(8, 'I made a 3-pointer', 2),
(9, 'I made a 3-pointer', 280),
(10, 'I made a block', 279),
(11, 'I made a 3-pointer', 279),
(12, 'I missed a 3-pointer', 2),
(13, 'I missed a 3-pointer', 2),
(14, 'I made a layup', 2),
(15, 'I made an assist', 1),
(16, 'I made an assist', 1),
(17, 'I made a block', 1),
(18, 'I made a block', 1),
(19, 'I missed a 3-pointer', 1),
(20, 'I missed a layup', 279),
(21, 'I missed a layup', 279),
(22, 'I missed a layup', 279),
(23, 'I missed a layup', 279),
(24, 'I missed a layup', 279),
(25, 'I missed a layup', 279),
(26, 'I made a layup', 280),
(27, 'I made a layup', 280),
(28, 'I made a layup', 280),
(29, 'I made a layup', 280),
(30, 'I missed a 3-pointer', 280),
(31, 'I missed a 3-pointer', 280),
(32, 'I missed a 3-pointer', 280),
(33, 'I made a 3-pointer', 280),
(34, 'I made a layup', 279),
(35, 'I made a layup', 279),
(36, 'I made a layup', 279),
(37, 'I missed a 3-pointer', 279),
(38, 'I missed a 3-pointer', 279),
(39, 'I made a 3-pointer', 279),
(40, 'I missed a 3-pointer', 282),
(41, 'I made a 3-pointer', 282),
(42, 'I made a 3-pointer', 282),
(43, 'I made a 3-pointer', 282),
(44, 'I made a block', 282),
(45, 'I made a block', 282),
(46, 'I made a block', 282),
(47, 'I made a steal', 282),
(48, 'I made an assist', 282),
(49, 'I made a block', 280),
(50, 'I made a steal', 280),
(51, 'I made a steal', 280),
(52, 'I made a steal', 280),
(53, 'I missed a 3-pointer', 1),
(54, 'I missed a 3-pointer', 1),
(55, 'I missed a 3-pointer', 283),
(56, 'I missed a 3-pointer', 283),
(57, 'I missed a 3-pointer', 283),
(58, 'I missed a 3-pointer', 283),
(59, 'I missed a 3-pointer', 283),
(60, 'I made a steal', 284),
(61, 'I made a block', 284),
(62, 'I made a 3-pointer', 284),
(63, 'I made a block', 2),
(64, 'I made a jump shot', 284),
(65, 'I missed a 3-pointer', 284),
(66, 'I made a block', 284),
(67, 'I made a 3-pointer', 283),
(68, 'I made a block', 279),
(69, 'I made a block', 279),
(70, 'I made a layup', 283),
(71, 'I made a steal', 283),
(72, 'I made a 3-pointer', 281),
(73, 'I made an assist', 280),
(74, 'I made an assist', 2),
(75, 'I made a jump shot', 1),
(76, 'I made a 3-pointer', 280),
(77, 'I missed a jump shot', 284),
(78, 'I missed a 3-pointer', 285),
(79, 'I made a block', 285),
(80, 'I made a layup', 285),
(81, 'I made a jump shot', 285),
(82, 'I made a rebound', 1),
(83, 'I made a rebound', 285),
(84, 'I made a steal', 285),
(85, 'I turned it over', 285),
(86, 'I made an assist', 285),
(87, 'I turned it over', 279),
(88, 'I made a steal', 279),
(89, 'I made a rebound', 279),
(90, 'I missed a 3-pointer', 286),
(91, 'I made a 3-pointer', 286),
(92, 'I made a block', 286),
(93, 'I made a jump shot', 287),
(94, 'I missed a 3-pointer', 287);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `game_title` varchar(255) NOT NULL,
  `game_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `game_title`, `game_date`) VALUES
(1, '5v5 against Tall dude', '2020-05-13'),
(2, '2v2 Sore game', '2020-05-21'),
(279, '5v5 against noobs', '2020-05-01'),
(280, '1v1 against globe trotter', '2020-05-21'),
(281, 'Freethrow shootout', '2020-05-24'),
(282, '4v4 Full stomach', '2020-05-26'),
(283, 'Have to urinate ', '2020-05-14'),
(284, 'Had to poop', '2020-05-10'),
(285, 'Lack of sleep', '2020-05-27'),
(286, '2v2 Against John', '2020-05-27'),
(287, '3v3 against jim', '2020-05-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_fk` (`game_fk`) USING BTREE;

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`game_fk`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
