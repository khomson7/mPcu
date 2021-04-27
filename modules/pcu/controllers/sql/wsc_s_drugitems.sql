/*
Navicat MySQL Data Transfer

Source Server         : 192.168.3.3_3306
Source Server Version : 50563
Source Host           : 192.168.3.3:3306
Source Database       : hos

Target Server Type    : MYSQL
Target Server Version : 50563
File Encoding         : 65001

Date: 2021-04-27 00:04:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for s_drugitems
-- ----------------------------
DROP TABLE IF EXISTS `wsc_s_drugitems`;
CREATE TABLE `wsc_s_drugitems` (
  `icode` varchar(7) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `strength` varchar(50) DEFAULT NULL,
  `units` varchar(50) DEFAULT NULL,
  `dosageform` varchar(100) DEFAULT NULL,
  `drugnote` varchar(150) DEFAULT NULL,
  `use_right` char(1) DEFAULT NULL,
  `must_paid` char(1) DEFAULT NULL,
  `istatus` char(1) DEFAULT NULL,
  `access_level` int(11) DEFAULT NULL,
  `paidst` char(2) DEFAULT NULL,
  `displaycolor` int(11) DEFAULT NULL,
  `price_lock` char(1) DEFAULT NULL,
  `icode_guid` varchar(38) DEFAULT NULL,
  `ename` varchar(150) DEFAULT NULL,
  `cost` double(15,3) DEFAULT NULL,
  `income` char(2) DEFAULT NULL,
  `hos_guid` varchar(38) DEFAULT NULL,
  `hos_guid_ext` varchar(64) DEFAULT NULL,
  `is_medication` char(1) DEFAULT NULL,
  `use_paidst` char(1) DEFAULT NULL,
  `is_medsupply` char(1) DEFAULT NULL,
  `sub_income` varchar(3) DEFAULT NULL,
  `highcost` varchar(1) DEFAULT 'N',
  `oldcode` varchar(15) DEFAULT NULL,
  `billcode` varchar(10) DEFAULT NULL,
  `billnumber` varchar(15) DEFAULT NULL,
  `nhso_adp_type_id` int(11) DEFAULT NULL,
  `nhso_adp_code` varchar(15) DEFAULT NULL,
  `unitprice` double(15,3) DEFAULT NULL,
  `displaycolor_focus` int(11) DEFAULT NULL,
  `tpu_code_list` varchar(200) DEFAULT NULL,
  `drugaccount` varchar(2) DEFAULT NULL,
  `sks_drug_code` varchar(25) DEFAULT NULL,
  `sks_product_category_id` int(11) DEFAULT NULL,
  `icd9cm` varchar(7) DEFAULT NULL,
  `drugcategory` varchar(150) DEFAULT NULL,
  `sks_dfs_code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`icode`),
  KEY `ix_name` (`name`),
  KEY `ix_access` (`access_level`),
  KEY `ix_status` (`istatus`),
  KEY `ix_nsu` (`name`,`strength`,`units`),
  KEY `ix_icode_guid` (`icode_guid`),
  KEY `ix_hos_guid_ext` (`hos_guid_ext`),
  KEY `ix_search1` (`is_medication`,`istatus`,`name`,`icode`),
  KEY `ix_search1_index` (`icode`,`is_medication`,`istatus`,`name`),
  KEY `ix_nsu_index` (`name`,`units`,`strength`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;
