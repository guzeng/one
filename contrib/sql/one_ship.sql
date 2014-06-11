
DROP TABLE IF EXISTS `one_ship`;
CREATE TABLE `one_ship` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '名称',
  `info` text NOT NULL COMMENT '描述',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='配送方式';
