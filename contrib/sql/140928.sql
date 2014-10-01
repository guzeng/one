DROP TABLE IF EXISTS `one_user_browse_history`;
CREATE TABLE `one_user_browse_history` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `product_id` INT(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `create_time` INT(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`),
  KEY `user` (`user_id`),
  KEY `product` (`product_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8 COMMENT='用户浏览商品历史表';