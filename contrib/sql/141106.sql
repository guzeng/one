CREATE TABLE `one_coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '编号',
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '类别:1,购物赠，2:商家赠',
  `value` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '面值',
  `use` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '使用条件，所需消费金额',
  `expirse_from` int(10) NOT NULL DEFAULT '0' COMMENT '有效期开始时间',
  `expirse_to` int(10) NOT NULL DEFAULT '0' COMMENT '有效期结束时间',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;