<?php
/**
 * @file    /adm/eyoom_admin/core/theme/ebslider_itemlist_update.php
 */
if (!defined('_EYOOM_IS_ADMIN_')) exit;

$sub_menu = "999600";

check_demo();

$es_code = isset($_POST['es_code']) ? clean_xss_tags(trim($_POST['es_code'])) : '';
$post_count_chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? count($_POST['chk']) : 0;
$chk = (isset($_POST['chk']) && is_array($_POST['chk'])) ? $_POST['chk'] : array();
$post_theme = isset($_POST['theme']) && $_POST['theme'] ? clean_xss_tags($_POST['theme']) : 'eb4_basic';
$act_button = isset($_POST['act_button']) ? strip_tags($_POST['act_button']) : '';

if (! $post_count_chk) {
    alert($act_button." 하실 항목을 하나 이상 체크하세요.");
}

check_admin_token();

if ($act_button === "선택수정") {

    auth_check_menu($auth, $sub_menu, 'w');

    for ($i=0; $i<$post_count_chk; $i++) {

        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;

        $post_ei_sort = isset($_POST['ei_sort'][$k]) ? clean_xss_tags($_POST['ei_sort'][$k], 1, 1) : '';
        $post_ei_state = isset($_POST['ei_state'][$k]) ? clean_xss_tags($_POST['ei_state'][$k], 1, 1) : '';
        $ei_view_level = isset($_POST['ei_view_level'][$k]) ? clean_xss_tags($_POST['ei_view_level'][$k], 1, 1) : 1;
        $ei_no = isset($_POST['ei_no'][$k]) ? clean_xss_tags($_POST['ei_no'][$k], 1, 1) : '';

        $sql = " update {$g5['eyoom_slider_item']}
                    set ei_sort = '{$post_ei_sort}',
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
    for ($i=0; $i<count((array)$_POST['chk']); $i++) {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        $ei_no = isset($_POST['ei_no'][$k]) ? clean_xss_tags($_POST['ei_no'][$k], 1, 1) : '';
        $del_ei_no[$i] = $ei_no;
    }

    /**
     * 쿼리 조건문
     */
    $where = " find_in_set(ei_no, '".implode(',', $del_ei_no)."') and ei_theme = '{$post_theme}' ";

    /**
     * EB 슬라이더 아이템 파일 경로
     */
    $ebslider_folder = G5_DATA_PATH.'/ebslider/' . $post_theme;

    $sql = "select ei_img from {$g5['eyoom_slider_item']} where {$where}";
    $res = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($res); $i++) {
        $ei_file = $ebslider_folder . "/{$row['ei_img']}";
        if (!is_dir($ei_file) && file_exists($ei_file)) {
            @unlink($ei_file);
        }
    }

    /**
     * EB슬라이더 아이템 레코드 삭제
     */
    $sql = "delete from {$g5['eyoom_slider_item']} where {$where} ";
    sql_query($sql);
    $msg = "선택한 EB슬라이더의 아이템을 삭제하였습니다.";
}

/**
 * 설정된 정보를 파일로 저장 - 캐쉬 기능
 */
$thema->save_ebslider_item($es_code , $post_theme);

/**
 * wmode 상태라면
 */
$qstr .= $wmode ? '&amp;wmode=1': '';

alert($msg, G5_ADMIN_URL . "/?dir=theme&amp;pid=ebslider_form&amp;es_code={$es_code}&amp;thema='{$post_theme}'&amp;w=u&amp;".$qstr);