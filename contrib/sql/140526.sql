
ALTER TABLE `one_member`   
  ADD COLUMN `email` varchar(50) NOT NULL DEFAULT ''  COMMENT '电子邮箱';
ALTER TABLE `one_member`   
  ADD COLUMN `telephone` varchar(30) NOT NULL DEFAULT ''  COMMENT '固定电话';
ALTER TABLE `one_member`   
  ADD COLUMN `phone` varchar(30) NOT NULL DEFAULT ''  COMMENT '手机';
ALTER TABLE `one_member`   
  ADD COLUMN `post_code` varchar(10) NOT NULL DEFAULT ''  COMMENT '邮编';
ALTER TABLE `one_member`   
  ADD COLUMN `area` int(11) NOT NULL DEFAULT '0'  COMMENT '地区';
ALTER TABLE `one_member`   
  ADD COLUMN `qq` varchar(30) NOT NULL DEFAULT ''  COMMENT 'qq';
ALTER TABLE `one_member`   
  ADD COLUMN `status` varchar(30) NOT NULL DEFAULT ''  COMMENT '启用';
ALTER TABLE `one_member`   
  ADD COLUMN `gender` int(11) NOT NULL DEFAULT '0'  COMMENT '性别';
ALTER TABLE `one_member`   
  ADD COLUMN `address` varchar(50) NOT NULL DEFAULT ''  COMMENT '详细地址';
ALTER TABLE `one_member`   
  ADD COLUMN `money` decimal(2) NOT NULL DEFAULT '0.00'  COMMENT '预付款';

