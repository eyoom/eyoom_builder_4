<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemcopy.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400300";

$ca_id = isset($_REQUEST['ca_id']) ? preg_replace('/[^0-9a-z]/i', '', $_REQUEST['ca_id']) : '';
$it_id = isset($_REQUEST['it_id']) ? safe_replace_regex($_REQUEST['it_id'], 'it_id') : '';

auth_check_menu($auth, $sub_menu, "r");

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="button" value="복사하기" id="btn_submit" class="btn-e btn-e-lg btn-e-red" onclick="_copy();">' ;
$frm_submit .= ' </div>';