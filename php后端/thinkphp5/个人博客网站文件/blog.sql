-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 09 月 03 日 12:24
-- 服务器版本: 5.6.40
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `blog`
--

-- --------------------------------------------------------

--
-- 表的结构 `swe`
--

CREATE TABLE IF NOT EXISTS `swe` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `swe`
--

INSERT INTO `swe` (`id`, `name`) VALUES
(1, '24'),
(2, '34');

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

CREATE TABLE IF NOT EXISTS `tp_admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `tp_admin`
--

INSERT INTO `tp_admin` (`id`, `username`, `password`) VALUES
(1, 'SWE', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'SWE16081', 'a1a517a8e7a9427a06c30b5d8f9ac30e'),
(7, 'werght', '3e55c1aca37ac5bbc9fc6779dddc353c'),
(11, 'ewqrt', '76d80224611fc919a5d54f0ff9fba446'),
(13, 'uuu', 'd41d8cd98f00b204e9800998ecf8427e'),
(16, '123', '202cb962ac59075b964b07152d234b70'),
(17, '12345', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- 表的结构 `tp_article`
--

CREATE TABLE IF NOT EXISTS `tp_article` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `author` varchar(30) NOT NULL COMMENT '作者',
  `desc` varchar(255) NOT NULL COMMENT '文章简介',
  `keywords` varchar(255) NOT NULL COMMENT '文章关键词',
  `content` text NOT NULL COMMENT '文章内容',
  `pic` varchar(100) NOT NULL COMMENT '缩略图',
  `click` int(10) NOT NULL DEFAULT '0' COMMENT '点击数',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:不推荐1:推荐',
  `time` int(10) NOT NULL COMMENT '发布时间',
  `cateid` mediumint(9) NOT NULL COMMENT '所属栏目',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `tp_article`
--

INSERT INTO `tp_article` (`id`, `title`, `author`, `desc`, `keywords`, `content`, `pic`, `click`, `state`, `time`, `cateid`) VALUES
(24, '下雨天', '李白', '为什么失眠的声音 变得好熟悉沉默的场景 做你的代替陪我等雨停 期待让人越来越沉溺 ', '下雨,这款车,自行车,在c', '<p class="wa-musicsong-lyric-line" style="background-color: transparent; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; margin-bottom: 5px; margin-left: 0px; margin-right: 0px; margin-top: 5px; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; white-space: normal; word-spacing: 0px;"><span style="display: inline !important; float: none; background-color: transparent; color: rgb(0, 0, 0); font-family: sans-serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-decoration: none; text-indent: 0px; text-transform: none; -webkit-text-stroke-width: 0px; word-spacing: 0px;">为什么失眠的声音 变得好熟悉沉默的场景 做你的代替陪我等雨停 期待让人越来越沉溺	</span></p><p class="wa-musicsong-lyric-line">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<br/></p><p class="wa-musicsong-lyric-line"><br/></p><p><br/></p>', '/uploads/20180828\\527186b72d2f580c8f5a270ec8167515.jpeg', 46, 1, 1535524496, 8),
(25, '款丰天', 'wer', 'werw', '下雨,123', '<p>wer</p>', '', 3, 1, 1535534371, 9),
(26, '晴天', '周杰伦', '故事的小黄花 从出生那年就飘着       童年的荡秋千 随记忆一直晃到现在  rui sou sou xi dou xi la         sou la xi xi xi xi la xi la sou ', '晴天,下雨,自行车', '<p class="wa-musicsong-lyric-line">故事的小黄花 从出生那年就飘着 &nbsp; &nbsp; &nbsp; 童年的荡秋千 随记忆一直晃到现在&nbsp; rui sou sou xi dou xi la &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p><p class="wa-musicsong-lyric-line">sou la xi xi xi xi la xi la sou	\r\n</p><p><br/></p>', '/uploads/20180828\\a5e0fb5818687741864658dfdf05c978.jpg', 24, 1, 1535527744, 8),
(27, '阴天', '李白', '还要多久我才能在你身边      等到放晴的那天也许我会比较好一点        从前从前有个人爱你很久        但偏偏风渐渐把距离吹得好  好不容易又能再多爱一天   但故事的最后你好像还是说了拜拜 ', '阴天', '<p class="wa-musicsong-lyric-line"><span style="font-size: 12px;">还要多久我才能在你身边 &nbsp; &nbsp; &nbsp;</span></p><p class="wa-musicsong-lyric-line"><span style="font-size: 12px;">等到放晴的那天也许我会比较好一点 &nbsp; &nbsp; &nbsp; &nbsp;</span></p><p class="wa-musicsong-lyric-line"><span style="font-size: 12px;">从前从前有个人爱你很久 &nbsp; &nbsp; &nbsp; &nbsp;</span></p><p class="wa-musicsong-lyric-line"><span style="font-size: 12px;">但偏偏风渐渐把距离吹得好 &nbsp;</span></p><p class="wa-musicsong-lyric-line"><span style="font-size: 12px;">好不容易又能再多爱一天 &nbsp;&nbsp;</span></p><p class="wa-musicsong-lyric-line"><span style="font-size: 12px;">但故事的最后你好像还是说了拜拜	\r\n</span></p><p><br/></p>', '/uploads/20180828\\760396c81aeeae772d4d0c99ba308cec.png', 4, 1, 1535507377, 8),
(28, '阿萨德', 'asd', 'asd', 'asd', '<p>asd&nbsp;</p>', '/uploads/20180829\\b6ab44bd01ee144520bb9f7ffde28330.png', 1, 1, 1535504741, 10),
(29, '绅士', '薛之谦', '从前从前有个人爱你很久       但偏偏雨渐渐把距离吹得好远          好不容易又能再多爱一天 但故事的最后你好像还是说了吧\r\n', '绅士', '<p class="wa-musicsong-lyric-line">从前从前有个人爱你很久 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p class="wa-musicsong-lyric-line">但偏偏雨渐渐把距离吹得好远 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p class="wa-musicsong-lyric-line">好不容易又能再多爱一天	\r\n</p><p>&nbsp;但故事的最后你好像还是说了吧</p><p><br/></p>', '', 3, 1, 1535507395, 8);

-- --------------------------------------------------------

--
-- 表的结构 `tp_cate`
--

CREATE TABLE IF NOT EXISTS `tp_cate` (
  `cateid` int(10) NOT NULL AUTO_INCREMENT,
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  PRIMARY KEY (`cateid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `tp_cate`
--

INSERT INTO `tp_cate` (`cateid`, `catename`) VALUES
(8, '美食'),
(9, '健身'),
(10, '养生'),
(11, '娱乐'),
(12, '体育'),
(13, '电影');

-- --------------------------------------------------------

--
-- 表的结构 `tp_links`
--

CREATE TABLE IF NOT EXISTS `tp_links` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '链接ID',
  `title` varchar(30) NOT NULL COMMENT '链接标题',
  `url` varchar(60) NOT NULL COMMENT '链接地址',
  `desc` varchar(255) NOT NULL COMMENT '链接说明',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `tp_links`
--

INSERT INTO `tp_links` (`id`, `title`, `url`, `desc`) VALUES
(4, '百度', 'http://www.baidu.com', '百度网2341234'),
(5, 'df', 'dfgb', '');

-- --------------------------------------------------------

--
-- 表的结构 `tp_tags`
--

CREATE TABLE IF NOT EXISTS `tp_tags` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `tagname` varchar(30) NOT NULL COMMENT 'tag标签名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `tp_tags`
--

INSERT INTO `tp_tags` (`id`, `tagname`) VALUES
(2, '电影'),
(3, '音乐'),
(4, '体育');

-- --------------------------------------------------------

--
-- 表的结构 `tp_user`
--

CREATE TABLE IF NOT EXISTS `tp_user` (
  `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(50) NOT NULL COMMENT '昵称',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `birthday` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '生日',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `tp_user`
--

INSERT INTO `tp_user` (`id`, `nickname`, `email`, `birthday`, `status`, `create_time`, `update_time`) VALUES
(1, 'BB', 'liu21st@gmail.com', 226339200, 0, 0, 0),
(2, '流年', 'thinkphp@qq.com', 226339200, 0, 0, 0),
(3, '流年', 'thinkphp@qq.com', 226339200, 0, 0, 0),
(4, '看云', 'kancloud@qq.com', 1427904000, 0, 0, 0),
(5, '看云', 'kancloud@qq.com', 1427904000, 0, 0, 0),
(6, '看云', 'kancloud@qq.com', 1427904000, 0, 0, 0),
(7, '看云', 'kancloud@qq.com', 1427904000, 0, 0, 0),
(8, '看云', 'kancloud@qq.com', 1427904000, 0, 0, 0),
(9, '看云', 'kancloud@qq.com', 1427904000, 0, 0, 0),
(10, '张三', 'zhanghsan@qq.com', 569174400, 0, 0, 0),
(11, '李四', 'lisi@qq.com', 653673600, 0, 0, 0),
(12, '张三', 'zhanghsan@qq.com', 569174400, 0, 0, 0),
(13, '李四', 'lisi@qq.com', 653673600, 0, 0, 0),
(14, '流年', 'thinkphp@qq.com', 226339200, 0, 0, 0),
(15, '流年', 'thinkphp@qq.com', 226339200, 0, 0, 0),
(16, 'thinkphp', 'thinkphp@qq.com', 0, 0, 0, 0),
(17, 'SWE', 'thinkphp@qq.com', 0, 0, 0, 0),
(18, 'SWE', 'thinkphp@qq.com', 0, 0, 0, 0),
(19, '2345', '23454', 2345, 0, 0, 0),
(20, '12', '124', 123, 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
