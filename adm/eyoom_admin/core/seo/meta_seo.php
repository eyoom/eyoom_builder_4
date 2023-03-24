<?php
/**
 * @file    /adm/eyoom_admin/core/seo/meta_seo.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "330100";

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=seo&pid=meta_seo_update&smode=1";

auth_check_menu($auth, $sub_menu, 'r');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="confirm-bottom-btn text-center margin-top-30 margin-bottom-30 m-t-0 m-b-0"> ';
$frm_submit .= ' <input type="submit" value="적용하기" class="btn-e btn-e-lg btn-e-crimson" accesskey="s">' ;
$frm_submit .= '</div>';