<?php
/**
 * core file : /eyoom/core/shop/personalpayform.php
 */
if (!defined('_EYOOM_')) exit;

// 모바일 주문인지
$is_mobile_pay = is_mobile();

$sql = " select * from {$g5['g5_shop_personalpay_table']} where pp_id = '$pp_id' and pp_use = '1' and pp_price > 0 ";
$pp = sql_fetch($sql);

if(!$pp['pp_id'])
    alert('개인결제 정보가 존재하지 않습니다.', G5_SHOP_URL);

if($pp['pp_tno'])
    alert('개인결제 정보가 존재하지 않습니다.', G5_SHOP_URL);

$pp['pp_name'] = strip_tags($pp['pp_name']);

$g5['title'] = $pp['pp_name'].'님 개인결제';

include_once(G5_SHOP_PATH.'/_head.php');

// 개인결제 체크를 위한 hash
$hash_data = md5($pp['pp_id'].$pp['pp_price'].$pp['pp_time']);
set_session('ss_personalpay_id', $pp['pp_id']);
set_session('ss_personalpay_hash', $hash_data);

// 에스크로 상품정보
if($default['de_escrow_use']) {
    $good_info .= "seq=1".chr(31);
    $good_info .= "ordr_numb={$pp_id}_".sprintf("%04d", 1).chr(31);
    $good_info .= "good_name=".addslashes($pp['pp_name'].'님 개인결제').chr(31);
    $good_info .= "good_cntx=1".chr(31);
    $good_info .= "good_amtx=".$pp['pp_price'].chr(31);
}

// 주문폼과 공통 사용을 위해 추가
$od_id = $pp_id;
$tot_price = $pp['pp_price'];
$goods = $pp['pp_name'].'님 개인결제';

if($default['de_pg_service'] == 'inicis')
    set_session('ss_order_inicis_id', $od_id);

// 기기별 결제폼 include
if($is_mobile_pay) {
    $order_action_url = G5_HTTPS_MSHOP_URL.'/personalpayformupdate.php';
    $skin_dir = EYOOM_CORE_MOBILE_PATH.'/'.G5_SHOP_DIR;
    require_once($skin_dir.'/personalpayform.sub.php');
} else {
    $order_action_url = G5_HTTPS_SHOP_URL.'/personalpayformupdate.php';
    $skin_dir = EYOOM_CORE_PATH.'/'.G5_SHOP_DIR;
    require_once($skin_dir.'/personalpayform.sub.php');
}

include_once(G5_SHOP_PATH.'/_tail.php');