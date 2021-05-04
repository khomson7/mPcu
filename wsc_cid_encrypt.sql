/*
Navicat MySQL Data Transfer

Source Server         : 192.168.2.190_3306
Source Server Version : 50531
Source Host           : 192.168.2.190:3306
Source Database       : hosxp_pcu

Target Server Type    : MYSQL
Target Server Version : 50531
File Encoding         : 65001

Date: 2021-05-03 14:22:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for wsc_cid_encrypt
-- ----------------------------
DROP TABLE IF EXISTS `wsc_cid_encrypt`;
CREATE TABLE `wsc_cid_encrypt` (
  `cid_encrypt` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`cid_encrypt`),
  KEY `idx` (`cid_encrypt`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=tis620;
