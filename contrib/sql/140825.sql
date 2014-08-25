ALTER TABLE `one_product`   
  ADD COLUMN `show_home` tinyint(3) DEFAULT 0  NOT NULL  COMMENT '是否首页展示,0:不展示,1:展示';
ALTER TABLE `one_product`   
  ADD COLUMN `handpick` tinyint(3) DEFAULT 0  NOT NULL  COMMENT '是否精选商品,0:不是,1:是';

