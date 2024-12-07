-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 04:49 PM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `description`, `price`, `image`, `created_at`) VALUES
(1, 'Kobor', 'Jashim Uddin', 'A classic novel.', 150.00, 'kobor.jpg', '2024-11-30 11:08:36'),
(2, 'Devdas', 'Sharatchandra Chattapadhay', '', 129.00, 'devdas.jpg', '2024-11-30 11:08:36'),
(3, 'Gitanjali', 'Rabindranath Tagore', '', 140.00, 'gitanjali.jpg', '2024-11-30 11:08:36'),
(4, 'Aguner Poroshmoni', 'Humayun Ahmed', '', 199.00, 'Aguner-Poroshmoni.jpg', '0000-00-00 00:00:00'),
(5, 'Hajar Bochor Dhore', 'Johir Rayhan', '', 159.00, 'hajar bochor dhore.jpg', '0000-00-00 00:00:00'),
(6, 'Himur Haate Koyekti Nil Poddo', 'Humayun Ahmed', '', 159.00, 'himur hate nil poddo.jpg', '0000-00-00 00:00:00'),
(7, 'Bristi O Meghomala', 'Humayun Ahmed', '', 150.00, 'Brishti-O-Meghomala-by-Humayun-Ahmed.jpg', '0000-00-00 00:00:00'),
(8, 'Borof Golaa Nodi', 'Johir Rayhan', '', 199.00, 'borof gola nodi.jpg', '0000-00-00 00:00:00'),
(9, 'Deshe Bideshe', 'Soiyod Mujtoba Ali', '', 199.00, 'deshe bideshe.jpg', '0000-00-00 00:00:00'),
(10, 'Shorger Pasher Bari', 'Shyamol Gongopaddhay', '', 150.00, 'download (1).jpg', '0000-00-00 00:00:00'),
(11, 'Ekattorer Dinguli', 'Jahanara Imam', '', 180.00, 'ekattorer dinguli.jpg', '0000-00-00 00:00:00'),
(12, 'Golpoguccho', 'Rabindranath Tagore', '', 299.00, 'golpoguccho.jpg', '0000-00-00 00:00:00'),
(13, 'kakababu Somogro', 'Shunil Gongopaddhay', '', 199.00, 'kakababu.jpg', '0000-00-00 00:00:00'),
(14, 'Shatkahon', 'Somoresh Majumder', '', 179.00, 'satkahon.jpg', '0000-00-00 00:00:00'),
(15, 'Shesher Kobita', 'Rabindranath Tagore', '', 199.00, 'shesher kobita.jpg', '0000-00-00 00:00:00'),
(16, 'Durbin', 'Shirshendu Mukhopaddhay', '', 200.00, 'durbin.jpg', '0000-00-00 00:00:00'),
(17, 'Oporajito', 'Bibhutibhushan Bondopaddhay', '', 160.00, 'oporajito.jpg', '0000-00-00 00:00:00'),
(18, 'Putul Nacher Itikotha', 'Manik Bondopaddhay', '', 180.00, 'Putul Nacher Itikatha.jpg', '0000-00-00 00:00:00'),
(19, 'Parthib', 'Shirshendu Mukhopaddhay', '', 199.00, 'parthib.jpg', '0000-00-00 00:00:00'),
(20, 'Tenida Somogro', 'Narayan Gongopaddhay', '', 230.00, 'Tenida_samagra.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(3, 'Shimu', 'shimum0226@gmail.com', '$2y$10$FrNT3gbUVV4OE.LL4nZrpuoCyMTPnPtMUHhfga7/lF8HJAvZDlYs6', '2024-11-30 11:16:12'),
(4, 'Chanchal', 'chanchallm78@gmail.com', '$2y$10$moTeZkAYmWKOJMuNSWMz8eJcPa75UHjVnWCrFwr2Xzczo7iQKzwqy', '2024-11-30 13:26:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
