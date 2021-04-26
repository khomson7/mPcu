/*
Navicat MySQL Data Transfer

Source Server         : 192.168.3.3_3306
Source Server Version : 50563
Source Host           : 192.168.3.3:3306
Source Database       : hos

Target Server Type    : MYSQL
Target Server Version : 50563
File Encoding         : 65001

Date: 2021-04-26 11:47:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pp_special_type
-- ----------------------------
DROP TABLE IF EXISTS `wsc_special_type`;
CREATE TABLE `wsc_special_type` (
  `pp_special_type_name` varchar(200) DEFAULT NULL,
  `pp_special_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620;


