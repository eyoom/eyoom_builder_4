<?php
/**
 * @file    /adm/eyoom_admin/core/member/counsel_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200150";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=counsel_list_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

if ($wmode) {
    $qstr .= "&amp;wmode=1";
}

// 문의분야
$counsel_status = explode(',', $config['cf_counsel_status']);

$sql_common = " from {$g5['eyoom_counsel']} ";

$sql_search = " where (1) ";
if ($sfl && $stx) {
    $sql_search .= " and {$sfl} like '%{$stx}%' ";
}

$scs = clean_xss_tags(trim($_REQUEST['scs']));
if ($scs) {
    $sql_search .= " and cs_status = '{$scs}' ";
    $qstr .= "&amp;scs={$scs}";
}

// 기간검색이 있다면
$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

if ($fr_date && $to_date) {
    $sql_search .= " and cs_regdt between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
    $qstr .= "&amp;fr_date={$fr_date}&amp;to_date={$to_date}";
}

if (!$sst) {
    $sst = "cs_regdt";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) {
    $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
}
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);
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