/*
Navicat MySQL Data Transfer

Source Server         : 192.168.3.21_3306
Source Server Version : 50505
Source Host           : 192.168.3.21:3306
Source Database       : hosxp_pcu03149

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-10-16 14:07:08
*/

SET FOREIGN_KEY_CHECKS=0;

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
