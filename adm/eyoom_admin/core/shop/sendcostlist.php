<?php
/**
 * @file    /adm/eyoom_admin/core/config/sendcostlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400750";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=sendcostupdate&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$sql_common = " from {$g5['g5_shop_sendcost_table']} ";

$sql_search = " where (1) ";
$sql_order = " order by sc_id desc ";

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
for($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';