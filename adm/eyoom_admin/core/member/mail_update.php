<?php
/**
 * @file    /adm/eyoom_admin/core/member/mail_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200300";

if ($w == 'u' || $w == 'd')
    check_demo();

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$ma_id = isset($_POST['ma_id']) ? (int) $_POST['ma_id'] : 0;
$ma_subject = isset($_POST['ma_subject']) ? strip_tags(clean_xss_attributes($_POST['ma_subject'])) : '';
$ma_content = isset($_POST['ma_content']) ? $_POST['ma_content'] : '';

if ($w == '') {
    $sql = " insert {$g5['mail_table']}
                set ma_subject = '{$ma_subject}',
                     ma_content = '{$ma_content}',
                     ma_time = '".G5_TIME_YMDHIS."',
                     ma_ip = '{$_SERVER['REMOTE_ADDR']}' ";
    sql_query($sql);
    $msg = "정상적으로 메일을 등록하였습니다.";
} else if ($w == 'u') {
    $sql = " update {$g5['mail_table']}
                set ma_subject = '{$ma_subject}',
                     ma_content = '{$ma_content}',
                     ma_time = '".G5_TIME_YMDHIS."',
                     ma_ip = '{$_SERVER['REMOTE_ADDR']}'
                where ma_id = '{$ma_id}' ";
    sql_query($sql);
    $msg = "메일정보를 수정하였습니다.";
} else if ($w == 'd') {
	$sql = " delete from {$g5['mail_table']} where ma_id = '{$ma_id}' ";
    sql_query($sql);
    $msg = "선택한 회원메일을 삭제하였습니다.";
}

alert($msg, G5_ADMIN_URL."/?dir=member&pid=mail_list");