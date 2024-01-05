-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2024 at 12:11 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tables`
--

-- --------------------------------------------------------

--
-- Table structure for table `Buses`
--

CREATE TABLE `Buses` (
  `Bus_Id` int NOT NULL,
  `Bus_no` varchar(100) NOT NULL,
  `Total_seats` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Buses`
--

INSERT INTO `Buses` (`Bus_Id`, `Bus_no`, `Total_seats`) VALUES
(1, 'HP66A2207', '44'),
(2, 'HP68A2598', '49'),
(3, 'HP36A6547', '33');

-- --------------------------------------------------------

--
-- Table structure for table `busSeats`
--

CREATE TABLE `busSeats` (
  `seat_id` int NOT NULL,
  `seat_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Bus_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `busSeats`
--

INSERT INTO `busSeats` (`seat_id`, `seat_number`, `Bus_id`) VALUES
(1, 'A1', 1),
(2, 'A2', 1),
(3, 'B1', 2),
(4, 'B2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Bus_route`
--

CREATE TABLE `Bus_route` (
  `Id` int NOT NULL,
  `Route_Id` int NOT NULL,
  `Bus_Id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Bus_route`
--

INSERT INTO `Bus_route` (`Id`, `Route_Id`, `Bus_Id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Routes`
--

CREATE TABLE `Routes` (
  `ID` int NOT NULL,
  `Leaving` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Going` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Routes`
--

INSERT INTO `Routes` (`ID`, `Leaving`, `Going`) VALUES
(1, 'Chandigarh', 'Rohru'),
(2, 'Delhi', 'Kangra'),
(3, 'Manali', 'Delhi'),
(4, 'Rohru\r\n', 'Dehradun');

-- --------------------------------------------------------

--
-- Table structure for table `Seat_booking`
--

CREATE TABLE `Seat_booking` (
  `Id` int NOT NULL,
  `s_id` int NOT NULL,
  `dates` date NOT NULL,
  `Bus_id` int NOT NULL,
  `Route_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Seat_booking`
--

INSERT INTO `Seat_booking` (`Id`, `s_id`, `dates`, `Bus_id`, `Route_id`) VALUES
(1, 1, '2024-01-11', 1, 1),
(2, 2, '2024-01-11', 1, 1),
(3, 1, '2024-01-11', 1, 1),
(4, 2, '2024-01-11', 1, 1),
(5, 1, '2024-01-11', 1, 1),
(6, 3, '2024-01-11', 1, 1),
(7, 4, '2024-01-11', 1, 1),
(8, 3, '2024-06-19', 2, 2),
(9, 1, '2024-06-19', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_reg`
--

CREATE TABLE `user_reg` (
  `Id` int NOT NULL,
  `Username` varchar(50) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_reg`
--

INSERT INTO `user_reg` (`Id`, `Username`, `PhoneNumber`, `Email`, `Password`) VALUES
(1, 'Raman dhiman', '8847236607', 'ramandhiman@gmail.com', '$2y$10$COXR38PHcdcsk.RFdmbrN.x.fGAO5H9uN1diRsJXTss1gY17beBFa'),
(2, 'Tushar123', '7986342653', 'tushar123@gmail.com', '$2y$10$zHxh/y6Ad82iGTtvi8JaMOfQBqJBtq9bhQDQAwRVd6iJbQjmAXYfi'),
(3, 'Sahil123', '7740023582', 'sahil123@gmail.com', '$2y$10$ZPLMf7HnAMl6IwKCX2otde9pfBDaF3Ae3dz6nHX9yq0t7Q4T7yoRy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Buses`
--
ALTER TABLE `Buses`
  ADD PRIMARY KEY (`Bus_Id`);

--
-- Indexes for table `busSeats`
--
ALTER TABLE `busSeats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY ` Bus_IdFK` (`Bus_id`);

--
-- Indexes for table `Bus_route`
--
ALTER TABLE `Bus_route`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Route_IdFK` (`Route_Id`),
  ADD KEY `buses_IdFK` (`Bus_Id`);

--
-- Indexes for table `Routes`
--
ALTER TABLE `Routes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Seat_booking`
--
ALTER TABLE `Seat_booking`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `seat_Id FK` (`s_id`),
  ADD KEY `bus_id FK` (`Bus_id`),
  ADD KEY `Route_id` (`Route_id`);

--
-- Indexes for table `user_reg`
--
ALTER TABLE `user_reg`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Buses`
--
ALTER TABLE `Buses`
  MODIFY `Bus_Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `busSeats`
--
ALTER TABLE `busSeats`
  MODIFY `seat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Bus_route`
--
ALTER TABLE `Bus_route`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Routes`
--
ALTER TABLE `Routes`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Seat_booking`
--
ALTER TABLE `Seat_booking`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_reg`
--
ALTER TABLE `user_reg`
  MODIFY `Id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `busSeats`
--
ALTER TABLE `busSeats`
  ADD CONSTRAINT ` Bus_IdFK` FOREIGN KEY (`Bus_id`) REFERENCES `Buses` (`Bus_Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Bus_route`
--
ALTER TABLE `Bus_route`
  ADD CONSTRAINT `buses_IdFK` FOREIGN KEY (`Bus_Id`) REFERENCES `Buses` (`Bus_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Route_IdFK` FOREIGN KEY (`Route_Id`) REFERENCES `Routes` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Seat_booking`
--
ALTER TABLE `Seat_booking`
  ADD CONSTRAINT `bus_id FK` FOREIGN KEY (`Bus_id`) REFERENCES `Buses` (`Bus_Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Route_id` FOREIGN KEY (`Route_id`) REFERENCES `Routes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `seat_Id FK` FOREIGN KEY (`s_id`) REFERENCES `busSeats` (`seat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
