-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2013 at 11:40 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccv4_admin_sf`
--

-- --------------------------------------------------------

--
-- Table structure for table `const`
--

CREATE TABLE `const` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'title',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Dumping data for table `const`
--

INSERT INTO `const` (`id`, `key`, `title`, `created`, `updated`, `status`) VALUES
(1, 'OPENALL', 'Open all', '0000-00-00 00:00:00', '2013-05-17 11:29:44', 'trash'),
(2, 'NAVCC_SEARCH_NODATA', 'Try searching something, I''m ready.', '0000-00-00 00:00:00', '2013-03-27 15:08:29', 'live'),
(3, 'NAVCC_SEARCH_PLACEHOLDER', 'Search for items, people, anything.', '0000-00-00 00:00:00', '2013-08-14 01:10:33', 'live'),
(4, 'OPTION_FILTER_REFINE', 'Refine', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(6, 'MULTIPLESELECT_AVAILABLE_LABEL', 'Available', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(7, 'MULTIPLESELECT_SELECTED_LABEL', 'Selected', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(8, 'MULTIPLESELECT_SELECTED_NODATA', 'Why don''t you try and drag something here?', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(9, 'ADMIN_ZONING_ZONE_NODATA', 'Dammit, no zone. That''s impossimpible!', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(10, 'ZONING_SELECTED_NODATA', 'This zone has no section', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(11, 'ZONING_SELECTED_BUBBLE', 'Mine! Mine!', '0000-00-00 00:00:00', '2013-03-22 14:49:01', 'live'),
(12, 'ZONING_AVAILABLE_LABEL', 'Apps', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(13, 'ZONING_LEGEND', 'This zoning shows the zones and sections. Change your code, this preview will follow.', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(14, 'ZONING_AVAILABLE_SEARCH_PLACEHOLDER', 'Search', '2013-01-23 11:13:49', '2013-01-23 11:13:49', 'live'),
(15, 'OPTION_DATE_YESTERDAY_NIGHT', 'Yesterday night', '2013-03-18 11:33:04', '2013-03-18 11:33:04', 'live'),
(16, 'DATE_YEAR', 'year', '2013-03-22 12:41:48', '2013-03-22 17:47:09', 'live'),
(17, 'DATE_MONTH', 'month', '2013-03-22 12:42:00', '2013-03-22 12:42:00', 'live'),
(18, 'DATE_WEEK', 'week', '2013-03-22 12:42:09', '2013-03-22 12:42:09', 'live'),
(19, 'DATE_DAY', 'day', '2013-03-22 12:42:19', '2013-03-22 12:42:19', 'live'),
(20, 'DATE_HOUR', 'hour', '2013-03-22 12:42:26', '2013-03-22 12:42:26', 'live'),
(21, 'DATE_MINUTE', 'minute', '2013-03-22 12:42:37', '2013-03-22 12:42:37', 'live'),
(22, 'DATE_SECOND', 'second', '2013-03-22 12:42:43', '2013-03-22 12:42:43', 'live'),
(23, 'TIMELINE_EVENT_UPDATE', 'updated', '2013-03-22 14:37:46', '2013-03-24 23:53:56', 'live'),
(24, 'TIMELINE_EVENT_INSERT', 'added', '2013-03-22 14:37:54', '2013-03-22 15:04:09', 'live'),
(25, 'TIMELINE_PERIOD_NIGHT', 'Instead of sleeping', '2013-03-22 15:11:45', '2013-03-22 15:11:45', 'live'),
(26, 'TIMELINE_PERIOD_DUSK', 'After diner', '2013-03-22 15:12:02', '2013-03-22 15:12:02', 'live'),
(27, 'TIMELINE_PERIOD_EVENING', 'This evening', '2013-03-22 15:12:36', '2013-03-22 15:16:15', 'live'),
(28, 'TIMELINE_PERIOD_AFTERNOON', 'This afternoon', '2013-03-22 15:13:13', '2013-03-22 15:13:13', 'live'),
(29, 'TIMELINE_PERIOD_NOON', 'At lunchtime', '2013-03-22 15:13:50', '2013-03-22 15:13:50', 'live'),
(30, 'TIMELINE_PERIOD_MORNING', 'This morning', '2013-03-22 15:14:25', '2013-03-22 15:14:25', 'live'),
(31, 'TIMELINE_PERIOD_DAWN', 'At dawn', '2013-03-22 15:14:48', '2013-03-22 15:14:48', 'live'),
(32, 'DATE_NOW', 'Just now', '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live'),
(39, 'FIELD_VALIDATION_ERROR_REQUIRED', 'This field is compulsory', '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live'),
(54, 'TIMELINE_PERIOD_YESTERDAY_DAWN', 'Yesterday very early', '2013-03-23 19:53:53', '2013-03-23 19:53:53', 'live'),
(55, 'TIMELINE_PERIOD_YESTERDAY_MORNING', 'Yesterday morning', '2013-03-23 19:54:03', '2013-03-23 19:54:03', 'live'),
(56, 'TIMELINE_PERIOD_YESTERDAY_NOON', 'Yesterday at noon', '2013-03-23 19:54:28', '2013-03-23 19:54:28', 'live'),
(57, 'TIMELINE_PERIOD_YESTERDAY_AFTERNOON', 'Yesterday afternoon', '2013-03-23 19:54:39', '2013-03-23 19:54:39', 'live'),
(58, 'TIMELINE_PERIOD_YESTERDAY_EVENING', 'Yesterday evening', '2013-03-23 19:54:46', '2013-03-23 19:54:46', 'live'),
(59, 'TIMELINE_PERIOD_YESTERDAY_DUSK', 'Yesterday quite late', '2013-03-23 19:55:04', '2013-03-23 19:55:04', 'live'),
(60, 'TIMELINE_PERIOD_YESTERDAY_NIGHT', 'Yesterday night', '2013-03-23 19:55:14', '2013-03-23 19:55:14', 'live'),
(61, 'TIMELINE_EVENT_DELETE', 'deleted', '2013-04-05 16:02:39', '2013-04-05 16:02:39', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `text` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The text content',
  `http_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The http status',
  `template` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The template',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The url',
  `system` tinyint(1) NOT NULL COMMENT 'System',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  `version` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`version`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `descr`, `text`, `http_status`, `template`, `url`, `system`, `created`, `updated`, `status`, `version`) VALUES
(1, 'home', 'grabou', '', '', '200 OK', '{"type":"html","key":"default"}', '/', 0, '2013-03-25 17:08:31', '2013-08-26 18:00:32', 'live', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The zone',
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The css classes',
  `template` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The template',
  `data` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The HTML5 custom data',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `key`, `title`, `descr`, `zone`, `class`, `template`, `data`, `created`, `updated`, `status`) VALUES
(2, 'form', 'Form', 'General form', 'content', '', '{"app":"section","theme":"edit","template":"edit"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '2013-04-02 14:02:45', 'live'),
(3, 'php', 'PHP classes, methods & functions', 'lorem Lorem ipsum', 'content', '', '{"app":"section","theme":"doc","template":"code"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '2013-08-30 01:16:18', 'live'),
(4, 'doc', 'The doc', 'Lorem ipsum', 'content', '', '{"app":"section","theme":"doc","template":"doc"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(5, 'splash', 'Ressource not found', 'Lorem ipsum', 'content', '', '{"app":"section","theme":"404","template":"error"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(9, 'live', 'Live', 'Everything here is up and running, published on your website.', 'content', '', '{"app":"section","theme":"listing","template":"infinite"}', '{"display":"in2col","status":"live"}', '0000-00-00 00:00:00', '2013-02-07 11:42:53', 'live'),
(11, 'asleep', 'Asleep', 'Items here are not accessible to the Internet, they''re idle, asleep. You can wake them up at anytime though.', 'content', '', '{"app":"section","theme":"listing","template":"infinite"}', '{"display":"in2col","status":"asleep"}', '0000-00-00 00:00:00', '2013-02-07 11:42:27', 'live'),
(12, 'treemap', 'The site tree', '', 'content', '', '{"app":"section","theme":"sitetree","template":"sitetree"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '2013-08-23 02:19:47', 'live'),
(17, 'zoning', 'Zoning', 'Zoning', 'content', '', '{"app":"section","theme":"zoning","template":"zoning"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(19, 'appstore', 'App store', '', 'content', '', '{"app":"section","theme":"appmanager","template":"appmanager"}', '', '0000-00-00 00:00:00', '2013-03-22 08:58:52', 'live'),
(20, 'appini', 'About this app', '', 'content', '', '{"app":"section","theme":"appini","template":"appini"}', '{"display":"in2col"}', '0000-00-00 00:00:00', '2013-02-07 10:47:37', 'live'),
(21, 'appconfig', 'Config', '', 'content', '', '{"app":"section","theme":"appconfig","template":"appconfig"}', '{"display":"inlandscape"}', '0000-00-00 00:00:00', '2013-02-01 02:05:55', 'live'),
(23, 'draft', 'My drafts', 'Everything here is personal: doodles, first attempts, unfinished documents. Noone else than you can see that.', 'content', '', '{"app":"section","theme":"listing","template":"infinite"}', '{"display":"in2col","status":"draft"}', '2013-02-07 06:08:49', '2013-06-24 14:09:22', 'live'),
(25, 'carousel_test', 'Carousel de test', '', 'content', '', '{"app":"jquery_carousel","theme":"default","template":"jquery_carousel","param":{"direction":"horizontal","autoSlideInterval":"3000","dispItems":"1","paginationPosition":"inside","nextBtn":"<span>next<\\/span>","prevBtn":"<span>previous<\\/span>","btnsPosition":"inside","nextBtnInsert":"appendTo","prevBtnInsert":"prependTo","delayAutoSlide":"0","effect":"slide","slideEasing":"swing","animSpeed":"normal"}}', '', '2013-02-08 10:22:45', '2013-02-08 10:22:45', 'live'),
(26, 'timeline', 'Timeline', 'Keep in touch with everything.', 'content', '', '{"app":"section","theme":"timeline","template":"timeline"}', '{"display":"in2col"}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live'),
(27, 'notes', 'Discussion', '', 'content', '', '{"app":"section","theme":"notes","template":"notes"}', '{"display":"in2col"}', '2013-03-11 01:20:51', '2013-04-02 13:10:52', 'live'),
(28, 'login', 'Login Form', '', 'content', '', '{"app":"form","theme":"login","template":"login"}', '', '2013-04-07 15:55:22', '2013-04-07 15:55:22', 'live'),
(34, '1b2cb4a6c9d2013efaba6ab7085a41a7', '', '', '', '', '', '{"app":"section","theme":"edit","template":"edit"}', '2013-08-30 20:52:50', '2013-08-30 20:52:50', '');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  `defaultversion` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`) VALUES
(1, 'admin', 'Grandcentral Administration', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1);

-- --------------------------------------------------------

--
-- Table structure for table `structure`
--

CREATE TABLE `structure` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `system` tinyint(1) NOT NULL COMMENT 'Is system',
  `attr` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Attributes',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `structure`
--

INSERT INTO `structure` (`id`, `key`, `title`, `descr`, `system`, `attr`, `created`, `updated`, `status`) VALUES
(1, 'structure', 'Structures', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"system":{"key":"system","title":"Is system","type":"bool"},"attr":{"key":"attr","title":"Attributes","type":"array"},"fitsinsitetree":{"key":"fitsinsitetree","title":"Can fit in the Site Tree","type":"bool"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status"}}', '0000-00-00 00:00:00', '2013-04-05 12:39:48', 'live'),
(2, 'site', 'Your websites', 'Manage your website basics, and the apps that will be opened at all time.', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"defaultversion":{"key":"defaultversion","type":"int","title":"Default Version"}}', '0000-00-00 00:00:00', '2013-04-05 12:41:29', 'live'),
(3, 'page', 'Page', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"text":{"key":"text","type":"string","title":"The text content","min":"0","max":"65035"},"http_status":{"key":"http_status","type":"string","title":"The http status","min":"0","max":"255"},"template":{"key":"template","type":"array","title":"The template"},"url":{"key":"url","type":"string","title":"The url","min":"0","max":"255","required":"1"},"system":{"key":"system","type":"bool","title":"System"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"version":{"key":"version","type":"version"},"child":{"key":"child","param":[{"item":"structure_3"}],"min":"","max":"","type":"rel"},"section":{"key":"section","param":{"1":{"item":"structure_5"}},"min":"","max":"","type":"rel"}}', '0000-00-00 00:00:00', '2013-08-20 18:57:03', 'live'),
(4, 'version', 'Versions', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"lang":{"key":"lang","title":"Language","type":"string","min":"0","max":"32","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '0000-00-00 00:00:00', '2013-04-05 12:43:36', 'live'),
(5, 'const', 'Text constants', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Cast title","min":"","max":"","required":"1"},"descr":{"key":"descr","type":"string","title":"Description","min":"","max":""},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `lang` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`) VALUES
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-04-05 17:02:34', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `_rel`
--

CREATE TABLE `_rel` (
  `item` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  `itemid` int(10) unsigned NOT NULL,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `rel` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  `relid` int(10) unsigned NOT NULL,
  `position` int(4) unsigned NOT NULL DEFAULT '0',
  KEY `position` (`position`),
  KEY `object` (`item`),
  KEY `rel` (`rel`),
  KEY `relid` (`relid`),
  KEY `objectid` (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Relations of page';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
