/*
Navicat MySQL Data Transfer

Source Server         : ladmin
Source Server Version : 50717
Source Host           : 127.0.0.1:33060
Source Database       : apiAdmin

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-03-13 17:02:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api_config_dict
-- ----------------------------
DROP TABLE IF EXISTS `api_config_dict`;
CREATE TABLE `api_config_dict` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '参数字典ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '参数字典名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '参数字典类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '参数字典标题',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '参数字典分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数字典值',
  `remark` varchar(100) NOT NULL COMMENT '参数字典说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '使用状态，0：停用，1：启用',
  `value` text NOT NULL COMMENT '使用状态',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `group` (`group`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='参数字典表';
