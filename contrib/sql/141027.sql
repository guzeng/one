ALTER TABLE one_user_openid ADD COLUMN expires INT(11) NOT NULL DEFAULT 0 COMMENT '过期时间',ADD COLUMN refresh_token VARCHAR(40) NOT NULL DEFAULT '' COMMENT '刷新token';