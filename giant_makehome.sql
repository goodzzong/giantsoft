-- phpMyAdmin SQL Dump
-- version 2.11.5.1
-- http://www.phpmyadmin.net
--
-- 호스트: localhost
-- 처리한 시간: 17-09-13 09:19 
-- 서버 버전: 5.1.45
-- PHP 버전: 5.2.17p1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 데이터베이스: `giant_makehome`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_admin`
--

CREATE TABLE IF NOT EXISTS `cs_admin` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_userid` varchar(30) NOT NULL DEFAULT '',
  `admin_passwd` varchar(30) NOT NULL DEFAULT '',
  `shop_email` varchar(200) NOT NULL DEFAULT '',
  `shop_name` varchar(100) NOT NULL DEFAULT '',
  `shop_domain` varchar(200) NOT NULL DEFAULT '',
  `shop_ceo` varchar(30) NOT NULL DEFAULT '',
  `shop_num` varchar(30) NOT NULL DEFAULT '',
  `shop_tel` varchar(30) NOT NULL,
  `shop_tel2` varchar(30) NOT NULL DEFAULT '',
  `shop_fax` varchar(30) NOT NULL DEFAULT '',
  `shop_phone` varchar(30) NOT NULL DEFAULT '',
  `shop_address` varchar(200) NOT NULL DEFAULT '',
  `shop_license` varchar(100) NOT NULL,
  `pg_company` varchar(30) NOT NULL DEFAULT '',
  `pg_id` varchar(30) NOT NULL DEFAULT '',
  `bank_0_1` varchar(20) NOT NULL DEFAULT '',
  `bank_0_2` varchar(20) NOT NULL DEFAULT '',
  `bank_0_3` varchar(20) NOT NULL DEFAULT '',
  `bank_1_1` varchar(20) NOT NULL DEFAULT '',
  `bank_1_2` varchar(20) NOT NULL DEFAULT '',
  `bank_1_3` varchar(20) NOT NULL DEFAULT '',
  `bank_2_1` varchar(20) NOT NULL DEFAULT '',
  `bank_2_2` varchar(20) NOT NULL DEFAULT '',
  `bank_2_3` varchar(20) NOT NULL DEFAULT '',
  `bank_3_1` varchar(20) NOT NULL DEFAULT '',
  `bank_3_2` varchar(20) NOT NULL DEFAULT '',
  `bank_3_3` varchar(20) NOT NULL DEFAULT '',
  `bank_4_1` varchar(20) NOT NULL DEFAULT '',
  `bank_4_2` varchar(20) NOT NULL DEFAULT '',
  `bank_4_3` varchar(20) NOT NULL DEFAULT '',
  `bank_5_1` varchar(20) NOT NULL DEFAULT '',
  `bank_5_2` varchar(20) NOT NULL DEFAULT '',
  `bank_5_3` varchar(20) NOT NULL DEFAULT '',
  `bank_6_1` varchar(20) NOT NULL DEFAULT '',
  `bank_6_2` varchar(20) NOT NULL DEFAULT '',
  `bank_6_3` varchar(20) NOT NULL DEFAULT '',
  `bank_7_1` varchar(20) NOT NULL DEFAULT '',
  `bank_7_2` varchar(20) NOT NULL DEFAULT '',
  `bank_7_3` varchar(20) NOT NULL DEFAULT '',
  `bank_8_1` varchar(20) NOT NULL DEFAULT '',
  `bank_8_2` varchar(20) NOT NULL DEFAULT '',
  `bank_8_3` varchar(20) NOT NULL DEFAULT '',
  `bank_9_1` varchar(20) NOT NULL DEFAULT '',
  `bank_9_2` varchar(20) NOT NULL DEFAULT '',
  `bank_9_3` varchar(20) NOT NULL DEFAULT '',
  `express_check` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `express_money` int(11) unsigned NOT NULL DEFAULT '0',
  `express_box_money` int(11) unsigned NOT NULL DEFAULT '0',
  `express_free` int(11) unsigned NOT NULL DEFAULT '0',
  `point_basic` float NOT NULL DEFAULT '0',
  `point_register` int(11) unsigned NOT NULL DEFAULT '0',
  `point_use` int(11) unsigned NOT NULL DEFAULT '0',
  `member_check` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `member_invite` int(11) unsigned NOT NULL DEFAULT '0',
  `member_register` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 테이블의 덤프 데이터 `cs_admin`
--

INSERT INTO `cs_admin` (`idx`, `admin_userid`, `admin_passwd`, `shop_email`, `shop_name`, `shop_domain`, `shop_ceo`, `shop_num`, `shop_tel`, `shop_tel2`, `shop_fax`, `shop_phone`, `shop_address`, `shop_license`, `pg_company`, `pg_id`, `bank_0_1`, `bank_0_2`, `bank_0_3`, `bank_1_1`, `bank_1_2`, `bank_1_3`, `bank_2_1`, `bank_2_2`, `bank_2_3`, `bank_3_1`, `bank_3_2`, `bank_3_3`, `bank_4_1`, `bank_4_2`, `bank_4_3`, `bank_5_1`, `bank_5_2`, `bank_5_3`, `bank_6_1`, `bank_6_2`, `bank_6_3`, `bank_7_1`, `bank_7_2`, `bank_7_3`, `bank_8_1`, `bank_8_2`, `bank_8_3`, `bank_9_1`, `bank_9_2`, `bank_9_3`, `express_check`, `express_money`, `express_box_money`, `express_free`, `point_basic`, `point_register`, `point_use`, `member_check`, `member_invite`, `member_register`) VALUES
(2, 'admin', 'admin', '', '거인소프트', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 1, 3000, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_banner`
--

CREATE TABLE IF NOT EXISTS `cs_banner` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `display` varchar(10) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `link_open` tinyint(3) NOT NULL,
  `bbs_file` varchar(100) NOT NULL,
  `sbbs_file` varchar(100) NOT NULL,
  `ranking` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_banner`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_bbs`
--

CREATE TABLE IF NOT EXISTS `cs_bbs` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(20) NOT NULL DEFAULT '',
  `bbs_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bbs_cate` tinyint(3) NOT NULL,
  `bbs_pds` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bbs_pds_ea` int(11) NOT NULL DEFAULT '0',
  `bbs_coment` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bbs_access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bbs_read` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `bbs_write` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `list_width` int(10) unsigned NOT NULL DEFAULT '0',
  `list_height` int(10) unsigned NOT NULL DEFAULT '0',
  `list_page` int(10) unsigned NOT NULL DEFAULT '0',
  `new_check` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `new_mark` int(10) unsigned NOT NULL DEFAULT '0',
  `cool_check` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cool_mark` int(10) unsigned NOT NULL DEFAULT '0',
  `title_line` varchar(10) NOT NULL DEFAULT '',
  `title_bg` varchar(10) NOT NULL DEFAULT '',
  `title_color` varchar(10) NOT NULL DEFAULT '',
  `gubun_line` varchar(10) NOT NULL DEFAULT '',
  `mouse_over` varchar(10) NOT NULL DEFAULT '',
  `view` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `list_line1` varchar(10) NOT NULL DEFAULT '',
  `list_line2` varchar(10) NOT NULL DEFAULT '',
  `header` text NOT NULL,
  `footer` text NOT NULL,
  `skin` varchar(30) NOT NULL DEFAULT '',
  `memo` text NOT NULL,
  `nospam` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bbs_secret` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `editor` char(2) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 테이블의 덤프 데이터 `cs_bbs`
--

INSERT INTO `cs_bbs` (`idx`, `name`, `code`, `bbs_type`, `bbs_cate`, `bbs_pds`, `bbs_pds_ea`, `bbs_coment`, `bbs_access`, `bbs_read`, `bbs_write`, `list_width`, `list_height`, `list_page`, `new_check`, `new_mark`, `cool_check`, `cool_mark`, `title_line`, `title_bg`, `title_color`, `gubun_line`, `mouse_over`, `view`, `list_line1`, `list_line2`, `header`, `footer`, `skin`, `memo`, `nospam`, `create_date`, `bbs_secret`, `editor`) VALUES
(4, '공지사항', 'notice', 2, 0, 1, 2, 0, 0, 0, 9, 0, 10, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-07-18 13:46:00', 0, '1'),
(18, 'FAQ', 'faq', 4, 1, 0, 1, 0, 0, 0, 9, 0, 10, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 23:41:27', 0, '1'),
(12, '갤러리1', 'g1', 3, 0, 1, 1, 0, 0, 0, 9, 4, 16, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 21:59:52', 0, '1'),
(11, 'QNA', 'qa', 1, 0, 1, 1, 1, 0, 0, 0, 0, 10, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 21:48:58', 1, '1'),
(13, '갤러리2', 'g2', 3, 0, 1, 1, 0, 0, 0, 9, 4, 16, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 22:00:01', 0, '1'),
(14, '갤러리3', 'g3', 3, 0, 1, 1, 0, 0, 0, 9, 4, 16, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 22:00:18', 0, '1'),
(15, '갤러리4', 'g4', 3, 0, 1, 1, 0, 0, 0, 9, 4, 16, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 22:00:44', 0, '1'),
(16, '갤러리5', 'g5', 3, 0, 1, 1, 0, 0, 0, 9, 4, 16, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 22:01:00', 0, '1'),
(17, '갤러리6', 'g6', 3, 0, 1, 1, 0, 0, 0, 9, 4, 16, 10, 1, 24, 0, 0, '', '', '', '', '', 0, '', '', 'NULL', 'NULL', 'NULL', 'NULL', 0, '2017-09-06 22:01:13', 0, '1');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_bbs_coment`
--

CREATE TABLE IF NOT EXISTS `cs_bbs_coment` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` int(10) unsigned NOT NULL DEFAULT '0',
  `coment` text NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `pwd` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userid` varchar(70) NOT NULL DEFAULT '',
  PRIMARY KEY (`idx`),
  KEY `link` (`link`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 테이블의 덤프 데이터 `cs_bbs_coment`
--

INSERT INTO `cs_bbs_coment` (`idx`, `link`, `coment`, `name`, `pwd`, `reg_date`, `userid`) VALUES
(2, 13, '1114444444', '관리자', '', '2017-09-06 22:57:54', ''),
(3, 13, 'NULL', '관리자', '', '2017-09-06 23:04:51', ''),
(5, 16, 'test', '관리자', '', '2017-09-07 14:12:52', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_bbs_data`
--

CREATE TABLE IF NOT EXISTS `cs_bbs_data` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL DEFAULT '',
  `cate` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `pwd` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `event_sday` varchar(30) NOT NULL COMMENT '이벤트기간(시작)',
  `event_eday` varchar(30) NOT NULL COMMENT '이벤트기간(종료)',
  `read_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notice` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `display` varchar(10) NOT NULL,
  `content` text NOT NULL,
  `ref` int(10) unsigned NOT NULL DEFAULT '0',
  `re_level` int(10) unsigned NOT NULL DEFAULT '0',
  `re_step` int(10) unsigned NOT NULL DEFAULT '0',
  `bbs_file` varchar(100) NOT NULL DEFAULT '',
  `bbs_file2` varchar(100) NOT NULL DEFAULT '',
  `bbs_file3` varchar(100) NOT NULL DEFAULT '',
  `bbs_file4` varchar(100) NOT NULL DEFAULT '',
  `bbs_file5` varchar(100) NOT NULL DEFAULT '',
  `sum_file` varchar(100) NOT NULL,
  `sbbs_file` varchar(100) NOT NULL,
  `sbbs_file2` varchar(100) NOT NULL,
  `sbbs_file3` varchar(100) NOT NULL,
  `sbbs_file4` varchar(100) NOT NULL,
  `sbbs_file5` varchar(100) NOT NULL,
  `sum_sfile` varchar(100) NOT NULL,
  `sum_img` varchar(100) NOT NULL,
  `secret` char(2) DEFAULT NULL,
  `userid` varchar(50) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `code` (`code`),
  KEY `subject` (`subject`),
  KEY `name` (`name`),
  KEY `reg_date` (`reg_date`),
  KEY `notice` (`notice`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 테이블의 덤프 데이터 `cs_bbs_data`
--

INSERT INTO `cs_bbs_data` (`idx`, `code`, `cate`, `subject`, `name`, `pwd`, `email`, `event_sday`, `event_eday`, `read_cnt`, `reg_date`, `tag`, `notice`, `display`, `content`, `ref`, `re_level`, `re_step`, `bbs_file`, `bbs_file2`, `bbs_file3`, `bbs_file4`, `bbs_file5`, `sum_file`, `sbbs_file`, `sbbs_file2`, `sbbs_file3`, `sbbs_file4`, `sbbs_file5`, `sum_sfile`, `sum_img`, `secret`, `userid`) VALUES
(1, 'notice', '', '게시판 URL', '관리자', 'admin', '', '', '', 16, '2017-08-01 17:44:35', 0, 1, '', '<p><a href="http://gsdemo111.giantsoft.co.kr/sub/board/pc/gallery_01.php" target="_blank" class="tx-link">http://gsdemo111.giantsoft.co.kr/sub/board/pc/gallery_01.php</a></p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', 'none', '', '', '', '', '', '', '', '', ''),
(8, 'g2', '', '2', '관리자', 'admin', '', '', '', 2, '2017-09-06 22:28:44', 0, 0, '', '<p>2</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', '15047045249.jpg', '', '', '', '', '', 'Desert.jpg', '', '', ''),
(7, 'g1', '', '1', '관리자', 'admin', '', '', '', 4, '2017-09-06 22:28:33', 0, 0, '', '<p>1</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', '15047045139.jpg', '', '', '', '', '', 'Chrysanthemum.jpg', '', '', ''),
(4, 'notice', '', 't', '관리자', 'admin', '', '', '', 5, '2017-09-06 21:45:30', 0, 0, '', '<p>t</p>', 2, 0, 0, '15047019641.jpg', 'none', 'none', 'none', 'none', 'none', 'Penguins.jpg', '', '', '', '', '', '', '', ''),
(5, 'qa', '', 'test', 'test', '098f6bcd4621d373cade4e832627b4f6', '', '', '', 0, '2017-09-06 21:49:41', 0, 0, '', '<p>test</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', '', '', '', '', '', '', '', '', 'y', ''),
(6, 'qa', '', 'tset', 'test', '098f6bcd4621d373cade4e832627b4f6', '', '', '', 9, '2017-09-06 21:52:35', 0, 0, '', '<p>testtest</p><p style="text-align: left;"><img src="/data/plupload/o_1bpbk8mn012n7124k1qau1kfud6a.jpg" alt="Hydrangeas.jpg" class="txc-image" style="clear:none;float:none;"></p><p><br></p>', 6, 0, 0, 'none', 'none', 'none', 'none', 'none', '', '', '', '', '', '', '', '', 'y', ''),
(9, 'g3', '', '3', '관리자', 'admin', '', '', '', 2, '2017-09-06 22:28:55', 0, 0, '', '<p>3</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', '15047045359.jpg', '', '', '', '', '', 'Lighthouse.jpg', '', '', ''),
(10, 'g4', '', '4', '관리자', 'admin', '', '', '', 3, '2017-09-06 22:29:04', 0, 0, '', '<p>4</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', '15047045449.jpg', '', '', '', '', '', 'Penguins.jpg', '', '', ''),
(11, 'g5', '', '5', '관리자', 'admin', '', '', '', 0, '2017-09-06 22:29:12', 0, 0, '', '<p>5</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', '15047045529.jpg', '', '', '', '', '', 'Tulips.jpg', '', '', ''),
(12, 'g6', '', '6', '관리자', 'admin', '', '', '', 5, '2017-09-06 22:29:23', 0, 0, '', '<p>6</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', '15047045639.jpg', '', '', '', '', '', 'Jellyfish.jpg', '', '', ''),
(13, 'qa', '', '답변입니다.', '관리자', 'admin', '', '', '', 39, '2017-09-06 22:29:51', 0, 0, '', 'test 님 쓰신글\r\n\r\n제목 : tset\r\n<p>testtest</p><p style="text-align: left;"><img src="/data/plupload/o_1bpbk8mn012n7124k1qau1kfud6a.jpg" alt="Hydrangeas.jpg" class="txc-image" style="clear:none;float:none;"></p><p><br></p><br><br>[답변]<br>1<p><br></p>', 6, 1, 1, 'none', 'none', 'none', 'none', 'none', 'none', '', '', '', '', '', '', '', '', ''),
(14, 'faq', '', 'q', '관리자', 'admin', '', '', '', 1, '2017-09-06 23:41:42', 0, 0, '', '<p>a</p>', 1, 0, 0, 'none', 'none', 'none', 'none', 'none', 'none', '', '', '', '', '', '', '', '', ''),
(16, 'qa', '', 'test11', 'test11', 'b59c67bf196a4758191e42f76670ceba', '', '', '', 4, '2017-09-07 14:12:16', 0, 0, '', '<p>test11<br></p>', 14, 0, 0, 'none', 'none', 'none', 'none', 'none', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_cart`
--

CREATE TABLE IF NOT EXISTS `cs_cart` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL DEFAULT '',
  `userid` varchar(50) NOT NULL,
  `part_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_code` varchar(20) NOT NULL DEFAULT '',
  `goods_name` varchar(200) NOT NULL DEFAULT '',
  `goods_price` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_point` float NOT NULL DEFAULT '0',
  `option1_name` varchar(100) NOT NULL DEFAULT '',
  `option1_idx` varchar(100) NOT NULL,
  `option2_name` varchar(100) NOT NULL DEFAULT '',
  `option2_idx` varchar(100) NOT NULL,
  `register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idx`),
  KEY `code` (`code`),
  KEY `part_idx` (`part_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_cart`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_cate`
--

CREATE TABLE IF NOT EXISTS `cs_cate` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 테이블의 덤프 데이터 `cs_cate`
--

INSERT INTO `cs_cate` (`idx`, `table_name`, `code`, `name`) VALUES
(1, 'cs_bbs_data', 'faq', 'FAQ 문의#1'),
(2, 'cs_bbs_data', 'faq', 'FAQ 문의#2'),
(3, 'cs_bbs_data', 'faq', 'FAQ 문의#3');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_connect`
--

CREATE TABLE IF NOT EXISTS `cs_connect` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idx`),
  KEY `ip` (`ip`),
  KEY `url` (`url`),
  KEY `register` (`register`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84456 ;

--
-- 테이블의 덤프 데이터 `cs_connect`
--

INSERT INTO `cs_connect` (`idx`, `ip`, `url`, `register`) VALUES
(84294, '123.212.43.231', '', '2017-08-29 18:36:16'),
(84295, '123.212.43.231', '', '2017-08-29 18:37:22'),
(84296, '123.212.43.231', '', '2017-08-29 18:37:24'),
(84297, '123.212.43.231', '', '2017-08-29 18:37:26'),
(84298, '123.212.43.231', '', '2017-08-29 18:37:50'),
(84299, '123.212.43.231', '', '2017-08-29 18:37:54'),
(84300, '123.212.43.231', '', '2017-08-29 18:38:02'),
(84301, '123.212.43.231', '', '2017-08-29 18:38:03'),
(84302, '123.212.43.231', '', '2017-08-29 18:38:21'),
(84303, '123.212.43.231', '', '2017-08-29 18:38:23'),
(84304, '123.212.43.231', '', '2017-08-29 18:38:46'),
(84305, '123.212.43.231', '', '2017-08-29 18:39:13'),
(84306, '123.212.43.231', '', '2017-08-29 18:39:23'),
(84307, '123.212.43.231', '', '2017-08-29 18:42:38'),
(84308, '123.212.43.231', '', '2017-08-30 09:05:48'),
(84309, '123.212.43.231', '', '2017-08-30 09:05:52'),
(84310, '123.212.43.231', '', '2017-08-30 09:05:53'),
(84311, '123.212.43.231', '', '2017-08-30 09:05:54'),
(84312, '123.212.43.231', '', '2017-08-30 09:05:55'),
(84313, '123.212.43.231', '', '2017-08-30 09:05:56'),
(84314, '123.212.43.231', '', '2017-08-30 09:05:57'),
(84315, '123.212.43.231', '', '2017-08-30 09:05:58'),
(84316, '123.212.43.231', '', '2017-08-30 09:05:59'),
(84317, '123.212.43.231', '', '2017-08-30 09:05:59'),
(84318, '123.212.43.231', '', '2017-08-30 09:06:00'),
(84319, '123.212.43.231', '', '2017-08-30 09:06:02'),
(84320, '123.212.43.231', '', '2017-08-30 09:06:06'),
(84321, '123.212.43.231', '', '2017-08-30 09:23:46'),
(84322, '123.212.43.231', '', '2017-08-30 09:23:52'),
(84323, '123.212.43.231', '', '2017-08-30 09:25:48'),
(84324, '123.212.43.231', '', '2017-08-30 09:26:17'),
(84325, '123.212.43.231', '', '2017-08-30 09:26:18'),
(84326, '123.212.43.231', '', '2017-08-30 09:26:20'),
(84327, '123.212.43.231', '', '2017-08-30 09:26:29'),
(84328, '123.212.43.231', '', '2017-08-30 09:26:35'),
(84329, '123.212.43.231', '', '2017-08-30 09:27:45'),
(84330, '123.212.43.231', '', '2017-08-30 09:27:47'),
(84331, '123.212.43.231', '', '2017-08-30 09:27:48'),
(84332, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php', '2017-08-30 09:27:48'),
(84333, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:27:49'),
(84334, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:28:08'),
(84335, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:28:09'),
(84336, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:28:10'),
(84337, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:28:11'),
(84338, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:28:16'),
(84339, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:29:37'),
(84340, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:29:39'),
(84341, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:29:42'),
(84342, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:30:17'),
(84343, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:43:14'),
(84344, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:43:15'),
(84345, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:43:16'),
(84346, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:43:17'),
(84347, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:45:14'),
(84348, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 09:45:15'),
(84349, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:15:32'),
(84350, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:15:33'),
(84351, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:15:34'),
(84352, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:15:35'),
(84353, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:15:35'),
(84354, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:15:49'),
(84355, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:16:40'),
(84356, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:17:39'),
(84357, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:17:44'),
(84358, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:17:45'),
(84359, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:17:45'),
(84360, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:17:46'),
(84361, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:17:46'),
(84362, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:17:47'),
(84363, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:18:05'),
(84364, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:18:47'),
(84365, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:18:56'),
(84366, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:23:30'),
(84367, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:23:32'),
(84368, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:23:32'),
(84369, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:23:34'),
(84370, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:23:38'),
(84371, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:23:55'),
(84372, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:23'),
(84373, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:29'),
(84374, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:37'),
(84375, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:38'),
(84376, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:38'),
(84377, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:42'),
(84378, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:46'),
(84379, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:50'),
(84380, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:24:54'),
(84381, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:33:09'),
(84382, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:33:34'),
(84383, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:33:37'),
(84384, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:33:38'),
(84385, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:33:39'),
(84386, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:33:45'),
(84387, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:33:47'),
(84388, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:02'),
(84389, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:06'),
(84390, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:24'),
(84391, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:26'),
(84392, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:30'),
(84393, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:40'),
(84394, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:41'),
(84395, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:34:42'),
(84396, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:35:15'),
(84397, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:35:17'),
(84398, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:35:17'),
(84399, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:38:57'),
(84400, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:38:58'),
(84401, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:38:59'),
(84402, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:38:59'),
(84403, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:39:04'),
(84404, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:39:05'),
(84405, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:39:06'),
(84406, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:39:26'),
(84407, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:40:33'),
(84408, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:40:34'),
(84409, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:40:41'),
(84410, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:40:42'),
(84411, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:40:46'),
(84412, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:05'),
(84413, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:08'),
(84414, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:09'),
(84415, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:10'),
(84416, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:15'),
(84417, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:17'),
(84418, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:18'),
(84419, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:20'),
(84420, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:20'),
(84421, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:21'),
(84422, '123.212.43.231', 'http://makehome2.giantsoft.co.kr/test_popup.php?', '2017-08-30 10:41:21'),
(84423, '123.212.43.231', '', '2017-08-30 10:42:31'),
(84424, '123.212.43.231', '', '2017-08-30 10:42:50'),
(84425, '123.212.43.231', '', '2017-08-30 10:42:52'),
(84426, '123.212.43.231', '', '2017-08-30 10:42:53'),
(84427, '123.212.43.231', '', '2017-08-30 10:48:53'),
(84428, '123.212.43.231', '', '2017-08-30 10:48:55'),
(84429, '123.212.43.231', '', '2017-08-30 10:48:56'),
(84430, '123.212.43.231', '', '2017-08-30 10:48:57'),
(84431, '123.212.43.231', '', '2017-08-30 10:48:57'),
(84432, '123.212.43.231', '', '2017-08-30 10:52:01'),
(84433, '123.212.43.231', '', '2017-08-30 10:53:23'),
(84434, '123.212.43.231', '', '2017-08-30 10:53:39'),
(84435, '123.212.43.231', '', '2017-08-30 10:53:45'),
(84436, '123.212.43.231', '', '2017-08-30 10:53:50'),
(84437, '123.212.43.231', '', '2017-08-30 10:53:51'),
(84438, '123.212.43.231', '', '2017-08-30 10:54:02'),
(84439, '123.212.43.231', '', '2017-08-30 10:54:09'),
(84440, '123.212.43.231', '', '2017-08-30 10:55:59'),
(84441, '123.212.43.231', '', '2017-08-30 10:56:02'),
(84442, '123.212.43.231', '', '2017-08-30 10:56:18'),
(84443, '123.212.43.231', '', '2017-08-30 10:56:19'),
(84444, '123.212.43.231', '', '2017-08-30 10:56:25'),
(84445, '123.212.43.231', '', '2017-08-30 10:56:27'),
(84446, '123.212.43.231', '', '2017-08-30 10:56:28'),
(84447, '123.212.43.231', '', '2017-08-30 10:56:29'),
(84448, '123.212.43.231', '', '2017-08-30 10:56:30'),
(84449, '123.212.43.231', '', '2017-08-30 10:56:32'),
(84450, '123.212.43.231', '', '2017-08-30 10:56:33'),
(84451, '123.212.43.231', '', '2017-08-30 10:56:35'),
(84452, '123.212.43.231', '', '2017-08-30 10:56:36'),
(84453, '175.223.38.102', '', '2017-08-30 10:58:08'),
(84454, '123.212.43.231', '', '2017-08-30 10:59:58'),
(84455, '123.212.43.231', '', '2017-08-30 11:00:00');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_goods`
--

CREATE TABLE IF NOT EXISTS `cs_goods` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(3) NOT NULL,
  `code` varchar(20) NOT NULL DEFAULT '',
  `icon` varchar(100) NOT NULL COMMENT '추가표시',
  `name` varchar(200) NOT NULL DEFAULT '',
  `company` varchar(100) NOT NULL DEFAULT '',
  `old_price` int(10) unsigned NOT NULL DEFAULT '0',
  `shop_price` int(10) unsigned NOT NULL DEFAULT '0',
  `sold_out` varchar(10) NOT NULL,
  `number` int(10) unsigned NOT NULL DEFAULT '0',
  `point` float NOT NULL DEFAULT '0',
  `option_check` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `option1_name` varchar(50) NOT NULL DEFAULT '',
  `option1_part` text NOT NULL,
  `option2_name` varchar(50) NOT NULL DEFAULT '',
  `option2_part` text NOT NULL,
  `images1` varchar(100) NOT NULL DEFAULT '',
  `images2` varchar(100) NOT NULL DEFAULT '',
  `add_images1` varchar(100) NOT NULL DEFAULT '',
  `add_images2` varchar(100) NOT NULL DEFAULT '',
  `add_images3` varchar(100) NOT NULL DEFAULT '',
  `add_images4` varchar(100) NOT NULL DEFAULT '',
  `add_images5` varchar(100) NOT NULL DEFAULT '',
  `goods_file` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `main_position` tinyint(3) NOT NULL,
  `sub_position` tinyint(3) NOT NULL,
  `read_cnt` int(10) NOT NULL,
  `ranking` int(10) unsigned NOT NULL DEFAULT '0',
  `register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `zzim` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idx`),
  KEY `part_idx` (`part_idx`),
  KEY `display` (`display`),
  KEY `code` (`code`),
  KEY `name` (`name`),
  KEY `register` (`register`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 테이블의 덤프 데이터 `cs_goods`
--

INSERT INTO `cs_goods` (`idx`, `part_idx`, `display`, `code`, `icon`, `name`, `company`, `old_price`, `shop_price`, `sold_out`, `number`, `point`, `option_check`, `option1_name`, `option1_part`, `option2_name`, `option2_part`, `images1`, `images2`, `add_images1`, `add_images2`, `add_images3`, `add_images4`, `add_images5`, `goods_file`, `content`, `main_position`, `sub_position`, `read_cnt`, `ranking`, `register`, `zzim`) VALUES
(1, 3, 1, '1501549169', '', '제품명#1', '', 2000, 1000, '', 0, 0, 0, '', '', '', '', 'GOODS1_1501549169.jpg', 'GOODS2_1501549169.jpg', '', '', '', '', '', '', '<h5 class="page-header" style="box-sizing: border-box; font-family: " helvetica="" neue",="" helvetica,="" arial,="" sans-serif;="" font-weight:="" 500;="" line-height:="" 1.1;="" color:="" rgb(51,="" 51,="" 51);="" margin:="" 0px="" 20px;="" font-size:="" 14px;="" padding-bottom:="" 9px;="" border-bottom:="" 1.5px="" solid="" rgb(238,="" 238,="" 238);"="">제품설명#</h5><div><h5 class="page-header" style="box-sizing: border-box; font-family: " helvetica="" neue",="" helvetica,="" arial,="" sans-serif;="" font-weight:="" 500;="" line-height:="" 1.1;="" color:="" rgb(51,="" 51,="" 51);="" margin:="" 0px="" 20px;="" font-size:="" 14px;="" padding-bottom:="" 9px;="" border-bottom:="" 1.5px="" solid="" rgb(238,="" 238,="" 238);"="">제품설명#3</h5></div><p><br></p>', 0, 0, 0, 0, '2017-08-01 10:05:58', ''),
(2, 3, 1, '1501554815', '', '######', '', 3000, 1500, '', 0, 0, 0, '', '', '', '', 'GOODS1_1501554815.jpg', '', '', '', '', '', '', '', '<p>###</p>', 0, 0, 0, 0, '2017-09-07 13:30:05', '');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `cs_goods_img` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `display` varchar(10) NOT NULL,
  `title` varchar(70) NOT NULL,
  `link_url` varchar(400) NOT NULL,
  `bbs_file` varchar(100) NOT NULL,
  `sbbs_file` varchar(100) NOT NULL,
  `ranking` int(11) NOT NULL,
  `udate` varchar(30) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8


--
-- 테이블 구조 `cs_mailform`
--

CREATE TABLE IF NOT EXISTS `cs_mailform` (
  `idx` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 테이블의 덤프 데이터 `cs_mailform`
--

INSERT INTO `cs_mailform` (`idx`, `item`, `title`, `content`) VALUES
(11, 1, '[{SHOP_NAME}] 회원가입이 완료되었습니다.', '<!doctype html>\r\n<html lang="ko">\r\n<head>\r\n<meta charset="utf-8">\r\n<meta http-equiv="X-UA-Compatible" content="IE=edge">\r\n<title>[{SHOP_NAME}]</title>\r\n</head>\r\n<body style="width:600px; margin:60px auto;">\r\n\r\n<table style="border:1px solid #dedede; background:#fff;" cellSpacing="0" cellPadding="0" width="500" border="0">\r\n	<tr>\r\n		<td height="40"></td>\r\n	</tr>\r\n	<tr>\r\n		<td align="center">\r\n			<p style="font-size:24px; font-weight:400; color:#333; font-family: NanumGothic,''돋움'',dotum,sans-serif; line-height:34px; letter-spacing:-0.5px;"><strong style="color:#f08c20">[{SHOP_NAME}]</strong>의<br>회원이 되신 것을 환영합니다.</p>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td height="40"></td>\r\n	</tr>\r\n	<tr>\r\n		<td height="50" align="center" style="font-size:14px; line-height:20px; font-family:NanumGothic,''돋움'',dotum,sans-serif;">저희 <font color="#000000"><B>[{SHOP_NAME}]</B></font> 이용을 감사드리며<br>앞으로도 고객님들의 편의를 위해 항상 노력하겠습니다.<br>[{SHOP_NAME}]에 가입하신 님의 정보입니다.</td>\r\n	</tr>\r\n	<tr>\r\n		<td height="20"></td>\r\n	</tr>\r\n	<tr>\r\n		<td>\r\n			<table cellSpacing="0" cellPadding="0" width="500" border="0">\r\n				<tr>\r\n					<td width="100" height="50"></td>\r\n					<td style="font-size:15px; font-family:NanumGothic,''돋움'',dotum,sans-serif;" bgColor="#ebebeb" height="50" align="center">이름 : <font color="#111111"><b>[{USER_NAME}]</b></font></td>\r\n					<td width="100" height="50"></td>\r\n				</tr>\r\n				<tr>\r\n					<td width="500" colspan="3" height="10"></td>\r\n				</tr>\r\n				<tr>\r\n					<td width="100" height="50"></td>\r\n					<td style="font-size:15px; font-family:NanumGothic,''돋움'',dotum,sans-serif;" bgColor="#ebebeb" height="50" align="center">아이디 : <font color="#111111"><b>[{USER_ID}]</b></font></td>\r\n					<td width="100" height="50"></td>\r\n				</tr>\r\n			</table>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td height="20"></td>\r\n	</tr>\r\n	<tr>\r\n		<td align="center"><a href="[{SHOP_DOMAIN}]" target="_blank" title="새창으로 열기" style="font-family:NanumGothic,''돋움'',dotum,sans-serif; padding:10px 20px; display:inline-block; background:#000; color:#fff; text-decoration:none; font-size:13px;">[{SHOP_NAME}] 홈페이지 바로가기</a></td>\r\n	</tr>\r\n	<tr>\r\n		<td height="50"></td>\r\n	</tr>\r\n	<tr>\r\n		<td height="60" align="center" bgColor="#414141" style="color:#fff; font-family:''돋움'',dotum,sans-serif; font-size:11px; line-height:20px;">Copyright © [{SHOP_NAME}] All rights reserved.<br>본 메일은 발신 전용 메일로 회신이 되지 않습니다.</td>\r\n	</tr>\r\n</table>\r\n\r\n</body>\r\n</html>'),
(14, 2, '회원님의 임시비밀번호 입니다.', '<!doctype html>\r\n<html lang="ko">\r\n<head>\r\n<meta charset="utf-8">\r\n<meta http-equiv="X-UA-Compatible" content="IE=edge">\r\n<title>[{SHOP_NAME}]</title>\r\n</head>\r\n<body style="width:600px; margin:60px auto;">\r\n\r\n<table style="border:1px solid #dedede; background:#fff;" cellSpacing="0" cellPadding="0" width="500" border="0">\r\n	<tr>\r\n		<td height="40"></td>\r\n	</tr>\r\n	<tr>\r\n		<td align="center">\r\n			<strong style="font-size:24px; font-weight:600; color:#333; font-family: NanumGothic,''돋움'',dotum,sans-serif; color:#f08c20">임시 비밀번호 발급</strong>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td height="30"></td>\r\n	</tr>\r\n	<tr>\r\n		<td align="center" style="font-size:13px; font-family:NanumGothic,''돋움'',dotum,sans-serif; line-height:20px;"><font color="#AAAAAA">※임시 비밀번호로 홈페이지에서 로그인 하신 후<br>비밀번호를 변경해주시기 바랍니다.<br>아이디, 비밀번호가 유출되지 않게 유의하세요.</font></td>\r\n	</tr>\r\n	<tr>\r\n		<td height="30"></td>\r\n	</tr>\r\n	<tr>\r\n		<td height="50" align="center" style="font-size:15px; font-family:NanumGothic,''돋움'',dotum,sans-serif;">[{SHOP_NAME}]에 가입한 <font color="#000000"><B>[{USER_NAME}]</B></font>님의 정보입니다.</td>\r\n	</tr>\r\n	<tr>\r\n		<td>\r\n			<table cellSpacing=0 cellPadding=0 width=500 border=0>\r\n				<tr>\r\n					<td width="100" height="50"></td>\r\n					<td style="font-SIZE:15px; font-family:NanumGothic,''돋움'',dotum,sans-serif;" bgColor="#ebebeb" height="50" align="center">아이디 : <font color="#111111"><b>[{USER_ID}]</b></font></td>\r\n					<td width="100" height="50"></td>\r\n				</tr>\r\n				<tr>\r\n					<td width="500" colspan="3" height="10"></td>\r\n				</tr>\r\n				<tr>\r\n					<td width="100" height="50"></td>\r\n					<td style="font-SIZE:15px; font-family:NanumGothic,''돋움'',dotum,sans-serif;" bgColor="#ebebeb" height="50" align="center">임시비밀번호 : <font color="#111111"><b>[{USER_PASSWD}]</b></font></td>\r\n					<td width="100" height="50"></td>\r\n				</tr>\r\n			</table>\r\n		</td>\r\n	</tr>\r\n	<tr>\r\n		<td height="20"></td>\r\n	</tr>\r\n	<tr>\r\n		<td align="center"><a href="[{SHOP_DOMAIN}]" target="_blank" title="새창으로 열기" style="font-family:NanumGothic,''돋움'',dotum,sans-serif; padding:10px 20px; display:inline-block; background:#000; color:#fff; text-decoration:none; font-size:13px;">[{SHOP_NAME}] 홈페이지 바로가기</a></td>\r\n	</tr>\r\n	<tr>\r\n		<td height="50"></td>\r\n	</tr>\r\n	<tr>\r\n		<td height="60" align="center" bgColor="#414141" style="color:#fff; font-family:''돋움'',dotum,sans-serif; font-size:11px; line-height:20px;">Copyright © [{SHOP_NAME}] All rights reserved.<br>본 메일은 발신 전용 메일로 회신이 되지 않습니다.</td>\r\n	</tr>\r\n</table>\r\n\r\n</body>\r\n</html>');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_member`
--

CREATE TABLE IF NOT EXISTS `cs_member` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `birth` varchar(30) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `zip_new` varchar(6) NOT NULL,
  `add1` varchar(200) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '가입일',
  `ip` varchar(100) NOT NULL COMMENT '가입한IP',
  `level` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sns` varchar(10) NOT NULL,
  `mailing` varchar(20) NOT NULL COMMENT '메일수신',
  `register_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '최종로그인',
  `exit_check` varchar(10) NOT NULL COMMENT '회원탈퇴(y)',
  `exit_register` datetime NOT NULL,
  `connect` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '로그인횟수',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 테이블의 덤프 데이터 `cs_member`
--

INSERT INTO `cs_member` (`idx`, `userid`, `passwd`, `name`, `email`, `birth`, `tel`, `phone`, `zip_new`, `add1`, `add2`, `register`, `ip`, `level`, `sns`, `mailing`, `register_login`, `exit_check`, `exit_register`, `connect`) VALUES
(1, 'test', '903941070fa5d173780b86891f3a9dd8', '홍길동', 'cmk@giantsoft.co.kr', '', '02-1234-7890', '010-020-030', '18367', '경기 화성시 10용사로 61', '상세주소#', '2017-07-19 14:16:11', '123.212.43.231', 1, '', 'y', '2017-07-25 16:02:24', '', '0000-00-00 00:00:00', 38),
(3, 'test07', '43bb735c2dfafdd89379e9d274db9d61', '고길동', 'cmk3@giantsoft.co.kr', '2001-12-31', '02-080-090', '010-080-090', '18367', '경기 화성시 10용사로 61', '상세주소####', '2017-07-25 15:33:38', '123.212.43.231', 1, '', 'y', '2017-07-25 15:33:45', '', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_online`
--

CREATE TABLE IF NOT EXISTS `cs_online` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `zip_new` varchar(6) NOT NULL,
  `add1` varchar(200) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `file` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `ip` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_online`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_option`
--

CREATE TABLE IF NOT EXISTS `cs_option` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `cate` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `sold_out` varchar(10) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_option`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_page`
--

CREATE TABLE IF NOT EXISTS `cs_page` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_index` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `tag` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 테이블의 덤프 데이터 `cs_page`
--

INSERT INTO `cs_page` (`idx`, `page_index`, `title`, `tag`, `content`) VALUES
(7, 'agreement', '서비스 이용약관', 0, '''ooo'' 은 (이하 ''회사''는) 고객님의 개인정보를 중요시하며, "정보통신망 이용촉진 및 정보보호"에 관한 법률을 준수하고 있습니다.<br>\r\n회사는 개인정보취급방침을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다..<br><br>\r\n\r\n회사는 개인정보취급방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다..<br><br>\r\n\r\nο 본 방침은 : oooo 년 oo 월 oo 일 부터 시행됩니다..<br><br>\r\n\r\n\r\n\r\n\r\n■ 수집하는 개인정보 항목.<br><br>\r\n\r\n회사는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다..<br><br>\r\n\r\nο 수집항목 : 이름 , 성별 , 휴대전화번호 , 이메일 , 회사명 , 회사전화번호 , 신용카드 정보 , 은행계좌 정보 , 서비스 이용기록 , 접속 로그 , 접속 IP 정보 , 결제기록<br><br>\r\n\r\nο 개인정보 수집방법 : 홈페이지(회원가입) , 서면양식<br><br>\r\n\r\n ■ 개인정보의 수집 및 이용목적<br><br>\r\n\r\n회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br><br>\r\n\r\nο 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산 콘텐츠 제공 , 구매 및 요금 결제 , 물품배송 또는 청구지 등 발송 , 금융거래 본인 인증 및 금융 서비스<br><br>\r\nο 회원 관리<br><br>\r\n회원제 서비스 이용에 따른 본인확인 , 개인 식별 , 불량회원의 부정 이용 방지와 비인가 사용 방지 , 불만처리 등 민원처리 , 고지사항 전달<br><br>\r\nο 마케팅 및 광고에 활용<br><br>\r\n신규 서비스(제품) 개발 및 특화<br><br>\r\n\r\n■ 개인정보의 보유 및 이용기간<br><br>\r\n\r\n회사는 개인정보 수집 및 이용목적이 달성된 후에는 예외 없이 해당 정보를 지체 없이 파기합니다.<br><br>\r\n\r\n■ 개인정보의 파기절차 및 방법<br><br>\r\n\r\n회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다.<br><br>파기절차 및 방법은 다음과 같습니다.<br><br>\r\n\r\nο 파기절차<br><br>\r\n\r\n회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어집니다.\r\n<br><br>\r\n별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다.<br><br>\r\n\r\nο 파기방법 \r\n\r\n- 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.<br><br>\r\n- 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.<br><br>\r\n\r\n■ 개인정보 제공\r\n\r\n회사는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다.<br><br>다만, 아래의 경우에는 예외로 합니다.\r\n\r\n- 이용자들이 사전에 동의한 경우\r\n- 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우\r\n\r\n■ 수집한 개인정보의 위탁\r\n\r\n회사는 고객님의 동의없이 고객님의 정보를 외부 업체에 위탁하지 않습니다.<br><br>향후 그러한 필요가 생길 경우, 위탁 대상자와 위탁 업무 내용에 대해 고객님에게 통지하고 필요한 경우 사전 동의를 받도록 하겠습니다.\r\n\r\n■ 이용자 및 법정대리인의 권리와 그 행사방법\r\n\r\n이용자 및 법정 대리인은 언제든지 등록되어 있는 자신 혹은 당해 만 14세 미만 아동의 개인정보를 조회하거나 수정할 수 있으며 가입해지를 요청할 수도 있습니다.\r\n이용자 혹은 만 14세 미만 아동의 개인정보 조회?수정을 위해서는 ‘개인정보변경’(또는 ‘회원정보수정’ 등)을 가입해지(동의철회)를 위해서는 “회원탈퇴”를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다.\r\n혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체없이 조치하겠습니다.\r\n귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다.<br><br>또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체없이 통지하여 정정이 이루어지도록 하겠습니다.\r\noo는 이용자 혹은 법정 대리인의 요청에 의해 해지 또는 삭제된 개인정보는 “oo가 수집하는 개인정보의 보유 및 이용기간”에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.<br><br>\r\n\r\n■ 개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항<br><br>\r\n\r\n쿠키 등 인터넷 서비스 이용 시 자동 생성되는 개인정보를 수집하는 장치를 운영하지 않습니다.<br><br>\r\n\r\n■ 개인정보에 관한 민원서비스<br><br>\r\n\r\n회사는 고객의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 관련 부서 및 개인정보관리책임자를 지정하고 있습니다..<br><br>\r\n\r\n\r\n개인정보관리책임자 성명 : ooo<br><br>\r\n전화번호 : oo-oooo-oooo<br><br>\r\n이메일 : oooo@oooo<br><br>\r\n\r\n\r\n귀하께서는 회사의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자 혹은 담당부서로 신고하실 수 있습니다.<br><br>회사는 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다.<br><br>\r\n\r\n기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.<br><br>\r\n\r\n1.개인정보침해신고센터 (www.1336.or.kr/국번없이 118)\r\n2.정보보호마크인증위원회 (www.eprivacy.or.kr/02-580-0533~4)\r\n3.대검찰청 인터넷범죄수사센터 (http://icic.sppo.go.kr/02-3480-3600)\r\n4.경찰청 사이버테러대응센터 (www.ctrc.go.kr/02-392-0330)'),
(8, 'privacy', '개인정보 취급방침', 0, '''ooo'' 은 (이하 ''회사''는) 고객님의 개인정보를 중요시하며, "정보통신망 이용촉진 및 정보보호"에 관한 법률을 준수하고 있습니다.<br>\r\n회사는 개인정보취급방침을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다..<br><br>\r\n\r\n회사는 개인정보취급방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다..<br><br>\r\n\r\nο 본 방침은 : oooo 년 oo 월 oo 일 부터 시행됩니다..<br><br>\r\n\r\n\r\n\r\n\r\n■ 수집하는 개인정보 항목.<br><br>\r\n\r\n회사는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다..<br><br>\r\n\r\nο 수집항목 : 이름 , 성별 , 휴대전화번호 , 이메일 , 회사명 , 회사전화번호 , 신용카드 정보 , 은행계좌 정보 , 서비스 이용기록 , 접속 로그 , 접속 IP 정보 , 결제기록<br><br>\r\n\r\nο 개인정보 수집방법 : 홈페이지(회원가입) , 서면양식<br><br>\r\n\r\n ■ 개인정보의 수집 및 이용목적<br><br>\r\n\r\n회사는 수집한 개인정보를 다음의 목적을 위해 활용합니다.<br><br>\r\n\r\nο 서비스 제공에 관한 계약 이행 및 서비스 제공에 따른 요금정산 콘텐츠 제공 , 구매 및 요금 결제 , 물품배송 또는 청구지 등 발송 , 금융거래 본인 인증 및 금융 서비스<br><br>\r\nο 회원 관리<br><br>\r\n회원제 서비스 이용에 따른 본인확인 , 개인 식별 , 불량회원의 부정 이용 방지와 비인가 사용 방지 , 불만처리 등 민원처리 , 고지사항 전달<br><br>\r\nο 마케팅 및 광고에 활용<br><br>\r\n신규 서비스(제품) 개발 및 특화<br><br>\r\n\r\n■ 개인정보의 보유 및 이용기간<br><br>\r\n\r\n회사는 개인정보 수집 및 이용목적이 달성된 후에는 예외 없이 해당 정보를 지체 없이 파기합니다.<br><br>\r\n\r\n■ 개인정보의 파기절차 및 방법<br><br>\r\n\r\n회사는 원칙적으로 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체없이 파기합니다.<br><br>파기절차 및 방법은 다음과 같습니다.<br><br>\r\n\r\nο 파기절차<br><br>\r\n\r\n회원님이 회원가입 등을 위해 입력하신 정보는 목적이 달성된 후 별도의 DB로 옮겨져(종이의 경우 별도의 서류함) 내부 방침 및 기타 관련 법령에 의한 정보보호 사유에 따라(보유 및 이용기간 참조) 일정 기간 저장된 후 파기되어집니다.\r\n<br><br>\r\n별도 DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 보유되어지는 이외의 다른 목적으로 이용되지 않습니다.<br><br>\r\n\r\nο 파기방법 \r\n\r\n- 전자적 파일형태로 저장된 개인정보는 기록을 재생할 수 없는 기술적 방법을 사용하여 삭제합니다.<br><br>\r\n- 종이에 출력된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기합니다.<br><br>\r\n\r\n■ 개인정보 제공\r\n\r\n회사는 이용자의 개인정보를 원칙적으로 외부에 제공하지 않습니다.<br><br>다만, 아래의 경우에는 예외로 합니다.\r\n\r\n- 이용자들이 사전에 동의한 경우\r\n- 법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우\r\n\r\n■ 수집한 개인정보의 위탁\r\n\r\n회사는 고객님의 동의없이 고객님의 정보를 외부 업체에 위탁하지 않습니다.<br><br>향후 그러한 필요가 생길 경우, 위탁 대상자와 위탁 업무 내용에 대해 고객님에게 통지하고 필요한 경우 사전 동의를 받도록 하겠습니다.\r\n\r\n■ 이용자 및 법정대리인의 권리와 그 행사방법\r\n\r\n이용자 및 법정 대리인은 언제든지 등록되어 있는 자신 혹은 당해 만 14세 미만 아동의 개인정보를 조회하거나 수정할 수 있으며 가입해지를 요청할 수도 있습니다.\r\n이용자 혹은 만 14세 미만 아동의 개인정보 조회?수정을 위해서는 ‘개인정보변경’(또는 ‘회원정보수정’ 등)을 가입해지(동의철회)를 위해서는 “회원탈퇴”를 클릭하여 본인 확인 절차를 거치신 후 직접 열람, 정정 또는 탈퇴가 가능합니다.\r\n혹은 개인정보관리책임자에게 서면, 전화 또는 이메일로 연락하시면 지체없이 조치하겠습니다.\r\n귀하가 개인정보의 오류에 대한 정정을 요청하신 경우에는 정정을 완료하기 전까지 당해 개인정보를 이용 또는 제공하지 않습니다.<br><br>또한 잘못된 개인정보를 제3자에게 이미 제공한 경우에는 정정 처리결과를 제3자에게 지체없이 통지하여 정정이 이루어지도록 하겠습니다.\r\noo는 이용자 혹은 법정 대리인의 요청에 의해 해지 또는 삭제된 개인정보는 “oo가 수집하는 개인정보의 보유 및 이용기간”에 명시된 바에 따라 처리하고 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.<br><br>\r\n\r\n■ 개인정보 자동수집 장치의 설치, 운영 및 그 거부에 관한 사항<br><br>\r\n\r\n쿠키 등 인터넷 서비스 이용 시 자동 생성되는 개인정보를 수집하는 장치를 운영하지 않습니다.<br><br>\r\n\r\n■ 개인정보에 관한 민원서비스<br><br>\r\n\r\n회사는 고객의 개인정보를 보호하고 개인정보와 관련한 불만을 처리하기 위하여 아래와 같이 관련 부서 및 개인정보관리책임자를 지정하고 있습니다..<br><br>\r\n\r\n\r\n개인정보관리책임자 성명 : ooo<br><br>\r\n전화번호 : oo-oooo-oooo<br><br>\r\n이메일 : oooo@oooo<br><br>\r\n\r\n\r\n귀하께서는 회사의 서비스를 이용하시며 발생하는 모든 개인정보보호 관련 민원을 개인정보관리책임자 혹은 담당부서로 신고하실 수 있습니다.<br><br>회사는 이용자들의 신고사항에 대해 신속하게 충분한 답변을 드릴 것입니다.<br><br>\r\n\r\n기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하시기 바랍니다.<br><br>\r\n\r\n1.개인정보침해신고센터 (www.1336.or.kr/국번없이 118)\r\n2.정보보호마크인증위원회 (www.eprivacy.or.kr/02-580-0533~4)\r\n3.대검찰청 인터넷범죄수사센터 (http://icic.sppo.go.kr/02-3480-3600)\r\n4.경찰청 사이버테러대응센터 (www.ctrc.go.kr/02-392-0330)'),
(9, 'exchange', '환불/교환안내', 0, '<p>환불/교환안내#</p><p>환불/교환안내##</p>'),
(10, 'delivery', '배송안내', 0, '<p><br></p>'),
(11, 'guest', '비회원 구매 및 결제 개인정보취급방침', 0, '''ooo'' 은 (이하 ''회사''는) 고객님의 개인정보를 중요시하며, "정보통신망 이용촉진 및 정보보호"에 관한 법률을 준수하고 있습니다.<br>\r\n회사는 개인정보취급방침을 통하여 고객님께서 제공하시는 개인정보가 어떠한 용도와 방식으로 이용되고 있으며, 개인정보보호를 위해 어떠한 조치가 취해지고 있는지 알려드립니다..<br><br>\r\n\r\n회사는 개인정보취급방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다..<br><br>\r\n\r\nο 본 방침은 : oooo 년 oo 월 oo 일 부터 시행됩니다..<br><br>\r\n\r\n\r\n\r\n\r\n■ 수집하는 개인정보 항목.<br><br>\r\n\r\n회사는 회원가입, 상담, 서비스 신청 등등을 위해 아래와 같은 개인정보를 수집하고 있습니다..<br><br>\r\n\r\nο 수집항목 : 이름 , 성별 , 휴대전화번호 , 이메일 , 회사명 , 회사전화번호 , 신용카드 정보 , 은행계좌 정보 , 서비스 이용기록 , 접속 로그 , 접속 IP 정보 , 결제기록<br><br>\r\n\r\nο 개인정보 수집방법 : 홈페이지(회원가입) , 서면양식<br><br>');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_part`
--

CREATE TABLE IF NOT EXISTS `cs_part` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_name` varchar(100) NOT NULL DEFAULT '',
  `part1_code` varchar(20) NOT NULL DEFAULT '',
  `part2_code` varchar(20) NOT NULL DEFAULT '',
  `part3_code` varchar(20) NOT NULL DEFAULT '',
  `part_index` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `part_ranking` int(10) unsigned NOT NULL DEFAULT '0',
  `part_display_check` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `part_low_check` tinyint(3) NOT NULL,
  `bbs_file` varchar(100) NOT NULL,
  `sbbs_file` varchar(100) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 테이블의 덤프 데이터 `cs_part`
--

INSERT INTO `cs_part` (`idx`, `part_name`, `part1_code`, `part2_code`, `part3_code`, `part_index`, `part_ranking`, `part_display_check`, `part_low_check`, `bbs_file`, `sbbs_file`, `content`) VALUES
(1, '카테고리#1', '1501548153', '', '', 1, 0, 1, 1, '', '', '<p><br></p>'),
(2, '카테고리#1-2', '1501548153', '1501548172', '', 2, 0, 1, 1, '', '', '<p><br></p>'),
(3, '카테고리#1-3', '1501548153', '1501548172', '1501548184', 3, 0, 1, 0, '', '', '<p><br></p>'),
(4, '카테고리2', '1504758582', '', '', 1, 0, 1, 0, '', '', '<p><br></p>');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_plupload`
--

CREATE TABLE IF NOT EXISTS `cs_plupload` (
  `idx` int(10) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(50) NOT NULL,
  `table_idx` int(8) NOT NULL,
  `url` varchar(400) NOT NULL,
  `filename` varchar(100) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `wr_plupload_img_index` (`table_name`,`table_idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=888 ;

--
-- 테이블의 덤프 데이터 `cs_plupload`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_point`
--

CREATE TABLE IF NOT EXISTS `cs_point` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL DEFAULT '',
  `point` float NOT NULL DEFAULT '0',
  `code` varchar(50) NOT NULL,
  `register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idx`),
  KEY `userid` (`userid`),
  KEY `point` (`point`),
  KEY `register` (`register`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_point`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_popup`
--

CREATE TABLE IF NOT EXISTS `cs_popup` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kind` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `start_day` varchar(20) NOT NULL DEFAULT '',
  `end_day` varchar(20) NOT NULL DEFAULT '',
  `width` int(10) unsigned NOT NULL DEFAULT '0',
  `height` int(10) unsigned NOT NULL DEFAULT '0',
  `tops` int(10) unsigned NOT NULL DEFAULT '0',
  `lefts` int(10) unsigned NOT NULL DEFAULT '0',
  `live` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title_bar` varchar(200) NOT NULL DEFAULT '',
  `link_url` varchar(200) NOT NULL DEFAULT '',
  `popup_images` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 테이블의 덤프 데이터 `cs_popup`
--

INSERT INTO `cs_popup` (`idx`, `kind`, `display`, `start_day`, `end_day`, `width`, `height`, `tops`, `lefts`, `live`, `title_bar`, `link_url`, `popup_images`, `content`, `reg_date`) VALUES
(11, 2, 1, '1504018800', '1504105200', 0, 0, 0, 0, 0, '11', '', 'POPUP_1504058177', '', '2017-08-30 10:56:17');

-- --------------------------------------------------------

--
-- 테이블 구조 `cs_product_qa`
--

CREATE TABLE IF NOT EXISTS `cs_product_qa` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_idx` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL DEFAULT '',
  `secret` char(2) NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT '',
  `pwd` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `content` text NOT NULL,
  `userid` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reply` varchar(10) NOT NULL,
  `reply_content` text NOT NULL,
  `reply_reg_date` datetime NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `subject` (`subject`),
  KEY `name` (`name`),
  KEY `reg_date` (`reg_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_product_qa`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_product_review`
--

CREATE TABLE IF NOT EXISTS `cs_product_review` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_idx` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(30) NOT NULL DEFAULT '',
  `pwd` varchar(255) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `star` tinyint(3) NOT NULL COMMENT '별점',
  `bbs_file` varchar(100) NOT NULL,
  `sbbs_file` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `userid` varchar(30) NOT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`idx`),
  KEY `subject` (`subject`),
  KEY `name` (`name`),
  KEY `reg_date` (`reg_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_product_review`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_seo`
--

CREATE TABLE IF NOT EXISTS `cs_seo` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `keywords` text NOT NULL,
  `naver_meta` varchar(255) NOT NULL,
  `google_meta` varchar(255) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_seo`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_trade`
--

CREATE TABLE IF NOT EXISTS `cs_trade` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trade_code` varchar(100) NOT NULL DEFAULT '',
  `trade_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trade_total_price` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_price` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_use_point` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_save_point` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_deliv_price` int(10) unsigned NOT NULL DEFAULT '0',
  `trade_method` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `trade_method_info` varchar(100) NOT NULL DEFAULT '',
  `trade_method_name` varchar(50) NOT NULL COMMENT '예금주',
  `tax_check` tinyint(3) NOT NULL COMMENT '(1:소득공제용, 2:지출증빙용, 3:미발행)',
  `tax_phone` varchar(30) NOT NULL,
  `tax_licensee` varchar(30) NOT NULL COMMENT '사업자번호',
  `trade_stat` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `trade_money_ok` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trade_start_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trade_end_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delivery_day` datetime NOT NULL COMMENT '배송중',
  `sale_end_day` datetime NOT NULL COMMENT '판매완료',
  `cancle_day` datetime NOT NULL,
  `trade_delivery` varchar(50) NOT NULL DEFAULT '',
  `trade_delivery2` varchar(50) NOT NULL DEFAULT '',
  `delivery_url` varchar(200) NOT NULL DEFAULT '',
  `trade_number` varchar(50) NOT NULL DEFAULT '',
  `userid` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `zip_new` varchar(6) NOT NULL,
  `add1` varchar(200) NOT NULL,
  `add2` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `bank_no` varchar(100) NOT NULL COMMENT '가상계좌(계좌번호)',
  `bank_code` varchar(100) NOT NULL COMMENT '가상계좌(은행코드)',
  `bank_name` varchar(30) NOT NULL COMMENT '가상계좌(은행이름)',
  `bank_payer` varchar(30) NOT NULL COMMENT '가상계좌(입금자)',
  `bank_end_day` varchar(50) NOT NULL COMMENT '가상계좌(입금종료)',
  `order_gu` varchar(2) NOT NULL DEFAULT '',
  `device` varchar(50) NOT NULL COMMENT 'pc,mobile',
  PRIMARY KEY (`idx`),
  KEY `trade_day` (`trade_day`),
  KEY `trade_code` (`trade_code`),
  KEY `trade_stat` (`trade_stat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_trade`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_trade_goods`
--

CREATE TABLE IF NOT EXISTS `cs_trade_goods` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trade_code` varchar(100) NOT NULL DEFAULT '',
  `part_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_code` varchar(20) NOT NULL DEFAULT '',
  `goods_name` varchar(200) NOT NULL DEFAULT '',
  `goods_price` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_point` int(10) unsigned NOT NULL DEFAULT '0',
  `option1_name` varchar(50) NOT NULL DEFAULT '',
  `option1_part` varchar(100) NOT NULL,
  `option1_idx` varchar(100) NOT NULL,
  `option2_name` varchar(50) NOT NULL DEFAULT '',
  `option2_part` varchar(100) NOT NULL,
  `option2_idx` varchar(100) NOT NULL,
  `trade_day` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_trade_goods`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_trade_temp`
--

CREATE TABLE IF NOT EXISTS `cs_trade_temp` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL DEFAULT '',
  `part_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_code` varchar(20) NOT NULL DEFAULT '',
  `goods_name` varchar(200) NOT NULL DEFAULT '',
  `goods_price` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_cnt` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_point` float NOT NULL DEFAULT '0',
  `option1_name` varchar(100) NOT NULL DEFAULT '',
  `option1_idx` varchar(100) NOT NULL,
  `option2_name` varchar(100) NOT NULL DEFAULT '',
  `option2_idx` varchar(100) NOT NULL,
  `register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idx`),
  KEY `code` (`code`),
  KEY `part_idx` (`part_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_trade_temp`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_wishlist`
--

CREATE TABLE IF NOT EXISTS `cs_wishlist` (
  `idx` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(50) NOT NULL,
  `goods_idx` int(10) unsigned NOT NULL DEFAULT '0',
  `register` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `cs_wishlist`
--


-- --------------------------------------------------------

--
-- 테이블 구조 `cs_zzim`
--

CREATE TABLE IF NOT EXISTS `cs_zzim` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `goods_idx` int(10) NOT NULL,
  `ranking` int(10) NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 테이블의 덤프 데이터 `cs_zzim`
--

INSERT INTO `cs_zzim` (`idx`, `code`, `goods_idx`, `ranking`) VALUES
(1, '1501554815', 2, 0),
(2, '1501554815', 1, 0),
(3, '1502440399', 2, 0),
(4, '1502440399', 1, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `todays`
--

CREATE TABLE IF NOT EXISTS `todays` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `oid` varchar(50) DEFAULT NULL,
  `goods_idx` int(11) DEFAULT NULL,
  `udate` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 테이블의 덤프 데이터 `todays`
--



