<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemsellrank.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500100";

auth_check_menu($auth, $sub_menu, "r");

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : date("Y-m-d", time());

if (!empty($fr_date) && !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date)) {
    $fr_date = '';
}
if (!empty($to_date) && !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date)) {
    alert('올바른 방식으로 접근해 주세요.');
}

/**
 * 1차 상품 분류 가져오기
 */
$fields = " ca_id, ca_name ";
$cate1 = $shop->get_goods_cate1($fields);
if (!$cate1) $cate1 = array();

$sql  = " select a.it_id,
                 b.*,
                 SUM(IF(ct_status = '쇼핑',ct_qty, 0)) as ct_status_1,
                 SUM(IF(ct_status = '주문',ct_qty, 0)) as ct_status_2,
                 SUM(IF(ct_status = '입금',ct_qty, 0)) as ct_status_3,
                 SUM(IF(ct_status = '준비',ct_qty, 0)) as ct_status_4,
                 SUM(IF(ct_status = '배송',ct_qty, 0)) as ct_status_5,
                 SUM(IF(ct_status = '완료',ct_qty, 0)) as ct_status_6,
                 SUM(IF(ct_status = '취소',ct_qty, 0)) as ct_status_7,
                 SUM(IF(ct_status = '반품',ct_qty, 0)) as ct_status_8,
                 SUM(IF(ct_status = '품절',ct_qty, 0)) as ct_status_9,
                 SUM(ct_qty) as ct_status_sum
            from {$g5['g5_shop_cart_table']} a, {$g5['g5_shop_item_table']} b ";
$sql .= " where a.it_id = b.it_id ";

if ($stx != "") {
    if ($sfl != "") {
        $sql .= " and $sfl like '%$stx%' ";
    }
    if (isset($save_stx) && $save_stx && ($save_stx != $stx))
        $page = 1;
}

if (!$to_date) $to_date = date("Ymd", time());

if ($fr_date && $to_date)
{
    $fr = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $fr_date);
    $to = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3", $to_date);
    $sql .= " and a.ct_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
}

if ($cate_a) {
    $cate_id = $cate_a;
    $sql .= " and ((b.ca_id like '{$cate_id}%' or b.ca_id2 like '{$cate_id}%' or b.ca_id3 like '{$cate_id}%') and length(b.ca_id)>=2 ) ";
}
if ($cate_a && $cate_b) {
    $cate_id = $cate_a . $cate_b;
    $sql .= " and ((b.ca_id like '{$cate_id}%' or b.ca_id2 like '{$cate_id}%' or b.ca_id3 like '{$cate_id}%') and length(b.ca_id)>=4 ) ";
}
if ($cate_a && $cate_b && $cate_c) {
    $cate_id = $cate_a . $cate_b . $cate_c;
    $sql .= " and ((b.ca_id like '{$cate_id}%' or b.ca_id2 like '{$cate_id}%' or b.ca_id3 like '{$cate_id}%') and length(b.ca_id)>=6 ) ";
}
if ($cate_a && $cate_b && $cate_c && $cate_d) {
    $cate_id = $cate_a . $cate_b . $cate_c . $cate_d;
    $sql .= " and ((b.ca_id like '{$cate_id}%' or b.ca_id2 like '{$cate_id}%' or b.ca_id3 like '{$cate_id}%') and length(b.ca_id)=8 ) ";
}

if (!$sst) {
    $sst  = "ct_status_sum";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

$sql .= " group by a.it_id
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

//$qstr = 'page='.$page.'&amp;sort1='.$sort1.'&amp;sort2='.$sort2;
$qstr .= '&amp;fr_date='.$fr_date.'&amp;to_date='.$to_date;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++)
{
    $href = shop_item_url($row['it_id']);
    $num = $rank + $i + 1;

    $list[$i] = $row;
    $list[$i]['it_name'] = preg_replace('/\r\n|\r|\n/', '', $row['it_name']);
    $list[$i]['num'] = $num;
    $list[$i]['href'] = $href;
    $list[$i]['image'] = str_replace('"', "'", get_it_image($row['it_id'], 160, 160) );
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