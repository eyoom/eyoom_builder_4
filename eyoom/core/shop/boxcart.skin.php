<?php
/**
 * core file : /eyoom/core/shop/boxcart.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 장바구니 상품정보
 */
$cart_datas = get_boxcart_datas(true);

/**
 * 장바구니 리스트
 */
$i = 0;
$ct_list = array();

if ($cart_datas) {
    foreach($cart_datas as $row) {
        if( !$row['it_id'] ) continue;
    
        $ct_list[$i]['it_name'] = $row['it_name'];
        $ct_list[$i]['it_img'] = get_it_image($row['it_id'], 60, 60, true);
        $ct_list[$i]['it_id'] = $row['it_id'];
        $i++;
    }
}

$ct_count = count((array)$ct_list);