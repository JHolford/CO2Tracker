-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2020 at 12:42 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v8s60`
--

-- --------------------------------------------------------

--
-- Table structure for table `co2accounts`
--

CREATE TABLE `co2accounts` (
  `Account_ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(256) NOT NULL,
  `CO2Count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `co2accounts`
--

INSERT INTO `co2accounts` (`Account_ID`, `username`, `password`, `CO2Count`) VALUES
(1, 'v8s60', '$2y$10$7Ro0N0kvqyC3YcvUgUa.9OeQlX5d1gKS7Nm9EanjYqu9PGB6P057G', 703576),
(3, 'chloe2312', '$2y$10$8yOncbQl1CEUS2znnClREeNREzP0A5QXdo7N1ZkP6t7JB0oj/YftW', 0),
(4, 'user', '$2y$10$WFXjvR/tg/xQF.lU0LwIwugt/7Q9zDXwAsJrwMDShnRc1eRt..RXi', 345181);

-- --------------------------------------------------------

--
-- Table structure for table `co2appliances`
--

CREATE TABLE `co2appliances` (
  `Appliance_ID` int(11) NOT NULL,
  `Appliance_Name` varchar(32) NOT NULL,
  `Appliance_CO2` int(11) NOT NULL,
  `Appliance_CO2_Desc` varchar(128) NOT NULL,
  `Appliance_CO2_Avg` int(11) NOT NULL,
  `Eco_Mode1` tinyint(1) NOT NULL,
  `Eco_Mode1_Desc` varchar(128) NOT NULL,
  `Eco_Mode2` tinyint(1) NOT NULL,
  `Eco_Mode2_Desc` varchar(128) NOT NULL,
  `API_Normal` varchar(64) NOT NULL,
  `API_Eco1` varchar(64) NOT NULL,
  `API_Eco2` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `co2appliances`
--

INSERT INTO `co2appliances` (`Appliance_ID`, `Appliance_Name`, `Appliance_CO2`, `Appliance_CO2_Desc`, `Appliance_CO2_Avg`, `Eco_Mode1`, `Eco_Mode1_Desc`, `Eco_Mode2`, `Eco_Mode2_Desc`, `API_Normal`, `API_Eco1`, `API_Eco2`) VALUES
(1, 'Kettle', 25, 'Enter number of cups boiled', 75, 0, '', 0, '', '', '', ''),
(2, 'Dishwasher', 0, 'Enter number of cycles', 0, 1, 'Eco Mode?', 0, '', 'YZ6P6QDPNRJU', '6PE9DHZX016X', ''),
(3, 'Washer/Dryer', 0, 'Enter number of cycles (A wash AND dry is one cycle)', 0, 1, 'Dry Only?', 1, 'Washing Line?', 'ORX85X16S22D', 'GNX8B1EX6IA3', 'XHO89UI59VT4');

-- --------------------------------------------------------

--
-- Table structure for table `co2modules`
--

CREATE TABLE `co2modules` (
  `Module_ID` int(11) NOT NULL,
  `Module_Name` varchar(32) NOT NULL,
  `Module_File` varchar(32) NOT NULL,
  `JSON_Name` varchar(64) NOT NULL,
  `API_URL` varchar(256) NOT NULL,
  `username:password` varchar(64) NOT NULL,
  `contentType` varchar(128) NOT NULL,
  `Get` tinyint(1) NOT NULL,
  `Query1` varchar(64) NOT NULL,
  `Param1` varchar(64) NOT NULL,
  `Query2` varchar(64) NOT NULL,
  `Param2` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `co2modules`
--

INSERT INTO `co2modules` (`Module_ID`, `Module_Name`, `Module_File`, `JSON_Name`, `API_URL`, `username:password`, `contentType`, `Get`, `Query1`, `Param1`, `Query2`, `Param2`) VALUES
(2, 'Appliances', 'appliance.php', 'Appliance_JSON', 'https://api.carbonkit.net/3.6/categories/Kitchen_generic/items;values?kWhPerYear=0&resultStart=0&resultLimit=50', 'v8s60:BasicAPIPassword1', 'Accept: application/json', 0, '', '', '', ''),
(3, 'Social', 'social.php', 'socialJSON', 'https://my-json-server.typicode.com/jholford/CO2DBJSON/db', '', '', 1, '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `co2accounts`
--
ALTER TABLE `co2accounts`
  ADD PRIMARY KEY (`Account_ID`);

--
-- Indexes for table `co2appliances`
--
ALTER TABLE `co2appliances`
  ADD PRIMARY KEY (`Appliance_ID`);

--
-- Indexes for table `co2modules`
--
ALTER TABLE `co2modules`
  ADD PRIMARY KEY (`Module_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `co2accounts`
--
ALTER TABLE `co2accounts`
  MODIFY `Account_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `co2appliances`
--
ALTER TABLE `co2appliances`
  MODIFY `Appliance_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `co2modules`
--
ALTER TABLE `co2modules`
  MODIFY `Module_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
