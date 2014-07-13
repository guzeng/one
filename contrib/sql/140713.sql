ALTER TABLE `one_product`   
     ADD COLUMN `promise` text NULL COMMENT '服务承诺';
ALTER TABLE `one_product`   
  ADD COLUMN `sale_num` INT(11) DEFAULT 0  NOT NULL  COMMENT '销量';

