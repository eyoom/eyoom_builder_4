<?php
/**
 * @file    /adm/eyoom_admin/core/shop/couponlist_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400800";

check_demo();

auth_check($auth[$sub_menu], 'd');

check_admin_token();

$count = count($_POST['chk']);
if(!$count)
    alert('선택삭제 하실 항목을 하나이상 선택해 주세요.');

for ($i=0; $i<$count; $i++)
{
    // 실제 번호를 넘김
    $k = $_POST['chk'][$i];

    $sql = " delete from {$g5['g5_shop_coupon_table']} where cp_id = '{$_POST['cp_id'][$k]}' ";
    sql_query($sql);
}

goto_url(G5_ADMIN_URL . '/?dir=shop&amp;pid=couponlist&amp;'.$qstr);