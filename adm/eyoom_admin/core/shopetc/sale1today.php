<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/sale1today.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500110";

auth_check_menu($auth, $sub_menu, "r");

$date = isset($_GET['date']) ? preg_replace('/[^0-9]/i', '', $_GET['date']) : '';
$tot = array(
    'orderprice'=>0,
    'coupon'=>0,
    'receipt_bank'=>0,
    'receipt_vbank'=>0,
    'receipt_iche'=>0,
    'receipt_card'=>0,
    'receipt_easy'=>0,
    'receipt_hp'=>0,
    'receipt_point'=>0,
    'ordercancel'=>0,
    'misu'=>0,
);
$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $date);

$sql = " select od_id,
                mb_id,
                od_name,
                od_settle_case,
                od_cart_price,
                od_receipt_price,
                od_receipt_point,
                od_cancel_price,
                od_misu,
                (od_cart_price + od_send_cost + od_send_cost2) as orderprice,
                (od_cart_coupon + od_coupon + od_send_coupon) as couponprice
           from {$g5['g5_shop_order_table']}
          where SUBSTRING(od_time,1,10) = '$date' and od_cart_price <> '0'
          order by od_id desc ";
$result = sql_query($sql);

$list = array();
$href = '';
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    if ($row['mb_id'] == '') { // 비회원일 경우는 주문자로 링크
        $href = EYOOM_ADMIN_URL."/?dir=shop&amp;pid=orderlist&amp;sel_field=od_name&amp;search=".$row['od_name'];
    } else { // 회원일 경우는 회원아이디로 링크
        $href = EYOOM_ADMIN_URL."/?dir=shop&amp;pid=orderlist&amp;sel_field=mb_id&amp;search=".$row['mb_id'];
    }

    $receipt_bank = $receipt_card = $receipt_vbank = $receipt_iche = $receipt_easy = $receipt_hp = 0;
    if($row['od_settle_case'] == '무통장')
        $receipt_bank = $row['od_receipt_price'];
    if($row['od_settle_case'] == '가상계좌')
        $receipt_vbank = $row['od_receipt_price'];
    if($row['od_settle_case'] == '계좌이체')
        $receipt_iche = $row['od_receipt_price'];
    if($row['od_settle_case'] == '휴대폰')
        $receipt_hp = $row['od_receipt_price'];
    if($row['od_settle_case'] == '신용카드')
        $receipt_card = $row['od_receipt_price'];
    if(in_array($row['od_settle_case'], array('간편결제', 'KAKAOPAY', 'lpay', 'inicis_payco', 'inicis_kakaopay', '삼성페이'))) {
        $receipt_easy = $row['od_receipt_price'];
    }

    $list[$i] = $row;
    $list[$i]['href'] = $href;
    $list[$i]['receipt_bank'] = $receipt_bank;
    $list[$i]['receipt_card'] = $receipt_card;
    $list[$i]['receipt_vbank'] = $receipt_vbank;
    $list[$i]['receipt_iche'] = $receipt_iche;
    $list[$i]['receipt_hp'] = $receipt_hp;

    $tot['orderprice']    += $row['orderprice'];
    $tot['ordercancel']   += $row['od_cancel_price'];
    $tot['coupon']        += $row['couponprice'] ;
    $tot['receipt_bank']  += $receipt_bank;
    $tot['receipt_vbank'] += $receipt_vbank;
    $tot['receipt_iche']  += $receipt_iche;
    $tot['receipt_card']  += $receipt_card;
    $tot['receipt_easy']  += $receipt_easy;
    $tot['receipt_hp']    += $receipt_hp;
    $tot['receipt_point'] += $row['od_receipt_point'];
    $tot['misu']          += $row['od_misu'];
}