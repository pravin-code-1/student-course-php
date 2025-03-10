-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 18, 2024 at 06:50 PM
-- Server version: 8.0.39-0ubuntu0.20.04.1
-- PHP Version: 7.4.3-4ubuntu2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Student`
--
/*SELECT * FROM ( SELECT s.*, c.name FROM Student_detial AS s LEFT JOIN courses AS c ON s.c_id = c.c_id LIMIT 0, 10 ) AS limited_students ORDER BY s_id DESC;*/
-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `discription` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `name`, `discription`) VALUES
(84, 'BCA', 'Bachelor of Computer Application'),
(85, 'MCA', 'Master Of Computer Application\r\n'),
(93, 'Mcom', 'Master of Commarce'),
(97, 'Bcom', 'Bachelor of Commarce'),
(100, 'MBA', 'Master of Business Administration');

-- --------------------------------------------------------

--
-- Table structure for table `Student_detial`
--

CREATE TABLE `Student_detial` (
  `s_id` int UNSIGNED NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` bigint DEFAULT NULL,
  `c_id` int DEFAULT NULL,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Student_detial`
--

INSERT INTO `Student_detial` (`s_id`, `firstname`, `lastname`, `email`, `gender`, `phone`, `c_id`, `reg_date`) VALUES
(70, 'Pravin', 'Prajapati', 'pravin04@gmail.com', 'Male', 9234567804, 100, '2024-09-17 04:30:45'),
(85, 'Pravin', 'Prajapati', 'pravin19@gmail.com', 'Male', 9234567810, 100, '2024-09-17 04:30:46'),
(95, 'Pravin', 'Prajapati', 'pravin29@gmail.com', 'Male', 9234567811, 100, '2024-09-17 04:30:47'),
(114, 'Pravin', 'Prajapati', 'pravin39@gmail.com', 'Male', 9234567812, 100, '2024-09-17 04:30:47'),
(385, 'Raj', 'Patel', 'pravin_prajapti201@gmail.com', 'Male', 9800543411, 100, '2024-09-17 10:50:20'),
(387, 'Raj', 'Patel', 'pravin_prajapti203@gmail.com', 'Male', 9800543413, 100, '2024-09-17 10:50:20'),
(388, 'Raj', 'Patel', 'pravin_prajapti204@gmail.com', 'Male', 9800543414, 100, '2024-09-17 10:50:20'),
(390, 'Raj', 'Patel', 'pravin_prajapti206@gmail.com', 'Male', 9800543416, 100, '2024-09-17 10:50:20'),
(396, 'Raj', 'Patel', 'pravin_prajapti212@gmail.com', 'Male', 9800543422, 100, '2024-09-17 10:50:20'),
(398, 'Raj', 'Patel', 'pravin_prajapti214@gmail.com', 'Male', 9800543424, 100, '2024-09-17 10:50:20'),
(400, 'Raj', 'Patel', 'pravin_prajapti216@gmail.com', 'Male', 9800543426, 100, '2024-09-17 10:50:20'),
(402, 'Raj', 'Patel', 'pravin_prajapti218@gmail.com', 'Male', 9800543428, 100, '2024-09-17 10:50:20'),
(403, 'Raj', 'Patel', 'pravin_prajapti219@gmail.com', 'Male', 9800543429, 100, '2024-09-17 10:50:20'),
(404, 'Raj', 'Patel', 'pravin_prajapti220@gmail.com', 'Male', 9800543430, 100, '2024-09-17 10:50:20'),
(405, 'Raj', 'Patel', 'pravin_prajapti221@gmail.com', 'Male', 9800543431, 100, '2024-09-17 10:50:20'),
(406, 'Raj', 'Patel', 'pravin_prajapti222@gmail.com', 'Male', 9800543432, 100, '2024-09-17 10:50:20'),
(411, 'Raj', 'Patel', 'pravin_prajapti227@gmail.com', 'Male', 9800543437, 100, '2024-09-17 10:50:20'),
(413, 'Raj', 'Patel', 'pravin_prajapti229@gmail.com', 'Male', 9800543439, 100, '2024-09-17 10:50:20'),
(416, 'Raj', 'Patel', 'pravin_prajapti232@gmail.com', 'Male', 9800543442, 100, '2024-09-17 10:50:20'),
(417, 'Raj', 'Patel', 'pravin_prajapti233@gmail.com', 'Male', 9800543443, 100, '2024-09-17 10:50:20'),
(418, 'Raj', 'Patel', 'pravin_prajapti234@gmail.com', 'Male', 9800543444, 100, '2024-09-17 10:50:20'),
(420, 'Raj', 'Patel', 'pravin_prajapti236@gmail.com', 'Male', 9800543446, 100, '2024-09-17 10:50:20'),
(421, 'Raj', 'Patel', 'pravin_prajapti237@gmail.com', 'Male', 9800543447, 100, '2024-09-17 10:50:20'),
(422, 'Raj', 'Patel', 'pravin_prajapti238@gmail.com', 'Male', 9800543448, 100, '2024-09-17 10:50:20'),
(486, 'fsdfs', 'sdfsdf', 'pravin.prajasdfspati0126@gmail.com', 'Female', 2334234556, 93, '2024-09-17 13:54:29'),
(791, 'dfsdf', 'asdfasdf', 'pravin.prajapdsfasdfati0126@gmail.com', 'Other', 3455673452, 85, '2024-09-18 13:06:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `Student_detial`
--
ALTER TABLE `Student_detial`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `Student_detial_ibfk_1` (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `Student_detial`
--
ALTER TABLE `Student_detial`
  MODIFY `s_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=792;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Student_detial`
--
ALTER TABLE `Student_detial`
  ADD CONSTRAINT `Student_detial_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `courses` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

ALTER TABLE `Student_detial` ADD `status` VARCHAR(50) NOT NULL AFTER `reg_date`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;