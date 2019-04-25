<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500310";

auth_check($auth[$sub_menu], "r");

$action_url1 = G5_ADMIN_URL . '/?dir=shopetc&amp;pid=itemeventlistupdate&amp;smode=1';

$ev_id = preg_replace('/[^0-9]/', '', $ev_id);

/**
 * 1차 상품 분류 가져오기
 */
$fields = " ca_id, ca_name ";
$cate1 = $shop->get_goods_cate1($fields);

$sql_search = " where (1) ";
$sfl = "";
if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " and $sfl like '%$stx%' ";
    }
}

if ($cate_a) {
    $sql_cate = " and (a.ca_id like '{$cate_a}%' or a.ca_id2 like '{$cate_a}%' or a.ca_id3 like '{$cate_a}%') ";
    $w = " (1) and ca_id like '{$cate_a}%' and length(ca_id)=4";
    $cate2 = $shop->get_goods_category($fields, $w);
}
if ($cate_a && $cate_b) {
    $sql_cate = " and (a.ca_id like '{$cate_b}%' or a.ca_id2 like '{$cate_b}%' or a.ca_id3 like '{$cate_b}%') ";
    $w = " (1) and ca_id like '{$cate_b}%' and length(ca_id)=6";
    $cate3 = $shop->get_goods_category($fields, $w);
}
if ($cate_a && $cate_b && $cate_c) {
    $sql_cate = " and (a.ca_id like '{$cate_c}%' or a.ca_id2 like '{$cate_c}%' or a.ca_id3 like '{$cate_c}%') ";
    $w = " (1) and ca_id like '{$cate_c}%' and length(ca_id)=8";
    $cate4 = $shop->get_goods_category($fields, $w);
}

$sql_search .= $sql_cate;

$sql_common = " from {$g5['g5_shop_item_table']} a
                left join {$g5['g5_shop_event_item_table']} b on (a.it_id=b.it_id and b.ev_id='$ev_id') ";
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
    $sst  = "it_id";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

$sql  = " select a.*, b.ev_id
          $sql_common
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

// 이벤트제목
if($ev_id) {
    $tmp = sql_fetch(" select ev_subject from {$g5['g5_shop_event_table']} where ev_id = '$ev_id' ");
    $ev_title = $tmp['ev_subject'];
}

// 이벤트 옵션처리
$event_option = "<option value=''>이벤트를 선택하세요</option>";
$sql1 = " select ev_id, ev_subject from {$g5['g5_shop_event_table']} order by ev_id desc ";
$result1 = sql_query($sql1);
while ($row1=sql_fetch_array($result1)) {
    $event_option .= '<option value="'.$row1['ev_id'].'" '.get_selected($ev_id, $row1['ev_id']).' >'.conv_subject($row1['ev_subject'], 20,"…").'</option>';
}

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $href = G5_SHOP_URL.'/item.php?it_id='.$row['it_id'];

    $sql = " select ev_id from {$g5['g5_shop_event_item_table']}
              where it_id = '{$row['it_id']}'
                and ev_id = '$ev_id' ";
    $ev = sql_fetch($sql);

    $list[$i] = $row;
    $list[$i]['it_name'] = preg_replace('/\r\n|\r|\n/', '', $row['it_name']);
    $list[$i]['image'] = str_replace('"', "'", get_it_image($row['it_id'], 160, 160));
    $list[$i]['href'] = $href;
    $list[$i]['is_ev_item'] = $ev['ev_id'] ? true: false;
}

$qstr .= "&amp;ev_id={$ev_id}";

/**
 * 페이징
 */
$paging = $eb->set_paging('./?dir=shop&amp;pid=itemeventlist&amp;'.$qstr.'&amp;page=');

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';