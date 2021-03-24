<?php
/**
 * @file    /adm/eyoom_admin/core/shop/couponlist_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400800";

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

    $sql = " delete from {$g5['g5_shop_coupon_table']} where cp_id = '".preg_replace('/[^a-z0-9_\-]/i', '', $_POST['cp_id'][$k])."' ";
    sql_query($sql);
}

goto_url(G5_ADMIN_URL . '/?dir=shop&amp;pid=couponlist&amp;'.$qstr);