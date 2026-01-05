-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2026 at 08:40 PM
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
-- Database: `spaceboots`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `phone_nb` varchar(12) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id_client`, `name`, `surname`, `mail`, `phone_nb`, `login`, `password`, `address`) VALUES
(1, 'Zuzanna', 'Ciba', 'blablabla@gmail.com', '+48777777777', 'login1', '$2y$10$MpgDYov2vqzjcz3J78GP2uZhEW3ogKo5aQIj3S1xflwldy7bddHLy', 'Gdzieś 12'),
(5, '', '', 'blablabla2@gmail.com', '+48777777777', 'login2', '$2y$10$DdvoYkCrMR/Hp6aS4VEyR.LY5bJCNIgGfTIPCjM9NTa2BT6PH8vUO', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `shopping_cart_id` int(11) NOT NULL,
  `arriving_date` date NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_client`, `shopping_cart_id`, `arriving_date`, `order_date`) VALUES
(1, 1, 1, '2025-04-09', '2025-05-14 00:00:00'),
(2, 2, 2, '2025-11-14', '2025-06-27 00:00:00'),
(3, 3, 3, '2025-07-25', '2024-12-14 00:00:00'),
(4, 4, 4, '2025-06-07', '2025-09-21 00:00:00'),
(5, 5, 5, '2025-06-09', '2025-02-09 00:00:00'),
(6, 6, 6, '2025-11-19', '2025-11-19 00:00:00'),
(7, 7, 7, '2025-05-22', '2025-01-31 00:00:00'),
(8, 8, 8, '2025-01-06', '2025-05-25 00:00:00'),
(9, 9, 9, '2025-08-18', '2025-01-05 00:00:00'),
(10, 9, 10, '2025-10-20', '2024-12-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_amount` int(3) NOT NULL,
  `p_price` decimal(5,2) NOT NULL,
  `p_collection` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `p_name`, `p_amount`, `p_price`, `p_collection`) VALUES
(1, 'Athletic Sneakers \"Sheeps\"', 2, 49.99, 'sport'),
(2, 'Casual Shoes \"Mountain Goat\"', 18, 44.99, 'casual'),
(3, 'Cycling Shoes \"Move!\"', 28, 39.99, 'sport'),
(4, 'Casual Leather Shoes \"Pavement\"', 45, 52.49, 'casual'),
(5, 'Cycling Shoes \"SpeedUp\"', 102, 39.99, 'sport'),
(6, 'Combat Boots \"Bloom\"', 13, 47.99, 'work'),
(7, 'Platform Shoes \"GOAT\"', 65, 61.99, 'casual'),
(8, 'Steel-Toed Shoes \"Amazon\"', 79, 59.99, 'work'),
(9, 'Sneakers \"Paul\" (authorial)', 2, 138.99, 'fashion'),
(10, 'Low Boots \"Marko\"', 5, 49.99, 'casual'),
(11, 'Tennis Shoes \"Melon\"', 82, 99.99, 'casual'),
(12, 'Waterproof Work Boots \"Brom\"', 71, 57.99, 'work'),
(13, 'Oil Resistant Boots \"Michael\"', 14, 49.99, 'casual'),
(14, 'Light-weight Sport Shoes \"California\"', 22, 44.99, 'sport'),
(15, 'Slip-Ons \"Mausoleum\"', 21, 39.99, 'sport'),
(16, 'Sport Sneakers \"Patison\"', 13, 54.99, 'sport'),
(17, 'Sport Shoes With Platform \"Alzheimer\'s\"', 0, 61.99, 'sport'),
(18, 'Safety Toe Sneakers \"Turtle\"', 16, 57.99, 'work'),
(19, 'Waterproof Fashion Boots \"Sally\"', 1, 119.99, 'fashion'),
(20, 'Fashion Platform Sneakers \"Maggy\"', 34, 59.99, 'fashion');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id_shopping_cart` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `ordered` tinyint(1) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `p_size` int(2) NOT NULL,
  `p_color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id_shopping_cart`, `id_client`, `id_product`, `ordered`, `amount`, `p_size`, `p_color`) VALUES
(1, 1, 3, NULL, 1, 40, 'black'),
(2, 1, 4, NULL, 1, 40, 'black'),
(3, 1, 2, NULL, 1, 38, 'brown'),
(4, 1, 2, NULL, 1, 38, 'brown'),
(5, 1, 2, NULL, 1, 38, 'brown'),
(6, 1, 2, NULL, 1, 38, 'brown'),
(7, 1, 2, NULL, 1, 38, 'brown'),
(8, 1, 3, NULL, 1, 35, 'black'),
(9, 1, 3, NULL, 1, 35, 'black'),
(10, 1, 1, NULL, 1, 40, 'white'),
(11, 1, 1, NULL, 1, 40, 'white');

-- --------------------------------------------------------

--
-- Table structure for table `sizes_colors`
--

CREATE TABLE `sizes_colors` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `colors` varchar(30) NOT NULL,
  `sizes` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes_colors`
--

INSERT INTO `sizes_colors` (`id`, `id_product`, `colors`, `sizes`) VALUES
(1, 1, 'white', 36),
(2, 1, 'white', 37),
(3, 1, 'white', 38),
(4, 1, 'white', 39),
(5, 1, 'white', 40),
(6, 1, 'white', 41),
(7, 1, 'white', 42),
(8, 2, 'brown', 38),
(9, 2, 'brown', 39),
(10, 2, 'brown', 40),
(11, 2, 'brown', 41),
(12, 2, 'brown', 42),
(13, 2, 'brown', 43),
(14, 2, 'brown', 44),
(15, 3, 'black', 35),
(16, 3, 'black', 36),
(17, 3, 'black', 37),
(18, 3, 'black', 38),
(19, 3, 'black', 39),
(20, 3, 'black', 40),
(21, 3, 'black', 41),
(22, 3, 'black', 42),
(23, 3, 'black', 43),
(24, 4, 'black', 38),
(25, 4, 'black', 39),
(26, 4, 'black', 40),
(27, 4, 'black', 41),
(28, 4, 'black', 42),
(29, 4, 'black', 43),
(30, 4, 'black', 44),
(31, 4, 'black', 45),
(32, 5, 'black', 37),
(33, 5, 'black', 38),
(34, 5, 'black', 39),
(35, 5, 'black', 40),
(36, 5, 'black', 41),
(37, 5, 'black', 42),
(38, 5, 'black', 43),
(39, 5, 'black', 44),
(40, 5, 'black', 45),
(41, 5, 'black', 46),
(42, 6, 'white', 38),
(43, 6, 'white', 39),
(44, 6, 'white', 40),
(45, 6, 'white', 41),
(46, 6, 'white', 42),
(47, 6, 'white', 43),
(48, 6, 'white', 44),
(49, 6, 'white', 45),
(50, 7, 'brown', 38),
(51, 7, 'brown', 39),
(52, 7, 'brown', 40),
(53, 7, 'brown', 41),
(54, 7, 'brown', 42),
(55, 7, 'brown', 43),
(56, 8, 'black', 39),
(57, 8, 'black', 40),
(58, 8, 'black', 41),
(59, 8, 'black', 42),
(60, 8, 'black', 43),
(61, 8, 'black', 44),
(62, 8, 'black', 45),
(63, 9, 'black', 40),
(64, 9, 'black', 41),
(65, 9, 'black', 42),
(66, 9, 'black', 43),
(67, 9, 'black', 44),
(68, 9, 'black', 45),
(69, 9, 'black', 46),
(70, 10, 'black', 37),
(71, 10, 'black', 38),
(72, 10, 'black', 39),
(73, 10, 'black', 40),
(74, 10, 'black', 41),
(75, 10, 'black', 42),
(76, 10, 'black', 43),
(77, 10, 'black', 44),
(78, 10, 'black', 45),
(79, 10, 'black', 46),
(80, 11, 'black', 35),
(81, 11, 'black', 36),
(82, 11, 'black', 37),
(83, 11, 'black', 38),
(84, 11, 'black', 39),
(85, 11, 'black', 40),
(86, 11, 'black', 41),
(87, 11, 'black', 42),
(88, 11, 'black', 43),
(89, 11, 'black', 44),
(90, 12, 'brown', 36),
(91, 12, 'brown', 37),
(92, 12, 'brown', 38),
(93, 12, 'brown', 39),
(94, 12, 'brown', 40),
(95, 12, 'brown', 41),
(96, 12, 'brown', 42),
(97, 12, 'brown', 43),
(98, 12, 'brown', 44),
(99, 13, 'black', 38),
(100, 13, 'black', 38),
(101, 13, 'black', 39),
(102, 13, 'black', 39),
(103, 13, 'black', 40),
(104, 13, 'black', 40),
(105, 13, 'black', 41),
(106, 13, 'black', 41),
(107, 13, 'black', 42),
(108, 13, 'black', 42),
(109, 13, 'black', 43),
(110, 13, 'black', 43),
(111, 13, 'black', 44),
(112, 13, 'black', 44),
(113, 13, 'black', 45),
(114, 14, 'black', 39),
(115, 14, 'black', 40),
(116, 14, 'black', 41),
(117, 14, 'black', 42),
(118, 14, 'black', 43),
(119, 14, 'black', 44),
(120, 14, 'black', 45),
(121, 15, 'black', 36),
(122, 15, 'black', 37),
(123, 15, 'black', 38),
(124, 15, 'black', 39),
(125, 15, 'black', 40),
(126, 15, 'black', 41),
(127, 15, 'black', 42),
(128, 15, 'black', 43),
(129, 16, 'black', 40),
(130, 16, 'black', 41),
(131, 17, 'black', 40),
(132, 17, 'black', 38),
(133, 18, 'black', 39),
(134, 18, 'black', 40),
(135, 18, 'black', 41),
(136, 18, 'black', 42),
(137, 18, 'black', 43),
(138, 19, 'white', 41),
(139, 20, 'black', 37),
(140, 20, 'black', 38),
(141, 20, 'black', 39),
(142, 20, 'black', 40),
(143, 20, 'black', 41),
(144, 20, 'black', 42),
(145, 20, 'black', 43),
(146, 20, 'black', 44);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `login_2` (`login`),
  ADD UNIQUE KEY `login_3` (`login`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `id_product` (`id_product`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id_shopping_cart`);

--
-- Indexes for table `sizes_colors`
--
ALTER TABLE `sizes_colors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id_shopping_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sizes_colors`
--
ALTER TABLE `sizes_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
