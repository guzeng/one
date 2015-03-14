CREATE TABLE `one_order_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作用户ID',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `info` char(200) NOT NULL DEFAULT '' COMMENT '详细',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;