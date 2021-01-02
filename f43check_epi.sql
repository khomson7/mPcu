
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for f43check_epi
-- ----------------------------
DROP TABLE IF EXISTS `f43check_epi`;
CREATE TABLE `f43check_epi` (
  `SEQ` varchar(16) DEFAULT NULL,
  `DATE_SERV` date NOT NULL,
  `VACCINETYPE` varchar(3) NOT NULL,
  `apicheck` varchar(35) CHARACTER SET utf8 DEFAULT '',
  PRIMARY KEY (`DATE_SERV`,`VACCINETYPE`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;
