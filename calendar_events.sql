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
  `ADMIN_ID` int(8) AUTO_INCREMENT, 
  `EMAIL` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `PASSWORD` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `RANK` int(8) NOT NULL,
  `FULL_NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `TEMP_TOKEN` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY(`ADMIN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `ID` int(8) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `VENUE` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `START_TIME` datetime NOT NULL,
  `END_TIME` datetime NOT NULL,
  `CATEGORY` varchar(64) COLLATE utf8_unicode_ci,
  `DESCRIPTION` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `LINK` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `COST` decimal NOT NULL,
  `PHONE` varchar(15) NOT NULL,
  `EMAIL` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `UB_CAMPUS_LOCATION` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ADDITIONAL_FILES` blob NOT NULL,
  `APPROVAL_STATUS` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `APPROVED_BY` int(8),
  PRIMARY KEY(`ID`),
  CONSTRAINT FK_tbl_event_approved_by FOREIGN KEY (`APPROVED_BY`) REFERENCES `tbl_admin` (`ADMIN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------


CREATE TABLE `tbl_categories`(
	`CATEGORY_ID` int(8) auto_increment,
    `NAME` varchar(64) not null,
    `ICON` varchar(64) not null,
    PRIMARY KEY(`CATEGORY_ID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `tbl_event_categories`
--

CREATE TABLE `tbl_event_categories` (
  `EVENT_ID` int(8) NOT NULL,
  `CATEGORY_ID` int(8) NOT NULL,
  PRIMARY KEY(`EVENT_ID`, `CATEGORY_ID`),
  CONSTRAINT FK_tbl_event_categories_eventID FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_events` (`ID`),
  CONSTRAINT FK_tbl_event_categories_categoryID FOREIGN KEY (`CATEGORY_ID`) REFERENCES `tbl_categories` (`CATEGORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Table structure for table `tbl_event_contacts`
--

CREATE TABLE `tbl_event_contacts` (
  `CONTACT_ID` int(8) not null AUTO_INCREMENT,
  `EVENT_ID` int(8) NOT NULL,
  `CONTACT_TYPE` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `PERSON_NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ADDITIONAL_INFO` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY(`CONTACT_ID`),
  CONSTRAINT `tbl_event_contacts_ibfk_1` FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_events` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tbl_in_progress_events` (
  `ID` int(8) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `VENUE` varchar(64) COLLATE utf8_unicode_ci,
  `START_TIME` datetime ,
  `END_TIME` datetime ,
  `CATEGORY` varchar(64) COLLATE utf8_unicode_ci,
  `DESCRIPTION` varchar(1024) COLLATE utf8_unicode_ci,
  `LINK` varchar(1024) COLLATE utf8_unicode_ci ,
  `COST` decimal,
  `PHONE` varchar(15),
  `EMAIL` varchar(128) COLLATE utf8_unicode_ci,
  `UB_CAMPUS_LOCATION` varchar(255) COLLATE utf8_unicode_ci,
  `ADDITIONAL_FILES` blob NOT NULL,
  `APPROVAL_STATUS` varchar(32) COLLATE utf8_unicode_ci,
  `ADMIN_ID` int(8) NOT NULL,
  PRIMARY KEY(`ID`),
  CONSTRAINT FK_tbl_in_progress_event FOREIGN KEY (`ADMIN_ID`) REFERENCES `tbl_admin` (`ADMIN_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tbl_in_progress_event_categories` (
  `EVENT_ID` int(8) NOT NULL,
  `CATEGORY_ID` int(8) NOT NULL,
  PRIMARY KEY(`EVENT_ID`, `CATEGORY_ID`),
  CONSTRAINT FK_tbl_in_progress_event_categories_eventID FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_in_progress_events` (`ID`),
  CONSTRAINT FK_tbl_in_progress_event_categories_categoryID FOREIGN KEY (`CATEGORY_ID`) REFERENCES `tbl_categories` (`CATEGORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tbl_in_progress_event_contacts` (
  `CONTACT_ID` int(8) not null AUTO_INCREMENT,
  `EVENT_ID` int(8) NOT NULL,
  `CONTACT_TYPE` varchar(64) COLLATE utf8_unicode_ci,
  `PERSON_NAME` varchar(64) COLLATE utf8_unicode_ci ,
  `ADDITIONAL_INFO` varchar(255) COLLATE utf8_unicode_ci,
  PRIMARY KEY(`CONTACT_ID`),
  CONSTRAINT `tbl_in_progress_event_contacts_ibfk_1` FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_in_progress_events` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tbl_event_changes` (
  `ID` int(8) NOT NULL ,
  `NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `VENUE` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `START_TIME` datetime NOT NULL,
  `END_TIME` datetime NOT NULL,
  `CATEGORY` varchar(64) COLLATE utf8_unicode_ci,
  `DESCRIPTION` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `LINK` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `COST` decimal NOT NULL,
  `PHONE` varchar(15) NOT NULL,
  `EMAIL` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `UB_CAMPUS_LOCATION` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ADDITIONAL_FILES` blob NOT NULL,
  `APPROVAL_STATUS` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY(`ID`),
  CONSTRAINT FK_tbl_event_changes_eventID  FOREIGN KEY (`ID`) REFERENCES `tbl_events`(`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `tbl_event_category_changes` (
  `EVENT_ID` int(8) NOT NULL,
  `CATEGORY_ID` int(8) NOT NULL,
  PRIMARY KEY(`EVENT_ID`, `CATEGORY_ID`),
  CONSTRAINT FK_tbl_event_category_changes_eventID FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_event_changes` (`ID`),
  CONSTRAINT FK_tbl_event_category_changes_categoryID FOREIGN KEY (`CATEGORY_ID`) REFERENCES `tbl_categories` (`CATEGORY_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `tbl_event_contact_changes` (
  `CONTACT_ID` int(8) not null AUTO_INCREMENT,
  `EVENT_ID` int(8) NOT NULL,
  `CONTACT_TYPE` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `PERSON_NAME` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `ADDITIONAL_INFO` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY(`CONTACT_ID`),
  CONSTRAINT `tbl_event_contact_changes_ibfk_1` FOREIGN KEY (`EVENT_ID`) REFERENCES `tbl_event_changes` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
