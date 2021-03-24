<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_copy.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999300";

auth_check_menu($auth, $sub_menu, "r");

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");


$action_url1 = G5_ADMIN_URL . "/?dir=theme&amp;pid=menu_copy_update&amp;smode=1";

$is_shop = $_GET['me_shop'] === '1' ? 'shop': '';