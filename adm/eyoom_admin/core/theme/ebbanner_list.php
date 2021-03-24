<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebbanner_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999630";

auth_check_menu($auth, $sub_menu, 'r');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebbanner_list_update&amp;smode=1';

/**
 * EB배너 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_banner'] . "` (
      `bn_no` int(10) unsigned NOT NULL,
      `bn_code` varchar(20) NOT NULL,
      `bn_type` enum('intra','extra') NOT NULL DEFAULT 'intra',
      `bn_subject` varchar(255) NOT NULL DEFAULT '0',
      `bn_link` text,
      `bn_img` varchar(100) NOT NULL DEFAULT '',
      `bn_target` varchar(20) NOT NULL DEFAULT '',
      `bn_script` text NOT NULL,
      `bn_sort` int(10) DEFAULT '0',
      `bn_theme` varchar(30) NOT NULL DEFAULT 'default',
      `bn_state` smallint(1) NOT NULL DEFAULT '0',
      `bn_period` char(1) NOT NULL DEFAULT '1',
      `bn_start` varchar(10) NOT NULL,
      `bn_end` varchar(10) NOT NULL,
      `bn_exposed` mediumint(10) NOT NULL DEFAULT '0',
      `bn_clicked` mediumint(10) NOT NULL DEFAULT '0',
      `bn_view_level` tinyint(4) NOT NULL DEFAULT '1',
      `bn_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
      PRIMARY KEY  (`bn_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
sql_query($sql, false);

/**
 * EB최신글 아이템 파일 저장 경로
 */
$ebbanner_folder = G5_DATA_PATH.'/ebbanner/';
if(!@is_dir($ebbanner_folder) ) {
    @mkdir($ebbanner_folder, G5_DIR_PERMISSION);
    @chmod($ebbanner_folder, G5_DIR_PERMISSION);
}

/**
 * 작업테마의 최신글 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_latest']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where bn_theme='{$this_theme}' ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} order by bn_regdt desc ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} order by bn_regdt desc limit {$from_record}, {$rows}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['bn_chg_code']    = "&lt;?php echo eb_latest('{$row['bn_code']}'); ?&gt;";
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);