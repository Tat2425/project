-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-12-10 15:21:31
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `test`
--

-- --------------------------------------------------------

--
-- 資料表結構 `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question_text` varchar(255) NOT NULL,
  `correct_answer` enum('Y','N') NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'General'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 傾印資料表的資料 `questions`
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

-- --------------------------------------------------------

--
-- 資料表結構 `users`
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
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `high_score`, `created_at`, `score`) VALUES
(1, 'liu', '$2y$10$F3z8y1AZZLdxggsBj0Efs.KgczndXaqYuE5CHtwoIOWWy85g4H1jq', 9, '2025-03-27 14:53:59', 6),
(2, 'iby', '$2y$10$/C3XnxLuqbRToRxSIOxypOyUfoYV/LJaGuNBXkck2m14k2rQJwlWW', 0, '2025-03-27 16:08:18', 8),
(3, 'may', '$2y$10$axtfALz.3XqrjWf1/q9iB..S3ZFsecHr1Xzuggsp1/TUTrR5mnGtq', 0, '2025-04-01 14:54:53', 7),
(4, 'wing', '$2y$10$Ydc7t3nNppJvnhlYVqlVceHDEysST5A0m7ASeEjxbs01lj9H2IWWO', 0, '2025-04-01 15:19:43', 0),
(5, 'tak', '$2y$10$YwsRysX/XRjyxA2BZVHMN.N2dpn5sBog2dgQRHBozFed8rbyT8EX.', 0, '2025-04-01 16:07:08', 5),
(6, 'manson', '$2y$10$xA0np2THs824YGl46y4eJuPuZIqa8lkkVDvLFQUyCHU4gkmIHp672', 0, '2025-04-01 16:54:22', 4),
(7, 'paul', '$2y$10$heZeBR2sEgLEa6r.w5/1p.5ulDJUfaF08aUqe4ZT1wR79pJ0LyTZi', 9, '2025-04-02 10:51:49', 8),
(8, 'kate', '$2y$10$3xS/41OS072SefQt89ijYuZTqO6ya3ILZ38krS8GWxpiJ2QUkjFc.', 0, '2025-04-05 12:57:15', 7),
(9, 'leo', '$2y$10$ljNg9KA/4H.Ei6tANqjwI.2RvAQ2.t8k.zqra49VaELgVyjnBKscW', 0, '2025-04-05 13:32:21', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` enum('Y','N') NOT NULL,
  `answered_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 傾印資料表的資料 `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `question_id`, `answer`, `answered_at`) VALUES
(450, 2, 4, 'N', '2025-12-10 23:20:20'),
(451, 2, 2, 'Y', '2025-12-10 23:20:21'),
(452, 2, 18, 'Y', '2025-12-10 23:20:24'),
(453, 2, 2, 'N', '2025-12-10 23:20:28'),
(454, 2, 1, 'Y', '2025-12-10 23:20:29'),
(455, 2, 4, 'Y', '2025-12-10 23:20:30'),
(456, 2, 14, 'N', '2025-12-10 23:20:30'),
(457, 2, 15, 'Y', '2025-12-10 23:20:31'),
(458, 2, 2, 'Y', '2025-12-10 23:20:32'),
(459, 2, 11, 'N', '2025-12-10 23:20:33');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 資料表索引 `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
