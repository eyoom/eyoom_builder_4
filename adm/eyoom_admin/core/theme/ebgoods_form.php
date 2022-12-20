<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

auth_check_menu($auth, $sub_menu, 'w');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_form_update&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_itemlist_update&amp;smode=1';

if ($w == 'u') {
    $eg_code = isset($_REQUEST['eg_code']) && $_REQUEST['eg_code'] ? clean_xss_tags($_REQUEST['eg_code']) : '';
    if (!$eg_code) alert("잘못된 접근입니다.");
}

/**
 * EB상품추출 아이템 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_goods_item'] . "` (
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
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * 스킨 디렉토리 읽어오기
 */
$ebgoods_skins = get_skin_dir('ebgoods', G5_PATH.'/theme/'.$this_theme.'/skin');

/**
 * EB상품추출 정보 가져오기
 */
if ($w == 'u') {
    $eg = sql_fetch("select * from {$g5['eyoom_goods']} where eg_code = '{$eg_code}' and eg_theme='{$this_theme}'");
    if (!$eg) {
        alert('존재하지 않는 상품입니다.', G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_list&amp;page=1');
    }
}

/**
 * 버튼셋
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_list&amp;page='.$page.'&amp;thema='.$this_theme.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';

/**
 * 상품 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_goods_item']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where gi_theme='{$this_theme}' and eg_code = '{$eg_code}' ";

$sql = " select * {$sql_common} {$sql_search} order by gi_sort asc";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $view_level = get_member_level_select("gi_view_level[$i]", 1, $member['mb_level'], $row['gi_view_level']);
    $list[$i]['view_level'] = preg_replace("/(\\n|\\r)/","",str_replace('"', "'", $view_level));
}

$count = count($list);