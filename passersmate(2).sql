-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 07:49 AM
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
  `AdminName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`) VALUES
(1, 'syrel');

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
  `PasserStatus` varchar(255) NOT NULL DEFAULT '1',
  `PasserRate` int(11) NOT NULL,
  `PasserCOCNo` varchar(255) NOT NULL,
  `PasserPass` varchar(255) NOT NULL,
  `PasserCertificate` varchar(255) NOT NULL,
  `PasserCertificateType` varchar(100) NOT NULL,
  `PasserTESDALink` varchar(255) NOT NULL,
  `PasserProfile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passer`
--

INSERT INTO `passer` (`PasserID`, `PasserFN`, `PasserLN`, `PasserMname`, `PasserBirthdate`, `PasserAge`, `PasserGender`, `PasserStreet`, `PasserCity`, `PasserAddress`, `PasserCPNo`, `PasserEmail`, `PasserStatus`, `PasserRate`, `PasserCOCNo`, `PasserPass`, `PasserCertificate`, `PasserCertificateType`, `PasserTESDALink`, `PasserProfile`) VALUES
(1, 'Jodel', 'Adan', 'B', NULL, 0, '', '', '', '', 0, 'test@gmail.com', '1', 0, '13040102003962', '$2y$12$jYJaVsEMCGuEBd6pvjl85u1mUVOSOL3kS.n43a5Qy4dpGdNjyApjG', 'CNC MILLING MACHINE OPERATION NC II', 'NC II', 'http://www.tesda.gov.ph/Rwac/Details/7369195', NULL);

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
-- Table structure for table `passerworkhistory`
--

CREATE TABLE `passerworkhistory` (
  `PasserWorkHistoryID` int(11) NOT NULL,
  `OfferJobID` int(11) NOT NULL,
  `PasserID` int(11) NOT NULL,
  `PasserWorkHistoryDesc` varchar(255) NOT NULL,
  `PasserWorkHistoryStartDate` date NOT NULL,
  `PasserWorkHistoryEndDate` date NOT NULL,
  `PasserWorkHistoryWorkDays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `SeekerAge` int(11) NOT NULL,
  `SeekerGender` varchar(255) NOT NULL,
  `SeekerUnitNo` int(11) NOT NULL,
  `SeekerStreetNo` int(11) NOT NULL,
  `SeekerStreetName` varchar(255) NOT NULL,
  `SeekerBarangay` varchar(255) NOT NULL,
  `SeekerMunicipality` varchar(255) NOT NULL,
  `SeekerPostalCode` int(11) NOT NULL,
  `SeekerCPNo` int(11) NOT NULL,
  `SeekerTelNo` varchar(255) NOT NULL,
  `SeekerEmail` varchar(255) NOT NULL,
  `SeekerType` varchar(255) NOT NULL,
  `SeekerStatus` varchar(255) NOT NULL,
  `SeekerUname` varchar(255) NOT NULL,
  `SeekerPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeker`
--

INSERT INTO `seeker` (`SeekerID`, `SeekerFN`, `SeekerLN`, `SeekerAge`, `SeekerGender`, `SeekerUnitNo`, `SeekerStreetNo`, `SeekerStreetName`, `SeekerBarangay`, `SeekerMunicipality`, `SeekerPostalCode`, `SeekerCPNo`, `SeekerTelNo`, `SeekerEmail`, `SeekerType`, `SeekerStatus`, `SeekerUname`, `SeekerPass`) VALUES
(1, 'Lemuel', 'Manatad', 22, 'Male', 6969, 6969, 'zxc', 'zxc', 'zxc', 6969, 2147483647, '256-8920', 'jlmabuga2k16@gmail.com', 'type1', 'SingleHaHa', 'masterseg1', 'pungkol321');

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

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`SubscriptionID`, `SubscriptionTypeID`, `SeekerID`, `SubscriptionStart`, `SubscriptionEnd`, `Payment`) VALUES
(1, 1, 1, '2001-01-01', '2002-02-02', 2000);

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
-- Indexes for table `passerskills`
--
ALTER TABLE `passerskills`
  ADD PRIMARY KEY (`PasserSkillsID`),
  ADD KEY `PasserId` (`PasserId`);

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
  MODIFY `CancelJobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `certificateofemployment`
--
ALTER TABLE `certificateofemployment`
  MODIFY `CertificateOfEmploymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dispute`
--
ALTER TABLE `dispute`
  MODIFY `DisputeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `DocFormsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `MessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `multimedia`
--
ALTER TABLE `multimedia`
  MODIFY `MultimediaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offerjob`
--
ALTER TABLE `offerjob`
  MODIFY `OfferJobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passer`
--
ALTER TABLE `passer`
  MODIFY `PasserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passerskills`
--
ALTER TABLE `passerskills`
  MODIFY `PasserSkillsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  MODIFY `PasserWorkHistoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptiontype`
--
ALTER TABLE `subscriptiontype`
  MODIFY `SubscriptionTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subskill`
--
ALTER TABLE `subskill`
  MODIFY `SubSkillsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `passerskills`
--
ALTER TABLE `passerskills`
  ADD CONSTRAINT `passerskills_ibfk_1` FOREIGN KEY (`PasserId`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  ADD CONSTRAINT `passerworkhistory_ibfk_1` FOREIGN KEY (`OfferJobID`) REFERENCES `offerjob` (`OfferJobID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `passerworkhistory_ibfk_2` FOREIGN KEY (`PasserID`) REFERENCES `passer` (`PasserID`) ON DELETE CASCADE ON UPDATE CASCADE;

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