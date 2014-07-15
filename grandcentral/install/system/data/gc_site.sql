-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 14 Juillet 2014 à 19:31
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `gc_site`
--

-- --------------------------------------------------------

--
-- Structure de la table `api`
--

DROP TABLE IF EXISTS `api`;
CREATE TABLE `api` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `owner` (`owner`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `const`
--

DROP TABLE IF EXISTS `const`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `form`
--

DROP TABLE IF EXISTS `form`;
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
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'title',
  `admin` tinyint(1) NOT NULL,
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `group`
--

INSERT INTO `group` (`id`, `key`, `title`, `admin`, `created`, `updated`, `status`) VALUES
(1, 'admin', 'Admin (back-end)', 1, '2013-10-02 08:35:40', '2014-07-04 12:38:27', 'live');

-- --------------------------------------------------------

--
-- Structure de la table `human`
--

DROP TABLE IF EXISTS `human`;
CREATE TABLE `human` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL,
  `profilepic` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `cover` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `firstname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `human`
--

INSERT INTO `human` (`id`, `key`, `title`, `descr`, `password`, `created`, `updated`, `status`, `system`, `profilepic`, `cover`, `owner`, `firstname`, `lastname`) VALUES
(1, 'anonymous', '', '', 'Anonymous User', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 1, '', '', 0, '', ''),
(2, 'admin', '', '', 'Administrator', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 1, '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
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
  `icon` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `key`, `title`, `descr`, `system`, `attr`, `created`, `updated`, `status`, `hasurl`, `owner`, `icon`) VALUES
(1, 'item', 'Items', '', 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"system":{"key":"system","type":"bool","required":"0"},"attr":{"key":"attr","type":"array"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"hasurl":{"key":"hasurl","type":"bool","required":"0"},"owner":{"key":"owner","type":"owner"},"icon":{"key":"icon","type":"string","required":"0","min":"","max":"30"}}', '2013-10-31 12:55:21', '2014-06-10 12:35:40', 'live', 0, 2, ''),
(2, 'site', 'Your websites', 'Manage your website basics, and the apps that will be opened at all time.', 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"defaultversion":{"key":"defaultversion","type":"int","required":"0","min":"","max":""},"owner":{"key":"owner","type":"owner"}}', '2013-11-17 14:17:48', '2014-06-30 11:21:29', 'live', 0, 2, ''),
(3, 'page', 'Page', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","required":"1","min":"0","max":"255"},"type":{"key":"type","type":"array","title":""},"descr":{"key":"descr","type":"string","title":"A short description","required":"0","min":"0","max":"500"},"text":{"key":"text","type":"string","title":"The text content","required":"0","min":"0","max":"65035"},"url":{"key":"url","type":"url","title":"The url"},"system":{"key":"system","type":"bool","title":"System","required":"0"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"version":{"key":"version","type":"version","title":""},"child":{"key":"child","type":"rel","title":"","required":"0","param":[{"item":"page"}]},"section":{"key":"section","type":"rel","title":"","required":"0","param":[{"item":"section"}]},"group":{"key":"group","type":"rel","title":"","required":"0","param":[{"item":"group"}]},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-10-31 12:59:36', '2013-11-18 13:05:29', 'live', 0, 2, ''),
(4, 'version', 'Versions', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","required":"1","min":"0","max":"255"},"lang":{"key":"lang","type":"string","title":"Language","required":"1","min":"0","max":"32"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-10-31 12:55:23', '2013-11-18 13:05:29', 'live', 0, 0, ''),
(5, 'human', 'Humans', '', 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"5000"},"password":{"key":"password","type":"password","required":"0"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"system":{"key":"system","type":"bool","required":"0"},"profilepic":{"key":"profilepic","type":"media","required":"0","min":"","max":""},"cover":{"key":"cover","type":"media","required":"0","min":"","max":""},"group":{"key":"group","type":"rel","required":"0","param":[{"item":"group"}],"min":"","max":""},"owner":{"key":"owner","type":"owner"},"company":{"key":"company","type":"rel","required":"0","param":[{"item":"company"}],"min":"","max":""},"firstname":{"key":"firstname","type":"string","required":"0","min":"0","max":"100"},"lastname":{"key":"lastname","type":"string","required":"0","min":"0","max":"100"},"follow":{"key":"follow","type":"rel","required":"0","param":{"1":{"item":"typology"},"2":{"item":"region"},"3":{"item":"company"},"4":{"item":"portfolio"}},"min":"","max":""}}', '2013-09-25 09:16:34', '2014-07-08 17:14:31', 'live', 0, 2, ''),
(7, 'section', 'Sections', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"zone":{"key":"zone","type":"string","title":"The zone","min":"0","max":"255"},"app":{"key":"app","type":"array","title":"The template","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-09-25 08:33:09', '2013-11-18 13:05:29', 'live', 0, 0, ''),
(27, 'const', 'Text constants', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","required":"1","min":"0","max":"5000"},"version":{"key":"version","type":"version","title":""},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-10-31 12:55:22', '2013-12-31 18:51:23', 'live', 0, 2, ''),
(28, 'logbook', 'Logbook', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"subject":{"key":"subject","type":"string","title":"Subject","required":"0","min":"0","max":"5000"},"subjectid":{"key":"subjectid","type":"int","title":"Subject ID","required":"0","min":"","max":""},"item":{"key":"item","type":"string","title":"item","required":"0","min":"0","max":"5000"},"itemid":{"key":"itemid","type":"int","title":"item id","required":"0","min":"","max":""},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"owner":{"key":"owner","type":"owner","title":"Owner"}}', '2013-10-31 12:55:17', '2013-10-31 12:55:17', 'live', 0, 0, ''),
(29, 'group', 'Groups', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"admin":{"key":"admin","type":"bool"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '2013-10-02 08:35:40', '2013-10-02 08:35:40', 'live', 0, 0, ''),
(30, 'form', 'Forms', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"Title","min":"","max":"","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"template":{"key":"template","type":"string","title":"Template","min":"","max":"","required":"1"},"action":{"key":"action","type":"string","title":"Action","min":"","max":"","required":"1"},"method":{"key":"method","type":"list","option":"post,get","title":"Method","required":"1"},"target":{"key":"target","type":"string","title":"Target"},"enctype":{"key":"enctype","type":"list","option":"application/x-www-form-urlencoded,multipart/form-data","title":"Enctype","required":"1"},"field":{"key":"field","type":"array","title":"The Fields"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', '2013-09-27 08:33:31', '2013-09-27 08:33:31', 'live', 0, 0, ''),
(31, 'api', 'Application Programing Interface', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"title":{"key":"title","type":"string","title":"Title","required":"1","min":"0","max":"1000"},"key":{"key":"key","type":"key","title":"The key"},"owner":{"key":"owner","type":"owner","title":"Owner"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"method":{"key":"method","type":"list","title":"Method","required":"1"}}', '2013-11-14 14:47:24', '2013-11-29 13:27:54', 'live', 0, 2, ''),
(33, 'machine', 'Machine', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"owner":{"key":"owner","type":"owner","title":"Owner"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"title":{"key":"title","type":"string","title":"Title","required":"1","min":"0","max":"1000"}}', '2013-11-29 13:21:45', '2013-12-31 13:23:24', 'live', 0, 2, ''),
(34, 'workflow', 'Items in the workflow', '', 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"item":{"key":"item","type":"string","required":"0","min":"0","max":"500"},"original":{"key":"original","type":"item","required":"1"},"data":{"key":"data","type":"array"},"owner":{"key":"owner","type":"owner"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"}}', '2014-05-24 17:54:44', '2014-05-27 14:20:59', 'live', 0, 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `logbook`
--

DROP TABLE IF EXISTS `logbook`;
CREATE TABLE `logbook` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `machine`
--

DROP TABLE IF EXISTS `machine`;
CREATE TABLE `machine` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `owner` (`owner`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item` (`item`),
  KEY `key` (`key`),
  KEY `owner` (`owner`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

DROP TABLE IF EXISTS `page`;
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
  `version` mediumint(3) unsigned NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`version`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `type`, `descr`, `text`, `url`, `system`, `created`, `updated`, `status`, `version`, `owner`) VALUES
(1, 'home', 'Home', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/', 0, '2013-03-25 17:08:31', '2014-03-14 21:00:29', 'live', 1, 2),
(2, 'error_404', '404', '{"key":"content","http_status":"404 Not Found","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/master"}}', '', '', '/404', 1, '2013-10-16 06:48:43', '2013-10-16 06:48:43', 'live', 1, 0),
(3, 'api.xml', 'API (xml)', '{"key":"content","http_status":"200 OK","content_type":"xml","url":"","master":{"app":"content","template":"\\/master\\/api"}}', '', '', '/api.xml', 1, '2013-03-25 17:08:31', '2013-08-26 13:54:05', 'live', 1, 0),
(7, 'ajax', 'Ajax page for HTML content', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/ajax"}}', '', '', '/ajax.html', 1, '0000-00-00 00:00:00', '2013-09-13 10:18:30', 'live', 1, 0),
(8, 'api.json', 'API (json)', '{"key":"content","http_status":"200 OK","content_type":"json","url":"","master":{"app":"content","template":"\\/master\\/api"}}', '', '', '/api.json', 1, '0000-00-00 00:00:00', '2013-09-13 10:18:30', 'live', 1, 0),
(9, 'login.post', 'Login routine', '{"key":"content","http_status":"200 OK","content_type":"routine","url":"","master":{"app":"content","template":"\\/master\\/login.post"}}', '', '', '/login.post', 1, '0000-00-00 00:00:00', '2013-09-13 10:18:30', 'live', 1, 0),
(10, 'login', 'Login', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/login"}}', '', '', '/login', 1, '0000-00-00 00:00:00', '2013-09-13 10:18:30', 'live', 1, 0),
(11, 'logout.post', 'Logout routine', '{"key":"content","http_status":"200 OK","content_type":"routine","url":"","master":{"app":"content","template":"\\/master\\/logout"}}', '', '', '/logout.post', 1, '0000-00-00 00:00:00', '2013-09-13 10:18:30', 'live', 1, 0),
(14, 'ajax.eventstream', 'AJAX (event-stream)', '{"key":"content","http_status":"200 OK","content_type":"eventstream","url":"","master":{"app":"content","template":"\\/master\\/ajax"}}', '', '', '/ajax.eventstream', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'live', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

DROP TABLE IF EXISTS `section`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `site`
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `site` (`id`, `key`, `title`, `descr`, `created`, `updated`, `status`, `defaultversion`, `owner`) VALUES
(1, 'mywebsite', 'My website', '', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

DROP TABLE IF EXISTS `version`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-10-12 22:59:27', 'live', 0);

-- --------------------------------------------------------

--
-- Structure de la table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE `workflow` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `original` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `original` (`original`),
  KEY `key` (`key`),
  KEY `owner` (`owner`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `_rel`
--

DROP TABLE IF EXISTS `_rel`;
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
('human', 2, 'group', 'group', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
