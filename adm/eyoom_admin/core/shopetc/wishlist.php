<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/wishlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500140";

auth_check_menu($auth, $sub_menu, "r");

// 기간검색이 있다면
$fr_date = isset($_GET['fr_date']) ? trim($_GET['fr_date']) : '';
$to_date = isset($_GET['to_date']) ? trim($_GET['to_date']) : '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

$cate_a = isset($_GET['cate_a']) ? (int) clean_xss_tags(trim($_GET['cate_a'])) : '';
$cate_b = isset($_GET['cate_b']) ? (int) clean_xss_tags(trim($_GET['cate_b'])) : '';
$cate_c = isset($_GET['cate_c']) ? (int) clean_xss_tags(trim($_GET['cate_c'])) : '';

/**
 * 1차 상품 분류 가져오기
 */
$fields = " ca_id, ca_name ";
$cate1 = $shop->get_goods_cate1($fields);

$sql_search = " where a.it_id = b.it_id ";
$sfl = "";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " and $sfl like '%$stx%' ";
    }
}

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

if (!$to_date) $to_date = date("Y-m-d", time());

if ($fr_date && $to_date)
{
    $sql_search .= " and a.wi_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
}

if (!$sst) {
    $sst  = "it_id_cnt";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

$sql  = " select a.it_id,
                 b.it_name,
                 COUNT(a.it_id) as it_id_cnt
            from {$g5['g5_shop_wish_table']} a, {$g5['g5_shop_item_table']} b ";
$sql .= " $sql_search ";

$sql .= " group by a.it_id, b.it_name
          $sql_order ";
$result = sql_query($sql);
$total_count = sql_num_rows($result);

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$rank = ($page - 1) * $rows;

$sql = $sql . " limit $from_record, $rows ";
$result = sql_query($sql);

$qstr .= '&amp;fr_date='.$fr_date.'&amp;to_date='.$to_date;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    // $s_mod = icon("수정", "./itemqaform.php?w=u&amp;iq_id={$row['iq_id']}&amp;$qstr");
    // $s_del = icon("삭제", "javascript:del('./itemqaupdate.php?w=d&amp;iq_id={$row['iq_id']}&amp;$qstr');");

    $href = shop_item_url($row['it_id']);
    $num = $rank + $i + 1;

    $list[$i] = $row;
    $list[$i]['it_name'] = preg_replace('/\r\n|\r|\n/', '', $row['it_name']);
    $list[$i]['num'] = $num;
    $list[$i]['image'] = str_replace('"', "'", get_it_image($row['it_id'], 160, 160));
    $list[$i]['href'] = $href;
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