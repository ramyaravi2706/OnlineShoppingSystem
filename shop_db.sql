-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2026 at 02:05 PM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total`, `address`, `created_at`) VALUES
(1, 1, 350.00, '74A,middle street,Nochikulam', '2026-04-09 10:50:05'),
(2, 1, 200.00, '74a,mid st\r\n', '2026-04-09 10:59:21'),
(3, 1, 50.00, 'mid st,Ariyalur\r\n', '2026-04-09 16:56:15'),
(4, 1, 250.00, '123', '2026-04-09 17:03:44'),
(5, 1, 200.00, '456', '2026-04-09 17:11:58'),
(6, 1, 350.00, '74a,mid st,nochikulam', '2026-04-20 14:53:17'),
(7, 1, 1200.00, 'xxyy', '2026-04-20 15:45:49'),
(8, 1, 1000.00, '45,mid st,Ariyalur', '2026-04-22 14:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 2, 1),
(4, 3, 3, 1),
(5, 4, 2, 1),
(6, 4, 3, 1),
(7, 5, 1, 1),
(8, 5, 3, 1),
(9, 6, 1, 1),
(10, 6, 2, 1),
(11, 7, 2, 1),
(12, 7, 4, 1),
(13, 8, 5, 1),
(14, 8, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Shampoo', 'Hair care product', 150.00, 'shampoo.jpg'),
(2, 'Hair Oil', 'Nourishes hair', 200.00, 'oil.jpg'),
(3, 'Comb', 'Hair styling tool', 50.00, 'comb.jpg'),
(4, 'Bags', 'It is good,and it is good for 2 years.\r\n', 1000.00, 'bags.jpg'),
(5, 'Dell Mouse', 'it is good,and carranty for 2years', 700.00, 'mouse.jpg'),
(6, 'Facewash', 'better for oily skin ', 300.00, 'facewash.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'ramya', '$2y$10$EEwqHqmkLcjQZiv4clzsN.f1Lsv9nzzMKwvIZhMLC4CjWjDtDnENG'),
(2, 'muthu', '$2y$10$Fm/YT5odpP./CHw.bUORWuHpSh.mx32.g.VxXK0WJmdFUFFLhirGK'),
(3, 'vaishu', '$2y$10$yS6Hr2vHRMEELH1YX2.to.MLaqanAzmWBC17rsSCmaVAIpFgWwfVW'),
(4, 'Asin', '$2y$10$yPE.euOLEJHK9.1zfk8Ew.ATxJrYVYe24ckhLrP5i9k.OVLE8ND7a'),
(5, 'srini', '$2y$10$PwrxZ6bayjtmfeenV5fpu.9gG2tQ0SuxppqtuOux27OGNRYm86L2.'),
(6, 'ramya', '$2y$10$UBKhlhgXRAsCfxv9vHozfuwbA7Jqymnk9AdjbD8fnrbiWPnI4mPbC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
