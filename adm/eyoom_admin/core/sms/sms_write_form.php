<?php
/**
 * @file    /adm/eyoom_admin/core/sms/sms_write_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$group = array();
$qry = sql_query("select * from {$g5['sms5_form_group_table']} order by fg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

$res = sql_fetch("select count(*) as cnt from `{$g5['sms5_form_table']}` where fg_no=0");
$no_count = $res['cnt'];

/**
 * 페이지 출력
 */
include_once(EYOOM_ADMIN_THEME_PATH . "/skin/sms/sms_write_form.html.php");