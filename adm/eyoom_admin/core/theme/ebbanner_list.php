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
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB banner 노출수 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_banner_date'] . "` (
        `bs_date` date NOT NULL DEFAULT '0000-00-00',
        `bs_expose` text NOT NULL,
        `bs_clicked` text NOT NULL,
        PRIMARY KEY  (`bs_date`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB배너 아이템 파일 저장 경로
 */
$ebbanner_folder = G5_DATA_PATH.'/ebbanner/';
if(!@is_dir($ebbanner_folder) ) {
    @mkdir($ebbanner_folder, G5_DIR_PERMISSION);
    @chmod($ebbanner_folder, G5_DIR_PERMISSION);
}

/**
 * 작업테마의 배너 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_banner']} ";

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
    $list[$i]['bn_chg_code']    = "&lt;?php echo eb_banner('{$row['bn_code']}'); ?&gt;";
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);