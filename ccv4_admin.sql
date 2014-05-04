-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2014 at 09:34 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccv4_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `const`
--

CREATE TABLE `const` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `version` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`version`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=93 ;

--
-- Dumping data for table `const`
--

INSERT INTO `const` (`id`, `key`, `title`, `version`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'OPENALL', 'Open all', 1, '0000-00-00 00:00:00', '2013-05-17 11:29:44', 'trash', 0),
(2, 'NAVCC_SEARCH_NODATA', 'Try searching something, I''m ready.', 1, '0000-00-00 00:00:00', '2013-03-27 15:08:29', 'live', 0),
(3, 'NAVCC_SEARCH_PLACEHOLDER', 'Search for items, people, anything.', 1, '0000-00-00 00:00:00', '2013-08-14 01:10:33', 'live', 0),
(4, 'OPTION_FILTER_REFINE', 'Refine', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(6, 'MULTIPLESELECT_AVAILABLE_LABEL', 'Available', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(7, 'MULTIPLESELECT_SELECTED_LABEL', 'Selected', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(8, 'MULTIPLESELECT_SELECTED_NODATA', 'Why don''t you try and drag something here?', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(9, 'ADMIN_ZONING_ZONE_NODATA', 'Dammit, no zone. That''s impossimpible!', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(10, 'ZONING_SELECTED_NODATA', 'This zone has no section', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(11, 'ZONING_SELECTED_BUBBLE', 'Mine! Mine!', 1, '0000-00-00 00:00:00', '2013-03-22 14:49:01', 'live', 0),
(12, 'ZONING_AVAILABLE_LABEL', 'Apps', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(13, 'ZONING_LEGEND', 'This zoning shows the zones and sections. Change your code, this preview will follow.', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(14, 'ZONING_AVAILABLE_SEARCH_PLACEHOLDER', 'Search', 1, '2013-01-23 11:13:49', '2013-01-23 11:13:49', 'live', 0),
(15, 'OPTION_DATE_YESTERDAY_NIGHT', 'Yesterday night', 1, '2013-03-18 11:33:04', '2013-03-18 11:33:04', 'live', 0),
(16, 'DATE_YEAR', 'year', 1, '2013-03-22 12:41:48', '2013-03-22 17:47:09', 'live', 0),
(17, 'DATE_MONTH', 'month', 1, '2013-03-22 12:42:00', '2013-03-22 12:42:00', 'live', 0),
(18, 'DATE_WEEK', 'week', 1, '2013-03-22 12:42:09', '2013-03-22 12:42:09', 'live', 0),
(19, 'DATE_DAY', 'day', 1, '2013-03-22 12:42:19', '2013-03-22 12:42:19', 'live', 0),
(20, 'DATE_HOUR', 'hour', 1, '2013-03-22 12:42:26', '2013-03-22 12:42:26', 'live', 0),
(21, 'DATE_MINUTE', 'minute', 1, '2013-03-22 12:42:37', '2013-03-22 12:42:37', 'live', 0),
(22, 'DATE_SECOND', 'second', 1, '2013-03-22 12:42:43', '2013-03-22 12:42:43', 'live', 0),
(23, 'TIMELINE_EVENT_UPDATE', 'updated', 1, '2013-03-22 14:37:46', '2013-03-24 23:53:56', 'live', 0),
(24, 'TIMELINE_EVENT_INSERT', 'added', 1, '2013-03-22 14:37:54', '2013-03-22 15:04:09', 'live', 0),
(25, 'TIMELINE_PERIOD_NIGHT', 'Instead of sleeping', 1, '2013-03-22 15:11:45', '2013-03-22 15:11:45', 'live', 0),
(26, 'TIMELINE_PERIOD_DUSK', 'After diner', 1, '2013-03-22 15:12:02', '2013-03-22 15:12:02', 'live', 0),
(27, 'TIMELINE_PERIOD_EVENING', 'This evening', 1, '2013-03-22 15:12:36', '2013-03-22 15:16:15', 'live', 0),
(28, 'TIMELINE_PERIOD_AFTERNOON', 'This afternoon', 1, '2013-03-22 15:13:13', '2013-03-22 15:13:13', 'live', 0),
(29, 'TIMELINE_PERIOD_NOON', 'At lunchtime', 1, '2013-03-22 15:13:50', '2013-03-22 15:13:50', 'live', 0),
(30, 'TIMELINE_PERIOD_MORNING', 'This morning', 1, '2013-03-22 15:14:25', '2013-03-22 15:14:25', 'live', 0),
(31, 'TIMELINE_PERIOD_DAWN', 'At dawn', 1, '2013-03-22 15:14:48', '2013-03-22 15:14:48', 'live', 0),
(32, 'DATE_NOW', 'Just now', 1, '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live', 0),
(39, 'FIELD_VALIDATION_ERROR_REQUIRED', 'This field is compulsory', 1, '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live', 0),
(54, 'TIMELINE_PERIOD_YESTERDAY_DAWN', 'Yesterday very early', 1, '2013-03-23 19:53:53', '2013-03-23 19:53:53', 'live', 0),
(55, 'TIMELINE_PERIOD_YESTERDAY_MORNING', 'Yesterday morning', 1, '2013-03-23 19:54:03', '2013-03-23 19:54:03', 'live', 0),
(56, 'TIMELINE_PERIOD_YESTERDAY_NOON', 'Yesterday at noon', 1, '2013-03-23 19:54:28', '2013-03-23 19:54:28', 'live', 0),
(57, 'TIMELINE_PERIOD_YESTERDAY_AFTERNOON', 'Yesterday afternoon', 1, '2013-03-23 19:54:39', '2013-03-23 19:54:39', 'live', 0),
(58, 'TIMELINE_PERIOD_YESTERDAY_EVENING', 'Yesterday evening', 1, '2013-03-23 19:54:46', '2013-03-23 19:54:46', 'live', 0),
(59, 'TIMELINE_PERIOD_YESTERDAY_DUSK', 'Yesterday quite late', 1, '2013-03-23 19:55:04', '2013-03-23 19:55:04', 'live', 0),
(60, 'TIMELINE_PERIOD_YESTERDAY_NIGHT', 'Yesterday night', 1, '2013-03-23 19:55:14', '2013-03-23 19:55:14', 'live', 0),
(61, 'TIMELINE_EVENT_DELETE', 'deleted', 1, '2013-04-05 16:02:39', '2013-04-05 16:02:39', 'live', 0),
(62, 'TABS_PAGE_SYSTEM_TITLE', 'System pages & APIs', 1, '2013-10-13 14:24:37', '2013-10-13 14:24:37', 'live', 0),
(63, 'TABS_PAGE_TREE_TITLE', 'The site tree', 1, '2013-10-13 14:31:21', '2013-10-13 14:31:21', 'live', 0),
(64, 'ITEM_PAGE_TITLE', 'The Site Tree', 1, '2013-10-14 01:28:04', '2013-10-14 01:29:34', 'live', 0),
(65, 'NAV_SUB_H1_STRUCTURE', 'A little bit of structure', 1, '2013-10-14 10:38:30', '2013-10-14 10:38:30', 'live', 0),
(66, 'NAV_SUB_H1_SUPPORT', 'Support & Documentation', 1, '2013-10-14 10:39:21', '2013-10-14 10:39:21', 'live', 0),
(67, 'NAV_SUB_H1_SYSTEM', 'Part of the system', 1, '2013-10-14 10:40:20', '2013-10-14 10:40:20', 'live', 0),
(68, 'APPINI_H2_ABOUT', 'About this App', 1, '2013-10-19 14:33:38', '2013-10-19 14:33:38', 'live', 0),
(69, 'APPINI_H2_DEPENDENCIES', 'Dependencies', 1, '2013-10-19 14:35:59', '2013-10-19 14:35:59', 'live', 0),
(70, 'APPINI_H2_REQUIREMENTS', 'Requirements', 1, '2013-10-19 14:36:24', '2013-10-19 14:36:24', 'live', 0),
(71, 'APPINI_H2_SYSTEM', 'System files', 1, '2013-10-19 14:36:44', '2013-10-19 14:36:44', 'live', 0),
(72, 'APPINI_H3_TITLE', 'Name', 1, '2013-10-19 14:37:13', '2013-10-19 14:37:13', 'live', 0),
(73, 'APPINI_H3_DESCRIPTION', 'Description', 1, '2013-10-19 14:37:32', '2013-10-19 14:37:32', 'live', 0),
(74, 'APPINI_H3_V', 'Version', 1, '2013-10-19 14:37:51', '2013-10-19 14:37:51', 'live', 0),
(75, 'APPINI_H3_V_DESCR', 'About this version', 1, '2013-10-19 14:38:19', '2013-10-19 14:43:48', 'live', 0),
(76, 'APPINI_H3_AUTHOR', 'Author(s)', 1, '2013-10-19 14:47:26', '2013-10-19 14:53:32', 'live', 0),
(77, 'APPINI_H3_COMPANY', 'Company', 1, '2013-10-19 14:55:23', '2013-10-19 14:55:23', 'live', 0),
(78, 'APPINI_H3_COMPANY_DESCR', 'About this company', 1, '2013-10-19 14:55:57', '2013-10-19 14:55:57', 'live', 0),
(79, 'APPINI_H3_URL', 'URL', 1, '2013-10-19 14:56:19', '2013-10-19 14:56:19', 'live', 0),
(80, 'APPINI_H3_GC', 'Grand Central', 1, '2013-10-19 14:57:23', '2013-10-19 14:57:23', 'live', 0),
(81, 'APPINI_H3_PHP', 'PHP', 1, '2013-10-19 14:57:34', '2013-10-19 14:57:34', 'live', 0),
(82, 'APPINI_H3_MYSQL', 'MySQL', 1, '2013-10-19 14:57:45', '2013-10-19 14:57:45', 'live', 0),
(83, 'APPINI_H3_CREDIT', 'Credits', 1, '2013-10-19 15:14:10', '2013-10-19 15:14:10', 'live', 0),
(84, 'APPINI_H3_LICENCE', 'Licence', 1, '2013-10-19 14:56:19', '2013-10-19 14:56:19', 'live', 0),
(85, 'OPTIONS_FILTERS_LEGEND_ORDER', 'Reorder by', 1, '2013-10-19 16:12:17', '2013-10-19 16:12:17', 'live', 0),
(86, 'OPTIONS_FILTERS_LEGEND_DISPLAY', 'Display', 1, '2013-10-19 17:10:19', '2013-10-19 17:10:19', 'live', 0),
(87, 'OPTIONS_FILTER_SORT_ASC_TITLE', 'From the last one to the first one', 1, '2013-10-19 17:11:31', '2013-10-19 17:11:31', 'live', 0),
(88, 'OPTIONS_FILTER_SORT_DESC_TITLE', 'From the first one to the last one', 1, '2013-10-19 17:12:22', '2013-10-19 17:12:22', 'live', 0),
(89, 'OPTIONS_FILTERS_LEGEND_SORT', 'Sort', 1, '2013-10-19 17:10:19', '2013-10-19 17:10:19', 'live', 0),
(90, 'OPTIONS_FILTER_DISPLAY_INSTACK_TITLE', 'In stacks', 1, '2013-10-19 17:13:55', '2013-10-19 17:13:55', 'live', 0),
(91, 'OPTIONS_FILTER_DISPLAY_INMASONRY_TITLE', 'In masonry', 1, '2013-10-19 17:14:59', '2013-10-19 17:14:59', 'live', 0),
(92, 'APPINI_H3_JQUERY', 'jQuery', 1, '2013-10-25 12:59:07', '2013-10-25 12:59:07', 'live', 0);

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `target` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `enctype` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `system` tinyint(1) NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `system` (`system`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=150 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `system`, `status`, `owner`) VALUES
(1, 'login', 'Login', '', 'login', 'login', 'post', '', '', '{"login":{"type":"text","key":"login","label":"So. My login is","placeholder":"my email address","required":true},"password":{"type":"password","key":"password","label":"and this is","placeholder":"my password","required":true},"save":{"type":"button","buttontype":"submit","key":"save","value":"Now let me in!"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, '', 0),
(66, 'mm_parution', 'mm_parution', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"descr":{"key":"descr","label":"Description","type":"text","required":"0","min":"","max":""},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Text","type":"text","required":"0","min":"","max":""}}', '2013-10-23 16:39:32', '2013-10-23 19:26:41', 0, 'live', 0),
(67, 'mm_seminaire', 'mm_seminaire', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"date":{"key":"date","label":"Date","type":"text","required":"0"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"descr":{"key":"descr","label":"Courte description","type":"text","required":"0","min":"","max":""},"text":{"key":"text","label":"Long texte","type":"text","required":"0","min":"","max":""},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""}}', '2013-10-23 16:40:53', '2013-10-28 08:21:29', 0, 'live', 0),
(68, 'mm_structure', 'mm_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool"}}', '2013-10-23 16:43:34', '2013-10-23 16:43:34', 0, 'live', 0),
(69, 'mm_page', 'mm_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-10-23 18:24:47', '2013-11-08 12:24:39', 0, 'live', 0),
(70, 'mm_article', 'mm_article', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-10-23 21:24:01', '2013-11-08 18:19:37', 0, 'live', 0),
(72, 'mm_group', 'mm_group', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"admin":{"key":"admin","label":"admin","type":"bool"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-25 00:21:48', '2013-10-25 00:21:48', 0, 'live', 0),
(73, 'mm_version', 'mm_version', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"lang":{"key":"lang","label":"Language","type":"text","required":"1","min":"0","max":"32"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-25 00:25:10', '2013-10-25 00:25:10', 0, 'live', 0),
(74, 'admin_const', 'admin_const', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"version":{"key":"version","label":"Version","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-25 12:58:52', '2014-05-02 16:27:57', 1, 'live', 2),
(75, 'mm_human', 'mm_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea"},"password":{"key":"password","label":"Password","type":"password"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","min":"","max":""}}', '2013-10-28 08:15:44', '2013-10-28 08:15:44', 0, 'live', 0),
(76, 'admin_structure', 'admin_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-28 10:39:22', '2014-04-08 17:09:30', 1, 'live', 0),
(77, 'admin_greenbutton', 'admin_greenbutton', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"icon":{"key":"icon","label":"Icon","type":"text","required":"0","min":"","max":""}}', '2013-10-28 10:39:38', '2013-10-28 10:39:38', 1, 'live', 0),
(78, 'admin_section', 'admin_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"greenbutton":{"key":"greenbutton","label":"greenbutton","valuestype":"bunch","values":[{"item":"greenbutton"}],"type":"multipleselect","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-28 10:40:03', '2014-04-08 03:56:41', 1, 'live', 0),
(79, 'mm_section', 'mm_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-28 12:17:45', '2013-10-28 12:17:45', 0, 'live', 0),
(80, 'admin_page', 'admin_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"text":{"key":"text","label":"The text content","type":"textarea","min":"0","max":"65035"},"url":{"key":"url","label":"The url","type":"text","required":"1","min":"0","max":"255"},"system":{"key":"system","label":"System","type":"bool"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","min":"","max":""},"section":{"key":"section","label":"section","valuestype":"bunch","values":{"1":{"item":"section"}},"type":"multipleselect","min":"","max":""},"sectiondefault":{"key":"sectiondefault","label":"sectiondefault","valuestype":"bunch","values":{"1":{"item":"section"}},"type":"multipleselect","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-28 12:20:02', '2014-04-08 03:56:11', 1, 'live', 0),
(81, 'admin_human', 'admin_human', '', 'default', 'post', 'post', '', '', '', '2013-10-28 21:08:52', '2013-10-28 21:08:52', 1, 'live', 0),
(82, 'admin_version', 'admin_version', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"lang":{"key":"lang","label":"Language","type":"text","required":"1","min":"0","max":"32"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-28 21:09:04', '2013-10-28 21:09:04', 1, 'live', 0),
(83, 'mm_note', 'mm_note', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"descr":{"key":"descr","label":"Desciption","type":"textarea","required":"1","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"item":{"key":"item","label":"Item","type":"text","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-28 21:45:55', '2014-04-10 14:54:01', 0, 'live', 0),
(85, 'mm_livre', 'mm_livre', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-10-30 13:38:35', '2013-10-30 14:59:55', 0, 'live', 0),
(86, 'souvenoir_structure', 'souvenoir_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-30 15:40:20', '2013-11-02 13:56:40', 0, 'live', 0),
(87, 'souvenoir_section', 'souvenoir_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","required":"0","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-30 15:44:50', '2013-11-04 15:55:30', 0, 'live', 0),
(88, 'souvenoir_site', 'souvenoir_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"300"},"owner":{"key":"owner","label":"Owner","type":"text"},"favicon":{"key":"favicon","label":"Favicon","type":"media","required":"0","min":"","max":""}}', '2013-10-30 16:04:14', '2014-01-03 02:56:27', 0, 'live', 0),
(89, 'souvenoir_people', 'souvenoir_people', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"url":{"key":"url","label":"Url","type":"text"}}', '2013-10-30 16:43:50', '2013-11-02 16:41:46', 0, 'live', 0),
(90, 'souvenoir_photo', 'souvenoir_photo', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"photo":{"key":"photo","label":"Photos","type":"media","required":"0","min":"","max":""},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"},"text":{"key":"text","label":"Text","type":"sirtrevor","required":"0"},"ref":{"key":"ref","label":"Ref","type":"text","required":"0","min":"0","max":"16"},"key":{"key":"key","label":"The key","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"people":{"key":"people","label":"People","valuestype":"bunch","values":[{"item":"people"}],"type":"multipleselect","required":"0"},"timestamp":{"key":"timestamp","label":"Timestamp","type":"text","required":"0"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"location":{"key":"location","label":"Location","valuestype":"bunch","values":[{"item":"place"}],"type":"multipleselect","required":"0"},"format":{"key":"format","label":"Formats for sell","valuestype":"bunch","values":[{"item":"format"}],"type":"multipleselect","required":"0"},"story":{"key":"story","label":"Story","type":"media","required":"0","min":"","max":""},"displaystory":{"key":"displaystory","label":"Display story","type":"text","required":"0"},"access":{"key":"access","label":"Access","type":"text","required":"0"}}', '2013-10-30 18:37:53', '2014-01-03 22:42:56', 0, 'live', 0),
(91, 'souvenoir_page', 'souvenoir_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-30 23:41:50', '2013-11-01 01:29:09', 0, 'live', 0),
(92, 'miranda_structure', 'miranda_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"},"icon":{"key":"icon","label":"icon","type":"text","required":"0","min":"0","max":"16"}}', '2013-10-31 12:54:30', '2014-04-09 01:28:23', 0, 'live', 0),
(93, 'souvenoir_format', 'souvenoir_format', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"price":{"key":"price","label":"Price","type":"text","required":"0"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"}}', '2013-11-02 18:48:15', '2013-11-02 18:50:01', 0, 'live', 0),
(94, 'souvenoir_place', 'souvenoir_place', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Name","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"}}', '2013-11-05 00:56:09', '2013-11-05 00:56:09', 0, 'live', 0),
(95, 'miranda_cast', 'miranda_cast', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Cast title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"100000"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"lat":{"key":"lat","label":"Latitude","type":"textarea","required":"1","min":"0","max":"5000"},"lng":{"key":"lng","label":"Longitude","type":"textarea","required":"1","min":"0","max":"5000"},"address":{"key":"address","label":"Address","type":"textarea","required":"0","min":"0","max":"5000"},"report":{"key":"report","label":"Report","type":"textarea","required":"0","min":"0","max":"100000"},"locastid":{"key":"locastid","label":"ID in Locast (for sync)","type":"number","required":"0","min":"","max":""},"significativity":{"key":"significativity","label":"Significativity","type":"array"},"media":{"key":"media","label":"Media","type":"media","required":"0","min":"","max":""},"version":{"key":"version","label":"Version","type":"text"},"map":{"key":"map","label":"map","valuestype":"bunch","values":[{"item":"map"}],"type":"multipleselect","required":"0"},"casttype":{"key":"casttype","label":"casttype","valuestype":"bunch","values":[{"item":"casttype"}],"type":"multipleselect","required":"0"},"typology":{"key":"typology","label":"typology","valuestype":"bunch","values":[{"item":"typology"}],"type":"multipleselect","required":"0"},"author":{"key":"author","label":"author","valuestype":"bunch","values":[{"item":"human"}],"type":"multipleselect","required":"0"},"url":{"key":"url","label":"url","type":"text"},"workflowstatus":{"key":"workflowstatus","label":"workflowstatus","valuestype":"bunch","values":[{"item":"workflowstatus"}],"type":"multipleselect","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"},"weather":{"key":"weather","label":"Weather","type":"array"}}', '2013-11-06 13:25:23', '2014-04-13 20:50:05', 0, 'live', 0),
(96, 'souvenoir_human', 'souvenoir_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"5000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"pref":{"key":"pref","label":"Preferences","type":"array"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-11-07 00:22:53', '2014-05-02 01:24:24', 0, 'live', 2),
(97, 'miranda_const', 'miranda_const', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"version":{"key":"version","label":"version","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-11-13 18:51:21', '2014-01-02 01:13:21', 0, 'live', 0),
(98, 'miranda_page', 'miranda_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"text":{"key":"text","label":"The text content","type":"textarea","required":"0","min":"0","max":"65035"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-11-13 19:15:40', '2014-04-09 11:08:31', 0, 'live', 0),
(99, 'miranda_api', 'miranda_api', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"1000"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"method":{"key":"method","label":"Method","type":"text","required":"1"}}', '2013-11-14 14:47:37', '2013-11-30 12:56:05', 0, 'live', 0),
(100, 'miranda_section', 'miranda_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"Version","type":"text"}}', '2013-11-14 14:50:36', '2013-11-14 14:50:36', 0, 'live', 0),
(101, 'miranda_human', 'miranda_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"5000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"},"company":{"key":"company","label":"Company","valuestype":"bunch","values":[{"item":"company"}],"type":"multipleselect","required":"0","min":"","max":""},"firstname":{"key":"firstname","label":"First name","type":"text","required":"0","min":"0","max":"100"},"lastname":{"key":"lastname","label":"Last name","type":"text","required":"0","min":"0","max":"100"}}', '2013-11-15 15:25:07', '2014-05-01 13:45:37', 0, 'live', 2),
(102, 'miranda_company', 'miranda_company', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"map":{"key":"map","label":"Maps","valuestype":"bunch","values":[{"item":"map"}],"type":"multipleselect","required":"0"}}', '2013-11-15 15:35:53', '2014-04-29 11:02:40', 0, 'live', 0),
(103, 'miranda_map', 'miranda_map', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Cast title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"typologyname":{"key":"typologyname","label":"Typology name","type":"text","required":"0","min":"0","max":"255"},"form":{"key":"form","label":"Upload cast form","valuestype":"bunch","values":[{"item":"form"}],"type":"multipleselect","required":"0"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""}}', '2013-11-15 15:37:31', '2014-01-06 12:20:36', 0, 'live', 0),
(104, 'souvenoir_const', 'souvenoir_const', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"version":{"key":"version","label":"version","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-11-18 01:53:29', '2013-11-18 01:53:29', 0, 'live', 0),
(105, 'cei_page', 'cei_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""}}', '2013-11-24 21:21:18', '2014-02-22 00:27:21', 0, 'live', 0),
(106, 'cei_structure', 'cei_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-11-24 21:48:03', '2013-11-24 21:48:03', 0, 'live', 0),
(107, 'modelec_structure', 'modelec_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-11-25 10:50:48', '2013-11-25 10:50:48', 0, 'live', 0),
(108, 'miranda_machine', 'miranda_machine', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"1000"}}', '2013-11-29 13:21:58', '2013-12-31 13:23:33', 0, 'live', 0),
(109, 'miranda_typology', 'miranda_typology', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Name of the type","type":"textarea","required":"0","min":"0","max":"5000"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"icon":{"key":"icon","label":"Icon","type":"text","required":"0","min":"0","max":"64"},"descr":{"key":"descr","label":"Descr","type":"textarea","required":"0","min":"0","max":"1000"},"elementid":{"key":"elementid","label":"Elementid","type":"text","required":"0","min":"0","max":"32"},"family":{"key":"family","label":"Family","type":"text","required":"0","min":"0","max":"100"},"ex":{"key":"ex","label":"Examples","type":"textarea","required":"0","min":"0","max":"1000"},"map":{"key":"map","label":"Map","valuestype":"bunch","values":[{"item":"map"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"text","type":"textarea","required":"0","min":"0","max":"5000"}}', '2013-12-02 14:07:28', '2014-05-01 13:24:02', 0, 'live', 2),
(110, 'miranda_casttype', 'miranda_casttype', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"textarea","required":"1","min":"0","max":"5000"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"test":{"key":"test","label":"test","valuestype":"bunch","values":{"1":{"item":"human"}},"type":"select","required":"0","min":"","max":"1"}}', '2013-12-02 21:49:38', '2014-04-29 14:34:42', 0, 'live', 2),
(111, 'modelec_page', 'modelec_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-12-04 14:45:40', '2013-12-04 14:45:40', 0, 'live', 0),
(112, 'modelec_effacement', 'modelec_effacement', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-12-04 14:52:27', '2013-12-04 14:52:27', 0, 'live', 0),
(114, 'miranda_form', 'miranda_form', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"template":{"key":"template","label":"Template","type":"text","required":"1","min":"","max":""},"action":{"key":"action","label":"Action","type":"text","required":"1","min":"","max":""},"method":{"key":"method","label":"Method","type":"text","required":"1"},"target":{"key":"target","label":"Target","type":"textarea"},"enctype":{"key":"enctype","label":"Enctype","type":"text","required":"1"},"field":{"key":"field","label":"The Fields","type":"form"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-12-23 19:22:45', '2013-12-23 19:22:45', 0, 'live', 0),
(115, 'erh_article', 'erh_article', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-12-27 00:34:11', '2013-12-27 00:34:11', 0, 'live', 0),
(116, 'erh_seminaire', 'erh_seminaire', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"date":{"key":"date","label":"Date","type":"text","required":"0"},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Courte description","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-12-27 00:40:48', '2013-12-27 00:40:48', 0, 'live', 0),
(117, 'erh_page', 'erh_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-12-27 00:54:48', '2013-12-27 00:54:48', 0, 'live', 0),
(118, 'erh_structure', 'erh_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool"}}', '2013-12-27 01:02:47', '2013-12-27 01:02:47', 0, 'live', 0);
INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `system`, `status`, `owner`) VALUES
(119, 'erh_film', 'erh_film', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"}}', '2013-12-27 01:07:17', '2013-12-27 01:14:21', 0, 'live', 0),
(120, 'erh_event', 'erh_event', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"},"descr":{"key":"descr","label":"Header","type":"textarea","required":"0","min":"0","max":"5000"},"video":{"key":"video","label":"Embed a video as the cover","type":"textarea","required":"0","min":"0","max":"2000"},"date":{"key":"date","label":"Date of the event","type":"text","required":"0"}}', '2014-02-02 19:43:04', '2014-02-02 19:54:29', 0, 'live', 0),
(121, 'erh_merchandise', 'erh_merchandise', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Text","type":"sirtrevor","required":"0"},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"},"url":{"key":"url","label":"Url","type":"text"},"video":{"key":"video","label":"Ember a video as the cover","type":"textarea","required":"0","min":"0","max":"2000"},"descr":{"key":"descr","label":"Header","type":"textarea","required":"0","min":"0","max":"5000"}}', '2014-02-02 20:23:54', '2014-02-02 20:26:03', 0, 'live', 0),
(122, 'erh_production', 'erh_production', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Text","type":"sirtrevor","required":"0"},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"},"url":{"key":"url","label":"Url","type":"text"},"descr":{"key":"descr","label":"Header","type":"textarea","required":"0","min":"0","max":"5000"},"video":{"key":"video","label":"Ember a video as the cover","type":"textarea","required":"0","min":"0","max":"2000"}}', '2014-02-02 20:27:37', '2014-02-02 20:27:37', 0, 'live', 0),
(123, 'souvenoir_group', 'souvenoir_group', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"admin":{"key":"admin","label":"admin","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-02-06 16:17:48', '2014-02-06 16:17:48', 0, 'live', 0),
(124, 'cei_site', 'cei_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number"}}', '2014-02-11 10:46:38', '2014-02-11 10:46:38', 0, 'live', 0),
(125, 'cei_issue', 'cei_issue', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"299"},"descr":{"key":"descr","label":"Descr","type":"textarea","required":"0","min":"0","max":"5000"},"color":{"key":"color","label":"Color","type":"text","required":"0","min":"0","max":"10"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"number":{"key":"number","label":"Number","type":"text","required":"1","min":"0","max":"2"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":"1"},"mockup":{"key":"mockup","label":"Mock-up","type":"media","required":"0","min":"","max":"1"},"text":{"key":"text","label":"Text","type":"textarea","required":"0","min":"0","max":"5000"},"wrapup":{"key":"wrapup","label":"wrapup","type":"textarea","required":"0","min":"0","max":"500"},"focus":{"key":"focus","label":"focus","valuestype":"bunch","values":[{"item":"contrib"}],"type":"multipleselect","required":"0"},"link":{"key":"link","label":"Link","type":"array"}}', '2014-02-11 19:02:53', '2014-03-03 14:18:37', 0, 'live', 0),
(126, 'cei_contrib', 'cei_contrib', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"title","type":"textarea","required":"0","min":"0","max":"500"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"5000"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":"1"},"mockup":{"key":"mockup","label":"Mock-up","type":"media","required":"0","min":"","max":""},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"issue":{"key":"issue","label":"Issue","valuestype":"bunch","values":[{"item":"issue"}],"type":"multipleselect","required":"0"},"location":{"key":"location","label":"Location","valuestype":"bunch","values":[{"item":"place"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"Text","type":"sirtrevor","required":"0"},"oldid":{"key":"oldid","label":"old","type":"number","required":"0","min":"","max":""},"author":{"key":"author","label":"author","valuestype":"bunch","values":[{"item":"human"}],"type":"multipleselect","required":"0"},"translation":{"key":"translation","label":"Translation","valuestype":"bunch","values":[{"item":"human"}],"type":"multipleselect","required":"0"},"illustration":{"key":"illustration","label":"Illustration","valuestype":"bunch","values":[{"item":"human"}],"type":"multipleselect","required":"0"},"photography":{"key":"photography","label":"Photography","valuestype":"bunch","values":[{"item":"human"}],"type":"multipleselect","required":"0"},"type":{"key":"type","label":"contribtype","valuestype":"bunch","values":{"1":{"item":"contribtype"}},"type":"multipleselect","required":"0"}}', '2014-02-11 19:08:25', '2014-02-14 18:33:01', 0, 'live', 0),
(127, 'cei_human', 'cei_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"5000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":"1"},"owner":{"key":"owner","label":"Owner","type":"text"},"firstname":{"key":"firstname","label":"First name","type":"text","required":"0","min":"0","max":"100"},"lastname":{"key":"lastname","label":"Last name","type":"text","required":"0","min":"0","max":"100"},"oldid":{"key":"oldid","label":"oldid","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"Url","type":"text"}}', '2014-02-11 19:08:45', '2014-02-15 00:57:35', 0, 'live', 0),
(128, 'cei_group', 'cei_group', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"admin":{"key":"admin","label":"admin","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-02-11 19:10:08', '2014-02-11 19:10:08', 0, 'live', 0),
(129, 'cei_section', 'cei_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","required":"0","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-02-12 18:38:19', '2014-02-12 18:38:19', 0, 'live', 0),
(130, 'cei_contribtype', 'cei_contribtype', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2014-02-14 18:37:45', '2014-02-14 18:37:45', 0, 'live', 0),
(131, 'cei_const', 'cei_const', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"version":{"key":"version","label":"version","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2014-02-19 09:58:14', '2014-02-19 09:58:14', 0, 'live', 0),
(132, 'cei_post', 'cei_post', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":"1"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"text":{"key":"text","label":"Text","type":"sirtrevor","required":"0"},"oldid":{"key":"oldid","label":"old","type":"number","required":"0","min":"","max":""},"date":{"key":"date","label":"date","type":"text","required":"0"},"address":{"key":"address","label":"address","type":"textarea","required":"0","min":"0","max":"5000"}}', '2014-02-21 17:01:37', '2014-02-21 22:04:28', 0, 'live', 0),
(133, 'tdc_human', 'tdc_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"5000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":"1"},"owner":{"key":"owner","label":"Owner","type":"text"},"firstname":{"key":"firstname","label":"First name","type":"text","required":"0","min":"0","max":"100"},"lastname":{"key":"lastname","label":"Last name","type":"text","required":"0","min":"0","max":"100"},"oldid":{"key":"oldid","label":"oldid","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"Url","type":"text"}}', '2014-03-24 19:49:14', '2014-03-24 19:49:14', 0, 'live', 0),
(134, 'tdc_structure', 'tdc_structure', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-03-24 19:50:25', '2014-03-24 19:50:25', 0, 'live', 0),
(135, 'tdc_page', 'tdc_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""}}', '2014-03-24 19:54:37', '2014-03-24 19:54:37', 0, 'live', 0),
(136, 'tdc_site', 'tdc_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"favicon":{"key":"favicon","label":"Favicon","type":"media","required":"0","min":"","max":"2"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-03-24 19:54:51', '2014-03-24 19:54:51', 0, 'live', 0),
(137, 'miranda_workflow', 'miranda_workflow', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"300"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"item":{"key":"item","label":"Item impacted","valuestype":"bunch","values":[{"item":"structure"}],"type":"multipleselect","required":"0"},"workflowstatus":{"key":"workflowstatus","label":"Statuses in this workflow","valuestype":"bunch","values":[{"item":"workflowstatus"}],"type":"multipleselect","required":"0"}}', '2014-04-07 20:37:51', '2014-04-08 05:00:38', 0, 'live', 0),
(138, 'miranda_workflowstatus', 'miranda_workflowstatus', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"300"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"group":{"key":"group","label":"Groups Assigned","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"}}', '2014-04-07 20:42:56', '2014-04-07 20:44:28', 0, 'live', 0),
(139, 'miranda_group', 'miranda_group', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"admin":{"key":"admin","label":"admin","type":"bool"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2014-04-07 20:45:47', '2014-04-07 20:45:47', 0, 'live', 0),
(140, 'mm_comment', 'mm_comment', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"item":{"key":"item","label":"Linked item","type":"text","required":"1"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"0","max":"255"},"txt":{"key":"txt","label":"Text","type":"textarea","required":"0","min":"0","max":"5000"}}', '2014-04-10 14:07:54', '2014-04-10 14:09:55', 0, 'live', 0),
(141, 'note', 'Notes', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"hidden","readonly":true},"item":{"key":"item","label":"Item","type":"hidden","min":"","max":"","placeholder":"Item"},"text":{"key":"text","label":"Text","type":"textarea","min":"","max":"","placeholder":"A short description"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(142, 'miranda_site', 'miranda_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-04-13 23:12:19', '2014-04-13 23:12:19', 0, 'live', 0),
(143, 'miranda_comment', 'miranda_comment', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"text":{"key":"text","label":"Text","type":"textarea","required":"0","min":"0","max":"31965"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2014-04-24 22:41:53', '2014-04-24 22:41:53', 0, 'live', 0),
(144, 'miranda_version', 'miranda_version', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"lang":{"key":"lang","label":"Language","type":"text","required":"1","min":"0","max":"32"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-04-25 05:28:32', '2014-04-25 05:28:32', 0, 'live', 0),
(145, 'miranda_item', 'miranda_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"},"icon":{"key":"icon","label":"icon","type":"text","required":"0","min":"0","max":"16"}}', '2014-04-29 14:03:01', '2014-04-29 14:36:06', 0, 'live', 2),
(146, 'zoning', 'Zoning', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"hidden","readonly":true},"item":{"key":"item","label":"Item","type":"hidden","min":"","max":"","placeholder":"Item"},"section":{"key":"text","label":"Text","type":"zoning","min":"","max":""}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(147, 'souvenoir_item', 'souvenoir_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-04-30 06:39:07', '2014-04-30 06:39:07', 0, 'live', 2),
(148, 'admin_item', 'admin_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-02 16:28:30', '2014-05-02 16:28:30', 1, 'live', 2),
(149, 'admin_site', 'admin_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-02 17:38:02', '2014-05-02 17:38:02', 1, 'live', 2);

-- --------------------------------------------------------

--
-- Table structure for table `greenbutton`
--

CREATE TABLE `greenbutton` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `greenbutton`
--

INSERT INTO `greenbutton` (`id`, `key`, `title`, `created`, `updated`, `status`, `icon`, `owner`) VALUES
(1, 'save', 'Save', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', '', 0),
(2, 'asleep', 'Go asleep', '0000-00-00 00:00:00', '2013-02-07 06:45:11', 'live', '', 0),
(3, 'new', 'New', '0000-00-00 00:00:00', '2013-05-01 21:46:43', 'live', '', 0),
(4, 'save_reach', 'Save & reach', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', '', 0),
(5, 'save_copy', 'Save as a copy', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', '', 0),
(6, 'save_new', 'Save & start anew', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', '', 0),
(7, 'trash', 'Move to trash', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', '', 0),
(8, 'live', 'Go live', '0000-00-00 00:00:00', '2013-02-07 06:31:35', 'live', '', 0),
(9, 'workflow', 'Put back in the workflow', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', '', 0),
(10, 'buildapp', 'Build a new App!', '2013-03-22 08:57:22', '2013-10-20 22:53:27', 'live', '', 0),
(11, 'newpage', 'New page', '2013-10-23 02:14:09', '2013-10-23 02:14:09', 'live', '', 0),
(12, 'preview', 'Preview', '2013-10-28 10:39:50', '2013-10-28 10:39:50', 'live', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL,
  `attr` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `hasurl` tinyint(1) NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `key`, `title`, `descr`, `system`, `attr`, `created`, `updated`, `status`, `hasurl`, `owner`) VALUES
(1, 'item', 'Items', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"system":{"key":"system","title":"Is system","type":"bool"},"attr":{"key":"attr","title":"Attributes","type":"array"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status"},"hasurl":{"key":"hasurl","title":"Has URL","type":"bool"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-11-17 14:17:07', '2013-11-17 14:17:07', 'live', 0, 0),
(2, 'site', 'Configuration', 'Manage your website basics, and the apps that will be opened at all time.', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","required":"1","min":"0","max":"255"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"defaultversion":{"key":"defaultversion","type":"int","title":"Default Version","required":"0","min":"","max":""},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-11-17 14:17:07', '2014-05-02 17:37:38', 'live', 0, 2),
(3, 'page', 'Pages', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"type":{"key":"type","type":"array"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"text":{"key":"text","type":"string","title":"The text content","min":"0","max":"65035"},"url":{"key":"url","type":"url","title":"The url","min":"0","max":"255","required":"1"},"system":{"key":"system","type":"bool","title":"System"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"child":{"key":"child","param":[{"item":"page"}],"min":"","max":"","type":"rel"},"section":{"key":"section","param":{"1":{"item":"section"}},"min":"","max":"","type":"rel"},"sectiondefault":{"key":"sectiondefault","param":{"1":{"item":"section"}},"min":"","max":"","type":"rel"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-11-17 14:17:07', '2013-11-17 14:17:07', 'live', 1, 0),
(4, 'version', 'Versions', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"lang":{"key":"lang","title":"Language","type":"string","min":"0","max":"32","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-11-17 14:17:07', '2013-11-17 14:17:07', 'live', 0, 0),
(5, 'const', 'Text constants', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"version":{"key":"version","title":"Version","type":"version"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-11-17 14:17:07', '2013-11-17 14:17:07', 'live', 0, 0),
(6, 'form', 'Forms', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"template":{"key":"template","type":"string","title":"Template","min":"","max":"","required":"1"},"action":{"key":"action","type":"string","title":"Action","min":"","max":"","required":"1"},"method":{"key":"method","type":"list","option":"post,get","title":"Method","required":"1"},"target":{"key":"target","type":"string","title":"Target"},"enctype":{"key":"enctype","type":"list","option":"application\\/x-www-form-urlencoded,multipart\\/form-data","title":"Enctype","required":"1"},"field":{"key":"field","type":"array","title":"The Fields"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"system":{"key":"system","type":"bool","title":"System"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-09-27 08:33:31', '2013-11-17 14:17:07', 'live', 0, 0),
(7, 'section', 'Sections', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"zone":{"key":"zone","type":"string","title":"The zone","min":"0","max":"255"},"app":{"key":"app","type":"array","title":"The template","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"greenbutton":{"key":"greenbutton","param":[{"item":"greenbutton"}],"min":"","max":"","type":"rel"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-09-25 08:33:09', '2013-11-17 14:17:07', 'live', 0, 0),
(8, 'greenbutton', 'Green button actions', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","required":"1","min":"0","max":"255"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"icon":{"key":"icon","type":"string","title":"Icon","required":"0","min":"","max":""},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-09-25 08:33:09', '2013-11-17 14:17:07', 'live', 0, 0),
(9, 'logbook', 'Logbook', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id","min":"0","max":"0","index":"primary","auto_increment":"1"},"key":{"key":"key","title":"The key","type":"key","min":"0","max":"32","required":"1"},"subject":{"key":"subject","title":"Subject","type":"string","min":"","max":""},"subjectid":{"key":"subjectid","title":"Subject ID","type":"int","min":"","max":""},"item":{"key":"item","title":"item","type":"string","min":"","max":""},"itemid":{"key":"itemid","title":"item id","type":"int","min":"","max":""},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-11-17 14:17:07', '2013-11-17 14:17:07', 'live', 0, 0),
(10, 'note', 'Notes', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"item":{"key":"item","type":"string","title":"Item","required":"1","min":"","max":""},"itemid":{"key":"itemid","type":"int","title":"Item ID","required":"1","min":"","max":""},"content":{"key":"content","type":"string","title":"Content","required":"1","min":"","max":""},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-10-20 22:59:08', '2013-11-17 14:17:07', 'live', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `subjectid` mediumint(3) unsigned NOT NULL,
  `item` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `itemid` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`id`, `key`, `subject`, `subjectid`, `item`, `itemid`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'insert', 'human', 23, 'form', 26, '2013-10-12 21:57:21', '2013-10-12 21:57:21', 'live', 0),
(2, 'update', 'human', 23, 'page', 6, '2013-10-12 22:01:52', '2013-10-12 22:01:52', 'live', 0),
(3, 'update', 'human', 2, 'page', 5, '2013-10-13 01:05:53', '2013-10-13 01:05:53', 'live', 0),
(4, 'insert', 'human', 2, 'form', 28, '2013-10-13 01:11:44', '2013-10-13 01:11:44', 'live', 0),
(5, 'update', 'human', 2, 'page', 6, '2013-10-13 02:28:37', '2013-10-13 02:28:37', 'live', 0),
(6, 'update', 'human', 2, 'page', 5, '2013-10-13 14:07:18', '2013-10-13 14:07:18', 'live', 0),
(7, 'update', 'human', 2, 'page', 5, '2013-10-13 14:08:20', '2013-10-13 14:08:20', 'live', 0),
(8, 'insert', 'human', 2, 'form', 30, '2013-10-13 14:22:05', '2013-10-13 14:22:05', 'live', 0),
(9, 'insert', 'human', 2, 'const', 62, '2013-10-13 14:24:37', '2013-10-13 14:24:37', 'live', 0),
(10, 'update', 'human', 2, 'page', 5, '2013-10-13 14:30:17', '2013-10-13 14:30:17', 'live', 0),
(11, 'insert', 'human', 2, 'const', 63, '2013-10-13 14:31:21', '2013-10-13 14:31:21', 'live', 0),
(12, 'update', 'human', 2, 'page', 1, '2013-10-13 14:37:01', '2013-10-13 14:37:01', 'live', 0),
(13, 'update', 'human', 2, 'page', 1, '2013-10-13 14:38:17', '2013-10-13 14:38:17', 'live', 0),
(14, 'update', 'human', 2, 'page', 1, '2013-10-13 14:49:26', '2013-10-13 14:49:26', 'live', 0),
(15, 'insert', 'human', 2, 'form', 31, '2013-10-13 15:58:26', '2013-10-13 15:58:26', 'live', 0),
(16, 'insert', 'human', 2, 'form', 32, '2013-10-13 15:58:44', '2013-10-13 15:58:44', 'live', 0),
(17, 'update', 'human', 2, 'page', 1, '2013-10-13 16:06:11', '2013-10-13 16:06:11', 'live', 0),
(18, 'insert', 'human', 2, 'const', 64, '2013-10-14 01:28:04', '2013-10-14 01:28:04', 'live', 0),
(19, 'update', 'human', 2, 'const', 64, '2013-10-14 01:29:34', '2013-10-14 01:29:34', 'live', 0),
(20, 'insert', 'human', 2, 'const', 65, '2013-10-14 10:38:30', '2013-10-14 10:38:30', 'live', 0),
(21, 'insert', 'human', 2, 'const', 66, '2013-10-14 10:39:21', '2013-10-14 10:39:21', 'live', 0),
(22, 'insert', 'human', 2, 'const', 67, '2013-10-14 10:40:20', '2013-10-14 10:40:20', 'live', 0),
(23, 'update', 'human', 2, 'page', 7, '2013-10-14 13:11:22', '2013-10-14 13:11:22', 'live', 0),
(24, 'update', 'human', 2, 'page', 7, '2013-10-14 13:11:59', '2013-10-14 13:11:59', 'live', 0),
(25, 'update', 'human', 2, 'page', 6, '2013-10-16 12:24:29', '2013-10-16 12:24:29', 'live', 0),
(26, 'update', 'human', 2, 'section', 2, '2013-10-16 14:52:08', '2013-10-16 14:52:08', 'live', 0),
(27, 'update', 'human', 2, 'section', 2, '2013-10-16 17:50:46', '2013-10-16 17:50:46', 'live', 0),
(28, 'update', 'human', 2, 'section', 2, '2013-10-16 17:51:20', '2013-10-16 17:51:20', 'live', 0),
(29, 'update', 'human', 2, 'section', 2, '2013-10-16 17:52:16', '2013-10-16 17:52:16', 'live', 0),
(30, 'update', 'human', 2, 'page', 11, '2013-10-18 18:40:46', '2013-10-18 18:40:46', 'live', 0),
(31, 'insert', 'human', 2, 'const', 68, '2013-10-19 14:33:38', '2013-10-19 14:33:38', 'live', 0),
(32, 'insert', 'human', 2, 'const', 69, '2013-10-19 14:35:54', '2013-10-19 14:35:54', 'live', 0),
(33, 'update', 'human', 2, 'const', 69, '2013-10-19 14:35:59', '2013-10-19 14:35:59', 'live', 0),
(34, 'insert', 'human', 2, 'const', 70, '2013-10-19 14:36:24', '2013-10-19 14:36:24', 'live', 0),
(35, 'insert', 'human', 2, 'const', 71, '2013-10-19 14:36:44', '2013-10-19 14:36:44', 'live', 0),
(36, 'insert', 'human', 2, 'const', 72, '2013-10-19 14:37:13', '2013-10-19 14:37:13', 'live', 0),
(37, 'insert', 'human', 2, 'const', 73, '2013-10-19 14:37:32', '2013-10-19 14:37:32', 'live', 0),
(38, 'insert', 'human', 2, 'const', 74, '2013-10-19 14:37:51', '2013-10-19 14:37:51', 'live', 0),
(39, 'insert', 'human', 2, 'const', 75, '2013-10-19 14:38:19', '2013-10-19 14:38:19', 'live', 0),
(40, 'update', 'human', 2, 'const', 75, '2013-10-19 14:41:58', '2013-10-19 14:41:58', 'live', 0),
(41, 'update', 'human', 2, 'const', 75, '2013-10-19 14:42:04', '2013-10-19 14:42:04', 'live', 0),
(42, 'update', 'human', 2, 'const', 75, '2013-10-19 14:43:48', '2013-10-19 14:43:48', 'live', 0),
(43, 'insert', 'human', 2, 'const', 76, '2013-10-19 14:47:26', '2013-10-19 14:47:26', 'live', 0),
(44, 'update', 'human', 2, 'const', 76, '2013-10-19 14:53:32', '2013-10-19 14:53:32', 'live', 0),
(45, 'insert', 'human', 2, 'const', 77, '2013-10-19 14:55:23', '2013-10-19 14:55:23', 'live', 0),
(46, 'insert', 'human', 2, 'const', 78, '2013-10-19 14:55:57', '2013-10-19 14:55:57', 'live', 0),
(47, 'insert', 'human', 2, 'const', 79, '2013-10-19 14:56:19', '2013-10-19 14:56:19', 'live', 0),
(48, 'insert', 'human', 2, 'const', 80, '2013-10-19 14:57:23', '2013-10-19 14:57:23', 'live', 0),
(49, 'insert', 'human', 2, 'const', 81, '2013-10-19 14:57:34', '2013-10-19 14:57:34', 'live', 0),
(50, 'insert', 'human', 2, 'const', 82, '2013-10-19 14:57:45', '2013-10-19 14:57:45', 'live', 0),
(51, 'insert', 'human', 2, 'const', 83, '2013-10-19 15:14:10', '2013-10-19 15:14:10', 'live', 0),
(52, 'insert', 'human', 2, 'form', 35, '2013-10-19 15:27:03', '2013-10-19 15:27:03', 'live', 0),
(53, 'update', 'human', 2, 'page', 10, '2013-10-19 15:27:46', '2013-10-19 15:27:46', 'live', 0),
(54, 'update', 'human', 2, 'page', 5, '2013-10-19 15:28:26', '2013-10-19 15:28:26', 'live', 0),
(55, 'update', 'human', 2, 'page', 6, '2013-10-19 15:32:08', '2013-10-19 15:32:08', 'live', 0),
(56, 'insert', 'human', 2, 'form', 36, '2013-10-19 15:37:25', '2013-10-19 15:37:25', 'live', 0),
(57, 'insert', 'human', 2, 'const', 85, '2013-10-19 16:12:13', '2013-10-19 16:12:13', 'live', 0),
(58, 'update', 'human', 2, 'const', 85, '2013-10-19 16:12:17', '2013-10-19 16:12:17', 'live', 0),
(59, 'insert', 'human', 2, 'const', 86, '2013-10-19 16:13:06', '2013-10-19 16:13:06', 'live', 0),
(60, 'update', 'human', 2, 'const', 86, '2013-10-19 17:10:19', '2013-10-19 17:10:19', 'live', 0),
(61, 'insert', 'human', 2, 'const', 87, '2013-10-19 17:11:31', '2013-10-19 17:11:31', 'live', 0),
(62, 'insert', 'human', 2, 'const', 88, '2013-10-19 17:12:22', '2013-10-19 17:12:22', 'live', 0),
(63, 'insert', 'human', 2, 'const', 90, '2013-10-19 17:13:55', '2013-10-19 17:13:55', 'live', 0),
(64, 'insert', 'human', 2, 'const', 91, '2013-10-19 17:14:59', '2013-10-19 17:14:59', 'live', 0),
(65, 'update', 'human', 2, 'page', 11, '2013-10-20 22:50:45', '2013-10-20 22:50:45', 'live', 0),
(66, 'update', 'human', 2, 'section', 4, '2013-10-20 22:52:03', '2013-10-20 22:52:03', 'live', 0),
(67, 'update', 'human', 2, 'section', 20, '2013-10-20 22:53:07', '2013-10-20 22:53:07', 'live', 0),
(68, 'insert', 'human', 2, 'form', 38, '2013-10-20 22:53:20', '2013-10-20 22:53:20', 'live', 0),
(69, 'update', 'human', 2, 'greenbutton', 10, '2013-10-20 22:53:27', '2013-10-20 22:53:27', 'live', 0),
(70, 'insert', 'human', 2, 'version', 2, '2013-10-20 22:53:53', '2013-10-20 22:53:53', 'live', 0),
(71, 'insert', 'human', 2, 'structure', 10, '2013-10-20 22:59:08', '2013-10-20 22:59:08', 'live', 0),
(72, 'update', 'human', 2, 'structure', 10, '2013-10-20 23:01:39', '2013-10-20 23:01:39', 'live', 0),
(73, 'insert', 'human', 2, 'form', 39, '2013-10-20 23:02:25', '2013-10-20 23:02:25', 'live', 0),
(74, 'insert', 'human', 2, 'form', 64, '2013-10-23 02:13:41', '2013-10-23 02:13:41', 'live', 0),
(75, 'insert', 'human', 2, 'greenbutton', 11, '2013-10-23 02:14:09', '2013-10-23 02:14:09', 'live', 0),
(76, 'insert', 'human', 2, 'form', 65, '2013-10-23 02:14:26', '2013-10-23 02:14:26', 'live', 0),
(77, 'update', 'human', 2, 'section', 10, '2013-10-23 02:14:52', '2013-10-23 02:14:52', 'live', 0),
(78, 'insert', 'human', 2, 'form', 74, '2013-10-25 12:58:52', '2013-10-25 12:58:52', 'live', 0),
(79, 'insert', 'human', 2, 'const', 92, '2013-10-25 12:59:07', '2013-10-25 12:59:07', 'live', 0),
(80, 'insert', 'human', 2, 'form', 76, '2013-10-28 10:39:22', '2013-10-28 10:39:22', 'live', 0),
(81, 'update', 'human', 2, 'structure', 8, '2013-10-28 10:39:28', '2013-10-28 10:39:28', 'live', 0),
(82, 'insert', 'human', 2, 'form', 77, '2013-10-28 10:39:38', '2013-10-28 10:39:38', 'live', 0),
(83, 'insert', 'human', 2, 'greenbutton', 12, '2013-10-28 10:39:50', '2013-10-28 10:39:50', 'live', 0),
(84, 'insert', 'human', 2, 'form', 78, '2013-10-28 10:40:03', '2013-10-28 10:40:03', 'live', 0),
(85, 'update', 'human', 2, 'section', 2, '2013-10-28 10:40:15', '2013-10-28 10:40:15', 'live', 0),
(86, 'insert', 'human', 2, 'form', 80, '2013-10-28 12:20:02', '2013-10-28 12:20:02', 'live', 0),
(87, 'update', 'human', 2, 'page', 5, '2013-10-28 21:08:27', '2013-10-28 21:08:27', 'live', 0),
(88, 'insert', 'human', 2, 'form', 81, '2013-10-28 21:08:52', '2013-10-28 21:08:52', 'live', 0),
(89, 'insert', 'human', 2, 'form', 82, '2013-10-28 21:09:04', '2013-10-28 21:09:04', 'live', 0),
(90, 'insert', 'human', 2, 'section', 29, '2013-11-05 15:34:51', '2013-11-05 15:34:51', 'live', 0),
(91, 'update', 'human', 2, 'form', 80, '2014-04-08 03:56:11', '2014-04-08 03:56:11', 'live', 0),
(92, 'update', 'human', 2, 'form', 78, '2014-04-08 03:56:41', '2014-04-08 03:56:41', 'live', 0),
(93, 'update', 'human', 2, 'page', 6, '2014-04-08 03:59:42', '2014-04-08 03:59:42', 'live', 0),
(94, 'update', 'human', 2, 'form', 76, '2014-04-08 17:09:30', '2014-04-08 17:09:30', 'live', 0),
(95, 'update', 'human', 2, 'page', 10, '2014-04-08 19:54:26', '2014-04-08 19:54:26', 'live', 0),
(96, 'update', 'human', 2, 'page', 9, '2014-04-08 19:54:46', '2014-04-08 19:54:46', 'live', 0),
(97, 'update', 'human', 2, 'page', 5, '2014-04-25 04:29:37', '2014-04-25 04:29:37', 'live', 0),
(98, 'update', 'human', 2, 'page', 5, '2014-04-25 10:03:37', '2014-04-25 10:03:37', 'live', 0),
(99, 'insert', 'human', 2, 'page', 37, '2014-05-02 15:31:57', '2014-05-02 15:31:57', 'live', 2),
(100, 'update', 'human', 2, 'page', 1, '2014-05-02 15:31:57', '2014-05-02 15:31:57', 'live', 2),
(101, 'update', 'human', 2, 'page', 37, '2014-05-02 15:36:47', '2014-05-02 15:36:47', 'live', 2),
(102, 'update', 'human', 2, 'form', 74, '2014-05-02 16:27:57', '2014-05-02 16:27:57', 'live', 2),
(103, 'insert', 'human', 2, 'form', 148, '2014-05-02 16:28:30', '2014-05-02 16:28:30', 'live', 2),
(104, 'update', 'human', 2, 'item', 2, '2014-05-02 17:37:38', '2014-05-02 17:37:38', 'live', 2),
(105, 'insert', 'human', 2, 'form', 149, '2014-05-02 17:38:02', '2014-05-02 17:38:02', 'live', 2);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `itemid` mediumint(3) unsigned NOT NULL,
  `content` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `text` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `type`, `descr`, `text`, `url`, `system`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'home', 'Digest', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', 'Welcome home', '', '/', 0, '2013-10-03 08:28:48', '2014-05-02 15:31:57', 'live', 2),
(2, 'error_404', 'Oups, that 404 thing again!', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', '', '', '/404', 1, '0000-00-00 00:00:00', '2013-08-26 01:28:27', 'live', 0),
(3, 'post', 'Routine points', '{"key":"content","http_status":"200 OK","content_type":"routine","app":"content","template":"\\/master\\/post"}', 'Receives all the posts from the forms.', '', '/routine', 1, '0000-00-00 00:00:00', '2013-08-25 19:33:38', 'live', 0),
(5, 'list', 'List', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', '', '', '/list', 0, '2013-10-13 01:05:53', '2014-04-25 10:03:37', 'live', 2),
(6, 'edit', 'Edit', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', '', '', '/edit', 0, '2013-10-12 22:01:52', '2014-04-08 03:59:42', 'live', 2),
(7, 'doc', 'Doc', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', 'About classes, methods and functions available to you, kind developer.', '', '/doc', 0, '2013-10-14 13:11:22', '2013-10-14 13:11:59', 'live', 0),
(9, 'site', 'Environment', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', 'Structure', '', '/site', 0, '2014-04-08 19:54:46', '2014-04-08 19:54:46', 'live', 2),
(10, 'content', 'Content', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', 'Publish', '', '/item', 0, '2013-10-19 15:27:46', '2014-04-08 19:54:26', 'live', 2),
(11, 'app', 'Apps', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', 'Tweak', '', '/app', 0, '2013-10-18 18:40:46', '2013-10-20 22:50:45', 'live', 0),
(29, 'logbook', 'Logbook', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', '', '', '/logbook', 0, '0000-00-00 00:00:00', '2013-03-06 06:21:38', 'live', 0),
(30, 'login', 'Login', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/login"}', '', '', '/login', 1, '2013-10-03 04:16:31', '2013-10-03 04:16:31', 'live', 0),
(31, 'api.json', 'API (json)', '{"key":"content","http_status":"200 OK","content_type":"json","app":"content","template":"\\/master\\/api"}', '', '', '/api.json', 1, '2013-03-06 03:21:46', '2013-03-22 12:56:52', 'live', 0),
(32, 'me', 'My profile', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', 'dfsdf', '', '/me', 0, '0000-00-00 00:00:00', '2013-03-13 14:04:08', 'live', 0),
(33, 'api.eventstream', 'API (event-stream)', '{"key":"content","http_status":"200 OK","content_type":"eventstream","app":"content","template":"\\/master\\/api"}', '', '', '/api.eventstream', 1, '2013-03-06 03:21:46', '2013-03-22 13:22:05', 'live', 0),
(35, 'ajax.html', 'AJAX (hmtl)', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/ajax"}', '', '', '/ajax.html', 1, '2013-03-06 03:21:46', '2013-03-22 13:22:05', 'live', 0),
(36, 'ajax.json', 'AJAX (json)', '{"key":"content","http_status":"200 OK","content_type":"json","app":"content","template":"\\/master\\/ajax"}', '', '', '/ajax.json', 1, '2013-03-06 03:21:46', '2013-03-22 12:56:52', 'live', 0),
(37, 'lab', 'Lab', '{"key":"content","http_status":"200 OK","content_type":"html","app":"content","template":"\\/master\\/master"}', '', '', '/lab', 0, '2014-05-02 15:31:57', '2014-05-02 15:36:47', 'live', 2);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `key`, `title`, `descr`, `zone`, `app`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'live', 'Live', 'General form', 'content', '{"key":"content","template":"\\/list\\/list", "param":{"status":"live", "system":false}}', '0000-00-00 00:00:00', '2013-04-02 14:02:45', 'live', 0),
(2, 'edit', 'Edit', 'General form', 'content', '{"key":"content","template":"\\/edit\\/edit"}', '2013-10-16 14:52:08', '2013-10-28 10:40:15', 'live', 0),
(3, 'php', 'PHP classes, methods & functions', 'lorem Lorem ipsum', 'content', '{"key":"content","template":"\\/doc\\/code"}', '0000-00-00 00:00:00', '2013-08-30 01:16:18', 'live', 0),
(4, 'doc', 'Documentation', '', 'content', '{"key":"content","template":"\\/doc\\/doc"}', '2013-10-20 22:52:03', '2013-10-20 22:52:03', 'live', 0),
(5, 'splash', 'Ressource not found', 'Lorem ipsum', 'content', '{"key":"content","template":"\\/error\\/error"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(6, 'system', 'System', '', 'content', '{"key":"content","template":"\\/list\\/list", "param":{"system":true}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live', 0),
(7, 'asleep', 'Asleep', '', 'content', '{"key":"content","template":"\\/list\\/list", "param":{"status":"asleep"}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live', 0),
(8, 'draft', 'Drafts', '', 'content', '{"key":"content","template":"\\/list\\/list", "param":{"status":"draft"}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live', 0),
(9, 'timeline', 'Timeline', 'Lorem ipsum', 'content', '{"key":"content","template":"\\/timeline\\/timeline"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(10, 'tree', 'Site tree', 'Lorem ipsum', 'content', '{"key":"content","template":"\\/tree\\/tree"}', '2013-10-23 02:14:52', '2013-10-23 02:14:52', 'live', 0),
(17, 'zoning', 'Zoning', 'Zoning', 'content', '{"key":"content","template":"\\/zoning\\/zoning"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(19, 'appstore', 'App store', '', 'content', '{"key":"content","template":"\\/appmanager\\/appmanager"}', '0000-00-00 00:00:00', '2013-03-22 08:58:52', 'live', 0),
(20, 'appini', 'About this app', '', 'content', '{"key":"content","template":"\\/appini\\/appini"}', '2013-10-20 22:53:07', '2013-10-20 22:53:07', 'live', 0),
(21, 'appconfig', 'Config', '', 'content', '{"key":"content","template":"\\/appconfig\\/appconfig"}', '0000-00-00 00:00:00', '2013-02-01 02:05:55', 'live', 0),
(25, 'carousel_test', 'Carousel de test', '', 'content', '{"key":"jquery_carousel","template":"\\/jquery_carousel","param":{"direction":"horizontal","autoSlideInterval":"3000","dispItems":"1","paginationPosition":"inside","nextBtn":"<span>next<\\/span>","prevBtn":"<span>previous<\\/span>","btnsPosition":"inside","nextBtnInsert":"appendTo","prevBtnInsert":"prependTo","delayAutoSlide":"0","effect":"slide","slideEasing":"swing","animSpeed":"normal"}}', '2013-02-08 10:22:45', '2013-02-08 10:22:45', 'live', 0),
(27, 'notes', 'Discussion', '', 'content', '{"key":"content","template":"\\/notes\\/notes"}', '2013-03-11 01:20:51', '2013-04-02 13:10:52', 'live', 0),
(28, 'login', 'Login Form', '', 'site', '{"key":"form","template":"\\/login","param":{"key":"login"}}', '2013-04-07 15:55:22', '2013-04-07 15:55:22', 'live', 0),
(30, 'workflow', 'Workflow', 'Workflow', 'content', '{"key":"content","template":"\\/workflow\\/workflow"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(31, 'lab', 'Open labs', '', 'content', '{"key":"lab","template":"\\/lab"}', '2013-10-16 14:52:08', '2013-11-05 15:34:51', 'live', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `defaultversion` mediumint(3) unsigned NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`, `owner`) VALUES
(1, 'admin', 'Grand Central', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1, 0),
(2, 'c63b929b57afd98fc6f4f8acbe9ab07a', '', '2014-04-13 20:29:03', '2014-04-13 20:29:03', 'live', 0, 0),
(3, 'eb95c95d80f1c2b854f9a0d573cbea7f', '', '2014-04-13 20:30:16', '2014-04-13 20:30:16', 'live', 0, 0),
(4, '6b456a3d842121fb117c84ef86db3533', '', '2014-04-13 20:30:21', '2014-04-13 20:30:21', 'live', 0, 0),
(5, '244ae49925c651a23106a61d7a78f7c9', '', '2014-04-13 20:31:53', '2014-04-13 20:31:53', 'live', 0, 0),
(6, 'c514ff705ba97144e90020da33ec9810', '', '2014-04-13 20:33:35', '2014-04-13 20:33:35', 'live', 0, 0),
(7, '6a69983d7f5ccc8fd1b6d921c7726871', '', '2014-04-13 20:35:39', '2014-04-13 20:35:39', 'live', 0, 0),
(8, '960e511a936b589272c702d6691ef80f', '', '2014-04-13 20:35:58', '2014-04-13 20:35:58', 'live', 0, 0),
(9, '3d9212412066b5211d14159ad7b0d67a', '', '2014-04-13 20:36:44', '2014-04-13 20:36:44', 'live', 0, 0),
(10, '3990575a86c78a8c4742e80995f0379b', '', '2014-04-13 20:40:25', '2014-04-13 20:40:25', 'live', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-04-05 17:02:34', 'live', 0),
(2, 'fr', 'Français', 'fr', '2013-10-20 22:53:53', '2013-10-20 22:53:53', 'live', 0);

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

--
-- Dumping data for table `_rel`
--

INSERT INTO `_rel` (`item`, `itemid`, `key`, `rel`, `relid`, `position`) VALUES
('page', 30, 'section', 'section', 28, 0),
('page', 7, 'section', 'section', 3, 0),
('page', 7, 'section', 'section', 4, 1),
('section', 1, 'greenbutton', 'greenbutton', 3, 0),
('page', 11, 'section', 'section', 20, 0),
('page', 11, 'section', 'section', 4, 1),
('section', 20, 'greenbutton', 'greenbutton', 10, 0),
('section', 10, 'greenbutton', 'greenbutton', 11, 0),
('section', 2, 'greenbutton', 'greenbutton', 8, 0),
('section', 2, 'greenbutton', 'greenbutton', 1, 1),
('section', 2, 'greenbutton', 'greenbutton', 2, 2),
('section', 2, 'greenbutton', 'greenbutton', 4, 3),
('section', 2, 'greenbutton', 'greenbutton', 5, 4),
('section', 2, 'greenbutton', 'greenbutton', 12, 5),
('section', 2, 'greenbutton', 'greenbutton', 6, 6),
('section', 2, 'greenbutton', 'greenbutton', 9, 7),
('section', 2, 'greenbutton', 'greenbutton', 7, 8),
('section', 29, 'greenbutton', 'greenbutton', 8, 0),
('section', 29, 'greenbutton', 'greenbutton', 1, 1),
('section', 29, 'greenbutton', 'greenbutton', 2, 2),
('section', 29, 'greenbutton', 'greenbutton', 4, 3),
('section', 29, 'greenbutton', 'greenbutton', 5, 4),
('section', 29, 'greenbutton', 'greenbutton', 12, 5),
('section', 29, 'greenbutton', 'greenbutton', 6, 6),
('section', 29, 'greenbutton', 'greenbutton', 9, 7),
('section', 29, 'greenbutton', 'greenbutton', 7, 8),
('page', 6, 'section', 'section', 9, 0),
('page', 6, 'section', 'section', 2, 1),
('page', 6, 'section', 'section', 17, 2),
('page', 6, 'section', 'section', 30, 3),
('page', 6, 'section', 'section', 27, 4),
('page', 6, 'sectiondefault', 'section', 2, 0),
('page', 10, 'child', 'page', 5, 0),
('page', 10, 'child', 'page', 6, 1),
('page', 5, 'section', 'section', 9, 0),
('page', 5, 'section', 'section', 1, 1),
('page', 5, 'section', 'section', 6, 2),
('page', 5, 'section', 'section', 7, 3),
('page', 5, 'section', 'section', 8, 4),
('page', 5, 'sectiondefault', 'section', 10, 0),
('page', 5, 'sectiondefault', 'section', 1, 1),
('page', 5, 'section', 'section', 10, 1),
('page', 1, 'child', 'page', 9, 0),
('page', 1, 'child', 'page', 10, 1),
('page', 1, 'child', 'page', 12, 2),
('page', 1, 'child', 'page', 11, 3),
('page', 1, 'child', 'page', 37, 4),
('page', 1, 'section', 'section', 9, 0),
('page', 37, 'section', 'section', 31, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
