-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2018 at 03:13 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_finder`
--
CREATE DATABASE IF NOT EXISTS `pet_finder` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pet_finder`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `users_id`, `topic_id`, `post_title`, `post_content`, `post_date`) VALUES
(22, 3, 2, 'Labrador', 'I am looking to buy a puppy.', '2018-10-14 21:51:00'),
(23, 4, 2, 'Maltese', 'Maltese is a cute dog.', '2018-10-14 21:51:59'),
(24, 2, 2, 'Look at my Pug', 'Isn\'t he adorable ?', '2018-10-14 21:52:27'),
(25, 1, 1, 'Persian Cats', 'I have cute pair of these cats.', '2018-10-14 21:54:04'),
(26, 3, 1, 'Lazy companion', 'Feed him food. He will be happy.', '2018-10-14 21:54:46'),
(27, 3, 1, 'Catty ', 'Shines always !! ', '2018-10-15 00:45:32'),
(30, 4, 5, 'Piggy', 'Pouts Perfectly !!!', '2018-10-15 00:54:19'),
(31, 3, 6, 'Fishyy', 'It lives in water', '2018-10-15 00:58:03'),
(32, 3, 4, 'Tortoiseee', 'Slow ', '2018-10-15 00:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_title`) VALUES
(1, 'Cats'),
(2, 'Dogs'),
(3, 'Birds'),
(4, 'Tortise'),
(5, 'Pigs'),
(6, 'Fishes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `users_id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `email`, `password`, `user_image`) VALUES
(3, 'Doc', 'Hudson', 'hornet@rsprings.gov', '@doc', 'default.jpeg'),
(5, 'Lightning', 'McQueen', 'kachow@rusteze.com', '@mcqueen\r\n', 'default.jpeg'),
(1, 'Tow', 'Mater', 'mater@rsprings.gov', '@mater', 'default.jpeg'),
(2, 'Sally', 'Carrera', 'porsche@rsprings.gov', '@sally', 'default.jpeg'),
(4, 'Finn', 'McMissile', 'topsecret@agent.org', '@mcmissile', 'default.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `users_id`, `topic_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 2, 3),
(4, 2, 2),
(17, 1, 2),
(18, 1, 1),
(19, 4, 5),
(20, 4, 2),
(21, 5, 1),
(22, 5, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_id` (`users_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
