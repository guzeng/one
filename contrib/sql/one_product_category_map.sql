DROP TABLE IF EXISTS `one_product_category_map`;
CREATE TABLE `one_product_category_map` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0' COMMENT '商品ID',
  `category_id` int(11) NOT NULL default '0' COMMENT '分类ID',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品分类对应表';

