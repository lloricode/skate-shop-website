-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2015 at 09:20 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `UserAccountID`, `ProductID`, `CartPurchased`, `CartQuantity`, `CartItemSize`, `CartDateAdded`) VALUES
(29, 10, 84, 1, 1, 'small', '2015-03-10 07:38:17');

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
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductPrice`, `ProductType`, `ProductStatus`, `ProductAvailabilitySmall`, `ProductAvailabilityMedium`, `ProductAvailabilityLarge`, `ProductGender`, `ProductAttactment`, `AdminAccountID`, `ProductDateAdded`, `ProductSale`, `ProductBrand`, `ProductSoldSmall`, `ProductSoldMedium`, `ProductSoldLarge`) VALUES
(83, 'lloricc', 8767, 'shoes', 'Available', 9, 9, 5, 'male', '7edc9b8f3bb006105814aa608cd0d3dc.jpg', 11, '2015-02-24 09:46:14', 1, 'nova', 1, 1, 5),
(84, 'lira', 9999, 'shoes', 'Available', 8, 0, 0, 'male', '1a1064995548a9317f00784967226575.jpg', 11, '2015-02-25 03:07:13', 1, 'luba', 3, 1, 1),
(85, 'wer', 324, 'shoes', 'Available', 0, 0, 0, 'female', 'a40eedce43d22bf9112e63489606abc3.jpg', 11, '2015-03-06 03:00:17', 1, 'ewwet', 1, 2, 3),
(86, 'egerddfgd', 43534, 'jackets', 'Available', 21, 21, 323, 'female', '3ff532cec0d867c6469a9dabbaabfd45.jpg', 11, '2015-03-09 06:08:06', 0, 'rgdg', 0, 0, 0),
(87, 'sfssd', 2432, 'shoes', 'Available', 234, 30, 234431, 'female', '24aea63194d3f805f28a239fc88bf565.jpg', 11, '2015-03-09 06:08:54', 1, 'dfs', 0, 2, 1),
(88, 'dg', 456, 'jackets', 'Available', 6, 875, 76, 'female', 'eb02874b2406039e6615da3484f5c8be.jpg', 11, '2015-03-09 06:10:00', 0, 'gwegew', 0, 1, 0),
(89, 'j', 64, 'tees', 'Available', 45, 34544, 45, 'female', 'b6dddd7f966b4ed41ee022c05749b872.jpg', 11, '2015-03-09 06:10:48', 0, 'kjh', 0, 0, 0),
(90, 'fh', 98, 'tees', 'Available', 786, 876, 75, 'female', '2abff88ebf06ab1c188603a37a91364c.jpg', 11, '2015-03-09 06:11:34', 0, 'kjhk', 0, 0, 1),
(91, 'jkj', 897, 'jackets', 'Available', 87, 97, 87, 'female', '400c1b2e9501ce206af3bf656e5671c9.jpg', 11, '2015-03-09 06:13:29', 0, 'kjh', 0, 0, 0),
(92, 'gf', 768, 'jackets', 'Available', 897, 98, 87, 'female', '3d45d01037af28364ebd60eb90c9fae2.jpg', 11, '2015-03-09 06:14:16', 1, 'hgf', 0, 0, 0),
(93, 'ghg', 68, 'jackets', 'Available', 78, 9, 78, 'female', '7fc015ef03f8c56a2700ed495d0f0c08.jpg', 11, '2015-03-09 06:32:19', 0, 'jhgj', 0, 0, 0),
(94, 'hgj', 87, 'shoes', 'Available', 7, 876, 876, 'female', 'eb425414fe54acbc1e0b708af4a3a997.jpg', 11, '2015-03-09 06:32:46', 1, 'jhg', 0, 0, 0),
(95, 'h', 878, 'jackets', 'Available', 897, 99987, 987, 'male', '2dde809bffb4eb722ba2be7d75a99586.jpg', 11, '2015-03-09 06:34:48', 0, 'jhg', 0, 0, 0),
(96, 'hgj', 979, 'tees', 'Available', 87, 87, 87, 'male', '7f1a5a605da0555e765c1108e306f01a.jpg', 11, '2015-03-09 06:35:20', 1, 'jhg', 0, 0, 0),
(97, 'jh', 876, 'jackets', 'Available', 87, 87, 8768, 'male', '82094b5a40c893684cfcd3d1af4f34a0.jpg', 11, '2015-03-09 06:36:35', 1, 'kjh', 0, 0, 0),
(98, 'hjg', 687, 'tees', 'Available', 687, 876, 876, 'male', '1e7a01189b88f824e628d3e852da645b.jpg', 11, '2015-03-09 06:37:08', 1, 'jg', 0, 0, 0),
(99, 'hkj', 897, 'shoes', 'Available', 987, 87, 987, 'male', 'a26f8c655a79f640d509595e62943bcc.jpg', 11, '2015-03-09 06:39:29', 1, 'jhk', 0, 0, 0),
(100, 'j', 67, 'shoes', 'Available', 876, 886, 876, 'male', '1d2a45a7c707d3840496a193ae0b0a40.jpg', 11, '2015-03-09 06:41:09', 0, 'jhgj', 0, 0, 0),
(101, 'kjkj', 767, 'jackets', 'Available', 876, 87, 876, 'male', 'c3b9501f648e23be6fefa3ae0395dcfb.jpg', 11, '2015-03-09 06:42:54', 0, 'kh', 0, 0, 0),
(102, 'sfw', 7876, 'tees', 'Available', 7868, 78, 87687, 'male', '5a3a97da28b376dcf854ae88eb7e9158.jpg', 11, '2015-03-09 06:52:10', 0, 'bj', 0, 0, 0),
(103, 'jhg', 87687, 'shoes', 'Available', 876, 876, 87, 'male', 'a2f1832e6d662a60c599ea186773eb7a.jpg', 11, '2015-03-09 06:52:54', 0, 'hg', 0, 0, 0),
(104, 'hg', 876, 'jackets', 'Available', 876, 876, 876, 'male', 'e4d340f314e6275d6fd7de9827cb4be6.jpg', 11, '2015-03-09 06:53:13', 0, 'gjhg', 0, 0, 0),
(105, 'kjh', 7687, 'jackets', 'Available', 87, 6876, 876, 'male', '5424559aa4c40165d69186df9307818e.jpg', 11, '2015-03-09 06:54:33', 0, 'jhj', 0, 0, 0),
(106, 'jjhg', 876, 'jackets', 'Available', 765, 765, 765, 'male', 'b694018101a7b4aa58dff1f03a35648d.jpg', 11, '2015-03-09 06:54:55', 0, 'jhg', 0, 0, 0),
(107, 'jh', 876876, 'jackets', 'Available', 876, 876, 876, 'male', '0fda5327cc4e87e358fa6d8bf9187159.jpg', 11, '2015-03-09 07:00:53', 0, 'kkjh', 0, 0, 0),
(108, 'jhg', 765, 'jackets', 'Available', 76, 7, 765, 'male', 'e660f28ffde1699d7704b7d0da6343fa.jpg', 11, '2015-03-09 07:01:20', 0, 'jh', 0, 0, 0),
(109, 'kjh', 876, 'jackets', 'Available', 76, 576, 57, 'male', '7e50be412f0e3007f957685217a6ce4b.jpg', 11, '2015-03-09 07:02:13', 0, 'kjh', 0, 0, 0),
(110, 'hj', 75, 'jackets', 'Available', 65, 87, 875, 'male', '99bfd31bfe7d1e495ace85e0b150ce2d.jpg', 11, '2015-03-09 07:02:33', 0, 'hv', 0, 0, 0),
(111, 'jhg', 675, 'tees', 'Available', 87, 876, 87, 'male', '20bdbcf904dfedd584ce3374e588a388.jpg', 11, '2015-03-09 07:02:49', 0, 'jhg', 0, 0, 0),
(112, 'jhg', 765, 'shoes', 'Available', 876, 76, 576, 'male', '5d8b9da4a1f646421a406b066245d0ba.jpeg', 11, '2015-03-09 07:06:34', 0, 'jhg', 0, 0, 0),
(113, 'h', 657, 'tees', 'Available', 76, 87, 68, 'male', '661bf6e868b65ad4224dc9373e2bef4d.jpg', 11, '2015-03-09 07:07:07', 0, 'hg', 0, 0, 0),
(114, 'jhg', 765, 'tees', 'Available', 65, 75, 765, 'male', '5b9a939f48c9f58b26a69e1e1d45b23c.jpg', 11, '2015-03-09 07:07:26', 0, 'jhg', 0, 0, 0),
(115, 'jh', 0, 'tees', 'Available', 87, 876, 876, 'male', 'c9fc10fde7be234f12ee996ad3a5e36a.jpg', 11, '2015-03-09 07:07:56', 0, 'jh', 0, 0, 0),
(116, 'jhg', 786, 'jackets', 'Available', 786, 876, 876, 'male', 'a20f73a0efac24bf8a42d41f1e236e03.jpg', 11, '2015-03-09 07:08:19', 0, 'jhg', 0, 0, 0),
(117, 'ijhg', 987, 'shorts', 'Available', 97, 987, 98, 'male', 'f588de9ff24312a8a10a4c6f664c4832.jpg', 11, '2015-03-09 07:08:49', 0, 'kj', 0, 0, 0),
(118, 'jk', 87, 'tees', 'Available', 0, 876, 876, 'male', 'a38afd3e9d7aeac942053442ea068b0f.jpg', 11, '2015-03-09 07:09:14', 0, 'jh', 0, 0, 0),
(119, 'ih', 97, 'tees', 'Available', 76, 876, 876, 'female', '121ed6d13592468ece2dcaa4cfacf1d6.jpg', 11, '2015-03-09 07:09:35', 0, 'kjh', 0, 0, 0),
(120, 'jkh', 876, 'jackets', 'Available', 976, 876, 876, 'male', '558fc94341078a0dd7f67e86162b6fd1.jpg', 11, '2015-03-09 07:09:56', 0, 'kjh', 0, 0, 0),
(121, 'jhg', 786, 'jackets', 'Available', 87, 876, 876, 'male', '4b77d49313bafb0f613837170d182919.jpg', 11, '2015-03-09 07:10:21', 0, 'jhg', 0, 0, 0);

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
  `PurchasedDelivered` tinyint(1) NOT NULL,
  `card_number` varchar(30) NOT NULL,
  `card_expiration` varchar(10) NOT NULL,
  `secure_code` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`PurchasedID`, `PurchasedAmount`, `PurchasedQuantity`, `UserAccountID`, `AdminAccountID`, `PurchasedDate`, `PurchasedDelivered`, `card_number`, `card_expiration`, `secure_code`) VALUES
(10, 9999, 1, 10, NULL, '2015-03-10 07:38:17', 0, '12345', '2015-03-15', '4321');

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
(10, 84, 1, 'small');

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
(10, '02bb73b065823523de3249a79499736d.jpg', 'Lloric', 'Garcia', 'q', '7694f4a66316e53c8cdd9d9954bd611d', '03/15/1990', 'male', 'egot turno dipolog city', '09487761477', 'emorickfighter@yahoo.com', 'dipolog', 'q', '7694f4a66316e53c8cdd9d9954bd611d'),
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
MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
MODIFY `PurchasedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
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
