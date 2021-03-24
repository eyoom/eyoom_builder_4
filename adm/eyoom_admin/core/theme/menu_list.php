<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999300";

auth_check_menu($auth, $sub_menu, "r");

/**
 * 테마 환경설정 파일
 */
include_once(EYOOM_ADMIN_CORE_PATH . "/theme/theme_head.php");

/**
 * 커뮤니티 메뉴인지 쇼핑몰메뉴 인지 설정
 */
$me_shop = 2; // 커뮤니티 메뉴

$action_url1 = G5_ADMIN_URL . "/?dir=theme&amp;pid=menu_form_update&amp;smode=1";