-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 24, 2021 at 03:20 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kbth_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `consultation_id` int(100) NOT NULL AUTO_INCREMENT,
  `patient_id` int(100) NOT NULL,
  `staff_id` int(100) NOT NULL,
  `temperature` varchar(50) NOT NULL,
  `pulse_rate` varchar(50) NOT NULL,
  `respiration` varchar(50) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `systolic_pressure` varchar(50) NOT NULL,
  `diastolic_pressure` varchar(50) NOT NULL,
  `lab_result` varchar(300) NOT NULL DEFAULT 'not applicable',
  `prescription` varchar(300) NOT NULL,
  `prescription_status` char(15) NOT NULL DEFAULT 'pending',
  `condate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`consultation_id`),
  KEY `patient_id` (`patient_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3003 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`consultation_id`, `patient_id`, `staff_id`, `temperature`, `pulse_rate`, `respiration`, `weight`, `systolic_pressure`, `diastolic_pressure`, `lab_result`, `prescription`, `prescription_status`, `condate`) VALUES
(3001, 2001, 1004, '36 deg cel', '35bps', 'normal', '60kg', '90kks', 'diastolic', 'Lab', 'paracetamol', 'dispensed', '2021-07-23 09:10:56'),
(3002, 2002, 1004, '56kg', '78jhb', 'normal', '36kgs', '87jhg', 'diastolic', 'everything cool', 'paracetamol', 'dispensed', '2021-07-24 03:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(100) NOT NULL AUTO_INCREMENT,
  `patient_name` char(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `parguard` char(15) NOT NULL,
  `parguard_name` char(50) NOT NULL,
  `parguard_contact` varchar(30) NOT NULL,
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2013 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `dob`, `gender`, `address`, `parguard`, `parguard_name`, `parguard_contact`, `regdate`) VALUES
(2001, 'johnny gyan', '2013-07-27', 'Female', '78 Liberia Road', 'Father', 'james gyan', '0547896543', '2021-07-23 04:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` int(100) NOT NULL AUTO_INCREMENT,
  `title` char(5) NOT NULL,
  `staff_name` char(30) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `role` char(25) NOT NULL,
  `department` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `staff_status` char(15) NOT NULL DEFAULT 'active',
  `regdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`staff_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1014 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `title`, `staff_name`, `dob`, `gender`, `address`, `contact`, `role`, `department`, `password`, `staff_status`, `regdate`) VALUES
(1001, 'Mr.', 'Samuel Kwao', '1984-06-06', 'Male', '21 East Legon Street, Accra', '0240987675', 'Administrator', 'Administration', '$2y$10$fF3SDO6c0crWgD4AMmIEQ.lngU0iyTIyFOtL78xvOiaH1OBkaPDi.', 'active', '2021-07-22 16:00:24'),
(1002, 'Mr.', 'James Brown', '1988-03-04', 'Male', 'GA-124-7878', '0541234897', 'Nurse', 'Child department', '$2y$10$vuImFsfBm5ABeO15G3tuj.zDFbUr/QZQPEGp97gAzXxOWWs9yj8Ia', 'active', '2021-07-22 17:00:37'),
(1011, 'Mrs.', 'mary owoo', '2021-07-07', 'Female', '35 Ghana Avenue', '0240987675', 'Doctor', 'Haematic department', '$2y$10$kw83GDk3djNp7xd4O5Z/qOSILiwSbFa8NyhZHjYg8X2yrMH1/gjnK', 'active', '2021-07-24 06:50:21'),
(1004, 'Mr.', 'John Anokye', '1979-03-02', 'Male', 'GA-124-7878', '0541234897', 'Doctor', 'Child department', '$2y$10$yEDLKFuT2I6l8gwvigDYxeq4bVwdXcBoe3xkXPBMOMT/uIFvxESTm', 'active', '2021-07-22 16:10:13'),
(1005, 'Ms.', 'Susan Amoah', '1986-10-10', 'Female', '21 East Legon Street, Accra', '0240987675', 'Doctor', 'Haematic department', '$2y$10$tQ./9M7WA0/VsMX3ruX8HuhZlyCIgfatDMr9QlUF4BcPry4OKNO76', 'active', '2021-07-22 16:11:30'),
(1006, 'Mr.', 'Nicholas Badu', '1974-06-12', 'Male', '35 Ghana Avenue', '0240987675', 'Lab Technician', 'Laboraory department', '$2y$10$mrIaFzUOH6nFGEqcV5yT/OZlZBZsJCU2Q2q4UPNAK2sVOW1ipElgm', 'active', '2021-07-22 16:13:02'),
(1007, 'Mrs.', 'Paulina Amoako', '1999-03-20', 'Female', '78 Liberia Road', '0240987675', 'Lab Technician', 'Laboraory department', '$2y$10$hQjgEsHm9bwdznE/nsswz.VQa0EzDTF4y21HHfAkPAB8glE44uPqG', 'active', '2021-07-22 16:14:29'),
(1008, 'Mr.', 'Joseph Baah', '1983-08-13', 'Male', '54 Abeka Street', '0240987675', 'Pharmacist', 'Dispensory department', '$2y$10$A.KUgzjeRdeTbKyoS4Rm3OoIfWK939Vsa1OSMnSl22N1BB0eoh6ai', 'active', '2021-07-22 16:16:26'),
(1009, 'Mrs.', 'Emelia Appiah', '1980-05-06', 'Female', '87 Lome Street', '0240987675', 'Pharmacist', 'Dispensory department', '$2y$10$4KHrjrz621PvGLAUTMxrN.6tbZariSvO3ZHZN8YOfy/L1RmkEov6q', 'active', '2021-07-22 16:17:53'),
(1012, 'Mrs.', 'mary owoo', '2021-07-15', 'Female', '87 Lome Street', '0240987675', 'Doctor', 'Child department', '$2y$10$vnrEtnlA1hQ0MYcqzk8CnuzBjsu5o5YWhE/0qLpkyQx8xSlpuoUkS', 'active', '2021-07-24 06:53:13'),
(1013, 'Mr.', 'John Anokye', '1979-03-02', 'Male\"', 'GA-124-7878', '0541234897', 'Doctor', 'Child department', '$2y$10$jkWI39FKXdIJJ4NvMY2ZBu4PzU2X5hT7kDnWGqjK5gSSWC.bB6ala', 'active', '2021-07-24 07:35:22');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
mysql