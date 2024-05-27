-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 05:58 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_firstname` varchar(50) NOT NULL,
  `payment_lastname` varchar(50) NOT NULL,
  `payment_email` varchar(100) NOT NULL,
  `payment_address` text NOT NULL,
  `payment_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_firstname`, `payment_lastname`, `payment_email`, `payment_address`, `payment_number`) VALUES
(1, 'louie', 'laspona', 'louizkylaspona@gmail.com', 'mangima', '09264686830'),
(2, 'louie', 'laspona', 'louizkylaspona@gmail.com', 'mangima', '09264686830'),
(3, 'louie', 'laspona', 'louizkylaspona@gmail.com', 'mangima', '09264686830'),
(4, 'louie', 'laspona', 'louizkylaspona@gmail.com', 'mangima', '09264686830'),
(5, 'louie', 'asd', 'louizkylaspona@gmail.com', 'mgania', '09264686830'),
(6, 'da', 's', 'sa@gmail.com', 'asa', '21'),
(7, 'g', 'l', 'l@gmail.com', 'fa', '23'),
(8, 'da', 'f', 'W@gmail.com', 'godods', '21'),
(9, 'a', 's', 'louizkylaspona@gmail.com', '2', '1'),
(10, 'me', 'you', 'meyou@gmail.com', 'meyou me you', '0000'),
(11, 'g', 'asd', 'louizkylaspona@gmail.com', 'aas', '2');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_retail_price` decimal(10,2) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_date_added` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `user_id`, `product_name`, `product_description`, `product_price`, `product_retail_price`, `product_quantity`, `product_image`, `product_date_added`) VALUES
(1, 1, 'Big Health Potion', 'A potion that gives you a big health', 210.00, 180.00, 100, 'https://i.pinimg.com/564x/46/47/8e/46478e1a5a932c68019d98744feef30c.jpg', '2024-05-27 13:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `purchase_quantity` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `product_id`, `payment_id`, `purchase_quantity`, `purchase_date`) VALUES
(5, 1, 5, 100, '2024-05-27 14:14:00'),
(6, 1, 6, 2, '2024-05-27 14:18:23'),
(7, 1, 7, 22, '2024-05-27 14:48:02'),
(8, 1, 8, 32, '2024-05-27 14:58:31'),
(9, 1, 9, 2, '2024-05-27 15:00:44'),
(10, 1, 10, 299, '2024-05-27 15:04:38'),
(11, 1, 11, 2, '2024-05-27 15:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`) VALUES
(1, 'admin', '$2y$10$wnLwih0K0IqdR1YeqzSXsuOp6zNHVNqOVM3n0diOy6nP5o5ia9plS'),
(2, 'sax', '$2y$10$/qGy/Fme0T6gXCFtgERsduPQU9UQghZkaK04ewir3zd4DB619mDEO'),
(3, 'qw', '$2y$10$eXHLmvpUS6hCmpTJTZZKzuyhjdZ3fKqIDs7MbZBbRc00LizL1a4qe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
