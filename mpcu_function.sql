/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50531
Source Host           : 127.0.0.1:3306
Source Database       : mpcu_function

Target Server Type    : MYSQL
Target Server Version : 50531
File Encoding         : 65001

Date: 2021-05-03 10:52:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for anc_cid
-- ----------------------------
DROP TABLE IF EXISTS `anc_cid`;
CREATE TABLE `anc_cid` (
  `cid` varchar(13) NOT NULL,
  `rxdate` date DEFAULT NULL,
  PRIMARY KEY (`cid`),
  KEY `key` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of anc_cid
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_allergy_encrypt
-- ----------------------------
DROP TABLE IF EXISTS `wsc_allergy_encrypt`;
CREATE TABLE `wsc_allergy_encrypt` (
  `cid_encrypt` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cid_encrypt`),
  KEY `idx0` (`cid_encrypt`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_allergy_encrypt
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_btn
-- ----------------------------
DROP TABLE IF EXISTS `wsc_btn`;
CREATE TABLE `wsc_btn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `btnname` varchar(50) DEFAULT NULL,
  `date_on` date DEFAULT NULL,
  `btn_on` enum('N','Y') DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_btn
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_check_send
-- ----------------------------
DROP TABLE IF EXISTS `wsc_check_send`;
CREATE TABLE `wsc_check_send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_send` varchar(15) DEFAULT NULL,
  `name_detail` varchar(255) DEFAULT NULL,
  `check_time_process` int(11) DEFAULT NULL,
  `check_send` enum('1','0') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx0` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_check_send
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_check_time_process
-- ----------------------------
DROP TABLE IF EXISTS `wsc_check_time_process`;
CREATE TABLE `wsc_check_time_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_time_process` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx0` (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_check_time_process
-- ----------------------------

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

-- ----------------------------
-- Records of wsc_check_token
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_chronic_lab
-- ----------------------------
DROP TABLE IF EXISTS `wsc_chronic_lab`;
CREATE TABLE `wsc_chronic_lab` (
  `hoscode` varchar(5) DEFAULT NULL,
  `cid_encrypt` varchar(37) NOT NULL,
  `hn` varchar(9) DEFAULT NULL,
  `order_date` date NOT NULL,
  `uuid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid_encrypt`,`order_date`),
  KEY `idx1` (`cid_encrypt`),
  KEY `idx0` (`cid_encrypt`,`order_date`) USING BTREE,
  KEY `idx2` (`order_date`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_chronic_lab
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_chronic_lab_copy
-- ----------------------------
DROP TABLE IF EXISTS `wsc_chronic_lab_copy`;
CREATE TABLE `wsc_chronic_lab_copy` (
  `hoscode` varchar(5) DEFAULT NULL,
  `cid_encrypt` varchar(37) NOT NULL,
  `hn` varchar(9) DEFAULT NULL,
  `order_date` date NOT NULL,
  `uuid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cid_encrypt`,`order_date`),
  KEY `idx1` (`cid_encrypt`),
  KEY `idx0` (`cid_encrypt`,`order_date`) USING BTREE,
  KEY `idx2` (`order_date`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_chronic_lab_copy
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_cid_encrypt
-- ----------------------------
DROP TABLE IF EXISTS `wsc_cid_encrypt`;
CREATE TABLE `wsc_cid_encrypt` (
  `cid_encrypt` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cid_encrypt`,`check_edit`),
  KEY `idx` (`cid_encrypt`,`check_edit`) USING BTREE,
  KEY `idx0` (`cid_encrypt`),
  KEY `idx1` (`check_edit`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_cid_encrypt
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_clinicmember
-- ----------------------------
DROP TABLE IF EXISTS `wsc_clinicmember`;
CREATE TABLE `wsc_clinicmember` (
  `mcid` varchar(37) DEFAULT NULL,
  `clinic` varchar(9) DEFAULT NULL,
  `regdate` date DEFAULT NULL,
  `lastvisit` date DEFAULT NULL,
  `begin_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wsc_clinicmember
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_clinicmember_cid
-- ----------------------------
DROP TABLE IF EXISTS `wsc_clinicmember_cid`;
CREATE TABLE `wsc_clinicmember_cid` (
  `cid` varchar(13) NOT NULL,
  `clinic` varchar(5) NOT NULL,
  PRIMARY KEY (`cid`,`clinic`),
  KEY `key` (`cid`,`clinic`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_clinicmember_cid
-- ----------------------------

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
-- Records of wsc_death_check
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_drugitems
-- ----------------------------
DROP TABLE IF EXISTS `wsc_drugitems`;
CREATE TABLE `wsc_drugitems` (
  `icode` varchar(7) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `strength` varchar(50) DEFAULT NULL,
  `units` varchar(50) DEFAULT NULL,
  `unitprice` double(22,3) DEFAULT NULL,
  `dosageform` varchar(100) DEFAULT NULL,
  `criticalpriority` int(11) DEFAULT NULL,
  `drugaccount` varchar(2) DEFAULT NULL,
  `drugcategory` varchar(150) DEFAULT NULL,
  `drugnote` varchar(150) DEFAULT NULL,
  `hintcode` varchar(4) DEFAULT NULL,
  `istatus` char(1) DEFAULT NULL,
  `lastupdatestdprice` datetime DEFAULT NULL,
  `lockprice` char(1) DEFAULT NULL,
  `lockprint` char(1) DEFAULT NULL,
  `maxlevel` int(11) DEFAULT NULL,
  `minlevel` int(11) DEFAULT NULL,
  `maxunitperdose` int(11) DEFAULT NULL,
  `packqty` int(11) DEFAULT NULL,
  `reorderqty` int(11) DEFAULT NULL,
  `stdprice` double(22,3) DEFAULT NULL,
  `stdtaken` varchar(30) DEFAULT NULL,
  `therapeutic` varchar(150) DEFAULT NULL,
  `therapeuticgroup` varchar(150) DEFAULT NULL,
  `default_qty` int(11) DEFAULT NULL,
  `gpo_code` varchar(7) DEFAULT NULL,
  `use_right` char(1) DEFAULT NULL,
  `i_type` char(1) DEFAULT NULL,
  `drugusage` varchar(30) DEFAULT NULL,
  `high_cost` varchar(1) DEFAULT NULL,
  `must_paid` char(1) DEFAULT NULL,
  `alert_level` tinyint(4) DEFAULT NULL,
  `access_level` tinyint(4) DEFAULT NULL,
  `sticker_short_name` varchar(150) DEFAULT NULL,
  `paidst` char(2) DEFAULT NULL,
  `antibiotic` char(1) DEFAULT NULL,
  `displaycolor` int(11) DEFAULT NULL,
  `empty` char(1) DEFAULT NULL,
  `empty_text` text,
  `unitcost` double(15,3) DEFAULT NULL,
  `gfmiscode` varchar(14) DEFAULT NULL,
  `ipd_price` double(15,3) DEFAULT NULL,
  `oldcode` varchar(20) DEFAULT NULL,
  `habit_forming` char(1) DEFAULT NULL,
  `did` varchar(27) DEFAULT NULL,
  `stock_type` varchar(4) DEFAULT NULL,
  `price2` double(15,3) DEFAULT NULL,
  `price3` double(15,3) DEFAULT NULL,
  `ipd_price2` double(15,3) DEFAULT NULL,
  `ipd_price3` double(15,3) DEFAULT NULL,
  `price_lock` char(1) DEFAULT NULL,
  `pregnancy` varchar(10) DEFAULT NULL,
  `pharmacology_group1` int(11) DEFAULT NULL,
  `pharmacology_group2` int(11) DEFAULT NULL,
  `pharmacology_group3` int(11) DEFAULT NULL,
  `generic_name` varchar(250) DEFAULT NULL,
  `show_pregnancy_alert` char(1) DEFAULT NULL,
  `icode_guid` varchar(38) DEFAULT NULL,
  `na` char(1) DEFAULT NULL,
  `invcode` varchar(10) DEFAULT NULL,
  `check_user_group` char(1) DEFAULT NULL,
  `check_user_name` char(1) DEFAULT NULL,
  `show_notify` char(1) DEFAULT NULL,
  `show_notify_text` text,
  `income` char(2) DEFAULT NULL,
  `print_sticker_pq` char(1) DEFAULT NULL,
  `charge_service_opd` char(1) DEFAULT NULL,
  `charge_service_ipd` char(1) DEFAULT NULL,
  `ename` varchar(150) DEFAULT NULL,
  `dose_type` char(3) DEFAULT NULL,
  `habit_forming_type` int(11) DEFAULT NULL,
  `no_discount` char(1) DEFAULT NULL,
  `therapeutic_eng` varchar(200) DEFAULT NULL,
  `hintcode_eng` varchar(200) DEFAULT NULL,
  `limit_drugusage` char(1) DEFAULT NULL,
  `print_sticker_header` char(1) DEFAULT NULL,
  `calc_idr_qty` char(1) DEFAULT NULL,
  `item_in_hospital` char(1) DEFAULT NULL,
  `no_substock` char(1) DEFAULT NULL,
  `volume_cc` int(11) DEFAULT NULL,
  `usage_code` varchar(10) DEFAULT NULL,
  `frequency_code` varchar(10) DEFAULT NULL,
  `time_code` varchar(10) DEFAULT NULL,
  `dispense_dose` double(15,3) DEFAULT NULL,
  `usage_unit_code` varchar(10) DEFAULT NULL,
  `dose_per_units` double(15,3) DEFAULT NULL,
  `ipd_default_pay` int(11) DEFAULT NULL,
  `billcode` varchar(10) DEFAULT NULL,
  `billnumber` varchar(15) DEFAULT NULL,
  `lockprint_ipd` char(1) DEFAULT NULL,
  `pregnancy_notify_text` text,
  `show_breast_feeding_alert` char(1) DEFAULT NULL,
  `breast_feeding_alert_text` text,
  `show_child_notify` char(1) DEFAULT NULL,
  `child_notify_text` text,
  `child_notify_min_age` int(11) DEFAULT NULL,
  `child_notify_max_age` int(11) DEFAULT NULL,
  `continuous` char(1) DEFAULT NULL,
  `substitute_icode` char(7) DEFAULT NULL,
  `trade_name` varchar(200) DEFAULT NULL,
  `use_right_allow` char(1) DEFAULT NULL,
  `medication_machine_id` int(11) DEFAULT NULL,
  `ipd_medication_machine_id` int(11) DEFAULT NULL,
  `check_remed_qty` char(1) DEFAULT NULL,
  `addict` char(1) DEFAULT NULL,
  `addict_type_id` int(11) DEFAULT NULL,
  `medication_machine_opd_no` int(11) DEFAULT NULL,
  `medication_machine_ipd_no` int(11) DEFAULT NULL,
  `fp_drug` char(1) DEFAULT NULL,
  `usage_code_ipd` varchar(10) DEFAULT NULL,
  `dispense_dose_ipd` double(15,3) DEFAULT NULL,
  `usage_unit_code_ipd` varchar(10) DEFAULT NULL,
  `frequency_code_ipd` varchar(10) DEFAULT NULL,
  `time_code_ipd` varchar(10) DEFAULT NULL,
  `print_ipd_injection_sticker` char(1) DEFAULT NULL,
  `provis_medication_unit_code` varchar(10) DEFAULT NULL,
  `hos_guid` varchar(38) DEFAULT NULL,
  `sks_product_category_id` int(11) DEFAULT NULL,
  `sks_clain_control_type_id` int(11) DEFAULT NULL,
  `sks_drug_code` varchar(25) DEFAULT NULL,
  `sks_dfs_code` varchar(50) DEFAULT NULL,
  `sks_dfs_text` varchar(150) DEFAULT NULL,
  `sks_reimb_price` double(15,3) DEFAULT NULL,
  `hos_guid_ext` varchar(64) DEFAULT NULL,
  `check_druginteraction_history` char(1) DEFAULT NULL,
  `check_druginteraction_history_day` int(11) DEFAULT NULL,
  `nhso_adp_type_id` int(11) DEFAULT NULL,
  `nhso_adp_code` varchar(15) DEFAULT NULL,
  `sks_claim_control_type_id` int(11) DEFAULT NULL,
  `begin_date` date DEFAULT NULL,
  `finish_date` date DEFAULT NULL,
  `name_pr` varchar(100) DEFAULT NULL,
  `name_eng` varchar(100) DEFAULT NULL,
  `capacity_name` varchar(100) DEFAULT NULL,
  `finish_reason` varchar(100) DEFAULT NULL,
  `extra_unitcost` double(15,3) DEFAULT NULL,
  `drug_control_type_id` int(11) DEFAULT NULL,
  `name_print` varchar(100) DEFAULT NULL,
  `active_ingredient_mg` double(15,3) DEFAULT NULL,
  `no_order_g6pd` char(1) DEFAULT NULL,
  `gender_check` char(1) DEFAULT NULL,
  `no_order_gender` char(1) DEFAULT NULL,
  `max_qty` int(11) DEFAULT NULL,
  `prefer_opd_usage_code` char(1) DEFAULT NULL,
  `capacity_qty` double(15,3) DEFAULT NULL,
  `need_order_reason` char(1) DEFAULT NULL,
  `drugitems_due_type_id` int(11) DEFAULT NULL,
  `drugeval_head_id` int(11) DEFAULT NULL,
  `light_protect` char(1) DEFAULT NULL,
  `tpu_code_list` varchar(200) DEFAULT NULL,
  `sks_specprep` varchar(2) DEFAULT NULL,
  `inv_map_update` char(1) DEFAULT NULL,
  `special_advice_text` text,
  `precaution_advice_text` text,
  `contra_advice_text` text,
  `storage_advice_text` text,
  `qr_code_url` varchar(200) DEFAULT NULL,
  `vat_percent` double(15,3) DEFAULT NULL,
  `acc_regist` char(1) DEFAULT NULL,
  `use_paidst` char(1) DEFAULT NULL,
  `thai_name` varchar(200) DEFAULT NULL,
  `fwf_item_id` int(11) DEFAULT NULL,
  `drugitems_em1_id` int(11) DEFAULT NULL,
  `drugitems_em2_id` int(11) DEFAULT NULL,
  `drugitems_em3_id` int(11) DEFAULT NULL,
  `drugitems_em4_id` int(11) DEFAULT NULL,
  `tmt_tp_code` varchar(10) DEFAULT NULL,
  `tmt_gp_code` varchar(10) DEFAULT NULL,
  `limit_pttype` char(1) DEFAULT NULL,
  `noshow_narcotic` char(1) DEFAULT NULL,
  `medication_machine_flag` char(1) DEFAULT NULL,
  `sks_price` double(15,3) DEFAULT NULL,
  `print_sticker_by_frequency` char(1) DEFAULT NULL,
  `print_sticker_pq_ipd` char(1) DEFAULT NULL,
  `dmi` char(1) DEFAULT NULL,
  `sub_income` varchar(3) DEFAULT NULL,
  `prefer_ipd_usage_code` char(1) DEFAULT NULL,
  `default_qty_ipd` int(11) DEFAULT NULL,
  `max_qty_ipd` int(11) DEFAULT NULL,
  `drugusage_ipd` varchar(30) DEFAULT NULL,
  `no_popup_ipd_reason` char(1) DEFAULT NULL,
  `specprep` varchar(10) DEFAULT NULL,
  `med_dose_calc_type_id` int(11) DEFAULT NULL,
  `send_line_notify` char(1) DEFAULT NULL,
  `show_qrcode_trade` char(1) DEFAULT NULL,
  `warn_g6pd` char(1) DEFAULT NULL,
  `ipd_rx_freq_day` int(11) DEFAULT NULL,
  `displaycolor_focus` int(11) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  `no_remed` char(1) DEFAULT NULL,
  `force_round_qty` char(1) DEFAULT NULL,
  `atc_code` varchar(10) DEFAULT NULL,
  `state_item_id` int(11) DEFAULT NULL,
  `multiply_charge_service` char(1) DEFAULT NULL,
  `csmbs_claim_cat` char(1) DEFAULT NULL,
  `simb_2005` varchar(10) DEFAULT NULL,
  `sks_rev_date` date DEFAULT NULL,
  PRIMARY KEY (`icode`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_drugitems
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_epi_check
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_f43_service
-- ----------------------------
DROP TABLE IF EXISTS `wsc_f43_service`;
CREATE TABLE `wsc_f43_service` (
  `HOSPCODE` varchar(5) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `HN` varchar(15) DEFAULT NULL,
  `SEQ` varchar(16) NOT NULL,
  `DATE_SERV` date NOT NULL,
  `TIME_SERV` varchar(6) DEFAULT NULL,
  `LOCATION` varchar(1) DEFAULT NULL,
  `INTIME` varchar(1) DEFAULT NULL,
  `INSTYPE` varchar(4) NOT NULL,
  `INSID` varchar(18) DEFAULT NULL,
  `MAIN` varchar(5) DEFAULT NULL,
  `TYPEIN` varchar(1) NOT NULL,
  `REFERINHOSP` varchar(5) DEFAULT NULL,
  `CAUSEIN` varchar(1) DEFAULT NULL,
  `CHIEFCOMP` text,
  `SERVPLACE` varchar(1) NOT NULL,
  `BTEMP` double(4,1) DEFAULT NULL,
  `SBP` int(3) DEFAULT NULL,
  `DBP` int(3) DEFAULT NULL,
  `PR` int(3) DEFAULT NULL,
  `RR` int(3) DEFAULT NULL,
  `TYPEOUT` varchar(1) NOT NULL,
  `REFEROUTHOSP` varchar(5) DEFAULT NULL,
  `CAUSEOUT` varchar(1) DEFAULT NULL,
  `COST` decimal(11,2) DEFAULT NULL,
  `PRICE` decimal(11,2) NOT NULL,
  `PAYPRICE` double(11,0) NOT NULL,
  `ACTUALPAY` decimal(11,2) NOT NULL,
  `D_UPDATE` datetime NOT NULL,
  PRIMARY KEY (`HOSPCODE`,`PID`,`SEQ`),
  KEY `date_serv_idx` (`DATE_SERV`) USING BTREE,
  KEY `ref_idx` (`REFEROUTHOSP`) USING BTREE,
  KEY `hcod_idx` (`HOSPCODE`) USING BTREE,
  KEY `idx1` (`HOSPCODE`,`PID`) USING BTREE,
  KEY `idx2` (`DATE_SERV`) USING BTREE,
  KEY `idx3` (`INSTYPE`) USING BTREE,
  KEY `idx4` (`REFEROUTHOSP`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wsc_f43_service
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_oapp_send
-- ----------------------------
DROP TABLE IF EXISTS `wsc_oapp_send`;
CREATE TABLE `wsc_oapp_send` (
  `oaid` varchar(15) NOT NULL,
  `hospcode` varchar(5) DEFAULT NULL,
  `date_app` date DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`oaid`),
  KEY `key_oaid` (`oaid`) USING BTREE,
  KEY `key_date` (`date_app`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_oapp_send
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_opitemrece_pcu_check
-- ----------------------------
DROP TABLE IF EXISTS `wsc_opitemrece_pcu_check`;
CREATE TABLE `wsc_opitemrece_pcu_check` (
  `mkey` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`mkey`),
  KEY `idx` (`mkey`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_opitemrece_pcu_check
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_pcu_oapp
-- ----------------------------
DROP TABLE IF EXISTS `wsc_pcu_oapp`;
CREATE TABLE `wsc_pcu_oapp` (
  `oaid` varchar(20) NOT NULL,
  `hospcode` varchar(5) DEFAULT NULL,
  `date_app` date DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `remark` text,
  `send_state` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`oaid`),
  KEY `idx_0` (`oaid`),
  KEY `idx_1` (`date_app`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_pcu_oapp
-- ----------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_person_encrypt
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_pps_to_pcu
-- ----------------------------
DROP TABLE IF EXISTS `wsc_pps_to_pcu`;
CREATE TABLE `wsc_pps_to_pcu` (
  `cid` varchar(40) NOT NULL,
  `pp_special_code` varchar(7) NOT NULL,
  `vstdate2` date NOT NULL,
  PRIMARY KEY (`cid`,`pp_special_code`,`vstdate2`),
  KEY `idx` (`cid`,`pp_special_code`,`vstdate2`),
  KEY `idx0` (`cid`),
  KEY `idx1` (`pp_special_code`),
  KEY `idx2` (`vstdate2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wsc_pps_to_pcu
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_special_type
-- ----------------------------
DROP TABLE IF EXISTS `wsc_special_type`;
CREATE TABLE `wsc_special_type` (
  `pp_special_type_name` varchar(200) DEFAULT NULL,
  `pp_special_code` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_special_type
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_test
-- ----------------------------
DROP TABLE IF EXISTS `wsc_test`;
CREATE TABLE `wsc_test` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_test
-- ----------------------------

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
-- Records of wsc_t_work_pcu
-- ----------------------------

-- ----------------------------
-- Table structure for wsc_user
-- ----------------------------
DROP TABLE IF EXISTS `wsc_user`;
CREATE TABLE `wsc_user` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of wsc_user
-- ----------------------------

-- ----------------------------
-- Procedure structure for mpcu_drugitems_importpcu
-- ----------------------------
DROP PROCEDURE IF EXISTS `mpcu_drugitems_importpcu`;
DELIMITER ;;
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `mpcu_drugitems_importpcu`()
BEGIN

	INSERT INTO drugitems(icode,name,strength,units,unitprice,dosageform,drugaccount,drugcategory,drugnote,hintcode,istatus,lastupdatestdprice,lockprice,lockprint
,maxlevel,minlevel,maxunitperdose,packqty,reorderqty,therapeutic,therapeuticgroup,use_right,drugusage,high_cost
,must_paid,alert_level,access_level,sticker_short_name,paidst,antibiotic,displaycolor,empty,unitcost,ipd_price,habit_forming,did
,price2,price3,ipd_price2,ipd_price3,price_lock,pregnancy,pharmacology_group1,pharmacology_group2,pharmacology_group3,generic_name,show_pregnancy_alert
,icode_guid,na,invcode,check_user_group,check_user_name,show_notify,show_notify_text,income,print_sticker_pq,charge_service_opd,charge_service_ipd,ename,dose_type
,habit_forming_type,no_discount,therapeutic_eng,hintcode_eng,limit_drugusage,print_sticker_header,calc_idr_qty,item_in_hospital,no_substock,volume_cc,usage_code
,frequency_code,time_code,dispense_dose,usage_unit_code,dose_per_units,ipd_default_pay,billcode,billnumber,lockprint_ipd,pregnancy_notify_text,show_breast_feeding_alert
,breast_feeding_alert_text,show_child_notify,child_notify_text,child_notify_min_age,child_notify_max_age,continuous,substitute_icode,trade_name,use_right_allow
,medication_machine_id,ipd_medication_machine_id,check_remed_qty,addict,addict_type_id,medication_machine_opd_no,medication_machine_ipd_no,fp_drug,usage_code_ipd,
dispense_dose_ipd,usage_unit_code_ipd,frequency_code_ipd,time_code_ipd,print_ipd_injection_sticker,provis_medication_unit_code,hos_guid,sks_product_category_id,
sks_clain_control_type_id,sks_drug_code,sks_dfs_code,sks_dfs_text,sks_reimb_price,hos_guid_ext,check_druginteraction_history,check_druginteraction_history_day,
nhso_adp_type_id,nhso_adp_code,sks_claim_control_type_id,begin_date,finish_date,name_pr,name_eng,capacity_name,finish_reason,extra_unitcost,drug_control_type_id,
name_print,active_ingredient_mg,no_order_g6pd,gender_check,no_order_gender,max_qty,prefer_opd_usage_code,capacity_qty,need_order_reason,drugitems_due_type_id,
drugeval_head_id,light_protect,tpu_code_list,inv_map_update,special_advice_text,precaution_advice_text,contra_advice_text,storage_advice_text,qr_code_url,vat_percent,
acc_regist,use_paidst,thai_name,fwf_item_id,drugitems_em1_id,drugitems_em2_id,drugitems_em3_id,drugitems_em4_id,tmt_tp_code,tmt_gp_code,limit_pttype,noshow_narcotic,
medication_machine_flag,sks_price,print_sticker_by_frequency,print_sticker_pq_ipd,sub_income,prefer_ipd_usage_code,default_qty_ipd,max_qty_ipd,drugusage_ipd,
no_popup_ipd_reason,specprep,med_dose_calc_type_id,send_line_notify,show_qrcode_trade,warn_g6pd,ipd_rx_freq_day)

select icode,name,strength,units,unitprice,dosageform,drugaccount,drugcategory,drugnote,hintcode,istatus,lastupdatestdprice,lockprice,lockprint
,maxlevel,minlevel,maxunitperdose,packqty,reorderqty,therapeutic,therapeuticgroup,use_right,drugusage,high_cost
,must_paid,alert_level,access_level,sticker_short_name,paidst,antibiotic,displaycolor,empty,unitcost,ipd_price,habit_forming,did
,price2,price3,ipd_price2,ipd_price3,price_lock,pregnancy,pharmacology_group1,pharmacology_group2,pharmacology_group3,generic_name,show_pregnancy_alert
,icode_guid,na,invcode,check_user_group,check_user_name,show_notify,show_notify_text,income,print_sticker_pq,charge_service_opd,charge_service_ipd,ename,dose_type
,habit_forming_type,no_discount,therapeutic_eng,hintcode_eng,limit_drugusage,print_sticker_header,calc_idr_qty,item_in_hospital,no_substock,volume_cc,usage_code
,frequency_code,time_code,dispense_dose,usage_unit_code,dose_per_units,ipd_default_pay,billcode,billnumber,lockprint_ipd,pregnancy_notify_text,show_breast_feeding_alert
,breast_feeding_alert_text,show_child_notify,child_notify_text,child_notify_min_age,child_notify_max_age,continuous,substitute_icode,trade_name,use_right_allow
,medication_machine_id,ipd_medication_machine_id,check_remed_qty,addict,addict_type_id,medication_machine_opd_no,medication_machine_ipd_no,fp_drug,usage_code_ipd,
dispense_dose_ipd,usage_unit_code_ipd,frequency_code_ipd,time_code_ipd,print_ipd_injection_sticker,provis_medication_unit_code,hos_guid,sks_product_category_id,
sks_clain_control_type_id,sks_drug_code,sks_dfs_code,sks_dfs_text,sks_reimb_price,hos_guid_ext,check_druginteraction_history,check_druginteraction_history_day,
nhso_adp_type_id,nhso_adp_code,sks_claim_control_type_id,begin_date,finish_date,name_pr,name_eng,capacity_name,finish_reason,extra_unitcost,drug_control_type_id,
name_print,active_ingredient_mg,no_order_g6pd,gender_check,no_order_gender,max_qty,prefer_opd_usage_code,capacity_qty,need_order_reason,drugitems_due_type_id,
drugeval_head_id,light_protect,tpu_code_list,inv_map_update,special_advice_text,precaution_advice_text,contra_advice_text,storage_advice_text,qr_code_url,vat_percent,
acc_regist,use_paidst,thai_name,fwf_item_id,drugitems_em1_id,drugitems_em2_id,drugitems_em3_id,drugitems_em4_id,tmt_tp_code,tmt_gp_code,limit_pttype,noshow_narcotic,
medication_machine_flag,sks_price,print_sticker_by_frequency,print_sticker_pq_ipd,sub_income,prefer_ipd_usage_code,default_qty_ipd,max_qty_ipd,drugusage_ipd,
no_popup_ipd_reason,specprep,med_dose_calc_type_id,send_line_notify,show_qrcode_trade,warn_g6pd,ipd_rx_freq_day
 
FROM drugitems_10918 WHERE check_status = '1' 
AND icode not in(select icode FROM drugitems);


update drugitems d 
,drugitems_10918 dm
SET d.unitcost = dm.unitcost ,d.unitprice = dm.unitprice, d.tpu_code_list = dm.tpu_code_list
WHERE d.icode = dm.icode AND d.`name` = dm.`name`;

update s_drugitems sd,drugitems d
set sd.istatus = d.istatus
WHERE sd.icode = d.icode ;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for mpcu_epi_send
-- ----------------------------
DROP PROCEDURE IF EXISTS `mpcu_epi_send`;
DELIMITER ;;
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `mpcu_epi_send`()
BEGIN
	
REPLACE INTO wsc_epi_check(PID,epikey,check_edit)

SELECT * FROM
(select t.PID,t.epikey,t.apicheck FROM
(select t.HOSPCODE,t.PID,(select seq_id FROM ovst_seq where vn = t.vn) as SEQ,t.vaccine_date as DATE_SERV,t.export_vaccine_code as VACCINETYPE 
,t.HOSPCODE as VACCINEPLACE,t.PROVIDER,concat(t.vaccine_date,' ',t.vaccine_time) as D_UPDATE
,MD5(concat('wsc',PID,export_vaccine_code,D_UPDATE)) as apicheck
,MD5(concat('wsc',PID,export_vaccine_code,t.vaccine_date)) as epikey
FROM 
(select (select hospitalcode from opdconfig) as HOSPCODE
,LPAD(pe.person_id, 6, '0') as PID
,we.vaccine_date,we.vaccine_time 
,t.export_vaccine_code,t.doctor_code as PROVIDER
,vn
,concat(we.vaccine_date,' ',we.vaccine_time) as D_UPDATE
from person_epi_vaccine we
LEFT JOIN person_epi pe on pe.person_epi_id = we.person_epi_id
INNER JOIN
(select pev.person_epi_vaccine_id,ev.export_vaccine_code,pev.doctor_code from person_epi_vaccine_list pev
LEFT JOIN epi_vaccine ev on ev.epi_vaccine_id = pev.epi_vaccine_id
WHERE ev.export_vaccine_code is not NULL)t on t.person_epi_vaccine_id = we.person_epi_vaccine_id)t WHERE t.PID is not null)t
WHERE t.epikey not in(select epikey FROM wsc_epi_check) 

UNION

select t.PID,t.epikey,t.apicheck FROM
(select t.HOSPCODE,t.PID,(select seq_id FROM ovst_seq where vn = t.vn) as SEQ,t.service_date as DATE_SERV,t.export_vaccine_code as VACCINETYPE 
,t.HOSPCODE as VACCINEPLACE,t.PROVIDER,concat(t.service_date,' ',t.service_time) as D_UPDATE
,MD5(concat('wsc',PID,export_vaccine_code,concat(t.service_date,' ',t.service_time))) as apicheck
,MD5(concat('wsc',PID,export_vaccine_code,t.service_date)) as epikey
FROM 
(select (select hospitalcode from opdconfig) as HOSPCODE
,LPAD(pw.person_id, 6, '0') as PID
,pws.service_date,pws.service_time,vn,t.export_vaccine_code,t.doctor_code as PROVIDER from person_wbc_service pws
LEFT JOIN person_wbc pw on pw.person_wbc_id = pws.person_wbc_id
INNER JOIN
(select w.person_wbc_service_id,wv.export_vaccine_code,w.doctor_code from person_wbc_vaccine_detail w
LEFT JOIN wbc_vaccine wv on wv.wbc_vaccine_id = w.wbc_vaccine_id
WHERE wv.export_vaccine_code is not NULL)t on t.person_wbc_service_id = pws.person_wbc_service_id)t WHERE t.PID is not null)t
WHERE t.epikey not in(select epikey FROM wsc_epi_check))
t GROUP BY t.epikey
;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for mpcu_opd_allergy_importpcu
-- ----------------------------
DROP PROCEDURE IF EXISTS `mpcu_opd_allergy_importpcu`;
DELIMITER ;;
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `mpcu_opd_allergy_importpcu`()
BEGIN
	
REPLACE INTO opd_allergy(hn,report_date,agent,symptom,reporter,note
,allergy_group_id,seriousness_id,allergy_result_id,allergy_relation_id,entry_datetime,update_datetime,force_no_order
,opd_allergy_alert_type_id,patient_cid,opd_allergy_report_type_id,opd_allergy_source_id)

select pt.hn,a.report_date,a.agent,concat(a.symptom,' ',a.note) as symptom ,a.reporter,a.note
,if(a.allergy_group_id = '0',null,a.allergy_group_id) as allergy_group_id
,if(a.seriousness_id = '0',null,a.seriousness_id) as seriousness_id
,if(a.allergy_result_id = '0',null,a.allergy_result_id) as allergy_result_id
,if(a.allergy_relation_id = '0',null,a.allergy_relation_id) as allergy_relation_id
,a.entry_datetime,a.update_datetime,if(a.force_no_order = '',null,a.force_no_order) as force_no_order

,a.opd_allergy_alert_type_id,a.patient_cid,a.opd_allergy_report_type_id
,if(a.opd_allergy_source_id = '0',null,a.opd_allergy_source_id) as opd_allergy_source_id
from opd_allergy_10918 a
INNER JOIN patient pt on pt.cid = a.patient_cid;

INSERT INTO drugstdgeneric(genericname)
select agent FROM opd_allergy
WHERE agent NOT IN
(select genericname from drugstdgeneric)
GROUP BY agent;

update patient pt
INNER JOIN
(select hn,GROUP_CONCAT("'",agent,"'") as drugallergy
from opd_allergy o
GROUP BY o.hn)t on t.hn = pt.hn
SET pt.drugallergy = t.drugallergy ;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for mpcu_person_send
-- ----------------------------
DROP PROCEDURE IF EXISTS `mpcu_person_send`;
DELIMITER ;;
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `mpcu_person_send`()
BEGIN
	
INSERT IGNORE INTO wsc_person_encrypt(PID,check_update,wsc_update)
select person_id,'111',last_update FROM person p
WHERE person_id not in(select PID FROM wsc_person_encrypt);


END
;;
DELIMITER ;
