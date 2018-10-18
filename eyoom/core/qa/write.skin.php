<?php
/**
 * core file : /eyoom/core/qa/write.skin.php
 */
if (!defined('_EYOOM_')) exit;

$option = '';
$option_hidden = '';

/**
 * 사용자 프로그램
 */
@include_once(EYOOM_USER_PATH.'/qa/write.skin.php');

/**
 * 출력
 */
include_once($eyoom_skin_path['qa'].'/write.skin.html.php');