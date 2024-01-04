<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/itemeventlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500310";

$action_url1 = G5_ADMIN_URL . '/?dir=shopetc&amp;pid=itemeventlistupdate&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$ev_id = isset($_GET['ev_id']) ? preg_replace('/[^0-9]/', '', $_GET['ev_id']) : '';
$sst = (isset($_GET['sst']) && in_array($_GET['sst'], array('a.it_id', 'it_name'))) ? $_GET['sst'] : 'a.it_id';
$sod = (isset($_GET['sod']) && in_array($_GET['sod'], array('desc', 'asc'))) ? $_GET['sod'] : 'desc';
$sfl = (isset($_GET['sfl']) && in_array($_GET['sfl'], array('a.it_id', 'it_name')) ) ? $_GET['sfl'] : 'it_name';
$stx = isset($_GET['stx']) ? get_search_string($_GET['stx']) : '';
$ev_title = isset($ev_title) ? clean_xss_tags($ev_title, 1, 1) : '';

$cate_a = isset($_GET['cate_a']) ? (int) clean_xss_tags($_GET['cate_a']) : '';
$cate_b = isset($_GET['cate_b']) ? (int) clean_xss_tags($_GET['cate_b']) : '';
$cate_c = isset($_GET['cate_c']) ? (int) clean_xss_tags($_GET['cate_c']) : '';
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
    $sst  = "b.ev_id";
    $sod = "desc";
}
$sql_order = "order by $sst $sod";

$sql  = " select a.*, b.ev_id
          $sql_common
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);

//$qstr1 = 'sel_ca_id='.$sel_ca_id.'&amp;sel_field='.$sel_field.'&amp;search='.$search;
$qstr1 = 'ev_id='.$ev_id.'&amp;cate_a='.$cate_a.'&amp;cate_b='.$cate_b.'&amp;cate_c='.$cate_c.'&amp;sfl='.$sfl.'&amp;stx='.$stx;
$qstr  = $qstr1.'&amp;sst='.$sst.'&amp;sod='.$sod.'&amp;page='.$page;

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
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $href = shop_item_url($row['it_id']);

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