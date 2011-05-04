-- phpMyAdmin SQL Dump
-- version 2.11.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2007 at 03:43 AM
-- Server version: 5.0.41
-- PHP Version: 5.2.2
-- $Id:$
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `hse_iso`
--

-- --------------------------------------------------------

--
-- Table structure for table `mks_sdata_iso_9241_10`
--

DROP TABLE IF EXISTS `mks_sdata_iso_9241_10`;
CREATE TABLE IF NOT EXISTS `mks_sdata_iso_9241_10` (
  `id` int(11) NOT NULL auto_increment,
  `finished` tinyint(1) NOT NULL default '0',
  `config` tinyint(1) NOT NULL default '0',
  `survivor_email` char(50) character set utf8 collate utf8_bin NOT NULL,
  `tid` char(50) character set utf8 collate utf8_bin NOT NULL,
  `txt_1_` char(50) default NULL,
  `txt_2_` char(50) default NULL,
  `txt_3_` char(50) default NULL,
  `txt_4_` char(50) default NULL,
  `txd_5_` int(10) default NULL,
  `txd_6_` int(10) default NULL,
  `rd7_7_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_8_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_9_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_10_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_11_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_12_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_13_` enum('1','2','3','4','5','6','7') default NULL,
  `txa_14_` tinytext,
  `rd7_15_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_16_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_17_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_18_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_19_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_20_` enum('1','2','3','4','5','6','7') default NULL,
  `txa_21_` tinytext,
  `rd7_22_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_23_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_24_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_25_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_26_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_27_` enum('1','2','3','4','5','6','7') default NULL,
  `txa_28_` tinytext,
  `rd7_29_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_30_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_31_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_32_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_33_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_34_` enum('1','2','3','4','5','6','7') default NULL,
  `txa_35_` tinytext,
  `rd7_36_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_37_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_38_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_39_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_40_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_41_` enum('1','2','3','4','5','6','7') default NULL,
  `txa_42_` tinytext,
  `rd7_43_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_44_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_45_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_46_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_47_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_48_` enum('1','2','3','4','5','6','7') default NULL,
  `txa_49_` tinytext,
  `rd7_50_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_51_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_52_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_53_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_54_` enum('1','2','3','4','5','6','7') default NULL,
  `rd7_55_` enum('1','2','3','4','5','6','7') default NULL,
  `txa_56_` tinytext,
  `txd_57_` int(10) default NULL,
  `txd_58_` int(10) default NULL,
  `txd_59_` int(10) default NULL,
  `txd_60_` int(10) default NULL,
  `txd_61_` int(10) default NULL,
  `ra6_62_` enum('1','2','3','4','5','6') default NULL,
  `ra2_63_` enum('1','2') default NULL,
  `txt_64_` char(50) default NULL,
  `txa_65_` tinytext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;


-- --------------------------------------------------------

--
-- Table structure for table `mks_session`
--

DROP TABLE IF EXISTS `mks_session`;
CREATE TABLE IF NOT EXISTS `mks_session` (
  `username` varchar(50) default NULL,
  `time` varchar(14) default NULL,
  `session_id` varchar(200) NOT NULL default '0',
  `guest` tinyint(4) default '1',
  `userid` int(11) default NULL,
  `usertype` enum('','superadmin','admin','user') NOT NULL,
  `gid` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`session_id`),
  KEY `whosonline` (`guest`,`usertype`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mks_surveys`
--

DROP TABLE IF EXISTS `mks_surveys`;
CREATE TABLE IF NOT EXISTS `mks_surveys` (
  `survey_id` int(10) NOT NULL auto_increment,
  `user_id` int(10) NOT NULL,
  `survey_type_id` char(20) collate utf8_bin NOT NULL,
  `title` char(80) collate utf8_bin NOT NULL,
  `date_created` datetime NOT NULL,
  `date_finish` datetime default NULL,
  `date_begin` datetime default NULL,
  `description` char(255) collate utf8_bin default NULL,
  `finished` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`survey_id`),
  KEY `mks_users_mks_surveys_FK1` (`user_id`),
  KEY `mks_survey_types_mks_surveys_FK1` (`survey_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `mks_survey_structure`
--

DROP TABLE IF EXISTS `mks_survey_structure`;
CREATE TABLE IF NOT EXISTS `mks_survey_structure` (
  `id` int(10) NOT NULL default '0',
  `survey_type_id` char(20) collate utf8_bin NOT NULL,
  `field_name` char(10) collate utf8_bin default NULL,
  `uc_type_id` char(10) collate utf8_bin default NULL,
  `required` tinyint(1) NOT NULL,
  `page` int(2) NOT NULL,
  `order` int(3) NOT NULL,
  `static` tinyint(1) default NULL COMMENT 'defines if field is static',
  `validate` varchar(50) collate utf8_bin default NULL COMMENT 'validate rule',
  PRIMARY KEY  (`id`),
  KEY `mks_user_controls_mks_survey_structure_FK1` (`uc_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mks_survey_structure`
--

INSERT INTO `mks_survey_structure` (`id`, `survey_type_id`, `field_name`, `uc_type_id`, `required`, `page`, `order`, `static`, `validate`) VALUES
(65, 'iso_9241_10', 'txa_65_', 'txa', 1, 9, 65, 0, NULL),
(64, 'iso_9241_10', 'txt_64_', 'txt', 1, 9, 64, 0, NULL),
(63, 'iso_9241_10', 'ra2_63_', 'ra2', 1, 9, 63, 0, NULL),
(62, 'iso_9241_10', 'ra6_62_', 'ra6', 1, 9, 62, 0, NULL),
(61, 'iso_9241_10', 'txd_61_', 'txd', 1, 9, 61, 0, NULL),
(60, 'iso_9241_10', 'txd_60_', 'txd', 1, 9, 60, 0, NULL),
(59, 'iso_9241_10', 'txd_59_', 'txd', 1, 9, 59, 0, NULL),
(58, 'iso_9241_10', 'txd_58_', 'txd', 1, 9, 58, 0, NULL),
(57, 'iso_9241_10', 'txd_57_', 'txd', 1, 9, 57, 0, NULL),
(56, 'iso_9241_10', 'txa_56_', 'txa', 1, 8, 56, 0, NULL),
(55, 'iso_9241_10', 'rd7_55_', 'rd7', 1, 8, 55, 0, NULL),
(54, 'iso_9241_10', 'rd7_54_', 'rd7', 1, 8, 54, 0, NULL),
(53, 'iso_9241_10', 'rd7_53_', 'rd7', 1, 8, 53, 0, NULL),
(52, 'iso_9241_10', 'rd7_52_', 'rd7', 1, 8, 52, 0, NULL),
(51, 'iso_9241_10', 'rd7_51_', 'rd7', 1, 8, 51, 0, NULL),
(50, 'iso_9241_10', 'rd7_50_', 'rd7', 1, 8, 50, 0, NULL),
(49, 'iso_9241_10', 'txa_49_', 'txa', 1, 7, 49, 0, NULL),
(48, 'iso_9241_10', 'rd7_48_', 'rd7', 1, 7, 48, 0, NULL),
(47, 'iso_9241_10', 'rd7_47_', 'rd7', 1, 7, 47, 0, NULL),
(46, 'iso_9241_10', 'rd7_46_', 'rd7', 1, 7, 46, 0, NULL),
(45, 'iso_9241_10', 'rd7_45_', 'rd7', 1, 7, 45, 0, NULL),
(44, 'iso_9241_10', 'rd7_44_', 'rd7', 1, 7, 44, 0, NULL),
(43, 'iso_9241_10', 'rd7_43_', 'rd7', 1, 7, 43, 0, NULL),
(42, 'iso_9241_10', 'txa_42_', 'txa', 1, 6, 42, 0, NULL),
(41, 'iso_9241_10', 'rd7_41_', 'rd7', 1, 6, 41, 0, NULL),
(40, 'iso_9241_10', 'rd7_40_', 'rd7', 1, 6, 40, 0, NULL),
(39, 'iso_9241_10', 'rd7_39_', 'rd7', 1, 6, 39, 0, NULL),
(38, 'iso_9241_10', 'rd7_38_', 'rd7', 1, 6, 38, 0, NULL),
(37, 'iso_9241_10', 'rd7_37_', 'rd7', 1, 6, 37, 0, NULL),
(36, 'iso_9241_10', 'rd7_36_', 'rd7', 1, 6, 36, 0, NULL),
(35, 'iso_9241_10', 'txa_35_', 'txa', 1, 5, 35, 0, NULL),
(34, 'iso_9241_10', 'rd7_34_', 'rd7', 1, 5, 34, 0, NULL),
(33, 'iso_9241_10', 'rd7_33_', 'rd7', 1, 5, 33, 0, NULL),
(32, 'iso_9241_10', 'rd7_32_', 'rd7', 1, 5, 32, 0, NULL),
(31, 'iso_9241_10', 'rd7_31_', 'rd7', 1, 5, 31, 0, NULL),
(30, 'iso_9241_10', 'rd7_30_', 'rd7', 1, 5, 30, 0, NULL),
(29, 'iso_9241_10', 'rd7_29_', 'rd7', 1, 5, 29, 0, NULL),
(28, 'iso_9241_10', 'txa_28_', 'txa', 1, 4, 28, 0, NULL),
(27, 'iso_9241_10', 'rd7_27_', 'rd7', 1, 4, 27, 0, NULL),
(26, 'iso_9241_10', 'rd7_26_', 'rd7', 1, 4, 26, 0, NULL),
(25, 'iso_9241_10', 'rd7_25_', 'rd7', 1, 4, 25, 0, NULL),
(24, 'iso_9241_10', 'rd7_24_', 'rd7', 1, 4, 24, 0, NULL),
(23, 'iso_9241_10', 'rd7_23_', 'rd7', 1, 4, 23, 0, NULL),
(22, 'iso_9241_10', 'rd7_22_', 'rd7', 1, 4, 22, 0, NULL),
(21, 'iso_9241_10', 'txa_21_', 'txa', 1, 3, 21, 0, NULL),
(20, 'iso_9241_10', 'rd7_20_', 'rd7', 1, 3, 20, 0, NULL),
(19, 'iso_9241_10', 'rd7_19_', 'rd7', 1, 3, 19, 0, NULL),
(18, 'iso_9241_10', 'rd7_18_', 'rd7', 1, 3, 18, 0, NULL),
(17, 'iso_9241_10', 'rd7_17_', 'rd7', 1, 3, 17, 0, NULL),
(16, 'iso_9241_10', 'rd7_16_', 'rd7', 1, 3, 16, 0, NULL),
(15, 'iso_9241_10', 'rd7_15_', 'rd7', 1, 3, 15, 0, NULL),
(14, 'iso_9241_10', 'txa_14_', 'txa', 1, 2, 14, 0, NULL),
(13, 'iso_9241_10', 'rd7_13_', 'rd7', 1, 2, 13, 0, NULL),
(12, 'iso_9241_10', 'rd7_12_', 'rd7', 1, 2, 12, 0, NULL),
(11, 'iso_9241_10', 'rd7_11_', 'rd7', 1, 2, 11, 0, NULL),
(10, 'iso_9241_10', 'rd7_10_', 'rd7', 1, 2, 10, 0, NULL),
(9, 'iso_9241_10', 'rd7_9_', 'rd7', 1, 2, 9, 0, NULL),
(8, 'iso_9241_10', 'rd7_8_', 'rd7', 1, 2, 8, 0, NULL),
(7, 'iso_9241_10', 'rd7_7_', 'rd7', 1, 1, 7, 0, NULL),
(6, 'iso_9241_10', 'txd_6_', 'txd', 1, 1, 6, 0, '0-168'),
(5, 'iso_9241_10', 'txd_5_', 'txd', 1, 1, 5, 0, '0-360'),
(4, 'iso_9241_10', 'txt_4_', 'txt', 1, 1, 4, 1, NULL),
(3, 'iso_9241_10', 'txt_3_', 'txt', 1, 1, 3, 1, NULL),
(2, 'iso_9241_10', 'txt_2_', 'txt', 1, 1, 2, 1, NULL),
(1, 'iso_9241_10', 'txt_1_', 'txt', 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mks_survey_survivors`
--

DROP TABLE IF EXISTS `mks_survey_survivors`;
CREATE TABLE IF NOT EXISTS `mks_survey_survivors` (
  `survivor_id` int(10) NOT NULL auto_increment,
  `survey_id` int(10) NOT NULL default '0',
  `survivor_email` char(50) collate utf8_bin NOT NULL,
  `email_sent` varchar(1) collate utf8_bin NOT NULL default '0',
  `tid` char(50) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`survivor_id`),
  UNIQUE KEY `tid` (`tid`),
  UNIQUE KEY `Isurvivor` (`survey_id`,`survivor_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Table structure for table `mks_survey_types`
--

DROP TABLE IF EXISTS `mks_survey_types`;
CREATE TABLE IF NOT EXISTS `mks_survey_types` (
  `survey_type_id` char(20) collate utf8_bin NOT NULL,
  `name` char(20) collate utf8_bin NOT NULL,
  `description` char(255) collate utf8_bin default NULL,
  `languages` char(100) collate utf8_bin default NULL,
  PRIMARY KEY  (`survey_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mks_survey_types`
--

INSERT INTO `mks_survey_types` (`survey_type_id`, `name`, `description`, `languages`) VALUES
('iso_9241_10', 'ISO 9241/10', 'Iso', 'de;en');

-- --------------------------------------------------------

--
-- Table structure for table `mks_users`
--

DROP TABLE IF EXISTS `mks_users`;
CREATE TABLE IF NOT EXISTS `mks_users` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL COMMENT 'Login name of user',
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` enum('administrator','superadministrator','user') NOT NULL,
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `usertype` (`usertype`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=537 ;

-- --------------------------------------------------------

--
-- Table structure for table `mks_users_incoming`
--

DROP TABLE IF EXISTS `mks_users_incoming`;
CREATE TABLE IF NOT EXISTS `mks_users_incoming` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL COMMENT 'Login name of user',
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `usertype` enum('administrator','superadministrator','user') NOT NULL,
  `block` tinyint(4) NOT NULL default '0',
  `sendEmail` tinyint(4) default '0',
  `gid` tinyint(3) unsigned NOT NULL default '1',
  `register_date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `optin` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `optin` (`optin`),
  KEY `usertype` (`usertype`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;


-- --------------------------------------------------------

--
-- Table structure for table `mks_user_controls`
--

DROP TABLE IF EXISTS `mks_user_controls`;
CREATE TABLE IF NOT EXISTS `mks_user_controls` (
  `uc_type_id` char(10) collate utf8_bin NOT NULL default '',
  `sql_type` char(100) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`uc_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mks_user_controls`
--

INSERT INTO `mks_user_controls` (`uc_type_id`, `sql_type`) VALUES
('txt', 'char(50)'),
('txd', 'Int(10)'),
('txa', 'TINYTEXT'),
('rd7', 'enum(''1'',''2'',''3'',''4'',''5'',''6'',''7'')'),
('ra6', 'enum(''1'',''2'',''3'',''4'',''5'',''6'')'),
('ra2', 'enum(''1'',''2'')');

-- Added tocken for mks_surveys
ALTER TABLE `mks_surveys` ADD `token` VARCHAR( 50 ) NOT NULL;  
ALTER TABLE `mks_surveys` ADD UNIQUE (
`token`
) 