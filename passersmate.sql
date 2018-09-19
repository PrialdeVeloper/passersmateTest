-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2018 at 08:46 PM
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
  `AgreementStatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `canceljoboffer`
--

INSERT INTO `canceljoboffer` (`CancelJobOfferID`, `OfferJobID`, `SeekerID`, `PasserID`, `CancellationInitiator`, `CancelReason`, `CancellationStatus`) VALUES
(1, 10, 3, 1, 'Passer', 'hehe', 2);

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
(3, 1, 3, 2, 'Seeker', 'hehe', '2018-09-19 16:13:33', 1),
(4, 1, 3, 2, 'Seeker', 'TAMBOK MAN KAAYU SIYA GUD :(', '2018-09-19 16:15:05', 1);

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
(2, 1, 3, '', '', '2018-09-01 21:29:36', 0),
(3, 9, 6, '', '', '2018-09-02 04:38:06', 0),
(4, 9, 6, 'Hoy', 'Passer', '2018-09-02 04:38:14', 0),
(5, 9, 6, 'Na cancel naman nako', 'Passer', '2018-09-02 04:38:24', 0),
(6, 9, 6, 'Nganung wala paman ka nakita sa search area', 'Passer', '2018-09-02 04:38:34', 0),
(7, 9, 6, 'ay bali', 'Passer', '2018-09-02 04:38:40', 0),
(8, 9, 6, 'Ambot inmo', 'Passer', '2018-09-02 08:20:23', 0),
(9, 9, 6, 'Oplok', 'Seeker', '2018-09-02 08:20:52', 0),
(10, 4, 6, '', '', '2018-09-02 13:50:26', 0),
(11, 1, 3, 'hoy', 'Seeker', '2018-09-07 14:17:07', 0),
(12, 1, 3, 'hey', 'Passer', '2018-09-19 15:59:18', 1);

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
(23, NULL, 4, 'JobOffer', '1', 0),
(24, NULL, 1, 'JobOffer', '1', 0),
(25, NULL, 1, 'JobOffer', '1', 0),
(26, NULL, 1, 'JobOffer', '1', 0),
(27, NULL, 4, 'JobOffer', '1', 0),
(28, NULL, 5, 'JobOffer', '1', 1),
(29, NULL, 1, 'JobOffer', '1', 0),
(30, 3, NULL, 'subscription', '2', 0),
(31, NULL, 1, 'agreements', '2', 0),
(32, NULL, 1, 'JobOffer', '2', 0),
(33, NULL, 1, 'JobOffer', '2', 0),
(34, NULL, 1, 'JobOffer', '2', 0),
(35, NULL, 4, 'JobOffer', '2', 0),
(36, 3, NULL, 'subscription', '2', 0),
(37, NULL, 4, 'agreements', '3', 0),
(38, NULL, 5, 'JobOffer', '3', 1),
(39, NULL, 4, 'JobOffer', '3', 0),
(40, NULL, 5, 'JobOffer', '3', 1),
(41, 3, NULL, 'jobOfferSeeker', '1', 0),
(42, 3, NULL, 'jobOfferSeeker', '3', 0),
(43, 3, NULL, 'jobOfferSeeker', '1', 0),
(44, 3, NULL, 'jobOfferSeeker', '3', 0),
(45, 3, NULL, 'cancellationSeeker', '1', 0),
(46, 3, NULL, 'cancellationSeeker', '1', 0),
(47, 3, NULL, 'cancellationSeeker', '1', 0),
(48, 3, NULL, 'cancellationSeeker', '1', 0),
(50, NULL, 5, 'cancellationSeeker', '1', 1),
(51, 3, NULL, 'jobOfferSeeker', '3', 0),
(52, 3, NULL, 'jobOfferSeeker', '3', 0),
(53, 3, NULL, 'jobOfferSeeker', '3', 0),
(54, 3, NULL, 'jobOfferSeeker', '3', 0),
(55, 3, NULL, 'cancellationSeeker', '1', 0),
(56, NULL, 1, 'cancellationSeeker', '2', 0),
(57, NULL, 1, 'cancellationSeeker', '2', 0),
(58, 3, NULL, 'jobOfferSeeker', '3', 0),
(59, 3, NULL, 'cancellationSeeker', '1', 0),
(60, NULL, 1, 'cancellationSeeker', '2', 0),
(61, NULL, 1, 'JobOffer', '1', 0),
(62, 3, NULL, 'jobOfferSeeker', '3', 0),
(63, 3, NULL, 'cancellationSeeker', '1', 0),
(64, NULL, 1, 'cancellationSeeker', '2', 0),
(65, 3, NULL, 'joboffered', '4', 0),
(66, 3, NULL, 'joboffered', '4', 0),
(67, 3, NULL, 'jobOfferSeeker', '4', 0),
(68, 3, NULL, 'jobOfferSeeker', '3', 0),
(69, NULL, 1, 'cancellationSeeker', '1', 0),
(74, NULL, 6, 'JobOffer', '1', 1),
(75, NULL, 1, 'JobOffer', '1', 0),
(76, 3, NULL, 'jobOfferSeeker', '3', 0),
(77, NULL, 1, 'JobOffer', '3', 0),
(78, NULL, 9, 'updateUserStatus', '3', 0),
(79, NULL, 9, 'updateUserStatus', '1', 0),
(80, 6, NULL, 'updateUserStatus', '1', 0),
(81, 6, NULL, 'subscription', '1', 0),
(82, NULL, 9, 'JobOffer', '1', 0),
(83, 6, NULL, 'jobOfferSeeker', '3', 0),
(84, NULL, 9, 'JobOffer', '3', 0),
(85, NULL, 9, 'cancellationSeeker', '1', 0),
(86, NULL, 6, 'cancellationSeeker', '2', 1),
(87, NULL, 6, 'cancellationSeeker', '2', 1),
(88, NULL, 6, 'cancellationSeeker', '2', 1),
(89, NULL, 6, 'cancellationSeeker', '2', 1),
(90, NULL, 6, 'cancellationSeeker', '2', 1),
(91, NULL, 6, 'cancellationSeeker', '2', 1),
(92, NULL, 9, 'JobOffer', '1', 0),
(93, NULL, 9, 'JobOffer', '1', 1),
(94, NULL, 9, 'JobOffer', '1', 1),
(98, 3, NULL, 'dispute', '1', 0),
(99, NULL, 1, 'JobOffer', '3', 0),
(100, NULL, 1, 'JobOffer', '5', 0),
(101, NULL, 1, 'JobOffer', '5', 0),
(102, NULL, 1, 'JobOffer', '5', 0),
(103, NULL, 1, 'JobOffer', '5', 0),
(104, NULL, 1, 'JobOffer', '5', 0),
(105, NULL, 1, 'JobOffer', '5', 0),
(106, NULL, 1, 'JobOffer', '5', 0),
(107, NULL, 1, 'JobOffer', '5', 0),
(108, NULL, 1, 'JobOffer', '5', 0),
(109, NULL, 1, 'JobOffer', '5', 0),
(110, NULL, 1, 'JobOffer', '5', 0),
(111, NULL, 1, 'JobOffer', '5', 0),
(112, NULL, 1, 'JobOffer', '5', 0),
(113, NULL, 1, 'JobOffer', '5', 0),
(114, NULL, 1, 'JobOffer', '5', 0),
(115, NULL, 1, 'JobOffer', '5', 0),
(116, NULL, 1, 'JobOffer', '5', 0),
(117, NULL, 1, 'JobOffer', '5', 0),
(118, NULL, 1, 'JobOffer', '5', 0),
(119, NULL, 14, 'updateUserStatus', '3', 0),
(120, NULL, 14, 'updateUserStatus', '3', 0),
(123, NULL, 14, 'updateUserStatus', '3', 0),
(124, NULL, 14, 'updateUserStatus', '1', 0),
(126, NULL, 2, 'JobOffer', '1', 1),
(127, NULL, 2, 'JobOffer', '2', 1),
(128, NULL, 6, 'JobOffer', '5', 1),
(129, NULL, 1, 'JobOffer', '5', 0),
(130, NULL, 1, 'JobOffer', '5', 0),
(131, NULL, 6, 'JobOffer', '5', 1),
(132, NULL, 1, 'JobOffer', '5', 0),
(133, NULL, 1, 'JobOffer', '5', 0),
(134, NULL, 1, 'JobOffer', '5', 0),
(135, NULL, 1, 'JobOffer', '5', 0),
(136, NULL, 4, 'JobOffer', '1', 1),
(137, NULL, 4, 'JobOffer', '2', 1),
(138, 3, NULL, 'dispute', '1', 0),
(139, NULL, 1, 'disputeSeeker', '1', 0),
(140, NULL, 1, 'disputeSeeker', '1', 0),
(141, NULL, 1, 'JobOffer', '1', 0),
(142, NULL, 2, 'JobOffer', '1', 1),
(143, NULL, 4, 'JobOffer', '1', 1),
(144, NULL, 5, 'JobOffer', '1', 1),
(145, NULL, 5, 'JobOffer', '2', 1),
(146, 3, NULL, 'jobOfferSeeker', '3', 0),
(147, NULL, 1, 'JobOffer', '3', 0),
(148, 3, NULL, 'cancellationSeeker', '1', 0),
(149, 1, NULL, 'cancellationSeeker', '2', 1),
(150, NULL, 1, 'JobOffer', '2', 0),
(151, 3, NULL, 'jobOfferSeeker', '3', 0),
(152, NULL, 1, 'cancellationSeeker', '1', 0),
(153, 1, NULL, 'cancellationSeeker', '2', 1),
(154, 3, NULL, 'jobOfferSeeker', '3', 0),
(155, NULL, 1, 'cancellationSeeker', '1', 0),
(160, 3, NULL, 'cancellationSeeker', '2', 0),
(161, 3, NULL, 'cancellationPasser', '2', 0),
(162, NULL, 1, 'cancellationSeeker', '1', 0),
(163, NULL, 1, 'cancellationSeeker', '1', 1),
(164, 3, NULL, 'cancellationPasser', '2', 0),
(165, 3, NULL, 'cancellationPasser', '2', 0),
(166, 3, NULL, 'cancellationSeeker', '1', 0),
(167, 1, NULL, 'cancellationPasser', '2', 1);

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
(1, 5, 3, 6, '', '2018-09-19 05:24:38', 5),
(2, 5, 3, 1, '', '2018-09-19 16:15:05', 8),
(3, 6, 6, 9, 'Walay free snacks', '2018-09-12 07:41:57', 9),
(4, 6, 6, 9, 'qwe', '2018-09-12 07:41:57', 9),
(5, 6, 6, 9, '', '2018-09-12 07:41:57', 9),
(6, 6, 6, 9, '', '2018-09-12 07:41:57', 9),
(8, 7, 3, 2, '', '2018-09-19 04:25:04', 2),
(9, 7, 3, 4, '', '2018-09-19 14:21:48', 2),
(10, 7, 3, 1, '', '2018-09-19 18:45:20', 7),
(11, 7, 3, 2, '', '2018-09-19 17:17:13', 1),
(12, 7, 3, 4, '', '2018-09-19 17:17:14', 1),
(13, 7, 3, 5, '', '2018-09-19 17:36:13', 2);

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
(2, 3, 'marvee tambok', '2018-08-03', '2018-08-25', 250, 'Online', 'In-House', 0, 2, 1),
(3, 3, 'tqw', '2018-08-01', '2018-08-15', 4319, 'Onsite', 'Offsite', 0, 2, 1),
(4, 3, 'sda', '2018-08-01', '2018-08-31', 1000, 'Online', 'In-House', 0, 1, 1),
(5, 3, 'lhehe', '2018-08-09', '2018-08-16', 5000, 'Online', 'In-House', 0, 2, 1),
(6, 6, 'General Gines St. Suba Cebu City', '2018-09-19', '2018-09-25', 1000, 'Onsite', 'Offsite', 0, 2, 1),
(7, 3, 'qweqwe', '2020-01-11', '2022-01-11', 705, 'Online', 'In-House', 1, 0, 1);

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
  `passerRegisterTimeDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserType` varchar(255) DEFAULT 'Passer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passer`
--

INSERT INTO `passer` (`PasserID`, `PasserFN`, `PasserLN`, `PasserMname`, `PasserBirthdate`, `PasserAge`, `PasserGender`, `PasserStreet`, `PasserCity`, `PasserAddress`, `PasserCPNo`, `PasserEmail`, `PasserStatus`, `PasserRate`, `PasserCOCNo`, `PasserCOCExpiryDate`, `PasserPass`, `PasserCertificate`, `PasserCertificateType`, `PasserTESDALink`, `PasserProfile`, `PasserFee`, `passerRegisterTimeDate`, `UserType`) VALUES
(1, 'Jodel', 'Adan', 'B', '1997-09-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Cebu', 9154861084, 'test@gmail.com', '1', 1, '13040102003962', '0000-00-00', '$2y$12$c8IJg1yqxeT8kwdtFNg1a.vJI3aRp6LDHpBNzLFzehwYULvzhP1wy', 'CNC MILLING MACHINE OPERATION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369195', '../../public/etc/images/user/passer/15325417363153254173631.png', 728, '2018-07-22 15:12:46', 'Passer'),
(2, 'Jerry J', 'Gayas', 'R', '2018-07-16', 25, 'Male', 'Kalunasan', 'Cebu City', 'Guadalupe', 9154861084, 'test2@gmail.com', '1', 0, '14130602029952', '0000-00-00', '$2y$12$y/lrpu3KBhaRlWsKMzM2oOdwjXvEA45eBjR5Xqb3MhIcVdZf0zEUC', 'Ships&#39; Catering Services NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369193', '../../public/etc/images/user/passer/15325451388153254513812.jpg', 728, '2018-07-22 15:20:53', 'Passer'),
(4, 'Jester Jo', 'Ong Chuan', 'B', '2018-07-25', 25, 'Female', 'Qwe', 'Qwe', 'Qwe', 9154861084, 'test3@gmail.com', '1', 0, '15130602192809', '2018-07-11', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW', 'BREAD AND PASTRY PRODUCTION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369205', '../../public/etc/images/user/passer/15325998525153259985214.jpg', 728, '2018-07-26 09:39:02', 'Passer'),
(5, 'Darwin', 'Agena', 'R', '2018-08-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Region Vii', 9154861084, 'marva@gmail.com', '1', 0, '14131201015492', '2018-07-06', '$2y$12$uwzaJ/ua6UxUKAF.T0DXKehZhOcf5W9DfgdejYRgfx878aQ4BjzY.', 'Ships&#39; Catering Services NC I', 'NC I', 'http://www.tesda.gov.ph/Rwac/Details/7369204', '../../public/etc/images/user/passer/15329363549153293635415.jpg', 0, '2018-07-30 07:22:16', 'Passer'),
(6, 'Frederick', 'Lorenzana', 'F', '2018-08-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Suba', 9154861084, 'sheldon@gmail.com', '1', 0, '13131601010336', '2018-08-16', '$2y$12$EYhujIRajkByoky0ivzoj.bUnAZzOZLERoNjFd5VPliAHDxv3/0kK', 'Ships&#39; Catering Services NC I', 'NC I', 'http://www.tesda.gov.ph/Rwac/Details/7369231', '../../public/etc/images/user/passer/15340694706153406947026.jpg', 0, '2018-08-12 10:21:25', 'Passer'),
(9, 'Herminio J', 'Miranda', 'R', '2018-09-26', 0, 'Female', 'General Gines St.', 'Cebu City', 'Region Vii', 9154861084, 'miranda@gmail.com', '1', 0, '15131403031982', '2018-09-26', '$2y$12$ol7yF94W.jMwiOp8wbOKVedJDEnnW3Fbey58.lOZfXnQlICj6LgK.', 'Plumbing NC III', 'NC III', 'http://www.tesda.gov.ph/Rwac/Details/7369234', '../../public/etc/images/user/passer/15358613606153586136039.jpg', 0, '2018-09-02 04:08:30', 'Passer'),
(12, 'Julieta', 'Lincuna', 'L', '2018-10-01', 0, 'Female', 'General Gines St.', 'Cebu City', 'Region Vii', 9154861084, 'lincuna@gmail.com', '0', 0, '15130702030231', '2018-09-20', '$2y$12$.u8Kz4O4WXsofVIuJWZkheGJY44epHFerTYN8a0vyvoJHcGL1v7PW', 'Household Services NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369233', '../../public/etc/images/user/passer/153639114871536391148512.jpg', 0, '2018-09-08 06:56:21', 'Passer'),
(14, 'Judith', 'Espiritu', 'L', '1997-09-09', 0, 'Female', 'Jones Avenue', 'Cebu City', 'Region Vii', 9154861084, 'espiritu@gmail.com', '1', 0, '12130302008762', '2018-09-28', '$2y$12$oEjML/qaz3Ok3V72J.htY.ay98YKc8JqfqPSEaIZrNQ83060wji46', 'Household Services NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369232', '../../public/etc/images/user/passer/1536468691101536468691314.jpg', 0, '2018-09-09 03:41:38', 'Passer');

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
(13, 5, 'Nursery', 'Aie College', 'BOGO'),
(14, 9, 'Highschool', 'Aie College', 'Valedictorian');

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
(7, 9, '../../public/etc/images/userVerify/passer/15358614514153586145149.jpg', '../../public/etc/images/userVerify/passer/15358614517153586145129.jpg', '../../public/etc/images/userVerify/passer/15358614516153586145149.jpg', '../../public/etc/images/userVerify/passer/15358614518153586145159.jpg', 'TIN Card', 12345, '2018-09-26', '2018-09-02 04:10:51'),
(8, 9, '../../public/etc/images/userVerify/passer/15358616572153586165759.jpg', '../../public/etc/images/userVerify/passer/15358616576153586165739.jpg', '../../public/etc/images/userVerify/passer/15358616571153586165769.jpg', '../../public/etc/images/userVerify/passer/15358616579153586165739.jpg', 'Philippine Passport', 123123, '2018-09-30', '2018-09-02 04:14:17'),
(9, 14, '../../public/etc/images/userVerify/passer/153646859691536468596514.png', '../../public/etc/images/userVerify/passer/153646859641536468596114.png', '../../public/etc/images/userVerify/passer/153646859661536468596414.png', '../../public/etc/images/userVerify/passer/153646859641536468596514.png', 'Philippine Passport', 1231231, '2020-11-11', '2018-09-09 04:49:56'),
(10, 14, '../../public/etc/images/userVerify/passer/1536468995101536468995214.png', '../../public/etc/images/userVerify/passer/153646899571536468995214.png', '../../public/etc/images/userVerify/passer/153646899531536468995114.png', '../../public/etc/images/userVerify/passer/153646899591536468995414.png', 'Philippine Passport', 1231231, '2020-11-11', '2018-09-09 04:56:35'),
(11, 14, '../../public/etc/images/userVerify/passer/153646912611536469126214.png', '../../public/etc/images/userVerify/passer/153646912621536469126114.png', '../../public/etc/images/userVerify/passer/153646912691536469126514.png', '../../public/etc/images/userVerify/passer/153646912661536469126214.png', 'Student ID', 1231231, '2020-11-11', '2018-09-09 04:58:46'),
(12, 14, '../../public/etc/images/userVerify/passer/153646929871536469298214.png', '../../public/etc/images/userVerify/passer/153646929871536469298614.png', '../../public/etc/images/userVerify/passer/153646929811536469298114.png', '../../public/etc/images/userVerify/passer/153646929861536469298614.png', 'Student ID', 1231231, '2020-11-11', '2018-09-09 05:01:38');

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
(5, NULL, 1, 'Qwe', 'Qwe', 232, 'qwe', '2018-08-01', '2018-08-16', NULL, '2018-08-12 15:59:06'),
(6, NULL, 9, 'Carpenter', 'Techmahindra', 456123, 'Naay free coffee', '2018-09-25', '2018-09-28', NULL, '2018-09-02 04:11:42');

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
(1, 2, 1, 3, 2, 2, 2, '', 'Passer', '2018-09-19 05:13:15'),
(2, 1, 6, 3, 0, 0, 0, '', 'Seeker', '2018-09-19 05:23:24'),
(3, 2, 1, 3, 4, 4, 4, 'hehe', 'Seeker', '2018-09-19 05:25:14'),
(4, 2, 1, 3, 4, 4, 4, '', 'Seeker', '2018-09-19 05:32:38'),
(5, 2, 1, 3, 2, 3, 3, '', 'Seeker', '2018-09-19 05:37:44');

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
(4, 4, '../../public/etc/images/userVerify/seeker/15332822003153328220044.jpg', '../../public/etc/images/userVerify/seeker/15332822005153328220014.jpg', '../../public/etc/images/userVerify/seeker/15332822007153328220044.jpg', 'Philippine Passport', 123123123, '2018-08-01', '2018-08-03 07:43:20'),
(5, 6, '../../public/etc/images/userVerify/seeker/15358618364153586183626.jpg', '../../public/etc/images/userVerify/seeker/15358618369153586183646.jpg', '../../public/etc/images/userVerify/seeker/15358618361153586183616.jpg', 'Philippine Passport', 123123123, '2018-09-24', '2018-09-02 04:17:16');

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
(4, 1, 3, '2018-08-12', '2018-08-15', 'paypal', 'ended'),
(5, 1, 3, '2018-08-16', '2019-08-25', 'paypal', 'ongoing'),
(6, 1, 6, '2018-09-02', '2018-09-03', 'paypal', 'ongoing');

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
(1, 'basic', 'day', 80, '2018-09-18 18:01:25'),
(2, 'silver', 'month', 2500, '2018-09-18 18:01:25'),
(3, 'gold', 'year', 5000, '2018-09-18 18:01:25');

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
(1, 20, 1, 'Passer'),
(3, 22, 14, 'Passer');

-- --------------------------------------------------------

--
-- Table structure for table `switchaccount`
--

CREATE TABLE `switchaccount` (
  `SwitchAccountID` int(11) NOT NULL,
  `FromID` int(11) NOT NULL,
  `ToID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactionhistory`
--

CREATE TABLE `transactionhistory` (
  `TransactionHistory` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `OldStatus` int(11) NOT NULL,
  `Triggerer` varchar(255) NOT NULL,
  `TransactionDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactionhistory`
--

INSERT INTO `transactionhistory` (`TransactionHistory`, `OfferJobID`, `OldStatus`, `Triggerer`, `TransactionDateTime`) VALUES
(1, 10, 1, '', '2018-09-19 17:37:19'),
(2, 10, 6, '', '2018-09-19 17:38:26'),
(3, 10, 2, 'Passer', '2018-09-19 17:54:47'),
(4, 10, 6, 'Seeker', '2018-09-19 17:57:36'),
(5, 10, 1, 'Passer', '2018-09-19 18:06:37'),
(6, 10, 6, 'Passer', '2018-09-19 18:09:06'),
(7, 10, 6, 'Passer', '2018-09-19 18:13:23'),
(8, 10, 6, 'Passer', '2018-09-19 18:14:23'),
(9, 10, 6, 'Passer', '2018-09-19 18:15:29'),
(10, 10, 6, 'Passer', '2018-09-19 18:17:39'),
(11, 10, 6, 'Passer', '2018-09-19 18:21:43'),
(12, 10, 6, 'Passer', '2018-09-19 18:34:28'),
(13, 10, 6, 'Passer', '2018-09-19 18:37:49'),
(14, 10, 6, 'Seeker', '2018-09-19 18:45:20');

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
-- Indexes for table `switch`
--
ALTER TABLE `switch`
  ADD PRIMARY KEY (`SwitchID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

--
-- Indexes for table `switchaccount`
--
ALTER TABLE `switchaccount`
  ADD PRIMARY KEY (`SwitchAccountID`);

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
  MODIFY `AgreementID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `canceljob`
--
ALTER TABLE `canceljob`
  MODIFY `CancelJobID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `canceljoboffer`
--
ALTER TABLE `canceljoboffer`
  MODIFY `CancelJobOfferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `DisputeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `DocFormsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `MultimediaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `offerjob`
--
ALTER TABLE `offerjob`
  MODIFY `OfferJobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `offerjobform`
--
ALTER TABLE `offerjobform`
  MODIFY `OfferJobFormID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `offerjobformused`
--
ALTER TABLE `offerjobformused`
  MODIFY `JobOfferFormUsedID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passer`
--
ALTER TABLE `passer`
  MODIFY `PasserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `passereducation`
--
ALTER TABLE `passereducation`
  MODIFY `educationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `passerskills`
--
ALTER TABLE `passerskills`
  MODIFY `PasserSkillsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passervalidate`
--
ALTER TABLE `passervalidate`
  MODIFY `passerValidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  MODIFY `PasserWorkHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `seekervalidate`
--
ALTER TABLE `seekervalidate`
  MODIFY `SeekerValidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `switch`
--
ALTER TABLE `switch`
  MODIFY `SwitchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `switchaccount`
--
ALTER TABLE `switchaccount`
  MODIFY `SwitchAccountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactionhistory`
--
ALTER TABLE `transactionhistory`
  MODIFY `TransactionHistory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- Constraints for table `dispute`
--
ALTER TABLE `dispute`
  ADD CONSTRAINT `dispute_ibfk_1` FOREIGN KEY (`JobOfferID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispute_ibfk_2` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispute_ibfk_3` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `offerjobformused`
--
ALTER TABLE `offerjobformused`
  ADD CONSTRAINT `offerjobformused_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ratings_ibfk_3` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `switch`
--
ALTER TABLE `switch`
  ADD CONSTRAINT `switch_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `switch_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transactionhistory`
--
ALTER TABLE `transactionhistory`
  ADD CONSTRAINT `transactionhistory_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
