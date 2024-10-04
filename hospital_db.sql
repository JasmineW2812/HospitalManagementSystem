-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 12:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `day_of_week` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `appointment_status` text DEFAULT NULL,
  `during_appointment` text NOT NULL,
  `check_in_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `staff_id`, `day_of_week`, `start_time`, `end_time`, `appointment_status`, `during_appointment`, `check_in_status`) VALUES
(7, 1, '2024-05-02', '10:00:00', '11:00:00', 'booked', '123', 'Checked in'),
(8, 1, '2024-05-03', '10:00:00', '11:00:00', 'booked', '', 'Checked in'),
(9, 1, '2024-05-04', '10:00:00', '11:00:00', 'booked', 'guh', 'Checked in'),
(10, 1, '2024-05-05', '10:00:00', '11:00:00', NULL, '', ''),
(11, 1, '2024-05-06', '10:00:00', '11:00:00', NULL, '', ''),
(12, 1, '2024-05-09', '10:00:00', '11:00:00', NULL, '', ''),
(13, 4, '2024-05-08', '10:00:00', '11:00:00', NULL, '', ''),
(14, 1, '2024-05-04', '10:00:00', '11:00:00', NULL, '', ''),
(15, 1, '2024-05-04', '10:00:00', '11:00:00', NULL, '', ''),
(18, 4, '2024-05-08', '12:00:00', '13:00:00', NULL, '', ''),
(22, 1, '2024-05-04', '17:00:00', '18:00:00', NULL, '', ''),
(23, 1, '2024-05-04', '15:00:00', '16:00:00', NULL, '', ''),
(24, 1, '2024-05-04', '10:00:00', '11:00:00', NULL, '', ''),
(25, 1, '2024-05-04', '10:00:00', '11:00:00', NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_request`
--

CREATE TABLE `appointment_request` (
  `appointment_request_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `subject` varchar(20) NOT NULL,
  `about_appointment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_request`
--

INSERT INTO `appointment_request` (`appointment_request_id`, `patient_id`, `appointment_id`, `subject`, `about_appointment`) VALUES
(72, 1, 7, '1293', 'ook'),
(73, 1, 9, 'i', '9u9'),
(74, 1, NULL, 'de', 'q'),
(78, 1, NULL, 'd', ';'),
(79, 4, NULL, 'Headache', 'test'),
(80, 1, NULL, 'hello', '123');

-- --------------------------------------------------------

--
-- Table structure for table `health_condition`
--

CREATE TABLE `health_condition` (
  `health_condition_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `diagnosis` text NOT NULL,
  `date_started` date NOT NULL,
  `date_ended` date NOT NULL,
  `ongoing` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `health_condition`
--

INSERT INTO `health_condition` (`health_condition_id`, `patient_id`, `appointment_id`, `diagnosis`, `date_started`, `date_ended`, `ongoing`) VALUES
(2, 1, 9, 'Common Cold', '0000-00-00', '0000-00-00', 0),
(3, 1, 9, 'Acid Reflux', '0000-00-00', '0000-00-00', 0),
(4, 1, 9, 'Allergic Rhinitis', '2024-04-19', '0000-00-00', 0),
(5, 1, 7, '123', '2024-05-03', '0000-00-00', 0),
(6, 1, 7, '', '0000-00-00', '0000-00-00', 0),
(7, 1, 7, '', '0000-00-00', '0000-00-00', 0),
(8, 1, 7, 'TEST', '2024-05-03', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `surname` text NOT NULL,
  `dob` date NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `street_address` text NOT NULL,
  `city` text NOT NULL,
  `postcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `first_name`, `surname`, `dob`, `email`, `password`, `street_address`, `city`, `postcode`) VALUES
(1, 'John', 'Smith', '1998-01-17', 'myemail@gmail.com', '123', '26 Lake', 'Manchester', 'S2 4'),
(2, 'Jane', 'Waller', '1998-01-17', 'jane@gmail.com', '123', '26 Lake', 'Sheffield', 'S2 4'),
(3, '', 'Smith', '1995-07-02', 'PeterSmith@gmail.com', '123456789', '26 LakeSide', 'Manchester', 'S2 4LL'),
(4, '', 'Middleton', '1979-06-02', 'Dan@gmail.com', '123456789', '26 Foxwood', 'Oxford', 'OX27 5ED');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `role` text NOT NULL,
  `first_name` text NOT NULL,
  `surname` text NOT NULL,
  `dob` date NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `training_certification_end_date` date NOT NULL,
  `salary` int(11) NOT NULL,
  `street_address` text NOT NULL,
  `city` text NOT NULL,
  `postcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `role`, `first_name`, `surname`, `dob`, `email`, `password`, `training_certification_end_date`, `salary`, `street_address`, `city`, `postcode`) VALUES
(1, 'Doctor', 'James', 'Evans', '1977-05-06', 'J@gmail.com', '123', '2024-04-17', 35000, '1233', 'hrtgef', 'l'),
(2, 'Receptionist', 'Peter', 'Johnson', '1994-01-12', 'P@gmail.com', '123', '2024-04-17', 12000, '', '', ''),
(3, 'Hospital Official', 'Phillipa', 'Armitage', '1988-01-15', 'Pip@gmail.com', '123', '2024-03-05', 60000, '', '', ''),
(4, 'Doctor', 'Darren', 'Lee', '1977-05-06', 'DL@gmail.com', '123', '2024-04-17', 35000, 'l', ';', 'l');

-- --------------------------------------------------------

--
-- Table structure for table `test_result`
--

CREATE TABLE `test_result` (
  `test_result_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `result` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_result`
--

INSERT INTO `test_result` (`test_result_id`, `appointment_id`, `name`, `result`) VALUES
(1, 7, 'test', 'te'),
(2, 7, 'test', 'te');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatment_id` int(11) NOT NULL,
  `health_condition_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `treatment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatment_id`, `health_condition_id`, `type`, `treatment`) VALUES
(1, 2, '', 'ibuprofen '),
(2, 3, '', 'omeprazole'),
(3, 4, '', 'cetirizine'),
(4, 3, '', 'Tums '),
(6, 4, '', 'cetirizine'),
(7, 4, '', 'cetirizine'),
(8, 5, '', ''),
(9, 6, '', ''),
(10, 7, '', ''),
(11, 8, '', 'Rest');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `appointment_request`
--
ALTER TABLE `appointment_request`
  ADD PRIMARY KEY (`appointment_request_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `health_condition`
--
ALTER TABLE `health_condition`
  ADD PRIMARY KEY (`health_condition_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `test_result`
--
ALTER TABLE `test_result`
  ADD PRIMARY KEY (`test_result_id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatment_id`),
  ADD KEY `health_condition_id` (`health_condition_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `appointment_request`
--
ALTER TABLE `appointment_request`
  MODIFY `appointment_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `health_condition`
--
ALTER TABLE `health_condition`
  MODIFY `health_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `test_result`
--
ALTER TABLE `test_result`
  MODIFY `test_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `treatment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `appointment_request`
--
ALTER TABLE `appointment_request`
  ADD CONSTRAINT `appointment_request_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`),
  ADD CONSTRAINT `appointment_request_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`);

--
-- Constraints for table `health_condition`
--
ALTER TABLE `health_condition`
  ADD CONSTRAINT `health_condition_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `health_condition_ibfk_2` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`);

--
-- Constraints for table `test_result`
--
ALTER TABLE `test_result`
  ADD CONSTRAINT `test_result_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`appointment_id`);

--
-- Constraints for table `treatment`
--
ALTER TABLE `treatment`
  ADD CONSTRAINT `treatment_ibfk_1` FOREIGN KEY (`health_condition_id`) REFERENCES `health_condition` (`health_condition_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
