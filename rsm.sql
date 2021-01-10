-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 01:08 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Name` varchar(25) NOT NULL,
  `Id` varchar(15) NOT NULL,
  `Image` varchar(50) NOT NULL,
  `Price` mediumint(10) NOT NULL,
  `Description` varchar(25) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Name`, `Id`, `Image`, `Price`, `Description`, `Status`) VALUES
('Tiger Raw Rice', '17031609681743', 'uploads/17031609681743.jpg', 800, 'Tiger Raw 25 KG Rice Bag', 1),
('Nescafe', '20811609681830', 'uploads/20811609681830.png', 285, 'Nescafe 100G Coffee Powde', 1),
('Sugar', '23921609682010', 'uploads/23921609682010.jfif', 78, '1KG Sugar', 1),
('Tumeric Powder', '31511610193749', 'uploads/31511610193749.jpg', 68, '500G Vijay Tumeric Powder', 1),
('Dairy Milk', '4401609681509', 'uploads/4401609681509.jpg', 75, 'Dairy Milk Silk Choclate', 1),
('KIt Kat', '45001610020082', 'uploads/45001610020082.jfif', 25, '25RS Kit Kat Choclate', 0),
('Red Label', '4801609681946', 'uploads/4801609681946.jfif', 100, '500G Red Label Tea Powder', 1),
('Toor Dal', '4961609681690', 'uploads/4961609681690.jfif', 95, '1 KG Tata Toor Daal', 1),
('Aashirwad Chilli Powder', '7641610193664', 'uploads/7641610193664.jfif', 90, '500G Asirwad Chilli Powde', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Id` varchar(20) NOT NULL,
  `UId` varchar(20) NOT NULL,
  `Items` longtext NOT NULL,
  `Date` date NOT NULL,
  `Packing` tinyint(1) NOT NULL,
  `Payment` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Id`, `UId`, `Items`, `Date`, `Packing`, `Payment`) VALUES
('20991610020441', '45211609831534', 'a:2:{i:0;a:4:{s:4:\"Name\";s:10:\"Dairy Milk\";s:5:\"Price\";s:2:\"75\";s:11:\"Description\";s:24:\"Dairy Milk Silk Choclate\";s:8:\"Quantity\";i:2;}i:1;a:4:{s:4:\"Name\";s:7:\"Nescafe\";s:5:\"Price\";s:3:\"285\";s:11:\"Description\";s:25:\"Nescafe 100G Coffee Powde\";s:8:\"Quantity\";i:1;}}', '2021-01-07', 1, 0),
('29251610194010', '45211609831534', 'a:7:{i:0;a:4:{s:4:\"Name\";s:10:\"Dairy Milk\";s:5:\"Price\";s:2:\"75\";s:11:\"Description\";s:24:\"Dairy Milk Silk Choclate\";s:8:\"Quantity\";i:3;}i:1;a:4:{s:4:\"Name\";s:23:\"Aashirwad Chilli Powder\";s:5:\"Price\";s:2:\"90\";s:11:\"Description\";s:25:\"500G Asirwad Chilli Powde\";s:8:\"Quantity\";i:1;}i:2;a:4:{s:4:\"Name\";s:7:\"Nescafe\";s:5:\"Price\";s:3:\"285\";s:11:\"Description\";s:25:\"Nescafe 100G Coffee Powde\";s:8:\"Quantity\";i:1;}i:3;a:4:{s:4:\"Name\";s:9:\"Red Label\";s:5:\"Price\";s:3:\"100\";s:11:\"Description\";s:25:\"500G Red Label Tea Powder\";s:8:\"Quantity\";i:1;}i:4;a:4:{s:4:\"Name\";s:14:\"Tumeric Powder\";s:5:\"Price\";s:2:\"68\";s:11:\"Description\";s:25:\"500G Vijay Tumeric Powder\";s:8:\"Quantity\";i:1;}i:5;a:4:{s:4:\"Name\";s:14:\"Tiger Raw Rice\";s:5:\"Price\";s:3:\"800\";s:11:\"Description\";s:24:\"Tiger Raw 25 KG Rice Bag\";s:8:\"Quantity\";i:1;}i:6;a:4:{s:4:\"Name\";s:5:\"Sugar\";s:5:\"Price\";s:2:\"78\";s:11:\"Description\";s:9:\"1KG Sugar\";s:8:\"Quantity\";i:1;}}', '2021-01-09', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `Name` varchar(20) NOT NULL,
  `Phone` bigint(10) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`Name`, `Phone`, `Address`, `Username`, `Password`) VALUES
('Disha Kotari', 9741627227, 'Main Road Near Main Bus Stand Udupi', 'dishakotari', 'dishakotari');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(30) NOT NULL,
  `Id` varchar(20) NOT NULL,
  `Phone` mediumint(11) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Id`, `Phone`, `Address`, `Username`, `Password`) VALUES
('Mahendra Singh Dhoni', '26761610192866', 8388607, 'Main Road near Krishna Maat Udupi', 'msdhoni', 'msdhoni'),
('Nidhi Hegde', '45211609831534', 8388607, 'Near Malpe Police Station Malpe', 'nidhihegde', 'nidhihegde');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
