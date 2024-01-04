<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/somo_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350200";

if (!isset($sm_bo_table)) exit;

$action_url1 = G5_ADMIN_URL . '/?dir=somoim&amp;pid=somo_list_update&amp;smode=1';

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['eyoom_somoim']} ";

$sql_search = " where (1) ";

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_id' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '%{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($smc) {
    $sql_search .= " and sm_category = '{$smc}' ";
    $qstr .= "&amp;smc={$smc}";
}

// 기간검색이 있다면
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($fr_date && $to_date) {
    $sql_search .= " and po_datetime between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

if (!$sst) {
    $sst  = "sm_regdt";
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

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('./?dir=somoim&amp;pid=somo_list&amp;'.$qstr.'&amp;page=');

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';
