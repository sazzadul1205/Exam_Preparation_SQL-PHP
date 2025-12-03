-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 05:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idb_bisew_evidence`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddStudent` (IN `Pname` VARCHAR(100), IN `Paddress` VARCHAR(255), IN `Pmobile` VARCHAR(20))   BEGIN
    INSERT INTO students (name, address, mobile)
    VALUES (Pname, Paddress, Pmobile);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `module_name` varchar(20) NOT NULL,
  `totalmarks` int(5) NOT NULL,
  `student_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `module_name`, `totalmarks`, `student_id`) VALUES
(3, 'Mathematics', 78, 2),
(4, 'Science', 82, 2),
(9, 'Mathematics', 89, 5),
(10, 'Science', 94, 5);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `address`, `mobile`) VALUES
(2, 'Bob Smith', '45 Oak Avenue, Shelbyville', '01817654321'),
(5, 'Ethan Hunt', '9 Cedar Street, Gotham', '01512345678'),
(8, 'Md Shafikul Islam', 'f weaf wefw', '01917335945'),
(9, 'Md Shafikul Islam', 'f weaf wefw', '01917335945');

--
-- Triggers `students`
--
DELIMITER $$
CREATE TRIGGER `after_student_delete` AFTER DELETE ON `students` FOR EACH ROW DELETE FROM results WHERE student_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_results`
-- (See below for the actual view)
--
CREATE TABLE `student_results` (
`student_id` int(11)
,`student_name` varchar(50)
,`address` varchar(100)
,`mobile` varchar(20)
,`module_name` varchar(20)
,`totalmarks` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`) VALUES
('user1@example.com', '7c6a180b36896a0a8c02787eeafb0e4c'),
('user2@example.com', '6cb75f652a9b52798eb6cf2201057c73'),
('user3@example.com', '819b0643d6b89dc9b579fdfc9094f28e'),
('user4@example.com', '34cc93ece0ba9e3f6f235d4af979b16c'),
('user5@example.com', 'db0edd04aaac4506f7edab03ac855d56');

-- --------------------------------------------------------

--
-- Structure for view `student_results`
--
DROP TABLE IF EXISTS `student_results`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_results`  AS SELECT `s`.`id` AS `student_id`, `s`.`name` AS `student_name`, `s`.`address` AS `address`, `s`.`mobile` AS `mobile`, `r`.`module_name` AS `module_name`, `r`.`totalmarks` AS `totalmarks` FROM (`students` `s` left join `results` `r` on(`s`.`id` = `r`.`student_id`)) ORDER BY `s`.`id` ASC, `r`.`module_name` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
