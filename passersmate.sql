-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 04:04 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `canceljob`
--

CREATE TABLE `canceljob` (
  `CancelJobID` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `CancelDate` date NOT NULL,
  `CancelTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CancelReason` varchar(255) NOT NULL,
  `CancelStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `certificateofemployment`
--

CREATE TABLE `certificateofemployment` (
  `CertificateOfEmploymentID` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `GeneratedKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disabledusers`
--

CREATE TABLE `disabledusers` (
  `DisableUserID` int(11) NOT NULL,
  `PasserID` int(11) DEFAULT NULL,
  `SeekerID` int(11) DEFAULT NULL,
  `DeactivateReason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `dispute` (
  `DisputeID` int(11) NOT NULL,
  `offerJobID` int(11) NOT NULL,
  `DisputeDate` date NOT NULL,
  `DisputeTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DisputeDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `DocFormsID` int(11) NOT NULL,
  `DocFormsName` varchar(255) NOT NULL,
  `DocFormsType` varchar(255) NOT NULL,
  `DocFormsStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`DocFormsID`, `DocFormsName`, `DocFormsType`, `DocFormsStatus`) VALUES
(1, 'name', 'type', 'status');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `MessageID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `MessageContent` text,
  `MessageSender` varchar(255) DEFAULT NULL,
  `MessageTimeAndDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `MessageStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`MessageID`, `PasserID`, `SeekerID`, `MessageContent`, `MessageSender`, `MessageTimeAndDate`, `MessageStatus`) VALUES
(1, 1, 3, '', '', '2018-08-11 11:31:24', 0),
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
(27, 1, 3, 'trtrtr', 'Passer', '2018-08-12 20:32:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `multimedia`
--

CREATE TABLE `multimedia` (
  `MultimediaID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `Multimedia` blob NOT NULL,
  `MultimediaDateUploaded` varchar(255) NOT NULL,
  `MultimediaDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notificationID` int(11) NOT NULL,
  `SeekerID` int(11) DEFAULT NULL,
  `PasserID` int(11) DEFAULT NULL,
  `notificationType` varchar(255) NOT NULL,
  `notificationMessage` text NOT NULL,
  `notificationStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(17, 3, NULL, 'subscription', '2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `offerjob`
--

CREATE TABLE `offerjob` (
  `OfferJobID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `JobOfferDate` date NOT NULL,
  `JobOfferTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `JobOfferDesc` varchar(255) NOT NULL,
  `JobOfferNeeded` int(11) NOT NULL,
  `JobOfferStatus` varchar(255) NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `Payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offerjobform`
--

CREATE TABLE `offerjobform` (
  `OfferJobFormID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `WorkingAddress` text NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Salary` double NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `AccomodationType` varchar(255) NOT NULL,
  `offerjobformDefault` int(11) NOT NULL DEFAULT '0',
  `OfferJobFormStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerjobform`
--

INSERT INTO `offerjobform` (`OfferJobFormID`, `SeekerID`, `WorkingAddress`, `StartDate`, `EndDate`, `Salary`, `PaymentMethod`, `AccomodationType`, `offerjobformDefault`, `OfferJobFormStatus`) VALUES
(1, 1, 'qwe', '2018-07-31', '2018-08-20', 255, 'Onsite', 'Offsite', 0, 1),
(2, 1, 'try', '2018-08-05', '2018-08-10', 255, 'Online', 'In-House', 0, 1),
(3, 4, 'General Gines St. Suba Cebu City', '2018-08-06', '2018-08-10', 1000, 'Onsite', 'Offsite', 0, 0),
(4, 3, 'guadalupe', '2018-08-22', '2018-08-24', 500, 'Online', 'In-House', 1, 1),
(5, 3, 'qwe', '2018-07-31', '2018-08-30', 255, 'Online', 'In-House', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `passer`
--

CREATE TABLE `passer` (
  `PasserID` int(11) NOT NULL,
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
  `passerRegisterTimeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `passereducation` (
  `educationID` int(11) NOT NULL,
  `passerID` int(11) NOT NULL,
  `educationAttainment` varchar(255) NOT NULL,
  `educationSchool` varchar(255) NOT NULL,
  `educationAccomplishment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `passerskills` (
  `PasserSkillsID` int(11) NOT NULL,
  `PasserId` int(11) NOT NULL,
  `PasserSkillsName` varchar(255) NOT NULL,
  `PasserSKillsDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passervalidate`
--

CREATE TABLE `passervalidate` (
  `passerValidateId` int(11) NOT NULL,
  `passerID` int(11) NOT NULL,
  `frontID` varchar(255) NOT NULL,
  `backID` varchar(255) NOT NULL,
  `selfie` varchar(255) NOT NULL,
  `COC` varchar(255) NOT NULL,
  `idType` varchar(255) NOT NULL,
  `idNumber` bigint(20) NOT NULL,
  `expirationDate` date NOT NULL,
  `passerValidateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `passerworkhistory` (
  `PasserWorkHistoryID` int(11) NOT NULL,
  `OfferJobID` int(11) DEFAULT NULL,
  `PasserID` int(11) NOT NULL,
  `PasserJobTitle` varchar(255) NOT NULL,
  `PasserCompany` varchar(255) NOT NULL,
  `PasserCompanyNumber` bigint(20) DEFAULT NULL,
  `PasserWorkHistoryDesc` varchar(255) NOT NULL,
  `PasserWorkHistoryStartDate` date NOT NULL,
  `PasserWorkHistoryEndDate` date NOT NULL,
  `PasserWorkHistoryWorkDays` int(11) DEFAULT NULL,
  `passerWorkHistoryDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `review` (
  `ReviewID` int(11) NOT NULL,
  `Review` int(11) NOT NULL,
  `Star` int(11) NOT NULL,
  `ReviewBy` int(11) NOT NULL,
  `ReviewTo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seeker`
--

CREATE TABLE `seeker` (
  `SeekerID` int(11) NOT NULL,
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
  `SeekerPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeker`
--

INSERT INTO `seeker` (`SeekerID`, `SeekerFN`, `SeekerLN`, `SeekerBirthdate`, `SeekerAge`, `SeekerGender`, `SeekerStreet`, `SeekerCity`, `SeekerAddress`, `SeekerCPNo`, `SeekerEmail`, `SeekerType`, `SeekerFacebookId`, `SeekerFacebookLink`, `SeekerGmailID`, `SeekerGmailLink`, `SeekerStatus`, `SeekerProfile`, `SeekerUname`, `SeekerPass`) VALUES
(1, 'Syrel', 'Prialde', '2018-07-18', 0, 'Male', 'Str', 'Cebu City', 'Add', 2147483647, 'syrelgm@gmail.com', '', '1416471571813746', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEdPQkRPZAjV5enQ2RzkxZA0lrNThxX1pQcGFDaGVFNGVjckE0ZAUU5cDBJQ2dvTVl2aTRRLVNoU1pXa2t2ZA0pFYTQyeWtzd2RvWVhMX2ZAmOVJaQkNVdm1zUnNnMW1NN3h6VzhQZAW94YzR6a1VDY18t/', NULL, '', '1', '../../public/etc/images/user/seeker/15324324264153243242611.jpg', '', ''),
(2, 'Marvee Yofa', 'Franco', NULL, 0, 'Female', '', '', '', NULL, 'francoyochi@gmail.com', '', '1668043639982457', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEd2ejZA2eFlSV09zd3RadWJRRTEzdFRkWm1fVHlnczVCN1pqTnZA5QUJoNEkxeUlHNHd4YUliUldBWm02c09fMnZAYbDZAUUnJ5Mmc4cVpFYWRyUExPdHpMN2FZAeGxYajh4UjUwd25yZAWllZAkNDMmR0/', NULL, '', '1', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1668043639982457&amp;height=200&amp;width=200&amp;ext=1535530327&amp;hash=AeT60qKEE-Hc1jO0', '', ''),
(3, 'syrel', 'prialde', '1997-11-22', 21, 'Female', 'Qwe', 'Qwe', 'Qweqwe', 9154861084, 'test@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/seeker/15341036682153410366863.jpg', 'test01', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW'),
(4, 'May', 'Franco', '2018-08-01', 0, 'Female', 'General Gines St.', 'Cebu City', 'Suba', 2147483647, 'francoyogie@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/seeker/15332818502153328185034.jpg', 'franco', '$2y$12$vhJF9oSUtFTE0zqf1PYifOFyGvqfMZA4ao8e7yW0VdOunHZU9Tw12'),
(5, 'Syrel', 'Prialde', NULL, 0, 'Male', '', '', '', NULL, 'prialde01@gmail.com', '', NULL, NULL, '118416846115335852813', 'https://plus.google.com/118416846115335852813', '0', 'https://lh4.googleusercontent.com/-kYuWnXUzfcI/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7ry8ZDeqsrb-PjviuoLSg6sO99sIw/mo/photo.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `seekervalidate`
--

CREATE TABLE `seekervalidate` (
  `SeekerValidateId` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `frontID` varchar(255) NOT NULL,
  `backID` varchar(255) NOT NULL,
  `selfie` varchar(255) NOT NULL,
  `idType` varchar(255) NOT NULL,
  `idNumber` bigint(20) NOT NULL,
  `expirationDate` date NOT NULL,
  `seekerValidateDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `subscription` (
  `SubscriptionID` int(11) NOT NULL,
  `SubscriptionTypeID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `SubscriptionStart` date NOT NULL,
  `SubscriptionEnd` date NOT NULL,
  `PaymentMethod` varchar(255) DEFAULT NULL,
  `SubscriptionStatus` varchar(255) NOT NULL DEFAULT 'ongoing'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`SubscriptionID`, `SubscriptionTypeID`, `SeekerID`, `SubscriptionStart`, `SubscriptionEnd`, `PaymentMethod`, `SubscriptionStatus`) VALUES
(1, 1, 2, '2018-07-30', '2018-07-31', 'paypal', 'ended'),
(2, 1, 1, '2018-07-31', '2018-08-01', 'paypal', 'ended'),
(3, 1, 3, '2018-08-07', '2018-10-05', 'paypal', 'ended'),
(4, 1, 3, '2018-08-12', '2018-08-15', 'paypal', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptiontype`
--

CREATE TABLE `subscriptiontype` (
  `SubscriptionTypeID` int(11) NOT NULL,
  `SubscriptionName` varchar(255) NOT NULL,
  `SubscriptionValidity` varchar(255) NOT NULL,
  `SubscriptionPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `subskill` (
  `SubSkillsID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `SubSkillsName` varchar(255) NOT NULL,
  `SubSkillDesc` varchar(255) NOT NULL,
  `SubSkillsFee` int(11) NOT NULL,
  `SubSkillsStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `switchaccount`
--

CREATE TABLE `switchaccount` (
  `SwitchAccountID` int(11) NOT NULL,
  `FromID` int(11) NOT NULL,
  `ToID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `canceljob`
--
ALTER TABLE `canceljob`
  ADD PRIMARY KEY (`CancelJobID`),
  ADD KEY `OfferJobID` (`OfferJobID`);

--
-- Indexes for table `certificateofemployment`
--
ALTER TABLE `certificateofemployment`
  ADD PRIMARY KEY (`CertificateOfEmploymentID`),
  ADD KEY `OfferJobID` (`OfferJobID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `disabledusers`
--
ALTER TABLE `disabledusers`
  ADD PRIMARY KEY (`DisableUserID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `dispute`
--
ALTER TABLE `dispute`
  ADD PRIMARY KEY (`DisputeID`),
  ADD KEY `offerJobID` (`offerJobID`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DocFormsID`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`MessageID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `multimedia`
--
ALTER TABLE `multimedia`
  ADD PRIMARY KEY (`MultimediaID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notificationID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `offerjob`
--
ALTER TABLE `offerjob`
  ADD PRIMARY KEY (`OfferJobID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `offerjobform`
--
ALTER TABLE `offerjobform`
  ADD PRIMARY KEY (`OfferJobFormID`),
  ADD KEY `offerjobform_ibfk_1` (`SeekerID`);

--
-- Indexes for table `passer`
--
ALTER TABLE `passer`
  ADD PRIMARY KEY (`PasserID`);

--
-- Indexes for table `passereducation`
--
ALTER TABLE `passereducation`
  ADD PRIMARY KEY (`educationID`),
  ADD KEY `passerID` (`passerID`);

--
-- Indexes for table `passerskills`
--
ALTER TABLE `passerskills`
  ADD PRIMARY KEY (`PasserSkillsID`),
  ADD KEY `PasserId` (`PasserId`);

--
-- Indexes for table `passervalidate`
--
ALTER TABLE `passervalidate`
  ADD PRIMARY KEY (`passerValidateId`),
  ADD KEY `passerID` (`passerID`);

--
-- Indexes for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  ADD PRIMARY KEY (`PasserWorkHistoryID`),
  ADD KEY `OfferJobID` (`OfferJobID`),
  ADD KEY `PasserID` (`PasserID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewID`);

--
-- Indexes for table `seeker`
--
ALTER TABLE `seeker`
  ADD PRIMARY KEY (`SeekerID`);

--
-- Indexes for table `seekervalidate`
--
ALTER TABLE `seekervalidate`
  ADD PRIMARY KEY (`SeekerValidateId`),
  ADD KEY `passerID` (`SeekerID`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`SubscriptionID`),
  ADD KEY `SeekerID` (`SeekerID`),
  ADD KEY `SubscriptionTypeID` (`SubscriptionTypeID`);

--
-- Indexes for table `subscriptiontype`
--
ALTER TABLE `subscriptiontype`
  ADD PRIMARY KEY (`SubscriptionTypeID`);

--
-- Indexes for table `subskill`
--
ALTER TABLE `subskill`
  ADD PRIMARY KEY (`SubSkillsID`),
  ADD KEY `PasserID` (`PasserID`);

--
-- Indexes for table `switchaccount`
--
ALTER TABLE `switchaccount`
  ADD PRIMARY KEY (`SwitchAccountID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `canceljob`
--
ALTER TABLE `canceljob`
  MODIFY `CancelJobID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificateofemployment`
--
ALTER TABLE `certificateofemployment`
  MODIFY `CertificateOfEmploymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disabledusers`
--
ALTER TABLE `disabledusers`
  MODIFY `DisableUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dispute`
--
ALTER TABLE `dispute`
  MODIFY `DisputeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `DocFormsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `MultimediaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `offerjob`
--
ALTER TABLE `offerjob`
  MODIFY `OfferJobID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offerjobform`
--
ALTER TABLE `offerjobform`
  MODIFY `OfferJobFormID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `passer`
--
ALTER TABLE `passer`
  MODIFY `PasserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `passereducation`
--
ALTER TABLE `passereducation`
  MODIFY `educationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `passerskills`
--
ALTER TABLE `passerskills`
  MODIFY `PasserSkillsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passervalidate`
--
ALTER TABLE `passervalidate`
  MODIFY `passerValidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  MODIFY `PasserWorkHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `SeekerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seekervalidate`
--
ALTER TABLE `seekervalidate`
  MODIFY `SeekerValidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscriptiontype`
--
ALTER TABLE `subscriptiontype`
  MODIFY `SubscriptionTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subskill`
--
ALTER TABLE `subskill`
  MODIFY `SubSkillsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `switchaccount`
--
ALTER TABLE `switchaccount`
  MODIFY `SwitchAccountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `canceljob`
--
ALTER TABLE `canceljob`
  ADD CONSTRAINT `canceljob_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `certificateofemployment`
--
ALTER TABLE `certificateofemployment`
  ADD CONSTRAINT `certificateofemployment_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `dispute_ibfk_1` FOREIGN KEY (`offerJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `offerjob_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offerjob_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `passerworkhistory_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE,
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
