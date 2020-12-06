-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2020 at 12:14 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photogal`
--

-- --------------------------------------------------------

--
-- Table structure for table `like_pic`
--

CREATE TABLE `like_pic` (
  `count` int(13) NOT NULL,
  `MID` int(11) NOT NULL,
  `picID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_pic`
--

INSERT INTO `like_pic` (`count`, `MID`, `picID`) VALUES
(10, 15, 35);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tmp_picprofile` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MID`, `username`, `password`, `firstname`, `lastname`, `email`, `tmp_picprofile`) VALUES
(15, 'zemorez', '12345', 'chaiyapol3', 'mahajan3', 'zemorez@gmail.com4', ''),
(16, 'zemorez1', '1234', 'test', 'test', 'test@gmail.com', ''),
(17, 'admin', '1234', 'admin', 'admin', 'admin2@mail.com', ''),
(18, 'admin2', '1234', 'Chiyapol', 'Mahajan', 'admintest@mail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `picID` int(11) NOT NULL,
  `MID` int(11) NOT NULL,
  `picname` varchar(20) NOT NULL,
  `tmp_name` varchar(30) NOT NULL,
  `upload_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `picture`
--

INSERT INTO `picture` (`picID`, `MID`, `picname`, `tmp_name`, `upload_at`) VALUES
(29, 17, '1602318135.jpg', '../uploads/1602318135.jpg', '2020-10-10 08:22:15'),
(30, 17, '1602318159.jpg', '../uploads/1602318159.jpg', '2020-10-10 08:22:39'),
(31, 17, '1602318170.jpg', '../uploads/1602318170.jpg', '2020-10-10 08:22:50'),
(32, 17, '1602318179.jpg', '../uploads/1602318179.jpg', '2020-10-10 08:22:58'),
(33, 17, '1602423835.jpg', '../uploads/1602423835.jpg', '2020-10-11 13:43:54'),
(34, 15, '1602581081.jpg', '../uploads/1602581081.jpg', '2020-10-13 09:24:40'),
(35, 15, '1602749823.jpg', '../uploads/1602749823.jpg', '2020-10-15 08:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tagID` int(11) NOT NULL,
  `tagname` varchar(20) NOT NULL,
  `picID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tagID`, `tagname`, `picID`) VALUES
(28, 'CS61', 29),
(29, 'Girls', 30),
(30, 'Man', 31),
(31, 'Mountain', 32),
(32, 'Girls', 33),
(33, 'sundown', 34),
(34, 'dog', 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `like_pic`
--
ALTER TABLE `like_pic`
  ADD PRIMARY KEY (`count`),
  ADD KEY `fk_like_MID` (`MID`),
  ADD KEY `fk_like_picID` (`picID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MID`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`picID`),
  ADD KEY `fk_mid` (`MID`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tagID`),
  ADD KEY `fk_picIDfortag` (`picID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `like_pic`
--
ALTER TABLE `like_pic`
  MODIFY `count` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `picID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tagID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `like_pic`
--
ALTER TABLE `like_pic`
  ADD CONSTRAINT `fk_like_MID` FOREIGN KEY (`MID`) REFERENCES `member` (`MID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_like_picID` FOREIGN KEY (`picID`) REFERENCES `picture` (`picID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `fk_mid` FOREIGN KEY (`MID`) REFERENCES `member` (`MID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `fk_picIDfortag` FOREIGN KEY (`picID`) REFERENCES `picture` (`picID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
