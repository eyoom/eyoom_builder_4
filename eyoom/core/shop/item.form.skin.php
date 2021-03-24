<?php
/**
 * core file : /eyoom/core/shop/item.form.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 상품 썸네일 큰 이미지
 */
$big_img_count = 0;
$thumbnails = $big_img = $thumb_info = array();
for($i=1; $i<=10; $i++) {
    if(!$it['it_img'.$i])
        continue;

    $img = get_it_thumbnail($it['it_img'.$i], $default['de_mimg_width'], $default['de_mimg_height']);

    if($img) {
        // 썸네일
        $thumb = get_it_thumbnail($it['it_img'.$i], 150, 0);
        $thumbnails[] = $thumb;

        $big_img[$i]['href'] = G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$i;
        $big_img[$i]['image'] = $img;

        $big_img_count++;
    }
}

/**
 * 썸네일
 */
$thumb1 = true;
$thumb_count = 0;
$thumb_total_count = count((array)$thumbnails);
if($thumb_total_count > 0) {
    $i=0;
    foreach($thumbnails as $val) {
        $thumb_count++;

        $thumb_info[$i]['href'] = G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;no='.$thumb_count;
        $thumb_info[$i]['image'] = $val;
        $thumb_info[$i]['cnt'] = $thumb_count;
        $i++;
    }
}

/**
 * 배송비
 */
$ct_send_cost_label = '배송비결제';

if($it['it_sc_type'] == 1)
    $sc_method = '무료배송';
else {
    if($it['it_sc_method'] == 1)
        $sc_method = '수령후 지불';
    else if($it['it_sc_method'] == 2) {
        $ct_send_cost_label = '<label for="ct_send_cost">배송비결제</label>';
    }
    else
        $sc_method = '주문시 결제';
}

/**
 * 스킨 출력
 */
include_once(EYOOM_THEME_SHOP_SKIN_PATH.'/item.form.skin.html.php');