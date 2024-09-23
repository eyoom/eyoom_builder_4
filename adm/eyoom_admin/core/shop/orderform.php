<?php
/**
 * @file    /adm/eyoom_admin/core/shop/orderform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400400";

/**
 * 폼 전송 URL
 */
$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=orderformcartupdate&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=shop&amp;pid=orderformreceiptupdate&amp;smode=1';
$action_url3 = G5_ADMIN_URL . '/?dir=shop&amp;pid=orderformupdate&amp;smode=1';

$cart_title3 = '주문번호';
$cart_title4 = '배송완료';

auth_check_menu($auth, $sub_menu, "w");

$fr_date = isset($_REQUEST['fr_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['fr_date']) : '';
$to_date = isset($_REQUEST['to_date']) ? preg_replace('/[^0-9 :\-]/i', '', $_REQUEST['to_date']) : '';
$od_status = isset($_REQUEST['od_status']) ? clean_xss_tags($_REQUEST['od_status'], 1, 1) : '';
$od_settle_case = isset($_REQUEST['od_settle_case']) ? clean_xss_tags($_REQUEST['od_settle_case'], 1, 1) : '';
$od_misu = isset($_REQUEST['od_misu']) ? clean_xss_tags($_REQUEST['od_misu'], 1, 1) : '';
$od_cancel_price = isset($_REQUEST['od_cancel_price']) ? clean_xss_tags($_REQUEST['od_cancel_price'], 1, 1) : '';
$od_refund_price = isset($_REQUEST['od_refund_price']) ? clean_xss_tags($_REQUEST['od_refund_price'], 1, 1) : '';
$od_receipt_point = isset($_REQUEST['od_receipt_point']) ? clean_xss_tags($_REQUEST['od_receipt_point'], 1, 1) : '';
$od_coupon = isset($_REQUEST['od_coupon']) ? clean_xss_tags($_REQUEST['od_coupon'], 1, 1) : '';
$od_id = isset($_REQUEST['od_id']) ? safe_replace_regex($_REQUEST['od_id'], 'od_id') : '';
$od_escrow = isset($_REQUEST['od_escrow']) ? clean_xss_tags($_REQUEST['od_escrow'], 1, 1) : ''; 

$sort1 = isset($_REQUEST['sort1']) ? clean_xss_tags($_REQUEST['sort1'], 1, 1) : '';
$sort2 = isset($_REQUEST['sort2']) ? clean_xss_tags($_REQUEST['sort2'], 1, 1) : '';
$sel_field = isset($_REQUEST['sel_field']) ? clean_xss_tags($_REQUEST['sel_field'], 1, 1) : '';
$search = isset($_REQUEST['search']) ? get_search_string($_REQUEST['search']) : '';

// 완료된 주문에 포인트를 적립한다.
save_order_point("완료");

//------------------------------------------------------------------------------
// 주문서 정보
//------------------------------------------------------------------------------
$sql = " select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
$od = sql_fetch($sql);
if (! (isset($od['od_id']) && $od['od_id'])) {
    alert("해당 주문번호로 주문서가 존재하지 않습니다.");
}

$od['mb_id'] = $od['mb_id'] ? $od['mb_id'] : "비회원";
//------------------------------------------------------------------------------

/**
 * 탭메뉴
 */
$pg_anchor = array(
    'anc_sodr_list' => '주문상품 목록',
    'anc_sodr_pay' => '주문결제 내역',
    'anc_sodr_chk' => '결제상세정보',
    'anc_sodr_memo' => '상점메모',
    'anc_sodr_orderer' => '주문/받으시는 분'
);

/**
 * 결제금액 자동입력 체크박스
 */
$html_receipt_chk = '<input type="checkbox" id="od_receipt_chk" value="'.$od['od_misu'].'" onclick="chk_receipt_price()">
<label for="od_receipt_chk">결제금액 입력</label><br>';

$qstr1 = "od_status=".urlencode($od_status)."&amp;od_settle_case=".urlencode($od_settle_case)."&amp;od_misu=$od_misu&amp;od_cancel_price=$od_cancel_price&amp;od_refund_price=$od_refund_price&amp;od_receipt_point=$od_receipt_point&amp;od_coupon=$od_coupon&amp;fr_date=$fr_date&amp;to_date=$to_date&amp;sel_field=$sel_field&amp;search=$search&amp;save_search=$search";
if($default['de_escrow_use'])
    $qstr1 .= "&amp;od_escrow=$od_escrow";
$qstr = "$qstr1&amp;sort1=$sort1&amp;sort2=$sort2&amp;page=$page";

/**
 * 상품목록
 */
$sql = " select it_id,
                it_name,
                cp_price,
                ct_notax,
                ct_send_cost,
                it_sc_type
           from {$g5['g5_shop_cart_table']}
          where od_id = '{$od['od_id']}'
          group by it_id
          order by ct_id ";
$result = sql_query($sql);

/**
 * 주소 참고항목 필드추가
 */
if(!isset($od['od_addr3'])) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_order_table']}`
                    ADD `od_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `od_addr2`,
                    ADD `od_b_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `od_b_addr2` ", true);
}

/**
 * 배송목록에 참고항목 필드추가
 */
if(!sql_query(" select ad_addr3 from {$g5['g5_shop_order_address_table']} limit 1", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_order_address_table']}`
                    ADD `ad_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `ad_addr2` ", true);
}

/**
 * 결제 PG 필드 추가
 */
if(!sql_query(" select od_pg from {$g5['g5_shop_order_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['g5_shop_order_table']}`
                    ADD `od_pg` varchar(255) NOT NULL DEFAULT '' AFTER `od_mobile`,
                    ADD `od_casseqno` varchar(255) NOT NULL DEFAULT '' AFTER `od_escrow` ", true);

    /**
     * 주문 결제 PG kcp로 설정
     */
    sql_query(" update {$g5['g5_shop_order_table']} set od_pg = 'kcp' ");
}

/**
 * LG 현금영수증 JS
 */
if($od['od_pg'] == 'lg') {
    if($default['de_card_test']) {
    echo '<script language="JavaScript" src="'.SHOP_TOSSPAYMENTS_CASHRECEIPT_TEST_JS.'"></script>'.PHP_EOL;
    } else {
        echo '<script language="JavaScript" src="'.SHOP_TOSSPAYMENTS_CASHRECEIPT_REAL_JS.'"></script>'.PHP_EOL;
    }
}

$print_od_deposit_name = $od['od_deposit_name'];
// nicepay 로 주문하고 가상계좌인 경우
if ($od['od_pg'] === 'nicepay' && $od['od_settle_case'] === '가상계좌' && $od['od_deposit_name']){
    $print_od_deposit_name .= '_NICE';
}

/**
 * add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
 */
add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js

/**
 * 주문상품 목록
 */
$chk_cnt = 0;
$list = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    /**
     * 상품이미지
     */
    $row['image'] = str_replace('"', "'", get_it_image($row['it_id'], 160, 160));
    $row['href'] = shop_item_url($row['it_id']);

    /**
     * 상품의 옵션정보
     */
    $sql = " select ct_id, it_id, ct_price, ct_point, ct_qty, ct_option, ct_status, cp_price, ct_stock_use, ct_point_use, ct_send_cost, io_type, io_price
                from {$g5['g5_shop_cart_table']}
                where od_id = '{$od['od_id']}'
                  and it_id = '{$row['it_id']}'
                order by io_type asc, ct_id asc ";
    $res = sql_query($sql);
    $row['rowspan'] = sql_num_rows($res);

    /**
     * 합계금액 계산
     */
    $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                    SUM(ct_qty) as qty
                from {$g5['g5_shop_cart_table']}
                where it_id = '{$row['it_id']}'
                  and od_id = '{$od['od_id']}' ";
    $sum = sql_fetch($sql);

    /**
     * 배송비
     */
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

    /**
     * 조건부무료
     */
    if($row['it_sc_type'] == 2) {
        $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $od['od_id']);

        if($sendcost == 0)
            $ct_send_cost = '무료';
    }

    $list[$i] = $row;
    $list[$i]['ct_send_cost'] = $ct_send_cost;

    $loop = &$list[$i]['opt'];

    for($k=0; $opt=sql_fetch_array($res); $k++) {
        if($opt['io_type'])
            $opt_price = $opt['io_price'];
        else
            $opt_price = $opt['ct_price'] + $opt['io_price'];

        /**
         * 소계
         */
        $ct_price['stotal'] = $opt_price * $opt['ct_qty'];
        $ct_point['stotal'] = $opt['ct_point'] * $opt['ct_qty'];

        $loop[$k] = $opt;
        $loop[$k]['opt_price'] = $opt_price;
        $loop[$k]['ct_price'] = $ct_price['stotal'];
        $loop[$k]['ct_point'] = $ct_point['stotal'];
        $loop[$k]['chk_cnt'] = $chk_cnt;

        $chk_cnt++;
    }
}

/**
 * 주문금액 = 상품구입금액 + 배송비 + 추가배송비
 */
$amount['order'] = $od['od_cart_price'] + $od['od_send_cost'] + $od['od_send_cost2'];

/**
 * 입금액 = 결제금액 + 포인트
 */
$amount['receipt'] = $od['od_receipt_price'] + $od['od_receipt_point'];

/**
 * 쿠폰금액
 */
$amount['coupon'] = $od['od_cart_coupon'] + $od['od_coupon'] + $od['od_send_coupon'];

/**
 * 취소금액
 */
$amount['cancel'] = $od['od_cancel_price'];

/**
 * 미수금 = 주문금액 - 취소금액 - 입금금액 - 쿠폰금액
 */
//$amount['미수'] = $amount['order'] - $amount['receipt'] - $amount['coupon'];

/**
 * 결제방법
 */
$s_receipt_way = check_pay_name_replace($od['od_settle_case'], $od);

if ($od['od_receipt_point'] > 0)
    $s_receipt_way .= "+포인트";

/**
 * 결제상세정보 - 결제대행사 링크
 */
if ($od['od_settle_case'] != '무통장') {
    switch($od['od_pg']) {
        case 'lg':
            $pg_url  = 'http://pgweb.tosspayments.com';
            $pg_test = '토스페이먼츠';
            if ($default['de_card_test']) {
                $pg_url = 'http://pgweb.tosspayments.com/tmert';
                $pg_test .= ' 테스트 ';
            }
            break;
        case 'inicis':
            $pg_url  = 'https://iniweb.inicis.com/';
            $pg_test = 'KG이니시스';
            break;
        case 'KAKAOPAY':
            $pg_url  = 'https://mms.cnspay.co.kr';
            $pg_test = 'KAKAOPAY';
            break;
        case 'nicepay':
            $pg_url  = 'https://npg.nicepay.co.kr/';
            $pg_test = 'NICEPAY';
            break;
        default:
            $pg_url  = 'http://admin8.kcp.co.kr';
            $pg_test = 'KCP';
            if ($default['de_card_test']) {
                // 로그인 아이디 / 비번
                // 일반 : test1234 / test12345
                // 에스크로 : escrow / escrow913
                $pg_url = 'http://testadmin8.kcp.co.kr';
                $pg_test .= ' 테스트 ';
            }
    }
}

/**
 * 현금영수증
 */
if ($od['od_misu'] == 0 && $od['od_receipt_price'] && ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체')) {
    if ($od['od_cash']) {
        if($od['od_pg'] == 'lg') {
            require G5_SHOP_PATH.'/settle_lg.inc.php';

            switch($od['od_settle_case']) {
                case '계좌이체':
                    $trade_type = 'BANK';
                    break;
                case '가상계좌':
                    $trade_type = 'CAS';
                    break;
                default:
                    $trade_type = 'CR';
                    break;
            }
            $cash_receipt_script = 'javascript:showCashReceipts(\''.$LGD_MID.'\',\''.$od['od_id'].'\',\''.$od['od_casseqno'].'\',\''.$trade_type.'\',\''.$CST_PLATFORM.'\');';
        } else if($od['od_pg'] == 'inicis') {
            $cash = unserialize($od['od_cash_info']);
            $cash_receipt_script = 'window.open(\'https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/Cash_mCmReceipt.jsp?noTid='.$cash['TID'].'&clpaymethod=22\',\'showreceipt\',\'width=380,height=540,scrollbars=no,resizable=no\');';
        } else if($od['od_pg'] == 'nicepay') {

            $od_tid = $od['od_tno'];
            $cash_type = 0;

            if (! $od_tid) {
                $cash = unserialize($od['od_cash_info']);
                $od_tid = isset($cash['TID']) ? $cash['TID'] : '';
                $cash_type = $od_tid ? 1 : 0;
            }

            $cash_receipt_script = 'window.open(\'https://npg.nicepay.co.kr/issue/IssueLoader.do?type='.$cash_type.'&TID='.$od_tid.'&noMethod=1\',\'receipt\',\'width=430,height=700\');';
        } else {
            require G5_SHOP_PATH.'/settle_kcp.inc.php';

            $cash = unserialize($od['od_cash_info']);
            $cash_receipt_script = 'window.open(\''.G5_CASH_RECEIPT_URL.$default['de_kcp_mid'].'&orderid='.$od_id.'&bill_yn=Y&authno='.$cash['receipt_no'].'\', \'taxsave_receipt\', \'width=360,height=647,scrollbars=0,menus=0\');';
        }
    }
}

/**
 * 계좌번호 안내
 */
if ($od['od_settle_case'] == '무통장' || $od['od_settle_case'] == '가상계좌' || $od['od_settle_case'] == '계좌이체') {
    if ($od['od_settle_case'] == '무통장') {
        // 은행계좌를 배열로 만든후
        $str = explode("\n", $default['de_bank_account']);
        $bank_account .= '<label class="select"><select name="od_bank_account" id="od_bank_account">'.PHP_EOL;
        $bank_account .= '<option value="">선택하십시오</option>'.PHP_EOL;
        for ($i=0; $i<count($str); $i++) {
            $str[$i] = str_replace("\r", "", $str[$i]);
            $bank_account .= '<option value="'.$str[$i].'" '.get_selected($od['od_bank_account'], $str[$i]).'>'.$str[$i].'</option>'.PHP_EOL;
        }
        $bank_account .= '</select><i></i></label>';
    } else if ($od['od_settle_case'] == '가상계좌') {
        $bank_account = $od['od_bank_account'].'<label class="input"><input type="hidden" name="od_bank_account" value="'.$od['od_bank_account'].'"></label>';
    } else if ($od['od_settle_case'] == '계좌이체') {
        $bank_account = $od['od_settle_case'];
    }
}