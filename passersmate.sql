-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2018 at 08:01 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'syrel', 'test@gmail.com', '$2y$12$A5beirOzKPlwQUpZAHe4YuM1jgWRkGOrWdhFMh/5RJCzN04TjVj/i');

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
  `MessageContent` varchar(255) NOT NULL,
  `MessageDate` date NOT NULL,
  `MessageTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MessageStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `NotificationID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `SeekerID` int(11) NOT NULL,
  `SubscriptionID` int(11) NOT NULL,
  `MessageID` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `CancelJobID` int(11) NOT NULL,
  `NotificationType` varchar(255) NOT NULL,
  `NotificationStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Jodel', 'Adan', 'B', '1997-09-01', 0, 'Male', 'General Gines St.', 'Cebu City', 'Cebu', 9337752834, 'test@gmail.com', '1', 0, '13040102003962', '0000-00-00', '$2y$12$jYJaVsEMCGuEBd6pvjl85u1mUVOSOL3kS.n43a5Qy4dpGdNjyApjG', 'CNC MILLING MACHINE OPERATION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369195', '../../public/etc/images/user/passer/15325417363153254173631.png', 0, '2018-07-22 15:12:46'),
(2, 'Jerry J', 'Gayas', 'R', '2018-07-16', 0, 'Male', 'Kalunasan', 'Cebu City', 'Guadalupe', 9337752834, 'test2@gmail.com', '0', 0, '14130602029952', '0000-00-00', '$2y$12$y/lrpu3KBhaRlWsKMzM2oOdwjXvEA45eBjR5Xqb3MhIcVdZf0zEUC', 'Ships&#39; Catering Services NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369193', '../../public/etc/images/user/passer/15325451388153254513812.jpg', 0, '2018-07-22 15:20:53'),
(3, '', '', '', NULL, 0, '', '', '', '', NULL, '', '0', 0, '', '0000-00-00', '$2y$12$VaHA4bJ8u6qFfHGLiC8M4egPaLsd7koKBBvZKBQdcF6hsdEs974Um', '', '', '', NULL, 0, '2018-07-26 06:12:30'),
(4, 'Jester Jo', 'Ong Chuan', 'B', '2018-07-25', 0, 'Male', 'Qwe', 'Qwe', 'Qwe', 2323232323, 'test3@gmail.com', '1', 0, '15130602192809', '2018-07-11', '$2y$12$zlFNjRLgMXptGbJ6QrrkNeroqmsro9FgqHGqy4EVynbOwtt0TSlzW', 'BREAD AND PASTRY PRODUCTION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369205', '../../public/etc/images/user/passer/15325998525153259985214.jpg', 0, '2018-07-26 09:39:02');

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
(6, 1, 'Nursery', 'Qwe', '');

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
(2, 4, '../../public/etc/images/userVerify/passer/153259840010153259840034.jpg', '../../public/etc/images/userVerify/passer/15325984003153259840024.jpg', '../../public/etc/images/userVerify/passer/15325984006153259840044.jpg', '../../public/etc/images/userVerify/passer/15325984005153259840034.jpg', 'Philippine Passport', 123, '2018-07-10', '2018-07-26 09:46:40');

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
  `PasserWorkHistoryDesc` varchar(255) NOT NULL,
  `PasserWorkHistoryStartDate` date NOT NULL,
  `PasserWorkHistoryEndDate` date NOT NULL,
  `PasserWorkHistoryWorkDays` int(11) DEFAULT NULL,
  `passerWorkHistoryDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passerworkhistory`
--

INSERT INTO `passerworkhistory` (`PasserWorkHistoryID`, `OfferJobID`, `PasserID`, `PasserJobTitle`, `PasserCompany`, `PasserWorkHistoryDesc`, `PasserWorkHistoryStartDate`, `PasserWorkHistoryEndDate`, `PasserWorkHistoryWorkDays`, `passerWorkHistoryDateTime`) VALUES
(1, NULL, 1, 'Qe', 'Q', 'qwe', '1970-01-01', '1970-01-01', NULL, '2018-07-23 08:25:11'),
(2, NULL, 1, 'Qwe', 'The Master', 'qweqweqweqweqweqweqeqe', '2018-07-01', '2018-07-10', NULL, '2018-07-26 16:01:16');

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
  `SeekerCPNo` int(11) DEFAULT NULL,
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
(1, 'Syrel', 'Prialde', '2018-07-18', 0, 'Male', 'Str', 'Cebu City', 'Add', 2147483647, 'syrelgm@gmail.com', '', '1416471571813746', 'https://www.facebook.com/app_scoped_user_id/YXNpZADpBWEdPQkRPZAjV5enQ2RzkxZA0lrNThxX1pQcGFDaGVFNGVjckE0ZAUU5cDBJQ2dvTVl2aTRRLVNoU1pXa2t2ZA0pFYTQyeWtzd2RvWVhMX2ZAmOVJaQkNVdm1zUnNnMW1NN3h6VzhQZAW94YzR6a1VDY18t/', NULL, '', '1', '../../public/etc/images/user/seeker/15324324264153243242611.jpg', '', '');

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
(1, 1, '../../public/etc/images/userVerify/seeker/15326280044153262800421.jpg', '../../public/etc/images/userVerify/seeker/15326280041153262800441.jpg', '../../public/etc/images/userVerify/seeker/153262800410153262800411.jpg', 'TIN Card', 2323, '2018-07-20', '2018-07-26 18:00:04');

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
  `Payment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Sname', 'valid', 2000);

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
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`),
  ADD KEY `SubscriptionID` (`SubscriptionID`),
  ADD KEY `MessageID` (`MessageID`),
  ADD KEY `OfferJobID` (`OfferJobID`),
  ADD KEY `CancelJobID` (`CancelJobID`);

--
-- Indexes for table `offerjob`
--
ALTER TABLE `offerjob`
  ADD PRIMARY KEY (`OfferJobID`),
  ADD KEY `PasserID` (`PasserID`),
  ADD KEY `SeekerID` (`SeekerID`);

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
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `MultimediaID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offerjob`
--
ALTER TABLE `offerjob`
  MODIFY `OfferJobID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `passer`
--
ALTER TABLE `passer`
  MODIFY `PasserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `passereducation`
--
ALTER TABLE `passereducation`
  MODIFY `educationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `passerskills`
--
ALTER TABLE `passerskills`
  MODIFY `PasserSkillsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `passervalidate`
--
ALTER TABLE `passervalidate`
  MODIFY `passerValidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  MODIFY `PasserWorkHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `SeekerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `seekervalidate`
--
ALTER TABLE `seekervalidate`
  MODIFY `SeekerValidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscriptiontype`
--
ALTER TABLE `subscriptiontype`
  MODIFY `SubscriptionTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`SubscriptionID`) REFERENCES `subscription` (`SubscriptionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`MessageID`) REFERENCES `message` (`MessageID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_5` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_6` FOREIGN KEY (`CancelJobID`) REFERENCES `canceljob` (`CancelJobID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offerjob`
--
ALTER TABLE `offerjob`
  ADD CONSTRAINT `offerjob_ibfk_1` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offerjob_ibfk_2` FOREIGN KEY (`SeekerID`) REFERENCES `seeker` (`SeekerID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
