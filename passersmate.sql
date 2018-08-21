-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 21, 2018 at 12:16 PM
-- Server version: 10.2.8-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `passersmate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`AdminID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `username`, `email`, `password`) VALUES
(1, 'syrel', 'test@gmail.com', '$2y$12$A5beirOzKPlwQUpZAHe4YuM1jgWRkGOrWdhFMh/5RJCzN04TjVj/i'),
(2, 'crimson', 'francoyogie@gmail.com', '$2y$12$as7ENGvmZtzGqUns2n23VeME0QTxt9ORwDzHSP31O3JenOVpvOATm'),
(3, 'test', 'qweee@gmail.com', '$2y$12$lPC0SBHSHnbUqFeT1Etvu.YACEGPZweAot65MvI5n55BDIPloz0hu'),
(4, 'crimsonadmin', 'crimson@gmail.com', '$2y$12$drMX/W2kLszEMn.FvraJu.yk3IWOFeZ7zchKr2ditnO8E1qEJFqn6');

-- --------------------------------------------------------

--
-- Table structure for table `agreement`
--

DROP TABLE IF EXISTS `agreement`;
CREATE TABLE IF NOT EXISTS `agreement` (
  `AgreementID` int(11) NOT NULL AUTO_INCREMENT,
  `SeekerID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `OfferJobFormID` int(11) NOT NULL,
  `AgreementDateandTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `AgreementNotes` text DEFAULT NULL,
  `AgreementStatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`AgreementID`),
  KEY `PasserID` (`PasserID`),
  KEY `SeekerID` (`SeekerID`),
  KEY `OfferJobFormID` (`OfferJobFormID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `canceljob`
--

DROP TABLE IF EXISTS `canceljob`;
CREATE TABLE IF NOT EXISTS `canceljob` (
  `CancelJobID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferJobID` int(11) NOT NULL,
  `CancelDate` date NOT NULL,
  `CancelTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `CancelReason` varchar(255) NOT NULL,
  `CancelStatus` varchar(255) NOT NULL,
  PRIMARY KEY (`CancelJobID`),
  KEY `OfferJobID` (`OfferJobID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificateofemployment`
--

DROP TABLE IF EXISTS `certificateofemployment`;
CREATE TABLE IF NOT EXISTS `certificateofemployment` (
  `CertificateOfEmploymentID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferJobID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `GeneratedKey` varchar(255) NOT NULL,
  PRIMARY KEY (`CertificateOfEmploymentID`),
  KEY `OfferJobID` (`OfferJobID`),
  KEY `AdminID` (`AdminID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disabledusers`
--

DROP TABLE IF EXISTS `disabledusers`;
CREATE TABLE IF NOT EXISTS `disabledusers` (
  `DisableUserID` int(11) NOT NULL AUTO_INCREMENT,
  `PasserID` int(11) DEFAULT NULL,
  `SeekerID` int(11) DEFAULT NULL,
  `DeactivateReason` text NOT NULL,
  PRIMARY KEY (`DisableUserID`),
  KEY `PasserID` (`PasserID`),
  KEY `SeekerID` (`SeekerID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disabledusers`
--

INSERT INTO `disabledusers` (`DisableUserID`, `PasserID`, `SeekerID`, `DeactivateReason`) VALUES
(1, 1, NULL, 'Temporary'),
(2, NULL, 3, 'noJobs'),
(3, NULL, 3, 'unNeeded');

-- --------------------------------------------------------

--
-- Table structure for table `dispute`
--

DROP TABLE IF EXISTS `dispute`;
CREATE TABLE IF NOT EXISTS `dispute` (
  `DisputeID` int(11) NOT NULL AUTO_INCREMENT,
  `offerJobID` int(11) NOT NULL,
  `DisputeDate` date NOT NULL,
  `DisputeTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DisputeDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`DisputeID`),
  KEY `offerJobID` (`offerJobID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `DocFormsID` int(11) NOT NULL AUTO_INCREMENT,
  `DocFormsName` varchar(255) NOT NULL,
  `DocFormsType` varchar(255) NOT NULL,
  `DocFormsStatus` varchar(255) NOT NULL,
  PRIMARY KEY (`DocFormsID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`DocFormsID`, `DocFormsName`, `DocFormsType`, `DocFormsStatus`) VALUES
(1, 'name', 'type', 'status');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `MessageID` int(11) NOT NULL AUTO_INCREMENT,
  `PasserID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `MessageContent` text DEFAULT NULL,
  `MessageSender` varchar(255) DEFAULT NULL,
  `MessageTimeAndDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `MessageStatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`MessageID`),
  KEY `PasserID` (`PasserID`),
  KEY `SeekerID` (`SeekerID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageID`, `PasserID`, `SeekerID`, `MessageContent`, `MessageSender`, `MessageTimeAndDate`, `MessageStatus`) VALUES
(1, 1, 2, NULL, NULL, '2018-08-11 11:31:24', 0),
(2, 1, 3, 'hello', 'Seeker', '2018-08-11 11:33:46', 0),
(3, 1, 3, 'hi', 'Passer', '2018-08-11 13:41:05', 0),
(4, 1, 3, 'what\'s up?', 'Passer', '2018-08-11 13:41:14', 0),
(5, 1, 3, '&lt;script&gt;alert(&quot;qwe&quot;)&lt;/script&gt;', 'Passer', '2018-08-11 13:41:26', 0),
(6, 1, 3, 'no xss', 'Passer', '2018-08-11 13:42:10', 0),
(7, 1, 3, '&lt;script&gt;alert(&quot;qwe&quot;)&lt;/script&gt;', 'Passer', '2018-08-11 13:42:56', 0),
(8, 1, 3, 'qwe', 'Seeker', '2018-08-11 14:12:13', 0),
(9, 1, 3, 'qwe', 'Seeker', '2018-08-11 14:18:01', 0),
(10, 1, 3, 'zxcxz', 'Seeker', '2018-08-11 14:18:04', 0),
(11, 1, 3, 'qweqweqwe', 'Seeker', '2018-08-11 14:21:49', 0),
(12, 1, 3, 'wew', 'Seeker', '2018-08-11 14:24:37', 0),
(13, 1, 3, 'qwe', 'Seeker', '2018-08-11 14:24:43', 0),
(14, 1, 3, 'asd', 'Passer', '2018-08-11 16:12:39', 0),
(15, 4, 3, '', '', '2018-08-12 04:48:39', 0),
(16, 4, 3, 'hello', 'Seeker', '2018-08-12 04:48:53', 0),
(18, 4, 3, 'hi', 'Seeker', '2018-08-12 11:22:15', 0),
(19, 5, 3, '', '', '2018-08-12 19:48:59', 0),
(20, 5, 3, 'Hello', 'Seeker', '2018-08-12 19:49:16', 0),
(21, 5, 3, 'BABA', 'Seeker', '2018-08-12 19:49:21', 0),
(22, 1, 3, 'qwe', 'Seeker', '2018-08-12 20:04:28', 0),
(23, 1, 3, 'tqet', 'Seeker', '2018-08-12 20:06:31', 0),
(24, 1, 3, 'qwe', 'Seeker', '2018-08-12 20:14:04', 0),
(25, 1, 3, 'qwe', 'Seeker', '2018-08-12 20:14:35', 0),
(26, 1, 3, 'ewq', 'Passer', '2018-08-12 20:14:38', 0),
(27, 1, 3, 'trtrtr', 'Passer', '2018-08-12 20:32:25', 0),
(28, 1, 3, 'qw', 'Seeker', '2018-08-19 09:25:57', 0),
(29, 1, 2, NULL, NULL, '2018-08-19 12:10:28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `multimedia`
--

DROP TABLE IF EXISTS `multimedia`;
CREATE TABLE IF NOT EXISTS `multimedia` (
  `MultimediaID` int(11) NOT NULL AUTO_INCREMENT,
  `PasserID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `Multimedia` blob NOT NULL,
  `MultimediaDateUploaded` varchar(255) NOT NULL,
  `MultimediaDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`MultimediaID`),
  KEY `PasserID` (`PasserID`),
  KEY `SeekerID` (`SeekerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notificationID` int(11) NOT NULL AUTO_INCREMENT,
  `SeekerID` int(11) DEFAULT NULL,
  `PasserID` int(11) DEFAULT NULL,
  `notificationType` varchar(255) NOT NULL,
  `notificationMessage` text NOT NULL,
  `notificationStatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`notificationID`),
  KEY `PasserID` (`PasserID`),
  KEY `SeekerID` (`SeekerID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notificationID`, `SeekerID`, `PasserID`, `notificationType`, `notificationMessage`, `notificationStatus`) VALUES
(1, NULL, 1, 'updateUserStatus', '1', 0),
(2, NULL, 5, 'updateUserStatus', '1', 0),
(3, 2, NULL, 'updateUserStatus', '1', 0),
(4, 2, NULL, 'subscription', '1', 0),
(5, 1, NULL, 'subscription', '1', 0),
(6, 4, NULL, 'updateUserStatus', '1', 0),
(7, 3, NULL, 'subscription', '1', 0),
(8, 3, NULL, 'subscription', '2', 0),
(9, 3, NULL, 'subscription', '2', 0),
(10, 3, NULL, 'subscription', '1', 0),
(11, 3, NULL, 'subscription', '2', 0),
(12, 3, NULL, 'subscription', '2', 0),
(13, 3, NULL, 'subscription', '2', 0),
(14, NULL, 6, 'updateUserStatus', '1', 0),
(15, 3, NULL, 'subscription', '1', 0),
(16, 3, NULL, 'subscription', '2', 0),
(17, 3, NULL, 'subscription', '2', 0),
(18, 3, NULL, 'subscription', '2', 0),
(19, 3, NULL, 'subscription', '1', 0),
(20, NULL, 1, 'JobOffer', '1', 0),
(21, 3, NULL, 'subscription', '2', 0),
(22, NULL, 1, 'JobOffer', '1', 0),
(23, NULL, 4, 'JobOffer', '1', 1),
(24, NULL, 1, 'JobOffer', '1', 0),
(25, NULL, 1, 'JobOffer', '1', 0),
(26, NULL, 1, 'JobOffer', '1', 0),
(27, NULL, 4, 'JobOffer', '1', 1),
(28, NULL, 5, 'JobOffer', '1', 1),
(29, NULL, 1, 'JobOffer', '1', 0),
(30, 3, NULL, 'subscription', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `offerjob`
--

DROP TABLE IF EXISTS `offerjob`;
CREATE TABLE IF NOT EXISTS `offerjob` (
  `OfferJobID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferJobFormID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `Notes` text DEFAULT NULL,
  `OfferJobDateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `OfferJobStatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`OfferJobID`),
  KEY `SeekerID` (`SeekerID`),
  KEY `PasserID` (`PasserID`),
  KEY `OfferJobFormID` (`OfferJobFormID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerjob`
--

INSERT INTO `offerjob` (`OfferJobID`, `OfferJobFormID`, `SeekerID`, `PasserID`, `Notes`, `OfferJobDateTime`, `OfferJobStatus`) VALUES
(2, 3, 3, 4, 'hehe', '2018-08-19 22:50:08', 3),
(3, 4, 3, 5, '', '2018-08-20 05:35:28', 1),
(4, 5, 3, 1, '', '2018-08-19 23:24:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offerjobform`
--

DROP TABLE IF EXISTS `offerjobform`;
CREATE TABLE IF NOT EXISTS `offerjobform` (
  `OfferJobFormID` int(11) NOT NULL AUTO_INCREMENT,
  `SeekerID` int(11) NOT NULL,
  `WorkingAddress` text NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Salary` double NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `AccomodationType` varchar(255) NOT NULL,
  `offerjobformDefault` int(11) NOT NULL DEFAULT 0,
  `uneditable` int(11) NOT NULL DEFAULT 0,
  `OfferJobFormStatus` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`OfferJobFormID`),
  KEY `offerjobform_ibfk_1` (`SeekerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerjobform`
--

INSERT INTO `offerjobform` (`OfferJobFormID`, `SeekerID`, `WorkingAddress`, `StartDate`, `EndDate`, `Salary`, `PaymentMethod`, `AccomodationType`, `offerjobformDefault`, `uneditable`, `OfferJobFormStatus`) VALUES
(2, 3, 'marvee tambok', '2018-08-03', '2018-08-25', 250, 'Online', 'In-House', 0, 2, 1),
(3, 3, 'tqw', '2018-08-01', '2018-08-15', 500.25, 'Onsite', 'Offsite', 0, 2, 1),
(4, 3, 'sda', '2018-08-01', '2018-08-31', 1000, 'Online', 'In-House', 0, 1, 1),
(5, 3, 'lhehe', '2018-08-09', '2018-08-16', 7206, 'Online', 'In-House', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `passer`
--

DROP TABLE IF EXISTS `passer`;
CREATE TABLE IF NOT EXISTS `passer` (
  `PasserID` int(11) NOT NULL AUTO_INCREMENT,
  `PasserFN` varchar(255) NOT NULL,
  `PasserLN` varchar(255) NOT NULL,
  `PasserMname` varchar(100) NOT NULL,
  `PasserBirthdate` date DEFAULT NULL,
  `PasserAge` int(11) NOT NULL,
  `PasserGender` varchar(255) NOT NULL,
  `PasserStreet` varchar(255) NOT NULL,
  `PasserCity` varchar(255) NOT NULL,
  `PasserAddress` varchar(255) NOT NULL,
  `PasserCPNo` bigint(20) DEFAULT NULL,
  `PasserEmail` varchar(255) NOT NULL,
  `PasserStatus` varchar(255) NOT NULL DEFAULT '0',
  `PasserRate` int(11) NOT NULL,
  `PasserCOCNo` varchar(255) NOT NULL,
  `PasserCOCExpiryDate` date NOT NULL,
  `PasserPass` varchar(255) NOT NULL,
  `PasserCertificate` varchar(255) NOT NULL,
  `PasserCertificateType` varchar(100) NOT NULL,
  `PasserTESDALink` varchar(255) NOT NULL,
  `PasserProfile` varchar(255) DEFAULT NULL,
  `PasserFee` bigint(20) NOT NULL,
  `passerRegisterTimeDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`PasserID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passer`
--

INSERT INTO `passer` (`PasserID`, `PasserFN`, `PasserLN`, `PasserMname`, `PasserBirthdate`, `PasserAge`, `PasserGender`, `PasserStreet`, `PasserCity`, `PasserAddress`, `PasserCPNo`, `PasserEmail`, `PasserStatus`, `PasserRate`, `PasserCOCNo`, `PasserCOCExpiryDate`, `PasserPass`, `PasserCertificate`, `PasserCertificateType`, `PasserTESDALink`, `PasserProfile`, `PasserFee`, `passerRegisterTimeDate`) VALUES
(1, 'Jodel', 'Adan', 'B', '1997-09-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Cebu', 3252321233, 'test@gmail.com', '1', 0, '13040102003962', '0000-00-00', '$2y$12$c8IJg1yqxeT8kwdtFNg1a.vJI3aRp6LDHpBNzLFzehwYULvzhP1wy', 'CNC MILLING MACHINE OPERATION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369195', '../../public/etc/images/user/passer/15325417363153254173631.png', 0, '2018-07-22 15:12:46'),
(2, 'Jerry J', 'Gayas', 'R', '2018-07-16', 0, 'Male', 'Kalunasan', 'Cebu City', 'Guadalupe', 9337752834, 'test2@gmail.com', '0', 0, '14130602029952', '0000-00-00', '$2y$12$y/lrpu3KBhaRlWsKMzM2oOdwjXvEA45eBjR5Xqb3MhIcVdZf0zEUC', 'Ships&#39; Catering Services NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369193', '../../public/etc/images/user/passer/15325451388153254513812.jpg', 0, '2018-07-22 15:20:53'),
(3, '', '', '', NULL, 0, '', '', '', '', NULL, '', '0', 0, '', '0000-00-00', '$2y$12$VaHA4bJ8u6qFfHGLiC8M4egPaLsd7koKBBvZKBQdcF6hsdEs974Um', '', '', '', NULL, 0, '2018-07-26 06:12:30'),
(4, 'Jester Jo', 'Ong Chuan', 'B', '2018-07-25', 0, 'Female', 'Qwe', 'Qwe', 'Qwe', 2323232323, 'test3@gmail.com', '1', 0, '15130602192809', '2018-07-11', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW', 'BREAD AND PASTRY PRODUCTION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369205', '../../public/etc/images/user/passer/15325998525153259985214.jpg', 0, '2018-07-26 09:39:02'),
(5, 'Darwin', 'Agena', 'R', '2018-08-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Region Vii', 9154861084, 'marva@gmail.com', '1', 0, '14131201015492', '2018-07-06', '$2y$12$uwzaJ/ua6UxUKAF.T0DXKehZhOcf5W9DfgdejYRgfx878aQ4BjzY.', 'Ships&#39; Catering Services NC I', 'NC I', 'http://www.tesda.gov.ph/Rwac/Details/7369204', '../../public/etc/images/user/passer/15329363549153293635415.jpg', 0, '2018-07-30 07:22:16'),
(6, 'Frederick', 'Lorenzana', 'F', '2018-08-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Suba', 9154861084, 'sheldon@gmail.com', '1', 0, '13131601010336', '2018-08-16', '$2y$12$EYhujIRajkByoky0ivzoj.bUnAZzOZLERoNjFd5VPliAHDxv3/0kK', 'Ships&#39; Catering Services NC I', 'NC I', 'http://www.tesda.gov.ph/Rwac/Details/7369231', '../../public/etc/images/user/passer/15340694706153406947026.jpg', 0, '2018-08-12 10:21:25'),
(7, 'Bernard', 'Buhawe', 'P', NULL, 0, '', '', '', '', NULL, 'abugabayot@gmail.com', '2', 0, '16104302012735', '2018-08-21', '$2y$12$XR2/ml7jvtP5zFen5Iqt5.z8.n80/v7FHuSqjpaAJ57.dix3ziHGe', 'Scaffold Erection NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369228', NULL, 0, '2018-08-12 20:00:24'),
(8, 'Leonard', 'Lelis', 'P', NULL, 0, '', '', '', '', NULL, 'abugabayotkaayo@gmail.com', '0', 0, '16104302012746', '2018-07-31', '$2y$12$5HzXf2v2JaPtCQvieJISE.wj1ziVOvIsnml2kzbeQoiOTOgH8Pyky', 'Scaffold Erection NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369227', NULL, 0, '2018-08-12 20:03:15');

-- --------------------------------------------------------

--
-- Table structure for table `passereducation`
--

DROP TABLE IF EXISTS `passereducation`;
CREATE TABLE IF NOT EXISTS `passereducation` (
  `educationID` int(11) NOT NULL AUTO_INCREMENT,
  `passerID` int(11) NOT NULL,
  `educationAttainment` varchar(255) NOT NULL,
  `educationSchool` varchar(255) NOT NULL,
  `educationAccomplishment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`educationID`),
  KEY `passerID` (`passerID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passereducation`
--

INSERT INTO `passereducation` (`educationID`, `passerID`, `educationAttainment`, `educationSchool`, `educationAccomplishment`) VALUES
(1, 1, 'Qwe', 'Qew', ''),
(2, 1, 'Qwe', 'Qew', ''),
(3, 1, 'Qwe', 'Qew', 'qwe'),
(4, 1, 'College', 'Qw', 'qwe'),
(5, 1, 'Elementary', 'Qwe', ''),
(6, 1, 'Nursery', 'Qwe', ''),
(7, 5, 'Nursery', '', 'Nakapasar'),
(8, 5, 'College', '', 'naswq'),
(9, 5, 'College', '', 'qwe'),
(10, 5, 'Highschool', '', 'qweqwe'),
(11, 5, 'Highschool', 'Access Computer College', 'qwe'),
(12, 5, 'Elementary', 'Access Computer College', ''),
(13, 5, 'Nursery', 'Aie College', 'BOGO');

-- --------------------------------------------------------

--
-- Table structure for table `passerskills`
--

DROP TABLE IF EXISTS `passerskills`;
CREATE TABLE IF NOT EXISTS `passerskills` (
  `PasserSkillsID` int(11) NOT NULL AUTO_INCREMENT,
  `PasserId` int(11) NOT NULL,
  `PasserSkillsName` varchar(255) NOT NULL,
  `PasserSKillsDesc` varchar(255) NOT NULL,
  PRIMARY KEY (`PasserSkillsID`),
  KEY `PasserId` (`PasserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passervalidate`
--

DROP TABLE IF EXISTS `passervalidate`;
CREATE TABLE IF NOT EXISTS `passervalidate` (
  `passerValidateId` int(11) NOT NULL AUTO_INCREMENT,
  `passerID` int(11) NOT NULL,
  `frontID` varchar(255) NOT NULL,
  `backID` varchar(255) NOT NULL,
  `selfie` varchar(255) NOT NULL,
  `COC` varchar(255) NOT NULL,
  `idType` varchar(255) NOT NULL,
  `idNumber` bigint(20) NOT NULL,
  `expirationDate` date NOT NULL,
  `passerValidateDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`passerValidateId`),
  KEY `passerID` (`passerID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passervalidate`
--

INSERT INTO `passervalidate` (`passerValidateId`, `passerID`, `frontID`, `backID`, `selfie`, `COC`, `idType`, `idNumber`, `expirationDate`, `passerValidateDateTime`) VALUES
(1, 1, '../../public/etc/images/userVerify/passer/153257913210153257913221.jpg', '../../public/etc/images/userVerify/passer/15325791329153257913221.png', '../../public/etc/images/userVerify/passer/15325791323153257913211.jpg', '../../public/etc/images/userVerify/passer/15325791325153257913251.jpg', 'Philippine Passport', 2323, '2018-07-18', '2018-07-26 04:25:32'),
(2, 4, '../../public/etc/images/userVerify/passer/153259840010153259840034.jpg', '../../public/etc/images/userVerify/passer/15325984003153259840024.jpg', '../../public/etc/images/userVerify/passer/15325984006153259840044.jpg', '../../public/etc/images/userVerify/passer/15325984005153259840034.jpg', 'Philippine Passport', 123, '2018-07-10', '2018-07-26 09:46:40'),
(3, 1, '../../public/etc/images/userVerify/passer/15328746213153287462131.jpg', '../../public/etc/images/userVerify/passer/15328746213153287462121.jpg', '../../public/etc/images/userVerify/passer/15328746215153287462121.jpg', '../../public/etc/images/userVerify/passer/15328746218153287462141.jpg', 'Philippine Passport', 2323, '2018-07-20', '2018-07-29 14:30:21'),
(4, 5, '../../public/etc/images/userVerify/passer/15329364978153293649755.jpg', '../../public/etc/images/userVerify/passer/15329364971153293649725.jpg', '../../public/etc/images/userVerify/passer/15329364973153293649735.jpg', '../../public/etc/images/userVerify/passer/15329364971153293649725.jpg', 'Student ID', 123123, '2018-06-04', '2018-07-30 07:41:37'),
(5, 6, '../../public/etc/images/userVerify/passer/15340693224153406932246.jpg', '../../public/etc/images/userVerify/passer/15340693229153406932226.jpg', '../../public/etc/images/userVerify/passer/153406932210153406932216.jpg', '../../public/etc/images/userVerify/passer/15340693225153406932256.jpg', 'Student ID', 14281034, '2018-08-30', '2018-08-12 10:22:02'),
(6, 7, '../../public/etc/images/userVerify/passer/153410407410153410407437.jpg', '../../public/etc/images/userVerify/passer/15341040747153410407417.jpg', '../../public/etc/images/userVerify/passer/15341040746153410407447.jpg', '../../public/etc/images/userVerify/passer/15341040747153410407467.jpg', 'Driver&rsquo;s License', 34342414, '2018-08-16', '2018-08-12 20:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `passerworkhistory`
--

DROP TABLE IF EXISTS `passerworkhistory`;
CREATE TABLE IF NOT EXISTS `passerworkhistory` (
  `PasserWorkHistoryID` int(11) NOT NULL AUTO_INCREMENT,
  `OfferJobID` int(11) DEFAULT NULL,
  `PasserID` int(11) NOT NULL,
  `PasserJobTitle` varchar(255) NOT NULL,
  `PasserCompany` varchar(255) NOT NULL,
  `PasserCompanyNumber` bigint(20) DEFAULT NULL,
  `PasserWorkHistoryDesc` varchar(255) NOT NULL,
  `PasserWorkHistoryStartDate` date NOT NULL,
  `PasserWorkHistoryEndDate` date NOT NULL,
  `PasserWorkHistoryWorkDays` int(11) DEFAULT NULL,
  `passerWorkHistoryDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`PasserWorkHistoryID`),
  KEY `OfferJobID` (`OfferJobID`),
  KEY `PasserID` (`PasserID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passerworkhistory`
--

INSERT INTO `passerworkhistory` (`PasserWorkHistoryID`, `OfferJobID`, `PasserID`, `PasserJobTitle`, `PasserCompany`, `PasserCompanyNumber`, `PasserWorkHistoryDesc`, `PasserWorkHistoryStartDate`, `PasserWorkHistoryEndDate`, `PasserWorkHistoryWorkDays`, `passerWorkHistoryDateTime`) VALUES
(1, NULL, 1, 'Qe', 'Q', 0, 'qwe', '1970-01-01', '1970-01-01', NULL, '2018-07-23 08:25:11'),
(2, NULL, 5, 'Singer', 'Waterfront', 0, 'Dako kug kita. HAHAH', '2018-07-17', '2018-07-18', NULL, '2018-07-30 07:34:59'),
(3, NULL, 1, 'Qwe', 'Qwe', 0, 'qweq', '2018-08-01', '0000-00-00', 2018, '2018-08-12 15:56:21'),
(4, NULL, 1, 'Qwe', 'Qwe', 1323, 'qwe', '2018-08-01', '0000-00-00', 2018, '2018-08-12 15:57:27'),
(5, NULL, 1, 'Qwe', 'Qwe', 232, 'qwe', '2018-08-01', '2018-08-16', NULL, '2018-08-12 15:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `ReviewID` int(11) NOT NULL AUTO_INCREMENT,
  `Review` int(11) NOT NULL,
  `Star` int(11) NOT NULL,
  `ReviewBy` int(11) NOT NULL,
  `ReviewTo` int(11) NOT NULL,
  PRIMARY KEY (`ReviewID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seeker`
--

DROP TABLE IF EXISTS `seeker`;
CREATE TABLE IF NOT EXISTS `seeker` (
  `SeekerID` int(11) NOT NULL AUTO_INCREMENT,
  `SeekerFN` varchar(255) NOT NULL,
  `SeekerLN` varchar(255) NOT NULL,
  `SeekerBirthdate` date DEFAULT NULL,
  `SeekerAge` int(11) NOT NULL,
  `SeekerGender` varchar(255) NOT NULL,
  `SeekerStreet` varchar(255) NOT NULL,
  `SeekerCity` varchar(255) NOT NULL,
  `SeekerAddress` varchar(255) NOT NULL,
  `SeekerCPNo` bigint(20) DEFAULT NULL,
  `SeekerEmail` varchar(255) NOT NULL,
  `SeekerType` varchar(255) NOT NULL,
  `SeekerFacebookId` char(255) DEFAULT NULL,
  `SeekerFacebookLink` varchar(255) DEFAULT NULL,
  `SeekerGmailID` char(255) DEFAULT NULL,
  `SeekerGmailLink` varchar(255) NOT NULL,
  `SeekerStatus` varchar(255) DEFAULT '0',
  `SeekerProfile` varchar(255) NOT NULL,
  `SeekerUname` varchar(255) NOT NULL,
  `SeekerPass` varchar(255) NOT NULL,
  PRIMARY KEY (`SeekerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeker`
--

INSERT INTO `seeker` (`SeekerID`, `SeekerFN`, `SeekerLN`, `SeekerBirthdate`, `SeekerAge`, `SeekerGender`, `SeekerStreet`, `SeekerCity`, `SeekerAddress`, `SeekerCPNo`, `SeekerEmail`, `SeekerType`, `SeekerFacebookId`, `SeekerFacebookLink`, `SeekerGmailID`, `SeekerGmailLink`, `SeekerStatus`, `SeekerProfile`, `SeekerUname`, `SeekerPass`) VALUES
(1, 'Syrel', 'Prialde', '2018-07-18', 0, 'Male', 'Str', 'Cebu City', 'Add', 2147483647, 'syrelgm@gmail.com', '', '1416471571813746', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEdPQkRPZAjV5enQ2RzkxZA0lrNThxX1pQcGFDaGVFNGVjckE0ZAUU5cDBJQ2dvTVl2aTRRLVNoU1pXa2t2ZA0pFYTQyeWtzd2RvWVhMX2ZAmOVJaQkNVdm1zUnNnMW1NN3h6VzhQZAW94YzR6a1VDY18t/', NULL, '', '1', '../../public/etc/images/user/seeker/15324324264153243242611.jpg', '', ''),
(2, 'Marvee Yofa', 'Franco', NULL, 0, 'Female', '', '', '', NULL, 'francoyochi@gmail.com', '', '1668043639982457', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEd2ejZA2eFlSV09zd3RadWJRRTEzdFRkWm1fVHlnczVCN1pqTnZA5QUJoNEkxeUlHNHd4YUliUldBWm02c09fMnZAYbDZAUUnJ5Mmc4cVpFYWRyUExPdHpMN2FZAeGxYajh4UjUwd25yZAWllZAkNDMmR0/', NULL, '', '1', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1668043639982457&amp;height=200&amp;width=200&amp;ext=1535530327&amp;hash=AeT60qKEE-Hc1jO0', '', ''),
(3, 'syrel', 'prialde', '1997-11-22', 21, 'Female', 'Qwe', 'Qwe', 'Qweqwe', 9154861084, 'test@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/seeker/15347057119153470571123.jpg', 'test01', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW'),
(4, 'May', 'Franco', '2018-08-01', 0, 'Female', 'General Gines St.', 'Cebu City', 'Suba', 2147483647, 'francoyogie@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/seeker/15332818502153328185034.jpg', 'franco', '$2y$12$vhJF9oSUtFTE0zqf1PYifOFyGvqfMZA4ao8e7yW0VdOunHZU9Tw12'),
(5, 'Syrel', 'Prialde', NULL, 0, 'Male', '', '', '', NULL, 'prialde01@gmail.com', '', NULL, NULL, '118416846115335852813', 'https://plus.google.com/118416846115335852813', '0', 'https://lh4.googleusercontent.com/-kYuWnXUzfcI/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7ry8ZDeqsrb-PjviuoLSg6sO99sIw/mo/photo.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `seekervalidate`
--

DROP TABLE IF EXISTS `seekervalidate`;
CREATE TABLE IF NOT EXISTS `seekervalidate` (
  `SeekerValidateId` int(11) NOT NULL AUTO_INCREMENT,
  `SeekerID` int(11) NOT NULL,
  `frontID` varchar(255) NOT NULL,
  `backID` varchar(255) NOT NULL,
  `selfie` varchar(255) NOT NULL,
  `idType` varchar(255) NOT NULL,
  `idNumber` bigint(20) NOT NULL,
  `expirationDate` date NOT NULL,
  `seekerValidateDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`SeekerValidateId`),
  KEY `passerID` (`SeekerID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seekervalidate`
--

INSERT INTO `seekervalidate` (`SeekerValidateId`, `SeekerID`, `frontID`, `backID`, `selfie`, `idType`, `idNumber`, `expirationDate`, `seekerValidateDateTime`) VALUES
(1, 1, '../../public/etc/images/userVerify/seeker/15324384653153243846541.jpg', '../../public/etc/images/userVerify/seeker/15324384651153243846541.jpg', '../../public/etc/images/userVerify/seeker/15324384656153243846541.jpg', 'Philippine Passport', 2323, '2018-07-17', '2018-07-24 13:21:05'),
(2, 1, '../../public/etc/images/userVerify/seeker/15326008361153260083641.jpg', '../../public/etc/images/userVerify/seeker/153260083610153260083661.jpg', '../../public/etc/images/userVerify/seeker/15326008368153260083651.jpg', 'Philippine Passport', 232, '2018-07-19', '2018-07-26 10:27:16'),
(3, 2, '../../public/etc/images/userVerify/seeker/15329384533153293845362.jpg', '../../public/etc/images/userVerify/seeker/15329384536153293845332.jpg', '../../public/etc/images/userVerify/seeker/15329384539153293845362.jpg', 'Student ID', 123123123, '2018-05-08', '2018-07-30 08:14:13'),
(4, 4, '../../public/etc/images/userVerify/seeker/15332822003153328220044.jpg', '../../public/etc/images/userVerify/seeker/15332822005153328220014.jpg', '../../public/etc/images/userVerify/seeker/15332822007153328220044.jpg', 'Philippine Passport', 123123123, '2018-08-01', '2018-08-03 07:43:20');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE IF NOT EXISTS `subscription` (
  `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `SubscriptionTypeID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `SubscriptionStart` date NOT NULL,
  `SubscriptionEnd` date NOT NULL,
  `PaymentMethod` varchar(255) DEFAULT NULL,
  `SubscriptionStatus` varchar(255) NOT NULL DEFAULT 'ongoing',
  PRIMARY KEY (`SubscriptionID`),
  KEY `SeekerID` (`SeekerID`),
  KEY `SubscriptionTypeID` (`SubscriptionTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`SubscriptionID`, `SubscriptionTypeID`, `SeekerID`, `SubscriptionStart`, `SubscriptionEnd`, `PaymentMethod`, `SubscriptionStatus`) VALUES
(1, 1, 2, '2018-07-30', '2018-07-31', 'paypal', 'ended'),
(2, 1, 1, '2018-07-31', '2018-08-01', 'paypal', 'ended'),
(3, 1, 3, '2018-08-07', '2018-10-05', 'paypal', 'ended'),
(4, 1, 3, '2018-08-12', '2018-08-15', 'paypal', 'ended'),
(5, 1, 3, '2018-08-16', '2018-08-25', 'paypal', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptiontype`
--

DROP TABLE IF EXISTS `subscriptiontype`;
CREATE TABLE IF NOT EXISTS `subscriptiontype` (
  `SubscriptionTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `SubscriptionName` varchar(255) NOT NULL,
  `SubscriptionValidity` varchar(255) NOT NULL,
  `SubscriptionPrice` int(11) NOT NULL,
  PRIMARY KEY (`SubscriptionTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptiontype`
--

INSERT INTO `subscriptiontype` (`SubscriptionTypeID`, `SubscriptionName`, `SubscriptionValidity`, `SubscriptionPrice`) VALUES
(1, 'basic', 'day', 80),
(2, 'silver', 'month', 2500),
(3, 'gold', 'year', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `subskill`
--

DROP TABLE IF EXISTS `subskill`;
CREATE TABLE IF NOT EXISTS `subskill` (
  `SubSkillsID` int(11) NOT NULL AUTO_INCREMENT,
  `PasserID` int(11) NOT NULL,
  `SubSkillsName` varchar(255) NOT NULL,
  `SubSkillDesc` varchar(255) NOT NULL,
  `SubSkillsFee` int(11) NOT NULL,
  `SubSkillsStatus` varchar(255) NOT NULL,
  PRIMARY KEY (`SubSkillsID`),
  KEY `PasserID` (`PasserID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `switchaccount`
--

DROP TABLE IF EXISTS `switchaccount`;
CREATE TABLE IF NOT EXISTS `switchaccount` (
  `SwitchAccountID` int(11) NOT NULL AUTO_INCREMENT,
  `FromID` int(11) NOT NULL,
  `ToID` int(11) NOT NULL,
  PRIMARY KEY (`SwitchAccountID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreement`
--
ALTER TABLE `agreement`
  ADD CONSTRAINT `agreement_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agreement_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agreement_ibfk_3` FOREIGN KEY (`OfferJobFormID`) REFERENCES `offerjobform` (`OfferJobFormID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `canceljob`
--
ALTER TABLE `canceljob`
  ADD CONSTRAINT `canceljob_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `agreement` (`AgreementID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `certificateofemployment`
--
ALTER TABLE `certificateofemployment`
  ADD CONSTRAINT `certificateofemployment_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `agreement` (`AgreementID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `certificateofemployment_ibfk_2` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disabledusers`
--
ALTER TABLE `disabledusers`
  ADD CONSTRAINT `disabledusers_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `disabledusers_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dispute`
--
ALTER TABLE `dispute`
  ADD CONSTRAINT `dispute_ibfk_1` FOREIGN KEY (`offerJobID`) REFERENCES `agreement` (`AgreementID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `multimedia`
--
ALTER TABLE `multimedia`
  ADD CONSTRAINT `multimedia_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `multimedia_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offerjob`
--
ALTER TABLE `offerjob`
  ADD CONSTRAINT `offerjob_ibfk_1` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offerjob_ibfk_2` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offerjob_ibfk_3` FOREIGN KEY (`OfferJobFormID`) REFERENCES `offerjobform` (`OfferJobFormID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offerjobform`
--
ALTER TABLE `offerjobform`
  ADD CONSTRAINT `offerjobform_ibfk_1` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passereducation`
--
ALTER TABLE `passereducation`
  ADD CONSTRAINT `passereducation_ibfk_1` FOREIGN KEY (`passerID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passerskills`
--
ALTER TABLE `passerskills`
  ADD CONSTRAINT `passerskills_ibfk_1` FOREIGN KEY (`PasserId`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passervalidate`
--
ALTER TABLE `passervalidate`
  ADD CONSTRAINT `passervalidate_ibfk_1` FOREIGN KEY (`passerID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  ADD CONSTRAINT `passerworkhistory_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `agreement` (`AgreementID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passerworkhistory_ibfk_2` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seekervalidate`
--
ALTER TABLE `seekervalidate`
  ADD CONSTRAINT `seekervalidate_ibfk_1` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`SubscriptionTypeID`) REFERENCES `subscriptiontype` (`SubscriptionTypeID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subskill`
--
ALTER TABLE `subskill`
  ADD CONSTRAINT `subskill_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
