-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2016 at 05:54 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_attendance`
--

CREATE TABLE IF NOT EXISTS `class_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `math` int(3) NOT NULL,
  `science` int(3) NOT NULL,
  `sst` int(3) NOT NULL,
  `english` int(3) NOT NULL,
  `hindi` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `class_attendance`
--

INSERT INTO `class_attendance` (`id`, `username`, `math`, `science`, `sst`, `english`, `hindi`) VALUES
(11, 'Shiv', 10, 5, 6, -1, -1),
(12, 'chanty', 5, -1, 2, 0, -1),
(13, 'tublu', 0, -1, 5, -1, 0),
(14, 'pintu', 0, 0, 4, -1, -1),
(15, 'bapi', 0, 1, 1, -1, -1),
(16, 'prasanjit19', 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `subject` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `usertype`, `subject`) VALUES
(20, 'Shiv Shankar Subudhi', 'shiv.shankar@gmail.com', 'Shiv', 'Sheetal@123', 'student', ''),
(26, 'Chanty', 'chanty@gmail.com', 'chanty', 'Sheetal@123', 'student', ''),
(27, 'Tublu', 'tublu@gmail.com', 'tublu', 'Sheetal@123', 'student', ''),
(28, 'Pintu', 'pintu@gmail.com', 'pintu', 'Sheetal@123', 'student', ''),
(29, 'Ram Narayan Subudhi', 'rimu@gmail.com', 'rimu', 'Sheetal@123', 'teacher', 'sst'),
(30, 'prasanjit', 'prasanjit.mish@gmail.com', 'bapi', 'Bapi@1993', 'student', ''),
(31, 'prasanjit19', 'prasanjit.mishra19@gmail.com', 'prasanjit19', 'Prasanjit@19', 'student', ''),
(32, 'mishra19', 'mishra19@gmail.com', 'mishra1993', 'Mishra@19', 'teacher', 'sst'),
(33, 'shiv123456', 'shiv@cricbuzz.com', 'Shiv1234', 'Shetal@!23', 'teacher', 'science');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
