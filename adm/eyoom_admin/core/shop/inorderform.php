<?php
/**
 * @file    /adm/eyoom_admin/core/config/inorderform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400410";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=inorderformupdate&amp;smode=1";

auth_check_menu($auth, $sub_menu, "w");

$od_id = isset($_REQUEST['od_id']) ? safe_replace_regex($_REQUEST['od_id'], 'od_id') : '';

//------------------------------------------------------------------------------
// 주문서 정보
//------------------------------------------------------------------------------
$sql = " select * from {$g5['g5_shop_order_data_table']} where od_id = '$od_id' ";
$od = sql_fetch($sql);
if (!$od['od_id']) {
    alert("해당 주문번호로 미완료 주문서가 존재하지 않습니다.");
}

// 주문정보
$data = unserialize(base64_decode($od['dt_data']));

$sql_common = " from {$g5['g5_shop_cart_table']} where od_id = '{$od['cart_id']}' and ct_status = '쇼핑' and ct_select = '1' ";

// 주문금액
$sql = " select SUM(IF(io_type = 1, io_price, (ct_price + io_price)) * ct_qty) as od_price, COUNT(distinct it_id) as cart_count $sql_common ";
$row = sql_fetch($sql);
$tot_ct_price = $row['od_price'];
$cart_count   = $row['cart_count'];
$tot_od_price = $tot_ct_price;

// 쿠폰금액
$tot_cp_price = 0;
if($od['mb_id']) {
    // 상품쿠폰
    $tot_it_cp_price = $tot_od_cp_price = 0;
    $it_cp_cnt = (isset($data['cp_id']) && is_array($data['cp_id'])) ? count($data['cp_id']) : 0;
    $arr_it_cp_prc = array();
    for($i=0; $i<$it_cp_cnt; $i++) {
        $cid = $data['cp_id'][$i];
        $it_id = $data['it_id'][$i];
        $sql = " select cp_id, cp_method, cp_target, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum
                    from {$g5['g5_shop_coupon_table']}
                    where cp_id = '$cid'
                      and mb_id IN ( '{$od['mb_id']}', '전체회원' )
                      and cp_method IN ( 0, 1 ) ";
        $cp = sql_fetch($sql);
        if(! (isset($cp['cp_id']) && $cp['cp_id']))
            continue;

        // 사용한 쿠폰인지
        if(is_used_coupon($od['mb_id'], $cp['cp_id']))
            continue;

        // 분류할인인지
        if($cp['cp_method']) {
            $sql2 = " select it_id, ca_id, ca_id2, ca_id3
                        from {$g5['g5_shop_item_table']}
                        where it_id = '$it_id' ";
            $row2 = sql_fetch($sql2);

            if(!$row2['it_id'])
                continue;

            if($row2['ca_id'] != $cp['cp_target'] && $row2['ca_id2'] != $cp['cp_target'] && $row2['ca_id3'] != $cp['cp_target'])
                continue;
        } else {
            if($cp['cp_target'] != $it_id)
                continue;
        }

        // 상품금액
        $sql = " select SUM( IF(io_type = '1', io_price * ct_qty, (ct_price + io_price) * ct_qty)) as sum_price $sql_common and it_id = '$it_id' ";
        $ct = sql_fetch($sql);
        $item_price = $ct['sum_price'];

        if($cp['cp_minimum'] > $item_price)
            continue;

        $dc = 0;
        if($cp['cp_type']) {
            $dc = floor(($item_price * ($cp['cp_price'] / 100)) / $cp['cp_trunc']) * $cp['cp_trunc'];
        } else {
            $dc = $cp['cp_price'];
        }

        if($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
            $dc = $cp['cp_maximum'];

        if($item_price < $dc)
            continue;

        $tot_it_cp_price += $dc;
        $arr_it_cp_prc[$it_id] = $dc;
    }

    $tot_od_price -= $tot_it_cp_price;

    // 주문쿠폰
    if(isset($data['od_cp_id']) && $data['od_cp_id']) {
        $sql = " select cp_id, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum
                    from {$g5['g5_shop_coupon_table']}
                    where cp_id = '{$data['od_cp_id']}'
                      and mb_id IN ( '{$od['mb_id']}', '전체회원' )
                      and cp_method = '2' ";
        $cp = sql_fetch($sql);

        // 사용한 쿠폰인지
        $cp_used = is_used_coupon($od['mb_id'], $cp['cp_id']);

        $dc = 0;
        if(!$cp_used && $cp['cp_id'] && ($cp['cp_minimum'] <= $tot_od_price)) {
            if($cp['cp_type']) {
                $dc = floor(($tot_od_price * ($cp['cp_price'] / 100)) / $cp['cp_trunc']) * $cp['cp_trunc'];
            } else {
                $dc = $cp['cp_price'];
            }

            if($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
                $dc = $cp['cp_maximum'];

            $tot_od_cp_price = $dc;
            $tot_od_price -= $tot_od_cp_price;
        }
    }

    $tot_cp_price = $tot_it_cp_price + $tot_od_cp_price;
}

// 배송비
$od_send_cost = get_sendcost($od['cart_id']);

$tot_sc_cp_price = 0;
if($od['mb_id'] && $od_send_cost > 0) {
    // 배송쿠폰
    if($data['sc_cp_id']) {
        $sql = " select cp_id, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum
                    from {$g5['g5_shop_coupon_table']}
                    where cp_id = '{$data['sc_cp_id']}'
                      and mb_id IN ( '{$od['mb_id']}', '전체회원' )
                      and cp_method = '3' ";
        $cp = sql_fetch($sql);

        // 사용한 쿠폰인지
        $cp_used = is_used_coupon($od['mb_id'], $cp['cp_id']);

        $dc = 0;
        if(!$cp_used && $cp['cp_id'] && ($cp['cp_minimum'] <= $tot_od_price)) {
            if($cp['cp_type']) {
                $dc = floor(($send_cost * ($cp['cp_price'] / 100)) / $cp['cp_trunc']) * $cp['cp_trunc'];
            } else {
                $dc = $cp['cp_price'];
            }

            if($cp['cp_maximum'] && $dc > $cp['cp_maximum'])
                $dc = $cp['cp_maximum'];

            if($dc > $send_cost)
                $dc = $send_cost;

            $tot_sc_cp_price = $dc;
        }
    }
}

// 추가배송비
$od_send_cost2 = isset($data['od_send_cost2']) ? (int) $data['od_send_cost2'] : 0;

// 포인트
$od_temp_point = isset($data['od_temp_point']) ? (int) $data['od_temp_point'] : 0;

$order_price   = $tot_od_price + $od_send_cost + $od_send_cost2 - $tot_sc_cp_price - $od_temp_point;

// 상품목록
$sql = " select it_id, it_name, ct_notax, ct_send_cost, it_sc_type $sql_common group by it_id order by ct_id ";
$result = sql_query($sql);
$list = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    // 상품이미지
    $row['image'] = str_replace('"', "'", get_it_image($row['it_id'], 160, 160));
    $row['href'] = shop_item_url($row['it_id']);

    // 상품의 옵션정보
    $sql = " select ct_id, it_id, ct_price, ct_point, ct_qty, ct_option, ct_status, cp_price, ct_stock_use, ct_point_use, ct_send_cost, io_type, io_price $sql_common and it_id = '{$row['it_id']}' order by io_type asc, ct_id asc ";
    $res = sql_query($sql);
    $rowspan = sql_num_rows($res);

    // 합계금액 계산
    $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price, SUM(ct_qty) as qty $sql_common and it_id = '{$row['it_id']}' ";
    $sum = sql_fetch($sql);

    // 배송비
    switch($row['ct_send_cost'])
    {
        case 1:
            $ct_send_cost = '착불';
            break;
        case 2:
            $ct_send_cost = '무료';
            break;
        default:
            $ct_send_cost = '선불';
            break;
    }

    // 조건부무료
    if($row['it_sc_type'] == 2) {
        $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od['cart_id']);

        if($sendcost == 0)
            $ct_send_cost = '무료';
    }

    $list[$i] = $row;
    $list[$i]['ct_send_cost'] = $ct_send_cost;

    $loop2 = &$list[$i]['opt'];

    for($k=0; $opt=sql_fetch_array($res); $k++) {
        if($opt['io_type'])
            $opt_price = $opt['io_price'];
        else
            $opt_price = $opt['ct_price'] + $opt['io_price'];

        // 소계
        $ct_price['stotal'] = $opt_price * $opt['ct_qty'];
        $ct_point['stotal'] = $opt['ct_point'] * $opt['ct_qty'];

        if($k == 0)
            $opt_cp_price = (int)$arr_it_cp_prc[$row['it_id']];
        else
            $opt_cp_price = 0;

        $loop2[$k] = $opt;
        $loop2[$k]['opt_price']     = $opt_price;
        $loop2[$k]['ct_price']      = $ct_price['stotal'];
        $loop2[$k]['ct_point']      = $ct_point['stotal'];
        $loop2[$k]['chk_cnt']       = $chk_cnt;
        $loop2[$k]['opt_cp_price']  = $opt_cp_price;
    }
}

// 주문금액 = 상품구입금액 + 배송비 + 추가배송비
$amount['order'] = $tot_ct_price + $od_send_cost + $od_send_cost2;

// 입금액
$amount['receipt'] = $od_temp_point;

// 쿠폰금액
$amount['coupon'] = $tot_cp_price + $tot_sc_cp_price;

// 취소금액
$amount['cancel'] = 0;

// 미수금 = 주문금액 - 취소금액 - 입금금액 - 쿠폰금액
$amount['misu'] = $amount['order'] - $amount['receipt'] - $amount['coupon'];

// 결제방법
$s_receipt_way = $data['od_settle_case'];

if($data['od_settle_case'] == '간편결제') {
    switch($od['dt_pg']) {
        case 'lg':
            $s_receipt_way = 'PAYNOW';
            break;
        case 'inicis':
            $s_receipt_way = 'KPAY';
            break;
        case 'kcp':
            $s_receipt_way = 'PAYCO';
            break;
        default:
            $s_receipt_way = $data['od_settle_case'];
            break;
    }
}

if ($od_temp_point > 0)
    $s_receipt_way .= "+포인트";


// 이니시스를 사용하고 있다면
if( $default['de_pg_service'] === 'inicis' && empty($default['de_card_test']) ){
    $sql = " select * from {$g5['g5_shop_inicis_log_table']} where P_TID <> '' and P_TYPE in ('CARD', 'ISP', 'BANK') and P_MID <> '' and P_STATUS = '00' and oid = '".$od['od_id']."' ";
    $results = sql_query($sql);

    $tmps = array();

    while( $tmp=sql_fetch_array($results) ){

        $sql = " select od_id from {$g5['g5_shop_order_table']} where od_id = '".$tmp['oid']."' and od_tno = '".$tmp['P_TID']."' ";
        $exist_od = sql_fetch($sql);

        if( $exist_od['od_id'] ) continue;

        $sql = " select pp_id from {$g5['g5_shop_personalpay_table']} where pp_id = '".$tmp['oid']."' and pp_tno = '".$tmp['P_TID']."' ";
        $exist_od = sql_fetch($sql);

        if( $exist_od['od_id'] ) continue;

        $tmps[] = $tmp;
    }

    if( $tmps ) {
        $j=0;
        $inilog = array();
        foreach ($tmps as $tmp) {
            if( empty($tmp) ) continue;
            $inilog[$j]['oid']      = $tmp['oid'];
            $inilog[$j]['p_tid']    = $tmp['P_TID'];
            $inilog[$j]['p_mid']    = $tmp['P_MID'];
            if (in_array( strtolower($tmp['P_MID']), array('iniescrow0', 'inipaytest') )) {
                $inilog[$j]['test_str'] = ' ( 테스트결제 )';
            }
            $inilog[$j]['p_date'] = date('Y-m-d H:i:s', strtotime(substr($tmp['P_AUTH_DT'], 0, 14)));
            $inilog[$j]['p_method'] = $tmp['P_TYPE'].' '.$tmp['P_FN_NM'];
            $inilog[$j]['p_amount'] = $tmp['P_AMT'] ? number_format($tmp['P_AMT']) : 0;
            $j++;
        }
    }
}

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_sodr_list' => '주문상품 목록',
    'anc_sodr_orderer' => '주문하신 분',
    'anc_sodr_taker' => '받으시는 분',
);