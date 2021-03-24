<?php
/**
 * @file    /adm/eyoom_admin/core/sms/form_group.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900500";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL . '/?dir=sms&amp;pid=form_group_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "이모티콘 그룹";

$res = sql_fetch("select count(*) as cnt from {$g5['sms5_form_group_table']}");
$total_count = $res['cnt'];

$group = array();
$qry = sql_query("select * from {$g5['sms5_form_group_table']} order by fg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit .= ' <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit .= ' <input type="submit" name="act_button" value="선택비우기" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit .= '</div>';