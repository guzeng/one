ALTER TABLE one_coupon DROP user_id;
ALTER TABLE one_coupon DROP order_code;
ALTER TABLE one_coupon DROP is_use;
ALTER TABLE one_coupon DROP use_time;

CREATE TABLE `one_user_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `coupon_id` int(11) NOT NULL DEFAULT '0' COMMENT '优惠券id',
  `order_code` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `is_use` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否使用，1，使用',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `use_time` int(10) NOT NULL DEFAULT '0' COMMENT '使用时间',
  PRIMARY KEY (`id`),
  KEY `coupon` (`coupon_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;