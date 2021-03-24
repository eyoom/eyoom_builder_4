<?php
/**
 * @file    /adm/eyoom_admin/core/sms/history_list.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900400";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "문자전송 내역";

if ($page < 1) $page = 1;

if ($st && trim($sv))
    $sql_search = " and wr_message like '%$sv%' ";
else
    $sql_search = "";

$total_res = sql_fetch("select count(*) as cnt from {$g5['sms5_write_table']} where wr_renum=0 $sql_search");
$total_count = $total_res['cnt'];

$total_page = (int)($total_count/$page_size) + ($total_count%$page_size==0 ? 0 : 1);
$page_start = $page_size * ( $page - 1 );

$vnum = $total_count - (($page-1) * $page_size);

$qry = sql_query("select * from {$g5['sms5_write_table']} where wr_renum=0 $sql_search order by wr_no desc limit $page_start, $page_size");
$i=0;
while($res = sql_fetch_array($qry)) {
    $tmp_wr_memo = @unserialize($res['wr_memo']);
    $dupli_count = $tmp_wr_memo['total'] ? $tmp_wr_memo['total'] : 0;
    
    $list[$i] = $res;
    $list[$i]['dupli_count'] = $dupli_count;
    $list[$i]['vnum'] = $vnum;
    $vnum--;
    $i++;
}
$sms_count = is_array($list) ? count($list): 0;

/**
 * 페이징
 */
$paging = $eb->set_paging('admin', $dir, $pid, $qstr);

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';