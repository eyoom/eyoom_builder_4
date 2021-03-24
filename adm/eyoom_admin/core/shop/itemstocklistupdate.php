<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemstocklistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400620";

check_demo();

auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

$count_post_it_id = (isset($_POST['it_id']) && is_array($_POST['it_id'])) ? count($_POST['it_id']) : 0;

// 재고 일괄수정
for ($i=0; $i<count((array)$_POST['it_id']); $i++)
{
    $it_stock_qty = isset($_POST['it_stock_qty'][$i]) ? (int) $_POST['it_stock_qty'][$i] : 0;
    $it_noti_qty = isset($_POST['it_noti_qty'][$i]) ? (int) $_POST['it_noti_qty'][$i] : 0;
    $it_use = isset($_POST['it_use'][$i]) ? (int) $_POST['it_use'][$i] : 0;
    $it_soldout = isset($_POST['it_soldout'][$i]) ? (int) $_POST['it_soldout'][$i] : 0;
    $it_stock_sms = isset($_POST['it_stock_sms'][$i]) ? (int) $_POST['it_stock_sms'][$i] : 0;
    $it_id = isset($_POST['it_id'][$i]) ? safe_replace_regex($_POST['it_id'][$i], 'it_id') : '';

    $sql = "update {$g5['g5_shop_item_table']}
               set it_stock_qty    = '".$it_stock_qty."',
                   it_noti_qty     = '".$it_noti_qty."',
                   it_use          = '".$it_use."',
                   it_soldout      = '".$it_soldout."',
                   it_stock_sms    = '".$it_stock_sms."'
             where it_id = '".$it_id."' ";
    sql_query($sql);
}

goto_url(G5_ADMIN_URL . "/?dir=shop&amp;pid=itemstocklist&amp;".$qstr."page=$page");