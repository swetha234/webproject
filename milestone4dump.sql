-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2018 at 08:10 PM
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
-- Table structure for table `archive_info`
--

DROP TABLE IF EXISTS `archive_info`;
CREATE TABLE `archive_info` (
  `archive_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `archive_action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `archive_info`
--

INSERT INTO `archive_info` (`archive_id`, `topic_id`, `archive_action`) VALUES
(1, 1, 'unarchive'),
(3, 3, 'unarchive'),
(6, 4, 'unarchive'),
(7, 2, 'unarchive'),
(8, 5, 'unarchive'),
(9, 10, 'unarchive'),
(10, 11, 'unarchive'),
(11, 12, 'unarchive'),
(12, 13, 'unarchive'),
(13, 14, 'unarchive'),
(14, 15, 'unarchive'),
(15, 16, 'unarchive'),
(16, 17, 'unarchive'),
(17, 18, 'unarchive'),
(18, 19, 'unarchive');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `msg_content` text NOT NULL,
  `msg_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `msg_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `users_id`, `msg_content`, `msg_timestamp`, `msg_user_id`) VALUES
(26, 3, 'hello\n', '2018-12-08 17:47:37', 223),
(28, 3, 'hi\n', '2018-12-09 05:21:47', 223),
(29, 22, 'bye\n', '2018-12-09 05:24:07', 322),
(30, 22, 'Indiaaaaaa\n', '2018-12-09 05:24:18', 322);

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
(45, 80, 1, 'Hello', '2018-10-30 13:54:41', 'Hudson'),
(61, 119, 3, 'Hello', '2018-11-12 03:16:03', 'Hudson'),
(62, 0, 0, 'efjkfjhief', '2018-12-04 06:43:25', 'Hudson'),
(63, 0, 0, 'ghjg', '2018-12-06 00:40:57', 'Hudson');

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
  `post_content` longtext NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `global` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 24, 'like'),
(1, 27, 'like'),
(21, 447, 'like'),
(21, 449, 'dislike'),
(21, 453, 'dislike');

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
(5, 'Pigs', 'public');

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
  `status` text NOT NULL,
  `dp_value` int(11) NOT NULL,
  `checkgit` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `email`, `password`, `user_image`, `status`, `dp_value`, `checkgit`) VALUES
(21, 'Admin', 'Admin', 'admin@gmail.com', 'admin', 'default.jpeg', '', 1, 0),
(22, 'Gutti', 'Swetha', 'hima@rsprings.gov', '1234', 'IMG_0016.JPG', 'unverified', 1, 0),
(3, 'Doc', 'Hudson', 'hornet@rsprings.gov', '@doc', 'default.jpeg', '', 1, 0),
(5, 'Lightning', 'McQueen', 'kachow@rusteze.com', '@mcqueen', 'default.jpeg', '', 1, 0),
(1, 'Tow', 'Mater', 'mater@rsprings.gov', '@mater', 'chick.png', '', 1, 0),
(2, 'Sally', 'Carrera', 'porsche@rsprings.gov', '@sally', 'default.jpeg', '', 1, 0),
(4, 'Finn', 'McMissile', 'topsecret@agent.org', '@mcmissile', 'default.jpeg', '', 1, 0);

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
(168, 1, 2),
(165, 3, 2),
(169, 3, 3),
(160, 3, 4),
(174, 3, 5),
(166, 4, 3),
(123, 4, 5),
(167, 5, 2),
(142, 21, 1),
(139, 21, 2),
(140, 21, 3),
(141, 21, 4),
(138, 21, 5),
(172, 22, 1),
(173, 22, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive_info`
--
ALTER TABLE `archive_info`
  ADD PRIMARY KEY (`archive_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `combined_key` (`users_id`,`topic_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `users_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive_info`
--
ALTER TABLE `archive_info`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=365;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`),
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
