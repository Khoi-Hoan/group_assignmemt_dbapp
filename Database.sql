CREATE DATABASE auction;
USE auction;

CREATE TABLE `Branch` (
  `Branch_Code` char(9),
  `Branch_Name` varchar(50),
  `Address` varchar(255),
  `Hotline` varchar(50),
  PRIMARY KEY (`Branch_Code`),
  KEY `UN` (`Branch_Name`)
);

CREATE TABLE `Customer` (
  `Customer_Email` varchar(255),
  `Branch_Code` char(9),
  `Password` char(60),
  `Phone` char(10),
  `First_Name` varchar(20),
  `Last_Name` varchar(20),
  `Customer_ID` char(12),
  `Address` varchar(255),
  `City` varchar(20),
  `Country` varchar(20),
  `Balance` varchar(30),
  `Profile_URL` varchar(255),
  PRIMARY KEY (`Customer_Email`),
  FOREIGN KEY (`Branch_Code`) REFERENCES `Branch`(`Branch_Code`),
  KEY `UN` (`Phone`, `Customer_ID`)
);

CREATE TABLE `Bid` (
  `Customer_Email` varchar(255),
  `Auction_ID` int(9),
  `Bid` money,
  PRIMARY KEY (`Customer_Email`, `Auction_ID`),
  FOREIGN KEY (`Auction_ID`) REFERENCES `Auction`(`Auction_ID`),
  FOREIGN KEY (`Customer_Email`) REFERENCES `Customer`(`Customer_Email`)
);
