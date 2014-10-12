/*
MySQL Data Transfer
Source Host: localhost
Source Database: one
Target Host: localhost
Target Database: one
Date: 2014/6/23 19:32:38
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for one_product
-- ----------------------------
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
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COMMENT='产品表';

-- ----------------------------
-- Table structure for one_product_brand
-- ----------------------------
DROP TABLE IF EXISTS `one_product_brand`;
CREATE TABLE `one_product_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '品牌名称',
  `product_cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '关联商品分类ID',
  `info` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='商品品牌';

-- ----------------------------
-- Table structure for one_product_category
-- ----------------------------
DROP TABLE IF EXISTS `one_product_category`;
CREATE TABLE `one_product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='商品分类';

-- ----------------------------
-- Table structure for one_product_category_map
-- ----------------------------
DROP TABLE IF EXISTS `one_product_category_map`;
CREATE TABLE `one_product_category_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品ID',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '分类ID',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='商品分类对应表';

-- ----------------------------
-- Table structure for one_product_comment
-- ----------------------------
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

-- ----------------------------
-- Table structure for one_product_type
-- ----------------------------
DROP TABLE IF EXISTS `one_product_type`;
CREATE TABLE `one_product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '类型名称',
  `info` varchar(100) NOT NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='商品类型';

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `one_product` VALUES ('50', 'd-001', '苏泊尔 电压力锅 CYSB 50YC6B-100', '0', '299.00', '274.00', '5', '14', '0', '1403444623', '0', '7764', '1', '台', '2.00', '274', '1', '1', '1', '1', '<p>苏泊尔 电压力锅 CYSB 50YC6B-100 5L电脑版，支持24小时预约、2小时定时、数字显示，采用了硬质不粘彩琅内胆材质，功率是1000W，可以一键选择煮饭，<span style=\"color:#4c33e5;\">蛋糕，煲汤，豆类，煮粥，炖鱼</span>等功能；锅内部分为螺纹结构，持久耐用不变形；一锅双胆，使用寿命长。 </p>\r\n', '1');
INSERT INTO `one_product` VALUES ('51', 'd-002', '苏泊尔（supor）CYSB50FD9-100 电压力锅 5L一锅双胆', '0', '399.00', '374.00', '5', '14', '0', '1403444835', '0', '6744', '1', '台', '2.00', '374', '1', '1', '1', '1', '<div class=\"pcp_title\">创新按键式排气</div>\r\n\r\n<div class=\"pcp_zhengzi\">一直以开，电压力锅排气都要用手去转动限压阀，很不安全，烫伤时有发生，苏泊尔创新采用按键式排气设计，只要轻轻一按，就能安全快速的排出锅内压力，安全又快捷，美味无需再等待.<br />\r\nPS：采用了可靠的安全机械结构哦，断电后也能使用的</div>\r\n', '1');
INSERT INTO `one_product` VALUES ('52', 'd-003', '苏泊尔（supor） CYSB50YC1－100 电脑版压力锅5L（黑色）', '0', '369.00', '344.00', '5', '14', '0', '1403445011', '0', '4687', '1', '台', '3.00', '44', '1', '1', '1', '1', '<div class=\"pcp_title\">安全冷外壳，360度全面防烫</div>\r\n\r\n<div class=\"pcp_zhengzi\">传统压力锅锅盖是裸露的金属，表面温度极高,使用时极易烫伤,苏泊尔50FD9采用了360度全包冷外壳技术,360度全面防烫,安全全面升级</div>\r\n', '1');
INSERT INTO `one_product` VALUES ('53', 'd-004', '苏泊尔（SUPOR） CYSB50YC810A-100 电压力锅 双胆', '0', '199.00', '184.00', '0', '13', '0', '1403445159', '0', '2342', '1', '台', '1.00', '184', '1', '1', '1', '0', '<div class=\"pcp_title\">隐藏式顶盖储水盒</div>\r\n\r\n<div class=\"pcp_zhengzi\">苏泊尔50FD9在顶盖上设计有冷凝水储水盒，收集排气时产生的冷凝水，让您的厨房更加清爽好打理</div>\r\n', '0');
INSERT INTO `one_product` VALUES ('54', 'd-005', '美的（Midea） W12PCH402E 旋钮版4L 电压力锅', '0', '199.00', '184.00', '3', '13', '0', '1403445381', '0', '645', '1', '台', '2.00', '184', '1', '1', '1', '1', '<div class=\"pcp_title\">自动开盖按键</div>\r\n\r\n<div class=\"pcp_zhengzi\">当锅内没有压力并打开内盖后，只要轻轻一按开盖按键，整个锅盖就会自动打开哦。完全避免了烫伤的可能性</div>\r\n', '1');
INSERT INTO `one_product` VALUES ('55', 'd-006', '美的(midea) W12PCS505E 电压力锅 5L多功能电脑版', '0', '499.00', '455.00', '3', '10', '0', '1403445566', '0', '4656', '1', '台', '3.00', '455', '1', '1', '1', '1', '<div class=\"pcp_title\">双防保险设计</div>\r\n\r\n<div class=\"pcp_zhengzi\">您有没有被锅内余压烫到过？<br />\r\n您有没有因为锅盖吸锅而不得不清理厨房？<br />\r\n苏泊尔50FD9特别增加了防余压，防吸锅的双防保险设计，当您将内盖打开后，限压阀会自动打开，保正压力锅内外压力一致，再也不用担心余压烫伤和吸锅了</div>\r\n', '1');
INSERT INTO `one_product` VALUES ('56', 'd-007', '九阳（Joyoung） 5升电脑板电压力锅JYY-50YL1', '0', '199.00', '184.00', '0', '11', '0', '1403445736', '0', '4647', '1', '台', '2.00', '199', '1', '0', '0', '1', '<div class=\"pcp_title\">更安全的不锈钢保温罩</div>\r\n\r\n<div class=\"pcp_zhengzi\">苏泊尔选用加厚不锈钢一次成型保温罩，储热值高，保温性好，无焊点接缝，久用不生锈，安全有保<br />\r\n内部涂有黑色吸热材料，配合储热值超高的加厚不锈钢保温罩，断电后保温时间长达6小时（测试环境为室温25度）<br />\r\nPS：很多品牌和型号的保温罩用的都是铸铁，储热值低，保温性差好，使用一段时间后会生锈，从而导致结构强度下降，这样一来，你的压力锅就越来越不安全了</div>\r\n', '1');
INSERT INTO `one_product` VALUES ('57', 'd-008', '美的（Midea）FS40-11L1 机械电风扇/落地扇', '0', '139.00', '139.00', '3', '11', '0', '1403445992', '0', '1346', '1', '台', '3.00', '139', '1', '0', '0', '1', '<p>本产品全国联保，享受三包服务，质保期为：全国联保一年<br />\r\n您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......<br />\r\n售后服务电话：400-8899-316<br />\r\n品牌官方网站：www.midea.com.cn</p>\r\n', '0');
INSERT INTO `one_product` VALUES ('58', 'd-009', '美的（Midea）FS40-13C 5叶机械电风扇/落地扇', '0', '99.00', '94.00', '3', '12', '0', '1403446551', '0', '9746', '1', '台', '3.00', '94', '1', '1', '0', '1', '<p>本产品全国联保，享受三包服务，质保期为：全国联保一年<br />\r\n您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......<br />\r\n售后服务电话：400-8899-316<br />\r\n品牌官方网站：www.midea.com.cn</p>\r\n', '0');
INSERT INTO `one_product` VALUES ('59', 'd-010', '美的（Midea）FS40-13ER 5叶遥控电风扇/落地扇', '0', '99.00', '94.00', '3', '12', '0', '1403446690', '0', '6413', '0', '台', '3.00', '94', '1', '0', '0', '0', '<p>本产品全国联保，享受三包服务，质保期为：全国联保一年<br />\r\n您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......<br />\r\n售后服务电话：400-8899-316<br />\r\n品牌官方网站：www.midea.com.cn</p>\r\n', '0');
INSERT INTO `one_product` VALUES ('60', 'd-11', '美的（Midea）KYS30-10CR 遥控电风扇/升降转页扇', '0', '239.00', '199.00', '3', '10', '0', '1403447111', '0', '1346', '1', '台', '2.00', '199', '1', '1', '1', '1', '<p>本产品全国联保，享受三包服务，质保期为：全国联保一年<br />\r\n您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......<br />\r\n售后服务电话：400-8899-316<br />\r\n品牌官方网站：www.midea.com.cn</p>\r\n', '0');
INSERT INTO `one_product` VALUES ('61', 'd-012', '美的（Midea）FZ10-10JRL 遥控塔扇/电风扇', '0', '329.00', '299.00', '3', '9', '0', '1403447257', '0', '6447', '1', '台', '6.00', '299', '1', '1', '1', '1', '<p>本产品全国联保，享受三包服务，质保期为：全国联保一年<br />\r\n您可以查询本品牌在各地售后服务中心的联系方式，请点击这儿查询......<br />\r\n售后服务电话：400-8899-316<br />\r\n品牌官方网站：www.midea.com.cn</p>\r\n', '1');
INSERT INTO `one_product_brand` VALUES ('3', '美的', '');
INSERT INTO `one_product_brand` VALUES ('4', '九阳', '');
INSERT INTO `one_product_brand` VALUES ('5', '苏泊尔', '');
INSERT INTO `one_product_brand` VALUES ('6', '飞利浦', '');
INSERT INTO `one_product_brand` VALUES ('7', '奔腾', '');
INSERT INTO `one_product_brand` VALUES ('8', '松下', '');
INSERT INTO `one_product_brand` VALUES ('9', '格兰仕', '');
INSERT INTO `one_product_brand` VALUES ('10', '荣事达', '');
INSERT INTO `one_product_brand` VALUES ('11', '飞科', '');
INSERT INTO `one_product_category` VALUES ('13', '电脑', '0');
INSERT INTO `one_product_category` VALUES ('9', '食品', '0');
INSERT INTO `one_product_category` VALUES ('10', '图书', '0');
INSERT INTO `one_product_category` VALUES ('11', '服装', '0');
INSERT INTO `one_product_category` VALUES ('12', '电器', '0');
INSERT INTO `one_product_category` VALUES ('15', '笔记本', '13');
INSERT INTO `one_product_category` VALUES ('16', '平板电脑', '13');
INSERT INTO `one_product_category` VALUES ('17', '台式整机', '13');
INSERT INTO `one_product_category` VALUES ('18', '生活电器', '12');
INSERT INTO `one_product_category` VALUES ('19', '厨房电器', '12');
INSERT INTO `one_product_category_map` VALUES ('26', '50', '19');
INSERT INTO `one_product_category_map` VALUES ('27', '51', '19');
INSERT INTO `one_product_category_map` VALUES ('28', '52', '19');
INSERT INTO `one_product_category_map` VALUES ('29', '53', '19');
INSERT INTO `one_product_category_map` VALUES ('30', '55', '19');
INSERT INTO `one_product_category_map` VALUES ('31', '56', '19');
INSERT INTO `one_product_category_map` VALUES ('32', '57', '18');
INSERT INTO `one_product_category_map` VALUES ('36', '58', '18');
INSERT INTO `one_product_category_map` VALUES ('35', '59', '19');
INSERT INTO `one_product_category_map` VALUES ('34', '60', '18');
INSERT INTO `one_product_category_map` VALUES ('33', '61', '18');
INSERT INTO `one_product_type` VALUES ('9', '聚宝盆疯抢在即！', '');
INSERT INTO `one_product_type` VALUES ('7', '直降49元！', '');
INSERT INTO `one_product_type` VALUES ('8', '五一大放送', '');
INSERT INTO `one_product_type` VALUES ('10', '劲爆狂减！', '');
INSERT INTO `one_product_type` VALUES ('11', '新品上市', '');
INSERT INTO `one_product_type` VALUES ('12', '满99减5', '');
INSERT INTO `one_product_type` VALUES ('13', '满199减15', '');
INSERT INTO `one_product_type` VALUES ('14', '满299减25', '');
