<?php
/**
 * @file    /adm/eyoom_admin/core/theme/theme_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999100";

check_demo();

if($is_admin != 'super') alert('최고관리자만 설정을 변경할 수 있습니다.');

unset($theme);
$theme      = isset($_POST['theme']) ? clean_xss_tags(trim($_POST['theme'])): '';
$shop_theme = isset($_POST['shop_theme']) ? clean_xss_tags(trim($_POST['shop_theme'])): '';
$back_theme = isset($_POST['back_theme']) ? clean_xss_tags(trim($_POST['back_theme'])): '';
$back_pid   = isset($_POST['back_pid']) ? clean_xss_tags(trim($_POST['back_pid'])): '';
$w          = isset($_POST['w']) ? clean_xss_tags(trim($_POST['w'])): '';
$bo_table   = isset($_POST['bo_table']) ? clean_xss_tags(trim($_POST['bo_table'])): '';

$qstr = '';
if($w) $qstr .= "&amp;w={$w}";
if($bo_table && !is_array($bo_table)) $qstr .= "&amp;bo_table={$bo_table}";

if ($theme) {
    $eyoom_default['theme'] = $theme;
}

// 쇼핑몰 테마인지 구별
if ($shop_theme) {
    $shop_dir = G5_PATH.'/theme/'.$shop_theme.'/skin/shop/';
    if(!is_dir($shop_dir)) alert("선택한 테마는 쇼핑몰 테마가 아닙니다.");

    $eyoom_default['shop_theme'] = $shop_theme;
}

$qfile->save_file('eyoom', $eyoom_config_file, $eyoom_default);

goto_url(G5_ADMIN_URL . "/?dir=theme&amp;pid=theme_list{$qstr}&amp;thema={$back_theme}");