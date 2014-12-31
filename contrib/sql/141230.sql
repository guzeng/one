alter table one_member add column login_num int(11) not null default 0 comment '登录次数';
alter table one_member add column is_referrer tinyint(1) not null default 0 comment '是否为推荐人';