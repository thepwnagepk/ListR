-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 03:08 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listr`
--

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `listID` int(11) NOT NULL,
  `listJSON` text NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdBy` int(11) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`listID`, `listJSON`, `dateCreated`, `createdBy`, `public`, `title`) VALUES
(23, '{\"0\":{\"key\":0,\"type\":\"checked\",\"value\":\"Profile Page\"},\"1\":{\"key\":1,\"type\":\"checked\",\"value\":\"Settings?\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"-Customisation-\"},\"3\":{\"key\":3,\"type\":\"checked\",\"value\":\"(Local) Background Customisation\"},\"4\":{\"key\":4,\"type\":\"unchecked\",\"value\":\"Change Font\"},\"5\":{\"key\":5,\"type\":\"unchecked\",\"value\":\"Change Font Size\"},\"6\":{\"key\":6,\"type\":\"unchecked\",\"value\":\"List Types or Notations?\"},\"7\":{\"key\":7,\"type\":\"checked\",\"value\":\"Custom Colours\"},\"8\":{\"key\":8,\"type\":\"unchecked\",\"value\":\"Flags?\"},\"9\":{\"key\":9,\"type\":\"unchecked\",\"value\":\"-Additional Functionality-\"},\"10\":{\"key\":10,\"type\":\"unchecked\",\"value\":\"Drag and Drop\"},\"11\":{\"key\":11,\"type\":\"unchecked\",\"value\":\"Pagination\"},\"12\":{\"key\":12,\"type\":\"unchecked\",\"value\":\"Ratings\"},\"13\":{\"key\":13,\"type\":\"checked\",\"value\":\"Tidying up\"},\"14\":{\"key\":14,\"type\":\"checked\",\"value\":\"Custom Fonts Added\"}}', '2019-05-22 12:44:10', 9, 1, 'Things to finish'),
(40, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"1\"},\"1\":{\"key\":1,\"type\":\"unchecked\",\"value\":\"2\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"rr\"}}', '2019-05-24 14:34:45', 9, 0, 'Test List'),
(41, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"1\"},\"1\":{\"key\":1,\"type\":\"unchecked\",\"value\":\"3\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"5\"}}', '2019-05-28 20:05:31', 10, 1, 'List Test '),
(42, '{\"0\":{\"key\":0,\"type\":\"checked\",\"value\":\"Profile Page\"},\"1\":{\"key\":1,\"type\":\"checked\",\"value\":\"Settings?\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"-Customisation-\"},\"3\":{\"key\":3,\"type\":\"checked\",\"value\":\"Background Customisation\"},\"4\":{\"key\":4,\"type\":\"unchecked\",\"value\":\"Change Font\"},\"5\":{\"key\":5,\"type\":\"unchecked\",\"value\":\"Change Font Size\"},\"6\":{\"key\":6,\"type\":\"unchecked\",\"value\":\"List Types or Notations?\"},\"7\":{\"key\":7,\"type\":\"checked\",\"value\":\"Custom Colours\"},\"8\":{\"key\":8,\"type\":\"unchecked\",\"value\":\"Flags?\"},\"9\":{\"key\":9,\"type\":\"unchecked\",\"value\":\"-Additional Functionality-\"},\"10\":{\"key\":10,\"type\":\"unchecked\",\"value\":\"Drag and Drop\"},\"11\":{\"key\":11,\"type\":\"unchecked\",\"value\":\"Pagination\"},\"12\":{\"key\":12,\"type\":\"unchecked\",\"value\":\"Ratings\"},\"13\":{\"key\":13,\"type\":\"checked\",\"value\":\"Tidying up\"},\"14\":{\"key\":14,\"type\":\"checked\",\"value\":\"Custom Fonts Added\"}}', '2019-05-28 20:20:08', 10, 0, 'Things to finish'),
(43, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"aaaaa\"}}', '2019-05-28 20:22:57', 10, 1, 'A'),
(44, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"bbbbb\"}}', '2019-05-28 20:23:06', 10, 1, 'B'),
(45, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"ccccc\"}}', '2019-05-28 20:23:16', 10, 1, 'C'),
(46, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"1\"},\"1\":{\"key\":1,\"type\":\"unchecked\",\"value\":\"3\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"5\"}}', '2019-06-15 16:22:20', 11, 0, 'List Test '),
(47, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"1\"},\"1\":{\"key\":1,\"type\":\"unchecked\",\"value\":\"3\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"5\"}}', '2019-06-15 16:22:30', 11, 0, 'List Test '),
(48, '{\"0\":{\"key\":0,\"type\":\"unchecked\",\"value\":\"ccxzcxzcx\"},\"1\":{\"key\":1,\"type\":\"unchecked\",\"value\":\"xzxz\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"sdsds\"},\"3\":{\"key\":3,\"type\":\"unchecked\",\"value\":\"asdasdsa\"},\"4\":{\"key\":4,\"type\":\"unchecked\",\"value\":\"xcxz\"}}', '2019-11-13 16:00:28', 12, 0, 'List Title'),
(49, '{\"0\":{\"key\":0,\"type\":\"checked\",\"value\":\"Profile Page\"},\"1\":{\"key\":1,\"type\":\"checked\",\"value\":\"Settings?\"},\"2\":{\"key\":2,\"type\":\"unchecked\",\"value\":\"-Customisation-\"},\"3\":{\"key\":3,\"type\":\"checked\",\"value\":\"Background Customisation\"},\"4\":{\"key\":4,\"type\":\"unchecked\",\"value\":\"Change Font\"},\"5\":{\"key\":5,\"type\":\"unchecked\",\"value\":\"Change Font Size\"},\"6\":{\"key\":6,\"type\":\"unchecked\",\"value\":\"List Types or Notations?\"},\"7\":{\"key\":7,\"type\":\"checked\",\"value\":\"Custom Colours\"},\"8\":{\"key\":8,\"type\":\"unchecked\",\"value\":\"Flags?\"},\"9\":{\"key\":9,\"type\":\"unchecked\",\"value\":\"-Additional Functionality-\"},\"10\":{\"key\":10,\"type\":\"unchecked\",\"value\":\"Drag and Drop\"},\"11\":{\"key\":11,\"type\":\"unchecked\",\"value\":\"Pagination\"},\"12\":{\"key\":12,\"type\":\"unchecked\",\"value\":\"Ratings\"},\"13\":{\"key\":13,\"type\":\"checked\",\"value\":\"Tidying up\"},\"14\":{\"key\":14,\"type\":\"checked\",\"value\":\"Custom Fonts Added\"}}', '2019-11-13 16:02:01', 12, 1, 'Things to finish');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `name`) VALUES
(9, 'thepwnagepk@gmail.com', '$2y$10$cFxUg6UpzKwp0lbMvzv1WeGplO2mwN.FaiiUK4qAi3m5KqCzmnHuW', 'Thomas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`listID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `listID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
