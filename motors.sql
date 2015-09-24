-- phpMyAdmin SQL Dump
-- version 3.3.7
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 07 月 14 日 09:25
-- 服务器版本: 5.1.69
-- PHP 版本: 5.2.17p1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `motors`
--

-- --------------------------------------------------------

--
-- 表的结构 `wl_area`
--

CREATE TABLE IF NOT EXISTS `wl_area` (
  `areaid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `areaname` varchar(50) NOT NULL DEFAULT '',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `arrparentid` varchar(255) NOT NULL DEFAULT '',
  `child` tinyint(1) NOT NULL DEFAULT '0',
  `arrchildid` text,
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`areaid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='地区' AUTO_INCREMENT=110 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_banword`
--

CREATE TABLE IF NOT EXISTS `wl_banword` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `replacefrom` varchar(255) NOT NULL DEFAULT '' COMMENT '查找',
  `replaceto` varchar(255) NOT NULL DEFAULT '' COMMENT '替换',
  `deny` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否拦截',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='词语过滤' AUTO_INCREMENT=356 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_category`
--

CREATE TABLE IF NOT EXISTS `wl_category` (
  `catid` int(10) NOT NULL AUTO_INCREMENT,
  `catname` varchar(50) NOT NULL DEFAULT '',
  `catdir` varchar(50) NOT NULL DEFAULT '',
  `style` varchar(50) NOT NULL DEFAULT '',
  `linkurl` varchar(255) NOT NULL DEFAULT '',
  `letter` varchar(1) NOT NULL DEFAULT '',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `item` bigint(20) NOT NULL DEFAULT '0',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `arrparentid` varchar(255) NOT NULL DEFAULT '',
  `child` tinyint(1) NOT NULL DEFAULT '0',
  `arrchildid` text NOT NULL,
  `listorder` int(10) NOT NULL DEFAULT '0',
  `collect` smallint(6) NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`catid`),
  KEY `catname` (`catname`),
  KEY `item` (`parentid`,`item`),
  KEY `catid` (`catid`,`item`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2197 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_category_default_option`
--

CREATE TABLE IF NOT EXISTS `wl_category_default_option` (
  `id` bigint(20) NOT NULL DEFAULT '0' COMMENT '手动生成ID',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '默认的属性值(categroy表默认属性值的分表)',
  `catid` int(10) NOT NULL DEFAULT '0' COMMENT '属性值对应的分类ID',
  `num` int(10) NOT NULL DEFAULT '0' COMMENT '分类下属性对应的产品个数',
  `oid` int(10) NOT NULL DEFAULT '0' COMMENT '属性值对应的oid',
  KEY `id` (`id`),
  KEY `value_2` (`value`,`catid`,`oid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wl_category_option`
--

CREATE TABLE IF NOT EXISTS `wl_category_option` (
  `oid` bigint(20) NOT NULL AUTO_INCREMENT,
  `catid` int(10) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `required` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `name` varchar(50) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  `listorder` int(10) NOT NULL DEFAULT '0',
  `item` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`oid`),
  KEY `catid` (`name`,`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=368123 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_category_value`
--

CREATE TABLE IF NOT EXISTS `wl_category_value` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `oid` bigint(20) NOT NULL DEFAULT '0',
  `itemid` bigint(20) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  `did` bigint(20) NOT NULL DEFAULT '0' COMMENT '对应default_option表中的 id',
  `catid` int(10) NOT NULL DEFAULT '0' COMMENT 'category表的catid',
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`,`itemid`),
  KEY `oid_2` (`itemid`,`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11931693 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_check_news`
--

CREATE TABLE IF NOT EXISTS `wl_check_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cmd5` char(32) NOT NULL DEFAULT '',
  `nid` int(11) NOT NULL COMMENT 'news_id',
  PRIMARY KEY (`id`),
  KEY `cmd5` (`cmd5`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='检测news数据表' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_check_sell`
--

CREATE TABLE IF NOT EXISTS `wl_check_sell` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cmd5` char(32) NOT NULL DEFAULT '',
  `sid` int(11) NOT NULL COMMENT 'sell_id',
  PRIMARY KEY (`id`),
  KEY `cmd5` (`cmd5`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='检测sell数据表' AUTO_INCREMENT=837281 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_comment`
--

CREATE TABLE IF NOT EXISTS `wl_comment` (
  `itemid` bigint(20) NOT NULL AUTO_INCREMENT,
  `itemid_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '暂时对应sell表的 ID',
  `itemid_title` varchar(255) NOT NULL DEFAULT '' COMMENT '暂时对应sell表的 title',
  `itemid_linkurl` varchar(255) NOT NULL DEFAULT '' COMMENT '暂时对应sell表的\r\nlinkurl ',
  `itemid_username` varchar(255) NOT NULL DEFAULT '' COMMENT '暂时对应sell表的\r\nusername',
  `star` tinyint(4) NOT NULL DEFAULT '0' COMMENT '评价',
  `content` text NOT NULL COMMENT '评论内容',
  `qid` bigint(20) NOT NULL DEFAULT '0' COMMENT '引用ID',
  `quotation` text NOT NULL COMMENT '引用内容',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `hidden` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否匿名评论',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '评论时间',
  `quote` int(11) NOT NULL DEFAULT '0' COMMENT '引用数量',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '评论状态 是否已经审核',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_comment_stat`
--

CREATE TABLE IF NOT EXISTS `wl_comment_stat` (
  `sid` bigint(20) NOT NULL AUTO_INCREMENT,
  `itemid` bigint(20) NOT NULL DEFAULT '0' COMMENT '暂时对应sell表中的itemid',
  `comment` int(11) NOT NULL DEFAULT '0' COMMENT '评论数',
  `star1` int(11) NOT NULL DEFAULT '0' COMMENT '评星等级 好评',
  `star2` int(11) NOT NULL DEFAULT '0' COMMENT '评星等级 中评',
  `star3` int(11) NOT NULL DEFAULT '0' COMMENT '评星等级 差评',
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_company`
--

CREATE TABLE IF NOT EXISTS `wl_company` (
  `userid` bigint(20) NOT NULL COMMENT '用户ID',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '公司认证',
  `groupid` smallint(4) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `company` varchar(150) NOT NULL DEFAULT '' COMMENT '公司名称',
  `vip` smallint(2) NOT NULL DEFAULT '0' COMMENT 'Vip的指数',
  `vipt` smallint(2) NOT NULL DEFAULT '0' COMMENT 'VIP指数理论值',
  `vipr` smallint(2) NOT NULL DEFAULT '0' COMMENT 'VIP修正理论值',
  `ctype` varchar(100) NOT NULL DEFAULT '' COMMENT '公司类型 个人或者企业单位',
  `catid` int(11) NOT NULL DEFAULT '0' COMMENT '公司行业分类ID',
  `areaid` int(11) NOT NULL DEFAULT '0' COMMENT '地区ID',
  `mode` varchar(100) NOT NULL DEFAULT '' COMMENT '经营模式',
  `capital` float NOT NULL DEFAULT '0' COMMENT '注册资本',
  `regunit` varchar(15) NOT NULL DEFAULT '' COMMENT '注册资本货币单位',
  `size` varchar(100) NOT NULL DEFAULT '' COMMENT '公司规模 员工人数',
  `regyear` varchar(4) NOT NULL DEFAULT '' COMMENT '注册年份',
  `regcity` varchar(60) NOT NULL DEFAULT '' COMMENT '注册城市',
  `business` varchar(255) NOT NULL DEFAULT '' COMMENT '主要经营范围',
  `telephone` varchar(50) NOT NULL DEFAULT '' COMMENT '电话',
  `fax` varchar(50) NOT NULL DEFAULT '' COMMENT '传真',
  `mail` varchar(50) NOT NULL DEFAULT '' COMMENT '公司的mail 对外公开',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '公司地址',
  `zipcode` varchar(20) NOT NULL DEFAULT '' COMMENT '邮编',
  `homepage` varchar(255) NOT NULL DEFAULT '' COMMENT '公司主页',
  `fromtime` int(11) NOT NULL DEFAULT '0' COMMENT 'VIP开始时间',
  `totime` int(11) NOT NULL DEFAULT '0' COMMENT 'VIP过期时间',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '公司 Logo图或形象图',
  `introduce` varchar(255) NOT NULL DEFAULT '' COMMENT '公司简要介绍 ',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '公司访问次数',
  `linkurl` varchar(255) NOT NULL DEFAULT '' COMMENT '公司首页地址一般伪静态时使用',
  `markets` varchar(255) DEFAULT '' COMMENT '主要市场',
  `volume` varchar(100) DEFAULT '' COMMENT '年销售额',
  `export` varchar(100) DEFAULT '' COMMENT '出口百分比',
  `icp` varchar(100) DEFAULT '' COMMENT '管理体系认证',
  `regno` varchar(100) DEFAULT '' COMMENT '注册号',
  `authority` varchar(100) DEFAULT '' COMMENT '发证机关',
  PRIMARY KEY (`userid`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wl_company_data`
--

CREATE TABLE IF NOT EXISTS `wl_company_data` (
  `userid` bigint(20) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wl_comurl`
--

CREATE TABLE IF NOT EXISTS `wl_comurl` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `company` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='公司url表';

-- --------------------------------------------------------

--
-- 表的结构 `wl_friend`
--

CREATE TABLE IF NOT EXISTS `wl_friend` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `truename` varchar(100) NOT NULL,
  `typeid` int(11) NOT NULL,
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_friend_type`
--

CREATE TABLE IF NOT EXISTS `wl_friend_type` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tname` varchar(100) NOT NULL,
  `listorder` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_inquiry`
--

CREATE TABLE IF NOT EXISTS `wl_inquiry` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `touser` varchar(30) NOT NULL,
  `fromuser` varchar(30) DEFAULT '',
  `company` varchar(100) NOT NULL,
  `country` varchar(50) DEFAULT '',
  `truename` varchar(30) NOT NULL,
  `telephone` varchar(20) DEFAULT '',
  `mobile` varchar(20) DEFAULT '0',
  `email` varchar(50) DEFAULT '',
  `sid` bigint(20) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  `postdate` int(11) NOT NULL,
  `status` smallint(1) NOT NULL DEFAULT '0',
  `pid` bigint(20) NOT NULL DEFAULT '0' COMMENT '询盘父ID',
  PRIMARY KEY (`id`),
  KEY `usrename` (`touser`),
  KEY `sid` (`sid`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=749 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_inquiry_data`
--

CREATE TABLE IF NOT EXISTS `wl_inquiry_data` (
  `id` int(11) unsigned NOT NULL,
  `message` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wl_inquiry_notice`
--

CREATE TABLE IF NOT EXISTS `wl_inquiry_notice` (
  `id` int(11) unsigned NOT NULL COMMENT '对应询单id',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '会员名',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `note` text NOT NULL COMMENT '备注',
  `status` smallint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='询单通知';

-- --------------------------------------------------------

--
-- 表的结构 `wl_ip`
--

CREATE TABLE IF NOT EXISTS `wl_ip` (
  `StartIP` varchar(20) DEFAULT '',
  `EndIP` varchar(20) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL,
  `Local` varchar(50) DEFAULT NULL,
  KEY `IP` (`StartIP`,`EndIP`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wl_member`
--

CREATE TABLE IF NOT EXISTS `wl_member` (
  `userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `company` varchar(150) NOT NULL DEFAULT '' COMMENT '公司名称',
  `passport` varchar(30) NOT NULL DEFAULT '' COMMENT '通行证',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `payword` varchar(32) NOT NULL DEFAULT '' COMMENT '支付密码',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '用户email 不公开的，用于邮件验证和接收系统邮件',
  `message` smallint(6) NOT NULL DEFAULT '0' COMMENT '用户站内（新）短信数',
  `online` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户是否在线 1为在线 0为离线或隐身',
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别',
  `truename` varchar(50) NOT NULL DEFAULT '' COMMENT '姓名',
  `mobile` varchar(30) NOT NULL DEFAULT '' COMMENT '移动电话',
  `qq` varchar(50) NOT NULL DEFAULT '',
  `ali` varchar(30) NOT NULL DEFAULT '' COMMENT '阿里旺旺',
  `skype` varchar(30) NOT NULL DEFAULT '',
  `department` varchar(30) NOT NULL DEFAULT '' COMMENT '部门',
  `career` varchar(30) NOT NULL DEFAULT '' COMMENT '职位',
  `admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '否为管理员',
  `groupid` smallint(4) DEFAULT '6' COMMENT '当前用户组ID',
  `regid` smallint(4) DEFAULT '6' COMMENT '注册用户组ID',
  `areaid` int(11) NOT NULL DEFAULT '0' COMMENT '区域ID',
  `credit` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `edittime` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `regip` varchar(50) NOT NULL DEFAULT '' COMMENT '注册IP',
  `regtime` int(11) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `loginip` varchar(50) NOT NULL DEFAULT '' COMMENT '登入IP',
  `logintime` int(11) NOT NULL DEFAULT '0' COMMENT '登入时间',
  `logintimes` int(11) NOT NULL DEFAULT '0' COMMENT '登入次数',
  `black` varchar(255) NOT NULL DEFAULT '' COMMENT '站内信息黑名单',
  `send` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否允许站内信转发到认证的邮箱 ',
  `auth` varchar(32) NOT NULL DEFAULT '' COMMENT '验证码',
  `authvalue` varchar(100) NOT NULL DEFAULT '' COMMENT '验证内容说明',
  `authtime` int(11) NOT NULL DEFAULT '0' COMMENT '验证时间',
  `vmail` tinyint(4) NOT NULL DEFAULT '0' COMMENT '邮件认证',
  `vtruename` tinyint(4) NOT NULL DEFAULT '0' COMMENT '实名认证',
  `vcompany` tinyint(4) NOT NULL DEFAULT '0' COMMENT '公司认证',
  `inviter` varchar(30) NOT NULL DEFAULT '' COMMENT '推荐人',
  `lastip` varchar(50) NOT NULL DEFAULT '' COMMENT '上一次登入IP',
  `lasttime` int(11) NOT NULL DEFAULT '0' COMMENT '上一次登入时间',
  PRIMARY KEY (`userid`),
  KEY `company` (`company`),
  KEY `regtime` (`regtime`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15767 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_member_group`
--

CREATE TABLE IF NOT EXISTS `wl_member_group` (
  `groupid` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `groupname` varchar(50) NOT NULL DEFAULT '',
  `vip` smallint(2) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(4) unsigned NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员组' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_message`
--

CREATE TABLE IF NOT EXISTS `wl_message` (
  `mid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `style` varchar(50) NOT NULL DEFAULT '',
  `typeid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `fromuser` varchar(30) NOT NULL DEFAULT '',
  `touser` varchar(160) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `isread` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `issend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `feedback` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `auth` varchar(32) NOT NULL DEFAULT '' COMMENT '验证信息',
  `iid` bigint(20) NOT NULL DEFAULT '0' COMMENT '对应询盘表的ID',
  `isdel_r` smallint(1) unsigned NOT NULL DEFAULT '0' COMMENT '收件人是否删除 0为未\r\n删除,1为已删除',
  `isdel_s` smallint(1) unsigned NOT NULL DEFAULT '0' COMMENT '发件人是否删除 0为未\r\n删除,1为已删除',
  PRIMARY KEY (`mid`),
  KEY `touser` (`touser`),
  KEY `typeid` (`typeid`,`fromuser`,`touser`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='站内信件' AUTO_INCREMENT=773 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_news`
--

CREATE TABLE IF NOT EXISTS `wl_news` (
  `itemid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `areaid` int(10) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `style` varchar(50) NOT NULL DEFAULT '',
  `fee` float NOT NULL DEFAULT '0',
  `subtitle` text NOT NULL,
  `introduce` varchar(255) NOT NULL DEFAULT '',
  `tag` varchar(100) NOT NULL DEFAULT '',
  `keyword` varchar(255) NOT NULL DEFAULT '',
  `pptword` text NOT NULL COMMENT '产品属性',
  `author` varchar(50) NOT NULL DEFAULT '',
  `source` varchar(30) NOT NULL DEFAULT '',
  `fromurl` varchar(255) NOT NULL DEFAULT '',
  `voteid` varchar(100) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL DEFAULT '',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `editor` varchar(30) NOT NULL DEFAULT '',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0',
  `totime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '过期时间',
  `ip` varchar(50) NOT NULL,
  `template` varchar(30) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `linkurl` varchar(255) NOT NULL DEFAULT '',
  `filepath` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`itemid`),
  KEY `addtime` (`addtime`),
  KEY `username` (`username`),
  KEY `status` (`status`),
  KEY `hits` (`hits`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='资讯' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_news_data`
--

CREATE TABLE IF NOT EXISTS `wl_news_data` (
  `itemid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='资讯内容';

-- --------------------------------------------------------

--
-- 表的结构 `wl_page_set`
--

CREATE TABLE IF NOT EXISTS `wl_page_set` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `mode` varchar(50) NOT NULL DEFAULT '' COMMENT '模块',
  `in_page` varchar(50) NOT NULL DEFAULT '' COMMENT '所在页面',
  `num` varchar(10) NOT NULL DEFAULT '' COMMENT '显示数目',
  `conditions` varchar(100) NOT NULL DEFAULT '' COMMENT '查询条件',
  `sort` varchar(100) NOT NULL DEFAULT '' COMMENT '排序',
  `fields` varchar(255) NOT NULL DEFAULT '' COMMENT '显示字段',
  `mlength` tinyint(1) DEFAULT '0' COMMENT 'sphinx匹配度',
  `edittime` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `editip` varchar(20) NOT NULL DEFAULT '' COMMENT '修改IP',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '修改者',
  PRIMARY KEY (`id`),
  KEY `mode` (`mode`),
  KEY `in_page` (`in_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_password_find`
--

CREATE TABLE IF NOT EXISTS `wl_password_find` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '会员邮箱',
  `auth` varchar(32) NOT NULL DEFAULT '' COMMENT '随机md5值',
  `totime` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_sell`
--

CREATE TABLE IF NOT EXISTS `wl_sell` (
  `itemid` bigint(20) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0' COMMENT '所属分类ID',
  `mycatid` bigint(20) NOT NULL DEFAULT '0' COMMENT '自定义分类ID',
  `typeid` smallint(2) NOT NULL DEFAULT '0' COMMENT '供应类型',
  `areaid` smallint(6) NOT NULL DEFAULT '0' COMMENT '地区ID',
  `level` tinyint(4) NOT NULL DEFAULT '0' COMMENT '推荐等级 1 表示推荐',
  `elite` tinyint(4) NOT NULL DEFAULT '0' COMMENT '公司首页推荐',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `style` varchar(50) NOT NULL DEFAULT '' COMMENT '标题颜色',
  `fee` float NOT NULL DEFAULT '0' COMMENT '收费积分',
  `introduce` varchar(255) NOT NULL DEFAULT '' COMMENT '内容简介',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '产品型号',
  `standard` varchar(100) NOT NULL DEFAULT '' COMMENT '产品规格',
  `brand` varchar(100) NOT NULL DEFAULT '' COMMENT '产品品牌',
  `unit` varchar(30) NOT NULL DEFAULT '' COMMENT '产品单位',
  `minprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最小产品价格',
  `maxprice` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '最大产品价格',
  `currency` varchar(15) NOT NULL DEFAULT '' COMMENT '货币单位',
  `minamount` float NOT NULL DEFAULT '0' COMMENT '最小起订量',
  `amount` float NOT NULL DEFAULT '0' COMMENT '供货总量',
  `days` smallint(3) NOT NULL DEFAULT '0' COMMENT '发货时间',
  `keyword` varchar(255) NOT NULL COMMENT '产品关键字',
  `hits` int(11) NOT NULL DEFAULT '0' COMMENT '访问次数',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '产品图片',
  `thumb1` varchar(255) NOT NULL,
  `thumb2` varchar(255) NOT NULL,
  `pptword` text NOT NULL COMMENT '产品属性',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `groupid` int(11) NOT NULL DEFAULT '0' COMMENT '用户组ID',
  `company` varchar(150) NOT NULL DEFAULT '' COMMENT '公司名称',
  `vip` smallint(2) NOT NULL DEFAULT '0' COMMENT 'vip指数',
  `validated` tinyint(4) NOT NULL DEFAULT '0' COMMENT '公司是否认证 ',
  `truename` varchar(50) NOT NULL DEFAULT '' COMMENT '联系人',
  `telephone` varchar(50) NOT NULL DEFAULT '' COMMENT '电话',
  `mobile` varchar(30) NOT NULL DEFAULT '' COMMENT '移动电话',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '公司地址',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '公司mail',
  `ali` varchar(30) NOT NULL DEFAULT '',
  `totime` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `edittime` int(11) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `editdate` varchar(50) NOT NULL DEFAULT '' COMMENT '修改日期 例如 2013-03-09',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `adddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加日期',
  `ip` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '发布状态',
  `linkurl` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `aliid` bigint(20) NOT NULL DEFAULT '0',
  `add_sitemap` smallint(1) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `elite` (`elite`,`username`),
  KEY `mycatid` (`mycatid`,`username`,`status`),
  KEY `catid` (`catid`,`status`,`itemid`),
  KEY `status` (`status`,`itemid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=837463 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_sell_data`
--

CREATE TABLE IF NOT EXISTS `wl_sell_data` (
  `itemid` bigint(20) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `wl_tagindex`
--

CREATE TABLE IF NOT EXISTS `wl_tagindex` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) NOT NULL COMMENT '关键词',
  `totalcc` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '总访问量',
  `weekcc` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '周访问量',
  `monthcc` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '月访问量',
  `weekup` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '周时间',
  `monthup` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '月时间',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  `byname` char(1) NOT NULL DEFAULT '',
  `catid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属分类ID',
  `note` varchar(30) NOT NULL COMMENT '备注',
  `linkurl` varchar(100) NOT NULL,
  `collect` tinyint(1) NOT NULL DEFAULT '0',
  `item` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `byname` (`byname`),
  KEY `tag` (`tag`),
  KEY `addtime` (`addtime`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14412 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_type`
--

CREATE TABLE IF NOT EXISTS `wl_type` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tname` varchar(100) NOT NULL DEFAULT '',
  `listorder` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`),
  KEY `tname` (`tname`,`userid`),
  KEY `userid` (`userid`),
  KEY `tid` (`tid`,`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37458 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_validate`
--

CREATE TABLE IF NOT EXISTS `wl_validate` (
  `itemid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `type` varchar(30) NOT NULL DEFAULT '' COMMENT '认证类型',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '图片附件',
  `thumb1` varchar(255) NOT NULL DEFAULT '' COMMENT '图片附件1',
  `thumb2` varchar(255) NOT NULL DEFAULT '' COMMENT '图片附件2',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '会员名',
  `addtime` int(10) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `editor` varchar(30) NOT NULL DEFAULT '' COMMENT '编辑',
  `edittime` int(10) NOT NULL DEFAULT '0' COMMENT '修改时间',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT 'ip',
  `status` smallint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='资料认证' AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- 表的结构 `wl_webpage`
--

CREATE TABLE IF NOT EXISTS `wl_webpage` (
  `itemid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(30) NOT NULL DEFAULT '' COMMENT '所属分组',
  `areaid` int(10) unsigned NOT NULL COMMENT '地区ID',
  `level` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '级别',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `style` varchar(50) NOT NULL DEFAULT '' COMMENT '颜色',
  `content` mediumtext NOT NULL COMMENT '内容',
  `seo_title` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `seo_keywords` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO关键词',
  `seo_description` varchar(255) NOT NULL DEFAULT '' COMMENT 'SEO描述',
  `editor` varchar(30) NOT NULL DEFAULT '' COMMENT '编辑',
  `edittime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `listorder` smallint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  `hits` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '点击次数',
  `islink` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '外部链接',
  `linkurl` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `domain` varchar(255) NOT NULL COMMENT '绑定域名',
  `template` varchar(30) NOT NULL DEFAULT '' COMMENT '模板',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单网页' AUTO_INCREMENT=1 ;
