-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 05:21 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engage`
--

-- --------------------------------------------------------

--
-- Table structure for table `facerecog`
--

CREATE TABLE `facerecog` (
  `slno` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `budget_slab` varchar(100) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `premium_products` varchar(200) NOT NULL,
  `average_product` varchar(200) NOT NULL,
  `image` varchar(500) NOT NULL,
  `additional` varchar(500) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facerecog`
--

INSERT INTO `facerecog` (`slno`, `name`, `budget_slab`, `contact_number`, `premium_products`, `average_product`, `image`, `additional`, `email`) VALUES
(1, 'Utkrishta Sinha', '1500-2000', '9670164523', 'Nike Jordan 2000 Sneakers. DIOR La Perfum', 'Ferrero Rocher, Krispy Kreme Donuts(Chocolate)', '/Components/face_recognition/images/saved_img_1.jpg', 'Showed interest in buying IFB Microwave ', 'krishsinha2@gmail.com'),
(2, '-', '-', '-', '-', '-', '/Components/face_recognition/images/saved_img_2.jpg', '-', '-'),
(3, '-', '-', '-', '-', '-', '/Components/face_recognition/images/saved_img_3.jpg', '-', '-'),
(4, '-', '-', '-', '-', '-', '/Components/face_recognition/images/saved_img_4.jpg', '-', '-'),
(5, '-', '-', '-', '-', '-', '/Components/face_recognition/images/saved_img_5.jpg', '-', '-'),
(6, 'Isha Rastogi', '2000', '-', '-', '-', '/Components/face_recognition/images/saved_img_6.jpg', '-', '-'),
(7, 'Isha Rastogi', '-', '-', '-', '-', '/Components/face_recognition/images/saved_img_7.jpg', '-', '-'),
(8, '-', '-', '-', '-', '-', '/Components/face_recognition/images/saved_img_8.jpg', '-', '-'),
(9, 'Isha Rastogi', '-', '-', '-', '-', '/Components/face_recognition/images/saved_img_9.jpg', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `objects`
--

CREATE TABLE `objects` (
  `id` int(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `count` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `objects`
--

INSERT INTO `objects` (`id`, `name`, `count`) VALUES
(1, 'bottle', '0'),
(2, 'cell phone', ' :1 '),
(3, 'toothbrush', ' :1 ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `facerecog`
--
ALTER TABLE `facerecog`
  ADD PRIMARY KEY (`slno`);

--
-- Indexes for table `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `facerecog`
--
ALTER TABLE `facerecog`
  MODIFY `slno` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
