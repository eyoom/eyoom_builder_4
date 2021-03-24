<?php
/**
 * @file    /adm/eyoom_admin/core/shop/orderdelivery.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400400";

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=orderdeliveryupdate&amp;wmode=1';

auth_check_menu($auth, $sub_menu, "w");

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="배송정보 등록" id="btn_submit" class="btn-e btn-e-lg btn-e-red">' ;
$frm_submit .= ' </div>';