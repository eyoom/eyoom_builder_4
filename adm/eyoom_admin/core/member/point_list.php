<?php
/**
 * @file    /adm/eyoom_admin/core/member/point_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200200";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=point_list_delete&amp;smode=1';
$action_url2 = G5_ADMIN_URL . '/?dir=member&amp;pid=point_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

$sql_common = " from {$g5['point_table']} po";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id':
            $sql_search .= " (po.{$sfl} = '{$stx}') ";
            break;
        default:
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

// 기간검색이 있다면
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($fr_date && $to_date) {
    $sql_search .= " and po_datetime between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

$po_type = clean_xss_tags($_GET['po_type']);
if (!$po_type || $po_type == 'all') {
    $po_type = 'all';
    $po_type_all = 'checked';
} else {
    if ($po_type == 'in') {
        $po_type_in = 'checked';
        $sql_search .= " and po_point > '0' ";
    } else if ($po_type == 'out') {
        $po_type_out = 'checked';
        $sql_search .= " and po_point < '0' ";
    }
    $qstr .= "&amp;po_type={$po_type}";
}

if (!$sst) {
    $sst  = "po_id";
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
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select po.*, mb.mb_name, mb.mb_nick, mb.mb_email, mb.mb_homepage, mb.mb_point
            {$sql_common}
            LEFT JOIN {$g5['member_table']} mb ON po.mb_id = mb.mb_id 
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$mb = array();
if ($sfl == 'mb_id' && $stx) {
    $mb = get_member($stx);
}

$po_expire_term = '';
if ($config['cf_point_term'] > 0) {
    $po_expire_term = $config['cf_point_term'];
}

if (strstr($sfl, "mb_id")) {
    $mb_id = $stx;
} else {
    $mb_id = "";
}

if (!(isset($mb['mb_id']) && $mb['mb_id'])) {
    $row2 = sql_fetch(" select sum(po_point) as sum_point from {$g5['point_table']} ");
    $sum_point = $row2['sum_point'];
}

$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    if ($i==0 || ($row2['mb_id'] != $row['mb_id'])) {
        $sql2 = " select mb_id, mb_name, mb_nick, mb_email, mb_homepage, mb_point from {$g5['member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
    }

    $mb_nick = get_sideview($row['mb_id'], $row2['mb_nick'], $row2['mb_email'], $row2['mb_homepage']);

    $link1 = $link2 = '';
    if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table']) {
        $link1 = '<a href="'.get_eyoom_pretty_url($row['po_rel_table'], $row['po_rel_id']).'" target="_blank">';
        $link2 = '</a>';
    }

    $expr = '';
    if ($row['po_expired'] == 1) {
        $expr = ' txt_expired';
    }

    $list[$i] = $row;
    $list[$i]['mb_name'] = $row2['mb_name'];
    $list[$i]['mb_nick'] = $row2['mb_nick'];

    if (!preg_match("/^\@/", $row['po_rel_table']) && $row['po_rel_table']) {
        $list[$i]['link'] = true;
    }

    if ($row['po_expired'] == 1) {
        $list[$i]['expire_date'] = substr(str_replace('-', '', $row['po_expire_date']), 2);
    } else {
        $list[$i]['expire_date'] = $row['po_expire_date'] == '9999-12-31' ? '&nbsp;' : $row['po_expire_date'];
    }
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
