-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2015 at 11:54 PM
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
  `CartItemSize` varchar(20) NOT NULL,
  `CartDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `UserAccountID`, `ProductID`, `CartPurchased`, `CartQuantity`, `CartItemSize`, `CartDateAdded`) VALUES
(83, 12, 83, 1, 1, '56', '2015-04-05 10:04:28'),
(84, 12, 91, 1, 2, 'medium', '2015-04-05 10:12:16'),
(85, 12, 89, 1, 1, 'ttt', '2015-04-05 10:13:41'),
(86, 12, 94, 1, 13, 'ttt', '2015-04-05 10:24:51'),
(87, 12, 88, 1, 1, 'small', '2015-04-06 04:46:05'),
(88, 12, 88, 0, 2, 'medium', '2015-04-06 04:45:43'),
(89, 10, 91, 1, 2, 'super medium', '2015-04-06 08:58:20'),
(90, 10, 83, 1, 1, '10', '2015-04-08 06:43:13'),
(91, 10, 88, 1, 1, 'medium', '2015-04-08 06:43:13'),
(92, 28, 83, 1, 2, '10', '2015-04-09 05:57:08'),
(93, 28, 84, 1, 3, '54', '2015-04-09 05:57:08'),
(94, 28, 90, 0, 2, 'ttt', '2015-04-09 05:55:05'),
(95, 7, 86, 1, 12, 'extra large', '2015-04-09 06:05:53'),
(96, 7, 83, 0, 5, '10', '2015-04-09 06:10:45'),
(97, 10, 85, 1, 1, '10', '2015-04-09 22:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
`DocumentID` int(11) NOT NULL,
  `DocumentCategory` varchar(20) NOT NULL,
  `DocumentValue` varchar(500) NOT NULL,
  `DocumentArrange` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`DocumentID`, `DocumentCategory`, `DocumentValue`, `DocumentArrange`) VALUES
(1, 'about', 'The SkateShop was established in 2012.Within its first year of business the we were able to open two more branches in Brooklyn, New York.', 1),
(2, 'about', 'Our stores cater to the masses providing easier access for people to obtain our products in places where we do not have branches yet.', 2),
(3, 'lloric', 'Lloric Garcia graduated Suma Cum Laude with the degree of Computer Science majoring in Programming. He has created and co-created many websites an had worked in many IT \\\\r\\\\ncompanies...Google, Facebook, Twitter just to name a few.', 1),
(4, 'megan', 'Megan Torlao,a.k.a Curiousamurai, is a freelance graphic designer. In 2012, she graduated with the degree in Information Technology majoring in Graphic designing. She is a freelance graphic designer and has worked with animation companies.', 1),
(5, 'contact title', 'Manila', 1),
(6, 'contact title', 'Cebu', 2),
(7, 'contact title', 'Dipolog', 3),
(8, 'contact title', 'Makati', 4),
(10, 'contact value', '144 Hitchcock Rd, Salinas, CA 93908 - Physical\r\n222 Lincoln Ave, Salinas, CA 93901 - Mailing', 1),
(11, 'contact value', '5064 Cinder Embers Via, Kalamazoo, Indiana, 46027-6415, US, (765) 335-3397', 2),
(12, 'contact value', '2823 Crystal Jetty, Minitonas, Indiana, 47921-7202, US, (574) 946-1749', 3),
(13, 'contact value', '8326 Middle Log Bay, Wawa, Nevada, 89080-6532, US, (775) 618-6506Lapu Lapu st.', 4),
(14, 'about', 'We also provide a easier access and better service with our inventory to home for our customers. Also we provide faster delivery service through our competent delivery employees', 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `UserAccountID`, `PaymentShippingAddress`, `PaymentCardNumber`, `PaymentCardExpiration`, `PaymentSecureCode`, `PurchasedID`) VALUES
(4, 12, 'sprikiwi lab', '112', '2015-04-07', '567', 55),
(5, 12, 'ij', '987', '2015-04-14', '87', 56),
(6, 12, 'klk', '98', '2015-04-24', '9', 57),
(7, 12, 'hg', '87', '2015-04-16', '76', 58),
(8, 12, 'hjgfhgf', '653', '2015-04-29', '6576', 59),
(9, 10, 'dfgfg', '24', '2015-04-15', '234', 60),
(10, 10, 'rili', '876', '2015-04-15', '323', 61),
(11, 28, 'jhgjhg', '65', '2015-04-28', '456564', 62),
(12, 7, 'fhgf', '464', '2015-04-21', '34534', 63),
(13, 10, 'jhg', '876', '2015-04-20', '78', 64);

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
  `ProductGender` enum('male','female','both') NOT NULL,
  `ProductAttactment` varchar(100) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `ProductDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ProductSale` tinyint(1) NOT NULL,
  `ProductBrand` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `ProductPrice`, `ProductType`, `ProductStatus`, `ProductGender`, `ProductAttactment`, `UserAccountID`, `ProductDateAdded`, `ProductSale`, `ProductBrand`) VALUES
(83, 'jjj', 8767, 'shoes', 'Available', 'male', '977876fbc5889f4d323508aa88b9abc9.jpg', 10, '2015-02-24 01:46:14', 1, 'nova'),
(84, 'lira', 9999, 'shoes', 'Available', 'male', '1a1064995548a9317f00784967226575.jpg', 10, '2015-02-24 19:07:13', 1, 'luba'),
(85, 'wer', 324, 'shoes', 'Available', 'female', 'a40eedce43d22bf9112e63489606abc3.jpg', 10, '2015-03-05 19:00:17', 1, 'ewwet'),
(86, 'egerddfgd', 43534, 'jackets', 'Available', 'female', '3ff532cec0d867c6469a9dabbaabfd45.jpg', 10, '2015-03-08 22:08:06', 0, 'rgdg'),
(87, 'sfssd', 2432, 'shoes', 'Available', 'female', '24aea63194d3f805f28a239fc88bf565.jpg', 10, '2015-03-08 22:08:54', 1, 'dfs'),
(88, 'dg', 456, 'jackets', 'Available', 'female', 'eb02874b2406039e6615da3484f5c8be.jpg', 10, '2015-03-08 22:10:00', 0, 'gwegew'),
(89, 'j', 64, 'tees', 'Available', 'female', 'b6dddd7f966b4ed41ee022c05749b872.jpg', 10, '2015-03-08 22:10:48', 0, 'kjh'),
(90, 'fh', 98, 'tees', 'Available', 'female', '2abff88ebf06ab1c188603a37a91364c.jpg', 10, '2015-03-08 22:11:34', 0, 'kjhk'),
(91, 'jkj', 897, 'jackets', 'Available', 'female', '400c1b2e9501ce206af3bf656e5671c9.jpg', 10, '2015-03-08 22:13:29', 0, 'kjh'),
(92, 'gf', 768, 'jackets', 'Available', 'female', '3d45d01037af28364ebd60eb90c9fae2.jpg', 10, '2015-03-08 22:14:16', 1, 'hgf'),
(93, 'ghg', 68, 'jackets', 'Available', 'female', '7fc015ef03f8c56a2700ed495d0f0c08.jpg', 10, '2015-03-08 22:32:19', 0, 'jhgj'),
(94, 'hgj', 87, 'shoes', 'Available', 'female', 'eb425414fe54acbc1e0b708af4a3a997.jpg', 10, '2015-03-08 22:32:46', 1, 'jhg'),
(95, 'h', 878, 'jackets', 'Available', 'male', '2dde809bffb4eb722ba2be7d75a99586.jpg', 10, '2015-03-08 22:34:48', 0, 'jhg'),
(96, 'hgj', 979, 'tees', 'Available', 'male', '7f1a5a605da0555e765c1108e306f01a.jpg', 10, '2015-03-08 22:35:20', 1, 'jhg'),
(97, 'jh', 876, 'jackets', 'Available', 'male', '82094b5a40c893684cfcd3d1af4f34a0.jpg', 10, '2015-03-08 22:36:35', 1, 'kjh'),
(98, 'hjg', 687, 'tees', 'Available', 'male', '1e7a01189b88f824e628d3e852da645b.jpg', 10, '2015-03-08 22:37:08', 1, 'jg'),
(99, 'hkj', 897, 'shoes', 'Available', 'male', 'a26f8c655a79f640d509595e62943bcc.jpg', 10, '2015-03-08 22:39:29', 1, 'jhk'),
(100, 'j', 67, 'shoes', 'Available', 'male', '1d2a45a7c707d3840496a193ae0b0a40.jpg', 10, '2015-03-08 22:41:09', 0, 'jhgj'),
(101, 'kjkj', 767, 'jackets', 'Available', 'male', 'c3b9501f648e23be6fefa3ae0395dcfb.jpg', 10, '2015-03-08 22:42:54', 0, 'kh'),
(102, 'sfw', 7876, 'tees', 'Available', 'male', '5a3a97da28b376dcf854ae88eb7e9158.jpg', 10, '2015-03-08 22:52:10', 0, 'bj'),
(103, 'jhg', 87687, 'shoes', 'Available', 'male', 'a2f1832e6d662a60c599ea186773eb7a.jpg', 10, '2015-03-08 22:52:54', 0, 'hg'),
(104, 'hg', 876, 'jackets', 'Available', 'male', 'e4d340f314e6275d6fd7de9827cb4be6.jpg', 10, '2015-03-08 22:53:13', 0, 'gjhg'),
(105, 'kjh', 7687, 'jackets', 'Available', 'male', '5424559aa4c40165d69186df9307818e.jpg', 10, '2015-03-08 22:54:33', 0, 'jhj'),
(106, 'jjhg', 876, 'jackets', 'Available', 'male', 'b694018101a7b4aa58dff1f03a35648d.jpg', 10, '2015-03-08 22:54:55', 0, 'jhg'),
(107, 'jh', 876876, 'jackets', 'Available', 'male', '0fda5327cc4e87e358fa6d8bf9187159.jpg', 10, '2015-03-08 23:00:53', 0, 'kkjh'),
(108, 'jhg', 765, 'jackets', 'Available', 'male', 'e660f28ffde1699d7704b7d0da6343fa.jpg', 10, '2015-03-08 23:01:20', 0, 'jh'),
(109, 'kjh', 876, 'jackets', 'Available', 'male', '7e50be412f0e3007f957685217a6ce4b.jpg', 10, '2015-03-08 23:02:13', 0, 'kjh'),
(110, 'hj', 75, 'jackets', 'Available', 'male', '99bfd31bfe7d1e495ace85e0b150ce2d.jpg', 10, '2015-03-08 23:02:33', 0, 'hv'),
(111, 'jhg', 675, 'tees', 'Available', 'male', '20bdbcf904dfedd584ce3374e588a388.jpg', 10, '2015-03-08 23:02:49', 0, 'jhg'),
(112, 'jhg', 765, 'shoes', 'Available', 'male', '5d8b9da4a1f646421a406b066245d0ba.jpeg', 10, '2015-03-08 23:06:34', 0, 'jhg'),
(113, 'h', 657, 'tees', 'Available', 'male', '661bf6e868b65ad4224dc9373e2bef4d.jpg', 10, '2015-03-08 23:07:07', 0, 'hg'),
(114, 'jhg', 765, 'tees', 'Available', 'male', '5b9a939f48c9f58b26a69e1e1d45b23c.jpg', 10, '2015-03-08 23:07:26', 0, 'jhg'),
(115, 'jh', 0, 'tees', 'Available', 'male', 'c9fc10fde7be234f12ee996ad3a5e36a.jpg', 10, '2015-03-08 23:07:56', 0, 'jh'),
(116, 'jhg', 786, 'jackets', 'Available', 'male', 'a20f73a0efac24bf8a42d41f1e236e03.jpg', 10, '2015-03-08 23:08:19', 0, 'jhg'),
(117, 'ijhg', 987, 'shorts', 'Available', 'male', 'f588de9ff24312a8a10a4c6f664c4832.jpg', 10, '2015-03-08 23:08:49', 0, 'kj'),
(118, 'jk', 87, 'tees', 'Available', 'male', 'a38afd3e9d7aeac942053442ea068b0f.jpg', 10, '2015-03-08 23:09:14', 0, 'jh'),
(119, 'ih', 97, 'tees', 'Available', 'female', '121ed6d13592468ece2dcaa4cfacf1d6.jpg', 10, '2015-03-08 23:09:35', 0, 'kjh'),
(120, 'jkh', 876, 'jackets', 'Available', 'male', '558fc94341078a0dd7f67e86162b6fd1.jpg', 10, '2015-03-08 23:09:56', 0, 'kjh'),
(121, 'jhg', 786, 'jackets', 'Available', 'male', '4b77d49313bafb0f613837170d182919.jpg', 10, '2015-03-08 23:10:21', 0, 'jhg'),
(122, 'kjhk', 987, 'shoes', 'Available', 'male', 'bea7cb41c1314626bae2499f7f05efd8.jpg', 10, '2015-03-29 02:00:31', 1, 'jk77777'),
(128, 'tuyt', 875765, 'jackets', 'Available', 'male', 'b5e8c345ce9da76c40eca8fafbac5be7.jpg', 10, '2015-04-01 01:25:56', 1, 'uytuy'),
(129, 'garcia', 9876, 'shoes', 'Available', 'male', 'bd260f020132e22512e2008b6b6a3a2a.jpeg', 10, '2015-04-01 04:21:51', 1, 'moy'),
(130, 'wwef', 35435, 'shoes', 'Available', 'male', 'd6b4dc09be1b98297d1332682641f2a3.jpg', 10, '2015-04-09 06:14:16', 0, 'ertert');

-- --------------------------------------------------------

--
-- Table structure for table `productinventory`
--

CREATE TABLE IF NOT EXISTS `productinventory` (
`ProductInventoryID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `ProductInventorySize` varchar(20) NOT NULL,
  `ProductInventoryStock` int(11) NOT NULL,
  `ProductInventorySold` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productinventory`
--

INSERT INTO `productinventory` (`ProductInventoryID`, `ProductID`, `ProductInventorySize`, `ProductInventoryStock`, `ProductInventorySold`) VALUES
(1, 83, '56', 2, 2),
(2, 83, '10', 4, 9),
(3, 83, '100', 34, 2),
(4, 84, '23', 7, 11),
(5, 84, '54', 50, 7),
(6, 84, '76', 78, 1),
(7, 85, '10', 55, 2),
(8, 85, '9', 78, 2),
(9, 85, '12', 78, 3),
(10, 86, 'small', 78, 3),
(11, 86, 'extra large', 65, 16),
(12, 86, 'medium', 78, 3),
(13, 87, '12', 78, 3),
(14, 87, '9', 77, 3),
(15, 87, '10', 78, 3),
(16, 88, 'small', 77, 3),
(17, 88, 'medium', 77, 4),
(18, 88, 'large', 78, 2),
(19, 89, 'ttt', 77, 2),
(20, 89, 'ttt', 77, 2),
(21, 89, 'ttt', 77, 2),
(22, 90, 'ttt', 78, 2),
(23, 90, 'ttt', 78, 6),
(24, 90, 'ttt', 78, 3),
(25, 91, 'extra samll', 0, 4),
(26, 91, 'super medium', 0, 8),
(27, 91, 'medyu large', 78, 4),
(28, 92, 'ttt', 78, 0),
(29, 92, 'ttt', 78, 0),
(30, 92, 'ttt', 78, 0),
(31, 93, 'ttt', 78, 2),
(32, 93, 'ttt', 78, 0),
(33, 93, 'ttt', 78, 0),
(34, 94, 'ttt', 65, 18),
(35, 94, 'ttt', 65, 18),
(36, 94, 'ttt', 65, 18),
(37, 95, 'ttt', 78, 5),
(38, 95, 'ttt', 78, 1),
(39, 95, 'ttt', 78, 0),
(40, 96, 'ttt', 78, 0),
(41, 96, 'ttt', 78, 0),
(42, 96, 'ttt', 78, 0),
(43, 97, 'ttt', 78, 0),
(44, 97, 'ttt', 78, 0),
(45, 97, 'ttt', 78, 0),
(46, 98, 'ttt', 78, 0),
(47, 98, 'ttt', 78, 1),
(48, 98, 'ttt', 78, 0),
(49, 99, 'ttt', 78, 0),
(50, 99, 'ttt', 78, 0),
(51, 99, 'ttt', 78, 0),
(52, 100, 'ttt', 78, 0),
(53, 100, 'ttt', 78, 0),
(54, 100, 'ttt', 78, 0),
(55, 101, 'ttt', 78, 1),
(56, 101, 'ttt', 78, 0),
(57, 101, 'ttt', 78, 0),
(58, 102, 'ttt', 78, 0),
(59, 102, 'ttt', 78, 0),
(60, 102, 'ttt', 78, 0),
(61, 103, 'ttt', 78, 0),
(62, 103, 'ttt', 78, 0),
(63, 103, 'ttt', 78, 0),
(64, 104, 'ttt', 78, 0),
(65, 104, 'ttt', 78, 0),
(66, 104, 'ttt', 78, 0),
(67, 105, 'ttt', 78, 0),
(68, 105, 'ttt', 78, 0),
(69, 105, 'ttt', 78, 0),
(70, 106, 'ttt', 78, 0),
(71, 106, 'ttt', 78, 0),
(72, 106, 'ttt', 78, 0),
(73, 107, 'ttt', 78, 0),
(74, 107, 'ttt', 78, 2),
(75, 107, 'ttt', 78, 0),
(76, 108, '21', 75, 3),
(77, 108, '32', 78, 0),
(78, 108, '12', 78, 0),
(79, 109, 'ttt', 78, 1),
(80, 109, 'ttt', 78, 0),
(81, 109, 'ttt', 78, 0),
(82, 110, 'ttt', 78, 0),
(83, 110, 'ttt', 78, 0),
(84, 110, 'ttt', 78, 0),
(85, 111, 'ttt', 78, 0),
(86, 111, 'ttt', 78, 1),
(87, 111, 'ttt', 78, 0),
(88, 112, 'ttt', 78, 0),
(89, 112, 'ttt', 78, 0),
(90, 112, 'ttt', 78, 0),
(91, 113, 'ttt', 78, 0),
(92, 113, 'ttt', 78, 0),
(93, 113, 'ttt', 78, 0),
(94, 114, 'ttt', 78, 0),
(95, 114, 'ttt', 78, 0),
(96, 114, 'ttt', 78, 0),
(97, 115, 'ttt', 78, 0),
(98, 115, 'ttt', 78, 0),
(99, 115, 'ttt', 78, 0),
(100, 116, 'ttt', 78, 0),
(101, 116, 'ttt', 78, 0),
(102, 116, 'ttt', 78, 0),
(103, 117, 'ttt', 78, 2),
(104, 117, 'ttt', 78, 0),
(105, 117, 'ttt', 78, 1),
(106, 118, 'ttt', 78, 0),
(107, 118, 'ttt', 78, 0),
(108, 118, 'ttt', 78, 0),
(109, 119, 'ttt', 78, 0),
(110, 119, 'ttt', 78, 0),
(111, 119, 'ttt', 78, 0),
(112, 120, 'ttt', 78, 0),
(113, 120, 'ttt', 78, 0),
(114, 120, 'ttt', 78, 0),
(115, 121, 'ttt', 78, 0),
(116, 121, 'ttt', 78, 0),
(117, 121, 'ttt', 78, 0),
(118, 122, '2', 3, 1),
(119, 122, '34', 78, 1),
(120, 122, '32', 78, 1),
(123, 128, 'two', 2, 0),
(124, 128, 'three', 3, 0),
(125, 128, 'four', 4, 0),
(126, 129, 'extra small', 8, 0),
(127, 129, 'small', 9, 0),
(128, 129, 'large', 10, 0),
(129, 130, '12', 5, 0),
(130, 130, '32', 4546, 0),
(131, 130, '23', 64, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchased`
--

INSERT INTO `purchased` (`PurchasedID`, `PurchasedAmount`, `PurchasedQuantity`, `UserAccountID`, `PurchasedDate`, `PurchasedDelivered`) VALUES
(55, 8767, 1, 12, '2015-04-05 10:08:59', 1),
(56, 1794, 2, 12, '2015-04-05 10:12:41', 1),
(57, 64, 1, 12, '2015-04-05 10:13:58', 1),
(58, 1131, 13, 12, '2015-04-05 10:25:02', 1),
(59, 456, 1, 12, '2015-04-09 06:03:10', 1),
(60, 1794, 2, 10, '2015-04-08 06:42:44', 1),
(61, 9223, 2, 10, '2015-04-08 06:43:43', 1),
(62, 47531, 5, 28, '2015-04-09 06:00:17', 1),
(63, 522408, 12, 7, '2015-04-09 06:06:16', 1),
(64, 324, 1, 10, '2015-04-09 22:56:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedapproved`
--

CREATE TABLE IF NOT EXISTS `purchasedapproved` (
`PurchasedApprovedID` int(11) NOT NULL,
  `PurchasedID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `PurchasedApprovedStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedapproved`
--

INSERT INTO `purchasedapproved` (`PurchasedApprovedID`, `PurchasedID`, `UserAccountID`, `PurchasedApprovedStatus`) VALUES
(31, 55, 25, 0),
(32, 56, 25, 0),
(33, 57, 25, 0),
(34, 58, 25, 1),
(35, 60, 10, 1),
(36, 61, 10, 0),
(37, 62, 10, 1),
(38, 59, 10, 0),
(39, 63, 10, 0),
(40, 64, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchasedline`
--

CREATE TABLE IF NOT EXISTS `purchasedline` (
`PurchasedLineID` int(11) NOT NULL,
  `PurchasedID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchasedline`
--

INSERT INTO `purchasedline` (`PurchasedLineID`, `PurchasedID`, `CartID`) VALUES
(4, 55, 83),
(5, 56, 84),
(6, 57, 85),
(7, 58, 86),
(8, 59, 87),
(9, 60, 89),
(10, 61, 90),
(11, 61, 91),
(12, 62, 92),
(13, 62, 93),
(14, 63, 95),
(15, 64, 97);

-- --------------------------------------------------------

--
-- Table structure for table `received`
--

CREATE TABLE IF NOT EXISTS `received` (
`ReceivedID` int(11) NOT NULL,
  `PurchasedApprovedID` int(11) NOT NULL,
  `UserAccountID` int(11) DEFAULT NULL,
  `ReceivedStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `received`
--

INSERT INTO `received` (`ReceivedID`, `PurchasedApprovedID`, `UserAccountID`, `ReceivedStatus`) VALUES
(14, 34, 25, 0),
(15, 37, 10, 1),
(16, 35, 10, 0),
(17, 40, 10, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`UserAccountID`, `UserAccountImage`, `UserAccountFirstName`, `UserAccountLastName`, `UserAccountUserName`, `UserAccountPassword`, `UserAccountBD`, `UserAccountGender`, `UserAccountHomeAddress`, `UserAccountMobile`, `UserAccountEmail`, `UserAccountSecretQuestion`, `UserAccountAnswer`) VALUES
(7, 'fad1ee46e6e7006cf39d601b334ca40f.jpg', 'll', 'll', 'll', '5b54c0a045f179bcbbbc9abcb8b5cd4c', '1990-06-14', 'male', 'hh', '766', 'hh@yahoo.com', 'hh', '5e36941b3d856737e81516acd45edc50'),
(8, 'female.png', 'bb', 'bb', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c', '1992-12-04', 'female', 'bb', '88', 'bb@yahoo.com', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c'),
(9, 'male.png', 'mm', 'mm', 'mm', 'b3cd915d758008bd19d0f2428fbb354a', '1989-02-24', 'male', 'mm', '88', 'mm@yahoo.com', 'mm', 'b3cd915d758008bd19d0f2428fbb354a'),
(10, 'da29c9efd0bcadd1ef03bfc51502cda8.jpg', 'Lloric', 'Garcia', 'q', '7694f4a66316e53c8cdd9d9954bd611d', '1990-03-15', 'male', 'Egot Turno Dipolog City', '09487761477', 'emorickfighter@yahoo.com', 'q', '7694f4a66316e53c8cdd9d9954bd611d'),
(11, 'male.png', 'ard', 'moses', 'ardmoses', 'e10adc3949ba59abbe56e057f20f883e', '1992-03-29', 'male', 'asdsadasdasd', '12323123123', 'aasdasdasd@yahoo.com', 'ard', '4ce0bec67fe735f4997426101dd5292b'),
(12, 'b196492c670e30b03b7597d3fe231669.jpg', 'z', 'z', 'qq', 'bbcc701c062bc94760bede95238116e1', '1991-06-13', 'male', 'z', '11', 'z@yahoo.com', '1+1', 'c81e728d9d4c2f636f067f89cc14862c'),
(13, 'female.png', 'Jerald', 'Buljatin', 'jeraldin', '97784fec6e2313cf5f1d7ffac21c7098', '1993-07-13', 'female', 'Me Bang, Dipolog City', '09213456789', 'jeraldin@yahoo.com', 'What name?', '8b80876f51614e59f3224af17b48aa9b'),
(14, 'female.png', 'dvx', 'dfhb', 'angel', 'f4f068e71e0d87bf0ad51e6214ab84e9', '1992-01-12', 'female', 'katipnan', '0909', 'angle@yahoo.com', 'aa', '4124bc0a9335c27f086f24ba207a4912'),
(15, 'female.png', 'Amie', 'Ongayo', 'amie', 'e6a4370aca6970175dee8c72cc7e08dc', '1991-02-16', 'female', 'qq', '9878', 'amie@yahoo.com', 't', 'e358efa489f58062f10dd7316b65649e'),
(16, 'male.png', 'aa', 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912', '1992-02-16', 'male', 'aa', '11', 'aa@yahoo.com', 'aa', '4124bc0a9335c27f086f24ba207a4912'),
(23, 'female.png', 'm', 'm', 'm', '6f8f57715090da2632453988d9a1501b', '1990-03-24', 'female', 'm', '9', 'm@m.m', 'm', '6f8f57715090da2632453988d9a1501b'),
(25, 'male.png', 'kk', 'kk', 'kk', 'dc468c70fb574ebd07287b38d0d0676d', '1990-03-24', 'male', 'kk', '9090', 'kk@k.k', 'kk', 'dc468c70fb574ebd07287b38d0d0676d'),
(26, 'male.png', 'Jelyn', 'Bayonas', 'b', '92eb5ffee6ae2fec3ad71c777531578f', '1990-03-15', 'male', 'egot', '1212432', 'b@b.b', 'b', '92eb5ffee6ae2fec3ad71c777531578f'),
(27, 'male.png', 'waw', 'waw', 'waw', '6b4dccfb69c362b172bafdfc60c343e1', '1990-04-14', 'male', 'waw', '122', 'waw@waw.waw', 'waw', '7dd87e1bac147f619208ad97426ef9df'),
(28, 'ab0e64e2b7591688e14316a5007b074c.jpg', 'Meg', 'torlao', 'meg', 'bbcc701c062bc94760bede95238116e1', '1990-04-08', 'male', 'adddd', '3123', 'meg@yahoo.com', 'meg', '35623e2fb12281ddb6d7d5f63c5a29e3');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

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
(37, 25, 'admin'),
(38, 26, 'user'),
(39, 27, 'user'),
(40, 28, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE IF NOT EXISTS `visit` (
`id` int(11) NOT NULL,
  `doc` varchar(100) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`id`, `doc`, `count`) VALUES
(1, 'index.php', 403),
(2, 'store.php?query=all', 482),
(3, 'store.php?query=all&page=2', 12),
(4, 'about.php', 168),
(5, 'login.php?about.php', 12),
(6, 'contact.php', 155),
(7, 'mycart.php?query=all', 149),
(8, 'login.php?mycart.php?query=all', 14),
(9, 'cart.php?query=all&file=83', 6),
(10, 'mycart.php?query=all&file=83', 1),
(11, 'cart.php?query=all&file=83&file=83', 3),
(12, 'mycart.php?query=all&file=83&file=83', 7),
(13, 'fillcheckout.php', 10),
(14, 'store.php?search=l', 9),
(15, 'store.php?search=ll', 3),
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
(33, 'mycart.php', 545),
(34, 'store.php', 8),
(35, 'store.php?query=all&file=90&file=90', 1),
(36, 'cart.php?query=all&file=90&file=90&file=84', 1),
(37, 'cart.php?query=all&file=90&file=90&file=84&file=84', 1),
(38, 'mycart.php?query=all&file=90&file=90&file=84&file=84', 6),
(39, 'store.php?query=all&cat=jackets', 16),
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
(77, 'login.php?index.php', 101),
(78, 'store.php?query=female', 10),
(79, 'store.php?query=female&cat=jeans', 2),
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
(104, 'login.php?store.php?query=all', 8),
(105, 'setting.php', 257),
(106, 'profile.php', 44),
(107, 'cart.php?&file=94', 3),
(108, 'cart.php?file=94', 1),
(109, 'cart.php?&file=84', 18),
(110, 'mycart.php?&del=2', 1),
(111, 'cart.php?&file=83', 108),
(112, 'mycart.php??', 1),
(113, 'mycart.php????', 1),
(114, 'mycart.php????????', 1),
(115, 'mycart.php????????????????', 1),
(116, 'mycart.php????????????????????????????????', 1),
(117, 'mycart.php????????????????????????????????????????????????????????????????', 2),
(118, 'mycart.php?&del=4', 1),
(119, 'cart.php?&file=88', 6),
(120, 'login.php?mycart.php', 47),
(121, 'mycart.php?page=2', 5),
(122, 'mycart.php?page=1', 1),
(123, 'cart.php?&file=93', 1),
(124, 'cart.php?&file=86', 9),
(125, 'store.php?query=all&cat=shorts', 8),
(126, 'cart.php?&file=117', 5),
(127, 'cart.php?file=117', 1),
(128, 'mycart.php?&del=21', 1),
(129, 'mycart.php?&del=24', 1),
(130, 'store.php?query=male', 31),
(131, 'store.php?query=male&cat=jackets', 10),
(132, 'cart.php?&file=104', 1),
(133, 'cart.php?&file=109', 2),
(134, 'mycart.php?&del=27', 1),
(135, 'mycart.php?&del=26', 1),
(136, 'cart.php?&file=95', 2),
(137, 'cart.php?&file=89', 2),
(138, 'signup.php', 124),
(139, 'recovery.php', 23),
(140, 'ans.php', 20),
(141, 'resetpass.php', 16),
(142, 'login.php', 17),
(143, 'store.php?search=aa', 1),
(144, 'store.php?query=all&page=3', 2),
(145, 'store.php?query=all&page=4', 2),
(146, 'store.php?query=all&page=5', 2),
(147, 'store.php?query=all&cat=jeans', 5),
(148, 'store.php?query=all&cat=tees', 6),
(149, 'store.php?query=all&cat=tees&page=2', 1),
(150, 'store.php?query=all&cat=jackets&page=2', 3),
(151, 'store.php?query=all&cat=shoes', 6),
(152, 'store.php?query=all&cat=shoes&page=2', 3),
(153, 'cart.php?&file=122', 1),
(154, 'login.php?signup.php', 8),
(155, 'store.php?query=female&cat=tees', 3),
(156, 'store.php?query=female&cat=jackets', 4),
(157, 'store.php?query=female&cat=shoes', 1),
(158, 'store.php?query=female&cat=shorts', 1),
(159, 'store.php?query=sale', 26),
(160, 'store.php?query=male&cat=shoes', 2),
(161, 'login.php?cart.php?&file=83', 18),
(162, 'store.php?query=male&page=2', 1),
(163, 'login.php?store.php?query=sale', 2),
(164, 'cart.php?&file=87', 7),
(165, 'cart.php?&file=107', 1),
(166, 'cart.php?&file=90', 4),
(167, 'mycart.php?&del=41', 1),
(168, 'store.php?query=male&cat=jackets&page=2', 1),
(169, 'cart.php?&file=111', 1),
(170, 'store.php?query=sale&cat=shorts', 2),
(171, 'store.php?query=sale&cat=jeans', 1),
(172, 'store.php?query=sale&cat=tees', 2),
(173, 'store.php?search=jk', 3),
(174, 'cart.php?&file=91', 6),
(175, 'cart.php?&file=118', 7),
(176, 'cart.php?file=118', 1),
(177, 'mycart.php?&del=46', 1),
(178, 'cart.php?file=83', 24),
(179, 'mycart.php?&del=53', 1),
(180, 'mycart.php?&del=53&del=54', 1),
(181, 'mycart.php?&del=53&del=54&del=55', 1),
(182, 'mycart.php?&del=56', 1),
(183, 'mycart.php?&del=56&del=57', 1),
(184, 'mycart.php?&del=64', 1),
(185, 'mycart.php?&del=65', 1),
(186, 'mycart.php?&del=66', 1),
(187, 'mycart.php?&del=63', 1),
(188, 'mycart.php?&del=63&del=62', 1),
(189, 'mycart.php?&del=63&del=62&del=61', 1),
(190, 'cart.php?&file=85', 4),
(191, 'mycart.php?&del=67', 1),
(192, 'mycart.php?&del=68', 1),
(193, 'store.php?search=jjj', 1),
(194, 'cart.php?file=86', 1),
(195, 'store.php?search=moy', 1),
(196, 'store.php?search=garca', 1),
(197, 'store.php?search=garcia', 1),
(198, 'cart.php?&file=129', 2),
(199, 'cart.php?file=129', 1),
(200, 'cart.php?file=87', 3),
(201, 'store.php?search=', 2),
(202, 'store.php?search=a', 8),
(203, 'store.php?search=k', 4),
(204, 'store.php?query=all&cat=jackets&page=3', 1),
(205, 'store.php?count=6', 1),
(206, 'store.php?count=4', 1),
(207, 'store.php?count=2&query=all', 1),
(208, 'store.php?count=55&query=sale', 1),
(209, 'store.php?count=2&query=all&cat=', 1),
(210, 'store.php?count=4&query=all&cat=cat%3Djackets%26', 1),
(211, 'store.php?count=2&query=all&cat=jackets', 1),
(212, 'store.php?query=male&cat=jeans', 1),
(213, 'store.php?count=5&query=male&cat=jackets', 1),
(214, 'store.php?count=2&query=all&cat=%3Cbr+%2F%3E%0D%0A%3Cb%3ENotice%3C%2Fb%3E%3A++Undefined+index%3A+cat', 1),
(215, 'store.php?count=11&query=all&cat=', 1),
(216, 'store.php?count=3&query=all', 1),
(217, 'store.php?count=6&query=all&cat=jackets', 1),
(218, 'store.php?count=4343&query=sale', 1),
(219, 'login.php?cart.php?&file=84', 2),
(220, 'store.php?&file=84', 1),
(221, 'store.php?search=3', 1),
(222, 'store.php?search=8', 3),
(223, 'store.php?search=eww', 1),
(224, 'store.php?search=we', 1),
(225, 'store.php?search=kk', 1),
(226, 'store.php?search=9', 6),
(227, 'store.php?search=97', 1),
(228, 'store.php?search=j', 1),
(229, 'store.php?search=95', 1),
(230, 'store.php?search=9j', 1),
(231, 'store.php?search=99', 1),
(232, 'store.php?search=94', 1),
(233, 'store.php?search=+', 1),
(234, 'store.php?search=1', 1),
(235, 'store.php?search=11', 1),
(236, 'store.php?search=111', 1),
(237, 'store.php?search=83', 2),
(238, 'cart.php?&file=108', 3),
(239, 'store.php?search=nova', 1),
(240, 'store.php?search=98', 1),
(241, 'store.php?search=li', 1),
(242, 'store.php?search=34', 1),
(243, 'store.php?search=86', 1),
(244, 'store.php?search=kj', 1),
(245, 'store.php?search=kjh', 1),
(246, 'store.php?search=fh', 1),
(247, 'cart.php?file=91', 1),
(248, 'login.php?cart.php?&file=85', 2),
(249, 'store.php?query=sale&page=2', 1),
(250, 'store.php?query=sale&page=1', 1),
(251, 'store.php?query=all&page=8', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`CartID`), ADD KEY `fk_cart_product` (`ProductID`), ADD KEY `fk_cart_useraccount` (`UserAccountID`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
 ADD PRIMARY KEY (`DocumentID`);

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
-- Indexes for table `productinventory`
--
ALTER TABLE `productinventory`
 ADD PRIMARY KEY (`ProductInventoryID`), ADD KEY `fk_productinventory_product` (`ProductID`);

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
-- Indexes for table `received`
--
ALTER TABLE `received`
 ADD PRIMARY KEY (`ReceivedID`), ADD KEY `fk_received_purchasedapproved` (`PurchasedApprovedID`), ADD KEY `fk_received_useraccount` (`UserAccountID`);

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
-- Indexes for table `visit`
--
ALTER TABLE `visit`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
MODIFY `DocumentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `productinventory`
--
ALTER TABLE `productinventory`
MODIFY `ProductInventoryID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=132;
--
-- AUTO_INCREMENT for table `purchased`
--
ALTER TABLE `purchased`
MODIFY `PurchasedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `purchasedapproved`
--
ALTER TABLE `purchasedapproved`
MODIFY `PurchasedApprovedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `purchasedline`
--
ALTER TABLE `purchasedline`
MODIFY `PurchasedLineID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `received`
--
ALTER TABLE `received`
MODIFY `ReceivedID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
MODIFY `UserAccountID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `useraccountaccess`
--
ALTER TABLE `useraccountaccess`
MODIFY `UserAccountAccessID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `useraccounttype`
--
ALTER TABLE `useraccounttype`
MODIFY `UserAccountTypeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=252;
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
-- Constraints for table `productinventory`
--
ALTER TABLE `productinventory`
ADD CONSTRAINT `fk_productinventory_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

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
-- Constraints for table `received`
--
ALTER TABLE `received`
ADD CONSTRAINT `fk_received_purchasedapproved` FOREIGN KEY (`PurchasedApprovedID`) REFERENCES `purchasedapproved` (`PurchasedApprovedID`),
ADD CONSTRAINT `fk_received_useraccount` FOREIGN KEY (`UserAccountID`) REFERENCES `useraccount` (`UserAccountID`);

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
