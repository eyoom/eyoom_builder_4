<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebgoods_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999500";

auth_check_menu($auth, $sub_menu, 'r');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebgoods_list_update&amp;smode=1';

/**
 * EB상품추출 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_goods'] . "` (
      `eg_no` int(10) unsigned NOT NULL,
      `eg_code` varchar(20) NOT NULL,
      `eg_subject` varchar(255) NOT NULL,
      `eg_theme` varchar(30) NOT NULL DEFAULT 'eb4_basic',
      `eg_skin` varchar(50) NOT NULL DEFAULT 'basic',
      `eg_state` smallint(1) NOT NULL DEFAULT '0',
      `eg_link` varchar(255) NOT NULL,
      `eg_target` varchar(10) NOT NULL,
      `eg_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
      PRIMARY KEY  (`eg_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB상품추출 아이템 파일 저장 경로
 */
$ebgoods_folder = G5_DATA_PATH.'/ebgoods/';
if(!@is_dir($ebgoods_folder) ) {
    @mkdir($ebgoods_folder, G5_DIR_PERMISSION);
    @chmod($ebgoods_folder, G5_DIR_PERMISSION);
}

/**
 * EB상품추출 마스터 레코드 가져오기
 */
$sql_common = " from {$g5['eyoom_goods']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where eg_theme='{$this_theme}' ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} order by eg_regdt desc ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} order by eg_regdt desc limit {$from_record}, {$rows}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['eg_chg_code']    = "&lt;?php echo eb_goods('{$row['eg_code']}'); ?&gt;";
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);