-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2023 at 03:58 AM
-- Server version: 8.0.31-0ubuntu0.22.04.1
-- PHP Version: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salestracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_bank`
--

CREATE TABLE `tbl_master_bank` (
  `PK_BankId` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `Bankname` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_brand`
--

CREATE TABLE `tbl_master_brand` (
  `PK_BrandID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  ` FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `BrandName` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_company`
--

CREATE TABLE `tbl_master_company` (
  `PK_CompanyID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_LocationID` int NOT NULL,
  `Company_name` varchar(100) NOT NULL,
  `Company_GUID` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_dealerinformation`
--

CREATE TABLE `tbl_master_dealerinformation` (
  `PK_DealerID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `DealerName` varchar(250) NOT NULL,
  `GUID` varchar(100) NOT NULL,
  `cwCategory` varchar(100) NOT NULL,
  `cwExecutiveName` varchar(100) NOT NULL,
  `cwProductName` varchar(100) NOT NULL,
  `FK_CategoryID` int NOT NULL DEFAULT '0',
  `DealerName_Alias` varchar(250) NOT NULL,
  `Product` varchar(250) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Town_City_Village` varchar(250) NOT NULL,
  `District` varchar(150) NOT NULL,
  `Pin_Code` varchar(250) NOT NULL,
  `Phone_Number` varchar(250) NOT NULL,
  `Mobile_Number` varchar(50) NOT NULL,
  `Category` varchar(25) NOT NULL,
  `Sales_Executive` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Credit_Days` int NOT NULL,
  `Credit_Limit` decimal(10,0) NOT NULL,
  `Vat_No` varchar(50) NOT NULL,
  `PAN_IT_No` varchar(50) NOT NULL,
  `GSTIN` varchar(50) NOT NULL,
  `E-Mail` varchar(50) NOT NULL,
  `Contact_Person` varchar(150) NOT NULL,
  `Notes` varchar(500) NOT NULL,
  `Alias` varchar(50) NOT NULL,
  `Send_SMS` bit(1) NOT NULL,
  `Sync` bit(1) NOT NULL,
  `OpeningBalance` double NOT NULL DEFAULT '0',
  `ClosingBalance` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_financialyear`
--

CREATE TABLE `tbl_master_financialyear` (
  `PK_FinancialID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` date NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` date NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `YearCode` varchar(20) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_location`
--

CREATE TABLE `tbl_master_location` (
  `PK_LocationID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `Location_name` varchar(100) NOT NULL,
  `LocationType` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_manager_salesexecutive`
--

CREATE TABLE `tbl_master_manager_salesexecutive` (
  `PK_Manager_SalesExecutiveID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` int NOT NULL DEFAULT '1',
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `FK_USER_SalesExecutiveID` int NOT NULL,
  `FK_User_MangerID` int NOT NULL,
  `SalesExecutiveName` varchar(100) NOT NULL,
  `ManagerName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_mobileappversion`
--

CREATE TABLE `tbl_master_mobileappversion` (
  `PK_VersionID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `Version` varchar(10) NOT NULL,
  `CurrentVersion` varchar(10) NOT NULL,
  `MobileAppPath` varchar(100) NOT NULL,
  `ServerIP` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_productcategory`
--

CREATE TABLE `tbl_master_productcategory` (
  `PK_CategoryID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `IsDeleted` bit(1) NOT NULL DEFAULT b'0',
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `Category_GUID` varchar(50) NOT NULL,
  `FK_ParentCategoryID` int NOT NULL,
  `FK_BrandID` int NOT NULL,
  `CategoryName` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_productitem`
--

CREATE TABLE `tbl_master_productitem` (
  `PK_ProductID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` date NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` int NOT NULL,
  `IsActive` int NOT NULL,
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `StockItem_GUID` varchar(50) NOT NULL,
  `FK_CategoryID` int NOT NULL,
  `CategoryName` varchar(500) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `AvailableQuantity` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_productitem_new`
--

CREATE TABLE `tbl_master_productitem_new` (
  `PK_ProductID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` date NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` int NOT NULL,
  `IsActive` int NOT NULL,
  `StockItem_GUID` varchar(50) NOT NULL,
  `FK_CategoryID` int NOT NULL,
  `CategoryName` varchar(500) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `AvailableQuantity` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_usergroup`
--

CREATE TABLE `tbl_master_usergroup` (
  `PK_UserGroupID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `UserGroup_name` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_master_userinformation`
--

CREATE TABLE `tbl_master_userinformation` (
  `PK_UserID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `UserID` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(500) NOT NULL,
  `Title` varchar(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `IMEI_No` varchar(300) DEFAULT NULL,
  `STATUS` varchar(20) NOT NULL,
  `ValidFrom` datetime NOT NULL,
  `ValidTo` datetime NOT NULL,
  `FK_SUPERVISORUserID` int NOT NULL,
  `FK_UserGroupId` int NOT NULL,
  `SEND_MSG` bit(10) NOT NULL,
  `FK_AssignedLocationIDs` varchar(100) NOT NULL,
  `FK_AssignedBrandID` varchar(100) NOT NULL,
  `AssignedBrands` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `PK_StatusID` int NOT NULL,
  `StatusName` varchar(100) NOT NULL,
  `StatusType` varchar(100) NOT NULL,
  `StatusDefault` bit(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_accountledger`
--

CREATE TABLE `tbl_trans_accountledger` (
  `PK_LedgerID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_DealerID` int NOT NULL,
  `LedgerDate` date NOT NULL,
  `VoucherType` varchar(500) NOT NULL,
  `VoucherNo` varchar(500) NOT NULL,
  `Particulars` text NOT NULL,
  `DebitAmount` int NOT NULL,
  `CreditAmount` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_dealercollection`
--

CREATE TABLE `tbl_trans_dealercollection` (
  `PK_CollectionID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` date NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `FK_UserID` int NOT NULL,
  `FK_DealerID` int NOT NULL,
  `Collection_type` varchar(200) DEFAULT NULL,
  `transactionID` varchar(200) DEFAULT NULL,
  `Cheque` varchar(50) DEFAULT NULL,
  `FK_BankID` int DEFAULT NULL,
  `ChequeNo` varchar(200) DEFAULT NULL,
  `Referral_Image` varchar(200) DEFAULT NULL,
  `amount` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_grndetails`
--

CREATE TABLE `tbl_trans_grndetails` (
  `PK_grnDetailsID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_grnID` varchar(100) NOT NULL,
  `FK_CategoryID` int NOT NULL,
  `FK_ProductID` int NOT NULL,
  `AvlQTY` int NOT NULL,
  `grnQTY` int NOT NULL,
  `Feedback` varchar(500) NOT NULL,
  `Defect` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_grnmaster`
--

CREATE TABLE `tbl_trans_grnmaster` (
  `PK_grnID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int NOT NULL,
  `ModifyDate` datetime NOT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_FinancialID` int NOT NULL,
  `DeviceID` varchar(20) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `State` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Latitude` varchar(200) NOT NULL,
  `Longitute` varchar(200) NOT NULL,
  `FK_DealerID` int NOT NULL,
  `grnNo` varchar(20) NOT NULL,
  `InvoiceNo` varchar(200) NOT NULL,
  `InvoiceDate` date NOT NULL,
  `grnDate` datetime NOT NULL,
  `FK_StatusID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_orderdetails`
--

CREATE TABLE `tbl_trans_orderdetails` (
  `PK_OrderDetailsID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int DEFAULT NULL,
  `ModifyDate` datetime DEFAULT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_OrderID` varchar(100) NOT NULL,
  `FK_CategoryID` int NOT NULL,
  `FK_ProductID` int NOT NULL,
  `AvlQTY` int NOT NULL,
  `OrderQTY` int NOT NULL,
  `ApprovedQTY` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_ordermaster`
--

CREATE TABLE `tbl_trans_ordermaster` (
  `PK_OrderID` int NOT NULL,
  `FK_CreatedBy` int NOT NULL,
  `CreatedDate` datetime NOT NULL,
  `FK_ModifyBy` int DEFAULT NULL,
  `ModifyDate` datetime DEFAULT NULL,
  `IsActive` bit(1) NOT NULL,
  `FK_FinancialID` int NOT NULL,
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `DeviceID` varchar(20) DEFAULT NULL,
  `Location` varchar(20) NOT NULL,
  `FK_DealerID` int NOT NULL,
  `OrderNo` varchar(20) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `FK_StatusID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans_visitentry`
--

CREATE TABLE `tbl_trans_visitentry` (
  `PK_VisitID` int NOT NULL,
  `FK_UserID` int NOT NULL,
  `FK_DealerID` int NOT NULL,
  `FK_LocationID` int NOT NULL,
  `FK_CompanyID` int NOT NULL,
  `Visit_Image` text NOT NULL,
  `Location` varchar(500) NOT NULL,
  `Country` varchar(200) NOT NULL,
  `State` varchar(200) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Latitude` varchar(200) NOT NULL,
  `Longitute` varchar(200) NOT NULL,
  `VisitDate` datetime NOT NULL,
  `VisitStatus` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_master_bank`
--
ALTER TABLE `tbl_master_bank`
  ADD PRIMARY KEY (`PK_BankId`);

--
-- Indexes for table `tbl_master_brand`
--
ALTER TABLE `tbl_master_brand`
  ADD PRIMARY KEY (`PK_BrandID`);

--
-- Indexes for table `tbl_master_company`
--
ALTER TABLE `tbl_master_company`
  ADD PRIMARY KEY (`PK_CompanyID`);

--
-- Indexes for table `tbl_master_dealerinformation`
--
ALTER TABLE `tbl_master_dealerinformation`
  ADD PRIMARY KEY (`PK_DealerID`);

--
-- Indexes for table `tbl_master_financialyear`
--
ALTER TABLE `tbl_master_financialyear`
  ADD PRIMARY KEY (`PK_FinancialID`);

--
-- Indexes for table `tbl_master_location`
--
ALTER TABLE `tbl_master_location`
  ADD PRIMARY KEY (`PK_LocationID`),
  ADD KEY `FK_ModifyBy` (`FK_ModifyBy`);

--
-- Indexes for table `tbl_master_manager_salesexecutive`
--
ALTER TABLE `tbl_master_manager_salesexecutive`
  ADD PRIMARY KEY (`PK_Manager_SalesExecutiveID`);

--
-- Indexes for table `tbl_master_mobileappversion`
--
ALTER TABLE `tbl_master_mobileappversion`
  ADD PRIMARY KEY (`PK_VersionID`);

--
-- Indexes for table `tbl_master_productcategory`
--
ALTER TABLE `tbl_master_productcategory`
  ADD PRIMARY KEY (`PK_CategoryID`);

--
-- Indexes for table `tbl_master_productitem`
--
ALTER TABLE `tbl_master_productitem`
  ADD PRIMARY KEY (`PK_ProductID`);

--
-- Indexes for table `tbl_master_productitem_new`
--
ALTER TABLE `tbl_master_productitem_new`
  ADD PRIMARY KEY (`PK_ProductID`);

--
-- Indexes for table `tbl_master_usergroup`
--
ALTER TABLE `tbl_master_usergroup`
  ADD PRIMARY KEY (`PK_UserGroupID`);

--
-- Indexes for table `tbl_master_userinformation`
--
ALTER TABLE `tbl_master_userinformation`
  ADD PRIMARY KEY (`PK_UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`PK_StatusID`);

--
-- Indexes for table `tbl_trans_accountledger`
--
ALTER TABLE `tbl_trans_accountledger`
  ADD PRIMARY KEY (`PK_LedgerID`);

--
-- Indexes for table `tbl_trans_dealercollection`
--
ALTER TABLE `tbl_trans_dealercollection`
  ADD PRIMARY KEY (`PK_CollectionID`);

--
-- Indexes for table `tbl_trans_grndetails`
--
ALTER TABLE `tbl_trans_grndetails`
  ADD PRIMARY KEY (`PK_grnDetailsID`);

--
-- Indexes for table `tbl_trans_grnmaster`
--
ALTER TABLE `tbl_trans_grnmaster`
  ADD PRIMARY KEY (`PK_grnID`);

--
-- Indexes for table `tbl_trans_orderdetails`
--
ALTER TABLE `tbl_trans_orderdetails`
  ADD PRIMARY KEY (`PK_OrderDetailsID`);

--
-- Indexes for table `tbl_trans_ordermaster`
--
ALTER TABLE `tbl_trans_ordermaster`
  ADD PRIMARY KEY (`PK_OrderID`);

--
-- Indexes for table `tbl_trans_visitentry`
--
ALTER TABLE `tbl_trans_visitentry`
  ADD PRIMARY KEY (`PK_VisitID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_master_bank`
--
ALTER TABLE `tbl_master_bank`
  MODIFY `PK_BankId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_brand`
--
ALTER TABLE `tbl_master_brand`
  MODIFY `PK_BrandID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_company`
--
ALTER TABLE `tbl_master_company`
  MODIFY `PK_CompanyID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_dealerinformation`
--
ALTER TABLE `tbl_master_dealerinformation`
  MODIFY `PK_DealerID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_financialyear`
--
ALTER TABLE `tbl_master_financialyear`
  MODIFY `PK_FinancialID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_location`
--
ALTER TABLE `tbl_master_location`
  MODIFY `PK_LocationID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_manager_salesexecutive`
--
ALTER TABLE `tbl_master_manager_salesexecutive`
  MODIFY `PK_Manager_SalesExecutiveID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_mobileappversion`
--
ALTER TABLE `tbl_master_mobileappversion`
  MODIFY `PK_VersionID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_productcategory`
--
ALTER TABLE `tbl_master_productcategory`
  MODIFY `PK_CategoryID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_productitem`
--
ALTER TABLE `tbl_master_productitem`
  MODIFY `PK_ProductID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_productitem_new`
--
ALTER TABLE `tbl_master_productitem_new`
  MODIFY `PK_ProductID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_usergroup`
--
ALTER TABLE `tbl_master_usergroup`
  MODIFY `PK_UserGroupID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_master_userinformation`
--
ALTER TABLE `tbl_master_userinformation`
  MODIFY `PK_UserID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `PK_StatusID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_accountledger`
--
ALTER TABLE `tbl_trans_accountledger`
  MODIFY `PK_LedgerID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_dealercollection`
--
ALTER TABLE `tbl_trans_dealercollection`
  MODIFY `PK_CollectionID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_grndetails`
--
ALTER TABLE `tbl_trans_grndetails`
  MODIFY `PK_grnDetailsID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_grnmaster`
--
ALTER TABLE `tbl_trans_grnmaster`
  MODIFY `PK_grnID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_orderdetails`
--
ALTER TABLE `tbl_trans_orderdetails`
  MODIFY `PK_OrderDetailsID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_ordermaster`
--
ALTER TABLE `tbl_trans_ordermaster`
  MODIFY `PK_OrderID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_trans_visitentry`
--
ALTER TABLE `tbl_trans_visitentry`
  MODIFY `PK_VisitID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
