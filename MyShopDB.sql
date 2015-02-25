-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2015 at 05:34 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminaccount`
--

CREATE TABLE IF NOT EXISTS `adminaccount` (
`AdminAccountID` int(11) NOT NULL,
  `AdminAccountUserName` varchar(20) NOT NULL,
  `AdminAccountName` varchar(50) NOT NULL,
  `AdminAccountLastName` varchar(20) NOT NULL,
  `AdminAccountPass` varchar(50) NOT NULL,
  `AdminAccountPermission` enum('admin','editor','','') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminaccount`
--

INSERT INTO `adminaccount` (`AdminAccountID`, `AdminAccountUserName`, `AdminAccountName`, `AdminAccountLastName`, `AdminAccountPass`, `AdminAccountPermission`) VALUES
(11, 'admin', 'Lloric', 'Garcia', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(12, 'q', 'user', 'fsfa', '7694f4a66316e53c8cdd9d9954bd611d', 'editor'),
(13, 'mos', 'Ard', 'Moses', 'mos', 'editor'),
(14, 'k', 'k', 'k', 'k', 'editor'),
(15, 'l', 'l', 'l', '2db95e8e1a9267b7a1188556b2013b33', 'editor'),
(16, 'qq', 'q', 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'editor'),
(18, 'a', 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', 'editor'),
(19, 'ardmoses', 'ard', 'moses', 'e10adc3949ba59abbe56e057f20f883e', 'admin'),
(20, 'aa', 'a', 'a', '4124bc0a9335c27f086f24ba207a4912', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
`CartID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `CartPurchased` tinyint(1) NOT NULL,
  `CartQuantity` int(11) NOT NULL,
  `CartItemSize` enum('small','medium','large') NOT NULL,
  `CartDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `UserAccountID`, `ProductID`, `CartPurchased`, `CartQuantity`, `CartItemSize`, `CartDateAdded`) VALUES
(1, 10, 84, 1, 1, 'small', '2015-02-25 03:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`ProductID` int(11) NOT NULL,
  `ProductName` varchar(50) NOT NULL,
  `ProductPrice` double NOT NULL,
  `ProductType` varchar(20) NOT NULL,
  `ProductStatus` enum('Available','Out of Stock','Close') NOT NULL,
  `ProductAvailabilitySmall` int(11) NOT NULL,
  `ProductAvailabilityMedium` int(11) NOT NULL,
  `ProductAvailabilityLarge` int(11) NOT NULL,
  `ProductGender` enum('male','female','both') NOT NULL,
  `ProductAttactment` varchar(100) NOT NULL,
  `AdminAccountID` int(11) NOT NULL,
  `ProductDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ProductSale` tinyint(1) NOT NULL,
  `ProductBrand` varchar(10) NOT NULL,
  `ProductSoldSmall` int(11) NOT NULL,
  `ProductSoldMedium` int(11) NOT NULL,
  `ProductSoldLarge` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductPrice`, `ProductType`, `ProductStatus`, `ProductAvailabilitySmall`, `ProductAvailabilityMedium`, `ProductAvailabilityLarge`, `ProductGender`, `ProductAttactment`, `AdminAccountID`, `ProductDateAdded`, `ProductSale`, `ProductBrand`, `ProductSoldSmall`, `ProductSoldMedium`, `ProductSoldLarge`) VALUES
(83, 'lloricc', 8767, 'shoes', 'Available', 10, 10, 10, 'male', '7edc9b8f3bb006105814aa608cd0d3dc.jpg', 11, '2015-02-24 09:46:14', 1, 'nova', 0, 0, 0),
(84, 'lira', 9999, 'shoes', 'Available', 0, 1, 1, 'female', '1a1064995548a9317f00784967226575.jpg', 11, '2015-02-25 03:07:13', 1, 'luba', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchased`
--

CREATE TABLE IF NOT EXISTS `purchased` (
`PurchasedID` int(11) NOT NULL,
  `PurchasedAmount` double NOT NULL,
  `PurchasedQuantity` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `AdminAccountID` int(11) DEFAULT NULL,
  `PurchasedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PurchasedDelivered` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`PurchasedID`, `PurchasedAmount`, `PurchasedQuantity`, `UserAccountID`, `AdminAccountID`, `PurchasedDate`, `PurchasedDelivered`) VALUES
(1, 9999, 1, 10, NULL, '2015-02-25 03:19:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedline`
--

CREATE TABLE IF NOT EXISTS `purchasedline` (
  `PurchasedID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Size` enum('small','medium','large') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedline`
--

INSERT INTO `purchasedline` (`PurchasedID`, `ProductID`, `Quantity`, `Size`) VALUES
(1, 84, 1, 'small');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE IF NOT EXISTS `useraccount` (
`UserAccountID` int(11) NOT NULL,
  `UserAccountImage` varchar(60) NOT NULL,
  `UserAccountFisrtName` varchar(20) NOT NULL,
  `UserAccountLastName` varchar(20) NOT NULL,
  `UserAccountUserName` varchar(20) NOT NULL,
  `UserAccountPassword` varchar(60) NOT NULL,
  `UserAccountBD` varchar(10) NOT NULL,
  `UserAccountGender` enum('female','male') NOT NULL,
  `UserAccountHomeAddress` varchar(60) NOT NULL,
  `UserAccountMobile` varchar(20) NOT NULL,
  `UserAccountEmail` varchar(50) NOT NULL,
  `UserAccountShipping` varchar(60) NOT NULL,
  `UserAccountSecretQuestion` varchar(20) NOT NULL,
  `UserAccountAnswer` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`UserAccountID`, `UserAccountImage`, `UserAccountFisrtName`, `UserAccountLastName`, `UserAccountUserName`, `UserAccountPassword`, `UserAccountBD`, `UserAccountGender`, `UserAccountHomeAddress`, `UserAccountMobile`, `UserAccountEmail`, `UserAccountShipping`, `UserAccountSecretQuestion`, `UserAccountAnswer`) VALUES
(7, 'male.png', 'll', 'll', 'll', '0cc175b9c0f1b6a831c399e269772661', '02/17/2015', 'male', 'hh', '766', 'hh@yahoo.com', 'hh', 'hh', '5e36941b3d856737e81516acd45edc50'),
(8, 'female.png', 'bb', 'bb', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c', '02/17/2015', 'female', 'bb', '88', 'bb@yahoo.com', 'bb', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c'),
(9, 'male.png', 'mm', 'mm', 'mm', 'b3cd915d758008bd19d0f2428fbb354a', '02/17/2015', 'male', 'mm', '88', 'mm@yahoo.com', 'mm', 'mm', 'b3cd915d758008bd19d0f2428fbb354a'),
(10, 'male.png', 'Lloric', 'Garcia', 'q', '7694f4a66316e53c8cdd9d9954bd611d', '03/15/1990', 'male', 'egot turno dipolog city', '09487761477', 'emorickfighter@yahoo.com', 'dipolog', 'q', '7694f4a66316e53c8cdd9d9954bd611d'),
(11, 'male.png', 'ard', 'moses', 'ardmoses', 'e10adc3949ba59abbe56e057f20f883e', '02/17/2015', 'male', 'asdsadasdasd', '12323123123', 'aasdasdasd@yahoo.com', 'asdasdasdasasdasd', 'ard', '4ce0bec67fe735f4997426101dd5292b'),
(12, 'male.png', 'z', 'z', 'z', 'fbade9e36a3f36d3d676c1b808451dd7', '02/17/2015', 'male', 'z', '11', 'z@yahoo.com', 'z', 'z', 'fbade9e36a3f36d3d676c1b808451dd7'),
(13, 'female.png', 'Jerald', 'Buljatin', 'jeraldin', '97784fec6e2313cf5f1d7ffac21c7098', '02/17/2015', 'female', 'Me Bang, Dipolog City', '09213456789', 'jeraldin@yahoo.com', 'Me Bang, Dipolog City', 'What name?', '8b80876f51614e59f3224af17b48aa9b'),
(14, 'female.png', 'Angel May', 'Magaway', 'angel', 'f4f068e71e0d87bf0ad51e6214ab84e9', '02/17/2015', 'female', 'katipnan', '0909', 'angle@yahoo.com', '...', 'aa', '4124bc0a9335c27f086f24ba207a4912'),
(15, 'female.png', 'Amie', 'Ongayo', 'amie', 'e6a4370aca6970175dee8c72cc7e08dc', '02/17/2015', 'female', 'qq', '9878', 'amie@yahoo.com', 'ww', 't', 'e358efa489f58062f10dd7316b65649e'),
(16, 'male.png', 'aa', 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912', '02/17/2015', 'male', 'aa', '11', 'aa@yahoo.com', 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaccount`
--
ALTER TABLE `adminaccount`
 ADD PRIMARY KEY (`AdminAccountID`), ADD UNIQUE KEY `AdminAccountUserName` (`AdminAccountUserName`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`CartID`), ADD KEY `fk_cart_useraccount` (`UserAccountID`), ADD KEY `fk_cart_product` (`ProductID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`ProductID`), ADD UNIQUE KEY `ProductAttactment` (`ProductAttactment`), ADD KEY `fk_product_adminaccount` (`AdminAccountID`);

--
-- Indexes for table `purchased`
--
ALTER TABLE `purchased`
 ADD PRIMARY KEY (`PurchasedID`), ADD KEY `fk_purchased_useraccount` (`UserAccountID`), ADD KEY `fk_purchased_adminaccount` (`AdminAccountID`);

--
-- Indexes for table `purchasedline`
--
ALTER TABLE `purchasedline`
 ADD KEY `fk_purchasedline_product` (`ProductID`), ADD KEY `fk_purchasedline_purchased` (`PurchasedID`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
 ADD PRIMARY KEY (`UserAccountID`), ADD UNIQUE KEY `UserAccountUserName` (`UserAccountUserName`), ADD UNIQUE KEY `UserAccountEmail` (`UserAccountEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminaccount`
--
ALTER TABLE `adminaccount`
MODIFY `AdminAccountID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
MODIFY `PurchasedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
MODIFY `UserAccountID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
ADD CONSTRAINT `fk_cart_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `fk_product_useraccount` FOREIGN KEY (`AdminAccountID`) REFERENCES `adminaccount` (`AdminAccountID`);

--
-- Constraints for table `purchased`
--
ALTER TABLE `purchased`
ADD CONSTRAINT `fk_purchased_adminaccount` FOREIGN KEY (`AdminAccountID`) REFERENCES `adminaccount` (`AdminAccountID`),
ADD CONSTRAINT `fk_purchased_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

--
-- Constraints for table `purchasedline`
--
ALTER TABLE `purchasedline`
ADD CONSTRAINT `fk_purchasedline_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
ADD CONSTRAINT `fk_purchasedline_purchased` FOREIGN KEY (`PurchasedID`) REFERENCES `purchased` (`PurchasedID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
