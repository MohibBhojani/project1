-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 15, 2015 at 07:05 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL auto_increment,
  `course_name` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `courses`
--


-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(40) NOT NULL,
  `subject` varchar(80) NOT NULL,
  `notice` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `subject`, `notice`) VALUES
(1, 'Result Of Entry Test Batch(2016)', 'Result', 'The Result of entry test batch (2016) will be displayed on the notice board on Monday(16/11/15).<br />\r\n\r\nRegards:\r\nRegistrar');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  `salary` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `name`, `salary`) VALUES
(1, 'mussadiq', '120000');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(180) NOT NULL,
  `password` varchar(190) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `type`) VALUES
(1, 'nawazish', 'rabbani', 'admin'),
(2, 'hamza', 'iqbal', 'student'),
(3, 'mohib', 'mohib', 'student'),
(4, 'mussadiq', 'mussadiq', 'teacher'),
(5, 'ali', 'ali', 'student'),
(6, 'rashid', 'kamal', 'student'),
(7, 'zaka', 'zaka', 'teacher');
