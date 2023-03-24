<?php
/**
 * @file    /adm/eyoom_admin/core/shop/personalpaycopy.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400440";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=shop&amp;pid=personalpaycopyupdate&amp;smode=1";

auth_check_menu($auth, $sub_menu, "w");

$g5['title'] = '개인결제 복사';

$sql = " select * from {$g5['g5_shop_personalpay_table']} where pp_id = '$pp_id' ";
$row = sql_fetch($sql);

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" id="btn_submit" class="btn-e btn-e-lg btn-e-red" accesskey="s">';
$frm_submit .= '</div>';