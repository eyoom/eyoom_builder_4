<?php
/**
 * core file : /eyoom/core/member/register.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/register.skin.php');

/**
 * HTML 출력
 */
include_once ($eyoom_skin_path['member'].'/register.skin.html.php');