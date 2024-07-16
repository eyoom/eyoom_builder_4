<?php
/**
 * @file    /adm/eyoom_admin/core/member/counsel_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "200150";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (! $post_count_chk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

if ($act_button == "선택수정") {
    for ($i=0; $i<count((array)$_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $post_cs_id= isset($_POST['cs_id'][$k]) ? $_POST['cs_id'][$k] : '';
        $post_cs_status= isset($_POST['cs_status'][$k]) ? clean_xss_tags(trim($_POST['cs_status'][$k])) : '1';

        $sql = " update {$g5['eyoom_counsel']}
                    set cs_status = '" . trim($post_cs_status). "',
                        cs_update = '" . G5_TIME_YMDHIS . "'
                    where cs_id = '" . sql_real_escape_string($post_cs_id) . "' ";
        sql_query($sql);
    }
    $message = "선택한 상담정보의 상태를 수정하였습니다.";

} elseif ($_POST['act_button'] == "선택삭제") {
    for ($i = 0; $i < count($_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_cs_id= isset($_POST['cs_id'][$k]) ? $_POST['cs_id'][$k] : '';

        $sql = "select * from {$g5['eyoom_counsel']} where cs_id = '{$post_cs_id}' ";
        $sc = sql_fetch($sql);
        $cs_file1 = unserialize($sc['cs_file1']);
        $cs_file2 = unserialize($sc['cs_file2']);

        $counsel_file_path = G5_DATA_PATH.'/counsel';
        $cs_file_1 = $counsel_file_path.'/'.$cs_file1['file'];
        if ($cs_file1['source'] && file_exists($cs_file_1)) {
            unlink($cs_file_1);
        }
        $cs_file_2 = $counsel_file_path.'/'.$cs_file2['file'];
        if ($cs_file2['source'] && file_exists($cs_file_2)) {
            unlink($cs_file_2);
        }

        $sql = "delete from {$g5['eyoom_counsel']} where cs_id = '{$post_cs_id}'";
        sql_query($sql);
    }
    $message = "선택한 상담정보를 삭제처리하였습니다.";
}

alert($message, G5_ADMIN_URL . '/?dir=member&amp;pid=counsel_list&amp;'.$qstr);