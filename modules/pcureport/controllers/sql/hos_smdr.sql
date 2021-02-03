CREATE TABLE IF NOT EXISTS `hos_smdr` (
  `vn` varchar(13) NOT NULL,
  `cid` varchar(40) DEFAULT NULL,
  `chwpart` char(2) DEFAULT NULL,
  `amppart` char(2) DEFAULT NULL,
  `tmbpart` char(2) DEFAULT NULL,
  `moopart` char(3) DEFAULT NULL,
  `vstdate` date DEFAULT NULL,
  `vsttime` time DEFAULT NULL,
  `drinking_type_id` int(11) DEFAULT NULL,
  `smoking_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`vn`),
  KEY `idx` (`vn`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;
