/*
MySQL Data Transfer

Source Server         : 127.0.0.1_Mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : chipcore_community

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-11 11:11:11

社区(chipcore_community)
数据库支持: 仅支持mysql
*/

-- ----------------------------
-- Create database if not exist
-- CHARACTER SET(数据库字符集)
-- COLLATE(数据库校对规则)
-- ----------------------------
-- CREATE DATABASE if not exists `chipcore_community` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- use chipcore_community;

SET FOREIGN_KEY_CHECKS=0;

-- -----------------------------------------------------------------------------
-- Common Table Start

-- ----------------------------
-- Table structure for common_friendlink
-- ----------------------------
CREATE TABLE IF NOT EXISTS `common_friendlink` (
  `friendlink_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `name` varchar(100) NOT NULL COMMENT '站点名称',
  `url` varchar(255) NOT NULL COMMENT '站点地址',
  `description` mediumtext NOT NULL COMMENT '站点说明',
  `logo` varchar(255) COMMENT '站点logo',
  `ifshow` smallint(1) not null DEFAULT '1' COMMENT '是否显示',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '分组',
  PRIMARY KEY (`friendlink_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='友情连接表';

-- ----------------------------
-- Records of common_friendlink
-- ----------------------------
INSERT INTO `common_friendlink` (`friendlink_id`, `displayorder`, `name`, `url`, `description`, `logo`, `ifshow`, `type`) VALUES
(1, 0, '百度一下', 'www.baidu.com', '百度', NULL, 1, 0),
(2, 0, '腾讯首页', 'www.qq.com', '腾讯', NULL, 1, 0);


-- ----------------------------
-- Table structure for common_application
-- ----------------------------
CREATE TABLE IF NOT EXISTS `common_application` (
  `application_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT COMMENT '编号',
  `displayorder` tinyint(3) NOT NULL DEFAULT '0' COMMENT '显示顺序',
  `name` varchar(100) NOT NULL COMMENT '应用名称',
  `url` varchar(255) NOT NULL COMMENT '应用地址',
  `description` mediumtext NOT NULL COMMENT '应用说明',
  `logo` varchar(255) COMMENT '应用logo',
  `ifshow` smallint(1) not null DEFAULT '1' COMMENT '是否显示',
  `type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '分组',
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='应用程序表';

-- ----------------------------
-- Records of common_application
-- ----------------------------
INSERT INTO `common_application` (`application_id`, `displayorder`, `name`, `url`, `description`, `logo`, `ifshow`, `type`) VALUES
(1, 1, '心情', 'record.php', '心情记录', NULL, 1, 0),
(2, 2, '日记', 'diary.php', '编写日记', NULL, 1, 0),
(3, 3, '文章', 'article.php', '编写文章', NULL, 0, 0),
(4, 0, '照片', 'pictrue.php', '照片', NULL, 1, 0),
(5, 5, '音乐', 'music.php', '音乐', NULL, 1, 0),
(6, 6, '视频', 'video.php', '视频', NULL, 0, 0),
(7, 7, '群组', 'group.php', '群组', NULL, 0, 0),
(8, 8, '圈子', 'circle.php', '圈子', NULL, 0, 0);


-- ----------------------------
-- Table structure for common_application
-- ----------------------------
create table if not EXISTS user_space(
  `spaceID` int(10) not null COMMENT '空间编号',
  `userID` int(10) not null COMMENT '用户编号',
  `title` int(10) not null COMMENT '空间标题',
  `frontCover` varchar(100) DEFAULT 'public\/image\/common\/default_frontCover.png' not null COMMENT '空间封面',
  `style` varchar(50) DEFAULT 'public\/theme\/default.css' not null COMMENT '空间风格',
  `flashbg` varchar(50) DEFAULT 'public\/flash\/space\/Pulley.swf' not null COMMENT 'Flash背景风格',
  `addTime` TIMESTAMP DEFAULT NOW() not null COMMENT '创建时间',
  `callPurview` varchar(1) default '1' not null COMMENT '访问权限 0不允许 1允许全部人 2允许好友',
  unique key(spaceID)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户空间表';

-- ----------------------------
-- Table structure for space_visitor
-- ----------------------------
CREATE TABLE IF NOT EXISTS `space_visitor` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '编号',
  `visitorID` int(10) NOT NULL COMMENT '访客编号',
  `userID` int(10) NOT NULL COMMENT '用户编号',
  `spaceID` int(10) NOT NULL COMMENT '空间编号',
  `count` int(20) NOT NULL COMMENT '访问次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='空间访客表';

-- ----------------------------
-- Table structure for user_custom
-- ----------------------------
CREATE TABLE IF NOT EXISTS `user_custom` (
  `userID` int(10) NOT NULL COMMENT '用户编号',
  `theme` varchar(50) NOT NULL DEFAULT 'public\/theme\/Default.css' COMMENT '主题设置',
  `priateSet` int(5) NOT NULL DEFAULT '0' COMMENT '隐私设置',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户自定义网站表' COMMENT='用户自定义表';

-- Common Table End
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- User Table Start

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
CREATE TABLE IF NOT EXISTS administrator(
  adminID int(5) AUTO_INCREMENT COMMENT '管理员编号',
  nickName varchar(20) COMMENT '昵称',
  password varchar(20) not null COMMENT '用户密码',
  regTime varchar(15) not null COMMENT '注册时间',
  lastTimeOnline varchar(15) COMMENT '上次登录时间',
  statue int(1) not null COMMENT '状态 1为登录 0为下线',
  primary key(adminID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员信息表';

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
CREATE TABLE IF NOT EXISTS user_Info(
  userID int(10) AUTO_INCREMENT COMMENT '用户编号 PK Identity(1,1)',
  nickName varchar(20) COMMENT '昵称',
  password varchar(50) not null COMMENT '用户密码',
  regTime TIMESTAMP DEFAULT NOW() COMMENT '注册时间',
  lastTimeOnline varchar(15) COMMENT '上次登录时间',
  statue int(2) COMMENT '状态 1为登录 0为下线 3正常 3为冻结',
  photo varchar(100) DEFAULT 'public\/image\/common\/default_Avatar.png' COMMENT '头像地址',
  priateSet varchar(5) COMMENT '隐私设置',
  /*基本信息*/
  realName varchar(20) not null COMMENT '真实姓名',
  sex varchar(5) not null COMMENT '性别',
  birthday DateTime not null COMMENT '生日',
  bloodType varchar(2) COMMENT '血型',
  about varchar(100) COMMENT '简介',
  status int(3) COMMENT '目前身份 1为学生 2为工作者 3为其他',
  /*联系信息*/
  location varchar(20) not null COMMENT '居住地址',
  homeCity varchar(20) COMMENT '家乡',
  email varchar(25) not null COMMENT '电子邮件',
  QQ varchar(12) COMMENT 'QQ',
  MSN varchar(30) COMMENT 'MSN',
  primary key(userID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户信息表';

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
CREATE TABLE IF NOT EXISTS user_WorksInfo(
  workID int(10) not null AUTO_INCREMENT COMMENT '工作编号 PK Identity(1,1)',
  userID int(10) not null COMMENT '用户编号 FK UserInfo(UserID)',
  companyName varchar(30) COMMENT '工作单位',
  departmentName varchar(20) COMMENT '部门名称',
  joinTime DateTime COMMENT '加入时间',
  departureTime DateTime null COMMENT '离职时间',
  primary key(workID),
  unique key(userID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户工作情况信息表';

-- ----------------------------
-- Table structure for administrator
-- ----------------------------
CREATE TABLE IF NOT EXISTS user_SchoolInfo(
  schoolID int(10) COMMENT '编号 PK Identity(1,1)',
  userID int(10) null COMMENT '用户编号 FK UserInfo(UserID)',
  schoolType varchar(10) null COMMENT '毕业学校类型',
  schoolName varchar(20) null COMMENT '学校名称',
  grade varchar(20) null COMMENT '院系',
  classes varchar(20) null COMMENT '班级',
  admissionTime DateTime null COMMENT '入学时间',
  primary key(schoolID),
  unique key(userID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户教育情况信息表';

/*创建用户信息视图*/
/*
create view user_view as select user_Info.*,
    user_WorksInfo.workID,user_WorksInfo.CompanyName,user_WorksInfo.departmentName,user_WorksInfo.joinTime,user_WorksInfo.departureTime,
    user_SchoolInfo.schoolID,user_SchoolInfo.schoolType,user_SchoolInfo.schoolName,user_SchoolInfo.grade,user_SchoolInfo.classes,user_SchoolInfo.admissionTime
    from user_Info,user_WorksInfo,user_SchoolInfo;
*/

-- User Table End
-- -----------------------------------------------------------------------------


/*好友*******************************************************************************************/

/*用户好友表*/
CREATE TABLE IF NOT EXISTS friends(
  id int(10) not null AUTO_INCREMENT COMMENT '表编号',
  friendID int(10) not null COMMENT '好友编号 PK.FK UserInfo(UserID)',
  userID int(10) not null COMMENT '用户编号 PK.FK UserInfo(UserID)',
  groupID int(10) not null default '1' COMMENT '好友组号',
  friendComment varchar(50) null COMMENT '好友备注',
  primary key(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*好友分组表*/
CREATE TABLE IF NOT EXISTS friendGroup(
  id int(10) not null AUTO_INCREMENT COMMENT '表编号',
  groupID int(10) not null COMMENT '分组编号 1：我的好友',
  userID int(10) not null COMMENT '用户编号 FK UserInfo(userID)',
  groupName varchar(20) not null COMMENT '分组名称',
  primary key(id)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*好友*******************************************************************************************/


/*用户分享模块*******************************************************************************************/

/*心情记录表*/
CREATE TABLE IF NOT EXISTS record_Info(
  recordID int(10) not null AUTO_INCREMENT COMMENT '心情编号',
  emotion int(10) not null COMMENT '目前情感 1开心 2伤心 3郁闷 4愤怒',
  content varchar(50) not null COMMENT '内容',
  userID int(10) not null COMMENT '发表人编号',
  addTime TIMESTAMP default NOW() COMMENT '发表时间',
  primary key(recordID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*日记信息表*/
CREATE TABLE IF NOT EXISTS diary_Info(
  diaryID int(10) not null AUTO_INCREMENT COMMENT '日记编号',
  title varchar(40) COMMENT '文章标题',
  content varchar(16000) COMMENT '文章内容',
  userID int(10) COMMENT '发表人ID',
  addTime TIMESTAMP DEFAULT NOW() COMMENT '发表时间',
  typeID int(3) default '1' COMMENT '分类编号',
  callPurview varchar(1) not null COMMENT '访问权限 0不允许 1允许全部人 2允许好友',
  forwardingNumber int(10) COMMENT '转发次数',
  comments int(10) COMMENT '评论次数',
  primary key(diaryID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create view diary_View as select * from diary_Info,diary_Comment;

/*文章信息表*/
CREATE TABLE IF NOT EXISTS article(
  articleID int(10) not null AUTO_INCREMENT COMMENT '文章编号',
  type varchar(5) COMMENT '文章类型 日志diary 帖子invitation 心情mood ',
  title varchar(20) COMMENT '文章标题',
  content varchar(10000) COMMENT '文章正文',
  userID int(10) COMMENT '发表人ID',
  addTime varchar(15) COMMENT '发表时间',
  forwardingNumber int(10) COMMENT '转发次数',
  comments int(10) COMMENT '评论次数',
  primary key(articleID),
  unique key(userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

--CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON UPDATE CASCADEe

/*文章收藏转发表*/
CREATE TABLE IF NOT EXISTS articleAdvanced(
  articleID int(10) not null AUTO_INCREMENT COMMENT '文章编号',
  userID int(10) not null COMMENT '用户编号',
  userCollect enum("0") not null COMMENT '用户收藏文章',
  userForwarding enum("0") not null COMMENT '用户转发文章',
  primary key()，
  unique key(articleID,userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


/*照片信息表*/
CREATE TABLE IF NOT EXISTS image_Info(
  imageID int(10) not null AUTO_INCREMENT COMMENT '照片编号 PK Identity(1,1)',
  imageName varchar(50) not null COMMENT '照片名称 规则 Image+ I++',
  userID int(10) null null COMMENT '拥有者编号',
  addTime TIMESTAMP DEFAULT NOW() not null COMMENT '创建时间',
  specialID int(10) null COMMENT '专辑编号',
  imagePath varchar(100) not null COMMENT '照片地址',
  imageRemark varchar(100) null COMMENT '照片描述',
  primary key(imageID),
  unique key(specialID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*照片专辑表*/
CREATE TABLE IF NOT EXISTS image_SpecialInfo(
  specialID int(10) not null AUTO_INCREMENT COMMENT '专辑标号 PK Identity(1,1)',
  specialName varchar(10) not null COMMENT '专辑名称 规则：相册+1',
  imagePath varchar(50) not null COMMENT '封面路径',
  addTime TIMESTAMP DEFAULT NOW() COMMENT '创建时间',
  modifyTime DateTime not null COMMENT '修改时间',
  userID int(10) not null COMMENT '用户编号',
  specialRemark varchar(100) null COMMENT '专辑描述',
  callPurview varchar(1) not null COMMENT '访问权限',
  primary key(id),
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

create view image_view as select * from image_Info,image_Comment;

/*音乐信息表*/
CREATE TABLE IF NOT EXISTS music_Info(
  musicID int(10) not null AUTO_INCREMENT COMMENT '音乐编号 PK Identity(1,1)',
  musicName varchar(50) not null COMMENT '音乐名称 规则 music+ I++',
  userID int(10) null null COMMENT '拥有者编号',
  addTime TIMESTAMP DEFAULT NOW() COMMENT '创建时间',
  specialID int(10) null COMMENT '专辑编号',
  musicPath varchar(100) not null COMMENT '音乐地址',
  musicRemark varchar(100) null COMMENT '音乐描述',
  primary key(musicID),
  unique key(specialID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*音乐专辑表*/
CREATE TABLE IF NOT EXISTS music_SpecialInfo(
  specialID int(10) not null AUTO_INCREMENT COMMENT '专辑标号 PK Identity(1,1)',
  specialName varchar(10) not null COMMENT '专辑名称 规则：专辑+1',
  addTime TIMESTAMP DEFAULT NOW() COMMENT '创建时间',
  modifyTime DateTime not null COMMENT '修改时间',
  userID int(10) not null COMMENT '用户编号',
  specialRemark varchar(100) null COMMENT '专辑描述',
  callPurview varchar(1) not null COMMENT '访问权限',
  primary key(specialID),
  unique key(userID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

create view image_view as select * from music_Info,music_Comment;

/*分享评论表*/
CREATE TABLE IF NOT EXISTS share_comment(
  commentID int(10) not null AUTO_INCREMENT COMMENT '评论编号',
  shareType int(10) not null COMMENT '分享类型 1心情 2日记 3文章 4照片 5音乐 6视频 7文件',
  shareUserID int(10) not null COMMENT '分享者编号',
  reviewersID int(10) not null COMMENT '评论者编号',
  shareID int(10) not null COMMENT '被评论的分享编号',
  content varchar(200) not null COMMENT '评论内容',
  addTime TIMESTAMP DEFAULT NOW() not null COMMENT '评论时间',
  primary key(commentID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*用户分享模块*******************************************************************************************/


/*用户互动模块*******************************************************************************************/

/*用户关注表*/
create table IF NOT EXITST user_Attention(
  attentionID int(10) not null AUTO_INCREMENT COMMENT '关注编号',
  userID int(10) not null COMMENT '用户编号',
  followersID int(10) not null COMMENT '被关注者编号',
  attentionTime DateTime not null COMMENT '关注时间',
  primary key(attentionID),
  unique key(userID)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*用户动态表*/
create table user_Dynamic(
  dynamicID int(20) not null AUTO_INCREMENT COMMENT '动态编号',
  userID int(10) not null COMMENT '用户编号',
  actionType int(2) not null COMMENT '用户动作： 1分享心情 2分享日记 3分享文章 4分享照片 5分享音乐 6分享视频 7分享文件 8添加好友 9添加关注 10新人报道 11分享评论 ',
  actionObject varchar(200) not null COMMENT '动作对象 用户之间存用户名 分享之间存标题',
  actionTime TIMESTAMP DEFAULT NOW() not null COMMENT '动作时间',
  primary key(dynamicID)
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;


/*活动表*/
CREATE TABLE IF NOT EXISTS activity_Info(
  activityID int(10) not null AUTO_INCREMENT COMMENT '活动编号',
  userID int(10) not null COMMENT '发起者编号',
  time_Create DateTime not null COMMENT '创建时间',
  time_End DateTime not null COMMENT '结束时间',
  address varchar(50) not null COMMENT '活动地址',
  states int(1) not null COMMENT '当前活动状态',
  topic varchar(50) not null COMMENT '活动主题',
  content varchar(512) null COMMENT '活动描述',
  num_Max int(8) not null COMMENT '最大人数',
  num_Current int(8) not null COMMENT '当前参加人数',
  primary key(activityID),
  unique key(userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*文章动态表
drop table if exites article_New;
create table IF NOT EXITST article_New(
  newID int(10) not null AUTO_INCREMENT COMMENT '动态编号',
  userID int(10) not null COMMENT '发布者编号',
  addTime DateTime not null COMMENT '发布时间',
  content int(10) null COMMENT '文本内容',
  pictruePath varchar(50) null COMMENT '图片地址',
  videoPath varchar(50) null COMMENT '视频地址',
  num_Comment int(8) not null COMMENT '评论人数',
  num_Share int(8) not null COMMENT '分享人数',
  type int(2) not null COMMENT '动态类型 0:日记 1:图片 2:视频',
  primary key(newID),
  unique key(userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

/*用户互动*******************************************************************************************/


/*已放弃的数据库*******************************************************************************************/
/*
日记评论表
CREATE TABLE IF NOT EXISTS diary_Comment(
  commentID int(10) not null AUTO_INCREMENT COMMENT '评论编号',
  diaryID int(10) not null COMMENT '日记编号',
  observerID int(10) not null COMMENT '评论者编号',
  content varchar(200) not null COMMENT '评论内容',
  primary key(commentID),
  unique key(diaryID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
文章评论表
CREATE TABLE IF NOT EXISTS article_Comment(
  commentID int(10) not null AUTO_INCREMENT COMMENT '评论编号',
  articleID int(10) not null COMMENT '文章编号',
  byCommentID int(10) not null COMMENT '被评论者编号',
  observerID int(10) not null COMMENT '评论者编号',
  content varchar(200) not null COMMENT '评论内容',
  primary key(commentID),
  unique key(articleID,observerID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
照片评论表
CREATE TABLE IF NOT EXISTS image_Comment(
  commentID int(10) not null AUTO_INCREMENT COMMENT '评论编号',
  imageID int(10) not null COMMENT '照片编号',
  observerID int(10) not null COMMENT '评论者编号',
  content varchar(200) not null COMMENT '评论内容',
  primary key(commentID),
  unique key(imageID,userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
音乐评论表
CREATE TABLE IF NOT EXISTS music_Comment(
  commentID int(10) not null AUTO_INCREMENT COMMENT '评论编号',
  musicID int(10) not null COMMENT '音乐编号',
  observerID int(10) not null COMMENT '评论者编号',
  content varchar(200) not null COMMENT '评论内容',
  primary key(commentID),
  unique key(musicID,userID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
