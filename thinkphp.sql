/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-04 22:59:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `destoon_login`
-- ----------------------------
DROP TABLE IF EXISTS `destoon_login`;
CREATE TABLE `destoon_login` (
  `logid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `passsalt` varchar(8) NOT NULL,
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `loginip` varchar(50) NOT NULL DEFAULT '',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0',
  `message` varchar(255) NOT NULL DEFAULT '',
  `agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`logid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='登录日志';

-- ----------------------------
-- Records of destoon_login
-- ----------------------------

-- ----------------------------
-- Table structure for `tp_cate`
-- ----------------------------
DROP TABLE IF EXISTS `tp_cate`;
CREATE TABLE `tp_cate` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类别 1文章',
  `name` char(10) NOT NULL DEFAULT '0' COMMENT '菜单名称',
  `parent_id` smallint(6) NOT NULL COMMENT '父级id',
  `icon` char(20) DEFAULT '0' COMMENT '菜单图标',
  `module` char(20) NOT NULL COMMENT '模块',
  `controller` char(20) NOT NULL COMMENT '控制器',
  `action` char(20) NOT NULL COMMENT '操作',
  `parameter` varchar(200) NOT NULL DEFAULT '0' COMMENT '参数',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态（0正常，1删除，2禁用）',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime NOT NULL COMMENT '更新时间',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='系统所有分类表';

-- ----------------------------
-- Records of tp_cate
-- ----------------------------
INSERT INTO `tp_cate` VALUES ('1', '1', 'y杨郇0', '9', null, 'cate', 'Detail', 'save', '', '0', '0000-00-00 00:00:00', '2017-10-29 11:57:05', '0');
INSERT INTO `tp_cate` VALUES ('2', '1', '99', '0', null, '', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0');
INSERT INTO `tp_cate` VALUES ('3', '1', '222', '0', null, '', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0');
INSERT INTO `tp_cate` VALUES ('4', '1', '0000', '0', null, '', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0');
INSERT INTO `tp_cate` VALUES ('5', '1', '99', '0', null, '', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0');
INSERT INTO `tp_cate` VALUES ('6', '1', '55', '0', null, '', '', '', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0');
INSERT INTO `tp_cate` VALUES ('7', '1', '3333', '0', null, 'cate', 'Detail', 'save', '', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0');
INSERT INTO `tp_cate` VALUES ('8', '1', '852', '1', '0', 'cate', 'Detail', 'save', '0', '0', '2017-10-28 22:15:52', '2017-10-29 12:04:49', '0');
INSERT INTO `tp_cate` VALUES ('9', '1', '一二三四', '0', '0', 'cate', 'Detail', 'save', '0', '0', '2017-10-29 10:17:16', '2017-10-29 12:03:58', '0');
INSERT INTO `tp_cate` VALUES ('10', '1', '一二', '9', '0', 'cate', 'Detail', 'save', '0', '0', '2017-10-29 10:19:13', '2017-10-29 10:19:13', '0');
INSERT INTO `tp_cate` VALUES ('11', '1', '一二三', '0', '0', 'cate', 'Detail', 'save', '0', '1', '2017-10-29 10:21:00', '2017-10-29 22:40:20', '0');
INSERT INTO `tp_cate` VALUES ('12', '1', 'oooi', '0', '0', 'cate', 'Detail', 'save', '0', '0', '2017-10-29 21:10:28', '2017-10-31 21:46:19', '0');
INSERT INTO `tp_cate` VALUES ('13', '1', 'bbb', '9', '0', 'cate', 'Detail', 'save', '0', '0', '2017-10-29 21:17:33', '2017-10-29 21:17:58', '0');

-- ----------------------------
-- Table structure for `tp_log`
-- ----------------------------
DROP TABLE IF EXISTS `tp_log`;
CREATE TABLE `tp_log` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL,
  `user_id` bigint(20) DEFAULT '0',
  `user_name` varchar(30) NOT NULL DEFAULT '',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='操作日志表';

-- ----------------------------
-- Records of tp_log
-- ----------------------------
INSERT INTO `tp_log` VALUES ('1', '登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-02 21:05:13');
INSERT INTO `tp_log` VALUES ('2', '登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-02 21:05:56');
INSERT INTO `tp_log` VALUES ('3', '成功登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-02 21:16:12');
INSERT INTO `tp_log` VALUES ('4', '访问管理员列表', '/member/lists?_pjax=%23admui-pageContent&_=1509628575573', '1', 'admin', '127.0.0.1', '2017-11-02 21:19:25');
INSERT INTO `tp_log` VALUES ('5', '编辑管理员信息', '/member/detail', '1', 'admin', '127.0.0.1', '2017-11-02 21:23:14');
INSERT INTO `tp_log` VALUES ('6', '成功登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-02 21:23:44');
INSERT INTO `tp_log` VALUES ('7', '访问管理员列表', '/member/lists?_pjax=%23admui-pageContent&_=1509629027176', '1', 'admin', '127.0.0.1', '2017-11-02 21:23:50');
INSERT INTO `tp_log` VALUES ('8', '退出系统', '/login/index/out', '1', 'admin', '127.0.0.1', '2017-11-02 21:25:59');
INSERT INTO `tp_log` VALUES ('9', '成功登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-02 21:26:57');
INSERT INTO `tp_log` VALUES ('10', '退出系统', '/login/index/out', '1', 'admin', '127.0.0.1', '2017-11-02 22:05:18');
INSERT INTO `tp_log` VALUES ('11', '成功登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-02 22:07:54');
INSERT INTO `tp_log` VALUES ('12', '退出系统', '/login/index/out', '1', 'admin', '127.0.0.1', '2017-11-02 22:08:47');
INSERT INTO `tp_log` VALUES ('13', '成功登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-03 19:52:14');
INSERT INTO `tp_log` VALUES ('14', '添加置业顾问:杨郇', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 21:13:25');
INSERT INTO `tp_log` VALUES ('15', '编辑置业顾问信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 21:32:06');
INSERT INTO `tp_log` VALUES ('16', '编辑置业顾问信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 21:47:35');
INSERT INTO `tp_log` VALUES ('17', '编辑置业顾问信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 21:51:39');
INSERT INTO `tp_log` VALUES ('18', '添加置业顾问:飞雪', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 21:54:55');
INSERT INTO `tp_log` VALUES ('19', '编辑置业顾问:飞雪的信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 21:55:08');
INSERT INTO `tp_log` VALUES ('20', '删除会员飞雪', '/member/detail/delete', '1', 'admin', '127.0.0.1', '2017-11-03 22:14:07');
INSERT INTO `tp_log` VALUES ('21', '删除置业顾问:飞雪', '/member/detail/delete', '1', 'admin', '127.0.0.1', '2017-11-03 22:15:16');
INSERT INTO `tp_log` VALUES ('22', '编辑置业顾问:杨郇的信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 22:27:11');
INSERT INTO `tp_log` VALUES ('23', '编辑置业顾问:杨郇的信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 22:39:26');
INSERT INTO `tp_log` VALUES ('24', '添加置业顾问:雪影', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 22:43:53');
INSERT INTO `tp_log` VALUES ('25', '编辑置业顾问:雪影的信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 22:44:25');
INSERT INTO `tp_log` VALUES ('26', '退出系统', '/login/index/out', '1', 'admin', '127.0.0.1', '2017-11-03 22:47:13');
INSERT INTO `tp_log` VALUES ('27', '成功登录系统', '/login/index/login', '4', '杨郇', '127.0.0.1', '2017-11-03 22:47:33');
INSERT INTO `tp_log` VALUES ('28', '编辑置业顾问:杨郇1的信息', '/member/detail?group_id=1', '4', '杨郇', '127.0.0.1', '2017-11-03 22:47:58');
INSERT INTO `tp_log` VALUES ('29', '成功登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-03 23:00:35');
INSERT INTO `tp_log` VALUES ('30', '编辑置业顾问:杨郇1的信息', '/member/detail?group_id=1', '1', 'admin', '127.0.0.1', '2017-11-03 23:00:52');
INSERT INTO `tp_log` VALUES ('31', '退出系统', '/login/index/out', '1', 'admin', '127.0.0.1', '2017-11-03 23:00:59');
INSERT INTO `tp_log` VALUES ('32', '成功登录系统', '/login/index/login', '1', 'admin', '127.0.0.1', '2017-11-04 22:46:59');

-- ----------------------------
-- Table structure for `tp_member`
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` char(30) DEFAULT '0',
  `pass_word` varchar(32) NOT NULL DEFAULT '',
  `pass_salt` varchar(8) NOT NULL,
  `token` char(40) NOT NULL,
  `team` tinyint(1) NOT NULL DEFAULT '1' COMMENT '顾问团队 1华南城 2中原 3九鼎',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1启用 2禁用 3删除',
  `number` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '剩余名额',
  `age` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '年龄',
  `area_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '居住区域',
  `channels` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '来访渠道',
  `adviser_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '置业顾问id',
  `room` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '意向户型 1楼栋 2户型',
  `house` tinyint(1) DEFAULT '0' COMMENT '具体哪一栋楼或者具体哪一个户型，根据room来区分',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `true_name` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(50) NOT NULL DEFAULT '',
  `msn` varchar(50) NOT NULL DEFAULT '',
  `qq` varchar(20) NOT NULL DEFAULT '',
  `ali` varchar(30) NOT NULL DEFAULT '',
  `skype` varchar(30) NOT NULL DEFAULT '',
  `department` varchar(30) NOT NULL DEFAULT '',
  `career` varchar(30) NOT NULL DEFAULT '',
  `admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `role` varchar(255) NOT NULL DEFAULT '',
  `aid` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint(1) unsigned NOT NULL DEFAULT '4' COMMENT '分组 4管理员',
  `regid` smallint(4) unsigned NOT NULL DEFAULT '0',
  `sms` int(10) NOT NULL DEFAULT '0',
  `credit` int(10) NOT NULL DEFAULT '0',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deposit` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `bank` varchar(30) NOT NULL DEFAULT '',
  `banktype` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `branch` varchar(100) NOT NULL,
  `account` varchar(30) NOT NULL DEFAULT '',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reg_ip` varchar(50) NOT NULL DEFAULT '',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `login_ip` varchar(50) NOT NULL DEFAULT '',
  `login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `login_times` int(10) unsigned NOT NULL DEFAULT '1',
  `black` varchar(255) NOT NULL DEFAULT '',
  `send` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `auth` varchar(32) NOT NULL DEFAULT '',
  `authvalue` varchar(100) NOT NULL DEFAULT '',
  `auth_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `vemail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vmobile` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vtruename` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vbank` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vcompany` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vtrade` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `trade` varchar(50) NOT NULL DEFAULT '',
  `support` varchar(50) NOT NULL DEFAULT '',
  `inviter` varchar(30) NOT NULL DEFAULT '',
  `note` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupid` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='会员';

-- ----------------------------
-- Records of tp_member
-- ----------------------------
INSERT INTO `tp_member` VALUES ('1', 'admin', '063007e91c5c22b71cddddc1fc7f5f11', 'Bji1Gy9z', 'bddae976000c3d512abeb80a3545ba6b9d15d7c2', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1', '', '', '', '', '', '', '', '', '0', '', '0', '4', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:46:59', '127.0.0.1', '2017-10-30 22:02:01', '127.0.0.1', '2017-11-04 22:47:00', '31', '', '1', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('2', 'admin2', '3c7bcf1ccb0a6133a10b9ff1ba9e4567', 'C98sjVir', '5b35ecf140e03412ca5ebe675227d87f52465d56', '0', '0', '0', '0', '0', '1', '0', '0', '0', '1', '', '', '', '', '', '', '', '', '0', '', '0', '4', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-01 23:27:19', '127.0.0.1', '2017-10-30 22:02:01', '127.0.0.1', '2017-11-01 23:27:20', '1', '', '1', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('4', '杨郇1', '52fe2f31e39609310497ae6708afe0c1', 'DQEeWFp5', '6745211355626a72081d04e7b6697fbc50833425', '1', '2', '100', '0', '0', '0', '0', '0', '0', '1', '', '', '', '', '', '', '', '', '0', '', '0', '1', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-03 23:00:52', '127.0.0.1', '2017-11-03 21:13:25', '127.0.0.1', '2017-11-03 23:00:53', '2', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('5', '飞雪', '57d0cbd0bb24bfd70342141ad0ae2a76', 'P7x0Oszv', 'd24a9320794a663651a0f063f9888ea9e6c30a87', '3', '3', '11', '0', '0', '0', '0', '0', '0', '1', '', '', '', '', '', '', '', '', '0', '', '0', '1', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-03 22:15:16', '127.0.0.1', '2017-11-03 21:54:55', '127.0.0.1', '2017-11-03 22:15:17', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('6', '雪影', '41af93216e12a859abc6f41582bd20db', 'Re0iMfqD', '0f598979dd11363912fef87f5007187f117d397d', '3', '1', '50', '0', '0', '0', '0', '0', '0', '1', '', '', '', '', '', '', '', '', '0', '', '0', '1', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-03 22:44:25', '127.0.0.1', '2017-11-03 22:43:53', '127.0.0.1', '2017-11-03 22:44:26', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('10', '123', '', '', '', '1', '1', '0', '0', '0', '0', '6', '1', '0', '1', '123', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 21:46:44', '127.0.0.1', '2017-11-04 21:46:44', '127.0.0.1', '2017-11-04 21:46:46', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('11', '123', '', '', '', '1', '1', '0', '0', '0', '0', '6', '1', '3', '1', '123', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:04:03', '127.0.0.1', '2017-11-04 22:04:03', '127.0.0.1', '2017-11-04 22:04:05', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('12', 'eeee', '', '', '', '1', '1', '0', '0', '0', '0', '6', '1', '4', '1', 'eeee', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:05:44', '127.0.0.1', '2017-11-04 22:05:44', '127.0.0.1', '2017-11-04 22:05:45', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('13', '456789', '', '', '', '1', '1', '0', '2', '0', '4', '6', '2', '6', '1', '456789', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:21:08', '127.0.0.1', '2017-11-04 22:21:08', '127.0.0.1', '2017-11-04 22:21:09', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('14', '杨总', '', '', '', '1', '1', '0', '1', '0', '5', '6', '2', '5', '1', '杨总', '15825382538', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:23:35', '127.0.0.1', '2017-11-04 22:23:35', '127.0.0.1', '2017-11-04 22:23:36', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('15', '杨郇1', '', '', '', '1', '1', '0', '1', '0', '0', '6', '2', '3', '1', '杨郇1', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:28:57', '127.0.0.1', '2017-11-04 22:28:57', '127.0.0.1', '2017-11-04 22:28:58', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('16', '123', '', '', '', '1', '1', '0', '0', '0', '0', '6', '1', '5', '1', '123', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:39:24', '127.0.0.1', '2017-11-04 22:39:24', '127.0.0.1', '2017-11-04 22:39:25', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('17', '123456', '', '', '', '1', '1', '0', '0', '0', '0', '6', '1', '5', '1', '123456', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:40:49', '127.0.0.1', '2017-11-04 22:40:49', '127.0.0.1', '2017-11-04 22:40:50', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');
INSERT INTO `tp_member` VALUES ('18', '杨郇', '', '', '', '1', '1', '0', '2', '0', '0', '6', '1', '6', '1', '杨郇', '15025302695', '', '', '', '', '', '', '0', '', '0', '5', '0', '0', '0', '0.00', '0.00', '', '0', '', '', '2017-11-04 22:41:41', '127.0.0.1', '2017-11-04 22:41:41', '127.0.0.1', '2017-11-04 22:41:43', '1', '', '0', '', '', '0000-00-00 00:00:00', '0', '0', '0', '0', '0', '0', '', '', '', '');

-- ----------------------------
-- Table structure for `tp_member_note`
-- ----------------------------
DROP TABLE IF EXISTS `tp_member_note`;
CREATE TABLE `tp_member_note` (
  `id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) NOT NULL DEFAULT '0',
  `note` text,
  PRIMARY KEY (`id`,`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COMMENT='预约登记备注表';

-- ----------------------------
-- Records of tp_member_note
-- ----------------------------
INSERT INTO `tp_member_note` VALUES ('11', '11', '');
INSERT INTO `tp_member_note` VALUES ('12', '12', '3423243423fsdfd');
INSERT INTO `tp_member_note` VALUES ('13', '13', 'kkjojojo');
INSERT INTO `tp_member_note` VALUES ('14', '14', '又来了');
INSERT INTO `tp_member_note` VALUES ('15', '15', '题库');
INSERT INTO `tp_member_note` VALUES ('16', '16', '');
INSERT INTO `tp_member_note` VALUES ('17', '17', '');
INSERT INTO `tp_member_note` VALUES ('18', '18', '');
