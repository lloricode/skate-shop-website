-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2015 at 08:06 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `UserAccountID`, `ProductID`, `CartPurchased`, `CartQuantity`, `CartItemSize`, `CartDateAdded`) VALUES
(23, 10, 84, 1, 1, 'small', '2015-03-28 12:15:18'),
(25, 10, 117, 1, 1, 'large', '2015-03-28 12:12:30'),
(28, 10, 109, 1, 1, 'small', '2015-03-28 11:36:17'),
(29, 10, 95, 1, 1, 'small', '2015-03-28 11:35:55'),
(30, 10, 95, 1, 1, 'small', '2015-03-28 12:15:18'),
(31, 10, 95, 0, 1, 'medium', '2015-03-28 12:13:34'),
(32, 10, 89, 1, 1, 'small', '2015-03-28 12:17:58'),
(33, 23, 84, 1, 1, 'small', '2015-03-28 13:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `DocumentID` int(11) NOT NULL,
  `DocumentCategory` varchar(20) NOT NULL,
  `DocumentValue` varchar(200) NOT NULL,
  `DocumentArrange` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`DocumentID`, `DocumentCategory`, `DocumentValue`, `DocumentArrange`) VALUES
(1, 'about', 'Lakas tama akoy nawawala qq', 1),
(2, 'about', 'hmmmmm wala lang hhehe qq', 2),
(3, 'lloric', 'Lloric Garcia''s details aa', 1),
(4, 'megan', 'Megan Torlao''s details aa', 1),
(5, 'contact title', '1NEW YORK BRANCH', 1),
(6, 'contact title', '2VANCOUVER BRANCH', 2),
(7, 'contact title', '3NEW ZEALAND BRANCH', 3),
(8, 'contact title', '4MANILA BRANCH', 4),
(10, 'contact value', '1lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum', 1),
(11, 'contact value', '2lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum', 2),
(12, 'contact value', '3lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum', 3),
(13, 'contact value', '4lorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsumlorem ipsum', 4);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`PaymentID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `PaymentShippingAddress` varchar(50) NOT NULL,
  `PaymentCardNumber` varchar(30) NOT NULL,
  `PaymentCardExpiration` varchar(10) NOT NULL,
  `PaymentSecureCode` varchar(30) NOT NULL,
  `PurchasedID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `UserAccountID`, `PaymentShippingAddress`, `PaymentCardNumber`, `PaymentCardExpiration`, `PaymentSecureCode`, `PurchasedID`) VALUES
(14, 10, 'JKGJ', '564', '2015-03-30', '65', 22),
(15, 10, 'HFH', '75765', '2015-03-30', '76576', 23),
(16, 10, 'jhg', '7876', '2015-03-30', '876', 24),
(17, 10, 'bjhg', '765875', '2015-03-31', '32', 25),
(18, 10, 'hjhg', '7657', '2015-03-30', '767', 26),
(19, 23, 'kh', '768', '2015-03-30', '78', 27);

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
  `UserAccountID` int(11) NOT NULL,
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

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductPrice`, `ProductType`, `ProductStatus`, `ProductAvailabilitySmall`, `ProductAvailabilityMedium`, `ProductAvailabilityLarge`, `ProductGender`, `ProductAttactment`, `UserAccountID`, `ProductDateAdded`, `ProductSale`, `ProductBrand`, `ProductSoldSmall`, `ProductSoldMedium`, `ProductSoldLarge`) VALUES
(83, 'lloriccaa', 8767, 'shoes', 'Available', 4, 6, 2, 'male', '977876fbc5889f4d323508aa88b9abc9.jpg', 25, '2015-02-24 01:46:14', 1, 'nova', 6, 4, 7),
(84, 'lira', 9999, 'shoes', 'Available', 0, 0, 0, 'male', '1a1064995548a9317f00784967226575.jpg', 10, '2015-02-24 19:07:13', 1, 'luba', 11, 1, 1),
(85, 'wer', 324, 'shoes', 'Available', 0, 0, 0, 'female', 'a40eedce43d22bf9112e63489606abc3.jpg', 10, '2015-03-05 19:00:17', 1, 'ewwet', 1, 2, 3),
(86, 'egerddfgd', 43534, 'jackets', 'Available', 19, 11, 319, 'female', '3ff532cec0d867c6469a9dabbaabfd45.jpg', 10, '2015-03-08 22:08:06', 0, 'rgdg', 2, 10, 4),
(87, 'sfssd', 2432, 'shoes', 'Available', 232, 30, 234429, 'female', '24aea63194d3f805f28a239fc88bf565.jpg', 10, '2015-03-08 22:08:54', 1, 'dfs', 2, 2, 3),
(88, 'dg', 456, 'jackets', 'Available', 4, 873, 74, 'female', 'eb02874b2406039e6615da3484f5c8be.jpg', 10, '2015-03-08 22:10:00', 0, 'gwegew', 2, 3, 2),
(89, 'j', 64, 'tees', 'Available', 44, 34544, 45, 'female', 'b6dddd7f966b4ed41ee022c05749b872.jpg', 10, '2015-03-08 22:10:48', 0, 'kjh', 1, 0, 0),
(90, 'fh', 98, 'tees', 'Available', 784, 871, 73, 'female', '2abff88ebf06ab1c188603a37a91364c.jpg', 10, '2015-03-08 22:11:34', 0, 'kjhk', 2, 5, 3),
(91, 'jkj', 897, 'jackets', 'Available', 86, 96, 87, 'female', '400c1b2e9501ce206af3bf656e5671c9.jpg', 10, '2015-03-08 22:13:29', 0, 'kjh', 1, 1, 0),
(92, 'gf', 768, 'jackets', 'Available', 897, 98, 87, 'female', '3d45d01037af28364ebd60eb90c9fae2.jpg', 10, '2015-03-08 22:14:16', 1, 'hgf', 0, 0, 0),
(93, 'ghg', 68, 'jackets', 'Available', 76, 9, 78, 'female', '7fc015ef03f8c56a2700ed495d0f0c08.jpg', 10, '2015-03-08 22:32:19', 0, 'jhgj', 2, 0, 0),
(94, 'hgj', 87, 'shoes', 'Available', 2, 876, 876, 'female', 'eb425414fe54acbc1e0b708af4a3a997.jpg', 10, '2015-03-08 22:32:46', 1, 'jhg', 5, 0, 0),
(95, 'h', 878, 'jackets', 'Available', 895, 99987, 987, 'male', '2dde809bffb4eb722ba2be7d75a99586.jpg', 10, '2015-03-08 22:34:48', 0, 'jhg', 2, 0, 0),
(96, 'hgj', 979, 'tees', 'Available', 87, 87, 87, 'male', '7f1a5a605da0555e765c1108e306f01a.jpg', 10, '2015-03-08 22:35:20', 1, 'jhg', 0, 0, 0),
(97, 'jh', 876, 'jackets', 'Available', 87, 87, 8768, 'male', '82094b5a40c893684cfcd3d1af4f34a0.jpg', 10, '2015-03-08 22:36:35', 1, 'kjh', 0, 0, 0),
(98, 'hjg', 687, 'tees', 'Available', 687, 875, 876, 'male', '1e7a01189b88f824e628d3e852da645b.jpg', 10, '2015-03-08 22:37:08', 1, 'jg', 0, 1, 0),
(99, 'hkj', 897, 'shoes', 'Available', 987, 87, 987, 'male', 'a26f8c655a79f640d509595e62943bcc.jpg', 10, '2015-03-08 22:39:29', 1, 'jhk', 0, 0, 0),
(100, 'j', 67, 'shoes', 'Available', 876, 886, 876, 'male', '1d2a45a7c707d3840496a193ae0b0a40.jpg', 10, '2015-03-08 22:41:09', 0, 'jhgj', 0, 0, 0),
(101, 'kjkj', 767, 'jackets', 'Available', 875, 87, 876, 'male', 'c3b9501f648e23be6fefa3ae0395dcfb.jpg', 10, '2015-03-08 22:42:54', 0, 'kh', 1, 0, 0),
(102, 'sfw', 7876, 'tees', 'Available', 7868, 78, 87687, 'male', '5a3a97da28b376dcf854ae88eb7e9158.jpg', 10, '2015-03-08 22:52:10', 0, 'bj', 0, 0, 0),
(103, 'jhg', 87687, 'shoes', 'Available', 876, 876, 87, 'male', 'a2f1832e6d662a60c599ea186773eb7a.jpg', 10, '2015-03-08 22:52:54', 0, 'hg', 0, 0, 0),
(104, 'hg', 876, 'jackets', 'Available', 876, 876, 876, 'male', 'e4d340f314e6275d6fd7de9827cb4be6.jpg', 10, '2015-03-08 22:53:13', 0, 'gjhg', 0, 0, 0),
(105, 'kjh', 7687, 'jackets', 'Available', 87, 6876, 876, 'male', '5424559aa4c40165d69186df9307818e.jpg', 10, '2015-03-08 22:54:33', 0, 'jhj', 0, 0, 0),
(106, 'jjhg', 876, 'jackets', 'Available', 765, 765, 765, 'male', 'b694018101a7b4aa58dff1f03a35648d.jpg', 10, '2015-03-08 22:54:55', 0, 'jhg', 0, 0, 0),
(107, 'jh', 876876, 'jackets', 'Available', 876, 876, 876, 'male', '0fda5327cc4e87e358fa6d8bf9187159.jpg', 10, '2015-03-08 23:00:53', 0, 'kkjh', 0, 0, 0),
(108, 'jhg', 765, 'jackets', 'Available', 76, 7, 765, 'male', 'e660f28ffde1699d7704b7d0da6343fa.jpg', 10, '2015-03-08 23:01:20', 0, 'jh', 0, 0, 0),
(109, 'kjh', 876, 'jackets', 'Available', 75, 576, 57, 'male', '7e50be412f0e3007f957685217a6ce4b.jpg', 10, '2015-03-08 23:02:13', 0, 'kjh', 1, 0, 0),
(110, 'hj', 75, 'jackets', 'Available', 65, 87, 875, 'male', '99bfd31bfe7d1e495ace85e0b150ce2d.jpg', 10, '2015-03-08 23:02:33', 0, 'hv', 0, 0, 0),
(111, 'jhg', 675, 'tees', 'Available', 87, 876, 87, 'male', '20bdbcf904dfedd584ce3374e588a388.jpg', 10, '2015-03-08 23:02:49', 0, 'jhg', 0, 0, 0),
(112, 'jhg', 765, 'shoes', 'Available', 876, 76, 576, 'male', '5d8b9da4a1f646421a406b066245d0ba.jpeg', 10, '2015-03-08 23:06:34', 0, 'jhg', 0, 0, 0),
(113, 'h', 657, 'tees', 'Available', 76, 87, 68, 'male', '661bf6e868b65ad4224dc9373e2bef4d.jpg', 10, '2015-03-08 23:07:07', 0, 'hg', 0, 0, 0),
(114, 'jhg', 765, 'tees', 'Available', 65, 75, 765, 'male', '5b9a939f48c9f58b26a69e1e1d45b23c.jpg', 10, '2015-03-08 23:07:26', 0, 'jhg', 0, 0, 0),
(115, 'jh', 0, 'tees', 'Available', 87, 876, 876, 'male', 'c9fc10fde7be234f12ee996ad3a5e36a.jpg', 10, '2015-03-08 23:07:56', 0, 'jh', 0, 0, 0),
(116, 'jhg', 786, 'jackets', 'Available', 786, 876, 876, 'male', 'a20f73a0efac24bf8a42d41f1e236e03.jpg', 10, '2015-03-08 23:08:19', 0, 'jhg', 0, 0, 0),
(117, 'ijhg', 987, 'shorts', 'Available', 95, 987, 97, 'male', 'f588de9ff24312a8a10a4c6f664c4832.jpg', 10, '2015-03-08 23:08:49', 0, 'kj', 2, 0, 1),
(118, 'jk', 87, 'tees', 'Available', 0, 876, 876, 'male', 'a38afd3e9d7aeac942053442ea068b0f.jpg', 10, '2015-03-08 23:09:14', 0, 'jh', 0, 0, 0),
(119, 'ih', 97, 'tees', 'Available', 76, 876, 876, 'female', '121ed6d13592468ece2dcaa4cfacf1d6.jpg', 10, '2015-03-08 23:09:35', 0, 'kjh', 0, 0, 0),
(120, 'jkh', 876, 'jackets', 'Available', 976, 876, 876, 'male', '558fc94341078a0dd7f67e86162b6fd1.jpg', 10, '2015-03-08 23:09:56', 0, 'kjh', 0, 0, 0),
(121, 'jhg', 786, 'jackets', 'Available', 87, 876, 876, 'male', '4b77d49313bafb0f613837170d182919.jpg', 10, '2015-03-08 23:10:21', 0, 'jhg', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchased`
--

CREATE TABLE IF NOT EXISTS `purchased` (
`PurchasedID` int(11) NOT NULL,
  `PurchasedAmount` double NOT NULL,
  `PurchasedQuantity` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `PurchasedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PurchasedDelivered` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`PurchasedID`, `PurchasedAmount`, `PurchasedQuantity`, `UserAccountID`, `PurchasedDate`, `PurchasedDelivered`) VALUES
(22, 878, 1, 10, '2015-03-28 12:11:40', 1),
(23, 876, 1, 10, '2015-03-28 12:11:24', 1),
(24, 987, 1, 10, '2015-03-28 12:17:04', 1),
(25, 10877, 2, 10, '2015-03-28 12:16:27', 1),
(26, 64, 1, 10, '2015-03-28 12:17:57', 0),
(27, 9999, 1, 23, '2015-03-28 13:11:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedapproved`
--

CREATE TABLE IF NOT EXISTS `purchasedapproved` (
`PurchasedApprovedID` int(11) NOT NULL,
  `PurchasedID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `PurchasedApprovedStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedapproved`
--

INSERT INTO `purchasedapproved` (`PurchasedApprovedID`, `PurchasedID`, `UserAccountID`, `PurchasedApprovedStatus`) VALUES
(10, 23, 10, 0),
(11, 22, 10, 1),
(12, 25, 10, 1),
(13, 24, 10, 0),
(14, 27, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedline`
--

CREATE TABLE IF NOT EXISTS `purchasedline` (
`PurchasedLineID` int(11) NOT NULL,
  `PurchasedID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Size` enum('small','medium','large') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedline`
--

INSERT INTO `purchasedline` (`PurchasedLineID`, `PurchasedID`, `CartID`, `Quantity`, `Size`) VALUES
(19, 22, 29, 1, 'small'),
(20, 23, 28, 1, 'small'),
(21, 24, 25, 1, 'large'),
(22, 25, 23, 1, 'small'),
(23, 25, 30, 1, 'small'),
(24, 26, 32, 1, 'small'),
(25, 27, 33, 1, 'small');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE IF NOT EXISTS `useraccount` (
`UserAccountID` int(11) NOT NULL,
  `UserAccountImage` varchar(60) NOT NULL,
  `UserAccountFirstName` varchar(20) NOT NULL,
  `UserAccountLastName` varchar(20) NOT NULL,
  `UserAccountUserName` varchar(20) NOT NULL,
  `UserAccountPassword` varchar(60) NOT NULL,
  `UserAccountBD` varchar(10) NOT NULL,
  `UserAccountGender` enum('female','male') NOT NULL,
  `UserAccountHomeAddress` varchar(60) NOT NULL,
  `UserAccountMobile` varchar(20) NOT NULL,
  `UserAccountEmail` varchar(50) NOT NULL,
  `UserAccountSecretQuestion` varchar(20) NOT NULL,
  `UserAccountAnswer` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`UserAccountID`, `UserAccountImage`, `UserAccountFirstName`, `UserAccountLastName`, `UserAccountUserName`, `UserAccountPassword`, `UserAccountBD`, `UserAccountGender`, `UserAccountHomeAddress`, `UserAccountMobile`, `UserAccountEmail`, `UserAccountSecretQuestion`, `UserAccountAnswer`) VALUES
(7, 'male.png', 'll', 'll', 'll', '0cc175b9c0f1b6a831c399e269772661', '02/17/2015', 'male', 'hh', '766', 'hh@yahoo.com', 'hh', '5e36941b3d856737e81516acd45edc50'),
(8, 'female.png', 'bb', 'bb', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c', '02/17/2015', 'female', 'bb', '88', 'bb@yahoo.com', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c'),
(9, 'male.png', 'mm', 'mm', 'mm', 'b3cd915d758008bd19d0f2428fbb354a', '02/17/2015', 'male', 'mm', '88', 'mm@yahoo.com', 'mm', 'b3cd915d758008bd19d0f2428fbb354a'),
(10, '02bb73b065823523de3249a79499736d.jpg', 'Lloric', 'Garcia', 'q', '7694f4a66316e53c8cdd9d9954bd611d', '03/15/1990', 'male', 'egot turno dipolog city', '09487761477', 'emorickfighter@yahoo.com', 'q', '7694f4a66316e53c8cdd9d9954bd611d'),
(11, 'male.png', 'ard', 'moses', 'ardmoses', 'e10adc3949ba59abbe56e057f20f883e', '02/17/2015', 'male', 'asdsadasdasd', '12323123123', 'aasdasdasd@yahoo.com', 'ard', '4ce0bec67fe735f4997426101dd5292b'),
(12, 'male.png', 'z', 'z', 'z', 'fbade9e36a3f36d3d676c1b808451dd7', '02/17/2015', 'male', 'z', '11', 'z@yahoo.com', 'z', 'fbade9e36a3f36d3d676c1b808451dd7'),
(13, 'female.png', 'Jerald', 'Buljatin', 'jeraldin', '97784fec6e2313cf5f1d7ffac21c7098', '02/17/2015', 'female', 'Me Bang, Dipolog City', '09213456789', 'jeraldin@yahoo.com', 'What name?', '8b80876f51614e59f3224af17b48aa9b'),
(14, 'female.png', 'dvx', 'dfhb', 'angel', 'f4f068e71e0d87bf0ad51e6214ab84e9', '02/17/2015', 'female', 'katipnan', '0909', 'angle@yahoo.com', 'aa', '4124bc0a9335c27f086f24ba207a4912'),
(15, 'female.png', 'Amie', 'Ongayo', 'amie', 'e6a4370aca6970175dee8c72cc7e08dc', '02/17/2015', 'female', 'qq', '9878', 'amie@yahoo.com', 't', 'e358efa489f58062f10dd7316b65649e'),
(16, 'male.png', 'aa', 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912', '02/17/2015', 'male', 'aa', '11', 'aa@yahoo.com', 'aa', '4124bc0a9335c27f086f24ba207a4912'),
(23, 'female.png', 'm', 'm', 'm', '6f8f57715090da2632453988d9a1501b', '1990-03-24', 'female', 'm', '9', 'm@m.m', 'm', '6f8f57715090da2632453988d9a1501b'),
(25, 'male.png', 'kk', 'kk', 'kk', 'dc468c70fb574ebd07287b38d0d0676d', '1990-03-24', 'male', 'kk', '9090', 'kk@k.k', 'kk', 'dc468c70fb574ebd07287b38d0d0676d');

-- --------------------------------------------------------

--
-- Table structure for table `useraccountaccess`
--

CREATE TABLE IF NOT EXISTS `useraccountaccess` (
`UserAccountAccessID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `UserAccountAccessValue` enum('admin','editor') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccountaccess`
--

INSERT INTO `useraccountaccess` (`UserAccountAccessID`, `UserAccountID`, `UserAccountAccessValue`) VALUES
(1, 10, 'admin'),
(3, 25, 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounttype`
--

CREATE TABLE IF NOT EXISTS `useraccounttype` (
`UserAccountTypeID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `UserAccountTypeValue` enum('admin','user') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccounttype`
--

INSERT INTO `useraccounttype` (`UserAccountTypeID`, `UserAccountID`, `UserAccountTypeValue`) VALUES
(1, 10, 'admin'),
(22, 7, 'user'),
(23, 8, 'user'),
(24, 9, 'user'),
(25, 11, 'user'),
(26, 12, 'user'),
(27, 13, 'user'),
(28, 14, 'user'),
(29, 15, 'user'),
(34, 16, 'user'),
(35, 23, 'user'),
(37, 25, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
  `id` int(11) NOT NULL,
  `doc` varchar(100) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`id`, `doc`, `count`) VALUES
(1, 'index.php', 56),
(2, 'store.php?query=all', 120),
(3, 'store.php?query=all&page=2', 5),
(4, 'about.php', 19),
(5, 'login.php?about.php', 2),
(6, 'contact.php', 17),
(7, 'mycart.php?query=all', 149),
(8, 'login.php?mycart.php?query=all', 14),
(9, 'cart.php?query=all&file=83', 6),
(10, 'mycart.php?query=all&file=83', 1),
(11, 'cart.php?query=all&file=83&file=83', 3),
(12, 'mycart.php?query=all&file=83&file=83', 7),
(13, 'fillcheckout.php', 10),
(14, 'store.php?search=l', 2),
(15, 'store.php?search=ll', 2),
(16, 'store.php?search=lll', 1),
(17, 'cart.php?query=all&file=90', 7),
(18, 'cart.php?query=all&file=90&file=90', 5),
(19, 'mycart.php?query=all&file=90&file=90', 25),
(20, 'mycart.php?query=all&del=31', 1),
(21, 'store.php?query=all&del=31', 1),
(22, 'cart.php?query=all&del=31&file=86', 1),
(23, 'cart.php?query=all&del=31&file=86&file=86', 1),
(24, 'mycart.php?query=all&del=31&file=86&file=86', 2),
(25, 'cart.php?query=all&file=86', 6),
(26, 'cart.php?query=all&file=86&file=86', 6),
(27, 'mycart.php?query=all&file=86&file=86', 45),
(28, 'mycart.php?query=all&file=86&file=86&del=34', 1),
(29, 'store.php?query=all&file=86&file=86&del=34', 1),
(30, 'cart.php?query=all&file=86&file=86&del=34&file=87', 1),
(31, 'cart.php?query=all&file=86&file=86&del=34&file=87&file=87', 1),
(32, 'mycart.php?query=all&file=86&file=86&del=34&file=87&file=87', 2),
(33, 'mycart.php', 241),
(34, 'store.php', 1),
(35, 'store.php?query=all&file=90&file=90', 1),
(36, 'cart.php?query=all&file=90&file=90&file=84', 1),
(37, 'cart.php?query=all&file=90&file=90&file=84&file=84', 1),
(38, 'mycart.php?query=all&file=90&file=90&file=84&file=84', 6),
(39, 'store.php?query=all&cat=jackets', 3),
(40, 'cart.php?query=all&cat=jackets&file=101', 1),
(41, 'cart.php?query=all&cat=jackets&file=101&file=101', 1),
(42, 'mycart.php?query=all&cat=jackets&file=101&file=101', 3),
(43, 'cart.php?query=all&file=87', 4),
(44, 'cart.php?query=all&file=87&file=87', 4),
(45, 'store.php?query=all&file=87&file=87', 1),
(46, 'cart.php?query=all&file=87&file=87&file=88', 1),
(47, 'cart.php?query=all&file=87&file=87&file=88&file=88', 1),
(48, 'mycart.php?query=all&file=87&file=87&file=88&file=88', 3),
(49, 'cart.php?query=all&file=84', 3),
(50, 'cart.php?query=all&file=84&file=84', 1),
(51, 'store.php?query=all&file=84&file=84', 1),
(52, 'cart.php?query=all&file=84&file=84&file=90', 1),
(53, 'cart.php?query=all&file=84&file=84&file=90&file=90', 1),
(54, 'mycart.php?query=all&file=84&file=84&file=90&file=90', 3),
(55, 'cart.php?query=all&file=88', 1),
(56, 'cart.php?query=all&file=88&file=88', 1),
(57, 'store.php?query=all&file=88&file=88', 1),
(58, 'cart.php?query=all&file=88&file=88&file=86', 1),
(59, 'cart.php?query=all&file=88&file=88&file=86&file=86', 1),
(60, 'mycart.php?query=all&file=88&file=88&file=86&file=86', 3),
(61, 'store.php?query=all&file=86&file=86', 1),
(62, 'cart.php?query=all&file=86&file=86&file=91', 1),
(63, 'cart.php?query=all&file=86&file=86&file=91&file=91', 1),
(64, 'store.php?query=all&file=86&file=86&file=91&file=91', 1),
(65, 'cart.php?query=all&page=2&file=98', 1),
(66, 'cart.php?query=all&page=2&file=98&file=98', 1),
(67, 'mycart.php?query=all&page=2&file=98&file=98', 3),
(68, 'mycart.php?query=all&file=87&file=87', 5),
(69, 'cart.php?query=all&file=87&file=87&file=87', 1),
(70, 'mycart.php?query=all&file=87&file=87&file=87', 3),
(71, 'cart.php?query=all&page=2&file=95', 1),
(72, 'cart.php?query=all&page=2&file=95&file=95', 1),
(73, 'cart.php?query=all&page=2&file=95&file=95&file=95', 1),
(74, 'mycart.php?query=all&page=2&file=95&file=95&file=95', 1),
(75, 'mycart.php?query=all&page=2&file=95&file=95&file=95&del=55', 1),
(76, 'mycart.php?query=all&page=2&file=95&file=95&file=95&del=55&del=54', 1),
(77, 'login.php?index.php', 21),
(78, 'store.php?query=female', 1),
(79, 'store.php?query=female&cat=jeans', 1),
(80, 'login.php?cart.php?query=all&file=84', 2),
(81, 'mycart.php?query=all&file=84', 2),
(82, 'store.php?query=all&file=83', 2),
(83, 'cart.php?query=all&file=83&file=84', 1),
(84, 'cart.php?query=all&file=83&file=88', 1),
(85, 'cart.php?query=all&file=83&file=88&file=88', 1),
(86, 'mycart.php?query=all&file=83&file=88&file=88', 4),
(87, 'mycart.php?query=all&del=56', 1),
(88, 'mycart.php?query=all&del=56&del=58', 1),
(89, 'mycart.php?query=all&del=56&del=58&del=59', 1),
(90, 'cart.php?query=all&file=91', 1),
(91, 'cart.php?query=all&file=91&file=91', 1),
(92, 'mycart.php?query=all&file=91&file=91', 2),
(93, 'login.php?cart.php?query=all&file=90', 2),
(94, 'mycart.php?query=all&file=90', 2),
(95, 'login.php?mycart.php?query=all&file=86&file=86', 1),
(96, 'mycart.php?query=all?query=all', 12),
(97, 'mycart.php?query=all?query=all?query=all?query=all', 2),
(98, 'mycart.php?query=all?query=all?query=all?query=all?query=all?query=all?query=all?query=all', 2),
(99, 'mycart.php?query=all?query=all?query=all?query=all?query=all?query=all?query=all?query=all?query=all', 1),
(100, 'mycart.php?query=all&file=83&file=83?query=all&file=83&file=83', 1),
(101, 'mycart.php?query=all&file=87&file=87?query=all&file=87&file=87', 1),
(102, 'mycart.php?query=all&file=86&file=86?query=all&file=86&file=86', 1),
(103, 'mycart.php?query=all&file=90&file=90?query=all&file=90&file=90', 1),
(0, 'login.php?store.php?query=all', 2),
(0, 'setting.php', 3),
(0, 'profile.php', 16),
(0, 'cart.php?&file=94', 2),
(0, 'cart.php?file=94', 1),
(0, 'cart.php?&file=84', 8),
(0, 'mycart.php?&del=2', 1),
(0, 'cart.php?&file=83', 5),
(0, 'mycart.php??', 1),
(0, 'mycart.php????', 1),
(0, 'mycart.php????????', 1),
(0, 'mycart.php????????????????', 1),
(0, 'mycart.php????????????????????????????????', 1),
(0, 'mycart.php????????????????????????????????????????????????????????????????', 2),
(0, 'mycart.php?&del=4', 1),
(0, 'cart.php?&file=88', 2),
(0, 'login.php?mycart.php', 4),
(0, 'mycart.php?page=2', 4),
(0, 'mycart.php?page=1', 1),
(0, 'cart.php?&file=93', 1),
(0, 'cart.php?&file=86', 2),
(0, 'store.php?query=all&cat=shorts', 4),
(0, 'cart.php?&file=117', 4),
(0, 'cart.php?file=117', 1),
(0, 'mycart.php?&del=21', 1),
(0, 'mycart.php?&del=24', 1),
(0, 'store.php?query=male', 6),
(0, 'store.php?query=male&cat=jackets', 7),
(0, 'cart.php?&file=104', 1),
(0, 'cart.php?&file=109', 2),
(0, 'mycart.php?&del=27', 1),
(0, 'mycart.php?&del=26', 1),
(0, 'cart.php?&file=95', 2),
(0, 'cart.php?&file=89', 1),
(0, 'signup.php', 23),
(0, 'recovery.php', 4),
(0, 'ans.php', 2),
(0, 'resetpass.php', 2),
(0, 'login.php', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`CartID`), ADD KEY `fk_cart_product` (`ProductID`), ADD KEY `fk_cart_useraccount` (`UserAccountID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`PaymentID`), ADD KEY `fk_payment_useraccount` (`UserAccountID`), ADD KEY `fk_payment_purchased` (`PurchasedID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`ProductID`), ADD KEY `fk__product_useraccount` (`UserAccountID`);

--
-- Indexes for table `purchased`
--
ALTER TABLE `purchased`
 ADD PRIMARY KEY (`PurchasedID`), ADD KEY `fk_purchased_useraccount` (`UserAccountID`);

--
-- Indexes for table `purchasedapproved`
--
ALTER TABLE `purchasedapproved`
 ADD PRIMARY KEY (`PurchasedApprovedID`), ADD KEY `fk_purchasedapproved_purchased` (`PurchasedID`), ADD KEY `fk_purchasedapproved_useraccount` (`UserAccountID`);

--
-- Indexes for table `purchasedline`
--
ALTER TABLE `purchasedline`
 ADD PRIMARY KEY (`PurchasedLineID`), ADD KEY `fk_purchasedline_cart` (`CartID`), ADD KEY `fk_purchasedline_purchased` (`PurchasedID`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
 ADD PRIMARY KEY (`UserAccountID`), ADD UNIQUE KEY `UserAccountUserName` (`UserAccountUserName`);

--
-- Indexes for table `useraccountaccess`
--
ALTER TABLE `useraccountaccess`
 ADD PRIMARY KEY (`UserAccountAccessID`), ADD KEY `fk_useraccountaccess_useraccount` (`UserAccountID`);

--
-- Indexes for table `useraccounttype`
--
ALTER TABLE `useraccounttype`
 ADD PRIMARY KEY (`UserAccountTypeID`), ADD KEY `fk_useraccounttype_useraccount` (`UserAccountID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
MODIFY `PurchasedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `purchasedapproved`
--
ALTER TABLE `purchasedapproved`
MODIFY `PurchasedApprovedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `purchasedline`
--
ALTER TABLE `purchasedline`
MODIFY `PurchasedLineID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
MODIFY `UserAccountID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `useraccountaccess`
--
ALTER TABLE `useraccountaccess`
MODIFY `UserAccountAccessID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `useraccounttype`
--
ALTER TABLE `useraccounttype`
MODIFY `UserAccountTypeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
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
-- Constraints for table `payment`
--
ALTER TABLE `payment`
ADD CONSTRAINT `fk_payment_purchased` FOREIGN KEY (`PurchasedID`) REFERENCES `purchased` (`PurchasedID`),
ADD CONSTRAINT `fk_payment_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `fk__product_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

--
-- Constraints for table `purchased`
--
ALTER TABLE `purchased`
ADD CONSTRAINT `fk_purchased_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

--
-- Constraints for table `purchasedapproved`
--
ALTER TABLE `purchasedapproved`
ADD CONSTRAINT `fk_purchasedapproved_purchased` FOREIGN KEY (`PurchasedID`) REFERENCES `purchased` (`PurchasedID`),
ADD CONSTRAINT `fk_purchasedapproved_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

--
-- Constraints for table `purchasedline`
--
ALTER TABLE `purchasedline`
ADD CONSTRAINT `fk_purchasedline_cart` FOREIGN KEY (`CartID`) REFERENCES `cart` (`CartID`),
ADD CONSTRAINT `fk_purchasedline_purchased` FOREIGN KEY (`PurchasedID`) REFERENCES `purchased` (`PurchasedID`);

--
-- Constraints for table `useraccountaccess`
--
ALTER TABLE `useraccountaccess`
ADD CONSTRAINT `fk_useraccountaccess_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

--
-- Constraints for table `useraccounttype`
--
ALTER TABLE `useraccounttype`
ADD CONSTRAINT `fk_useraccounttype_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
