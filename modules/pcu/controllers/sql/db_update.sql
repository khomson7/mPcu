

CREATE TABLE IF NOT EXISTS `wsc_check_token` (
  `id` int(11) NOT NULL,
  `token_` varchar(255) DEFAULT NULL,
  `date_creat` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idkey` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;


CREATE TABLE IF NOT EXISTS `wsc_cid_encrypt` (
  `cid_encrypt` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`cid_encrypt`),
  KEY `idx` (`cid_encrypt`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;



CREATE TABLE IF NOT EXISTS `wsc_clinicmember_cid` (
  `cid` varchar(13) NOT NULL,
  `clinic` varchar(5) NOT NULL,
  PRIMARY KEY (`cid`,`clinic`),
  KEY `key` (`cid`,`clinic`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=tis620;



CREATE TABLE IF NOT EXISTS `wsc_death_check` (
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


CREATE TABLE IF NOT EXISTS `wsc_epi_check` (
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


CREATE TABLE IF NOT EXISTS `wsc_oapp_send` (
  `oaid` varchar(15) NOT NULL,
  `hospcode` varchar(5) DEFAULT NULL,
  `date_app` date DEFAULT NULL,
  `result` int(11) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`oaid`),
  KEY `key_oaid` (`oaid`) USING BTREE,
  KEY `key_date` (`date_app`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;


DROP TABLE IF EXISTS `wsc_opitemrece_pcu_check`;
CREATE TABLE IF NOT EXISTS `wsc_opitemrece_pcu_check` (
  `mkey` varchar(50) CHARACTER SET utf8 NOT NULL,
  `check_edit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`mkey`),
  KEY `idx` (`mkey`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;


CREATE TABLE IF NOT EXISTS `wsc_pcu_oapp` (
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


CREATE TABLE IF NOT EXISTS `wsc_person_encrypt` (
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


CREATE TABLE IF NOT EXISTS `wsc_t_work_pcu` (
  `date_work` date NOT NULL,
  `d_update` datetime DEFAULT NULL,
  PRIMARY KEY (`date_work`),
  KEY `idx` (`date_work`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;


CREATE TABLE IF NOT EXISTS `wsc_user` (
  `id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=tis620;
