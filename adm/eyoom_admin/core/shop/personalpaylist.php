<?php
/**
 * @file    /adm/eyoom_admin/core/shop/personalpaylist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400440";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=personalpaylistdelete&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$sql_common = " from {$g5['g5_shop_personalpay_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'pp_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'od_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst  = "pp_id";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt
            {$sql_common}
            {$sql_search}
            {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$k = 0;
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

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