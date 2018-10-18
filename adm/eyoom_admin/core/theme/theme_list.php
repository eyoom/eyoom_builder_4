<?php
/**
 * @file    /adm/eyoom_admin/core/theme/theme_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999100";

/**
 * 테마 폼 action
 */
$theme_action_url = G5_ADMIN_URL . "/?dir=theme&amp;pid=theme_list_update&amp;smode=1";

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");