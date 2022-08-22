-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 22, 2022 at 11:18 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `rollno`, `locality`, `image`) VALUES
(1, 'Neve Henderson', '60', 'Duis facilis nihil a', ''),
(2, 'Amena Vega', '16', 'Ex nulla quia incidu', ''),
(3, 'Amena Vega', '16', 'Ex nulla quia incidu', ''),
(4, 'Amena Vega', '16', 'Ex nulla quia incidu', ''),
(5, 'Amena Vega', '16', 'Ex nulla quia incidu', ''),
(6, 'Ignatius Dorsey', '56', 'Incididunt rerum et ', ''),
(7, 'Driscoll Rosario', '5', 'Veritatis et enim ip', 'uploads/French Tacos & Burgers Nesttun2832.jpg'),
(8, 'Kiayada Beck', '88', 'Magni suscipit esse ', ''),
(9, 'Jessica Stevenson', '79', 'Dolor dolore sunt pr', ''),
(10, 'Hadley Bonner', '19', 'Exercitationem irure', ''),
(11, 'Hadley Bonner', '19', 'Exercitationem irure', ''),
(12, 'Dale Cook', '47', 'Ad velit iure aliqua', ''),
(13, 'Miriam Bryant', '59', 'Explicabo Dolore do', ''),
(14, 'jigs', '100', 'Adajan', '');

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

DROP TABLE IF EXISTS `student_subject`;
CREATE TABLE `student_subject` (
  `id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `subject_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_subject`
--

INSERT INTO `student_subject` (`id`, `student_id`, `subject_id`) VALUES
(1, 11, 2),
(2, 12, 1),
(3, 12, 2),
(4, 13, 1),
(5, 13, 2),
(6, 14, 1),
(7, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `marks` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `image`, `marks`) VALUES
(1, 'Maths', '', 100),
(2, 'Science', '', 100),
(3, 'Computer', '', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_subject`
--
ALTER TABLE `student_subject`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
