-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2016 at 05:55 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbuddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `ID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `ArtistName` varchar(100) DEFAULT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`ID`, `ArtistID`, `ArtistName`, `Status`) VALUES
(1, 1, 'artist1', 'live'),
(2, 2, 'artist2', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `ID` int(11) NOT NULL,
  `CityID` int(11) NOT NULL,
  `CityName` varchar(100) DEFAULT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`ID`, `CityID`, `CityName`, `Status`) VALUES
(1, 1, 'Gwalior', 'live'),
(2, 2, 'Meerut', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `composer`
--

CREATE TABLE `composer` (
  `ID` int(11) NOT NULL,
  `ComposerID` int(11) NOT NULL,
  `ComposerName` varchar(100) DEFAULT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `composer`
--

INSERT INTO `composer` (`ID`, `ComposerID`, `ComposerName`, `Status`) VALUES
(1, 1, 'composer1', 'live'),
(2, 2, 'composer2', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `ID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `CountryName` varchar(100) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`ID`, `CountryID`, `CountryName`, `Status`) VALUES
(1, 1, 'India', 'live'),
(2, 2, 'Australia', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `ID` int(11) NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `LanguageName` varchar(100) DEFAULT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`ID`, `LanguageID`, `LanguageName`, `Status`) VALUES
(1, 1, 'Hindi', 'live'),
(2, 2, 'English', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `ID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `ListingTitle` varchar(256) NOT NULL,
  `ListingViews` int(11) NOT NULL DEFAULT '0',
  `ListingLikes` int(11) NOT NULL DEFAULT '0',
  `ListingDislikes` int(11) NOT NULL DEFAULT '0',
  `ListingUploadDate` datetime DEFAULT NULL,
  `ListingDescription` varchar(10000) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'disabled',
  `UserID` int(11) NOT NULL,
  `ListingSourceID` int(11) DEFAULT NULL,
  `ListingSourceLink` varchar(10000) NOT NULL,
  `LanguageID` int(11) DEFAULT NULL,
  `ListingLyrics` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`ID`, `ListingID`, `ListingTitle`, `ListingViews`, `ListingLikes`, `ListingDislikes`, `ListingUploadDate`, `ListingDescription`, `Status`, `UserID`, `ListingSourceID`, `ListingSourceLink`, `LanguageID`, `ListingLyrics`) VALUES
(1, 102, '', 0, 0, 0, NULL, 'aaa', 'disabled', 169, NULL, 'aaa', NULL, NULL),
(3, 104, '', 0, 0, 0, NULL, 'asdasda', 'disabled', 149, NULL, 'sad', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listing_artist_relation`
--

CREATE TABLE `listing_artist_relation` (
  `ID` int(11) NOT NULL,
  `ArtistID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listing_composer_relation`
--

CREATE TABLE `listing_composer_relation` (
  `ID` int(11) NOT NULL,
  `ComposerID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listing_producer_relation`
--

CREATE TABLE `listing_producer_relation` (
  `ID` int(11) NOT NULL,
  `ProducerID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listing_tag_relation`
--

CREATE TABLE `listing_tag_relation` (
  `ID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listing_writer_relation`
--

CREATE TABLE `listing_writer_relation` (
  `ID` int(11) NOT NULL,
  `WriterID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `ID` int(11) NOT NULL,
  `PlaylistID` int(11) NOT NULL,
  `PlaylistName` varchar(100) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live',
  `PlaylistCDate` datetime NOT NULL,
  `Rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `playlist_listing_relation`
--

CREATE TABLE `playlist_listing_relation` (
  `ID` int(11) NOT NULL,
  `PlaylistID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `producer`
--

CREATE TABLE `producer` (
  `ID` int(11) NOT NULL,
  `ProducerID` int(11) NOT NULL,
  `ProducerName` varchar(100) DEFAULT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producer`
--

INSERT INTO `producer` (`ID`, `ProducerID`, `ProducerName`, `Status`) VALUES
(1, 1, 'producer1', 'live'),
(2, 2, 'producer2', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `profession`
--

CREATE TABLE `profession` (
  `ID` int(11) NOT NULL,
  `ProfessionID` int(11) NOT NULL,
  `ProfessionName` varchar(100) DEFAULT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profession`
--

INSERT INTO `profession` (`ID`, `ProfessionID`, `ProfessionName`, `Status`) VALUES
(1, 1, 'Profession1', 'live'),
(2, 2, 'Profession2', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `ID` int(11) NOT NULL,
  `SectionID` int(11) NOT NULL,
  `SectionName` varchar(100) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section_listing_relation`
--

CREATE TABLE `section_listing_relation` (
  `ID` int(11) NOT NULL,
  `SectionID` int(11) NOT NULL,
  `ListingID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `source_of_listing`
--

CREATE TABLE `source_of_listing` (
  `ID` int(11) NOT NULL,
  `SourceID` int(11) NOT NULL,
  `Source` varchar(100) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `ID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL,
  `TagName` varchar(100) NOT NULL,
  `TagCreatedBy` int(11) NOT NULL,
  `TagCreationDate` datetime NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tickets_listing`
--

CREATE TABLE `tickets_listing` (
  `ID` bigint(20) NOT NULL,
  `Temp` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets_listing`
--

INSERT INTO `tickets_listing` (`ID`, `Temp`) VALUES
(100, 'a'),
(101, 'a'),
(102, 'a'),
(103, 'a'),
(104, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `tickets_user`
--

CREATE TABLE `tickets_user` (
  `ID` bigint(20) NOT NULL,
  `Temp` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets_user`
--

INSERT INTO `tickets_user` (`ID`, `Temp`) VALUES
(102, 'a'),
(103, 'a'),
(104, 'a'),
(105, 'a'),
(106, 'a'),
(107, 'a'),
(108, 'a'),
(109, 'a'),
(110, 'a'),
(111, 'a'),
(112, 'a'),
(113, 'a'),
(114, 'a'),
(115, 'a'),
(116, 'a'),
(117, 'a'),
(118, 'a'),
(119, 'a'),
(120, 'a'),
(121, 'a'),
(122, 'a'),
(123, 'a'),
(124, 'a'),
(125, 'a'),
(126, 'a'),
(127, 'a'),
(128, 'a'),
(129, 'a'),
(130, 'a'),
(131, 'a'),
(132, 'a'),
(133, 'a'),
(134, 'a'),
(135, 'a'),
(136, 'a'),
(137, 'a'),
(138, 'a'),
(139, 'a'),
(140, 'a'),
(141, 'a'),
(142, 'a'),
(143, 'a'),
(144, 'a'),
(145, 'a'),
(146, 'a'),
(147, 'a'),
(148, 'a'),
(149, 'a'),
(150, 'a'),
(151, 'a'),
(152, 'a'),
(153, 'a'),
(154, 'a'),
(155, 'a'),
(156, 'a'),
(157, 'a'),
(158, 'a'),
(159, 'a'),
(160, 'a'),
(161, 'a'),
(162, 'a'),
(163, 'a'),
(164, 'a'),
(165, 'a'),
(166, 'a'),
(167, 'a'),
(168, 'a'),
(169, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `FirstName` varchar(100) DEFAULT NULL,
  `LastName` varchar(100) DEFAULT NULL,
  `DateOfBirth` datetime DEFAULT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `CityID` int(11) DEFAULT NULL,
  `CountryID` int(11) DEFAULT NULL,
  `Mobile` int(11) DEFAULT NULL,
  `ProfessionID` int(11) DEFAULT NULL,
  `AboutMe` varchar(10000) DEFAULT NULL,
  `Status` enum('live','disabled','draft','deleted') NOT NULL DEFAULT 'disabled',
  `EmailSent` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `GroupID` int(11) NOT NULL DEFAULT '1',
  `Salt` varchar(256) DEFAULT NULL,
  `FacebookID` varchar(256) DEFAULT NULL,
  `GoogleID` varchar(256) DEFAULT NULL,
  `ProfilePic` varchar(256) NOT NULL DEFAULT 'Default.jpeg',
  `Rating` int(11) NOT NULL DEFAULT '0',
  `FollowersCount` int(11) NOT NULL DEFAULT '0',
  `TagsCount` int(11) NOT NULL DEFAULT '0',
  `FollowingCount` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserID`, `Username`, `Password`, `Email`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `CityID`, `CountryID`, `Mobile`, `ProfessionID`, `AboutMe`, `Status`, `EmailSent`, `GroupID`, `Salt`, `FacebookID`, `GoogleID`, `ProfilePic`, `Rating`, `FollowersCount`, `TagsCount`, `FollowingCount`) VALUES
(110, 149, 'abc', 'NDE2OGJhMTI5YjQ0ZDY2OWU1MTRlOGYwOWMyYzRmM2M=', 'asd@asd.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'live', 'NO', 1, '16260593858230280d0bc84.26966288', NULL, NULL, 'Default.jpeg', 0, 0, 0, 0),
(111, 150, 'root', 'OTYyZDEzM2YzMDI0MzM3NzdjZjUyMTE3MDdjMWY1NTE=', 'example@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'deleted', 'NO', 1, '934020032582305ac64aac6.32518084', NULL, NULL, 'Default.jpeg', 0, 0, 0, 0),
(127, 166, 'kj', 'ODYzNGFhNTQ2NDY0YzBhY2UyOTQ4ODk0MDc1Y2VhNzE=', 'asd@asd.cokuhm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'disabled', 'YES', 1, '12986916985829baacd0d304.37037354', NULL, NULL, 'Default.jpeg', 0, 0, 0, 0),
(128, 167, 'sss', 'MTFkZjc2MmJjNTE0NzNlYjg3NDg4NDQ4NGIxNTBlMTM=', 'assssssd@asd.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'live', 'YES', 1, '15484203605847a5acc081c9.89474683', NULL, NULL, 'Default.jpeg', 0, 0, 0, 0),
(130, 169, 'aaa', 'NzU2MjZjODg0ZTUzODA0Zjg3MTM4MTgwZTllZjhlYjI=', 'aaa@asd.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'live', 'YES', 1, '278675886584904a22d8917.99172483', NULL, NULL, 'Default.jpeg', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_follow_relation`
--

CREATE TABLE `user_follow_relation` (
  `ID` int(11) NOT NULL,
  `FollowedID` int(11) NOT NULL,
  `FollowingID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `ID` int(11) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `GroupName` varchar(100) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`ID`, `GroupID`, `GroupName`, `Status`) VALUES
(1, 1, 'test', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `user_tag_relation`
--

CREATE TABLE `user_tag_relation` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `writer`
--

CREATE TABLE `writer` (
  `ID` int(11) NOT NULL,
  `WriterID` int(11) NOT NULL,
  `WriterName` varchar(100) DEFAULT NULL,
  `Status` enum('live','disabled','draft','delete') NOT NULL DEFAULT 'live'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `writer`
--

INSERT INTO `writer` (`ID`, `WriterID`, `WriterName`, `Status`) VALUES
(1, 1, 'writer1', 'live'),
(2, 2, 'writer2', 'live');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ArtistID` (`ArtistID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CityID` (`CityID`);

--
-- Indexes for table `composer`
--
ALTER TABLE `composer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ComposerID` (`ComposerID`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CountryID` (`CountryID`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `LanguageID` (`LanguageID`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ListingID` (`ListingID`),
  ADD KEY `ListingSourceID` (`ListingSourceID`),
  ADD KEY `LanguageID` (`LanguageID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `listing_artist_relation`
--
ALTER TABLE `listing_artist_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ArtistID` (`ArtistID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `listing_composer_relation`
--
ALTER TABLE `listing_composer_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ComposerID` (`ComposerID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `listing_producer_relation`
--
ALTER TABLE `listing_producer_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProducerID` (`ProducerID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `listing_tag_relation`
--
ALTER TABLE `listing_tag_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ListingID` (`ListingID`),
  ADD KEY `TagID` (`TagID`);

--
-- Indexes for table `listing_writer_relation`
--
ALTER TABLE `listing_writer_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `WriterID` (`WriterID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PlaylistID` (`PlaylistID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `playlist_listing_relation`
--
ALTER TABLE `playlist_listing_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `PlaylistID` (`PlaylistID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProducerID` (`ProducerID`);

--
-- Indexes for table `profession`
--
ALTER TABLE `profession`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProfessionID` (`ProfessionID`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SectionID` (`SectionID`);

--
-- Indexes for table `section_listing_relation`
--
ALTER TABLE `section_listing_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SectionID` (`SectionID`),
  ADD KEY `ListingID` (`ListingID`);

--
-- Indexes for table `source_of_listing`
--
ALTER TABLE `source_of_listing`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SourceID` (`SourceID`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TagID` (`TagID`);

--
-- Indexes for table `tickets_listing`
--
ALTER TABLE `tickets_listing`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tickets_user`
--
ALTER TABLE `tickets_user`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CityID` (`CityID`),
  ADD KEY `CountryID` (`CountryID`),
  ADD KEY `ProfessionID` (`ProfessionID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `user_follow_relation`
--
ALTER TABLE `user_follow_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FollowedID` (`FollowedID`),
  ADD KEY `FollowingID` (`FollowingID`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `GroupID` (`GroupID`);

--
-- Indexes for table `user_tag_relation`
--
ALTER TABLE `user_tag_relation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `TagID` (`TagID`);

--
-- Indexes for table `writer`
--
ALTER TABLE `writer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `WriterID` (`WriterID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `composer`
--
ALTER TABLE `composer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `listing_artist_relation`
--
ALTER TABLE `listing_artist_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `listing_composer_relation`
--
ALTER TABLE `listing_composer_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `listing_producer_relation`
--
ALTER TABLE `listing_producer_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `listing_tag_relation`
--
ALTER TABLE `listing_tag_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `listing_writer_relation`
--
ALTER TABLE `listing_writer_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `playlist_listing_relation`
--
ALTER TABLE `playlist_listing_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `producer`
--
ALTER TABLE `producer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `profession`
--
ALTER TABLE `profession`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `section_listing_relation`
--
ALTER TABLE `section_listing_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `source_of_listing`
--
ALTER TABLE `source_of_listing`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets_listing`
--
ALTER TABLE `tickets_listing`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `tickets_user`
--
ALTER TABLE `tickets_user`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `user_follow_relation`
--
ALTER TABLE `user_follow_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_tag_relation`
--
ALTER TABLE `user_tag_relation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `writer`
--
ALTER TABLE `writer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `listing_ibfk_1` FOREIGN KEY (`ListingSourceID`) REFERENCES `source_of_listing` (`SourceID`),
  ADD CONSTRAINT `listing_ibfk_2` FOREIGN KEY (`LanguageID`) REFERENCES `language` (`LanguageID`),
  ADD CONSTRAINT `listing_ibfk_3` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `listing_artist_relation`
--
ALTER TABLE `listing_artist_relation`
  ADD CONSTRAINT `listing_artist_relation_ibfk_1` FOREIGN KEY (`ArtistID`) REFERENCES `artist` (`ArtistID`),
  ADD CONSTRAINT `listing_artist_relation_ibfk_2` FOREIGN KEY (`ListingID`) REFERENCES `listing` (`ListingID`);

--
-- Constraints for table `listing_composer_relation`
--
ALTER TABLE `listing_composer_relation`
  ADD CONSTRAINT `listing_composer_relation_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listing` (`ListingID`),
  ADD CONSTRAINT `listing_composer_relation_ibfk_2` FOREIGN KEY (`ComposerID`) REFERENCES `composer` (`ComposerID`);

--
-- Constraints for table `listing_producer_relation`
--
ALTER TABLE `listing_producer_relation`
  ADD CONSTRAINT `listing_producer_relation_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listing` (`ListingID`),
  ADD CONSTRAINT `listing_producer_relation_ibfk_2` FOREIGN KEY (`ProducerID`) REFERENCES `producer` (`ProducerID`);

--
-- Constraints for table `listing_tag_relation`
--
ALTER TABLE `listing_tag_relation`
  ADD CONSTRAINT `listing_tag_relation_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listing` (`ListingID`),
  ADD CONSTRAINT `listing_tag_relation_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tag` (`TagID`);

--
-- Constraints for table `listing_writer_relation`
--
ALTER TABLE `listing_writer_relation`
  ADD CONSTRAINT `listing_writer_relation_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listing` (`ListingID`),
  ADD CONSTRAINT `listing_writer_relation_ibfk_2` FOREIGN KEY (`WriterID`) REFERENCES `writer` (`WriterID`);

--
-- Constraints for table `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `playlist_listing_relation`
--
ALTER TABLE `playlist_listing_relation`
  ADD CONSTRAINT `playlist_listing_relation_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listing` (`ListingID`),
  ADD CONSTRAINT `playlist_listing_relation_ibfk_2` FOREIGN KEY (`PlaylistID`) REFERENCES `playlist` (`PlaylistID`);

--
-- Constraints for table `section_listing_relation`
--
ALTER TABLE `section_listing_relation`
  ADD CONSTRAINT `section_listing_relation_ibfk_1` FOREIGN KEY (`ListingID`) REFERENCES `listing` (`ListingID`),
  ADD CONSTRAINT `section_listing_relation_ibfk_2` FOREIGN KEY (`SectionID`) REFERENCES `sections` (`SectionID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`CityID`) REFERENCES `city` (`CityID`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`CountryID`) REFERENCES `country` (`CountryID`),
  ADD CONSTRAINT `user_ibfk_4` FOREIGN KEY (`ProfessionID`) REFERENCES `profession` (`ProfessionID`),
  ADD CONSTRAINT `user_ibfk_5` FOREIGN KEY (`GroupID`) REFERENCES `user_groups` (`GroupID`);

--
-- Constraints for table `user_follow_relation`
--
ALTER TABLE `user_follow_relation`
  ADD CONSTRAINT `user_follow_relation_ibfk_1` FOREIGN KEY (`FollowedID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `user_follow_relation_ibfk_2` FOREIGN KEY (`FollowingID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `user_tag_relation`
--
ALTER TABLE `user_tag_relation`
  ADD CONSTRAINT `user_tag_relation_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`),
  ADD CONSTRAINT `user_tag_relation_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tag` (`TagID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
