
DROP TABLE IF EXISTS `one_pay`;
CREATE TABLE `one_pay` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(30) NOT NULL default '' COMMENT '支付方式名称',
  `apikey` varchar(200) NOT NULL default '' COMMENT 'apikey',
  `secret` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付方式';
