<?php
/**
 * @file    /adm/eyoom_admin/core/shop/couponmember.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400800";

auth_check_menu($auth, $sub_menu, "w");

$mb_name = isset($_REQUEST['mb_name']) ? clean_xss_tags($_REQUEST['mb_name'], 1, 1) : '';

$sql_common = " from {$g5['member_table']} ";
$sql_where = " where mb_id <> '{$config['cf_admin']}' and mb_leave_date = '' and mb_intercept_date ='' ";

if($mb_name){
    $mb_name = preg_replace('/\!\?\*$#<>()\[\]\{\}/i', '', strip_tags($mb_name));
    $sql_where .= " and mb_name like '%".sql_real_escape_string($mb_name)."%' ";
}

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common . $sql_where;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " select mb_id, mb_name
            $sql_common
            $sql_where
            order by mb_id
            limit $from_record, $rows ";
$result = sql_query($sql);

$qstr1 = 'mb_name='.urlencode($mb_name);

$k = 0;
$list = array();
for($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;

    $list_num = $total_count - ($page - 1) * $rows;
    $list[$i]['num'] = $list_num - $k;
    $k++;
}

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr1.'&amp;wmode=1');