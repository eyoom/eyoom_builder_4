<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemstocklist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400620";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=itemstocklistupdate&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$fr_date = isset($_GET['fr_date']) ? trim($_GET['fr_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';

$cate_a = isset($_GET['cate_a']) ? (int) clean_xss_tags($_GET['cate_a']) : '';
$cate_b = isset($_GET['cate_b']) ? (int) clean_xss_tags($_GET['cate_b']) : '';
$cate_c = isset($_GET['cate_c']) ? (int) clean_xss_tags($_GET['cate_c']) : '';
$cate_d = isset($_GET['cate_d']) ? (int) clean_xss_tags($_GET['cate_d']) : '';

/**
 * 1차 상품 분류 가져오기
 */
$fields = " ca_id, ca_name ";
$cate1 = $shop->get_goods_cate1($fields);
if (!$cate1) $cate1 = array();

$sql_search = " where 1 ";
if ($search != "") {
    if ($sel_field != "") {
        $sql_search .= " and $sel_field like '%$search%' ";
    }
}

// 기간검색이 있다면
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($sdt == 'it_time') {
    $sdt_target = 'it_time';
} else if ($sdt == 'it_update_time') {
    $sdt_target = 'it_update_time';
}

if ($sdt_target && $fr_date && $to_date) {
    $sql_search .= " and $sdt_target between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;sdt={$sdt_target}&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

/**
 * 서브 카테고리
 */
$cate2 = $cate3 = $cate4 = array();
if ($cate_a) {
    $sql_cate = " and (ca_id like '{$cate_a}%' or ca_id2 like '{$cate_a}%' or ca_id3 like '{$cate_a}%') ";
    $w = " (1) and ca_id like '{$cate_a}%' and length(ca_id)=4";
    $cate2 = $shop->get_goods_category($fields, $w);
}
if ($cate_a && $cate_b) {
    $sql_cate = " and (ca_id like '{$cate_b}%' or ca_id2 like '{$cate_b}%' or ca_id3 like '{$cate_b}%') ";
    $w = " (1) and ca_id like '{$cate_b}%' and length(ca_id)=6";
    $cate3 = $shop->get_goods_category($fields, $w);
}
if ($cate_a && $cate_b && $cate_c) {
    $sql_cate = " and (ca_id like '{$cate_c}%' or ca_id2 like '{$cate_c}%' or ca_id3 like '{$cate_c}%') ";
    $w = " (1) and ca_id like '{$cate_c}%' and length(ca_id)=8";
    $cate4 = $shop->get_goods_category($fields, $w);
}

$sql_search .= $sql_cate;

if ($sfl == "")  $sfl = "it_name";

$sql_common = "  from {$g5['g5_shop_item_table']} ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = isset($row['cnt']) ? $row['cnt'] : 0;

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sst = in_array($sst, array('it_id', 'it_name', 'it_stock_qty', 'it_use', 'it_soldout', 'it_stock_sms')) ? $sst : '';
$sod = in_array($sod, array('desc', 'asc')) ? $sod : 'desc';

if (!$sst) {
    $sst  = "it_stock_qty";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";

$sql  = " select it_id,
                 it_name,
                 it_use,
                 it_stock_qty,
                 it_stock_sms,
                 it_noti_qty,
                 it_soldout
            $sql_common
            $sql_order
            limit $from_record, $rows ";
$result = sql_query($sql);

$qstr1 = 'sel_ca_id='.$sel_ca_id.'&amp;search='.$search;
$qstr = $qstr1.'&amp;page='.$page;

// 리스트
$k = 0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $href = shop_item_url($row['it_id']);

    // 선택옵션이 있을 경우 주문대기 수량 계산하지 않음
    $sql2 = " select count(*) as cnt from {$g5['g5_shop_item_option_table']} where it_id = '{$row['it_id']}' and io_type = '0' and io_use = '1' ";
    $row2 = sql_fetch($sql2);
    $wait_qty = 0;

    if(! (isset($row2['cnt']) && $row2['cnt'])) {
        $sql1 = " select SUM(ct_qty) as sum_qty
                    from {$g5['g5_shop_cart_table']}
                   where it_id = '{$row['it_id']}'
                     and ct_stock_use = '0'
                     and ct_status in ('쇼핑', '주문', '입금', '준비') ";
        $row1 = sql_fetch($sql1);
        $wait_qty = $row1['sum_qty'];
    }

    // 가재고 (미래재고)
    $temporary_qty = $row['it_stock_qty'] - $wait_qty;

    // 통보수량보다 재고수량이 작을 때
    $it_stock_qty = number_format((int)$row['it_stock_qty']);
    $it_stock_qty_st = ''; // 스타일 정의
    if($row['it_stock_qty'] <= $row['it_noti_qty']) {
        $it_stock_qty_st = ' sit_stock_qty_alert';
        $it_stock_qty = ''.$it_stock_qty.' <span class=\"sound_only\"> 재고부족 </span>';
    }

    $list[$i] = $row;
    $list[$i]['it_name'] = preg_replace('/\r\n|\r|\n/', '', cut_str(stripslashes($row['it_name']), 60, "&#133"));
    $list[$i]['href'] = $href;
    $list[$i]['wait_qty'] = (float)$wait_qty;
    $list[$i]['temporary_qty'] = (float)$temporary_qty;
    $list[$i]['it_stock_qty_st'] = $it_stock_qty_st;
    $list[$i]['it_stock_qty_str'] = $it_stock_qty;
    $list[$i]['image'] = str_replace('"', "'", get_it_image($row['it_id'], 160, 160));

    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';