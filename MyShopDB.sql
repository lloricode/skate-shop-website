-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 06:20 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `MyShopDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Purchased`
--

CREATE TABLE IF NOT EXISTS `Purchased` (
`PurchasedID` int(11) NOT NULL,
  `PurchasedAmount` double NOT NULL,
  `PurchasedQuantity` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `AdminAccountID` int(11) DEFAULT NULL,
  `PurchasedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PurchasedDelivered` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Purchased`
--
ALTER TABLE `Purchased`
 ADD PRIMARY KEY (`PurchasedID`), ADD KEY `fk_purchased_useraccount` (`UserAccountID`), ADD KEY `fk_purchased_adminaccount` (`AdminAccountID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Purchased`
--
ALTER TABLE `Purchased`
MODIFY `PurchasedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Purchased`
--
ALTER TABLE `Purchased`
ADD CONSTRAINT `fk_purchased_adminaccount` FOREIGN KEY (`AdminAccountID`) REFERENCES `AdminAccount` (`AdminAccountID`),
ADD CONSTRAINT `fk_purchased_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `UserAccount` (`UserAccountID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
