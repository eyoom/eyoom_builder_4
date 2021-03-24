<?php
/**
 * @file    /adm/eyoom_admin/core/theme/menu_copy_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

/**
 * POST 변수 체크
 */
$theme      = isset($_POST['theme']) ? clean_xss_tags($_POST['theme']): '';
$me_shop    = isset($_POST['me_shop']) ? clean_xss_tags($_POST['me_shop']): '';
$tg_theme   = isset($_POST['tg_theme']) ? clean_xss_tags($_POST['tg_theme']): '';
$tg_me_shop = isset($_POST['tg_me_shop']) ? clean_xss_tags($_POST['tg_me_shop']): '';

if(!($theme && $me_shop && $tg_theme && $tg_me_shop)) {
    alert('잘못된 접근입니다.');
}

/**
 * 원본테마의 메뉴와 대상테마의 메뉴가 동일하다면 리턴
 */
if ($theme == $tg_theme && $me_shop == $tg_me_shop) {
    alert('원본과 대상이 동일하여 메뉴를 복사하실 수 없습니다.');
    exit;
}

/**
 * 대상테마의 메뉴 삭제
 */
$sql = "delete from {$g5['eyoom_menu']} where me_theme = '{$tg_theme}' and me_shop = '{$tg_me_shop}'";
sql_query($sql, false);

/**
 * 원본테마의 메뉴 복사
 */
$sql = "select * from {$g5['eyoom_menu']} where (1) and me_theme = '{$theme}' and me_shop = '{$me_shop}' order by me_code asc";
$res = sql_query($sql, false);
for($i=0; $row=sql_fetch_array($res); $i++) {
    unset($set, $insert);
    $set = "
        me_theme        = '" . $tg_theme . "',
        me_code         = '" . $row['me_code'] . "',
        me_name         = '" . $row['me_name'] . "',
        me_icon         = '" . $row['me_icon'] . "',
        me_shop         = '" . $tg_me_shop . "',
        me_path         = '" . $row['me_path'] . "',
        me_type         = '" . $row['me_type'] . "',
        me_pid          = '" . $row['me_pid'] . "',
        me_link         = '" . $row['me_link'] . "',
        me_target       = '" . $row['me_target'] . "',
        me_order        = '" . $row['me_order'] . "',
        me_permit_level = '" . $row['me_permit_level'] . "',
        me_side         = '" . $row['me_side'] . "',
        me_use          = '" . $row['me_use'] . "',
        me_use_nav      = '" . $row['me_use_nav'] . "'
    ";

    $insert = "insert into {$g5['eyoom_menu']} set {$set}";
    sql_query($insert, false);
}

alert('메뉴를 정상적으로 복사하였습니다.', G5_ADMIN_URL. "/?dir=theme&amp;pid=menu_copy&amp;thema={$theme}&amp;me_shop={$me_shop}&amp;wmode=1");