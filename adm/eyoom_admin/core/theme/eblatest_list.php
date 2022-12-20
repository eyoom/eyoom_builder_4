<?php
/**
 * @file    /adm/eyoom_admin/core/theme/eblatest_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999620";

auth_check_menu($auth, $sub_menu, 'r');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=eblatest_list_update&amp;smode=1';

/**
 * g5_board_new 테이블에 wr_hit 및 wr_comment 필드 체크 후, 없다면 추가
 */
if(!sql_query(" select wr_hit from {$g5['board_new_table']} limit 1 ", false)) {
    $sql = " alter table `{$g5['board_new_table']}`
                add `wr_hit` int(11) NOT NULL default '0' after `mb_id`,
                add `wr_comment` int(11) NOT NULL default '0' after `wr_hit`
    ";
    sql_query($sql, true);

    /**
     * 추가된 wr_id에 실제 히트수 업데이트
     */
    $latest->update_wr_id();
}

/**
 * EB최신글 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_latest'] . "` (
      `el_no` int(10) unsigned NOT NULL,
      `el_code` varchar(20) NOT NULL,
      `el_subject` varchar(255) NOT NULL,
      `el_theme` varchar(30) NOT NULL DEFAULT 'eb4_basic',
      `el_skin` varchar(50) NOT NULL DEFAULT 'basic',
      `el_state` smallint(1) NOT NULL DEFAULT '0',
      `el_cache` int(10) NOT NULL DEFAULT '0',
      `el_new` mediumint(3) NOT NULL DEFAULT '0',
      `el_link` varchar(255) NOT NULL,
      `el_target` varchar(10) NOT NULL,
      `el_regdt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
      PRIMARY KEY  (`el_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB최신글 아이템 파일 저장 경로
 */
$eblatest_folder = G5_DATA_PATH.'/eblatest/';
if(!@is_dir($eblatest_folder) ) {
    @mkdir($eblatest_folder, G5_DIR_PERMISSION);
    @chmod($eblatest_folder, G5_DIR_PERMISSION);
}

/**
 * 작업테마의 최신글 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_latest']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where el_theme='{$this_theme}' ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} order by el_regdt desc ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} order by el_regdt desc limit {$from_record}, {$rows}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['el_chg_code']    = "&lt;?php echo eb_latest('{$row['el_code']}'); ?&gt;";
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);