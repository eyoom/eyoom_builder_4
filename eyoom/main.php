<?php
/**
 * file : /eyoom/main.php
 */
define('_MAIN_', true);

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH . '/main.php');

/**
 * 이윰 테마파일 출력
 */
include_once(EYOOM_THEME_PATH . '/index.html.php');