<?php
/**
 * @file    head.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

/**
 * 폼전송 모드일 때 헤더 출력 방지
 */
if ($smode) return;
else {
    @include_once(EYOOM_ADMIN_INC_PATH.'/admin.menu.php');
}

/**
 * 그누 헤더정보 출력
 */
@include_once(G5_PATH.'/head.sub.php');

/**
 * 최고관리자 정보
 */
$adminfo = sql_fetch("select * from {$g5['member_table']} where mb_no = '1' limit 1");
if (!$adminfo) $adminfo = get_member($config['cf_admin']);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_ADMIN_USER_PATH . '/admin.head.php');

/**
 * 헤더 디자인 출력
 */
@include_once(EYOOM_ADMIN_THEME_PATH . '/admin.head.html.php');