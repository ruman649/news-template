-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 06:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(10) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `categoryPost` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categoryPost`) VALUES
(23, 'tv', 3),
(24, 'it', 3),
(25, 'edu', 2),
(26, 'sport', 1),
(27, 'nai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_table`
--

CREATE TABLE `post_table` (
  `postId` int(10) NOT NULL,
  `postTitle` varchar(200) NOT NULL,
  `postDesc` text NOT NULL,
  `postDate` varchar(50) NOT NULL,
  `postImg` varchar(50) NOT NULL,
  `postCategory` varchar(255) NOT NULL,
  `autor` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_table`
--

INSERT INTO `post_table` (`postId`, `postTitle`, `postDesc`, `postDate`, `postImg`, `postCategory`, `autor`) VALUES
(55, 'ami b', 'aikahbe b onek kicho likhbe', '25 Oct 2022', '76416tyler-franta-iusJ25iYu1c-unsplash.jpg', '27', 35),
(58, 'na hoi ami amake mare pelbo', 'kino ze amon ata hoi', '25 Oct 2022', '71049studio-republic-fotKKqWNMQ4-unsplash.jpg', '24', 37),
(59, 'aita dekar jonno', 'aita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonnoaita dekar jonno', '26 Oct 2022', '63382hunters-race-MYbhN8KaaEc-unsplash.jpg', '24', 35),
(60, 'g', 'sfdg', '26 Oct 2022', '81830studio-republic-fotKKqWNMQ4-unsplash.jpg', '23', 35),
(61, 'adfa', 'asfaf', '26 Oct 2022', '77020mobile2.jpg', '25', 35),
(62, 'adsf', 'afsf', '26 Oct 2022', '80456tyler-franta-iusJ25iYu1c-unsplash.jpg', '23', 35),
(63, 'adfa', 'faf', '26 Oct 2022', '72900stil-8-GAoVpIk4M-unsplash.jpg', '23', 35),
(64, 'afdf', 'af', '26 Oct 2022', '73342craig-garner-YoadQb46v6k-unsplash.jpg', '25', 35),
(65, 'afadf', 'adfdasf', '26 Oct 2022', '94549new-data-services-nZ50HrjAFNc-unsplash.jpg', '26', 35),
(66, 'adf', 'adfdf', '26 Oct 2022', '64508tyler-franta-iusJ25iYu1c-unsplash.jpg', '24', 35);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `websiteName` varchar(64) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `footerDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`websiteName`, `logo`, `footerDesc`) VALUES
('topNews.com', 'Captain_News_logo.jpg', '@copy right from 2000 to 2023 by Ruman Miah and love');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userPass` text NOT NULL,
  `userRole` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `firstName`, `lastName`, `userName`, `userPass`, `userRole`) VALUES
(33, 'a', 'a', 'a', 'a', 1),
(35, 'b', 'b', 'b', '$2y$10$qa8KCp/VhT0qqwLdQO7YIO1ROJG5rs2IPood1G5YuOlDlm0yaMKfe', 1),
(36, 'c', 'c', 'c', '$2y$10$QocqKw5ptlOSSXEAi8upg.ybzQSK3Pp19aX/qeeLGYdWtAsmACZ32', 1),
(37, 'q', 'q', 'q', '$2y$10$vTjrQH5dBs0YeAyC5zGDEOCHzjJTPUadnmrYWHZgSl7BH.7FdUQWq', 0),
(38, 'w', 'w', 'w', '$2y$10$JAReFyKNa1zI25E7tMjlROtTqjoHiysYK8g8cgyX1nIZyPL5bbGrW', 0),
(39, 'e', 'e', 'e', '$2y$10$2ijxwtEQM.Of8MngBTlGS.t32bCQaNrEENCvbhdwPaW/jPGARWc7u', 0),
(40, 'admin', 'x', 'x', '$2y$10$KaN8Ov8Q4SzCuRczBGv4L.hNkDT8.hAJ23j8R8HIh28RTT5byab82', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `post_table`
--
ALTER TABLE `post_table`
  ADD PRIMARY KEY (`postId`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `post_table`
--
ALTER TABLE `post_table`
  MODIFY `postId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
