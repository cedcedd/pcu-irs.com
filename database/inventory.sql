-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 04:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` varchar(15) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `status`) VALUES
('cat-144135', 'Hardware', 'active'),
('cat-639086', 'Cabinet', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` varchar(15) NOT NULL,
  `departmentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `departmentName`) VALUES
('cus-1', 'Customer'),
('dept-1', 'General Services Office (GSO)'),
('dept-2', 'ICTO'),
('dept-3', 'Registrar'),
('head-1', 'Head Department');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` varchar(15) NOT NULL,
  `categoryID` varchar(15) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productQuantity` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `expirationDate` date NOT NULL,
  `price` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `productQuantity`, `unit`, `expirationDate`, `price`, `status`) VALUES
('prod-105535', 'cat-144135', 'HDD', '0', '10 Units', '2023-06-17', '2000', 'active'),
('prod-178904', 'cat-144135', 'Wireless Mouse', '0', '5 Units', '2023-06-17', '15000', 'active'),
('prod-872668', 'cat-639086', 'Filing Cabinet', '0', '2 units', '2023-06-17', '1,400', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `productrequest`
--

CREATE TABLE `productrequest` (
  `requestID` varchar(15) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `departmentID` varchar(15) NOT NULL,
  `categoryID` varchar(15) NOT NULL,
  `productID` varchar(15) NOT NULL,
  `requestDate` date NOT NULL,
  `requestQuantity` varchar(20) NOT NULL,
  `requestStatus` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `productrequestviews`
-- (See below for the actual view)
--
CREATE TABLE `productrequestviews` (
`requestID` varchar(15)
,`name` varchar(50)
,`departmentID` varchar(15)
,`departmentName` varchar(50)
,`categoryName` varchar(50)
,`productID` varchar(15)
,`productName` varchar(50)
,`requestDate` date
,`requestQuantity` varchar(20)
,`requestStatus` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `productviews`
-- (See below for the actual view)
--
CREATE TABLE `productviews` (
`productID` varchar(15)
,`productName` varchar(50)
,`productQuantity` varchar(50)
,`unit` varchar(50)
,`expirationDate` date
,`price` varchar(50)
,`categoryID` varchar(15)
,`categoryName` varchar(50)
,`status` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorder`
--

CREATE TABLE `purchaseorder` (
  `orderID` varchar(15) NOT NULL,
  `companyID` varchar(15) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `productID` varchar(15) NOT NULL,
  `orderDate` date NOT NULL,
  `expect_date` date NOT NULL,
  `orderQuantity` varchar(50) NOT NULL,
  `orderUnitCost` varchar(50) NOT NULL,
  `orderStatus` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `purchaseorderviews`
-- (See below for the actual view)
--
CREATE TABLE `purchaseorderviews` (
`orderID` varchar(15)
,`companyID` varchar(15)
,`companyName` varchar(100)
,`name` varchar(50)
,`productID` varchar(15)
,`productName` varchar(50)
,`orderDate` date
,`expect_date` date
,`orderQuantity` varchar(50)
,`orderUnitCost` varchar(50)
,`orderStatus` varchar(50)
,`status` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `reservationvehicle`
--

CREATE TABLE `reservationvehicle` (
  `reservationVehicleID` varchar(15) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `departmentID` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `vehicleID` varchar(15) NOT NULL,
  `nameOfActivity` varchar(100) NOT NULL,
  `numberOfPassenger` varchar(50) NOT NULL,
  `resDate` date NOT NULL,
  `pickUp` datetime(6) NOT NULL,
  `returnDate` datetime(6) NOT NULL,
  `reservationStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservationvehicle`
--

INSERT INTO `reservationvehicle` (`reservationVehicleID`, `userID`, `departmentID`, `email`, `vehicleID`, `nameOfActivity`, `numberOfPassenger`, `resDate`, `pickUp`, `returnDate`, `reservationStatus`) VALUES
('resVehicle-1317', 'emp-1', 'dept-2', 'ramos@gmail.com', 'vehicle-3', 'Retreat', '10', '2023-06-17', '2023-06-24 01:13:00.000000', '2023-06-17 06:13:00.000000', 'Approved'),
('resVehicle-1376', 'emp-1', 'dept-2', 'ramos@gmail.com', 'vehicle-4', 'Retreat', '18', '2023-06-16', '2023-06-30 08:00:00.000000', '2023-06-30 17:00:00.000000', 'Pending');

-- --------------------------------------------------------

--
-- Stand-in structure for view `reservationvehicleviews`
-- (See below for the actual view)
--
CREATE TABLE `reservationvehicleviews` (
`reservationVehicleID` varchar(15)
,`userID` varchar(15)
,`name` varchar(50)
,`email` varchar(50)
,`contact_no` varchar(15)
,`address` varchar(50)
,`departmentID` varchar(15)
,`departmentName` varchar(50)
,`nameOfActivity` varchar(100)
,`vehicleName` varchar(100)
,`numberOfSeaters` varchar(25)
,`numberOfPassenger` varchar(50)
,`resDate` date
,`pickUp` datetime(6)
,`returnDate` datetime(6)
,`reservationStatus` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `reservationvenue`
--

CREATE TABLE `reservationvenue` (
  `reservationID` varchar(15) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `departmentID` varchar(50) NOT NULL,
  `venueID` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nameOfActivity` varchar(100) NOT NULL,
  `numberOfGuests` varchar(25) NOT NULL,
  `reserveDate` date NOT NULL,
  `checkIn` datetime(6) NOT NULL,
  `checkOut` datetime(6) NOT NULL,
  `reservationStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservationvenue`
--

INSERT INTO `reservationvenue` (`reservationID`, `userID`, `departmentID`, `venueID`, `email`, `nameOfActivity`, `numberOfGuests`, `reserveDate`, `checkIn`, `checkOut`, `reservationStatus`) VALUES
('resven-1110', 'user-9302448', 'dept-3', 'venue-2', 'roi@gmail.com', 'Meeting', '26', '2023-05-14', '2023-05-23 17:07:00.000000', '2023-05-26 17:07:00.000000', 'Declined'),
('resven-1684', 'emp-1', 'dept-2', 'venue-1', 'ryanmdreyes@yahoo.com', 'Meeting', '23', '2023-05-14', '2023-06-02 22:29:00.000000', '2023-05-23 21:28:00.000000', 'Declined'),
('resven-1827', 'user-1665367', 'cus-1', 'venue-1', 'jerjer@gmail.com', 'Health Seminar', '80', '2023-06-05', '2023-06-30 15:30:00.000000', '2023-06-30 18:00:00.000000', 'Approved'),
('resven-1833', 'user-1', 'cus-1', 'venue-2', 'ronaldo@gmail.com', 'Assembly', '50', '2023-05-24', '2023-05-28 13:30:00.000000', '2023-05-28 15:00:00.000000', 'Approved'),
('resven-6919', 'emp-1', 'dept-2', 'venue-4', 'ramos@gmail.com', 'Intramurals', '80', '2023-05-24', '2023-05-23 00:54:00.000000', '2023-05-25 00:54:00.000000', 'Pending'),
('resven-9292', 'user-1', 'cus-1', 'venue-2', 'ronaldo@gmail.com', 'General Assembly', '50', '2023-06-05', '2023-06-20 12:00:00.000000', '2023-06-20 15:00:00.000000', 'Approved'),
('resven-9833', 'emp-1', 'dept-2', 'venue-1', 'ranilodelosreyes@yahoo.com', 'Meeting', '23', '2023-05-14', '2023-05-18 16:49:00.000000', '2023-05-18 19:48:00.000000', 'Pending'),
('resven-9932', 'user-1780370', 'cus-1', 'venue-1', 'ryanmdreyes@yahoo.com', 'Meeting', '23', '2023-05-14', '2023-05-19 20:28:00.000000', '2023-06-02 21:28:00.000000', 'Approved');

-- --------------------------------------------------------

--
-- Stand-in structure for view `reservationvenueviews`
-- (See below for the actual view)
--
CREATE TABLE `reservationvenueviews` (
`reservationID` varchar(15)
,`userID` varchar(15)
,`name` varchar(50)
,`departmentID` varchar(15)
,`departmentName` varchar(50)
,`email` varchar(50)
,`contact_no` varchar(15)
,`address` varchar(50)
,`venueName` varchar(100)
,`nameOfActivity` varchar(100)
,`numberOfGuests` varchar(25)
,`reserveDate` date
,`checkIn` datetime(6)
,`checkOut` datetime(6)
,`reservationStatus` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(11) NOT NULL,
  `userID` varchar(15) NOT NULL,
  `departmentID` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contactnum` int(11) NOT NULL,
  `address` varchar(250) NOT NULL,
  `venue` varchar(100) NOT NULL,
  `nog` int(100) NOT NULL,
  `noa` varchar(250) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `schedStatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `userID`, `departmentID`, `name`, `email`, `contactnum`, `address`, `venue`, `nog`, `noa`, `start_datetime`, `end_datetime`, `schedStatus`) VALUES
(28, 'emp-1', 'dept-2', 'ramos', 'ramos@gmail.com', 23, '3214 pasay', 'Multi-purpose Hall', 23, 'Meeting', '2023-06-16 10:00:00', '2023-06-16 14:00:00', 'Pending'),
(29, 'user-1', 'cus-1', 'ronaldo', 'ronaldo@gmail.com', 2147483647, 'Innocencio St. Pasay City', 'Ground Floor Auditorium', 50, 'Seminar', '2023-06-19 08:00:00', '2023-06-19 10:00:00', 'Pending'),
(30, 'emp-1', 'dept-2', 'ramos', 'ramos@gmail.com', 2147483647, 'Cavite City', 'University Gymnasium', 50, 'Intramurals', '2023-06-27 10:00:00', '2023-06-27 14:00:00', 'Approved'),
(31, 'emp-1', 'dept-2', 'ramos', 'ramos@gmail.com', 123, 'pasay city', 'Multi-purpose Hall', 23, 'Retreat', '2023-06-18 08:00:00', '2023-06-18 10:00:00', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `companyID` varchar(15) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `companyAddress` varchar(100) NOT NULL,
  `telephone_no` varchar(15) NOT NULL,
  `cellphone_no` varchar(15) NOT NULL,
  `contactPerson` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`companyID`, `companyName`, `companyAddress`, `telephone_no`, `cellphone_no`, `contactPerson`, `email`, `status`) VALUES
('company-10081', 'Nike', 'Bonifacio High Street', '123', '123', 'Kobe Bryant', 'nike@gmail.com', 'inactive'),
('company-16297', 'PWU', '4213 Taft ave', '28987979', '3242342', 'raul ivan', 'pwu@gmail.com', 'inactive'),
('company-17327', 'Nike Air', 'Pasay City', '53453534', '090489254', 'Lester', 'nike@gmail.com', 'inactive'),
('company-19145', 'Kahit ano', '4213 Taft ave', '213123', '123123', 'raul', 'kahitano@gmail.com', 'inactive'),
('company-49421', 'PCU', '4213 Taft ave', '0335545454', '09231232', 'fesfsfse', 'pcu@gmail.com', 'inactive'),
('company-54301', 'R Graphics & Prints', '1602-B Leon Guinto St. cor. Pedro Gil St. Malate Manila', '254-4696', '09285047915', 'John Doe', 'rgraphicsprints@gmail.com', 'active'),
('company-84304', 'National Bookstore', 'Ermita Manila', '888-878', '09123456789', 'Ramon Burog', 'nbookstore@gmail.com', 'inactive'),
('company-87254', 'Coziest', '4213 Taft ave', '25455844', '0365884848', 'Zed', 'coziest@gmail.com', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `access` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `departmentID` varchar(15) NOT NULL,
  `userStatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `name`, `email`, `contact_no`, `address`, `access`, `password`, `departmentID`, `userStatus`) VALUES
('admin1', 'test', 'test@gmail.com', '123', '123', 'administrator', '123', 'dept-1', 'active'),
('emp-1', 'ramos', 'ramos@gmail.com', '123', '123', 'department', '123', 'dept-2', 'active'),
('head-1', 'Department Head', 'head@gmail.com', '09545632541', '1024 taft ave.', 'head', '123', 'dept-1', 'inactive'),
('headDept-1', 'Head Department', 'headdept@gmail.com', '123', '134 taft ', 'head', '123', 'head-1', 'active'),
('user-1', 'ronaldo', 'ronaldo@gmail.com', '123', '123', 'customer', '123', 'cus-1', 'active'),
('user-1086271', 'admin', 'admin@gmail.com', '092565478', '432 pasay city', 'administrator', '123', 'dept-1', 'inactive'),
('user-1118647', 'Bryan', 'bryan@gmail.com', '2141254213', '3214 pasay', 'customer', '4321', 'cus-1', 'inactive'),
('user-1352055', 'joben', 'joben@gmail.com', '2141254213', '3214 pasay', 'department', '1234567', 'dept-2', 'inactive'),
('user-1482818', 'John Lester Adarling', 'johnlester@gmail.com', '09875463251', 'Imus City', 'customer', '123', 'cus-1', 'active'),
('user-1665367', 'Jerjer Collado', 'jerjer@gmail.com', '09123456789', 'Cavite City', 'customer', '1234', 'cus-1', 'inactive'),
('user-1780370', 'Roi Jayson', 'roi@gmail.com', '094546454', '3124 Sucat ', 'customer', '123', 'cus-1', 'inactive'),
('user-1987403', 'ced', 'ced@gmail.com', '019283019283', '321 cavite', 'customer', '123', 'cus-1', 'active'),
('user-5118907', 'John Doe', 'johndoe@gmail.com', '09951519302', 'Dasmarinas, Cavite City', 'department', '123', 'dept-1', 'inactive'),
('user-9302448', 'Roland', 'roland@gmail.com', '098854515455', '3214 pasay', 'department', '12345', 'dept-3', 'inactive');

-- --------------------------------------------------------

--
-- Stand-in structure for view `userviews`
-- (See below for the actual view)
--
CREATE TABLE `userviews` (
`userID` varchar(15)
,`name` varchar(50)
,`contact_no` varchar(15)
,`address` varchar(50)
,`email` varchar(50)
,`access` varchar(15)
,`password` varchar(50)
,`userStatus` varchar(15)
,`departmentID` varchar(15)
,`departmentName` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicleID` varchar(15) NOT NULL,
  `vehicleName` varchar(100) NOT NULL,
  `vehicle_no` varchar(25) NOT NULL,
  `numberOfSeaters` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicleID`, `vehicleName`, `vehicle_no`, `numberOfSeaters`) VALUES
('vehicle-1', 'Toyota Grandia', 'WYI 837', '6'),
('vehicle-2', 'Isuzu ', 'ZGK 639', '6'),
('vehicle-3', 'Hyundai Coaster', 'NFP 3653', '12'),
('vehicle-4', 'L-300', 'XMX 475', '20'),
('vehicle-5', 'Toyota Pick-Up', 'URG 318', '15'),
('vehicle-6', 'Toyota Innova', 'PWO 612', '12');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venueID` varchar(15) NOT NULL,
  `venueName` varchar(100) NOT NULL,
  `numberOfPax` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venueID`, `venueName`, `numberOfPax`) VALUES
('venue-1', 'Multi-purpose Hall', '400'),
('venue-2', 'Stage Side (MPH)', '100'),
('venue-3', 'Middle (MPH)', '100'),
('venue-4', 'Back Side (MPH)', '100'),
('venue-5', 'Reception Area (MPH)', '100'),
('venue-6', 'Ground Floor Auditorium', '100'),
('venue-7', 'University Gymnasium', '100'),
('venue-8', 'Freedom Park', '100');

-- --------------------------------------------------------

--
-- Structure for view `productrequestviews`
--
DROP TABLE IF EXISTS `productrequestviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productrequestviews`  AS SELECT `productrequest`.`requestID` AS `requestID`, `users`.`name` AS `name`, `department`.`departmentID` AS `departmentID`, `department`.`departmentName` AS `departmentName`, `category`.`categoryName` AS `categoryName`, `product`.`productID` AS `productID`, `product`.`productName` AS `productName`, `productrequest`.`requestDate` AS `requestDate`, `productrequest`.`requestQuantity` AS `requestQuantity`, `productrequest`.`requestStatus` AS `requestStatus` FROM ((((`productrequest` join `users` on(`productrequest`.`userID` = `users`.`userID`)) join `department` on(`productrequest`.`departmentID` = `department`.`departmentID`)) join `category` on(`productrequest`.`categoryID` = `category`.`categoryID`)) join `product` on(`productrequest`.`productID` = `product`.`productID`))  ;

-- --------------------------------------------------------

--
-- Structure for view `productviews`
--
DROP TABLE IF EXISTS `productviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productviews`  AS SELECT `product`.`productID` AS `productID`, `product`.`productName` AS `productName`, `product`.`productQuantity` AS `productQuantity`, `product`.`unit` AS `unit`, `product`.`expirationDate` AS `expirationDate`, `product`.`price` AS `price`, `category`.`categoryID` AS `categoryID`, `category`.`categoryName` AS `categoryName`, `product`.`status` AS `status` FROM (`product` join `category` on(`product`.`categoryID` = `category`.`categoryID`))  ;

-- --------------------------------------------------------

--
-- Structure for view `purchaseorderviews`
--
DROP TABLE IF EXISTS `purchaseorderviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `purchaseorderviews`  AS SELECT `purchaseorder`.`orderID` AS `orderID`, `supplier`.`companyID` AS `companyID`, `supplier`.`companyName` AS `companyName`, `users`.`name` AS `name`, `product`.`productID` AS `productID`, `product`.`productName` AS `productName`, `purchaseorder`.`orderDate` AS `orderDate`, `purchaseorder`.`expect_date` AS `expect_date`, `purchaseorder`.`orderQuantity` AS `orderQuantity`, `purchaseorder`.`orderUnitCost` AS `orderUnitCost`, `purchaseorder`.`orderStatus` AS `orderStatus`, `purchaseorder`.`status` AS `status` FROM (((`purchaseorder` join `supplier` on(`purchaseorder`.`companyID` = `supplier`.`companyID`)) join `users` on(`purchaseorder`.`userID` = `users`.`userID`)) join `product` on(`purchaseorder`.`productID` = `product`.`productID`))  ;

-- --------------------------------------------------------

--
-- Structure for view `reservationvehicleviews`
--
DROP TABLE IF EXISTS `reservationvehicleviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservationvehicleviews`  AS SELECT `reservationvehicle`.`reservationVehicleID` AS `reservationVehicleID`, `users`.`userID` AS `userID`, `users`.`name` AS `name`, `reservationvehicle`.`email` AS `email`, `users`.`contact_no` AS `contact_no`, `users`.`address` AS `address`, `department`.`departmentID` AS `departmentID`, `department`.`departmentName` AS `departmentName`, `reservationvehicle`.`nameOfActivity` AS `nameOfActivity`, `vehicle`.`vehicleName` AS `vehicleName`, `vehicle`.`numberOfSeaters` AS `numberOfSeaters`, `reservationvehicle`.`numberOfPassenger` AS `numberOfPassenger`, `reservationvehicle`.`resDate` AS `resDate`, `reservationvehicle`.`pickUp` AS `pickUp`, `reservationvehicle`.`returnDate` AS `returnDate`, `reservationvehicle`.`reservationStatus` AS `reservationStatus` FROM (((`reservationvehicle` join `users` on(`reservationvehicle`.`userID` = `users`.`userID`)) join `vehicle` on(`reservationvehicle`.`vehicleID` = `vehicle`.`vehicleID`)) join `department` on(`reservationvehicle`.`departmentID` = `department`.`departmentID`))  ;

-- --------------------------------------------------------

--
-- Structure for view `reservationvenueviews`
--
DROP TABLE IF EXISTS `reservationvenueviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservationvenueviews`  AS SELECT `reservationvenue`.`reservationID` AS `reservationID`, `users`.`userID` AS `userID`, `users`.`name` AS `name`, `department`.`departmentID` AS `departmentID`, `department`.`departmentName` AS `departmentName`, `reservationvenue`.`email` AS `email`, `users`.`contact_no` AS `contact_no`, `users`.`address` AS `address`, `venue`.`venueName` AS `venueName`, `reservationvenue`.`nameOfActivity` AS `nameOfActivity`, `reservationvenue`.`numberOfGuests` AS `numberOfGuests`, `reservationvenue`.`reserveDate` AS `reserveDate`, `reservationvenue`.`checkIn` AS `checkIn`, `reservationvenue`.`checkOut` AS `checkOut`, `reservationvenue`.`reservationStatus` AS `reservationStatus` FROM (((`reservationvenue` join `users` on(`reservationvenue`.`userID` = `users`.`userID`)) join `venue` on(`reservationvenue`.`venueID` = `venue`.`venueID`)) join `department` on(`reservationvenue`.`departmentID` = `department`.`departmentID`))  ;

-- --------------------------------------------------------

--
-- Structure for view `userviews`
--
DROP TABLE IF EXISTS `userviews`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userviews`  AS SELECT `users`.`userID` AS `userID`, `users`.`name` AS `name`, `users`.`contact_no` AS `contact_no`, `users`.`address` AS `address`, `users`.`email` AS `email`, `users`.`access` AS `access`, `users`.`password` AS `password`, `users`.`userStatus` AS `userStatus`, `department`.`departmentID` AS `departmentID`, `department`.`departmentName` AS `departmentName` FROM (`users` join `department` on(`users`.`departmentID` = `department`.`departmentID`))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `FK_PRODUCT_CATEGORYID` (`categoryID`);

--
-- Indexes for table `productrequest`
--
ALTER TABLE `productrequest`
  ADD PRIMARY KEY (`requestID`),
  ADD KEY `FK_PRO_REQ_USERID` (`userID`),
  ADD KEY `FK_PRO_REQ_CATEGORYID` (`categoryID`),
  ADD KEY `FK_PRO_REQ_PRODUCTID` (`productID`),
  ADD KEY `FK_PRO_REQ_DEPARTMENTID` (`departmentID`);

--
-- Indexes for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `FK_PUR_ORDER_USERID` (`userID`),
  ADD KEY `FK_PUR_ORDER_COMPANYID` (`companyID`),
  ADD KEY `FK_PUR_ORDER_PRODUCTID` (`productID`);

--
-- Indexes for table `reservationvehicle`
--
ALTER TABLE `reservationvehicle`
  ADD PRIMARY KEY (`reservationVehicleID`),
  ADD KEY `FK_RES_VEHICLE_USERID` (`userID`),
  ADD KEY `FK_RES_VENUE_VEHICLEID` (`vehicleID`),
  ADD KEY `FK_RES_VEHICLE_DEPTID` (`departmentID`);

--
-- Indexes for table `reservationvenue`
--
ALTER TABLE `reservationvenue`
  ADD PRIMARY KEY (`reservationID`),
  ADD KEY `FK_RES_VENUE_USERID` (`userID`),
  ADD KEY `FK_RES_VENUE_VENUEID` (`venueID`),
  ADD KEY `FK_RES_VENUE_DEPTID` (`departmentID`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_SHED_USERID` (`userID`),
  ADD KEY `FK_SCHED_DEPARTMENTID` (`departmentID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`companyID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `FK_USERS_DEPARTMENTID` (`departmentID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicleID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venueID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_PRODUCT_CATEGORYID` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`);

--
-- Constraints for table `productrequest`
--
ALTER TABLE `productrequest`
  ADD CONSTRAINT `FK_PRO_REQ_CATEGORYID` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`),
  ADD CONSTRAINT `FK_PRO_REQ_DEPARTMENTID` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`),
  ADD CONSTRAINT `FK_PRO_REQ_PRODUCTID` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `FK_PRO_REQ_USERID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `purchaseorder`
--
ALTER TABLE `purchaseorder`
  ADD CONSTRAINT `FK_PUR_ORDER_COMPANYID` FOREIGN KEY (`companyID`) REFERENCES `supplier` (`companyID`),
  ADD CONSTRAINT `FK_PUR_ORDER_PRODUCTID` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`),
  ADD CONSTRAINT `FK_PUR_ORDER_USERID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `reservationvehicle`
--
ALTER TABLE `reservationvehicle`
  ADD CONSTRAINT `FK_RES_VEHICLE_DEPTID` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`),
  ADD CONSTRAINT `FK_RES_VEHICLE_USERID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `FK_RES_VENUE_VEHICLEID` FOREIGN KEY (`vehicleID`) REFERENCES `vehicle` (`vehicleID`);

--
-- Constraints for table `reservationvenue`
--
ALTER TABLE `reservationvenue`
  ADD CONSTRAINT `FK_RES_VENUE_DEPTID` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`),
  ADD CONSTRAINT `FK_RES_VENUE_USERID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `FK_RES_VENUE_VENUEID` FOREIGN KEY (`venueID`) REFERENCES `venue` (`venueID`);

--
-- Constraints for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD CONSTRAINT `FK_SCHED_DEPARTMENTID` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`),
  ADD CONSTRAINT `FK_SHED_USERID` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_USERS_DEPARTMENTID` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
