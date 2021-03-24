<?php
/**
 * @file    /adm/eyoom_admin/core/sms/history_view.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "900400";
include_once(EYOOM_ADMIN_CORE_PATH . '/sms/_common.php');

$re_text = '';

$st = isset($st) ? strip_tags($st) : '';
$ssv = isset($ssv) ? strip_tags($ssv) : '';

if( $st && !in_array($st, array('hs_name', 'hs_hp', 'bk_no')) ){
    $st = '';
}

if( $sst && !in_array($sst, array('mb_id', 'bk_no', 'hs_name', 'hs_hp', 'hs_datetime', 'hs_flag', 'hs_code', 'hs_memo', 'hs_log')) ){
    $sst = '';
}

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = "문자전송 상세내역";

if (!is_numeric($wr_no))
    alert('전송 고유 번호가 없습니다.');

if ($spage < 1) $spage = 1;

if ($sst && trim($ssv))
    $sql_search = " and $sst like '%".sql_real_escape_string($ssv)."%' ";
else
    $sql_search = "";

if ($wr_renum) {
    $sql_renum = " and wr_renum='$wr_renum' ";
    $re_text = " <span style='font-weight:normal; color:red;'>(재전송)</span>";
} else
    $sql_renum = " and wr_renum='0'";

$total_res = sql_fetch("select count(*) as cnt from {$g5['sms5_history_table']} where wr_no='$wr_no' $sql_search $sql_renum");
$total_count = $total_res['cnt'];

$spage_size = 15;
$total_spage = (int)($total_count/$spage_size) + ($total_count%$spage_size==0 ? 0 : 1);
$spage_start = $spage_size * ( $spage - 1 );

$vnum = $total_count - (($spage-1) * $spage_size);

$write = sql_fetch("select * from {$g5['sms5_write_table']} where wr_no='$wr_no' $sql_renum");
if ($write['wr_booking'] == '0000-00-00 00:00:00')
    $write['wr_booking'] = '즉시전송';

$res = sql_fetch("select count(*) as cnt from {$g5['sms5_write_table']} where wr_no='$wr_no' and wr_renum>0");
$re_vnum = $res['cnt'];

if ($write['wr_re_total'] && !$wr_renum) {
    $qry = sql_query("select * from {$g5['sms5_write_table']} where wr_no='$wr_no' and wr_renum>0 order by wr_renum desc");
    $i=0;
    while($res = sql_fetch_array($qry)) {
        $list[$i] = $res;
        $list[$i]['re_vnum'] = $re_vnum;
        $re_vnum--;
        $i++;
    }
    $count = is_array($list) ? count($list): 0;
}

$qry = sql_query("select * from {$g5['sms5_history_table']} where wr_no='$wr_no' $sql_search $sql_renum order by hs_no desc limit $spage_start, $spage_size");
$i=0;
while($res = sql_fetch_array($qry)) {
    $group = sql_fetch("select * from {$g5['sms5_book_group_table']} where bg_no='{$res['bg_no']}'");
    if ($group)
        $bg_name = $group['bg_name'];
    else
        $bg_name = '없음';

    if ($res['mb_id'])
        $mb_id = $res['mb_id'];
    else
        $mb_id = '비회원';

    $res['hs_log'] = str_replace($config['cf_icode_pw'], '**********', $res['hs_log']);
    
    $hs_list[$i] = $res;
    $hs_list[$i]['bg_name'] = $bg_name;
    $hs_list[$i]['mb_id'] = $mb_id;
    $hs_list[$i]['vnum'] = $vnum;
    $vnum--;
    $i++;
}
$hs_count = is_array($hs_list) ? count($hs_list): 0;

/**
 * 검색버튼
 */
$frm_submit  = ' <div class="text-center margin-top-10 margin-bottom-10"> ';
$frm_submit .= ' <input type="submit" value="검색" class="btn-e btn-e-lg btn-e-dark" accesskey="s">' ;
$frm_submit .= '</div>';