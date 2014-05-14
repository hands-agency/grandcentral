-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 14 Mai 2014 à 12:28
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ccv4_admin_mvd`
--

-- --------------------------------------------------------

--
-- Structure de la table `const`
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
-- Contenu de la table `const`
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
-- Structure de la table `form`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=159 ;

--
-- Contenu de la table `form`
--

INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `system`, `status`, `owner`) VALUES
(1, 'login', 'Login', '', 'login', 'login', 'post', '', '', '{"login":{"type":"text","key":"login","label":"So. My login is","placeholder":"my email address","required":true},"password":{"type":"password","key":"password","label":"and this is","placeholder":"my password","required":true},"save":{"type":"button","buttontype":"submit","key":"save","value":"Now let me in!"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(141, 'note', 'Notes', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"hidden","readonly":true},"item":{"key":"item","label":"Item","type":"hidden","min":"","max":"","placeholder":"Item"},"text":{"key":"text","label":"Text","type":"textarea","min":"","max":"","placeholder":"A short description"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(146, 'zoning', 'Zoning', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"hidden","readonly":true},"item":{"key":"item","label":"Item","type":"hidden","min":"","max":"","placeholder":"Item"},"section":{"key":"text","label":"Text","type":"zoning","min":"","max":""}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(154, 'tdc_page', 'tdc_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"nav":{"key":"nav","label":"Navigation title","type":"text","required":"0","min":"0","max":"20"},"type":{"key":"type","label":"type","type":"pagetype"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"text":{"key":"text","label":"The text content","type":"textarea","required":"0","min":"0","max":"65035"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"Children","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"Zoning","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"Only for","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"}}', '2014-05-10 15:14:01', '2014-05-10 15:14:01', 0, 'live', 2),
(155, 'tdc_item', 'tdc_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-10 15:48:32', '2014-05-10 15:48:32', 0, 'live', 2),
(156, 'tdc_site', 'tdc_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"},"favicon":{"key":"favicon","label":"Fav icon","type":"media","required":"0","min":"","max":"1"}}', '2014-05-10 16:30:55', '2014-05-10 16:30:55', 0, 'live', 2),
(157, 'tdc_human', 'tdc_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"firstname":{"key":"firstname","label":"First Name","type":"text","required":"0","min":"0","max":"255"},"lastname":{"key":"lastname","label":"Last Name","type":"text","required":"0","min":"0","max":"255"},"title":{"key":"title","label":"A short title","type":"text","required":"0","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"1000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"}}', '2014-05-10 16:36:33', '2014-05-10 17:51:39', 0, 'live', 2),
(158, 'tdc_section', 'tdc_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-10 16:55:32', '2014-05-10 16:55:32', 0, 'live', 2);

-- --------------------------------------------------------

--
-- Structure de la table `greenbutton`
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
-- Contenu de la table `greenbutton`
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
-- Structure de la table `item`
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
-- Contenu de la table `item`
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
-- Structure de la table `logbook`
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
-- Contenu de la table `logbook`
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
-- Structure de la table `note`
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
-- Structure de la table `page`
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
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `type`, `descr`, `text`, `url`, `system`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'home', 'Digest', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', 'Welcome home', '', '/', 0, '2013-10-03 08:28:48', '2014-05-02 15:31:57', 'live', 2),
(2, 'error_404', 'Oups, that 404 thing again!', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', '', '', '/404', 1, '0000-00-00 00:00:00', '2013-08-26 01:28:27', 'live', 0),
(3, 'post', 'Routine points', '{"key":"content","http_status":"200 OK","content_type":"routine","master":{"app":"content","template":"/master/post"}}', 'Receives all the posts from the forms.', '', '/routine', 1, '0000-00-00 00:00:00', '2013-08-25 19:33:38', 'live', 0),
(5, 'list', 'List', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', '', '', '/list', 0, '2013-10-13 01:05:53', '2014-04-25 10:03:37', 'live', 2),
(6, 'edit', 'Edit', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', '', '', '/edit', 0, '2013-10-12 22:01:52', '2014-04-08 03:59:42', 'live', 2),
(7, 'doc', 'Doc', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', 'About classes, methods and functions available to you, kind developer.', '', '/doc', 0, '2013-10-14 13:11:22', '2013-10-14 13:11:59', 'live', 0),
(9, 'site', 'Environment', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', 'Structure', '', '/site', 0, '2014-04-08 19:54:46', '2014-04-08 19:54:46', 'live', 2),
(10, 'content', 'Content', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', 'Publish', '', '/item', 0, '2013-10-19 15:27:46', '2014-04-08 19:54:26', 'live', 2),
(11, 'app', 'Apps', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', 'Tweak', '', '/app', 0, '2013-10-18 18:40:46', '2013-10-20 22:50:45', 'live', 0),
(29, 'logbook', 'Logbook', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', '', '', '/logbook', 0, '0000-00-00 00:00:00', '2013-03-06 06:21:38', 'live', 0),
(30, 'login', 'Login', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/login"}}', '', '', '/login', 1, '2013-10-03 04:16:31', '2013-10-03 04:16:31', 'live', 0),
(31, 'api.json', 'API (json)', '{"key":"content","http_status":"200 OK","content_type":"json","master":{"app":"content","template":"/master/api"}}', '', '', '/api.json', 1, '2013-03-06 03:21:46', '2013-03-22 12:56:52', 'live', 0),
(32, 'me', 'My profile', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', 'dfsdf', '', '/me', 0, '0000-00-00 00:00:00', '2013-03-13 14:04:08', 'live', 0),
(33, 'api.eventstream', 'API (event-stream)', '{"key":"content","http_status":"200 OK","content_type":"eventstream","master":{"app":"content","template":"/master/api"}}', '', '', '/api.eventstream', 1, '2013-03-06 03:21:46', '2013-03-22 13:22:05', 'live', 0),
(35, 'ajax.html', 'AJAX (hmtl)', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/ajax"}}', '', '', '/ajax.html', 1, '2013-03-06 03:21:46', '2013-03-22 13:22:05', 'live', 0),
(36, 'ajax.json', 'AJAX (json)', '{"key":"content","http_status":"200 OK","content_type":"json","master":{"app":"content","template":"/master/ajax"}}', '', '', '/ajax.json', 1, '2013-03-06 03:21:46', '2013-03-22 12:56:52', 'live', 0),
(37, 'lab', 'Lab', '{"key":"content","http_status":"200 OK","content_type":"html","master":{"app":"content","template":"/master/master"}}', '', '', '/lab', 0, '2014-05-02 15:31:57', '2014-05-02 15:36:47', 'live', 2);

-- --------------------------------------------------------

--
-- Structure de la table `section`
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
-- Contenu de la table `section`
--

INSERT INTO `section` (`id`, `key`, `title`, `descr`, `zone`, `app`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'live', 'Live', 'General form', 'content', '{"app":"content","template":"\\/list\\/list", "param":{"status":"live", "system":false}}', '0000-00-00 00:00:00', '2013-04-02 14:02:45', 'live', 0),
(2, 'edit', 'Edit', 'General form', 'content', '{"app":"content","template":"\\/edit\\/edit"}', '2013-10-16 14:52:08', '2013-10-28 10:40:15', 'live', 0),
(3, 'php', 'PHP classes, methods & functions', 'lorem Lorem ipsum', 'content', '{"app":"content","template":"\\/doc\\/code"}', '0000-00-00 00:00:00', '2013-08-30 01:16:18', 'live', 0),
(4, 'doc', 'Documentation', '', 'content', '{"app":"content","template":"\\/doc\\/doc"}', '2013-10-20 22:52:03', '2013-10-20 22:52:03', 'live', 0),
(5, 'splash', 'Ressource not found', 'Lorem ipsum', 'content', '{"app":"content","template":"\\/error\\/error"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(6, 'system', 'System', '', 'content', '{"app":"content","template":"\\/list\\/list", "param":{"system":true}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live', 0),
(7, 'asleep', 'Asleep', '', 'content', '{"app":"content","template":"\\/list\\/list", "param":{"status":"asleep"}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live', 0),
(8, 'draft', 'Drafts', '', 'content', '{"app":"content","template":"\\/list\\/list", "param":{"status":"draft"}}', '2013-02-24 06:33:01', '2013-03-10 19:29:31', 'live', 0),
(9, 'timeline', 'Timeline', 'Lorem ipsum', 'content', '{"app":"content","template":"\\/timeline\\/timeline"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(10, 'tree', 'Site tree', 'Lorem ipsum', 'content', '{"app":"content","template":"\\/tree\\/tree"}', '2013-10-23 02:14:52', '2013-10-23 02:14:52', 'live', 0),
(17, 'zoning', 'Zoning', 'Zoning', 'content', '{"app":"content","template":"\\/zoning\\/zoning"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(19, 'appstore', 'App store', '', 'content', '{"app":"content","template":"\\/appmanager\\/appmanager"}', '0000-00-00 00:00:00', '2013-03-22 08:58:52', 'live', 0),
(20, 'appini', 'About this app', '', 'content', '{"app":"content","template":"\\/appini\\/appini"}', '2013-10-20 22:53:07', '2013-10-20 22:53:07', 'live', 0),
(21, 'appconfig', 'Config', '', 'content', '{"app":"content","template":"\\/appconfig\\/appconfig"}', '0000-00-00 00:00:00', '2013-02-01 02:05:55', 'live', 0),
(25, 'carousel_test', 'Carousel de test', '', 'content', '{"app":"jquery_carousel","template":"\\/jquery_carousel","param":{"direction":"horizontal","autoSlideInterval":"3000","dispItems":"1","paginationPosition":"inside","nextBtn":"<span>next<\\/span>","prevBtn":"<span>previous<\\/span>","btnsPosition":"inside","nextBtnInsert":"appendTo","prevBtnInsert":"prependTo","delayAutoSlide":"0","effect":"slide","slideEasing":"swing","animSpeed":"normal"}}', '2013-02-08 10:22:45', '2013-02-08 10:22:45', 'live', 0),
(27, 'notes', 'Discussion', '', 'content', '{"app":"content","template":"\\/notes\\/notes"}', '2013-03-11 01:20:51', '2013-04-02 13:10:52', 'live', 0),
(28, 'login', 'Login Form', '', 'site', '{"app":"form","template":"\\/login","param":{"key":"login"}}', '2013-04-07 15:55:22', '2013-04-07 15:55:22', 'live', 0),
(30, 'workflow', 'Workflow', 'Workflow', 'content', '{"app":"content","template":"\\/workflow\\/workflow"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(31, 'lab', 'Open labs', '', 'content', '{"app":"lab","template":"\\/lab"}', '2013-10-16 14:52:08', '2013-11-05 15:34:51', 'live', 0);

-- --------------------------------------------------------

--
-- Structure de la table `site`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`, `owner`) VALUES
(1, 'admin', 'Grand Central', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `version`
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
-- Contenu de la table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-04-05 17:02:34', 'live', 0),
(2, 'fr', 'Français', 'fr', '2013-10-20 22:53:53', '2013-10-20 22:53:53', 'live', 0);

-- --------------------------------------------------------

--
-- Structure de la table `_rel`
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
-- Contenu de la table `_rel`
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
