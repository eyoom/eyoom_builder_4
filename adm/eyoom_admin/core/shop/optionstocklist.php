<?php
/**
 * @file    /adm/eyoom_admin/core/shop/optionstocklist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400500";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=optionstocklistupdate&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$fr_date = isset($_GET['fr_date']) ? trim($_GET['fr_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';
$cate_a = isset($_GET['cate_a']) ? (int) clean_xss_tags($_GET['cate_a']) : '';
$cate_b = isset($_GET['cate_b']) ? (int) clean_xss_tags($_GET['cate_b']) : '';
$cate_c = isset($_GET['cate_c']) ? (int) clean_xss_tags($_GET['cate_c']) : '';

/**
 * 1차 상품 분류 가져오기
 */
$fields = " ca_id, ca_name ";
$cate1 = $shop->get_goods_cate1($fields);
if (!$cate1) $cate1 = array();

$sql_search = " where b.it_id is not NULL ";
if ($search != "") {
    if ($sel_field != "") {
        $sql_search .= " and $sel_field like '%$search%' ";
    }
}

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
    $sql_cate = " and (b.ca_id like '{$cate_a}%' or b.ca_id2 like '{$cate_a}%' or b.ca_id3 like '{$cate_a}%') ";
    $w = " (1) and ca_id like '{$cate_a}%' and length(ca_id)=4";
    $cate2 = $shop->get_goods_category($fields, $w);
}
if ($cate_a && $cate_b) {
    $sql_cate = " and (b.ca_id like '{$cate_b}%' or b.ca_id2 like '{$cate_b}%' or b.ca_id3 like '{$cate_b}%') ";
    $w = " (1) and ca_id like '{$cate_b}%' and length(ca_id)=6";
    $cate3 = $shop->get_goods_category($fields, $w);
}
if ($cate_a && $cate_b && $cate_c) {
    $sql_cate = " and (b.ca_id like '{$cate_c}%' or b.ca_id2 like '{$cate_c}%' or b.ca_id3 like '{$cate_c}%') ";
    $w = " (1) and ca_id like '{$cate_c}%' and length(ca_id)=8";
    $cate4 = $shop->get_goods_category($fields, $w);
}

$sql_search .= $sql_cate;

if ($sfl == "")  $sfl = "it_name";

$sql_common = "  from {$g5['g5_shop_item_option_table']} a left join {$g5['g5_shop_item_table']} b on ( a.it_id = b.it_id ) ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

if (!$sst) {
    $sst  = "it_stock_qty";
    $sod = "asc";
}
$sql_order = "order by $sst $sod";

$sql  = " select a.it_id,
                 a.io_id,
                 a.io_type,
                 a.io_stock_qty,
                 a.io_noti_qty,
                 a.io_use,
                 b.it_name,
                 b.it_option_subject,
                 b.ca_id
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

    $sql1 = " select SUM(ct_qty) as sum_qty
                from {$g5['g5_shop_cart_table']}
               where it_id = '{$row['it_id']}'
                 and io_id = '{$row['io_id']}'
                 and ct_stock_use = '0'
                 and ct_status in ('쇼핑', '주문', '입금', '준비') ";
    $row1 = sql_fetch($sql1);
    $wait_qty = $row1['sum_qty'];

    // 가재고 (미래재고)
    $temporary_qty = $row['io_stock_qty'] - $wait_qty;

    $option = '';
    $option_br = '';
    if($row['io_type']) {
        $opt = explode(chr(30), $row['io_id']);
        if($opt[0] && $opt[1])
            $option .= $opt[0].' : '.$opt[1];
    } else {
        $subj = explode(',', $row['it_option_subject']);
        $opt = explode(chr(30), $row['io_id']);
        for($k=0; $k<count($subj); $k++) {
            if($subj[$k] && $opt[$k]) {
                $option .= $option_br.$subj[$k].' : '.$opt[$k];
                $option_br = '<br>';
            }
        }
    }

    $type = '선택옵션';
    if($row['io_type'])
        $type = '추가옵션';

    // 통보수량보다 재고수량이 작을 때
    $io_stock_qty = number_format($row['io_stock_qty']);
    $io_stock_qty_st = ''; // 스타일 정의
    if($row['io_stock_qty'] <= $row['io_noti_qty']) {
        $io_stock_qty_st = ' sit_stock_qty_alert';
        $io_stock_qty = ''.$io_stock_qty.' <span class=\"sound_only\"> 재고부족 </span>';
    }

    $list[$i] = $row;
    $list[$i]['it_name'] = preg_replace('/\r\n|\r|\n/', '', cut_str(stripslashes($row['it_name']), 60, "&#133"));
    $list[$i]['option'] = $option;
    $list[$i]['href'] = $href;
    $list[$i]['wait_qty'] = $wait_qty;
    $list[$i]['temporary_qty'] = $temporary_qty;
    $list[$i]['type'] = $type;
    $list[$i]['io_stock_qty_st'] = $io_stock_qty_st;
    $list[$i]['io_stock_qty_str'] = $io_stock_qty;
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