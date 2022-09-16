<?php
/**
 * @file    /adm/eyoom_admin/core/member/poll_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200900";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=poll_form_update&amp;smode=1';

auth_check_menu($auth, $sub_menu, 'w');

$po_id = isset($po_id) ? (int) $po_id : 0;
$po = array(
    'po_subject' => '',
    'po_etc' => '',
    'po_level' => '',
    'po_point' => '',
);

$html_title = '투표';
if ($w == '') {
    $html_title .= ' 생성';
} elseif ($w == 'u') {
    $html_title .= ' 수정';
    $sql = " select * from {$g5['poll_table']} where po_id = '{$po_id}' ";
    $po = sql_fetch($sql);
} else {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if (!isset($po['po_use'])) {
    sql_query(" alter table `{$g5['poll_table']}` add `po_use` tinyint not null default '0' after `mb_ids` ", false);
}

$g5['title'] = $html_title;

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="확인" class="btn-e btn-e-lg btn-e-red" accesskey="s">' ;
$frm_submit .= !$wmode ? ' <a href="' . G5_ADMIN_URL . '/?dir=member&amp;pid=poll_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ': '';
$frm_submit .= '</div>';