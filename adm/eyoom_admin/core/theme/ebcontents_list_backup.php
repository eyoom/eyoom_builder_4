<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebcontents_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999610";

auth_check_menu($auth, $sub_menu, 'r');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebcontents_list_update&amp;smode=1';

/**
 * EB Contents 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_contents'] . "` (
      `ec_no` int(10) unsigned NOT NULL auto_increment,
      `ec_code` text NOT NULL,
      `ec_subject` varchar(255) NOT NULL,
      `ec_theme` varchar(30) NOT NULL default 'basic3',
      `ec_skin` varchar(50) NOT NULL default 'basic',
      `ec_state` smallint(1) NOT NULL default '0',
      `ec_text` text NOT NULL,
      `ec_link_cnt` smallint(2) NOT NULL default '2',
      `ec_image_cnt` smallint(2) NOT NULL default '5',
      `ec_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
      PRIMARY KEY  (`ec_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB 컨텐츠 아이템 파일 저장 경로
 */
$ebcontents_folder = G5_DATA_PATH.'/ebcontents/';
$qfile->make_directory($ebcontents_folder);

/**
 * 배너 테이블에서 작업테마의 배너/광고 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_contents']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where ec_theme='{$this_theme}' ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} order by ec_regdt desc ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} order by ec_regdt desc limit {$from_record}, {$rows}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['ec_chg_code']    = "&lt;?php echo eb_contents('{$row['ec_code']}'); ?&gt;";
}

/**
 * 페이징
 */
$paging = $eb->set_paging('./?dir=theme&amp;pid=ebcontents_list&amp;'.$qstr.'&amp;page=');
