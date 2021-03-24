<?php
/**
 * @file    /adm/eyoom_admin/core/sms/sms_write.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900300";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$wr_no = isset($_REQUEST['wr_no']) ? (int) $_REQUEST['wr_no'] : 0;
$bk_no = isset($_REQUEST['bk_no']) ? (int) $_REQUEST['bk_no'] : 0;
$fo_no = isset($_REQUEST['fo_no']) ? (int) $_REQUEST['fo_no'] : 0;

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "문자 보내기";

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=sms_write_send&amp;smode=1';