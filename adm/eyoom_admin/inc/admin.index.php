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
                ADD `cf_eyoom_admin_theme` varchar(255) NOT NULL DEFAULT 'basic' AFTER `cf_eyoom_admin`,
                ADD `cf_permit_level` tinyint(4) NOT NULL DEFAULT '1' AFTER `cf_eyoom_admin_theme` ", true);
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