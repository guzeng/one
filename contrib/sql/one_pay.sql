
DROP TABLE IF EXISTS `one_pay`;
CREATE TABLE `one_pay` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '名称',
  `type` varchar(30) NOT NULL default '0' COMMENT '支付方式',
  `apikey` varchar(200) NOT NULL default '' COMMENT 'apikey',
  `secret` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付方式';

INSERT INTO `one_pay` VALUES (1,'货到付款','daofu','','');
INSERT INTO `one_pay` VALUES (2,'支付宝','alipay','','');
INSERT INTO `one_pay` VALUES (3,'网银转账','banking','','');
INSERT INTO `one_pay` VALUES (4,'微支付','tenpay','','');
