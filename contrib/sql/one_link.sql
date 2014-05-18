CREATE TABLE `one_link` (
  `id` int(11) NOT NULL auto_increment,
  `type` tinyint(3) NOT NULL default '1' COMMENT '类型;1,图片;2,文字',
  `title` varchar(50) NOT NULL default '' COMMENT 'title',
  `url` varchar(200) NOT NULL default '' COMMENT 'URL',
  `img` varchar(100) NOT NULL default '' COMMENT '图片地址',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接';

