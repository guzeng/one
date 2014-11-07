ALTER TABLE one_order 
ADD COLUMN pay TINYINT(1) NOT NULL DEFAULT 0 COMMENT '是否付款,1:已付',
ADD COLUMN pay_type INT(11) NOT NULL DEFAULT 0 COMMENT '付款方式',
ADD COLUMN `pay_time` int(10) NOT NULL DEFAULT '0' COMMENT '付款时间',
ADD COLUMN `pay_code` varchar(50) NOT NULL DEFAULT '' COMMENT '支付单号',
ADD COLUMN `complete` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否完成',
ADD COLUMN `finish_time` int(10) NOT NULL DEFAULT '0' COMMENT '完成时间',
ADD COLUMN `bank_no` varchar(100) NOT NULL DEFAULT '' COMMENT '银行流水',
ADD COLUMN `bank` varchar(15) NOT NULL DEFAULT '' COMMENT '银行',
ADD COLUMN `buyer_email` varchar(100) NOT NULL DEFAULT '' COMMENT '付款支付宝账号',
ADD COLUMN `notify_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '支付宝通知付款时间';

CREATE TABLE `one_pay_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `order_code` varchar(40) NOT NULL DEFAULT '' COMMENT '订单号',
  `from` varchar(10) NOT NULL DEFAULT '' COMMENT '来源，付款方式',
  `trade_no` varchar(50) NOT NULL DEFAULT '' COMMENT '交易号',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1,成功;2,失败',
  `info` char(200) DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付日志'