<?php
/**
 * @file    /adm/eyoom_admin/core/member/mail_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200300";

include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], 'r');

/**
 * 폼 action URL
 */
$action_url1 = G5_ADMIN_URL . "/?dir=member&amp;pid=mail_update&amp;smode=1";

$html_title = '회원메일';

if ($w == 'u') {
    $html_title .= '수정';
    $readonly = ' readonly';

    $sql = " select * from {$g5['mail_table']} where ma_id = '{$ma_id}' ";
    $ma = sql_fetch($sql);
    if (!$ma['ma_id'])
        alert('등록된 자료가 없습니다.');
} else {
    $html_title .= '입력';
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=member&amp;pid=mail_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';