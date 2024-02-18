-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 06:52 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
  `S_1` int(11) NOT NULL DEFAULT '-1',
  `S_2` int(11) NOT NULL DEFAULT '-1',
  `S_3` int(11) NOT NULL DEFAULT '-1',
  `S_4` int(11) NOT NULL DEFAULT '-1',
  `S_5` int(11) NOT NULL DEFAULT '-1',
  `S_6` int(11) NOT NULL DEFAULT '-1',
  `S_7` int(11) NOT NULL DEFAULT '-1',
  `S_8` int(11) NOT NULL DEFAULT '-1',
  `S_9` int(11) NOT NULL DEFAULT '-1',
  `S_10` int(11) NOT NULL DEFAULT '-1',
  `S_11` int(11) NOT NULL DEFAULT '-1',
  `S_12` int(11) NOT NULL DEFAULT '-1',
  `S_13` int(11) NOT NULL DEFAULT '-1',
  `S_14` int(11) NOT NULL DEFAULT '-1',
  `S_15` int(11) NOT NULL DEFAULT '-1',
  `S_16` int(11) NOT NULL DEFAULT '-1',
  `S_17` int(11) NOT NULL DEFAULT '-1',
  `S_18` int(11) NOT NULL DEFAULT '-1',
  `S_19` int(11) NOT NULL DEFAULT '-1',
  `S_20` int(11) NOT NULL DEFAULT '-1',
  `S_21` int(11) NOT NULL DEFAULT '-1',
  `S_22` int(11) NOT NULL DEFAULT '-1',
  `S_23` int(11) NOT NULL DEFAULT '-1',
  `S_24` int(11) NOT NULL DEFAULT '-1',
  `S_25` int(11) NOT NULL DEFAULT '-1',
  `S_26` int(11) NOT NULL DEFAULT '-1',
  `S_27` int(11) NOT NULL DEFAULT '-1',
  `S_28` int(11) NOT NULL DEFAULT '-1',
  `S_29` int(11) NOT NULL DEFAULT '-1',
  `S_30` int(11) NOT NULL DEFAULT '-1',
  `S_31` int(11) NOT NULL DEFAULT '-1',
  `S_32` int(11) NOT NULL DEFAULT '-1',
  `S_33` int(11) NOT NULL DEFAULT '-1',
  `S_34` int(11) NOT NULL DEFAULT '-1',
  `S_35` int(11) NOT NULL DEFAULT '-1',
  `S_36` int(11) NOT NULL DEFAULT '-1',
  `S_37` int(11) NOT NULL DEFAULT '-1',
  `S_38` int(11) NOT NULL DEFAULT '-1',
  `S_39` int(11) NOT NULL DEFAULT '-1',
  `S_40` int(11) NOT NULL DEFAULT '-1',
  `S_41` int(11) NOT NULL DEFAULT '-1',
  `S_42` int(11) NOT NULL DEFAULT '-1',
  `S_43` int(11) NOT NULL DEFAULT '-1',
  `S_44` int(11) NOT NULL DEFAULT '-1',
  `S_45` int(11) NOT NULL DEFAULT '-1',
  `S_46` int(11) NOT NULL DEFAULT '-1',
  `S_47` int(11) NOT NULL DEFAULT '-1',
  `S_48` int(11) NOT NULL DEFAULT '-1',
  `S_49` int(11) NOT NULL DEFAULT '-1',
  `S_50` int(11) NOT NULL DEFAULT '-1',
  `S_51` int(11) NOT NULL DEFAULT '-1',
  `S_52` int(11) NOT NULL DEFAULT '-1',
  `S_53` int(11) NOT NULL DEFAULT '-1',
  `S_54` int(11) NOT NULL DEFAULT '-1',
  `S_55` int(11) NOT NULL DEFAULT '-1',
  `S_56` int(11) NOT NULL DEFAULT '-1',
  `S_57` int(11) NOT NULL DEFAULT '-1',
  `S_58` int(11) NOT NULL DEFAULT '-1',
  `S_59` int(11) NOT NULL DEFAULT '-1',
  `S_60` int(11) NOT NULL DEFAULT '-1',
  `S_61` int(11) NOT NULL DEFAULT '-1',
  `S_62` int(11) NOT NULL DEFAULT '-1',
  `S_63` int(11) NOT NULL DEFAULT '-1',
  `S_64` int(11) NOT NULL DEFAULT '-1',
  `S_65` int(11) NOT NULL DEFAULT '-1',
  `S_66` int(11) NOT NULL DEFAULT '-1',
  `S_67` int(11) NOT NULL DEFAULT '-1',
  `S_68` int(11) NOT NULL DEFAULT '-1',
  `S_69` int(11) NOT NULL DEFAULT '-1',
  `S_70` int(11) NOT NULL DEFAULT '-1',
  `S_71` int(11) NOT NULL DEFAULT '-1',
  `S_72` int(11) NOT NULL DEFAULT '-1',
  `S_73` int(11) NOT NULL DEFAULT '-1',
  `S_74` int(11) NOT NULL DEFAULT '-1',
  `S_75` int(11) NOT NULL DEFAULT '-1',
  `S_76` int(11) NOT NULL DEFAULT '-1',
  `S_77` int(11) NOT NULL DEFAULT '-1',
  `S_78` int(11) NOT NULL DEFAULT '-1',
  `S_79` int(11) NOT NULL DEFAULT '-1',
  `S_80` int(11) NOT NULL DEFAULT '-1',
  `S_81` int(11) NOT NULL DEFAULT '-1',
  `S_82` int(11) NOT NULL DEFAULT '-1',
  `S_83` int(11) NOT NULL DEFAULT '-1',
  `S_84` int(11) NOT NULL DEFAULT '-1',
  `S_85` int(11) NOT NULL DEFAULT '-1',
  `S_86` int(11) NOT NULL DEFAULT '-1',
  `S_87` int(11) NOT NULL DEFAULT '-1',
  `S_88` int(11) NOT NULL DEFAULT '-1',
  `S_89` int(11) NOT NULL DEFAULT '-1',
  `S_90` int(11) NOT NULL DEFAULT '-1',
  `S_91` int(11) NOT NULL DEFAULT '-1',
  `S_92` int(11) NOT NULL DEFAULT '-1',
  `S_93` int(11) NOT NULL DEFAULT '-1',
  `S_94` int(11) NOT NULL DEFAULT '-1',
  `S_95` int(11) NOT NULL DEFAULT '-1',
  `S_96` int(11) NOT NULL DEFAULT '-1',
  `S_97` int(11) NOT NULL DEFAULT '-1',
  `S_98` int(11) NOT NULL DEFAULT '-1',
  `S_99` int(11) NOT NULL DEFAULT '-1',
  `S_100` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=121 ;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `date`, `time`, `subject`, `S_1`, `S_2`, `S_3`, `S_4`, `S_5`, `S_6`, `S_7`, `S_8`, `S_9`, `S_10`, `S_11`, `S_12`, `S_13`, `S_14`, `S_15`, `S_16`, `S_17`, `S_18`, `S_19`, `S_20`, `S_21`, `S_22`, `S_23`, `S_24`, `S_25`, `S_26`, `S_27`, `S_28`, `S_29`, `S_30`, `S_31`, `S_32`, `S_33`, `S_34`, `S_35`, `S_36`, `S_37`, `S_38`, `S_39`, `S_40`, `S_41`, `S_42`, `S_43`, `S_44`, `S_45`, `S_46`, `S_47`, `S_48`, `S_49`, `S_50`, `S_51`, `S_52`, `S_53`, `S_54`, `S_55`, `S_56`, `S_57`, `S_58`, `S_59`, `S_60`, `S_61`, `S_62`, `S_63`, `S_64`, `S_65`, `S_66`, `S_67`, `S_68`, `S_69`, `S_70`, `S_71`, `S_72`, `S_73`, `S_74`, `S_75`, `S_76`, `S_77`, `S_78`, `S_79`, `S_80`, `S_81`, `S_82`, `S_83`, `S_84`, `S_85`, `S_86`, `S_87`, `S_88`, `S_89`, `S_90`, `S_91`, `S_92`, `S_93`, `S_94`, `S_95`, `S_96`, `S_97`, `S_98`, `S_99`, `S_100`) VALUES
(106, '2024-01-31', '21:40:00.000000', '10', -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, 1, -1, 1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, 0, -1, -1, -1, -1, -1, 0, -1, 0, -1, 0, -1, 0, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1),
(107, '2024-01-31', '21:42:00.000000', '10', 1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, 1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, -1, -1, 0, -1, 0, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, 1, -1, -1, -1, 0, -1, -1, -1, -1, 1, -1, -1, -1, -1),
(108, '2024-01-31', '21:43:00.000000', '10', 1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, -1, -1, 1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, -1),
(109, '2024-01-31', '22:36:00.000000', '9', 1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, 1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 1, 0, -1, -1, -1, -1, -1, -1, 1, -1, 0, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, 0, -1, -1, -1, -1, 0, -1, -1, -1, -1),
(110, '2024-01-31', '22:39:00.000000', '9', 1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, 0, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 0, 0, -1, -1, -1, -1, -1, -1, 0, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, 1, -1, -1, -1, 0, -1, -1, -1, -1, 1, -1, -1, -1, -1),
(111, '2024-01-31', '22:40:00.000000', '9', 1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, 0, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, -1, -1, 1, -1, 0, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, 0, -1, -1, -1, -1),
(112, '2024-02-01', '10:48:00.000000', '10', -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, 0, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, 1, -1, 1, -1, 1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1),
(113, '2024-02-01', '10:49:00.000000', '9', 1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, 0, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 0, 0, -1, -1, -1, -1, -1, -1, 0, -1, 0, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, 0, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, 0, -1, -1, -1, 0, -1, -1, -1, -1, 0, -1, -1, -1, -1),
(116, '2024-02-01', '16:56:00.000000', '12', 1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, 0, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 0, 0, -1, -1, -1, -1, -1, -1, 0, -1, 1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, 0, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 0, -1, -1, -1, 0, -1, -1, -1, -1, 0, -1, -1, -1, -1),
(117, '2024-02-01', '16:58:00.000000', '12', -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 1),
(118, '2024-02-01', '18:39:00.000000', '9', 1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, -1, -1, 1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, -1),
(119, '2024-02-05', '19:23:00.000000', '10', 1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, 1, -1, -1, -1, -1, -1, -1, 1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, 1, -1, -1, -1, -1),
(120, '2024-02-06', '09:22:00.000000', '10', -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, 0, -1, 0, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 1, -1, -1, 1, -1, -1, -1, -1, -1, 1, -1, 1, -1, 1, -1, 1, -1, -1, -1, 1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `year`, `divi`, `department_id`, `teacher_id`) VALUES
(6, 1, 'A', 8, 0),
(7, 2, 'A', 8, 0),
(8, 1, 'B', 8, 0),
(9, 1, 'A', 7, 31),
(10, 1, 'B', 7, 25),
(11, 2, 'A', 7, 27),
(12, 2, 'B', 7, 33);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`) VALUES
(7, 'Computer', 1),
(8, 'Information Technology', 1),
(9, 'Electronics and Telecommunication ', 0),
(10, 'Electronics', 0),
(11, 'CIvil', 0),
(12, 'Automobile', 0),
(13, 'Mechanical', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `hod_reg`
--

INSERT INTO `hod_reg` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `report_to`, `department_id`) VALUES
(14, 'HOD', 'Computer', 'virajchikhale88@gmail.com', '9766466299', '25d55ad283aa400af464c76d713c07ad', '13', '7'),
(15, 'HOD', 'IT', 'chikhaleviraj@gmail.com', '9766466299', '25d55ad283aa400af464c76d713c07ad', '13', '8');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `principal_reg`
--

INSERT INTO `principal_reg` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`) VALUES
(13, 'Principal', 'Viraj', 'virajchikhale88@gmail.com', '9766466299', '25d55ad283aa400af464c76d713c07ad');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=201 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `roll`, `enroll`, `name`, `phone`, `email`, `class_id`) VALUES
(102, '2', '2', 'John Anderson', '3764617213', 'emily_johnson@school.edu', 11),
(103, '3', '3', 'Sophia Brown', '0410480791', 'william_anderson@company.net', 8),
(104, '4', '4', 'Jane Smith', '4359084703', 'john_miller@service.org', 6),
(105, '5', '5', 'David Davis', '5753547404', 'john_johnson@company.net', 8),
(106, '6', '6', 'Michael Miller', '8937594746', 'robert_smith@example.com', 8),
(107, '7', '7', 'Jane Taylor', '1205507114', 'michael_smith@school.edu', 8),
(108, '8', '8', 'William Davis', '0809652919', 'emma_doe@example.com', 10),
(109, '9', '9', 'Robert Wilson', '3792989269', 'john_wilson@company.net', 7),
(110, '10', '10', 'Olivia Anderson', '0455003009', 'sophia_doe@school.edu', 8),
(111, '11', '11', 'Michael Brown', '4184794474', 'william_moore@service.org', 9),
(112, '12', '12', 'Michael Brown', '1787326188', 'jane_doe@example.com', 11),
(113, '13', '13', 'Olivia Miller', '1652460904', 'sophia_doe@school.edu', 8),
(114, '14', '14', 'Emily Miller', '6244974933', 'jane_johnson@example.com', 11),
(115, '15', '15', 'Olivia Miller', '6820454187', 'john_doe@company.net', 10),
(116, '16', '16', 'Emma Johnson', '6394490220', 'sophia_smith@school.edu', 7),
(117, '17', '17', 'William Anderson', '2047400898', 'david_brown@service.org', 8),
(118, '18', '18', 'Emma Moore', '0863189139', 'john_miller@school.edu', 12),
(119, '19', '19', 'David Davis', '8490446569', 'david_miller@school.edu', 11),
(120, '20', '20', 'Emily Smith', '3494200861', 'emily_anderson@example.com', 10),
(121, '21', '21', 'Olivia Wilson', '5993499013', 'john_doe@example.com', 9),
(122, '22', '22', 'Olivia Davis', '2969942129', 'jane_brown@school.edu', 9),
(123, '23', '23', 'John Moore', '7634059972', 'emily_anderson@example.com', 10),
(124, '24', '24', 'Robert Doe', '6578412480', 'sophia_smith@example.com', 9),
(125, '25', '25', 'John Moore', '9752183584', 'emma_davis@example.com', 7),
(126, '26', '26', 'Michael Smith', '3091495574', 'john_doe@school.edu', 11),
(127, '27', '27', 'Michael Johnson', '1320134090', 'michael_wilson@school.edu', 11),
(128, '28', '28', 'David Moore', '2052661418', 'john_taylor@company.net', 9),
(129, '29', '29', 'Emily Doe', '8318446842', 'michael_smith@service.org', 6),
(130, '30', '30', 'Robert Taylor', '1474401801', 'jane_smith@example.com', 6),
(131, '31', '31', 'John Moore', '4644797350', 'jane_wilson@example.com', 6),
(132, '32', '32', 'Emily Doe', '6218209414', 'emma_davis@example.com', 7),
(133, '33', '33', 'Emily Doe', '5770046987', 'olivia_brown@company.net', 8),
(134, '34', '34', 'Robert Doe', '7476440794', 'jane_johnson@service.org', 11),
(135, '35', '35', 'William Anderson', '9146640077', 'michael_doe@example.com', 7),
(136, '36', '36', 'Michael Johnson', '6537826517', 'olivia_doe@service.org', 11),
(137, '37', '37', 'Olivia Doe', '3247027433', 'jane_miller@school.edu', 6),
(138, '38', '38', 'Robert Davis', '0091289237', 'david_taylor@company.net', 10),
(139, '39', '39', 'John Moore', '1963660223', 'robert_taylor@company.net', 11),
(140, '40', '40', 'Robert Doe', '1496017221', 'robert_brown@service.org', 12),
(141, '41', '41', 'Olivia Moore', '3247622688', 'michael_doe@service.org', 6),
(142, '42', '42', 'Michael Taylor', '2500283059', 'john_miller@service.org', 10),
(143, '43', '43', 'Olivia Wilson', '0149590156', 'michael_anderson@school.edu', 7),
(144, '44', '44', 'William Miller', '1027584288', 'robert_anderson@company.net', 12),
(145, '45', '45', 'John Johnson', '0655022776', 'michael_taylor@company.net', 6),
(146, '46', '46', 'Olivia Smith', '4432723986', 'olivia_wilson@service.org', 8),
(147, '47', '47', 'Emily Brown', '9421675646', 'michael_anderson@service.org', 7),
(148, '48', '48', 'Michael Wilson', '2817358510', 'david_johnson@school.edu', 11),
(149, '49', '49', 'William Wilson', '2726218158', 'jane_smith@service.org', 7),
(150, '50', '50', 'Emily Brown', '7601666546', 'david_miller@service.org', 12),
(151, '51', '51', 'Jane Smith', '3909934854', 'david_johnson@company.net', 11),
(152, '52', '52', 'David Wilson', '8356862132', 'robert_smith@service.org', 10),
(153, '53', '53', 'Emily Doe', '3146775793', 'jane_moore@school.edu', 6),
(154, '54', '54', 'Jane Miller', '0717059368', 'olivia_moore@example.com', 8),
(155, '55', '55', 'Jane Wilson', '4202572626', 'william_miller@example.com', 12),
(156, '56', '56', 'David Moore', '0386540897', 'olivia_doe@school.edu', 7),
(157, '57', '57', 'John Wilson', '0317853660', 'william_miller@company.net', 9),
(158, '58', '58', 'Emma Anderson', '4898335216', 'olivia_wilson@company.net', 11),
(159, '59', '59', 'Emily Wilson', '2805096035', 'michael_brown@example.com', 7),
(160, '60', '60', 'William Smith', '1770897910', 'michael_miller@school.edu', 9),
(161, '61', '61', 'Michael Davis', '2999652036', 'olivia_doe@service.org', 8),
(162, '62', '62', 'Michael Anderson', '9751876967', 'robert_doe@example.com', 11),
(163, '63', '63', 'David Miller', '1036230186', 'robert_miller@school.edu', 8),
(164, '64', '64', 'Emma Taylor', '0154420859', 'emily_smith@school.edu', 6),
(165, '65', '65', 'William Taylor', '5691982667', 'jane_anderson@school.edu', 10),
(166, '66', '66', 'John Doe', '8301471023', 'john_taylor@example.com', 9),
(167, '67', '67', 'Robert Anderson', '3745473631', 'jane_johnson@example.com', 7),
(168, '68', '68', 'Emma Anderson', '9288376696', 'emily_wilson@school.edu', 9),
(169, '69', '69', 'Emily Anderson', '5580410300', 'david_wilson@school.edu', 12),
(170, '70', '70', 'William Wilson', '7406387101', 'michael_davis@company.net', 9),
(171, '71', '71', 'William Doe', '2105846616', 'david_davis@school.edu', 8),
(172, '72', '72', 'William Miller', '4513607406', 'william_doe@school.edu', 9),
(173, '73', '73', 'William Wilson', '8900403807', 'emma_anderson@service.org', 6),
(174, '74', '74', 'William Taylor', '4700432928', 'william_taylor@school.edu', 7),
(175, '75', '75', 'William Smith', '5069860411', 'william_smith@school.edu', 11),
(176, '76', '76', 'David Miller', '2711115903', 'william_doe@school.edu', 9),
(177, '77', '77', 'Emily Taylor', '3478084018', 'david_wilson@service.org', 10),
(178, '78', '78', 'Sophia Taylor', '6407669714', 'john_miller@example.com', 6),
(179, '79', '79', 'Jane Anderson', '0790167770', 'robert_miller@service.org', 6),
(180, '80', '80', 'Robert Smith', '0956308852', 'emily_doe@service.org', 8),
(181, '81', '81', 'Emma Smith', '4859661340', 'robert_brown@example.com', 10),
(182, '82', '82', 'Robert Miller', '4531632972', 'william_moore@company.net', 11),
(183, '83', '83', 'John Taylor', '7199040761', 'emily_smith@service.org', 10),
(184, '84', '84', 'William Brown', '9692284208', 'john_wilson@service.org', 7),
(185, '85', '85', 'John Johnson', '9399268758', 'robert_anderson@school.edu', 6),
(186, '86', '86', 'Michael Wilson', '0781616874', 'emily_taylor@company.net', 8),
(187, '87', '87', 'Jane Brown', '7191462621', 'william_wilson@company.net', 11),
(188, '88', '88', 'Jane Miller', '5845602089', 'david_anderson@school.edu', 10),
(189, '89', '89', 'William Miller', '3318515687', 'robert_moore@company.net', 10),
(190, '90', '90', 'Jane Moore', '1191597198', 'william_taylor@example.com', 8),
(191, '91', '91', 'William Anderson', '9357524010', 'john_doe@service.org', 11),
(192, '92', '92', 'Jane Moore', '4899171523', 'jane_doe@company.net', 10),
(193, '93', '93', 'John Davis', '7666573648', 'emily_johnson@school.edu', 8),
(194, '94', '94', 'John Smith', '7800071553', 'michael_anderson@school.edu', 8),
(195, '95', '95', 'John Doe', '6604862258', 'sophia_taylor@example.com', 12),
(196, '96', '96', 'Michael Doe', '1229163596', 'sophia_moore@company.net', 11),
(197, '97', '97', 'Olivia Davis', '0286743368', 'john_doe@company.net', 7),
(198, '98', '98', 'Jane Miller', '8988621501', 'david_davis@company.net', 6),
(199, '99', '99', 'David Wilson', '8464477287', 'john_davis@school.edu', 10),
(200, '100', '100', 'Olivia Moore', '8525284748', 'robert_johnson@school.edu', 12);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `code`, `name`, `type`, `department_id`, `teacher_id`, `year`) VALUES
(3, '1', 'Science', 0, 8, 0, 0),
(4, '2', 'Maths', 0, 8, 0, 0),
(5, '3', 'English', 0, 8, 0, 0),
(6, '4', 'SST', 0, 8, 0, 0),
(7, '5', 'WT', 0, 8, 0, 0),
(8, '6', 'AI', 0, 8, 0, 0),
(9, '1', 'English', 0, 7, 27, 2),
(10, '2', 'Maths', 1, 7, 25, 2),
(11, '3', 'Science', 0, 7, 33, 2),
(12, '4', 'WT', 1, 7, 29, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `teacher_reg`
--

INSERT INTO `teacher_reg` (`id`, `first_name`, `last_name`, `email`, `phone`, `password`, `report_to`, `department_id`, `status`) VALUES
(25, 'John', 'Doe', 'john.doe@example.com', '1234567890', '25d55ad283aa400af464c76d713c07ad', '14', '7', 1),
(26, 'Jane', 'Smith', 'jane.smith@example.com', '9876543210', '25d55ad283aa400af464c76d713c07ad', '15', '8', 0),
(27, 'Robert', 'Johnson', 'robert.johnson@example.com', '5555555555', '25d55ad283aa400af464c76d713c07ad', '14', '7', 1),
(28, 'Emily', 'Davis', 'emily.davis@example.com', '1112223333', '25d55ad283aa400af464c76d713c07ad', '15', '8', 0),
(29, 'Michael', 'Brown', 'michael.brown@example.com', '4443332222', '25d55ad283aa400af464c76d713c07ad', '14', '7', 0),
(30, 'Sophia', 'Wilson', 'sophia.wilson@example.com', '9998887777', '25d55ad283aa400af464c76d713c07ad', '15', '8', 0),
(31, 'David', 'Miller', 'david.miller@example.com', '7776665555', '25d55ad283aa400af464c76d713c07ad', '14', '7', 1),
(32, 'Olivia', 'Moore', 'olivia.moore@example.com', '3334445555', '25d55ad283aa400af464c76d713c07ad', '15', '8', 0),
(33, 'William', 'Taylor', 'william.taylor@example.com', '6667778888', '25d55ad283aa400af464c76d713c07ad', '14', '7', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
