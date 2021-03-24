<?php
/**
 * @file    /adm/eyoom_admin/core/sms/install.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "SMS5 솔루션 설치";

$setup = (isset($_POST['setup']) && $_POST['setup']) ? 1 : 0;

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=install';