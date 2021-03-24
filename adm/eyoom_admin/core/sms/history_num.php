<?php
/**
 * @file    /adm/eyoom_admin/core/sms/history_view.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900410";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "문자전송 내역 (번호별)";

if ($page < 1) $page = 1;

if( isset($st) && !in_array($st, array('hs_name', 'hs_hp', 'bk_no')) ){
    $st = '';
}

if ($st && trim($sv))
    $sql_search = " and $st like '%$sv%' ";
else
    $sql_search = "";

$total_res = sql_fetch("select count(*) as cnt from {$g5['sms5_history_table']} where 1 $sql_search");
$total_count = $total_res['cnt'];

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$vnum = $total_count - (($page-1) * $page_size);

$qry = sql_query("select * from {$g5['sms5_history_table']} where 1 $sql_search order by hs_no desc limit $page_start, $page_size");
$i=0;
while($res = sql_fetch_array($qry)) {
    $write = sql_fetch("select * from {$g5['sms5_write_table']} where wr_no='{$res['wr_no']}' and wr_renum=0");
    $group = sql_fetch("select * from {$g5['sms5_book_group_table']} where bg_no='{$res['bg_no']}'");
    if ($group)
        $bg_name = $group['bg_name'];
    else
        $bg_name = '없음';

    if ($res['mb_id'])
        $mb_id = $res['mb_id'];
    else
        $mb_id = '비회원';

    $list[$i] = $res;
    $list[$i]['bg_name'] = $bg_name;
    $list[$i]['mb_id'] = $mb_id;
    $list[$i]['vnum'] = $vnum;
    $vnum--;
    $i++;
}

$count = is_array($list) ? count($list): 0;

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';