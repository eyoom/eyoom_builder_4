<?php
/**
 * @file    /adm/eyoom_admin/core/member/mail_select_form.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200300";

$action_url1 = G5_ADMIN_URL . '/?dir=member&amp;pid=mail_select_list';

if (!$config['cf_email_use']) {
    alert('환경설정에서 \'메일발송 사용\'에 체크하셔야 메일을 발송할 수 있습니다.');
}

auth_check_menu($auth, $sub_menu, 'r');

$ma_id = isset($_GET['ma_id']) ? (int) $_GET['ma_id'] : 0;

$sql = " select * from {$g5['mail_table']} where ma_id = '$ma_id' ";
$ma = sql_fetch($sql);
if (!$ma['ma_id']) {
    alert('보내실 내용을 선택하여 주십시오.');
}

// 전체회원수
$sql = " select COUNT(*) as cnt from {$g5['member_table']} ";
$row = sql_fetch($sql);
$tot_cnt = $row['cnt'];

// 탈퇴대기회원수
$sql = " select COUNT(*) as cnt from {$g5['member_table']} where mb_leave_date <> '' ";
$row = sql_fetch($sql);
$finish_cnt = $row['cnt'];

$last_option = explode('||', $ma['ma_last_option']);
for ($i = 0; $i < count($last_option); $i++) {
    $option = explode('=', $last_option[$i]);
    // 동적변수
    $var = isset($option[0]) ? $option[0] : '';
    if (isset($option[1])) {
        $$var = $option[1];
    }
}

if (!isset($mb_id1)) {
    $mb_id1 = 1;
}
if (!isset($mb_level_from)) {
    $mb_level_from = 1;
}
if (!isset($mb_level_to)) {
    $mb_level_to = 10;
}
if (!isset($mb_mailling)) {
    $mb_mailling = 1;
}

$mb_id1_from = isset($mb_id1_from) ? clean_xss_tags($mb_id1_from, 1, 1, 30) : '';
$mb_id1_to = isset($mb_id1_to) ? clean_xss_tags($mb_id1_to, 1, 1, 30) : '';
$mb_email = isset($mb_email) ? clean_xss_tags($mb_email, 1, 1, 100) : '';

$sql = " select gr_id, gr_subject from {$g5['group_table']} order by gr_subject ";
$result = sql_query($sql);
$list = array();
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $list[$i] = $row;
}

/**
 * 버튼
 */
$frm_submit  = ' <div class="text-center margin-top-30 margin-bottom-30"> ';
$frm_submit .= ' <input type="submit" value="메일발송 대상 확인" class="btn-e btn-e-lg btn-e-red">' ;
$frm_submit .= ' <a href="' . G5_ADMIN_URL . '/?dir=member&amp;pid=mail_list&amp;'.$qstr.'" class="btn-e btn-e-lg btn-e-dark">목록</a> ';
$frm_submit .= '</div>';