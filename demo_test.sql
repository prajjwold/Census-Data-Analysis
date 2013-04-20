-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2013 at 12:34 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `censusNepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `demo_test`
--

CREATE TABLE IF NOT EXISTS `demo_test` (
  `yr` int(11) NOT NULL,
  `dst_id` int(11) NOT NULL,
  `bhramin` int(11) NOT NULL,
  `chhetri` int(11) NOT NULL,
  `newar` int(11) NOT NULL,
  `clst_id` int(11) NOT NULL,
  `tot_cnt` int(11) NOT NULL,
  `dst_nme` varchar(50) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo_test`
--

INSERT INTO `demo_test` (`yr`, `dst_id`, `bhramin`, `chhetri`, `newar`, `clst_id`, `tot_cnt`, `dst_nme`, `lat`, `lng`) VALUES
(2010, 1, 50, 60, 12, 1, 122, 'bajhang', 0, 0),
(2010, 2, 60, 80, 10, 1, 150, 'bajura', 0, 0),
(2010, 3, 20, 50, 8, 1, 78, 'doti', 0, 0),
(2010, 9, 45, 45, 56, 2, 146, 'kapilbastu', 0, 0),
(2010, 7, 11, 55, 88, 2, 154, 'udayapur', 0, 0),
(2010, 10, 33, 22, 44, 2, 99, 'nawalparasi', 0, 0),
(2010, 5, 99, 55, 45, 3, 199, 'kailali', 0, 0),
(2010, 8, 55, 55, 55, 3, 165, 'gulmi', 0, 0),
(2010, 4, 75, 45, 56, 3, 176, 'achham', 0, 0),
(2010, 6, 100, 88, 88, 3, 276, 'kanchanpur', 0, 0);
