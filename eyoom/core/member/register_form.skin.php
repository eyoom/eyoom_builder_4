<?php
/**
 * core file : /eyoom/core/member/register_form.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/member/register_form.skin.php');

/**
 * HTML 출력
 */
include_once ($eyoom_skin_path['member'].'/register_form.skin.html.php');