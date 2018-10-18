<?php
/**
 * @file	/adm/eyoom_admin/core/theme/eyoom_theme.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 테마관리 메뉴 depth
 */
$sub_key = substr($sub_menu,3,3);
if(!$sub_key) exit;

/**
 * 커뮤니티홈으로 설정된 테마
 */
$theme = $eyoom_default['theme'];

/**
 * 쇼핑몰홈으로 설정된 테마
 */
$shop_theme = $eyoom_default['shop_theme'];

/**
 * 현재 작업중인 테마
 */
$this_theme = $_GET['thema'];
if(!$this_theme) $this_theme = $theme;

/**
 * 작업중인 테마의 설정정보 가져오기
 */
$config_file = G5_DATA_PATH.'/eyoom.'.$this_theme.'.config.php';
if (!$this_theme) {
	$config_file = G5_DATA_PATH.'/eyoom.config.php';
}
unset($eyoom);
@include($config_file);