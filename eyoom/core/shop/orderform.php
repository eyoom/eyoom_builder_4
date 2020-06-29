<?php
/**
 * core file : /eyoom/core/shop/orderform.php
 */
if (!defined('_EYOOM_')) exit;

/**
 * add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
 */
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

/**
 * 주문상품 재고체크 js 파일
 */
add_javascript('<script src="'.G5_JS_URL.'/shop.order.js"></script>', 0);

$sw_direct = preg_replace('/[^a-z0-9_]/i', '', $sw_direct);

/**
 * 모바일 주문인지
 */
$is_mobile_order = is_mobile();

set_session("ss_direct", $sw_direct);

/**
 * 장바구니가 비어있는가?
 */
if ($sw_direct) {
    $tmp_cart_id = get_session('ss_cart_direct');
} else {
    $tmp_cart_id = get_session('ss_cart_id');
}

if (get_cart_count($tmp_cart_id) == 0)
    alert('장바구니가 비어 있습니다.', G5_SHOP_URL.'/cart.php');

/**
 * 새로운 주문번호 생성
 */
$od_id = get_uniqid();
set_session('ss_order_id', $od_id);
$s_cart_id = $tmp_cart_id;
if($default['de_pg_service'] == 'inicis' || $default['de_inicis_lpay_use'] || $default['de_inicis_kakaopay_use'])
    set_session('ss_order_inicis_id', $od_id);

/**
 * 상단 레이아웃
 */
include_once(G5_SHOP_PATH.'/_head.php');

/**
 * 희망배송일 지정
 */
if ($default['de_hope_date_use']) {
    include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
}

/**
 * 기기별 주문폼 include
 */
if($is_mobile_order) {
    $order_action_url = G5_HTTPS_MSHOP_URL.'/orderformupdate.php';
    $skin_dir = EYOOM_CORE_MOBILE_PATH.'/'.G5_SHOP_DIR;
    require_once($skin_dir.'/orderform.sub.php');
} else {
    $order_action_url = G5_HTTPS_SHOP_URL.'/orderformupdate.php';
    $skin_dir = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR;
    require_once($skin_dir.'/orderform.sub.php');
}

/**
 * 하단 레이아웃
 */
include_once(G5_SHOP_PATH.'/_tail.php');