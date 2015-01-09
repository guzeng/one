alter table one_order add column use_coupon tinyint(3) not null default 0 comment'是否使用优惠券.1,使用';
alter table one_user_coupon add column order_id int(11) not null default 0 comment '订单号';