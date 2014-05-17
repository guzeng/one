

DROP TABLE IF EXISTS `one_member`;
CREATE TABLE `one_member` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '' COMMENT '会员名',
  `pwd` varchar(50) NOT NULL default '' COMMENT '密码',
  `name` varchar(30) NOT NULL default '' COMMENT '姓名',
  `grade` tinyint(3) NOT NULL default '0' COMMENT '等级',
  `score` int(11) NOT NULL default '0' COMMENT '积分',
  `reference` int(11) NOT NULL default '0' COMMENT '推荐人',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `last_login_time` int(10) NOT NULL default '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(15) NOT NULL default '' COMMENT '最后登录IP',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员表';

#
# Source for table one_news
#

DROP TABLE IF EXISTS `one_news`;
CREATE TABLE `one_news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL default '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `status` tinyint(3) NOT NULL default '0' COMMENT '状态',
  `show_time` int(10) NOT NULL default '0' COMMENT '发布时间',
  `cate_id` int(11) NOT NULL default '0' COMMENT '类别ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表';

#
# Source for table one_order
#

DROP TABLE IF EXISTS `one_order`;
CREATE TABLE `one_order` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT '用户ID，订单创建人',
  `code` varchar(20) NOT NULL default '' COMMENT '编号',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `price` float(10,2) NOT NULL default '0.00' COMMENT '价格',
  `phone` varchar(20) NOT NULL default '' COMMENT '电话',
  `address` varchar(255) NOT NULL default '' COMMENT '地址',
  `status` tinyint(3) NOT NULL default '0' COMMENT '状态',
  PRIMARY KEY  (`id`),
  KEY `user` (`user_id`),
  KEY `code` (`code`),
  KEY `time` (`create_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';

#
# Source for table one_order_detail
#

DROP TABLE IF EXISTS `one_order_detail`;
CREATE TABLE `one_order_detail` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0' COMMENT '商品ID',
  `price` float(10,2) NOT NULL default '0.00' COMMENT '价格',
  `number` int(11) NOT NULL default '0' COMMENT '数量',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单详情';

#
# Source for table one_product
#

DROP TABLE IF EXISTS `one_product`;
CREATE TABLE `one_product` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(20) NOT NULL default '' COMMENT '代码',
  `name` varchar(50) NOT NULL default '' COMMENT '名称',
  `cate_id` int(11) NOT NULL default '0' COMMENT '类别ID',
  `price` float(10,2) NOT NULL default '0.00' COMMENT '价格',
  `best_price` float(10,2) NOT NULL default '0.00' COMMENT '优惠价',
  `brand` varchar(30) NOT NULL default '' COMMENT '品牌',
  `type_id` int(11) NOT NULL default '0' COMMENT '类型',
  `create_by` int(11) NOT NULL default '0' COMMENT '添加人',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL default '0' COMMENT '最后修改时间',
  `amount` int(11) NOT NULL default '0' COMMENT '库存数量',
  `status` tinyint(3) NOT NULL default '0' COMMENT '状态：1，上架；0，下架；2，删除',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='产品表';

#
# Source for table one_product_category
#

DROP TABLE IF EXISTS `one_product_category`;
CREATE TABLE `one_product_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '名称',
  `parent_id` int(11) NOT NULL default '0' COMMENT '父类ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品分类';

#
# Source for table one_product_type
#

DROP TABLE IF EXISTS `one_product_type`;
CREATE TABLE `one_product_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '类型名称',
  `info` varchar(50) NOT NULL default '' COMMENT '说明',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品类型';

#
# Source for table one_storage
#

DROP TABLE IF EXISTS `one_storage`;
CREATE TABLE `one_storage` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '名称',
  `info` varchar(100) NOT NULL default '' COMMENT '说明',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='仓库';


