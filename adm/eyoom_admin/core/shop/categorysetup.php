<?php
/**
 * @file    /adm/eyoom_admin/core/shop/categorysetup.php
 */
include_once('./_common.php');

$ca_run = false;

$ca_id = isset($_POST['id']) ? preg_replace('/[^0-9a-z]/i', '', $_POST['id']) : '';
if ( $ca_id === 0 || (strlen($ca_id) == 1 && $ca_id == '0') ) $ca_id = '';

$depth = strlen($ca_id)/2;

$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=categoryformupdate&amp;smode=1";

if($ca_id) {
    $sql = "select * from {$g5['g5_shop_category_table']} where ca_id='{$ca_id}' ";
    $cainfo = sql_fetch($sql, false);

    if($cainfo['ca_use'] == '1') $checked['ca_use1'] = 'checked'; else $checked['ca_use2'] = 'checked';
    if(!$cainfo['ca_path']) {
        $cainfo['ca_path'] = $thema->get_path($cainfo['ca_id']);
    }
}

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/skin/shop/categoryform.html.php");