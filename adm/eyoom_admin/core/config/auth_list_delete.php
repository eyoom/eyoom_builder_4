<?php
/**
 * @file    /adm/eyoom_admin/core/config/auth_list_delete.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "100200";

check_demo();

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

check_admin_token();

$count = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$post_act_button = isset($_POST['act_button']) ? clean_xss_tags($_POST['act_button'], 1, 1) : '';

if (!$count) {
    alert($_POST['act_button'] . " 하실 항목을 하나 이상 체크하세요.");
}

if ((isset($_POST['mb_id']) && !is_array($_POST['mb_id'])) || (isset($_POST['au_menu']) && !is_array($_POST['au_menu']))) {
    alert("잘못된 요청입니다.");
}

for ($i = 0; $i < $count; $i++) {
    // 실제 번호를 넘김
    $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
    
    $mb_id = isset($_POST['mb_id'][$k]) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['mb_id'][$k]) : '';
    $au_menu = isset($_POST['au_menu'][$k]) ? preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['au_menu'][$k]) : '';

    $sql = " delete from {$g5['auth_table']} where mb_id = '" . $mb_id . "' and au_menu = '" . $au_menu . "' ";
    sql_query($sql);

    run_event('adm_auth_delete_member', $mb_id, $au_menu);
}

alert('선택한 권한설정을 삭제하였습니다.', G5_ADMIN_URL . '/?dir=config&amp;pid=auth_list&amp;' . $qstr);