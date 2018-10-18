<?php
/**
 * @file    inc/admin.index.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

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
for ($i=0; $row=sql_fetch_array($res); $i++) {
    $tminfo[$row['tm_name']] = $row;
}

/**
 * 영카트5 인가?
 */
if ($is_youngcart) {
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