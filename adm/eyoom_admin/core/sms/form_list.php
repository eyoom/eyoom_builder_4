<?php
/**
 * @file    /adm/eyoom_admin/core/sms/form_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900600";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$action_url = G5_ADMIN_URL.'/?dir=sms&amp;pid=form_multi_update&amp;smode=1';

$page_size = 12;

auth_check_menu($auth, $sub_menu, "r");

$token = get_token();

$g5['title'] = "이모티콘 관리";

if ($page < 1) $page = 1;

$fg_no = isset($_REQUEST['fg_no']) ? (int) $_REQUEST['fg_no'] : 0;

if (is_numeric($fg_no))
    $sql_group = " and fg_no='$fg_no' ";
else
    $sql_group = "";

$st = clean_xss_tags($st);
$sv = clean_xss_tags($sv);

if ($st == 'all') {
    $sql_search = "and (fo_name like '%{$sv}%' or fo_content like '%{$sv}%')";
} else if ($st == 'name') {
    $sql_search = "and fo_name like '%{$sv}%'";
} else if ($st == 'content') {
    $sql_search = "and fo_content like '%{$sv}%'";
} else {
    $sql_search = '';
}

$total_res = sql_fetch("select count(*) as cnt from {$g5['sms5_form_table']} where 1 $sql_group $sql_search");
$total_count = isset($total_res['cnt']) ? $total_res['cnt'] : 0;

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$vnum = $total_count - (($page-1) * $page_size);

$group = array();
$qry = sql_query("select * from {$g5['sms5_form_group_table']} order by fg_name");
while ($res = sql_fetch_array($qry)) array_push($group, $res);

$res = sql_fetch("select count(*) as cnt from {$g5['sms5_form_table']} where fg_no=0");
$no_count = isset($res['cnt']) ? $res['cnt'] : 0;

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" name="act_button" value="선택이동" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit .= ' <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn-e btn-e-lg btn-e-dark">' ;
$frm_submit .= ' <a href="'.G5_ADMIN_URL.'/?dir=sms&amp;pid=form_write&amp;page='.$page.'&amp;fg_no='.$fg_no.'" class="btn-e btn-e-lg btn-e-red">이모티콘 추가</a>' ;
$frm_submit .= '</div>';