-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2025 at 02:44 PM
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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_adress` text NOT NULL,
  `shopping_cart_id` int(11) NOT NULL,
  `arriving_date` date NOT NULL,
  `order_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `client_id`, `order_adress`, `shopping_cart_id`, `arriving_date`, `order_date`) VALUES
(1, 1, '', 1, '2025-04-09', '2025-05-14'),
(2, 2, '', 2, '2025-11-14', '2025-06-27'),
(3, 3, '', 3, '2025-07-25', '2024-12-14'),
(4, 4, '', 4, '2025-06-07', '2025-09-21'),
(5, 5, '', 5, '2025-06-09', '2025-02-09'),
(6, 6, '', 6, '2025-11-19', '2025-11-19'),
(7, 7, '', 7, '2025-05-22', '2025-01-31'),
(8, 8, '', 8, '2025-01-06', '2025-05-25'),
(9, 9, '', 9, '2025-08-18', '2025-01-05'),
(10, 10, '', 10, '2025-10-20', '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_price` decimal(4,2) NOT NULL,
  `p_color` varchar(20) NOT NULL,
  `p_collection` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `p_name`, `p_price`, `p_color`, `p_collection`) VALUES
(1, '', 14.99, 'Khaki', ''),
(2, '', 1.29, 'Purple', ''),
(3, '', 5.49, 'Yellow', ''),
(4, '', 4.49, 'Maroon', ''),
(5, '', 3.79, 'Mauv', ''),
(6, '', 4.79, 'Khaki', ''),
(7, '', 3.79, 'Red', ''),
(8, '', 1.79, 'Green', ''),
(9, '', 6.99, 'Indigo', ''),
(10, '', 49.99, 'Khaki', '');

-- --------------------------------------------------------

--
-- Table structure for table `sb_client`
--

CREATE TABLE `sb_client` (
  `id_client` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `phone_nb` varchar(15) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sb_client`
--

INSERT INTO `sb_client` (`id_client`, `name`, `surname`, `mail`, `phone_nb`, `login`, `password`, `address`) VALUES
(0, '', 'Maddie', '', '', '', '', ''),
(1, 'Cindra', 'Maddie', 'csheffield0@ox.ac.uk', '+63-130-493-884', 'login', 'kL7*t~@z87Rt,x', '12th Floor'),
(2, 'Regine', 'Henstridge', 'rtolemache1@nydailynews.com', '+1-703-947-2193', 'login', 'oW6`O\'%.L', 'Suite 43'),
(3, 'Tate', 'Stannislawski', 'tpearsall2@admin.ch', '+230-182-746-69', 'login', 'kA2(B%o__tlFljzo', '15th Floor'),
(4, 'Deb', 'Thorsen', 'drolley3@dot.gov', '+86-595-640-244', 'login', 'eZ3<F?z9rJ=ego', 'Suite 98'),
(5, 'Tiler', 'Josifovic', 'tshirt4@webnode.com', '+58-307-842-294', 'login', 'dJ3!SsgYQXYX1', 'PO Box 52541'),
(6, 'Eldon', 'Karpinski', 'ewillcott5@webnode.com', '+86-978-713-965', 'login', 'bK3?vTJQYbR\'SC*A', 'Apt 635'),
(7, 'Lynne', 'Mulder', 'lhawkeridge6@yahoo.co.jp', '+504-903-499-52', 'login', 'uT4.v4kpQHaU$66)', '5th Floor'),
(8, 'Jorgan', 'Bertin', 'jrosin7@foxnews.com', '+46-852-699-417', 'login', 'aJ4<\"8dQo\'J9', 'PO Box 44389'),
(9, 'Molly', 'Craydon', 'mjepensen8@pcworld.com', '+63-179-345-067', 'login', 'oL6<#Opl', 'Suite 87'),
(10, 'Clari', 'Panketh', 'cgillmor9@craigslist.org', '+46-156-563-796', 'login', 'vH9+/{2As\'|jY%', 'Suite 61');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `sb_client`
--
ALTER TABLE `sb_client`
  ADD PRIMARY KEY (`id_client`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
