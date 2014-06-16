ALTER TABLE `one_news_category`   
    ADD COLUMN `parent_id` INT(11) DEFAULT 0  NOT NULL  COMMENT '父ID';