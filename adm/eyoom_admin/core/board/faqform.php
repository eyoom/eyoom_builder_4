<?php
/**
 * @file    /adm/eyoom_admin/core/board/faqform.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300700";

include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

$action_url1 = G5_ADMIN_URL . '/?dir=board&amp;pid=faqformupdate&amp;smode=1';

$fm_id = (int) $fm_id;
$fa_id = isset($fa_id) ? (int) $fa_id : 0;

$sql = " select * from {$g5['faq_master_table']} where fm_id = '$fm_id' ";
$fm = sql_fetch($sql);

$html_title = $fm['fm_subject'];

if ($w == "u")
{
    $html_title .= " 수정";
    $readonly = " readonly";

    $sql = " select * from {$g5['faq_table']} where fa_id = '$fa_id' ";
    $fa = sql_fetch($sql);
    if (!$fa['fa_id']) alert("등록된 자료가 없습니다.");
}
else
    $html_title .= ' 항목 입력';

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=board&amp;pid=faqlist&amp;fm_id='.$fm_id.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';