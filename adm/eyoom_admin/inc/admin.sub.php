<?php
/**
 * @file    inc/admin.sub.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$is_subpage = true;
$act_file = EYOOM_ADMIN_CORE_PATH . "/{$dir}/{$pid}.php";

if (file_exists($act_file)) {
    include_once($act_file);
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