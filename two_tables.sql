-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2017 at 11:28 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gse`
--

-- --------------------------------------------------------

--
-- Table structure for table `gse_getintouchmovie`
--

CREATE TABLE IF NOT EXISTS `gse_getintouchmovie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gse_getintouchmovie`
--

INSERT INTO `gse_getintouchmovie` (`id`, `name`, `lastname`, `email`, `title`, `message`, `status`, `timestamp`) VALUES
(1, 'Chintan', 'Shah', 'chintan.shah@wohlig.com', 'Title test', 'Message goes here....', 0, '2017-03-17 09:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `gse_workdone`
--

CREATE TABLE IF NOT EXISTS `gse_workdone` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `city` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gse_workdone`
--

INSERT INTO `gse_workdone` (`id`, `title`, `date`, `city`, `description`, `image`, `url`, `status`, `timestamp`) VALUES
(1, 'Title test', '2017-03-19', 'mumbai', 'demo', '2014_-_12.jpg', 'google.com', 0, '2017-03-17 10:17:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gse_getintouchmovie`
--
ALTER TABLE `gse_getintouchmovie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_workdone`
--
ALTER TABLE `gse_workdone`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gse_getintouchmovie`
--
ALTER TABLE `gse_getintouchmovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_workdone`
--
ALTER TABLE `gse_workdone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
