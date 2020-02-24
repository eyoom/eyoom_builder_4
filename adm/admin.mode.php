<?php
$sub_menu = "100000";
include_once('./_common.php');

if (!$is_admin) alert('관리자만 접근 가능합니다.');

$cf_eyoom_admin = '';

$permit_to = array('gnu', 'eyoom');
$to = trim($_GET['to']);
if (!in_array($to, $permit_to)) {
	alert('잘못된 접근입니다.');
} else {
	switch ($to) {
		case 'gnu': $cf_eyoom_admin = 'n'; break;
		case 'eyoom': $cf_eyoom_admin = 'y'; break;
	}
	
	$sql = "update `{$g5['config_table']}` set cf_eyoom_admin = '{$cf_eyoom_admin}' ";
	sql_query($sql, false);
	
	goto_url(G5_ADMIN_URL, false);
}