-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2015 at 10:53 AM
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
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `owner` (`owner`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `title`, `method`, `key`, `owner`, `created`, `updated`, `status`) VALUES
(1, 'Save Preferences', 'get', 'save_pref', 'human_4', '2015-02-18 16:43:20', '2015-02-18 16:56:47', 'live');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=114 ;

--
-- Dumping data for table `const`
--

INSERT INTO `const` (`id`, `key`, `title`, `version`, `created`, `updated`, `status`, `owner`) VALUES
(2, 'NAVCC_SEARCH_NODATA', 'Try searching something, I''m ready.', 1, '0000-00-00 00:00:00', '2013-03-27 15:08:29', 'live', 0),
(3, 'NAVCC_SEARCH_PLACEHOLDER', '{"fr":"Rechercher","en":"Search"}', 1, '2014-05-31 05:45:20', '2014-05-31 05:45:20', 'live', 2),
(4, 'OPTION_FILTER_REFINE', '{"fr":"Rafiner","en":"Refine"}', 1, '2014-05-31 04:52:19', '2014-05-31 04:52:19', 'live', 2),
(6, 'MULTIPLESELECT_AVAILABLE_LABEL', '{"fr":"Disponibles","en":"Available"}', 1, '2014-05-31 04:52:32', '2014-05-31 04:52:32', 'live', 2),
(7, 'MULTIPLESELECT_SELECTED_LABEL', '{"fr":"Sélectionnés","en":"Selected"}', 1, '2014-05-31 04:52:48', '2014-05-31 04:52:48', 'live', 2),
(8, 'MULTIPLESELECT_SELECTED_NODATA', '{"en":"Why don''t you drag and drop items from the list ›","fr":"Essayez de glisser-déposer des items depuis la liste →"}', 1, '2014-05-31 04:53:41', '2015-08-13 20:12:22', 'live', 2),
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
(27, 'TIMELINE_PERIOD_EVENING', '{"en":"This evening","fr":"Ce soir"}', 1, '2013-03-22 15:12:36', '2015-01-12 20:02:27', 'live', 2),
(28, 'TIMELINE_PERIOD_AFTERNOON', '{"fr":"L''après-midi","en":"In the afternoon"}', 1, '2013-03-22 15:13:13', '2014-05-31 04:57:22', 'live', 2),
(29, 'TIMELINE_PERIOD_NOON', '{"fr":"A midi","en":"At noon"}', 1, '2013-03-22 15:13:50', '2014-05-31 04:57:31', 'live', 2),
(30, 'TIMELINE_PERIOD_MORNING', '{"en":"This morning","fr":"Ce matin"}', 1, '2013-03-22 15:14:25', '2015-01-12 20:02:45', 'live', 2),
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
(85, 'OPTIONS_FILTERS_LEGEND_ORDER', '{"fr":"Ordonner","en":"Reorder"}', 1, '2013-10-19 16:12:17', '2014-05-31 05:07:51', 'live', 2),
(86, 'OPTIONS_FILTERS_LEGEND_DISPLAY', '{"fr":"Affichage","en":"Display"}', 1, '2013-10-19 17:10:19', '2014-05-31 05:07:10', 'live', 2),
(87, 'OPTIONS_FILTER_SORT_ASC_TITLE', '{"en":"From last one to first","fr":"Du dernier au premier"}', 1, '2013-10-19 17:11:31', '2014-06-06 23:13:02', 'live', 2),
(88, 'OPTIONS_FILTER_SORT_DESC_TITLE', '{"en":"From first to last","fr":"Du premier au dernier"}', 1, '2013-10-19 17:12:22', '2014-06-06 23:12:50', 'live', 2),
(89, 'OPTIONS_FILTERS_LEGEND_SORT', '{"fr":"Classement","en":"Sort"}', 1, '2013-10-19 17:10:19', '2014-05-31 05:07:27', 'live', 2),
(90, 'OPTIONS_FILTER_DISPLAY_INSTACK_TITLE', '{"fr":"En lignes","en":"In stacks"}', 1, '2013-10-19 17:13:55', '2014-05-31 05:05:46', 'live', 2),
(91, 'OPTIONS_FILTER_DISPLAY_INMASONRY_TITLE', '{"fr":"En masonry","en":"In masonry"}', 1, '2013-10-19 17:14:59', '2014-05-31 05:06:08', 'live', 2),
(93, 'NAV_SUB_H1_PLAYANDFIX', '{"fr":"Jouez & réparez","en":"Play & fix"}', 1, '2014-05-30 04:55:33', '2014-05-31 05:03:23', 'live', 2),
(94, 'NAV_SUB_H1_MAJOR', '{"fr":"Publiés","en":"Online"}', 1, '2014-05-30 04:56:50', '2014-05-31 05:03:57', 'live', 2),
(95, 'NAV_SUB_H1_MINOR', '{"fr":"Mineurs","en":"Minors"}', 1, '2014-05-30 04:57:16', '2014-05-31 05:04:04', 'live', 2),
(96, 'NAV_SUB_H1_SOCIAL', '{"fr":"Social","en":"Social life"}', 1, '2014-05-30 04:57:34', '2014-05-31 05:04:19', 'live', 2),
(97, 'NAV_SUB_H1_DIGEST', '{"en":"In an eyeblink","fr":"D''un coup d''œil"}', 1, '2014-06-02 12:12:43', '2014-06-02 12:12:43', 'live', 2),
(98, 'NAV_SUB_H1_BYEBYE', '{"en":"Bye bye","fr":"Bye bye"}', 1, '2014-06-02 12:13:00', '2014-06-02 12:13:00', 'live', 2),
(99, 'NODATA', '{"en":"Nope, sorry, nothing. Zero. Zilch.","fr":"Rien du tout du tout du tout."}', 1, '2014-06-02 14:17:57', '2014-06-03 10:12:28', 'live', 2),
(100, 'STOPPER', '{"en":"That''s all, folks!","fr":"That''s all, folks!"}', 1, '2014-06-02 14:21:05', '2014-06-02 14:21:05', 'live', 2),
(101, 'DATE_NOW', '{"en":"Just now","fr":"A l''instant"}', 1, '2014-06-03 10:41:16', '2014-06-03 10:42:05', 'trash', 2),
(102, 'EVENTSTREAM_UPDATE', '{"en":"updated","fr":"a mis à jour"}', 1, '2014-12-28 19:26:56', '2014-12-28 19:39:39', 'live', 0),
(103, 'EVENTSTREAM_INSERT', '{"en":"added","fr":"a ajouté"}', 1, '2014-12-28 19:27:19', '2014-12-28 19:33:56', 'live', 0),
(104, 'ZONING_SELECTED_NODATA', '{"en":"No sections in this zone","fr":"Aucune section dans cette zone"}', 1, '2015-01-24 15:24:47', '2015-01-24 15:24:47', 'live', 0),
(105, 'EVENTSTREAM_INSERT_LIVE', '{"en":"Published","fr":"a publié"}', 1, '2015-02-09 03:56:03', '2015-02-09 03:56:03', 'live', 0),
(106, 'EVENTSTREAM_UPDATE_LIVE', '{"en":"Updated","fr":"a modifié"}', 1, '2015-02-09 03:56:33', '2015-02-09 03:56:33', 'live', 0),
(107, 'EVENTSTREAM_INSERT_ASLEEP', '{"en":"put asleep","fr":""}', 1, '2015-02-09 03:57:16', '2015-02-09 03:57:16', 'live', 0),
(108, 'EVENTSTREAM_INSERT_ASLEEP', '{"en":"put asleep","fr":""}', 1, '2015-02-09 03:57:20', '2015-02-09 03:57:20', 'live', 0),
(109, 'EVENTSTREAM_UPDATE_ASLEEP', '{"en":"modified asleep","fr":"a modifié en sommeil"}', 1, '2015-02-09 03:57:34', '2015-02-09 04:00:00', 'live', 0),
(110, 'EVENTSTREAM_INSERT_TRASH', '{"en":"Trashed","fr":"a jeté à la corbeille"}', 1, '2015-02-09 03:57:57', '2015-02-09 03:57:57', 'live', 0),
(111, 'EVENTSTREAM_UPDATE_TRASH', '{"en":"trashed","fr":"a jeté à la corbeille"}', 1, '2015-02-09 03:58:16', '2015-02-09 03:58:16', 'live', 0),
(112, 'EVENTSTREAM_INSERT_DRAFT', '{"en":"started working on","fr":"s''est mis à travaillé sur"}', 1, '2015-02-09 04:11:49', '2015-02-09 04:11:49', 'live', 0),
(113, 'EVENTSTREAM_UPDATE_DRAFT', '{"en":"works on","fr":"travaille sur"}', 1, '2015-02-09 04:12:25', '2015-02-09 04:41:47', 'live', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=191 ;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `system`, `status`, `owner`) VALUES
(1, 'login', 'Login', '', 'login', 'post', 'post', '', '', '{"login":{"type":"text","key":"login","label":"So. My login is","placeholder":"my email address","required":true},"password":{"type":"password","key":"password","label":"and this is","placeholder":"my password","required":true},"save":{"type":"button","buttontype":"submit","key":"save","value":"Now let me in!"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 2),
(141, 'note', 'Notes', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"The unique identifier","type":"hidden","readonly":true},"item":{"key":"item","label":"Item","type":"hidden","min":"","max":"","placeholder":"Item"},"text":{"key":"text","label":"Text","type":"textarea","min":"","max":"","placeholder":"A short description"}}', '2013-09-14 12:53:52', '2013-09-14 12:53:52', 0, 'live', 2),
(164, 'admin_section', 'admin_section', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"zone":{"key":"zone","label":"zone","type":"text","required":"0","min":"0","max":"255"},"app":{"key":"app","label":"app","type":"app"},"created":{"key":"created","label":"created","type":"date"},"updated":{"key":"updated","label":"updated","type":"date"},"status":{"key":"status","label":"status","type":"text"},"greenbutton":{"key":"greenbutton","label":"greenbutton","valuestype":"bunch","values":[{"item":"greenbutton"}],"placeholder":"...","type":"multipleselect","required":"0","min":"","max":""},"owner":{"key":"owner","label":"owner","type":"text"},"nodata":{"key":"nodata","label":"nodata","type":"i18n","field":"fieldText"}}', '2014-05-15 09:47:46', '2015-02-08 23:49:03', 1, 'live', 2),
(177, 'admin_site', 'admin_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"text","required":"1","min":"0","max":"255"},"created":{"key":"created","label":"created","type":"date"},"updated":{"key":"updated","label":"updated","type":"date"},"status":{"key":"status","label":"status","type":"text"},"defaultversion":{"key":"defaultversion","label":"defaultversion","type":"number","required":"0","min":"","max":""},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-05-29 07:02:14', '2015-04-28 11:24:57', 1, 'live', 2),
(178, 'admin_const', 'admin_const', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"version":{"key":"version","label":"version","type":"text"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-05-30 04:55:24', '2014-06-02 12:12:22', 1, 'live', 2),
(179, 'admin_item', 'admin_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text","required":true},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"icon":{"key":"icon","label":"icon","type":"text","required":"0","min":"0","max":"100"},"attr":{"key":"attr","label":"attr","type":"attr"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"hasurl":{"key":"hasurl","label":"hasurl","type":"bool","required":"0"},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-05-31 03:49:54', '2014-06-06 23:55:16', 1, 'live', 2),
(184, 'admin_greenbutton', 'admin_greenbutton', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"created":{"key":"created","label":"created","type":"date"},"updated":{"key":"updated","label":"updated","type":"date"},"status":{"key":"status","label":"status","type":"text"},"icon":{"key":"icon","label":"icon","type":"text","required":"0","min":"0","max":"32"},"owner":{"key":"owner","label":"owner","type":"text"},"cat":{"key":"cat","label":"cat","type":"text","required":"0","min":"0","max":"100"},"andback":{"key":"andback","label":"andback","type":"bool","required":"0"},"andreach":{"key":"andreach","label":"andreach","type":"bool","required":"0"},"live":{"key":"live","label":"live","type":"text"},"color":{"key":"color","label":"color","type":"text","required":"0","min":"0","max":"8"}}', '2014-06-02 14:50:00', '2015-08-13 21:57:14', 1, 'live', 2),
(185, 'admin_version', 'admin_version', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"text","required":"1","min":"0","max":"255"},"lang":{"key":"lang","label":"lang","type":"text","required":"1","min":"0","max":"32"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-06-02 16:11:28', '2014-06-02 16:11:28', 1, 'live', 2),
(186, 'admin_api', 'admin_api', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"title":{"key":"title","label":"title","type":"text","required":"0","min":"0","max":"255"},"method":{"key":"method","label":"method","type":"text","required":"0","min":"0","max":"4"},"key":{"key":"key","label":"key","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"},"created":{"key":"created","label":"created","type":"date"},"updated":{"key":"updated","label":"updated","type":"date"},"status":{"key":"status","label":"status","type":"text"}}', '2015-02-18 16:42:36', '2015-02-18 16:42:36', 1, 'live', 0),
(188, 'hands_page_zoning', 'hands_page_zoning', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","type":"hidden","readonly":true},"section":{"key":"section","type":"zoning"}}', '2015-08-12 01:38:19', '2015-08-12 01:38:19', 1, 'live', 0),
(189, 'admin_workflow', 'admin_workflow', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"item":{"key":"item","label":"item","type":"textarea","required":"0","min":"0","max":"500"},"original":{"key":"original","label":"original","type":"select","valuestype":"bunch","placeholder":"...","values":null,"required":"1"},"owner":{"key":"owner","label":"owner","type":"text"},"created":{"key":"created","label":"created","type":"date"},"updated":{"key":"updated","label":"updated","type":"date"},"status":{"key":"status","label":"status","type":"text"},"data":{"key":"data","label":"data","type":"text","required":"0"}}', '2015-08-12 12:05:06', '2015-08-12 12:05:06', 1, 'live', 0),
(190, 'admin_page', 'admin_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"i18n","field":"fieldText"},"type":{"key":"type","label":"type","type":"pagetype"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"500"},"text":{"key":"text","label":"text","type":"textarea","required":"0","min":"0","max":"65035"},"url":{"key":"url","label":"url","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"created":{"key":"created","label":"created","type":"date"},"updated":{"key":"updated","label":"updated","type":"date"},"status":{"key":"status","label":"status","type":"text"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"placeholder":"...","type":"multipleselect","required":"0","min":"","max":""},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"placeholder":"...","type":"multipleselect","required":"0","min":"","max":""},"sectiondefault":{"key":"sectiondefault","label":"sectiondefault","valuestype":"bunch","values":[{"item":"section"}],"placeholder":"...","type":"multipleselect","required":"0","min":"","max":""},"owner":{"key":"owner","label":"owner","type":"text"}}', '2015-08-12 12:20:33', '2015-08-12 12:20:33', 1, 'live', 0);

-- --------------------------------------------------------

--
-- Table structure for table `greenbutton`
--

CREATE TABLE `greenbutton` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `cat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `andback` tinyint(1) NOT NULL,
  `andreach` tinyint(1) NOT NULL,
  `live` tinyint(1) NOT NULL,
  `color` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `greenbutton`
--

INSERT INTO `greenbutton` (`id`, `key`, `title`, `created`, `updated`, `status`, `icon`, `owner`, `cat`, `andback`, `andreach`, `live`, `color`) VALUES
(1, 'save', '{"en":"Save","fr":"Sauvegarder"}', '2014-06-02 14:50:17', '2015-08-13 22:32:46', 'live', '', '2', 'save', 1, 1, 0, '388E3C'),
(2, 'asleep', '{"en":"Put asleep","fr":"Mettre en sommeil"}', '2014-06-02 15:00:50', '2015-08-13 22:32:48', 'live', '', '2', 'status', 1, 0, 0, '01579B'),
(3, 'new', '{"en":"New","fr":"Ajouter"}', '2014-06-02 15:01:05', '2015-08-13 22:25:42', 'live', '', '2', '', 0, 0, 0, '6cbf2d'),
(5, 'save_copy', '{"en":"Save as a copy","fr":"Sauvegarder comme copie"}', '2014-06-02 14:53:57', '2015-08-13 22:32:31', 'live', '', '2', 'save', 0, 0, 0, '66BB6A'),
(6, 'save_new', '{"en":"Save & start a new one","fr":"Sauvegarder & ouvrir un nouveau"}', '2014-06-02 15:02:35', '2015-08-13 22:32:33', 'live', '', '2', 'save', 0, 0, 0, '81C784'),
(7, 'trash', '{"en":"Move to trash","fr":"Jeter à la corbeille"}', '2014-06-02 14:59:21', '2015-08-13 22:32:43', 'live', '', '2', 'archive', 1, 0, 0, '666666'),
(8, 'live', '{"en":"Go live","fr":"Publier"}', '2014-06-02 15:00:35', '2015-08-13 22:32:51', 'live', '', '2', 'status', 1, 1, 0, '6cbf2d'),
(9, 'workflow', '{"en":"Back to the workflow","fr":"Remettre dans le workflow"}', '2014-06-02 15:00:00', '2015-08-13 22:32:39', 'live', '', '2', '', 0, 0, 0, '9C27B0'),
(10, 'buildapp', '{"en":"Build an app!","fr":"Constuire une app!"}', '2013-03-22 08:57:22', '2015-08-13 22:32:29', 'live', '', '2', '', 0, 0, 0, ''),
(11, 'newpage', '{"en":"Add a page to the tree","fr":"Ajouter une page à l''arborescence"}', '2013-10-23 02:14:09', '2015-08-13 22:33:37', 'live', '', '2', '', 0, 0, 0, ''),
(12, 'preview', '{"en":"Preview","fr":"Previsualisation"}', '2013-10-28 10:39:50', '2015-08-13 22:16:48', 'live', '', '2', 'check', 0, 0, 0, '607D8B'),
(14, 'newsystem', '{"en":"Add to the system","fr":"Ajouter au système"}', '2014-07-28 11:11:39', '2015-08-13 22:32:37', 'live', '', '2', '', 0, 0, 0, '4A148C'),
(15, 'newworkflow', '{"en":"New workflow","fr":"Nouveau workflow"}', '2014-08-11 21:19:29', '2015-08-13 22:32:15', 'live', '', '2', '', 0, 0, 0, ''),
(16, 'googlepreview', '{"en":"See what Google sees","fr":"Voyez ce que Google vois"}', '2015-01-06 21:28:39', '2015-08-13 22:16:57', 'live', '', 'human_2', 'check', 0, 0, 0, '546E7A'),
(17, 'savecontext_zoning', '{"en":"Save section","fr":"Sauvegarder cette section"}', '2015-04-20 14:44:19', '2015-08-13 22:32:42', 'live', '', 'human_2', '', 0, 0, 0, '4CAF50'),
(18, 'savecontext_multipleselect', '{"en":"Sauvegarder les modifications","fr":"Save changes"}', '2015-04-20 18:33:12', '2015-08-15 14:58:04', 'live', '', 'human_2', '', 0, 0, 0, '4CAF50'),
(19, 'edititem', '{"en":"Edit Item","fr":"Modifier l''item"}', '2015-08-13 22:27:48', '2015-08-13 22:27:48', 'live', '&#xe079', 'human_2', '', 0, 0, 0, '7E57C2');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `attr` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `hasurl` tinyint(1) NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `key`, `title`, `icon`, `attr`, `system`, `created`, `updated`, `status`, `hasurl`, `owner`) VALUES
(1, 'item', '{"en":"Items","fr":"items"}', '019', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldText"},"icon":{"key":"icon","type":"string","required":"0","min":"0","max":"100"},"attr":{"key":"attr","type":"array"},"system":{"key":"system","type":"bool","required":"0"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"hasurl":{"key":"hasurl","type":"bool","required":"0"},"owner":{"key":"owner","type":"owner"}}', 1, '2013-11-17 14:17:07', '2014-06-02 11:45:45', 'live', 0, 2),
(2, 'site', '{"en":"Sites","fr":"Sites"}', '064', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"defaultversion":{"key":"defaultversion","type":"int","required":"0","min":"","max":""},"owner":{"key":"owner","type":"owner"}}', 1, '2013-11-17 14:17:07', '2014-06-02 11:46:18', 'live', 0, 2),
(3, 'page', '{"en":"Pages","fr":"Pages"}', '081', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldText"},"type":{"key":"type","type":"array"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"text":{"key":"text","type":"string","required":"0","min":"0","max":"65035"},"url":{"key":"url","type":"url"},"system":{"key":"system","type":"bool","required":"0"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"child":{"key":"child","type":"rel","required":"0","param":[{"item":"page"}],"min":"","max":""},"section":{"key":"section","type":"rel","required":"0","param":[{"item":"section"}],"min":"","max":""},"sectiondefault":{"key":"sectiondefault","type":"rel","required":"0","param":[{"item":"section"}],"min":"","max":""},"owner":{"key":"owner","type":"owner"}}', 1, '2013-11-17 14:17:07', '2014-06-02 11:42:35', 'live', 1, 2),
(4, 'version', '{"en":"Versions","fr":"Versions"}', '031', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"lang":{"key":"lang","type":"string","required":"1","min":"0","max":"32"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', 1, '2013-11-17 14:17:07', '2014-06-02 11:41:57', 'live', 0, 2),
(5, 'const', '{"en":"Labels","fr":"Intitulés"}', '028', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldText"},"version":{"key":"version","type":"version"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', 1, '2013-11-17 14:17:07', '2014-06-02 11:43:48', 'live', 0, 2),
(6, 'form', '{"en":"Forms","fr":"Formulaires"}', '068', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"template":{"key":"template","type":"string","required":"1","min":"0","max":"5000"},"action":{"key":"action","type":"string","required":"1","min":"0","max":"5000"},"method":{"key":"method","type":"list","required":"1"},"target":{"key":"target","type":"string","required":"0","min":"0","max":"5000"},"enctype":{"key":"enctype","type":"list","required":"1"},"field":{"key":"field","type":"array"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"system":{"key":"system","type":"bool","required":"0"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', 1, '2013-09-27 08:33:31', '2014-06-02 11:46:39', 'live', 0, 2),
(7, 'section', '{"en":"Sections","fr":"Sections"}', '004', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldText"},"zone":{"key":"zone","type":"string","required":"0","min":"0","max":"255"},"app":{"key":"app","type":"array"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"greenbutton":{"key":"greenbutton","type":"rel","required":"0","param":[{"item":"greenbutton"}],"min":"","max":""},"owner":{"key":"owner","type":"owner"},"nodata":{"key":"nodata","type":"i18n","field":"fieldText"}}', 1, '2013-09-25 08:33:09', '2015-01-24 21:49:43', 'live', 0, 2),
(8, 'greenbutton', '{"en":"Green button actions","fr":"Actions du bouton vert"}', '044', '{"id":{"key":"id","type":"id","field":""},"key":{"key":"key","type":"key","field":""},"title":{"key":"title","type":"i18n","field":"fieldText","attr":"attrString"},"created":{"key":"created","type":"created","field":""},"updated":{"key":"updated","type":"updated","field":""},"status":{"key":"status","type":"status","field":""},"icon":{"key":"icon","type":"string","required":"0","field":"","min":"0","max":"32"},"owner":{"key":"owner","type":"owner","field":""},"cat":{"key":"cat","type":"string","required":"0","field":"","min":"0","max":"100"},"andback":{"key":"andback","type":"bool","required":"0","field":""},"andreach":{"key":"andreach","type":"bool","required":"0","field":""},"live":{"key":"live","type":"live","field":""},"color":{"key":"color","type":"string","required":"0","field":"","min":"0","max":"8"}}', 1, '2013-09-25 08:33:09', '2015-08-13 21:57:07', 'live', 0, 2),
(9, 'logbook', '{"en":"Logs","fr":"Logs"}', '030', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"subject":{"key":"subject","type":"string","required":"0","min":"0","max":"5000"},"subjectid":{"key":"subjectid","type":"int","required":"0","min":"","max":""},"item":{"key":"item","type":"string","required":"0","min":"0","max":"5000"},"itemid":{"key":"itemid","type":"int","required":"0","min":"","max":""},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', 1, '2013-11-17 14:17:07', '2014-06-02 11:42:02', 'live', 0, 2),
(10, 'note', '{"en":"Notes","fr":"Notes"}', '076', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"item":{"key":"item","type":"string","required":"1","min":"0","max":"5000"},"itemid":{"key":"itemid","type":"int","required":"1","min":"","max":""},"content":{"key":"content","type":"string","required":"1","min":"0","max":"5000"},"owner":{"key":"owner","type":"owner"}}', 1, '2013-10-20 22:59:08', '2014-06-02 11:46:57', 'live', 0, 2),
(11, 'api', '{"en":"API","fr":"API"}', '', '{"id":{"key":"id","type":"id"},"title":{"key":"title","type":"string","required":"0","min":"0","max":"255"},"method":{"key":"method","type":"string","required":"0","min":"0","max":"4"},"key":{"key":"key","type":"key"},"owner":{"key":"owner","type":"owner"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"}}', 1, '2015-02-18 16:41:38', '2015-02-18 16:41:38', 'live', 0, 2),
(12, 'workflow', '{"en":"Workflow","fr":"Workflow"}', '', '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"item":{"key":"item","type":"string","required":"0","min":"0","max":"500"},"original":{"key":"original","type":"item","required":"1"},"owner":{"key":"owner","type":"owner"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"data":{"key":"data","type":"object","required":"0"}}', 1, '2014-05-24 17:54:44', '2014-09-02 22:13:36', 'live', 0, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=499 ;

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
(73, 'insert', 'human', 2, 'form', 39, '2013-10-20 23:02:25', '2013-10-20 23:02:25', 'live', 0),
(74, 'insert', 'human', 2, 'form', 64, '2013-10-23 02:13:41', '2013-10-23 02:13:41', 'live', 0),
(75, 'insert', 'human', 2, 'greenbutton', 11, '2013-10-23 02:14:09', '2013-10-23 02:14:09', 'live', 0),
(76, 'insert', 'human', 2, 'form', 65, '2013-10-23 02:14:26', '2013-10-23 02:14:26', 'live', 0),
(77, 'update', 'human', 2, 'section', 10, '2013-10-23 02:14:52', '2013-10-23 02:14:52', 'live', 0),
(78, 'insert', 'human', 2, 'form', 74, '2013-10-25 12:58:52', '2013-10-25 12:58:52', 'live', 0),
(79, 'insert', 'human', 2, 'const', 92, '2013-10-25 12:59:07', '2013-10-25 12:59:07', 'live', 0),
(80, 'insert', 'human', 2, 'form', 76, '2013-10-28 10:39:22', '2013-10-28 10:39:22', 'live', 0),
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
(213, 'update', 'human', 2, 'const', 64, '2014-05-31 05:46:41', '2014-05-31 05:46:41', 'live', 2),
(214, 'update', 'human', 2, 'section', 2, '2014-06-01 07:45:06', '2014-06-01 07:45:06', 'live', 2),
(215, 'update', 'human', 2, 'item', 8, '2014-06-01 14:02:20', '2014-06-01 14:02:20', 'live', 2),
(216, 'update', 'human', 2, 'item', 8, '2014-06-02 11:17:23', '2014-06-02 11:17:23', 'live', 2),
(217, 'update', 'human', 2, 'item', 1, '2014-06-02 11:27:08', '2014-06-02 11:27:08', 'live', 2),
(218, 'update', 'human', 2, 'form', 179, '2014-06-02 11:27:30', '2014-06-02 11:27:30', 'live', 2),
(219, 'update', 'human', 2, 'item', 1, '2014-06-02 11:27:45', '2014-06-02 11:27:45', 'live', 2),
(220, 'update', 'human', 2, 'form', 179, '2014-06-02 11:28:13', '2014-06-02 11:28:13', 'live', 2),
(221, 'update', 'human', 2, 'item', 1, '2014-06-02 11:29:24', '2014-06-02 11:29:24', 'live', 2),
(222, 'update', 'human', 2, 'form', 179, '2014-06-02 11:29:39', '2014-06-02 11:29:39', 'live', 2),
(223, 'update', 'human', 2, 'item', 4, '2014-06-02 11:30:00', '2014-06-02 11:30:00', 'live', 2),
(224, 'update', 'human', 2, 'item', 6, '2014-06-02 11:30:19', '2014-06-02 11:30:19', 'live', 2),
(225, 'update', 'human', 2, 'item', 4, '2014-06-02 11:30:35', '2014-06-02 11:30:35', 'live', 2),
(226, 'update', 'human', 2, 'item', 9, '2014-06-02 11:30:48', '2014-06-02 11:30:48', 'live', 2),
(227, 'update', 'human', 2, 'item', 10, '2014-06-02 11:30:58', '2014-06-02 11:30:58', 'live', 2),
(228, 'update', 'human', 2, 'item', 2, '2014-06-02 11:31:07', '2014-06-02 11:31:07', 'live', 2),
(229, 'update', 'human', 2, 'item', 5, '2014-06-02 11:31:24', '2014-06-02 11:31:24', 'live', 2),
(230, 'update', 'human', 2, 'item', 3, '2014-06-02 11:31:35', '2014-06-02 11:31:35', 'live', 2),
(231, 'update', 'human', 2, 'item', 7, '2014-06-02 11:31:44', '2014-06-02 11:31:44', 'live', 2),
(232, 'update', 'human', 2, 'item', 8, '2014-06-02 11:32:02', '2014-06-02 11:32:02', 'live', 2),
(233, 'update', 'human', 2, 'item', 1, '2014-06-02 11:32:45', '2014-06-02 11:32:45', 'live', 2),
(234, 'update', 'human', 2, 'form', 179, '2014-06-02 11:40:29', '2014-06-02 11:40:29', 'live', 2),
(235, 'update', 'human', 2, 'item', 1, '2014-06-02 11:41:10', '2014-06-02 11:41:10', 'live', 2),
(236, 'update', 'human', 2, 'form', 179, '2014-06-02 11:41:15', '2014-06-02 11:41:15', 'live', 2),
(237, 'update', 'human', 2, 'item', 4, '2014-06-02 11:41:57', '2014-06-02 11:41:57', 'live', 2),
(238, 'update', 'human', 2, 'item', 9, '2014-06-02 11:42:02', '2014-06-02 11:42:02', 'live', 2),
(239, 'update', 'human', 2, 'item', 3, '2014-06-02 11:42:35', '2014-06-02 11:42:35', 'live', 2),
(240, 'update', 'human', 2, 'item', 7, '2014-06-02 11:42:53', '2014-06-02 11:42:53', 'live', 2),
(241, 'update', 'human', 2, 'item', 7, '2014-06-02 11:43:31', '2014-06-02 11:43:31', 'live', 2),
(242, 'update', 'human', 2, 'item', 5, '2014-06-02 11:43:48', '2014-06-02 11:43:48', 'live', 2),
(243, 'update', 'human', 2, 'item', 8, '2014-06-02 11:45:09', '2014-06-02 11:45:09', 'live', 2),
(244, 'update', 'human', 2, 'item', 1, '2014-06-02 11:45:45', '2014-06-02 11:45:45', 'live', 2),
(245, 'update', 'human', 2, 'item', 2, '2014-06-02 11:46:18', '2014-06-02 11:46:18', 'live', 2),
(246, 'update', 'human', 2, 'item', 6, '2014-06-02 11:46:39', '2014-06-02 11:46:39', 'live', 2),
(247, 'update', 'human', 2, 'item', 10, '2014-06-02 11:46:57', '2014-06-02 11:46:57', 'live', 2),
(248, 'update', 'human', 2, 'form', 178, '2014-06-02 12:12:22', '2014-06-02 12:12:22', 'live', 2),
(249, 'insert', 'human', 2, 'const', 97, '2014-06-02 12:12:43', '2014-06-02 12:12:43', 'live', 2),
(250, 'insert', 'human', 2, 'const', 98, '2014-06-02 12:13:00', '2014-06-02 12:13:00', 'live', 2),
(251, 'insert', 'human', 2, 'const', 100, '2014-06-02 14:21:05', '2014-06-02 14:21:05', 'live', 2),
(252, 'update', 'human', 2, 'form', 164, '2014-06-02 14:26:44', '2014-06-02 14:26:44', 'live', 2),
(253, 'insert', 'human', 2, 'form', 184, '2014-06-02 14:50:00', '2014-06-02 14:50:00', 'live', 2),
(254, 'update', 'human', 2, 'greenbutton', 1, '2014-06-02 14:50:17', '2014-06-02 14:50:17', 'live', 2),
(255, 'update', 'human', 2, 'greenbutton', 4, '2014-06-02 14:53:31', '2014-06-02 14:53:31', 'live', 2),
(256, 'update', 'human', 2, 'greenbutton', 5, '2014-06-02 14:53:57', '2014-06-02 14:53:57', 'live', 2),
(257, 'update', 'human', 2, 'greenbutton', 7, '2014-06-02 14:59:21', '2014-06-02 14:59:21', 'live', 2),
(258, 'update', 'human', 2, 'greenbutton', 9, '2014-06-02 15:00:00', '2014-06-02 15:00:00', 'live', 2),
(259, 'update', 'human', 2, 'greenbutton', 13, '2014-06-02 15:00:19', '2014-06-02 15:00:19', 'live', 2),
(260, 'update', 'human', 2, 'greenbutton', 8, '2014-06-02 15:00:35', '2014-06-02 15:00:35', 'live', 2),
(261, 'update', 'human', 2, 'greenbutton', 2, '2014-06-02 15:00:50', '2014-06-02 15:00:50', 'live', 2),
(262, 'update', 'human', 2, 'greenbutton', 3, '2014-06-02 15:01:05', '2014-06-02 15:01:05', 'live', 2),
(263, 'update', 'human', 2, 'greenbutton', 10, '2014-06-02 15:01:21', '2014-06-02 15:01:21', 'live', 2),
(264, 'update', 'human', 2, 'greenbutton', 11, '2014-06-02 15:02:02', '2014-06-02 15:02:02', 'live', 2),
(265, 'update', 'human', 2, 'greenbutton', 12, '2014-06-02 15:02:14', '2014-06-02 15:02:14', 'live', 2),
(266, 'update', 'human', 2, 'greenbutton', 6, '2014-06-02 15:02:35', '2014-06-02 15:02:35', 'live', 2),
(267, 'update', 'human', 2, 'greenbutton', 5, '2014-06-02 15:10:22', '2014-06-02 15:10:22', 'live', 2),
(268, 'insert', 'human', 2, 'form', 185, '2014-06-02 16:11:28', '2014-06-02 16:11:28', 'live', 2),
(269, 'update', 'human', 2, 'const', 99, '2014-06-03 10:12:28', '2014-06-03 10:12:28', 'live', 2),
(270, 'insert', 'human', 2, 'form', 3, '2014-06-03 10:30:54', '2014-06-03 10:30:54', 'live', 2),
(271, 'insert', 'human', 2, 'const', 101, '2014-06-03 10:41:16', '2014-06-03 10:41:16', 'live', 2),
(272, 'update', 'human', 2, 'const', 101, '2014-06-03 10:42:05', '2014-06-03 10:42:05', 'live', 2),
(273, 'update', 'human', 2, 'const', 88, '2014-06-06 23:12:50', '2014-06-06 23:12:50', 'live', 2),
(274, 'update', 'human', 2, 'const', 87, '2014-06-06 23:13:02', '2014-06-06 23:13:02', 'live', 2),
(275, 'update', 'human', 2, 'form', 179, '2014-06-06 23:55:16', '2014-06-06 23:55:16', 'live', 2),
(276, 'update', 'human', 2, 'form', 175, '2014-06-06 23:55:43', '2014-06-06 23:55:43', 'live', 2),
(277, 'insert', 'human', 2, 'greenbutton', 14, '2014-07-28 11:11:39', '2014-07-28 11:11:39', 'live', 2),
(278, 'update', 'human', 2, 'greenbutton', 14, '2014-07-28 11:11:58', '2014-07-28 11:11:58', 'live', 2),
(279, 'update', 'human', 2, 'section', 6, '2014-07-28 11:16:15', '2014-07-28 11:16:15', 'live', 2),
(280, 'update', 'human', 2, 'greenbutton', 14, '2014-07-28 11:26:03', '2014-07-28 11:26:03', 'live', 2),
(281, 'update', 'human', 2, 'greenbutton', 14, '2014-07-28 11:26:39', '2014-07-28 11:26:39', 'live', 2),
(282, 'update', 'human', 2, 'section', 7, '2014-07-28 11:27:28', '2014-07-28 11:27:28', 'live', 2),
(283, 'update', 'human', 2, 'section', 8, '2014-07-28 11:27:35', '2014-07-28 11:27:35', 'live', 2),
(284, 'update', 'human', 2, 'greenbutton', 14, '2014-07-28 11:35:37', '2014-07-28 11:35:37', 'live', 2),
(285, 'insert', 'human', 2, 'site', 3, '2014-08-07 02:48:28', '2014-08-07 02:48:28', 'live', 2),
(286, 'insert', 'human', 2, 'greenbutton', 15, '2014-08-11 21:19:29', '2014-08-11 21:19:29', 'live', 2),
(287, 'update', 'human', 2, 'section', 30, '2014-08-11 21:20:38', '2014-08-11 21:20:38', 'live', 2),
(288, 'update', 'human', 2, 'item', 7, '2014-12-20 14:56:38', '2014-12-20 14:56:38', 'live', 0),
(289, 'update', 'human', 2, 'form', 164, '2014-12-20 14:58:16', '2014-12-20 14:58:16', 'live', 0),
(290, 'update', 'human', 2, 'section', 31, '2014-12-20 14:59:42', '2014-12-20 14:59:42', 'live', 0),
(291, 'update', 'human', 2, 'section', 9, '2014-12-20 15:00:30', '2014-12-20 15:00:30', 'live', 0),
(292, 'update', 'human', 2, 'section', 27, '2014-12-20 15:01:12', '2014-12-20 15:01:12', 'live', 0),
(293, 'update', 'human', 2, 'section', 1, '2014-12-20 15:01:58', '2014-12-20 15:01:58', 'live', 0),
(294, 'update', 'human', 2, 'section', 6, '2014-12-20 15:18:07', '2014-12-20 15:18:07', 'live', 0),
(295, 'update', 'human', 2, 'section', 7, '2014-12-20 15:18:21', '2014-12-20 15:18:21', 'live', 0),
(296, 'update', 'human', 2, 'section', 8, '2014-12-20 15:18:35', '2014-12-20 15:18:35', 'live', 0),
(297, 'update', 'human', 2, 'section', 30, '2014-12-20 15:18:56', '2014-12-20 15:18:56', 'live', 0),
(298, 'update', 'human', 2, 'section', 25, '2014-12-20 15:19:16', '2014-12-20 15:19:16', 'live', 0),
(299, 'insert', 'human', 2, 'const', 102, '2014-12-28 19:26:56', '2014-12-28 19:26:56', 'live', 0),
(300, 'insert', 'human', 2, 'const', 103, '2014-12-28 19:27:19', '2014-12-28 19:27:19', 'live', 0),
(301, 'update', 'human', 2, 'const', 103, '2014-12-28 19:28:25', '2014-12-28 19:28:25', 'live', 0),
(302, 'update', 'human', 2, 'const', 102, '2014-12-28 19:28:40', '2014-12-28 19:28:40', 'live', 0),
(303, 'update', 'human', 2, 'const', 103, '2014-12-28 19:33:56', '2014-12-28 19:33:56', 'live', 0),
(304, 'update', 'human', 2, 'const', 102, '2014-12-28 19:39:39', '2014-12-28 19:39:39', 'live', 0),
(305, 'update', 'human', 2, 'section', 10, '2014-12-29 14:01:36', '2014-12-29 14:01:36', 'live', 0),
(306, 'insert', 'human', 2, 'greenbutton', 16, '2015-01-06 21:28:39', '2015-01-06 21:28:39', 'live', 0),
(307, 'update', 'human', 2, 'section', 2, '2015-01-06 21:31:03', '2015-01-06 21:31:03', 'live', 0),
(308, 'update', 'human', 2, 'greenbutton', 16, '2015-01-06 21:31:18', '2015-01-06 21:31:18', 'live', 0),
(309, 'update', 'human', 2, 'item', 8, '2015-01-06 21:35:32', '2015-01-06 21:35:32', 'live', 0),
(310, 'update', 'human', 2, 'form', 184, '2015-01-06 21:36:00', '2015-01-06 21:36:00', 'live', 0),
(311, 'update', 'human', 2, 'greenbutton', 16, '2015-01-06 21:36:06', '2015-01-06 21:36:06', 'live', 0),
(312, 'update', 'human', 2, 'greenbutton', 12, '2015-01-06 21:36:11', '2015-01-06 21:36:11', 'live', 0),
(313, 'update', 'human', 2, 'greenbutton', 1, '2015-01-06 21:39:17', '2015-01-06 21:39:17', 'live', 0),
(314, 'update', 'human', 2, 'greenbutton', 4, '2015-01-06 21:39:24', '2015-01-06 21:39:24', 'live', 0),
(315, 'update', 'human', 2, 'greenbutton', 6, '2015-01-06 21:39:28', '2015-01-06 21:39:28', 'live', 0),
(316, 'update', 'human', 2, 'greenbutton', 13, '2015-01-06 21:39:33', '2015-01-06 21:39:33', 'live', 0),
(317, 'update', 'human', 2, 'greenbutton', 8, '2015-01-06 21:39:37', '2015-01-06 21:39:37', 'live', 0),
(318, 'update', 'human', 2, 'greenbutton', 5, '2015-01-06 21:39:40', '2015-01-06 21:39:40', 'live', 0),
(319, 'update', 'human', 2, 'section', 2, '2015-01-06 22:03:51', '2015-01-06 22:03:51', 'live', 0),
(320, 'update', 'human', 2, 'section', 2, '2015-01-06 22:04:12', '2015-01-06 22:04:12', 'live', 0),
(321, 'update', 'human', 2, 'section', 2, '2015-01-06 22:04:31', '2015-01-06 22:04:31', 'live', 0),
(322, 'update', 'human', 2, 'greenbutton', 6, '2015-01-06 22:34:26', '2015-01-06 22:34:26', 'live', 0),
(323, 'update', 'human', 2, 'greenbutton', 6, '2015-01-06 22:34:31', '2015-01-06 22:34:31', 'live', 0),
(324, 'update', 'human', 2, 'greenbutton', 6, '2015-01-06 22:34:34', '2015-01-06 22:34:34', 'live', 0),
(325, 'update', 'human', 2, 'greenbutton', 6, '2015-01-06 22:34:41', '2015-01-06 22:34:41', 'live', 0),
(326, 'update', 'human', 2, 'greenbutton', 16, '2015-01-07 02:21:05', '2015-01-07 02:21:05', 'live', 0),
(327, 'update', 'human', 4, 'const', 27, '2015-01-12 20:02:27', '2015-01-12 20:02:27', 'live', 0),
(328, 'update', 'human', 4, 'const', 30, '2015-01-12 20:02:45', '2015-01-12 20:02:45', 'live', 0),
(329, 'insert', 'human', 4, 'page', 38, '2015-01-19 19:02:07', '2015-01-19 19:02:07', 'live', 0),
(330, 'update', 'human', 4, 'page', 38, '2015-01-19 19:05:48', '2015-01-19 19:05:48', 'live', 0),
(331, 'update', 'human', 4, 'page', 38, '2015-01-19 19:08:56', '2015-01-19 19:08:56', 'live', 0),
(332, 'update', 'human', 4, 'section', 17, '2015-01-24 13:38:24', '2015-01-24 13:38:24', 'live', 0),
(333, 'insert', 'human', 4, 'const', 104, '2015-01-24 15:24:47', '2015-01-24 15:24:47', 'live', 0),
(334, 'update', 'human', 4, 'item', 7, '2015-01-24 21:49:43', '2015-01-24 21:49:43', 'live', 0),
(335, 'update', 'human', 4, 'greenbutton', 8, '2015-02-08 23:48:10', '2015-02-08 23:48:10', 'live', 0),
(336, 'update', 'human', 4, 'form', 164, '2015-02-08 23:49:03', '2015-02-08 23:49:03', 'live', 0),
(337, 'update', 'human', 4, 'section', 2, '2015-02-08 23:49:16', '2015-02-08 23:49:16', 'live', 0),
(338, 'update', 'human', 4, 'greenbutton', 12, '2015-02-08 23:49:45', '2015-02-08 23:49:45', 'live', 0),
(339, 'update', 'human', 4, 'greenbutton', 16, '2015-02-08 23:49:51', '2015-02-08 23:49:51', 'live', 0),
(340, 'update', 'human', 4, 'greenbutton', 2, '2015-02-08 23:51:37', '2015-02-08 23:51:37', 'live', 0),
(341, 'update', 'human', 4, 'greenbutton', 7, '2015-02-08 23:51:40', '2015-02-08 23:51:40', 'live', 0),
(342, 'insert', 'human', 4, 'const', 105, '2015-02-09 03:56:03', '2015-02-09 03:56:03', 'live', 0),
(343, 'insert', 'human', 4, 'const', 106, '2015-02-09 03:56:33', '2015-02-09 03:56:33', 'live', 0),
(344, 'insert', 'human', 4, 'const', 107, '2015-02-09 03:57:16', '2015-02-09 03:57:16', 'live', 0),
(345, 'insert', 'human', 4, 'const', 108, '2015-02-09 03:57:20', '2015-02-09 03:57:20', 'live', 0),
(346, 'insert', 'human', 4, 'const', 109, '2015-02-09 03:57:34', '2015-02-09 03:57:34', 'live', 0),
(347, 'insert', 'human', 4, 'const', 110, '2015-02-09 03:57:57', '2015-02-09 03:57:57', 'live', 0),
(348, 'insert', 'human', 4, 'const', 111, '2015-02-09 03:58:16', '2015-02-09 03:58:16', 'live', 0),
(349, 'update', 'human', 4, 'const', 109, '2015-02-09 03:59:43', '2015-02-09 03:59:43', 'live', 0),
(350, 'update', 'human', 4, 'const', 109, '2015-02-09 04:00:00', '2015-02-09 04:00:00', 'live', 0),
(351, 'insert', 'human', 4, 'const', 112, '2015-02-09 04:11:49', '2015-02-09 04:11:49', 'live', 0),
(352, 'insert', 'human', 4, 'const', 113, '2015-02-09 04:12:25', '2015-02-09 04:12:25', 'live', 0),
(353, 'update', 'human', 4, 'item', 8, '2015-02-09 04:16:00', '2015-02-09 04:16:00', 'live', 0),
(354, 'update', 'human', 4, 'form', 184, '2015-02-09 04:16:21', '2015-02-09 04:16:21', 'live', 0),
(355, 'update', 'human', 4, 'greenbutton', 13, '2015-02-09 04:16:29', '2015-02-09 04:16:29', 'live', 0),
(356, 'update', 'human', 4, 'greenbutton', 4, '2015-02-09 04:16:33', '2015-02-09 04:16:33', 'live', 0),
(357, 'update', 'human', 4, 'greenbutton', 4, '2015-02-09 04:16:50', '2015-02-09 04:16:50', 'live', 0),
(358, 'update', 'human', 4, 'greenbutton', 7, '2015-02-09 04:18:02', '2015-02-09 04:18:02', 'live', 0),
(359, 'update', 'human', 4, 'greenbutton', 2, '2015-02-09 04:18:09', '2015-02-09 04:18:09', 'live', 0),
(360, 'update', 'human', 4, 'greenbutton', 8, '2015-02-09 04:18:15', '2015-02-09 04:18:15', 'live', 0),
(361, 'update', 'human', 4, 'greenbutton', 1, '2015-02-09 04:18:28', '2015-02-09 04:18:28', 'live', 0),
(362, 'update', 'human', 4, 'const', 113, '2015-02-09 04:41:47', '2015-02-09 04:41:47', 'live', 0),
(363, 'update', 'human', 4, 'const', 8, '2015-02-09 07:28:56', '2015-02-09 07:28:56', 'live', 0),
(364, 'update', 'human', 4, 'const', 8, '2015-02-09 07:29:36', '2015-02-09 07:29:36', 'live', 0),
(365, 'insert', 'human', 4, 'page', 39, '2015-02-16 15:47:39', '2015-02-16 15:47:39', 'live', 0),
(366, 'insert', 'human', 4, 'item', 11, '2015-02-18 16:41:38', '2015-02-18 16:41:38', 'live', 0),
(367, 'insert', 'human', 4, 'form', 186, '2015-02-18 16:42:36', '2015-02-18 16:42:36', 'live', 0),
(368, 'insert', 'human', 4, 'api', 1, '2015-02-18 16:43:20', '2015-02-18 16:43:20', 'live', 0),
(369, 'insert', 'human', 4, 'api', 2, '2015-02-18 16:43:24', '2015-02-18 16:43:24', 'live', 0),
(370, 'update', 'human', 4, 'api', 1, '2015-02-18 16:56:47', '2015-02-18 16:56:47', 'live', 0),
(371, 'update', 'human', 2, 'page', 39, '2015-02-20 16:53:36', '2015-02-20 16:53:36', 'live', 0),
(372, 'update', 'human', 2, 'page', 31, '2015-02-20 16:59:09', '2015-02-20 16:59:09', 'live', 0),
(373, 'update', 'human', 2, 'page', 31, '2015-02-20 17:12:32', '2015-02-20 17:12:32', 'live', 0),
(374, 'update', 'human', 2, 'page', 31, '2015-02-20 17:19:56', '2015-02-20 17:19:56', 'live', 0),
(375, 'update', 'human', 2, 'page', 31, '2015-02-20 17:22:30', '2015-02-20 17:22:30', 'live', 0),
(376, 'update', 'human', 2, 'page', 31, '2015-02-20 17:23:09', '2015-02-20 17:23:09', 'live', 0),
(377, 'update', 'human', 2, 'section', 2, '2015-04-15 14:50:19', '2015-04-15 14:50:19', 'live', 0),
(378, 'update', 'human', 2, 'section', 17, '2015-04-20 14:37:07', '2015-04-20 14:37:07', 'live', 0),
(379, 'insert', 'human', 2, 'greenbutton', 17, '2015-04-20 14:44:19', '2015-04-20 14:44:19', 'live', 0),
(380, 'insert', 'human', 2, 'greenbutton', 18, '2015-04-20 18:33:12', '2015-04-20 18:33:12', 'live', 0),
(381, 'update', 'human', 2, 'page', 5, '2015-04-28 11:07:53', '2015-04-28 11:07:53', 'live', 0),
(382, 'update', 'human', 2, 'page', 5, '2015-04-28 11:09:16', '2015-04-28 11:09:16', 'live', 0),
(383, 'insert', 'human', 2, 'section', 32, '2015-04-28 11:12:02', '2015-04-28 11:12:02', 'live', 0),
(384, 'update', 'human', 2, 'section', 32, '2015-04-28 11:17:39', '2015-04-28 11:17:39', 'live', 0),
(385, 'update', 'human', 2, 'page', 5, '2015-04-28 11:18:03', '2015-04-28 11:18:03', 'live', 0),
(386, 'update', 'human', 2, 'section', 32, '2015-04-28 11:24:47', '2015-04-28 11:24:47', 'live', 0),
(387, 'update', 'human', 2, 'form', 177, '2015-04-28 11:24:57', '2015-04-28 11:24:57', 'live', 0),
(388, 'update', 'human', 2, 'section', 25, '2015-04-28 11:26:05', '2015-04-28 11:26:05', 'live', 0),
(389, 'update', 'human', 2, 'section', 32, '2015-04-28 11:27:51', '2015-04-28 11:27:51', 'live', 0),
(390, 'update', 'human', 2, 'site', 1, '2015-04-28 11:28:23', '2015-04-28 11:28:23', 'live', 0),
(391, 'update', 'human', 2, 'section', 32, '2015-04-28 11:29:37', '2015-04-28 11:29:37', 'live', 0),
(392, 'update', 'human', 2, 'section', 1, '2015-04-29 17:41:02', '2015-04-29 17:41:02', 'live', 0),
(393, 'update', 'human', 2, 'section', 7, '2015-04-29 17:41:17', '2015-04-29 17:41:17', 'live', 0),
(394, 'update', 'human', 2, 'section', 6, '2015-04-29 17:52:54', '2015-04-29 17:52:54', 'live', 0),
(395, 'update', 'human', 2, 'section', 6, '2015-04-29 17:53:00', '2015-04-29 17:53:00', 'live', 0),
(396, 'update', 'human', 2, 'section', 6, '2015-04-29 17:59:39', '2015-04-29 17:59:39', 'live', 0),
(397, 'update', 'human', 2, 'section', 6, '2015-04-29 18:03:43', '2015-04-29 18:03:43', 'live', 0),
(398, 'update', 'human', 2, 'section', 32, '2015-04-30 01:18:32', '2015-04-30 01:18:32', 'live', 0),
(399, 'update', 'human', 2, 'section', 8, '2015-04-30 21:01:57', '2015-04-30 21:01:57', 'live', 0),
(400, 'update', 'human', 2, 'section', 32, '2015-05-01 00:28:01', '2015-05-01 00:28:01', 'live', 0),
(401, 'update', 'human', 2, 'section', 6, '2015-05-01 00:36:10', '2015-05-01 00:36:10', 'live', 0),
(402, 'update', 'human', 2, 'section', 32, '2015-05-01 12:23:02', '2015-05-01 12:23:02', 'live', 0),
(403, 'insert', 'human', 2, 'form', 187, '2015-06-17 21:29:16', '2015-06-17 21:29:16', 'live', 0),
(404, 'update', 'human', 2, 'page', 6, '2015-06-17 21:29:33', '2015-06-17 21:29:33', 'live', 0),
(405, 'update', 'human', 2, 'page', 6, '2015-06-18 16:02:27', '2015-06-18 16:02:27', 'live', 0),
(406, 'insert', 'human', 2, 'form', 188, '2015-08-12 01:38:19', '2015-08-12 01:38:19', 'live', 0),
(407, 'insert', 'human', 2, 'form', 189, '2015-08-12 12:05:06', '2015-08-12 12:05:06', 'live', 0),
(408, 'insert', 'human', 2, 'workflow', 1, '2015-08-12 12:11:44', '2015-08-12 12:11:44', 'live', 0),
(409, 'insert', 'human', 2, 'page', 39, '2015-08-12 12:12:36', '2015-08-12 12:12:36', 'live', 0),
(410, 'insert', 'human', 2, 'page', 40, '2015-08-12 12:15:02', '2015-08-12 12:15:02', 'live', 0),
(411, 'insert', 'human', 2, 'page', 41, '2015-08-12 12:16:29', '2015-08-12 12:16:29', 'live', 0),
(412, 'insert', 'human', 2, 'workflow', 2, '2015-08-12 12:17:02', '2015-08-12 12:17:02', 'live', 0),
(413, 'insert', 'human', 2, 'page', 42, '2015-08-12 12:17:27', '2015-08-12 12:17:27', 'live', 0),
(414, 'insert', 'human', 2, 'form', 190, '2015-08-12 12:20:33', '2015-08-12 12:20:33', 'live', 0),
(415, 'update', 'human', 2, 'page', 11, '2015-08-12 12:23:07', '2015-08-12 12:23:07', 'live', 0),
(416, 'insert', 'human', 2, 'workflow', 3, '2015-08-12 14:25:07', '2015-08-12 14:25:07', 'live', 0),
(417, 'insert', 'human', 2, 'workflow', 4, '2015-08-12 14:46:51', '2015-08-12 14:46:51', 'live', 0),
(418, 'insert', 'human', 2, 'page', 43, '2015-08-12 14:47:26', '2015-08-12 14:47:26', 'live', 0),
(419, 'update', 'human', 2, 'page', 11, '2015-08-12 14:50:58', '2015-08-12 14:50:58', 'live', 0),
(420, 'update', 'human', 2, 'page', 11, '2015-08-12 14:51:13', '2015-08-12 14:51:13', 'live', 0),
(421, 'update', 'human', 2, 'section', 19, '2015-08-12 14:54:21', '2015-08-12 14:54:21', 'live', 0),
(422, 'update', 'human', 2, 'section', 20, '2015-08-12 14:54:48', '2015-08-12 14:54:48', 'live', 0),
(423, 'update', 'human', 2, 'section', 32, '2015-08-12 14:58:43', '2015-08-12 14:58:43', 'live', 0),
(424, 'update', 'human', 2, 'section', 32, '2015-08-12 14:59:12', '2015-08-12 14:59:12', 'live', 0),
(425, 'update', 'human', 2, 'section', 32, '2015-08-12 15:00:01', '2015-08-12 15:00:01', 'live', 0),
(426, 'update', 'human', 2, 'section', 32, '2015-08-12 15:00:09', '2015-08-12 15:00:09', 'live', 0),
(427, 'update', 'human', 2, 'page', 43, '2015-08-12 15:00:34', '2015-08-12 15:00:34', 'live', 0),
(428, 'update', 'human', 2, 'section', 32, '2015-08-12 15:02:00', '2015-08-12 15:02:00', 'live', 0),
(429, 'update', 'human', 2, 'const', 8, '2015-08-13 20:12:22', '2015-08-13 20:12:22', 'live', 0),
(430, 'update', 'human', 2, 'item', 8, '2015-08-13 20:48:36', '2015-08-13 20:48:36', 'live', 0),
(431, 'update', 'human', 2, 'form', 184, '2015-08-13 20:48:50', '2015-08-13 20:48:50', 'live', 0),
(432, 'update', 'human', 2, 'greenbutton', 17, '2015-08-13 20:49:24', '2015-08-13 20:49:24', 'live', 0),
(433, 'update', 'human', 2, 'greenbutton', 17, '2015-08-13 20:51:45', '2015-08-13 20:51:45', 'live', 0),
(434, 'update', 'human', 2, 'greenbutton', 17, '2015-08-13 20:52:07', '2015-08-13 20:52:07', 'live', 0),
(435, 'update', 'human', 2, 'greenbutton', 8, '2015-08-13 20:52:23', '2015-08-13 20:52:23', 'live', 0),
(436, 'update', 'human', 2, 'greenbutton', 2, '2015-08-13 20:52:36', '2015-08-13 20:52:36', 'live', 0),
(437, 'update', 'human', 2, 'greenbutton', 7, '2015-08-13 20:52:50', '2015-08-13 20:52:50', 'live', 0),
(438, 'update', 'human', 2, 'greenbutton', 16, '2015-08-13 20:53:17', '2015-08-13 20:53:17', 'live', 0),
(439, 'update', 'human', 2, 'greenbutton', 12, '2015-08-13 20:53:34', '2015-08-13 20:53:34', 'live', 0),
(440, 'update', 'human', 2, 'greenbutton', 15, '2015-08-13 20:56:51', '2015-08-13 20:56:51', 'live', 0),
(441, 'update', 'human', 2, 'greenbutton', 17, '2015-08-13 20:58:03', '2015-08-13 20:58:03', 'live', 0),
(442, 'update', 'human', 2, 'greenbutton', 5, '2015-08-13 20:59:15', '2015-08-13 20:59:15', 'live', 0),
(443, 'update', 'human', 2, 'greenbutton', 11, '2015-08-13 20:59:41', '2015-08-13 20:59:41', 'live', 0),
(444, 'update', 'human', 2, 'greenbutton', 10, '2015-08-13 21:00:42', '2015-08-13 21:00:42', 'live', 0),
(445, 'update', 'human', 2, 'greenbutton', 3, '2015-08-13 21:00:46', '2015-08-13 21:00:46', 'live', 0),
(446, 'update', 'human', 2, 'greenbutton', 14, '2015-08-13 21:01:08', '2015-08-13 21:01:08', 'live', 0),
(447, 'update', 'human', 2, 'greenbutton', 1, '2015-08-13 21:11:04', '2015-08-13 21:11:04', 'live', 0),
(448, 'update', 'human', 2, 'greenbutton', 6, '2015-08-13 21:11:15', '2015-08-13 21:11:15', 'live', 0),
(449, 'update', 'human', 2, 'greenbutton', 18, '2015-08-13 21:11:35', '2015-08-13 21:11:35', 'live', 0),
(450, 'update', 'human', 2, 'greenbutton', 9, '2015-08-13 21:12:30', '2015-08-13 21:12:30', 'live', 0),
(451, 'update', 'human', 2, 'greenbutton', 14, '2015-08-13 21:13:52', '2015-08-13 21:13:52', 'live', 0),
(452, 'update', 'human', 2, 'greenbutton', 14, '2015-08-13 21:27:41', '2015-08-13 21:27:41', 'live', 0),
(453, 'update', 'human', 2, 'item', 8, '2015-08-13 21:57:07', '2015-08-13 21:57:07', 'live', 0),
(454, 'update', 'human', 2, 'form', 184, '2015-08-13 21:57:14', '2015-08-13 21:57:14', 'live', 0),
(455, 'update', 'human', 2, 'greenbutton', 9, '2015-08-13 21:59:27', '2015-08-13 21:59:27', 'live', 0),
(456, 'update', 'human', 2, 'greenbutton', 9, '2015-08-13 22:06:27', '2015-08-13 22:06:27', 'live', 0),
(457, 'update', 'human', 2, 'greenbutton', 14, '2015-08-13 22:06:30', '2015-08-13 22:06:30', 'live', 0),
(458, 'update', 'human', 2, 'greenbutton', 18, '2015-08-13 22:08:13', '2015-08-13 22:08:13', 'live', 0),
(459, 'update', 'human', 2, 'greenbutton', 6, '2015-08-13 22:08:21', '2015-08-13 22:08:21', 'live', 0),
(460, 'update', 'human', 2, 'greenbutton', 1, '2015-08-13 22:08:34', '2015-08-13 22:08:34', 'live', 0),
(461, 'update', 'human', 2, 'greenbutton', 5, '2015-08-13 22:08:39', '2015-08-13 22:08:39', 'live', 0),
(462, 'update', 'human', 2, 'greenbutton', 17, '2015-08-13 22:08:46', '2015-08-13 22:08:46', 'live', 0),
(463, 'update', 'human', 2, 'greenbutton', 7, '2015-08-13 22:08:59', '2015-08-13 22:08:59', 'live', 0),
(464, 'update', 'human', 2, 'greenbutton', 2, '2015-08-13 22:09:42', '2015-08-13 22:09:42', 'live', 0),
(465, 'update', 'human', 2, 'greenbutton', 1, '2015-08-13 22:10:24', '2015-08-13 22:10:24', 'live', 0),
(466, 'update', 'human', 2, 'greenbutton', 8, '2015-08-13 22:10:40', '2015-08-13 22:10:40', 'live', 0),
(467, 'update', 'human', 2, 'greenbutton', 8, '2015-08-13 22:11:53', '2015-08-13 22:11:53', 'live', 0),
(468, 'update', 'human', 2, 'greenbutton', 2, '2015-08-13 22:12:07', '2015-08-13 22:12:07', 'live', 0),
(469, 'update', 'human', 2, 'greenbutton', 8, '2015-08-13 22:12:32', '2015-08-13 22:12:32', 'live', 0),
(470, 'update', 'human', 2, 'section', 2, '2015-08-13 22:13:38', '2015-08-13 22:13:38', 'live', 0),
(471, 'update', 'human', 2, 'greenbutton', 12, '2015-08-13 22:16:48', '2015-08-13 22:16:48', 'live', 0),
(472, 'update', 'human', 2, 'greenbutton', 16, '2015-08-13 22:16:57', '2015-08-13 22:16:57', 'live', 0),
(473, 'update', 'human', 2, 'greenbutton', 3, '2015-08-13 22:25:42', '2015-08-13 22:25:42', 'live', 0),
(474, 'insert', 'human', 2, 'greenbutton', 19, '2015-08-13 22:27:48', '2015-08-13 22:27:48', 'live', 0),
(475, 'update', 'human', 2, 'section', 1, '2015-08-13 22:28:52', '2015-08-13 22:28:52', 'live', 0),
(476, 'update', 'human', 2, 'greenbutton', 15, '2015-08-13 22:32:15', '2015-08-13 22:32:15', 'live', 0),
(477, 'update', 'human', 2, 'greenbutton', 10, '2015-08-13 22:32:29', '2015-08-13 22:32:29', 'live', 0),
(478, 'update', 'human', 2, 'greenbutton', 5, '2015-08-13 22:32:31', '2015-08-13 22:32:31', 'live', 0),
(479, 'update', 'human', 2, 'greenbutton', 6, '2015-08-13 22:32:33', '2015-08-13 22:32:33', 'live', 0),
(480, 'update', 'human', 2, 'greenbutton', 18, '2015-08-13 22:32:35', '2015-08-13 22:32:35', 'live', 0),
(481, 'update', 'human', 2, 'greenbutton', 14, '2015-08-13 22:32:37', '2015-08-13 22:32:37', 'live', 0),
(482, 'update', 'human', 2, 'greenbutton', 9, '2015-08-13 22:32:39', '2015-08-13 22:32:39', 'live', 0),
(483, 'update', 'human', 2, 'greenbutton', 17, '2015-08-13 22:32:42', '2015-08-13 22:32:42', 'live', 0),
(484, 'update', 'human', 2, 'greenbutton', 7, '2015-08-13 22:32:43', '2015-08-13 22:32:43', 'live', 0),
(485, 'update', 'human', 2, 'greenbutton', 1, '2015-08-13 22:32:46', '2015-08-13 22:32:46', 'live', 0),
(486, 'update', 'human', 2, 'greenbutton', 2, '2015-08-13 22:32:48', '2015-08-13 22:32:48', 'live', 0),
(487, 'update', 'human', 2, 'greenbutton', 8, '2015-08-13 22:32:51', '2015-08-13 22:32:51', 'live', 0),
(488, 'update', 'human', 2, 'greenbutton', 11, '2015-08-13 22:33:37', '2015-08-13 22:33:37', 'live', 0),
(489, 'update', 'human', 2, 'greenbutton', 18, '2015-08-15 14:58:04', '2015-08-15 14:58:04', 'live', 0),
(490, 'update', 'human', 2, 'section', 2, '2015-08-15 16:28:29', '2015-08-15 16:28:29', 'live', 0),
(491, 'update', 'human', 2, 'page', 1, '2015-08-15 16:30:36', '2015-08-15 16:30:36', 'live', 0),
(492, 'update', 'human', 2, 'page', 1, '2015-08-15 16:30:39', '2015-08-15 16:30:39', 'live', 0),
(493, 'update', 'human', 2, 'page', 43, '2015-08-21 15:13:11', '2015-08-21 15:13:11', 'live', 0),
(494, 'update', 'human', 2, 'section', 32, '2015-08-21 15:15:44', '2015-08-21 15:15:44', 'live', 0),
(495, 'update', 'human', 2, 'page', 43, '2015-08-21 15:15:46', '2015-08-21 15:15:46', 'live', 0),
(496, 'update', 'human', 2, 'section', 32, '2015-08-21 15:16:12', '2015-08-21 15:16:12', 'live', 0),
(497, 'update', 'human', 2, 'page', 31, '2015-08-25 17:14:33', '2015-08-25 17:14:33', 'live', 0),
(498, 'update', 'human', 2, 'page', 31, '2015-08-25 17:14:51', '2015-08-25 17:14:51', 'live', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `type`, `descr`, `text`, `url`, `system`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'home', '{"en":"Digest","fr":"Digest"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Welcome home', '', '/', 0, '2013-10-03 08:28:48', '2015-08-15 16:30:39', 'live', 2),
(2, 'error_404', '{"fr":"404","en":"404"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/404', 1, '2014-05-31 05:10:38', '2014-05-31 05:10:38', 'live', 2),
(3, 'post', '{"fr":"POST routine","en":"POST routine"}', '{"key":"content","http_status":"200 OK","content_type":"routine","url":"","master":{"app":"content","template":"\\/master\\/post"}}', 'Receives all the posts from the forms.', '', '/routine', 1, '2014-05-31 05:10:27', '2014-05-31 05:10:27', 'live', 2),
(5, 'list', '{"en":"List","fr":"Liste"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/list', 0, '2013-10-13 01:05:53', '2015-04-28 11:18:03', 'live', 2),
(6, 'edit', '{"en":"Edit","fr":"Edition"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/edit', 0, '2013-10-12 22:01:52', '2015-06-18 16:02:27', 'live', 2),
(7, 'doc', '{"fr":"Doc","en":"Doc"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'About classes, methods and functions available to you, kind developer.', '', '/doc', 0, '2013-10-14 13:11:22', '2014-05-31 05:38:16', 'live', 2),
(9, 'site', '{"fr":"Environnement","en":"Environment"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Structure', '', '/site', 0, '2014-04-08 19:54:46', '2014-05-31 05:38:35', 'live', 2),
(10, 'content', '{"fr":"Contenu","en":"Content"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Publish', '', '/item', 0, '2013-10-19 15:27:46', '2014-05-31 04:44:29', 'live', 2),
(11, 'apps', '{"en":"Apps","fr":"Apps"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'Tweak', '', '/apps', 0, '2013-10-18 18:40:46', '2015-08-12 14:51:13', 'live', 2),
(29, 'logbook', '{"fr":"Livre des logs","en":"Log book"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/logbook', 0, '2014-05-31 05:38:10', '2014-05-31 05:38:10', 'live', 2),
(30, 'login', '{"fr":"Login","en":"Login"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/login"}}', '', '', '/login', 1, '2013-10-03 04:16:31', '2014-05-31 05:10:46', 'live', 2),
(31, 'csv', '{"en":"API (csv)","fr":"API (json)"}', '{"key":"content","http_status":"200 OK","content_type":"csv","url":"","master":{"app":"api","template":"\\/api"}}', '', '', '/csv', 1, '2013-03-06 03:21:46', '2015-08-25 17:14:51', 'live', 2),
(32, 'me', '{"fr":"Moi","en":"Me"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', 'dfsdf', '', '/me', 0, '2014-05-31 05:37:42', '2014-05-31 05:37:42', 'live', 2),
(33, 'api.eventstream', '{"fr":"API (eventstream)","en":"API (eventstream)"}', '{"key":"content","http_status":"200 OK","content_type":"eventstream","url":"","master":{"app":"content","template":"\\/master\\/api"}}', '', '', '/api.eventstream', 1, '2013-03-06 03:21:46', '2014-05-31 05:10:03', 'live', 2),
(35, 'ajax.html', '{"fr":"AJAX (html)","en":"AJAX (html)"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/ajax"}}', '', '', '/ajax.html', 1, '2013-03-06 03:21:46', '2014-05-31 05:10:12', 'live', 2),
(36, 'ajax.json', '{"fr":"AJAX (json)","en":"AJAX (json)"}', '{"key":"content","http_status":"200 OK","content_type":"json","url":"","master":{"app":"content","template":"\\/master\\/ajax"}}', '', '', '/ajax.json', 1, '2013-03-06 03:21:46', '2014-05-31 05:09:52', 'live', 2),
(37, 'lab', '{"fr":"Lab","en":"Lab"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/lab', 0, '2014-05-02 15:31:57', '2014-05-31 05:37:49', 'live', 2),
(38, 'iframe', '{"en":"Iframes","fr":""}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/iframe"}}', 'Use me to send content to en empty master template. Nice for Iframes.', '', '/iframe', 1, '2015-01-19 19:02:07', '2015-01-19 19:08:56', 'live', 2),
(39, 'app', '{"en":"App","fr":"App"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/app', 0, '2015-08-12 12:12:36', '2015-08-12 12:12:36', 'live', 2),
(43, '4eca7f680019838d1c021cd9c63217e3', '{"en":"Build an App","fr":"Faire une app"}', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/build-an-app', 0, '2015-08-12 14:47:26', '2015-08-21 15:15:46', 'live', 0);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `zone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `nodata` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `key`, `title`, `zone`, `app`, `created`, `updated`, `status`, `owner`, `nodata`) VALUES
(1, 'list', '{"en":"List","fr":"Publiés"}', 'content', '{"app":"content","template":"\\/list\\/list","param":{"system":""}}', '2014-05-31 04:51:15', '2015-08-13 22:28:52', 'live', '2', '{"en":"Nothing live. Sorry, nothing. Zero. Zilch.","fr":"Rien du tout. Rien de rien de rien."}'),
(2, 'edit', '{"en":"Edit","fr":"Modifier"}', 'content', '{"app":"content","template":"\\/edit\\/edit"}', '2013-10-16 14:52:08', '2015-08-15 16:28:29', 'live', '2', '{"en":"","fr":""}'),
(3, 'php', '{"fr":"Apps","en":"Apps"}', 'content', '{"app":"content","template":"\\/doc\\/code"}', '2014-05-15 09:47:55', '2014-05-31 04:48:57', 'live', '2', ''),
(4, 'doc', '{"fr":"Doc","en":"Doc"}', 'content', '{"app":"content","template":"\\/doc\\/doc"}', '2013-10-20 22:52:03', '2014-05-31 04:49:55', 'live', '2', ''),
(5, 'splash', '{"fr":"Bienvenue","en":"Welcome"}', 'content', '{"app":"content","template":"\\/error\\/error"}', '2014-05-31 04:46:24', '2014-05-31 04:46:24', 'live', '2', ''),
(6, 'system', '{"en":"System","fr":"Système"}', 'content', '{"app":"content","template":"\\/list\\/list","param":{"param":{"system":"1"}}}', '2013-02-24 06:33:01', '2015-05-01 00:36:10', 'live', '2', '{"en":"Nothing reserved by the system.","fr":"Rien que le système ne se garde pour lui."}'),
(8, 'draft', '{"en":"Drafts","fr":"Brouillons"}', 'content', '{"app":"content","template":"\\/list\\/list","param":{"status":"draft"}}', '2013-02-24 06:33:01', '2015-04-30 21:01:57', 'live', '2', '{"en":"No drafts.","fr":"Aucun brouillon."}'),
(9, 'timeline', '{"en":"Timeline","fr":"En direct"}', 'content', '{"app":"content","template":"\\/timeline\\/timeline"}', '2014-05-31 04:46:50', '2014-12-20 15:00:30', 'live', '2', '{"en":"As soon as something happens, we''ll let you know right here.","fr":"Dès qu''il se passera quelque chose, nous vous en parlerons ici."}'),
(10, 'tree', '{"en":"Site tree","fr":"Arborescence"}', 'content', '{"app":"content","template":"\\/tree\\/tree"}', '2013-10-23 02:14:52', '2014-12-29 14:01:36', 'live', '2', '{"en":"You should ask for help, there should be at least one page in your site tree.","fr":"Vous devriez demander de l''aide. Il devrait avoir au moins une page dans votre arbo."}'),
(17, 'zoning', '{"en":"Zoning","fr":"Zoning"}', 'content', '{"app":"content","template":"\\/zoning\\/zoning"}', '2014-05-31 04:47:01', '2015-04-20 14:37:07', 'live', '2', '{"en":"","fr":""}'),
(19, 'appstore', '{"en":"Store","fr":"Store"}', 'content', '{"app":"content","template":"\\/appmanager\\/appmanager"}', '2014-05-31 04:50:45', '2015-08-12 14:54:21', 'live', '2', '{"en":"","fr":""}'),
(20, 'appini', '{"en":"About","fr":"A propos"}', 'content', '{"app":"content","template":"\\/appini\\/appini"}', '2013-10-20 22:53:07', '2015-08-12 14:54:48', 'live', '2', '{"en":"","fr":""}'),
(21, 'appconfig', '{"fr":"Configuration","en":"Configuration"}', 'content', '{"app":"content","template":"\\/appconfig\\/appconfig"}', '2014-05-31 04:47:28', '2014-05-31 04:47:28', 'live', '2', ''),
(25, 'carousel_test', '{"en":"","fr":""}', 'content', '{"app":"","template":"\\/jquery_carousel","param":{"direction":"horizontal","autoSlideInterval":"3000","dispItems":"1","paginationPosition":"inside","nextBtn":"<span>next<\\/span>","prevBtn":"<span>previous<\\/span>","btnsPosition":"inside","nextBtnInsert":"appendTo","prevBtnInsert":"prependTo","delayAutoSlide":"0","effect":"slide","slideEasing":"swing","animSpeed":"normal"}}', '2013-02-08 10:22:45', '2015-04-28 11:26:05', 'live', 'human_2', '{"en":"","fr":""}'),
(27, 'notes', '{"en":"Conversation","fr":"Discussion"}', 'content', '{"app":"content","template":"\\/notes\\/notes"}', '2013-03-11 01:20:51', '2014-12-20 15:01:12', 'live', '2', '{"en":"This conversation is missing your voice.","fr":"Cette conversation n''est rien sans vous."}'),
(28, 'login', '{"fr":"Login","en":"Login"}', 'site', '{"app":"form","template":"\\/login","param":{"key":"login"}}', '2013-04-07 15:55:22', '2014-05-31 04:50:04', 'live', '2', ''),
(30, 'workflow', '{"en":"Workflow","fr":"Workflow"}', 'content', '{"app":"content","template":"\\/workflow\\/workflow"}', '2014-05-31 04:47:16', '2014-12-20 15:18:56', 'live', '2', '{"en":"No workflow.","fr":"Aucun flux de publication."}'),
(31, 'lab', '{"en":"Lab","fr":"Lab"}', 'content', '{"app":"lab","template":"\\/lab"}', '2013-10-16 14:52:08', '2014-12-20 14:59:42', 'live', '2', '{"en":"There is nothing in your lab. You should experiment more!","fr":"Il n''y a rien au labo. Vous devriez tester des trucs!"}'),
(32, 'buildapp', '{"en":"Step by step","fr":"Pas à pas"}', 'content', '{"app":"appbuilder","template":"\\/appbuilder\\/appbuilder"}', '2015-04-28 11:12:02', '2015-08-21 15:16:12', 'live', 'human_2', '{"en":"We''re working hard on this feature. Stay tuned!","fr":"Nous travaillons dur sur cette section. Revenez vite !"}');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`, `owner`) VALUES
(1, 'admin', 'Hands Agency', '2013-05-21 14:52:00', '2015-04-28 11:28:23', 'live', 1, 2),
(2, 'ad17c94303b0df2ada3243c46e943577', '', '2014-07-03 14:44:15', '2014-07-03 14:44:15', 'trash', 0, 2),
(3, '79a337257a49d8f874e9822212d45f35', '', '2014-08-07 02:48:28', '2014-08-07 02:48:28', 'trash', 0, 2);

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
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-04-05 17:02:34', 'live', 2),
(2, 'fr', 'Français', 'fr', '2013-10-20 22:53:53', '2013-10-20 22:53:53', 'live', 2);

-- --------------------------------------------------------

--
-- Table structure for table `workflow`
--

CREATE TABLE `workflow` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `original` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `owner` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `data` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `original` (`original`),
  KEY `key` (`key`),
  KEY `owner` (`owner`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `workflow`
--

INSERT INTO `workflow` (`id`, `key`, `item`, `original`, `owner`, `created`, `updated`, `status`, `data`) VALUES
(2, 'fbc1742d6d359b80c4ce97cc5d3be094', 'page', '', 'human_2', '2015-08-12 12:17:02', '2015-08-12 12:17:02', 'draft', 'O:8:"itemPage":5:{s:8:"\0*\0child";b:0;s:9:"\0*\0zoning";b:0;s:6:"\0*\0env";s:5:"admin";s:8:"\0*\0table";s:4:"page";s:7:"\0*\0data";a:16:{s:2:"id";O:6:"attrId":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:2:"id";}}s:3:"key";O:7:"attrKey":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:3:"key";}}s:5:"title";O:8:"attrI18n":3:{s:8:"\0*\0field";s:9:"fieldText";s:7:"\0*\0data";a:1:{i:0;s:8:"New page";}s:9:"\0*\0params";a:3:{s:3:"key";s:5:"title";s:5:"table";s:4:"page";s:3:"env";s:5:"admin";}}s:4:"type";O:9:"attrArray":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:1:{s:3:"key";s:4:"type";}}s:5:"descr";O:10:"attrString":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:4:{s:3:"key";s:5:"descr";s:8:"required";b:0;s:3:"min";i:0;s:3:"max";s:3:"500";}}s:4:"text";O:10:"attrString":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:4:{s:3:"key";s:4:"text";s:8:"required";b:0;s:3:"min";i:0;s:3:"max";s:5:"65035";}}s:3:"url";O:7:"attrUrl":3:{s:7:"\0*\0item";N;s:7:"\0*\0data";N;s:9:"\0*\0params";a:8:{s:3:"key";s:3:"url";s:5:"table";s:4:"page";s:3:"env";s:5:"admin";s:7:"version";N;s:4:"live";b:0;s:8:"nickname";N;s:2:"id";N;s:4:"name";N;}}s:6:"system";O:8:"attrBool":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:2:{s:3:"key";s:6:"system";s:8:"required";b:0;}}s:7:"created";O:11:"attrCreated":2:{s:7:"\0*\0data";s:19:"0000-00-00 00:00:00";s:9:"\0*\0params";a:2:{s:4:"type";s:8:"datetime";s:3:"key";s:7:"created";}}s:7:"updated";O:11:"attrUpdated":2:{s:7:"\0*\0data";s:19:"0000-00-00 00:00:00";s:9:"\0*\0params";a:2:{s:4:"type";s:8:"datetime";s:3:"key";s:7:"updated";}}s:6:"status";O:10:"attrStatus":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:6:"status";}}s:5:"child";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:5:"child";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:4:"page";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:7:"section";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:7:"section";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:7:"section";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:14:"sectiondefault";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:14:"sectiondefault";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:7:"section";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:5:"owner";O:9:"attrOwner":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:2:{s:3:"key";s:5:"owner";s:3:"env";s:5:"admin";}}s:6:"parent";s:7:"page_11";}}'),
(3, '2e9cba3dd8e4478472ef2673d5fd3ef8', 'page', '', 'human_2', '2015-08-12 14:25:07', '2015-08-12 14:25:07', 'draft', 'O:8:"itemPage":5:{s:8:"\0*\0child";b:0;s:9:"\0*\0zoning";b:0;s:6:"\0*\0env";s:5:"admin";s:8:"\0*\0table";s:4:"page";s:7:"\0*\0data";a:16:{s:2:"id";O:6:"attrId":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:2:"id";}}s:3:"key";O:7:"attrKey":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:3:"key";}}s:5:"title";O:8:"attrI18n":3:{s:8:"\0*\0field";s:9:"fieldText";s:7:"\0*\0data";a:1:{i:0;s:8:"New page";}s:9:"\0*\0params";a:3:{s:3:"key";s:5:"title";s:5:"table";s:4:"page";s:3:"env";s:5:"admin";}}s:4:"type";O:9:"attrArray":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:1:{s:3:"key";s:4:"type";}}s:5:"descr";O:10:"attrString":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:4:{s:3:"key";s:5:"descr";s:8:"required";b:0;s:3:"min";i:0;s:3:"max";s:3:"500";}}s:4:"text";O:10:"attrString":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:4:{s:3:"key";s:4:"text";s:8:"required";b:0;s:3:"min";i:0;s:3:"max";s:5:"65035";}}s:3:"url";O:7:"attrUrl":3:{s:7:"\0*\0item";N;s:7:"\0*\0data";N;s:9:"\0*\0params";a:8:{s:3:"key";s:3:"url";s:5:"table";s:4:"page";s:3:"env";s:5:"admin";s:7:"version";N;s:4:"live";b:0;s:8:"nickname";N;s:2:"id";N;s:4:"name";N;}}s:6:"system";O:8:"attrBool":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:2:{s:3:"key";s:6:"system";s:8:"required";b:0;}}s:7:"created";O:11:"attrCreated":2:{s:7:"\0*\0data";s:19:"0000-00-00 00:00:00";s:9:"\0*\0params";a:2:{s:4:"type";s:8:"datetime";s:3:"key";s:7:"created";}}s:7:"updated";O:11:"attrUpdated":2:{s:7:"\0*\0data";s:19:"0000-00-00 00:00:00";s:9:"\0*\0params";a:2:{s:4:"type";s:8:"datetime";s:3:"key";s:7:"updated";}}s:6:"status";O:10:"attrStatus":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:6:"status";}}s:5:"child";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:5:"child";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:4:"page";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:7:"section";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:7:"section";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:7:"section";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:14:"sectiondefault";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:14:"sectiondefault";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:7:"section";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:5:"owner";O:9:"attrOwner":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:2:{s:3:"key";s:5:"owner";s:3:"env";s:5:"admin";}}s:6:"parent";s:7:"page_11";}}'),
(4, '965bf6349c64ca121ace10bc27051bbd', 'page', '', 'human_2', '2015-08-12 14:46:51', '2015-08-12 14:46:51', 'draft', 'O:8:"itemPage":5:{s:8:"\0*\0child";b:0;s:9:"\0*\0zoning";b:0;s:6:"\0*\0env";s:5:"admin";s:8:"\0*\0table";s:4:"page";s:7:"\0*\0data";a:16:{s:2:"id";O:6:"attrId":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:2:"id";}}s:3:"key";O:7:"attrKey":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:3:"key";}}s:5:"title";O:8:"attrI18n":3:{s:8:"\0*\0field";s:9:"fieldText";s:7:"\0*\0data";a:1:{i:0;s:8:"New page";}s:9:"\0*\0params";a:3:{s:3:"key";s:5:"title";s:5:"table";s:4:"page";s:3:"env";s:5:"admin";}}s:4:"type";O:9:"attrArray":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:1:{s:3:"key";s:4:"type";}}s:5:"descr";O:10:"attrString":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:4:{s:3:"key";s:5:"descr";s:8:"required";b:0;s:3:"min";i:0;s:3:"max";s:3:"500";}}s:4:"text";O:10:"attrString":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:4:{s:3:"key";s:4:"text";s:8:"required";b:0;s:3:"min";i:0;s:3:"max";s:5:"65035";}}s:3:"url";O:7:"attrUrl":3:{s:7:"\0*\0item";N;s:7:"\0*\0data";N;s:9:"\0*\0params";a:8:{s:3:"key";s:3:"url";s:5:"table";s:4:"page";s:3:"env";s:5:"admin";s:7:"version";N;s:4:"live";b:0;s:8:"nickname";N;s:2:"id";N;s:4:"name";N;}}s:6:"system";O:8:"attrBool":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:2:{s:3:"key";s:6:"system";s:8:"required";b:0;}}s:7:"created";O:11:"attrCreated":2:{s:7:"\0*\0data";s:19:"0000-00-00 00:00:00";s:9:"\0*\0params";a:2:{s:4:"type";s:8:"datetime";s:3:"key";s:7:"created";}}s:7:"updated";O:11:"attrUpdated":2:{s:7:"\0*\0data";s:19:"0000-00-00 00:00:00";s:9:"\0*\0params";a:2:{s:4:"type";s:8:"datetime";s:3:"key";s:7:"updated";}}s:6:"status";O:10:"attrStatus":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:1:{s:3:"key";s:6:"status";}}s:5:"child";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:5:"child";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:4:"page";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:7:"section";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:7:"section";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:7:"section";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:14:"sectiondefault";O:7:"attrRel":2:{s:7:"\0*\0data";a:0:{}s:9:"\0*\0params";a:8:{s:3:"key";s:14:"sectiondefault";s:8:"required";b:0;s:5:"param";a:1:{i:0;a:1:{s:4:"item";s:7:"section";}}s:3:"min";s:0:"";s:3:"max";s:0:"";s:3:"env";s:5:"admin";s:5:"table";s:4:"page";s:2:"id";N;}}s:5:"owner";O:9:"attrOwner":2:{s:7:"\0*\0data";N;s:9:"\0*\0params";a:2:{s:3:"key";s:5:"owner";s:3:"env";s:5:"admin";}}s:6:"parent";s:7:"page_11";}}');

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
('page', 30, 'section', 'section', 28, 0),
('page', 37, 'section', 'section', 31, 0),
('page', 7, 'section', 'section', 3, 0),
('page', 7, 'section', 'section', 4, 1),
('page', 9, 'child', 'page', 37, 0),
('page', 9, 'child', 'page', 29, 1),
('page', 9, 'child', 'page', 7, 2),
('page', 40, 'child', 'page', 27, 0),
('page', 41, 'child', 'page', 29, 0),
('section', 30, 'greenbutton', 'greenbutton', 15, 0),
('section', 10, 'greenbutton', 'greenbutton', 11, 0),
('section', 17, 'greenbutton', 'greenbutton', 8, 0),
('section', 17, 'greenbutton', 'greenbutton', 1, 1),
('section', 17, 'greenbutton', 'greenbutton', 5, 2),
('section', 17, 'greenbutton', 'greenbutton', 6, 3),
('section', 17, 'greenbutton', 'greenbutton', 12, 4),
('section', 17, 'greenbutton', 'greenbutton', 16, 5),
('section', 17, 'greenbutton', 'greenbutton', 2, 6),
('section', 17, 'greenbutton', 'greenbutton', 9, 7),
('section', 17, 'greenbutton', 'greenbutton', 7, 8),
('page', 5, 'section', 'section', 9, 0),
('page', 5, 'section', 'section', 1, 1),
('page', 5, 'section', 'section', 10, 2),
('page', 5, 'section', 'section', 6, 3),
('page', 5, 'section', 'section', 7, 4),
('page', 5, 'section', 'section', 8, 5),
('page', 39, 'section', 'section', 4, 2),
('page', 5, 'sectiondefault', 'section', 10, 0),
('page', 5, 'sectiondefault', 'section', 1, 1),
('section', 7, 'greenbutton', 'greenbutton', 3, 0),
('section', 8, 'greenbutton', 'greenbutton', 3, 0),
('section', 6, 'greenbutton', 'greenbutton', 14, 0),
('page', 6, 'section', 'section', 9, 0),
('page', 6, 'section', 'section', 2, 1),
('page', 6, 'section', 'section', 17, 2),
('page', 6, 'sectiondefault', 'section', 2, 0),
('page', 39, 'section', 'section', 20, 1),
('page', 11, 'child', 'page', 39, 0),
('page', 11, 'child', 'page', 43, 1),
('page', 11, 'section', 'section', 19, 0),
('section', 19, 'greenbutton', 'greenbutton', 10, 0),
('section', 1, 'greenbutton', 'greenbutton', 3, 0),
('section', 1, 'greenbutton', 'greenbutton', 19, 1),
('section', 2, 'greenbutton', 'greenbutton', 8, 0),
('section', 2, 'greenbutton', 'greenbutton', 2, 1),
('section', 2, 'greenbutton', 'greenbutton', 1, 2),
('section', 2, 'greenbutton', 'greenbutton', 5, 3),
('section', 2, 'greenbutton', 'greenbutton', 6, 4),
('section', 2, 'greenbutton', 'greenbutton', 12, 5),
('section', 2, 'greenbutton', 'greenbutton', 16, 6),
('section', 2, 'greenbutton', 'greenbutton', 7, 7),
('page', 1, 'child', 'page', 32, 0),
('page', 1, 'child', 'page', 9, 1),
('page', 1, 'child', 'page', 10, 2),
('page', 1, 'child', 'page', 11, 3),
('page', 1, 'section', 'section', 9, 0),
('page', 43, 'section', 'section', 32, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
