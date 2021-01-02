/*
Navicat MySQL Data Transfer

Source Server         : 192.168.3.21_3306
Source Server Version : 50505
Source Host           : 192.168.3.21:3306
Source Database       : hosxp_pcu03149

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-11-28 23:07:33
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
) ENGINE=InnoDB DEFAULT CHARSET=tis620;
