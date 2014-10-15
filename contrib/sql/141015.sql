create table one_cart (
id int(11) not null auto_increment,
user_id int(11) not null default 0 comment '用户ID',
product_id int(11) not null default 0 comment '产品ID',
count int(11) not null default 0 comment '数量',
primary key(id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='购物车'; 