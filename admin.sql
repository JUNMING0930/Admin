-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 08:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `ID` int(5) NOT NULL,
  `Admin_Fname` varchar(100) NOT NULL,
  `Admin_Lname` varchar(100) NOT NULL,
  `Admin_Email` varchar(100) NOT NULL,
  `Admin_Password` varchar(100) NOT NULL,
  `Admin_Phone` varchar(100) NOT NULL,
  `Admin_Role` int(1) NOT NULL COMMENT '0=Admin,1=SuperAdmin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`ID`, `Admin_Fname`, `Admin_Lname`, `Admin_Email`, `Admin_Password`, `Admin_Phone`, `Admin_Role`) VALUES
(23, 'QjEwS1EwL1VPWUUvczE1SjZ6d0o1QT09OjoxMjM0NTY3ODkxMjM0NTY3', 'RmNVeURjYVJ1OEZ1ek9CSUd6NjdKQT09OjoxMjM0NTY3ODkxMjM0NTY3', 'cWFPL0NNaFd1R09UdW9rQ09adG13TjFzTGw3d25YNGRDcnpMS0xlRm1vZz06OjEyMzQ1Njc4OTEyMzQ1Njc=', '$2y$10$ES6Wua7qluujCvvSIlrQyOSGSsvWnq2VTKPAAetiIzLvqxHFyBmGa', 'MFV4NzFtSU0rUUJDZWxDMTBxV1dPQT09OjoxMjM0NTY3ODkxMjM0NTY3', 1),
(26, 'WEhHRDdCMjZnSUwydnUxelRBSDJ5UT09OjoxMjM0NTY3ODkxMjM0NTY3', 'RmNVeURjYVJ1OEZ1ek9CSUd6NjdKQT09OjoxMjM0NTY3ODkxMjM0NTY3', 'Y0NENXRSWFlvMXV5aDRjdG1QV1ROcTY4NUhvSEZiU1BNYkFLTzIvU1R6QT06OjEyMzQ1Njc4OTEyMzQ1Njc=', '$2y$10$Gxk7NSIJ2FlZ/3WBgLBCreetPsggj0GEZbl/sZeBpDa6PcVyoQ8qK', 'MFV4NzFtSU0rUUJDZWxDMTBxV1dPQT09OjoxMjM0NTY3ODkxMjM0NTY3', 1),
(27, '', '', 'a', 'a', '', 1),
(28, '', '', '', '', '', 1),
(29, 'SGdmdmwwYjd2VlpxYjhZTmt1R1p5QT09OjoxMjM0NTY3ODkxMjM0NTY3', 'cmNDa3BxSkh4SWZWMGkvK2E1cmltZz09OjoxMjM0NTY3ODkxMjM0NTY3', 'MmhTalJDTzBpWEZFZS9ubkJRaENwR2tPRy9KUm5IZDhJOTZzUGJ1YWloYz06OjEyMzQ1Njc4OTEyMzQ1Njc=', '$2y$10$PT2QqrMIeRa7tINRVTApNerH6mzt4UifV9ahkfw3Bt2Ko/idVRi2K', 'K0RkeEJUTWZCbytZR1BhWUZMN0lFQT09OjoxMjM0NTY3ODkxMjM0NTY3', 1),
(30, 'WEhHRDdCMjZnSUwydnUxelRBSDJ5UT09OjoxMjM0NTY3ODkxMjM0NTY3', 'RmNVeURjYVJ1OEZ1ek9CSUd6NjdKQT09OjoxMjM0NTY3ODkxMjM0NTY3', 'M2JNVWljOUxnL2tsVlhQRklwejVsVmJqem1lUTI2NkdjbVJwRFZJWWFZYz06OjEyMzQ1Njc4OTEyMzQ1Njc=', '$2y$10$GuL82k0jcuiC1pUqWOV.c.C2acv9kM5357ASGGn/KwMLs7tkr1Zw6', 'MFV4NzFtSU0rUUJDZWxDMTBxV1dPQT09OjoxMjM0NTY3ODkxMjM0NTY3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(5) NOT NULL,
  `Cate_Name` varchar(200) NOT NULL,
  `Cate_Description` text DEFAULT NULL,
  `Cate_Status` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Cate_Name`, `Cate_Description`, `Cate_Status`) VALUES
(1, 'SANDLE', '       ', 1),
(2, 'SLIDER', '   ', 1),
(3, 'FLIP FLOPS', '  ', 1),
(4, 'SPORT SHOES', ' ', 1),
(5, 'CLOGS', '   ', 1),
(6, 'Shoes', '', 1),
(7, 'Ming Lim', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ID` int(5) NOT NULL,
  `Category_ID` int(5) NOT NULL,
  `Pro_Name` varchar(100) NOT NULL,
  `Pro_Description` text DEFAULT NULL,
  `Pro_Price` decimal(10,2) NOT NULL,
  `Pro_Image` varchar(200) NOT NULL,
  `Pro_Status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Category_ID`, `Pro_Name`, `Pro_Description`, `Pro_Price`, `Pro_Image`, `Pro_Status`) VALUES
(1, 1, 'August Unisex Sandal', 'Our August Unisex Sandal will be your new go-to locker room companion. Our sandal has plush top bed foam for cushioning that offers a great underfoot feel. And, with a convenient slip-on \r\ndesign, you can recover in supportive comfort after your next workout. Our sandal has a one-piece fixed upper to offer all-day support.', '180.00', '1674062759.jpg                    ', 1),
(2, 1, 'Dion Unisex Sandal', 'Our Dion Unisex sandal is perfect to slip into for pre- or post-skate relaxation. With a super soft top bed foam that is anatomically designed to mimic the contour of the foot, you’ll reach for it \r\nover and over again.', '260.00', '1674064957.jpg', 1),
(3, 1, 'Gray Unisex Sandal', 'Max and relax with our Gray Unisex sandal which features a comfortable footbed and adjustable hook-and-loop closure straps for easy wear. Plus, rubber pods on the outsole provide \r\nversatile \r\nuse, so you can wear these sandals outdoors, on city streets and everywhere in between.', '250.00', '1674065153.jpg', 1),
(4, 1, 'Rowan Unisex Sandal', 'Slide into progressive KNM style in the urban-inspired Rowan Unisex Sandals. With a comfortable moulded and padded footbed, a durable outsole and stylish leather-like straps, they’re perfect \r\nfor post-workout lounging or a day out on the town.', '260.00', '1674065322.jpg', 1),
(5, 1, 'Solomon Unisex Sandal', 'Slip into a true KNM classic with our Solomon Unisex Sandal, delivering incomparable style and comfort for generations to come.', '250.00', '1674065548.jpg ', 1),
(6, 2, 'Billie Casual Slides', 'Designed for maximum comfort and style, these slides are the ideal footwear for your next summer vacation.', '179.00', '1674066008.jpg', 1),
(7, 2, 'Double Band Sliders', 'Classic meets style with this pair of double-banded sandals. Rest on a comfortable moulded footbed that is set on a durable rubber tread sole.', '250.00', '1674066087.jpg', 1),
(8, 2, 'Nylon Fabric Banded Slides', 'Lightweight and stylish, this Nylon Banded Slides in military green makes the perfect casual footwear to have this season. Featuring a contrasting banded upper, get ready to step out in style \r\nwith this sleek number.', '199.00', '1674066189.jpg', 1),
(9, 2, 'Padded Slides', 'Run errands or lounge in these comfy pair of slides. The effortless upper offers multiple styling options while providing maximum comfortability for all-day wear.', '199.00', '1674066257.jpg', 1),
(10, 2, 'Slide Sandals', 'Stand out from the rest on your next casual beach outing with your friends or significant other in these Slide Sandals. Effortlessly chic, lightweight and bound to keep you cool , this pair of \r\nslides rendered in an all-black silhouette features ridges across the upper, adding statement points to your overall relaxed casual ensembles in a cinch.', '229.00', '1674066346.jpg', 1),
(11, 3, 'Top Max Flip Flops', 'Top Max Flip Flops is sturdy and staid. Designed with wider straps and classic colors this pair will assure comfort and self-confidence on each step.', '50.00', '1674067576.jpg', 1),
(12, 3, 'Comfy Flip Flops', 'Comfy Flip Flops carries democratic, versatile, classic, comfortable and colorful. From fashion to basics, from neutral to vibrant, there’s a perfect pair waiting for you', '89.00', '1674067776.jpg', 1),
(13, 3, 'Rubi Thong Flip Flops', 'Perfect for the beach. pool or casual Sundays, the Rubi Thong is the \r\nultimate slip on-and-go.', '29.00', '1674068090.jpg', 1),
(14, 3, 'Eva Flip Flops', 'It is classic basic flip flops for men. Wear it on beach, on street. Leisure, \r\nfashion and comfortable. ', '49.00', '1674068249.jpg', 1),
(15, 3, 'Cushion Court Flip Flops', 'In the court of style, these rule! We made a few subtle twists to the \r\ntrusty flip flop for a refined look. The strap is tapered, made of metallic \r\nvegan leather. But REEF’s signature comfort stays the same, with high-\r\nenergy rebound, arch support and heel cupping.', '200.00', '1674068337.jpg', 1),
(16, 4, 'Interfex Running Shoes', 'Modern style meets streetwear fashion in the INTERFLEX Modern \r\nsneaker. These runners feature a bold contemporary design with an \r\nexaggerated tongue and contrast EVA foam midsole for a striking \r\nappearance. Ground-contact EVA at the outsole adds a lightweight feel \r\nand excellent cushioning, keeping these runners comfortable, no matter \r\nwhere your day takes you.\r\n', '200.00', '1674068476.jpg', 1),
(17, 4, 'Stan Smith Sport Shoes', 'Stan Smith Sport Shoes is best for lifestyle, perforated side detail low cut \r\nsneakers, vegan leather upper and lace up fastening', '300.00', '1674068650.jpg', 1),
(18, 4, 'Uniform Synthetic Sport Shoes', 'Genuine Leather is a natural material from animals and therefore differs \r\nfrom hide to hide. Whereas Synthetic Leather are treated and reacts \r\ndifferently during coloring and tanning process, to replicate these \r\ntextures of a Genuine Leather.\r\n\r\nWhile we handle all of our product with utmost care, irregularities such \r\nas dents, scars, scratches, wrinkles or blemishes are normal, and should \r\nnot be considered as a defect.\r\n', '449.00', '1674068812.jpg', 1),
(19, 4, 'Twitch Running Shoes', 'Twitch Running Shoes is streamlined mesh running shoes, its mono \r\nmesh material is breathable and comfortable during both speed and \r\nendurance runs and it is SOFTFOAM+ which means it is comfort \r\nsockliner for instant step-in and long-lasting comfort', '400.00', '1674069032.jpg', 1),
(20, 4, 'Dna Guard Sport Shoes', 'It is a textured knitted panelled shoes, it has a textile and synthetic upper, \r\ntextile inner, rubber outsole and BOOST midsole.', '769.00', '1674069159.jpg', 1),
(21, 5, 'Classic Clogs', 'Class Clogs is a solid shade class unisex clog sandals, it has a EVA upper, \r\nEVA insole, EVA outsole and it is water-friendly and buoyant', '299.00', '1674069484.jpg', 1),
(22, 5, 'Bistro Pro Clogs', 'Bistro Pro Clogs has a slip-on construction, synthetic upper, soft feeling, it \r\nis a sport-inspired clogs for everday.', '200.00', '1674069727.jpg', 1),
(23, 5, 'Adilette Clogs', 'These clogs are as functional as they are comfortable. If you want to \r\nkeep \r\nthe slouchy-casual vibe going all through your day, slip your feet into the \r\ncontoured footbeds and head for the door', '299.00', '1674069933.jpg  ', 1),
(24, 5, 'Shuv Leather Clogs', 'Our Shuv clogs. The shoes of the future. Simple. Ultra-modern. Iconic. \r\nFun. With a brilliantly minimal, single-piece, full-grain leather upper and \r\nour amazingly comfortable, triple-density microwobbleboard midsole \r\nunderneath. Irresistible, really. With built-in arch contour and our \r\namazing microwobbleboard midsoles.', '599.00', '1674070797.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `ID` int(3) NOT NULL,
  `EUsize` int(3) NOT NULL,
  `CMsize` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`ID`, `EUsize`, `CMsize`) VALUES
(3, 39, '23.75'),
(4, 40, '24.60'),
(5, 41, '25.45'),
(6, 42, '26.30'),
(7, 43, '27.15');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `ID` int(5) NOT NULL,
  `Category_ID` int(5) NOT NULL,
  `Product_ID` int(5) NOT NULL,
  `Product_Size` int(3) NOT NULL,
  `Product_Quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`ID`, `Category_ID`, `Product_ID`, `Product_Size`, `Product_Quantity`) VALUES
(1, 1, 1, 39, 25),
(2, 1, 1, 40, 24),
(3, 1, 1, 41, 31),
(4, 1, 1, 42, 30),
(5, 1, 1, 43, 1),
(6, 1, 3, 39, 28),
(9, 1, 3, 42, 10),
(10, 1, 3, 43, 32),
(11, 1, 2, 39, 9),
(12, 1, 2, 40, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
