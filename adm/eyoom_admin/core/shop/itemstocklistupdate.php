<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemstocklistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400620";

check_demo();

auth_check($auth[$sub_menu], "w");

check_admin_token();

// 재고 일괄수정
for ($i=0; $i<count($_POST['it_id']); $i++)
{
    $sql = "update {$g5['g5_shop_item_table']}
               set it_stock_qty    = '{$_POST['it_stock_qty'][$i]}',
                   it_noti_qty     = '{$_POST['it_noti_qty'][$i]}',
                   it_use          = '{$_POST['it_use'][$i]}',
                   it_soldout      = '{$_POST['it_soldout'][$i]}',
                   it_stock_sms    = '{$_POST['it_stock_sms'][$i]}'
             where it_id = '{$_POST['it_id'][$i]}' ";
    sql_query($sql);
}

goto_url(G5_ADMIN_URL . "/?dir=shop&amp;pid=itemstocklist&amp;".$qstr."page=$page");