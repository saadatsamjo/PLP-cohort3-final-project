-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 10:53 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plp-devs-forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `questionid` int(10) UNSIGNED NOT NULL,
  `description` varchar(300) CHARACTER SET latin1 NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL,
  `userid` int(10) UNSIGNED NOT NULL,
  `accepted` int(10) UNSIGNED NOT NULL,
  `votes` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `questionid`, `description`, `created`, `updated`, `userid`, `accepted`, `votes`) VALUES
(1, 1, 'Please be more specific with your question', '2023-06-21 13:26:02', '2023-06-21 13:26:02', 6923, 1, 2),
(2, 1, 'Check Out W3Schools.com .They explain it soo well', '2023-06-21 13:26:02', '2023-06-21 13:26:02', 6924, 1, 3),
(3, 2, 'Use curly braces', '2023-06-21 13:26:02', '2023-06-21 13:26:02', 6924, 0, 5),
(11, 1, '<p>We Mzee</p>', '2023-06-24 12:39:31', NULL, 6923, 0, 0),
(12, 1, '<p>rdtfgyhujik</p>', '2023-06-24 13:12:06', NULL, 6923, 0, 0),
(13, 1, '<p>We Mzee</p>', '2023-06-24 13:15:46', NULL, 6923, 0, 0),
(14, 2, '<p>sfdgh</p>', '2023-06-25 11:12:23', NULL, 6924, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `category_description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'PHP', 'This is a PHP thread'),
(2, 'Python', 'This is a Python thread');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer_desc` varchar(300) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`answer_id`, `question_id`, `category_id`, `user_id`, `answer_desc`, `rating`) VALUES
(1, 1, 1, 1, 'Please be more specific with your question', 4),
(2, 1, 1, 2, 'Check Out W3Schools.com .They explain it soo well', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `key` varchar(100) NOT NULL,
  `expDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`id`, `email`, `key`, `expDate`) VALUES
(47, 'omitihenry@gmail.com', '88d1f8fac43a6ce5f0913602e107c3cf838f9c4a28', '2023-06-17 15:16');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `thread_id` int(11) NOT NULL,
  `thread_title` varchar(100) NOT NULL,
  `thread_desc` varchar(300) NOT NULL,
  `thread_cat_id` int(11) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `date_posted`, `date_updated`, `user_id`, `status`) VALUES
(1, 'How do I set a secure cookie in PHP ?', 'Hello guys I was trying to set a secure cookie in PHP please provide me an OOP based solution', 1, '2023-06-14 21:00:00', '2023-06-21 19:43:25', 6923, 1),
(2, 'How to create an object', 'How do I create an object in Python ?', 2, '2023-06-15 21:00:00', '2023-06-21 19:43:25', 6924, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(250) NOT NULL,
  `profilepic` text NOT NULL DEFAULT 'user-default.jpg',
  `status` text NOT NULL DEFAULT 'Offline'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `dob`, `password`, `profilepic`, `status`) VALUES
(6923, 'mpiers110', 'mpiers110@gmail.com', '2001-05-20', 'uliza2023.f02f758dbc86d616d3ec9c9452c0c2b2', 'mpiers110.png', 'Offline'),
(6924, 'admin10', 'admin@gmail.com', '2005-02-01', 'uliza2023.6b1049159fb98132913a5e5b8bde49bd', 'user-default.jpg', 'Offline'),
(6926, 'mzeemzima', 'mzee@gmail.com', '2001-05-20', 'uliza2023.4dfe68b135dd7c6b77d4a40036bea656', 'user-default.jpg', '\'Offline\'');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`),
  ADD UNIQUE KEY `thread_title` (`thread_title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6927;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
