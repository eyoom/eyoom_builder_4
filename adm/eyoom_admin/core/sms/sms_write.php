<?php
/**
 * @file    /adm/eyoom_admin/core/sms/sms_write.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900300";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = "문자 보내기";

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=sms_write_send&amp;smode=1';