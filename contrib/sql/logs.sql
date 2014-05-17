

CREATE TABLE `one_logs` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增主键ID',
  `user_id` int(11) NOT NULL default '0' COMMENT '用户ID',
  `username` varchar(30) NOT NULL default '' COMMENT '用户名',
  `time` int(10) NOT NULL default '0' COMMENT '操作时间',
  `type` varchar(20) NOT NULL default '' COMMENT '类型',
  `object_type` varchar(30) NOT NULL default '' COMMENT '操作对象',
  `object_id` int(11) NOT NULL default '0' COMMENT '对象ID',
  `object_name` varchar(100) NOT NULL default '' COMMENT '对象名称',
  `message` text NOT NULL COMMENT '操作内容',
  `ip` varchar(15) NOT NULL COMMENT '操作者IP',
  PRIMARY KEY  (`id`),
  KEY `type_id` (`type`,`object_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日志表';


