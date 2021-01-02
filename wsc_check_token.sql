/*
Navicat MySQL Data Transfer

Source Server         : 192.168.3.21_3306
Source Server Version : 50505
Source Host           : 192.168.3.21:3306
Source Database       : hosxp_pcu03149

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-10-16 13:20:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wsc_check_token
-- ----------------------------
DROP TABLE IF EXISTS `wsc_check_token`;
CREATE TABLE `wsc_check_token` (
  `id` int(11) NOT NULL,
  `token_` varchar(255) DEFAULT NULL,
  `date_creat` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idkey` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_cid_encrypt
-- ----------------------------
DROP TABLE IF EXISTS `wsc_cid_encrypt`;
CREATE TABLE `wsc_cid_encrypt` (
  `cid_encrypt` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`cid_encrypt`),
  KEY `idx` (`cid_encrypt`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_clinicmember_cid
-- ----------------------------
DROP TABLE IF EXISTS `wsc_clinicmember_cid`;
CREATE TABLE `wsc_clinicmember_cid` (
  `cid` varchar(13) NOT NULL,
  `clinic` varchar(5) NOT NULL,
  PRIMARY KEY (`cid`,`clinic`),
  KEY `key` (`cid`,`clinic`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_death_check
-- ----------------------------
DROP TABLE IF EXISTS `wsc_death_check`;
CREATE TABLE `wsc_death_check` (
  `CID` varchar(13) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `DISCHARGE` char(1) DEFAULT NULL,
  `DDISCHARGE` date DEFAULT NULL,
  `apicheck` varchar(35) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`CID`,`PID`),
  KEY `idx3` (`PID`),
  KEY `idx1` (`CID`,`PID`) USING BTREE,
  KEY `idx2` (`CID`,`PID`) USING BTREE,
  KEY `idx4` (`CID`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_epi_check
-- ----------------------------
DROP TABLE IF EXISTS `wsc_epi_check`;
CREATE TABLE `wsc_epi_check` (
  `epikey` varchar(50) CHARACTER SET utf8 NOT NULL,
  `PID` int(11) NOT NULL,
  `check_update` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_status` char(1) DEFAULT '0',
  PRIMARY KEY (`epikey`,`check_update`,`check_edit`),
  KEY `idx` (`check_update`),
  KEY `idx1` (`check_edit`),
  KEY `idx0` (`epikey`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_opitemrece_pcu_check
-- ----------------------------
DROP TABLE IF EXISTS `wsc_opitemrece_pcu_check`;
CREATE TABLE `wsc_opitemrece_pcu_check` (
  `mkey` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`mkey`),
  KEY `idx` (`mkey`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_person_encrypt
-- ----------------------------
DROP TABLE IF EXISTS `wsc_person_encrypt`;
CREATE TABLE `wsc_person_encrypt` (
  `PID` int(11) NOT NULL,
  `check_update` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 NOT NULL,
  `wsc_update` datetime DEFAULT NULL,
  `d_update` datetime DEFAULT NULL,
  `check_status` char(1) DEFAULT '0',
  PRIMARY KEY (`PID`,`check_update`,`check_edit`),
  KEY `idx` (`check_update`),
  KEY `idx1` (`check_edit`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_t_work_pcu
-- ----------------------------
DROP TABLE IF EXISTS `wsc_t_work_pcu`;
CREATE TABLE `wsc_t_work_pcu` (
  `date_work` date NOT NULL,
  `d_update` datetime DEFAULT NULL,
  PRIMARY KEY (`date_work`),
  KEY `idx` (`date_work`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Table structure for wsc_user
-- ----------------------------
DROP TABLE IF EXISTS `wsc_user`;
CREATE TABLE `wsc_user` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;
