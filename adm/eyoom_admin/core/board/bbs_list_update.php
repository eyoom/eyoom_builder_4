<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300120";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk            = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button     = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (isset($_REQUEST['view']))  { // search order (검색 오름, 내림차순)
    $view = preg_match("/^(w|c)$/i", $sod) ? $sod : '';
    if ($view)
        $qstr .= '&amp;view=' . urlencode($view);
} else {
    $view = '';
}

if (!$post_count_chk) {
    alert($act_button . " 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i = 0; $i < $post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_wr_id = isset($_POST['wr_ids'][$k]) ? clean_xss_tags($_POST['wr_ids'][$k], 1, 1) : '';
        $post_wr_datetime = isset($_POST['wr_datetime'][$k]) ? clean_xss_tags($_POST['wr_datetime'][$k], 1, 1) : '';
        $post_wr_hit = isset($_POST['wr_hit'][$k]) ? clean_xss_tags($_POST['wr_hit'][$k], 1, 1) : '';
        $post_wr_good = isset($_POST['wr_good'][$k]) ? clean_xss_tags($_POST['wr_good'][$k], 1, 1) : '';
        $post_wr_nogood = isset($_POST['wr_nogood'][$k]) ? clean_xss_tags($_POST['wr_nogood'][$k], 1, 1) : '';

        $sql = " update {$write_table}
                    set wr_datetime = '" . sql_real_escape_string($post_wr_datetime) . "',
                        wr_hit      = '" . sql_real_escape_string($post_wr_hit) . "',
                        wr_good     = '" . sql_real_escape_string($post_wr_good) . "',
                        wr_nogood   = '" . sql_real_escape_string($post_wr_nogood) . "'
                  where wr_id       = '" . sql_real_escape_string($post_wr_id) . "' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";
}

// query string
$qstr .= $gr_id ? '&amp;gr_id='.$gr_id: '';
$qstr .= $bo_table ? '&amp;bo_table='.$bo_table: '';
$qstr .= $view ? '&amp;view='.$view: '';

run_event('admin_board_list_update', $act_button, $chk, $board_table, $qstr);

alert($msg, G5_ADMIN_URL . '/?dir=board&amp;pid=bbs_list&amp;' . $qstr);