<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemuselist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400650";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=itemuselistupdate&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

if (isset($sfl) && $sfl && !in_array($sfl, array('it_name','a.it_id','is_name'))) {
    $sfl = '';
}

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

$where = " where ";
$sql_search = "";
$save_stx = isset($_REQUEST['save_stx']) ? clean_xss_tags($_REQUEST['save_stx'], 1, 1) : '';

if ($stx != "") {
    if ($sfl != "") {
        $sql_search .= " $where $sfl like '%$stx%' ";
        $where = " and ";
    }
    if (isset($save_stx) && $save_stx && ($save_stx != $stx))
        $page = 1;
}

if ($sca != "") {
    $sql_search .= " and ca_id like '$sca%' ";
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

if ($sfl == "")  $sfl = "a.it_name";
if (!$sst) {
    $sst = "is_id";
    $sod = "desc";
}

$sql_common = "  from {$g5['g5_shop_item_use_table']} a
                 left join {$g5['g5_shop_item_table']} b on (a.it_id = b.it_id)
                 left join {$g5['member_table']} c on (a.mb_id = c.mb_id) ";
$sql_common .= $sql_search;

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql  = " select *
          $sql_common
          order by $sst $sod, is_id desc
          limit $from_record, $rows ";
$result = sql_query($sql);

//$qstr = 'page='.$page.'&amp;sst='.$sst.'&amp;sod='.$sod.'&amp;stx='.$stx;
$qstr .= ($qstr ? '&amp;' : '').'sca='.$sca.'&amp;save_stx='.$stx;

$k=0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    $list[$i]['href'] = shop_item_url($row['it_id']);
    $list[$i]['it_name'] = preg_replace('/\r\n|\r|\n/', '', $row['it_name']);

    $list[$i]['is_content'] = str_replace('"', "'", get_view_thumbnail(conv_content(str_replace(array("\n","\r"),"",$row['is_content']), 1), 300));
    $list[$i]['image'] = str_replace('"', "'", get_it_image($row['it_id'], 160, 160));
    // get_it_image($row['it_id'], 50, 50);

    $list[$i]['bg'] = 'bg'.($i%2);

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