<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemlistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400300";

check_demo();

check_admin_token();

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        $p_ca_id = is_array($_POST['ca_id']) ? strip_tags($_POST['ca_id'][$k]) : '';
        $p_ca_id2 = is_array($_POST['ca_id2']) ? strip_tags($_POST['ca_id2'][$k]) : '';
        $p_ca_id3 = is_array($_POST['ca_id3']) ? strip_tags($_POST['ca_id3'][$k]) : '';
        $p_it_name = is_array($_POST['it_name']) ? strip_tags($_POST['it_name'][$k]) : '';
        $p_it_cust_price = is_array($_POST['it_cust_price']) ? strip_tags($_POST['it_cust_price'][$k]) : '';
        $p_it_price = is_array($_POST['it_price']) ? strip_tags($_POST['it_price'][$k]) : '';
        $p_it_stock_qty = is_array($_POST['it_stock_qty']) ? strip_tags($_POST['it_stock_qty'][$k]) : '';
        $p_it_skin = is_array($_POST['it_skin']) ? strip_tags($_POST['it_skin'][$k]) : '';
        $p_it_mobile_skin = is_array($_POST['it_mobile_skin']) ? strip_tags($_POST['it_mobile_skin'][$k]) : '';
        $p_it_use = is_array($_POST['it_use']) ? strip_tags($_POST['it_use'][$k]) : '';
        $p_it_soldout = is_array($_POST['it_soldout']) ? strip_tags($_POST['it_soldout'][$k]) : '';
        $p_it_order = is_array($_POST['it_order']) ? strip_tags($_POST['it_order'][$k]) : '';

        $sql = "update {$g5['g5_shop_item_table']}
                    set ca_id          = '".sql_real_escape_string($p_ca_id)."',
                        ca_id2         = '".sql_real_escape_string($p_ca_id2)."',
                        ca_id3         = '".sql_real_escape_string($p_ca_id3)."',
                        it_name        = '".$p_it_name."',
                        it_cust_price  = '".sql_real_escape_string($p_it_cust_price)."',
                        it_price       = '".sql_real_escape_string($p_it_price)."',
                        it_stock_qty   = '".sql_real_escape_string($p_it_stock_qty)."',
                        it_skin        = '".sql_real_escape_string($p_it_skin)."',
                        it_mobile_skin = '".sql_real_escape_string($p_it_mobile_skin)."',
                        it_use         = '".sql_real_escape_string($p_it_use)."',
                        it_soldout     = '".sql_real_escape_string($p_it_soldout)."',
                        it_order       = '".sql_real_escape_string($p_it_order)."',
                        it_update_time = '".G5_TIME_YMDHIS."'
                where it_id   = '{$_POST['it_id'][$k]}' ";
        sql_query($sql);
    }
    $msg = "선택한 상품을 수정하였습니다.";

} else if ($_POST['act_button'] == "선택삭제") {

    if ($is_admin != 'super')
        alert('상품 삭제는 최고관리자만 가능합니다.');

    auth_check($auth[$sub_menu], 'd');

    // _ITEM_DELETE_ 상수를 선언해야 itemdelete.inc.php 가 정상 작동함
    define('_ITEM_DELETE_', true);

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        // include 전에 $it_id 값을 반드시 넘겨야 함
        $it_id = $_POST['it_id'][$k];
        include (G5_ADMIN_PATH . '/shop_admin/itemdelete.inc.php');
    }
    $msg = "선택한 상품을 삭제하였습니다.";
}

// query string
$qstr .= $sdt ? '&amp;sdt='.$sdt: '';
$qstr .= $fr_date ? '&amp;fr_date='.$fr_date: '';
$qstr .= $to_date ? '&amp;to_date='.$to_date: '';
$qstr .= $cate_a ? '&amp;cate_a='.$cate_a: '';
$qstr .= $cate_b ? '&amp;cate_b='.$cate_b: '';
$qstr .= $cate_c ? '&amp;cate_c='.$$cate_c: '';
$qstr .= $cate_d ? '&amp;cate_d='.$cate_d: '';

alert($msg, G5_ADMIN_URL . "/?dir=shop&amp;pid=itemlist&amp;{$qstr}");