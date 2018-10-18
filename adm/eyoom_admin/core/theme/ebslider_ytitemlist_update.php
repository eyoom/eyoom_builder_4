<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_ytitemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

check_demo();

if (!count($_POST['ytchk'])) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

if ($_POST['act_button'] == "선택수정") {

    auth_check($auth[$sub_menu], 'w');

    for ($i=0; $i<count($_POST['ytchk']); $i++) {

        // 실제 번호를 넘김
        $k = $_POST['ytchk'][$i];

        $sql = " update {$g5['eyoom_slider_ytitem']}
                    set ei_autoplay = '{$_POST['ei_autoplay'][$k]}',
                        ei_control = '{$_POST['ei_control'][$k]}',
                        ei_loop = '{$_POST['ei_loop'][$k]}',
                        ei_mute = '{$_POST['ei_mute'][$k]}',
                        ei_raster = '{$_POST['ei_raster'][$k]}',
                        ei_sort = '{$_POST['ei_sort'][$k]}',
                        ei_state = '{$_POST['ei_state'][$k]}',
                        ei_view_level = '{$_POST['ei_view_level'][$k]}'
                 where ei_no = '{$_POST['ei_no'][$k]}' and ei_theme = '{$_POST['theme']}' ";
        sql_query($sql);
    }
    $msg = "정상적으로 수정하였습니다.";

    if (!$page) $page = 1;
    $qstr = "page={$page}";

} else if ($_POST['act_button'] == "선택삭제") {

    auth_check($auth[$sub_menu], 'd');

    for ($i=0; $i<count($_POST['ytchk']); $i++) {
        // 실제 번호를 넘김
        $k = $_POST['ytchk'][$i];
        $del_ei_no[$i] = $_POST['ei_no'][$k];
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ei_no, '".implode(',', $del_ei_no)."') and ei_theme = '{$_POST['theme']}' ";

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

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=ebslider_form&amp;es_code={$_POST['es_code']}&amp;thema='{$_POST['theme']}'&amp;w=u&amp;".$qstr);