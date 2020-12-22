-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2020 at 04:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `citrus`
--
CREATE DATABASE IF NOT EXISTS `citrus` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `citrus`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `allowed` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `name`, `email`, `comment`, `allowed`, `created_at`, `updated_at`) VALUES
(1, 'Anastasija', 'anastasija@gmail.com', 'Your citruses are the best', '1', '2020-12-21 13:15:35', '2020-12-22 15:52:45'),
(2, 'Teodora', 'teodora@gmail.com', 'I dont like oranges', '0', '2020-12-21 13:18:08', '2020-12-22 15:52:06'),
(3, 'Milena', 'milena@gmail.com', 'Test Comment', '0', '2020-12-21 13:15:35', '2020-12-22 15:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'limun.jpg', 'Limun 1kg', 'Kilogram limuna za 89,99 RSD', '2020-12-21 14:39:24', '2020-12-21 14:49:26'),
(2, 'pomorandza.png', 'Pomorandza 1kg', 'Kilogram pomorandzi za 134,12 RSD', '2020-12-21 14:40:19', '2020-12-21 16:42:24'),
(3, 'grejp.jpg', 'Crveni grejp 1kg', 'Kilogram crvenog grejpa za 190,21 RSD', '2020-12-21 14:47:10', '2020-12-21 14:50:12'),
(15, 'limun.jpg', 'Limun 1kg', 'Kilogram limuna za 89,99 RSD', '2020-12-21 14:39:24', '2020-12-21 14:49:26'),
(16, 'pomorandza.png', 'Pomorandza 1kg', 'Kilogram pomorandzi za 134,12 RSD', '2020-12-21 14:40:19', '2020-12-21 16:42:24'),
(17, 'grejp.jpg', 'Crveni grejp 1kg', 'Kilogram crvenog grejpa za 190,21 RSD', '2020-12-21 14:47:10', '2020-12-21 14:50:12'),
(18, 'limun.jpg', 'Limun 1kg', 'Kilogram limuna za 89,99 RSD', '2020-12-21 14:39:24', '2020-12-21 14:49:26'),
(19, 'pomorandza.png', 'Pomorandza 1kg', 'Kilogram pomorandzi za 134,12 RSD', '2020-12-21 14:40:19', '2020-12-21 16:42:24'),
(20, 'grejp.jpg', 'Crveni grejp 1kg', 'Kilogram crvenog grejpa za 190,21 RSD', '2020-12-21 14:47:10', '2020-12-21 14:50:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
