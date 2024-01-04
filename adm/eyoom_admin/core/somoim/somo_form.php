<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/somo_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350200";

auth_check($auth[$sub_menu], 'w');

if ($is_admin != 'super' && $w == '') alert('최고관리자만 접근 가능합니다.');

if (!isset($sm_bo_table)) exit;

$action_url1 = G5_ADMIN_URL . '/?dir=somoim&amp;pid=somo_form_update&amp;smode=1';

/**
 * 신청 테이블 정보
 */
$write_table = $g5['write_prefix'] . $sm_bo_table;
$sql_common = " from {$write_table} ";

$html_title = '';
$sm_id_attr = '';
$sound_only = '';
if ($w == '') {
    $html_title .= ' 생성';
    $sm_id_attr = 'required';
    
    $wr_id = clean_xss_tags(trim($_GET['wr_id']));
    $sql_where = " wr_id = '{$wr_id}' and wr_id = wr_parent ";
    
    if (!$wr_id) alert('정상적인 방법으로 생성해 주시기 바랍니다.');
    
    /**
     * 신청한 소모임이 이미 등록되어 있는지 체크
     */
    $row = sql_fetch("select count(*) as cnt from {$g5['eyoom_somoim']} where wr_id = '{$wr_id}'");
    if ($row['cnt']) {
        alert("해당 신청건에 대한 소모임은 이미 개설하였습니다.", G5_ADMIN_URL."/?dir=somoim&amp;pid=somo_list");
    }
    
    $sainfo = sql_fetch("select wr_id, wr_subject, wr_name, wr_good, mb_id {$sql_common} where {$sql_where} ");
    if ($sainfo['wr_nogood'] == '1') alert('이미 개설된 소모임입니다.');
    if ($sainfo['wr_good'] < $somo['sm_goods_for_open']) alert('개설조건을 충족시키지 못하였습니다.');

} else if ($w == 'u') {
    $sm = sql_fetch(" select * from {$g5['eyoom_somoim']} where sm_id = '$sm_id' ");
    $html_title .= ' 수정';
    $sm_id_attr = 'readonly';
    
    $wr_id = $sm['wr_id'];
    $sql_where = " wr_id = '{$sm['wr_id']}' and wr_id = wr_parent ";
    
    $sainfo = sql_fetch("select wr_id, wr_subject, wr_name, wr_good, mb_id {$sql_common} where {$sql_where} ");
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

if ($smc) $qstr .= "&amp;smc={$smc}";

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=somoim&amp;pid=somo_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';