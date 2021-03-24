<?php
/**
 * @file    /adm/eyoom_admin/core/sms/member_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900200";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "회원정보 업데이트";

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=member_update_run&amp;smode=1';

$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="실행" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';