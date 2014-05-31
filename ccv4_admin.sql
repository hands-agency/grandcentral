-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2014 at 05:48 AM
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
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `version` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`version`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=97 ;

--
-- Dumping data for table `const`
--

INSERT INTO `const` (`id`, `key`, `title`, `version`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'OPENALL', 'Open all', 1, '0000-00-00 00:00:00', '2013-05-17 11:29:44', 'trash', 0),
(2, 'NAVCC_SEARCH_NODATA', 'Try searching something, I''m ready.', 1, '0000-00-00 00:00:00', '2013-03-27 15:08:29', 'live', 0),
(3, 'NAVCC_SEARCH_PLACEHOLDER', '{"fr":"Rechercher","en":"Search"}', 1, '2014-05-31 05:45:20', '2014-05-31 05:45:20', 'live', 2),
(4, 'OPTION_FILTER_REFINE', '{"fr":"Rafiner","en":"Refine"}', 1, '2014-05-31 04:52:19', '2014-05-31 04:52:19', 'live', 2),
(6, 'MULTIPLESELECT_AVAILABLE_LABEL', '{"fr":"Disponibles","en":"Available"}', 1, '2014-05-31 04:52:32', '2014-05-31 04:52:32', 'live', 2),
(7, 'MULTIPLESELECT_SELECTED_LABEL', '{"fr":"Sélectionnés","en":"Selected"}', 1, '2014-05-31 04:52:48', '2014-05-31 04:52:48', 'live', 2),
(8, 'MULTIPLESELECT_SELECTED_NODATA', '{"fr":"Essayez de glisser-déposer des items depuis la liste","en":"Why don''t you drag and drop items from the list?"}', 1, '2014-05-31 04:53:41', '2014-05-31 04:53:41', 'live', 2),
(9, 'ADMIN_ZONING_ZONE_NODATA', 'Dammit, no zone. That''s impossimpible!', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(10, 'ZONING_SELECTED_NODATA', 'This zone has no section', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(11, 'ZONING_SELECTED_BUBBLE', 'Mine! Mine!', 1, '0000-00-00 00:00:00', '2013-03-22 14:49:01', 'live', 0),
(12, 'ZONING_AVAILABLE_LABEL', 'Apps', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(13, 'ZONING_LEGEND', 'This zoning shows the zones and sections. Change your code, this preview will follow.', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0),
(14, 'ZONING_AVAILABLE_SEARCH_PLACEHOLDER', 'Search', 1, '2013-01-23 11:13:49', '2013-01-23 11:13:49', 'live', 0),
(15, 'OPTION_DATE_YESTERDAY_NIGHT', '{"fr":"Hier soir","en":"Yesterday night"}', 1, '2013-03-18 11:33:04', '2014-05-31 04:54:26', 'live', 2),
(16, 'DATE_YEAR', '{"fr":"Années","en":"Years"}', 1, '2013-03-22 12:41:48', '2014-05-31 04:58:51', 'live', 2),
(17, 'DATE_MONTH', '{"fr":"Mois","en":"Months"}', 1, '2013-03-22 12:42:00', '2014-05-31 04:54:39', 'live', 2),
(18, 'DATE_WEEK', '{"fr":"Semaine","en":"Week"}', 1, '2013-03-22 12:42:09', '2014-05-31 04:54:55', 'live', 2),
(19, 'DATE_DAY', '{"fr":"Jours","en":"Days"}', 1, '2013-03-22 12:42:19', '2014-05-31 04:55:06', 'live', 2),
(20, 'DATE_HOUR', '{"fr":"Heures","en":"Hours"}', 1, '2013-03-22 12:42:26', '2014-05-31 04:55:13', 'live', 2),
(21, 'DATE_MINUTE', '{"fr":"Minutes","en":"Minutes"}', 1, '2013-03-22 12:42:37', '2014-05-31 04:55:21', 'live', 2),
(22, 'DATE_SECOND', '{"fr":"Secondes","en":"Seconds"}', 1, '2013-03-22 12:42:43', '2014-05-31 04:55:31', 'live', 2),
(23, 'TIMELINE_EVENT_UPDATE', '{"fr":"a modifié","en":"updated"}', 1, '2013-03-22 14:37:46', '2014-05-31 05:01:54', 'live', 2),
(24, 'TIMELINE_EVENT_INSERT', '{"fr":"a ajouté","en":"created"}', 1, '2013-03-22 14:37:54', '2014-05-31 04:55:58', 'live', 2),
(25, 'TIMELINE_PERIOD_NIGHT', '{"fr":"Pendant la nuit","en":"At night"}', 1, '2013-03-22 15:11:45', '2014-05-31 04:56:14', 'live', 2),
(26, 'TIMELINE_PERIOD_DUSK', '{"fr":"Tôt le matin","en":"At dusk"}', 1, '2013-03-22 15:12:02', '2014-05-31 04:56:31', 'live', 2),
(27, 'TIMELINE_PERIOD_EVENING', '{"fr":"Le soir","en":"In the evening"}', 1, '2013-03-22 15:12:36', '2014-05-31 04:59:03', 'live', 2),
(28, 'TIMELINE_PERIOD_AFTERNOON', '{"fr":"L''après-midi","en":"In the afternoon"}', 1, '2013-03-22 15:13:13', '2014-05-31 04:57:22', 'live', 2),
(29, 'TIMELINE_PERIOD_NOON', '{"fr":"A midi","en":"At noon"}', 1, '2013-03-22 15:13:50', '2014-05-31 04:57:31', 'live', 2),
(30, 'TIMELINE_PERIOD_MORNING', '{"fr":"Le matin","en":"In the morning"}', 1, '2013-03-22 15:14:25', '2014-05-31 04:57:43', 'live', 2),
(31, 'TIMELINE_PERIOD_DAWN', '{"fr":"Le soir","en":"At dawn"}', 1, '2013-03-22 15:14:48', '2014-05-31 04:58:11', 'live', 2),
(32, 'DATE_NOW', '{"fr":"A l''instant","en":"Just now"}', 1, '2013-03-22 17:48:55', '2014-05-31 04:58:44', 'live', 2),
(39, 'FIELD_VALIDATION_ERROR_REQUIRED', '{"fr":"Ce champ est obligatoire","en":"This field is compulsory"}', 1, '2013-03-22 17:48:55', '2014-05-31 04:58:32', 'live', 2),
(54, 'TIMELINE_PERIOD_YESTERDAY_DAWN', '{"fr":"Hier, assez tôt","en":"Yesterday very early"}', 1, '2013-03-23 19:53:53', '2014-05-31 05:00:21', 'live', 2),
(55, 'TIMELINE_PERIOD_YESTERDAY_MORNING', '{"fr":"Hier matin","en":"Yesterday morning"}', 1, '2013-03-23 19:54:03', '2014-05-31 05:00:30', 'live', 2),
(56, 'TIMELINE_PERIOD_YESTERDAY_NOON', '{"fr":"Hier midi","en":"Yesterday at noon"}', 1, '2013-03-23 19:54:28', '2014-05-31 05:00:43', 'live', 2),
(57, 'TIMELINE_PERIOD_YESTERDAY_AFTERNOON', '{"fr":"Hier après-midi","en":"Yesterday afternoon"}', 1, '2013-03-23 19:54:39', '2014-05-31 05:00:54', 'live', 2),
(58, 'TIMELINE_PERIOD_YESTERDAY_EVENING', '{"fr":"Hier soir","en":"Yesterday evening"}', 1, '2013-03-23 19:54:46', '2014-05-31 05:01:07', 'live', 2),
(59, 'TIMELINE_PERIOD_YESTERDAY_DUSK', '{"fr":"Hier assez tard","en":"Yesterday very late"}', 1, '2013-03-23 19:55:04', '2014-05-31 05:01:24', 'live', 2),
(60, 'TIMELINE_PERIOD_YESTERDAY_NIGHT', '{"fr":"Pendant la nuit d''hier","en":"Yesterday at night"}', 1, '2013-03-23 19:55:14', '2014-05-31 05:01:43', 'live', 2),
(61, 'TIMELINE_EVENT_DELETE', '{"fr":"a effacé","en":"deleted"}', 1, '2013-04-05 16:02:39', '2014-05-31 05:02:07', 'live', 2),
(62, 'TABS_PAGE_SYSTEM_TITLE', '{"fr":"Système","en":"System"}', 1, '2013-10-13 14:24:37', '2014-05-31 05:02:22', 'live', 2),
(63, 'TABS_PAGE_TREE_TITLE', '{"fr":"Arborescence","en":"Site tree"}', 1, '2013-10-13 14:31:21', '2014-05-31 05:02:33', 'live', 2),
(64, 'ITEM_PAGE_TITLE', '{"fr":"Arborescence","en":"The site tree"}', 1, '2013-10-14 01:28:04', '2014-05-31 05:46:41', 'live', 2),
(65, 'NAV_SUB_H1_STRUCTURE', '{"fr":"Un peu de structure","en":"Some structure"}', 1, '2013-10-14 10:38:30', '2014-05-31 05:45:46', 'live', 2),
(66, 'NAV_SUB_H1_SUPPORT', '{"fr":"Support","en":"Support"}', 1, '2013-10-14 10:39:21', '2014-05-31 05:45:56', 'live', 2),
(67, 'NAV_SUB_H1_SYSTEM', '{"fr":"Système","en":"System"}', 1, '2013-10-14 10:40:20', '2014-05-31 05:46:05', 'live', 2),
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
(85, 'OPTIONS_FILTERS_LEGEND_ORDER', '{"fr":"Ordonner","en":"Reorder"}', 1, '2013-10-19 16:12:17', '2014-05-31 05:07:51', 'live', 2),
(86, 'OPTIONS_FILTERS_LEGEND_DISPLAY', '{"fr":"Affichage","en":"Display"}', 1, '2013-10-19 17:10:19', '2014-05-31 05:07:10', 'live', 2),
(87, 'OPTIONS_FILTER_SORT_ASC_TITLE', '{"fr":"Du dernier au premier","en":"From the last one to the first one"}', 1, '2013-10-19 17:11:31', '2014-05-31 05:05:24', 'live', 2),
(88, 'OPTIONS_FILTER_SORT_DESC_TITLE', '{"fr":"Du premier au dernier","en":"From the first one to the last one"}', 1, '2013-10-19 17:12:22', '2014-05-31 05:05:33', 'live', 2),
(89, 'OPTIONS_FILTERS_LEGEND_SORT', '{"fr":"Classement","en":"Sort"}', 1, '2013-10-19 17:10:19', '2014-05-31 05:07:27', 'live', 2),
(90, 'OPTIONS_FILTER_DISPLAY_INSTACK_TITLE', '{"fr":"En lignes","en":"In stacks"}', 1, '2013-10-19 17:13:55', '2014-05-31 05:05:46', 'live', 2),
(91, 'OPTIONS_FILTER_DISPLAY_INMASONRY_TITLE', '{"fr":"En masonry","en":"In masonry"}', 1, '2013-10-19 17:14:59', '2014-05-31 05:06:08', 'live', 2),
(92, 'APPINI_H3_JQUERY', 'jQuery', 1, '2013-10-25 12:59:07', '2013-10-25 12:59:07', 'live', 0),
(93, 'NAV_SUB_H1_PLAYANDFIX', '{"fr":"Jouez & réparez","en":"Play & fix"}', 1, '2014-05-30 04:55:33', '2014-05-31 05:03:23', 'live', 2),
(94, 'NAV_SUB_H1_MAJOR', '{"fr":"Publiés","en":"Online"}', 1, '2014-05-30 04:56:50', '2014-05-31 05:03:57', 'live', 2),
(95, 'NAV_SUB_H1_MINOR', '{"fr":"Mineurs","en":"Minors"}', 1, '2014-05-30 04:57:16', '2014-05-31 05:04:04', 'live', 2),
(96, 'NAV_SUB_H1_SOCIAL', '{"fr":"Social","en":"Social life"}', 1, '2014-05-30 04:57:34', '2014-05-31 05:04:19', 'live', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=180 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `system`, `status`, `owner`) VALUES
(1, 'login', 'Login', '', 'login', 'login', 'post', '', '', '{"login":{"type":"text","key":"login","label":"So. My login is","placeholder":"my email address","required":true},"password":{"type":"password","key":"password","label":"and this is","placeholder":"my password","required":true},"save":{"type":"button","buttontype":"submit","key":"save","value":"Now let me in!"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(141, 'note', 'Notes', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"hidden","readonly":true},"item":{"key":"item","label":"Item","type":"hidden","min":"","max":"","placeholder":"Item"},"text":{"key":"text","label":"Text","type":"textarea","min":"","max":"","placeholder":"A short description"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(146, 'zoning', 'Zoning', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"hidden","readonly":true},"item":{"key":"item","label":"Item","type":"hidden","min":"","max":"","placeholder":"Item"},"section":{"key":"text","label":"Text","type":"zoning","min":"","max":""}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 0),
(154, 'tdc_page', 'tdc_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"type":{"key":"type","label":"type","type":"pagetype"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"child":{"key":"child","label":"Children","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0","min":"","max":""},"section":{"key":"section","label":"Zoning","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0","min":"","max":""},"group":{"key":"group","label":"Only for","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"title":{"key":"title","label":"Titre","type":"i18n","field":"fieldText"},"descr":{"key":"descr","label":"Chapo","type":"i18n","field":"fieldTextarea"},"text":{"key":"text","label":"Texte","type":"i18n","field":"fieldSirtrevor"}}', '2014-05-10 15:14:01', '2014-05-21 16:39:02', 0, 'live', 2),
(155, 'tdc_item', 'tdc_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text","required":true},"title":{"key":"title","label":"title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"hasurl":{"key":"hasurl","label":"hasurl","type":"bool","required":"0"},"attr":{"key":"attr","label":"attr","type":"attr"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"},"icon":{"key":"icon","label":"icon","type":"textarea","required":"0","min":"0","max":"500"}}', '2014-05-10 15:48:32', '2014-05-23 12:03:33', 0, 'live', 2),
(156, 'tdc_site', 'tdc_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"},"favicon":{"key":"favicon","label":"Fav icon","type":"media","required":"0","min":"","max":"1"}}', '2014-05-10 16:30:55', '2014-05-10 16:30:55', 0, 'live', 2),
(157, 'tdc_human', 'tdc_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"firstname":{"key":"firstname","label":"First Name","type":"text","required":"0","min":"0","max":"255"},"lastname":{"key":"lastname","label":"Last Name","type":"text","required":"0","min":"0","max":"255"},"title":{"key":"title","label":"A short title","type":"text","required":"0","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"1000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"}}', '2014-05-10 16:36:33', '2014-05-10 17:51:39', 0, 'live', 2),
(158, 'tdc_section', 'tdc_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app","required":"1"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-10 16:55:32', '2014-05-10 16:55:32', 0, 'live', 2),
(159, 'souvenoir_page', 'souvenoir_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"pagetype"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"url","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0","min":"","max":""},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"text":{"key":"text","label":"text","type":"sirtrevor","required":"0"},"owner":{"key":"owner","label":"owner","type":"text"},"parent":{"key":"parent","label":"parent","valuestype":"bunch","values":[{"item":"page"}],"type":"select","required":"0","min":"0","max":"1"}}', '2014-05-14 12:37:48', '2014-05-30 04:10:32', 0, 'live', 2),
(160, 'souvenoir_photo', 'souvenoir_photo', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"photo":{"key":"photo","label":"Photos","type":"media","required":"0","min":"","max":""},"title":{"key":"title","label":"Title","type":"textarea","required":"0","min":"0","max":"500"},"text":{"key":"text","label":"Text","type":"sirtrevor","required":"0"},"ref":{"key":"ref","label":"Ref","type":"text","required":"0","min":"0","max":"16"},"key":{"key":"key","label":"The key","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"people":{"key":"people","label":"People","valuestype":"bunch","values":[{"item":"people"}],"type":"multipleselect","required":"0"},"timestamp":{"key":"timestamp","label":"Timestamp","type":"text","required":"0"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"location":{"key":"location","label":"Location","valuestype":"bunch","values":[{"item":"place"}],"type":"multipleselect","required":"0"},"format":{"key":"format","label":"Formats for sell","valuestype":"bunch","values":[{"item":"format"}],"type":"multipleselect","required":"0"},"story":{"key":"story","label":"Story","type":"media","required":"0","min":"","max":""},"displaystory":{"key":"displaystory","label":"Display story","type":"text","required":"0"},"access":{"key":"access","label":"Access","type":"text","required":"0"}}', '2014-05-14 15:47:16', '2014-05-14 15:47:16', 0, 'live', 2),
(161, 'souvenoir_item', 'souvenoir_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-14 16:06:04', '2014-05-14 16:06:04', 0, 'live', 2),
(162, 'souvenoir_test', 'souvenoir_test', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"text1":{"key":"text1","label":"text1","type":"sirtrevor","required":"0"},"text2":{"key":"text2","label":"text2","type":"sirtrevor","required":"0"},"key":{"key":"key","label":"key","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"text3":{"key":"text3","label":"text3","type":"sirtrevor","required":"0"},"testi18n":{"key":"testi18n","label":"testi18n","type":"i18n","field":"fieldText"}}', '2014-05-14 19:47:32', '2014-05-15 09:03:25', 0, 'live', 2),
(163, 'souvenoir_site', 'souvenoir_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"500"},"favicon":{"key":"favicon","label":"favicon","type":"media","required":"0","min":"","max":""}}', '2014-05-15 00:50:13', '2014-05-18 03:17:40', 0, 'live', 2),
(164, 'admin_section', 'admin_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"500"},"zone":{"key":"zone","label":"zone","type":"text","required":"0","min":"0","max":"255"},"app":{"key":"app","label":"app","type":"app"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"greenbutton":{"key":"greenbutton","label":"greenbutton","valuestype":"bunch","values":[{"item":"greenbutton"}],"type":"multipleselect","required":"0","min":"","max":""},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-05-15 09:47:46', '2014-05-31 04:45:58', 1, 'live', 2),
(165, 'souvenoir_section', 'souvenoir_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","required":"0","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-15 11:44:05', '2014-05-15 11:44:05', 0, 'live', 2),
(166, 'souvenoir_version', 'souvenoir_version', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"lang":{"key":"lang","label":"Language","type":"text","required":"1","min":"0","max":"32"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-15 17:51:27', '2014-05-15 17:51:27', 0, 'live', 2),
(167, 'miranda_page', 'miranda_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"type":{"key":"type","label":"type","type":"pagetype"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"5000"},"url":{"key":"url","label":"The url","type":"text"},"system":{"key":"system","label":"System","type":"bool","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"version":{"key":"version","label":"version","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0"},"text":{"key":"text","label":"Texte","type":"sirtrevor","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-17 23:54:19', '2014-05-17 23:54:19', 0, 'live', 2),
(168, 'miranda_section', 'miranda_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"zone":{"key":"zone","label":"The zone","type":"text","required":"0","min":"0","max":"255"},"app":{"key":"app","label":"The template","type":"app"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-18 00:03:45', '2014-05-18 00:03:45', 0, 'live', 2),
(169, 'miranda_item', 'miranda_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","required":"0","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool","required":"0"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool","required":"0"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-18 00:31:22', '2014-05-18 00:31:22', 0, 'live', 2),
(170, 'miranda_map', 'miranda_map', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"Cast title","type":"textarea","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","label":"Description","type":"textarea","required":"0","min":"0","max":"5000"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"typologyname":{"key":"typologyname","label":"Typology name","type":"text","required":"0","min":"0","max":"255"},"form":{"key":"form","label":"Upload cast form","valuestype":"bunch","values":[{"item":"form"}],"type":"multipleselect","required":"0","min":"","max":""},"cover":{"key":"cover","label":"Cover","type":"media","required":"0","min":"","max":""}}', '2014-05-18 00:34:43', '2014-05-18 00:34:43', 0, 'live', 2),
(171, 'miranda_site', 'miranda_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-18 02:20:35', '2014-05-18 02:20:35', 0, 'live', 2),
(172, 'souvenoir_order', 'souvenoir_order', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"content":{"key":"content","label":"Order Content","type":"array"},"email":{"key":"email","label":"Customer email","type":"text","required":"0","min":"0","max":"200"},"key":{"key":"key","label":"The key","type":"text"},"url":{"key":"url","label":"Url","type":"text"},"owner":{"key":"owner","label":"Owner","type":"text"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"}}', '2014-05-19 23:04:14', '2014-05-19 23:04:14', 0, 'live', 2),
(173, 'tdc_news', 'tdc_news', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"key":{"key":"key","label":"key","type":"text"},"url":{"key":"url","label":"url","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"descr":{"key":"descr","label":"descr","type":"i18n","field":"fieldTextarea"},"text":{"key":"text","label":"text","type":"i18n","field":"fieldTextarea"},"media":{"key":"media","label":"media","type":"media","required":"0","min":"","max":"1"},"type":{"key":"type","label":"type","valuestype":"bunch","values":[{"item":"newstype"}],"type":"multipleselect","required":"0","min":"","max":""}}', '2014-05-23 17:08:41', '2014-05-23 17:08:41', 0, 'live', 2),
(174, 'souvenoir_workflow', 'souvenoir_workflow', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"item":{"key":"item","label":"item","type":"textarea","required":"0","min":"0","max":"500"},"original":{"key":"original","label":"original","type":"text","required":"1"},"data":{"key":"data","label":"data","type":"array"},"owner":{"key":"owner","label":"owner","type":"text"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"}}', '2014-05-24 23:15:04', '2014-05-27 14:27:39', 0, 'live', 2),
(175, 'admin_page', 'admin_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"type":{"key":"type","label":"type","type":"pagetype"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"500"},"text":{"key":"text","label":"text","type":"textarea","required":"0","min":"0","max":"65035"},"url":{"key":"url","label":"url","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0","min":"","max":""},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0","min":"","max":""},"sectiondefault":{"key":"sectiondefault","label":"sectiondefault","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0","min":"","max":""},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-05-28 00:32:59', '2014-05-31 04:43:36', 1, 'live', 2),
(176, 'souvenoir_human', 'souvenoir_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"Short bio","type":"textarea","required":"0","min":"0","max":"5000"},"password":{"key":"password","label":"Password","type":"password","required":"0"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"profilepic":{"key":"profilepic","label":"Profile Picture","type":"media","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"pref":{"key":"pref","label":"Preferences","type":"array"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-28 18:40:16', '2014-05-28 18:40:16', 0, 'live', 2),
(177, 'admin_site', 'admin_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text"},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"Status","type":"text"},"defaultversion":{"key":"defaultversion","label":"Default Version","type":"number","required":"0","min":"","max":""},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-29 07:02:14', '2014-05-29 07:02:14', 1, 'live', 2),
(178, 'admin_const', 'admin_const', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"version":{"key":"version","label":"version","type":"text"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-05-30 04:55:24', '2014-05-31 04:51:44', 1, 'live', 2),
(179, 'admin_item', 'admin_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"number","readonly":true},"key":{"key":"key","label":"The key","type":"text","required":true},"title":{"key":"title","label":"A short title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"A short description","type":"textarea","min":"0","max":"500"},"system":{"key":"system","label":"Is system","type":"bool"},"attr":{"key":"attr","label":"Attributes","type":"attr"},"created":{"key":"created","label":"Created Datetime","type":"text"},"updated":{"key":"updated","label":"Updated Datetime","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"Has URL","type":"bool"},"owner":{"key":"owner","label":"Owner","type":"text"}}', '2014-05-31 03:49:54', '2014-05-31 03:49:54', 1, 'live', 2);

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
(3, 'page', 'Pages', '', 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldText"},"type":{"key":"type","type":"array"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"text":{"key":"text","type":"string","required":"0","min":"0","max":"65035"},"url":{"key":"url","type":"url"},"system":{"key":"system","type":"bool","required":"0"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"child":{"key":"child","type":"rel","required":"0","param":[{"item":"page"}],"min":"","max":""},"section":{"key":"section","type":"rel","required":"0","param":[{"item":"section"}],"min":"","max":""},"sectiondefault":{"key":"sectiondefault","type":"rel","required":"0","param":[{"item":"section"}],"min":"","max":""},"owner":{"key":"owner","type":"owner"}}', '2013-11-17 14:17:07', '2014-05-31 04:43:21', 'live', 1, 2),
(4, 'version', 'Versions', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"lang":{"key":"lang","title":"Language","type":"string","min":"0","max":"32","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-11-17 14:17:07', '2013-11-17 14:17:07', 'live', 0, 0),
(5, 'const', 'Text constants', '', 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldText"},"version":{"key":"version","type":"version"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-11-17 14:17:07', '2014-05-31 04:42:18', 'live', 0, 2),
(6, 'form', 'Forms', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"template":{"key":"template","type":"string","title":"Template","min":"","max":"","required":"1"},"action":{"key":"action","type":"string","title":"Action","min":"","max":"","required":"1"},"method":{"key":"method","type":"list","option":"post,get","title":"Method","required":"1"},"target":{"key":"target","type":"string","title":"Target"},"enctype":{"key":"enctype","type":"list","option":"application\\/x-www-form-urlencoded,multipart\\/form-data","title":"Enctype","required":"1"},"field":{"key":"field","type":"array","title":"The Fields"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"system":{"key":"system","type":"bool","title":"System"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-09-27 08:33:31', '2013-11-17 14:17:07', 'live', 0, 0),
(7, 'section', 'Sections', '', 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldText"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"zone":{"key":"zone","type":"string","required":"0","min":"0","max":"255"},"app":{"key":"app","type":"array"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"greenbutton":{"key":"greenbutton","type":"rel","required":"0","param":[{"item":"greenbutton"}],"min":"","max":""},"owner":{"key":"owner","type":"owner"}}', '2013-09-25 08:33:09', '2014-05-31 04:45:40', 'live', 0, 2),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=214 ;

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
(105, 'insert', 'human', 2, 'form', 149, '2014-05-02 17:38:02', '2014-05-02 17:38:02', 'live', 2),
(106, 'insert', 'human', 2, 'form', 164, '2014-05-15 09:47:46', '2014-05-15 09:47:46', 'live', 2),
(107, 'update', 'human', 2, 'section', 3, '2014-05-15 09:47:55', '2014-05-15 09:47:55', 'live', 2),
(108, 'insert', 'human', 2, 'form', 178, '2014-05-30 04:55:24', '2014-05-30 04:55:24', 'live', 2),
(109, 'insert', 'human', 2, 'const', 93, '2014-05-30 04:55:33', '2014-05-30 04:55:33', 'live', 2),
(110, 'insert', 'human', 2, 'const', 94, '2014-05-30 04:56:50', '2014-05-30 04:56:50', 'live', 2),
(111, 'insert', 'human', 2, 'const', 95, '2014-05-30 04:57:16', '2014-05-30 04:57:16', 'live', 2),
(112, 'insert', 'human', 2, 'const', 96, '2014-05-30 04:57:34', '2014-05-30 04:57:34', 'live', 2),
(113, 'update', 'human', 2, 'page', 1, '2014-05-30 04:59:49', '2014-05-30 04:59:49', 'live', 2),
(114, 'insert', 'human', 2, 'form', 179, '2014-05-31 03:49:54', '2014-05-31 03:49:54', 'live', 2),
(115, 'update', 'human', 2, 'item', 5, '2014-05-31 04:41:39', '2014-05-31 04:41:39', 'live', 2),
(116, 'update', 'human', 2, 'form', 178, '2014-05-31 04:41:55', '2014-05-31 04:41:55', 'live', 2),
(117, 'update', 'human', 2, 'item', 5, '2014-05-31 04:42:18', '2014-05-31 04:42:18', 'live', 2),
(118, 'update', 'human', 2, 'item', 3, '2014-05-31 04:43:08', '2014-05-31 04:43:08', 'live', 2),
(119, 'update', 'human', 2, 'item', 3, '2014-05-31 04:43:21', '2014-05-31 04:43:21', 'live', 2),
(120, 'update', 'human', 2, 'form', 175, '2014-05-31 04:43:36', '2014-05-31 04:43:36', 'live', 2),
(121, 'update', 'human', 2, 'page', 1, '2014-05-31 04:43:47', '2014-05-31 04:43:47', 'live', 2),
(122, 'update', 'human', 2, 'page', 9, '2014-05-31 04:44:15', '2014-05-31 04:44:15', 'live', 2),
(123, 'update', 'human', 2, 'page', 10, '2014-05-31 04:44:29', '2014-05-31 04:44:29', 'live', 2),
(124, 'update', 'human', 2, 'page', 11, '2014-05-31 04:44:40', '2014-05-31 04:44:40', 'live', 2),
(125, 'update', 'human', 2, 'page', 5, '2014-05-31 04:44:53', '2014-05-31 04:44:53', 'live', 2),
(126, 'update', 'human', 2, 'page', 6, '2014-05-31 04:45:01', '2014-05-31 04:45:01', 'live', 2),
(127, 'update', 'human', 2, 'item', 7, '2014-05-31 04:45:40', '2014-05-31 04:45:40', 'live', 2),
(128, 'update', 'human', 2, 'form', 164, '2014-05-31 04:45:58', '2014-05-31 04:45:58', 'live', 2),
(129, 'update', 'human', 2, 'section', 5, '2014-05-31 04:46:24', '2014-05-31 04:46:24', 'live', 2),
(130, 'update', 'human', 2, 'section', 9, '2014-05-31 04:46:50', '2014-05-31 04:46:50', 'live', 2),
(131, 'update', 'human', 2, 'section', 17, '2014-05-31 04:47:01', '2014-05-31 04:47:01', 'live', 2),
(132, 'update', 'human', 2, 'section', 30, '2014-05-31 04:47:16', '2014-05-31 04:47:16', 'live', 2),
(133, 'update', 'human', 2, 'section', 21, '2014-05-31 04:47:28', '2014-05-31 04:47:28', 'live', 2),
(134, 'update', 'human', 2, 'section', 6, '2014-05-31 04:47:37', '2014-05-31 04:47:37', 'live', 2),
(135, 'update', 'human', 2, 'section', 7, '2014-05-31 04:47:46', '2014-05-31 04:47:46', 'live', 2),
(136, 'update', 'human', 2, 'section', 8, '2014-05-31 04:47:54', '2014-05-31 04:47:54', 'live', 2),
(137, 'update', 'human', 2, 'section', 3, '2014-05-31 04:48:57', '2014-05-31 04:48:57', 'live', 2),
(138, 'update', 'human', 2, 'section', 31, '2014-05-31 04:49:05', '2014-05-31 04:49:05', 'live', 2),
(139, 'update', 'human', 2, 'section', 2, '2014-05-31 04:49:18', '2014-05-31 04:49:18', 'live', 2),
(140, 'update', 'human', 2, 'section', 10, '2014-05-31 04:49:29', '2014-05-31 04:49:29', 'live', 2),
(141, 'update', 'human', 2, 'section', 20, '2014-05-31 04:49:44', '2014-05-31 04:49:44', 'live', 2),
(142, 'update', 'human', 2, 'section', 4, '2014-05-31 04:49:55', '2014-05-31 04:49:55', 'live', 2),
(143, 'update', 'human', 2, 'section', 28, '2014-05-31 04:50:04', '2014-05-31 04:50:04', 'live', 2),
(144, 'update', 'human', 2, 'section', 19, '2014-05-31 04:50:45', '2014-05-31 04:50:45', 'live', 2),
(145, 'update', 'human', 2, 'section', 27, '2014-05-31 04:51:02', '2014-05-31 04:51:02', 'live', 2),
(146, 'update', 'human', 2, 'section', 1, '2014-05-31 04:51:15', '2014-05-31 04:51:15', 'live', 2),
(147, 'update', 'human', 2, 'form', 178, '2014-05-31 04:51:44', '2014-05-31 04:51:44', 'live', 2),
(148, 'update', 'human', 2, 'const', 4, '2014-05-31 04:52:19', '2014-05-31 04:52:19', 'live', 2),
(149, 'update', 'human', 2, 'const', 6, '2014-05-31 04:52:32', '2014-05-31 04:52:32', 'live', 2),
(150, 'update', 'human', 2, 'const', 7, '2014-05-31 04:52:48', '2014-05-31 04:52:48', 'live', 2),
(151, 'update', 'human', 2, 'const', 8, '2014-05-31 04:53:33', '2014-05-31 04:53:33', 'live', 2),
(152, 'update', 'human', 2, 'const', 8, '2014-05-31 04:53:41', '2014-05-31 04:53:41', 'live', 2),
(153, 'update', 'human', 2, 'const', 15, '2014-05-31 04:54:26', '2014-05-31 04:54:26', 'live', 2),
(154, 'update', 'human', 2, 'const', 17, '2014-05-31 04:54:39', '2014-05-31 04:54:39', 'live', 2),
(155, 'update', 'human', 2, 'const', 18, '2014-05-31 04:54:55', '2014-05-31 04:54:55', 'live', 2),
(156, 'update', 'human', 2, 'const', 19, '2014-05-31 04:55:06', '2014-05-31 04:55:06', 'live', 2),
(157, 'update', 'human', 2, 'const', 20, '2014-05-31 04:55:13', '2014-05-31 04:55:13', 'live', 2),
(158, 'update', 'human', 2, 'const', 21, '2014-05-31 04:55:21', '2014-05-31 04:55:21', 'live', 2),
(159, 'update', 'human', 2, 'const', 22, '2014-05-31 04:55:31', '2014-05-31 04:55:31', 'live', 2),
(160, 'update', 'human', 2, 'const', 24, '2014-05-31 04:55:58', '2014-05-31 04:55:58', 'live', 2),
(161, 'update', 'human', 2, 'const', 25, '2014-05-31 04:56:14', '2014-05-31 04:56:14', 'live', 2),
(162, 'update', 'human', 2, 'const', 26, '2014-05-31 04:56:31', '2014-05-31 04:56:31', 'live', 2),
(163, 'update', 'human', 2, 'const', 28, '2014-05-31 04:57:22', '2014-05-31 04:57:22', 'live', 2),
(164, 'update', 'human', 2, 'const', 29, '2014-05-31 04:57:31', '2014-05-31 04:57:31', 'live', 2),
(165, 'update', 'human', 2, 'const', 30, '2014-05-31 04:57:43', '2014-05-31 04:57:43', 'live', 2),
(166, 'update', 'human', 2, 'const', 31, '2014-05-31 04:58:11', '2014-05-31 04:58:11', 'live', 2),
(167, 'update', 'human', 2, 'const', 39, '2014-05-31 04:58:32', '2014-05-31 04:58:32', 'live', 2),
(168, 'update', 'human', 2, 'const', 32, '2014-05-31 04:58:44', '2014-05-31 04:58:44', 'live', 2),
(169, 'update', 'human', 2, 'const', 16, '2014-05-31 04:58:51', '2014-05-31 04:58:51', 'live', 2),
(170, 'update', 'human', 2, 'const', 27, '2014-05-31 04:59:03', '2014-05-31 04:59:03', 'live', 2),
(171, 'update', 'human', 2, 'const', 54, '2014-05-31 05:00:21', '2014-05-31 05:00:21', 'live', 2),
(172, 'update', 'human', 2, 'const', 55, '2014-05-31 05:00:30', '2014-05-31 05:00:30', 'live', 2),
(173, 'update', 'human', 2, 'const', 56, '2014-05-31 05:00:43', '2014-05-31 05:00:43', 'live', 2),
(174, 'update', 'human', 2, 'const', 57, '2014-05-31 05:00:54', '2014-05-31 05:00:54', 'live', 2),
(175, 'update', 'human', 2, 'const', 58, '2014-05-31 05:01:07', '2014-05-31 05:01:07', 'live', 2),
(176, 'update', 'human', 2, 'const', 59, '2014-05-31 05:01:24', '2014-05-31 05:01:24', 'live', 2),
(177, 'update', 'human', 2, 'const', 60, '2014-05-31 05:01:43', '2014-05-31 05:01:43', 'live', 2),
(178, 'update', 'human', 2, 'const', 23, '2014-05-31 05:01:54', '2014-05-31 05:01:54', 'live', 2),
(179, 'update', 'human', 2, 'const', 61, '2014-05-31 05:02:07', '2014-05-31 05:02:07', 'live', 2),
(180, 'update', 'human', 2, 'const', 62, '2014-05-31 05:02:22', '2014-05-31 05:02:22', 'live', 2),
(181, 'update', 'human', 2, 'const', 63, '2014-05-31 05:02:33', '2014-05-31 05:02:33', 'live', 2),
(182, 'update', 'human', 2, 'const', 93, '2014-05-31 05:03:23', '2014-05-31 05:03:23', 'live', 2),
(183, 'update', 'human', 2, 'const', 94, '2014-05-31 05:03:57', '2014-05-31 05:03:57', 'live', 2),
(184, 'update', 'human', 2, 'const', 95, '2014-05-31 05:04:04', '2014-05-31 05:04:04', 'live', 2),
(185, 'update', 'human', 2, 'const', 96, '2014-05-31 05:04:19', '2014-05-31 05:04:19', 'live', 2),
(186, 'update', 'human', 2, 'const', 87, '2014-05-31 05:05:24', '2014-05-31 05:05:24', 'live', 2),
(187, 'update', 'human', 2, 'const', 88, '2014-05-31 05:05:33', '2014-05-31 05:05:33', 'live', 2),
(188, 'update', 'human', 2, 'const', 90, '2014-05-31 05:05:46', '2014-05-31 05:05:46', 'live', 2),
(189, 'update', 'human', 2, 'const', 91, '2014-05-31 05:06:08', '2014-05-31 05:06:08', 'live', 2),
(190, 'update', 'human', 2, 'const', 85, '2014-05-31 05:06:55', '2014-05-31 05:06:55', 'live', 2),
(191, 'update', 'human', 2, 'const', 86, '2014-05-31 05:07:10', '2014-05-31 05:07:10', 'live', 2),
(192, 'update', 'human', 2, 'const', 89, '2014-05-31 05:07:27', '2014-05-31 05:07:27', 'live', 2),
(193, 'update', 'human', 2, 'const', 85, '2014-05-31 05:07:51', '2014-05-31 05:07:51', 'live', 2),
(194, 'update', 'human', 2, 'page', 31, '2014-05-31 05:09:43', '2014-05-31 05:09:43', 'live', 2),
(195, 'update', 'human', 2, 'page', 36, '2014-05-31 05:09:52', '2014-05-31 05:09:52', 'live', 2),
(196, 'update', 'human', 2, 'page', 33, '2014-05-31 05:10:03', '2014-05-31 05:10:03', 'live', 2),
(197, 'update', 'human', 2, 'page', 35, '2014-05-31 05:10:12', '2014-05-31 05:10:12', 'live', 2),
(198, 'update', 'human', 2, 'page', 3, '2014-05-31 05:10:20', '2014-05-31 05:10:20', 'live', 2),
(199, 'update', 'human', 2, 'page', 3, '2014-05-31 05:10:27', '2014-05-31 05:10:27', 'live', 2),
(200, 'update', 'human', 2, 'page', 2, '2014-05-31 05:10:38', '2014-05-31 05:10:38', 'live', 2),
(201, 'update', 'human', 2, 'page', 30, '2014-05-31 05:10:46', '2014-05-31 05:10:46', 'live', 2),
(202, 'update', 'human', 2, 'page', 9, '2014-05-31 05:36:53', '2014-05-31 05:36:53', 'live', 2),
(203, 'update', 'human', 2, 'page', 32, '2014-05-31 05:37:42', '2014-05-31 05:37:42', 'live', 2),
(204, 'update', 'human', 2, 'page', 37, '2014-05-31 05:37:49', '2014-05-31 05:37:49', 'live', 2),
(205, 'update', 'human', 2, 'page', 29, '2014-05-31 05:38:10', '2014-05-31 05:38:10', 'live', 2),
(206, 'update', 'human', 2, 'page', 7, '2014-05-31 05:38:16', '2014-05-31 05:38:16', 'live', 2),
(207, 'update', 'human', 2, 'page', 9, '2014-05-31 05:38:35', '2014-05-31 05:38:35', 'live', 2),
(208, 'update', 'human', 2, 'page', 1, '2014-05-31 05:38:45', '2014-05-31 05:38:45', 'live', 2),
(209, 'update', 'human', 2, 'const', 3, '2014-05-31 05:45:20', '2014-05-31 05:45:20', 'live', 2),
(210, 'update', 'human', 2, 'const', 65, '2014-05-31 05:45:46', '2014-05-31 05:45:46', 'live', 2),
(211, 'update', 'human', 2, 'const', 66, '2014-05-31 05:45:56', '2014-05-31 05:45:56', 'live', 2),
(212, 'update', 'human', 2, 'const', 67, '2014-05-31 05:46:05', '2014-05-31 05:46:05', 'live', 2),
(213, 'update', 'human', 2, 'const', 64, '2014-05-31 05:46:41', '2014-05-31 05:46:41', 'live', 2);

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
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
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
(1, 'home', '{"fr":"Digest","en":"Digest"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Welcome home', '', '/', 0, '2013-10-03 08:28:48', '2014-05-31 05:38:45', 'live', 2),
(2, 'error_404', '{"fr":"404","en":"404"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/404', 1, '2014-05-31 05:10:38', '2014-05-31 05:10:38', 'live', 2),
(3, 'post', '{"fr":"POST routine","en":"POST routine"}', '{"key":"content","http_status":"200 OK","content_type":"routine","url":"","master":{"app":"content","template":"\\/master\\/post"}}', 'Receives all the posts from the forms.', '', '/routine', 1, '2014-05-31 05:10:27', '2014-05-31 05:10:27', 'live', 2),
(5, 'list', '{"fr":"Liste","en":"List"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/list', 0, '2013-10-13 01:05:53', '2014-05-31 04:44:53', 'live', 2),
(6, 'edit', '{"fr":"Edition","en":"Edit"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/edit', 0, '2013-10-12 22:01:52', '2014-05-31 04:45:01', 'live', 2),
(7, 'doc', '{"fr":"Doc","en":"Doc"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'About classes, methods and functions available to you, kind developer.', '', '/doc', 0, '2013-10-14 13:11:22', '2014-05-31 05:38:16', 'live', 2),
(9, 'site', '{"fr":"Environnement","en":"Environment"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Structure', '', '/site', 0, '2014-04-08 19:54:46', '2014-05-31 05:38:35', 'live', 2),
(10, 'content', '{"fr":"Contenu","en":"Content"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Publish', '', '/item', 0, '2013-10-19 15:27:46', '2014-05-31 04:44:29', 'live', 2),
(11, 'app', '{"fr":"Apps","en":"Apps"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Tweak', '', '/app', 0, '2013-10-18 18:40:46', '2014-05-31 04:44:40', 'live', 2),
(29, 'logbook', '{"fr":"Livre des logs","en":"Log book"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/logbook', 0, '2014-05-31 05:38:10', '2014-05-31 05:38:10', 'live', 2),
(30, 'login', '{"fr":"Login","en":"Login"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/login"}}', '', '', '/login', 1, '2013-10-03 04:16:31', '2014-05-31 05:10:46', 'live', 2),
(31, 'api.json', '{"fr":"API (json)","en":"API (json)"}', '{"key":"content","http_status":"200 OK","content_type":"json","url":"","master":{"app":"content","template":"\\/master\\/api"}}', '', '', '/api.json', 1, '2013-03-06 03:21:46', '2014-05-31 05:09:43', 'live', 2),
(32, 'me', '{"fr":"Moi","en":"Me"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'dfsdf', '', '/me', 0, '2014-05-31 05:37:42', '2014-05-31 05:37:42', 'live', 2),
(33, 'api.eventstream', '{"fr":"API (eventstream)","en":"API (eventstream)"}', '{"key":"content","http_status":"200 OK","content_type":"eventstream","url":"","master":{"app":"content","template":"\\/master\\/api"}}', '', '', '/api.eventstream', 1, '2013-03-06 03:21:46', '2014-05-31 05:10:03', 'live', 2),
(35, 'ajax.html', '{"fr":"AJAX (html)","en":"AJAX (html)"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/ajax"}}', '', '', '/ajax.html', 1, '2013-03-06 03:21:46', '2014-05-31 05:10:12', 'live', 2),
(36, 'ajax.json', '{"fr":"AJAX (json)","en":"AJAX (json)"}', '{"key":"content","http_status":"200 OK","content_type":"json","url":"","master":{"app":"content","template":"\\/master\\/ajax"}}', '', '', '/ajax.json', 1, '2013-03-06 03:21:46', '2014-05-31 05:09:52', 'live', 2),
(37, 'lab', '{"fr":"Lab","en":"Lab"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/lab', 0, '2014-05-02 15:31:57', '2014-05-31 05:37:49', 'live', 2);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
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
(1, 'live', '{"fr":"Publiés","en":"Live"}', 'General form', 'content', '{"app":"content","template":"\\/list\\/list","param":{"status":"live","system":""}}', '2014-05-31 04:51:15', '2014-05-31 04:51:15', 'live', 2),
(2, 'edit', '{"fr":"Edition","en":"Edit"}', 'General form', 'content', '{"app":"content","template":"\\/edit\\/edit"}', '2013-10-16 14:52:08', '2014-05-31 04:49:18', 'live', 2),
(3, 'php', '{"fr":"Apps","en":"Apps"}', '', 'content', '{"app":"content","template":"\\/doc\\/code"}', '2014-05-15 09:47:55', '2014-05-31 04:48:57', 'live', 2),
(4, 'doc', '{"fr":"Doc","en":"Doc"}', '', 'content', '{"app":"content","template":"\\/doc\\/doc"}', '2013-10-20 22:52:03', '2014-05-31 04:49:55', 'live', 2),
(5, 'splash', '{"fr":"Bienvenue","en":"Welcome"}', 'Lorem ipsum', 'content', '{"app":"content","template":"\\/error\\/error"}', '2014-05-31 04:46:24', '2014-05-31 04:46:24', 'live', 2),
(6, 'system', '{"fr":"Système","en":"System"}', '', 'content', '{"app":"content","template":"\\/list\\/list","param":{"system":"1"}}', '2013-02-24 06:33:01', '2014-05-31 04:47:37', 'live', 2),
(7, 'asleep', '{"fr":"En sommeil","en":"Asleep"}', '', 'content', '{"app":"content","template":"\\/list\\/list","param":{"status":"asleep"}}', '2013-02-24 06:33:01', '2014-05-31 04:47:46', 'live', 2),
(8, 'draft', '{"fr":"Brouillon","en":"Draft"}', '', 'content', '{"app":"content","template":"\\/list\\/list","param":{"status":"draft"}}', '2013-02-24 06:33:01', '2014-05-31 04:47:54', 'live', 2),
(9, 'timeline', '{"fr":"En direct","en":"Timeline"}', 'Lorem ipsum', 'content', '{"app":"content","template":"\\/timeline\\/timeline"}', '2014-05-31 04:46:50', '2014-05-31 04:46:50', 'live', 2),
(10, 'tree', '{"fr":"Arborescence","en":"Site tree"}', 'Lorem ipsum', 'content', '{"app":"content","template":"\\/tree\\/tree"}', '2013-10-23 02:14:52', '2014-05-31 04:49:29', 'live', 2),
(17, 'zoning', '{"fr":"Zoning","en":"Zoning"}', 'Zoning', 'content', '{"app":"content","template":"\\/zoning\\/zoning"}', '2014-05-31 04:47:01', '2014-05-31 04:47:01', 'live', 2),
(19, 'appstore', '{"fr":"App store","en":"App store"}', '', 'content', '{"app":"content","template":"\\/appmanager\\/appmanager"}', '2014-05-31 04:50:45', '2014-05-31 04:50:45', 'live', 2),
(20, 'appini', '{"fr":"A propos","en":"About"}', '', 'content', '{"app":"content","template":"\\/appini\\/appini"}', '2013-10-20 22:53:07', '2014-05-31 04:49:44', 'live', 2),
(21, 'appconfig', '{"fr":"Configuration","en":"Configuration"}', '', 'content', '{"app":"content","template":"\\/appconfig\\/appconfig"}', '2014-05-31 04:47:28', '2014-05-31 04:47:28', 'live', 2),
(25, 'carousel_test', 'Carousel de test', '', 'content', '{"app":"jquery_carousel","template":"\\/jquery_carousel","param":{"direction":"horizontal","autoSlideInterval":"3000","dispItems":"1","paginationPosition":"inside","nextBtn":"<span>next<\\/span>","prevBtn":"<span>previous<\\/span>","btnsPosition":"inside","nextBtnInsert":"appendTo","prevBtnInsert":"prependTo","delayAutoSlide":"0","effect":"slide","slideEasing":"swing","animSpeed":"normal"}}', '2013-02-08 10:22:45', '2013-02-08 10:22:45', 'live', 0),
(27, 'notes', '{"fr":"Discussion","en":"Discussion"}', '', 'content', '{"app":"content","template":"\\/notes\\/notes"}', '2013-03-11 01:20:51', '2014-05-31 04:51:02', 'live', 2),
(28, 'login', '{"fr":"Login","en":"Login"}', '', 'site', '{"app":"form","template":"\\/login","param":{"key":"login"}}', '2013-04-07 15:55:22', '2014-05-31 04:50:04', 'live', 2),
(30, 'workflow', '{"fr":"Workflow","en":"Workflow"}', 'Workflow', 'content', '{"app":"content","template":"\\/workflow\\/workflow"}', '2014-05-31 04:47:16', '2014-05-31 04:47:16', 'live', 2),
(31, 'lab', '{"fr":"Lab","en":"Lab"}', '', 'content', '{"app":"lab","template":"\\/lab"}', '2013-10-16 14:52:08', '2014-05-31 04:49:05', 'live', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`, `owner`) VALUES
(1, 'admin', 'Grand Central', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1, 0),
(2, '77225e2f16f658021e93a8c48830b9c5', '', '2014-05-22 23:20:53', '2014-05-22 23:20:53', 'asleep', 0, 2);

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
('section', 29, 'greenbutton', 'greenbutton', 8, 0),
('section', 29, 'greenbutton', 'greenbutton', 1, 1),
('section', 29, 'greenbutton', 'greenbutton', 2, 2),
('section', 29, 'greenbutton', 'greenbutton', 4, 3),
('section', 29, 'greenbutton', 'greenbutton', 5, 4),
('section', 29, 'greenbutton', 'greenbutton', 12, 5),
('section', 29, 'greenbutton', 'greenbutton', 6, 6),
('section', 29, 'greenbutton', 'greenbutton', 9, 7),
('section', 29, 'greenbutton', 'greenbutton', 7, 8),
('page', 10, 'child', 'page', 5, 0),
('page', 10, 'child', 'page', 6, 1),
('page', 11, 'section', 'section', 20, 0),
('page', 11, 'section', 'section', 4, 1),
('page', 5, 'section', 'section', 9, 0),
('page', 5, 'section', 'section', 1, 1),
('page', 5, 'section', 'section', 10, 2),
('page', 5, 'section', 'section', 6, 3),
('page', 5, 'section', 'section', 7, 4),
('page', 5, 'section', 'section', 8, 5),
('page', 5, 'sectiondefault', 'section', 10, 0),
('page', 5, 'sectiondefault', 'section', 1, 1),
('page', 6, 'section', 'section', 9, 0),
('page', 6, 'section', 'section', 2, 1),
('page', 6, 'section', 'section', 17, 2),
('page', 6, 'section', 'section', 30, 3),
('page', 6, 'section', 'section', 27, 4),
('page', 6, 'sectiondefault', 'section', 2, 0),
('section', 2, 'greenbutton', 'greenbutton', 8, 0),
('section', 2, 'greenbutton', 'greenbutton', 1, 1),
('section', 2, 'greenbutton', 'greenbutton', 2, 2),
('section', 2, 'greenbutton', 'greenbutton', 4, 3),
('section', 2, 'greenbutton', 'greenbutton', 5, 4),
('section', 2, 'greenbutton', 'greenbutton', 12, 5),
('section', 2, 'greenbutton', 'greenbutton', 6, 6),
('section', 2, 'greenbutton', 'greenbutton', 9, 7),
('section', 2, 'greenbutton', 'greenbutton', 7, 8),
('section', 10, 'greenbutton', 'greenbutton', 11, 0),
('section', 20, 'greenbutton', 'greenbutton', 10, 0),
('section', 1, 'greenbutton', 'greenbutton', 3, 0),
('page', 30, 'section', 'section', 28, 0),
('page', 37, 'section', 'section', 31, 0),
('page', 7, 'section', 'section', 3, 0),
('page', 7, 'section', 'section', 4, 1),
('page', 9, 'child', 'page', 37, 0),
('page', 9, 'child', 'page', 29, 1),
('page', 9, 'child', 'page', 7, 2),
('page', 1, 'child', 'page', 32, 0),
('page', 1, 'child', 'page', 9, 1),
('page', 1, 'child', 'page', 10, 2),
('page', 1, 'child', 'page', 11, 3),
('page', 1, 'section', 'section', 9, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
