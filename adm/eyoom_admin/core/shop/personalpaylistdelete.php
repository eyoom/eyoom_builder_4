<?php
/**
 * @file    /adm/eyoom_admin/core/shop/personalpayformupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = '400440';

check_demo();

auth_check_menu($auth, $sub_menu, 'd');

check_admin_token();

$count = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
if(!$count)
    alert('선택삭제 하실 항목을 하나이상 선택해 주세요.');

for ($i=0; $i<$count; $i++)
{
    // 실제 번호를 넘김
    $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
    $ppp_id = isset($_POST['pp_id'][$i]) ? preg_replace('/[^0-9]/', '', $_POST['pp_id'][$k]) : 0;

    $sql = " delete from {$g5['g5_shop_personalpay_table']} where pp_id = '{$ppp_id}' ";
    sql_query($sql);
}

alert("선택한 개인결제를 삭제처리하였습니다.", G5_ADMIN_URL . "/?dir=shop&amp;pid=personalpaylist&amp;{$qstr}");