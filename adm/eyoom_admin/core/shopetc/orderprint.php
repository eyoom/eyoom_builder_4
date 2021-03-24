<?php
/**
 * @file    /adm/eyoom_admin/core/shopetc/orderprint.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "500120";

auth_check_menu($auth, $sub_menu, "r");

$action_url1 = G5_ADMIN_URL . '/?dir=shopetc&amp;pid=orderprintresult&amp;wmode=1';