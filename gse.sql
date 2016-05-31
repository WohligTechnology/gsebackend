-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2016 at 07:38 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gse`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevel`
--

CREATE TABLE IF NOT EXISTS `accesslevel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accesslevel`
--

INSERT INTO `accesslevel` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'Operator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `gse_award`
--

CREATE TABLE IF NOT EXISTS `gse_award` (
  `id` int(11) NOT NULL,
  `movie` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_award`
--

INSERT INTO `gse_award` (`id`, `movie`, `name`) VALUES
(1, 1, 'demo award');

-- --------------------------------------------------------

--
-- Table structure for table `gse_awarddetail`
--

CREATE TABLE IF NOT EXISTS `gse_awarddetail` (
  `id` int(11) NOT NULL,
  `award` varchar(255) NOT NULL,
  `awardname` varchar(255) NOT NULL,
  `awardreceiver` varchar(255) NOT NULL,
  `winnername` varchar(255) NOT NULL,
  `movie` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_awarddetail`
--

INSERT INTO `gse_awarddetail` (`id`, `award`, `awardname`, `awardreceiver`, `winnername`, `movie`) VALUES
(1, 'Film Fare', 'R D Burman', 'Kabir Shekhawat', 'Hello Brother', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gse_blogimage`
--

CREATE TABLE IF NOT EXISTS `gse_blogimage` (
  `id` int(11) NOT NULL,
  `diaryarticle` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_blogimage`
--

INSERT INTO `gse_blogimage` (`id`, `diaryarticle`, `image`, `order`) VALUES
(1, 1, 'Thank-You-Mumbai1.png', 1),
(2, 1, 'Top-Moment.png', 2),
(3, 2, 'Top-Moment2.png', 1),
(4, 2, '2.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gse_blogtext`
--

CREATE TABLE IF NOT EXISTS `gse_blogtext` (
  `id` int(11) NOT NULL,
  `diaryarticle` int(11) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_blogtext`
--

INSERT INTO `gse_blogtext` (`id`, `diaryarticle`, `content`, `image`, `order`) VALUES
(1, 1, 'demo for blog text', '15.jpg', 1),
(2, 1, 'demo 2', 'Thank-You-Mumbai.png', 2),
(3, 2, 'egrea', 'Top-Moment1.png', 1),
(4, 2, 'dgvaregfr', '16.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gse_blogvideo`
--

CREATE TABLE IF NOT EXISTS `gse_blogvideo` (
  `id` int(11) NOT NULL,
  `diaryarticle` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_blogvideo`
--

INSERT INTO `gse_blogvideo` (`id`, `diaryarticle`, `url`, `order`) VALUES
(1, 1, 'tyaweyfAFD', 1),
(2, 1, 'refe', 2),
(3, 2, 'rggtgtrf', 1),
(4, 2, 'gdhvjyfdjv', 2);

-- --------------------------------------------------------

--
-- Table structure for table `gse_careerform`
--

CREATE TABLE IF NOT EXISTS `gse_careerform` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gse_careerposition`
--

CREATE TABLE IF NOT EXISTS `gse_careerposition` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_careerposition`
--

INSERT INTO `gse_careerposition` (`id`, `name`, `position`, `education`) VALUES
(1, 'Executive Developer', '3', 'BE Comp');

-- --------------------------------------------------------

--
-- Table structure for table `gse_category`
--

CREATE TABLE IF NOT EXISTS `gse_category` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_category`
--

INSERT INTO `gse_category` (`id`, `order`, `status`, `name`, `category`) VALUES
(1, 1, 1, 'demo', ''),
(2, 2, 1, 'demo2', '');

-- --------------------------------------------------------

--
-- Table structure for table `gse_clientdetail`
--

CREATE TABLE IF NOT EXISTS `gse_clientdetail` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `banner` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_clientdetail`
--

INSERT INTO `gse_clientdetail` (`id`, `order`, `status`, `name`, `image`, `title`, `url`, `content`, `banner`) VALUES
(1, 1, 1, 'GS', '111.png', 'GE Entertainment', 'http://gse.in', 'demo content', 'Untitled.png'),
(2, 0, 0, '', '', '', '', '', '1stscreeshot.png');

-- --------------------------------------------------------

--
-- Table structure for table `gse_clientlogo`
--

CREATE TABLE IF NOT EXISTS `gse_clientlogo` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_clientlogo`
--

INSERT INTO `gse_clientlogo` (`id`, `order`, `status`, `name`, `image`) VALUES
(1, 1, 1, 'demo', '112.png');

-- --------------------------------------------------------

--
-- Table structure for table `gse_diaryarticle`
--

CREATE TABLE IF NOT EXISTS `gse_diaryarticle` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `diarycategory` int(11) NOT NULL,
  `diarysubcategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `type` int(11) NOT NULL,
  `showhide` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_diaryarticle`
--

INSERT INTO `gse_diaryarticle` (`id`, `status`, `diarycategory`, `diarysubcategory`, `name`, `image`, `timestamp`, `content`, `date`, `type`, `showhide`) VALUES
(1, 1, 1, 1, 'Demo diary article', 'day-03.png', '2016-04-20 07:31:00', '<p>Content for artic le</p>', '2016-03-09', 3, 3),
(2, 1, 1, 1, 'demo 2', 'Thank-You-Mumbai2.png', '2016-04-20 07:11:56', '<p>dsavrv</p>', '2016-04-20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gse_diarycategory`
--

CREATE TABLE IF NOT EXISTS `gse_diarycategory` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_diarycategory`
--

INSERT INTO `gse_diarycategory` (`id`, `order`, `status`, `name`) VALUES
(1, 1, 1, 'Diary category');

-- --------------------------------------------------------

--
-- Table structure for table `gse_diarysubcategory`
--

CREATE TABLE IF NOT EXISTS `gse_diarysubcategory` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `diarycategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_diarysubcategory`
--

INSERT INTO `gse_diarysubcategory` (`id`, `order`, `status`, `diarycategory`, `name`) VALUES
(1, 1, 1, 1, 'demo diary sub category');

-- --------------------------------------------------------

--
-- Table structure for table `gse_generalenquiry`
--

CREATE TABLE IF NOT EXISTS `gse_generalenquiry` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `webaddress` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_generalenquiry`
--

INSERT INTO `gse_generalenquiry` (`id`, `firstname`, `middlename`, `lastname`, `companyname`, `email`, `phone`, `webaddress`, `message`) VALUES
(1, 'Pooja', 'gfsgf', 'gfgagf', 'woh', 'pooja.wohlig@gmail.com', '9594390024', 'dfedb dsfhjsh hdsfgd', 'afadsfdsafsdf');

-- --------------------------------------------------------

--
-- Table structure for table `gse_getintouch`
--

CREATE TABLE IF NOT EXISTS `gse_getintouch` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  `enquiryfor` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_getintouch`
--

INSERT INTO `gse_getintouch` (`id`, `category`, `firstname`, `lastname`, `email`, `phone`, `timestamp`, `comment`, `enquiryfor`) VALUES
(1, 1, 'Firstname', 'Lastname', 'demo@demo.com', '9594390043', '2016-03-29 09:26:12', 'Demo comment', 'Comma separated enquiries');

-- --------------------------------------------------------

--
-- Table structure for table `gse_highlight`
--

CREATE TABLE IF NOT EXISTS `gse_highlight` (
  `id` int(11) NOT NULL,
  `sportscategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `videos` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_highlight`
--

INSERT INTO `gse_highlight` (`id`, `sportscategory`, `name`, `image`, `link`, `location`, `content`, `videos`, `date`) VALUES
(1, 1, 'demo1', '1371.png', 'wohlig.com', 'airoli', 'dgr  yth try', '', '2016-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `gse_movie`
--

CREATE TABLE IF NOT EXISTS `gse_movie` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `movie` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_movie`
--

INSERT INTO `gse_movie` (`id`, `content`, `movie`) VALUES
(1, 'dhsfgeyrgfgyfguy', 1),
(2, 'qwer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gse_moviedetail`
--

CREATE TABLE IF NOT EXISTS `gse_moviedetail` (
  `id` int(11) NOT NULL,
  `isupcoming` int(11) NOT NULL,
  `isreleased` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `imdb` varchar(255) NOT NULL,
  `producer` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `cast` varchar(255) NOT NULL,
  `music` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `videos` text NOT NULL,
  `releasedate` date NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_moviedetail`
--

INSERT INTO `gse_moviedetail` (`id`, `isupcoming`, `isreleased`, `name`, `banner`, `imdb`, `producer`, `director`, `cast`, `music`, `synopsis`, `videos`, `releasedate`, `image`) VALUES
(1, 1, 2, 'demo', '1.png', 'http://www.abc.com', 'drfghjn', 'fghjnk', 'fghjk', 'fghj', 'ghj', 'tgyhj', '2016-04-20', 'aura.png');

-- --------------------------------------------------------

--
-- Table structure for table `gse_moviegallery`
--

CREATE TABLE IF NOT EXISTS `gse_moviegallery` (
  `id` int(11) NOT NULL,
  `movie` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_moviegallery`
--

INSERT INTO `gse_moviegallery` (`id`, `movie`, `order`, `status`, `image`) VALUES
(1, 1, 1, 1, '12.png'),
(2, 1, 2, 2, '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gse_moviewallpaper`
--

CREATE TABLE IF NOT EXISTS `gse_moviewallpaper` (
  `id` int(11) NOT NULL,
  `movie` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_moviewallpaper`
--

INSERT INTO `gse_moviewallpaper` (`id`, `movie`, `image`) VALUES
(1, 1, '2_(2)4.png'),
(2, 1, '1_(1)1.png');

-- --------------------------------------------------------

--
-- Table structure for table `gse_player`
--

CREATE TABLE IF NOT EXISTS `gse_player` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `sportscategory` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_player`
--

INSERT INTO `gse_player` (`id`, `order`, `status`, `sportscategory`, `name`, `image`) VALUES
(1, 1, 1, 1, 'polo', '1373.png');

-- --------------------------------------------------------

--
-- Table structure for table `gse_previousgamegallery`
--

CREATE TABLE IF NOT EXISTS `gse_previousgamegallery` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `highlight` int(11) NOT NULL,
  `sportscategory` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_previousgamegallery`
--

INSERT INTO `gse_previousgamegallery` (`id`, `order`, `status`, `highlight`, `sportscategory`, `image`) VALUES
(1, 1, 1, 1, 1, '1372.png'),
(2, 2, 1, 1, 1, 'aura2.png');

-- --------------------------------------------------------

--
-- Table structure for table `gse_previousgamevideo`
--

CREATE TABLE IF NOT EXISTS `gse_previousgamevideo` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `highlight` int(11) NOT NULL,
  `sportscategory` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gse_previousgamevideo`
--

INSERT INTO `gse_previousgamevideo` (`id`, `url`, `order`, `highlight`, `sportscategory`) VALUES
(1, 'http://admin.myfynx.com', 1, 1, 1),
(2, 'https://youtu.be/GGErfAmSK9I', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gse_proposedproject`
--

CREATE TABLE IF NOT EXISTS `gse_proposedproject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `webaddress` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question1ans` varchar(255) NOT NULL,
  `question2ans` varchar(255) NOT NULL,
  `question3ans` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_proposedproject`
--

INSERT INTO `gse_proposedproject` (`id`, `name`, `company`, `webaddress`, `country`, `phone`, `email`, `question1ans`, `question2ans`, `question3ans`, `content`) VALUES
(1, 'Wohlig', 'Wohlig Tech', 'http://wohlig.com', 'India', '9876543223', 'info@wohlig.com', '1', '2', '4', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `gse_service`
--

CREATE TABLE IF NOT EXISTS `gse_service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `type` int(11) NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_service`
--

INSERT INTO `gse_service` (`id`, `name`, `content`, `type`, `order`) VALUES
(1, 'demo', 'Demo content', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gse_sportscategory`
--

CREATE TABLE IF NOT EXISTS `gse_sportscategory` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_sportscategory`
--

INSERT INTO `gse_sportscategory` (`id`, `order`, `status`, `name`, `image`, `link`, `banner`, `content`) VALUES
(1, 1, 1, 'JPP', '1stscreeshot1.png', 'wohlig.com', '137.png', 'hf hfj');

-- --------------------------------------------------------

--
-- Table structure for table `gse_subscribe`
--

CREATE TABLE IF NOT EXISTS `gse_subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_subscribe`
--

INSERT INTO `gse_subscribe` (`id`, `email`, `timestamp`) VALUES
(1, 'pooja.wohlig@gmail.com', '2016-03-29 07:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `gse_talent`
--

CREATE TABLE IF NOT EXISTS `gse_talent` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_talent`
--

INSERT INTO `gse_talent` (`id`, `name`, `image`, `link`) VALUES
(1, 'demo1', '_MGL16732.jpg', 'wohlig.com'),
(2, 'second', '14.jpg', 'wohlig.com');

-- --------------------------------------------------------

--
-- Table structure for table `gse_talenttype`
--

CREATE TABLE IF NOT EXISTS `gse_talenttype` (
  `id` int(11) NOT NULL,
  `talent` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `videos` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_talenttype`
--

INSERT INTO `gse_talenttype` (`id`, `talent`, `order`, `status`, `name`, `image`, `url`, `banner`, `content`, `videos`) VALUES
(1, 1, 1, 1, 'demo', '2_(1)1.png', 'http://accessworld.in', '2_(1)2.png', 'fghjk', 'hjrsmhrf,yaerjea,erager'),
(2, 2, 1, 1, 'demo', '2_(2)1.png', 'http://moviewsapp.com', '2_(1)3.png', 'fghjk', 'jserbceu,ebcr87er'),
(4, 2, 1, 1, 'demo', '1376.png', 'http://moviewsapp.com', 'aura3.png', 'hwrae ewf aeusf', '');

-- --------------------------------------------------------

--
-- Table structure for table `gse_talenttypegallery`
--

CREATE TABLE IF NOT EXISTS `gse_talenttypegallery` (
  `id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `talenttype` int(11) NOT NULL,
  `talent` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_talenttypegallery`
--

INSERT INTO `gse_talenttypegallery` (`id`, `order`, `status`, `talenttype`, `talent`, `image`) VALUES
(1, 1, 1, 2, 0, '1_(1).png'),
(2, 2, 1, 2, 0, '1377.png'),
(3, 2, 1, 2, 0, 'aura4.png');

-- --------------------------------------------------------

--
-- Table structure for table `gse_talenttypevideo`
--

CREATE TABLE IF NOT EXISTS `gse_talenttypevideo` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `talenttype` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gse_talenttypevideo`
--

INSERT INTO `gse_talenttypevideo` (`id`, `url`, `order`, `talenttype`) VALUES
(1, 'https://youtu.be/GGErfAmSK9I', 1, 2),
(2, 'http://moviewsapp.com', 2, 2),
(3, 'http://admin.ccc.com', 3, 2),
(5, 'http://gse.in', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gse_testimonial`
--

CREATE TABLE IF NOT EXISTS `gse_testimonial` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quote` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_testimonial`
--

INSERT INTO `gse_testimonial` (`id`, `category`, `status`, `order`, `name`, `author`, `image`, `quote`) VALUES
(1, 1, 1, 1, 'demo', 'Demo name', 'BES02MAIN.JPG', 'Demo quote');

-- --------------------------------------------------------

--
-- Table structure for table `gse_wedding`
--

CREATE TABLE IF NOT EXISTS `gse_wedding` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_wedding`
--

INSERT INTO `gse_wedding` (`id`, `name`, `image`, `banner`) VALUES
(1, '360 Wedding', '14.png', 'Home-Banners-Shoes1[1]1.jpg'),
(2, 'Sangeet', '', ''),
(3, 'Mehendi', '', ''),
(4, 'Cocktails', '', ''),
(5, 'Destination', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `gse_weddinggallery`
--

CREATE TABLE IF NOT EXISTS `gse_weddinggallery` (
  `id` int(11) NOT NULL,
  `wedding` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gse_weddingsubtype`
--

CREATE TABLE IF NOT EXISTS `gse_weddingsubtype` (
  `id` int(11) NOT NULL,
  `wedding` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `videos` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_weddingsubtype`
--

INSERT INTO `gse_weddingsubtype` (`id`, `wedding`, `name`, `image`, `content`, `videos`) VALUES
(1, 1, 'Choksi talera wedding set up', 'the_joker_the_dark_knight-wallpaper-1366x768.jpg', 'The beautiful #choksitalerawedding took place at Mohini Mahal on 16th April, 2014. The entire #event was organized and managed by GS Worldwide Entertainment. #gswedding', 'jhasfher, sdfkuahgdf'),
(2, 1, 'demo', 'SFA_FLAG_UW.jpg', 'fjgadf', 'geyfe, yueued');

-- --------------------------------------------------------

--
-- Table structure for table `gse_weddingtype`
--

CREATE TABLE IF NOT EXISTS `gse_weddingtype` (
  `id` int(11) NOT NULL,
  `wedding` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gse_weddingtype`
--

INSERT INTO `gse_weddingtype` (`id`, `wedding`, `name`, `image`, `banner`) VALUES
(2, 0, 'demo', '8.jpg', 'urban-classics-t-shirt-tall-tee-blue-34463.jpg'),
(3, 1, 'demo', '2_(2)2.png', '13.png'),
(4, 1, 'polo', 'broken_knight-wallpaper-1366x768.jpg', 'q2EEsvQ.jpg'),
(5, 3, 'asfjeryerg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `logintype`
--

CREATE TABLE IF NOT EXISTS `logintype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logintype`
--

INSERT INTO `logintype` (`id`, `name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Email'),
(4, 'Google');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `linktype` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  `isactive` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `description`, `keyword`, `url`, `linktype`, `parent`, `isactive`, `order`, `icon`) VALUES
(1, 'General Enquiry', '', '', 'site/viewgeneralenquiry', '1', 0, 1, 1, 'icon-dashboard'),
(2, 'Proposed Project', '', '', 'site/viewproposedproject', '1', 0, 1, 1, 'icon-dashboard'),
(3, 'Category', '', '', 'site/viewcategory', '1', 0, 1, 1, 'icon-dashboard'),
(4, 'Movie Detail', '', '', 'site/viewmoviedetail', '1', 0, 1, 0, 'icon-dashboard'),
(5, 'Subscribe', '', '', 'site/viewsubscribe', '1', 0, 1, 1, 'icon-dashboard'),
(6, 'Testimonial', '', '', 'site/viewtestimonial', '1', 0, 1, 2, 'icon-dashboard'),
(7, 'Get in touch', '', '', 'site/viewgetintouch', '1', 0, 1, 1, 'icon-dashboard'),
(8, 'Diary Category', '', '', 'site/viewdiarycategory', '1', 0, 1, 3, 'icon-dashboard'),
(9, 'Wedding', '', '', 'site/viewwedding', '1', 0, 1, 0, 'icon-dashboard'),
(10, 'Service', '', '', 'site/viewservice', '1', 0, 1, 1, 'icon-dashboard'),
(11, 'Diary Sub-Category', '', '', 'site/viewdiarysubcategory', '1', 0, 1, 4, 'icon-dashboard'),
(12, 'Diary Article', '', '', 'site/viewdiaryarticle', '1', 0, 1, 5, 'icon-dashboard'),
(14, 'Talent', '', '', 'site/viewtalent', '1', 0, 1, 9, 'icon-dashboard'),
(17, 'Sports Category', '', '', 'site/viewsportscategory', '1', 0, 1, 6, 'icon-dashboard'),
(18, 'Highlight', '', '', 'site/viewhighlight', '1', 0, 1, 7, 'icon-dashboard'),
(19, 'Previous Game Gallery', '', '', 'site/viewpreviousgamegallery', '1', 0, 1, 1, 'icon-dashboard'),
(20, 'Player', '', '', 'site/viewplayer', '1', 0, 1, 8, 'icon-dashboard'),
(21, 'Client Logo', '', '', 'site/viewclientlogo', '1', 0, 1, 1, 'icon-dashboard'),
(22, 'Client Detail', '', '', 'site/viewclientdetail', '1', 0, 1, 1, 'icon-dashboard'),
(23, 'Career', '', '', 'site/viewcareerform', '1', 0, 1, 1, 'icon-dashboard'),
(24, 'Career Position', '', '', 'site/viewcareerposition', '1', 0, 1, 1, 'icon-dashboard'),
(25, 'Talent Type', '', '', 'site/viewtalenttype', '1', 0, 1, 10, 'icon-dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `menuaccess`
--

CREATE TABLE IF NOT EXISTS `menuaccess` (
  `menu` int(11) NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuaccess`
--

INSERT INTO `menuaccess` (`menu`, `access`) VALUES
(1, 1),
(4, 1),
(2, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 0),
(15, 1),
(16, 1),
(18, 1),
(19, 0),
(20, 0),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(6, 1),
(17, 1),
(20, 1),
(14, 1),
(25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(0, 'Choose Status'),
(1, 'Enable'),
(2, 'Disable');

-- --------------------------------------------------------

--
-- Table structure for table `talentvideo`
--

CREATE TABLE IF NOT EXISTS `talentvideo` (
  `id` int(11) NOT NULL,
  `talent` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`id`, `name`, `logo`) VALUES
(1, '', '11.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `accesslevel` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `socialid` varchar(255) NOT NULL,
  `logintype` varchar(255) NOT NULL,
  `json` text NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `billingaddress` text NOT NULL,
  `billingcity` varchar(255) NOT NULL,
  `billingstate` varchar(255) NOT NULL,
  `billingcountry` varchar(255) NOT NULL,
  `billingcontact` varchar(255) NOT NULL,
  `billingpincode` varchar(255) NOT NULL,
  `shippingaddress` text NOT NULL,
  `shippingcity` varchar(255) NOT NULL,
  `shippingcountry` varchar(255) NOT NULL,
  `shippingstate` varchar(255) NOT NULL,
  `shippingpincode` varchar(255) NOT NULL,
  `shippingname` varchar(255) NOT NULL,
  `shippingcontact` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `registrationno` varchar(255) NOT NULL,
  `vatnumber` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `dob` date NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `firstname`, `lastname`, `phone`, `billingaddress`, `billingcity`, `billingstate`, `billingcountry`, `billingcontact`, `billingpincode`, `shippingaddress`, `shippingcity`, `shippingcountry`, `shippingstate`, `shippingpincode`, `shippingname`, `shippingcontact`, `currency`, `credit`, `companyname`, `registrationno`, `vatnumber`, `country`, `fax`, `gender`, `facebook`, `google`, `twitter`, `street`, `address`, `dob`, `city`, `state`, `pincode`) VALUES
(1, 'wohlig', 'a63526467438df9566c508027d9cb06b', 'wohlig@wohlig.com', 1, '0000-00-00 00:00:00', 1, 'images_(2)1.jpg', '', '', 'Facebook', '0', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '0000-00-00', '', '', ''),
(6, 'Pooja Thakare', '', 'pooja.wohlig@gmail.com', 3, '2015-12-09 06:02:37', 1, 'https://lh5.googleusercontent.com/-5B1PwZZrwdI/AAAAAAAAAAI/AAAAAAAAABw/J3Hf871N8IE/photo.jpg', '', '103402210128529539675', 'Google', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '103402210128529539675', '', '', '', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE IF NOT EXISTS `userlog` (
  `id` int(11) NOT NULL,
  `onuser` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `onuser`, `status`, `description`, `timestamp`) VALUES
(1, 1, 1, 'User Address Edited', '2014-05-12 06:50:21'),
(2, 1, 1, 'User Details Edited', '2014-05-12 06:51:43'),
(3, 1, 1, 'User Details Edited', '2014-05-12 06:51:53'),
(4, 4, 1, 'User Created', '2014-05-12 06:52:44'),
(5, 4, 1, 'User Address Edited', '2014-05-12 12:31:48'),
(6, 23, 2, 'User Created', '2014-10-07 06:46:55'),
(7, 24, 2, 'User Created', '2014-10-07 06:48:25'),
(8, 25, 2, 'User Created', '2014-10-07 06:49:04'),
(9, 26, 2, 'User Created', '2014-10-07 06:49:16'),
(10, 27, 2, 'User Created', '2014-10-07 06:52:18'),
(11, 28, 2, 'User Created', '2014-10-07 06:52:45'),
(12, 29, 2, 'User Created', '2014-10-07 06:53:10'),
(13, 30, 2, 'User Created', '2014-10-07 06:53:33'),
(14, 31, 2, 'User Created', '2014-10-07 06:55:03'),
(15, 32, 2, 'User Created', '2014-10-07 06:55:33'),
(16, 33, 2, 'User Created', '2014-10-07 06:59:32'),
(17, 34, 2, 'User Created', '2014-10-07 07:01:18'),
(18, 35, 2, 'User Created', '2014-10-07 07:01:50'),
(19, 34, 2, 'User Details Edited', '2014-10-07 07:04:34'),
(20, 18, 2, 'User Details Edited', '2014-10-07 07:05:11'),
(21, 18, 2, 'User Details Edited', '2014-10-07 07:05:45'),
(22, 18, 2, 'User Details Edited', '2014-10-07 07:06:03'),
(23, 7, 6, 'User Created', '2014-10-17 06:22:29'),
(24, 7, 6, 'User Details Edited', '2014-10-17 06:32:22'),
(25, 7, 6, 'User Details Edited', '2014-10-17 06:32:37'),
(26, 8, 6, 'User Created', '2014-11-15 12:05:52'),
(27, 9, 6, 'User Created', '2014-12-02 10:46:36'),
(28, 9, 6, 'User Details Edited', '2014-12-02 10:47:34'),
(29, 4, 6, 'User Details Edited', '2014-12-03 10:34:49'),
(30, 4, 6, 'User Details Edited', '2014-12-03 10:36:34'),
(31, 4, 6, 'User Details Edited', '2014-12-03 10:36:49'),
(32, 8, 6, 'User Details Edited', '2014-12-03 10:47:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesslevel`
--
ALTER TABLE `accesslevel`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `gse_award`
--
ALTER TABLE `gse_award`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_awarddetail`
--
ALTER TABLE `gse_awarddetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_blogimage`
--
ALTER TABLE `gse_blogimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_blogtext`
--
ALTER TABLE `gse_blogtext`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_blogvideo`
--
ALTER TABLE `gse_blogvideo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_careerform`
--
ALTER TABLE `gse_careerform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_careerposition`
--
ALTER TABLE `gse_careerposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_category`
--
ALTER TABLE `gse_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_clientdetail`
--
ALTER TABLE `gse_clientdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_clientlogo`
--
ALTER TABLE `gse_clientlogo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_diaryarticle`
--
ALTER TABLE `gse_diaryarticle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_diarycategory`
--
ALTER TABLE `gse_diarycategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_diarysubcategory`
--
ALTER TABLE `gse_diarysubcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_generalenquiry`
--
ALTER TABLE `gse_generalenquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_getintouch`
--
ALTER TABLE `gse_getintouch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_highlight`
--
ALTER TABLE `gse_highlight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_movie`
--
ALTER TABLE `gse_movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_moviedetail`
--
ALTER TABLE `gse_moviedetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_moviegallery`
--
ALTER TABLE `gse_moviegallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_moviewallpaper`
--
ALTER TABLE `gse_moviewallpaper`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_player`
--
ALTER TABLE `gse_player`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_previousgamegallery`
--
ALTER TABLE `gse_previousgamegallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_previousgamevideo`
--
ALTER TABLE `gse_previousgamevideo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_proposedproject`
--
ALTER TABLE `gse_proposedproject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_service`
--
ALTER TABLE `gse_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_sportscategory`
--
ALTER TABLE `gse_sportscategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_subscribe`
--
ALTER TABLE `gse_subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_talent`
--
ALTER TABLE `gse_talent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_talenttype`
--
ALTER TABLE `gse_talenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_talenttypegallery`
--
ALTER TABLE `gse_talenttypegallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_talenttypevideo`
--
ALTER TABLE `gse_talenttypevideo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_testimonial`
--
ALTER TABLE `gse_testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_wedding`
--
ALTER TABLE `gse_wedding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_weddinggallery`
--
ALTER TABLE `gse_weddinggallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_weddingsubtype`
--
ALTER TABLE `gse_weddingsubtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gse_weddingtype`
--
ALTER TABLE `gse_weddingtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logintype`
--
ALTER TABLE `logintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `talentvideo`
--
ALTER TABLE `talentvideo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesslevel`
--
ALTER TABLE `accesslevel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gse_award`
--
ALTER TABLE `gse_award`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_awarddetail`
--
ALTER TABLE `gse_awarddetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_blogimage`
--
ALTER TABLE `gse_blogimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gse_blogtext`
--
ALTER TABLE `gse_blogtext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gse_blogvideo`
--
ALTER TABLE `gse_blogvideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gse_careerform`
--
ALTER TABLE `gse_careerform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gse_careerposition`
--
ALTER TABLE `gse_careerposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_category`
--
ALTER TABLE `gse_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_clientdetail`
--
ALTER TABLE `gse_clientdetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_clientlogo`
--
ALTER TABLE `gse_clientlogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_diaryarticle`
--
ALTER TABLE `gse_diaryarticle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_diarycategory`
--
ALTER TABLE `gse_diarycategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_diarysubcategory`
--
ALTER TABLE `gse_diarysubcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_generalenquiry`
--
ALTER TABLE `gse_generalenquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_getintouch`
--
ALTER TABLE `gse_getintouch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_highlight`
--
ALTER TABLE `gse_highlight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_movie`
--
ALTER TABLE `gse_movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_moviedetail`
--
ALTER TABLE `gse_moviedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_moviegallery`
--
ALTER TABLE `gse_moviegallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_moviewallpaper`
--
ALTER TABLE `gse_moviewallpaper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_player`
--
ALTER TABLE `gse_player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_previousgamegallery`
--
ALTER TABLE `gse_previousgamegallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_previousgamevideo`
--
ALTER TABLE `gse_previousgamevideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_proposedproject`
--
ALTER TABLE `gse_proposedproject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_service`
--
ALTER TABLE `gse_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_sportscategory`
--
ALTER TABLE `gse_sportscategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_subscribe`
--
ALTER TABLE `gse_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_talent`
--
ALTER TABLE `gse_talent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_talenttype`
--
ALTER TABLE `gse_talenttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `gse_talenttypegallery`
--
ALTER TABLE `gse_talenttypegallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gse_talenttypevideo`
--
ALTER TABLE `gse_talenttypevideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `gse_testimonial`
--
ALTER TABLE `gse_testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gse_wedding`
--
ALTER TABLE `gse_wedding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `gse_weddinggallery`
--
ALTER TABLE `gse_weddinggallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gse_weddingsubtype`
--
ALTER TABLE `gse_weddingsubtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gse_weddingtype`
--
ALTER TABLE `gse_weddingtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `logintype`
--
ALTER TABLE `logintype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `talentvideo`
--
ALTER TABLE `talentvideo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
