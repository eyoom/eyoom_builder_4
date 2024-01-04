<?php
/**
 * @file    /adm/eyoom_admin/core/theme/board_list_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999200";

check_demo();

$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (isset($_REQUEST['theme'])) {
    if (!is_array($_REQUEST['theme'])) {
        $post_theme = filter_var($_REQUEST['theme'], FILTER_VALIDATE_REGEXP, array(
            "options" => array("regexp" => "/^[a-z0-9_]+$/i")
        ));
        $post_theme = preg_replace('/[^a-z0-9_]/i', '', trim($post_theme));
    }
} else {
    $post_theme = 'eb4_basic';
}

if (! $post_count_chk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button === "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_bo_skin = isset($_POST['bo_skin'][$k]) ? clean_xss_tags($_POST['bo_skin'][$k], 1, 1) : '';
        $bo_write_limit = isset($_POST['bo_write_limit'][$k]) ? clean_xss_tags($_POST['bo_write_limit'][$k], 1, 1) : '';
        $use_gnu_skin = isset($_POST['use_gnu_skin'][$k]) ? clean_xss_tags($_POST['use_gnu_skin'][$k], 1, 1) : '';
        $post_board_table = isset($_POST['board_table'][$k]) ? clean_xss_tags($_POST['board_table'][$k], 1, 1) : '';

        $sql = " update {$g5['eyoom_board']}
                    set bo_skin             = '".sql_real_escape_string($post_bo_skin)."',
                        bo_write_limit      = '".sql_real_escape_string($bo_write_limit)."',
                        use_gnu_skin        = '".sql_real_escape_string($use_gnu_skin)."'
                  where bo_table            = '".sql_real_escape_string($post_board_table)."' and bo_theme = '".sql_real_escape_string($post_theme)."' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if ($page) $qstr .= "page={$page}";
}

alert($msg, G5_ADMIN_URL . '/?dir=theme&amp;pid=board_list&amp;'.$qstr);