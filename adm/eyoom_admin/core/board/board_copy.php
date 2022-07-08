<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_copy.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

auth_check_menu($auth, $sub_menu, 'w');

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=board_copy_update&amp;smode=1';

$bo_table = $_REQUEST['bo_table'];
if (empty($bo_table)) {
    alert_close("정상적인 방법으로 이용해주세요.");
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';