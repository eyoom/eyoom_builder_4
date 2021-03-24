<?php
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 처리할 주문
 */
$od_status = array('주문', '입금', '준비', '배송');
foreach($od_status as $status) {
    $order_status[$status] = get_order_status_sum($status);
    $order_status[$status]['href'] = G5_ADMIN_URL . "/?dir=shop&amp;pid=orderlist&amp;od_status={$status}";
}

/**
 * 상품문의
 */
$sql = " select * from {$g5['g5_shop_item_qa_table']} where (1) order by iq_id desc limit 5 ";
$result = sql_query($sql);
$item_qa = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $sql1 = " select * from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
    $row1 = sql_fetch($sql1);

    $item_qa[$i] = $row;
    $item_qa[$i]['mb_photo'] = $eb->mb_photo($row1['mb_id']);
    $item_qa[$i]['name'] = get_text($row1['mb_name']);
    $item_qa[$i]['is_answer'] = $row['iq_answer'] ? true: false;
}

/**
 * 사용후기
 */
$sql = " select * from {$g5['g5_shop_item_use_table']} where (1) order by is_id desc limit 5 ";
$result = sql_query($sql);
$item_use = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $sql1 = " select * from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
    $row1 = sql_fetch($sql1);

    $item_use[$i] = $row;
    $item_use[$i]['mb_photo'] = $eb->mb_photo($row1['mb_id']);
    $item_use[$i]['name'] = get_text($row1['mb_name']);
    $item_use[$i]['is_answer'] = $row['is_confirm'] == '1' ? true: false;
}

/**
 * 이번주 주문현황
 */
$arr_order = array();
$x_val = array();
for($i=6; $i>=0; $i--) {
    $date = date('Y-m-d', strtotime('-'.$i.' days', G5_SERVER_TIME));
    $last_date = date('Y-m-d', strtotime('-'.($i+7).' days', G5_SERVER_TIME));

    $x_val[] = $date;
    $last_x_val[] = $last_date;
    $arr_order[] = get_order_date_sum($date);
}

/**
 * 올해 월별 매출현황
 */
$this_year = date('Y');
$this_ord_info = get_year_order_info($this_year);
foreach($this_ord_info as $key => $od_info) {
    ${$key} = $od_info;
}
@ksort($receiptbank);
@ksort($receiptvbank);
@ksort($receiptiche);
@ksort($receiptcard);
@ksort($receipteasy);
@ksort($receiptkakao);
@ksort($receipthp);
@ksort($ordercoupon);
@ksort($receiptpoint);
@ksort($ordercancel);

/**
 * 결제수단별 주문현황
 */
$term = 3;
$info = array();
$info_key = array();
$od_pg_thead = array();
$j = 0;
for($i=($term - 1); $i>=0; $i--) {
    $date = date("Y-m-d", strtotime('-'.$i.' days', G5_SERVER_TIME));
    $info[$date] = get_order_settle_sum($date);

    $day = substr($date, 5, 5).' ('.get_yoil($date).')';
    $info_key[] = $date;
    $od_pg_thead[$j]['day'] = $day;
    $j++;
}
$pg_case = array('신용카드', '계좌이체', '가상계좌', '무통장', '휴대폰', '포인트', '쿠폰', '간편결제', 'KAKAOPAY');

$k =0;
$pg_info = array();
foreach($pg_case as $val) {
    $val_cnt ++;
    $pg_info[$k]['cnt']     = $val_cnt;
    $pg_info[$k]['method']  = $val;
    $inloop = &$pg_info[$k]['info'];

    $j=0;
    foreach($info_key as $date) {
        $inloop[$j]['count'] = $info[$date][$val]['count'];
        $inloop[$j]['price'] = $info[$date][$val]['price'];
        $j++;
    }
    $k++;
}