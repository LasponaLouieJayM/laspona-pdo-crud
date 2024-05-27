-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 08:00 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `salary` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `salary`) VALUES
(1, 'louie', 'Mangima Tankulan Manolo Fortich Bukidnon', 1000),
(2, 'mt', 'mangi9em', 100);

-- --------------------------------------------------------

--
-- Table structure for table `payment_address`
--

CREATE TABLE `payment_address` (
  `payment_id` int(11) NOT NULL,
  `payment_name` varchar(50) NOT NULL,
  `payment_address` varchar(50) NOT NULL,
  `payment_number` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_thumbnail_link` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_retail_price` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_date_added` date NOT NULL,
  `product_updated_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_thumbnail_link`, `product_name`, `product_description`, `product_retail_price`, `product_price`, `product_quantity`, `product_image`, `product_date_added`, `product_updated_date`, `user_id`, `payment_id`) VALUES
(2, NULL, 'Health Potions', 'A Bundle Of Healt Potion', '4500', 5000, 200, 'https://i.pinimg.com/564x/46/47/8e/46478e1a5a932c68019d98744feef30c.jpg', '0000-00-00', NULL, 0, 0),
(3, NULL, 'health Potion', 'A potion that gives health', '280', 300, 500, 'https://th.bing.com/th/id/OIP.7PKUWSBItp26Xgzs2KWaOgHaHa?w=161&h=180&c=7&r=0&o=5&pid=1.7', '0000-00-00', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `purchase_name` varchar(50) NOT NULL,
  `purchase_price` int(11) NOT NULL,
  `purchase_quantity` int(11) NOT NULL,
  `purchase_date_added` date NOT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$.P/z4IWP8LKn5yZDZNtIuu3prdyFNMkfczkJERfH4O.7/jrPqJbUS', '2024-04-29 16:58:20'),
(2, 'me', '$2y$10$2Ox3Dm/nZUGcN4ELo.udWOST4oAJWA3vm5SAuy5rvmiELmGFbmg42', '2024-04-29 17:00:39'),
(3, 'ad', '$2y$10$jblpzdQV1hWmkwxBiUG60uuJlKTPd/sijFwofXFSsRvoNBvLlLyJa', '2024-05-26 19:37:15'),
(4, 'sa', '$2y$10$t2xmM5b4xafAtiijqDFk2eTs0fWvz3JzwVx3oK8HOvuSmM8t276pC', '2024-05-27 13:25:41'),
(5, 'sas', '$2y$10$LE8ZGWPqoDTaU3e6MM9dWuPrHWAyXO.D0I1MyGIZ.8JwuoAR68feu', '2024-05-27 13:27:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_address`
--
ALTER TABLE `payment_address`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `fk_payment_address` (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_address`
--
ALTER TABLE `payment_address`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fk_payment_address` FOREIGN KEY (`payment_id`) REFERENCES `payment_address` (`payment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
