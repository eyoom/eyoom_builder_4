<?php
/**
 * @file    tail.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit; // 개별 페이지 접근 불가

/**
 * 폼전송 모드일 때 출력 방지
 */
if ($smode) return;

/**
 * 버전 표기
 */
$print_version = ($is_admin == 'super') ? 'Version ' . G5_GNUBOARD_VER : '';

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_ADMIN_USER_PATH . '/admin.tail.php');

/**
 * 테일 디자인 출력
 */
@include_once(EYOOM_ADMIN_THEME_PATH . "/admin.tail.html.php");