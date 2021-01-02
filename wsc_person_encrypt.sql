/*
Navicat MySQL Data Transfer

Source Server         : 192.168.3.21_3306
Source Server Version : 50505
Source Host           : 192.168.3.21:3306
Source Database       : hosxp_pcu03149

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-10-18 14:32:49
*/

SET FOREIGN_KEY_CHECKS=0;

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
