-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 11, 2015 at 07:58 AM
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
-- Table structure for table `AdminAccount`
--

CREATE TABLE IF NOT EXISTS `AdminAccount` (
`AdminAccountID` int(11) NOT NULL,
  `AdminAccountUserName` varchar(20) NOT NULL,
  `AdminAccountName` varchar(50) NOT NULL,
  `AdminAccountLastName` varchar(20) NOT NULL,
  `AdminAccountPass` varchar(50) NOT NULL,
  `AdminAccountPermission` enum('admin','editor','','') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `AdminAccount`
--

INSERT INTO `AdminAccount` (`AdminAccountID`, `AdminAccountUserName`, `AdminAccountName`, `AdminAccountLastName`, `AdminAccountPass`, `AdminAccountPermission`) VALUES
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
-- Table structure for table `Cart`
--

CREATE TABLE IF NOT EXISTS `Cart` (
`CartID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `CartPurchased` tinyint(1) NOT NULL,
  `CartQuantity` int(11) NOT NULL,
  `CartItemSize` enum('small','medium','large') NOT NULL,
  `CartDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`ProductID`, `ProductName`, `ProductPrice`, `ProductType`, `ProductStatus`, `ProductAvailabilitySmall`, `ProductAvailabilityMedium`, `ProductAvailabilityLarge`, `ProductGender`, `ProductAttactment`, `AdminAccountID`, `ProductDateAdded`, `ProductSale`, `ProductBrand`, `ProductSoldSmall`, `ProductSoldMedium`, `ProductSoldLarge`) VALUES
(49, 'black jac', 757, 'shoes', 'Available', 0, 0, 0, 'male', 'e06125a16c1446f81868096a35bb2609.jpg', 12, '2015-01-21 15:05:22', 0, 'ballos', 10, 11, 10),
(50, 'ballos', 8898, 'shoes', 'Available', 10, 10, 10, 'male', 'ff4b41246e3a881a9bea221f4fad912f.jpg', 12, '2015-01-21 15:14:43', 0, 'name', 0, 0, 0),
(51, 'dad', 2423, 'shoes', 'Close', 10, 10, 9, 'male', '0912e713f05745fbf45c448f188fb7a0.jpg', 12, '2015-01-23 06:26:39', 0, 'ssf', 0, 0, 1),
(52, 'eew', 2342, 'jackets', 'Available', 10, 10, 10, 'male', '480ed5ddecc68f23f9052bcac30c9f89.jpg', 11, '2015-01-23 06:28:36', 0, 'efws', 0, 0, 0),
(53, 'wer', 2342, 'shoes', 'Close', 10, 10, 10, 'male', '8d0e54b6e7af546a94dff9de661daeeb.jpg', 11, '2015-01-23 06:29:27', 0, 'wefw', 0, 0, 0),
(54, 'fdg', 433, 'jackets', 'Available', 10, 10, 10, 'male', '1643a617dfa75d76bf2622a46ee5a682.jpg', 11, '2015-01-23 06:29:51', 0, 'dg', 0, 0, 0),
(55, 'tyry', 464, 'tees', 'Available', 10, 10, 10, 'male', '9bdfc236a8be498259937d37f24b0f33.jpg', 11, '2015-01-23 06:30:19', 0, 'yryr', 0, 0, 0),
(56, 'dfgd', 436, 'shoes', 'Available', 10, 10, 10, 'male', 'b812c58e38f5811907c304e8df5b768e.jpg', 11, '2015-01-23 06:30:56', 0, 'dfbdsb', 0, 0, 0),
(57, 'dfg', 335, 'jackets', 'Available', 10, 10, 10, 'male', '62f9352df5a06a827b48b5138d9e3487.jpg', 11, '2015-01-23 06:31:21', 0, 'gfedgfd', 0, 0, 0),
(58, 'fdsg', 3453, 'shoes', 'Available', 10, 10, 10, 'male', '8cb7fd7f92fd0a9051b2a59fd13c50a0.jpg', 11, '2015-01-23 06:31:39', 0, 'fdgsd', 0, 0, 0),
(59, 'ewwe', 523, 'jackets', 'Available', 10, 10, 10, 'male', '28d724e01c32bcc6bfa279ac6474340e.jpg', 11, '2015-01-23 06:32:05', 0, 'ewwet', 0, 0, 0),
(60, 'fbdbf', 2342, 'jackets', 'Available', 10, 10, 10, 'male', 'e2d1532231d56dbb112b93a2d28697cb.jpg', 11, '2015-01-23 06:35:19', 0, 'wfw', 0, 0, 0),
(61, 'edwin', 123456, 'tees', 'Available', 10, 10, 10, 'male', '0e0058efc38826e2a138ea536605186f.jpg', 12, '2015-01-25 02:38:18', 1, 'rudas', 0, 0, 0),
(62, 'egsgs', 3634, 'shoes', 'Available', 10, 10, 10, 'male', 'ff418c6f3d026954a312dea869d144d3.jpg', 12, '2015-01-25 06:40:31', 1, 'gdfs', 0, 0, 0),
(63, 'hjhg', 89778, 'shoes', 'Available', 10, 10, 10, 'male', '0692e3b5c51c1009e917728132278892.jpg', 11, '2015-01-25 06:41:49', 0, 'jj', 0, 0, 0),
(64, 'lloric', 123456, 'shoes', 'Available', 10, 10, 10, 'male', '7b25869914f9413278e1c1673a7d8798.jpg', 11, '2015-01-25 09:47:39', 0, 'm/', 0, 0, 0),
(65, 'Onyok', 3454678, 'tees', 'Available', 10, 10, 10, 'female', '424b8bf632d1fa7a2466e5a2b58b94e3.jpg', 12, '2015-01-25 12:59:42', 0, 'Embrado', 0, 0, 0),
(66, 'kaaka', 87987, 'shoes', 'Close', 10, 10, 10, 'male', '5f91ddee776d4273f7939dc6d64739ca.jpg', 11, '2015-01-28 06:26:00', 0, 'guyg', 0, 0, 0),
(67, 'nike', 234324321, 'jackets', 'Available', 10, 10, 10, 'male', 'abadd4bd81ff40a61bf430edc170066f.jpg', 11, '2015-01-28 06:34:35', 0, 'steffan ja', 0, 0, 0),
(68, 'hgj', 8768, 'shoes', 'Available', 10, 10, 10, 'male', '7d3d6d946f59ecb68a41e61f9f019441.jpg', 11, '2015-01-28 08:45:13', 0, 'ghg', 0, 0, 0),
(69, 'jhjh', 0, 'shoes', 'Available', 10, 10, 10, 'male', '88c97de27cc47af79104b89b2239efdb.jpg', 11, '2015-01-28 09:02:20', 0, 'kjhk', 0, 0, 0),
(70, 'jhgjhg', 876876, 'shorts', 'Available', 10, 10, 10, 'male', 'cac54197e63168ad9b2ff7280d371b84.jpg', 12, '2015-01-28 09:02:52', 0, 'jhgj', 0, 0, 0),
(71, 'hcfb', 35, 'shoes', 'Available', 10, 10, 10, 'female', 'de0c88f4e6e1eb32fdfbafb51fd224af.jpg', 12, '2015-02-07 15:37:56', 1, 'dg', 0, 0, 0),
(72, 'sdg', 242, 'jackets', 'Available', 10, 10, 10, 'female', 'd60b9606686e4c471113877a55a419ec.jpg', 11, '2015-02-07 15:38:38', 0, 'dgf', 0, 0, 0),
(73, 'ewrw', 234, 'shoes', 'Available', 10, 10, 10, 'female', '7118062ff0129bd3e4ac1b5724409c66.jpg', 11, '2015-02-07 15:38:59', 0, 'wrew', 0, 0, 0),
(74, 'sgs', 224, 'jackets', 'Available', 10, 10, 10, 'female', 'd5a719929a9d12ee49c44bd5fec15312.jpg', 11, '2015-02-07 15:39:24', 0, 'gdx', 0, 0, 0),
(75, 'sdfs', 234, 'tees', 'Available', 10, 10, 10, 'female', '3986f35e6a9c5853804008700df5afe3.jpg', 11, '2015-02-07 15:39:47', 0, 'dsgs', 0, 0, 0),
(76, 'fe', 34, 'jackets', 'Available', 10, 10, 10, 'female', '640be5c56510cf4a76d06511ca27e99d.jpg', 11, '2015-02-07 15:40:12', 0, 'sfs', 0, 0, 0),
(77, 'qr', 10, 'tees', '', 10, 10, 10, 'female', '8e5637abbeb54269ef310e743cf6b67e.jpg', 11, '2015-02-07 15:40:34', 0, 'wr', 0, 0, 0),
(78, 'wefa', 523, 'jackets', 'Available', 10, 10, 10, 'female', 'a32e6858d41913935359a0d262856f85.jpg', 11, '2015-02-07 15:40:52', 0, 'sf', 0, 0, 0),
(79, 'ers', 23, 'jackets', 'Available', 10, 10, 10, 'female', '0d3d4941e564dbf46a18c34e7f6c6294.jpg', 11, '2015-02-07 15:41:12', 0, 'sf', 0, 0, 0),
(80, 'wre', 23, 'shoes', 'Available', 10, 10, 10, 'female', 'be6993f4f7ac6f9b5cc331a6ffc953b0.jpg', 12, '2015-02-07 15:41:29', 1, 'rw', 0, 0, 0),
(81, 'jinky', 100000, 'shoes', 'Available', 10, 10, 10, 'male', '83eed3c5fa0df44361252111e72128e7.jpg', 12, '2015-02-10 03:50:00', 1, 'jsky', 0, 0, 0),
(82, 'q', 1, 'shoes', 'Available', 1, 1, 1, 'male', '45b6405b533c992b88f711364483b555.jpg', 20, '2015-02-11 06:13:33', 1, 'q', 0, 0, 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `PurchasedLine`
--

CREATE TABLE IF NOT EXISTS `PurchasedLine` (
  `PurchasedID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Size` enum('small','medium','large') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `UserAccount`
--

CREATE TABLE IF NOT EXISTS `UserAccount` (
`UserAccountID` int(11) NOT NULL,
  `UserAccountImage` varchar(60) NOT NULL,
  `UserAccountFisrtName` varchar(20) NOT NULL,
  `UserAccountLastName` varchar(20) NOT NULL,
  `UserAccountUserName` varchar(20) NOT NULL,
  `UserAccountPassword` varchar(60) NOT NULL,
  `UserAccountBM` enum('January','February','March','April','May','June','July','August','September','October','November','December') NOT NULL,
  `UserAccountBD` int(11) NOT NULL,
  `UserAccountBY` int(11) NOT NULL,
  `UserAccountGender` enum('female','male') NOT NULL,
  `UserAccountHomeAddress` varchar(60) NOT NULL,
  `UserAccountMobile` varchar(20) NOT NULL,
  `UserAccountEmail` varchar(50) NOT NULL,
  `UserAccountShipping` varchar(60) NOT NULL,
  `UserAccountSecretQuestion` varchar(20) NOT NULL,
  `UserAccountAnswer` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `UserAccount`
--

INSERT INTO `UserAccount` (`UserAccountID`, `UserAccountImage`, `UserAccountFisrtName`, `UserAccountLastName`, `UserAccountUserName`, `UserAccountPassword`, `UserAccountBM`, `UserAccountBD`, `UserAccountBY`, `UserAccountGender`, `UserAccountHomeAddress`, `UserAccountMobile`, `UserAccountEmail`, `UserAccountShipping`, `UserAccountSecretQuestion`, `UserAccountAnswer`) VALUES
(7, 'male.png', 'll', 'll', 'll', '0cc175b9c0f1b6a831c399e269772661', 'January', 1, 1990, 'male', 'hh', '766', 'hh@yahoo.com', 'hh', 'hh', '5e36941b3d856737e81516acd45edc50'),
(8, 'female.png', 'bb', 'bb', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c', 'January', 6, 1990, 'female', 'bb', '88', 'bb@yahoo.com', 'bb', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c'),
(9, 'male.png', 'mm', 'mm', 'mm', 'b3cd915d758008bd19d0f2428fbb354a', 'January', 6, 1990, 'male', 'mm', '88', 'mm@yahoo.com', 'mm', 'mm', 'b3cd915d758008bd19d0f2428fbb354a'),
(10, '2e161ce9d8ff5b8da0fd794ed80fbe59.jpg', 'Lloric', 'Garcia', 'q', '7694f4a66316e53c8cdd9d9954bd611d', 'March', 15, 1990, 'male', 'egot turno dipolog city', '09487761477', 'emorickfighter@yahoo.com', 'dipolog', 'q', '7694f4a66316e53c8cdd9d9954bd611d'),
(11, 'male.png', 'ard', 'moses', 'ardmoses', 'e10adc3949ba59abbe56e057f20f883e', 'January', 1, 1999, 'male', 'asdsadasdasd', '12323123123', 'aasdasdasd@yahoo.com', 'asdasdasdasasdasd', 'ard', '4ce0bec67fe735f4997426101dd5292b'),
(12, 'male.png', 'z', 'z', 'z', 'fbade9e36a3f36d3d676c1b808451dd7', 'January', 6, 1990, 'male', 'z', '11', 'z@yahoo.com', 'z', 'z', 'fbade9e36a3f36d3d676c1b808451dd7'),
(13, 'female.png', 'Jerald', 'Buljatin', 'jeraldin', '97784fec6e2313cf5f1d7ffac21c7098', 'May', 10, 1995, 'female', 'Me Bang, Dipolog City', '09213456789', 'jeraldin@yahoo.com', 'Me Bang, Dipolog City', 'What name?', '8b80876f51614e59f3224af17b48aa9b'),
(14, 'female.png', 'Angel May', 'Magaway', 'angel', 'f4f068e71e0d87bf0ad51e6214ab84e9', 'May', 10, 1993, 'female', 'katipnan', '0909', 'angle@yahoo.com', '...', 'aa', '4124bc0a9335c27f086f24ba207a4912');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AdminAccount`
--
ALTER TABLE `AdminAccount`
 ADD PRIMARY KEY (`AdminAccountID`), ADD UNIQUE KEY `AdminAccountUserName` (`AdminAccountUserName`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
 ADD PRIMARY KEY (`CartID`), ADD KEY `fk_cart_useraccount` (`UserAccountID`), ADD KEY `fk_cart_product` (`ProductID`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
 ADD PRIMARY KEY (`ProductID`), ADD UNIQUE KEY `ProductAttactment` (`ProductAttactment`), ADD KEY `fk_product_adminaccount` (`AdminAccountID`);

--
-- Indexes for table `Purchased`
--
ALTER TABLE `Purchased`
 ADD PRIMARY KEY (`PurchasedID`), ADD KEY `fk_purchased_useraccount` (`UserAccountID`), ADD KEY `fk_purchased_adminaccount` (`AdminAccountID`);

--
-- Indexes for table `PurchasedLine`
--
ALTER TABLE `PurchasedLine`
 ADD KEY `fk_purchasedline_product` (`ProductID`), ADD KEY `fk_purchasedline_purchased` (`PurchasedID`);

--
-- Indexes for table `UserAccount`
--
ALTER TABLE `UserAccount`
 ADD PRIMARY KEY (`UserAccountID`), ADD UNIQUE KEY `UserAccountUserName` (`UserAccountUserName`), ADD UNIQUE KEY `UserAccountEmail` (`UserAccountEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AdminAccount`
--
ALTER TABLE `AdminAccount`
MODIFY `AdminAccountID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `Purchased`
--
ALTER TABLE `Purchased`
MODIFY `PurchasedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `UserAccount`
--
ALTER TABLE `UserAccount`
MODIFY `UserAccountID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`ProductID`) REFERENCES `Product` (`ProductID`),
ADD CONSTRAINT `fk_cart_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `UserAccount` (`UserAccountID`);

--
-- Constraints for table `Product`
--
ALTER TABLE `Product`
ADD CONSTRAINT `fk_product_useraccount` FOREIGN KEY (`AdminAccountID`) REFERENCES `AdminAccount` (`AdminAccountID`);

--
-- Constraints for table `Purchased`
--
ALTER TABLE `Purchased`
ADD CONSTRAINT `fk_purchased_adminaccount` FOREIGN KEY (`AdminAccountID`) REFERENCES `AdminAccount` (`AdminAccountID`),
ADD CONSTRAINT `fk_purchased_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `UserAccount` (`UserAccountID`);

--
-- Constraints for table `PurchasedLine`
--
ALTER TABLE `PurchasedLine`
ADD CONSTRAINT `fk_purchasedline_product` FOREIGN KEY (`ProductID`) REFERENCES `Product` (`ProductID`),
ADD CONSTRAINT `fk_purchasedline_purchased` FOREIGN KEY (`PurchasedID`) REFERENCES `Purchased` (`PurchasedID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
