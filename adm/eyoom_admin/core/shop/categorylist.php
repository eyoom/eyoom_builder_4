<?php
/**
 * @file    /adm/eyoom_admin/core/shop/categorylist.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400200";

auth_check_menu($auth, $sub_menu, "r");

$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=categoryformupdate&amp;smode=1";
