<?php
/**
 * @file    /adm/eyoom_admin/core/config/inorderlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400410";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=inorderlistdelete&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$sql_common = " from {$g5['g5_shop_order_data_table']} ";

$sql_search = " where cart_id <> '0' ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
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
    $sst  = "od_id";
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
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    unset($pg);
    $data = unserialize(base64_decode($row['dt_data']));

    switch($row['dt_pg']) {
        case 'inicis':
            $pg = 'KG이니시스';
            break;
        case 'lg':
            $pg = 'LGU+';
            break;
        default:
            $pg = 'KCP';
            break;
    }

    // 주문금액
    $sql = " select sum(if(io_type = '1', io_price, (ct_price + io_price)) * ct_qty) as price from {$g5['g5_shop_cart_table']} where od_id = '{$row['cart_id']}' and ct_status = '쇼핑' ";
    $ct = sql_fetch($sql);

    $list[$i] = $row;
    $list[$i]['pg']             = $pg;
    $list[$i]['od_name']        = $data['od_name'];
    $list[$i]['od_tel']         = $data['od_tel'];
    $list[$i]['od_b_name']      = $data['od_b_name'];
    $list[$i]['od_settle_case'] = $data['od_settle_case'];
    $list[$i]['price']          = $ct['price'];
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