<?php
$sub_menu = '400400';
include_once('./_common.php');

if ($config['cf_admin'] != $member['mb_id']) {
    alert("권한이 없습니다.");
}

$where = array();

$sort1 = (isset($_GET['sort1']) && in_array($_GET['sort1'], array('od_id', 'od_cart_price', 'od_receipt_price', 'od_cancel_price', 'od_misu', 'od_cash'))) ? $_GET['sort1'] : '';
$sort2 = (isset($_GET['sort2']) && in_array($_GET['sort2'], array('desc', 'asc'))) ? $_GET['sort2'] : 'desc';
$sel_field = (isset($_GET['sel_field']) && in_array($_GET['sel_field'], array('od_id', 'it_name', 'mb_id', 'mb_nick', 'od_name', 'od_tel', 'od_hp', 'od_b_name', 'od_b_tel', 'od_b_hp', 'od_deposit_name', 'od_invoice')) ) ? $_GET['sel_field'] : ''; 
$od_status = isset($_GET['od_status']) ? get_search_string($_GET['od_status']) : '';
$search = isset($_GET['search']) ? get_search_string($_GET['search']) : '';

$fr_date = (isset($_GET['fr_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['fr_date'])) ? $_GET['fr_date'] : '';
$to_date = (isset($_GET['to_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['to_date'])) ? $_GET['to_date'] : '';

$od_misu = isset($_GET['od_misu']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_misu']) : '';
$od_cancel_price = isset($_GET['od_cancel_price']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_cancel_price']) : '';
$od_refund_price = isset($_GET['od_refund_price']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_refund_price']) : '';
$od_receipt_point = isset($_GET['od_receipt_point']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_receipt_point']) : '';
$od_coupon = isset($_GET['od_coupon']) ? preg_replace('/[^0-9a-z]/i', '', $_GET['od_coupon']) : ''; 
$od_settle_case = isset($_GET['od_settle_case']) ? clean_xss_tags($_GET['od_settle_case'], 1, 1) : ''; 
$od_escrow = isset($_GET['od_escrow']) ? clean_xss_tags($_GET['od_escrow'], 1, 1) : ''; 

$tot_itemcount = $tot_orderprice = $tot_receiptprice = $tot_ordercancel = $tot_misu = $tot_couponprice = 0;
$sql_search = "";

if ($sel_field != "") {
    // 상품명 검색
    if ($sel_field == 'it_name') {
        $sql = "select od_id from {$g5['g5_shop_cart_table']} where it_name like '%$search%' ";
        $res = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($res); $i++) {
            $s_od_id[$row['od_id']] = $row['od_id'];
        }
        
        if (isset($s_od_id) && is_array($s_od_id)) {
            $where[] = " find_in_set(od_id, '".implode(',', $s_od_id)."') > 0 ";
        }
    } else if ($sel_field == 'mb_nick') {
        $sql = "select mb_id from {$g5['member_table']} where mb_nick like '%$search%' ";
        $res = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($res); $i++) {
            $s_mb_id[$row['mb_id']] = $row['mb_id'];
        }
        
        if (isset($s_mb_id) && is_array($s_mb_id)) {
            $where[] = " find_in_set(mb_id, '".implode(',', $s_mb_id)."') > 0 ";
        }
    } else {
        $where[] = " $sel_field like '%$search%' ";
    }

    if ($save_search != $search) {
        $page = 1;
    }
}

if ($od_status) {
    switch($od_status) {
        case '전체취소':
            $where[] = " od_status = '취소' ";
            break;
        case '부분취소':
            $where[] = " od_status IN('주문', '입금', '준비', '배송', '완료') and od_cancel_price > 0 ";
            break;
        default:
            $where[] = " od_status = '$od_status' ";
            break;
    }

    switch ($od_status) {
        case '주문' :
            $sort1 = "od_id";
            $sort2 = "desc";
            break;
        case '입금' :   // 결제완료
            $sort1 = "od_receipt_time";
            $sort2 = "desc";
            break;
        case '배송' :   // 배송중
            $sort1 = "od_invoice_time";
            $sort2 = "desc";
            break;
    }
}

if ($od_settle_case) {
    if( $od_settle_case === '간편결제' ) {
        $where[] = " od_settle_case in ('간편결제', '삼성페이', 'lpay', 'inicis_kakaopay') ";
    } else {
        $where[] = " od_settle_case = '$od_settle_case' ";
    }
}

if ($od_misu) {
    $where[] = " od_misu != 0 ";
}

if ($od_cancel_price) {
    $where[] = " od_cancel_price != 0 ";
}

if ($od_refund_price) {
    $where[] = " od_refund_price != 0 ";
}

if ($od_receipt_point) {
    $where[] = " od_receipt_point != 0 ";
}

if ($od_coupon) {
    $where[] = " ( od_cart_coupon > 0 or od_coupon > 0 or od_send_coupon > 0 ) ";
}

if ($od_escrow) {
    $where[] = " od_escrow = 1 ";
}

if ($fr_date && $to_date) {
    $where[] = " od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
}

// 무료상품
$od_free = $_GET['od_free'] ? (int) $_GET['od_free']: 1;
if ($od_free) {
    $od_free_val = $od_free-1;
    if ($od_free_val == 0) {
        $where[] = " od_cart_price <> 0 ";
    }
    if ($od_free == '1') {
        $od_free_chk_1 = 'checked';
    } else if ($od_free == '2') {
        $od_free_chk_2 = 'checked';
    }
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sel_field == "")  $sel_field = "od_id";
if ($sort1 == "") $sort1 = "od_id";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from {$g5['g5_shop_order_table']} $sql_search and find_in_set(od_status,'입금,준비,배송,완료')  ";

$sql  = " select *,
            (od_cart_coupon + od_coupon + od_send_coupon) as couponprice
           $sql_common
           order by $sort1 $sort2 ";
$result = sql_query($sql);

if(!@sql_num_rows($result))
    alert('검색 대상 주문이 없습니다.');

if( function_exists('pg_setting_check') ){
    pg_setting_check(true);
}

function column_char($i) { return chr( 65 + $i ); }

if (phpversion() >= '5.2.0') {
    include_once(G5_LIB_PATH.'/PHPExcel.php');

    $headers = array('No', '주문번호', '상태', '상품정보', '옵션정보', '수량', '주문금액', '결제금액', '택배비', '합산금액', '포인트결제액', '주문자', '연락처', '주문일');
    $widths  = array(8, 15, 8, 60, 40, 8, 8, 8, 8, 8, 8, 8, 15, 25);
    $header_bgcolor = 'FFABCDEF';
    $last_char = column_char(count($headers) - 1);
    
    $rows = array();
    
    $k=1;
    for($i=1; $row=sql_fetch_array($result); $i++) {
        $q = "select * from {$g5['g5_shop_cart_table']} where od_id = '{$row['od_id']}' order by ct_id asc ";
        $r = sql_query($q);
        $rows = array();
        for ($j=0; $ct=sql_fetch_array($r); $j++) {
            $rows[$j] = array(
                ' ' . $j == 0 ? $k: '',
                $j == 0 ? $row['od_id']: '',
                $j == 0 ? $row['od_status']: '',
                $ct['it_name'],
                $ct['ct_option'],
                ' ' . $ct['ct_qty'],
                ' ' . $ct['ct_price'],
                ' ' . $ct['ct_price'] * $ct['ct_qty'],
                ' ' . $j == 0 ? $row['od_send_cost'] + $row['od_send_cost2']: '',
                ' ' . $j == 0 ? $row['od_receipt_price']: '',
                ' ' . $j == 0 ? $row['od_receipt_point']: '',
                $j == 0 ? $row['od_name']: '',
                ' ' . $j == 0 ? $row['od_hp']: '',
                $j == 0 ? $row['od_time']: ''
            );
            // Increment index for next row
        }
        $k++;
    }
    
    $data = array_merge(array($headers), $rows);
    
    $excel = new PHPExcel();
    $excel->setActiveSheetIndex(0)->getStyle("A1:${last_char}1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB($header_bgcolor);
    $excel->setActiveSheetIndex(0)->getStyle("A:$last_char")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setWrapText(true);
    foreach($widths as $i => $w) $excel->setActiveSheetIndex(0)->getColumnDimension(column_char($i))->setWidth($w);
    $excel->getActiveSheet()->fromArray($data, NULL, 'A1');
    
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"order_list_".date("ymdhis", time()).".xls\"");
    header("Cache-Control: max-age=0");
    
    $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
    $writer->save('php://output');
}