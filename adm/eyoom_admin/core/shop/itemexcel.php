<?php
/**
 * @file    /adm/eyoom_admin/core/shop/itemexcel.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "400300";

auth_check($auth[$sub_menu], "w");

$action_url1 = G5_ADMIN_URL . '/?dir=shop&amp;pid=itemexcelupdate';

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="button" value="상품 엑셀파일 등록" id="btn_submit" class="btn-e btn-e-lg btn-e-red" onclick="_copy();">' ;
$frm_submit .= ' </div>';