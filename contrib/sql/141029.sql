ALTER TABLE one_member ADD COLUMN validate_phone TINYINT(1) NOT NULL DEFAULT 0 COMMENT '手机是否验证,1:验证',ADD COLUMN validate_email TINYINT(1) NOT NULL DEFAULT 0 COMMENT '邮箱是否验证,1:验证';
CREATE TABLE `one_validation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `code` varchar(40) NOT NULL DEFAULT '',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `expires` int(10) NOT NULL DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8