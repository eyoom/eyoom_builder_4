<?php
/**
 * @file    /adm/eyoom_admin/core/shop/orderform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400400";

$action_url = G5_ADMIN_URL.'/?dir=shop&amp;pid=orderpartcancelupdate&amp;smode=1';

auth_check_menu($auth, $sub_menu, "w");

$od_id = isset($_REQUEST['od_id']) ? safe_replace_regex($_REQUEST['od_id'], 'od_id') : '';

$sql = " select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
$od = sql_fetch($sql);

$msg = '';
if(! (isset($od['od_id']) && $od['od_id']))
    $msg = '주문정보가 존재하지 않습니다.';

if($od['od_pg'] == 'inicis' && $od['od_settle_case'] == '계좌이체')
    $msg = 'KG이니시스는 신용카드만 부분취소가 가능합니다.';

if($od['od_settle_case'] == '계좌이체' && substr($od['od_receipt_time'], 0, 10) >= G5_TIME_YMD)
    $msg = '실시간 계좌이체건의 부분취소 요청은 결제일 익일에 가능합니다.';

if($od['od_receipt_price'] - $od['od_refund_price'] <= 0)
    $msg = '부분취소 처리할 금액이 없습니다.';

$g5['title'] = $od['od_settle_case'].' 부분취소';

// 취소가능금액
$od_misu = abs($od['od_misu']);

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';