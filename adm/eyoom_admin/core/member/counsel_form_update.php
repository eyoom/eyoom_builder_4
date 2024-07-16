<?php
/**
 * @file    /adm/eyoom_admin/core/member/counsel_form_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200150";

require_once G5_LIB_PATH . "/register.lib.php";

if ($w == 'u') {
    check_demo();
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$cs_id          = isset($_POST['cs_id']) ? (int) clean_xss_tags(trim($_POST['cs_id'])) : '';
$cs_part        = clean_xss_tags(trim($_POST['cs_part']));
$cs_company     = clean_xss_tags(trim($_POST['cs_company']));
$cs_name        = clean_xss_tags(trim($_POST['cs_name']));
$cs_tel         = clean_xss_tags(trim($_POST['cs_tel']));
$cs_email       = clean_xss_tags(trim($_POST['cs_email']));
$cs_email_ok    = clean_xss_tags(trim($_POST['cs_email_ok']));
$cs_status      = clean_xss_tags(trim($_POST['cs_status']));

$cs_subject = '';
if (isset($_POST['cs_subject'])) {
    $cs_subject = substr(trim($_POST['cs_subject']),0,255);
    $cs_subject = preg_replace("#[\\\]+$#", "", $cs_subject);
}

$cs_content = '';
if (isset($_POST['cs_content'])) {
    $cs_content = substr(trim($_POST['cs_content']),0,65536);
    $cs_content = preg_replace("#[\\\]+$#", "", $cs_content);
    $cs_content = addslashes($cs_content);
}

$cs_memo = '';
if (isset($_POST['cs_memo'])) {
    $cs_memo = substr(trim($_POST['cs_memo']),0,65536);
    $cs_memo = preg_replace("#[\\\]+$#", "", $cs_memo);
    $cs_memo = addslashes($cs_memo);
}

if (!$cs_part) {
    alert("업체명을 입력해 주세요.");
}

if (!$cs_company) {
    alert("회사명을 입력해 주세요.");
}

if (!$cs_name) {
    alert("담당자를 입력해 주세요.");
}

if (!$cs_tel) {
    alert("연락처를 입력해 주세요.");
} else {
    $cs_tel = $eb->get_phone_number($cs_tel);
}

if (!$cs_email) {
    alert("이메일을 입력해 주세요.");
} else {
    $msg = valid_mb_email($cs_email);
    if ($msg) {
        alert($msg);
    }
}

$sql = "update {$g5['eyoom_counsel']} 
            set cs_part = '{$cs_part}', 
                cs_company = '{$cs_company}', 
                cs_name = '{$cs_name}', 
                cs_tel = '{$cs_tel}', 
                cs_email = '{$cs_email}', 
                cs_subject = '{$cs_subject}', 
                cs_content = '{$cs_content}', 
                cs_memo = '{$cs_memo}', 
                cs_status = '{$cs_status}', 
                mb_id = '".$member['mb_id']."',
                cs_update = '".G5_TIME_YMDHIS."' 
            where cs_id = '{$cs_id}' ";
sql_query($sql);

$fr_date = trim($_POST['fr_date']);
$to_date = trim($_POST['to_date']);
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = '';
if(! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = '';

$qstr .= $fr_date ? '&amp;fr_date='.$fr_date: '';
$qstr .= $to_date ? '&amp;to_date='.$to_date: '';

goto_url(G5_ADMIN_URL . '/?dir=member&amp;pid=counsel_form&amp;'.$qstr.'&amp;w=u&amp;cs_id='.$cs_id, false);