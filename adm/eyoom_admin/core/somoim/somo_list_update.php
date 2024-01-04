<?php
/**
 * @file    /adm/eyoom_admin/core/somoim/somo_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "350200";

check_demo();

if (!isset($sm_bo_table)) exit;

if (!count($_POST['chk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['chk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];
        $sm_id = $_POST['sm_id'][$k];

        $sm_subject = is_array($_POST['sm_subject']) ? strip_tags($_POST['sm_subject'][$k]) : '';

        $sql = " update {$g5['eyoom_somoim']} set sm_subject = '".$sm_subject."' where sm_id = '".sql_real_escape_string($sm_id)."' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($_POST['act_button'] == "선택삭제") {

    if ($is_admin != 'super')
        alert('게시판 삭제는 최고관리자만 가능합니다.');

    auth_check($auth[$sub_menu], 'd');

    // _BOARD_DELETE_ 상수를 선언해야 board_delete.inc.php 가 정상 작동함
    define('_BOARD_DELETE_', true);

    for ($i=0; $i<count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['chk'][$i];

        // include 전에 $bo_table 값을 반드시 넘겨야 함
        $tmp_bo_table = trim($_POST['sm_id'][$k]);

        if( preg_match("/^[A-Za-z0-9_]+$/", $tmp_bo_table) ){
            include (G5_ADMIN_PATH . '/board_delete.inc.php');

            // 확장필드 정보 삭제
            sql_query("delete from {$g5['eyoom_exboard']} where bo_table = '{$tmp_bo_table}' ");

            // 이윰게시판 확장 정보 삭제
            sql_query("delete from {$g5['eyoom_board']} where bo_table = '{$tmp_bo_table}' ");
            
            // 소모임 삭제
            sql_query("delete from {$g5['eyoom_somoim']} where sm_id = '{$tmp_bo_table}' ");
        }
    }
    $msg = "선택한 소모임을 삭제하였습니다.";

}

// query string
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . '/?dir=somoim&amp;pid=somo_list&amp;'.$qstr);