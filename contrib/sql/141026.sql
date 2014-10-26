

DROP TABLE IF EXISTS `one_user_openid`;
CREATE TABLE `one_user_openid` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT 'uesr ID',
  `name` varchar(15) NOT NULL default '' COMMENT 'openid名称',
  `token` varchar(40) NOT NULL default '' COMMENT 'token',
  `openid` varchar(40) NOT NULL default '' COMMENT 'openid',
  `create_time` int(10) NOT NULL default '0' COMMENT '时间',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `openid` (`openid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='user openid';

