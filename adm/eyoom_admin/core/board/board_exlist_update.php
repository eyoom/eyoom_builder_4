<?php
/**
 * @file    /adm/eyoom_admin/core/board/board_exlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "300100";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';
$board_table = (isset($_POST['board_table']) && is_array($_POST['board_table'])) ? $_POST['board_table'] : array();

if (! $post_count_chk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($_POST['act_button'] == "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {
        unset($ex_use_search, $ex_required);
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $ex_use_search  = $_POST['ex_use_search'][$k] == 'y' ? 'y':'n';
        $ex_required    = $_POST['ex_required'][$k] == 'y' ? 'y':'n';
        $ex_subject = isset($_POST['ex_subject'][$k]) ? clean_xss_tags($_POST['ex_subject'][$k], 1, 1) : '';
        $ex_no = isset($_POST['ex_no'][$k]) ? (int) $_POST['ex_no'][$k] : 0;
        $post_board_table = isset($_POST['board_table'][$k]) ? clean_xss_tags($_POST['board_table'][$k], 1, 1) : '';

        $sql = " update {$g5['eyoom_exboard']} set
                    ex_subject      = '{$ex_subject}',
                    ex_use_search   = '{$ex_use_search}',
                    ex_required     = '{$ex_required}'
                 where ex_no = '{$ex_no}' and bo_table = '{$post_board_table}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');

    $write_table = $g5['write_prefix'] . $board['bo_table'];

    $del_count = count((array)$_POST['chk']);
    $del_ex_no = array();
    for ($i=0; $i<$del_count; $i++) {
        unset($ex_fname);
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $del_ex_no[$i] = isset($_POST['ex_no'][$k]) ? (int) $_POST['ex_no'][$k] : 0;
        $ex_fname = isset($_POST['ex_fname'][$k]) ? clean_xss_tags($_POST['ex_fname'][$k]) : '';
        $sql = " alter table `{$write_table}` drop `{$ex_fname}`";
        sql_query($sql, true);
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ex_no, '".implode(',', $del_ex_no)."') and bo_table = '{$_POST['bo_table']}' ";

    /**
     * 확장필드 테이블 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_exboard']} where {$where} ";
    sql_query($sql);

    // 최종 확장필드 갯수
    $sql = "SHOW COLUMNS FROM {$write_table} LIKE 'ex_%'";
    $res = sql_query($sql);
    $ex = array();
    for($i=0; $row=sql_fetch_array($res); $i++) {
        $ex[$i] = $row['Field'];
    }
    $bo_ex_cnt = count($ex);

    sql_query("update {$g5['board_table']} set bo_ex_cnt = '{$bo_ex_cnt}' where bo_table = '{$_POST['bo_table']}' ");

    $msg = "선택한 확장필드를 정상적으로 삭제하였습니다.";
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

alert($msg, G5_ADMIN_URL . "/?dir=board&amp;pid=board_extend&amp;bo_table={$_POST['bo_table']}&amp;{$qstr}");