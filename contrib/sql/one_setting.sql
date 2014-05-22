CREATE TABLE `one_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable` varchar(50) NOT NULL DEFAULT '' COMMENT '变量名',
  `value` text COMMENT '变量值',
  `comment` varchar(150) NOT NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='系统设置';