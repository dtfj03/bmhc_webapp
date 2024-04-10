-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 12:22 AM
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
-- Database: `group17`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

CREATE TABLE `admintbl` (
  `username` varchar(10) NOT NULL,
  `admFname` varchar(50) NOT NULL,
  `admLname` varchar(50) NOT NULL,
  `admBdate` date NOT NULL,
  `admAddress` text NOT NULL,
  `admContact` varchar(11) NOT NULL,
  `admPassword` varchar(20) NOT NULL,
  `adminID` int(11) NOT NULL,
  `admRole` varchar(20) NOT NULL,
  `admPhoto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`username`, `admFname`, `admLname`, `admBdate`, `admAddress`, `admContact`, `admPassword`, `adminID`, `admRole`, `admPhoto`) VALUES
('d.filasol', 'Dante', 'Filasol', '2003-11-22', 'Purok Calera, Brgy. Miranda, Pontevedra, Negros Occidental', '09398835963', 'tumayan03', 1, 'Moderator', 'd.filasol.jpg'),
('jk.dilag', 'Jan Kevin', 'Dilag', '2001-01-20', 'Bacolod City', '09685512149', '123', 2, 'Moderator', 'jk.dilag.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `announcementtbl`
--

CREATE TABLE `announcementtbl` (
  `announcementID` int(11) NOT NULL,
  `announcementTitle` varchar(50) NOT NULL,
  `announcementNote` text NOT NULL,
  `announcementDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcementtbl`
--

INSERT INTO `announcementtbl` (`announcementID`, `announcementTitle`, `announcementNote`, `announcementDate`) VALUES
(44, 'lorem ipsum', 'wala lang', '2024-03-05'),
(45, 'sopsop posonegro', '@dilag\'s residence', '2024-03-06'),
(48, 'hello', 'world', '2024-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `appointmenttbl`
--

CREATE TABLE `appointmenttbl` (
  `appointmentID` int(11) NOT NULL,
  `patientID` int(10) NOT NULL,
  `serviceType` varchar(30) NOT NULL,
  `dateOfVisit` date NOT NULL,
  `appointmentNote` text DEFAULT NULL,
  `appointmentStatus` varchar(10) NOT NULL DEFAULT 'PENDING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointmenttbl`
--

INSERT INTO `appointmenttbl` (`appointmentID`, `patientID`, `serviceType`, `dateOfVisit`, `appointmentNote`, `appointmentStatus`) VALUES
(25, 4, 'Despensing of Medicine', '2024-03-26', '', 'CONFIRMED'),
(26, 6, 'Immunization', '2024-03-22', 'no comment', 'PENDING'),
(27, 8, 'Family Planning Counseling', '2024-03-18', 'no comment', 'PENDING'),
(28, 10, 'Family Planning Counseling', '2024-03-08', 'help', 'PENDING'),
(29, 1, 'Family Planning Counseling', '2024-03-21', 'pls help me', 'PENDING');

-- --------------------------------------------------------

--
-- Table structure for table `eventtbl`
--

CREATE TABLE `eventtbl` (
  `eventID` int(11) NOT NULL,
  `eventTitle` varchar(50) NOT NULL,
  `eventDate` date NOT NULL,
  `eventTime` varchar(20) NOT NULL,
  `eventLocation` text NOT NULL,
  `eventNote` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventtbl`
--

INSERT INTO `eventtbl` (`eventID`, `eventTitle`, `eventDate`, `eventTime`, `eventLocation`, `eventNote`) VALUES
(1, 'BLOOD LETTING ACTIVITY', '2024-02-29', '9:00AM - 4:00PM', 'Pontevedra Gymnasiumuih', 'prepare yourself hehehehe'),
(10, 'Schedule for Medical Drive', '2024-02-29', '6:00AM - 1:00PM', 'Pontevera Multi-purpose Hall', '* with Brgy. Captain'),
(13, 'MIDTERM EXAM', '2024-03-18', 'N/A', 'USLS', ''),
(15, 'no comment sched', '2024-03-30', '7:00am', 'TBA', ''),
(16, 'MIDTERM PRESENTATION', '2024-03-11', '9AM', 'CSL8', 'group17');

-- --------------------------------------------------------

--
-- Table structure for table `patienttbl`
--

CREATE TABLE `patienttbl` (
  `patientID` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `patientSex` varchar(10) NOT NULL,
  `birthDate` date NOT NULL,
  `addressPurok` varchar(50) NOT NULL,
  `placeOfBirth` text NOT NULL,
  `pobCity` varchar(50) NOT NULL,
  `pobProv` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patienttbl`
--

INSERT INTO `patienttbl` (`patientID`, `firstName`, `middleName`, `lastName`, `patientSex`, `birthDate`, `addressPurok`, `placeOfBirth`, `pobCity`, `pobProv`) VALUES
(1, 'John Florence', 'Solina', 'Villafranca', 'Male', '2001-06-19', 'Purok Biante Village', 'Dr. Pablo O. Torre Memorial Hospital', 'Bacolod City', 'Negros Occidental'),
(2, 'Kenneth', 'Dimailig', 'De Vera', 'Male', '2003-11-22', 'Purok Carmen', 'Bacolod Adventist Medical Center', 'Bacolod City', 'Negros Occidental'),
(3, 'Joel Ian', 'Franco', 'Deza', 'Male', '2003-12-19', 'Purok Crotons', 'Bacolod Adventist Medical Center', 'Bacolod City', 'Negros Occidental'),
(4, 'Jan Kevin', 'Aspan', 'Dilag', 'Male', '2001-01-20', 'Purok Biante Village', 'Valladolid District Hospital', 'Valladolid', 'Negros Occidental'),
(5, 'Sean Emmanuel', '', 'Bonda', 'Male', '2003-12-25', 'Purok Calera', 'Valladolid District Hospital', 'Valladolid', 'Negros Occidental'),
(6, 'Dante', 'Tumayan', 'Filasol', 'Male', '2003-11-22', 'Purok Calera', 'Valladolid District Hospital', 'Valladolid', 'Negros Occidental'),
(7, 'Sakura', 'Batumbakal', 'Miyawaki', 'Female', '1998-03-19', 'Purok Imnida', 'Japan 3rd floor', 'Kagoshima', 'Japan'),
(8, 'Toni', 'Marie', 'Fowler', 'Female', '1993-07-22', 'Purok Torofam', 'Manila Hospital', 'Manila', 'Manila'),
(9, 'Krister Von', 'Saludares', 'Getino', 'Male', '2003-03-23', 'Purok Lamperong', 'AMOSUP Seamen\'s Hospital Manila', 'Manila', 'Metro Manila'),
(10, 'Enzu', 'Ballenas', 'Yocariza', 'Male', '2003-04-07', 'Purok Tres', 'Manila Hospital', 'La Carlota', 'Negros Occidental'),
(11, 'Janagap', 'D', 'Dairin', 'Female', '2008-10-30', 'Purok la salle', 'Bacolod Hospital', 'Bacolod City', 'Negros Occidental'),
(12, 'Daniella Mae', 'Tumayan', 'Filasol', 'Female', '2006-09-14', 'Purok Calera', 'Bacolod Queen of Mercy Hospital', 'Bacolod City', 'Negros Occidental');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admintbl`
--
ALTER TABLE `admintbl`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `announcementtbl`
--
ALTER TABLE `announcementtbl`
  ADD PRIMARY KEY (`announcementID`);

--
-- Indexes for table `appointmenttbl`
--
ALTER TABLE `appointmenttbl`
  ADD PRIMARY KEY (`appointmentID`),
  ADD KEY `patientID` (`patientID`);

--
-- Indexes for table `eventtbl`
--
ALTER TABLE `eventtbl`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `patienttbl`
--
ALTER TABLE `patienttbl`
  ADD PRIMARY KEY (`patientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admintbl`
--
ALTER TABLE `admintbl`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcementtbl`
--
ALTER TABLE `announcementtbl`
  MODIFY `announcementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `appointmenttbl`
--
ALTER TABLE `appointmenttbl`
  MODIFY `appointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `eventtbl`
--
ALTER TABLE `eventtbl`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `patienttbl`
--
ALTER TABLE `patienttbl`
  MODIFY `patientID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointmenttbl`
--
ALTER TABLE `appointmenttbl`
  ADD CONSTRAINT `appointmenttbl_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patienttbl` (`patientID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
