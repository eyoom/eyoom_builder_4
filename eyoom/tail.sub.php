<?php
/**
 * file : /eyoom/head.sub.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH . '/tail.sub.php');

/**
 * 하단 html 출력
 */
include_once(EYOOM_THEME_PATH . '/tail.sub.html.php');

/**
 * 후킹 이벤트 실행
 */
run_event('tail_sub');

/**
 * 이윰 테마파일 출력
 */
echo html_end(); // HTML 마지막 처리 함수