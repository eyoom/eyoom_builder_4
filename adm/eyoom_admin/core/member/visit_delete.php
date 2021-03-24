<?php
/**
 * @file    /adm/eyoom_admin/core/member/visit_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200820";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=visit_delete_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'r');

// 최소년도 구함
$sql = " select min(vi_date) as min_date from {$g5['visit_table']} ";
$row = sql_fetch($sql);

$min_year = (int)substr($row['min_date'], 0, 4);
$now_year = (int)substr(G5_TIME_YMD, 0, 4);

/**
 * 삭제버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="로그삭제" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= '</div>';