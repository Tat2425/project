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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `correct_answer` enum('Y','N') NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'General'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_text`, `correct_answer`, `category`) VALUES
(1, 'Is the Earth the center of the universe?', 'N', 'General'),
(2, 'Can humans survive without water for several days?', 'Y', 'General'),
(3, 'Is Shakespeare known for writing novels?', 'N', 'General'),
(4, 'Do all mammals lay eggs?', 'N', 'General'),
(5, 'Is the boiling point of water at sea level 100 degrees Celsius?', 'Y', 'General'),
(6, 'Is photosynthesis the process by which plants make their food?', 'Y', 'General'),
(7, 'Is the capital of France Paris?', 'Y', 'General'),
(8, 'Do all countries use the same currency?', 'N', 'General'),
(9, 'Is gravity stronger on Earth than on the Moon?', 'Y', 'General'),
(10, 'Can a person live without a heart?', 'N', 'General'),
(11, 'Is the chemical symbol for gold Au?', 'Y', 'General'),
(12, 'Do all birds migrate south for the winter?', 'N', 'General'),
(13, 'Is the Great Wall of China visible from space?', 'N', 'General'),
(14, 'Is algebra a branch of mathematics?', 'Y', 'General'),
(15, 'Do plants take in carbon dioxide during photosynthesis?', 'Y', 'General'),
(16, 'Is the human body made up of 206 bones?', 'Y', 'General'),
(17, 'Was Albert Einstein known for his theory of relativity?', 'Y', 'General'),
(18, 'Is the Pacific Ocean the largest ocean on Earth?', 'Y', 'General'),
(19, 'Do all insects have six legs?', 'N', 'General'),
(20, 'Is the speed of light faster than the speed of sound?', 'Y', 'General');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
