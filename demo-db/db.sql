-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 07, 2022 at 08:22 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `salt` varchar(250) NOT NULL,
  `balance` float(11,2) NOT NULL DEFAULT 0.00,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `salt`, `balance`, `status`, `created_at`) VALUES
(20, 'Shakib', 'shakib@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 0.00, 'ACTIVE', '2022-11-07 23:41:46'),
(21, 'Sujon', 'sujon@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'MTIzNDU2', 0.00, 'ACTIVE', '2022-11-08 00:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_expense_income`
--

CREATE TABLE `user_expense_income` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('EXPENSE','INCOME') NOT NULL,
  `amount` float(11,2) NOT NULL,
  `expense_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_expense_income`
--

INSERT INTO `user_expense_income` (`id`, `user_id`, `type`, `amount`, `expense_date`, `created_at`) VALUES
(1, 20, 'INCOME', 50000.00, '2022-11-01', '2022-11-08 00:33:02'),
(2, 20, 'INCOME', 10000.00, '2022-11-05', '2022-11-08 00:33:26'),
(3, 20, 'EXPENSE', 4500.00, '2022-11-10', '2022-11-08 00:42:10'),
(4, 20, 'EXPENSE', 1500.00, '2022-11-17', '2022-11-08 00:42:28'),
(5, 21, 'INCOME', 15000.00, '2022-11-01', '2022-11-08 00:45:37'),
(7, 21, 'EXPENSE', 997.00, '2022-11-03', '2022-11-08 00:45:56'),
(8, 21, 'EXPENSE', 754.00, '2022-11-16', '2022-11-08 01:20:09'),
(9, 21, 'EXPENSE', 249.00, '2022-11-11', '2022-11-08 01:20:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`,`salt`,`name`),
  ADD UNIQUE KEY `user_email` (`email`);

--
-- Indexes for table `user_expense_income`
--
ALTER TABLE `user_expense_income`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_expense_income`
--
ALTER TABLE `user_expense_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
