
#
# Source for table one_news
#

DROP TABLE IF EXISTS `one_news_category`;
CREATE TABLE `one_news_category`(
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '类型名字',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章类别表';
