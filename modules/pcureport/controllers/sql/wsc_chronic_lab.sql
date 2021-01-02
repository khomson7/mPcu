
CREATE TABLE IF NOT EXISTS `wsc_chronic_lab` (
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

