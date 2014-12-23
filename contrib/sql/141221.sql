ALTER TABLE one_order_detail add column create_time int(10) not null default 0; 
ALTER TABLE one_user_comment add column product_id int(11) not null default 0 after user_id; 
ALTER TABLE one_user_comment add column order_detail_id int(11) not null default 0; 
ALTER TABLE one_user_comment add column point int(11) not null default 0; 