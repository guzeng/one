
#
# Source for table one_news
#

DROP TABLE IF EXISTS `one_questionnaire`;
CREATE TABLE `one_questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '问卷标题',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '简介(开头语)',
  `conclusion` varchar(255) NOT NULL DEFAULT '' COMMENT '结束语',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,1:启用;0:关闭',
  `create_time` varchar(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `create_by` int(11) NOT NULL DEFAULT '0' COMMENT '创建人ID',
  `record` int(11) NOT NULL DEFAULT '0' COMMENT '答题总人数',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `one_questionnaire_question`;
CREATE TABLE `one_questionnaire_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '问题标题',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:单选题;1:多选题',
  `record` int(11) NOT NULL DEFAULT '0' COMMENT '答题人数',
  `questionnaire_id` int(11) NOT NULL DEFAULT '0' COMMENT '调查问卷表ID',
  PRIMARY KEY (`id`),
  KEY `questionnaire_id` (`questionnaire_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `one_questionnaire_option`;
CREATE TABLE `one_questionnaire_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '选项标题',
  `record` int(11) NOT NULL DEFAULT '0' COMMENT '选项记录',
  `questionnaire_question_id` int(11) NOT NULL DEFAULT 0 COMMENT '调查问卷问题表ID',
  `questionnaire_id` int(11) NOT NULL DEFAULT '0' COMMENT '调查问卷表ID',
  PRIMARY KEY (`id`),
  KEY `questionnaire_question_id` (`questionnaire_question_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;
