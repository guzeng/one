DROP TABLE IF EXISTS `one_user_address`;
CREATE TABLE `one_user_address` (
  `id` INT(11) NOT NULL DEFAULT '0' COMMENT 'ID',
  `user_id` INT(11) NOT NULL DEFAULT '0' COMMENT '用户Id',
  `province_id` INT(11) NOT NULL DEFAULT '0' COMMENT '省的区域编号',
  `city_id` INT(11) NOT NULL DEFAULT '0' COMMENT '市的区域编号',
  `qu_id` INT(11) NOT NULL DEFAULT '0' COMMENT '区的区域编号',
  `consignee` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '收货人',
  `gender` INT(11) NOT NULL DEFAULT '0' COMMENT '性别',
  `telephone` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '固定电话',
  `phone` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '手机',
  `address` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `status` INT(1) NOT NULL DEFAULT '1' COMMENT '状态（1可用/0不可用）',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;

