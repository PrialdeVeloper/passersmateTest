-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2018 at 03:04 PM
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
(4, 'crimsonadmin', 'crimson@gmail.com', '$2y$12$drMX/W2kLszEMn.FvraJu.yk3IWOFeZ7zchKr2ditnO8E1qEJFqn6'),
(5, 'crimson1', 'crimson1@gmail.com', '$2y$12$tLkZliaKPOK.Tz32VkviAOVTOVAme1.lvw82E8zhQk9HQ5kKY/vne'),
(6, 'admin06', 'admin06@gmail.com', '$2y$12$FmxKA0e8sIa5D0KO2y9MvOHowEi8caK4F.3oQtlgsC9724oQsd24y'),
(7, 'franco101', 'franco101@gmail.com', '$2y$12$xbiLPqQdJwff/S6QQe0O.OTkuNxdJ5TdgdGftvMPwia3irLZd.fAO');

-- --------------------------------------------------------

--
-- Table structure for table `agreement`
--

CREATE TABLE `agreement` (
  `AgreementID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `OfferJobFormUsedID` int(11) NOT NULL,
  `AgreementDateandTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AgreementSerial` varchar(255) NOT NULL,
  `CompletionSerial` varchar(255) DEFAULT NULL,
  `AgreementStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agreement`
--

INSERT INTO `agreement` (`AgreementID`, `SeekerID`, `PasserID`, `OfferJobFormUsedID`, `AgreementDateandTime`, `AgreementSerial`, `CompletionSerial`, `AgreementStatus`) VALUES
(1, 3, 1, 1, '2018-09-22 00:23:00', '', NULL, 4),
(2, 3, 6, 2, '2018-09-22 03:40:32', 'PM6781736', NULL, 2),
(3, 3, 17, 3, '2018-09-22 05:24:30', '', NULL, 5),
(4, 3, 1, 4, '2018-10-02 10:11:01', 'PM6781931', 'PM6781031', 2);

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
-- Table structure for table `canceljoboffer`
--

CREATE TABLE `canceljoboffer` (
  `CancelJobOfferID` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `CancellationInitiator` varchar(255) NOT NULL,
  `CancelReason` text NOT NULL,
  `CancellationStatus` int(11) NOT NULL DEFAULT '1'
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
(3, NULL, 3, 'unNeeded'),
(4, NULL, 3, 'unNeeded');

-- --------------------------------------------------------

--
-- Table structure for table `dispute`
--

CREATE TABLE `dispute` (
  `DisputeID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `JobOfferID` int(11) NOT NULL,
  `DisputeIssuer` varchar(255) NOT NULL,
  `DisputeReason` text NOT NULL,
  `DisputeIssued` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DisputeStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispute`
--

INSERT INTO `dispute` (`DisputeID`, `PasserID`, `SeekerID`, `JobOfferID`, `DisputeIssuer`, `DisputeReason`, `DisputeIssued`, `DisputeStatus`) VALUES
(1, 1, 3, 1, 'Passer', 'Way tarung seldo', '2018-09-22 00:26:13', 1),
(2, 12, 3, 3, 'Seeker', 'Nangawat ug planggana', '2018-09-22 03:31:40', 1),
(3, 17, 3, 4, 'Passer', 'di mo bayad', '2018-09-22 05:28:43', 2);

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
(1, 1, 3, '', '', '2018-09-22 00:28:02', 0),
(2, 6, 3, '', '', '2018-09-22 03:23:21', 0),
(3, 6, 3, 'hoy', 'Seeker', '2018-09-22 03:23:32', 0),
(4, 12, 3, '', '', '2018-09-22 03:32:36', 0),
(5, 12, 3, 'Halooo', 'Seeker', '2018-09-22 03:44:16', 0),
(6, 17, 3, '', '', '2018-09-22 05:20:48', 0),
(7, 17, 3, 'hey dude', 'Passer', '2018-09-22 05:21:05', 0),
(8, 17, 3, 'dawat naka', 'Seeker', '2018-09-22 05:21:37', 0),
(9, 17, 3, 'ka perfect ba', 'Seeker', '2018-09-22 05:21:49', 0),
(10, 17, 3, 'sure oy?', 'Seeker', '2018-09-22 05:29:33', 0);

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
(1, NULL, 1, 'JobOffer', '1', 0),
(2, 3, NULL, 'jobOfferSeeker', '3', 0),
(3, NULL, 1, 'JobOffer', '3', 0),
(4, NULL, 1, 'JobOffer', '5', 0),
(5, 3, NULL, 'dispute', '1', 0),
(6, NULL, 4, 'updateUserStatus', '5', 1),
(7, NULL, 4, 'updateUserStatus', '1', 1),
(8, NULL, 4, 'updateUserStatus', '5', 1),
(9, NULL, 4, 'updateUserStatus', '1', 1),
(10, NULL, 6, 'JobOffer', '1', 0),
(11, NULL, 12, 'JobOffer', '1', 0),
(12, 3, NULL, 'jobOfferSeeker', '3', 0),
(13, NULL, 12, 'disputeSeeker', '1', 0),
(14, 3, NULL, 'jobOfferSeeker', '3', 0),
(15, NULL, 6, 'JobOffer', '3', 0),
(16, NULL, 6, 'JobOffer', '5', 0),
(17, 3, NULL, 'subscription', '1', 0),
(18, NULL, 17, 'updateUserStatus', '1', 0),
(19, NULL, 17, 'JobOffer', '1', 0),
(20, 3, NULL, 'jobOfferSeeker', '3', 0),
(21, NULL, 17, 'JobOffer', '3', 1),
(22, NULL, 17, 'JobOffer', '5', 1),
(23, 3, NULL, 'dispute', '1', 0),
(24, NULL, 1, 'JobOffer', '1', 0),
(25, 3, NULL, 'jobOfferSeeker', '3', 0),
(26, NULL, 1, 'JobOffer', '3', 0),
(27, NULL, 1, 'JobOffer', '5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `offerjob`
--

CREATE TABLE `offerjob` (
  `OfferJobID` int(11) NOT NULL,
  `OfferJobFormID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `Notes` text,
  `OfferJobDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `OfferJobStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerjob`
--

INSERT INTO `offerjob` (`OfferJobID`, `OfferJobFormID`, `SeekerID`, `PasserID`, `Notes`, `OfferJobDateTime`, `OfferJobStatus`) VALUES
(1, 1, 3, 1, 'No free snacks', '2018-09-22 02:53:38', 10),
(2, 1, 3, 6, 'qwe', '2018-09-22 03:41:40', 9),
(3, 1, 3, 12, 'Limpyo balay', '2018-09-22 03:31:41', 8),
(4, 2, 3, 17, 'Free meal everyday', '2018-09-22 05:30:28', 10),
(5, 2, 3, 1, 'hehe', '2018-10-02 10:11:14', 9);

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
  `uneditable` int(11) NOT NULL DEFAULT '0',
  `OfferJobFormStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerjobform`
--

INSERT INTO `offerjobform` (`OfferJobFormID`, `SeekerID`, `WorkingAddress`, `StartDate`, `EndDate`, `Salary`, `PaymentMethod`, `AccomodationType`, `offerjobformDefault`, `uneditable`, `OfferJobFormStatus`) VALUES
(1, 3, 'General Gines St. Suba Cebu City', '2018-09-25', '2018-12-25', 7000, 'Onsite', 'Offsite', 0, 2, 1),
(2, 3, 'Carlock Street Cebu City', '2018-09-06', '2018-09-20', 5000, 'Online', 'In-House', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `offerjobformused`
--

CREATE TABLE `offerjobformused` (
  `JobOfferFormUsedID` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `WorkingAddress` text NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `Salary` double NOT NULL,
  `PaymentMethod` varchar(255) NOT NULL,
  `AccomodationType` varchar(255) NOT NULL,
  `Notes` text NOT NULL,
  `OfferJobFormStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offerjobformused`
--

INSERT INTO `offerjobformused` (`JobOfferFormUsedID`, `OfferJobID`, `WorkingAddress`, `StartDate`, `EndDate`, `Salary`, `PaymentMethod`, `AccomodationType`, `Notes`, `OfferJobFormStatus`) VALUES
(1, 1, 'General Gines St. Suba Cebu City', '2018-09-25', '2018-12-25', 7000, 'Onsite', 'Offsite', 'No free snacks', 1),
(2, 2, 'General Gines St. Suba Cebu City', '2018-09-25', '2018-12-25', 7000, 'Onsite', 'Offsite', 'qwe', 1),
(3, 4, 'Carlock Street Cebu City', '2018-09-06', '2018-09-20', 5000, 'Online', 'In-House', 'Free meal everyday', 1),
(4, 5, 'Carlock Street Cebu City', '2018-09-06', '2018-09-20', 5000, 'Online', 'In-House', 'hehe', 1);

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
  `PasserCOCNo` varchar(255) NOT NULL,
  `PasserCOCExpiryDate` date NOT NULL,
  `PasserPass` varchar(255) NOT NULL,
  `PasserCertificate` varchar(255) NOT NULL,
  `PasserCertificateType` varchar(100) NOT NULL,
  `PasserTESDALink` varchar(255) NOT NULL,
  `PasserProfile` varchar(255) DEFAULT NULL,
  `PasserFee` bigint(20) NOT NULL,
  `passerRegisterTimeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserType` varchar(255) DEFAULT 'Passer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passer`
--

INSERT INTO `passer` (`PasserID`, `PasserFN`, `PasserLN`, `PasserMname`, `PasserBirthdate`, `PasserAge`, `PasserGender`, `PasserStreet`, `PasserCity`, `PasserAddress`, `PasserCPNo`, `PasserEmail`, `PasserStatus`, `PasserCOCNo`, `PasserCOCExpiryDate`, `PasserPass`, `PasserCertificate`, `PasserCertificateType`, `PasserTESDALink`, `PasserProfile`, `PasserFee`, `passerRegisterTimeDate`, `UserType`) VALUES
(1, 'Jodel', 'Adan', 'B', '1997-09-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Cebu', 9154861084, 'test@gmail.com', '1', '13040102003962', '0000-00-00', '$2y$12$c8IJg1yqxeT8kwdtFNg1a.vJI3aRp6LDHpBNzLFzehwYULvzhP1wy', 'CNC MILLING MACHINE OPERATION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369195', '../../public/etc/images/user/passer/15325417363153254173631.png', 728, '2018-07-22 15:12:46', 'Passer'),
(4, 'Jester Jo', 'Ong Chuan', 'B', '2018-07-25', 25, 'Female', 'Qwe', 'Qwe', 'Qwe', 9154861084, 'test3@gmail.com', '1', '15130602192809', '2018-07-11', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW', 'BREAD AND PASTRY PRODUCTION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369205', '../../public/etc/images/user/passer/15325998525153259985214.jpg', 728, '2018-07-26 09:39:02', 'Passer'),
(5, 'Darwin', 'Agena', 'R', '2018-08-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Region Vii', 9154861084, 'marva@gmail.com', '1', '14131201015492', '2018-07-06', '$2y$12$uwzaJ/ua6UxUKAF.T0DXKehZhOcf5W9DfgdejYRgfx878aQ4BjzY.', 'Ships&#39; Catering Services NC I', 'NC I', 'http://www.tesda.gov.ph/Rwac/Details/7369204', '../../public/etc/images/user/passer/15329363549153293635415.jpg', 0, '2018-07-30 07:22:16', 'Passer'),
(6, 'Frederick', 'Lorenzana', 'F', '2018-08-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Suba', 9154861084, 'sheldon@gmail.com', '1', '13131601010336', '2018-08-16', '$2y$12$c8IJg1yqxeT8kwdtFNg1a.vJI3aRp6LDHpBNzLFzehwYULvzhP1wy', 'Ships&#39; Catering Services NC I', 'NC I', 'http://www.tesda.gov.ph/Rwac/Details/7369231', '../../public/etc/images/user/passer/15340694706153406947026.jpg', 3097, '2018-08-12 10:21:25', 'Passer'),
(9, 'Herminio J', 'Miranda', 'R', '2018-09-26', 0, 'Female', 'General Gines St.', 'Cebu City', 'Region Vii', 9154861084, 'miranda@gmail.com', '1', '15131403031982', '2018-09-26', '$2y$12$ol7yF94W.jMwiOp8wbOKVedJDEnnW3Fbey58.lOZfXnQlICj6LgK.', 'Plumbing NC III', 'NC III', 'http://www.tesda.gov.ph/Rwac/Details/7369234', '../../public/etc/images/user/passer/15358613606153586136039.jpg', 0, '2018-09-02 04:08:30', 'Passer'),
(12, 'Julieta', 'Lincuna', 'L', '1979-07-29', 39, 'Female', 'General Gines St.', 'Cebu City', 'Region Vii', 9154861084, 'lincuna@gmail.com', '1', '15130702030231', '2018-09-20', '$2y$12$.u8Kz4O4WXsofVIuJWZkheGJY44epHFerTYN8a0vyvoJHcGL1v7PW', 'Household Services NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369233', '../../public/etc/images/user/passer/153639114871536391148512.jpg', 0, '2018-09-08 06:56:21', 'Passer'),
(14, 'Judith', 'Espiritu', 'L', '1997-09-09', 0, 'Female', 'Jones Avenue', 'Cebu City', 'Region Vii', 9154861084, 'espiritu@gmail.com', '1', '12130302008762', '2018-09-28', '$2y$12$oEjML/qaz3Ok3V72J.htY.ay98YKc8JqfqPSEaIZrNQ83060wji46', 'Household Services NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369232', '../../public/etc/images/user/passer/1536468691101536468691314.jpg', 0, '2018-09-09 03:41:38', 'Passer'),
(16, 'syrel', 'prialde', '', NULL, 0, '', '', '', '', NULL, 'test@gmail.com', '0', '', '0000-00-00', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW', '', '', '', NULL, 0, '2018-09-22 03:03:57', 'Passer'),
(17, 'Jowie', 'Manalo', 'S', '1997-11-22', 21, 'Male', 'Kamparang', 'Cebu City', 'Region Vii', 9154861084, 'manalo@gmail.com', '1', '13130601156635', '2018-12-13', '$2y$12$aQPCU4zGCCGeZ02vXp0.Yu8aMAFAF21OEwxUFjc7QurL4x7cy/3uS', 'Ships&#39; Catering Services NC I', 'NC I', 'http://www.tesda.gov.ph/Rwac/Details/7369281', '../../public/etc/images/user/passer/1537593397101537593397517.png', 0, '2018-09-22 05:03:59', 'Passer');

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
(12, 6, 'Elementary', 'Access Computer College', ''),
(13, 5, 'Nursery', 'Aie College', 'BOGO'),
(14, 9, 'Highschool', 'Aie College', 'Valedictorian'),
(15, 1, 'Highschool', 'Aces Tagum College (atc)', 'qweqwe'),
(16, 6, 'Highschool', 'Abe International College Of Business And Accountancy', 'ghgf');

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
(1, 17, '../../public/etc/images/userVerify/passer/1537592743101537592744117.png', '../../public/etc/images/userVerify/passer/153759274461537592744217.png', '../../public/etc/images/userVerify/passer/153759274491537592744417.png', '../../public/etc/images/userVerify/passer/153759274461537592744517.jpg', 'Student ID', 14277743, '2018-09-14', '2018-09-22 05:05:44');

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
(1, NULL, 6, 'Qwe', 'Qwe', 323232323, 'qwe', '2018-09-12', '2018-09-21', NULL, '2018-09-22 04:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `RatingsID` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `PersonalityRate` int(11) DEFAULT NULL,
  `PunctualityRate` int(11) NOT NULL,
  `WorkQualityRate` int(11) NOT NULL,
  `Feedback` text,
  `ReviewBy` varchar(255) NOT NULL,
  `ReviewdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`RatingsID`, `OfferJobID`, `PasserID`, `SeekerID`, `PersonalityRate`, `PunctualityRate`, `WorkQualityRate`, `Feedback`, `ReviewBy`, `ReviewdOn`) VALUES
(1, 1, 1, 3, 5, 5, 5, 'Awesome', 'Seeker', '2018-09-22 00:23:31'),
(2, 2, 6, 3, 5, 5, 5, 'Good', 'Seeker', '2018-09-22 03:41:40'),
(3, 2, 6, 3, 5, 5, 5, 'Awesome', 'Passer', '2018-09-22 03:42:06'),
(4, 4, 17, 3, 4, 5, 5, 'okay ra tanan', 'Seeker', '2018-09-22 05:26:32'),
(5, 5, 1, 3, 3, 3, 3, 'hehe', 'Seeker', '2018-10-02 10:11:14');

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
  `SeekerPass` varchar(255) NOT NULL,
  `SeekerRegisterDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserType` varchar(255) DEFAULT 'Seeker'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeker`
--

INSERT INTO `seeker` (`SeekerID`, `SeekerFN`, `SeekerLN`, `SeekerBirthdate`, `SeekerAge`, `SeekerGender`, `SeekerStreet`, `SeekerCity`, `SeekerAddress`, `SeekerCPNo`, `SeekerEmail`, `SeekerType`, `SeekerFacebookId`, `SeekerFacebookLink`, `SeekerGmailID`, `SeekerGmailLink`, `SeekerStatus`, `SeekerProfile`, `SeekerUname`, `SeekerPass`, `SeekerRegisterDateTime`, `UserType`) VALUES
(1, 'Syrel', 'Prialde', '2018-07-18', 0, 'Male', 'Str', 'Cebu City', 'Add', 9222817453, 'syrelgm@gmail.com', '', '1416471571813746', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEdPQkRPZAjV5enQ2RzkxZA0lrNThxX1pQcGFDaGVFNGVjckE0ZAUU5cDBJQ2dvTVl2aTRRLVNoU1pXa2t2ZA0pFYTQyeWtzd2RvWVhMX2ZAmOVJaQkNVdm1zUnNnMW1NN3h6VzhQZAW94YzR6a1VDY18t/', NULL, '', '1', '../../public/etc/images/user/seeker/15324324264153243242611.jpg', '', '', '2018-09-17 17:57:19', 'Seeker'),
(2, 'Marvee Yofa', 'Franco', NULL, 0, 'Female', '', '', '', 9222817453, 'francoyochi@gmail.com', '', '1668043639982457', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEd2ejZA2eFlSV09zd3RadWJRRTEzdFRkWm1fVHlnczVCN1pqTnZA5QUJoNEkxeUlHNHd4YUliUldBWm02c09fMnZAYbDZAUUnJ5Mmc4cVpFYWRyUExPdHpMN2FZAeGxYajh4UjUwd25yZAWllZAkNDMmR0/', NULL, '', '1', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1668043639982457&amp;height=200&amp;width=200&amp;ext=1535530327&amp;hash=AeT60qKEE-Hc1jO0', '', '', '2018-09-17 17:57:19', 'Seeker'),
(3, 'syrel', 'prialde', '1997-11-22', 21, 'Female', 'Qwe', 'Qwe', 'Qweqwe', 9222817453, 'test@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/seeker/153637989410153637989433.jpg', 'test01', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW', '2018-09-17 17:57:19', 'Seeker'),
(4, 'May', 'Franco', '2018-08-01', 0, 'Female', 'General Gines St.', 'Cebu City', 'Suba', 9222817453, 'francoyogie@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/seeker/15332818502153328185034.jpg', 'franco', '$2y$12$vhJF9oSUtFTE0zqf1PYifOFyGvqfMZA4ao8e7yW0VdOunHZU9Tw12', '2018-09-17 17:57:19', 'Seeker'),
(5, 'Syrel', 'Prialde', NULL, 0, 'Male', '', '', '', 9222817453, 'prialde01@gmail.com', '', NULL, NULL, '118416846115335852813', 'https://plus.google.com/118416846115335852813', '0', 'https://lh4.googleusercontent.com/-kYuWnXUzfcI/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7ry8ZDeqsrb-PjviuoLSg6sO99sIw/mo/photo.jpg', '', '', '2018-09-17 17:57:19', 'Seeker'),
(6, 'Marvee', 'Franco', '2018-09-12', 0, 'Female', 'General Gines St.', 'Cebu City', 'Cebu', 9222817453, 'marvee@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/seeker/15358618518153586185156.jpg', 'marvee06', '$2y$12$75.SRlp1MxEUV4zk7FpqZ.y72CQB.cdR5Ho18FhDi6Cro0tuKoDgm', '2018-09-17 17:57:19', 'Seeker'),
(20, 'Jodel', 'Adan', '1997-09-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Cebu', 9222817453, 'test@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/passer/15325417363153254173631.png', '', '$2y$12$c8IJg1yqxeT8kwdtFNg1a.vJI3aRp6LDHpBNzLFzehwYULvzhP1wy', '2018-09-17 17:57:19', 'Seeker'),
(21, 'Marimar', 'Franco', '1997-09-03', 21, 'Female', 'Mango Avenue', 'Cebu City', 'Region Vii', 9222817453, 'franco@gmail.com', '', NULL, NULL, NULL, '', '0', '', 'marimar', '$2y$12$Ku2hBTRAOTqFtlF9S4xhP.SXlxtHTzKC9CJhIB5f4ZZolksBUWO7y', '2018-09-17 17:57:19', 'Seeker'),
(22, 'Judith', 'Espiritu', '1997-09-09', 0, 'Female', 'Jones Avenue', 'Cebu City', 'Region Vii', 9222817453, 'espiritu@gmail.com', '', NULL, NULL, NULL, '', '1', '../../public/etc/images/user/passer/1536468691101536468691314.jpg', '', '$2y$12$oEjML/qaz3Ok3V72J.htY.ay98YKc8JqfqPSEaIZrNQ83060wji46', '2018-09-17 17:57:19', 'Seeker');

-- --------------------------------------------------------

--
-- Table structure for table `seekercompany`
--

CREATE TABLE `seekercompany` (
  `companyID` int(11) NOT NULL,
  `seekerID` int(11) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `companyNumber` int(11) NOT NULL,
  `companyDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seekercompany`
--

INSERT INTO `seekercompany` (`companyID`, `seekerID`, `companyName`, `companyNumber`, `companyDesc`) VALUES
(1, 3, 'Mrs.clean', 2147483647, 'Clean');

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
(1, 3, 3, '2018-09-22', '2019-09-22', 'paypal', 'ongoing'),
(2, 2, 3, '2018-09-22', '2018-10-22', 'paypal', 'ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptiontype`
--

CREATE TABLE `subscriptiontype` (
  `SubscriptionTypeID` int(11) NOT NULL,
  `SubscriptionName` varchar(255) NOT NULL,
  `SubscriptionValidity` varchar(255) NOT NULL,
  `SubscriptionPrice` int(11) NOT NULL,
  `SubscriptionCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscriptiontype`
--

INSERT INTO `subscriptiontype` (`SubscriptionTypeID`, `SubscriptionName`, `SubscriptionValidity`, `SubscriptionPrice`, `SubscriptionCreated`) VALUES
(1, 'basic', 'day', 80, '2018-09-18 10:01:25'),
(2, 'silver', 'month', 2500, '2018-09-18 10:01:25'),
(3, 'gold', 'year', 5000, '2018-09-18 10:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `switch`
--

CREATE TABLE `switch` (
  `SwitchID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `Original` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `switch`
--

INSERT INTO `switch` (`SwitchID`, `SeekerID`, `PasserID`, `Original`) VALUES
(1, 3, 16, 'Seeker');

-- --------------------------------------------------------

--
-- Table structure for table `transactionhistory`
--

CREATE TABLE `transactionhistory` (
  `TransactionHistory` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `OldStatus` int(11) NOT NULL,
  `NewStatus` int(11) NOT NULL,
  `Triggerer` varchar(255) NOT NULL,
  `TransactionDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactionhistory`
--

INSERT INTO `transactionhistory` (`TransactionHistory`, `OfferJobID`, `OldStatus`, `NewStatus`, `Triggerer`, `TransactionDateTime`) VALUES
(1, 1, 0, 1, 'Seeker', '2018-09-21 23:33:35'),
(2, 1, 1, 3, 'Passer', '2018-09-21 23:33:35'),
(3, 1, 6, 7, 'Seeker', '2018-09-21 23:34:03'),
(4, 1, 6, 7, 'Seeker', '2018-09-21 23:38:41'),
(5, 1, 6, 7, 'Seeker', '2018-09-21 23:45:07'),
(6, 1, 6, 7, 'Seeker', '2018-09-21 23:47:07'),
(7, 1, 6, 7, 'Seeker', '2018-09-21 23:47:49'),
(8, 1, 6, 7, 'Seeker', '2018-09-21 23:48:40'),
(9, 1, 6, 7, 'Seeker', '2018-09-21 23:49:33'),
(10, 1, 6, 7, 'Seeker', '2018-09-21 23:50:20'),
(11, 1, 6, 7, 'Seeker', '2018-09-21 23:57:49'),
(12, 1, 5, 9, 'Seeker', '2018-09-21 23:58:39'),
(13, 1, 0, 1, 'Seeker', '2018-09-22 00:21:04'),
(14, 1, 1, 3, 'Passer', '2018-09-22 00:21:04'),
(15, 1, 3, 5, 'Seeker', '2018-09-22 00:22:01'),
(16, 1, 5, 9, 'Seeker', '2018-09-22 00:23:00'),
(17, 1, 9, 8, 'Passer', '2018-09-22 00:23:31'),
(18, 2, 0, 1, 'Seeker', '2018-09-22 03:18:58'),
(19, 3, 0, 1, 'Seeker', '2018-09-22 03:30:11'),
(20, 3, 1, 3, 'Passer', '2018-09-22 03:30:11'),
(21, 3, 3, 8, 'Seeker', '2018-09-22 03:30:54'),
(22, 2, 1, 3, 'Passer', '2018-09-22 03:18:58'),
(23, 2, 3, 5, 'Seeker', '2018-09-22 03:39:48'),
(24, 2, 5, 9, 'Seeker', '2018-09-22 03:40:32'),
(25, 4, 0, 1, 'Seeker', '2018-09-22 05:19:28'),
(26, 4, 1, 3, 'Passer', '2018-09-22 05:19:28'),
(27, 4, 3, 5, 'Seeker', '2018-09-22 05:22:20'),
(28, 4, 5, 9, 'Seeker', '2018-09-22 05:24:30'),
(29, 4, 9, 8, 'Passer', '2018-09-22 05:26:32'),
(30, 4, 8, 10, 'Passer', '2018-09-22 05:30:28'),
(31, 5, 0, 1, 'Seeker', '2018-10-02 10:09:04'),
(32, 5, 1, 3, 'Passer', '2018-10-02 10:09:04'),
(33, 5, 3, 5, 'Seeker', '2018-10-02 10:10:45'),
(34, 5, 5, 9, 'Seeker', '2018-10-02 10:11:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `agreement`
--
ALTER TABLE `agreement`
  ADD PRIMARY KEY (`AgreementID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`),
  ADD KEY `OfferJobFormID` (`OfferJobFormUsedID`);

--
-- Indexes for table `canceljob`
--
ALTER TABLE `canceljob`
  ADD PRIMARY KEY (`CancelJobID`),
  ADD KEY `OfferJobID` (`OfferJobID`);

--
-- Indexes for table `canceljoboffer`
--
ALTER TABLE `canceljoboffer`
  ADD PRIMARY KEY (`CancelJobOfferID`),
  ADD KEY `OfferJobID` (`OfferJobID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

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
  ADD KEY `JobOfferID` (`JobOfferID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

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
  ADD KEY `SeekerID` (`SeekerID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `OfferJobFormID` (`OfferJobFormID`);

--
-- Indexes for table `offerjobform`
--
ALTER TABLE `offerjobform`
  ADD PRIMARY KEY (`OfferJobFormID`),
  ADD KEY `offerjobform_ibfk_1` (`SeekerID`);

--
-- Indexes for table `offerjobformused`
--
ALTER TABLE `offerjobformused`
  ADD PRIMARY KEY (`JobOfferFormUsedID`),
  ADD KEY `OfferJobID` (`OfferJobID`);

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
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`RatingsID`),
  ADD KEY `OfferJobID` (`OfferJobID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `seeker`
--
ALTER TABLE `seeker`
  ADD PRIMARY KEY (`SeekerID`);

--
-- Indexes for table `seekercompany`
--
ALTER TABLE `seekercompany`
  ADD PRIMARY KEY (`companyID`),
  ADD KEY `seekercompany_ibfk_1` (`seekerID`);

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
-- Indexes for table `switch`
--
ALTER TABLE `switch`
  ADD PRIMARY KEY (`SwitchID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `transactionhistory`
--
ALTER TABLE `transactionhistory`
  ADD PRIMARY KEY (`TransactionHistory`),
  ADD KEY `OfferJobID` (`OfferJobID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `agreement`
--
ALTER TABLE `agreement`
  MODIFY `AgreementID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `canceljob`
--
ALTER TABLE `canceljob`
  MODIFY `CancelJobID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `canceljoboffer`
--
ALTER TABLE `canceljoboffer`
  MODIFY `CancelJobOfferID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificateofemployment`
--
ALTER TABLE `certificateofemployment`
  MODIFY `CertificateOfEmploymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `disabledusers`
--
ALTER TABLE `disabledusers`
  MODIFY `DisableUserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dispute`
--
ALTER TABLE `dispute`
  MODIFY `DisputeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `DocFormsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `MultimediaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `offerjob`
--
ALTER TABLE `offerjob`
  MODIFY `OfferJobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `offerjobform`
--
ALTER TABLE `offerjobform`
  MODIFY `OfferJobFormID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offerjobformused`
--
ALTER TABLE `offerjobformused`
  MODIFY `JobOfferFormUsedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passer`
--
ALTER TABLE `passer`
  MODIFY `PasserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `passereducation`
--
ALTER TABLE `passereducation`
  MODIFY `educationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `passervalidate`
--
ALTER TABLE `passervalidate`
  MODIFY `passerValidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  MODIFY `PasserWorkHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `RatingsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `SeekerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `seekercompany`
--
ALTER TABLE `seekercompany`
  MODIFY `companyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seekervalidate`
--
ALTER TABLE `seekervalidate`
  MODIFY `SeekerValidateId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriptiontype`
--
ALTER TABLE `subscriptiontype`
  MODIFY `SubscriptionTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `switch`
--
ALTER TABLE `switch`
  MODIFY `SwitchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactionhistory`
--
ALTER TABLE `transactionhistory`
  MODIFY `TransactionHistory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agreement`
--
ALTER TABLE `agreement`
  ADD CONSTRAINT `agreement_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agreement_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `agreement_ibfk_3` FOREIGN KEY (`OfferJobFormUsedID`) REFERENCES `offerjobformused` (`JobOfferFormUsedID`);

--
-- Constraints for table `canceljob`
--
ALTER TABLE `canceljob`
  ADD CONSTRAINT `canceljob_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `agreement` (`AgreementID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `canceljoboffer`
--
ALTER TABLE `canceljoboffer`
  ADD CONSTRAINT `canceljoboffer_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `canceljoboffer_ibfk_2` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `canceljoboffer_ibfk_3` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
