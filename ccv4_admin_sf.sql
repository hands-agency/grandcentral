-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 16, 2013 at 01:31 PM
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
  `version` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`version`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=93 ;

--
-- Dumping data for table `const`
--

INSERT INTO `const` (`id`, `key`, `title`, `version`, `created`, `updated`, `status`) VALUES
(1, 'OPENALL', 'Open all', 1, '0000-00-00 00:00:00', '2013-05-17 11:29:44', 'trash'),
(2, 'NAVCC_SEARCH_NODATA', 'Try searching something, I''m ready.', 1, '0000-00-00 00:00:00', '2013-03-27 15:08:29', 'live'),
(3, 'NAVCC_SEARCH_PLACEHOLDER', 'Search for items, people, anything.', 1, '0000-00-00 00:00:00', '2013-08-14 01:10:33', 'live'),
(4, 'OPTION_FILTER_REFINE', 'Refine', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(6, 'MULTIPLESELECT_AVAILABLE_LABEL', 'Available', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(7, 'MULTIPLESELECT_SELECTED_LABEL', 'Selected', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(8, 'MULTIPLESELECT_SELECTED_NODATA', 'Why don''t you try and drag something here?', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(9, 'ADMIN_ZONING_ZONE_NODATA', 'Dammit, no zone. That''s impossimpible!', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(10, 'ZONING_SELECTED_NODATA', 'This zone has no section', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(11, 'ZONING_SELECTED_BUBBLE', 'Mine! Mine!', 1, '0000-00-00 00:00:00', '2013-03-22 14:49:01', 'live'),
(12, 'ZONING_AVAILABLE_LABEL', 'Apps', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(13, 'ZONING_LEGEND', 'This zoning shows the zones and sections. Change your code, this preview will follow.', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(14, 'ZONING_AVAILABLE_SEARCH_PLACEHOLDER', 'Search', 1, '2013-01-23 11:13:49', '2013-01-23 11:13:49', 'live'),
(15, 'OPTION_DATE_YESTERDAY_NIGHT', 'Yesterday night', 1, '2013-03-18 11:33:04', '2013-03-18 11:33:04', 'live'),
(16, 'DATE_YEAR', 'year', 1, '2013-03-22 12:41:48', '2013-03-22 17:47:09', 'live'),
(17, 'DATE_MONTH', 'month', 1, '2013-03-22 12:42:00', '2013-03-22 12:42:00', 'live'),
(18, 'DATE_WEEK', 'week', 1, '2013-03-22 12:42:09', '2013-03-22 12:42:09', 'live'),
(19, 'DATE_DAY', 'day', 1, '2013-03-22 12:42:19', '2013-03-22 12:42:19', 'live'),
(20, 'DATE_HOUR', 'hour', 1, '2013-03-22 12:42:26', '2013-03-22 12:42:26', 'live'),
(21, 'DATE_MINUTE', 'minute', 1, '2013-03-22 12:42:37', '2013-03-22 12:42:37', 'live'),
(22, 'DATE_SECOND', 'second', 1, '2013-03-22 12:42:43', '2013-03-22 12:42:43', 'live'),
(23, 'TIMELINE_EVENT_UPDATE', 'updated', 1, '2013-03-22 14:37:46', '2013-03-24 23:53:56', 'live'),
(24, 'TIMELINE_EVENT_INSERT', 'added', 1, '2013-03-22 14:37:54', '2013-03-22 15:04:09', 'live'),
(25, 'TIMELINE_PERIOD_NIGHT', 'Instead of sleeping', 1, '2013-03-22 15:11:45', '2013-03-22 15:11:45', 'live'),
(26, 'TIMELINE_PERIOD_DUSK', 'After diner', 1, '2013-03-22 15:12:02', '2013-03-22 15:12:02', 'live'),
(27, 'TIMELINE_PERIOD_EVENING', 'This evening', 1, '2013-03-22 15:12:36', '2013-03-22 15:16:15', 'live'),
(28, 'TIMELINE_PERIOD_AFTERNOON', 'This afternoon', 1, '2013-03-22 15:13:13', '2013-03-22 15:13:13', 'live'),
(29, 'TIMELINE_PERIOD_NOON', 'At lunchtime', 1, '2013-03-22 15:13:50', '2013-03-22 15:13:50', 'live'),
(30, 'TIMELINE_PERIOD_MORNING', 'This morning', 1, '2013-03-22 15:14:25', '2013-03-22 15:14:25', 'live'),
(31, 'TIMELINE_PERIOD_DAWN', 'At dawn', 1, '2013-03-22 15:14:48', '2013-03-22 15:14:48', 'live'),
(32, 'DATE_NOW', 'Just now', 1, '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live'),
(39, 'FIELD_VALIDATION_ERROR_REQUIRED', 'This field is compulsory', 1, '2013-03-22 17:48:55', '2013-03-22 17:48:55', 'live'),
(54, 'TIMELINE_PERIOD_YESTERDAY_DAWN', 'Yesterday very early', 1, '2013-03-23 19:53:53', '2013-03-23 19:53:53', 'live'),
(55, 'TIMELINE_PERIOD_YESTERDAY_MORNING', 'Yesterday morning', 1, '2013-03-23 19:54:03', '2013-03-23 19:54:03', 'live'),
(56, 'TIMELINE_PERIOD_YESTERDAY_NOON', 'Yesterday at noon', 1, '2013-03-23 19:54:28', '2013-03-23 19:54:28', 'live'),
(57, 'TIMELINE_PERIOD_YESTERDAY_AFTERNOON', 'Yesterday afternoon', 1, '2013-03-23 19:54:39', '2013-03-23 19:54:39', 'live'),
(58, 'TIMELINE_PERIOD_YESTERDAY_EVENING', 'Yesterday evening', 1, '2013-03-23 19:54:46', '2013-03-23 19:54:46', 'live'),
(59, 'TIMELINE_PERIOD_YESTERDAY_DUSK', 'Yesterday quite late', 1, '2013-03-23 19:55:04', '2013-03-23 19:55:04', 'live'),
(60, 'TIMELINE_PERIOD_YESTERDAY_NIGHT', 'Yesterday night', 1, '2013-03-23 19:55:14', '2013-03-23 19:55:14', 'live'),
(61, 'TIMELINE_EVENT_DELETE', 'deleted', 1, '2013-04-05 16:02:39', '2013-04-05 16:02:39', 'live'),
(62, 'TABS_PAGE_SYSTEM_TITLE', 'System pages & APIs', 1, '2013-10-13 14:24:37', '2013-10-13 14:24:37', 'live'),
(63, 'TABS_PAGE_TREE_TITLE', 'The site tree', 1, '2013-10-13 14:31:21', '2013-10-13 14:31:21', 'live'),
(64, 'ITEM_PAGE_TITLE', 'The Site Tree', 1, '2013-10-14 01:28:04', '2013-10-14 01:29:34', 'live'),
(65, 'NAV_SUB_H1_STRUCTURE', 'A little bit of structure', 1, '2013-10-14 10:38:30', '2013-10-14 10:38:30', 'live'),
(66, 'NAV_SUB_H1_SUPPORT', 'Support & Documentation', 1, '2013-10-14 10:39:21', '2013-10-14 10:39:21', 'live'),
(67, 'NAV_SUB_H1_SYSTEM', 'Part of the system', 1, '2013-10-14 10:40:20', '2013-10-14 10:40:20', 'live'),
(68, 'APPINI_H2_ABOUT', 'About this App', 1, '2013-10-19 14:33:38', '2013-10-19 14:33:38', 'live'),
(69, 'APPINI_H2_DEPENDENCIES', 'Dependencies', 1, '2013-10-19 14:35:59', '2013-10-19 14:35:59', 'live'),
(70, 'APPINI_H2_REQUIREMENTS', 'Requirements', 1, '2013-10-19 14:36:24', '2013-10-19 14:36:24', 'live'),
(71, 'APPINI_H2_SYSTEM', 'System files', 1, '2013-10-19 14:36:44', '2013-10-19 14:36:44', 'live'),
(72, 'APPINI_H3_TITLE', 'Name', 1, '2013-10-19 14:37:13', '2013-10-19 14:37:13', 'live'),
(73, 'APPINI_H3_DESCRIPTION', 'Description', 1, '2013-10-19 14:37:32', '2013-10-19 14:37:32', 'live'),
(74, 'APPINI_H3_V', 'Version', 1, '2013-10-19 14:37:51', '2013-10-19 14:37:51', 'live'),
(75, 'APPINI_H3_V_DESCR', 'About this version', 1, '2013-10-19 14:38:19', '2013-10-19 14:43:48', 'live'),
(76, 'APPINI_H3_AUTHOR', 'Author(s)', 1, '2013-10-19 14:47:26', '2013-10-19 14:53:32', 'live'),
(77, 'APPINI_H3_COMPANY', 'Company', 1, '2013-10-19 14:55:23', '2013-10-19 14:55:23', 'live'),
(78, 'APPINI_H3_COMPANY_DESCR', 'About this company', 1, '2013-10-19 14:55:57', '2013-10-19 14:55:57', 'live'),
(79, 'APPINI_H3_URL', 'URL', 1, '2013-10-19 14:56:19', '2013-10-19 14:56:19', 'live'),
(80, 'APPINI_H3_GC', 'Grand Central', 1, '2013-10-19 14:57:23', '2013-10-19 14:57:23', 'live'),
(81, 'APPINI_H3_PHP', 'PHP', 1, '2013-10-19 14:57:34', '2013-10-19 14:57:34', 'live'),
(82, 'APPINI_H3_MYSQL', 'MySQL', 1, '2013-10-19 14:57:45', '2013-10-19 14:57:45', 'live'),
(83, 'APPINI_H3_CREDIT', 'Credits', 1, '2013-10-19 15:14:10', '2013-10-19 15:14:10', 'live'),
(84, 'APPINI_H3_LICENCE', 'Licence', 1, '2013-10-19 14:56:19', '2013-10-19 14:56:19', 'live'),
(85, 'OPTIONS_FILTERS_LEGEND_ORDER', 'Reorder by', 1, '2013-10-19 16:12:17', '2013-10-19 16:12:17', 'live'),
(86, 'OPTIONS_FILTERS_LEGEND_DISPLAY', 'Display', 1, '2013-10-19 17:10:19', '2013-10-19 17:10:19', 'live'),
(87, 'OPTIONS_FILTER_SORT_ASC_TITLE', 'From the last one to the first one', 1, '2013-10-19 17:11:31', '2013-10-19 17:11:31', 'live'),
(88, 'OPTIONS_FILTER_SORT_DESC_TITLE', 'From the first one to the last one', 1, '2013-10-19 17:12:22', '2013-10-19 17:12:22', 'live'),
(89, 'OPTIONS_FILTERS_LEGEND_SORT', 'Sort', 1, '2013-10-19 17:10:19', '2013-10-19 17:10:19', 'live'),
(90, 'OPTIONS_FILTER_DISPLAY_INSTACK_TITLE', 'In stacks', 1, '2013-10-19 17:13:55', '2013-10-19 17:13:55', 'live'),
(91, 'OPTIONS_FILTER_DISPLAY_INMASONRY_TITLE', 'In masonry', 1, '2013-10-19 17:14:59', '2013-10-19 17:14:59', 'live'),
(92, 'APPINI_H3_JQUERY', 'jQuery', 1, '2013-10-25 12:59:07', '2013-10-25 12:59:07', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Template',
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Action / routine',
  `method` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Method',
  `target` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Target',
  `enctype` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Enctype',
  `field` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The fields',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `system` tinyint(1) NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `system` (`system`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=104 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `system`, `status`) VALUES
(1, 'login', 'Login', '', 'login', 'login', 'post', '', '', '{"login":{"type":"text","key":"login","label":"Login","placeholder":"Your login","required":true},"password":{"type":"password","key":"password","label":"Password","placeholder":"Password","required":true},"save":{"type":"button","buttontype":"submit","key":"save","value":"submit"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, ''),
(66, 'mm_parution', 'mm_parution', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"descr":{"key":"descr","label":"Description","type":"text","required":"0","min":"","max":""},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Text","type":"text","required":"0","min":"","max":""}}', '2013-10-23 16:39:32', '2013-10-23 19:26:41', 0, 'live'),
(67, 'mm_seminaire', 'mm_seminaire', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"date":{"key":"date","label":"Date","type":"text","required":"0"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"descr":{"key":"descr","label":"Courte description","type":"text","required":"0","min":"","max":""},"text":{"key":"text","label":"Long texte","type":"text","required":"0","min":"","max":""},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""}}', '2013-10-23 16:40:53', '2013-10-28 08:21:29', 0, 'live'),
(68, 'mm_structure', 'mm_structure', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool"}}', '2013-10-23 16:43:34', '2013-10-23 16:43:34', 0, 'live'),
(69, 'mm_page', 'mm_page', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-10-23 18:24:47', '2013-11-08 12:24:39', 0, 'live'),
(70, 'mm_article', 'mm_article', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-10-23 21:24:01', '2013-11-08 18:19:37', 0, 'live'),
(72, 'mm_group', 'mm_group', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"admin":{"key":"admin","label":"admin","type":"bool"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-25 00:21:48', '2013-10-25 00:21:48', 0, 'live'),
(73, 'mm_version', 'mm_version', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"lang":{"key":"lang","label":"Language","type":"text","required":"1","min":"0","max":"32"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-25 00:25:10', '2013-10-25 00:25:10', 0, 'live'),
(74, 'admin_const', 'admin_const', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"text","required":"1","min":"","max":""},"version":{"key":"version","label":"Version","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-25 12:58:52', '2013-10-25 12:58:52', 1, 'live'),
(75, 'mm_human', 'mm_human', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea"},"password":{"key":"password","label":"Password","type":"password"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","min":"","max":""}}', '2013-10-28 08:15:44', '2013-10-28 08:15:44', 0, 'live'),
(76, 'admin_structure', 'admin_structure', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool"}}', '2013-10-28 10:39:22', '2013-10-28 10:39:22', 1, 'live'),
(77, 'admin_greenbutton', 'admin_greenbutton', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"icon":{"key":"icon","label":"Icon","type":"text","required":"0","min":"","max":""}}', '2013-10-28 10:39:38', '2013-10-28 10:39:38', 1, 'live'),
(78, 'admin_section', 'admin_section', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"greenbutton":{"key":"greenbutton","label":"greenbutton","valuestype":"bunch","values":[{"item":"greenbutton"}],"type":"multipleselect","min":"","max":""}}', '2013-10-28 10:40:03', '2013-10-28 10:40:03', 1, 'live'),
(79, 'mm_section', 'mm_section', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-28 12:17:45', '2013-10-28 12:17:45', 0, 'live'),
(80, 'admin_page', 'admin_page', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"text":{"key":"text","label":"The text content","type":"textarea","min":"0","max":"65035"},"url":{"key":"url","label":"The url","type":"text","required":"1","min":"0","max":"255"},"system":{"key":"system","label":"System","type":"bool"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","min":"","max":""},"section":{"key":"section","label":"section","valuestype":"bunch","values":{"1":{"item":"section"}},"type":"multipleselect","min":"","max":""},"sectiondefault":{"key":"sectiondefault","label":"sectiondefault","valuestype":"bunch","values":{"1":{"item":"section"}},"type":"multipleselect","min":"","max":""}}', '2013-10-28 12:20:02', '2013-10-28 12:20:02', 1, 'live'),
(81, 'admin_human', 'admin_human', '', 'default', 'item', 'post', '', '', '', '2013-10-28 21:08:52', '2013-10-28 21:08:52', 1, 'live'),
(82, 'admin_version', 'admin_version', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"lang":{"key":"lang","label":"Language","type":"text","required":"1","min":"0","max":"32"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-28 21:09:04', '2013-10-28 21:09:04', 1, 'live'),
(83, 'mm_note', 'mm_note', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"descr":{"key":"descr","label":"Desciption","type":"text","required":"1","min":"","max":""},"item":{"key":"item","label":"Item","type":"text","required":"1","min":"","max":""},"Itemid":{"key":"Itemid","label":"Item id","type":"number","required":"1","min":"","max":""},"key":{"key":"key","label":"The key","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-10-28 21:45:55', '2013-10-28 21:45:55', 0, 'live'),
(85, 'mm_livre', 'mm_livre', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"}}', '2013-10-30 13:38:35', '2013-10-30 14:59:55', 0, 'live'),
(86, 'souvenoir_structure', 'souvenoir_structure', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-30 15:40:20', '2013-11-02 13:56:40', 0, 'live'),
(87, 'souvenoir_section', 'souvenoir_section', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","required":"0","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-30 15:44:50', '2013-11-04 15:55:30', 0, 'live'),
(88, 'souvenoir_site', 'souvenoir_site', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number"}}', '2013-10-30 16:04:14', '2013-10-30 16:04:14', 0, 'live'),
(89, 'souvenoir_people', 'souvenoir_people', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"url":{"key":"url","label":"Url","type":"text"}}', '2013-10-30 16:43:50', '2013-11-02 16:41:46', 0, 'live'),
(90, 'souvenoir_photo', 'souvenoir_photo', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"photo":{"key":"photo","label":"Photos","type":"media","required":"0","min":"","max":""},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"5000"},"text":{"key":"text","label":"Text","type":"sirtrevor","required":"0"},"ref":{"key":"ref","label":"Ref","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"people":{"key":"people","label":"People","valuestype":"bunch","values":[{"item":"people"}],"type":"multipleselect","required":"0"},"timestamp":{"key":"timestamp","label":"Timestamp","type":"text","required":"0"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"location":{"key":"location","label":"Location","valuestype":"bunch","values":[{"item":"place"}],"type":"multipleselect","required":"0"},"format":{"key":"format","label":"Formats for sell","valuestype":"bunch","values":{"1":{"item":"format"}},"type":"multipleselect","required":"0"}}', '2013-10-30 18:37:53', '2013-11-03 13:52:28', 0, 'live'),
(91, 'souvenoir_page', 'souvenoir_page', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-30 23:41:50', '2013-11-01 01:29:09', 0, 'live'),
(92, 'miranda_structure', 'miranda_structure', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-10-31 12:54:30', '2013-10-31 12:57:35', 0, 'live'),
(93, 'souvenoir_format', 'souvenoir_format', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"price":{"key":"price","label":"Price","type":"text","required":"0"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"}}', '2013-11-02 18:48:15', '2013-11-02 18:50:01', 0, 'live'),
(94, 'souvenoir_place', 'souvenoir_place', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Name","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"}}', '2013-11-05 00:56:09', '2013-11-05 00:56:09', 0, 'live'),
(95, 'miranda_cast', 'miranda_cast', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Cast title","type":"text","required":"1","min":"","max":""},"descr":{"key":"descr","label":"Description","type":"text","min":"","max":""},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"lat":{"key":"lat","label":"Latitude","type":"text","required":"1","min":"","max":""},"lng":{"key":"lng","label":"Longitude","type":"text","required":"1","min":"","max":""},"address":{"key":"address","label":"Address","type":"text","min":"","max":""},"report":{"key":"report","label":"Report","type":"text","min":"","max":""},"locastid":{"key":"locastid","label":"ID in Locast (for sync)","type":"number","min":"","max":""},"significativity":{"key":"significativity","label":"Significativity","type":"array"},"media":{"key":"media","label":"Media","type":"media"},"version":{"key":"version","label":"Version","type":"text"},"map":{"key":"map","label":"map","valuestype":"bunch","values":[{"item":"map"}],"type":"multipleselect","min":"","max":""},"casttype":{"key":"casttype","label":"casttype","valuestype":"bunch","values":[{"item":"casttype"}],"type":"multipleselect","min":"","max":""},"typology":{"key":"typology","label":"typology","valuestype":"bunch","values":[{"item":"typology"}],"type":"multipleselect","min":"","max":""},"author":{"key":"author","label":"author","valuestype":"bunch","values":{"1":{"item":"human"}},"type":"select","required":"1","min":"1","max":"1"},"url":{"key":"url","label":"url","type":"text"}}', '2013-11-06 13:25:23', '2013-11-06 13:25:23', 0, 'live'),
(96, 'souvenoir_human', 'souvenoir_human', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea"},"password":{"key":"password","label":"Password","type":"password"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","min":"","max":""}}', '2013-11-07 00:22:53', '2013-11-07 00:22:53', 0, 'live'),
(97, 'miranda_const', 'miranda_const', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Title","type":"textarea","required":"1","min":"0","max":"5000"},"version":{"key":"version","label":"version","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-11-13 18:51:21', '2013-11-13 18:51:21', 0, 'live'),
(98, 'miranda_page', 'miranda_page', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"array"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"text":{"key":"text","label":"The text content","type":"textarea","required":"0","min":"0","max":"65035"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2013-11-13 19:15:40', '2013-11-13 19:15:40', 0, 'live'),
(99, 'miranda_api', 'miranda_api', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"API name","type":"textarea","required":"1","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2013-11-14 14:47:37', '2013-11-15 01:23:04', 0, 'live'),
(100, 'miranda_section', 'miranda_section', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"Version","type":"text"}}', '2013-11-14 14:50:36', '2013-11-14 14:50:36', 0, 'live'),
(101, 'miranda_human', 'miranda_human', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"5000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"},"company":{"key":"company","label":"Company","valuestype":"bunch","values":{"1":{"item":"company"}},"type":"multipleselect","required":"0"}}', '2013-11-15 15:25:07', '2013-11-15 15:39:00', 0, 'live'),
(102, 'miranda_company', 'miranda_company', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"5000"},"key":{"key":"key","label":"The key","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"map":{"key":"map","label":"Maps","valuestype":"bunch","values":{"1":{"item":"map"}},"type":"multipleselect","required":"0"}}', '2013-11-15 15:35:53', '2013-11-15 15:41:54', 0, 'live'),
(103, 'miranda_map', 'miranda_map', '', 'default', 'item', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Cast title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"company":{"key":"company","label":"Company","valuestype":"bunch","values":{"1":{"item":"company"}},"type":"multipleselect","required":"1"}}', '2013-11-15 15:37:31', '2013-11-15 15:37:31', 0, 'live');

-- --------------------------------------------------------

--
-- Table structure for table `greenbutton`
--

CREATE TABLE `greenbutton` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `greenbutton`
--

INSERT INTO `greenbutton` (`id`, `key`, `title`, `created`, `updated`, `status`, `icon`) VALUES
(1, 'save', 'Save', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', ''),
(2, 'asleep', 'Go asleep', '0000-00-00 00:00:00', '2013-02-07 06:45:11', 'live', ''),
(3, 'new', 'New', '0000-00-00 00:00:00', '2013-05-01 21:46:43', 'live', ''),
(4, 'save_reach', 'Save & reach', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', ''),
(5, 'save_copy', 'Save as a copy', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', ''),
(6, 'save_new', 'Save & start anew', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', ''),
(7, 'trash', 'Move to trash', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', ''),
(8, 'live', 'Go live', '0000-00-00 00:00:00', '2013-02-07 06:31:35', 'live', ''),
(9, 'workflow', 'Put back in the workflow', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', ''),
(10, 'buildapp', 'Build a new App!', '2013-03-22 08:57:22', '2013-10-20 22:53:27', 'live', ''),
(11, 'newpage', 'Add a page to the sitetree', '2013-10-23 02:14:09', '2013-10-23 02:14:09', 'live', ''),
(12, 'preview', 'Preview', '2013-10-28 10:39:50', '2013-10-28 10:39:50', 'live', '');

-- --------------------------------------------------------

--
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `subject` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Subject',
  `subjectid` mediumint(3) unsigned NOT NULL COMMENT 'Subject ID',
  `item` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Object',
  `itemid` mediumint(3) unsigned NOT NULL COMMENT 'Object id',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `key` (`key`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=91 ;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`id`, `key`, `subject`, `subjectid`, `item`, `itemid`, `created`, `updated`, `status`) VALUES
(1, 'insert', 'human', 23, 'form', 26, '2013-10-12 21:57:21', '2013-10-12 21:57:21', 'live'),
(2, 'update', 'human', 23, 'page', 6, '2013-10-12 22:01:52', '2013-10-12 22:01:52', 'live'),
(3, 'update', 'human', 2, 'page', 5, '2013-10-13 01:05:53', '2013-10-13 01:05:53', 'live'),
(4, 'insert', 'human', 2, 'form', 28, '2013-10-13 01:11:44', '2013-10-13 01:11:44', 'live'),
(5, 'update', 'human', 2, 'page', 6, '2013-10-13 02:28:37', '2013-10-13 02:28:37', 'live'),
(6, 'update', 'human', 2, 'page', 5, '2013-10-13 14:07:18', '2013-10-13 14:07:18', 'live'),
(7, 'update', 'human', 2, 'page', 5, '2013-10-13 14:08:20', '2013-10-13 14:08:20', 'live'),
(8, 'insert', 'human', 2, 'form', 30, '2013-10-13 14:22:05', '2013-10-13 14:22:05', 'live'),
(9, 'insert', 'human', 2, 'const', 62, '2013-10-13 14:24:37', '2013-10-13 14:24:37', 'live'),
(10, 'update', 'human', 2, 'page', 5, '2013-10-13 14:30:17', '2013-10-13 14:30:17', 'live'),
(11, 'insert', 'human', 2, 'const', 63, '2013-10-13 14:31:21', '2013-10-13 14:31:21', 'live'),
(12, 'update', 'human', 2, 'page', 1, '2013-10-13 14:37:01', '2013-10-13 14:37:01', 'live'),
(13, 'update', 'human', 2, 'page', 1, '2013-10-13 14:38:17', '2013-10-13 14:38:17', 'live'),
(14, 'update', 'human', 2, 'page', 1, '2013-10-13 14:49:26', '2013-10-13 14:49:26', 'live'),
(15, 'insert', 'human', 2, 'form', 31, '2013-10-13 15:58:26', '2013-10-13 15:58:26', 'live'),
(16, 'insert', 'human', 2, 'form', 32, '2013-10-13 15:58:44', '2013-10-13 15:58:44', 'live'),
(17, 'update', 'human', 2, 'page', 1, '2013-10-13 16:06:11', '2013-10-13 16:06:11', 'live'),
(18, 'insert', 'human', 2, 'const', 64, '2013-10-14 01:28:04', '2013-10-14 01:28:04', 'live'),
(19, 'update', 'human', 2, 'const', 64, '2013-10-14 01:29:34', '2013-10-14 01:29:34', 'live'),
(20, 'insert', 'human', 2, 'const', 65, '2013-10-14 10:38:30', '2013-10-14 10:38:30', 'live'),
(21, 'insert', 'human', 2, 'const', 66, '2013-10-14 10:39:21', '2013-10-14 10:39:21', 'live'),
(22, 'insert', 'human', 2, 'const', 67, '2013-10-14 10:40:20', '2013-10-14 10:40:20', 'live'),
(23, 'update', 'human', 2, 'page', 7, '2013-10-14 13:11:22', '2013-10-14 13:11:22', 'live'),
(24, 'update', 'human', 2, 'page', 7, '2013-10-14 13:11:59', '2013-10-14 13:11:59', 'live'),
(25, 'update', 'human', 2, 'page', 6, '2013-10-16 12:24:29', '2013-10-16 12:24:29', 'live'),
(26, 'update', 'human', 2, 'section', 2, '2013-10-16 14:52:08', '2013-10-16 14:52:08', 'live'),
(27, 'update', 'human', 2, 'section', 2, '2013-10-16 17:50:46', '2013-10-16 17:50:46', 'live'),
(28, 'update', 'human', 2, 'section', 2, '2013-10-16 17:51:20', '2013-10-16 17:51:20', 'live'),
(29, 'update', 'human', 2, 'section', 2, '2013-10-16 17:52:16', '2013-10-16 17:52:16', 'live'),
(30, 'update', 'human', 2, 'page', 11, '2013-10-18 18:40:46', '2013-10-18 18:40:46', 'live'),
(31, 'insert', 'human', 2, 'const', 68, '2013-10-19 14:33:38', '2013-10-19 14:33:38', 'live'),
(32, 'insert', 'human', 2, 'const', 69, '2013-10-19 14:35:54', '2013-10-19 14:35:54', 'live'),
(33, 'update', 'human', 2, 'const', 69, '2013-10-19 14:35:59', '2013-10-19 14:35:59', 'live'),
(34, 'insert', 'human', 2, 'const', 70, '2013-10-19 14:36:24', '2013-10-19 14:36:24', 'live'),
(35, 'insert', 'human', 2, 'const', 71, '2013-10-19 14:36:44', '2013-10-19 14:36:44', 'live'),
(36, 'insert', 'human', 2, 'const', 72, '2013-10-19 14:37:13', '2013-10-19 14:37:13', 'live'),
(37, 'insert', 'human', 2, 'const', 73, '2013-10-19 14:37:32', '2013-10-19 14:37:32', 'live'),
(38, 'insert', 'human', 2, 'const', 74, '2013-10-19 14:37:51', '2013-10-19 14:37:51', 'live'),
(39, 'insert', 'human', 2, 'const', 75, '2013-10-19 14:38:19', '2013-10-19 14:38:19', 'live'),
(40, 'update', 'human', 2, 'const', 75, '2013-10-19 14:41:58', '2013-10-19 14:41:58', 'live'),
(41, 'update', 'human', 2, 'const', 75, '2013-10-19 14:42:04', '2013-10-19 14:42:04', 'live'),
(42, 'update', 'human', 2, 'const', 75, '2013-10-19 14:43:48', '2013-10-19 14:43:48', 'live'),
(43, 'insert', 'human', 2, 'const', 76, '2013-10-19 14:47:26', '2013-10-19 14:47:26', 'live'),
(44, 'update', 'human', 2, 'const', 76, '2013-10-19 14:53:32', '2013-10-19 14:53:32', 'live'),
(45, 'insert', 'human', 2, 'const', 77, '2013-10-19 14:55:23', '2013-10-19 14:55:23', 'live'),
(46, 'insert', 'human', 2, 'const', 78, '2013-10-19 14:55:57', '2013-10-19 14:55:57', 'live'),
(47, 'insert', 'human', 2, 'const', 79, '2013-10-19 14:56:19', '2013-10-19 14:56:19', 'live'),
(48, 'insert', 'human', 2, 'const', 80, '2013-10-19 14:57:23', '2013-10-19 14:57:23', 'live'),
(49, 'insert', 'human', 2, 'const', 81, '2013-10-19 14:57:34', '2013-10-19 14:57:34', 'live'),
(50, 'insert', 'human', 2, 'const', 82, '2013-10-19 14:57:45', '2013-10-19 14:57:45', 'live'),
(51, 'insert', 'human', 2, 'const', 83, '2013-10-19 15:14:10', '2013-10-19 15:14:10', 'live'),
(52, 'insert', 'human', 2, 'form', 35, '2013-10-19 15:27:03', '2013-10-19 15:27:03', 'live'),
(53, 'update', 'human', 2, 'page', 10, '2013-10-19 15:27:46', '2013-10-19 15:27:46', 'live'),
(54, 'update', 'human', 2, 'page', 5, '2013-10-19 15:28:26', '2013-10-19 15:28:26', 'live'),
(55, 'update', 'human', 2, 'page', 6, '2013-10-19 15:32:08', '2013-10-19 15:32:08', 'live'),
(56, 'insert', 'human', 2, 'form', 36, '2013-10-19 15:37:25', '2013-10-19 15:37:25', 'live'),
(57, 'insert', 'human', 2, 'const', 85, '2013-10-19 16:12:13', '2013-10-19 16:12:13', 'live'),
(58, 'update', 'human', 2, 'const', 85, '2013-10-19 16:12:17', '2013-10-19 16:12:17', 'live'),
(59, 'insert', 'human', 2, 'const', 86, '2013-10-19 16:13:06', '2013-10-19 16:13:06', 'live'),
(60, 'update', 'human', 2, 'const', 86, '2013-10-19 17:10:19', '2013-10-19 17:10:19', 'live'),
(61, 'insert', 'human', 2, 'const', 87, '2013-10-19 17:11:31', '2013-10-19 17:11:31', 'live'),
(62, 'insert', 'human', 2, 'const', 88, '2013-10-19 17:12:22', '2013-10-19 17:12:22', 'live'),
(63, 'insert', 'human', 2, 'const', 90, '2013-10-19 17:13:55', '2013-10-19 17:13:55', 'live'),
(64, 'insert', 'human', 2, 'const', 91, '2013-10-19 17:14:59', '2013-10-19 17:14:59', 'live'),
(65, 'update', 'human', 2, 'page', 11, '2013-10-20 22:50:45', '2013-10-20 22:50:45', 'live'),
(66, 'update', 'human', 2, 'section', 4, '2013-10-20 22:52:03', '2013-10-20 22:52:03', 'live'),
(67, 'update', 'human', 2, 'section', 20, '2013-10-20 22:53:07', '2013-10-20 22:53:07', 'live'),
(68, 'insert', 'human', 2, 'form', 38, '2013-10-20 22:53:20', '2013-10-20 22:53:20', 'live'),
(69, 'update', 'human', 2, 'greenbutton', 10, '2013-10-20 22:53:27', '2013-10-20 22:53:27', 'live'),
(70, 'insert', 'human', 2, 'version', 2, '2013-10-20 22:53:53', '2013-10-20 22:53:53', 'live'),
(71, 'insert', 'human', 2, 'structure', 10, '2013-10-20 22:59:08', '2013-10-20 22:59:08', 'live'),
(72, 'update', 'human', 2, 'structure', 10, '2013-10-20 23:01:39', '2013-10-20 23:01:39', 'live'),
(73, 'insert', 'human', 2, 'form', 39, '2013-10-20 23:02:25', '2013-10-20 23:02:25', 'live'),
(74, 'insert', 'human', 2, 'form', 64, '2013-10-23 02:13:41', '2013-10-23 02:13:41', 'live'),
(75, 'insert', 'human', 2, 'greenbutton', 11, '2013-10-23 02:14:09', '2013-10-23 02:14:09', 'live'),
(76, 'insert', 'human', 2, 'form', 65, '2013-10-23 02:14:26', '2013-10-23 02:14:26', 'live'),
(77, 'update', 'human', 2, 'section', 10, '2013-10-23 02:14:52', '2013-10-23 02:14:52', 'live'),
(78, 'insert', 'human', 2, 'form', 74, '2013-10-25 12:58:52', '2013-10-25 12:58:52', 'live'),
(79, 'insert', 'human', 2, 'const', 92, '2013-10-25 12:59:07', '2013-10-25 12:59:07', 'live'),
(80, 'insert', 'human', 2, 'form', 76, '2013-10-28 10:39:22', '2013-10-28 10:39:22', 'live'),
(81, 'update', 'human', 2, 'structure', 8, '2013-10-28 10:39:28', '2013-10-28 10:39:28', 'live'),
(82, 'insert', 'human', 2, 'form', 77, '2013-10-28 10:39:38', '2013-10-28 10:39:38', 'live'),
(83, 'insert', 'human', 2, 'greenbutton', 12, '2013-10-28 10:39:50', '2013-10-28 10:39:50', 'live'),
(84, 'insert', 'human', 2, 'form', 78, '2013-10-28 10:40:03', '2013-10-28 10:40:03', 'live'),
(85, 'update', 'human', 2, 'section', 2, '2013-10-28 10:40:15', '2013-10-28 10:40:15', 'live'),
(86, 'insert', 'human', 2, 'form', 80, '2013-10-28 12:20:02', '2013-10-28 12:20:02', 'live'),
(87, 'update', 'human', 2, 'page', 5, '2013-10-28 21:08:27', '2013-10-28 21:08:27', 'live'),
(88, 'insert', 'human', 2, 'form', 81, '2013-10-28 21:08:52', '2013-10-28 21:08:52', 'live'),
(89, 'insert', 'human', 2, 'form', 82, '2013-10-28 21:09:04', '2013-10-28 21:09:04', 'live'),
(90, 'insert', 'human', 2, 'section', 29, '2013-11-05 15:34:51', '2013-11-05 15:34:51', 'live');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `itemid` mediumint(3) unsigned NOT NULL,
  `content` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `text` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The text content',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The url',
  `system` tinyint(1) NOT NULL COMMENT 'System',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `type`, `descr`, `text`, `url`, `system`, `created`, `updated`, `status`) VALUES
(1, 'home', 'Digest', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', 'Welcome home', '', '/', 0, '2013-10-03 08:28:48', '2013-10-13 16:06:11', 'live'),
(2, 'error_404', 'Oups, that 404 thing again!', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', '', '', '/404', 1, '0000-00-00 00:00:00', '2013-08-26 01:28:27', 'live'),
(3, 'post', 'Routine points', '{"key":"content","http_status":"200 OK","content_type":"routine","master":"post"}', 'Receives all the posts from the forms.', '', '/routine', 1, '0000-00-00 00:00:00', '2013-08-25 19:33:38', 'live'),
(5, 'list', 'List', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', '', '', '/list', 0, '2013-10-13 01:05:53', '2013-10-28 21:08:27', 'live'),
(6, 'edit', 'Edit', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', '', '', '/edit', 0, '2013-10-12 22:01:52', '2013-10-19 15:32:08', 'live'),
(7, 'doc', 'Doc', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', 'About classes, methods and functions available to you, kind developer.', '', '/doc', 0, '2013-10-14 13:11:22', '2013-10-14 13:11:59', 'live'),
(9, 'env', 'Environment', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', 'Structure', '', '/site', 0, '0000-00-00 00:00:00', '2013-08-30 01:19:18', 'live'),
(10, 'item', 'Content', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', 'Publish', '', '/item', 0, '2013-10-19 15:27:46', '2013-10-19 15:27:46', 'live'),
(11, 'app', 'Apps', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', 'Tweak', '', '/app', 0, '2013-10-18 18:40:46', '2013-10-20 22:50:45', 'live'),
(12, 'social', 'Socialise', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', 'Chinwag', '', '/social', 0, '0000-00-00 00:00:00', '2013-03-10 23:03:28', 'live'),
(29, 'logbook', 'Logbook', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', '', '', '/logbook', 0, '0000-00-00 00:00:00', '2013-03-06 06:21:38', 'live'),
(30, 'login', 'Login', '{"key":"content","http_status":"200 OK","content_type":"html","master":"login"}', '', '', '/login', 1, '2013-10-03 04:16:31', '2013-10-03 04:16:31', 'live'),
(31, 'api.json', 'API (json)', '{"key":"content","http_status":"200 OK","content_type":"json","master":"api"}', '', '', '/api.json', 1, '2013-03-06 03:21:46', '2013-03-22 12:56:52', 'live'),
(32, 'me', 'My profile', '{"key":"content","http_status":"200 OK","content_type":"html","master":"master"}', 'dfsdf', '', '/me', 0, '0000-00-00 00:00:00', '2013-03-13 14:04:08', 'live'),
(33, 'api.eventstream', 'API (event-stream)', '{"key":"content","http_status":"200 OK","content_type":"eventstream","master":"api"}', '', '', '/api.eventstream', 1, '2013-03-06 03:21:46', '2013-03-22 13:22:05', 'live'),
(35, 'ajax.html', 'AJAX (hmtl)', '{"key":"content","http_status":"200 OK","content_type":"html","master":"ajax"}', '', '', '/ajax.html', 1, '2013-03-06 03:21:46', '2013-03-22 13:22:05', 'live'),
(36, 'ajax.json', 'AJAX (json)', '{"key":"content","http_status":"200 OK","content_type":"json","master":"ajax"}', '', '', '/ajax.json', 1, '2013-03-06 03:21:46', '2013-03-22 12:56:52', 'live');

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
  `app` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'The template',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `key`, `title`, `descr`, `zone`, `app`, `created`, `updated`, `status`) VALUES
(1, 'live', 'Live', 'General form', 'content', '{"key":"content","template":"list/list", "param":{"status":"live", "system":false}}', '0000-00-00 00:00:00', '2013-04-02 14:02:45', 'live'),
(2, 'edit', 'Edit', 'General form', 'content', '{"key":"content","template":"edit\\/edit"}', '2013-10-16 14:52:08', '2013-10-28 10:40:15', 'live'),
(3, 'php', 'PHP classes, methods & functions', 'lorem Lorem ipsum', 'content', '{"key":"content","template":"doc/code"}', '0000-00-00 00:00:00', '2013-08-30 01:16:18', 'live'),
(4, 'doc', 'Documentation', '', 'content', '{"key":"content","template":"doc\\/doc"}', '2013-10-20 22:52:03', '2013-10-20 22:52:03', 'live'),
(5, 'splash', 'Ressource not found', 'Lorem ipsum', 'content', '{"key":"content","template":"error/error"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(6, 'system', 'System', '', 'content', '{"key":"content","template":"list/list", "param":{"system":true}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live'),
(7, 'asleep', 'Asleep', '', 'content', '{"key":"content","template":"list/list", "param":{"status":"asleep"}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live'),
(8, 'draft', 'Drafts', '', 'content', '{"key":"content","template":"list/list", "param":{"status":"draft"}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live'),
(9, 'timeline', 'Timeline', 'Lorem ipsum', 'content', '{"key":"content","template":"timeline/timeline"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(10, 'tree', 'Site tree', 'Lorem ipsum', 'content', '{"key":"content","template":"tree\\/tree"}', '2013-10-23 02:14:52', '2013-10-23 02:14:52', 'live'),
(17, 'zoning', 'Zoning', 'Zoning', 'content', '{"key":"content","template":"zoning/zoning"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live'),
(19, 'appstore', 'App store', '', 'content', '{"key":"content","template":"appmanager/appmanager"}', '0000-00-00 00:00:00', '2013-03-22 08:58:52', 'live'),
(20, 'appini', 'About this app', '', 'content', '{"key":"content","template":"appini\\/appini"}', '2013-10-20 22:53:07', '2013-10-20 22:53:07', 'live'),
(21, 'appconfig', 'Config', '', 'content', '{"key":"content","template":"appconfig/appconfig"}', '0000-00-00 00:00:00', '2013-02-01 02:05:55', 'live'),
(25, 'carousel_test', 'Carousel de test', '', 'content', '{"key":"jquery_carousel","template":"jquery_carousel","param":{"direction":"horizontal","autoSlideInterval":"3000","dispItems":"1","paginationPosition":"inside","nextBtn":"<span>next<\\/span>","prevBtn":"<span>previous<\\/span>","btnsPosition":"inside","nextBtnInsert":"appendTo","prevBtnInsert":"prependTo","delayAutoSlide":"0","effect":"slide","slideEasing":"swing","animSpeed":"normal"}}', '2013-02-08 10:22:45', '2013-02-08 10:22:45', 'live'),
(27, 'notes', 'Discussion', '', 'content', '{"key":"content","template":"notes/notes"}', '2013-03-11 01:20:51', '2013-04-02 13:10:52', 'live'),
(28, 'login', 'Login Form', '', 'site', '{"key":"form","template":"login","param":{"key":"login"}}', '2013-04-07 15:55:22', '2013-04-07 15:55:22', 'live'),
(29, 'edit', 'Edit', 'General form', 'content', '{"key":"content"}', '2013-10-16 14:52:08', '2013-11-05 15:34:51', 'live');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`) VALUES
(1, 'admin', 'Grand Central', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1),
(2, '1fec3e33e08e0451b6374cc50ebdbf1b', '', '2013-11-05 18:29:02', '2013-11-05 18:29:02', 'trash', 0);

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
  `hasurl` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `structure`
--

INSERT INTO `structure` (`id`, `key`, `title`, `descr`, `system`, `attr`, `created`, `updated`, `status`, `hasurl`) VALUES
(1, 'structure', 'Structures', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"system":{"key":"system","title":"Is system","type":"bool"},"attr":{"key":"attr","title":"Attributes","type":"array"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status"},"hasurl":{"key":"hasurl","title":"Has URL","type":"bool"}}', '0000-00-00 00:00:00', '2013-04-05 12:39:48', 'live', 0),
(2, 'site', 'Your websites', 'Manage your website basics, and the apps that will be opened at all time.', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"defaultversion":{"key":"defaultversion","type":"int","title":"Default Version"}}', '0000-00-00 00:00:00', '2013-04-05 12:41:29', 'live', 0),
(3, 'page', 'Pages', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"type":{"key":"type","type":"array"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"text":{"key":"text","type":"string","title":"The text content","min":"0","max":"65035"},"url":{"key":"url","type":"url","title":"The url","min":"0","max":"255","required":"1"},"system":{"key":"system","type":"bool","title":"System"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"child":{"key":"child","param":[{"item":"page"}],"min":"","max":"","type":"rel"},"section":{"key":"section","param":{"1":{"item":"section"}},"min":"","max":"","type":"rel"},"sectiondefault":{"key":"sectiondefault","param":{"1":{"item":"section"}},"min":"","max":"","type":"rel"}}', '0000-00-00 00:00:00', '2013-08-20 18:57:03', 'live', 1),
(4, 'version', 'Versions', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"lang":{"key":"lang","title":"Language","type":"string","min":"0","max":"32","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '0000-00-00 00:00:00', '2013-04-05 12:43:36', 'live', 0),
(5, 'const', 'Text constants', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"version":{"key":"version","title":"Version","type":"version"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(6, 'form', 'Forms', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"template":{"key":"template","type":"string","title":"Template","min":"","max":"","required":"1"},"action":{"key":"action","type":"string","title":"Action","min":"","max":"","required":"1"},"method":{"key":"method","type":"list","option":"post,get","title":"Method","required":"1"},"target":{"key":"target","type":"string","title":"Target"},"enctype":{"key":"enctype","type":"list","option":"application/x-www-form-urlencoded,multipart/form-data","title":"Enctype","required":"1"},"field":{"key":"field","type":"array","title":"The Fields"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"system":{"key":"system","type":"bool","title":"System"},"status":{"key":"status","type":"status","title":"Status"}}', '2013-09-27 08:33:31', '2013-09-27 08:33:31', 'live', 0),
(7, 'section', 'Sections', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"zone":{"key":"zone","type":"string","title":"The zone","min":"0","max":"255"},"app":{"key":"app","type":"array","title":"The template","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"greenbutton":{"key":"greenbutton","param":[{"item":"greenbutton"}],"min":"","max":"","type":"rel"}}', '2013-09-25 08:33:09', '2013-09-25 08:33:09', 'live', 0),
(8, 'greenbutton', 'Green button actions', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","required":"1","min":"0","max":"255"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"icon":{"key":"icon","type":"string","title":"Icon","required":"0","min":"","max":""}}', '2013-09-25 08:33:09', '2013-10-28 10:39:28', 'live', 0),
(9, 'logbook', 'Logbook', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id","min":"0","max":"0","index":"primary","auto_increment":"1"},"key":{"key":"key","title":"The key","type":"key","min":"0","max":"32","required":"1"},"subject":{"key":"subject","title":"Subject","type":"string","min":"","max":""},"subjectid":{"key":"subjectid","title":"Subject ID","type":"int","min":"","max":""},"item":{"key":"item","title":"item","type":"string","min":"","max":""},"itemid":{"key":"itemid","title":"item id","type":"int","min":"","max":""},\r\n"created":{"key":"created","type":"created","title":"Created Datetime"},\r\n"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},\r\n"status":{"key":"status","type":"status","title":"Status"}}', '0000-00-00 00:00:00', '2013-04-05 12:41:29', 'live', 0),
(10, 'note', 'Notes', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"item":{"key":"item","type":"string","title":"Item","required":"1","min":"","max":""},"itemid":{"key":"itemid","type":"int","title":"Item ID","required":"1","min":"","max":""},"content":{"key":"content","type":"string","title":"Content","required":"1","min":"","max":""}}', '2013-10-20 22:59:08', '2013-10-20 23:01:39', 'live', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`) VALUES
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-04-05 17:02:34', 'live'),
(2, 'fr', 'Français', 'fr', '2013-10-20 22:53:53', '2013-10-20 22:53:53', 'live');

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
('page', 1, 'child', 'page', 9, 0),
('page', 1, 'child', 'page', 10, 1),
('page', 1, 'child', 'page', 12, 2),
('page', 1, 'child', 'page', 11, 3),
('page', 1, 'section', 'section', 9, 0),
('page', 7, 'section', 'section', 3, 0),
('page', 7, 'section', 'section', 4, 1),
('section', 1, 'greenbutton', 'greenbutton', 3, 0),
('page', 10, 'child', 'page', 5, 0),
('page', 10, 'child', 'page', 6, 1),
('page', 6, 'section', 'section', 9, 0),
('page', 6, 'section', 'section', 2, 1),
('page', 6, 'section', 'section', 17, 2),
('page', 6, 'section', 'section', 27, 3),
('page', 6, 'sectiondefault', 'section', 2, 0),
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
('page', 5, 'section', 'section', 9, 0),
('page', 5, 'section', 'section', 10, 1),
('page', 5, 'section', 'section', 1, 2),
('page', 5, 'section', 'section', 6, 3),
('page', 5, 'section', 'section', 7, 4),
('page', 5, 'section', 'section', 8, 5),
('page', 5, 'section', 'section', 27, 6),
('page', 5, 'sectiondefault', 'section', 10, 0),
('page', 5, 'sectiondefault', 'section', 1, 1),
('section', 29, 'greenbutton', 'greenbutton', 8, 0),
('section', 29, 'greenbutton', 'greenbutton', 1, 1),
('section', 29, 'greenbutton', 'greenbutton', 2, 2),
('section', 29, 'greenbutton', 'greenbutton', 4, 3),
('section', 29, 'greenbutton', 'greenbutton', 5, 4),
('section', 29, 'greenbutton', 'greenbutton', 12, 5),
('section', 29, 'greenbutton', 'greenbutton', 6, 6),
('section', 29, 'greenbutton', 'greenbutton', 9, 7),
('section', 29, 'greenbutton', 'greenbutton', 7, 8);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
