<?php
/**
 * @file    /adm/eyoom_admin/core/board/faqlist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300700";

auth_check($auth[$sub_menu], "r");

$fm_id = (int) $fm_id;

$sql = " select * from {$g5['faq_master_table']} where fm_id = '$fm_id' ";
$fm = sql_fetch($sql);

$sql_common = " from {$g5['faq_table']} where fm_id = '$fm_id' ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = "select * $sql_common order by fa_order , fa_id ";
$result = sql_query($sql);

for ($i=0; $row=sql_fetch_array($result); $i++) {
    $row1 = sql_fetch(" select COUNT(*) as cnt from {$g5['faq_table']} where fm_id = '{$row['fm_id']}' ");
    $cnt = $row1['cnt'];

    $s_mod = icon("수정", "");
    $s_del = icon("삭제", "");

    $num = $i + 1;

    $list[$i] = $row;
    $list[$i]['num'] = $num;
    $list[$i]['cnt'] = $cnt;
    $row['fa_subject'] = str_replace("\r\n", '', strip_tags($row['fa_subject']));
    $list[$i]['fa_subject'] = str_replace('"', "'", strip_tags($row['fa_subject']));
}