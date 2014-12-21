

DROP TABLE IF EXISTS `one_area`;
CREATE TABLE `one_area` (
  `area_id` int(11) NOT NULL default '0' COMMENT '区域编号',
  `area_name` varchar(20) NOT NULL default '0' COMMENT '区域名称',
  `parent_id` int(11) NOT NULL default '0' COMMENT '父级编号',
  `area_level` int(3) NOT NULL default '0' COMMENT '区域等级(1省/2市/3区县)',
  `status` int(1) NOT NULL default '1' COMMENT '状态（1可用/0不可用）',
  `storage_id` int(11) NOT NULL default '0' COMMENT '所属仓库',
  PRIMARY KEY  (`area_id`),
  UNIQUE KEY `UK_website_area` (`area_id`,`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Source for table one_join
#

DROP TABLE IF EXISTS `one_join`;
CREATE TABLE `one_join` (
  `id` int(11) NOT NULL auto_increment,
  `type` tinyint(3) NOT NULL default '0' COMMENT '类型：1,供应商；2，人才',
  `company` varchar(200) NOT NULL default '' COMMENT '供应商公司名称',
  `name` varchar(50) NOT NULL default '' COMMENT '姓名',
  `phone` varchar(100) NOT NULL default '' COMMENT '电话',
  `email` varchar(100) NOT NULL default '' COMMENT '邮箱',
  `create_time` int(10) NOT NULL default '0' COMMENT '填写时间',
  `status` tinyint(3) NOT NULL default '0' COMMENT '状态：0，未处理；1，已处理',
  `note` text COMMENT '备注',
  `handle` varchar(50) NOT NULL default '' COMMENT '处理人',
  `handle_time` int(10) NOT NULL default '0' COMMENT '处理时间',
  `remark` text COMMENT '评价',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='加明';

#
# Source for table one_link
#

DROP TABLE IF EXISTS `one_link`;
CREATE TABLE `one_link` (
  `id` int(11) NOT NULL auto_increment,
  `type` tinyint(3) NOT NULL default '1' COMMENT '类型;1,图片;2,文字',
  `title` varchar(50) NOT NULL default '' COMMENT 'title',
  `url` varchar(200) NOT NULL default '' COMMENT 'URL',
  `img` varchar(100) NOT NULL default '' COMMENT '图片地址',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='友情链接';

#
# Source for table one_logs
#

DROP TABLE IF EXISTS `one_logs`;
CREATE TABLE `one_logs` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增主键ID',
  `user_id` int(11) NOT NULL default '0' COMMENT '用户ID',
  `username` varchar(30) NOT NULL default '' COMMENT '用户名',
  `time` int(10) NOT NULL default '0' COMMENT '操作时间',
  `type` varchar(20) NOT NULL default '' COMMENT '类型',
  `object_type` varchar(30) NOT NULL default '' COMMENT '操作对象',
  `object_id` int(11) NOT NULL default '0' COMMENT '对象ID',
  `object_name` varchar(100) NOT NULL default '' COMMENT '对象名称',
  `message` text NOT NULL COMMENT '操作内容',
  `ip` varchar(15) NOT NULL COMMENT '操作者IP',
  PRIMARY KEY  (`id`),
  KEY `type_id` (`type`,`object_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='操作日志表';

#
# Source for table one_member
#

DROP TABLE IF EXISTS `one_member`;
CREATE TABLE `one_member` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(30) NOT NULL default '' COMMENT '会员名',
  `pwd` varchar(50) NOT NULL default '' COMMENT '密码',
  `name` varchar(30) NOT NULL default '' COMMENT '真实姓名',
  `alias` varchar(30) NOT NULL default '' COMMENT '昵称',
  `email` varchar(100) NOT NULL default '' COMMENT 'Email',
  `grade` tinyint(3) NOT NULL default '0' COMMENT '等级',
  `score` int(11) NOT NULL default '0' COMMENT '积分',
  `reference` int(11) NOT NULL default '0' COMMENT '推荐人',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `last_login_time` int(10) NOT NULL default '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(15) NOT NULL default '' COMMENT '最后登录IP',
  `is_admin` tinyint(3) NOT NULL default '0' COMMENT '是否管理员',
  `telephone` varchar(30) NOT NULL default '' COMMENT '固定电话',
  `phone` varchar(30) NOT NULL default '' COMMENT '手机',
  `post_code` varchar(10) NOT NULL default '' COMMENT '邮编',
  `area` int(11) NOT NULL default '0' COMMENT '地区',
  `qq` varchar(30) NOT NULL default '' COMMENT 'qq',
  `status` varchar(30) NOT NULL default '' COMMENT '启用',
  `gender` int(11) NOT NULL default '0' COMMENT '性别',
  `address` varchar(50) NOT NULL default '' COMMENT '详细地址',
  `money` decimal(2,0) NOT NULL default '0' COMMENT '预付款',
  `birthday` int(10) DEFAULT '0'  NOT NULL  COMMENT '生日',
  `id_card_number` VARCHAR(30) DEFAULT ''  NOT NULL  COMMENT '身份证号码',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员表';


INSERT INTO `one_member` VALUES (1,'admin','497245c9e08975567103ce3cc382e761758a1679','admin','',0,0,0,0,0,'',0,'','','',0,'','1',0,'',0);

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
  `type` tinyint(3) NOT NULL default '0' COMMENT '类型：1，文章；2，调查',
  `cate_id` int(11) NOT NULL default '0' COMMENT '类别ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章表';

#
# Source for table one_news_category
#

DROP TABLE IF EXISTS `one_news_category`;
CREATE TABLE `one_news_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '类型名字',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `parent_id` int(11) NOT NULL default '0' COMMENT '父ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章类别表';

#
# Source for table one_order
#

DROP TABLE IF EXISTS `one_order`;
CREATE TABLE `one_order` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT '用户ID，订单创建人',
  `username` varchar(30) NOT NULL default '' COMMENT '用户名',
  `code` varchar(20) NOT NULL default '' COMMENT '编号',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `price` float(10,2) NOT NULL default '0.00' COMMENT '价格',
  `phone` varchar(20) NOT NULL default '' COMMENT '电话',
  `address` varchar(255) NOT NULL default '' COMMENT '地址',
  `status` tinyint(3) NOT NULL default '0' COMMENT '状态,1,待付款,2,待发货,3,待收货,4,待评价,5,交易成功,6,退货,7,废弃订单',
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
  `order_id` int(11) NOT NULL default '0' COMMENT '订单ID',
  `product_id` int(11) NOT NULL default '0' COMMENT '商品ID',
  `price` float(10,2) NOT NULL default '0.00' COMMENT '价格',
  `number` int(11) NOT NULL default '0' COMMENT '数量',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
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
  `brand_id` int(11) NOT NULL default '0' COMMENT '品牌ID',
  `type_id` int(11) NOT NULL default '0' COMMENT '类型',
  `create_by` int(11) NOT NULL default '0' COMMENT '添加人',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL default '0' COMMENT '最后修改时间',
  `amount` int(11) NOT NULL default '0' COMMENT '库存数量',
  `status` tinyint(3) NOT NULL default '0' COMMENT '状态：1，上架；0，下架；2，删除',
  `unit` varchar(30) NOT NULL default '' COMMENT '计量单位',
  `weight` float(9,2) NOT NULL default '0.00' COMMENT '单位重量',
  `score` int(11) NOT NULL default '0' COMMENT '积分',
  `min_num` int(11) NOT NULL default '0' COMMENT '最低购买数',
  `recommend` tinyint(3) NOT NULL default '0' COMMENT '是否推荐，1:推荐',
  `specials` tinyint(3) NOT NULL default '0' COMMENT '是否特卖,1:是',
  `allow_comment` tinyint(3) NOT NULL default '0' COMMENT '是否允许评论,1:是',
  `show_home` tinyint(3) NOT NULL default '0' COMMENT '是否首页展示,0:不展示,1:展示',
  `handpick` tinyint(3) NOT NULL default '0' COMMENT '是否精选商品,0:不是,1:是',
  `info` text COMMENT '简介',
  `hot` tinyint(3) NOT NULL default '0' COMMENT '是否热卖,1:是',
  `promise` text COMMENT '服务承诺',
  `sale_num` int(11) NOT NULL default '0' COMMENT '销量',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='产品表';

#
# Source for table one_product_brand
#

DROP TABLE IF EXISTS `one_product_brand`;
CREATE TABLE `one_product_brand` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '品牌名称',
  `info` varchar(100) NOT NULL default '' COMMENT '备注',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='商品品牌';

#
# Source for table one_product_category
#

DROP TABLE IF EXISTS `one_product_category`;
CREATE TABLE `one_product_category` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '' COMMENT '名称',
  `parent_id` int(11) NOT NULL default '0' COMMENT '父类ID',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品分类';

#
# Source for table one_product_comment
#

DROP TABLE IF EXISTS `one_product_comment`;
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='商品讨论表';

#
# Source for table one_product_type
#

DROP TABLE IF EXISTS `one_product_type`;
CREATE TABLE `one_product_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '类型名称',
  `info` varchar(100) NOT NULL default '' COMMENT '说明',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商品类型';

#
# Source for table one_questionnaire
#

DROP TABLE IF EXISTS `one_questionnaire`;
CREATE TABLE `one_questionnaire` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增主键',
  `title` varchar(50) NOT NULL default '' COMMENT '问卷标题',
  `intro` varchar(255) NOT NULL default '' COMMENT '简介(开头语)',
  `conclusion` varchar(255) NOT NULL default '' COMMENT '结束语',
  `status` tinyint(1) NOT NULL default '0' COMMENT '状态,1:启用;0:关闭',
  `create_time` varchar(10) NOT NULL default '0' COMMENT '创建时间',
  `create_by` int(11) NOT NULL default '0' COMMENT '创建人ID',
  `record` int(11) NOT NULL default '0' COMMENT '答题总人数',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Source for table one_questionnaire_option
#

DROP TABLE IF EXISTS `one_questionnaire_option`;
CREATE TABLE `one_questionnaire_option` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增主键',
  `title` varchar(100) NOT NULL default '' COMMENT '选项标题',
  `record` int(11) NOT NULL default '0' COMMENT '选项记录',
  `questionnaire_question_id` int(11) NOT NULL default '0' COMMENT '调查问卷问题表ID',
  `questionnaire_id` int(11) NOT NULL default '0' COMMENT '调查问卷表ID',
  PRIMARY KEY  (`id`),
  KEY `questionnaire_question_id` (`questionnaire_question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

#
# Source for table one_questionnaire_question
#

DROP TABLE IF EXISTS `one_questionnaire_question`;
CREATE TABLE `one_questionnaire_question` (
  `id` int(11) NOT NULL auto_increment COMMENT '自增主键',
  `title` varchar(100) NOT NULL default '' COMMENT '问题标题',
  `type` tinyint(1) NOT NULL default '0' COMMENT '0:单选题;1:多选题',
  `record` int(11) NOT NULL default '0' COMMENT '答题人数',
  `questionnaire_id` int(11) NOT NULL default '0' COMMENT '调查问卷表ID',
  PRIMARY KEY  (`id`),
  KEY `questionnaire_id` (`questionnaire_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Source for table one_setting
#

DROP TABLE IF EXISTS `one_setting`;
CREATE TABLE `one_setting` (
  `id` int(11) NOT NULL auto_increment,
  `variable` varchar(100) NOT NULL default '' COMMENT '名称',
  `value` varchar(150) NOT NULL default '' COMMENT '值',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `variable` (`variable`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='设置表';

#
# Source for table one_storage
#

DROP TABLE IF EXISTS `one_storage`;
CREATE TABLE `one_storage` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '名称',
  `info` varchar(100) NOT NULL default '' COMMENT '说明',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='仓库';

#
# Source for table one_user_comment
#

DROP TABLE IF EXISTS `one_user_comment`;
CREATE TABLE `one_user_comment` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT '创建人ID',
  `content` text NOT NULL COMMENT '留言内容',
  `reversion` text COMMENT '回复内容',
  `create_time` varchar(10) NOT NULL default '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员留言';

DROP TABLE IF EXISTS `one_product_category_map`;
CREATE TABLE `one_product_category_map` (
  `id` int(11) NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0' COMMENT '商品ID',
  `category_id` int(11) NOT NULL default '0' COMMENT '分类ID',
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='商品分类对应表';


DROP TABLE IF EXISTS `one_pay`;
CREATE TABLE `one_pay` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '名称',
  `type` varchar(30) NOT NULL default '0' COMMENT '支付方式',
  `apikey` varchar(200) NOT NULL default '' COMMENT 'apikey',
  `secret` text,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='支付方式';

INSERT INTO `one_pay` VALUES (1,'货到付款','daofu','','');
INSERT INTO `one_pay` VALUES (2,'支付宝','alipay','','');
INSERT INTO `one_pay` VALUES (3,'网银转账','banking','','');
INSERT INTO `one_pay` VALUES (4,'微支付','tenpay','','');


DROP TABLE IF EXISTS `one_ship`;
CREATE TABLE `one_ship` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '' COMMENT '名称',
  `billing` varchar(100) NOT NULL default '' COMMENT '计费方法',
  `info` text NOT NULL COMMENT '描述',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='配送方式';

DROP TABLE IF EXISTS `one_user_address`;
CREATE TABLE `one_user_address` (
  `id` INT(11) NOT NULL auto_increment,
  `user_id` INT(11) NOT NULL DEFAULT '0' COMMENT '用户Id',
  `province_id` INT(11) NOT NULL DEFAULT '0' COMMENT '省的区域编号',
  `city_id` INT(11) NOT NULL DEFAULT '0' COMMENT '市的区域编号',
  `area` INT(11) NOT NULL DEFAULT '0' COMMENT '区的区域编号',
  `consignee` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '收货人',
  `gender` INT(11) NOT NULL DEFAULT '0' COMMENT '性别',
  `telephone` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '固定电话',
  `phone` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '手机',
  `address` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `status` INT(1) NOT NULL DEFAULT '1' COMMENT '状态（1可用/0不可用）',
  `default` INT(1) NOT NULL DEFAULT '0' COMMENT '默认地址（1默认/0不默认）',
  PRIMARY KEY  (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `one_user_browse_history`;
CREATE TABLE `one_user_browse_history` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0' COMMENT '用户ID',
  `product_id` int(11) NOT NULL default '0' COMMENT '商品ID',
  `create_time` int(10) NOT NULL default '0' COMMENT '创建时间',
  PRIMARY KEY  (`id`),
  KEY `user` (`user_id`),
  KEY `product` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户浏览商品历史表';

DROP TABLE IF EXISTS `one_ad`;
CREATE TABLE `one_ad` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `position_id` TINYINT(3) NOT NULL DEFAULT '0' COMMENT '广告位置：0,首页滚动图,1,',
  `title` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '名称',
  `url` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '链接',
  `create_time` INT(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `start_time` INT(11) NOT NULL DEFAULT '0' COMMENT '开始时间',
  `end_time` INT(11) NOT NULL DEFAULT '0' COMMENT '结束时间',
  `link_man` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '联系人',
  `link_email` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '联系人邮箱',
  `link_phone` VARCHAR(60) NOT NULL DEFAULT '' COMMENT '联系手机号码',
  `click_count` MEDIUMINT(8) NOT NULL DEFAULT '0' COMMENT '点击量',
  `enabled` TINYINT(3) NOT NULL DEFAULT '1' COMMENT '是否显示',
  PRIMARY KEY  (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;