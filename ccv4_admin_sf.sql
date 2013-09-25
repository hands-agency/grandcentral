-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 25 Septembre 2013 à 16:26
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ccv4_admin_sf`
--

-- --------------------------------------------------------

--
-- Structure de la table `page`
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
-- Contenu de la table `page`
--

INSERT INTO `page` (`id`, `key`, `title`, `descr`, `text`, `http_status`, `template`, `url`, `system`, `created`, `updated`, `status`, `version`) VALUES
(1, 'home', 'grabou', '', '', '200 OK', '{"type":"html","key":"default"}', '/', 0, '2013-03-25 17:08:31', '2013-08-26 18:00:32', 'live', 1);

-- --------------------------------------------------------

--
-- Structure de la table `site`
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
-- Contenu de la table `site`
--

INSERT INTO `site` (`id`, `key`, `title`, `created`, `updated`, `status`, `defaultversion`) VALUES
(1, 'admin', 'Grandcentral Administration', '2013-05-21 14:52:00', '2013-05-21 14:52:00', 'live', 1);

-- --------------------------------------------------------

--
-- Structure de la table `structure`
--

CREATE TABLE `structure` (
  `id` mediumint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'The unique identifier',
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The key',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short title',
  `descr` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'A short description',
  `system` tinyint(1) NOT NULL COMMENT 'Is system',
  `attr` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'Attributes',
  `fitsinsitetree` tinyint(1) NOT NULL COMMENT 'Can fit in the Site Tree',
  `created` datetime NOT NULL COMMENT 'Created Datetime',
  `updated` datetime NOT NULL COMMENT 'Updated Datetime',
  `status` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `structure`
--

INSERT INTO `structure` (`id`, `key`, `title`, `descr`, `system`, `attr`, `fitsinsitetree`, `created`, `updated`, `status`) VALUES
(1, 'structure', 'Structures', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"descr":{"key":"descr","title":"A short description","type":"string","min":"0","max":"500"},"system":{"key":"system","title":"Is system","type":"bool"},"attr":{"key":"attr","title":"Attributes","type":"array"},"fitsinsitetree":{"key":"fitsinsitetree","title":"Can fit in the Site Tree","type":"bool"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status"}}', 0, '0000-00-00 00:00:00', '2013-04-05 12:39:48', 'live'),
(2, 'site', 'Your websites', 'Manage your website basics, and the apps that will be opened at all time.', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"defaultversion":{"key":"defaultversion","type":"int","title":"Default Version"}}', 0, '0000-00-00 00:00:00', '2013-04-05 12:41:29', 'live'),
(3, 'page', 'Page', '', 1, '{"id":{"key":"id","type":"id","title":"The unique identifier"},"key":{"key":"key","type":"key","title":"The key"},"title":{"key":"title","type":"string","title":"A short title","min":"0","max":"255","required":"1"},"descr":{"key":"descr","type":"string","title":"A short description","min":"0","max":"500"},"text":{"key":"text","type":"string","title":"The text content","min":"0","max":"65035"},"http_status":{"key":"http_status","type":"string","title":"The http status","min":"0","max":"255"},"template":{"key":"template","type":"array","title":"The template"},"url":{"key":"url","type":"string","title":"The url","min":"0","max":"255","required":"1"},"system":{"key":"system","type":"bool","title":"System"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"},"version":{"key":"version","type":"version"},"child":{"key":"child","param":[{"item":"structure_3"}],"min":"","max":"","type":"rel"},"section":{"key":"section","param":{"1":{"item":"structure_5"}},"min":"","max":"","type":"rel"}}', 1, '0000-00-00 00:00:00', '2013-08-20 18:57:03', 'live'),
(4, 'version', 'Versions', '', 1, '{"id":{"key":"id","title":"The unique identifier","type":"id"},"key":{"key":"key","title":"The key","type":"key"},"title":{"key":"title","title":"A short title","type":"string","min":"0","max":"255","required":"1"},"lang":{"key":"lang","title":"Language","type":"string","min":"0","max":"32","required":"1"},"created":{"key":"created","type":"created","title":"Created Datetime"},"updated":{"key":"updated","type":"updated","title":"Updated Datetime"},"status":{"key":"status","type":"status","title":"Status"}}', 0, '0000-00-00 00:00:00', '2013-04-05 12:43:36', 'live');

-- --------------------------------------------------------

--
-- Structure de la table `version`
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
-- Contenu de la table `version`
--

INSERT INTO `version` (`id`, `key`, `title`, `lang`, `created`, `updated`, `status`) VALUES
(1, 'en', 'English', 'en', '2013-04-05 17:02:34', '2013-04-05 17:02:34', 'live');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
