<?php
/**
 * core file : /eyoom/core/shop/boxtodayview.skin.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * 오늘 본 상품 정보
 */
$tv_datas = get_view_today_items(true);

/**
 * 출력 설정
 */
$tv_div['top'] = 0;
$tv_div['img_width'] = 60;
$tv_div['img_height'] = 60;
$tv_div['img_length'] = 3; // 한번에 보여줄 이미지 수

/**
 * 오늘 본 상품이 1개라도 있을 때
 */
if ($tv_datas) {
    $tv_tot_count = 0;
    $k = 0;
    $i = 0;
    $cnt = 1;
    $tv_list = array();
    foreach($tv_datas as $rowx) {
        if(!$rowx['it_id']) continue;

        $tv_it_id = $rowx['it_id'];

        if ($tv_tot_count % $tv_div['img_length'] == 0) $k++;

        $tv_list[$i]['it_name'] = get_text($rowx['it_name']);
        $tv_list[$i]['img'] = get_it_image($tv_it_id, $tv_div['img_width'], $tv_div['img_height'], $tv_it_id, '', $it_name);
        $it_price = get_price($rowx);
        $print_price = is_int($it_price) ? number_format($it_price) : $it_price;
        
        $tv_list[$i]['price'] = $print_price;
        $tv_list[$i]['k'] = $k;

        $tv_tot_count++;
        $cnt++;
        $i++;
    }
}