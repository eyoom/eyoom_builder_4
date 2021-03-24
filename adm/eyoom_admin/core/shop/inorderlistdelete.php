<?php
/**
 * @file    /adm/eyoom_admin/core/config/inorderlistdelete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400410";

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
    $od_id = isset($_POST['od_id'][$k]) ? safe_replace_regex($_POST['od_id'][$k], 'od_id') : '';
    $sql = " delete from {$g5['g5_shop_order_data_table']} where od_id = '{$od_id}' ";
    sql_query($sql);
}

goto_url(G5_ADMIN_URL . '/?dir=shop&amp;pid=inorderlist&amp;' . $qstr);