<?php
if (!defined('_EYOOM_IS_ADMIN_')) exit;

// 주문상태에 따른 합계 금액
function get_order_status_sum($status) {
    global $g5;

    $sql = "
        SELECT count(*) as cnt, sum(od_cart_price + od_send_cost + od_send_cost2 - od_cancel_price) as price
        FROM {$g5['g5_shop_order_table']}
        WHERE od_status = '{$status}'
    ";
    $row = sql_fetch($sql);

    $info = array();
    $info['count'] = (int)$row['cnt'];
    $info['price'] = (int)$row['price'];
    $info['href'] = './orderlist.php?od_status='.urlencode($status);

    return $info;
}

// 일자별 주문 합계 금액
function get_order_date_sum($date) {
    global $g5;

    $sql = "
        SELECT sum(od_cart_price + od_send_cost + od_send_cost2) as orderprice, sum(od_cancel_price) as cancelprice
        FROM {$g5['g5_shop_order_table']}
        WHERE SUBSTRING(od_time, 1, 10) = '{$date}'
    ";
    $row = sql_fetch($sql);

    $info = array();
    $info['order'] = (int)$row['orderprice'];
    $info['cancel'] = (int)$row['cancelprice'];

    return $info;
}

// 일자별 결제수단 주문 합계 금액
function get_order_settle_sum($date) {
    global $g5, $default;

    $case = array('신용카드', '계좌이체', '가상계좌', '무통장', '휴대폰', '간편결제', 'KAKAOPAY');
    $info = array();

    // 결제수단별 합계
    foreach($case as $val) {
        $sql = "
            SELECT sum(od_cart_price + od_send_cost + od_send_cost2 - od_receipt_point - od_cart_coupon - od_coupon - od_send_coupon) as price, count(*) as cnt
            FROM {$g5['g5_shop_order_table']}
            WHERE SUBSTRING(od_time, 1, 10) = '{$date}' and od_settle_case = '{$val}'
        ";
        $row = sql_fetch($sql);

        $info[$val]['price'] = (int)$row['price'];
        $info[$val]['count'] = (int)$row['cnt'];
    }

    // 포인트 합계
    $sql = "
        SELECT sum(od_receipt_point) as price, count(*) as cnt
        FROM {$g5['g5_shop_order_table']}
        WHERE SUBSTRING(od_time, 1, 10) = '{$date}' and od_receipt_point > 0
    ";
    $row = sql_fetch($sql);
    $info['포인트']['price'] = (int)$row['price'];
    $info['포인트']['count'] = (int)$row['cnt'];

    // 쿠폰 합계
    $sql = "
        SELECT sum(od_cart_coupon + od_coupon + od_send_coupon) as price, count(*) as cnt
        FROM {$g5['g5_shop_order_table']}
        WHERE SUBSTRING(od_time, 1, 10) = '{$date}' and ( od_cart_coupon > 0 or od_coupon > 0 or od_send_coupon > 0 )
    ";
    $row = sql_fetch($sql);
    $info['쿠폰']['price'] = (int)$row['price'];
    $info['쿠폰']['count'] = (int)$row['cnt'];

    return $info;
}

function get_max_value($arr) {
    foreach($arr as $key => $val)
        if(is_array($val))
            $arr[$key] = get_max_value($val);

    @sort($arr);

    return array_pop($arr);
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
        WHERE od_time between '{$fr_month}' and '{$to_month}'
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

    return $output;
}