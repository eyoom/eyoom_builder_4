<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_ytitemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

check_demo();

$es_code = isset($_POST['es_code']) ? (int) clean_xss_tags(trim($_POST['es_code'])) : '';
$post_count_ytchk = (isset($_POST['ytchk']) && is_array($_POST['ytchk'])) ? count($_POST['ytchk']) : 0;
$ytchk = (isset($_POST['ytchk']) && is_array($_POST['ytchk'])) ? $_POST['ytchk'] : array();
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

if (! $post_count_ytchk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button === "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_ytchk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['ytchk'][$i]) ? (int) $_POST['ytchk'][$i] : 0;

        $post_ei_autoplay = isset($_POST['ei_autoplay'][$k]) ? (int) clean_xss_tags($_POST['ei_autoplay'][$k], 1, 1) : '';
        $post_ei_control = isset($_POST['ei_control'][$k]) ? (int) clean_xss_tags($_POST['ei_control'][$k], 1, 1) : '';
        $post_ei_loop = isset($_POST['ei_loop'][$k]) ? (int) clean_xss_tags($_POST['ei_loop'][$k], 1, 1) : '';
        $post_ei_mute = isset($_POST['ei_mute'][$k]) ? (int) clean_xss_tags($_POST['ei_mute'][$k], 1, 1) : '';
        $post_ei_raster = isset($_POST['ei_raster'][$k]) ? (int) clean_xss_tags($_POST['ei_raster'][$k], 1, 1) : '';
        $post_ei_sort = isset($_POST['ei_sort'][$k]) ? (int) clean_xss_tags($_POST['ei_sort'][$k], 1, 1) : '';
        $post_ei_state = isset($_POST['ei_state'][$k]) ? (int) clean_xss_tags($_POST['ei_state'][$k], 1, 1) : '';
        $ei_view_level = isset($_POST['ei_view_level'][$k]) ? (int) clean_xss_tags($_POST['ei_view_level'][$k], 1, 1) : 1;
        $ei_no = isset($_POST['ei_no'][$k]) ? (int) clean_xss_tags($_POST['ei_no'][$k], 1, 1) : '';

        $sql = " update {$g5['eyoom_slider_ytitem']}
                    set ei_autoplay = '{$post_ei_autoplay}',
                        ei_control = '{$post_ei_control}',
                        ei_loop = '{$post_ei_loop}',
                        ei_mute = '{$post_ei_mute}',
                        ei_raster = '{$post_ei_raster}',
                        ei_sort = '{$post_ei_sort}',
                        ei_state = '{$post_ei_state}',
                        ei_view_level = '{$ei_view_level}'
                 where ei_no = '{$ei_no}' and ei_theme = '{$post_theme}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($act_button == "선택삭제") {

    auth_check_menu($auth, $sub_menu, 'd');
    $del_ei_no = array();
    for ($i=0; $i<$post_count_ytchk; $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['ytchk'][$i]) ? (int) $_POST['ytchk'][$i] : 0;
        $ei_no = isset($_POST['ei_no'][$k]) ? clean_xss_tags($_POST['ei_no'][$k], 1, 1) : '';
        $del_ei_no[$i] = $ei_no;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ei_no, '".implode(',', $del_ei_no)."') and ei_theme = '{$post_theme}' ";

    /**
     * EB슬라이더 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_slider_ytitem']} where {$where} ";
    sql_query($sql);
    $msg = "선택한 EB슬라이더의 유튜브동영상 아이템을 삭제하였습니다.";
}

/**
 * wmode 상태라면
 */
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=ebslider_form&amp;es_code={$es_code}&amp;w=u&amp;".$qstr);