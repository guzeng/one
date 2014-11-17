CREATE TABLE `one_user_mailsubs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL DEFAULT '0',
  `shoping_order` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `shoping_not_pay` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `shoping_pay_success` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `shoping_not_comment` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `account_coupon` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `account_not_pay` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `account_pay_success` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `account_not_comment` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '是否订阅：0没有,1有',
  `create_time` INT(3) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;