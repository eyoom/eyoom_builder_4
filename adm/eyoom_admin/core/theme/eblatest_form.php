<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_form_update&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_itemlist_update&amp;smode=1';

if ($w == 'u') {
    $el_code = isset($_REQUEST['el_code']) && $_REQUEST['el_code'] ? clean_xss_tags($_REQUEST['el_code']) : '';
    if (!$el_code) alert("잘못된 접근입니다.");
}

/**
 * EB최신글 아이템 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_latest_item'] . "` (
      `li_no` int(10) unsigned NOT NULL auto_increment,
      `el_code` varchar(20) NOT NULL,
      `li_theme` varchar(30) NOT NULL default '',
      `li_state` char(1) NOT NULL default '2',
      `li_sort` int(10) default '0',
      `li_title` varchar(255) NOT NULL,
      `li_link` varchar(255) NOT NULL,
      `li_target` varchar(10) NOT NULL,
      `li_bo_table` varchar(20) NOT NULL default '',
      `li_ca_name` varchar(50) NOT NULL default '',
      `li_gr_id` varchar(20) NOT NULL default '',
      `li_exclude` varchar(255) NOT NULL default '',
      `li_include` varchar(255) NOT NULL default '',
      `li_tables` text NOT NULL,
      `li_count` smallint(2) NOT NULL default '5',
      `li_depart` smallint(1) NOT NULL default '2',
      `li_period` smallint(4) NOT NULL default '0',
      `li_type` char(2) NOT NULL,
      `li_ca_view` char(1) NOT NULL default 'n',
      `li_ca_name` varchar(50) NOT NULL default '',
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
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * 게시판 분류(카테고리) 설정 필드 추가
 */
if (!sql_query(" select li_ca_name from {$g5['eyoom_latest_item']} limit 1", false)) {
    $sql = " ALTER TABLE `{$g5['eyoom_latest_item']}` ADD `li_ca_name` varchar(50) NOT NULL DEFAULT '' AFTER `li_bo_table`";
    sql_query($sql, false);
}

/**
 * 스킨 디렉토리 읽어오기
 */
$eblatest_skins = get_skin_dir('eblatest', G5_PATH.'/theme/'.$this_theme.'/skin');

/**
 * EB최신글 정보 가져오기
 */
if ($w == 'u') {
    $el = sql_fetch("select * from {$g5['eyoom_latest']} where el_code = '{$el_code}' and el_theme='{$this_theme}'");
    if (!$el) {
        alert('존재하지 않는 최신글입니다.', G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_list&amp;page=1');
    }
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_list&amp;page='.$page.'&amp;thema='.$this_theme.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';

/**
 * 최신글 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_latest_item']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where li_theme='{$this_theme}' and el_code = '{$el_code}' ";

$sql = " select * {$sql_common} {$sql_search} order by li_sort asc";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $view_level = get_member_level_select("li_view_level[$i]", 1, $member['mb_level'], $row['li_view_level']);
    $list[$i]['view_level'] = preg_replace("/(\\n|\\r)/","",str_replace('"', "'", $view_level));
}