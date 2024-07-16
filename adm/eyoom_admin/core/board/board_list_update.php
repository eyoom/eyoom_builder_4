<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk            = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button     = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';
$board_table    = (isset($_POST['board_table']) && is_array($_POST['board_table'])) ? $_POST['board_table'] : array();

if (!$post_count_chk) {
    alert($act_button . " 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i = 0; $i < $post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_gr_id = isset($_POST['gr_id'][$k]) ? clean_xss_tags($_POST['gr_id'][$k], 1, 1) : '';
        $post_bo_device = isset($_POST['bo_device'][$k]) ? clean_xss_tags($_POST['bo_device'][$k], 1, 1) : '';
        $post_bo_skin = isset($_POST['bo_skin'][$k]) ? clean_xss_tags($_POST['bo_skin'][$k], 1, 1) : '';
        $post_bo_mobile_skin = isset($_POST['bo_mobile_skin'][$k]) ? clean_xss_tags($_POST['bo_mobile_skin'][$k], 1, 1) : '';
        $post_bo_read_point = isset($_POST['bo_read_point'][$k]) ? clean_xss_tags($_POST['bo_read_point'][$k], 1, 1) : '';
        $post_bo_write_point = isset($_POST['bo_write_point'][$k]) ? clean_xss_tags($_POST['bo_write_point'][$k], 1, 1) : '';
        $post_bo_comment_point = isset($_POST['bo_comment_point'][$k]) ? clean_xss_tags($_POST['bo_comment_point'][$k], 1, 1) : '';
        $post_bo_download_point = isset($_POST['bo_download_point'][$k]) ? clean_xss_tags($_POST['bo_download_point'][$k], 1, 1) : '';
        $post_bo_use_search = isset($_POST['bo_use_search'][$k]) ? clean_xss_tags($_POST['bo_use_search'][$k], 1, 1) : '';
        $post_bo_use_sns = isset($_POST['bo_use_sns'][$k]) ? clean_xss_tags($_POST['bo_use_sns'][$k], 1, 1) : '';
        $post_bo_order = isset($_POST['bo_order'][$k]) ? clean_xss_tags($_POST['bo_order'][$k], 1, 1) : '';
        $post_board_table = isset($_POST['board_table'][$k]) ? clean_xss_tags($_POST['board_table'][$k], 1, 1) : '';

        $bo_skin_set = '';
        if ($post_bo_skin && $post_bo_mobile_skin) {
            $bo_skin_set = " bo_skin = '" . sql_real_escape_string($post_bo_skin) . "',
                          bo_mobile_skin = '" . sql_real_escape_string($post_bo_mobile_skin) . "',
            ";
        }

        unset($post_use_gnu_skin);
        if (isset($_POST['use_gnu_skin'][$k])) {
            $post_use_gnu_skin = $_POST['use_gnu_skin'][$k] == 'y' ? 'y': 'n';
        }

        if ($is_admin != 'super') {
            $sql = " select count(*) as cnt from {$g5['board_table']} a, {$g5['group_table']} b
                      where a.gr_id = '" . sql_real_escape_string($post_gr_id) . "'
                        and a.gr_id = b.gr_id
                        and b.gr_admin = '{$member['mb_id']}' ";
            $row = sql_fetch($sql);
            if (!$row['cnt']) {
                alert('최고관리자가 아닌 경우 다른 관리자의 게시판(' . $board_table[$k] . ')은 수정이 불가합니다.');
            }
        }

        $p_bo_subject = is_array($_POST['bo_subject']) ? strip_tags(clean_xss_attributes($_POST['bo_subject'][$k])) : '';

        $sql = " update {$g5['board_table']}
                    set gr_id               = '" . sql_real_escape_string($post_gr_id) . "',
                        bo_subject          = '" . $p_bo_subject . "',
                        bo_device           = '" . sql_real_escape_string($post_bo_device) . "',
                        {$bo_skin_set}
                        bo_read_point       = '" . sql_real_escape_string($post_bo_read_point) . "',
                        bo_write_point      = '" . sql_real_escape_string($post_bo_write_point) . "',
                        bo_comment_point    = '" . sql_real_escape_string($post_bo_comment_point) . "',
                        bo_download_point   = '" . sql_real_escape_string($post_bo_download_point) . "',
                        bo_use_search       = '" . sql_real_escape_string($post_bo_use_search) . "',
                        bo_use_sns          = '" . sql_real_escape_string($post_bo_use_sns) . "',
                        bo_order            = '" . sql_real_escape_string($post_bo_order) . "'
                  where bo_table            = '" . sql_real_escape_string($post_board_table) . "' ";

        sql_query($sql);

        if ($post_use_gnu_skin) {
            $sql = " update {$g5['eyoom_board']} set use_gnu_skin = '{$post_use_gnu_skin}' where bo_table = '" . sql_real_escape_string($post_board_table) . "' ";
            sql_query($sql);
        }
    }
    $msg = "정상적으로 수정하였습니다.";

} else if ($act_button == "선택삭제") {
    if ($is_admin != 'super') {
        alert('게시판 삭제는 최고관리자만 가능합니다.');
    }

    auth_check_menu($auth, $sub_menu, 'd');

    // _BOARD_DELETE_ 상수를 선언해야 board_delete.inc.php 가 정상 작동함
    /* 확인필요 22.05.27
    A file should declare new symbols (classes, functions, constants, etc.) and cause no other side effects,
    or it should execute logic with side effects, but should not do both.*/
    define('_BOARD_DELETE_', true);

    for ($i=0; $i<$post_count_chk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        // include 전에 $bo_table 값을 반드시 넘겨야 함
        $tmp_bo_table = isset($_POST['board_table'][$k]) ? trim(clean_xss_tags($_POST['board_table'][$k], 1, 1)) : '';

        if (preg_match("/^[A-Za-z0-9_]+$/", $tmp_bo_table)) {
            include (G5_ADMIN_PATH . '/board_delete.inc.php');

            // 확장필드 정보 삭제
            sql_query("delete from {$g5['eyoom_exboard']} where bo_table = '" . sql_real_escape_string($tmp_bo_table) . "' ");

            // 이윰게시판 확장 정보 삭제
            sql_query("delete from {$g5['eyoom_board']} where bo_table = '" . sql_real_escape_string($tmp_bo_table) . "' ");

            // 인기게시글 삭제
            sql_query(" delete from {$g5['eyoom_best']} where bo_table = '{$tmp_bo_table}' ");
        }
    }
    $msg = "선택한 게시판을 삭제하였습니다.";

}

// query string
$qstr .= $grid ? '&amp;grid='.$grid: '';
$qstr .= $boskin ? '&amp;boskin='.$boskin: '';
$qstr .= $bomobileskin ? '&amp;bomobileskin='.$bomobileskin: '';
$qstr .= $bo_ex ? '&amp;bo_ex='.$bo_ex: '';
$qstr .= $bo_cate ? '&amp;bo_cate='.$bo_cate: '';
$qstr .= $bo_sideview ? '&amp;bo_sideview='.$bo_sideview: '';
$qstr .= $bo_dhtml ? '&amp;bo_dhtml='.$bo_dhtml: '';
$qstr .= $bo_secret ? '&amp;bo_secret='.$bo_secret: '';
$qstr .= $bo_good ? '&amp;bo_good='.$bo_good: '';
$qstr .= $bo_nogood ? '&amp;bo_nogood='.$bo_nogood: '';
$qstr .= $bo_file ? '&amp;bo_file='.$bo_file: '';
$qstr .= $bo_cont ? '&amp;bo_cont='.$bo_cont: '';
$qstr .= $bo_list ? '&amp;bo_list='.$bo_list: '';
$qstr .= $bo_sns ? '&amp;bo_sns='.$bo_sns: '';
$qstr .= $wmode ? '&amp;wmode=1': '';

run_event('admin_board_list_update', $act_button, $chk, $board_table, $qstr);

alert($msg, G5_ADMIN_URL . '/?dir=board&amp;pid=board_list&amp;' . $qstr);