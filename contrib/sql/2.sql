alter table one_order add column username varchar(30) not null default '' COMMENT '用户名' after user_id;
alter table one_order_detail add column order_id int(11) not null default 0 COMMENT '订单ID' after id;

CREATE TABLE `one_product_brand` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '品牌名称',
  `product_cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联商品分类ID',
  `info` varchar(100) NOT NULL default '' COMMENT '备注',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品品牌';

CREATE TABLE `one_product_comment` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT '用户ID',
  `product_id` int(11) NOT NULL default '0' COMMENT '商品ID',
  `create_time` int(10) NOT NULL default '0' COMMENT '时间',
  `rate` tinyint(3) NOT NULL default '0' COMMENT '评分',
  `comment` text,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品讨论表';