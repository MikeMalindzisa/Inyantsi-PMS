-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 22, 2021 at 03:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ncg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ncg_addresses`
--

CREATE TABLE `ncg_addresses` (
  `REC_ID` int(10) NOT NULL,
  `ADDRESS_TYPE` varchar(30) NOT NULL,
  `ADDRESS_LINE_ONE` varchar(80) NOT NULL,
  `ADDRESS_LINE_TWO` varchar(80) NOT NULL,
  `ADDRESS_LINE_THREE` varchar(80) NOT NULL,
  `ADDRESS_LINE_FOUR` varchar(80) NOT NULL,
  `STATUS` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `PRIORITY` enum('Primary','Secondary') NOT NULL DEFAULT 'Primary',
  `CLIENT_ID` int(10) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_addresses`
--

INSERT INTO `ncg_addresses` (`REC_ID`, `ADDRESS_TYPE`, `ADDRESS_LINE_ONE`, `ADDRESS_LINE_TWO`, `ADDRESS_LINE_THREE`, `ADDRESS_LINE_FOUR`, `STATUS`, `PRIORITY`, `CLIENT_ID`, `TIMESTAMP`) VALUES
(1, 'Office Address', 'Street Name', 'Plot Number', 'Town ', 'Country', 'Active', 'Primary', 1, '2021-01-11 09:23:42'),
(2, 'Office Address', 'Street Name', 'Plot Number', 'Town ', 'Country', 'Active', 'Primary', 2, '2021-01-22 10:59:54'),
(3, 'Office Address', '111 St', '112 Plot', 'Zulwini', 'Eswatini', 'Active', 'Primary', 3, '2021-03-15 05:30:26'),
(4, 'HQ Office Address', '111 St', '112 Plot', 'Mbabane', 'Eswatini', 'Active', 'Primary', 4, '2021-03-15 05:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_assignments`
--

CREATE TABLE `ncg_assignments` (
  `REC_ID` int(10) NOT NULL,
  `UID` int(10) NOT NULL,
  `PID` int(10) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_clients`
--

CREATE TABLE `ncg_clients` (
  `CUSTOMER_ID` int(10) NOT NULL,
  `CLIENT_NAME` varchar(60) NOT NULL,
  `DESCRIPTION` varchar(500) NOT NULL,
  `STATUS` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_clients`
--

INSERT INTO `ncg_clients` (`CUSTOMER_ID`, `CLIENT_NAME`, `DESCRIPTION`, `STATUS`, `TIMESTAMP`) VALUES
(1, 'Eswatini Government', 'The government of the Kingdommm', 'Active', '2021-01-11 09:23:42'),
(2, 'Outsoure Eswatini', 'System development company.', 'Active', '2021-01-22 10:59:53'),
(3, 'Eswatini Water Service Corporation', 'Water service company.', 'Active', '2021-03-15 05:30:26'),
(4, 'Eswatini Electricity Company', 'Electrical production and supply company.', 'Active', '2021-03-15 05:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_client_logos`
--

CREATE TABLE `ncg_client_logos` (
  `REC_ID` int(10) NOT NULL,
  `COMPANY_ID` int(10) NOT NULL,
  `LOGO` varchar(200) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_client_logos`
--

INSERT INTO `ncg_client_logos` (`REC_ID`, `COMPANY_ID`, `LOGO`, `TIMESTAMP`) VALUES
(1, 1, 'assets/repo/logos/CUS_IMG_JAN2021775866547.png', '2021-01-18 10:47:16'),
(2, 2, 'assets/repo/logos/CUS_IMG_JAN2021699682143.png', '2021-01-22 11:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_contacts`
--

CREATE TABLE `ncg_contacts` (
  `REC_ID` int(11) NOT NULL,
  `JOB_ROLE` varchar(30) NOT NULL,
  `CONTACT_TITLE` varchar(30) DEFAULT NULL,
  `CONTACT_INITIALS` varchar(10) DEFAULT NULL,
  `CONTACT_FULL_NAME` varchar(60) DEFAULT NULL,
  `CONTACT_TELL` varchar(20) DEFAULT NULL,
  `CONTACT_CELL` varchar(20) DEFAULT NULL,
  `CONTACT_EMAIL` varchar(60) DEFAULT NULL,
  `STATUS` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `PRIORITY` enum('Primary','Secondary') NOT NULL DEFAULT 'Primary',
  `CLIENT_ID` int(10) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_contacts`
--

INSERT INTO `ncg_contacts` (`REC_ID`, `JOB_ROLE`, `CONTACT_TITLE`, `CONTACT_INITIALS`, `CONTACT_FULL_NAME`, `CONTACT_TELL`, `CONTACT_CELL`, `CONTACT_EMAIL`, `STATUS`, `PRIORITY`, `CLIENT_ID`, `TIMESTAMP`) VALUES
(1, 'Md', 'Mr', 'J.', 'Jane Doe', '76000000', '76000000', 'jane@gov.sz', 'Active', 'Primary', 1, '2021-01-11 09:23:42'),
(2, 'Md', 'Mr', 'M.M', 'Maqhawe Mike Malindzisa', '+26879694662', '+26876694662', 'mike@outsourceszl.com', 'Active', 'Primary', 2, '2021-01-22 10:59:53'),
(3, 'Director', 'Mr', 'J.D', 'John Doe', '+(268) 4312 1212', '+(268) 7602 0000', 'john@swsc.co.sz', 'Active', 'Primary', 3, '2021-03-15 05:30:26'),
(4, 'Director', 'Mr', 'J.D', 'John Doe', '+(268) 4312 1212', '+(268) 7602 0000', 'john@eec.co.sz', 'Active', 'Primary', 4, '2021-03-15 05:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_delivery_dates`
--

CREATE TABLE `ncg_delivery_dates` (
  `REC_ID` int(10) NOT NULL,
  `PROJECT_ID` int(10) NOT NULL,
  `CREATED_BY` int(10) NOT NULL,
  `DATE_TYPE` enum('Delivery Date','Start Date') NOT NULL,
  `PREV_DATE` varchar(60) NOT NULL,
  `NEW_DATE` varchar(60) NOT NULL,
  `DATE_REASON` longtext NOT NULL,
  `DATE_DESC` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_external_users_info`
--

CREATE TABLE `ncg_external_users_info` (
  `REC_ID` int(10) NOT NULL,
  `USER_ID` int(10) NOT NULL,
  `USER_NAME` varchar(60) DEFAULT NULL,
  `USER_PHONE` varchar(20) DEFAULT NULL,
  `USER_EMAIL` varchar(60) DEFAULT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_external_users_info`
--

INSERT INTO `ncg_external_users_info` (`REC_ID`, `USER_ID`, `USER_NAME`, `USER_PHONE`, `USER_EMAIL`, `TIMESTAMP`) VALUES
(1, 3, 'Jane Doe', '76000000', 'jane@gov.sz', '2021-01-11 09:57:04'),
(4, 9, 'Mike Malindzisa', '76694662', 'projects@outsourceszl.com', '2021-03-10 00:31:50'),
(8, 13, 'Mangaliso Dlamini', '79000000', 'mangalisod@inyatsi.co.sz', '2021-03-10 08:11:11'),
(9, 14, 'Mike Malindzisa', '76694662', 'machaweml@gmail.com', '2021-03-10 08:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_internal_users_info`
--

CREATE TABLE `ncg_internal_users_info` (
  `REC_ID` int(10) NOT NULL,
  `USER_ID` int(10) NOT NULL,
  `NAME` varchar(60) DEFAULT NULL,
  `W_PHONE` varchar(20) DEFAULT NULL,
  `P_PHONE` varchar(20) DEFAULT NULL,
  `EXTERNSION` varchar(20) DEFAULT NULL,
  `W_EMAIL` varchar(60) DEFAULT NULL,
  `P_EMAIL` varchar(60) DEFAULT NULL,
  `DEPARTMENT` varchar(60) DEFAULT NULL,
  `IMAGE` varchar(200) DEFAULT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_internal_users_info`
--

INSERT INTO `ncg_internal_users_info` (`REC_ID`, `USER_ID`, `NAME`, `W_PHONE`, `P_PHONE`, `EXTERNSION`, `W_EMAIL`, `P_EMAIL`, `DEPARTMENT`, `IMAGE`, `TIMESTAMP`) VALUES
(1, 1, 'Test User', '76000000', '76000000', '2012', 'test@inyatsi.co.sz', 'test@inyatsi.co.sz', 'Logistics', NULL, '2021-01-11 08:59:40'),
(2, 2, 'John Doe', '76000000', NULL, NULL, 'john@inyatsi.co.sz', NULL, NULL, NULL, '2021-01-11 09:18:51'),
(5, 6, 'Outsource Eswatini', '79694662', '79694662', '2012', 'mike@outsourceszl.com', 'mike@outsourceszl.com', 'System Development', 'assets/repo/users/USR_IMG_JAN2021312823836.jpg', '2021-01-22 10:57:30'),
(6, 13, 'Mangaliso Dlamini', '79000000', NULL, NULL, 'mangalisod@inyatsi.co.sz', NULL, NULL, NULL, '2021-03-10 08:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_password_reset`
--

CREATE TABLE `ncg_password_reset` (
  `REC_ID` int(11) NOT NULL,
  `USER_ID` varchar(100) NOT NULL,
  `PASS_TOKEN` varchar(255) NOT NULL,
  `TOKEN_EXPIRATION` timestamp NULL DEFAULT NULL,
  `TOKEN_VALIDATION` tinyint(4) NOT NULL,
  `TOKEN_EXPIRED` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TOKEN_CREATED` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_password_reset`
--

INSERT INTO `ncg_password_reset` (`REC_ID`, `USER_ID`, `PASS_TOKEN`, `TOKEN_EXPIRATION`, `TOKEN_VALIDATION`, `TOKEN_EXPIRED`, `TOKEN_CREATED`) VALUES
(19, 'mike@outsourceszl.com', '70a32110fff0f26d301e58ebbca9cb9f', '2021-03-21 14:43:46', 0, '2021-03-21 20:29:02', '2021-03-21 20:29:02'),
(20, 'mike@outsourceszl.com', '15c00b5250ddedaabc203b67f8b034fd', '2021-03-22 06:34:57', 0, '2021-03-21 20:29:02', '2021-03-21 20:29:02'),
(21, 'mike@outsourceszl.com', '6f0ca67289d79eb35d19decbc0a08453', '2021-03-22 07:05:19', 0, '2021-03-21 20:29:02', '2021-03-21 20:29:02'),
(22, 'mike@outsourceszl.com', 'LOOCNh5RHygabWsvzEE6iNUpMF/nB5eAkaV9IfIWbcdu8DWXmk+9fBi8lmnwaKElUWBAR5FOG/NcUcxCsjDJ7g==', '2021-03-22 07:09:00', 0, '2021-03-21 20:29:02', '2021-03-21 20:29:02'),
(23, 'mike@outsourceszl.com', '1d94108e907bb8311d8802b48fd54b4a', '2021-03-22 07:24:15', 0, '2021-03-21 20:29:02', '2021-03-21 20:29:02');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_payment_certificates`
--

CREATE TABLE `ncg_payment_certificates` (
  `REC_ID` int(10) NOT NULL,
  `PROJECT_ID` int(10) NOT NULL,
  `CREATED_BY` int(10) NOT NULL,
  `CERT_AMOUNT` decimal(15,2) NOT NULL,
  `CERT_REASON` longtext NOT NULL,
  `CERT_DESC` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_privacy`
--

CREATE TABLE `ncg_privacy` (
  `REC_ID` int(10) NOT NULL,
  `NCG_PRIVACY` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_privacy`
--

INSERT INTO `ncg_privacy` (`REC_ID`, `NCG_PRIVACY`, `TIMESTAMP`) VALUES
(3, 'policy.php', '2020-12-15 05:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_projects`
--

CREATE TABLE `ncg_projects` (
  `PROJECT_ID` int(100) NOT NULL,
  `ADDED_BY` int(10) NOT NULL,
  `CUSTOMER_ID` int(10) NOT NULL DEFAULT 0,
  `STATUS` enum('Complete','Ongoing','Terminated') NOT NULL DEFAULT 'Ongoing',
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_project_finances`
--

CREATE TABLE `ncg_project_finances` (
  `REC_ID` int(10) NOT NULL,
  `PROJECT_ID` int(10) NOT NULL,
  `VARIATION_VALUE` decimal(15,2) NOT NULL DEFAULT 0.00,
  `PAYMENT_VALUE` decimal(15,2) NOT NULL DEFAULT 0.00,
  `CURRENT_VALUE` decimal(15,2) NOT NULL,
  `REMAINING_VALUE` decimal(15,2) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_project_info`
--

CREATE TABLE `ncg_project_info` (
  `REC_ID` int(10) NOT NULL,
  `PROJECT_ID` int(10) NOT NULL,
  `PROJECT_NAME` varchar(120) DEFAULT NULL,
  `CONTRACT_DATE` varchar(60) NOT NULL,
  `BASE_START` varchar(60) NOT NULL,
  `BASE_END` varchar(60) NOT NULL,
  `START_DATE` varchar(60) NOT NULL,
  `END_DATE` varchar(60) NOT NULL,
  `PROJECT_PROGRESS` int(3) NOT NULL,
  `CONTRACT_VALUE` decimal(15,2) NOT NULL,
  `CURRENCY` varchar(10) NOT NULL,
  `PROJECT_DESC` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_security_external_members`
--

CREATE TABLE `ncg_security_external_members` (
  `REC_ID` int(10) NOT NULL,
  `USER_ID` int(10) NOT NULL,
  `GROUP_ID` int(10) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_security_external_members`
--

INSERT INTO `ncg_security_external_members` (`REC_ID`, `USER_ID`, `GROUP_ID`, `TIMESTAMP`) VALUES
(1, 3, 1, '2021-01-11 09:57:04'),
(4, 9, 1, '2021-03-10 00:31:58'),
(5, 10, 1, '2021-03-10 00:39:32'),
(6, 12, 1, '2021-03-10 08:00:24'),
(7, 13, 1, '2021-03-10 08:11:15'),
(8, 14, 1, '2021-03-10 08:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_security_groups`
--

CREATE TABLE `ncg_security_groups` (
  `REC_ID` int(10) NOT NULL,
  `GRP_NAME` varchar(60) NOT NULL,
  `PERMISSIONS` varchar(30) NOT NULL,
  `DOMAIN` enum('External','Internal') NOT NULL,
  `STATUS` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `FACILITATOR` int(10) DEFAULT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_security_groups`
--

INSERT INTO `ncg_security_groups` (`REC_ID`, `GRP_NAME`, `PERMISSIONS`, `DOMAIN`, `STATUS`, `FACILITATOR`, `TIMESTAMP`) VALUES
(1, 'Customers', 'R', 'External', 'Active', NULL, '2021-01-11 01:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_security_internal_members`
--

CREATE TABLE `ncg_security_internal_members` (
  `REC_ID` int(10) NOT NULL,
  `USER_ID` int(10) NOT NULL,
  `GROUP_ID` int(10) NOT NULL,
  `ROLE` enum('Member','Facilitator') NOT NULL DEFAULT 'Member',
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_set_about`
--

CREATE TABLE `ncg_set_about` (
  `REC_ID` int(10) NOT NULL,
  `ABOUT_TITLE` varchar(60) NOT NULL,
  `ABOUT_CONTENT` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_set_about_us`
--

CREATE TABLE `ncg_set_about_us` (
  `REC_ID` int(11) NOT NULL,
  `ITEM_TITLE` varchar(120) NOT NULL,
  `ITEM_CONTENT` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_set_about_us`
--

INSERT INTO `ncg_set_about_us` (`REC_ID`, `ITEM_TITLE`, `ITEM_CONTENT`, `TIMESTAMP`) VALUES
(1, 'Electrification', 'qF6AR0c6ww3NCJQsOVcuGKrWFZxGRhq2A+HvT0PlvR3HIz+y3bfZbaF1Anc+oxTIcEOfvlHS6rMkuWjMKee0NPgBXPXsWfRZ+rl4DbCpXUmQUzCcWfaVN+agF2m4qikTu5+zLQSDJPHy0kWQhNoByfjIre4DOwaMZx+hVqfDah8=', '2021-01-11 09:53:12'),
(2, 'Purification', 'nDvyKHM8X3lEJduZwtCaBbYV6wQlwiUV9LVe4TrpgK+1I9ChE7j5rCkudQTmsv0Er3s6bPOAVmIuMvdDitEnEBVJIDqkQUC1mvamCu7rp9VBFE23SFmSnIED5enu972ZgMsl74NlhBGZftprg15FB/9pWx8ls/fmwoBm6yOeY/iOoJpxIUY5uvt1Q4lT0F0aXnn6pcjKu7dX0js8eMOuhyxeu8k8ElDtA3HwhdqQj9T7Xf3hw+85ng4Hh1GB3aSbHW87W2xTVPmm+7jqgoPkMg==', '2021-01-22 11:32:44');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_set_contacts`
--

CREATE TABLE `ncg_set_contacts` (
  `REC_ID` int(10) NOT NULL,
  `CON_SET_ID` int(10) NOT NULL,
  `CON_SET_TYPE` varchar(60) NOT NULL,
  `CON_SET_VALUE` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_set_contacts`
--

INSERT INTO `ncg_set_contacts` (`REC_ID`, `CON_SET_ID`, `CON_SET_TYPE`, `CON_SET_VALUE`) VALUES
(1, 1, 'TEL', '23000000'),
(2, 1, 'Cell', '76694662');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_set_contact_us`
--

CREATE TABLE `ncg_set_contact_us` (
  `REC_ID` int(10) NOT NULL,
  `REC_TITLE` varchar(60) NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_set_contact_us`
--

INSERT INTO `ncg_set_contact_us` (`REC_ID`, `REC_TITLE`, `TIMESTAMP`) VALUES
(1, 'Inyatsi House', '2021-01-11 09:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_set_location`
--

CREATE TABLE `ncg_set_location` (
  `REC_ID` int(10) NOT NULL,
  `ADD_SET_ID` int(10) NOT NULL,
  `LINE_1` varchar(60) NOT NULL,
  `LINE_2` varchar(60) NOT NULL,
  `LINE_3` varchar(60) NOT NULL,
  `LINE_4` varchar(60) NOT NULL,
  `LINE_5` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_set_location`
--

INSERT INTO `ncg_set_location` (`REC_ID`, `ADD_SET_ID`, `LINE_1`, `LINE_2`, `LINE_3`, `LINE_4`, `LINE_5`) VALUES
(1, 1, 'Inyasti House', '1212 Plot', 'dr Hynd', 'Manzini', 'Eswatini'),
(2, 1, 'NCC Mocambique', '1212 Plot', 'Edwardo Mondlane', 'Maputo', 'Macambique');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_set_postal`
--

CREATE TABLE `ncg_set_postal` (
  `REC_ID` int(11) NOT NULL,
  `POS_SET_ID` int(11) NOT NULL,
  `LINE_1` varchar(60) NOT NULL,
  `LINE_2` varchar(60) NOT NULL,
  `LINE_3` varchar(60) NOT NULL,
  `LINE_4` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_set_postal`
--

INSERT INTO `ncg_set_postal` (`REC_ID`, `POS_SET_ID`, `LINE_1`, `LINE_2`, `LINE_3`, `LINE_4`) VALUES
(0, 1, '12', 'Manzini', 'Eswatini', 'M200'),
(0, 1, '2341', 'Maputo', 'Mocambique', 'MZ 210');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_smtp_settings`
--

CREATE TABLE `ncg_smtp_settings` (
  `REC_ID` int(11) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `SMTP_SERVER` varchar(300) NOT NULL,
  `SMTP_PORT_DEFAULT` varchar(200) NOT NULL,
  `SMTP_PORT` varchar(200) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `SMTP_AUTH` varchar(300) NOT NULL,
  `SMTP_SECURE` varchar(200) NOT NULL,
  `STATUS` varchar(100) NOT NULL DEFAULT 'Active',
  `UPDATED` timestamp NOT NULL DEFAULT current_timestamp(),
  `ADDED` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_smtp_settings`
--

INSERT INTO `ncg_smtp_settings` (`REC_ID`, `EMAIL`, `SMTP_SERVER`, `SMTP_PORT_DEFAULT`, `SMTP_PORT`, `PASSWORD`, `SMTP_AUTH`, `SMTP_SECURE`, `STATUS`, `UPDATED`, `ADDED`) VALUES
(6, '8BVVgv/KYUUPCxhzF9EU9m5utZm9lE8U44yJOJ9vay5rZ7ahcapeeD8NLG5X8k8acshOz9BVtptyVat0zstzKWXEcKAEhGYZpacIVwnmCyI=', 'LhlIUAFRf74VCjgzPPHd9smIwFsgeM+r47WykdFusvd3hZJZ6nyb+jXHdCEWdLfYK56DrsAB76bRlMJsZZZw7hrDp6fCZ8HoZupS8Jiyv28=', 'e2bW/rCNP2ztH0Gngx7s4Aa3adNWltTIKXDW0jw+5Z5p50YOBKrf6sSugfppE4H1U63+YmKEPMFbrJIjF1khsA==', 'e6y9du+qafsbt+ClisI/FKqYCoNG8VA8LMHFuTF9A4gDwfdWU3MG97830KfYTIIAtV+82ACSRpJOdTtR/ucCnA==', 'IF74r9a11iCxPcdq/PVRzdsUUSo5QsiHa1RHXBypEgnJOaRN2YPlOXhDpQlmK6FrKUFY4bA+mPrhsokAtamC2A==', 'kYZ0DCtZLvGZSiUVFEvrxbB+zr83MXfuajaVOdndX4cP4st7oswzb3CIBuXLo7jU3wQ3B72vfBPolgbGPV8qeg==', '0GiX28c3SGFMSDimiXL1Rhr+VUkF/JTSPQWzhNY6qo3G4I8ouGbEXIyjuoFk2cbPURhi8xZI+b1QaUUjX2jmnA==', '', '2021-03-22 10:01:08', '2021-03-22 09:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_terms`
--

CREATE TABLE `ncg_terms` (
  `REC_ID` int(10) NOT NULL,
  `NCG_TERMS` longtext NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_terms`
--

INSERT INTO `ncg_terms` (`REC_ID`, `NCG_TERMS`, `TIMESTAMP`) VALUES
(1, 'terms.php', '2020-12-15 05:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_users`
--

CREATE TABLE `ncg_users` (
  `REC_ID` int(10) NOT NULL,
  `USER_ID` varchar(60) NOT NULL,
  `PASS` varchar(20000) NOT NULL,
  `ROLE` enum('User','Admin','Customer') NOT NULL DEFAULT 'User',
  `STATUS` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `AFFILIATION` int(10) DEFAULT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ncg_users`
--

INSERT INTO `ncg_users` (`REC_ID`, `USER_ID`, `PASS`, `ROLE`, `STATUS`, `AFFILIATION`, `TIMESTAMP`) VALUES
(1, 'test@inyatsi.co.sz', '1a1dc91c907325c69271ddf0c944bc72', 'Admin', 'Active', NULL, '2021-03-14 19:55:39'),
(2, 'john@inyatsi.co.sz', '1a1dc91c907325c69271ddf0c944bc72', 'User', 'Active', NULL, '2021-03-13 22:58:19'),
(3, 'jane@gov.sz', 'c1572d05424d0ecb2a65ec6a82aeacbf', 'Customer', 'Active', 1, '2021-03-21 21:38:24'),
(6, 'mike@outsourceszl.com', '1a1dc91c907325c69271ddf0c944bc72', 'Admin', 'Active', NULL, '2021-03-21 22:05:37'),
(9, 'projects@outsourceszl.com', '1a1dc91c907325c69271ddf0c944bc72', 'Customer', 'Active', 2, '2021-03-10 00:31:50'),
(13, 'mangalisod@inyatsi.co.sz', '1a1dc91c907325c69271ddf0c944bc72', 'User', 'Active', NULL, '2021-03-15 05:55:59'),
(14, 'machaweml@gmail.com', '1a1dc91c907325c69271ddf0c944bc72', 'Customer', 'Active', 2, '2021-03-10 08:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `ncg_user_notification`
--

CREATE TABLE `ncg_user_notification` (
  `NOTIFICATION_ID` int(10) NOT NULL,
  `UID` int(10) NOT NULL,
  `MESSAGE` text DEFAULT NULL,
  `TYPE` enum('success','warning','error') NOT NULL DEFAULT 'success',
  `STATUS` int(2) NOT NULL DEFAULT 0,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncg_variation_orders`
--

CREATE TABLE `ncg_variation_orders` (
  `REC_ID` int(10) NOT NULL,
  `PROJECT_ID` int(10) NOT NULL,
  `CREATED_BY` int(10) NOT NULL,
  `PREV_CONTRACT_VALUE` decimal(15,2) NOT NULL,
  `VO_AMOUNT` decimal(15,2) NOT NULL,
  `NEW_CONTRACT_VALUE` decimal(15,2) NOT NULL,
  `VO_REASON` longtext NOT NULL,
  `VO_DESC` longtext NOT NULL,
  `VO_STATUS` enum('Ongoing','Complete','Terminated') NOT NULL,
  `TIMESTAMP` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ncg_addresses`
--
ALTER TABLE `ncg_addresses`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_assignments`
--
ALTER TABLE `ncg_assignments`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_clients`
--
ALTER TABLE `ncg_clients`
  ADD PRIMARY KEY (`CUSTOMER_ID`);

--
-- Indexes for table `ncg_client_logos`
--
ALTER TABLE `ncg_client_logos`
  ADD PRIMARY KEY (`REC_ID`),
  ADD UNIQUE KEY `COMPANY_ID` (`COMPANY_ID`);

--
-- Indexes for table `ncg_contacts`
--
ALTER TABLE `ncg_contacts`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_delivery_dates`
--
ALTER TABLE `ncg_delivery_dates`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_external_users_info`
--
ALTER TABLE `ncg_external_users_info`
  ADD PRIMARY KEY (`REC_ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `ncg_internal_users_info`
--
ALTER TABLE `ncg_internal_users_info`
  ADD PRIMARY KEY (`REC_ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `ncg_password_reset`
--
ALTER TABLE `ncg_password_reset`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_payment_certificates`
--
ALTER TABLE `ncg_payment_certificates`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_privacy`
--
ALTER TABLE `ncg_privacy`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_projects`
--
ALTER TABLE `ncg_projects`
  ADD PRIMARY KEY (`PROJECT_ID`);

--
-- Indexes for table `ncg_project_finances`
--
ALTER TABLE `ncg_project_finances`
  ADD PRIMARY KEY (`REC_ID`),
  ADD UNIQUE KEY `PROJECT_ID` (`PROJECT_ID`);

--
-- Indexes for table `ncg_project_info`
--
ALTER TABLE `ncg_project_info`
  ADD PRIMARY KEY (`REC_ID`),
  ADD UNIQUE KEY `PROJECT_ID` (`PROJECT_ID`);

--
-- Indexes for table `ncg_security_external_members`
--
ALTER TABLE `ncg_security_external_members`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_security_groups`
--
ALTER TABLE `ncg_security_groups`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_security_internal_members`
--
ALTER TABLE `ncg_security_internal_members`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_set_about`
--
ALTER TABLE `ncg_set_about`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_set_about_us`
--
ALTER TABLE `ncg_set_about_us`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_set_contacts`
--
ALTER TABLE `ncg_set_contacts`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_set_contact_us`
--
ALTER TABLE `ncg_set_contact_us`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_set_location`
--
ALTER TABLE `ncg_set_location`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_smtp_settings`
--
ALTER TABLE `ncg_smtp_settings`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_terms`
--
ALTER TABLE `ncg_terms`
  ADD PRIMARY KEY (`REC_ID`);

--
-- Indexes for table `ncg_users`
--
ALTER TABLE `ncg_users`
  ADD PRIMARY KEY (`REC_ID`),
  ADD UNIQUE KEY `USER_ID` (`USER_ID`);

--
-- Indexes for table `ncg_user_notification`
--
ALTER TABLE `ncg_user_notification`
  ADD PRIMARY KEY (`NOTIFICATION_ID`);

--
-- Indexes for table `ncg_variation_orders`
--
ALTER TABLE `ncg_variation_orders`
  ADD PRIMARY KEY (`REC_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ncg_addresses`
--
ALTER TABLE `ncg_addresses`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ncg_assignments`
--
ALTER TABLE `ncg_assignments`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_clients`
--
ALTER TABLE `ncg_clients`
  MODIFY `CUSTOMER_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ncg_client_logos`
--
ALTER TABLE `ncg_client_logos`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ncg_contacts`
--
ALTER TABLE `ncg_contacts`
  MODIFY `REC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ncg_delivery_dates`
--
ALTER TABLE `ncg_delivery_dates`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_external_users_info`
--
ALTER TABLE `ncg_external_users_info`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ncg_internal_users_info`
--
ALTER TABLE `ncg_internal_users_info`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ncg_password_reset`
--
ALTER TABLE `ncg_password_reset`
  MODIFY `REC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ncg_payment_certificates`
--
ALTER TABLE `ncg_payment_certificates`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_privacy`
--
ALTER TABLE `ncg_privacy`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ncg_projects`
--
ALTER TABLE `ncg_projects`
  MODIFY `PROJECT_ID` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_project_finances`
--
ALTER TABLE `ncg_project_finances`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_project_info`
--
ALTER TABLE `ncg_project_info`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_security_external_members`
--
ALTER TABLE `ncg_security_external_members`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ncg_security_groups`
--
ALTER TABLE `ncg_security_groups`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ncg_security_internal_members`
--
ALTER TABLE `ncg_security_internal_members`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_set_about`
--
ALTER TABLE `ncg_set_about`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_set_about_us`
--
ALTER TABLE `ncg_set_about_us`
  MODIFY `REC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ncg_set_contacts`
--
ALTER TABLE `ncg_set_contacts`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ncg_set_contact_us`
--
ALTER TABLE `ncg_set_contact_us`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ncg_set_location`
--
ALTER TABLE `ncg_set_location`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ncg_smtp_settings`
--
ALTER TABLE `ncg_smtp_settings`
  MODIFY `REC_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ncg_terms`
--
ALTER TABLE `ncg_terms`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ncg_users`
--
ALTER TABLE `ncg_users`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ncg_user_notification`
--
ALTER TABLE `ncg_user_notification`
  MODIFY `NOTIFICATION_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncg_variation_orders`
--
ALTER TABLE `ncg_variation_orders`
  MODIFY `REC_ID` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
