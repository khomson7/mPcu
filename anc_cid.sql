

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
