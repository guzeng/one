DROP TABLE IF EXISTS `one_user_comment`;
CREATE TABLE `one_user_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人ID',
  `content` text NOT NULL COMMENT '留言内容',
  `reversion` text COMMENT '回复内容',
  `create_time` varchar(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='会员留言';