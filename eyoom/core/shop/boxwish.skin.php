<?php
/**
 * core file : /eyoom/core/shop/boxwish.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 위시리스트 상품정보
 */
$wishlist_datas = get_wishlist_datas($member['mb_id'], true);

/**
 * 위시리스트 리스트
 */
$i = 0;
$wish_list = array();

if ($wishlist_datas) {
    foreach($wishlist_datas as $row) {
        if( !$row['it_id'] ) continue;
    
        $wish_list[$i]['it_name'] = $row['it_name'];
        $wish_list[$i]['it_img'] = get_it_image($row['it_id'], 60, 60, true);
        $wish_list[$i]['it_id'] = $row['it_id'];
        $i++;
    }
}

$wish_count = count((array)$wish_list);