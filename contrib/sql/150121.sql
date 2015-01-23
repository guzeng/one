
ALTER TABLE one_member ADD COLUMN role_id TINYINT(3) NOT NULL DEFAULT 0 COMMENT '角色ID';

/*Table structure for table `one_role` */

DROP TABLE IF EXISTS `one_role`;

CREATE TABLE `one_role` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '角色名称',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='角色表';

/*Table structure for table `lm_role_permission_map` */

DROP TABLE IF EXISTS `one_role_permission_map`;

CREATE TABLE `one_role_permission_map` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `role_id` INT(11) NOT NULL DEFAULT '0' COMMENT '角色ID',
  `permission_id` INT(11) NOT NULL DEFAULT '0' COMMENT '权限ID',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=MYISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='角色拥有的权限表';

ALTER TABLE one_order add column last_price float(10,2) not null default 0 comment'修改后价格' after price; 
ALTER TABLE one_order add column ship_time int(10) not null default 0 comment '发货时间',add column get_time int(10) not null default 0 comment '收货时间'; 

