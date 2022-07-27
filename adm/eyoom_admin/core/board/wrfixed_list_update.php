<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300900";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk            = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button     = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (!$post_count_chk) {
    alert($act_button . " 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i = 0; $i < $post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_bf_open = isset($_POST['bf_open'][$k]) ? clean_xss_tags($_POST['bf_open'][$k], 1, 1) : '';
        $post_bo_table = isset($_POST['bo_table'][$k]) ? clean_xss_tags($_POST['bo_table'][$k], 1, 1) : '';
        $post_wr_id = isset($_POST['wr_id'][$k]) ? clean_xss_tags($_POST['wr_id'][$k], 1, 1) : '';
        
        $sql_where = " bo_table = '" . sql_real_escape_string($post_bo_table) . "' and wr_id='" . sql_real_escape_string($post_wr_id) . "' ";
        
        $sql_add = '';
        if ($post_bf_open == 'y') {
            $row = sql_fetch("select * from {$g5['eyoom_wrfixed']} where {$sql_where}");
            $mbinfo = get_member($row['mb_id']);

            if ($row['bf_wrfixed_point'] > $mbinfo['mb_point']) {
                continue;
            } else {
                if ($row['po_datetime'] == '0000-00-00 00:00:00' && $row['mb_id'] != $config['cf_admin']) {
                    insert_point($row['mb_id'], $row['bf_wrfixed_point']*(-1), "{$row['bo_table']}-{$row['wr_id']} 게시물 상단고정", $row['bo_table'], $row['wr_id'], "상단고정 - ".time());
                    $sql_add = ", po_datetime = '" . G5_TIME_YMDHIS . "' ";
                }
            }
            $ex_time = $bbs->get_exdatetime($row['bf_wrfixed_date']);
            $ex_datetime = date('Y-m-d H:i:s', $ex_time);
            $sql_add .= ", ex_datetime = '" . $ex_datetime . "' ";
        }

        $sql = " update {$g5['eyoom_wrfixed']} set bf_open = '" . sql_real_escape_string($post_bf_open) . "' {$sql_add} where {$sql_where} ";

        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($act_button == "선택삭제") {
    if ($is_admin != 'super') {
        alert('삭제는 최고관리자만 가능합니다.');
    }

    auth_check_menu($auth, $sub_menu, 'd');

    define('_WRFIXED_DELETE_', true);

    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_bo_table = isset($_POST['bo_table'][$k]) ? clean_xss_tags($_POST['bo_table'][$k], 1, 1) : '';
        $post_wr_id = isset($_POST['wr_id'][$k]) ? clean_xss_tags($_POST['wr_id'][$k], 1, 1) : '';

        // 확장필드 정보 삭제
        $sql = "delete from {$g5['eyoom_wrfixed']} where bo_table = '" . sql_real_escape_string($post_bo_table) . "' and wr_id='" . sql_real_escape_string($post_wr_id) . "' ";
        sql_query($sql);
    }
    $msg = "선택한 게시판을 삭제하였습니다.";

}

// query string
$qstr .= $wmode ? '&amp;wmode=1': '';

run_event('admin_board_list_update', $act_button, $chk, $board_table, $qstr);

alert($msg, G5_ADMIN_URL . '/?dir=board&amp;pid=wrfixed_list&amp;' . $qstr);