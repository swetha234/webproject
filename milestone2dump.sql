-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 30, 2018 at 07:46 PM
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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment_authur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `users_id`, `comment`, `date`, `comment_authur`) VALUES
(45, 80, 1, 'Hello', '2018-10-30 13:54:41', 'Hudson');

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
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `global` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `users_id`, `topic_id`, `post_title`, `post_content`, `post_date`, `global`) VALUES
(22, 3, 2, 'Labrador', 'I am looking to buy a puppy.', '2018-10-14 21:51:00', NULL),
(23, 4, 2, 'Maltese', 'Maltese is a cute dog.', '2018-10-14 21:51:59', NULL),
(24, 2, 2, 'Look at my Pug', 'Isn\'t he adorable ?', '2018-10-16 11:31:03', 1),
(25, 1, 1, 'Persian Cats', 'I have cute pair of these cats.', '2018-10-14 21:54:04', NULL),
(26, 3, 1, 'Lazy companion', 'Feed him food. He will be happy.', '2018-10-16 11:28:33', 1),
(27, 3, 1, 'Catty ', 'Shines always !! ', '2018-10-15 00:45:32', NULL),
(30, 4, 5, 'Piggy', 'Pouts Perfectly !!!', '2018-10-15 00:54:19', NULL),
(31, 3, 6, 'Fishyy', 'It lives in water', '2018-10-15 00:58:03', NULL),
(32, 3, 4, 'Tortoiseee', 'Slow ', '2018-10-15 00:59:52', NULL),
(79, 1, 5, 'Post on Pigs', 'Pigs are cute !!', '2018-10-16 11:59:11', 1),
(80, 1, 3, 'Pigeon', 'Many of them !!', '2018-10-16 12:03:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
CREATE TABLE `rating` (
  `users_id` int(100) NOT NULL,
  `post_id` int(100) NOT NULL,
  `rating_action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`users_id`, `post_id`, `rating_action`) VALUES
(1, 79, 'like'),
(1, 80, 'like'),
(2, 24, 'dislike'),
(3, 22, 'like'),
(3, 23, 'like'),
(3, 24, 'like'),
(3, 26, 'like'),
(3, 31, 'like'),
(3, 79, 'like'),
(3, 80, 'like'),
(4, 23, 'like'),
(18, 22, 'like'),
(18, 79, 'like'),
(18, 80, 'dislike'),
(18, 95, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` text NOT NULL,
  `choose` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_title`, `choose`) VALUES
(1, 'Cats', 'public'),
(2, 'Dogs', 'public'),
(3, 'Birds', 'public'),
(4, 'Tortise', 'public'),
(5, 'Pigs', 'public'),
(6, 'Fishes', 'public');

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
  `user_image` varchar(256) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `email`, `password`, `user_image`, `status`) VALUES
(3, 'Doc', 'Hudson', 'hornet@rsprings.gov', '@doc', 'default.jpeg', ''),
(5, 'Lightning', 'McQueen', 'kachow@rusteze.com', '@mcqueen', 'default.jpeg', ''),
(1, 'Tow', 'Mater', 'mater@rsprings.gov', '@mater', 'default.jpeg', ''),
(2, 'Sally', 'Carrera', 'porsche@rsprings.gov', '@sally', 'default.jpeg', ''),
(4, 'Finn', 'McMissile', 'topsecret@agent.org', '@mcmissile', 'default.jpeg', '');

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
(17, 1, 4),
(18, 1, 1),
(19, 4, 5),
(20, 4, 2),
(21, 5, 1),
(22, 5, 6),
(24, 3, 12),
(29, 3, 14),
(30, 18, 14),
(31, 3, 15),
(32, 18, 15),
(33, 3, 15),
(34, 18, 15),
(35, 3, 17),
(36, 18, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD UNIQUE KEY `users_id` (`users_id`,`post_id`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
