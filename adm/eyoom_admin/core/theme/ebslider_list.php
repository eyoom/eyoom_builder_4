<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

auth_check_menu($auth, $sub_menu, 'r');

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

$action_url1 = G5_ADMIN_URL . '/?dir=theme&amp;pid=ebslider_list_update&amp;smode=1';

/**
 * EB Slider 테이블 생성
 */
$sql = "
    CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_slider'] . "` (
      `es_no` int(10) unsigned NOT NULL auto_increment,
      `es_code` text NOT NULL,
      `es_subject` varchar(255) NOT NULL,
      `es_theme` varchar(30) NOT NULL default 'eb4_basic',
      `es_skin` varchar(50) NOT NULL default 'basic',
      `es_ytplay` char(1) NOT NULL default '1',
      `es_state` smallint(1) NOT NULL default '0',
      `es_link_cnt` smallint(2) NOT NULL default '2',
      `es_image_cnt` smallint(2) NOT NULL default '3',
      `es_link` varchar(255) NOT NULL,
      `es_target` varchar(10) NOT NULL,
      `es_image` varchar(255) NOT NULL,
      `es_regdt` datetime NOT NULL default '0000-00-00 00:00:00',
      PRIMARY KEY  (`es_no`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
";
$sql = get_db_create_replace($sql);
sql_query($sql, false);

/**
 * EB슬라이더 설정에서 유튜브동영상 플레이 방식 선택필드 추가
 */
if(!sql_query(" select es_ytplay from {$g5['eyoom_slider']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_slider']}` add `es_ytplay` char(1) NOT NULL default '1' after `es_skin` ";
    sql_query($sql, true);
}

if(!sql_query(" select es_ytmauto from {$g5['eyoom_slider']} limit 1 ", false)) {
    $sql = " alter table `{$g5['eyoom_slider']}` add `es_ytmauto` char(1) NOT NULL DEFAULT '2' after `es_ytplay` ";
    sql_query($sql, true);
}

/**
 * EB 슬라이더 아이템 파일 저장 경로
 */
$ebslider_folder = G5_DATA_PATH.'/ebslider/';
if(!@is_dir($ebslider_folder) ) {
    @mkdir($ebslider_folder, G5_DIR_PERMISSION);
    @chmod($ebslider_folder, G5_DIR_PERMISSION);
}

/**
 * 배너 테이블에서 작업테마의 슬라이더 레코드 정보 가져오기
 */
$sql_common = " from {$g5['eyoom_slider']} ";

/**
 * 작업테마 조건문
 */
$sql_search = " where es_theme='{$this_theme}' ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} order by es_regdt desc ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} order by es_regdt desc limit {$from_record}, {$rows}";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['es_chg_code']    = "&lt;?php echo eb_slider('{$row['es_code']}'); ?&gt;";
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);
