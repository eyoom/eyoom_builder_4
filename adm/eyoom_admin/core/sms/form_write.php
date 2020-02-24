<?php
/**
 * @file    /adm/eyoom_admin/core/sms/form_write.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900600";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL.'/?dir=sms&amp;pid=form_update&amp;smode=1';

$g5['title'] = "이모티콘 ";

$fg_no = isset($fg_no) ? (int) $fg_no : '';

if ($w == 'u' && is_numeric($fo_no)) {
    $write = sql_fetch("select * from {$g5['sms5_form_table']} where fo_no='$fo_no'");
    $g5['title'] .= '수정';
}
else  {
    $write['fg_no'] = $fg_no;
    $g5['title'] .= '추가';
}