<?php
/**
 * core file : /eyoom/core/member/login.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/login.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['member'].'/login.skin.html.php');
