<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/somo_apply.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350300";

//$action_url1 = G5_ADMIN_URL . '/?dir=somoim&amp;pid=somo_list_update&amp;smode=1';

auth_check($auth[$sub_menu], 'r');

if (!isset($sm_bo_table)) exit;

$write_table = $g5['write_prefix'] . $sm_bo_table;
$sql_common = " from {$write_table} ";

/**
 * wr_nogood 필드를 개설 여부를 구분하는 필드로 활용
 */
$sql_search = " where (1) and wr_nogood = '0' and wr_id = wr_parent ";

if (!$sst) {
    $sst  = "wr_good";
    $sod = "desc";
}
$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$k=0;
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
    
    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('./?dir=somoim&amp;pid=somo_apply&amp;'.$qstr.'&amp;page=');
