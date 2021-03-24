<?php
/**
 * @file    /adm/eyoom_admin/core/sms/num_book_file.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900900";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "휴대폰번호 파일";

$no_group = sql_fetch("select * from {$g5['sms5_book_group_table']} where bg_no = 1");

$group = array();
$qry = sql_query("select * from {$g5['sms5_book_group_table']} where bg_no > 1 order by bg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);