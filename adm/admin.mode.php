<?php
$sub_menu = "100000";
include_once('./_common.php');

if (!$is_admin) alert('관리자만 접근 가능합니다.');

/**
 * 이윰 관리자 관련 설정
 */
if (!isset($config['cf_eyoom_admin'])) {
    sql_query("ALTER TABLE `{$g5['config_table']}`
                ADD `cf_eyoom_admin` enum('y','n') NOT NULL DEFAULT 'y' AFTER `cf_add_script`,
                ADD `cf_eyoom_admin_theme` varchar(255) NOT NULL DEFAULT 'basic' AFTER `cf_eyoom_admin`,
                ADD `cf_eyoom_mobile_skin` tinyint(4) NOT NULL DEFAULT '1' AFTER `cf_eyoom_admin_theme` ", true);
}

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