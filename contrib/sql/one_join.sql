DROP TABLE IF EXISTS `one_join`;
CREATE TABLE `one_join` (
  `id` int(11) NOT NULL auto_increment,
  `type` tinyint(3) NOT NULL default '0' COMMENT '类型：1,供应商；2，人才',
  `company` varchar(200) NOT NULL default '' COMMENT '供应商公司名称',
  `name` varchar(50) NOT NULL default '' COMMENT '姓名',
  `phone` varchar(100) NOT NULL default '' COMMENT '电话',
  `email` varchar(100) NOT NULL default '' COMMENT '邮箱',
  `create_time` int(10) NOT NULL default '0' COMMENT '填写时间',
  `status` tinyint(3) NOT NULL default '0' COMMENT '状态：0，未处理；1，已处理',
  `note` text COMMENT '备注',
  `handle` varchar(50) NOT NULL default '' COMMENT '处理人',
  `handle_time` int(10) NOT NULL default '0' COMMENT '处理时间',
  `remark` text COMMENT '评价',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='加明';
