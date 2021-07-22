<?php
/**
 * core file : /eyoom/core/shop/list.skin.php
 */
if (!defined('_EYOOM_')) exit;

global $is_admin, $eyoom, $shop;

/**
 * 상품진열
 */
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $row['sct_last'] = 'sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $row['sct_last'] = 'sct_clear'; // 줄 첫번째
        else $row['sct_last'] = '';
    } else { // 1줄 이미지 : 1개
        $row['sct_last'] = ' sct_clear';
    }

    $row['it_basic'] = conv_content($row['it_basic'], 1);

    /**
     * 상세페이지 경로
     */
    if($this->href) {
        $row['href'] = shop_item_url($row['it_id']);
    }

    /**
     * 상품 목록 이미지
     */
    if ($this->view_it_img) {
        $row['it_image'] = get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";

        $row['it_image2'] = $shop->get_it_second_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }

    /**
     * 상품유형 아이콘
     */
    if($this->view_it_icon) {
        $row['it_icon'] = $shop->item_icon($row);
    }

    /**
     * 할인율 계산
     */
    $row['dc_ratio'] = $row['it_cust_price'] ? $shop->dc_ratio($row['it_cust_price'], $row['it_price']): 0;

    /**
     * 상품가격 출력
     */
    if ($this->view_it_cust_price || $this->view_it_price) {
        if ($this->view_it_cust_price && $row['it_cust_price']) {
            $row['it_cust_price'] = "<strike>".preg_replace('/원/','',display_price($row['it_cust_price']))."</strike>";
        }
        if ($this->view_it_price) {
            $row['it_tel_inq'] = preg_replace('/원/','',display_price(get_price($row), $row['it_tel_inq']));
        }
    }

    /**
     * 소셜링크 정보
     */
    if ($this->view_sns) {
        $row['sns_top'] = $this->img_height + 10;
        $row['sns_url']  = urlencode(shop_item_url($row['it_id']));
        $row['sns_title'] = urlencode(get_text($row['it_name']).' | '.get_text($config['cf_title']));
    }

    /**
     * 고객선호도 별점수
     */
    $row['star_score'] = get_star_image($row['it_id']);

    $list[$i] = $row;
}