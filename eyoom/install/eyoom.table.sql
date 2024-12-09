-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_respond`
--

DROP TABLE IF EXISTS `g5_eyoom_respond`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_respond` (
  `rid` int(11) NOT NULL auto_increment,
  `bo_table` varchar(20) NOT NULL default '',
  `pr_id` mediumint(11) NOT NULL,
  `wr_id` int(11) NOT NULL default '0',
  `wr_cmt` int(11) NOT NULL default '0',
  `wr_subject` varchar(255) NOT NULL default '',
  `wr_mb_id` varchar(20) NOT NULL,
  `mb_id` varchar(20) NOT NULL,
  `mb_name` varchar(255) NOT NULL,
  `re_cnt` mediumint(3) NOT NULL default '0',
  `re_type` varchar(20) NOT NULL,
  `re_chk` tinyint(4) NOT NULL default '0',
  `regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`rid`),
  KEY `mb_id` (`wr_mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_manager`
--

DROP TABLE IF EXISTS `g5_eyoom_manager`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_manager` (
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `mg_theme` varchar(255) NOT NULL DEFAULT '',
  `mg_menu` varchar(255) NOT NULL,
  PRIMARY KEY (`mb_id`,`mg_theme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_member`
--

DROP TABLE IF EXISTS `g5_eyoom_member`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_member` (
  `mb_id` varchar(30) NOT NULL,
  `level` mediumint(5) NOT NULL default '1',
  `level_point` mediumint(11) NOT NULL default '0',
  `photo` varchar(100) NOT NULL,
  `myhome_cover` varchar(100) NOT NULL,
  `myhome_hit` mediumint(11) NOT NULL default '0',
  `open_page` enum('y','n') NOT NULL default 'y',
  `respond` mediumint(5) NOT NULL default '0',
  `onoff_push` enum('on','off') NOT NULL default 'on',
  `onoff_push_respond` enum('on','off') NOT NULL default 'on',
  `onoff_push_memo` enum('on','off') NOT NULL default 'on',
  `onoff_push_social` enum('on','off') NOT NULL default 'on',
  `onoff_push_likes` enum('on','off') NOT NULL default 'on',
  `onoff_push_guest` enum('on','off') NOT NULL default 'on',
  `onoff_social` enum('on','off') NOT NULL default 'on',
  `open_email` enum('y','n') NOT NULL default 'y',
  `open_homepage` enum('y','n') NOT NULL default 'y',
  `open_tel` enum('y','n') NOT NULL default 'y',
  `open_hp` enum('y','n') NOT NULL default 'y',
  `view_timeline` char(1) NOT NULL default '1',
  `view_favorite` char(1) NOT NULL default '1',
  `view_followinggul` char(1) NOT NULL default '1',
  `favorite` text NOT NULL,
  `likes` int(11) NOT NULL default '0',
  UNIQUE KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_activity`
--

DROP TABLE IF EXISTS `g5_eyoom_activity`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_activity` (
  `act_id` mediumint(11) unsigned NOT NULL auto_increment,
  `mb_id` varchar(40) NOT NULL,
  `act_type` varchar(20) NOT NULL,
  `act_contents` text NOT NULL,
  `act_image` text NOT NULL,
  `act_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`act_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_board`
--

DROP TABLE IF EXISTS `g5_eyoom_board`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_board` (
  `bo_id` mediumint(11) unsigned NOT NULL auto_increment,
  `bo_table` varchar(20) NOT NULL,
  `gr_id` varchar(10) NOT NULL,
  `bo_theme` varchar(50) NOT NULL,
  `bo_skin` varchar(40) NOT NULL,
  `use_gnu_skin` enum('y','n') NOT NULL default 'n',
  `use_shop_skin` enum('y','n') NOT NULL default 'n',
  `bo_sel_date_type` enum('1','2') NOT NULL default '1',
  `bo_use_hotgul` char(1) NOT NULL default '1',
  `bo_use_anonymous` char(1) NOT NULL default '',
  `bo_use_infinite_scroll` char(1) NOT NULL default '2',
  `bo_use_cmt_infinite` char(1) NOT NULL default '0',
  `bo_use_cmt_best` char(1) NOT NULL default '0',
  `bo_use_point_explain` char(1) NOT NULL default '1',
  `bo_use_video_photo` char(1) NOT NULL default '2',
  `bo_use_list_image` char(1) NOT NULL default '1',
  `bo_use_good_member` char(1) NOT NULL default '1',
  `bo_use_nogood_member` char(1) NOT NULL default '0',
  `bo_use_yellow_card` char(1) NOT NULL default '0',
  `bo_use_exif` char(1) NOT NULL default '0',
  `bo_use_rating` char(1) NOT NULL default '2',
  `bo_use_rating_list` char(1) NOT NULL default '1',
  `bo_use_rating_member` char(1) NOT NULL default '0',
  `bo_use_rating_score` char(1) NOT NULL default '0',
  `bo_use_rating_comment` char(1) NOT NULL default '0',
  `bo_rating_point` int(11) NOT NULL default '0',
  `bo_use_tag` char(1) NOT NULL default '0',
  `bo_use_automove` char(1) NOT NULL default '0',
  `bo_use_best` char(1) NOT NULL default '0',
  `bo_goto_url` varchar(255) NULL default '',
  `bo_use_addon_emoticon` char(1) NOT NULL default '1',
  `bo_use_addon_video` char(1) NOT NULL default '1',
  `bo_use_addon_coding` char(1) NOT NULL default '0',
  `bo_use_addon_soundcloud` char(1) NOT NULL default '0',
  `bo_use_addon_map` char(1) NOT NULL default '0',
  `bo_use_addon_poll` char(1) NOT NULL default '0',
  `bo_addon_poll_point` int(7) NOT NULL default '0',
  `bo_addon_poll_type` char(1) NOT NULL default '1',
  `bo_use_addon_cmtfile` char(1) NOT NULL default '1',
  `bo_count_cmtfile` smallint(2) NOT NULL default '1',
  `bo_use_extimg` char(1) NOT NULL default '0',
  `bo_use_adopt_point` char(1) NOT NULL default '0',
  `bo_adopt_minpoint` int(7) NOT NULL default '0',
  `bo_adopt_maxpoint` int(11) NOT NULL default '0',
  `bo_adopt_ratio` smallint(3) NOT NULL default '0',
  `bo_use_wrfixed` char(1) NOT NULL default '',
  `bo_wrfixed_type` char(1) NOT NULL default '1',
  `bo_wrfixed_point` int(7) NOT NULL default '1000',
  `bo_wrfixed_date` smallint(3) NOT NULL default '5',
  `bo_use_pointpost` char(1) NOT NULL default '',
  `bo_pointpost_point` varchar(255) NOT NULL default '',
  `bo_write_limit` smallint(3) NOT NULL default '0',
  `bo_cmt_best_min` tinyint(2) NOT NULL default '10',
  `bo_cmt_best_limit` tinyint(2) NOT NULL default '5',
  `bo_tag_level` tinyint(4) NOT NULL default '2',
  `bo_tag_limit` tinyint(4) NOT NULL default '10',
  `bo_automove` varchar(255) NOT NULL,
  `bo_best` varchar(255) NOT NULL,
  `bo_use_scheduled` char(1) NOT NULL default '',
  `bo_table_scheduled` varchar(30) NOT NULL,
  `bo_scheduled_ip` varchar(20) NOT NULL,
  `bo_exif_detail` text NOT NULL,
  `bo_blind_limit` tinyint(2) NOT NULL default '5',
  `bo_blind_view` tinyint(2) NOT NULL default '10',
  `bo_blind_direct` tinyint(2) NOT NULL default '10',
  `bo_cmtpoint_target` char(1) NOT NULL default '1',
  `bo_firstcmt_point` int(7) NOT NULL default '0',
  `bo_firstcmt_point_type` char(1) NOT NULL default '1',
  `bo_bomb_point` int(7) NOT NULL default '0',
  `bo_bomb_point_type` char(1) NOT NULL default '1',
  `bo_bomb_point_limit` int(3) NOT NULL default '10',
  `bo_bomb_point_cnt` int(2) NOT NULL default '1',
  `bo_lucky_point` int(7) NOT NULL default '0',
  `bo_lucky_point_type` char(1) NOT NULL default '1',
  `bo_lucky_point_ratio` int(2) NOT NULL default '1',
  `download_fee_ratio` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`bo_id`),
  KEY `bo_table` (`bo_table`),
  KEY `bo_theme` (`bo_theme`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_menu`
--

DROP TABLE IF EXISTS `g5_eyoom_menu`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_menu` (
  `me_id` int(11) NOT NULL auto_increment,
  `me_theme` varchar(20) NOT NULL,
  `me_code` varchar(255) NOT NULL default '',
  `me_name` varchar(255) NOT NULL default '',
  `me_icon` varchar(100) NOT NULL,
  `me_shop` char(1) NOT NULL default '2',
  `me_path` varchar(255) NOT NULL,
  `me_type` varchar(30) NOT NULL,
  `me_pid` varchar(40) NOT NULL,
  `me_sca` varchar(50) NOT NULL,
  `me_link` varchar(255) NOT NULL default '',
  `me_target` varchar(255) NOT NULL default '',
  `me_order` int(11) NOT NULL default '0',
  `me_permit_level` tinyint(4) NOT NULL default '1',
  `me_side` enum('y','n') NOT NULL default 'y',
  `me_use` enum('y','n') NOT NULL default 'y',
  `me_use_nav` enum('y','n') NOT NULL default 'y',
  PRIMARY KEY  (`me_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_theme`
--

DROP TABLE IF EXISTS `g5_eyoom_theme`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_theme` (
  `tm_name` varchar(40) NOT NULL,
  `tm_alias` varchar(20) NOT NULL,
  `tm_key` varchar(100) NOT NULL,
  `cm_key` varchar(255) NOT NULL,
  `cm_salt` varchar(10) NOT NULL,
  `tm_last` varchar(20) NOT NULL,
  `tm_time` varchar(20) NOT NULL,
  UNIQUE KEY `tm_name` (`tm_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_yellowcard`
--

DROP TABLE IF EXISTS `g5_eyoom_yellowcard`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_yellowcard` (
  `yc_id` int(11) unsigned NOT NULL auto_increment,
  `bo_table` varchar(20) NOT NULL default '',
  `wr_id` int(11) NOT NULL default '0',
  `pr_id` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL default '',
  `yc_reason` char(1) NOT NULL,
  `yc_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`yc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_rating`
--

DROP TABLE IF EXISTS `g5_eyoom_rating`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_rating` (
  `rt_id` int(11) unsigned NOT NULL auto_increment,
  `bo_table` varchar(20) NOT NULL default '',
  `wr_id` int(11) NOT NULL default '0',
  `mb_id` varchar(20) NOT NULL default '',
  `rating` smallint(2) NOT NULL default '0',
  `comment` varchar(255) NOT NULL,
  `rt_good` int(11) NOT NULL default '0',
  `rt_nogood` int(11) NOT NULL default '0',
  `rt_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`rt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_tag`
--

DROP TABLE IF EXISTS `g5_eyoom_tag`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_tag` (
  `tg_id` int(11) unsigned NOT NULL auto_increment,
  `tg_word` varchar(20) NOT NULL default '',
  `tg_theme` varchar(40) NOT NULL default 'basic',
  `tg_regcnt` int(11) unsigned NOT NULL default '0',
  `tg_dpmenu` enum('y','n') NOT NULL default 'n',
  `tg_scnt` int(11) NOT NULL default '0',
  `tg_score` int(11) NOT NULL default '0',
  `tg_recommdt` datetime NOT NULL default '0000-00-00 00:00:00',
  `tg_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`tg_id`),
  KEY `tg_word` (`tg_word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_tag_write`
--

DROP TABLE IF EXISTS `g5_eyoom_tag_write`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_tag_write` (
  `tw_id` int(11) unsigned NOT NULL auto_increment,
  `tw_theme` varchar(40) NOT NULL,
  `bo_table` varchar(20) NOT NULL default '',
  `wr_id` int(11) NOT NULL default '0',
  `wr_subject` varchar(255) NOT NULL,
  `wr_option` set('html1','html2','secret','mail') NOT NULL,
  `wr_content` text NOT NULL,
  `wr_tag` text NOT NULL,
  `wr_image` text NOT NULL,
  `wr_hit` int(11) NOT NULL default '0',
  `mb_id` varchar(20) NOT NULL default '',
  `mb_name` varchar(50) NOT NULL,
  `mb_nick` varchar(50) NOT NULL,
  `mb_level` varchar(255) NOT NULL,
  `tw_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `eb_1` varchar(255) NOT NULL,
  `eb_2` varchar(255) NOT NULL,
  `eb_3` varchar(255) NOT NULL,
  `eb_4` varchar(255) NOT NULL,
  `eb_5` varchar(255) NOT NULL,
  `eb_6` varchar(255) NOT NULL,
  `eb_7` varchar(255) NOT NULL,
  `eb_8` varchar(255) NOT NULL,
  `eb_9` varchar(255) NOT NULL,
  `eb_10` varchar(255) NOT NULL,
  PRIMARY KEY  (`tw_id`),
  KEY `mb_id` (`mb_id`),
  KEY `wr_hit` (`wr_hit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_best`
--

DROP TABLE IF EXISTS `g5_eyoom_best`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_best` (
  `bb_id` int(11) unsigned NOT NULL auto_increment,
  `bo_table` varchar(20) NOT NULL,
  `wr_id` int(11) NOT NULL,
  `mb_id` varchar(20) NOT NULL,
  `wr_good` int(11) NOT NULL default '0',
  `wr_hit` int(11) NOT NULL default '0',
  `wr_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `bb_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`bb_id`),
  KEY `mb_id` (`mb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_goods`
--

DROP TABLE IF EXISTS `g5_eyoom_goods`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_goods` (
  `eg_no` int(10) unsigned NOT NULL auto_increment,
  `eg_code` varchar(20) NOT NULL,
  `eg_subject` varchar(255) NOT NULL,
  `eg_theme` varchar(30) NOT NULL default 'eb4_basic',
  `eg_skin` varchar(50) NOT NULL default 'basic',
  `eg_state` smallint(1) NOT NULL default '0',
  `eg_link` varchar(255) NOT NULL,
  `eg_target` varchar(10) NOT NULL,
  `eg_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`eg_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_goods_item`
--

DROP TABLE IF EXISTS `g5_eyoom_goods_item`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_goods_item` (
  `gi_no` int(10) unsigned NOT NULL auto_increment,
  `eg_code` varchar(20) NOT NULL,
  `gi_theme` varchar(30) NOT NULL default '',
  `gi_state` char(1) NOT NULL default '2',
  `gi_sort` int(10) default '0',
  `gi_title` varchar(255) NOT NULL,
  `gi_link` varchar(255) NOT NULL,
  `gi_target` varchar(10) NOT NULL,
  `gi_ca_id` varchar(20) NOT NULL default '',
  `gi_ca_ids` varchar(255) NOT NULL default '',
  `gi_exclude` varchar(255) NOT NULL default '',
  `gi_include` varchar(255) NOT NULL default '',
  `gi_count` smallint(2) NOT NULL default '5',
  `gi_sortby` smallint(2) NOT NULL default '1',
  `gi_view_it_id` char(1) NOT NULL default 'y',
  `gi_view_it_name` char(1) NOT NULL default 'y',
  `gi_view_it_basic` char(1) NOT NULL default 'y',
  `gi_view_it_cust_price` char(1) NOT NULL default 'y',
  `gi_view_it_price` char(1) NOT NULL default 'y',
  `gi_view_it_icon` char(1) NOT NULL default 'y',
  `gi_view_img` char(1) NOT NULL default 'y',
  `gi_view_sns` char(1) NOT NULL default 'y',
  `gi_img_width` smallint(3) NOT NULL default '300',
  `gi_img_height` smallint(3) NOT NULL default '0',
  `gi_view_level` tinyint(4) NOT NULL default '1',
  `gi_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`gi_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_slider`
--

DROP TABLE IF EXISTS `g5_eyoom_slider`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_slider` (
  `es_no` int(10) unsigned NOT NULL auto_increment,
  `es_code` varchar(255) NOT NULL,
  `es_subject` varchar(255) NOT NULL,
  `es_theme` varchar(30) NOT NULL default 'eb4_basic',
  `es_skin` varchar(50) NOT NULL default 'basic',
  `es_text` text NOT NULL,
  `es_ytplay` char(1) NOT NULL default '1',
  `es_ytmauto` char(1) NOT NULL default '2',
  `es_state` smallint(1) NOT NULL default '0',
  `es_link` varchar(255) NOT NULL,
  `es_target` varchar(10) NOT NULL,
  `es_image` varchar(255) NOT NULL,
  `es_link_cnt` smallint(2) NOT NULL default '2',
  `es_image_cnt` smallint(2) NOT NULL default '3',
  `es_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`es_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_slider_item`
--

DROP TABLE IF EXISTS `g5_eyoom_slider_item`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_slider_item` (
  `ei_no` int(10) unsigned NOT NULL auto_increment,
  `es_code` varchar(255) NOT NULL,
  `ei_theme` varchar(50) NOT NULL default '',
  `ei_state` char(1) NOT NULL default '2',
  `ei_sort` int(10) default '0',
  `ei_title` varchar(255) NOT NULL,
  `ei_subtitle` varchar(255) NOT NULL,
  `ei_text` text NOT NULL,
  `ei_link` text NOT NULL,
  `ei_target` text NOT NULL,
  `ei_img` text NOT NULL,
  `ei_period` char(1) NOT NULL default '1',
  `ei_start` varchar(10) NOT NULL,
  `ei_end` varchar(10) NOT NULL,
  `ei_clicked` mediumint(10) NOT NULL default '0',
  `ei_view_level` tinyint(4) NOT NULL default '1',
  `ei_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ei_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_slider_ytitem`
--

DROP TABLE IF EXISTS `g5_eyoom_slider_ytitem`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_slider_ytitem` (
  `ei_no` int(10) unsigned NOT NULL auto_increment,
  `es_code` text NOT NULL,
  `ei_theme` varchar(30) NOT NULL default '',
  `ei_state` char(1) NOT NULL default '2',
  `ei_sort` int(10) default '0',
  `ei_ytcode` varchar(255) NOT NULL,
  `ei_quality` varchar(10) NOT NULL default 'hd1080',
  `ei_remember` char(1) NOT NULL default '1',
  `ei_autoplay` char(1) NOT NULL default '1',
  `ei_control` char(1) NOT NULL default '1',
  `ei_loop` char(1) NOT NULL default '1',
  `ei_mute` char(1) NOT NULL default '1',
  `ei_raster` char(1) NOT NULL default '1',
  `ei_volumn` smallint(3) NOT NULL default '10',
  `ei_stime` smallint(4) NOT NULL default '0',
  `ei_etime` smallint(4) NOT NULL default '0',
  `ei_period` char(1) NOT NULL default '1',
  `ei_start` varchar(10) NOT NULL,
  `ei_end` varchar(10) NOT NULL,
  `ei_view_level` tinyint(4) NOT NULL default '1',
  `ei_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ei_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_exboard`
--

DROP TABLE IF EXISTS `g5_eyoom_exboard`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_exboard` (
  `ex_no` int(11) unsigned NOT NULL auto_increment,
  `bo_table` varchar(20) NOT NULL,
  `ex_fname` varchar(10) NOT NULL,
  `ex_subject` varchar(50) NOT NULL,
  `ex_use_search` enum('y','n') NOT NULL default 'n',
  `ex_required` enum('y','n') NOT NULL default 'n',
  `ex_form` varchar(20) NOT NULL default 'text',
  `ex_type` varchar(20) NOT NULL,
  `ex_length` mediumint(5) NOT NULL,
  `ex_default` varchar(255) NOT NULL,
  `ex_item_value` text NOT NULL,
  PRIMARY KEY  (`ex_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_follow`
--

DROP TABLE IF EXISTS `g5_eyoom_follow`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_follow` (
  `fo_no` int(11) unsigned NOT NULL auto_increment,
  `fo_my_id` varchar(30) NOT NULL,
  `fo_mb_id` varchar(30) NOT NULL,
  `fo_friends` enum('y','n') NOT NULL default 'n',
  `fo_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`fo_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_like`
--

DROP TABLE IF EXISTS `g5_eyoom_like`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_like` (
  `lk_no` int(11) unsigned NOT NULL auto_increment,
  `lk_my_id` varchar(30) NOT NULL,
  `lk_mb_id` varchar(30) NOT NULL,
  `lk_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`lk_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_subscribe`
--

DROP TABLE IF EXISTS `g5_eyoom_subscribe`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_subscribe` (
  `sb_no` int(11) unsigned NOT NULL auto_increment,
  `sb_my_id` varchar(30) NOT NULL,
  `sb_mb_id` varchar(30) NOT NULL,
  `sb_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`sb_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_pin`
--

DROP TABLE IF EXISTS `g5_eyoom_pin`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_pin` (
  `pn_no` int(11) unsigned NOT NULL auto_increment,
  `mb_id` varchar(30) NOT NULL,
  `bo_table` varchar(20) NOT NULL default '',
  `wr_id` int(11) NOT NULL,
  `it_id` varchar(20) NOT NULL default '',
  `pn_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`pn_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_contents`
--

DROP TABLE IF EXISTS `g5_eyoom_contents`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_contents` (
  `ec_no` int(10) unsigned NOT NULL auto_increment,
  `ec_code` text NOT NULL,
  `me_id` int(10) unsigned NOT NULL default '0',
  `me_code` varchar(255) NOT NULL default '',
  `ec_name` varchar(255) NOT NULL default '',
  `ec_subject` text NOT NULL,
  `ec_text` text NOT NULL,
  `ec_theme` varchar(30) NOT NULL default 'eb4_basic',
  `ec_skin` varchar(50) NOT NULL default 'basic',
  `ec_state` smallint(1) NOT NULL default '0',
  `ec_link` varchar(255) NOT NULL,
  `ec_target` varchar(10) NOT NULL,
  `ec_image` varchar(255) NOT NULL,
  `ec_file` varchar(255) NOT NULL,
  `ec_filename` varchar(255) NOT NULL,
  `ec_sort` smallint(3) NOT NULL DEFAULT '0',
  `ec_link_cnt` smallint(2) NOT NULL default '2',
  `ec_image_cnt` smallint(2) NOT NULL default '5',
  `ec_ext_cnt` smallint(2) NOT NULL default '5',
  `ec_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ec_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_contents_item`
--

DROP TABLE IF EXISTS `g5_eyoom_contents_item`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_contents_item` (
  `ci_no` int(10) unsigned NOT NULL auto_increment,
  `ec_code` text NOT NULL,
  `ci_theme` varchar(30) NOT NULL default 'eb4_basic',
  `ci_state` char(1) NOT NULL default '2',
  `ci_sort` int(10) default '0',
  `ci_subject` text NOT NULL,
  `ci_text` text NOT NULL,
  `ci_content` text NOT NULL,
  `ci_link` text NOT NULL,
  `ci_target` text NOT NULL,
  `ci_img` text NOT NULL,
  `ci_period` char(1) NOT NULL default '1',
  `ci_start` varchar(10) NOT NULL,
  `ci_end` varchar(10) NOT NULL,
  `ci_view_level` tinyint(4) NOT NULL default '1',
  `ci_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`ci_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_latest`
--

DROP TABLE IF EXISTS `g5_eyoom_latest`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_latest` (
  `el_no` int(10) unsigned NOT NULL auto_increment,
  `el_code` varchar(20) NOT NULL,
  `el_subject` varchar(255) NOT NULL,
  `el_theme` varchar(30) NOT NULL default 'eb4_basic',
  `el_skin` varchar(50) NOT NULL default 'basic',
  `el_state` smallint(1) NOT NULL default '0',
  `el_cache` int(10) NOT NULL default '0',
  `el_new` mediumint(3) NOT NULL default '0',
  `el_link` varchar(255) NOT NULL,
  `el_target` varchar(10) NOT NULL,
  `el_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`el_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoomlatest_item`
--

DROP TABLE IF EXISTS `g5_eyoom_latest_item`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_latest_item` (
  `li_no` int(10) unsigned NOT NULL auto_increment,
  `el_code` varchar(20) NOT NULL,
  `li_theme` varchar(30) NOT NULL default '',
  `li_state` char(1) NOT NULL default '2',
  `li_sort` int(10) default '0',
  `li_title` varchar(255) NOT NULL,
  `li_link` varchar(255) NOT NULL,
  `li_target` varchar(10) NOT NULL,
  `li_bo_table` varchar(20) NOT NULL default '',
  `li_gr_id` varchar(20) NOT NULL default '',
  `li_exclude` varchar(255) NOT NULL default '',
  `li_include` varchar(255) NOT NULL default '',
  `li_tables` text NOT NULL,
  `li_direct` char(1) NOT NULL default 'n',
  `li_count` smallint(2) NOT NULL default '5',
  `li_depart` smallint(1) NOT NULL default '2',
  `li_period` smallint(2) NOT NULL default '0',
  `li_type` char(2) NOT NULL,
  `li_ca_view` char(1) NOT NULL default 'n',
  `li_cut_subject` smallint(2) NOT NULL default '50',
  `li_best` char(1) NOT NULL default 'n',
  `li_random` char(1) NOT NULL default 'n',
  `li_img_view` char(1) NOT NULL default 'n',
  `li_img_width` smallint(3) NOT NULL default '300',
  `li_img_height` smallint(3) NOT NULL default '300',
  `li_content` char(1) NOT NULL default 'n',
  `li_cut_content` smallint(3) NOT NULL default '100',
  `li_bo_subject` char(1) NOT NULL default 'n',
  `li_mbname_view` char(1) NOT NULL default 'y',
  `li_photo` char(1) NOT NULL default 'n',
  `li_use_date` char(1) NOT NULL default 'y',
  `li_date_type` char(1) NOT NULL default '1',
  `li_date_kind` varchar(20) NOT NULL,
  `li_view_level` tinyint(4) NOT NULL default '1',
  `li_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`li_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_brand`
--

DROP TABLE IF EXISTS `g5_eyoom_brand`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_brand` (
  `br_no` int(10) unsigned NOT NULL auto_increment,
  `br_code` varchar(255) NOT NULL,
  `br_name` varchar(255) NOT NULL,
  `br_basic` varchar(255) NULL,
  `br_sort` smallint(3) NOT NULL DEFAULT '0',
  `br_open` enum('y','n') NOT NULL DEFAULT 'y',
  `br_img` varchar(255) NULL,
  `br_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`br_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_banner`
--

DROP TABLE IF EXISTS `g5_eyoom_banner`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_banner` (
  `bn_no` int(10) unsigned NOT NULL auto_increment,
  `bn_code` varchar(20) NOT NULL,
  `bn_subject` varchar(255) NOT NULL DEFAULT '0',
  `bn_theme` varchar(30) NOT NULL default 'eb4_basic',
  `bn_skin` varchar(50) NOT NULL default 'basic',
  `bn_state` smallint(1) NOT NULL DEFAULT '0',
  `bn_image` varchar(255) NOT NULL,
  `bn_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`bn_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_banner_item`
--

DROP TABLE IF EXISTS `g5_eyoom_banner_item`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_banner_item` (
  `bi_no` int(10) unsigned NOT NULL auto_increment,
  `bn_code` varchar(20) NOT NULL,
  `bi_theme` varchar(30) NOT NULL default 'eb4_basic',
  `bi_type` enum('intra','extra') NOT NULL DEFAULT 'intra',
  `bi_state` char(1) NOT NULL default '2',
  `bi_sort` int(10) default '0',
  `bi_title` varchar(255) NOT NULL,
  `bi_subtitle` varchar(255) NOT NULL,
  `bi_script` text NOT NULL,
  `bi_link` varchar(255) NOT NULL DEFAULT '',
  `bi_img` varchar(255) NOT NULL DEFAULT '',
  `bi_period` char(1) NOT NULL default '1',
  `bi_start` varchar(10) NOT NULL,
  `bi_end` varchar(10) NOT NULL,
  `bi_exposed` mediumint(10) NOT NULL DEFAULT '0',
  `bi_clicked` mediumint(10) NOT NULL DEFAULT '0',
  `bi_view_level` tinyint(4) NOT NULL default '1',
  `bi_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`bi_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_banner_hit`
--

DROP TABLE IF EXISTS `g5_eyoom_banner_hit`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_banner_hit` (
    `bh_id` int(11) unsigned NOT NULL auto_increment,
    `bn_code` varchar(20) NOT NULL,
    `bi_no` int(11) NOT NULL,
    `bh_ip` varchar(100) NOT NULL DEFAULT '',
    `bh_date` date NOT NULL DEFAULT '0000-00-00',
    `bh_time` time NOT NULL DEFAULT '00:00:00',
    `bh_referer` text NOT NULL,
    `bh_agent` varchar(200) NOT NULL,
    PRIMARY KEY  (`bh_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_banner_date`
--

DROP TABLE IF EXISTS `g5_eyoom_banner_date`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_banner_date` (
    `bs_date` date NOT NULL DEFAULT '0000-00-00',
    `bs_expose` text NOT NULL,
    `bs_clicked` text NOT NULL,
    PRIMARY KEY  (`bs_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_wrfixed`
--

DROP TABLE IF EXISTS `g5_eyoom_wrfixed`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_wrfixed` (
    `bo_table` varchar(20) NOT NULL DEFAULT '',
    `wr_id` int(11) NOT NULL DEFAULT '0',
    `mb_id` varchar(30) NOT NULL,
    `bf_wrfixed_point` int(11) NOT NULL DEFAULT '0',
    `bf_wrfixed_date` smallint(3) NOT NULL DEFAULT '1',
    `bf_open` enum('y','n') NOT NULL DEFAULT 'n',
    `po_datetime` datetime NOT NULL,
    `ex_datetime` datetime NOT NULL,
    `bf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_favorite_adm`
--

DROP TABLE IF EXISTS `g5_eyoom_favorite_adm`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_favorite_adm` (
  `mb_id` varchar(30) NOT NULL,
  `dir` varchar(20) NOT NULL,
  `pid` varchar(40) NOT NULL,
  `fm_code` char(6) NOT NULL,
  `me_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_mbmemo`
--

DROP TABLE IF EXISTS `g5_eyoom_mbmemo`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_mbmemo` (
    `mm_no` int(11) unsigned NOT NULL auto_increment,
    `mm_my_id` varchar(30) NOT NULL,
    `mm_mb_id` varchar(30) NOT NULL,
    `mm_memo` text NOT NULL,
    PRIMARY KEY  (`mm_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_counsel`
--

DROP TABLE IF EXISTS `g5_eyoom_counsel`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_counsel` (
    `cs_id` int(11) UNSIGNED NOT NULL auto_increment,
    `mb_id` varchar(30) NOT NULL,
    `cs_part` varchar(20) NOT NULL,
    `cs_company` varchar(50) NOT NULL,
    `cs_name` varchar(30) NOT NULL,
    `cs_tel` varchar(20) NOT NULL,
    `cs_email` varchar(255) NOT NULL,
    `cs_subject` varchar(255) NOT NULL,
    `cs_content` text NOT NULL,
    `cs_file1` text NOT NULL,
    `cs_file2` text NOT NULL,
    `cs_memo` text NOT NULL,
    `cs_status` varchar(20) NOT NULL DEFAULT '',
    `cs_ip` varchar(255) NOT NULL,
    `cs_update` datetime NOT NULL,
    `cs_regdt` datetime NOT NULL,
    PRIMARY KEY  (`cs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_bbspoll`
--

DROP TABLE IF EXISTS `g5_eyoom_bbspoll`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_bbspoll` (
    `po_id` int(11) unsigned NOT NULL auto_increment,
    `bo_table` varchar(20) NOT NULL DEFAULT '',
    `wr_id` int(11) NOT NULL DEFAULT '0',
    `mb_id` varchar(20) NOT NULL DEFAULT '',
    `po_flag` char(2) NOT NULL DEFAULT '',
    `po_point` int(7) NOT NULL DEFAULT '0',
    `po_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY  (`po_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `g5_eyoom_scheduled`
--

DROP TABLE IF EXISTS `g5_eyoom_scheduled`;
CREATE TABLE IF NOT EXISTS `g5_eyoom_scheduled` (
    `sd_id` int(11) unsigned NOT NULL auto_increment,
    `bo_table` varchar(20) NOT NULL DEFAULT '',
    `wr_id` int(11) NOT NULL DEFAULT '0',
    `tg_table` varchar(20) NOT NULL DEFAULT '',
    `wr_opendate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    PRIMARY KEY  (`sd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;