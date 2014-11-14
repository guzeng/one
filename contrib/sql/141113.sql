ALTER TABLE one_member ENGINE = INNODB;
CREATE TABLE `one_user_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `sub` varchar(200) NOT NULL DEFAULT '' COMMENT '订阅内容，以'',''分隔',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8