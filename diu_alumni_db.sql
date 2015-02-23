-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2015 at 05:06 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diu_alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE IF NOT EXISTS `career` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `companyName` text NOT NULL,
  `designation` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `duration` double DEFAULT '0',
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`id`, `userId`, `companyName`, `designation`, `description`, `duration`, `status`) VALUES
(1, 3, 'WebliveIT', 'Web Developer', 'Developing web application and designing DB.', 3, 'Past'),
(3, 3, 'Demo company', 'Developer', 'Developing...', 2, 'Past');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text CHARACTER SET utf8 NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postId` (`postId`,`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `body`, `time`, `postId`, `userId`) VALUES
(3, 'Really good post. Thank you!', '2015-01-15 15:59:58', 2, 3),
(4, 'nice post, I love this post!', '2015-01-15 16:05:37', 1, 3),
(6, 'Another good post form you!', '2015-01-15 16:06:16', 1, 3),
(7, 'I really love you post....', '2015-01-15 16:06:25', 1, 3),
(8, 'text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also', '2015-01-15 16:07:55', 1, 3),
(9, 'nllkl\r\n', '2015-01-15 16:11:30', 3, 2),
(10, 'yho;joko\r\nohhi', '2015-01-15 16:11:41', 3, 2),
(11, 'nice post! I like it and fuck u \\mitthu', '2015-01-16 15:06:35', 3, 3),
(12, 'I like this post! OK?', '2015-01-21 15:35:27', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(15, 'Computer Science & Engineering'),
(43, 'Electric & Electrical Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `educational_qualification`
--

CREATE TABLE IF NOT EXISTS `educational_qualification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `exam` varchar(255) NOT NULL,
  `department` text NOT NULL,
  `institute` text NOT NULL,
  `cgpa` varchar(255) NOT NULL,
  `passingYear` year(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `educational_qualification`
--

INSERT INTO `educational_qualification` (`id`, `userId`, `exam`, `department`, `institute`, `cgpa`, `passingYear`) VALUES
(1, 3, 'B. Sc.', 'Computer Science and Engineering', 'Daffodil International University', '3.00', 2014),
(2, 3, 'H. S. C.', 'Science', 'Brahmanbaria Govt. College', '4.50', 2010),
(3, 3, 'S. S. C.', 'Science', 'Aruail Bohu Mukhi High School', '4.88', 2008);

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE IF NOT EXISTS `friendrequest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `status` enum('pending','accepted','rejected') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `friendrequest`
--

INSERT INTO `friendrequest` (`id`, `senderId`, `receiverId`, `status`) VALUES
(8, 3, 2, 'accepted'),
(9, 3, 4, 'accepted'),
(10, 4, 2, 'accepted'),
(11, 3, 7, 'rejected'),
(12, 8, 3, 'accepted'),
(13, 8, 2, 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `friendId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`,`friendId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `friendship`
--

INSERT INTO `friendship` (`id`, `userId`, `friendId`, `time`) VALUES
(7, 3, 4, '2015-01-12 13:58:24'),
(8, 4, 3, '2015-01-12 13:58:24'),
(9, 4, 2, '2015-01-12 14:12:17'),
(10, 2, 4, '2015-01-12 14:12:17'),
(11, 3, 2, '2015-01-12 14:19:17'),
(12, 2, 3, '2015-01-12 14:19:18'),
(13, 8, 3, '2015-01-19 13:09:55'),
(14, 3, 8, '2015-01-19 13:09:55'),
(15, 8, 2, '2015-01-21 15:21:51'),
(16, 2, 8, '2015-01-21 15:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `department` int(11) NOT NULL,
  `about` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `department`, `about`, `time`) VALUES
(1, 'Computer Science & Engineering Alumni Group', 15, 'Lead the machines...', '2015-01-19 13:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `membergroupmap`
--

CREATE TABLE IF NOT EXISTS `membergroupmap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `userType` enum('admin','member') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `time` timestamp NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `sendId` int(11) NOT NULL,
  `receiveId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `senderId` (`senderId`,`receiverId`),
  KEY `sendId` (`sendId`,`receiveId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `userId` int(11) NOT NULL,
  `time` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text CHARACTER SET utf8 NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `groupId` (`groupId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `body`, `time`, `userId`, `groupId`) VALUES
(1, 'I love you than I can say..........', '2015-01-14 16:23:19', 3, NULL),
(2, 'Ok, this is another test post. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also', '2015-01-14 16:40:18', 3, NULL),
(3, 'Let''s try this out! this is an edition test!', '2015-01-15 16:11:20', 2, NULL),
(4, 'Football khelum ............... FIFA !%', '2015-01-18 15:18:33', 4, NULL),
(5, 'Hello post!', '2015-01-21 15:20:53', 3, NULL),
(6, 'Hello post....ok?', '2015-01-21 15:32:04', 2, 15);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `name`) VALUES
(2, 'B. Sc.'),
(3, 'M. Sc.'),
(4, 'Bachelor'),
(5, 'Masters');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `link` text NOT NULL,
  `groupMember` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `userId`, `title`, `description`, `link`, `groupMember`) VALUES
(4, 2, 'Alumni Social Web', 'Nothing here...', 'http://localhost/diu_alumni/home', 'Ferdous Rifat'),
(7, 3, 'Chess', 'A human vs human game...', 'http://www.github.com/alimrancse', 'Sagar Chakraborty, Masudur Rahman');

-- --------------------------------------------------------

--
-- Table structure for table `receivedmessage`
--

CREATE TABLE IF NOT EXISTS `receivedmessage` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sentmessage`
--

CREATE TABLE IF NOT EXISTS `sentmessage` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `firstName` varchar(150) NOT NULL,
  `lastName` varchar(150) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `about` text CHARACTER SET utf8 NOT NULL,
  `maritalStatus` varchar(20) NOT NULL,
  `fatherName` varchar(150) NOT NULL,
  `motherName` varchar(150) NOT NULL,
  `religion` varchar(30) NOT NULL,
  `birthday` varchar(10) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `universityId` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL,
  `program` int(11) NOT NULL,
  `skills` text NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `batch_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `departnment` (`program`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `firstName`, `lastName`, `photo`, `status`, `gender`, `about`, `maritalStatus`, `fatherName`, `motherName`, `religion`, `birthday`, `phone`, `reg_time`, `universityId`, `role`, `program`, `skills`, `country`, `address`, `batch_id`, `department_id`, `student_id`) VALUES
(2, '', '827ccb0eea8a706c4c34a16891f84e7b', 'mithu@diu.edu.bd', 'Asaduzzaman', 'Mithu', 'public/images/users/2.png', 1, 'Male', 'I am Mithu. I love you programming. Do you know me Mr?', 'Married', 'Abdus Samad', 'Shelina Begum', 'Islam', '01/01/1970', '01757430980', '2014-12-29 10:53:41', '111-15-1273', '', 2, 'Oracle DB<br />\r\nHTML, CSS etc', 'Bangladesh', '1/D North Adabor,MOhammadpur', 0, 15, 0),
(3, '', 'aeda6d66c337fa09f185719baa2334f9', 'imran15-1191@diu.edu.bd', 'Al- Imran', 'Ahmed', 'public/images/users/3.jpg', 1, 'Male', 'I am Al- Imran Ahmed. I love you programming. Do you know me Mr?', 'Unmarried', 'Kabir Ahmed', 'Sahena Ahmed', 'Islam', '08/02/1992', '01748197835', '2014-12-29 10:54:35', '111-15-1191', '', 2, 'Developing: PHP, JAVA<br />\r\nDatabase: MySql', 'Bangladesh', 'Dhaka-1215', 0, 15, 0),
(4, '', 'e10adc3949ba59abbe56e057f20f883e', 'rifat4@diu.edu.bd', 'Ferdous', 'Rifat', 'public/images/users/4.jpg', 1, 'Male', 'I am Rifat. I love you programming. Now, I am interested about oracle DBMS.', 'Married', '', '', 'Other', '01/01/1970', '', '2014-12-29 11:13:25', '111-15-1292', 'user', 2, 'Database: Oracle<br />\r\nDesign: Bootstra, Html, CSS etc.<br />\r\nOthers: Ms Office, Linux(UBUNTU), Cisco', '', '', 0, 15, 0),
(6, '', '827ccb0eea8a706c4c34a16891f84e7b', 'rakib@diu.edu.bd', 'Rakib', 'Hasan', 'public/images/users/6.png', 1, 'Male', '', 'Married', '', '', 'Islam', '01/01/1970', '', '2015-01-05 07:01:55', '111-43-2014', 'user', 2, '', '', '', 0, 0, 0),
(7, '', 'e10adc3949ba59abbe56e057f20f883e', 'tuhin@diu.edu.bd', 'tuhin', 'islam', 'public/images/users/7.jpg', 1, '', '', '', '', '', '', '', '', '2015-01-08 05:08:17', '111-15-1298', 'user', 2, '', '', '', 0, 0, 0),
(8, '', '827ccb0eea8a706c4c34a16891f84e7b', 'amirul1313@diu.edu.bd', 'Amirul', 'Islam', 'public/images/users/8.png', 1, '', '', '', '', '', '', '', '', '2015-01-19 13:03:17', '', 'user', 2, '', '', '', 111, 15, 1313);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
