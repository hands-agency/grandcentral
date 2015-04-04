-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 30 Juillet 2014 à 14:28
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ccv4_yoga`
--

-- --------------------------------------------------------

--
-- Structure de la table `const`
--

DROP TABLE IF EXISTS `const`;
CREATE TABLE `const` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` mediumtext COLLATE utf8_unicode_ci NOT NULL,
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
-- Structure de la table `form`
--

DROP TABLE IF EXISTS `form`;
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
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `form`
--

INSERT INTO `form` (`id`, `key`, `title`, `descr`, `template`, `action`, `method`, `target`, `enctype`, `field`, `created`, `updated`, `system`, `status`, `owner`) VALUES
(1, 'yoga_item', 'yoga_item', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text","required":true},"title":{"key":"title","label":"title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"500"},"icon":{"key":"icon","label":"icon","type":"text","required":"0","min":"0","max":"10"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"hasurl":{"key":"hasurl","label":"hasurl","type":"bool","required":"0"},"attr":{"key":"attr","label":"attr","type":"attr"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-07-30 12:17:33', '2014-07-30 12:21:14', 1, 'live', 2),
(2, 'yoga_page', 'yoga_page', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"text","required":"1","min":"0","max":"255"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"500"},"image":{"key":"image","label":"image","type":"media","required":"0","min":"","max":""},"text":{"key":"text","label":"text","type":"textarea","required":"0","min":"0","max":"5000"},"type":{"key":"type","label":"type","type":"pagetype"},"section":{"key":"section","label":"section","valuestype":"bunch","values":[{"item":"section"}],"type":"multipleselect","required":"0","min":"","max":""},"url":{"key":"url","label":"url","type":"text"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"child":{"key":"child","label":"child","valuestype":"bunch","values":[{"item":"page"}],"type":"multipleselect","required":"0","min":"","max":""},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"metatitle":{"key":"metatitle","label":"metatitle","type":"text","required":"0","min":"0","max":"255"},"metadescr":{"key":"metadescr","label":"metadescr","type":"textarea","required":"0","min":"0","max":"500"},"metakeywords":{"key":"metakeywords","label":"metakeywords","type":"textarea","required":"0","min":"0","max":"500"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"},"status":{"key":"status","label":"status","type":"text"}}', '2014-07-30 12:28:08', '2014-07-30 14:22:03', 1, 'live', 2),
(3, 'yoga_human', 'yoga_human', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"text","required":"0","min":"0","max":"255"},"firstname":{"key":"firstname","label":"firstname","type":"text","required":"0","min":"0","max":"255"},"lastname":{"key":"lastname","label":"lastname","type":"text","required":"0","min":"0","max":"255"},"descr":{"key":"descr","label":"descr","type":"textarea","required":"0","min":"0","max":"1000"},"password":{"key":"password","label":"password","type":"password","required":"0"},"group":{"key":"group","label":"group","valuestype":"bunch","values":[{"item":"group"}],"type":"multipleselect","required":"0","min":"","max":""},"profilepic":{"key":"profilepic","label":"profilepic","type":"media","required":"0","min":"","max":""},"pref":{"key":"pref","label":"pref","type":"array"},"system":{"key":"system","label":"system","type":"bool","required":"0"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"},"status":{"key":"status","label":"status","type":"text"}}', '2014-07-30 12:37:32', '2014-07-30 12:37:32', 1, 'live', 2),
(4, 'yoga_site', 'yoga_site', '', 'default', 'post', 'post', '', '', '{"id":{"key":"id","label":"id","type":"number","readonly":true},"key":{"key":"key","label":"key","type":"text"},"title":{"key":"title","label":"title","type":"text","required":"1","min":"0","max":"255"},"defaultversion":{"key":"defaultversion","label":"defaultversion","type":"number","required":"0","min":"","max":""},"favicon":{"key":"favicon","label":"favicon","type":"media","required":"0","min":"","max":"1"},"created":{"key":"created","label":"created","type":"text"},"updated":{"key":"updated","label":"updated","type":"text"},"status":{"key":"status","label":"status","type":"text"},"owner":{"key":"owner","label":"owner","type":"text"}}', '2014-07-30 12:53:16', '2014-07-30 12:53:16', 1, 'live', 2);

-- --------------------------------------------------------

--
-- Structure de la table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `system` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`),
  KEY `version` (`admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `group`
--

INSERT INTO `group` (`id`, `key`, `title`, `admin`, `system`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'admin', 'Administrators', 1, 1, '2013-10-02 08:35:40', '2014-05-14 13:41:18', 'live', 2);

-- --------------------------------------------------------

--
-- Structure de la table `human`
--

DROP TABLE IF EXISTS `human`;
CREATE TABLE `human` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `profilepic` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `pref` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `human`
--

INSERT INTO `human` (`id`, `key`, `title`, `firstname`, `lastname`, `descr`, `password`, `profilepic`, `pref`, `system`, `created`, `updated`, `owner`, `status`) VALUES
(1, 'anonymous', 'Anonymous User', '', '', '', '', '', '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'live'),
(2, 'sf@cafecentral.fr', 'Sylvain Frigui', 'Sylvain', 'Frigui', 'Grand Central', '$2y$10$v0yR1h5dxHGVaCYI2.7c/eNXCALGJeOYtoBvGt5w5XV6CMFLYYbwi', '[{"url":"\\/image\\/divers\\/sf.png","title":""}]', '', 0, '2013-10-02 12:36:35', '2014-07-30 12:47:13', 23, 'live'),
(10, '14af88e367adfa9d5f0b3f4266ddff51', '', 'Geneviève', 'Frigui', '', '$2y$10$5WIg6NaYEN1n6Wff.21qWOn4eenG9UUJNLk4gu10.exj4eKlXBcAi', '[{"url":"\\/image\\/divers\\/bureauyoga.jpg","title":""}]', '', 0, '2014-07-30 12:46:20', '2014-07-30 12:46:20', 2, 'live');

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
  `icon` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL,
  `hasurl` tinyint(1) NOT NULL,
  `attr` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `key`, `title`, `descr`, `icon`, `system`, `hasurl`, `attr`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'item', 'Items', '', '019', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"icon":{"key":"icon","type":"string","required":"0","min":"0","max":"10"},"system":{"key":"system","type":"bool","required":"0"},"hasurl":{"key":"hasurl","type":"bool","required":"0"},"attr":{"key":"attr","type":"array"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-10-20 20:50:19', '2014-07-30 12:21:06', 'live', 2),
(2, 'site', 'Sites', '', '064', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"defaultversion":{"key":"defaultversion","type":"int","required":"0","min":"","max":""},"favicon":{"key":"favicon","type":"media","required":"0","min":"","max":"1"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-11-14 14:13:56', '2014-07-30 12:20:13', 'live', 2),
(3, 'page', 'Page', '', '081', 1, 1, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"image":{"key":"image","type":"media","required":"0","min":"","max":""},"text":{"key":"text","type":"string","required":"0","min":"0","max":"5000"},"type":{"key":"type","type":"array"},"section":{"key":"section","type":"rel","required":"0","param":[{"item":"section"}],"min":"","max":""},"url":{"key":"url","type":"url"},"system":{"key":"system","type":"bool","required":"0"},"child":{"key":"child","type":"rel","required":"0","param":[{"item":"page"}],"min":"","max":""},"group":{"key":"group","type":"rel","required":"0","param":[{"item":"group"}],"min":"","max":""},"metatitle":{"key":"metatitle","type":"string","required":"0","min":"0","max":"255"},"metadescr":{"key":"metadescr","type":"string","required":"0","min":"0","max":"500"},"metakeywords":{"key":"metakeywords","type":"string","required":"0","min":"0","max":"500"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"owner":{"key":"owner","type":"owner"},"status":{"key":"status","type":"status"}}', '2013-10-21 01:20:44', '2014-07-30 14:21:50', 'live', 2),
(4, 'version', 'Versions', '', '031', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"lang":{"key":"lang","type":"string","required":"1","min":"0","max":"32"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-11-14 14:13:56', '2014-07-30 12:21:54', 'live', 4),
(5, 'human', 'Humans', '', '074', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"0","min":"0","max":"255"},"firstname":{"key":"firstname","type":"string","required":"0","min":"0","max":"255"},"lastname":{"key":"lastname","type":"string","required":"0","min":"0","max":"255"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"1000"},"password":{"key":"password","type":"password","required":"0"},"group":{"key":"group","type":"rel","required":"0","param":[{"item":"group"}],"min":"","max":""},"profilepic":{"key":"profilepic","type":"media","required":"0","min":"","max":""},"pref":{"key":"pref","type":"array"},"system":{"key":"system","type":"bool","required":"0"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"owner":{"key":"owner","type":"owner"},"status":{"key":"status","type":"status"}}', '2013-09-25 09:16:34', '2014-07-30 12:23:43', 'live', 2),
(6, 'section', 'Sections', '', '004', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"255"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"zone":{"key":"zone","type":"string","required":"0","min":"0","max":"26"},"app":{"key":"app","type":"array"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-09-25 08:33:09', '2014-07-30 12:19:49', 'live', 2),
(7, 'const', 'Text constants', '', '028', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"i18n","field":"fieldTextarea"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-11-14 14:13:57', '2014-07-30 12:22:45', 'live', 2),
(8, 'logbook', 'Logs', '', '030', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"subject":{"key":"subject","type":"string","required":"0","min":"0","max":"5000"},"subjectid":{"key":"subjectid","type":"int","required":"0","min":"","max":""},"item":{"key":"item","type":"string","required":"0","min":"0","max":"5000"},"itemid":{"key":"itemid","type":"int","required":"0","min":"","max":""},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-11-14 14:13:57', '2014-07-30 12:21:22', 'live', 4),
(9, 'form', 'Forms', '', '068', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"5000"},"descr":{"key":"descr","type":"string","required":"0","min":"0","max":"500"},"template":{"key":"template","type":"string","required":"1","min":"0","max":"5000"},"action":{"key":"action","type":"string","required":"1","min":"0","max":"5000"},"method":{"key":"method","type":"list","required":"1"},"target":{"key":"target","type":"string","required":"0","min":"0","max":"5000"},"enctype":{"key":"enctype","type":"list","required":"1"},"field":{"key":"field","type":"array"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"system":{"key":"system","type":"bool","required":"0"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-09-27 08:33:31', '2014-07-30 12:21:39', 'live', 4),
(10, 'group', 'Group', '', '076', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"title":{"key":"title","type":"string","required":"1","min":"0","max":"5000"},"admin":{"key":"admin","type":"bool","required":"0"},"system":{"key":"system","type":"bool","required":"0"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-10-02 08:35:40', '2014-07-30 12:22:19', 'live', 4),
(11, 'workflow', 'Items in the workflow', '', '057', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"item":{"key":"item","type":"string","required":"0","min":"0","max":"500"},"data":{"key":"data","type":"object","required":"0"},"original":{"key":"original","type":"item","required":"1"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2014-05-24 17:54:44', '2014-07-30 12:27:51', 'live', 2),
(12, 'note', 'Notes', '', '076', 1, 0, '{"id":{"key":"id","type":"id"},"key":{"key":"key","type":"key"},"descr":{"key":"descr","type":"string","required":"1","min":"0","max":"5000"},"item":{"key":"item","type":"item","required":"0"},"created":{"key":"created","type":"created"},"updated":{"key":"updated","type":"updated"},"status":{"key":"status","type":"status"},"owner":{"key":"owner","type":"owner"}}', '2013-10-28 21:01:37', '2014-07-30 12:20:47', 'live', 2);

-- --------------------------------------------------------

--
-- Structure de la table `logbook`
--

DROP TABLE IF EXISTS `logbook`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Contenu de la table `logbook`
--

INSERT INTO `logbook` (`id`, `key`, `subject`, `subjectid`, `item`, `itemid`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'insert', 'human', 2, 'form', 1, '2014-07-30 12:17:33', '2014-07-30 12:17:33', 'live', 2),
(2, 'update', 'human', 2, 'item', 2, '2014-07-30 12:17:57', '2014-07-30 12:17:57', 'live', 2),
(3, 'update', 'human', 2, 'item', 2, '2014-07-30 12:18:31', '2014-07-30 12:18:31', 'live', 2),
(4, 'update', 'human', 2, 'item', 2, '2014-07-30 12:18:51', '2014-07-30 12:18:51', 'live', 2),
(5, 'update', 'human', 2, 'item', 6, '2014-07-30 12:19:49', '2014-07-30 12:19:49', 'live', 2),
(6, 'update', 'human', 2, 'item', 2, '2014-07-30 12:20:13', '2014-07-30 12:20:13', 'live', 2),
(7, 'update', 'human', 2, 'item', 12, '2014-07-30 12:20:47', '2014-07-30 12:20:47', 'live', 2),
(8, 'update', 'human', 2, 'item', 1, '2014-07-30 12:21:06', '2014-07-30 12:21:06', 'live', 2),
(9, 'update', 'human', 2, 'form', 1, '2014-07-30 12:21:14', '2014-07-30 12:21:14', 'live', 2),
(10, 'update', 'human', 2, 'item', 8, '2014-07-30 12:21:22', '2014-07-30 12:21:22', 'live', 2),
(11, 'update', 'human', 2, 'item', 9, '2014-07-30 12:21:39', '2014-07-30 12:21:39', 'live', 2),
(12, 'update', 'human', 2, 'item', 4, '2014-07-30 12:21:54', '2014-07-30 12:21:54', 'live', 2),
(13, 'update', 'human', 2, 'item', 10, '2014-07-30 12:22:19', '2014-07-30 12:22:19', 'live', 2),
(14, 'update', 'human', 2, 'item', 7, '2014-07-30 12:22:45', '2014-07-30 12:22:45', 'live', 2),
(15, 'update', 'human', 2, 'item', 5, '2014-07-30 12:23:28', '2014-07-30 12:23:28', 'live', 2),
(16, 'update', 'human', 2, 'item', 5, '2014-07-30 12:23:43', '2014-07-30 12:23:43', 'live', 2),
(17, 'update', 'human', 2, 'item', 3, '2014-07-30 12:26:53', '2014-07-30 12:26:53', 'live', 2),
(18, 'update', 'human', 2, 'item', 11, '2014-07-30 12:27:51', '2014-07-30 12:27:51', 'live', 2),
(19, 'insert', 'human', 2, 'form', 2, '2014-07-30 12:28:08', '2014-07-30 12:28:08', 'live', 2),
(20, 'update', 'human', 2, 'page', 1, '2014-07-30 12:28:45', '2014-07-30 12:28:45', 'live', 2),
(21, 'update', 'human', 2, 'page', 9, '2014-07-30 12:29:46', '2014-07-30 12:29:46', 'live', 2),
(22, 'update', 'human', 2, 'page', 4, '2014-07-30 12:30:26', '2014-07-30 12:30:26', 'live', 2),
(23, 'update', 'human', 2, 'page', 8, '2014-07-30 12:30:54', '2014-07-30 12:30:54', 'live', 2),
(24, 'update', 'human', 2, 'page', 7, '2014-07-30 12:31:20', '2014-07-30 12:31:20', 'live', 2),
(25, 'update', 'human', 2, 'page', 6, '2014-07-30 12:32:52', '2014-07-30 12:32:52', 'live', 2),
(26, 'update', 'human', 2, 'page', 7, '2014-07-30 12:33:12', '2014-07-30 12:33:12', 'live', 2),
(27, 'update', 'human', 2, 'page', 3, '2014-07-30 12:34:13', '2014-07-30 12:34:13', 'live', 2),
(28, 'update', 'human', 2, 'page', 2, '2014-07-30 12:34:41', '2014-07-30 12:34:41', 'live', 2),
(29, 'update', 'human', 2, 'page', 5, '2014-07-30 12:35:15', '2014-07-30 12:35:15', 'live', 2),
(30, 'update', 'human', 2, 'item', 3, '2014-07-30 12:35:52', '2014-07-30 12:35:52', 'live', 2),
(31, 'insert', 'human', 2, 'form', 3, '2014-07-30 12:37:32', '2014-07-30 12:37:32', 'live', 2),
(32, 'update', 'human', 2, 'human', 2, '2014-07-30 12:43:21', '2014-07-30 12:43:21', 'live', 2),
(33, 'insert', 'human', 2, 'human', 10, '2014-07-30 12:46:20', '2014-07-30 12:46:20', 'live', 2),
(34, 'update', 'human', 2, 'human', 2, '2014-07-30 12:47:13', '2014-07-30 12:47:13', 'live', 2),
(35, 'insert', 'human', 2, 'form', 4, '2014-07-30 12:53:16', '2014-07-30 12:53:16', 'live', 2),
(36, 'update', 'human', 2, 'site', 1, '2014-07-30 12:54:37', '2014-07-30 12:54:37', 'live', 2),
(37, 'update', 'human', 2, 'item', 3, '2014-07-30 14:21:50', '2014-07-30 14:21:50', 'live', 2),
(38, 'update', 'human', 2, 'form', 2, '2014-07-30 14:22:03', '2014-07-30 14:22:03', 'live', 2),
(39, 'update', 'human', 2, 'page', 1, '2014-07-30 14:22:26', '2014-07-30 14:22:26', 'live', 2);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE `note` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `descr` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `Itemid` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
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
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `image` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `type` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `system` tinyint(1) NOT NULL,
  `metatitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `metadescr` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `metakeywords` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=88 ;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `descr`, `image`, `text`, `type`, `url`, `system`, `metatitle`, `metadescr`, `metakeywords`, `created`, `updated`, `owner`, `status`) VALUES
(1, 'home', 'Acceuil', '', '[{"url":"\\/image\\/background\\/bg_beach.jpg","title":""}]', '', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/default"}}', '/', 0, '', '', '', '2013-03-25 17:08:31', '2014-07-30 14:22:26', 2, 'live'),
(2, 'error_404', '404', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/default"}}', '/404', 1, '', '', '', '2013-10-16 06:48:43', '2014-07-30 12:34:41', 2, 'live'),
(3, 'login.post', 'Login - routine', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"routine","url":"","master":{"app":"content","template":"\\/master\\/login.post"}}', '/login.post', 1, '', '', '', '2013-10-23 02:57:25', '2014-07-30 12:34:13', 2, 'live'),
(4, 'login', 'Indentification', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/default"}}', '/login', 1, '', '', '', '2014-05-21 16:02:53', '2014-07-30 12:30:26', 2, 'live'),
(5, 'logout', 'Logout routine', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"routine","url":"","master":{"app":"content","template":"\\/master\\/logout"}}', '/logout', 1, '', '', '', '2014-05-21 16:02:53', '2014-07-30 12:35:15', 2, 'live'),
(6, 'api.json', 'API json', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"json","url":"","master":{"app":"content","template":"\\/api\\/api"}}', '/api.json', 1, '', '', '', '2013-03-06 03:21:46', '2014-07-30 12:32:52', 2, 'live'),
(7, 'api.xml', 'API xml', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"xml","url":"","master":{"app":"content","template":"\\/api\\/api"}}', '/api.xml', 1, '', '', '', '2013-03-06 03:21:46', '2014-07-30 12:33:12', 2, 'live'),
(8, 'ajax.html', 'Ajax', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"content","template":"\\/master\\/ajax"}}', '/ajax.html', 1, '', '', '', '2013-03-06 03:21:46', '2014-07-30 12:30:54', 2, 'live'),
(9, 'maintenance', 'Maintenance', '', '', '', '{"key":"content","http_status":"200 OK","content_type":"html","url":"","master":{"app":"maintenance","template":"\\/index"}}', '/maintenance', 1, '', '', '', '2014-07-01 11:35:13', '2014-07-30 12:29:46', 2, 'live');

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
  `zone` varchar(26) COLLATE utf8_unicode_ci NOT NULL,
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
  `defaultversion` mediumint(3) unsigned NOT NULL,
  `favicon` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Contenu de la table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `defaultversion`, `favicon`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'yoga', 'ACSC Yoga', 1, '[{"url":"\\/image\\/divers\\/lg_yoga.png","title":""}]', '2013-05-21 14:52:00', '2014-07-30 12:54:37', 'live', 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`, `owner`) VALUES
(1, 'fr', 'Français', 'fr', '2013-10-31 14:41:56', '2013-10-31 14:41:56', 'live', 2);

-- --------------------------------------------------------

--
-- Structure de la table `workflow`
--

DROP TABLE IF EXISTS `workflow`;
CREATE TABLE `workflow` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `data` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `original` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `owner` mediumint(3) unsigned NOT NULL,
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
('human', 10, 'group', 'group', 1, 0),
('human', 2, 'group', 'group', 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
