-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 03:45 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_reg`
--

CREATE TABLE IF NOT EXISTS `admin_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `admin_reg`
--

INSERT INTO `admin_reg` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`) VALUES
(11, 'viraj', 'chikhale', 'virajchikhale88@gmail.com', '09766466299', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE IF NOT EXISTS `attendence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `time` time(6) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `S_10` int(11) NOT NULL DEFAULT '-1',
  `S_11` int(11) NOT NULL DEFAULT '-1',
  `S_12` int(11) NOT NULL DEFAULT '-1',
  `S_13` int(11) NOT NULL DEFAULT '-1',
  `S_14` int(11) NOT NULL DEFAULT '-1',
  `S_15` int(11) NOT NULL DEFAULT '-1',
  `S_16` int(11) NOT NULL DEFAULT '-1',
  `S_17` int(11) NOT NULL DEFAULT '-1',
  `S_` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `date`, `time`, `subject`, `S_10`, `S_11`, `S_12`, `S_13`, `S_14`, `S_15`, `S_16`, `S_17`, `S_`) VALUES
(92, '2023-12-18', '18:22:00.000000', 'HCI', 1, 0, 1, 0, -1, -1, -1, -1, -1),
(93, '2023-12-19', '15:15:00.000000', 'WT', 1, 0, 1, 0, 1, -1, -1, -1, -1),
(94, '2023-12-19', '15:27:00.000000', 'HCI', 1, 0, 1, 0, 1, -1, -1, -1, -1);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `divi` varchar(10) NOT NULL,
  `department_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `year`, `divi`, `department_id`, `teacher_id`) VALUES
(1, 1, 'A', 3, 0),
(2, 2, 'B', 3, 0),
(3, 1, 'B', 3, 22),
(4, 1, 'A', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`) VALUES
(1, 'IT', 1),
(2, 'COM', 0),
(3, 'AIDS', 1),
(4, 'ENTC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `principal_verification` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`principal_verification`) VALUES
('ABCD');

-- --------------------------------------------------------

--
-- Table structure for table `hod_reg`
--

CREATE TABLE IF NOT EXISTS `hod_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `report_to` text NOT NULL,
  `department_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `hod_reg`
--

INSERT INTO `hod_reg` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `report_to`, `department_id`) VALUES
(12, 'viraj', 'chikhale', 'virajchikhale88@gmail.com', '9766466299', '7a34efbb9b40f6644df6330831208185', '10', '3'),
(13, 'viraj', 'chikhale', 'chikhaleviraj@gmail.com', '9876543211', '7a34efbb9b40f6644df6330831208185', '10', '1');

-- --------------------------------------------------------

--
-- Table structure for table `principal_reg`
--

CREATE TABLE IF NOT EXISTS `principal_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `principal_reg`
--

INSERT INTO `principal_reg` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`) VALUES
(10, 'viraj', 'chikhale', 'virajchikhale88@gmail.com', '9766466299', '7a34efbb9b40f6644df6330831208185'),
(11, 'viraj', 'chikhale', 'chikhaleviraj@gmail.com', 'virajchikhale88@gmail.com', '67b2cea5146593bd19364b439de60a34');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll` varchar(10) NOT NULL,
  `enroll` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `roll`, `enroll`, `name`, `phone`, `email`, `class_id`) VALUES
(26, '12', '12', 'atharv jori', '0976646629', 'dtr', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_reg`
--

CREATE TABLE IF NOT EXISTS `teacher_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `password` text NOT NULL,
  `report_to` text NOT NULL,
  `department_id` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `teacher_reg`
--

INSERT INTO `teacher_reg` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `report_to`, `department_id`, `status`) VALUES
(22, 'viraj111', 'chikhale', 'virajchikhale88@gmail.com', '9766466299', '5e8667a439c68f5145dd2fcbecf02209', '12', '3', 1),
(23, 'atharv', 'jori', 'atharvatharv1503@gmail.com', '930764845', '6ebe76c9fb411be97b3b0d48b791a7c9', '12', '3', 0),
(24, 'viraj', 'chikhale', 'chikhaleviraj@gmail.com', '76543212345', '2ca31d1dc5483ce92a8352352730958e', '13', '1', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
