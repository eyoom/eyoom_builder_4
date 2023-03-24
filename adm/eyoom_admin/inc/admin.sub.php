<?php
/**
 * @file    inc/admin.sub.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 다중관리자 권한 체크
 */
if (isset($mg_auth) && $mg_auth && !in_array($dir, $mg_auth) && $member['mb_id'] != $config['cf_admin']) {
    alert("접근권한이 없습니다.");
    exit;
}

$is_subpage = true;
$act_file = EYOOM_ADMIN_CORE_PATH . "/{$dir}/{$pid}.php";

if (file_exists($act_file)) {
    include_once($act_file);
} else {
    $act_file = EYOOM_ADMIN_THEME_PATH . "/core/{$dir}/{$pid}.php";
    @include_once($act_file);
}

/**
 * 폼전송 모드일 때 출력 방지
 */
if ($smode) return;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_ADMIN_USER_PATH . "/core/{$dir}/{$pid}.html.php");

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/skin/{$dir}/{$pid}.html.php");