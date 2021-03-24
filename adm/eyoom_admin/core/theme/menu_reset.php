<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_reset.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

auth_check_menu($auth, $sub_menu, 'w');

if ($is_admin != 'super') alert("권한이 없습니다.");

/**
 * 변수 체크
 */
$theme      = isset($_GET['thema']) ? clean_xss_tags(trim($_GET['thema'])): '';
$me_shop    = isset($_GET['me_shop']) ? clean_xss_tags(trim($_GET['me_shop'])): '';

if(!($theme && $me_shop)) {
    alert('잘못된 접근입니다.');
}

$is_shop = $me_shop === '1' ? 'shop': '';

/**
 * 대상테마의 메뉴 삭제
 */
$sql = "delete from {$g5['eyoom_menu']} where me_theme = '{$theme}' and me_shop = '{$me_shop}'";
sql_query($sql, false);

alert("정상적으로 메뉴를 초기화 하였습니다.", G5_ADMIN_URL."/?dir=theme&amp;pid={$is_shop}menu_list");