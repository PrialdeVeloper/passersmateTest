-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2018 at 09:29 AM
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
  `AgreementSerial` varchar(255) DEFAULT NULL,
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
  `NewStatus` int(11) NOT NULL,
  `Triggerer` varchar(255) NOT NULL,
  `TransactionDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
  MODIFY `DisableUserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispute`
--
ALTER TABLE `dispute`
  MODIFY `DisputeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `DocFormsID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `notificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offerjob`
--
ALTER TABLE `offerjob`
  MODIFY `OfferJobID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offerjobform`
--
ALTER TABLE `offerjobform`
  MODIFY `OfferJobFormID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offerjobformused`
--
ALTER TABLE `offerjobformused`
  MODIFY `JobOfferFormUsedID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passer`
--
ALTER TABLE `passer`
  MODIFY `PasserID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passereducation`
--
ALTER TABLE `passereducation`
  MODIFY `educationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passerskills`
--
ALTER TABLE `passerskills`
  MODIFY `PasserSkillsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passervalidate`
--
ALTER TABLE `passervalidate`
  MODIFY `passerValidateId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passerworkhistory`
--
ALTER TABLE `passerworkhistory`
  MODIFY `PasserWorkHistoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `RatingsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seeker`
--
ALTER TABLE `seeker`
  MODIFY `SeekerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seekervalidate`
--
ALTER TABLE `seekervalidate`
  MODIFY `SeekerValidateId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `SubscriptionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptiontype`
--
ALTER TABLE `subscriptiontype`
  MODIFY `SubscriptionTypeID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subskill`
--
ALTER TABLE `subskill`
  MODIFY `SubSkillsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `switch`
--
ALTER TABLE `switch`
  MODIFY `SwitchID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `switchaccount`
--
ALTER TABLE `switchaccount`
  MODIFY `SwitchAccountID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactionhistory`
--
ALTER TABLE `transactionhistory`
  MODIFY `TransactionHistory` int(11) NOT NULL AUTO_INCREMENT;

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
