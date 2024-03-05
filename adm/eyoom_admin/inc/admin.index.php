<?php
/**
 * @file    inc/admin.index.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 이윰 관리자 관련 설정
 */
if (!isset($config['cf_eyoom_admin'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_eyoom_admin` enum('y','n') NOT NULL DEFAULT 'y' AFTER `cf_add_script`,
                ADD `cf_eyoom_admin_theme` varchar(255) NOT NULL DEFAULT 'eba_basic' AFTER `cf_eyoom_admin`,
                ADD `cf_permit_level` tinyint(4) NOT NULL DEFAULT '1' AFTER `cf_eyoom_admin_theme` ", true);
}

/**
 * 회원메모 사용여부 설정 및 테이블 생성
 */
if (!isset($config['cf_use_mbmemo'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_use_mbmemo` tinyint(4) NOT NULL DEFAULT '1' AFTER `cf_permit_level` ", true);

    if(!sql_query(" DESCRIBE {$g5['eyoom_mbmemo']} ", false)) {
        $sql = "
            CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_mbmemo'] . "` (
                `mm_no` int(11) unsigned NOT NULL auto_increment,
                `mm_my_id` varchar(30) NOT NULL,
                `mm_mb_id` varchar(30) NOT NULL,
                `mm_memo` text NOT NULL,
                PRIMARY KEY (`mm_no`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 
        ";

        $sql = get_db_create_replace($sql, false);
        sql_query($sql, false);
    }
}

/**
 * 관리자모드 즐겨찾기 테이블 생성
 */
if(!sql_query(" DESCRIBE {$g5['eyoom_favorite_adm']} ", false)) {
    $sql = "
        CREATE TABLE IF NOT EXISTS `" . $g5['eyoom_favorite_adm'] . "` (
            `mb_id` varchar(30) NOT NULL,
            `dir` varchar(20) NOT NULL,
            `pid` varchar(40) NOT NULL,
            `fm_code` char(6) NOT NULL,
            `me_name` varchar(255) NOT NULL
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 
    ";

    $sql = get_db_create_replace($sql, false);
    sql_query($sql, false);
}

/**
 * 소셜로그인 디버그 파일 24시간 지난것은 삭제
 */
@include_once('./safe_check.php');
if(function_exists('social_log_file_delete')){
    social_log_file_delete(86400);
}

/**
 * 설치 테마들
 */
$sql = "select * from {$g5['eyoom_theme']} where 1 ";
$res = sql_query($sql,false);
$tminfo = array();
for ($i=0; $row=sql_fetch_array($res); $i++) {
    $tminfo[$row['tm_name']] = $row;
}

/**
 * 영카트5 인가?
 */
if ($is_youngcart && ($member['mb_id'] == $config['cf_admin'] || in_array('shop', $mg_auth))) {
    include_once(EYOOM_ADMIN_INC_PATH.'/shop.index.php');
}

/**
 * 그누보드5/영카트5 공통
 */
include_once(EYOOM_ADMIN_INC_PATH. '/common.index.php');

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_ADMIN_USER_PATH . '/inc/admin.index.php');

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/admin.index.html.php");