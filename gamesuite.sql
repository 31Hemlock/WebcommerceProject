-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2018 at 03:51 AM
-- Server version: 5.7.21-log
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamesuite`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `accountType` enum('Customer','Employee','Admin') DEFAULT 'Customer',
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `accountCreation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `birthDate` date NOT NULL,
  `phoneNumber` varchar(24) NOT NULL,
  `addressID` int(11) NOT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`accountID`, `username`, `accountType`, `password`, `email`, `accountCreation`, `lastLogin`, `firstName`, `lastName`, `birthDate`, `phoneNumber`, `addressID`) VALUES
(1, 'admin', 'Admin', 'admin', 'admin@gamesuite.com', '2017-06-06 04:00:00', '2018-04-25 23:04:21', 'John', 'Jamerson', '1973-12-09', '555-555-5555', 1),
(2, 'rkent', 'Employee', 'rkent', 'rkent@gamesuite.com', '2018-04-25 23:06:23', '2018-04-25 23:06:23', 'Ryan', 'Kent', '1996-10-01', '555-555-5555', 2),
(3, 'k007Guy', 'Customer', '7heH7pes7pa55w00d', 'koolguy@somewebsite.com', '2018-04-24 17:39:56', '2018-04-24 17:39:56', 'Bob', 'Smith', '1967-10-28', '555-555-5555', 3);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_street` varchar(100) NOT NULL,
  `zip_code1` varchar(5) NOT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_zipCode_address` (`zip_code1`)
) ENGINE=InnoDB AUTO_INCREMENT=3030 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_street`, `zip_code1`) VALUES
(123, 'Apple Lane', '24068'),
(221, 'Cherry Lane', '22044'),
(234, 'Sparkling Lane', '23450'),
(329, 'Pickle Street', '21921'),
(389, 'Friendship Lane', '23501'),
(398, 'Jamestown Road', '22801'),
(569, 'Cool Steet', '24001'),
(630, 'Washington Street', '24060'),
(736, 'Cheese Road', '23261'),
(827, 'Notsocool Street', '27012'),
(982, 'Roberto Circle', '22902'),
(3029, 'Rocky Road', '22601');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `gameID` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `releaseDate` date DEFAULT NULL,
  `esrbRating` enum('EC','E','E10+','T','M','AO') DEFAULT NULL,
  `genre` varchar(20) NOT NULL,
  `platform` enum('Switch','PS4','Xbox One','PC') NOT NULL,
  `publisher` text NOT NULL,
  `developer` text NOT NULL,
  `beforeRentPrice` double NOT NULL DEFAULT '59.99',
  `afterRentPrice` double NOT NULL DEFAULT '53.99',
  `rentalRate` double NOT NULL DEFAULT '6.99',
  `quantity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gameID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameID`, `title`, `releaseDate`, `esrbRating`, `genre`, `platform`, `publisher`, `developer`, `beforeRentPrice`, `afterRentPrice`, `rentalRate`, `quantity`) VALUES
(1, 'Knack 2', '2017-09-05', 'E10+', 'Action', 'PS4', 'SIE Japan Studio', 'Sony Interactive Entertainment', 29.99, 25.99, 3.99, 20),
(2, 'PlayerUnknown\'s Battlegrounds', '2017-12-08', 'T', 'Battle Royale', 'Xbox One', 'PUBG Corporation', 'Microsoft Studios', 59.99, 53.99, 6.99, 100),
(3, 'God of War', '2018-04-20', 'M', 'Action-Adventure', 'PS4', 'Sony Interactive Entertainment', 'SIE Santa Monica Studio', 59.99, 53.99, 6.99, 100),
(4, 'Splatoon 2', '2017-07-21', 'E10+', 'Shooter', 'Switch', 'Nintendo EPD', 'Nintendo', 59.99, 53.99, 6.99, 40),
(5, 'Super Smash Bros. for Nintendo Switch', NULL, NULL, 'Fighting', 'Switch', 'Nintendo', 'Sora Ltd.', 59.99, 53.99, 6.99, 300),
(7, 'Sea of Thieves', '2018-03-20', 'T', 'Action-Adventure', 'Xbox One', 'Microsoft', 'Rare', 59.99, 53.99, 6.99, 100),
(8, 'Donkey Kong Country Tropical Freeze', '2018-05-04', 'E', 'Platformer', 'Switch', 'Nintendo', 'Retro Studios', 59.99, 53.99, 6.99, 200);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
  `accountID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `delieveryStatus` enum('processing','shipped','completed') NOT NULL,
  `delieveryDate` date NOT NULL,
  PRIMARY KEY (`accountID`,`gameID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`accountID`, `gameID`, `delieveryStatus`, `delieveryDate`) VALUES
(1, 1, 'completed', '2018-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

DROP TABLE IF EXISTS `rent`;
CREATE TABLE IF NOT EXISTS `rent` (
  `accountID` int(11) NOT NULL,
  `gameID` int(11) NOT NULL,
  `nextPaymentDate` date NOT NULL,
  `deliveryStatus` enum('processing','shipped','completed') NOT NULL,
  `delieveryDate` date NOT NULL,
  PRIMARY KEY (`accountID`,`gameID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`accountID`, `gameID`, `nextPaymentDate`, `deliveryStatus`, `delieveryDate`) VALUES
(1, 4, '2018-05-08', 'completed', '2018-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `zipcode`
--

DROP TABLE IF EXISTS `zipcode`;
CREATE TABLE IF NOT EXISTS `zipcode` (
  `zip_code` varchar(5) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` char(2) NOT NULL,
  PRIMARY KEY (`zip_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zipcode`
--

INSERT INTO `zipcode` (`zip_code`, `city`, `state`) VALUES
('21921', 'Elkton', 'MD'),
('22044', 'Falls Church', 'VA'),
('22601', 'Winchester', 'VA'),
('22801', 'Harrisonburg', 'VA'),
('22902', 'Charlottesville', 'VA'),
('23261', 'Richmond', 'VA'),
('23450', 'Virginia Beach', 'VA'),
('23501', 'Norfolk', 'VA'),
('24001', 'Roanoke', 'VA'),
('24060', 'Blacksburg', 'VA'),
('24068', 'Christiansburg', 'VA'),
('27012', 'Clemmons', 'NC');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_zipCode_address` FOREIGN KEY (`zip_code1`) REFERENCES `zipcode` (`zip_code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
