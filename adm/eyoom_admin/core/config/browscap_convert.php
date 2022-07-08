<?php
/**
 * @file    /adm/eyoom_admin/core/config/browscap_convert.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100520";

if (!(version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE)) {
    alert('사용할 수 없는 기능입니다.', correct_goto_url(G5_ADMIN_URL));
}

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$rows = isset($_GET['rows']) ? preg_replace('#[^0-9]#', '', $_GET['rows']) : 0;
if (!$rows) {
    $rows = 100;
}
