<?php
if (!defined('_EYOOM_IS_ADMIN_')) exit;

/**
 * 처리할 주문
 */
$order_status = get_order_status_sum();

/**
 * 개인결제
 */
$pp_info = get_personalpay_sum();

/**
 * 상품문의
 */
$sql = " select * from {$g5['g5_shop_item_qa_table']} where (1) order by iq_id desc limit 15 ";
$result = sql_query($sql);
$item_qa = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $item_qa[$i] = $row;
    $item_qa[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
    $item_qa[$i]['name'] = get_text($row['iq_name']);
    $item_qa[$i]['is_answer'] = $row['iq_answer'] ? true: false;
}

/**
 * 사용후기
 */
$sql = " select * from {$g5['g5_shop_item_use_table']} where (1) order by is_id desc limit 15 ";
$result = sql_query($sql);
$item_use = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $item_use[$i] = $row;
    $item_use[$i]['mb_photo'] = $eb->mb_photo($row['mb_id']);
    $item_use[$i]['name'] = get_text($row['is_name']);
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
}

$week_order = get_order_week_sum($x_val);
for($i=6; $i>=0; $i--) {
    $date = date('Ymd', strtotime('-'.$i.' days', G5_SERVER_TIME));
    $arr_order[] = $week_order[$date];
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
$term = 7;
$info_key = array();
$od_pg_thead = array();
$j = 0;
for($i=($term - 1); $i>=0; $i--) {
    $date = date("Y-m-d", strtotime('-'.$i.' days', G5_SERVER_TIME));
    $date_array[] = $date;

    $day = substr($date, 5, 5).' ('.get_yoil($date).')';
    $info_key[] = $date;
    $od_pg_thead[$j]['day'] = $day;
    $j++;
}
$info = get_week_settle_sum($date_array);
$pg_case = array('무통장', '가상계좌', '계좌이체', '신용카드', '간편결제', 'KAKAOPAY', '휴대폰', '쿠폰', '포인트');

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