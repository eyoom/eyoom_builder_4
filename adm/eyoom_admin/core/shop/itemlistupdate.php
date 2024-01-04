<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemlistupdate.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400300";

check_demo();

check_admin_token();

$count_post_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$post_act_button = isset($_POST['act_button']) ? $_POST['act_button'] : '';

if (! $count_post_chk) {
    alert($post_act_button." 하실 항목을 하나 이상 체크하세요.");
}

if ($post_act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i< $count_post_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $p_it_name = (isset($_POST['it_name']) && is_array($_POST['it_name'])) ? strip_tags(clean_xss_attributes($_POST['it_name'][$k])) : '';
        $p_it_cust_price = (isset($_POST['it_cust_price']) && is_array($_POST['it_cust_price'])) ? strip_tags($_POST['it_cust_price'][$k]) : '';
        $p_it_price = (isset($_POST['it_price']) && is_array($_POST['it_price'])) ? strip_tags($_POST['it_price'][$k]) : '';
        $p_it_stock_qty = (isset($_POST['it_stock_qty']) && is_array($_POST['it_stock_qty'])) ? strip_tags($_POST['it_stock_qty'][$k]) : '';
        $p_it_use       = isset($_POST['it_use'][$k])       ? clean_xss_tags($_POST['it_use'][$k], 1, 1)        : 0;
        $p_it_soldout   = isset($_POST['it_soldout'][$k])   ? clean_xss_tags($_POST['it_soldout'][$k], 1, 1)    : 0;
        $p_it_order = (isset($_POST['it_order']) && is_array($_POST['it_order'])) ? strip_tags($_POST['it_order'][$k]) : '';
        $p_it_type1 = (isset($_POST['it_type1']) && is_array($_POST['it_type1'])) ? strip_tags($_POST['it_type1'][$k]) : '';
        $p_it_type2 = (isset($_POST['it_type2']) && is_array($_POST['it_type2'])) ? strip_tags($_POST['it_type2'][$k]) : '';
        $p_it_type3 = (isset($_POST['it_type3']) && is_array($_POST['it_type3'])) ? strip_tags($_POST['it_type3'][$k]) : '';
        $p_it_type4 = (isset($_POST['it_type4']) && is_array($_POST['it_type4'])) ? strip_tags($_POST['it_type4'][$k]) : '';
        $p_it_type5 = (isset($_POST['it_type5']) && is_array($_POST['it_type5'])) ? strip_tags($_POST['it_type5'][$k]) : '';
        $p_it_id = isset($_POST['it_id'][$k]) ? preg_replace('/[^a-z0-9_\-]/i', '', $_POST['it_id'][$k]) : '';

        if ($is_admin != 'super') {     // 최고관리자가 아니면 체크
            $sql = "select a.it_id, b.ca_mb_id from {$g5['g5_shop_item_table']} a , {$g5['g5_shop_category_table']} b where (a.ca_id = b.ca_id) and a.it_id = '$p_it_id'";
            $checks = sql_fetch($sql);

            if( ! $checks['ca_mb_id'] || $checks['ca_mb_id'] !== $member['mb_id'] ){
                continue;
            }
        }

        $sql = "update {$g5['g5_shop_item_table']}
                   set it_name        = '".$p_it_name."',
                       it_cust_price  = '".sql_real_escape_string($p_it_cust_price)."',
                       it_price       = '".sql_real_escape_string($p_it_price)."',
                       it_stock_qty   = '".sql_real_escape_string($p_it_stock_qty)."',
                       it_use         = '".sql_real_escape_string($p_it_use)."',
                       it_soldout     = '".sql_real_escape_string($p_it_soldout)."',
                       it_order       = '".sql_real_escape_string($p_it_order)."',
                       it_type1       = '$p_it_type1',
                       it_type2       = '$p_it_type2',
                       it_type3       = '$p_it_type3',
                       it_type4       = '$p_it_type4',
                       it_type5       = '$p_it_type5',
                       it_update_time = '".G5_TIME_YMDHIS."'
                 where it_id   = '".$p_it_id."' ";
        sql_query($sql);

		if( function_exists('shop_seo_title_update') ) shop_seo_title_update($p_it_id, true);
    }
    $msg = "선택한 상품정보를 수정하였습니다.";
} else if ($post_act_button == "선택삭제") {

    if ($is_admin != 'super')
        alert('상품 삭제는 최고관리자만 가능합니다.');

    auth_check_menu($auth, $sub_menu, 'd');

    // _ITEM_DELETE_ 상수를 선언해야 itemdelete.inc.php 가 정상 작동함
    define('_ITEM_DELETE_', true);

    for ($i=0; $i<count((array)$_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        // include 전에 $it_id 값을 반드시 넘겨야 함
        $it_id = isset($_POST['it_id'][$k]) ? preg_replace('/[^a-z0-9_\-]/i', '', $_POST['it_id'][$k]) : '';
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
$qstr .= $cate_c ? '&amp;cate_c='.$cate_c: '';
$qstr .= $cate_d ? '&amp;cate_d='.$cate_d: '';

alert($msg, G5_ADMIN_URL . "/?dir=shop&amp;pid=itemlist&amp;{$qstr}");