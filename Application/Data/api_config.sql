/*
Navicat MySQL Data Transfer

Source Server         : ladmin
Source Server Version : 50717
Source Host           : 127.0.0.1:33060
Source Database       : apiAdmin

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-03-14 10:43:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for api_config
-- ----------------------------
DROP TABLE IF EXISTS `api_config`;
CREATE TABLE `api_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_url` varchar(100) NOT NULL DEFAULT '' COMMENT '网站地址',
  `record_no` varchar(100) NOT NULL DEFAULT '' COMMENT '备案号',
  `site_name` varchar(100) NOT NULL DEFAULT '' COMMENT '网站名称',
  `site_logo` varchar(200) NOT NULL DEFAULT '' COMMENT '网站logo',
  `site_title` varchar(1024) NOT NULL DEFAULT '' COMMENT '标题',
  `site_desc` varchar(1024) NOT NULL DEFAULT '' COMMENT '描述',
  `site_key` varchar(1024) NOT NULL DEFAULT '' COMMENT '关键字',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='网站设置';
