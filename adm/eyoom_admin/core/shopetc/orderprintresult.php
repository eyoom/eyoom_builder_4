<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/orderprintresult.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500120";

$fr_date = preg_replace('/[^0-9_\-]/', '', $fr_date);
$to_date = preg_replace('/[^0-9_\-]/', '', $to_date);

auth_check($auth[$sub_menu], "r");

function conv_telno($t)
{
    // 숫자만 있고 0으로 시작하는 전화번호
    if (!preg_match("/[^0-9]/", $t) && preg_match("/^0/", $t))  {
        if (preg_match("/^01/", $t)) {
            $t = preg_replace("/([0-9]{3})(.*)([0-9]{4})/", "\\1-\\2-\\3", $t);
        } else if (preg_match("/^02/", $t)) {
            $t = preg_replace("/([0-9]{2})(.*)([0-9]{4})/", "\\1-\\2-\\3", $t);
        } else {
            $t = preg_replace("/([0-9]{3})(.*)([0-9]{4})/", "\\1-\\2-\\3", $t);
        }
    }

    return $t;
}

// 1.04.01
// MS엑셀 CSV 데이터로 다운로드 받음
if ($csv == 'csv')
{
    $fr_date = date_conv($fr_date);
    $to_date = date_conv($to_date);


    $sql = " SELECT a.od_id, od_b_zip1, od_b_zip2, od_b_addr1, od_b_addr2, od_b_addr3, od_b_addr_jibeon, od_b_name, od_b_tel, od_b_hp, b.it_name, ct_qty, b.it_id, a.od_id, od_memo, od_invoice, b.ct_option, b.ct_send_cost, b.it_sc_type, a.od_time
               FROM {$g5['g5_shop_order_table']} a, {$g5['g5_shop_cart_table']} b
              where a.od_id = b.od_id ";
    if ($case == 1) // 출력기간
        $sql .= " and a.od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    else // 주문번호구간
        $sql .= " and a.od_id between '$fr_od_id' and '$to_od_id' ";
    if ($ct_status)
        $sql .= " and b.ct_status = '$ct_status' ";
    $sql .="  order by od_time asc, b.it_id, b.io_type, b.ct_id ";
    $result = sql_query($sql);
    $cnt = @sql_num_rows($result);
    if (!$cnt)
        alert("출력할 내역이 없습니다.");

    //header('Content-Type: text/x-csv');
    header("Content-charset=utf-8");
    header('Content-Type: doesn/matter');
    header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Content-Disposition: attachment; filename="orderlist-' . date("ymd", time()) . '.csv"');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    //echo "우편번호,주소,이름,전화1,전화2,상품명,수량,비고,전하실말씀\n";
    echo iconv('utf-8', 'euc-kr', "우편번호,주소,이름,전화1,전화2,상품명,수량,선택사항,배송비,상품코드,주문번호,운송장번호,전하실말씀\n");

    $save_it_id = '';
    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $pull_address = iconv('UTF-8', 'UHC', print_address($row['od_b_addr1'], $row['od_b_addr2'], $row['od_b_addr3'], $row['od_b_addr_jibeon']));

        $row = array_map('iconv_euckr', $row);

        if($save_it_id != $row['it_id']) {
            // 합계금액 계산
            $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                            SUM(ct_qty) as qty
                        from {$g5['g5_shop_cart_table']}
                        where it_id = '{$row['it_id']}'
                          and od_id = '{$row['od_id']}' ";
            $sum = sql_fetch($sql);

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
                $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $row['od_id']);

                if($sendcost == 0)
                    $ct_send_cost = '무료';
            }

            $save_it_id = $row['it_id'];

            $ct_send_cost = iconv_euckr($ct_send_cost);
        }

        echo '"\''.$row['od_b_zip1'].$row['od_b_zip2'].'"\''.',';
        echo '"'.$pull_address.'"'.',';
        echo '"'.$row['od_b_name'].'"'.',';
        //echo '"'.multibyte_digit((string)$row[od_b_tel]).'"'.',';
        //echo '"'.multibyte_digit((string)$row[od_b_hp]).'"'.',';
        echo '"'.conv_telno($row['od_b_tel']) . '"'.',';
        echo '"'.conv_telno($row['od_b_hp']) . '"'.',';
        echo '"'.preg_replace("/\"/", "&#034;", $row['it_name']) . '"'.',';
        echo '"'.$row['ct_qty'].'"'.',';
        echo '"'.$row['ct_option'].'"'.',';
        echo '"'.$ct_send_cost.'"'.',';
        echo '"\''.$row['it_id'].'\'"'.',';
        echo '"\''.$row['od_id'].'\'"'.',';
        echo '"'.$row['od_invoice'].'"'.',';
        //echo '"'.preg_replace("/\"/", "&#034;", preg_replace("/\n/", "", $row[od_memo])).'"';
        echo '"'.preg_replace("/\"/", "&#034;", $row['od_memo']).'"';
        echo "\n";
    }
    if ($i == 0)
        echo '자료가 없습니다.'.PHP_EOL;

    exit;
}

// MS엑셀 XLS 데이터로 다운로드 받음
if ($csv == 'xls')
{
    $fr_date = date_conv($fr_date);
    $to_date = date_conv($to_date);

    $sql = " SELECT a.od_id, od_zip1, od_zip2, od_addr1, od_addr2, od_addr3, od_addr_jibeon, od_name, od_tel, od_hp, od_b_zip1, od_b_zip2, od_b_addr1, od_b_addr2, od_b_addr3, od_b_addr_jibeon, od_b_name, od_b_tel, od_b_hp, b.it_name, ct_qty, b.it_id, a.od_id, od_memo, od_invoice, b.ct_option, b.ct_send_cost, b.it_sc_type, a.od_time
               FROM {$g5['g5_shop_order_table']} a, {$g5['g5_shop_cart_table']} b
              where a.od_id = b.od_id ";
    if ($case == 1) // 출력기간
        $sql .= " and a.od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    else // 주문번호구간
        $sql .= " and a.od_id between '$fr_od_id' and '$to_od_id' ";
    if ($ct_status)
        $sql .= " and b.ct_status = '$ct_status' ";
    $sql .="  order by od_time asc, b.it_id, b.io_type, b.ct_id ";
    $result = sql_query($sql);
    $cnt = @sql_num_rows($result);
    if (!$cnt)
        alert("출력할 내역이 없습니다.");

    /*================================================================================
    php_writeexcel http://www.bettina-attack.de/jonny/view.php/projects/php_writeexcel/
    =================================================================================*/

    include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_workbook.inc.php');
    include_once(G5_LIB_PATH.'/Excel/php_writeexcel/class.writeexcel_worksheet.inc.php');

    $fname = tempnam(G5_DATA_PATH, "tmp-orderlist.xls");
    $workbook = new writeexcel_workbook($fname);
    $worksheet = $workbook->addworksheet();

    // Put Excel data
    $data = array('보내는분_우편번호', '보내는분_주소', '보내는분_이름', '보내는분_전화1', '보내는분_전화2', '받는분_우편번호', '받는분_주소', '받는분_이름', '받는분_전화1', '받는분_전화2', '상품명', '수량', '선택사항', '배송비', '상품코드', '주문번호', '운송장번호', '전하실말씀');
    $data = array_map('iconv_euckr', $data);

    $col = 0;
    foreach($data as $cell) {
        $worksheet->write(0, $col++, $cell);
    }

    $save_it_id = '';
    for($i=1; $row=sql_fetch_array($result); $i++)
    {
        if($save_it_id != $row['it_id']) {
            // 합계금액 계산
            $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                            SUM(ct_qty) as qty
                        from {$g5['g5_shop_cart_table']}
                        where it_id = '{$row['it_id']}'
                          and od_id = '{$row['od_id']}' ";
            $sum = sql_fetch($sql);

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
                $sendcost = get_item_sendcost($row['it_id'], $sum['price'], $sum['qty'], $row['od_id']);

                if($sendcost == 0)
                    $ct_send_cost = '무료';
            }

            $save_it_id = $row['it_id'];

            $ct_send_cost = iconv_euckr($ct_send_cost);
        }

        $pull_address = iconv('UTF-8', 'UHC', print_address($row['od_b_addr1'], $row['od_b_addr2'], $row['od_b_addr3'], $row['od_b_addr_jibeon']));

        $row = array_map('iconv_euckr', $row);

        $worksheet->write($i, 0, ' '.$row['od_zip1'].$row['od_zip2']);
        $worksheet->write($i, 1, $send_address);
        $worksheet->write($i, 2, $row['od_name']);
        $worksheet->write($i, 3, ' '.$row['od_tel']);
        $worksheet->write($i, 4, ' '.$row['od_hp']);
        $worksheet->write($i, 5, ' '.$row['od_b_zip1'].$row['od_b_zip2']);
        $worksheet->write($i, 6, $pull_address);
        $worksheet->write($i, 7, $row['od_b_name']);
        $worksheet->write($i, 8, ' '.$row['od_b_tel']);
        $worksheet->write($i, 9, ' '.$row['od_b_hp']);
        $worksheet->write($i, 10, $row['it_name']);
        $worksheet->write($i, 11, $row['ct_qty']);
        $worksheet->write($i, 12, $row['ct_option']);
        $worksheet->write($i, 13, $ct_send_cost);
        $worksheet->write($i, 14, ' '.$row['it_id']);
        $worksheet->write($i, 15, ' '.$row['od_id']);
        $worksheet->write($i, 16, $row['od_invoice']);
        $worksheet->write($i, 17, $row['od_memo']);
    }

    $workbook->close();

    header("Content-Type: application/x-msexcel; name=\"orderlist-".date("ymd", time()).".xls\"");
    header("Content-Disposition: inline; filename=\"orderlist-".date("ymd", time()).".xls\"");
    $fh=fopen($fname, "rb");
    fpassthru($fh);
    unlink($fname);

    exit;
}

function get_order($od_id)
{
    global $g5;

    $sql = " select * from {$g5['g5_shop_order_table']} where od_id = '$od_id' ";
    return sql_fetch($sql);
}

if ($case == 1)
{
    $fr_date = date_conv($fr_date);
    $to_date = date_conv($to_date);
    $sql = " SELECT DISTINCT a.od_id FROM {$g5['g5_shop_order_table']} a, {$g5['g5_shop_cart_table']} b
              where a.od_id = b.od_id
                and a.od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
}
else
{
    $sql = " SELECT DISTINCT a.od_id FROM {$g5['g5_shop_order_table']} a, {$g5['g5_shop_cart_table']} b
              where a.od_id = b.od_id
                and a.od_id between '$fr_od_id' and '$to_od_id' ";
}
if ($ct_status)
    $sql .= " and b.ct_status = '$ct_status' ";
$sql .= " order by a.od_id ";
$result = sql_query($sql);
if (sql_num_rows($result) == 0)
{
    echo "<script>alert('출력할 내역이 없습니다.'); window.close();</script>";
    exit;
}


$mod = 10;
$tot_total_price = 0;
$save_it_id = '';
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $sql1 = " select * from {$g5['g5_shop_order_table']} where od_id = '{$row['od_id']}' ";
    $row1 = sql_fetch($sql1);

    // 1.03.02
    $row1['od_addr'] = '('.$row1['od_zip1'].$row1['od_zip2'].') '.print_address($row1['od_addr1'], $row1['od_addr2'], $row1['od_addr3'], $row1['od_addr_jibeon']);
    $row1['od_b_addr'] = '('.$row1['od_b_zip1'].$row1['od_b_zip2'].') '.print_address($row1['od_b_addr1'], $row1['od_b_addr2'], $row1['od_b_addr3'], $row1['od_b_addr_jibeon']);

    $row1['od_addr'] = ($row1['od_addr']) ? $row1['od_addr'] : '입력안함';
    $row1['od_tel'] = ($row1['od_tel']) ? $row1['od_tel'] : '입력안함';
    $row1['od_hp']  = ($row1['od_hp']) ? $row1['od_hp'] : '입력안함';
    $row1['od_b_tel'] = ($row1['od_b_tel']) ? $row1['od_b_tel'] : '입력안함';
    $row1['od_b_hp']  = ($row1['od_b_hp']) ? $row1['od_b_hp'] : '입력안함';

    // 보내는 사람과 받는 사람이 완전 일치하면 간단하게 출력
    // 보내는 사람과 받는 사람이 부분 일치하더라도 원래 내용을 모두 출력
    // 지운아빠 2013-04-18
    if ($row1['od_name'] == $row1['od_b_name'] && $row1['od_addr'] == $row1['od_b_addr'] && $row1['od_tel'] == $row1['od_b_tel'] &&  $row1['od_hp'] == $row1['od_b_hp'] && $row1['od_hp'] != "&nbsp;") $samesamesame = 1;
    else $samesamesame = '';

    $od_memo = ($row1['od_memo']) ? get_text(stripslashes($row1['od_memo'])) : '';
    $od_shop_memo = ($row1['od_shop_memo']) ? get_text(stripslashes($row1['od_shop_memo'])) : '';

    $sql2 = " select *
                from {$g5['g5_shop_cart_table']}
               where od_id = '{$row['od_id']}' ";
    if ($ct_status)
        $sql2 .= " and ct_status = '$ct_status' ";
    $sql2 .= "  order by it_id, io_type, ct_id ";

    $res2 = sql_query($sql2);
    $cnt = $sub_tot_qty = $sub_tot_price = 0;
    $save_it_id = '';

    $ordinfo[$i] = $row1;

    $loop = &$ordinfo[$i]['orditem'];

    while ($row2 = sql_fetch_array($res2))
    {
        if($row2['io_type']) {
            $it_price = $row2['io_price'];
            $row2_tot_price = $row2['io_price'] * $row2['ct_qty'];
        } else {
            $it_price = $row2['ct_price'] + $row2['io_price'];
            $row2_tot_price = ($row2['ct_price'] + $row2['io_price']) * $row2['ct_qty'];
        }
        $sub_tot_qty += $row2['ct_qty'];
        $sub_tot_price += $row2_tot_price;

        $it_name = stripslashes($row2['it_name']);
        $price_plus = '';
        if($row2['io_price'] >= 0)
            $price_plus = '+';

        $it_name = "$it_name ({$row2['ct_option']} ".$price_plus.display_price($row2['io_price']).")";

        if($save_it_id != $row2['it_id']) {
            switch($row2['ct_send_cost'])
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

            // 합계금액 계산
            $sql = " select SUM(IF(io_type = 1, (io_price * ct_qty), ((ct_price + io_price) * ct_qty))) as price,
                            SUM(ct_qty) as qty
                        from {$g5['g5_shop_cart_table']}
                        where it_id = '{$row2['it_id']}'
                          and od_id = '{$row2['od_id']}' ";
            $sum = sql_fetch($sql);

            // 조건부무료
            if($row2['it_sc_type'] == 2) {
                $sendcost = get_item_sendcost($row2['it_id'], $sum['price'], $sum['qty'], $row['od_id']);

                if($sendcost == 0)
                    $ct_send_cost = '무료';
            }

            $save_it_id = $row2['it_id'];
        }

        $loop[$cnt] = $row2;
        $loop[$cnt]['it_name'] = $it_name;
        $loop[$cnt]['it_price'] = $it_price;
        $loop[$cnt]['row2_tot_price'] = $row2_tot_price;
        $loop[$cnt]['ct_send_cost'] = $ct_send_cost;

        $cnt++;
    }
    $ordinfo[$i]['sub_tot_qty'] = $sub_tot_qty;
    $ordinfo[$i]['sub_tot_price'] = $sub_tot_price;
    $tot_tot_qty    += ($sub_tot_qty + 2);
    $tot_tot_price  += ($sub_tot_price + $row1['od_send_cost'] + $row1['od_send_cost2']);

    if ($od_memo) $od_memo = "<p><strong>비고</strong> $od_memo</p>";
    if ($od_shop_memo) $od_shop_memo = "<p><strong>상점메모</strong> $od_shop_memo</p>";

}