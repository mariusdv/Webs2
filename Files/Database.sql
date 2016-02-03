-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2016 at 12:07 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pokebase`
--
CREATE DATABASE IF NOT EXISTS `pokebase` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pokebase`;

-- --------------------------------------------------------

--
-- Table structure for table `adres`
--

DROP TABLE IF EXISTS `adres`;
CREATE TABLE `adres` (
  `Id` int(11) NOT NULL,
  `Zipcode` varchar(6) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Province` varchar(45) NOT NULL,
  `Country` varchar(45) NOT NULL,
  `Users_Email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `itemhistory`
--

DROP TABLE IF EXISTS `itemhistory`;
CREATE TABLE `itemhistory` (
  `Id` int(11) NOT NULL,
  `Price` decimal(20,2) NOT NULL,
  `Date` datetime NOT NULL,
  `Items_Id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `Id` int(10) UNSIGNED NOT NULL,
  `Naam` varchar(45) NOT NULL,
  `DescriptionLong` longtext NOT NULL,
  `DescriptionShort` varchar(200) NOT NULL,
  `Price` decimal(20,2) NOT NULL,
  `ImgUrlBig` varchar(45) NOT NULL,
  `ImgUrlSmall` varchar(45) NOT NULL,
  `Subcategories_Name` varchar(45) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `items`
--
DROP TRIGGER IF EXISTS `AFTER_INSERT_ITEMS`;
DELIMITER $$
CREATE TRIGGER `AFTER_INSERT_ITEMS` AFTER INSERT ON `items` FOR EACH ROW INSERT INTO itemhistory ( Price, Date, Items_Id)
	VALUES ( NEW.Price, Now(), New.Id )
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `AFTER_UPDATE_ITEMS`;
DELIMITER $$
CREATE TRIGGER `AFTER_UPDATE_ITEMS` AFTER UPDATE ON `items` FOR EACH ROW IF (NEW.Price <> OLD.Price) THEN
INSERT INTO itemhistory ( Price, Date, Items_Id)
	VALUES ( NEW.Price, Now(), New.Id );
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `items_has_orders`
--

DROP TABLE IF EXISTS `items_has_orders`;
CREATE TABLE `items_has_orders` (
  `Items_Id` int(10) UNSIGNED NOT NULL,
  `Orders_Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `Id` int(11) NOT NULL,
  `Users_Email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
CREATE TABLE `subcategories` (
  `Name` varchar(45) NOT NULL,
  `Categories_Name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timesheet`
--

DROP TABLE IF EXISTS `timesheet`;
CREATE TABLE `timesheet` (
  `Name` varchar(45) NOT NULL,
  `Task` varchar(45) NOT NULL,
  `Time` int(11) NOT NULL,
  `Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Email` varchar(45) NOT NULL,
  `IsAdmin` tinyint(1) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Surname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `Items_Id` int(10) UNSIGNED NOT NULL,
  `Users_Email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Adres_Users1_idx` (`Users_Email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `itemhistory`
--
ALTER TABLE `itemhistory`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_ItemHistory_Items1_idx` (`Items_Id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Id_UNIQUE` (`Id`),
  ADD KEY `fk_Items_Subcategories1_idx` (`Subcategories_Name`);

--
-- Indexes for table `items_has_orders`
--
ALTER TABLE `items_has_orders`
  ADD PRIMARY KEY (`Items_Id`,`Orders_Id`),
  ADD KEY `fk_Items_has_Orders_Orders1_idx` (`Orders_Id`),
  ADD KEY `fk_Items_has_Orders_Items1_idx` (`Items_Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk_Orders_Users1_idx` (`Users_Email`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`Name`),
  ADD KEY `fk_Subcategories_Categories_idx` (`Categories_Name`);

--
-- Indexes for table `timesheet`
--
ALTER TABLE `timesheet`
  ADD PRIMARY KEY (`Name`,`Task`,`Time`,`Date`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`Items_Id`,`Users_Email`),
  ADD KEY `fk_Items_has_Users_Users1_idx` (`Users_Email`),
  ADD KEY `fk_Items_has_Users_Items1_idx` (`Items_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adres`
--
ALTER TABLE `adres`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `itemhistory`
--
ALTER TABLE `itemhistory`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `adres`
--
ALTER TABLE `adres`
  ADD CONSTRAINT `fk_Adres_Users1` FOREIGN KEY (`Users_Email`) REFERENCES `users` (`Email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `itemhistory`
--
ALTER TABLE `itemhistory`
  ADD CONSTRAINT `fk_ItemHistory_Items1` FOREIGN KEY (`Items_Id`) REFERENCES `items` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_Items_Subcategories1` FOREIGN KEY (`Subcategories_Name`) REFERENCES `subcategories` (`Name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `items_has_orders`
--
ALTER TABLE `items_has_orders`
  ADD CONSTRAINT `fk_Items_has_Orders_Items1` FOREIGN KEY (`Items_Id`) REFERENCES `items` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Items_has_Orders_Orders1` FOREIGN KEY (`Orders_Id`) REFERENCES `orders` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_Orders_Users1` FOREIGN KEY (`Users_Email`) REFERENCES `users` (`Email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_Subcategories_Categories` FOREIGN KEY (`Categories_Name`) REFERENCES `categories` (`Name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `fk_Items_has_Users_Items1` FOREIGN KEY (`Items_Id`) REFERENCES `items` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Items_has_Users_Users1` FOREIGN KEY (`Users_Email`) REFERENCES `users` (`Email`) ON DELETE NO ACTION ON UPDATE NO ACTION;
