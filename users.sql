-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2025 at 05:23 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `high_score` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `score` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `high_score`, `created_at`, `score`) VALUES
(1, 'liu', '$2y$10$F3z8y1AZZLdxggsBj0Efs.KgczndXaqYuE5CHtwoIOWWy85g4H1jq', 9, '2025-03-27 14:53:59', 6),
(2, 'iby', '$2y$10$fpBNROZwJ4s5XN0FmtUJmOq3xjO5uh1XiaTIg6tpXS1FyoKcUQiXu', 0, '2025-03-27 16:08:18', 8),
(3, 'may', '$2y$10$axtfALz.3XqrjWf1/q9iB..S3ZFsecHr1Xzuggsp1/TUTrR5mnGtq', 0, '2025-04-01 14:54:53', 7),
(4, 'wing', '$2y$10$Ydc7t3nNppJvnhlYVqlVceHDEysST5A0m7ASeEjxbs01lj9H2IWWO', 0, '2025-04-01 15:19:43', 0),
(5, 'tak', '$2y$10$YwsRysX/XRjyxA2BZVHMN.N2dpn5sBog2dgQRHBozFed8rbyT8EX.', 0, '2025-04-01 16:07:08', 5),
(6, 'manson', '$2y$10$xA0np2THs824YGl46y4eJuPuZIqa8lkkVDvLFQUyCHU4gkmIHp672', 0, '2025-04-01 16:54:22', 4),
(7, 'paul', '$2y$10$heZeBR2sEgLEa6r.w5/1p.5ulDJUfaF08aUqe4ZT1wR79pJ0LyTZi', 9, '2025-04-02 10:51:49', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
