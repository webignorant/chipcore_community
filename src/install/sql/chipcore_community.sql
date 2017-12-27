/*
Navicat MySQL Data Transfer

Source Server         : localhost_mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : chipcore_community

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-12-28 00:39:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for common_application
-- ----------------------------
DROP TABLE IF EXISTS `common_application`;
CREATE TABLE `common_application` (
  `application_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `name` varchar(100) NOT NULL COMMENT '应用名称',
  `url` varchar(255) NOT NULL COMMENT '应用地址',
  `description` mediumtext NOT NULL COMMENT '应用说明',
  `logo` varchar(255) DEFAULT NULL COMMENT '应用logo',
  `ifshow` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '分组',
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of common_application
-- ----------------------------
INSERT INTO `common_application` VALUES ('4', '0', '照片', 'pictrue.php', '照片', 'public/image/icon/image.png', '1', '0');
INSERT INTO `common_application` VALUES ('1', '1', '心情', 'record.php', '心情记录', 'public/image/icon/mood.png', '1', '0');
INSERT INTO `common_application` VALUES ('2', '2', '日记', 'diary.php', '编写日记', 'public/image/icon/diary.png', '1', '0');
INSERT INTO `common_application` VALUES ('3', '3', '文章', 'article.php', '编写文章', 'public/image/icon/article.png', '0', '0');
INSERT INTO `common_application` VALUES ('5', '5', '音乐', 'music.php', '音乐', 'public/image/icon/music.png', '1', '0');
INSERT INTO `common_application` VALUES ('6', '6', '视频', 'video.php', '视频', 'public/image/icon/video.png', '0', '0');
INSERT INTO `common_application` VALUES ('7', '7', '群组', 'group.php', '群组', 'public/image/icon/groups.png', '0', '0');
INSERT INTO `common_application` VALUES ('8', '8', '圈子', 'circle.php', '圈子', 'public/image/icon/circle.png', '0', '0');

-- ----------------------------
-- Table structure for common_friendlink
-- ----------------------------
DROP TABLE IF EXISTS `common_friendlink`;
CREATE TABLE `common_friendlink` (
  `friendlink_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `name` varchar(100) NOT NULL COMMENT '站点名称',
  `url` varchar(255) NOT NULL COMMENT '站点地址',
  `description` mediumtext NOT NULL COMMENT '站点说明',
  `logo` varchar(255) DEFAULT NULL COMMENT '站点logo',
  `ifshow` smallint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '分组',
  PRIMARY KEY (`friendlink_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of common_friendlink
-- ----------------------------
INSERT INTO `common_friendlink` VALUES ('1', '0', '百度一下', 'http://www.baidu.com', '百度中国', 'public/image/logo/baidu.jpg', '1', '0');
INSERT INTO `common_friendlink` VALUES ('2', '0', '谷歌搜索', 'http://www.google.com.hk', '谷歌香港', 'public/image/logo/google.jpg', '1', '0');

-- ----------------------------
-- Table structure for diary_info
-- ----------------------------
DROP TABLE IF EXISTS `diary_info`;
CREATE TABLE `diary_info` (
  `diaryID` int(10) NOT NULL AUTO_INCREMENT COMMENT '日记编号',
  `title` varchar(40) DEFAULT NULL COMMENT '文章标题',
  `content` varchar(16000) DEFAULT NULL COMMENT '文章内容',
  `userID` int(10) DEFAULT NULL COMMENT '发表人ID',
  `addTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发表时间',
  `typeID` int(3) DEFAULT '1' COMMENT '分类编号',
  `callPurview` varchar(1) NOT NULL COMMENT '访问权限 0不允许 1允许全部人 2允许好友',
  `forwardingNumber` int(10) DEFAULT NULL COMMENT '转发次数',
  `comments` int(10) DEFAULT NULL COMMENT '评论次数',
  PRIMARY KEY (`diaryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of diary_info
-- ----------------------------

-- ----------------------------
-- Table structure for friendgroup
-- ----------------------------
DROP TABLE IF EXISTS `friendgroup`;
CREATE TABLE `friendgroup` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '表编号',
  `groupID` int(10) NOT NULL COMMENT '分组编号 1：我的好友',
  `userID` int(10) NOT NULL COMMENT '用户编号 FK UserInfo(userID)',
  `groupName` varchar(20) NOT NULL COMMENT '分组名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friendgroup
-- ----------------------------

-- ----------------------------
-- Table structure for friends
-- ----------------------------
DROP TABLE IF EXISTS `friends`;
CREATE TABLE `friends` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '表编号',
  `friendID` int(10) NOT NULL COMMENT '好友编号 PK.FK UserInfo(UserID)',
  `userID` int(10) NOT NULL COMMENT '用户编号 PK.FK UserInfo(UserID)',
  `groupID` int(10) NOT NULL DEFAULT '1' COMMENT '好友组号',
  `friendComment` varchar(50) DEFAULT NULL COMMENT '好友备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of friends
-- ----------------------------

-- ----------------------------
-- Table structure for image_info
-- ----------------------------
DROP TABLE IF EXISTS `image_info`;
CREATE TABLE `image_info` (
  `imageID` int(10) NOT NULL AUTO_INCREMENT COMMENT '照片编号 PK Identity(1,1)',
  `imageName` varchar(50) NOT NULL COMMENT '照片名称 规则 Image+ I++',
  `userID` int(10) DEFAULT NULL COMMENT '拥有者编号',
  `addTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `specialID` int(10) DEFAULT NULL COMMENT '专辑编号',
  `imagePath` varchar(100) NOT NULL COMMENT '照片地址',
  `imageRemark` varchar(100) DEFAULT NULL COMMENT '照片描述',
  PRIMARY KEY (`imageID`),
  UNIQUE KEY `specialID` (`specialID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of image_info
-- ----------------------------

-- ----------------------------
-- Table structure for message_short
-- ----------------------------
DROP TABLE IF EXISTS `message_short`;
CREATE TABLE `message_short` (
  `messageID` int(10) NOT NULL AUTO_INCREMENT COMMENT '消息编号 PK identity(1,1)',
  `sendUserID` int(10) NOT NULL COMMENT '发送方编号 FK UserInfo(UserID)',
  `receiveUserID` int(10) NOT NULL COMMENT '接收方编号 FK UserInfo(UserID)',
  `sendTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发送时间',
  `message` varchar(500) NOT NULL COMMENT '消息内容',
  `isIgnored` int(1) DEFAULT NULL COMMENT '是否忽略 1为忽略 0 为未忽略',
  `status` int(11) DEFAULT NULL COMMENT '消息状态 0为接收方已清除 1为发送方已清除 2为都已经清除',
  PRIMARY KEY (`messageID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message_short
-- ----------------------------

-- ----------------------------
-- Table structure for music_info
-- ----------------------------
DROP TABLE IF EXISTS `music_info`;
CREATE TABLE `music_info` (
  `musicID` int(10) NOT NULL AUTO_INCREMENT COMMENT '音乐编号 PK Identity(1,1)',
  `musicName` varchar(50) NOT NULL COMMENT '音乐名称 规则 music+ I++',
  `userID` int(10) DEFAULT NULL COMMENT '拥有者编号',
  `addTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `specialID` int(10) DEFAULT NULL COMMENT '专辑编号',
  `musicPath` varchar(100) NOT NULL COMMENT '音乐地址',
  `musicRemark` varchar(100) DEFAULT NULL COMMENT '音乐描述',
  PRIMARY KEY (`musicID`),
  UNIQUE KEY `specialID` (`specialID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of music_info
-- ----------------------------

-- ----------------------------
-- Table structure for record_info
-- ----------------------------
DROP TABLE IF EXISTS `record_info`;
CREATE TABLE `record_info` (
  `recordID` int(10) NOT NULL AUTO_INCREMENT COMMENT '心情编号',
  `emotion` int(10) NOT NULL COMMENT '目前情感 1开心 2伤心 3郁闷 4愤怒',
  `content` varchar(50) NOT NULL COMMENT '内容',
  `userID` int(10) NOT NULL COMMENT '发表人编号',
  `addTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发表时间',
  PRIMARY KEY (`recordID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of record_info
-- ----------------------------

-- ----------------------------
-- Table structure for share_comment
-- ----------------------------
DROP TABLE IF EXISTS `share_comment`;
CREATE TABLE `share_comment` (
  `commentID` int(10) NOT NULL AUTO_INCREMENT COMMENT '评论编号',
  `shareType` int(10) NOT NULL COMMENT '分享类型 1心情 2日记 3文章 4照片 5音乐 6视频 7文件',
  `shareUserID` int(10) NOT NULL COMMENT '分享者编号',
  `reviewersID` int(10) NOT NULL COMMENT '评论者编号',
  `shareID` int(10) NOT NULL COMMENT '被评论的分享编号',
  `content` varchar(200) NOT NULL COMMENT '评论内容',
  `addTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '评论时间',
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of share_comment
-- ----------------------------

-- ----------------------------
-- Table structure for space_visitor
-- ----------------------------
DROP TABLE IF EXISTS `space_visitor`;
CREATE TABLE `space_visitor` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `visitorID` int(10) NOT NULL COMMENT '访客编号',
  `userID` int(10) NOT NULL COMMENT '用户编号',
  `spaceID` int(10) NOT NULL COMMENT '空间编号',
  `count` int(20) NOT NULL COMMENT '访问次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of space_visitor
-- ----------------------------

-- ----------------------------
-- Table structure for user_custom
-- ----------------------------
DROP TABLE IF EXISTS `user_custom`;
CREATE TABLE `user_custom` (
  `userID` int(10) NOT NULL COMMENT '用户编号',
  `theme` varchar(50) NOT NULL DEFAULT 'public/theme/Default.css' COMMENT '主题设置',
  `priateSet` int(5) NOT NULL DEFAULT '0' COMMENT '隐私设置',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户自定义网站表';

-- ----------------------------
-- Records of user_custom
-- ----------------------------

-- ----------------------------
-- Table structure for user_dynamic
-- ----------------------------
DROP TABLE IF EXISTS `user_dynamic`;
CREATE TABLE `user_dynamic` (
  `dynamicID` int(20) NOT NULL AUTO_INCREMENT COMMENT '动态编号',
  `userID` int(10) NOT NULL COMMENT '用户编号',
  `actionType` int(2) NOT NULL COMMENT '用户动作： 1分享心情 2分享日记 3分享文章 4分享照片 5分享音乐 6分享视频 7分享文件 8添加好友 9添加关注 10新人报道',
  `actionObject` varchar(200) NOT NULL COMMENT '动作对象 用户之间存用户名 分享之间存标题',
  `actionTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '动作时间',
  PRIMARY KEY (`dynamicID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_dynamic
-- ----------------------------

-- ----------------------------
-- Table structure for user_info
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `userID` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户编号 PK Identity(1,1)',
  `nickName` varchar(20) DEFAULT NULL COMMENT '昵称',
  `password` varchar(50) NOT NULL COMMENT '用户密码',
  `regTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `lastTimeOnline` varchar(15) DEFAULT NULL COMMENT '上次登录时间',
  `statue` int(2) DEFAULT NULL COMMENT '状态 1为登录 0为下线 3正常 3为冻结',
  `photo` varchar(100) DEFAULT 'public/image/common/default_Avatar.png' COMMENT '头像地址',
  `priateSet` varchar(5) DEFAULT NULL COMMENT '隐私设置',
  `realName` varchar(20) NOT NULL COMMENT '真实姓名',
  `sex` varchar(5) NOT NULL COMMENT '性别',
  `birthday` datetime NOT NULL COMMENT '生日',
  `bloodType` varchar(2) DEFAULT NULL COMMENT '血型',
  `about` varchar(100) DEFAULT NULL COMMENT '简介',
  `status` int(3) DEFAULT NULL COMMENT '目前身份 1为学生 2为工作者 3为其他',
  `location` varchar(20) NOT NULL COMMENT '居住地址',
  `homeCity` varchar(20) DEFAULT NULL COMMENT '家乡',
  `email` varchar(25) NOT NULL COMMENT '电子邮件',
  `QQ` varchar(12) DEFAULT NULL COMMENT 'QQ',
  `MSN` varchar(30) DEFAULT NULL COMMENT 'MSN',
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_info
-- ----------------------------

-- ----------------------------
-- Table structure for user_schoolinfo
-- ----------------------------
DROP TABLE IF EXISTS `user_schoolinfo`;
CREATE TABLE `user_schoolinfo` (
  `schoolID` int(10) NOT NULL DEFAULT '0' COMMENT '编号 PK Identity(1,1)',
  `userID` int(10) DEFAULT NULL COMMENT '用户编号 FK UserInfo(UserID)',
  `schoolType` varchar(10) DEFAULT NULL COMMENT '毕业学校类型',
  `schoolName` varchar(20) DEFAULT NULL COMMENT '学校名称',
  `grade` varchar(20) DEFAULT NULL COMMENT '院系',
  `classes` varchar(20) DEFAULT NULL COMMENT '班级',
  `admissionTime` datetime DEFAULT NULL COMMENT '入学时间',
  PRIMARY KEY (`schoolID`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_schoolinfo
-- ----------------------------

-- ----------------------------
-- Table structure for user_space
-- ----------------------------
DROP TABLE IF EXISTS `user_space`;
CREATE TABLE `user_space` (
  `spaceID` int(10) NOT NULL COMMENT '空间编号',
  `userID` int(10) NOT NULL COMMENT '用户编号',
  `frontCover` varchar(100) DEFAULT 'public/image/common/default_frontCover.png' COMMENT '空间封面',
  `callPurview` varchar(1) NOT NULL COMMENT '访问权限 0不允许 1允许全部人 2允许好友',
  `flashbg` varchar(50) NOT NULL DEFAULT 'public/flash/space/Pulley.swf' COMMENT 'Flash背景风格',
  PRIMARY KEY (`spaceID`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_space
-- ----------------------------

-- ----------------------------
-- Table structure for user_worksinfo
-- ----------------------------
DROP TABLE IF EXISTS `user_worksinfo`;
CREATE TABLE `user_worksinfo` (
  `workID` int(10) NOT NULL AUTO_INCREMENT COMMENT '工作编号 PK Identity(1,1)',
  `userID` int(10) NOT NULL COMMENT '用户编号 FK UserInfo(UserID)',
  `companyName` varchar(30) DEFAULT NULL COMMENT '工作单位',
  `departmentName` varchar(20) DEFAULT NULL COMMENT '部门名称',
  `joinTime` datetime DEFAULT NULL COMMENT '加入时间',
  `departureTime` datetime DEFAULT NULL COMMENT '离职时间',
  PRIMARY KEY (`workID`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_worksinfo
-- ----------------------------
