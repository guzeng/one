# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.6.26)
# Database: 170es
# Generation Time: 2015-09-28 14:49:26 +0000
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table one_area
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_area`;



# Dump of table one_join
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_join`;

CREATE TABLE `one_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '类型：1,供应商；2，人才',
  `company` varchar(200) NOT NULL DEFAULT '' COMMENT '供应商公司名称',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `phone` varchar(100) NOT NULL DEFAULT '' COMMENT '电话',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '邮箱',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '填写时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态：0，未处理；1，已处理',
  `note` text COMMENT '备注',
  `handle` varchar(50) NOT NULL DEFAULT '' COMMENT '处理人',
  `handle_time` int(10) NOT NULL DEFAULT '0' COMMENT '处理时间',
  `remark` text COMMENT '评价',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='加明';



# Dump of table one_link
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_link`;

CREATE TABLE `one_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '类型;1,图片;2,文字',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT 'title',
  `url` varchar(200) NOT NULL DEFAULT '' COMMENT 'URL',
  `img` varchar(100) NOT NULL DEFAULT '' COMMENT '图片地址',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='友情链接';



# Dump of table one_logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_logs`;

CREATE TABLE `one_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `time` int(10) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类型',
  `object_type` varchar(30) NOT NULL DEFAULT '' COMMENT '操作对象',
  `object_id` int(11) NOT NULL DEFAULT '0' COMMENT '对象ID',
  `object_name` varchar(100) NOT NULL DEFAULT '' COMMENT '对象名称',
  `message` text NOT NULL COMMENT '操作内容',
  `ip` varchar(15) NOT NULL COMMENT '操作者IP',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type`,`object_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='操作日志表';



# Dump of table one_member
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_member`;

CREATE TABLE `one_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '会员名',
  `pwd` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '姓名',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'Email',
  `grade` tinyint(3) NOT NULL DEFAULT '0' COMMENT '等级',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `reference` int(11) NOT NULL DEFAULT '0' COMMENT '推荐人',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `last_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `is_admin` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否管理员',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `telephone` varchar(30) NOT NULL DEFAULT '' COMMENT '固定电话',
  `phone` varchar(30) NOT NULL DEFAULT '' COMMENT '手机',
  `post_code` varchar(10) NOT NULL DEFAULT '' COMMENT '邮编',
  `area` int(11) NOT NULL DEFAULT '0' COMMENT '地区',
  `qq` varchar(30) NOT NULL DEFAULT '' COMMENT 'qq',
  `status` varchar(30) NOT NULL DEFAULT '' COMMENT '启用',
  `gender` int(11) NOT NULL DEFAULT '0' COMMENT '性别',
  `address` varchar(50) NOT NULL DEFAULT '' COMMENT '详细地址',
  `money` decimal(2,0) NOT NULL DEFAULT '0' COMMENT '预付款',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员表';

LOCK TABLES `one_member` WRITE;
/*!40000 ALTER TABLE `one_member` DISABLE KEYS */;
INSERT INTO `one_member` (`id`,`username`,`pwd`,`name`,`email`,`grade`,`score`,`reference`,`create_time`,`last_login_time`,`last_login_ip`,`is_admin`,`password`,`telephone`,`phone`,`post_code`,`area`,`qq`,`status`,`gender`,`address`,`money`)
VALUES
	(1,'admin','497245c9e08975567103ce3cc382e761758a1679','admin','',0,0,0,0,0,'',0,'','','','',0,'','',0,'',0);

/*!40000 ALTER TABLE `one_member` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table one_news
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_news`;

CREATE TABLE `one_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态',
  `show_time` int(10) NOT NULL DEFAULT '0' COMMENT '发布时间',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '类型：1，文章；2，调查',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '类别ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章表';



# Dump of table one_news_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_news_category`;

CREATE TABLE `one_news_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '类型名字',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章类别表';



# Dump of table one_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_order`;

CREATE TABLE `one_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID，订单创建人',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '编号',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `phone` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '地址',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态,0,待处理,1,已发货,2,退货',
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`),
  KEY `code` (`code`),
  KEY `time` (`create_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单表';



# Dump of table one_order_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_order_detail`;

CREATE TABLE `one_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `number` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单详情';



# Dump of table one_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_product`;

CREATE TABLE `one_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL DEFAULT '' COMMENT '代码',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '类别ID',
  `price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `best_price` float(10,2) NOT NULL DEFAULT '0.00' COMMENT '优惠价',
  `brand_id` int(11) NOT NULL DEFAULT '0' COMMENT '品牌ID',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '类型',
  `create_by` int(11) NOT NULL DEFAULT '0' COMMENT '添加人',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) NOT NULL DEFAULT '0' COMMENT '最后修改时间',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '库存数量',
  `status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '状态：1，上架；0，下架；2，删除',
  `unit` varchar(30) NOT NULL DEFAULT '' COMMENT '计量单位',
  `weight` float(9,2) NOT NULL DEFAULT '0.00' COMMENT '单位重量',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `min_num` int(11) NOT NULL DEFAULT '0' COMMENT '最低购买数',
  `recommend` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否推荐，1:推荐',
  `specials` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否特卖,1:是',
  `allow_comment` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否允许评论,1:是',
  `info` text COMMENT '简介',
  `hot` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否热卖,1:是',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='产品表';



# Dump of table one_product_brand
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_product_brand`;

CREATE TABLE `one_product_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `info` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品品牌';



# Dump of table one_product_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_product_category`;

CREATE TABLE `one_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='商品分类';



# Dump of table one_product_comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_product_comment`;

CREATE TABLE `one_product_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '时间',
  `rate` tinyint(3) NOT NULL DEFAULT '0' COMMENT '评分',
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='商品讨论表';



# Dump of table one_product_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_product_type`;

CREATE TABLE `one_product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '类型名称',
  `info` varchar(100) NOT NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='商品类型';



# Dump of table one_questionnaire
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_questionnaire`;

CREATE TABLE `one_questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '问卷标题',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '简介(开头语)',
  `conclusion` varchar(255) NOT NULL DEFAULT '' COMMENT '结束语',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,1:启用;0:关闭',
  `create_time` varchar(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_by` int(11) NOT NULL DEFAULT '0' COMMENT '创建人ID',
  `record` int(11) NOT NULL DEFAULT '0' COMMENT '答题总人数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;



# Dump of table one_questionnaire_option
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_questionnaire_option`;

CREATE TABLE `one_questionnaire_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '选项标题',
  `record` int(11) NOT NULL DEFAULT '0' COMMENT '选项记录',
  `questionnaire_question_id` int(11) NOT NULL DEFAULT '0' COMMENT '调查问卷问题表ID',
  `questionnaire_id` int(11) NOT NULL DEFAULT '0' COMMENT '调查问卷表ID',
  PRIMARY KEY (`id`),
  KEY `questionnaire_question_id` (`questionnaire_question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;



# Dump of table one_questionnaire_question
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_questionnaire_question`;

CREATE TABLE `one_questionnaire_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '问题标题',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:单选题;1:多选题',
  `record` int(11) NOT NULL DEFAULT '0' COMMENT '答题人数',
  `questionnaire_id` int(11) NOT NULL DEFAULT '0' COMMENT '调查问卷表ID',
  PRIMARY KEY (`id`),
  KEY `questionnaire_id` (`questionnaire_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;



# Dump of table one_setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_setting`;

CREATE TABLE `one_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `value` varchar(150) NOT NULL DEFAULT '' COMMENT '值',
  PRIMARY KEY (`id`),
  UNIQUE KEY `variable` (`variable`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='设置表';



# Dump of table one_storage
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_storage`;

CREATE TABLE `one_storage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '名称',
  `info` varchar(100) NOT NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='仓库';



# Dump of table one_user_comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `one_user_comment`;

CREATE TABLE `one_user_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '创建人ID',
  `content` text NOT NULL COMMENT '留言内容',
  `reversion` text COMMENT '回复内容',
  `create_time` varchar(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员留言';






/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
