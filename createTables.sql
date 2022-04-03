-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2022 at 12:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectboolean`
--

-- --------------------------------------------------------

--
-- Table structure for table `appealtable`
--

CREATE TABLE IF NOT EXISTS `appealtable` (`APPEALID` varchar(7) NOT NULL,`APPEALTITLE` varchar(30) NOT NULL,`FROMDATE` date NOT NULL,`TODATE` date NOT NULL,`DESCRIPTION` varchar(100) NOT NULL,`OUTCOME` varchar(20) DEFAULT NULL,`TARGETAMOUNT` int(10) NOT NULL,`ORGID` int(7) NOT NULL);

--
-- Dumping data for table `appealtable`
--

INSERT INTO `appealtable` (`APPEALID`, `APPEALTITLE`, `FROMDATE`, `TODATE`, `DESCRIPTION`, `OUTCOME`, `TARGETAMOUNT`, `ORGID`) VALUES
('AP1', 'Im Dying', '2022-03-01', '2022-04-01', 'I get Cancer', 'Donation Expired', 100000, 2),
('AP2', 'PCR', '2022-03-01', '2022-03-12', 'Vaccines', 'Appeal Closed', 200000, 2),
('AP3', 'Earthquake In Indonesia', '2022-03-24', '2022-04-29', 'Earthquake makes Java island split into 2 \r\nPlease help them to survive the insanity', 'Donation Open', 500000, 2),
('AP4', 'Helping Earthquake In Taiwan', '2022-03-01', '2022-04-01', 'Helping the victim of Earthquake of 7.5 S.R in Taiwan', 'Donation Expired', 1000000, 2),
('AP5', 'Ukraine Counter attack Invades', '2022-03-15', '2022-03-26', 'Ukraine counter attack to invades the whole Russia, help the refugee to leave Russia!', 'On Disbursement', 200000, 31),
('AP6', 'Help For Ukraine', '2022-04-01', '2022-05-01', 'Helping Ukraine crisis right now', 'Waiting to Start', 50000, 31);

-- --------------------------------------------------------

--
-- Table structure for table `contributiontable`
--

CREATE TABLE IF NOT EXISTS `contributiontable` (
  `CONTRIBUTIONID` varchar(7) NOT NULL,
  `RECEIVEDDATE` date NOT NULL,
  `AMOUNT` float DEFAULT NULL,
  `PAYMENTCHANNEL` varchar(10) DEFAULT NULL,
  `REFERENCENO` varchar(15) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `ESTIMATEDVALUE` float DEFAULT NULL,
  `APPEALID` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contributiontable`
--

INSERT INTO `contributiontable` (`CONTRIBUTIONID`, `RECEIVEDDATE`, `AMOUNT`, `PAYMENTCHANNEL`, `REFERENCENO`, `DESCRIPTION`, `ESTIMATEDVALUE`, `APPEALID`) VALUES
('CON1', '2022-03-25', NULL, NULL, NULL, 'test', 10000, 'AP1'),
('CON2', '2022-03-25', 50000, 'Maybank', '21712921', NULL, NULL, 'AP1'),
('CON3', '2022-03-26', 300000, 'Maybank', '12613781', NULL, NULL, 'AP2'),
('CON4', '2022-03-25', 2500, 'CIMB', '219798172', NULL, NULL, 'AP1'),
('CON5', '2022-03-27', NULL, NULL, NULL, '100 Kg Bag of Uncooked Rice', 500, 'AP1'),
('CON6', '2022-03-27', 400, 'CIMB Trans', '1437538233', NULL, NULL, 'AP1'),
('CON7', '2022-03-27', 476000, 'Maybank', '17368293', NULL, NULL, 'AP4'),
('CON8', '2022-03-27', 50000, 'Public Ban', '791879814', NULL, NULL, 'AP5');

-- --------------------------------------------------------

--
-- Table structure for table `disbursementtable`
--

CREATE TABLE IF NOT EXISTS `disbursementtable` (
  `DISBURSEMENTDATE` date NOT NULL,
  `CASHAMOUNT` float NOT NULL,
  `GOODDISBURSED` varchar(50) NOT NULL,
  `APPEALID` varchar(15) NOT NULL,
  `USERNAME` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disbursementtable`
--

INSERT INTO `disbursementtable` (`DISBURSEMENTDATE`, `CASHAMOUNT`, `GOODDISBURSED`, `APPEALID`, `USERNAME`) VALUES
('2022-04-01', 100000, 'house', 'AP2', 'app1'),
('2022-04-01', 200000, 'bed', 'AP2', 'app4'),
('2022-05-27', 10000, 'Apartment Food and Bed', 'AP5', 'app7');

-- --------------------------------------------------------

--
-- Table structure for table `doctable`
--

CREATE TABLE IF NOT EXISTS `doctable` (
  `documentID` varchar(7) NOT NULL,
  `filename` varchar(300) NOT NULL,
  `documentDescription` varchar(40) NOT NULL,
  `username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctable`
--

INSERT INTO `doctable` (`documentID`, `filename`, `documentDescription`, `username`) VALUES
('1', 'TIMETABLE (HUKL HUS2  F2F) Sem 1-2022 -  W.E.F 17 Jan 2022.pdf', 'household income', 'app1'),
('10', 'Tute01B.pdf', 'My Information', 'app6'),
('11', 'ProjectBoolean.pdf', 'HouseHold Income', 'app7'),
('12', 'Assignment 3 S1 2022.pdf', 'HouseHoldIncome', 'app8'),
('2', 'ProjectBoolean.pdf', 'household income', 'app1'),
('3', 'LIST OF CLUBS-SOCIETIES (S2) 2021.pdf', 'household income', 'app2'),
('4', 'TIMETABLE (HUKL HUS2  F2F) Sem 1-2022 -  W.E.F 17 Jan 2022.pdf', 'household income', 'app2'),
('5', 'ProjectBoolean.pdf', 'household income', 'app2'),
('6', 'LIST OF CLUBS-SOCIETIES (S2) 2021.pdf', 'household income', 'app3'),
('7', 'MyVax A2 (1).pdf', 'hello im under water', 'app4'),
('8', 'IT Student Handbook (Dec2021).pdf', 'HouseHold Income', 'app5'),
('9', '1. IT Non F2F Exams Schedule (Updated 25 Oct 2021) for Students.pdf', 'My Household Income', 'app6');

-- --------------------------------------------------------

--
-- Table structure for table `orgtable`
--

CREATE TABLE IF NOT EXISTS `orgtable` (
  `ORGID` int(7) NOT NULL,
  `ORGNAME` varchar(20) NOT NULL,
  `ORGADDRESS` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orgtable`
--

INSERT INTO `orgtable` (`ORGID`, `ORGNAME`, `ORGADDRESS`) VALUES
(2, 'Youtube', 'USA'),
(6, 'Mc Donalds', 'Jalan Buntung'),
(8, 'Mike Wazaoski', 'Rich Brain Street'),
(9, 'Udayana', 'jalan bali'),
(15, 'Mang Oleh', 'Ikan Hiu'),
(25, 'KFC', 'jalan buntu no 5'),
(26, 'Google', 'Jalan California No.98'),
(27, 'Twitch', 'Road Of California no 33'),
(31, 'Xiaomi', 'Jalan Ketuban No 30');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE IF NOT EXISTS `usertable` (
  `USERNAME` varchar(10) NOT NULL,
  `PASSWORD` varchar(15) NOT NULL,
  `FULLNAME` varchar(50) NOT NULL,
  `EMAIL` varchar(25) DEFAULT NULL,
  `MOBILENO` varchar(12) DEFAULT NULL,
  `USERTYPE` enum('APPLICANT','ORGREP') NOT NULL,
  `JOBTITLE` varchar(15) DEFAULT NULL,
  `IDNO` varchar(20) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `HOUSEHOLDINCOME` float DEFAULT NULL,
  `ORGID` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`USERNAME`, `PASSWORD`, `FULLNAME`, `EMAIL`, `MOBILENO`, `USERTYPE`, `JOBTITLE`, `IDNO`, `ADDRESS`, `HOUSEHOLDINCOME`, `ORGID`) VALUES
('app1', '^/0w95sK', 'Mike', NULL, NULL, 'APPLICANT', NULL, 'C12232123', 'jalan help', 10, 2),
('app2', '25Tw016-', 'Jess', NULL, NULL, 'APPLICANT', NULL, '17297323', 'jalan tebing', 2000, 2),
('app3', '2&64&HoX', 'Felix', NULL, NULL, 'APPLICANT', NULL, '9832982', 'jalan gblk', 10, 2),
('app4', '1y5N50%5', 'Abdul Qayoom', NULL, NULL, 'APPLICANT', NULL, '23917892', 'Jalan qayoom', 100, 2),
('app5', '0G+060n4', 'Vladimir Putin', NULL, NULL, 'APPLICANT', NULL, 'R6287912', 'Moscow Presidency', 100, 31),
('app6', '6qT3+@70', 'Donald Trump', NULL, NULL, 'APPLICANT', NULL, 'A1298734', 'White House', 150, 31),
('app7', '81*V@rT7', 'Barack Obama', NULL, NULL, 'APPLICANT', NULL, 'BO218761', 'White House pt 1', 190, 31),
('app8', 'L@s2o4d8', 'Kim Jong Il', NULL, NULL, 'APPLICANT', NULL, '72638292', 'North Korea Roady 1', 200, 31),
('arshiagh', '=qk=1BwI', 'Arshia Gholami', 'gholami.arshia@outlook.co', '01124345464', 'ORGREP', 'LOSER', NULL, NULL, NULL, 6),
('carricklie', '.y31)B!8', 'Carrick Lie', 'lie.carrick1234@gmail.com', '0172365921', 'ORGREP', 'Gamer', NULL, NULL, NULL, 2),
('notcarrick', ')v4N764Q', 'Not Carrick', 'b1902338@helplive.edu.my', '0172365921', 'ORGREP', 'Chief', NULL, NULL, NULL, 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appealtable`
--
ALTER TABLE `appealtable`
  ADD PRIMARY KEY (`APPEALID`);

--
-- Indexes for table `contributiontable`
--
ALTER TABLE `contributiontable`
  ADD PRIMARY KEY (`CONTRIBUTIONID`),
  ADD KEY `contribution_appeal_constraint` (`APPEALID`);

--
-- Indexes for table `disbursementtable`
--
ALTER TABLE `disbursementtable`
  ADD PRIMARY KEY (`USERNAME`),
  ADD KEY `disbursement_appeal_constraint` (`APPEALID`);

--
-- Indexes for table `doctable`
--
ALTER TABLE `doctable`
  ADD PRIMARY KEY (`documentID`),
  ADD KEY `document_user_constraint` (`username`);

--
-- Indexes for table `orgtable`
--
ALTER TABLE `orgtable`
  ADD PRIMARY KEY (`ORGID`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`USERNAME`),
  ADD KEY `user_organization_constraint` (`ORGID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orgtable`
--
ALTER TABLE `orgtable`
  MODIFY `ORGID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contributiontable`
--
ALTER TABLE `contributiontable`
  ADD CONSTRAINT `contribution_appeal_constraint` FOREIGN KEY (`APPEALID`) REFERENCES `appealtable` (`APPEALID`);

--
-- Constraints for table `disbursementtable`
--
ALTER TABLE `disbursementtable`
  ADD CONSTRAINT `disbursement_appeal_constraint` FOREIGN KEY (`APPEALID`) REFERENCES `appealtable` (`APPEALID`),
  ADD CONSTRAINT `disbursement_user_constraint` FOREIGN KEY (`USERNAME`) REFERENCES `usertable` (`USERNAME`);

--
-- Constraints for table `doctable`
--
ALTER TABLE `doctable`
  ADD CONSTRAINT `document_user_constraint` FOREIGN KEY (`username`) REFERENCES `usertable` (`USERNAME`);

--
-- Constraints for table `usertable`
--
ALTER TABLE `usertable`
  ADD CONSTRAINT `user_organization_constraint` FOREIGN KEY (`ORGID`) REFERENCES `orgtable` (`ORGID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
