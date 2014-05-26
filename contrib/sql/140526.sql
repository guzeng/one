alter table one_product change brand brand_id int(11) not null default 0 comment '品牌ID';
alter table one_product add column `unit` varchar(30) not null default '' comment '计量单位',
						add column `weight` float(9,2) not null default 0 comment '单位重量',
						add column `score` int(11) not null default 0 comment '积分',
						add column `min_num` int(11) not null default 0 comment '最低购买数',
						add column `recommend` tinyint(3) not null default 0 comment '是否推荐，1:推荐',
						add column `specials` tinyint(3) not null default 0 comment '是否特价,1:是',
						add column `hot` tinyint(3) not null default 0 comment '是否热卖,1:是',
						add column `allow_comment` tinyint(3) not null default 0 comment '是否允许评论,1:是',
						add column `info` text null comment '简介';
