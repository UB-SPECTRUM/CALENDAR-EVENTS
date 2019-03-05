-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2019 at 11:45 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendar_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `EMAIL` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `RANK` int(8) NOT NULL,
  `FULL_NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `TEMP_TOKEN` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `ID` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `VENUE` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `TIME` datetime NOT NULL,
  `CATEGORY` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `DESCRIPTION` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `LINK` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `COST` double NOT NULL,
  `PHONE` int(10) NOT NULL,
  `EMAIL` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `ADDITIONAL_FILES` blob NOT NULL,
  `APPROVAL_STATUS` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_categories`
--

CREATE TABLE `tbl_event_categories` (
  `EVENT_ID` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `CATEGORY` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_contacts`
--

CREATE TABLE `tbl_event_contacts` (
  `EVENT_ID` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `CONTACT_TYPE` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `PERSON_NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ADDITIONAL_INFO` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_event_categories`
--
ALTER TABLE `tbl_event_categories`
  ADD PRIMARY KEY (`EVENT_ID`);

--
-- Indexes for table `tbl_event_contacts`
--
ALTER TABLE `tbl_event_contacts`
  ADD PRIMARY KEY (`EVENT_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_event_categories`
--
ALTER TABLE `tbl_event_categories`
  ADD CONSTRAINT `tbl_event_categories_ibfk_1` FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_events` (`ID`);

--
-- Constraints for table `tbl_event_contacts`
--
ALTER TABLE `tbl_event_contacts`
  ADD CONSTRAINT `tbl_event_contacts_ibfk_1` FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_events` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
