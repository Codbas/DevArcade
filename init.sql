-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 20, 2024 at 07:11 PM
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
-- Database: `DevArcade`
--

-- --------------------------------------------------------

--
-- Table structure for table `DevLogs`
--

CREATE TABLE `DevLogs` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DevLogs`
--

INSERT INTO `DevLogs` (`id`, `title`, `description`) VALUES
(1, 'Dev Log - Game One', 'This is the first Dev Log, appropriately named \"Dev Log - Game One\". Learn how I made this simple, but addicting game!'),
(2, 'Dev Log - Game Two', 'The second Dev Log made for DevArcade. This one should be a doozy! Get strapped in, because you\'re in for a ride.'),
(3, 'Dev Log - Game Three', 'The third, and possible final Dev Log. This one is no different than the others... or is it?');

-- --------------------------------------------------------

--
-- Table structure for table `DevLogViews`
--

CREATE TABLE `DevLogViews` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `devLogId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `FailedLogin`
--

CREATE TABLE `FailedLogin` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `FailedLogin`
--

INSERT INTO `FailedLogin` (`timestamp`, `ip`) VALUES
('2024-05-14 01:30:37', '127.0.0.1'),
('2024-05-14 01:43:00', '127.0.0.1'),
('2024-05-14 01:54:00', '127.0.0.1'),
('2024-05-14 02:08:38', '127.0.0.1'),
('2024-05-17 18:31:12', '127.0.0.1'),
('2024-05-17 18:31:37', '127.0.0.1'),
('2024-05-17 18:31:44', '127.0.0.1'),
('2024-05-17 18:32:18', '127.0.0.1'),
('2024-05-17 18:37:22', '127.0.0.1'),
('2024-05-17 22:25:00', '127.0.0.1'),
('2024-05-18 00:40:08', '127.0.0.1'),
('2024-05-18 02:12:42', '127.0.0.1'),
('2024-05-18 02:13:30', '127.0.0.1'),
('2024-05-18 02:13:31', '127.0.0.1'),
('2024-05-18 02:13:32', '127.0.0.1'),
('2024-05-18 02:13:33', '127.0.0.1'),
('2024-05-18 02:14:22', '127.0.0.1'),
('2024-05-18 02:14:23', '127.0.0.1'),
('2024-05-18 02:14:24', '127.0.0.1'),
('2024-05-18 02:14:25', '127.0.0.1'),
('2024-05-18 02:24:51', '127.0.0.1'),
('2024-05-18 02:38:10', '127.0.0.1'),
('2024-05-18 02:38:25', '127.0.0.1'),
('2024-05-18 02:39:05', '127.0.0.1'),
('2024-05-18 05:02:02', '127.0.0.1'),
('2024-05-18 10:48:03', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `GamePlays`
--

CREATE TABLE `GamePlays` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `gameId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Games`
--

CREATE TABLE `Games` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Games`
--

INSERT INTO `Games` (`id`, `title`, `description`) VALUES
(1, 'Game One', 'This is the first game, appropriately named \"Game One\". It is a simple game where you try to click the button, but it has plans of its own. :)'),
(2, 'Game Two', 'The second game made for DevArcade. It\'s exactly the same as Game One!'),
(3, 'Game Three', 'The third, and possible final game. This one is no different than the others.');

-- --------------------------------------------------------

--
-- Table structure for table `Pages`
--

CREATE TABLE `Pages` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Pages`
--

INSERT INTO `Pages` (`id`, `name`) VALUES
(1, 'Home'),
(2, 'Games'),
(3, 'Dev Logs'),
(4, 'About'),
(5, 'Log In');

-- --------------------------------------------------------

--
-- Table structure for table `PageViews`
--

CREATE TABLE `PageViews` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `pageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

CREATE TABLE `Sessions` (
  `sessionId` varchar(255) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `lastActive` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SiteHits`
--

CREATE TABLE `SiteHits` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SuccessfulLogin`
--

CREATE TABLE `SuccessfulLogin` (
  `timestamp` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `userName` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`userName`, `password`) VALUES
('cody', '$2y$10$YS6RTyB6l2VjCp8h2q9Ffuc49iYKIsHP/c9gsqj5TSBTyst7UyH6K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DevLogs`
--
ALTER TABLE `DevLogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `DevLogViews`
--
ALTER TABLE `DevLogViews`
  ADD KEY `devLogId` (`devLogId`);

--
-- Indexes for table `FailedLogin`
--
ALTER TABLE `FailedLogin`
  ADD PRIMARY KEY (`timestamp`,`ip`);

--
-- Indexes for table `GamePlays`
--
ALTER TABLE `GamePlays`
  ADD KEY `gameId` (`gameId`);

--
-- Indexes for table `Games`
--
ALTER TABLE `Games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Pages`
--
ALTER TABLE `Pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PageViews`
--
ALTER TABLE `PageViews`
  ADD KEY `pageId` (`pageId`);

--
-- Indexes for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD PRIMARY KEY (`sessionId`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `SiteHits`
--
ALTER TABLE `SiteHits`
  ADD PRIMARY KEY (`timestamp`,`ip`);

--
-- Indexes for table `SuccessfulLogin`
--
ALTER TABLE `SuccessfulLogin`
  ADD PRIMARY KEY (`username`,`ip`,`timestamp`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DevLogs`
--
ALTER TABLE `DevLogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Games`
--
ALTER TABLE `Games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Pages`
--
ALTER TABLE `Pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DevLogViews`
--
ALTER TABLE `DevLogViews`
  ADD CONSTRAINT `devlogviews_ibfk_1` FOREIGN KEY (`devLogId`) REFERENCES `DevLogs` (`id`);

--
-- Constraints for table `GamePlays`
--
ALTER TABLE `GamePlays`
  ADD CONSTRAINT `gameplays_ibfk_1` FOREIGN KEY (`gameId`) REFERENCES `Games` (`id`);

--
-- Constraints for table `PageViews`
--
ALTER TABLE `PageViews`
  ADD CONSTRAINT `pageviews_ibfk_1` FOREIGN KEY (`pageId`) REFERENCES `Pages` (`id`);

--
-- Constraints for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `Users` (`userName`);

--
-- Constraints for table `SuccessfulLogin`
--
ALTER TABLE `SuccessfulLogin`
  ADD CONSTRAINT `successfullogin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `Users` (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
