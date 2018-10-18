<?php
/**
 * core file : /eyoom/core/connect/current_connect.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/connect/current_connect.skin.php');

/**
 * HTML 출력
 */
include_once($eyoom_skin_path['connect'].'/current_connect.skin.html.php');