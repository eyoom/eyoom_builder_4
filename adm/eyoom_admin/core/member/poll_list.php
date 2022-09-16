<?php
/**
 * @file    /adm/eyoom_admin/core/member/poll_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200900";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=poll_delete&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

$sql_common = " from {$g5['poll_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default:
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if (!$sst) {
    $sst = "po_id";
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

$sql = " select *
            {$sql_common}
            {$sql_search}
            {$sql_order}
            limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $sql2 = " select sum(po_cnt1+po_cnt2+po_cnt3+po_cnt4+po_cnt5+po_cnt6+po_cnt7+po_cnt8+po_cnt9) as sum_po_cnt from {$g5['poll_table']} where po_id = '{$row['po_id']}' ";
    $row2 = sql_fetch($sql2);
    $po_etc = ($row['po_etc']) ? "사용" : "미사용";
    $po_use = ($row['po_use']) ? "사용" : "미사용";

    $s_mod = "<a href='".G5_ADMIN_URL."/?dir=member&amp;pid=poll_form&amp;".$qstr."&amp;w=u&amp;po_id=".$row['po_id']."' class='btn-e btn-e-red btn-e-sm'>수정</a>";

    $list[$i] = $row;
    $list[$i]['po_etc'] = $po_etc;
    $list[$i]['po_use'] = $po_use;
    $list[$i]['s_mode'] = $s_mod;
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