-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 07:35 AM
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
-- Database: `exam_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Insert_Manufacturer` (IN `Mname` VARCHAR(50), IN `Maddress` VARCHAR(100), IN `Mcontact_no` VARCHAR(50))   INSERT INTO manufacfacture (name, address, contact_no)
    VALUES (Mname, Maddress, Mcontact_no)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `expensive_products`
-- (See below for the actual view)
--
CREATE TABLE `expensive_products` (
`id` int(11)
,`name` varchar(50)
,`price` int(5)
,`manufacturer_id` int(10)
);

-- --------------------------------------------------------

--
-- Table structure for table `manufacfacture`
--

CREATE TABLE `manufacfacture` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manufacfacture`
--

INSERT INTO `manufacfacture` (`id`, `name`, `address`, `contact_no`) VALUES
(5, 'Sunrise Manufacturing', '78 Sunrise Street, Springfield', '01919876543'),
(6, 'Prime Components', '22 Prime Lane, Gotham', '01611223344'),
(7, 'NextGen Solutions', '9 Next Street, Star City', '01512345678'),
(8, 'Samsung', 'tt11 hOUSE', '0231524');

--
-- Triggers `manufacfacture`
--
DELIMITER $$
CREATE TRIGGER `after_manufactorer_delete` AFTER DELETE ON `manufacfacture` FOR EACH ROW DELETE FROM product WHERE manufacturer_id = OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(5) NOT NULL,
  `manufacturer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `manufacturer_id`) VALUES
(7, 'Product C1', 80, 5),
(8, 'Product C2', 5654, 5),
(9, 'Product C3', 111, 5),
(10, 'Product D1', 65, 6),
(11, 'Product D2', 70, 6),
(12, 'Product D3', 96, 6),
(13, 'Product E1', 130, 7),
(14, 'Product E2', 5321, 7),
(15, 'Product E3', 160, 7);

-- --------------------------------------------------------

--
-- Structure for view `expensive_products`
--
DROP TABLE IF EXISTS `expensive_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `expensive_products`  AS SELECT `product`.`id` AS `id`, `product`.`name` AS `name`, `product`.`price` AS `price`, `product`.`manufacturer_id` AS `manufacturer_id` FROM `product` WHERE `product`.`price` > 5000 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacfacture`
--
ALTER TABLE `manufacfacture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacfacture`
--
ALTER TABLE `manufacfacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
