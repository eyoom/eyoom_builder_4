<?php
if (!defined('_EYOOM_IS_ADMIN_')) exit;

include_once(G5_ADMIN_PATH.'/shop_admin/admin.shop.lib.php');

// 주문상태에 따른 합계 금액
function get_order_status_sum() {
    global $g5;

    $od_status = array('주문', '입금', '준비', '배송');
    $od_status_set = implode(',', $od_status);

    $sql = "
        SELECT od_status, od_cart_price, od_send_cost, od_send_cost2, od_cancel_price
        FROM {$g5['g5_shop_order_table']}
        WHERE find_in_set(od_status,'{$od_status_set}') and od_cart_price <> 0
    ";
    $result = sql_query($sql);
    $order_status = array('주문'=>array(), '입금'=>array(), '준비'=>array(), '배송'=>array());
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        unset($od_price);
        $order_status[$row['od_status']]['count']++;
        $od_price = $row['od_cart_price']+$row['od_send_cost']+$row['od_send_cost2']-$row['od_cancel_price'];
        $order_status[$row['od_status']]['price'] += $od_price;
    }

    foreach($od_status as $status) {
        $order_status[$status]['href'] = G5_ADMIN_URL . "/?dir=shop&amp;pid=orderlist&amp;od_status={$status}";
    }

    return $order_status;
}

// 개인결제 미수금 합계 금액
function get_personalpay_sum () {
    global $g5;

    $sql = "
        SELECT count(*) as cnt, sum(pp_price-pp_receipt_price) as price
        FROM {$g5['g5_shop_personalpay_table']}
        WHERE pp_price <> pp_receipt_price
    ";
    $row = sql_fetch($sql);

    $info = array();
    $info['count'] = (int)$row['cnt'];
    $info['price'] = (int)$row['price'];
    $info['href'] = G5_ADMIN_URL.'/?dir=shop&pid=personalpaylist';

    return $info;
}

// 주간별 주문 합계 금액
function get_order_week_sum($date) {
    global $g5;

    $date_set = implode(',', $date);
    $sql = "
        SELECT od_time, od_cart_price, od_send_cost, od_send_cost2, od_cancel_price
        FROM {$g5['g5_shop_order_table']}
        WHERE find_in_set(SUBSTRING(od_time, 1, 10),'{$date_set}') and od_cart_price <> 0
    ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $od_time = date('Ymd', strtotime($row['od_time']));
        $order_date[$od_time]['count']++;
        $order_date[$od_time]['order'] += $row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2'];
        $order_date[$od_time]['cancel'] += $row['od_cancel_price'];
    }

    return $order_date;
}

function get_week_settle_sum($date) {
    global $g5;

    $date_set = implode(',', $date);

    $sql = "
        SELECT od_time, od_settle_case, od_cart_price, od_send_cost, od_send_cost2, od_receipt_point, od_cart_coupon, od_coupon, od_send_coupon
        FROM {$g5['g5_shop_order_table']}
        WHERE find_in_set(SUBSTRING(od_time, 1, 10),'{$date_set}') and od_cart_price <> 0
    ";
    $result = sql_query($sql);
    $info = array('무통장'=>array(), '가상계좌'=>array(), '계좌이체'=>array(), '신용카드'=>array(), '간편결제'=>array(), 'KAKAOPAY'=>array(), '휴대폰'=>array(), '쿠폰'=>array(), '포인트'=>array());
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $od_time = date('Y-m-d', strtotime($row['od_time']));
        $info[$od_time][$row['od_settle_case']]['price'] += $row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2'] - $row['od_receipt_point'] - $row['od_cart_coupon'] - $row['od_coupon'] - $row['od_send_coupon'];
        $info[$od_time][$row['od_settle_case']]['count']++;
    }

    // 포인트 합계
    $sql = "
        SELECT od_time, od_receipt_point
        FROM {$g5['g5_shop_order_table']}
        WHERE find_in_set(SUBSTRING(od_time, 1, 10),'{$date_set}') and od_receipt_point > 0 and od_cart_price <> 0
    ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $od_time = date('Y-m-d', strtotime($row['od_time']));
        $info[$od_time]['포인트']['price'] += $row['od_receipt_point'];
        $info[$od_time]['포인트']['count']++;
    }

    // 쿠폰 합계
    $sql = "
        SELECT od_time, od_cart_coupon, od_coupon, od_send_coupon
        FROM {$g5['g5_shop_order_table']}
        WHERE find_in_set(SUBSTRING(od_time, 1, 10),'{$date_set}') and ( od_cart_coupon > 0 or od_coupon > 0 or od_send_coupon > 0 ) and od_cart_price <> 0
    ";
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $od_time = date('Y-m-d', strtotime($row['od_time']));
        $info[$od_time]['쿠폰']['price'] += $row['od_cart_coupon'] + $row['od_coupon'] + $row['od_send_coupon'];
        $info[$od_time]['쿠폰']['count']++;
    }
    return $info;
}

// 해당년도의 모든 주문 추출
function get_year_order_info($year) {
    global $g5;

    if (!$year) $year = date('Y');

    $fr_month = $year . '-01-01 00:00:00';
    $to_month = $year . '-12-31 23:59:59';

    $sql = "
        SELECT od_id, SUBSTRING(od_time,1,7) as od_date, od_send_cost, od_settle_case, od_receipt_price, od_receipt_point, od_cart_price, od_cancel_price, od_misu, (od_cart_price + od_send_cost + od_send_cost2) as orderprice, (od_cart_coupon + od_coupon + od_send_coupon) as couponprice
        FROM {$g5['g5_shop_order_table']}
        WHERE od_time between '{$fr_month}' and '{$to_month}' and od_cart_price <> '0' and od_status<>'취소' and od_status<>'주문' and od_status<>'반품' and od_status<>'품절'
        ORDER BY od_time desc
    ";

    $result = sql_query($sql);
    $info = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        $month = substr($row['od_date'], -2) * 1;
        $info[$month][$i] = $row;
    }
    @ksort($info);

    for($m=1; $m<=12; $m++) {
        $sale_month[$m]['count'] = count((array)$info[$m]);

        if (isset($info[$m])) {
            foreach($info[$m] as $i => $row) {
                $orderprice[$m]     += $row['orderprice'];
                $ordercancel[$m]    += $row['od_cancel_price'];
                $ordercoupon[$m]    += $row['couponprice'];

                switch($row['od_settle_case']) {
                    case '무통장':     $receiptbank[$m]    += $row['od_receipt_price']; break;
                    case '가상계좌':    $receiptvbank[$m]   += $row['od_receipt_price']; break;
                    case '계좌이체':    $receiptiche[$m]    += $row['od_receipt_price']; break;
                    case '휴대폰':     $receipthp[$m]      += $row['od_receipt_price']; break;
                    case '신용카드':    $receiptcard[$m]    += $row['od_receipt_price']; break;
                    case '간편결제':    $receipteasy[$m]    += $row['od_receipt_price']; break;
                    case 'KAKAOPAY':$receiptkakao[$m]   += $row['od_receipt_price']; break;
                }
                $receiptpoint[$m] += $row['od_receipt_point'];
                $misu[$m] += $row['od_misu'];

                $tot[$m]['orderprice'] += $row['orderprice'];
            }
        } else {
            $orderprice[$m]     += 0;
            $ordercancel[$m]    += 0;
            $ordercoupon[$m]    += 0;
            $receiptbank[$m]    += 0;
            $receiptvbank[$m]   += 0;
            $receiptiche[$m]    += 0;
            $receipthp[$m]      += 0;
            $receiptcard[$m]    += 0;
            $receipteasy[$m]    += 0;
            $receiptkakao[$m]   += 0;
            $receiptpoint[$m]   += 0;
            $misu[$m]           += 0;

            $tot[$m]['orderprice'] += 0;
        }
    }

    for($m=1; $m<=12; $m++) {
        $orderprice[$m]     = !$orderprice[$m] ? 0: $orderprice[$m];
        $ordercancel[$m]    = !$ordercancel[$m] ? 0: $ordercancel[$m];
        $ordercoupon[$m]    = !$ordercoupon[$m] ? 0: $ordercoupon[$m];
        $receiptbank[$m]    = !$receiptbank[$m] ? 0: $receiptbank[$m];
        $receiptvbank[$m]   = !$receiptvbank[$m] ? 0: $receiptvbank[$m];
        $receiptiche[$m]    = !$receiptiche[$m] ? 0: $receiptiche[$m];
        $receipthp[$m]      = !$receipthp[$m] ? 0: $receipthp[$m];
        $receiptcard[$m]    = !$receiptcard[$m] ? 0: $receiptcard[$m];
        $receipteasy[$m]    = !$receipteasy[$m] ? 0: $receipteasy[$m];
        $receiptkakao[$m]   = !$receiptkakao[$m] ? 0: $receiptkakao[$m];
        $receiptpoint[$m]   = !$receiptpoint[$m] ? 0: $receiptpoint[$m];
    }

    $output['tot']          = $tot;
    $output['orderprice']   = $orderprice;
    $output['ordercancel']  = $ordercancel;
    $output['ordercoupon']  = $ordercoupon;
    $output['misu']         = $misu;
    $output['receiptbank']  = $receiptbank;
    $output['receiptvbank'] = $receiptvbank;
    $output['receiptiche']  = $receiptiche;
    $output['receipthp']    = $receipthp;
    $output['receiptcard']  = $receiptcard;
    $output['receipteasy']  = $receipteasy;
    $output['receiptkakao'] = $receiptkakao;
    $output['receiptpoint'] = $receiptpoint;
    $output['sale_month']   = $sale_month;

    return $output;
}